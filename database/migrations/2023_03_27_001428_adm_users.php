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
        Schema::create('adm_users', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 120);
            $table->string('email', 160)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('senha', 256);
            $table->tinyInteger('poder');
            $table->tinyInteger('status')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adm_users');
    }
};
