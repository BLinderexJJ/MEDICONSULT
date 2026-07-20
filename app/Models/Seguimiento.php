<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    protected $fillable = ['user_id', 'consulta_id', 'estado', 'notas'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function consulta()
    {
        return $this->belongsTo(Consulta::class);
    }
}
