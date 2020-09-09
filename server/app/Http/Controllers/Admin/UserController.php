<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Traits\Upload;
use App\Traits\Messages;
use App\User;

class UserController extends Controller
{
    use Messages;
    use Upload;

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->user->all();

        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validator($request);
        $data['password'] = Hash::make($data['password']);

        if($request->hasFile('image')) {
            $data['image'] = $this->imageUpload($request->file('image'), 'users');
        }

        $user = $this->user->create($data);

        return $this->message("Usuário criado!", $user->id, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->user->find($id);

        if(is_null($user)){
            return $this->errorMessage("Usuário não encontrado");
        }

        return response()->json($user);
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

        $data = $this->validator($request, $user->id);

        if(array_key_exists('password', $data)){
            $data['password'] = Hash::make($data['password']);
        }

        if($request->hasFile('image')) {
            if(Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }
            $data['image'] = $this->imageUpload($request->file('image'), 'users');
        }

        $user->update($data);

        return $this->message("Usuário atualizado com sucesso!", $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->user->find($id);

        if(is_null($user)){
            return $this->errorMessage("Usuário não encontrado");
        }

        $user->delete();

        return $this->message($user->name . ' foi removido do sistema!', $user->id);
    }

    /**
     * Get a validator.
     *
     * @param  array  $data
     * @param  int    $id
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator($data, $id = null)
    {
        $fields = [
            'name'      => ['required', 'string', 'max:190'],
            'email'     => ['required', 'string', 'max:190' , 'email', Rule::unique('users')->ignore($id)],
            'password'  => [Rule::requiredIf(!$id), 'string', 'min:8', 'confirmed'],
            'type'      => ['required', Rule::in(['SIMPLES', 'MASTER'])],
            'image'     => ['image', 'mimes:jpeg,jpg,png']
        ];

        $messages = [
            'required'  => 'Esse campo é obrigatório!',
            'max'       => 'Campo deve ter no mínimo :max caracteres.',
            'email'     => 'Insira um endereço de e-mail válido!',
            'unique'    => 'Esse e-mail já está em uso. Tente outro.',
            'confirmed' => 'As senhas não coincidem. Tente novamente.',
            'string'    => 'Insira caracteres válidos.',
            'min'       => 'Campo deve ter no mínimo :min caracteres.',
            'in'        => 'Selecione um dos valores pré-informados.',
            'image'     => 'Você deve inserir uma imagem.',
            'mimes'     => 'A imagem deve se do tipo: jpeg, jpg ou png.'
        ];

        return $data->validate($fields, $messages);
    }
}
