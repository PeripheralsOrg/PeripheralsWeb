<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CEPController extends Controller
{
    private string $originZipCode = '04576000';

    private int $length = 20;
    private int $height = 20;
    private int $width = 20; //Min 10
    private string $token = 'a168fc2b918340642281d1cf5550c18a62bf8472';

    public function __construct(
        private string $code, //41106 - PAC , 40010 - SEDEX
        private string $destinationZipCode,
        private int $weight,
        private array $response = [],

    ) {


        $cepOrigem = $this->originZipCode;
        $pesoEnc = $this->weight;
        $alturaEnc = $this->height;
        $larguraEnc = $this->length;
        $compEnc = $this->width;
        $tokenApp = $this->token;
        $cepDestino = $this->destinationZipCode;

        $jsonUrl = "https://cepcerto.com/ws/json-frete/$cepOrigem/$cepDestino/$pesoEnc/$alturaEnc/$larguraEnc/$compEnc/$tokenApp";


        $jsonContent = file_get_contents($jsonUrl);

        if ($jsonContent !== false) {
            // Parse the JSON content
            $jsonData = json_decode($jsonContent, true);
            // dd($jsonData);
// dd($jsonData);
            $this->response['value'] = $jsonData['valorsedex'];
            $this->response['deadline'] = $jsonData['prazosedex'];

        } else {
            return false;
        }
    }

    public function getInfo()
    {
        if (!empty($this->response)) {
            return [
                'valor' => $this->response['value'],
                'prazo' => $this->response['deadline']
            ];
        } else {
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
