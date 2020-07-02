<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Traits\Messages;
use App\Reader;

class ReaderUpdateController extends Controller
{
    use Messages;

    /**
	 * @var Reader
	 */
	private $reader;

	public function __construct(Reader $reader)
	{
		$this->reader = $reader;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $reader = $this->reader->find($id);

        if (is_null($reader)) {
            return $this->errorMessage("Leitor não encontrado.");
        }

        $data = $this->validator($request, $reader->id);

        $reader->update($data);

        return $this->message("Leitor atualizado com sucesso!");
    }

    /**
    *Get a validator for user update.
    *
    * @param  array $data
    * @param int $id
    * @return \Illuminate\Contracts\Validation\Validator
    */
   protected function validator($data, $id)
   {
       return $data->validate([
           'name'         => ['required', 'string', 'max:190'],
           'email'        => ['required', 'string', 'email', 'max:190' , Rule::unique('readers')->ignore($id)],
           'phone'        => ['required', 'string'],
           'gender'       => ['required', 'string'],
           'grade'        => ['required', 'string', 'max:1'],
           'class'        => ['required', 'string', 'max:1'],
           'course_id'    => ['required', 'string', 'max:1'],
           'registration' => ['required', 'string'],
           'entry_year'   => ['required', 'string', 'max:4'],
       ], 
       [
           'required'  =>  'Este campo é obrigatório!',
           'max'       =>  'Campo deve ter no mínimo :max caracteres.',
           'email'     =>  'Insira um endereço de e-mail válido!',
           'unique'    =>  'Este e-mail já esta em uso. Tente outro.',
           'string'    =>  'Insira caracteres válidos!',
       ]);
   }

   /**
    * Get a validator for user password.
    *
    * @param  array  $data
    * @return \Illuminate\Contracts\Validation\Validator
    */
   protected function passwordValidator($data)
   {
       $data->validate(['password' => 'required, string, min:8, confirmed'],[
           'required'  =>  'Este campo é obrigatório!',
           'min'       =>  'Campo deve ter no mínimo :min caracteres.',
           'string'    =>  'Insira caracteres válidos!',
           'confirmed' =>  'As senhas não coincidem. Tente novamente.'
       ]);
   }
}
