<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $user->load('candidate');
        return view('profile.edit', ['user' => $user]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validated = $request->validated();

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture_url) {
                Storage::delete('public/profile_pictures/' . basename($user->profile_picture_url));
            }
            $imageName = time() . '.' . $request->profile_picture->extension();
            $request->profile_picture->storeAs('public/profile_pictures', $imageName);
            $user->profile_picture_url = '/storage/profile_pictures/' . $imageName;
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
        ];

        if ($request->hasFile('resume')) {
            $resumeName = time() . '_' . $user->id . '.' . $request->resume->extension();
            $request->resume->storeAs('public/resumes', $resumeName);
            $candidateData['resume_url'] = '/storage/resumes/' . $resumeName;
        }

        Candidate::updateOrCreate(
            ['user_id' => $user->id],
            $candidateData
        );

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
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
}
