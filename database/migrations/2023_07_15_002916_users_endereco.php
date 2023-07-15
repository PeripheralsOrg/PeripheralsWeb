<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users_endereco', function(Blueprint $table){
            $table->id('id_endereco');
            $table->string('tipo_logradouro', 120);
            $table->string('logradouro', 320);
            $table->string('bairro', 255);
            $table->string('numero', 20);
            $table->string('complemento', 100)->nullable();
            $table->string('cep', 20);
            $table->string('ponto_ref', 255);
            $table->string('estado', 120);
            $table->string('cidade', 120);
            $table->tinyInteger('status');
            $table->foreignId('id_users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_endereco');
    }
};
