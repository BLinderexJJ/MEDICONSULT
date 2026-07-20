<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSituacion extends Model
{
    protected $table = 'user_situaciones';
    protected $fillable = ['user_id', 'situacion', 'activa', 'fecha_inicio', 'fecha_fin'];
    protected $casts = ['activa' => 'boolean', 'fecha_inicio' => 'date', 'fecha_fin' => 'date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
