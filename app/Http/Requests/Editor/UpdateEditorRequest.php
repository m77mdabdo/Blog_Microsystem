<?php

namespace App\Http\Requests\Editor;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEditorRequest extends FormRequest
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
         $id = $this->route('editor');
         $id = $id instanceof User ? $id->id : $id;
        return [
            //
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6|confirmed',
            'role'     => 'required|in:editor,admin',
            // 'status'   => 'required|in:published,draft',
            // 'is_paid'  => 'required|in:0,1',
        ];
    }
}
