<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$user['name']}} Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #121212; color: #ffffff; }
        .profile-header { background-color: #1E1E1E; border-radius: 8px; box-shadow: 0 0 10px rgba(255,255,255,0.1); }
        .section-card { background-color: #1E1E1E; border-radius: 8px; box-shadow: 0 0 10px rgba(255,255,255,0.1); margin-bottom: 20px; color: #ffffff; }
        .profile-pic { width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 5px solid #2C2C2C; box-shadow: 0 0 10px rgba(255,255,255,0.1); }
        .bg-cover { height: 200px; background-size: cover; background-position: center; border-radius: 8px 8px 0 0; filter: brightness(0.7); }
        .text-muted { color: #888 !important; }
        .btn-outline-primary {
            color: #3498db;
            border-color: #3498db;
        }
        .btn-outline-primary:hover {
            background-color: #3498db;
            color: #ffffff;
        }
        a { color: #3498db; text-decoration: none; }
        a:hover { color: #2980b9; }
    </style>
</head>
<body>
<div class="container mt-4 mb-5">
    <!-- Profile Header -->
    <div class="profile-header mb-4">
        <div class="bg-cover" style="background-image: url('https://i.ibb.co/2YtbSgg5/Blue-and-White-Modern-Business-Linked-In-Banner.png');"></div>
        <div class="px-4 pb-4">
            <div class="d-flex align-items-end position-relative" style="margin-top: -75px;">
                <img src="{{asset('/storage/images/profile_pics/'. auth()->user()->profile_picture_url)}}" alt="Profile Picture" class="profile-pic me-4">
                <div class="mt-5">
                    <h2 class="mb-1">{{ $user->f_name }} {{ $user->l_name }}</h2>
                </div>
                <div class="ms-auto position-absolute end-0 top-20 mt-5">
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary"><i class="bi bi-pencil"></i> Edit Profile</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <!-- Contact Information -->
            <div class="section-card p-4 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4>Contact Information</h4>
                    <a href="#" class="text-primary"><i class="bi bi-pencil"></i></a>
                </div>
                <div class="mb-3">
                    <p class="mb-1"><i class="bi bi-envelope me-2"></i> {{ $user->email }}</p>
                    @if($user->candidate && $user->candidate->phone_number)
                        <p class="mb-1"><i class="bi bi-phone me-2"></i> {{ $user->candidate->phone_number }}</p>
                    @else
                        <p class="mb-1 text-muted"><i class="bi bi-phone me-2"></i> Phone not provided</p>
                    @endif
                    @if($user->candidate && $user->candidate->linkedin_profile)
                        <p class="mb-1"><i class="bi bi-linkedin me-2"></i> <a href="{{ $user->candidate->linkedin_profile }}" target="_blank">LinkedIn Profile</a></p>
                    @else
                        <p class="mb-1 text-muted"><i class="bi bi-linkedin me-2"></i> LinkedIn not provided</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <!-- Resume -->
            <div class="section-card p-4 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4>Resume</h4>
                    <a href="#" class="text-primary"><i class="bi bi-upload"></i></a>
                </div>
                @if($user->candidate && $user->candidate->resume_url)
                    <p><a href="{{ asset('/storage/resumes/'.$user->candidate->resume_url) }}" target="_blank" download class="btn btn-sm btn-outline-primary"><i class="bi bi-file-earmark-pdf"></i> Download Resume</a></p>
                @else
                    <p class="text-muted">No resume uploaded yet</p>
                @endif
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
