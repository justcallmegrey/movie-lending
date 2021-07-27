<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LendingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

     /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $uri = strtolower(request()->segment(2));
        $rules = [];

        switch($uri) {
            case 'store':
                $rules = [
                    'member_id' => ['required'],
                    'movies' => ['required', 'not_in:[]'],
                    'due_date' => ['required'],
                ];
                break;
            default:
                break;
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'movies.required' => trans('validation.select_empty', ['attribute' => 'movies to lend']),
            'movies.not_in' => trans('validation.select_empty', ['attribute' => 'movies to lend']),
        ];
        return $messages;
    }
}
