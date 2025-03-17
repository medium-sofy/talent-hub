<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile View</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .profile-header { background-color: #fff; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .section-card { background-color: #fff; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); margin-bottom: 20px; }
        .profile-pic { width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 5px solid #fff; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .bg-cover { height: 200px; background-size: cover; background-position: center; border-radius: 8px 8px 0 0; }
    </style>
</head>
<body class="bg-light">
<div class="container mt-4 mb-5">
    <!-- Profile Header -->
    <div class="profile-header mb-4">
        <div class="bg-cover" style="background-image: url('https://static.vecteezy.com/system/resources/thumbnails/036/324/708/small/ai-generated-picture-of-a-tiger-walking-in-the-forest-photo.jpg');"></div>
        <div class="px-4 pb-4">
            <div class="d-flex align-items-end position-relative" style="margin-top: -75px;">
                <img src="{{ $user->profile_picture_url ? asset($user->profile_picture_url) : 'https://static.vecteezy.com/system/resources/thumbnails/036/324/708/small/ai-generated-picture-of-a-tiger-walking-in-the-forest-photo.jpg' }}" alt="Profile Picture" class="profile-pic me-4">
                <div class="mt-5">
                    <h2 class="mb-1">{{ $user->f_name }} {{ $user->l_name }}</h2>
                </div>
                <div class="ms-auto position-absolute end-0 top-0 mt-5">
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary"><i class="bi bi-pencil"></i> Edit Profile</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <!-- About Section -->
            <div class="section-card p-4 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4>About</h4>
                    <a href="#" class="text-primary"><i class="bi bi-pencil"></i></a>
                </div>
                <p class="text-muted">{{$users['About']}}</p>
            </div>


        </div>

        <div class="col-md-4">
            <!-- Contact Info -->
            <div class="section-card p-4 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4>Contact Information</h4>
                    <a href="#" class="text-primary"><i class="bi bi-pencil"></i></a>
                </div>
                <div class="mb-3">
                    <p class="mb-1"><i class="bi bi-envelope me-2"></i> amroa333@gmail.com</p>
                    <p class="mb-1 text-muted"><i class="bi bi-phone me-2"></i> Phone not provided</p>
                    <p class="mb-1 text-muted"><i class="bi bi-linkedin me-2"></i> LinkedIn not provided</p>
                </div>
            </div>

            <!-- Resume -->
            <div class="section-card p-4 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4>Resume</h4>
                    <a href="#" class="text-primary"><i class="bi bi-upload"></i></a>
                </div>
                <p class="text-muted">No resume uploaded yet</p>
            </div>


        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
