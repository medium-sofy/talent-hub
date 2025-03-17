@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center py-8">

    <div class="w-full max-w-3xl mx-4">
        <div class="bg-white shadow-xl rounded-lg p-8 border border-gray-100">
            <h1 class="text-3xl font-bold mb-6 text-gray-800">Apply for {{ $job->title }}</h1>


            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-md">
                    <strong class="font-medium">There were some issues with your submission:</strong>
                    <!-- <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul> -->
                </div>
            @endif


            @if ($errors->has('application'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-md">
                    <strong class="font-medium">Error:</strong> {{ $errors->first('application') }}
                </div>
            @endif


            <form action="{{ route('applications.store', $job->id) }}" method="POST" enctype="multipart/form-data">
                @csrf


                <div class="mb-6">
                    <label for="contact_email" class="block text-sm font-medium text-gray-700 mb-2">Contact Email</label>
                    <input type="email" name="contact_email" id="contact_email"
                           class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('contact_email') border-red-500 @enderror"
                           value="{{ old('contact_email') }}" placeholder="Enter your email">
                    @error('contact_email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>


                <div class="mb-6">
                    <label for="contact_phone" class="block text-sm font-medium text-gray-700 mb-2">Contact Phone</label>
                    <input type="text" name="contact_phone" id="contact_phone"
                           class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('contact_phone') border-red-500 @enderror"
                           value="{{ old('contact_phone') }}" placeholder="Enter your phone number">
                    @error('contact_phone')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>


                <div class="mb-6">
                    <label for="resume" class="block text-sm font-medium text-gray-700 mb-2">Resume (PDF or DOCX only)</label>
                    <div class="flex items-center justify-center w-full">
                        <label for="resume" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition duration-200">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                <p class="mb-2 text-sm text-gray-500">
                                    <span class="font-semibold">Click to upload</span> or drag and drop
                                </p>
                                <p class="text-xs text-gray-500">PDF or DOCX (Max: 2MB)</p>
                            </div>
                            <input type="file" name="resume" id="resume" class="hidden" accept=".pdf,.docx">
                        </label>
                    </div>
                    @error('resume')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>


                <button type="submit" class="w-full bg-blue-600 text-white p-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
                    Submit Application
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
