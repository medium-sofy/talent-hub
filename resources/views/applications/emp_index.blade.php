@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">
    <div class="container mx-auto px-4 py-8">

    <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Job Applications</h1>
        </div>


        <div class="bg-white shadow rounded-lg mb-6">
            <div class="flex border-b border-gray-200">
                <a href="{{ route('applications.emp_index') }}" class="px-6 py-3 font-medium text-sm {{ request('status') ? 'text-gray-600' : 'text-blue-600 border-b-2 border-blue-600' }}">
                    All Applications
                </a>
                <a href="{{ route('applications.emp_index', ['status' => 'pending']) }}" class="px-6 py-3 font-medium text-sm {{ request('status') === 'pending' ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-600' }}">
                    Pending
                </a>
                <a href="{{ route('applications.emp_index', ['status' => 'accepted']) }}" class="px-6 py-3 font-medium text-sm {{ request('status') === 'accepted' ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-600' }}">
                    Accepted
                </a>
                <a href="{{ route('applications.emp_index', ['status' => 'rejected']) }}" class="px-6 py-3 font-medium text-sm {{ request('status') === 'rejected' ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-600' }}">
                    Rejected
                </a>
            </div>
        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @if ($applications->isEmpty())
                <div class="col-span-full bg-white rounded-lg shadow-md p-8 text-center">
                    @if (request('status') === 'pending')
                        <p class="text-gray-500 text-lg">No pending applications.</p>
                    @elseif (request('status') === 'accepted')
                        <p class="text-gray-500 text-lg">No accepted applications.</p>
                    @elseif (request('status') === 'rejected')
                        <p class="text-gray-500 text-lg">No rejected applications.</p>
                    @else
                        <p class="text-gray-500 text-lg">No applications found.</p>
                    @endif
                </div>
            @else
                @foreach ($applications as $application)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-all duration-200">

                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
                            <h2 class="text-xl font-semibold text-gray-800">{{ $application->jobListing->title }}</h2>
                            <div class="mt-1">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($application->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($application->status === 'accepted') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($application->status) }}
                                </span>
                            </div>
                        </div>


                        <div class="p-6">
                            <div class="mb-4">
                                <p class="text-gray-700 font-medium">
                                    <span class="text-gray-500">Candidate:</span> {{ $application->candidate->user->f_name }} {{ $application->candidate->user->l_name }}
                                </p>
                            </div>


                            <div class="space-y-3 mb-4">
                                <div class="flex items-center">
                                    <span class="text-gray-500 w-32">Email:</span>
                                    <a href="mailto:{{ $application->contact_email }}" class="text-blue-600 hover:text-blue-700 hover:underline">{{ $application->contact_email }}</a>
                                </div>
                                <div class="flex items-center">
                                    <span class="text-gray-500 w-32">Phone:</span>
                                    <a href="tel:{{ $application->contact_phone }}" class="text-blue-600 hover:text-blue-700 hover:underline">{{ $application->contact_phone }}</a>
                                </div>
                                <div class="flex items-center">
                                    <span class="text-gray-500 w-32">Resume:</span>
                                    <a href="{{ asset('storage/' . $application->resume_url) }}" target="_blank" class="text-blue-600 hover:text-blue-700 hover:underline">Download Resume</a>
                                </div>
                            </div>


                            @if (Auth::user()->role === 'employer' && $application->status === 'pending')
                                <div class="flex space-x-2 pt-4 border-t border-gray-100">
                                    <form action="{{ route('applications.update', $application) }}" method="POST" class="w-1/2">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="accepted">
                                        <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition-colors duration-200">
                                            Accept
                                        </button>
                                    </form>
                                    <form action="{{ route('applications.update', $application) }}" method="POST" class="w-1/2">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="w-full bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition-colors duration-200">
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
