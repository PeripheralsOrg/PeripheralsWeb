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
            'name' => ['required', 'max:255'],
            'password' => ['required', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,30}$/']
        ]);


        $rememberMe = $request->input('rememberMe')  == 'on' ? true : false;
        $user = AdmUsers::all()->where('name', $request->input('name'))
        ->where('password', Hash::make($request->input('password')))->toArray();

        if(empty($user)){
            // return back(302, ['errors' => 'asdsad'])->with('errors', 'asdasd');
            return redirect('/session')->withErrors(['errors' => 'asdadad']);
        }

        exit();

        if (Auth::check()) {
            if ($request->session()->has('user')) {
                return redirect('/');
            }

            $request->session()->regenerate();
            $request->session()->put('user', $user);

            return back()->with('error', 'O usuário já está logado');
        }

        if (Auth::guard('adm_users')->attempt($validator, $rememberMe)) {
            // return redirect()->intended('/');
            return dd('2');
        }

        return back()->with('error', 'Ocorreu um erro ao se logar, por favor, contate o administrador!');

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        return redirect('/pag/register');
    }

}
