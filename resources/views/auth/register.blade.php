<x-home.layout>
    <x-home.page-heading>Register</x-home.page-heading>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- Name -->

        <x-forms.input label="First Name" name="f_name" />

        <x-forms.input label="Last Name" name="l_name"/>
        <!-- Email Address -->

        <x-forms.input label="Email" name="email"/>

        <!-- Password -->

        <x-forms.input label="Password" name="password" type="password"/>
        <!-- Confirm Password -->

        <x-forms.input label="Confirm Password" name="password_confirmation" type="password" />
        <!-- Upload profile pic -->
        <div class="mt-4">
            <x-forms.label name="profile_picture" label="Profile Picture"/>
            <div class="relative w-full">
                <label for="profile_picture" class="w-full flex items-center justify-center bg-blue-500 hover:bg-blue-400 border border-gray-500 rounded-md py-3 px-4 cursor-pointer">
                    <span class="profile-picture-name">Choose Profile Pic</span>
                </label>
                <input id="profile_picture" name="profile_picture" type="file" class="absolute left-0 top-0 opacity-0" onchange="updateFileName('profile_picture', 'profile-picture-name')"/>
            </div>

{{--      Role choosing      --}}
            <x-forms.label label="What are you looking for?" class="mt-4 mb-2"/>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
            <div class="flex items-center gap-2">
                <input type="radio" value="candidate" name="role" onclick="showCandidateFields()" id="candidate" {{ old('role') == 'candidate' ? 'checked' : '' }}>
                <x-forms.label name="candidate" label="Looking for Jobs" :square="false"/>
            </div>

            <div class="flex items-center gap-2 mt-2">
                <input type="radio" value="employer" name="role" onclick="showEmployerFields()" id="employer" {{ old('role') == 'employer' ? 'checked' : '' }}>
                <x-forms.label name="employer" label="Looking for talent" :square="false"/>

            </div>
        </div>

        <!-- Candidate fields -->
        <div id="candidateFields" style="display: {{ old('role') == 'candidate' ? 'block' : 'none' }}">
            <x-forms.label name="resume" label="Upload Resume" class="mt-4"/>
            <div class="relative w-full">
                <label for="resume" class="w-full mb-4 flex items-center justify-center bg-blue-500 hover:bg-blue-400 border border-gray-500 rounded-md py-3 px-4 cursor-pointer">
                    <span class="resume-name">Choose Resume</span>
                </label>
                <input id="resume" name="resume" type="file" class="absolute left-0 top-0 opacity-0" onchange="updateFileName('resume', 'resume-name')"/>
            </div>
            <x-input-error :messages="$errors->get('resume')" class="mt-2" />

            <x-forms.input label="LinkedIn Profile" name="linkedin_profile" class="mb-4"/>

            <x-forms.input label="Phone No." name="phone_number" type="tel" />
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

        function updateFileName(inputName, fileName) {
            const input = document.getElementById(inputName);
            const fileNameDisplay = document.querySelector('.'+fileName);

            if (input.files.length > 0) {
                fileNameDisplay.textContent = input.files[0].name;
            } else {
                fileNameDisplay.textContent = 'Choose File';
            }
        }
    </script>
</x-home.layout>
