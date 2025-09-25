<?php

namespace App\Http\Requests\Api\Editor;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
         $rules = [
            'title.en' => 'required|string|max:255',
            'title.ar' => 'nullable|string|max:255',
            'content'  => 'required|string',
            'status'   => 'required|in:draft,published',
        ];

        if (Auth::check() && Auth::user()->role === 'admin') {
            $rules['is_paid'] = 'sometimes|boolean';
        }

        return $rules;
}
}
