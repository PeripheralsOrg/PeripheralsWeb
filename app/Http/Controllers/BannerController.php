<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class BannerController extends Controller
{

    //Tamanho máximo de arquivo: 5 Megabytes
    public const MAXIMUM_SIZE = 5000000;

    public function register(Request $request){
        $validator = $request->validate([
            'nome_banner' => ['required'],
            'link_route' => ['required'],
            'status' => ['required'],
        ]);

        $image = $request->file('link_img');

        if($image->getMimeType() == 'image/png' || 'image/jpeg' || 'image/webp' || 'image/jpg'){
            if(!$image->isValid()){
                return back()->withErrors('O arquivo não é válido');
            }

            if($image->getSize() > BannerController::MAXIMUM_SIZE){
                return back()->withErrors('O arquivo não é grande demais');
            }
            // Validação
        }


        return back()->withErrors('Houve um erro ao cadastro o banner');
    }
}
