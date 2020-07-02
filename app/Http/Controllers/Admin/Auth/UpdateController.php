<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Traits\Messages;
use App\User;

class UpdateController extends Controller
{
    use Messages;

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Requests\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = $this->user->find($id);

        if(is_null($user)){
            return $this->errorMessage("Usuário não encontrado");
        }

        $this->validator($request, $user->id);
        
        $data = $request->only('name', 'email', 'type');
        $user->update($data);

        return $this->message("Usuário editado com sucesso!");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Requests\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, $id)
    {
        $user = $this->user->find($id);

        if(is_null($user)){
            return $this->errorMessage("Usuário não encontrado");
        }

        $this->passwordValidator($request);

        $data = $request->only('password');
        $data['password'] = Hash::make($data['password']);

        $user->update($data);

        return $this->message("Senha atualizada com sucesso!");
    }


    /**
     *Get a validator for user update.
     *
     * @param  array  $data
     * @param int $id
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator($data, $id)
    {
        return $data->validate([
            'name'  => ['required', 'string', 'max:190'],
            'email' => ['required', 'string', 'max:190' , 'email', Rule::unique('users')->ignore($id)],
            'type'  => ['required', 'string']
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
        $data->validate(['password' => 'required|string|min:8|confirmed'],[
            'required'  =>  'Este campo é obrigatório!',
            'min'       =>  'Campo deve ter no mínimo :min caracteres.',
            'string'    =>  'Insira caracteres válidos!',
            'confirmed' =>  'As senhas não coincidem. Tente novamente.'
        ]);
    }
}
