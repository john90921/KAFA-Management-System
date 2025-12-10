<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterChildRequest extends FormRequest
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
     * Rules is the format that apply for the register child request
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'child_ic' => 'required|string|size:12',
            'child_name' => 'required|string|max:255',
            'child_age' => 'required',
            'child_gender' => 'required|string|in:Men,Women',
            'child_verification' => 'required|mimes:pdf|max:10240',
        ];
    }
}