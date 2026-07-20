<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicamentoCatalogo extends Model
{
    protected $table = 'medicamentos_catalogo';
    protected $fillable = [
        'nombre', 'principio_activo', 'categoria_terapeutica', 'presentacion', 'concentracion',
        'edad_minima_meses', 'dosis', 'indicaciones', 'contraindicaciones', 'efectos_secundarios',
        'dosis_referencia', 'interacciones', 'requiere_receta', 'embarazo', 'lactancia',
        'insuficiencia_renal', 'insuficiencia_hepatica', 'alergias_relacionadas', 'estado'
    ];

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'user_medicamentos', 'medicamento_id', 'user_id')
            ->withPivot('dosis', 'frecuencia', 'activo')->withTimestamps();
    }
}
