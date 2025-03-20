@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-semibold mb-6 text-gray-800">My Applications</h1>
<!-- Notifications Section -->
<div class="mb-8">
    <h2 class="text-xl font-semibold mb-4 text-gray-800">Notifications</h2>
    @foreach (Auth::user()->notifications as $notification)
        <div class="bg-white shadow-sm rounded-lg p-4 mb-4 border border-gray-100">
            <p class="text-gray-700">{{ $notification->message }}</p>
            <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>

            <!-- Mark as Read Form -->
            @if (!$notification->is_read)
                <form action="{{ route('notifications.markAsRead', $notification) }}" method="POST" class="inline-block">
                    @csrf
                    <button type="submit" class="text-blue-500 hover:text-blue-700">Mark as Read</button>
                </form>
            @else
                <span class="text-green-500">Read</span>
            @endif
        </div>
    @endforeach
</div>
    <!-- Applications Section -->
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

                <!-- Modal to open small tab -->
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

<!-- JS for the Modal -->
<script>
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
</script>
@endsection
