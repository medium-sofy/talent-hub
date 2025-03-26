<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
{{--            {{dd(asset('/storage/images/company_logos/'.auth()->user()->employer->company_logo_url))}}--}}
            @if(auth()->user()->role=='employer')
                <img src="{{asset('/storage/images/company_logos/'. auth()->user()->employer->company_logo_url)}}" width="200px" alt="">

            @endif
            @if(auth()->user()->role=='candidate')
                {{auth()->user()->resume_url}}
                <a href="{{asset('storage/documents/resumes/'. auth()->user()->candidate->resume_url)}}" class="text-red-400 font-bold">Download Resume</a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>