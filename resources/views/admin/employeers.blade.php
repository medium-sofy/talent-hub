
@extends("admin.layouts.app")

@section("title", "Job Board")

@section("main")
    <!-- Employers Table -->
    <div class="card mt-4">
        <div class="card-header bg-success text-white">
            <strong>All Employers</strong>
        </div>
        <div class="card-body">
            @if($employers->isEmpty())
                <p class="text-muted">No employers available.</p>
            @else
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Company Name</th>
                            <th>Employer Name</th>
                            <th>Email</th>
                            <th>Job Listings</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employers as $employer)
                        <tr>
                            <td>{{ $employer->id }}</td>
                            <td>{{ $employer->user->name }}</td>
                            <td>{{ $employer->user->email }}</td>
                            <td>{{ $employer->user->email }}</td>
                            <td>{{ $employer->jobListings->count() }} jobs</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
</div>
@endsection