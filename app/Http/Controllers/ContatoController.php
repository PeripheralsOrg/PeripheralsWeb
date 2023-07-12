<?php

namespace App\Http\Controllers;

use App\Mail\Contato;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContatoController extends Controller
{
    public function sendMessage(Request $request){

        $request->validate([
            'name' => ['required'],
            'lastname' => ['required'],
            'email' => ['required', 'email'],
            'message' => ['required'],
            'assunto' => ['required'],
        ]);


        try{
            $emailSend = Mail::to(env('MAIL_USERNAME'))->send(new Contato(
                $request->input('email'),
                $request->input('name'),
                $request->input('lastname'),
                $request->input('assunto'),
                $request->input('message')
            ));
        }catch(Exception $e){
            return back()->withErrors("Erro ao enviar o email: $e");
        }
        

        return back()->withErrors('Email enviado com sucesso!');
    }
}
