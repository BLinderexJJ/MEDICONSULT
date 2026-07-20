<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnfermedadCatalogo extends Model
{
    protected $table = 'enfermedades_catalogo';
    protected $fillable = ['nombre', 'descripcion', 'sintomas', 'prevencion', 'cuando_acudir'];

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'user_enfermedades', 'enfermedad_id', 'user_id')
            ->withPivot('fecha_diagnostico', 'observacion')->withTimestamps();
    }
}
