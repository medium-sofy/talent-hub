@extends("admin.layouts.app")

@section("title", "Job Board")

@section("main")
    <!-- Candidates Table -->
    <div class="card mt-4">
        <div class="card-header bg-primary text-white">
            <strong>All Candidates</strong>
        </div>
        <div class="card-body">
            @if($candidates->isEmpty())
                <p class="text-muted">No candidates available.</p>
            @else
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Resume</th>
                            <th>LinkedIn</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($candidates as $candidate)
                        <tr>
                            <td>{{ $candidate->id }}</td>
                            <td>{{ $candidate->user->name }}</td>
                            <td>{{ $candidate->user->email }}</td>
                            <td>{{ $candidate->phone_number ?? 'N/A' }}</td>
                            <td>
                                @if($candidate->resume_url)
                                    <a href="{{ $candidate->resume_url }}" class="btn btn-sm btn-success" target="_blank">View Resume</a>
                                @else
                                    <span class="text-muted">No Resume</span>
                                @endif
                            </td>
                            <td>
                                @if($candidate->linkedin_profile)
                                    <a href="{{ $candidate->linkedin_profile }}" class="btn btn-sm btn-info" target="_blank">LinkedIn</a>
                                @else
                                    <span class="text-muted">No Profile</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection