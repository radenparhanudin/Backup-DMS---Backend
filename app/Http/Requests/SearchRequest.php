<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'limit' => 'nullable|numeric',
            'offset' => 'nullable|numeric',
            'page' => 'nullable|numeric',
        ];
    }

    public function attributes(): array
    {
        return [
            'limit' => 'Limit',
            'offset' => 'Offset',
            'page' => 'Page',
        ];
    }
}
