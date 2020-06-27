<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReaderRequest extends FormRequest
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
            'name' =>           'required|string|max:190',
            'email' =>          'required|string|email',
            'password' =>       'required|string|min:8',
            'phone' =>          'required|string',
            'gender' =>         'required|string',
            'grade' =>          'required|string|max:1',
            'class' =>          'required|string|max:1',
            'course_id' =>      'required|string|max:1',
            'registration' =>   'required|string',
            'entry_year' =>     'required|string|max:4',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Este campo é obrigatório!',
            'string' => 'Insira caracteres válidos!',
            'min' => 'Campo deve ter no mínimo :min caracteres',
            'max' => 'Campo deve ter no máximo :max caracteres',
            'email' => 'Insira um endereço de e-mail válido!',
        ];
    }
}
