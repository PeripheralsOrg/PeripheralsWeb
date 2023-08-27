<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if(!$request->session()->has('user')){
            return redirect('adm/auth/entrar')->withErrors('É necessário fazer login para continuar!');
        }

        $roles = empty($roles) ? [null] : $roles;
        if (empty($roles)) {
            return redirect('adm/auth/entrar')->withErrors('É necessário fazer login para continuar!');
        }

        foreach ($roles as $role) {
            if (array_values($request->session()->get('user'))['0']['poder'] == $role) {

                if (Auth::guard('adm_users')->check()) {
                    return $next($request);
                } else {
                    return redirect('adm/auth/entrar')->withErrors('É necessário fazer login para continuar!');
                }
            }
        }

        return back()->withErrors('Você não possui autorização para acessar a URL: ' .  $request->url());
    }
}
