<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class getProdutoFreteController extends Controller
{
    public function getProdutoFrete($cep){
        $getFrete[] = (new CEPController('40010', $cep, 5))->getInfo();
        $getFrete[] = (new CEPController('04510', $cep, 5))->getInfo();

        try {
            echo json_encode($getFrete, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            echo $e->getMessage();
        }
    }
}
