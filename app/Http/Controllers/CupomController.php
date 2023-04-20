<?php

namespace App\Http\Controllers;

use App\Models\Cupom;
use Illuminate\Http\Request;

class CupomController extends Controller
{
    public function all()
    {
        $cupons = Cupom::all()->where('status', 1)->toArray();
        if ($cupons) {
            return view('admin.list.listCupons')->with('cupons', $cupons);
        }
        return redirect('falha-listCupons');
    }

    // TODO: #23 Criar coluna para linkar categoria
    public function register(Request $request, Cupom $cupom)
    {
        $validator = $request->validate([
            'nome' => ['required'],
            'codigo' => ['required'],
            'data_expiracao' => ['required'],
            'porcentagem' => ['required'],
            'status' => ['required'],
        ]);
        $request->merge([
            'porcentagem' => floatval($request->input('porcentagem'))
        ]);

        $create = $request->except(['_token']);
        $cupomC = $cupom->create($create);

        if ($cupomC) {
            return redirect()->route('page-listCupons')->withErrors('Cupom criado com sucesso!');
        }

        return back()->withErrors('Houve um erro ao cadastrar o cupom');
    }

    public function fallback()
    {
        $erro = 'Cupons não encontrados!';
        return view('admin.list.listCupons')->with('erro', $erro);
    }

    public function delete($id)
    {
        $deleteAll = Cupom::findOrFail($id);
        $deleteAll->delete();
        if ($deleteAll) {
            return redirect()->route('page-listCupons')->withErrors('Cupom deletado com sucesso');
        }
        return redirect('falha-listCupons')->withErrors('Não foi possível deletar o Cupom!');
    }

    public function getUpdate($id)
    {
        $getCupom = Cupom::all()->where('id', $id)->toArray();
        if ($getCupom) {
            return view('admin.forms.UpdateCupom')->with('getCupom', $getCupom);
        }
        return redirect('falha-listCupons')->withErrors('Não foi possível atualizar o Cupom!');
    }

    public function update(Request $request, $id)
    {
        $validator = $request->validate([
            'nome' => ['required'],
            'codigo' => ['required'],
            'data_expiracao' => ['required'],
            'porcentagem' => ['required'],
            'status' => ['required'],
        ]);

        $request->merge([
            'porcentagem' => floatval($request->input('porcentagem'))
        ]);

        $create = $request->except(['_token', '_method']);

        $updateCupom = (Cupom::all()->where('id', $id)->toQuery())->update($create);

        if ($updateCupom) {
            return redirect()->route('page-listCupons')->withErrors('Cupom atualizado com sucesso!');
        }
        return back()->withErrors('Houve um erro ao atualizar o cupom');
    }
}
