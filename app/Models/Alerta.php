<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alerta extends Model
{
    protected $fillable = ['user_id', 'titulo', 'descripcion', 'tipo', 'categoria', 'leida'];
    protected $casts = ['leida' => 'boolean'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
