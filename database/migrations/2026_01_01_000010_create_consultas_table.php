<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('tipo', 20)->default('libre');
            $table->text('sintoma_principal')->nullable();
            $table->text('descripcion')->nullable();
            $table->string('nivel_riesgo', 10)->nullable();
            $table->text('posibles_causas')->nullable();
            $table->text('recomendaciones_generales')->nullable();
            $table->text('diagnostico_ia')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consultas');
    }
};
