<?php

namespace App\Http\Controllers;

use App\Http\Requests\jobs\PostJobRequest;
use App\Models\JobListing;
use App\Models\Category;
use Illuminate\Http\Request;

class JobListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Category::limit(10)->get();
        $jobs = JobListing::all();
        return view('jobs.index', compact('jobs', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('jobs.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostJobRequest $request)
    {
        JobListing::create([...$request->validated(), 'employer_id'=>auth()->user()->employer->id]);
        return redirect()->route('jobs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(JobListing $jobListing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobListing $jobListing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobListing $jobListing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobListing $jobListing)
    {
        //
    }
}
