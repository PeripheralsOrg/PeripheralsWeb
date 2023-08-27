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
        Schema::create('temporary_venda', function (Blueprint $table) {
            $table->id('id_temporary_venda');
            $table->decimal('valor_total', 10, 2);
            $table->decimal('frete', 10, 2);
            $table->integer('prazo');
            $table->integer('quantidade_items');
            $table->foreignId('id_users');
            $table->foreignId('id_carrinho');
            $table->foreignId('id_endereco');
            $table->decimal('desconto_total', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temporary_venda');
    }
};
