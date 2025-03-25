@extends('layouts.app')

@section('title', $job['title'])

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-lg p-8 border border-gray-200">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h2 class="text-3xl font-semibold text-blue-600">{{ $job['title'] }}</h2>
                        <p class="text-gray-600 mt-2">{{ $job['company'] }} - {{ $job['location'] }}</p>
                        <p class="text-gray-500 text-sm mt-1">{{ $job['posted_at'] ?? 'Recently Posted' }}</p>
                    </div>
                    <div>
                        @if (!empty($job['company_logo']))
                            <img src="{{ asset('storage/company_logos/' . $job['company_logo']) }}" alt="{{ $job['company'] }} Logo" class="h-20 w-20 object-cover rounded">
                        @endif
                    </div>
                </div>

                <div class="mb-8">
                    <a href="#" class="w-full bg-blue-600 text-white p-4 rounded-lg font-semibold hover:bg-blue-700 transition text-center block text-lg">
                        Apply Now
                    </a>
                </div>

                <div class="mb-8">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Job Description</h3>
                    <p class="text-gray-700 text-base leading-relaxed">{{ $job['description'] }}</p>
                </div>

                <div class="mb-8">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Responsibilities</h3>
                    <p class="text-gray-700 text-base leading-relaxed">{{ $job['responsibilities'] }}</p>
                </div>

                <div class="mb-8">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Skills</h3>
                    <p class="text-gray-700 text-base leading-relaxed">{{ $job['skills'] }}</p>
                </div>

                <div class="mb-8">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Technologies</h3>
                    <p class="text-gray-700 text-base leading-relaxed">{{ $job['technologies'] }}</p>
                </div>

                <div class="mb-8">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Salary</h3>
                    <p class="text-gray-700 text-base leading-relaxed">{{ $job['salary'] }}</p>
                </div>

                <div class="mb-8">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Benefits</h3>
                    <p class="text-gray-700 text-base leading-relaxed">{{ $job['benefits'] }}</p>
                </div>

                <div class="mb-8">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Experience</h3>
                    <p class="text-gray-700 text-base leading-relaxed">{{ $job['experience'] }}</p>
                </div>

                <div class="mb-8">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Application Deadline</h3>
                    <p class="text-gray-700 text-base leading-relaxed">{{ $job['deadline'] }}</p>
                </div>
            </div>
        </div>

        <div class="lg:col-span-1">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Similar Jobs</h2>

            <div class="space-y-6">
                @foreach ($similar_jobs as $similar_job)
                    <div class="bg-white shadow-md rounded-lg p-6 border border-gray-200 transform transition-transform duration-300 hover:scale-105 hover:shadow-xl">
                        <div class="flex justify-between items-center">
                            <div>
                                <h2 class="text-xl font-semibold text-blue-600">
                                    <a href="{{ url('/jobs/' . $similar_job['id']) }}">{{ $similar_job['title'] }}</a>
                                </h2>
                                <p class="text-gray-600">{{ $similar_job['company'] }} - {{ $similar_job['location'] }}</p>
                                <p class="text-gray-500 text-sm">{{ $similar_job['posted_at'] ?? 'Recently Posted' }}</p>
                            </div>
                            <div>
                                @if (!empty($similar_job['company_logo']))
                                    <img src="{{ asset('storage/company_logos/' . $similar_job['company_logo']) }}" alt="{{ $similar_job['company'] }} Logo" class="h-12 w-12 object-cover rounded">
                                @endif
                            </div>
                        </div>
                        <div class="mt-2">
                            <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-xs">{{ ucfirst($similar_job['job_type']) }}</span>
                            <span class="bg-green-200 text-green-700 px-3 py-1 rounded-full text-xs">{{ $similar_job['experience'] ?? 'Experience not specified' }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection