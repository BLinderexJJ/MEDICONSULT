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
        Schema::table('medicamentos_catalogo', function (Blueprint $table) {
            $table->string('categoria_terapeutica', 100)->nullable()->after('principio_activo');
            $table->string('presentacion', 50)->nullable()->after('categoria_terapeutica');
            $table->string('concentracion', 50)->nullable()->after('presentacion');
            $table->integer('edad_minima_meses')->nullable()->after('concentracion');
            $table->string('dosis', 200)->nullable()->after('edad_minima_meses');
            $table->boolean('requiere_receta')->default(false)->after('dosis_referencia');
            $table->string('embarazo', 20)->nullable()->after('requiere_receta');
            $table->string('lactancia', 20)->nullable()->after('embarazo');
            $table->string('insuficiencia_renal', 100)->nullable()->after('lactancia');
            $table->string('insuficiencia_hepatica', 100)->nullable()->after('insuficiencia_renal');
            $table->string('alergias_relacionadas', 200)->nullable()->after('insuficiencia_hepatica');
            $table->string('estado', 20)->default('OTC')->after('alergias_relacionadas');
        });
    }

    public function down(): void
    {
        Schema::table('medicamentos_catalogo', function (Blueprint $table) {
            $table->dropColumn([
                'categoria_terapeutica', 'presentacion', 'concentracion',
                'edad_minima_meses', 'dosis', 'requiere_receta', 'embarazo',
                'lactancia', 'insuficiencia_renal', 'insuficiencia_hepatica',
                'alergias_relacionadas', 'estado'
            ]);
        });
    }
};
