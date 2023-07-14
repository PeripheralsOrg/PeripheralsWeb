<?php

namespace App\Http\Controllers;

use App\Models\Favoritos;
use Illuminate\Http\Request;
use App\Models\ProdutoView;

class FavoritoController extends Controller
{
    public function allFavoritos(Request $request)
    {
        $favoritosSearch = Favoritos::all()->where('id_users', $request->session()->get('user')['id'])->toArray();
        $getAllProd = ProdutoView::all()->where('status', 1)->take(6)->toArray();

        $arrayProd = [];
        foreach ($favoritosSearch as $t) {
            $produtoGet = ProdutoView::all()->where('id_produtos', $t['id_produto'])->toArray();
            array_push($arrayProd, $produtoGet);
        }

        function array_flatten($array)
        {
            return array_reduce($array, function ($carry, $item) {
                if (is_array($item)) {
                    return array_merge_recursive($carry, ($item));
                } else {
                    $carry[] = $item;
                    return $carry;
                }
            }, []);
        }

        $favoritos = array_flatten($arrayProd);

        if ($favoritos) {
            return view('client.favoritos')->with([
                'getAllProd' => $getAllProd,
                'favoritos' => $favoritos
            ]);
        }
        return redirect()->route('falha-listFavoritos');
    }

    public function fallback()
    {
        $getAllProd = ProdutoView::all()->where('status', 1)->take(6)->toArray();
        $erro = 'Nenhum item favoritado encontrado!';
        return view('client.favoritos')->with([
            'erro' => $erro,
            'getAllProd' => $getAllProd
        ]);
    }

    public function register(Favoritos $favoritos, Request $request, $idProduto)
    {

        $idUser = $request->session()->get('user')['id'];
        $checkExist = $favoritos->all()->where('id_produto', $idProduto)->where('id_users', $idUser)->toArray();

        if (count($checkExist) > 0) {
            return redirect()->route('desfavoritar-produto', $idProduto);
        }

        $favoritosC = $favoritos->create([
            'id_produto' => $idProduto,
            'id_users' => $idUser
        ]);

        if (!$favoritosC) {
            return back()->withErrors(['Ocorreu um erro ao favoritar o produto!']);
        }

        return redirect()->route('client-favoritos');
    }

    public function delete(Request $request, $idProduto)
    {
        $getUser = $request->session()->get('user')['id'];
        $deleteAll = Favoritos::all()->where('id_produto', $idProduto)->where('id_users', $getUser)->toQuery();
        $deleteAll->getModel()->delete();
        if ($deleteAll) {
            return redirect()->route('client-favoritos')->withErrors('O item foi retirado da sua lista de favoritos!');
        }
        return redirect('falha-listFavoritos')->withErrors('Não foi possível desfavoritar o produto!');
    }
}
