<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LimitOffsetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'limit' => 'required|numeric',
            'offset' => 'required|numeric',
        ];
    }

    public function attributes(): array
    {
        return [
            'limit' => 'Limit',
            'offset' => 'Offset',
        ];
    }
}
