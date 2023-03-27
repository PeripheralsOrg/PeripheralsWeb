<?php

namespace App\Http\Controllers;

use App\Models\AdmUsers;
use Illuminate\Foundation\Bootstrap\RegisterProviders;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class LoginController extends Controller
{

    public function login(Request $request, AdmUsers $user)
    {
        //Validation
        $validator = $request->validate([
            'nome' => ['required', 'max:255'],
            'senha' => ['required', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,30}$/']
        ]);


        $rememberMe = $request->input('rememberMe')  == 'on' ? true : false;
        $user = AdmUsers::all()->where('nome', $request->input('nome'))->toArray();

        if (Auth::check()) {
            if ($request->session()->has('user')) {
                return redirect('/');
            }

            $request->session()->regenerate();
            $request->session()->put('user', $user);

            return back()->withErrors(['login' => 'O usuário já está logado!']);
        }

        $request->merge([
            'senha' => Hash::make($request->input('senha'))
        ]);

        if (Auth::guard('adm_users')->attempt($validator, $rememberMe)) {
            $request->session()->regenerate();
            $request->session()->put('user', $user);
            // return redirect()->intended('/');
            return dd('2');
        }

        return back()->withErrors(['login' => 'Ocorreu um erro ao se logar!']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        return redirect('/pag/register');
    }

}
