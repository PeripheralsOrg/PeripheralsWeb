<?php

namespace App\Http\Controllers;

use App\Models\ProdutoInventario;
use Illuminate\Http\Request;

class ProdutoinventarioController extends Controller
{
    public function insertInventario($quantidade, $status){
        $inventario = new ProdutoInventario();
        $inventarioC = $inventario->create([
            'quantidade' => $quantidade,
            'status' => $status
        ])->id;

        if(!$inventarioC){
            return redirect()->back()->withErrors('Ocorreu um erro ao adicionar as informações do produto!');
        }

        return $inventarioC;
    }
}
