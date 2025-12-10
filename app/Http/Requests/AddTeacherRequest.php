<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddTeacherRequest extends FormRequest
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
     * Rules is the format that apply for the add teacher request
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_ic' => 'required|string|size:12',
            'user_name' => 'required|string|max:255',
            'user_gender' => 'required|string|in:Men,Women|max:255',
            'user_contact' => 'required|numeric|digits_between:1,255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' =>  'required|string|min:8',
            'user_verification' => 'required|mimes:pdf|max:10240',
        ];
    }
}
