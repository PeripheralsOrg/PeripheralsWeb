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
        Schema::create('adm_submenu', function (Blueprint $table) {
            $table->id();
            $table->string('titulo_submenu', 120)->charset('utf8');
            $table->string('link_submenu', 160)->charset('utf8');
            $table->foreignId('id_menu', 160);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adm_submenu');
    }
};
