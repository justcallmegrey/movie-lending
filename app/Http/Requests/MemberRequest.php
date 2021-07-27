<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
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
                    'name' => ['required', 'max:20'],
                    'age' => ['required', 'numeric', 'digits:2'],
                    'address' => ['required', 'max:30'],
                    'telephone' => ['required', 'numeric', 'digits_between:11,16'],
                    'identity_number' => ['required', 'digits_between:10,16'],
                    'is_active' => ['required'],
                ];
                break;
            case 'update':
                $id = decrypt(request('id'));
                $rules = [
                    'name' => ['required', 'max:30'],
                    'age' => ['required', 'numeric', 'digits:2'],
                    'address' => ['required', 'max:50'],
                    'telephone' => ['required', 'numeric', 'digits_between:11,16'],
                    'identity_number' => ['required', 'digits_between:10,16', 'unique:members,identity_number'.($id ? ",$id" : '').',id,deleted_at,NULL' ],
                    'is_active' => ['required'],
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

        ];
        return $messages;
    }
}
