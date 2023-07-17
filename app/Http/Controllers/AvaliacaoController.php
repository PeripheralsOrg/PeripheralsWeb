<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use App\Models\ProdutoView;
use Illuminate\Http\Request;
use Controller\ClientProdutoController;

class AvaliacaoController extends Controller
{
    public function getProdutoAvaliar($idProduto)
    {
        $produto = ProdutoView::all()->where('id_produtos', $idProduto)->toArray();
        if ($produto) {
            return view('client.avaliar-produto')->with([
                'produto' => $produto,
                'idProduto' => $idProduto
            ]);
        }
        return redirect()->back()->withErrors('Ocorreu um erro ao avaliar o produto!');
    }

    public function getFeedbacks()
    {
        $avaliacoes = Avaliacao::all()->toArray();
        if (count($avaliacoes) > 0) {
            return view('admin.list.listComentarios')->with([
                'avaliacoes' => $avaliacoes,
            ]);
        }
        return redirect()->back()->withErrors('Ocorreu um erro ao avaliar o produto!');
    }


    public function register(Request $request)
    {
        $request->validate([
            'titulo' => ['required'],
            'comentario' => ['required'],
            'avaliacao' => ['required'],
        ]);

        $avaliacao = new Avaliacao();

        $idProduto = $request->input('idProduto');
        if (empty($request->input('idProduto'))) {
            return redirect()->back()->withErrors('Não foi possível avaliar o produto. Tente novamente em instantes!');
        }

        $idProduto = $request->input('idProduto');

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

        return redirect()->route('client-info')->withErrors('Produto avaliado com sucesso!');
    }

    public function getComentarioAdmin($idComentario){
        $getComment = array_values(Avaliacao::all()->where('id_comentario', $idComentario)->toArray());
        $produto = ProdutoView::all()->where('id_produtos', $getComment[0]['id_produto'])->toArray();
        if ($getComment) {
            return view('admin.details.detailsComentario')->with([
                'produto' => $produto,
                'getComment' => $getComment
            ]);
        }
        return redirect()->back()->withErrors('Ocorreu um erro ao avaliar o produto!');
    }

    public function likeAvaliacao($idComentario)
    {
        $avaliacao = Avaliacao::all()->where('id_comentario', $idComentario)->toQuery();

        $avaliacaoC = $avaliacao->update([
            'like' => intval($avaliacao->getModel()->getAttribute('like')) + 1
        ]);

        return $avaliacaoC;
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

    public function getCountAvaliacaoProduto($idProduto)
    {
        return Avaliacao::all()->where('id_produto', $idProduto)->count();
    }

    public function getMediaAvaliacaoProduto($idProduto)
    {
        $avaliacaoCount = Avaliacao::all()->where('id_produto', $idProduto)->count();
        if ($avaliacaoCount !== 0) {
            return round(Avaliacao::all()->where('id_produto', $idProduto)->sum('avaliacao') / $avaliacaoCount, 1);
        } else {
            return 0;
        }
    }

    public function getAllAvaliacaoProduto($idProduto)
    {
        return array_values(Avaliacao::all()->where('id_produto', $idProduto)->toArray());
    }

    public function getPercentStar($idProduto, $valorStar)
    {
        $star = (Avaliacao::all()->where('id_produto', $idProduto)->whereIn('avaliacao', $valorStar)->count());
        $total = (new AvaliacaoController())->getCountAvaliacaoProduto($idProduto);
        if ($total !== 0) {
            $percent = $star / $total * 100;
            return round($percent);
        } else {
            return 0;
        }
    }


    public function dateFilterAdmin(Request $request)
    {
        $avaliacoes = Avaliacao::all()->whereBetween('created_at', [$request->input('dateFrom'), $request->input('dateTo')])->toArray();

        if ($avaliacoes) {
            return view('admin.list.listComentarios')->with('avaliacoes', $avaliacoes);
        }
        return redirect()->route('fallback-listComentario');
    }

    public function fallbackAdmin(){
        $erro = 'Nenhum comentário encontrado!';
        return view('admin.list.listComentarios')->with('erro', $erro);

    }
}
