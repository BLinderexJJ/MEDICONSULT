<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consulta_sintomas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('consulta_id')->constrained()->onDelete('cascade');
            $table->foreignId('sintoma_id')->nullable()->constrained('sintomas_catalogo')->onDelete('set null');
            $table->string('nombre_sintoma', 100);
            $table->string('intensidad', 20)->nullable();
            $table->integer('duracion_dias')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consulta_sintomas');
    }
};
