<?php

namespace App\Http\Controllers;

use App\Models\DetalhesProduto;
use Illuminate\Http\Request;

class DetalhesProdutoController extends Controller
{
    public function insertDetalhes($detalhes){
        $modelDetalhes = new DetalhesProduto();
        $detalhesC = $modelDetalhes->create([
            'fonte_energia' => $detalhes['fonte_energia'],
            'codigo' => $detalhes['codigo'],
            'tipo_tela' => $detalhes['tipo_tela'],
            'tipo_audio' => $detalhes['tipo_audio'][0] !== 0 ? $detalhes['tipo_audio'][0] : $detalhes['tipo_audio'][1],
            'tamanho' => $detalhes['tamanho'],
            'resolucao' => $detalhes['resolucao'],
            'tecnologia' => $detalhes['tecnologia'],
            'conexao' => $detalhes['conexao'],
            'microfone' => $detalhes['microfone'],
            'frequencia' => $detalhes['frequencia'],
            'dpi' => $detalhes['dpi'],
            'cor' => $detalhes['cor'],
            'material' => $detalhes['material'],
            'peso' => $detalhes['peso'],
            'tipo_teclado' => $detalhes['tipo_teclado'],
            'garantia' => $detalhes['garantia'],
            'info_adicional' => $detalhes['info_adicional'],
            'status' => $detalhes['status']
        ])->id_detalhes;
        
        if(!$detalhesC){
            return redirect()->back()->withErrors('Ocorreu um erro ao adicionar as informações do produto!');
        }

        return $detalhesC;

    }

    public function updateDetalhes($detalhes, $id)
    {
        $modelDetalhes = (new DetalhesProduto())->all()->where('id_detalhes', $id)->toQuery();

        $detalhesC = $modelDetalhes->update($detalhes);

        if (!$detalhesC) {
            return redirect()->back()->withErrors('Ocorreu um erro ao atualizar as informações do produto!');
        }

        return $detalhesC;
    }
}
