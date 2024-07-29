<?php

namespace Modules\Document\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SyncFileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'limit' => 'required|in:5,10,20,50,100,500,1000',
        ];
    }

    public function attributes(): array
    {
        return [
            'limit' => 'Limit',
        ];
    }
}
