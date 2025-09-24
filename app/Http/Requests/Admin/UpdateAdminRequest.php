<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('admin');
          $id = $id instanceof User ? $id->id : $id;

        return [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6|confirmed',
            'role'     => 'required|in:admin,editor', // ضيف اللي محتاجه هنا
        ];
    }
}
