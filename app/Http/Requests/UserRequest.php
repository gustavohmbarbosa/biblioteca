<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'email'     =>  'required|string|email|max:190|unique:users',
            'password'  =>  'required|string|min:8|confirmed',
            'type'      =>  'required|string'
        ];
    }

    public function messages()
    {
        return [
            'required'  =>  'Este campo é obrigatório!',
            'max'       =>  'Campo deve ter no máximo :max caracteres.',
            'email'     =>  'Insira um endereço de e-mail válido!',
            'unique'    =>  'Este e-mail já esta em uso. Tente outro.',
            'string'    =>  'Insira caracteres válidos!',
            'confirmed' =>  'As senhas não coincidem. Tente novamente.',
            'min'       =>  'Campo deve ter no mínimo :min caracteres.',
        ];
    }
}
