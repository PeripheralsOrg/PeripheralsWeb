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
        Schema::create('users_produto_imgs', function (Blueprint $table) {
            $table->id('id_produto_imgs');
            $table->string('nome_img', 120)->charset('utf8');
            $table->string('link_img', 320)->charset('utf8');
            $table->decimal('peso', 10, 2);
            $table->foreignId('id_produto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_produto_imgs');
    }
};
