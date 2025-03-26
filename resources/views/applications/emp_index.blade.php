@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black text-white">
    <div class="container mx-auto px-4 py-8">

        <div class="mb-8">
            <h1 class="text-3xl font-bold text-white">Job Applications</h1>
            <p class="text-gray-400 mt-2">Review and manage candidate applications</p>
        </div>

        <div class="bg-black rounded-xl border border-gray-800 mb-8 overflow-hidden">
            <div class="flex border-b border-gray-800">
                <a href="{{ route('applications.emp_index') }}" class="relative px-8 py-4 font-medium text-center {{ request('status') ? 'text-gray-400 hover:text-white' : 'text-white font-semibold' }} transition-all duration-200">
                    All Applications
                    @if(!request('status'))
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-white"></span>
                    @endif
                </a>
                <a href="{{ route('applications.emp_index', ['status' => 'pending']) }}" class="relative px-8 py-4 font-medium text-center {{ request('status') === 'pending' ? 'text-white font-semibold' : 'text-gray-400 hover:text-white' }} transition-all duration-200">
                    Pending
                    @if(request('status') === 'pending')
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-white"></span>
                    @endif
                </a>
                <a href="{{ route('applications.emp_index', ['status' => 'accepted']) }}" class="relative px-8 py-4 font-medium text-center {{ request('status') === 'accepted' ? 'text-white font-semibold' : 'text-gray-400 hover:text-white' }} transition-all duration-200">
                    Accepted
                    @if(request('status') === 'accepted')
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-white"></span>
                    @endif
                </a>
                <a href="{{ route('applications.emp_index', ['status' => 'rejected']) }}" class="relative px-8 py-4 font-medium text-center {{ request('status') === 'rejected' ? 'text-white font-semibold' : 'text-gray-400 hover:text-white' }} transition-all duration-200">
                    Rejected
                    @if(request('status') === 'rejected')
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-white"></span>
                    @endif
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @if ($applications->isEmpty())
                <div class="col-span-full bg-black rounded-xl border border-gray-800 p-12 text-center">
                    <div class="w-20 h-20 mx-auto bg-gray-900 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-10 h-10 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    @if (request('status') === 'pending')
                        <p class="text-gray-300 text-xl font-medium mb-2">No pending applications</p>
                        <p class="text-gray-500">Applications awaiting review will appear here</p>
                    @elseif (request('status') === 'accepted')
                        <p class="text-gray-300 text-xl font-medium mb-2">No accepted applications</p>
                        <p class="text-gray-500">Candidates you've approved will appear here</p>
                    @elseif (request('status') === 'rejected')
                        <p class="text-gray-300 text-xl font-medium mb-2">No rejected applications</p>
                        <p class="text-gray-500">Candidates you've declined will appear here</p>
                    @else
                        <p class="text-gray-300 text-xl font-medium mb-2">No applications found</p>
                        <p class="text-gray-500">Applications will appear here once candidates apply to your listings</p>
                    @endif
                </div>
            @else
                @foreach ($applications as $application)
                    <div class="bg-black rounded-xl border border-gray-800 overflow-hidden hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                        <div class="relative">
                            <div class="absolute top-0 left-0 w-full h-1 bg-white"></div>
                            <div class="pt-6 px-6 pb-4">
                                <div class="flex justify-between items-start mb-2">
                                    <h2 class="text-xl font-semibold text-white">{{ $application->jobListing->title }}</h2>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($application->status === 'pending') bg-yellow-900 text-yellow-200
                                        @elseif($application->status === 'accepted') bg-green-900 text-green-200
                                        @else bg-red-900 text-red-200
                                        @endif">
                                        {{ ucfirst($application->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="px-6 pt-2 pb-6">
                            <div class="flex items-center pb-4 mb-4 border-b border-gray-800">
                                <div class="w-12 h-12 bg-gray-800 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                    {{ substr($application->candidate->user->f_name, 0, 1) }}{{ substr($application->candidate->user->l_name, 0, 1) }}
                                </div>
                                <div class="ml-3">
                                    <p class="font-semibold text-white">{{ $application->candidate->user->f_name }} {{ $application->candidate->user->l_name }}</p>
                                    <p class="text-sm text-gray-400">Applicant</p>
                                </div>
                            </div>

                            <div class="space-y-3 mb-6">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    <a href="mailto:{{ $application->contact_email }}" class="text-white hover:text-gray-300 hover:underline">{{ $application->contact_email }}</a>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    <a href="tel:{{ $application->contact_phone }}" class="text-white hover:text-gray-300 hover:underline">{{ $application->contact_phone }}</a>
                                </div>
                            </div>
                            
                            <a href="{{ asset('storage/documents/resumes/' . basename($application->resume_url)) }}" 
                               target="_blank" 
                               class="flex items-center justify-center bg-gray-900 text-white w-full py-2 rounded-lg hover:bg-gray-800 transition-colors duration-200 mb-4">
                               Download Resume
                            </a>

                            @if (Auth::user()->role === 'employer' && $application->status === 'pending')
                                <div class="flex space-x-2">
                                    <form action="{{ route('applications.update', $application) }}" method="POST" class="w-1/2">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="accepted">
                                        <button type="submit" class="w-full bg-white text-black px-4 py-2.5 rounded-lg hover:bg-gray-200 transition-colors duration-200 font-medium">
                                            Accept
                                        </button>
                                    </form>
                                    <form action="{{ route('applications.update', $application) }}" method="POST" class="w-1/2">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="w-full bg-gray-800 text-white px-4 py-2.5 rounded-lg hover:bg-gray-700 transition-colors duration-200 font-medium">
                                            Reject
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection