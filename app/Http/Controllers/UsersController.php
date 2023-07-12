<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    public function registerUser(Request $request, User $user)
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'cpf' => ['required', 'max:15', Rule::unique('users', 'cpf')],
            'telefone_celular' => ['required', 'max:15'],
            'password' => [
                'required', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,30}$/',
                'same:senhaConfirm'
            ],
            'email' => [
                'required',
                Rule::unique('users', 'email'),
                'same:confirmEmail'
            ],
            'feedback'
        ]);

        if ($validator->fails()) {
            return redirect()->route('client-cadastro')
                ->withErrors($validator)
                ->withInput();
        }


        if ($request->input('feedback') == 'on') {
            $request->merge([
                'feedback' => 1
            ]);
        } else {
            $request->merge([
                'feedback' => 0
            ]);
        }

        $request->merge([
            'password' => Hash::make($request->input('password'))
        ]);

        $request->merge([
            'cpf' => str_replace(['.', '-'], '', $request->input('cpf'))
        ]);

        $create = $request->except(['_token', 'senhaConfirm']);
        $userC = $user->create($create);

        if (!$userC) {
            return back()->withErrors(['Ocorreu um erro ao fazer o cadastro!']);
        }

        return redirect()->route('client-login')->withErrors('Usuário cadastrado com sucesso');
    }

    public function LoginUser(Request $request)
    {
        //Validation
        $validator = $request->validate([
            'email-cpf' => ['required', 'max:255'],
            'senha' => ['required', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,30}$/']
        ]);

        $rememberMe = $request->input('rememberMe')  == 'on' ? true : false;
        $user = User::all()->where('email', $request->input('email-cpf'))->toArray();
        $type = 'email';
        
        // Login com CPF
        if(empty($user)){
            $type = 'cpf';
            $request->merge([
                'email-cpf' => str_replace(['.', '-'], '', $request->input('email-cpf'))
            ]);
            $user = User::all()->where('cpf', $request->input('email-cpf'))->toArray();
        }


        // Usuário inexistente
        if (empty($user)) {
            return back()->withErrors(['Usuário não encontrado']);
        }

        if (Auth::check()) {
            if ($request->session()->has('user') && !empty($request->session()->get('user'))) {
                return redirect()->route('client-homepage');
            }

            $request->session()->regenerate();
            $request->session()->put('user', $user);

            return redirect()->route('client-homepage');
        }


        if($type === 'cpf'){
            $validator = [
                'cpf' => $request->input('email-cpf'),
                'password' => $request->input('senha')
            ];

        }else{
            $validator = [
                'email' => $request->input('email-cpf'),
                'password' => $request->input('senha')
            ];
        }

        if (Auth::guard('web')->attempt($validator, $rememberMe)) {
            $request->session()->regenerate();
            $request->session()->put('user', $user);
            return redirect()->route('client-homepage');
        }

        return back()->withErrors('Ocorreu um erro ao se logar, por favor, contate o SAC!');
    }

    public function logoutUser(Request $request){
        Auth::logout();
        $request->session()->flush();
        return redirect()->route('client-login')->withErrors('Sessão encerrada com sucesso');
    }

    // RESET de Senha
    public function resetPasswordEmail (Request $request){
        $request->validate(['email' => 'required|email']);

        if(count(User::all()->where('email', $request->input('email'))->toArray()) <= 0){
            session()->forget('status');
            return redirect()->back()->withErrors('Não existe nenhum usuário com o e-mail indicado!');
        }

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function resetPassword(Request $request){

        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,30}$/',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
        ? redirect()->route('client-login')->withErrors( __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
