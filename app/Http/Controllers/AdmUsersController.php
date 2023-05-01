<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdmUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class AdmUsersController extends Controller
{
    public function all(){
        $users = AdmUsers::all()->where('status', 1)->toArray();
        if($users){
           return view('admin.list.listUserAdm')->with('users', $users); 
        }
        return redirect()->route('falha-listAdm'); 
    }

    public function search(Request $request)
    {
        if (empty($request->input('search'))) {
            return redirect()->route('page-listAdm')->withErrors('Por favor, preencha o campo de pesquisa!');
        }

        $search = $request->input('search');
        $users = json_decode(json_encode(DB::table('adm_users')->where('name', 'LIKE', '%' . $search . '%')
            ->Orwhere('email', 'LIKE', '%' . $search . '%')->get()->toArray()), true);

        if ($users) {
            return view('admin.list.listUserAdm')->with('users', $users);
        }
        return redirect()->route('falha-listAdm');
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

    public function getUpdate($id)
    {
        $getAdm = AdmUsers::all()->where('id', $id)->toArray();
        if ($getAdm) {
            return view('admin.forms.UpdateAdm')->with('getAdm', $getAdm);
        }
        return redirect('falha-listAdm')->withErrors('Não foi possível atualizar o usuário!'); 
    }

    public function update(Request $request, $id)
    {
        $validator = $request->validate([
            'name' => ['required', 'max:255'],
            'password' => [
                'required', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,30}$/',
                'same:senhaConfirm'
            ],
            'email' => ['required'],
            'poder' => ['required'],
            'status' => ['required']
        ]);


        $getAdm = AdmUsers::all()->where('id', $id)->toArray();
        $searchEmail = AdmUsers::all()->where('email', $getAdm[1]['email'])->toArray();

        if (empty($getAdm)) {
            return redirect('falha-listAdm');
        }

        if(count($searchEmail) > 1 && $getAdm[1]['email'] !== $request->input('email')){
            return back()->withErrors('Esse email já está em uso!');
        }

        $request->merge([
            'password' => Hash::make($request->input('password'))
        ]);

        $values = $request->except('_token', '_method', 'senhaConfirm');
        $updateAdm = (AdmUsers::all()->where('id', $id)->toQuery())->update($values);

        if($updateAdm){
            return redirect()->route('page-listAdm');
        }

        return back()->withErrors('Ocorreu um erro ao atualizar o usuário!');
    }
}
