<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class LogController extends Controller
{

    public static function writeFile($userName, $mensagem, $area){
        $timeNow = Carbon::now()->timezone('America/Sao_Paulo')->toDateTimeString();
        $formatMessage = '['. $timeNow . '][' . $area . ']['. $userName .'] - ' .$mensagem.  "\n";
        $fileName = public_path('log\\log.txt');
        $openFile = fopen($fileName, 'a');
        $writeFile = fwrite($openFile, $formatMessage);
        fclose($openFile);
    }

    public function readFile(){
        $bytesToRead = 10000000;
        $fileName = public_path('log\\log.txt');
        $openFile = fopen($fileName, 'a+');
        $fileContent = fread($openFile, $bytesToRead);
        return view('admin.list.listLogView', ['fileContent' => $fileContent]);
    }

    public function downloadLog(){
        $fileName = public_path('log\\log.txt');
        return Response::download($fileName);
    }
}
