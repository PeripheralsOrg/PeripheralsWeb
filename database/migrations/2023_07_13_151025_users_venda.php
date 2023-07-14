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
        Schema::create('users_venda', function(Blueprint $table){
            $table->id('id_venda');
            $table->decimal('valor_total', 10, 2);
            $table->decimal('frete', 10, 2);
            $table->integer('quantidade_items');
            $table->decimal('valor_desconto_total', 10, 2)->nullable();
            $table->timestamps();
            $table->foreignId('id_venda_status');
            $table->foreignId('id_carrinho');
            $table->foreignId('id_users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_venda');
    }
};
