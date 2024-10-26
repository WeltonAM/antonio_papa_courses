<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UserCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('edit', 'users');
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'role_id' => 'required',
        ];
    }
}
