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
        Schema::create('adm_marcas', function (Blueprint $table) {
            $table->id('id_marca');
            $table->string('nome', 360)->charset('utf8');
            $table->mediumText('descricao_atividades', 120)->charset('utf8');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adm_marcas');
        
    }
};
