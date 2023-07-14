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
        Schema::create('users_cupom', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 120)->charset('utf8');
            $table->string('codigo', 30)->charset('utf8');
            $table->string('tipo', 30)->charset('utf8');
            $table->string('visibilidade', 30)->charset('utf8');
            $table->foreignId('id_categoria')->nullable();
            $table->foreignId('id_marca')->nullable();
            $table->dateTime('data_expiracao');
            $table->decimal('porcentagem', 10, 2);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_cupom');
    }
};
