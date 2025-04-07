<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobListing;
use App\Models\Candidate;
use App\Models\Employer;
use App\Models\Application;

class AdminController extends Controller
{
    public function dashboard()
    {
        $latestApplications = Application::with('candidate.user', 'jobListing')->latest()->take(5)->get();
    
        return view('admin.dashboard', [
            'candidates_count' => Candidate::count(),
            'employers_count' => Employer::count(),
            'applications_count' => Application::count(),
            'candidates' => Candidate::all(),
            'employers' => Employer::all(),
            'latestApplications' => $latestApplications,
        ]);
    }
    

    public function jobListings()
    {
        return view('admin.job_listings', ['jobs' => JobListing::all()]);
    }

    public function approveJob($id)
    {
        JobListing::where('id', $id)->update(['is_approved' => true]);
        return back()->with('success', 'Job approved successfully');
    }

    public function rejectJob($id)
    {
        JobListing::where('id', $id)->update(['is_approved' => false]);
        return back()->with('error', 'Job rejected successfully');
    }
    public function showApplications()
    {        $candidates = Candidate::with('user')->get();
        $employers = Employer::with('user', 'jobListings')->get();

        $applications = Application::with('candidate.user', 'jobListing')->latest()->get();
        return view('admin.applications', [
            'latestApplications' => $applications,
            'applications_count' => Application::count(),  
            'candidates_count' => Candidate::count(),
            'employers_count' => Employer::count(),
            'activeTab' => 'applications',
            'candidates' => $candidates,
            'employers' => $employers,

        ]);
    }
    
    public function showEmployers()
    {        $latestApplications = Application::with('candidate.user', 'jobListing')->latest()->take(5)->get();
        $employers = Employer::with('user', 'jobListings')->get();
        $candidates = Candidate::with('user')->get();

        return view('admin.employeers', [
            'candidates' => $candidates,

            'employers' => $employers,
            'applications_count' => Application::count(),  
            'candidates_count' => Candidate::count(),
            'employers_count' => Employer::count(),
            'activeTab' => 'employers',
            'latestApplications' => $latestApplications,

        ]);
    }
    
    public function showCandidates()
    {        $latestApplications = Application::with('candidate.user', 'jobListing')->latest()->take(5)->get();
        $employers = Employer::with('user', 'jobListings')->get();

        $candidates = Candidate::with('user')->get();
        return view('admin.candidaties', [
            'candidates' => $candidates,
            'employers' => $employers,

            'applications_count' => Application::count(),  // <-- Add this
            'candidates_count' => Candidate::count(),
            'employers_count' => Employer::count(),
            'activeTab' => 'candidates',
            'latestApplications' => $latestApplications,

        ]);
    }
    

}
