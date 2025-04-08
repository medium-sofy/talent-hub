<?php

namespace App\Http\Requests\jobs;

use Illuminate\Foundation\Http\FormRequest;

class PostJobRequest extends FormRequest
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
        return [
            'title' => 'required|string|min:3|max:100',
            'description' => 'required|string|min:3|max:500',
            'requirements' => 'required|string|min:3|max:500',
            'benefits' => 'required|string|min:3|max:500',
            'location' => 'required|string|min:3|max:50',
            'category_id' => 'required|numeric|exists:categories,id',
            'workplace'=> 'required|string|in:On-site,Hybrid,Remote',
            'job_type'=> 'required|string|in:Part-time,Full-time,Freelance',
            'lower_salary' => 'required|numeric|min:1000|max:100000',
            'upper_salary' => 'required|numeric|min:2000|max:1000000|gt:lower_salary',
            'application_deadline' => 'required|date',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Job title is required',
            'title.string' => 'Job title must be string',
            'title.min' => 'Job title must be at least 3 characters',
            'title.max' => 'Job title must be less than 100 characters',
            'description.required' => 'Job description is required',
            'description.string' => 'Job description must be string',
            'description.min' => 'Job description must be at least 3 characters',
            'description.max' => 'Job description must be less than 500 characters',
            'requirements.required' => 'Requirements is required',
            'requirements.string' => 'Requirements must be string',
            'requirements.min' => 'Requirements must be at least 3 characters',
            'requirements.max' => 'Requirements must be less than 500 characters',
            'benefits.required' => 'Benefits is required',
            'benefits.string' => 'Benefits must be string',
            'benefits.min' => 'Benefits must be at least 3 characters',
            'benefits.max' => 'Benefits must be less than 500 characters',
            'location.required' => 'Location is required',
            'location.string' => 'Location must be string',
            'location.min' => 'Location must be at least 3 characters',
            'location.max' => 'Location must be less than 50 characters',
            'category_id.required' => 'Category is required',
            'workplace.required' => 'Workplace is required',
            'workplace.string' => 'Workplace must be string',
            'lower_salary.required' => 'Lower salary range is required',
            'lower_salary.numeric' => 'Lower salary range must be numeric',
            'upper_salary.required' => 'Upper salary range is required',
            'upper_salary.numeric' => 'Upper salary range must be numeric',
            'upper_salary.min' => 'Upper salary range must be at least 2000',
            'upper_salary.gt' => 'Upper salary range must be greater than lower salary range',
            'application_deadline.required' => 'Application deadline is required',
            'application_deadline.date' => 'Application deadline must be a date',
        ];
    }
}
