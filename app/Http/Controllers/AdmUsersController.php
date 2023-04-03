<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdmUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdmUsersController extends Controller
{
    public function all(){
        $users = AdmUsers::all()->where('status', 1)->toArray();
        if($users){
           return view('admin.list.listUserAdm')->with('users', $users); 
        }
        return redirect('falha-listAdm'); 
    }

    public function register(Request $request, AdmUsers $user)
    {
        $validator = $request->validate([
            'name' => ['required', 'max:255'],
            'password' => ['required', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,30}$/',
             'same:senhaConfirm'],
            'email' => ['required', Rule::unique('adm_users', 'email')],
            'poder' => ['required'],
            'status' => ['required']
        ]);

        $request->merge([
            'password' => Hash::make($request->input('password'))
        ]);

        $create = $request->except(['_token', 'senhaConfirm']);
        $userC = $user->create($create);

        if (!$userC) {
            return back()->withErrors(['Ocorreu um erro ao criar o usuário!']);
        }

        return redirect()->route('page-listAdm');
    }

    public function delete($id)
    {
        $deleteAll = AdmUsers::findOrFail($id);
        $deleteAll->delete();
        if($deleteAll){
            return redirect()->route('page-listAdm');
        }
        return redirect('falha-listAdm')->withErrors('Não foi possível deletar o usuário!'); 
    }

    public function fallback()
    {
        $erro = 'Usuários não encontrados!';
        return view('admin.list.listUserAdm')->with('erro', $erro);
    }
}
