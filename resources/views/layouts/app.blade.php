<x-home.layout>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
    <style>
        body {
            background-color: #121212 !important;
            color: #ffffff;
        }
        .bg-white {
            background-color: #1E1E1E !important;
            color: #ffffff;
        }
        .text-gray-600 {
            color: #888 !important;
        }
        .bg-gray-100 {
            background-color: #121212 !important;
        }
        .border {
            border-color: #333 !important;
        }
        .text-gray-900 {
            color: #ffffff !important;
        }
        .hover\:bg-gray-100:hover {
            background-color: #1E1E1E !important;
        }
        .text-gray-500 {
            color: #888 !important;
        }
        a {
            color: #3498db !important;
        }
        a:hover {
            color: #2980b9 !important;
        }
    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
</x-home.layout>
