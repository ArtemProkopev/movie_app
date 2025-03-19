<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MovieRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:60'],
            'description' => ['required', 'string', 'max:255'],
            'duration' => ['required', 'integer', 'min:30'],
            'country' => ['required', 'string'],
            'release_date' => ['required', Rule::date()->format('Y-m-d')],
            'rating' => ['required', 'integer', 'min:1', 'max:10'],
            'poster' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'genres' => ['required', 'array', 'min:1'],
            'genres.*' => ['exists:genres,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Title is required.',
            'description.required' => 'Description is required.',
            'duration.required' => 'Duration is required and must be at least 30 minutes.',
            'country.required' => 'Country is required.',
            'release_date.required' => 'Release date is required.',
            'rating.required' => 'Rating is required and must be between 1 and 10.',
            'poster.image' => 'The poster must be an image file (jpeg, png, jpg, gif).',
            'poster.max' => 'The poster size must not exceed 2MB.',
            'genres.required' => 'At least one genre must be selected.',
            'genres.*.exists' => 'One or more selected genres do not exist in the database.',
        ];
    }
}
