<x-home.layout>
    <x-home.page-heading>Showing {{ count($jobs) }} results for: <span class="text-yellow-300">{{ request('q') }}</span></x-home.page-heading>
    <div class="space-y-6">
        @foreach ($jobs as $job)
            <x-home.job-card-wide :$job />
        @endforeach
    </div>
</x-home.layout>
