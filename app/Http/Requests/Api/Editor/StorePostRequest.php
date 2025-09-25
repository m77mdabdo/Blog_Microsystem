<?php

namespace App\Http\Requests\Api\Editor;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            //
            'title.en' => 'required|string|max:255',
        'title.ar' => 'nullable|string|max:255',
        'content'  => 'required|string',
        'status'   => 'nullable|in:draft,published',
        'is_paid'  => 'nullable|boolean',
        ];


    }
}
