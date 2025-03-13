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
            'rating' => ['required', 'integer', 'min:1'],
            'poster' => ['required', 'image'],
            'genres' => ['required', 'array'],
            'genres.*' => ['exists:genres,name'],
        ];
    }
}
