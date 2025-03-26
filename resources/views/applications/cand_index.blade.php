@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black text-white">
    <div class="px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-7xl mx-auto">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
                <div class="mb-4 md:mb-0">
                <h1 class="text-3xl font-bold text-white">My Applications</h1>       
                             <p class="text-gray-400 mt-2">Track and manage your job applications</p>
                </div>


                <div class="relative">
                    <button id="notificationButton" class="relative p-2 rounded-full hover:bg-gray-800 transition-colors group">
                        <div class="relative">
                            <svg class="h-6 w-6 text-gray-300 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            @if($unreadCount = Auth::user()->notifications->where('is_read', false)->count() > 0)
                            <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center transform translate-x-1 -translate-y-1 shadow-sm">
                                {{ $unreadCount }}
                            </span>
                            @endif
                        </div>
                    </button>


                    <div id="notificationPanel" class="hidden absolute right-0 mt-2 w-80 bg-gray-900 rounded-lg shadow-xl z-50 border border-gray-700 divide-y divide-gray-700 max-h-[80vh] overflow-y-auto">
                        <div class="px-4 py-3 flex justify-between items-center bg-gray-900 sticky top-0 z-10">
                            <h3 class="font-medium">Notifications</h3>
                            @if($unreadCount > 0)
                            <form action="{{ route('notifications.markAllAsRead') }}" method="POST">
                                @csrf
                                <button type="submit" class="text-xs text-blue-400 hover:text-blue-300 transition-colors">
                                    Mark all as read
                                </button>
                            </form>
                            @endif
                        </div>

                        @forelse (Auth::user()->notifications as $notification)
                        <div class="p-4 hover:bg-gray-800 transition-colors {{ $notification->is_read ? 'bg-gray-900' : 'bg-gray-800' }}">
                            <div class="flex justify-between">
                                <p class="text-sm">{{ $notification->message }}</p>
                                <div class="flex space-x-2 ml-3">
                                    @if (!$notification->is_read)
                                    <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-blue-400 hover:text-blue-300 text-xs" title="Mark as read">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </button>
                                    </form>
                                    @endif
                                    <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-300 text-xs" title="Delete">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="flex justify-between items-center mt-2">
                                <span class="text-xs text-gray-400">{{ $notification->created_at->diffForHumans() }}</span>
                                @if ($notification->is_read)
                                <form action="{{ route('notifications.markAsUnread', $notification->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-green-400 hover:text-green-300 text-xs">
                                        Mark as unread
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                        @empty
                        <div class="p-6 text-center text-gray-400 text-sm">
                            No notifications yet
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>


            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($applications as $application)
                <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-xl overflow-hidden border border-gray-700 hover:border-blue-500/50 transition-all duration-300 hover:shadow-lg group">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-lg font-bold text-white group-hover:text-blue-400 transition-colors">{{ $application->jobListing->title }}</h3>
                                <p class="text-sm text-gray-300 mb-3">{{ $application->jobListing->employer->company_name }}</p>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if($application->status === 'pending') bg-yellow-900 text-yellow-200
                                @elseif($application->status === 'accepted') bg-green-900 text-green-200
                                @else bg-red-900 text-red-200 @endif">
                                {{ ucfirst($application->status) }}
                            </span>
                        </div>

                        <div class="mt-4 space-y-3">
                            <div class="flex items-center text-sm text-gray-300">
                                <svg class="flex-shrink-0 mr-2 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $application->jobListing->location }}
                            </div>
                            <div class="flex items-center text-sm text-gray-300">
                                <svg class="flex-shrink-0 mr-2 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Applied {{ $application->created_at->format('M d, Y') }}
                            </div>
                            <div class="flex items-center text-sm text-gray-300">
                                <svg class="flex-shrink-0 mr-2 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                ${{ number_format($application->jobListing->lower_salary) }} - ${{ number_format($application->jobListing->upper_salary) }}
                            </div>
                        </div>

                        <div class="mt-6 flex space-x-3">
                            <button onclick="openModal('modal-{{ $application->id }}')" 
                                    class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition-colors duration-200 text-sm font-medium flex items-center justify-center">
                                <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Details
                            </button>

                            @if ($application->status === 'pending')
                            <form action="{{ route('applications.destroy', $application) }}" method="POST" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="w-full bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-md transition-colors duration-200 text-sm font-medium flex items-center justify-center">
                                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Cancel
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Application Modal -->
                <div id="modal-{{ $application->id }}" 
                     class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-80 hidden p-4">
                    <div class="bg-gray-900 rounded-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto border border-gray-700">
                        <div class="p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h2 class="text-2xl font-bold text-white">{{ $application->jobListing->title }}</h2>
                                    <p class="text-blue-400 mt-1">{{ $application->jobListing->employer->company_name }}</p>
                                </div>
                                <button onclick="closeModal('modal-{{ $application->id }}')" 
                                        class="text-gray-400 hover:text-white p-1 rounded-full hover:bg-gray-800">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>

                            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-4">
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-400">STATUS</h3>
                                        <p class="mt-1 text-sm text-white">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                @if($application->status === 'pending') bg-yellow-900 text-yellow-200
                                                @elseif($application->status === 'accepted') bg-green-900 text-green-200
                                                @else bg-red-900 text-red-200 @endif">
                                                {{ ucfirst($application->status) }}
                                            </span>
                                        </p>
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-400">LOCATION</h3>
                                        <p class="mt-1 text-sm text-white">{{ $application->jobListing->location }}</p>
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-400">WORKPLACE</h3>
                                        <p class="mt-1 text-sm text-white">{{ $application->jobListing->workplace }}</p>
                                    </div>
                                </div>
                                <div class="space-y-4">
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-400">SALARY RANGE</h3>
                                        <p class="mt-1 text-sm text-white">${{ number_format($application->jobListing->lower_salary) }} - ${{ number_format($application->jobListing->upper_salary) }}</p>
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-400">JOB TYPE</h3>
                                        <p class="mt-1 text-sm text-white">{{ $application->jobListing->job_type }}</p>
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-400">APPLIED ON</h3>
                                        <p class="mt-1 text-sm text-white">{{ $application->created_at->format('M d, Y') }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8">
                                <h3 class="text-lg font-medium text-white mb-3">Job Description</h3>
                                <div class="prose prose-invert max-w-none text-gray-300">
                                    {{ $application->jobListing->description }}
                                </div>
                            </div>

                            <div class="mt-8 flex justify-end space-x-3">
                                @if ($application->status === 'pending')
                                <form action="{{ route('applications.destroy', $application) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md transition-colors duration-200 text-sm font-medium">
                                        Cancel Application
                                    </button>
                                </form>
                                @endif
                                <button onclick="closeModal('modal-{{ $application->id }}')" 
                                        class="bg-gray-800 hover:bg-gray-700 text-white px-4 py-2 rounded-md transition-colors duration-200 text-sm font-medium">
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

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

    // Close modal when clicking outside
    window.onclick = function(event) {
        if (event.target.classList.contains('bg-black')) {
            closeModal(event.target.id);
        }
    };

    // Notification Panel Toggle
    document.addEventListener('DOMContentLoaded', function() {
        const notificationButton = document.getElementById('notificationButton');
        const notificationPanel = document.getElementById('notificationPanel');

        notificationButton.addEventListener('click', function(e) {
            e.stopPropagation();
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