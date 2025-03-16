<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
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
        // the request contains info for both candidates, and employers
        // create the user with required info based on role value

//        TODO: Create a filesystem to save user profile pic & CV
//            TODO: Add profile pic to user
        $imageName = null;
        $resumeName = null;
        if($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $imageName = $image->store('/', 'profile_pic');
        }

        if($request->hasFile('resume')) {
            $resume = $request->file('resume');
            $resumeName = $resume->store('/', 'candidate_resume');
        }

        $user = User::create([
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'email' => $request->email,
            'profile_picture_url'=> $imageName,
            'password' => Hash::make($request->password),
            'role'=>$request->role,
        ]);


        if($request->role == 'candidate')
        {
//            TODO: Add resume to candidate
            $user->candidates()->create([
                'resume_url' => $resumeName,
                'linkedin_profile'=>$request->linkedin_profile,
                'phone_number'=>$request->phone_number,
            ]);
        }

        if($request->role == 'employer')
        {
            $user->employers()->create([
                'company_name'=>$request->company_name,
                'company_website'=>$request->company_website,
                'company_description'=>$request->company_description,
            ]);
        }



        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
