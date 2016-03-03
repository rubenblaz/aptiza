<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RecuPassRequest extends Request
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
        return [
           'pass'=>['required','regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,15}$/'],
           'repass' =>['required','same:pass'],
        ];
    }
}
