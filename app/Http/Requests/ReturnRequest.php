<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'lateness_charge' => ['sometimes'],
        ];
    }

    public function messages()
    {
        $messages = [

        ];
        return $messages;
    }
}
