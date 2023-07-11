<?php

namespace App\Http\Controllers;

use App\Models\Favoritos;
use Illuminate\Http\Request;

class FavoritoController extends Controller
{
    public function all(Request $request)
    {
        $favoritos = Favoritos::all()->where('id_users', $request->session()->get('user')['id'])->toArray();
        if ($favoritos) {
            return view('client.favoritos')->with('favoritos', $favoritos);
        }
        return redirect()->route('falha-listFavoritos');
    }

    public function fallback()
    {
        $erro = 'Nenhum produto favorito encontrado!';
        return view('client.favoritos')->with('erro', $erro);
    }

    public function register(Favoritos $favoritos, Request $request, $idProduto){

        $favoritosC = $favoritos->create([
            'id_produto' => $idProduto,
            'id_users' => $request->session()->get('user')['id']
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
        $deleteAll->delete();
        if ($deleteAll) {
            return redirect()->route('client-favoritos');
        }
        return redirect('falha-listFavoritos')->withErrors('Não foi possível desfavoritar o produto!');
    }
}
