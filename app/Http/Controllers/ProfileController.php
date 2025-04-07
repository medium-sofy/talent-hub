<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
<<<<<<< HEAD
=======
use App\Models\Candidate;
>>>>>>> c4b440931959f3fe81af478374ac416720e5628f
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
<<<<<<< HEAD
=======
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
>>>>>>> c4b440931959f3fe81af478374ac416720e5628f
use Illuminate\View\View;

class ProfileController extends Controller
{
<<<<<<< HEAD
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();
=======
    public function edit(Request $request): View
    {
        $user = $request->user();
        $user->load('candidate');
        return view('profile.edit', ['user' => $user]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validated = $request->validated();

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture_url) {
                Storage::disk('profile_pic')->delete($user->profile_picture_url);
            }
            $imageName = time() . '.' . $request->profile_picture->extension();
            $request->profile_picture->storeAs('', $imageName, 'profile_pic');
            $user->profile_picture_url = $imageName;
        }

        // Generate slug from full name
        $fullName = trim($validated['f_name'] . ' ' . $validated['l_name']);
        $slug = Str::slug($fullName);

        // Ensure unique slug
        $originalSlug = $slug;
        $counter = 1;
        while (Candidate::where('slug', $slug)->where('user_id', '!=', $user->id)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $user->f_name = $validated['f_name'];
        $user->l_name = $validated['l_name'];
        $user->email = $validated['email'];

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $candidateData = [
            'user_id' => $user->id,
            'phone_number' => $validated['phone_number'] ?? null,
            'linkedin_profile' => $validated['linkedin_profile'] ?? null,
            'slug' => $slug, // Add slug to candidate data
        ];

        if ($request->hasFile('resume')) {
            $resumeName = time() . '_' . $user->id . '.' . $request->resume->extension();
            $request->resume->storeAs('', $resumeName, 'resumes');
            $candidateData['resume_url'] = $resumeName;
        }

        Candidate::updateOrCreate(
            ['user_id' => $user->id],
            $candidateData
        );
>>>>>>> c4b440931959f3fe81af478374ac416720e5628f

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

<<<<<<< HEAD
    /**
     * Delete the user's account.
     */
=======
>>>>>>> c4b440931959f3fe81af478374ac416720e5628f
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
<<<<<<< HEAD

        Auth::logout();

        $user->delete();

=======
        Auth::logout();
        $user->delete();
>>>>>>> c4b440931959f3fe81af478374ac416720e5628f
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
<<<<<<< HEAD
=======

    public function show()
    {
        $user = Auth::user()->load('candidate');
        return view('profile.index', compact('user'));
    }

    // New method to show profile by slug
    public function showBySlug(string $slug)
    {
        $candidate = Candidate::where('slug', $slug)->firstOrFail();
        $user = $candidate->user;
        return view('profile.profile', compact('user', 'candidate'));
    }
>>>>>>> c4b440931959f3fe81af478374ac416720e5628f
}
