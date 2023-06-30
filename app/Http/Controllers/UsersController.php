<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function registerUser(Request $request, User $user)
    {
        // $validator = $request->validate([
        //     'name' => ['required', 'max:255'],
        //     'last_name' => ['required', 'max:255'],
        //     'cpf' => ['required', 'max:15'],
        //     'telefone_celular' => ['required', 'max:15'],
        //     'password' => [
        //         'required', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,30}$/',
        //         'same:senhaConfirm'
        //     ],
        //     'email' => ['required', Rule::unique('users', 'email')],
        //     'feedback' 
        // ]);

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

        $create = $request->except(['_token', 'senhaConfirm']);
        $userC = $user->create($create);

        if (!$userC) {
            return back()->withErrors(['Ocorreu um erro ao fazer o cadastro!']);
        }

        return redirect()->route('client-login')->withErrors('Usuário cadastrado com sucesso');
    }
}
