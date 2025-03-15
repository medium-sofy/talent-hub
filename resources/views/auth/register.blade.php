<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
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

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        {{--    Upload profile pic    --}}

        <div class="mt-4">
            <x-input-label for="profile-picture" :value="'Profile Pic'" />
            <x-file-input name="profile-picture" id="profile-picture"/>
            <x-input-label class="mt-4 mb-2" :value="'What are you looking for?'" />
            <div class="flex items-center gap-2">
                <input type="radio" value="candidate" name="role" onclick="showCandidateFields()" id="candidate">
                <x-input-label for="candidate" :value="'Looking for jobs '" />
            </div>

            <div class="flex items-center gap-2 mt-2">
                <input type="radio" value="employer" name="role" onclick="showEmployerFields()" id="employer">
                <x-input-label for="employer" :value="'Looking for talent '" />
            </div>
        </div>


        {{--    Candidate specific fields (hidden by default)    --}}

        <div id="candidateFields" style="display:none">
            <x-input-label for="resume" class="mt-4" :value="'Upload Resume'" />
            <x-file-input name="resume" id="resume"/>

            <x-input-label for="linkedin_profile" class="mt-4" :value="'linkedIn Profile'" />
            <x-text-input name="linkedin_profile" class="mt-2 w-full" id="linkedin_profile" />

            <x-input-label for="phone_number" class="mt-4" :value="'Phone No.'" />
            <x-text-input name="phone_number" class="mt-2 w-full" id="phone_number" />
        </div>

        <div id="employerFields" style="display:none">
            <x-input-label for="company_name" class="mt-4" :value="'Company Name'" />
            <x-text-input name="company_name" class="mt-2 w-full" id="company_name"/>

            <x-input-label for="Company_logo" class="mt-4" :value="'Company Logo'" />
            <x-file-input name="Company_logo" id="Company_logo" />

            <x-input-label for="website" class="mt-4" :value="'Company\'s Website'" />
            <x-text-input name="website" class="mt-2 w-full" id="website" />

            <x-input-label for="description" class="mt-4" :value="'Company\'s Description'" />
            <x-text-input name="description" class="mt-2 w-full" id="description" />
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
