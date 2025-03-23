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
        $latestApplications   = Application::with('candidate.user', 'jobListing')->latest()->take(5)->get();

        return view('admin.dashboard', [
            'candidates' => Candidate::count(),
            'employers' => Employer::count(),
            'applications' => Application::count(),

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
}
