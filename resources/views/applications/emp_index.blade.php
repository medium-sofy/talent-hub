@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8 text-gray-800">Job Applications</h1>

        <!-- Tabs -->
        <div class="flex space-x-4 mb-8 border-b border-gray-200">
            <a href="{{ route('applications.emp_index') }}" class="px-4 py-2 rounded-t-md {{ request('status') ? 'text-gray-500 hover:text-blue-600' : 'text-blue-600 border-b-2 border-blue-600' }}">All</a>
            <a href="{{ route('applications.emp_index', ['status' => 'pending']) }}" class="px-4 py-2 rounded-t-md {{ request('status') === 'pending' ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-blue-600' }}">Pending</a>
            <a href="{{ route('applications.emp_index', ['status' => 'accepted']) }}" class="px-4 py-2 rounded-t-md {{ request('status') === 'accepted' ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-blue-600' }}">Accepted</a>
            <a href="{{ route('applications.emp_index', ['status' => 'rejected']) }}" class="px-4 py-2 rounded-t-md {{ request('status') === 'rejected' ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-blue-600' }}">Rejected</a>
        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @if ($applications->isEmpty())
        <div class="col-span-full text-center text-gray-500">
            @if (request('status') === 'pending')
                No pending applications.
            @elseif (request('status') === 'accepted')
                No accepted applications.
            @elseif (request('status') === 'rejected')
                No rejected applications.
            @else
                No applications found.
            @endif
        </div>
    @else
        @foreach ($applications as $application)
            <div class="bg-gradient-to-r from-blue-50 to-purple-50 shadow-lg rounded-xl p-6 border border-gray-100 hover:shadow-2xl hover:scale-105 transition-all duration-300">
                <h2 class="text-xl font-semibold mb-2 text-gray-800">{{ $application->jobListing->title }}</h2>
                <p class="mb-2 text-gray-600">
                    <strong>Candidate:</strong> {{ $application->candidate->user->f_name }} {{ $application->candidate->user->l_name }}
                </p>
                <p class="mb-2 text-gray-600">
                    <strong>Status:</strong>
                    <span class="inline-block px-2 py-1 text-sm rounded
                        @if($application->status === 'pending') bg-yellow-100 text-yellow-800
                        @elseif($application->status === 'accepted') bg-green-100 text-green-800
                        @else bg-red-100 text-red-800
                        @endif">
                        {{ $application->status }}
                    </span>
                </p>
                <p class="mb-2 text-gray-600">
                    <strong>Contact Email:</strong> <a href="mailto:{{ $application->contact_email }}" class="text-blue-600 hover:text-blue-500 hover:underline">{{ $application->contact_email }}</a>
                </p>
                <p class="mb-2 text-gray-600">
                    <strong>Contact Phone:</strong> <a href="tel:{{ $application->contact_phone }}" class="text-blue-600 hover:text-blue-500 hover:underline">{{ $application->contact_phone }}</a>
                </p>
                <p class="mb-4 text-gray-600">
                    <strong>Resume:</strong>
                    <a href="{{ asset('storage/' . $application->resume_url) }}" target="_blank" class="text-blue-600 hover:text-blue-500 hover:underline">Download Resume</a>
                </p>


                <div class="flex space-x-2">
                    @if (Auth::user()->role === 'employer' && $application->status === 'pending')
                        <form action="{{ route('applications.update', $application) }}" method="POST" class="inline-block">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="accepted">
                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition-colors duration-300">Accept</button>
                        </form>
                        <form action="{{ route('applications.update', $application) }}" method="POST" class="inline-block">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition-colors duration-300">Reject</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    @endif
</div>
    </div>
</div>
@endsection
