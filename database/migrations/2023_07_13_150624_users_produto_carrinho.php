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
        Schema::create('users_produto_carrinho', function(Blueprint $table){
            $table->id('id_produto_carrinho');
            $table->integer('quantidade');
            $table->decimal('valor_total', 10, 2);
            $table->decimal('valor_desconto', 10, 2)->nullable();
            $table->timestamps();
            $table->foreignId('id_produto');
            $table->foreignId('id_carrinho');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_produto_carrinho');
    }
};
