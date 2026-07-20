<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SintomaCatalogo extends Model
{
    protected $table = 'sintomas_catalogo';
    protected $fillable = ['nombre', 'descripcion', 'categoria'];
}
