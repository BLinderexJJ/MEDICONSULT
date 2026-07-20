<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlergiaCatalogo extends Model
{
    protected $table = 'alergias_catalogo';
    protected $fillable = ['nombre', 'descripcion', 'tipo'];

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'user_alergias', 'alergia_id', 'user_id')
            ->withPivot('observacion')->withTimestamps();
    }
}
