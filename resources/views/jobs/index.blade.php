@extends('layouts.app')

@section('title', ' Your Dream Job')

@section('content')
<div class="bg-blue-900 py-12 text-white text-center">
    <h1 class="text-4xl font-bold">Find Your Suitable Job</h1>
</div>

<div class="max-w-7xl mx-auto p-6">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
<!-- Left side -->
         <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-lg p-6 border border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Filters</h2>


                <div class="mb-6">
                    <label class="text-gray-700 text-sm font-semibold">Job Title / Keywords</label>
                    <input type="text" name="search" class="w-full p-3 border border-gray-300 rounded-md outline-none mt-1" placeholder="E.g., Software Engineer">
                </div>


                <div class="mb-6">
                    <label class="text-gray-700 text-sm font-semibold">Location</label>
                    <select name="location" class="w-full p-3 border border-gray-300 rounded-md outline-none mt-1">
                        <option value="">All Locations</option>
                        <option value="Cairo">Cairo</option>
                        <option value="Alexandria">Alexandria</option>
                        <option value="Remote">Remote</option>
                    </select>
                </div>


                <div class="mb-6">
                    <label class="text-gray-700 text-sm font-semibold">Job Category</label>
                    <select name="category" class="w-full p-3 border border-gray-300 rounded-md outline-none mt-1">
                        <option value="">All Categories</option>
                        <option value="Programming">Programming</option>
                        <option value="Management">Management</option>
                        <option value="HR">HR</option>
                        <option value="Marketing">Marketing</option>
                    </select>
                </div>


                <div class="mb-6">
                    <label class="text-gray-700 text-sm font-semibold">Work Type</label>
                    <select name="work_type" class="w-full p-3 border border-gray-300 rounded-md outline-none mt-1">
                        <option value="">All Types</option>
                        <option value="remote">Remote</option>
                        <option value="onsite">On-site</option>
                        <option value="hybrid">Hybrid</option>
                    </select>
                </div>


                <div class="mb-6">
                    <label class="text-gray-700 text-sm font-semibold">Experience Level</label>
                    <select name="experience_level" class="w-full p-3 border border-gray-300 rounded-md outline-none mt-1">
                        <option value="">All Levels</option>
                        <option value="entry">Entry Level</option>
                        <option value="mid">Mid Level</option>
                        <option value="senior">Senior Level</option>
                    </select>
                </div>


                <div class="mb-6">
    <label class="text-gray-700 text-sm font-semibold">Salary Range</label>
    <select name="salary_range" class="w-full p-3 border border-gray-300 rounded-md outline-none mt-1">
        <option value="">All Salaries</option>
        <option value="0-5000">EGP 0 - EGP 5,000</option>
        <option value="5000-10000">EGP 5,000 - EGP 10,000</option>
        <option value="10000-20000">EGP 10,000 - EGP 20,000</option>
        <option value="20000-30000">EGP 20,000 - EGP 30,000</option>
        <option value="30000-50000">EGP 30,000 - EGP 50,000</option>
        <option value="50000+">EGP 50,000+</option>
    </select>
</div>


                  <div class="mb-6">
                    <label class="text-gray-700 text-sm font-semibold">Date Posted</label>
                    <select name="date_posted" class="w-full p-3 border border-gray-300 rounded-md outline-none mt-1">
                        <option value="">Any Time</option>
                        <option value="1">Last 24 Hours</option>
                        <option value="7">Last 7 Days</option>
                        <option value="30">Last 30 Days</option>
                    </select>
                </div>



                <button type="submit" class="w-full bg-blue-600 text-white p-3 rounded-md font-semibold hover:bg-blue-700 transition">Apply Filters</button>
            </div>
        </div>

<!-- right side -->
<div class="lg:col-span-3">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Latest Jobs</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                @foreach ($jobs as $job)
                    <div class="bg-white shadow-md rounded-lg p-6 border border-gray-200 transform transition-transform duration-300 hover:scale-105 hover:shadow-xl">
                        <div class="flex justify-between items-center">
                            <div>
                                <h2 class="text-xl font-semibold text-blue-600">
                                    <a href="{{ url('/jobs/' . $job['id']) }}">{{ $job['title'] }}</a>
                                </h2>
                                <p class="text-gray-600">{{ $job['company'] }} - {{ $job['location'] }}</p>
                                <p class="text-gray-500 text-sm">{{ $job['posted_at'] ?? 'Recently Posted' }}</p>
                            </div>
                            <div>
                                @if (!empty($job['company_logo']))
                                    <img src="{{ asset('storage/company_logos/' . $job['company_logo']) }}" alt="{{ $job['company'] }} Logo" class="h-12 w-12 object-cover rounded">
                                @endif
                            </div>
                        </div>
                        <div class="mt-2">
                            <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-xs">{{ ucfirst($job['job_type']) }}</span>
                            <span class="bg-green-200 text-green-700 px-3 py-1 rounded-full text-xs">{{ $job['experience'] ?? 'Experience not specified' }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
