<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Unique;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100); // Nombre: máximo 100 caracteres
            $table->string('last_name', 150); // Apellidos: máximo 150 caracteres
            $table->date('dob'); // Fecha de nacimiento
            $table->string('dni', 9)->unique(); // DNI/NIE: siempre 9 caracteres
            $table->enum('sex', ['hombre', 'mujer']);
            $table->string('address', 255); // Dirección: máximo 255 caracteres
            $table->string('postal_code', 5); // Código Postal en España tiene 5 caracteres
            $table->string('phone', 15); // Teléfono: máximo 15 caracteres (puede incluir prefijo internacional)
            $table->string('phone_emergence', 15)->nullable(); //Contacto de emergencia
            $table->string('email', 191)->unique();
            $table->string('health_card_number', 20)->unique()->nullable(); // Número de tarjeta sanitaria
            $table->string('health_insurance')->nullable(); // Seguro médico
            $table->text('allergies')->nullable(); // Alergias
            $table->text('previous_illnesses')->nullable(); // Enfermedades previas
            $table->text('current_medications')->nullable(); // Medicamentos actuales
            $table->text('medical_notes')->nullable(); // Ovservaciones
            $table->enum('blood_type', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); // Relación opcional
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
