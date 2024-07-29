<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'file_import' => 'required|mimes:xlsx',
        ];
    }

    public function attributes(): array
    {
        return [
            'file_import' => 'File Import',
        ];
    }
}
