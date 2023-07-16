<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use Illuminate\Http\Request;

class AvaliacaoController extends Controller
{
    public function getComentariosClient(Request $request)
    {
        $avaliacao = Avaliacao::all()->where('id_users', $request->session()->get('user')['id'])->toArray();
        if ($avaliacao) {
            return view('client.minhas-avaliacoes')->with('avaliacao', $avaliacao);
        }
        return redirect()->route('falha-listAvaliacoes');
    }


    public function getComentariosClientProduto(Request $request, $idProduto)
    {
        $avaliacao = Avaliacao::all()->where('id_users', $request->session()->get('user')['id'])
            ->where('id_produto', $idProduto)->toArray();
        if ($avaliacao) {
            return view('client.meus-pedidos')->with('avaliacao', $avaliacao);
        }
        return redirect()->route('falha-listAvaliacoes');
    }

    public function register(Request $request, Avaliacao $avaliacao, $idProduto)
    {
        $request->validate([
            'titulo' => ['required'],
            'comentario' => ['required'],
            'avaliacao' => ['required'],
        ]);

        if (empty($idProduto)) {
            return redirect()->back()->withErrors('Não foi possível avaliar o produto. Tente novamente em instantes!');
        }

        $avaliacaoC = $avaliacao->create([
            'id_produto' => $idProduto,
            'id_users' => $request->session()->get('user')['id'],
            'titulo' => $request->input('titulo'),
            'comentario' => $request->input('comentario'),
            'avaliacao' => $request->input('avaliacao'),
        ]);

        if (!$avaliacaoC) {
            return back()->withErrors(['Ocorreu um erro ao avaliar o produto!']);
        }

        // return redirect()->route();

    }


    public function delete(Request $request, $idProduto)
    {
        $getUser = $request->session()->get('user')['id'];
        $deleteAll = Avaliacao::all()->where('id_produto', $idProduto)->where('id_users', $getUser)->toQuery();
        $deleteAll->delete();
        if ($deleteAll) {
            // return redirect()->route();
        }
        return redirect('falha-listAvaliacoes')->withErrors('Não foi possível apagar a avaliação o produto!');
    }
}
