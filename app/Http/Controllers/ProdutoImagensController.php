<?php

namespace App\Http\Controllers;

use App\Models\ProdutoImagens;
use Illuminate\Http\Request;

class ProdutoImagensController extends Controller
{
    public function insertImage($path, $name, $id)
    {
        $prodImagens = new ProdutoImagens();

        if (is_array($path)) {
            for ($i = 0; $i < count($path); $i++) {
                $imagemC = $prodImagens->create([
                    'nome_img' => $name,
                    'link_img' => $path[$i],
                    'id_produto' => $id,
                ]);

                if (!$imagemC) {
                    return redirect()->back()->withErrors('Ocorreu um erro ao adicionar a imagem ao banco de dados!');
                }
            }

            return $imagemC;
        } else {
            $imagemC = $prodImagens->create([
                'nome_img' => $name,
                'link_img' => $path,
                'id_produto' => $id,
            ]);

            if (!$imagemC) {
                return redirect()->back()->withErrors('Ocorreu um erro ao adicionar a imagem ao banco de dados!');
            }

            return $imagemC;
        }
    }
}
