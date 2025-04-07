<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Models\User;
<<<<<<< HEAD
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
=======
use App\Models\Candidate;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
>>>>>>> c4b440931959f3fe81af478374ac416720e5628f
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegistrationRequest $request): RedirectResponse
    {
<<<<<<< HEAD
        // the request contains info for both candidates, and employers
        // create the user with required info based on role value

//        TODO: Create a filesystem to save user profile pic & CV
//            TODO: Add profile pic to user
        $imageName = null;
        $resumeName = null;
        $companyLogoName = null;
=======
        $imageName = null;
        $resumeName = null;
        $companyLogoName = null;

>>>>>>> c4b440931959f3fe81af478374ac416720e5628f
        if($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $imageName = $image->store('/', 'profile_pic');
        }

        if($request->hasFile('resume')) {
            $resume = $request->file('resume');
            $resumeName = $resume->store('/', 'candidate_resume');
        }

        if($request->hasFile('company_logo')) {
            $companyLogo = $request->file('company_logo');
            $companyLogoName = $companyLogo->store('/', 'company_logo');
        }

        $user = User::create([
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'email' => $request->email,
            'profile_picture_url'=> $imageName,
            'password' => Hash::make($request->password),
            'role'=>$request->role,
        ]);

<<<<<<< HEAD

        if($request->role == 'candidate')
        {
//            TODO: Add resume to candidate
            $user->candidate()->create([
                'resume_url' => $resumeName,
                'linkedin_profile'=>$request->linkedin_profile,
                'phone_number'=>$request->phone_number,
=======
        if($request->role == 'candidate')
        {
            // Generate unique slug
            $fullName = trim($request->f_name . ' ' . $request->l_name);
            $slug = $this->createUniqueSlug($fullName);

            $user->candidate()->create([
                'resume_url' => $resumeName,
                'linkedin_profile' => $request->linkedin_profile,
                'phone_number' => $request->phone_number,
                'slug' => $slug,
>>>>>>> c4b440931959f3fe81af478374ac416720e5628f
            ]);
        }

        if($request->role == 'employer')
        {
            $user->employer()->create([
<<<<<<< HEAD
                'company_name'=>$request->company_name,
                'company_logo_url'=>$companyLogoName,
                'company_website'=>$request->company_website,
                'company_description'=>$request->company_description,
            ]);
        }



=======
                'company_name' => $request->company_name,
                'company_logo_url' => $companyLogoName,
                'company_website' => $request->company_website,
                'company_description' => $request->company_description,
            ]);
        }

>>>>>>> c4b440931959f3fe81af478374ac416720e5628f
        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
<<<<<<< HEAD
=======

    /**
     * Create a unique slug for the candidate
     */
    protected function createUniqueSlug(string $name): string
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        // Check if slug exists and make it unique
        while (Candidate::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
>>>>>>> c4b440931959f3fe81af478374ac416720e5628f
}
