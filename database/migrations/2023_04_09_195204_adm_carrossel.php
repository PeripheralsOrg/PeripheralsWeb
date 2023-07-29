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
        Schema::create('adm_carrossel', function (Blueprint $table) {
            $table->id();
            $table->string('nome_banner', 120)->charset('utf8');
            $table->string('link_carrossel', 160)->charset('utf8');
            $table->decimal('peso', 10, 2);
            $table->string('link_route', 160)->charset('utf8')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adm_carrossel');
    }
};
