<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportResultRequest extends FormRequest
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
            'csv_file' => 'required|file|mimes:csv,txt|max:5120', // 5MB max, CSV or TXT
            'assessid' => 'required|exists:examinations,id',
            'subs' => 'required|exists:subjects,id',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'csv_file.required' => 'Please select a CSV file to upload.',
            'csv_file.file' => 'The uploaded file must be a valid file.',
            'csv_file.mimes' => 'The file must be a CSV file (.csv or .txt).',
            'csv_file.max' => 'The file size must not exceed 5MB.',
            'assessid.required' => 'Examination ID is required.',
            'assessid.exists' => 'The selected examination does not exist.',
            'subs.required' => 'Subject ID is required.',
            'subs.exists' => 'The selected subject does not exist.',
        ];
    }
}
