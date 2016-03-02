<?php

namespace App\Http\Requests;
use App\Http\Requests\Request;
class PerfilRequest extends Request
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
            'password_nuevo' => array('required', 'regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,15}$/'),
            'password_repetir' => array('required','same:password_nuevo'),
            'password_anterior'=>'required'
        ];
    }
}