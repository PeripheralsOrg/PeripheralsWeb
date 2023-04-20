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
        Schema::create('users_produtos', function (Blueprint $table) {
            $table->id('id_produtos');
            $table->string('nome', 320)->charset('utf8');
            $table->string('marca', 120)->charset('utf8');
            $table->string('modelo', 120)->charset('utf8');
            $table->decimal('preco', 10, 2);
            $table->tinyInteger('is_promocao');
            $table->mediumText('descricao')->charset('utf8');
            $table->foreignId('id_inventario');
            $table->foreignId('id_detalhes');
            $table->foreignId('id_categoria');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_produtos');
    }
};
