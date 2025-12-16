<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InviteUserRequest extends FormRequest
{
    public function authorize(): bool
    {

        return true;
    }

    public function rules(): array
    {
        return [
            'company_id' => 'required|exists:companies,id',
            'name'       => 'required|string',
            'email'      => 'required|email|unique:users,email|unique:invitations,email',
            'role_id'    => 'required|exists:roles,id',
        ];
    }

    public function messages(): array
    {
        return [
            'company_id.required' => 'Company is required',
            'company_id.exists'   => 'Selected company is invalid',
            'email.unique'        => 'This email is already invited or registered',
            'role_id.required' => 'Company is required',

        ];
    }
}
