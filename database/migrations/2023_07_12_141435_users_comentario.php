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
        Schema::create('users_comentario', function (Blueprint $table) {
            $table->id('id_comentario');
            $table->string('titulo', 160)->charset('utf8mb4');
            $table->integer('avaliacao');
            $table->mediumText('comentario')->charset('utf8mb4');
            $table->integer('likes')->default(0);
            $table->foreignId('id_users');
            $table->foreignId('id_produto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_comentarios');
        
    }
};
