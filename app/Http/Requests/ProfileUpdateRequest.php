<?php

namespace App\Http\Requests;

<<<<<<< HEAD
use App\Models\User;
=======
>>>>>>> c4b440931959f3fe81af478374ac416720e5628f
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
<<<<<<< HEAD
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
=======
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'f_name' => 'required|string|max:255',
            'l_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->user()->id,
            'phone_number' => 'nullable|string|max:20',
            'linkedin_profile' => 'nullable|url|max:255',
            'profile_picture_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'resume_url' => 'nullable|mimes:pdf,doc,docx|max:2048',
>>>>>>> c4b440931959f3fe81af478374ac416720e5628f
        ];
    }
}
