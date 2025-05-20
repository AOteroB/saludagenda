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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('last_name', 150);
            $table->string('phone', 15)->nullable();
            $table->string('email', 191)->nullable()->unique();
            $table->string('license_number', 50)->nullable();
            $table->enum('status', ['activo', 'inactivo'])->default('activo');

            // Relación con el modelo de usuario
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Relación con las especialidades
            $table->unsignedBigInteger('specialty_id'); // Clave foránea
            $table->foreign('specialty_id')->references('id')->on('specialties')->onDelete('restrict');

            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
