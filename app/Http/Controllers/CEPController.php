<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CEPController extends Controller
{
    private string $originZipCode = '04576000';

    private int $length = 20;
    private int $height = 20;
    private int $width = 20; //Min 10

    public function __construct(
        private string $code, //41106 - PAC , 40010 - SEDEX
        private string $destinationZipCode,
        private int $weight,
        private array $response = [],

    ) {
        $url = 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx';

        $params = [
            'nCdEmpresa' => '',
            'sDsSenha' => '',
            'sCepOrigem' => $this->originZipCode,
            'sCepDestino' => $this->destinationZipCode,
            'nVlPeso' => $this->weight, //kg
            'nCdFormato' => '1',  //1 para caixa / pacote e 2 para rolo/prisma.
            'nVlComprimento' => $this->length,
            'nVlAltura' => $this->height,
            'nVlLargura' => $this->width,
            'nVlDiametro' => '0',
            'sCdMaoPropria' => 'n',
            'nVlValorDeclarado' => '0',
            'sCdAvisoRecebimento' => 'n',
            'StrRetorno' => 'xml',
            'nCdServico' =>  $this->code,
        ];

        $params = http_build_query($params);

        $curl = curl_init($url . '?' . $params);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($curl);
        $data = simplexml_load_string($data);

        $json = json_encode($data);
        if ($json == 'false') {
            return false;
        } else {
            $array = json_decode($json, TRUE)['cServico'];
        }

        if ($array['Erro'] == "0") {
            $this->response['codigo'] = $array['Codigo'];
            $this->response['value'] = $array['Valor'];
            $this->response['deadline'] = $array['PrazoEntrega'];
        }
    }

    public function getInfo()
    {
        if (!empty($this->response)) {
            return [
                'valor' => $this->response['value'],
                'prazo' => $this->response['deadline']
            ];  
        }else{
            return false;
        }
    }

}

// $getFrete[] = (new CEPController('40010', $_GET['cep'], 5))->getInfo();
// $getFrete[] = (new CEPController('40010', $_GET['cep'], 5))->getInfo();



// try {
//     echo json_encode($getFrete, JSON_THROW_ON_ERROR);
// } catch (\JsonException $e) {
//     echo $e->getMessage();
// }
