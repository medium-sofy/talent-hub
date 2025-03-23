@extends("admin.layouts.app")

@section("title", "Job Board")

@section("main")
<div class="container mt-4">
    <div class="row">
        <!-- Stats Cards -->
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total Candidates</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $candidates }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Total Employers</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $employers }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Total Applications</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $applications }}</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest Applications -->
    <div class="card mt-4">
        <div class="card-header bg-dark text-white">
            Latest Applications
        </div>
        <div class="card-body">
            @if($latestApplications->isEmpty())
                <p class="text-muted">No recent applications.</p>
            @else
            <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>applicant id</strong>
                        <strong>Job</strong>
                            <strong class="">Status</strong>
                        </li>
                </ul>
                <ul class="list-group">
                    @foreach($latestApplications as $app)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>{{ $app->candidate->user_id}}</strong>
                        applied for <em>{{ $app->jobListing->title }}</em>
                            <span class="badge badge-info">New</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection
