<?php

namespace App\Http\Controllers;

use App\Models\AdmUsers;
use Illuminate\Foundation\Bootstrap\RegisterProviders;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    public function login(Request $request, AdmUsers $user)
    {
        //Validation
        $validator = $request->validate([
            'name' => ['required', 'max:255'],
            'password' => ['required', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,30}$/']
        ]);

        $request->session()->regenerate(true);
        $request->session()->flush(true);

        $rememberMe = $request->input('rememberMe')  == 'on' ? true : false;
        $user = AdmUsers::all()->where('name', $request->input('name'))->toArray();
        if (empty($user)) {
            return back()->withErrors(['Usuário não encontrado']);
        }

        if (Auth::check()) {
            if ($request->session()->has('user')) {
                // Monitoramento log
                $userLogEmail = array_values(Session::get('user'))[0]['email'];
                LogController::writeFile($userLogEmail, 'Realizou o login', 'Login ADM');

                return to_route('page-homepageAdmin');
            }

            $request->session()->regenerate();
            $request->session()->put('user', $user);

            // Monitoramento log
            $userLogEmail = array_values(Session::get('user'))[0]['email'];
            LogController::writeFile($userLogEmail, 'Realizou o login', 'Login ADM');

            return to_route('page-homepageAdmin');
        }

        if (Auth::guard('adm_users')->attempt($validator, $rememberMe)) {
            $request->session()->regenerate();
            $request->session()->put('user', $user);
            // Monitoramento log
            $userLogEmail = array_values(Session::get('user'))[0]['email'];
            LogController::writeFile($userLogEmail, 'Realizou o login', 'Login ADM');

            return to_route('page-homepageAdmin');
        }

        return back()->withErrors('Ocorreu um erro ao se logar, por favor, contate o administrador!');
    }

    public function logout(Request $request)
    {

        // Monitoramento log
        $userLogEmail = array_values(Session::get('user'))[0]['email'];
        LogController::writeFile($userLogEmail, 'Realizou o logout', 'Login ADM');

        $request->session()->regenerate(true);
        Auth::logout();
        $request->session()->flush();
        return redirect('/adm/auth/entrar')->withErrors('Sessão encerrada com sucesso');
    }
}
