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
        Schema::create('users_carrinho', function(Blueprint $table){
            $table->id('id_carrinho');
            $table->decimal('valor_total', 10, 2);
            $table->integer('quant_items');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->foreignId('id_users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_carrinho');
        
    }
};
