<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="f_name" :value="__('First Name')" />
            <x-text-input id="f_name" class="block mt-1 w-full" type="text" name="f_name" :value="old('f_name')" required autofocus autocomplete="f_name" />
            <x-input-error :messages="$errors->get('f_name')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="l_name" :value="__('Last Name')" />
            <x-text-input id="l_name" class="block mt-1 w-full" type="text" name="l_name" :value="old('l_name')" required autofocus autocomplete="l_name" />
            <x-input-error :messages="$errors->get('l_name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Upload profile pic -->
        <div class="mt-4">
            <x-input-label for="profile_picture" :value="'Profile Pic'" />
            <x-file-input name="profile_picture" id="profile_picture" />
            <x-input-error :messages="$errors->get('profile_picture')" class="mt-2" />

            <x-input-label class="mt-4 mb-2" :value="'What are you looking for?'" />
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
            <div class="flex items-center gap-2">
                <input type="radio" value="candidate" name="role" onclick="showCandidateFields()" id="candidate" {{ old('role') == 'candidate' ? 'checked' : '' }}>
                <x-input-label for="candidate" :value="'Looking for jobs '" />
            </div>

            <div class="flex items-center gap-2 mt-2">
                <input type="radio" value="employer" name="role" onclick="showEmployerFields()" id="employer" {{ old('role') == 'employer' ? 'checked' : '' }}>
                <x-input-label for="employer" :value="'Looking for talent '" />
            </div>
        </div>

        <!-- Candidate fields -->
        <div id="candidateFields" style="display: {{ old('role') == 'candidate' ? 'block' : 'none' }}">
            <x-input-label for="resume" class="mt-4" :value="'Upload Resume'" />
            <x-file-input name="resume" id="resume" />
            <x-input-error :messages="$errors->get('resume')" class="mt-2" />

            <x-input-label for="linkedin_profile" class="mt-4" :value="'LinkedIn Profile'" />
            <x-text-input name="linkedin_profile" class="mt-2 w-full" id="linkedin_profile" :value="old('linkedin_profile')" />
            <x-input-error :messages="$errors->get('linkedin_profile')" class="mt-2" />

            <x-input-label for="phone_number" class="mt-4" :value="'Phone No.'" />
            <input type="tel" name="phone_number" class="mt-2 w-full" id="phone_number" value="{{ old('phone_number') }}" />
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>

        <!-- Employer fields -->
        <div id="employerFields" style="display: {{ old('role') == 'employer' ? 'block' : 'none' }}">
            <x-input-label for="company_name" class="mt-4" :value="'Company Name'" />
            <x-text-input name="company_name" class="mt-2 w-full" id="company_name" :value="old('company_name')" />
            <x-input-error :messages="$errors->get('company_name')" class="mt-2" />

            <x-input-label for="company_logo" class="mt-4" :value="'Company Logo'" />
            <x-file-input name="company_logo" id="company_logo" />
            <x-input-error :messages="$errors->get('company_logo')" class="mt-2" />

            <x-input-label for="company_website" class="mt-4" :value="'Company\'s Website'" />
            <x-text-input name="company_website" class="mt-2 w-full" id="company_website" :value="old('company_website')" />
            <x-input-error :messages="$errors->get('company_website')" class="mt-2" />

            <x-input-label for="company_description" class="mt-4" :value="'Company\'s Description'" />
            <x-text-input name="company_description" class="mt-2 w-full" id="company_description" :value="old('company_description')" />
            <x-input-error :messages="$errors->get('company_description')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
    <script>
        function showEmployerFields() {
            document.getElementById("employerFields").style.display = "block";
            document.getElementById("candidateFields").style.display = "none";
        }
        function showCandidateFields() {
            document.getElementById("candidateFields").style.display = "block";
            document.getElementById("employerFields").style.display = "none";
        }
    </script>
</x-guest-layout>
