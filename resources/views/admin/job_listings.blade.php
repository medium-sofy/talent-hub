@extends("admin.layouts.app")
@section("title", "Job Board | Job Listings")

@section('main')
<div class="container mt-4">
    <div class="card">
       
        <div class="card-body">
            @if($jobs->isEmpty())
                <p class="text-muted">No pending job listings.</p>
            @else
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Title</th>
                            <th>Category Name</th>

                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jobs as $job)
                            <tr>
                                <td>{{ $job->title }}</td>
                                <td>{{ $job->category->name }}</td>

                                <td>
                                @if($job->is_approved == true)
                                        <span class="badge badge-success">Approved</span>
                                    @else
                                    <form action="{{ route('admin.job.approve', $job->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                    </form>
                                    <form action="{{ route('admin.job.reject', $job->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
