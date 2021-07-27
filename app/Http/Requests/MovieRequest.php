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
            'title' => ['required', 'max:50'],
            'genre' => ['required', 'not_in:0'],
            'released_date' => ['required'],
        ];
    }

    public function messages()
    {
        $messages = [
            'genre.not_in' => trans('validation.select_empty', ['attribute' => 'genre']),
        ];
        return $messages;
    }
}
