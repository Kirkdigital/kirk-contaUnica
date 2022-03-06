<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\People;
use Illuminate\Support\Facades\Config;


class GetPermission
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
        //dados de usuario
        $you = auth()->user();
        //validar o tenant, se nao tive retornar para o inicio

        //pegar permissao do grupo
        $roles = People::where('user_id', $you->id)->with('roleslocal')->first();

        //retorno como apppermissao
        view()->share('appPermissao', $roles->roleslocal);
        return $next($request);
    }
}
