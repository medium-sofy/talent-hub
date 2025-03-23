<x-layout>
    <x-page-heading>Showing {{ count($jobs) }} results for: <span class="text-yellow-300">{{ request('q') }}</span></x-page-heading>
    <div class="space-y-6">
        @foreach ($jobs as $job)
            <x-job-card-wide :$job />
        @endforeach
    </div>
</x-layout>
