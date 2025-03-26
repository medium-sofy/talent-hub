@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black text-white flex items-center justify-center py-12">
    <div class="w-full max-w-3xl mx-4">
        <div class="bg-gray-900 shadow-xl rounded-lg overflow-hidden border border-gray-800">

        <div class="bg-gradient-to-r from-blue-600 to-blue-800 p-6 text-white">
                <h1 class="text-2xl font-bold">Apply for {{ $job->title }}</h1>
                <p class="mt-2 opacity-90">Complete the form below to submit your application</p>
            </div>

            @if ($errors->any())
                <div class="mx-6 mt-6 p-4 bg-red-900/50 border border-red-700 text-red-100 rounded-md">
                    <div class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <div>
                            <strong class="font-medium">There were some issues with your submission:</strong>
                        </div>
                    </div>
                </div>
            @endif

            @if ($errors->has('application'))
                <div class="mx-6 mt-6 p-4 bg-red-900/50 border border-red-700 text-red-100 rounded-md">
                    <div class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <div>
                            <strong class="font-medium">Error:</strong> {{ $errors->first('application') }}
                        </div>
                    </div>
                </div>
            @endif


            <div class="mx-6 mt-6 p-4 bg-blue-900/20 border border-blue-800 text-blue-100 rounded-md">
                <div class="flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <strong class="font-medium">Job Summary:</strong>
                        <div class="mt-2 grid grid-cols-2 gap-2 text-sm">
                            <div><span class="font-medium">Company:</span> {{ $job->employer->company_name }}</div>
                            <div><span class="font-medium">Location:</span> {{ $job->location }}</div>
                            <div><span class="font-medium">Job Type:</span> {{ $job->job_type }}</div>
                            <div><span class="font-medium">Salary:</span> ${{ number_format($job->lower_salary) }} - ${{ number_format($job->upper_salary) }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('applications.store', $job->id) }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf

                <div class="space-y-6">
                    <div>
                        <label for="contact_email" class="block text-sm font-medium text-gray-300 mb-1">Contact Email <span class="text-red-400">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>
                            <input type="email" name="contact_email" id="contact_email"
                                class="w-full pl-10 p-3 bg-gray-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-white @error('contact_email') border-red-500 @enderror"
                                value="{{ old('contact_email') }}" placeholder="you@example.com">
                        </div>
                        @error('contact_email')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="contact_phone" class="block text-sm font-medium text-gray-300 mb-1">Contact Phone <span class="text-red-400">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <input type="text" name="contact_phone" id="contact_phone"
                                class="w-full pl-10 p-3 bg-gray-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-white @error('contact_phone') border-red-500 @enderror"
                                value="{{ old('contact_phone') }}" placeholder="(123) 456-7890">
                        </div>
                        @error('contact_phone')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="resume" class="block text-sm font-medium text-gray-300 mb-1">Resume (PDF or DOCX only) <span class="text-red-400">*</span></label>

                        <div class="relative">
                            <input type="file" name="resume" id="resume"
                                class="absolute inset-0 w-full h-full opacity-0 z-50 cursor-pointer"
                                accept=".pdf,.docx"
                                onchange="updateFileNameDisplay(this)">

                            <div id="file-upload-ui" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-700 border-dashed rounded-lg bg-gray-800 hover:bg-gray-700/50 transition duration-200">
                                <div id="upload-prompt" class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-500 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                    <p class="mb-1 text-sm text-gray-400">
                                        <span class="font-semibold text-blue-400">Click to upload</span> or drag and drop
                                    </p>
                                    <p class="text-xs text-gray-500">PDF or DOCX (Max: 2MB)</p>
                                </div>

                                <div id="file-selected" class="hidden flex flex-col items-center justify-center pt-5 pb-6 w-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-500 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-sm font-medium text-gray-100 text-center" id="selected-filename">filename.pdf</p>
                                    <p class="text-xs text-gray-500 mt-1">Click to change file</p>
                                </div>
                            </div>
                        </div>

                        @error('resume')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                            Submit Application
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Function to display file name when selected
function updateFileNameDisplay(input) {
    const uploadPrompt = document.getElementById('upload-prompt');
    const fileSelected = document.getElementById('file-selected');
    const selectedFilename = document.getElementById('selected-filename');
    const fileUploadUI = document.getElementById('file-upload-ui');

    if (input.files && input.files[0]) {
        uploadPrompt.classList.add('hidden');
        fileSelected.classList.remove('hidden');
        selectedFilename.textContent = input.files[0].name;
        fileUploadUI.classList.remove('border-gray-700');
        fileUploadUI.classList.add('border-green-500');
    } else {
        uploadPrompt.classList.remove('hidden');
        fileSelected.classList.add('hidden');
        fileUploadUI.classList.remove('border-green-500');
        fileUploadUI.classList.add('border-gray-700');
    }
}
</script>
@endsection