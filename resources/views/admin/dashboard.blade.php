@extends("admin.layouts.app")

@section("title", "Job Board")

@section("main")

<div class="container mt-4">
    <div class="row">
        <!-- Stats Cards -->
        <div class="col-md-4">
                <a href="{{ route('admin.applications') }}" class="card text-white bg-warning mb-3 text-decoration-none">
                    <div class="card-header">Total Applications</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $applications_count }}</h5>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ route('admin.employers') }}" class="card text-white bg-success mb-3 text-decoration-none">
                    <div class="card-header">Total Employers</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $employers_count }}</h5>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ route('admin.candidates') }}" class="card text-white bg-primary mb-3 text-decoration-none">
                    <div class="card-header">Total Candidates</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $candidates_count }}</h5>
                    </div>
                </a>
</div>

    </div>

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
