<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function all(){
        $produtos = Produto::all()->where('status', 1)->toArray();
        if ($produtos) {
            return view('admin.list.listProdutos')->with('produtos', $produtos);
        }
        return redirect()->route('falha-listProdutos');
    }

    public function fallback(){
        $erro = 'Produtos não encontrados!';
        return view('admin.list.listProdutos')->with('erro', $erro);
    }
}
