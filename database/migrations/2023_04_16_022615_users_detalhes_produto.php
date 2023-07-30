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
        Schema::create('users_detalhes_produto', function (Blueprint $table) {
            $table->id('id_detalhes');
            $table->string('cor', 120)->charset('utf8mb4');
            $table->string('peso', 120)->charset('utf8mb4');
            $table->string('material', 120)->charset('utf8mb4');
            $table->string('garantia', 120)->charset('utf8mb4');
            $table->string('codigo', 120)->charset('utf8mb4');
            $table->string('fonte_energia', 120)->charset('utf8mb4')->nullable();
            $table->string('tipo_tela', 120)->charset('utf8mb4')->nullable();
            $table->string('tipo_audio', 120)->charset('utf8mb4')->nullable();
            $table->string('tamanho', 120)->charset('utf8mb4')->nullable();
            $table->string('resolucao', 120)->charset('utf8mb4')->nullable();
            $table->string('tecnologia', 120)->charset('utf8mb4')->nullable();
            $table->string('conexao', 120)->charset('utf8mb4')->nullable();
            $table->string('microfone', 120)->charset('utf8mb4')->nullable();
            $table->string('frequencia', 120)->charset('utf8mb4')->nullable();
            $table->string('dpi', 120)->charset('utf8mb4')->nullable();
            $table->string('tipo_teclado', 120)->charset('utf8mb4')->nullable();
            $table->mediumText('info_adicional', 120)->charset('utf8mb4');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_detalhes_produto');
    }
};
