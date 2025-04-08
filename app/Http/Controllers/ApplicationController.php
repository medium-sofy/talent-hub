<?php
namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\JobListing;
use App\Models\Notification;
use App\Models\User;
use App\Notifications\ApplicationStatusUpdated;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends Controller
{
    public function empIndex(Request $request)
    {
        if (Auth::user()->role !== 'employer') {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        if (!Auth::user()->employer) {
            return redirect()->back()->with('error', 'Employer profile not found.');
        }

        $status = $request->query('status');

        $applications = Application::whereHas('jobListing', function ($query) {
            $query->where('employer_id', Auth::user()->employer->id);
        })
        ->when($status, function ($query, $status) {
            return $query->where('status', $status);
        })
        ->with(['candidate.user', 'jobListing'])
        ->get();

        return view('applications.emp_index', compact('applications'));
    }

    public function candIndex(Request $request)
    {
        if (Auth::user()->role !== 'candidate') {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        if (!Auth::user()->candidate) {
            return redirect()->back()->with('error', 'Candidate profile not found.');
        }

        $applications = Application::where('candidate_id', Auth::user()->candidate->id)
            ->with(['jobListing'])
            ->get();

        return view('applications.cand_index', compact('applications'));
    }

    public function create($jobId)
    {
        if (Auth::user()->role !== 'candidate') {
            return redirect()->route('jobs.index')->with('error', 'Only candidates can apply for jobs.');
        }

        if (!Auth::user()->candidate) {
            return redirect()->route('jobs.index')->with('error', 'Candidate profile not found.');
        }

        $job = JobListing::findOrFail($jobId);
        return view('applications.create', compact('job'));
    }

    public function store(Request $request, $jobId)
    {
        if (Auth::user()->role !== 'candidate') {
            return redirect()->route('jobs.index')->with('error', 'Only candidates can apply for jobs.');
        }

        if (!Auth::user()->candidate) {
            return redirect()->route('jobs.index')->with('error', 'Candidate profile not found.');
        }

        $existingApplication = Application::where('job_listing_id', $jobId)
            ->where('candidate_id', Auth::user()->candidate->id)
            ->first();

        if ($existingApplication) {
            return redirect()->back()->withErrors(['application' => 'You have already applied to this job.']);
        }

        $validatedData = $request->validate([
            'contact_email' => 'required|email',
            'contact_phone' => 'required|regex:/^[0-9]{10,15}$/',
            'resume' => 'required|mimes:pdf,docx|max:2048',
        ]);

        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('', 'candidate_resume'); 
            $resumeUrl = 'documents/resumes/'.basename($resumePath);
        } else {
            return redirect()->back()->withErrors(['resume' => 'Resume file is required.']);
        }

        Application::create([
            'job_listing_id' => $jobId,
            'candidate_id' => Auth::user()->candidate->id,
            'status' => 'pending',
            'contact_email' => $validatedData['contact_email'],
            'contact_phone' => $validatedData['contact_phone'],
            'resume_url' => $resumeUrl, 
        ]);

        return redirect()->route('applications.cand_index')->with('success', 'Application submitted successfully!');
    }

    public function destroy($id)
    {
        $application = Application::findOrFail($id);

        if (Auth::user()->role !== 'candidate' || $application->candidate_id !== Auth::user()->candidate->id) {
            return redirect()->route('applications.cand_index')->with('error', 'Unauthorized action.');
        }

        $application->delete();
        return redirect()->route('applications.cand_index')->with('success', 'Application canceled successfully!');
    }

    public function update(Request $request, $id)
    {
        $application = Application::findOrFail($id);

        if (Auth::user()->role !== 'employer') {
            return redirect()->route('applications.emp_index')->with('error', 'Unauthorized action.');
        }

        if (!Auth::user()->employer) {
            return redirect()->route('applications.emp_index')->with('error', 'Employer profile not found.');
        }

        $request->validate([
            'status' => 'required|in:accepted,rejected',
        ]);

        $oldStatus = $application->status;
        $newStatus = $request->status;

        $application->update(['status' => $newStatus]);

        if ($oldStatus !== $newStatus) {
            $candidate = $application->candidate;
            $user = $candidate->user;

      // Create a notification using custom Notification model instead of laravel pure system
            Notification::create([
                'user_id' => $user->id,
                'message' => 'Your application for "' . $application->jobListing->title . '" has been ' . $newStatus . '.',
                'is_read' => false,
                'notifiable_type' => User::class,
                'notifiable_id' => $user->id,
            ]);
        }

        return redirect()->route('applications.emp_index')->with('success', 'Application status updated!');
    }
}
