<?php

namespace App\Http\Controllers;

use App\Models\ProdutoImagens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdutoImagensController extends Controller
{
    public function insertImage($path, $name, $id, $size, $boolean = 0)
    {
        $prodImagens = new ProdutoImagens();

        if (is_array($path)) {
            for ($i = 0; $i < count($path); $i++) {

                $imagemC = $prodImagens->create([
                    'nome_img' => $name,
                    'link_img' => $path[$i],
                    'peso' => $size[$i],
                    'img_principal' => $boolean,
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
                'peso' => $size,
                'img_principal' => $boolean,
                'id_produto' => $id,
            ]);

            if (!$imagemC) {
                return redirect()->back()->withErrors('Ocorreu um erro ao adicionar a imagem ao banco de dados!');
            }

            return $imagemC;
        }
    }

    public function deleteImage($imagesDelete){
        if (!empty($imagesDelete)) {
            $arrayDeleteImgs = str_split(str_replace(',', '', $imagesDelete), 2);
            for ($i = 0; $i < count($arrayDeleteImgs); $i++) {
                $imgGet = ProdutoImagens::all()->where('id_produto_imgs', $arrayDeleteImgs[$i])->toQuery();
                $deleteImage = Storage::delete($imgGet->getModel()->getAttributes()['link_img']);
                $imgGet->delete();
            }
        }
    }
}
