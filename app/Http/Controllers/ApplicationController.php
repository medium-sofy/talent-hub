<?php
namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the applications for the logged-in employer.
     */

    public function empIndex(Request $request)
    {
        if (Auth::user()->role !== 'employer') {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        $status = $request->query('status');

        $applications = Application::whereHas('jobListing', function ($query) {
            $query->where('employer_id', Auth::user()->employers->id);
        })
        ->when($status, function ($query, $status) {
            return $query->where('status', $status);
        })
        ->with(['candidate.user', 'jobListing'])
        ->get();

        return view('applications.emp_index', compact('applications'));
    }

    /**
     * Display a listing of the applications for the logged-in candidate.
     */
    public function candIndex(Request $request)
    {

        if (Auth::user()->role !== 'candidate') {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        $applications = Application::where('candidate_id', Auth::user()->candidates->id)
            ->with(['jobListing'])
            ->get();

        return view('applications.cand_index', compact('applications'));
    }



    public function create($jobId)
    {

        if (Auth::user()->role !== 'candidate') {
            return redirect()->route('jobs.index')->with('error', 'Only candidates can apply for jobs.');
        }

        $job = JobListing::findOrFail($jobId);
        return view('applications.create', compact('job'));
    }



    public function store(Request $request, $jobId)
    {

        if (Auth::user()->role !== 'candidate') {
            return redirect()->route('jobs.index')->with('error', 'Only candidates can apply for jobs.');
        }


        $existingApplication = Application::where('job_listing_id', $jobId)
            ->where('candidate_id', Auth::user()->candidates->id)
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
            $resumePath = $request->file('resume')->store('resumes', 'public'); // Store in the "public/resumes" directory
        } else {
            return redirect()->back()->withErrors(['resume' => 'Resume file is required.']);
        }


        Application::create([
            'job_listing_id' => $jobId,
            'candidate_id' => Auth::user()->candidates->id,
            'status' => 'pending',
            'contact_email' => $validatedData['contact_email'],
            'contact_phone' => $validatedData['contact_phone'],
            'resume_url' => $resumePath,
        ]);

        return redirect()->route('applications.cand_index')->with('success', 'Application submitted successfully!');
    }


    public function destroy($id)
    {
        $application = Application::findOrFail($id);


        if (Auth::user()->role !== 'candidate' || $application->candidate_id !== Auth::user()->candidates->id) {
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

        $request->validate([
            'status' => 'required|in:accepted,rejected',
        ]);

        $application->update(['status' => $request->status]);

        return redirect()->route('applications.emp_index')->with('success', 'Application status updated!');
    }
}
