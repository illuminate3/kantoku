<?php

namespace Modules\Kantoku\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeedModuleRequest extends FormRequest
{
    public function rules()
    {
        return [
            'module' => 'required',
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [];
    }
}
