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
        $you = auth()->user();
        //validar se selecionou a con

        Config::set('database.connections.tenant.schema', session()->get('conexao'));

        $roles = 'guest';

        $roles = People::where('user_id', $you->id)->with('roleslocal')->first();

        view()->share('appPermissao', $roles->roleslocal);
        
        return $next($request);
    }
}
