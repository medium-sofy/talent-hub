<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
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

                        <x-forms.form method="POST" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                            @method('patch')

                            <!-- Profile Picture -->
                            <div>
                                <x-forms.label name="profile_picture" label="Profile Picture" />

                                <div class="mt-1">
                                    @if(auth()->user()->profile_picture_url)
                                        <div class="mt-2 mb-4">
                                            <img src="{{ auth()->user()->profile_picture_url }}" alt="Profile Picture" class="w-24 h-24 rounded-full object-cover">
                                        </div>
                                    @endif

                                    <input
                                        id="profile_picture"
                                        name="profile_picture"
                                        type="file"
                                        class="rounded-xl bg-white/10 border border-white/10 px-5 py-4 w-full"
                                    />

                                    <x-forms.error :error="$errors->first('profile_picture')" />
                                </div>
                            </div>

                            <!-- First Name -->
                            <x-forms.input
                                label="First Name"
                                name="f_name"
                                :value="old('f_name', $user->f_name)"
                                required
                                autocomplete="given-name"
                            />

                            <!-- Last Name -->
                            <x-forms.input
                                label="Last Name"
                                name="l_name"
                                :value="old('l_name', $user->l_name)"
                                required
                                autocomplete="family-name"
                            />

                            <!-- Email -->
                            <x-forms.input
                                label="Email"
                                name="email"
                                type="email"
                                :value="old('email', $user->email)"
                                required
                                autocomplete="username"
                            />

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

                            <x-forms.divider />

                            <!-- Phone Number -->
                            <x-forms.input
                                label="Phone Number"
                                name="phone_number"
                                type="tel"
                                :value="old('phone_number', $user->candidate->phone_number ?? '')"
                                autocomplete="tel"
                            />

                            <!-- LinkedIn Profile -->
                            <x-forms.input
                                label="LinkedIn Profile URL"
                                name="linkedin_profile"
                                type="url"
                                :value="old('linkedin_profile', $user->candidate->linkedin_profile ?? '')"
                                autocomplete="url"
                                placeholder="https://linkedin.com/in/yourusername"
                            />

                            <!-- Resume Upload -->
                            <div>
                                <x-forms.label name="resume" label="Resume" />

                                <div class="mt-1">
                                    @if($user->candidate && $user->candidate->resume_url)
                                        <div class="mt-2 mb-2">
                                            <a href="{{ $user->candidate->resume_url }}" class="text-blue-600 hover:underline" target="_blank">View Current Resume</a>
                                        </div>
                                    @endif

                                    <input
                                        id="resume"
                                        name="resume"
                                        type="file"
                                        class="rounded-xl bg-white/10 border border-white/10 px-5 py-4 w-full"
                                        accept=".pdf,.doc,.docx"
                                    />

                                    <p class="text-sm text-gray-500 mt-1">Accepted formats: PDF, DOC, DOCX</p>
                                    <x-forms.error :error="$errors->first('resume')" />
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <x-forms.button>{{ __('Save') }}</x-forms.button>

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
                        </x-forms.form>
                    </section>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Update Password') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Ensure your account is using a long, random password to stay secure.') }}
                            </p>
                        </header>

                        <x-forms.form method="POST" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                            <!-- Current Password -->
                            <x-forms.input
                                label="Current Password"
                                name="current_password"
                                type="password"
                                autocomplete="current-password"
                            />

                            <!-- New Password -->
                            <x-forms.input
                                label="New Password"
                                name="password"
                                type="password"
                                autocomplete="new-password"
                            />

                            <!-- Confirm Password -->
                            <x-forms.input
                                label="Confirm Password"
                                name="password_confirmation"
                                type="password"
                                autocomplete="new-password"
                            />

                            <div class="flex items-center gap-4">
                                <x-forms.button>{{ __('Save') }}</x-forms.button>

                                @if (session('status') === 'password-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600"
                                    >{{ __('Saved.') }}</p>
                                @endif
                            </div>
                        </x-forms.form>
                    </section>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Delete Account') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}
                            </p>
                        </header>

                        <div class="mt-6">
                            <x-forms.button
                                x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                                class="bg-red-700"
                            >{{ __('Delete Account') }}</x-forms.button>
                        </div>

                        <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                            <x-forms.form method="POST" action="{{ route('profile.destroy') }}" class="p-6">
                                @method('delete')

                                <h2 class="text-lg font-medium text-gray-900">
                                    {{ __('Are you sure you want to delete your account?') }}
                                </h2>

                                <p class="mt-1 text-sm text-gray-600">
                                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}
                                </p>

                                <div class="mt-6">
                                    <x-forms.input
                                        label="Password"
                                        name="password"
                                        type="password"
                                        placeholder="{{ __('Password') }}"
                                    />

                                    <x-forms.error :error="$errors->userDeletion->first('password')" />
                                </div>

                                <div class="mt-6 flex justify-end">
                                    <x-secondary-button x-on:click="$dispatch('close')">
                                        {{ __('Cancel') }}
                                    </x-secondary-button>

                                    <x-forms.button class="ms-3 bg-red-700">
                                        {{ __('Delete Account') }}
                                    </x-forms.button>
                                </div>
                            </x-forms.form>
                        </x-modal>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
