<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name'      =>  'required|string|max:190',
            'email'     =>  'required|string|email|max:190',
            //'password'  =>  'required|string|min:8|confirmed',
            'type'      =>  'required|string'
        ];
    }

    public function messages()
    {
        return [
            'required'  =>  'Este campo é obrigatório!',
            'max'       =>  'Campo deve ter no mínimo :max caracteres',
            'email'     =>  'Insira um endereço de e-mail válido!',
            'string'    =>  'Insira caracteres válidos!',
        ];
    }
}
