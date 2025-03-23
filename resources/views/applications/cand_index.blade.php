@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-b from-blue-50 to-white min-h-screen">
    <div class="container mx-auto px-4 py-8">

    <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">My Applications</h1>
                <p class="text-gray-600 mt-1">Track and manage your job applications</p>
            </div>

            <!-- Notification Bell -->
            <div class="relative">
                <button id="notificationButton" class="p-2 bg-white shadow rounded-full focus:outline-none hover:bg-gray-50 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>

                    @php
                        $unreadCount = Auth::user()->notifications->where('is_read', false)->count();
                    @endphp

                    @if($unreadCount > 0)
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center border-2 border-white">
                        {{ $unreadCount }}
                    </span>
                    @endif
                </button>

                <!-- Dropdown Notification -->
                <div id="notificationPanel" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl z-50 max-h-96 overflow-y-auto border border-gray-100">
                    <div class="px-4 py-3 border-b border-gray-100 bg-gray-50 rounded-t-lg">
                        <div class="flex justify-between items-center">
                            <h3 class="font-semibold text-gray-800">Notifications</h3>
                            @if($unreadCount > 0)
                            <form action="{{ route('notifications.markAllAsRead') }}" method="POST">
                                @csrf
                                <button type="submit" class="text-xs text-blue-600 hover:text-blue-800 font-medium">
                                    Mark all as read
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>

                    <div class="divide-y divide-gray-100">
                        @forelse (Auth::user()->notifications as $notification)
                            <div class="px-4 py-3 hover:bg-gray-50 {{ $notification->is_read ? 'bg-white' : 'bg-blue-50' }} transition-colors duration-200">
                                <p class="text-sm text-gray-800">{{ $notification->message }}</p>
                                <div class="flex justify-between items-center mt-2">
                                    <p class="text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                                    <div class="flex space-x-2">
                                        @if (!$notification->is_read)
                                            <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                <button type="submit" class="text-xs text-blue-600 hover:text-blue-800 font-medium">
                                                    Mark as read
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('notifications.markAsUnread', $notification->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                <button type="submit" class="text-xs text-green-600 hover:text-green-800 font-medium">
                                                    Mark as unread
                                                </button>
                                            </form>
                                        @endif
                                        <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs text-red-600 hover:text-red-800 font-medium">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="px-4 py-6 text-center text-sm text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                </svg>
                                <p>No notifications yet</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Filter Tabs -->
        <div class="mb-8">
            <div class="flex bg-white rounded-lg shadow-sm p-1 inline-flex">
                <a href="{{ route('applications.index') }}" class="px-4 py-2 rounded-md {{ !request('status') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }} transition-colors duration-200 text-sm font-medium">All</a>
                <a href="{{ route('applications.index', ['status' => 'pending']) }}" class="px-4 py-2 rounded-md {{ request('status') === 'pending' ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }} transition-colors duration-200 text-sm font-medium">Pending</a>
                <a href="{{ route('applications.index', ['status' => 'accepted']) }}" class="px-4 py-2 rounded-md {{ request('status') === 'accepted' ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }} transition-colors duration-200 text-sm font-medium">Accepted</a>
                <a href="{{ route('applications.index', ['status' => 'rejected']) }}" class="px-4 py-2 rounded-md {{ request('status') === 'rejected' ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }} transition-colors duration-200 text-sm font-medium">Rejected</a>
            </div>
        </div>

        <!-- Applications Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($applications as $application)
                <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300 relative">

                <div class="absolute top-4 right-4">
                        <span class="inline-block px-3 py-1 text-xs font-medium rounded-full
                            @if($application->status === 'pending') bg-yellow-100 text-yellow-800 border border-yellow-200
                            @elseif($application->status === 'accepted') bg-green-100 text-green-800 border border-green-200
                            @else bg-red-100 text-red-800 border border-red-200
                            @endif">
                            {{ ucfirst($application->status) }}
                        </span>
                    </div>

                    <div class="p-6">
                        <h2 class="text-xl font-bold mb-2 text-gray-800 pr-20">{{ $application->jobListing->title }}</h2>
                        <div class="flex items-center text-gray-600 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ $application->jobListing->location }}
                        </div>

                        <div class="flex items-center text-gray-600 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Applied: {{ $application->created_at->format('M d, Y') }}
                        </div>

                        <div class="flex space-x-2 mt-6">
                            <button onclick="openModal('modal-{{ $application->id }}')" class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors duration-300 text-sm font-medium flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                View Details
                            </button>

                            @if ($application->status === 'pending')
                                <form action="{{ route('applications.destroy', $application) }}" method="POST" class="inline-block flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition-colors duration-300 text-sm font-medium flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Cancel
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

                    <!-- Modal to open small tab -->
                    <div id="modal-{{ $application->id }}" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                        <div class="bg-white rounded-lg shadow-2xl w-11/12 md:w-1/2 lg:w-1/3 max-h-90vh overflow-y-auto">
                            <div class="relative">
                                <div class="p-6">
                                    <button onclick="closeModal('modal-{{ $application->id }}')" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>

                                    <h2 class="text-2xl font-bold mb-6 text-gray-800 pr-8">{{ $application->jobListing->title }}</h2>

                                    <div class="space-y-4">
                                        <div class="flex">
                                            <div class="w-1/3 font-medium text-gray-600">Company:</div>
                                            <div class="w-2/3 text-gray-800">{{ $application->jobListing->employer->company_name }}</div>
                                        </div>

                                        <div class="flex">
                                            <div class="w-1/3 font-medium text-gray-600">Salary Range:</div>
                                            <div class="w-2/3 text-gray-800">${{ number_format($application->jobListing->lower_salary) }} - ${{ number_format($application->jobListing->upper_salary) }}</div>
                                        </div>

                                        <div class="flex">
                                            <div class="w-1/3 font-medium text-gray-600">Job Type:</div>
                                            <div class="w-2/3 text-gray-800">{{ $application->jobListing->job_type }}</div>
                                        </div>

                                        <div class="flex">
                                            <div class="w-1/3 font-medium text-gray-600">Workplace:</div>
                                            <div class="w-2/3 text-gray-800">{{ $application->jobListing->workplace }}</div>
                                        </div>

                                        <div>
                                            <div class="font-medium text-gray-600 mb-2">Description:</div>
                                            <div class="text-gray-800 bg-gray-50 p-4 rounded-md">{{ $application->jobListing->description }}</div>
                                        </div>
                                    </div>

                                    <div class="mt-8 pt-6 border-t border-gray-200">
                                        <h3 class="text-lg font-medium text-gray-800 mb-4">Your Application</h3>

                                        <div class="space-y-4">
                                            <div class="flex">
                                                <div class="w-1/3 font-medium text-gray-600">Status:</div>
                                                <div class="w-2/3">
                                                    <span class="inline-block px-3 py-1 text-xs font-medium rounded-full
                                                        @if($application->status === 'pending') bg-yellow-100 text-yellow-800 border border-yellow-200
                                                        @elseif($application->status === 'accepted') bg-green-100 text-green-800 border border-green-200
                                                        @else bg-red-100 text-red-800 border border-red-200
                                                        @endif">
                                                        {{ ucfirst($application->status) }}
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="flex">
                                                <div class="w-1/3 font-medium text-gray-600">Applied On:</div>
                                                <div class="w-2/3 text-gray-800">{{ $application->created_at->format('F d, Y') }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-8 flex justify-end">
                                        <button onclick="closeModal('modal-{{ $application->id }}')" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition-colors duration-300 text-sm font-medium">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-white p-8 rounded-lg shadow-sm text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="text-lg font-medium text-gray-800 mb-2">No applications found</h3>
                    <p class="text-gray-600 mb-6">Start applying to jobs to see your applications here.</p>
                    <a href="{{ route('jobs.index') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition-colors duration-300 text-sm font-medium">
                        Browse Jobs
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- JS for the Modal and Notification Panel -->
<script>
    // Modal Functions
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    window.onclick = function(event) {
        if (event.target.classList.contains('bg-black')) {
            event.target.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    };

    // Notification Panel Toggle
    document.addEventListener('DOMContentLoaded', function() {
        const notificationButton = document.getElementById('notificationButton');
        const notificationPanel = document.getElementById('notificationPanel');

        notificationButton.addEventListener('click', function(event) {
            event.stopPropagation();
            notificationPanel.classList.toggle('hidden');
        });


        document.addEventListener('click', function(event) {
            if (!notificationButton.contains(event.target) && !notificationPanel.contains(event.target)) {
                notificationPanel.classList.add('hidden');
            }
        });
    });
</script>
@endsection
