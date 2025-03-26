<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Candidate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProfileController extends Controller
{
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

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

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
        return view('profile.index', compact('user', 'candidate'));
    }
}
