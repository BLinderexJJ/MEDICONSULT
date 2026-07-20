<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medicamentos_catalogo', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('principio_activo', 100);
            $table->text('indicaciones')->nullable();
            $table->text('contraindicaciones')->nullable();
            $table->text('efectos_secundarios')->nullable();
            $table->text('dosis_referencia')->nullable();
            $table->text('interacciones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medicamentos_catalogo');
    }
};
