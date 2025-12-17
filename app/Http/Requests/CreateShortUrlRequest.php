<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateShortUrlRequest extends FormRequest
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
            'user_id' => ['nullable', 'exists:users,id'],
            'company_id' => ['nullable', 'exists:companies,id'],
            'original_url' => ['required', 'url', 'max:2048'],
            'short_code' => ['nullable', 'string', 'alpha_num', 'min:4', 'max:10', 'unique:short_urls,short_code'],
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.exists' => 'The selected user is invalid.',
            'company_id.exists' => 'The selected company is invalid.',
            'original_url.required' => 'Original URL is required.',
            'original_url.url' => 'Please provide a valid URL.',
            'original_url.max' => 'URL length should not exceed 2048 characters.',
            'short_code.alpha_num' => 'Short code may contain only letters and numbers.',
            'short_code.min' => 'Short code must be at least 4 characters.',
            'short_code.max' => 'Short code may not be greater than 10 characters.',
            'short_code.unique' => 'This short code is already in use.',
        ];
    }
}
