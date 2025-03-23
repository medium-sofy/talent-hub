@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">My Applications</h1>

        <div class="relative">
            <button id="notificationButton" class="p-2 hover:bg-gray-100 rounded-full focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>

                @php
                    $unreadCount = Auth::user()->notifications->where('is_read', false)->count();
                @endphp

                @if($unreadCount > 0)
                <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                    {{ $unreadCount }}
                </span>
                @endif
            </button>


            <div id="notificationPanel" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg z-50 max-h-96 overflow-y-auto">
                <div class="px-4 py-3 border-b border-gray-100">
                    <div class="flex justify-between items-center">
                        <h3 class="text-sm font-semibold text-gray-800">Notifications</h3>
                        @if($unreadCount > 0)
                        <form action="{{ route('notifications.markAllAsRead') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-xs text-blue-500 hover:text-blue-700">
                                Mark all as read
                            </button>
                        </form>
                        @endif
                    </div>
                </div>

                <div class="divide-y divide-gray-100">
                    @forelse (Auth::user()->notifications as $notification)
                        <div class="px-4 py-3 hover:bg-gray-50 {{ $notification->is_read ? 'bg-white' : 'bg-blue-50' }}">
                            <p class="text-sm text-gray-800">{{ $notification->message }}</p>
                            <div class="flex justify-between items-center mt-2">
                                <p class="text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                                <div class="flex space-x-2">
                                    @if (!$notification->is_read)
                                        <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit" class="text-xs text-blue-500 hover:text-blue-700">
                                                Mark as read
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('notifications.markAsUnread', $notification->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit" class="text-xs text-green-500 hover:text-green-700">
                                                Mark as unread
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs text-red-500 hover:text-red-700">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="px-4 py-6 text-center text-sm text-gray-500">
                            No notifications yet
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>


    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($applications as $application)
            <div class="bg-white shadow-sm rounded-lg p-6 border border-gray-100 hover:shadow-md transition-shadow duration-300">
                <h2 class="text-xl font-semibold mb-2 text-blue-600">{{ $application->jobListing->title }}</h2>
                <p class="text-gray-700 mb-2">
                    <strong>Status:</strong>
                    <span class="inline-block px-2 py-1 text-sm rounded
                        @if($application->status === 'pending') bg-yellow-100 text-yellow-800
                        @elseif($application->status === 'accepted') bg-green-100 text-green-800
                        @else bg-red-100 text-red-800
                        @endif">
                        {{ $application->status }}
                    </span>
                </p>
                <p class="text-gray-700 mb-2">
                    <strong>Job Location:</strong> {{ $application->jobListing->location }}
                </p>
                <p class="text-gray-700 mb-2">
                    <strong>Applied On:</strong> {{ $application->created_at->format('M d, Y') }}
                </p>

                <button onclick="openModal('modal-{{ $application->id }}')" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors duration-300">
                    Show Details
                </button>

                @if ($application->status === 'pending')
                    <form action="{{ route('applications.destroy', $application) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition-colors duration-300">Cancel Application</button>
                    </form>
                @endif


                <div id="modal-{{ $application->id }}" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                    <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-1/2 lg:w-1/3 p-6">
                        <h2 class="text-xl font-semibold mb-4 text-gray-800">{{ $application->jobListing->title }}</h2>
                        <p class="text-gray-700 mb-2">
                            <strong>Company:</strong> {{ $application->jobListing->employer->company_name }}
                        </p>
                        <p class="text-gray-700 mb-2">
                            <strong>Salary Range:</strong>
                            {{ $application->jobListing->lower_salary }} - {{ $application->jobListing->upper_salary }}
                        </p>
                        <p class="text-gray-700 mb-2">
                            <strong>Job Type:</strong> {{ $application->jobListing->job_type }}
                        </p>
                        <p class="text-gray-700 mb-2">
                            <strong>Workplace:</strong> {{ $application->jobListing->workplace }}
                        </p>
                        <p class="text-gray-700 mb-4">
                            <strong>Description:</strong> {{ $application->jobListing->description }}
                        </p>

                        <button onclick="closeModal('modal-{{ $application->id }}')" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors duration-300">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- JS for the Modal and Notification Panel -->
<script>
    // Modal Functions
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

    window.onclick = function(event) {
        if (event.target.classList.contains('bg-black')) {
            event.target.classList.add('hidden');
        }
    };

    // Notification Panel Toggle
    document.addEventListener('DOMContentLoaded', function() {
        const notificationButton = document.getElementById('notificationButton');
        const notificationPanel = document.getElementById('notificationPanel');

        notificationButton.addEventListener('click', function() {
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
