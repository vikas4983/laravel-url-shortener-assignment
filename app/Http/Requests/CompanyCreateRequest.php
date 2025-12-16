<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyCreateRequest extends FormRequest
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
        $companyId = $this->route('company');
        return [
            'name' => [
                'required',
                'string',
                'max:50',
                Rule::unique('companies', 'name')->ignore($companyId),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Company name is required.',
            'name.string'   => 'Company name must be a valid string.',
            'name.max'      => 'Company name must not exceed 50 characters.',
            'name.unique'   => 'This company name already exists.',
        ];
    }
}
