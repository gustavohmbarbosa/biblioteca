<?php

namespace App\Http\Middleware;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Closure;

class ReaderAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $reader = $request->user('reader');

        if (!$reader){
            return response()->json(['status' => 'Não autorizado'], 401);
        }

        if ($reader->status == "INATIVO"){
            return response()->json(['status' => 'Seu perfil está INATIVO. Consulte um bibliotecário.'], 401);
        }
        
        return $next($request);
    }
}
