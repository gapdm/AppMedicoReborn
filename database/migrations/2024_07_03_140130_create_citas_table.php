<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained('pacientes')->onDelete('cascade');
            $table->decimal('talla', 5, 2)->default(0);
            $table->decimal('temperatura', 4, 2)->default(0);
            $table->unsignedTinyInteger('saturacion_oxigeno')->default(0);
            $table->unsignedTinyInteger('frecuencia_cardiaca')->default(0);
            $table->decimal('peso', 5, 2)->default(0);
            $table->text('motivo_consulta')->nullable();
            $table->text('notas_padecimiento')->nullable();
            $table->foreignId('medico_id')->constrained('users')->onDelete('cascade');
            $table->unsignedTinyInteger('estado')->default(0); // 0 = Asignada, 1 = Confirmada, 2 = Terminada
            $table->dateTime('fecha');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
