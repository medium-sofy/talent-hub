<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Profile Picture -->
        <div>
            <x-input-label for="profile_picture" :value="__('Profile Picture')" />

            @if(auth()->user()->profile_picture_url)
                <div class="mt-2 mb-4">
                    <img src="{{ auth()->user()->profile_picture_url }}" alt="Profile Picture" class="w-24 h-24 rounded-full object-cover">
                </div>
            @endif

            <input id="profile_picture" name="profile_picture" type="file" class="mt-1 block w-full" />
            <x-input-error class="mt-2" :messages="$errors->get('profile_picture')" />
        </div>

        <!-- First Name -->
        <div>
            <x-input-label for="f_name" :value="__('First Name')" />
            <x-text-input id="f_name" name="f_name" type="text" class="mt-1 block w-full" :value="old('f_name', $user->f_name)" required autofocus autocomplete="given-name" />
            <x-input-error class="mt-2" :messages="$errors->get('f_name')" />
        </div>

        <!-- Last Name -->
        <div>
            <x-input-label for="l_name" :value="__('Last Name')" />
            <x-text-input id="l_name" name="l_name" type="text" class="mt-1 block w-full" :value="old('l_name', $user->l_name)" required autocomplete="family-name" />
            <x-input-error class="mt-2" :messages="$errors->get('l_name')" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Phone Number -->
        <div>
            <x-input-label for="phone_number" :value="__('Phone Number')" />
            <x-text-input id="phone_number" name="phone_number" type="tel" class="mt-1 block w-full" :value="old('phone_number', $user->candidate->phone_number ?? '')" autocomplete="tel" />
            <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
        </div>

        <!-- LinkedIn Profile -->
        <div>
            <x-input-label for="linkedin_profile" :value="__('LinkedIn Profile URL')" />
            <x-text-input id="linkedin_profile" name="linkedin_profile" type="url" class="mt-1 block w-full" :value="old('linkedin_profile', $user->candidate->linkedin_profile ?? '')" autocomplete="url" placeholder="https://linkedin.com/in/yourusername" />
            <x-input-error class="mt-2" :messages="$errors->get('linkedin_profile')" />
        </div>

        <!-- Resume Upload -->
        <div>
            <x-input-label for="resume_url" :value="__('Resume')" />

            @if($user->candidate && $user->candidate->resume_url)
                <div class="mt-2 mb-2">
                    <a href="{{ $user->candidate->resume_url }}" class="text-blue-600 hover:underline" target="_blank">View Current Resume</a>
                </div>
            @endif

            <input id="resume" name="resume" type="file" class="mt-1 block w-full" accept=".pdf,.doc,.docx" />
            <p class="text-sm text-gray-500 mt-1">Accepted formats: PDF, DOC, DOCX</p>
            <x-input-error class="mt-2" :messages="$errors->get('resume')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
