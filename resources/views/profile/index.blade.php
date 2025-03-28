<x-home.layout>
    <x-home.page-heading></x-home.page-heading>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$user['name']}} Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        dark: {
                            50: '#121212',
                            100: '#1E1E1E',
                            200: '#2C2C2C',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-dark-50 text-white">
<div class="container mx-auto px-4 py-6">


    <!-- Profile Header -->
    <div class="bg-dark-100 rounded-lg shadow-lg mb-6">
        <div
            class="h-52 bg-cover bg-center rounded-t-lg opacity-70"
            style="background-image: url('https://i.ibb.co/2YtbSgg5/Blue-and-White-Modern-Business-Linked-In-Banner.png')"
        ></div>

        <div class="px-4 pb-4 relative">
            <div class="flex items-end -mt-20">
                <img
                    src="{{asset('/storage/images/profile_pics/'. auth()->user()->profile_picture_url)}}"
                    alt="Profile Picture"
                    class="w-36 h-36 rounded-full object-cover border-4 border-dark-200 shadow-lg mr-4"
                >
                <div class="flex-grow">
                    <h2 class="text-2xl font-bold mb-1">
                        {{ $user->f_name }} {{ $user->l_name }}
                    </h2>
                </div>
                <div class="absolute top-0 right-0 mt-24">
                    <a
                        href="{{ route('profile.edit') }}"
                        class="btn btn-outline-primary px-4 py-2 border border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white rounded-lg transition duration-300"
                    >
                        <i class="bi bi-pencil mr-2"></i> Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-6">
        <!-- Contact Information -->
        <div class="bg-dark-100 rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h4 class="text-xl font-semibold">Contact Information</h4>
                <a href="{{ route('profile.edit') }}" class="text-blue-500 hover:text-blue-400">
                    <i class="bi bi-pencil"></i>
                </a>
            </div>
            <div>
                <p class="mb-2 flex items-center">
                    <i class="bi bi-envelope mr-2"></i>
                    {{ $user->email }}
                </p>
                @if($user->candidate && $user->candidate->phone_number)
                    <p class="mb-2 flex items-center">
                        <i class="bi bi-phone mr-2"></i>
                        {{ $user->candidate->phone_number }}
                    </p>
                @else
                    <p class="mb-2 flex items-center text-gray-500">
                        <i class="bi bi-phone mr-2"></i>
                        Phone not provided
                    </p>
                @endif
                @if($user->candidate && $user->candidate->linkedin_profile)
                    <p class="mb-2 flex items-center">
                        <i class="bi bi-linkedin mr-2"></i>
                        <a
                            href="{{ $user->candidate->linkedin_profile }}"
                            target="_blank"
                            class="text-blue-500 hover:underline"
                        >
                            LinkedIn Profile
                        </a>
                    </p>
                @else
                    <p class="mb-2 flex items-center text-gray-500">
                        <i class="bi bi-linkedin mr-2"></i>
                        LinkedIn not provided
                    </p>
                @endif
            </div>
        </div>

        <!-- Resume -->
        <div class="bg-dark-100 rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h4 class="text-xl font-semibold">Resume</h4>
            </div>
            @if($user->candidate && $user->candidate->resume_url)
                <a
                    href="{{ asset('/storage/resumes/'.$user->candidate->resume_url) }}"
                    target="_blank"
                    download
                    class="btn btn-outline-primary px-4 py-2 border border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white rounded-lg transition duration-300 inline-flex items-center"
                >
                    <i class="bi bi-file-earmark-pdf mr-2"></i> Download Resume
                </a>
            @else
                <p class="text-gray-500">No resume uploaded yet</p>
            @endif
        </div>
    </div>
</div>

<!-- Include icon library -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</body>
</html>
</x-home.layout>
