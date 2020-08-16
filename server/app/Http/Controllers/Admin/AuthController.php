<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // $credentials = $this->validator($request->only(['email', 'password']));
        $credentials = $request->all();

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Não autorizado'], 401);
        }

        $userDatas = auth('api')->user();

        return $this->respondWithTokenAndDatas($token, $userDatas);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Deslogado com sucesso!']);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithTokenAndDatas($token, $userDatas)
    {
        return response()->json([
            'user'         => $userDatas,
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth('api')->factory()->getTTL() * 60,
            'message'      => "Logado com sucesso!"
        ]);
    }

    /**
    * Get a validator.
    *
    * @param  array  $data
    * @return \Illuminate\Contracts\Validation\Validator
    */
   protected function validator($data, $id = null)
   {
        $fields = [
            'name'         => ['required', 'string', 'max:190'],
            'email'        => ['required', 'string', 'email', 'max:190'],
            'password'     => ['required', 'string', 'min:8'],

        ];

        $messages = [
            'required'    => 'Este campo é obrigatório!',
            'min'         => 'Campo deve ter no mínimo :min caracteres.',
            'max'         => 'Campo deve ter no máximo :max caracteres.',
            'email'       => 'Insira um endereço de e-mail válido!',
            'string'      => 'Insira caracteres válidos!',
        ];

        return $data->validate($fields, $messages);
   }
}
