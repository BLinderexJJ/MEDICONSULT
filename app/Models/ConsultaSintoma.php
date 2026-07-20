<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultaSintoma extends Model
{
    protected $table = 'consulta_sintomas';
    protected $fillable = ['consulta_id', 'sintoma_id', 'nombre_sintoma', 'intensidad', 'duracion_dias'];

    public function consulta()
    {
        return $this->belongsTo(Consulta::class);
    }

    public function sintoma()
    {
        return $this->belongsTo(SintomaCatalogo::class, 'sintoma_id');
    }
}
