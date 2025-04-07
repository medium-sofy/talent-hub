@extends("admin.layouts.app")
@section("title", "Job Board | Job Listings")

@section('main')
<div class="container mt-4">
       <!-- Latest Applications -->
       <div class="card mt-4">
        <div class="card-header bg-dark text-white">
            <strong>Latest Applications</strong>
        </div>
        <div class="card-body">
            @if($latestApplications->isEmpty())
                <p class="text-muted">No recent applications.</p>
            @else
                <table class="table table-striped table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Applicant</th>
                        <th>Candidate</th>
                        <th>Job Title</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($latestApplications as $app)
                    <tr>
                        <td>{{ $app->id }}</td>
                        <td>{{ $app->candidate->user->name }}</td>
                        <td>{{ $app->jobListing->title }}</td>
                        <td><span class="badge badge-info">New</span></td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
