<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $fillable = [
        'user_id', 'tipo', 'sintoma_principal', 'descripcion',
        'nivel_riesgo', 'posibles_causas', 'recomendaciones_generales', 'diagnostico_ia'
    ];

    protected $table = 'consultas';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sintomas()
    {
        return $this->hasMany(ConsultaSintoma::class);
    }
}
