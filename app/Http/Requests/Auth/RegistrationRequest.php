<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
class RegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        // Base rules for all registrations
        $rules = [
            'f_name'          => ['required', 'string', 'min:3','max:20'],
            'l_name'          => ['required', 'string', 'min:3','max:20'],
            'email'           => ['required', 'string', 'lowercase', 'email', 'max:50', 'unique:' . User::class],
            'password'        => ['required', 'confirmed', Password::defaults()],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'role'            => ['required'],
        ];

        // Candidate-specific rules
        if ($this->input('role') === 'candidate') {
            $rules['resume']            = ['required', 'file', 'mimes:pdf', 'max:2048'];
            $rules['linkedin_profile']  = ['required', 'string', 'min:10', 'max:100'];
            $rules['phone_number']      = ['required', 'numeric', 'digits_between:11,20'];
        }

        // Employer-specific rules
        if ($this->input('role') === 'employer') {
            $rules['company_name']       = ['required', 'string', 'min:3', 'max:50'];
            $rules['company_logo']       = ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'];
            $rules['company_website']    = ['required', 'string', 'min:10', 'max:50'];
            $rules['company_description']= ['required', 'string', 'min:30', 'max:255'];
        }

        return $rules;

    }

    public function messages(): array
    {
        return [
            'f_name.required' => 'First name is required',
            'f_name.min' => 'First name must be at least 3 characters',
            'f_name.max' => 'First name must be less than 20 characters',
            'l_name.required' => 'Last name is required',
            'l_name.min' => 'Last name must be at least 3 characters',
            'l_name.max' => 'Last name must be less than 20 characters',
            'email.required' => 'Email is required',
            'email.email' => 'Invalid email format',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters',
            'password.max' => 'Password must be less than 20 characters',
            'password.confirmed' => 'Password does not match',
            'profile_picture.required' => 'Profile picture is required',
            'profile_picture.image' => 'Profile picture must be an image',
            'role.required' => 'Role is required',

            'required' => 'Please choose a role',
            'resume.required' => 'Resume is required',
            'resume.file' => 'Resume must be a PDF file',
            'linkedin_profile.required' => 'Linkedin profile is required',
            'linkedin_profile.max' => 'Linkedin profile link must be less than 100 characters',
            'phone_number.required' => 'Phone number is required',
            'phone_number.min' => 'Phone number must be at least 11 digits',
            'phone_number.max' => 'Phone number must be less than 20 digits',
            'company_name.required' => 'Company name is required',
            'company_name.min' => 'Company name must be at least 3 characters',
            'company_name.max' => 'Company name must be less than 50 characters',
            'company_logo.required' => 'Company logo is required',
            'company_logo.image' => 'Company logo must be an image',
            'company_logo.mimes' => 'Company logo must be an image',
            'company_logo.max' => 'Company logo size must be less than 2MB',
            'company_website.required' => 'Company website is required',
            'company_website.min' => 'Company website must be at least 10 characters',
            'company_website.max' => 'Company website must be less than 50 characters',
            'company_description.required' => 'Company description is required',
            'company_description.min' => 'Company description must be at least 30 characters',
            'company_description.max' => 'Company description must be less than 255 characters',


        ];
    }
}
