<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'title'            => 'required|max:190',
            'subtitle'         => 'required|max:190',
            'origin'           => 'required',
            'price'            => 'nullable',
            'isbn'             => 'required',
            'synopsis'         => 'nullable',
            'cdd'              => 'required',
            'language'         => 'required',
            'observations'     => 'required',
            'pages'            => 'required',
            'edition'          => 'required',
            'publication_date' => 'required',
            'color'            => 'required',
            'cape'             => '',
            'company_id'       => 'required',
            'cape'             => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Este campo é obrigatório!',
            'max'      => 'Campo deve ter no máximo :max caracteres',
        ];
    }
}
