<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'dni', 'apellido', 'telefono', 'rol',
        'fecha_nacimiento', 'sexo', 'peso', 'altura', 'activo',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'fecha_nacimiento' => 'date',
            'activo' => 'boolean',
            'peso' => 'decimal:2',
            'altura' => 'decimal:2',
        ];
    }

    public function alergias()
    {
        return $this->belongsToMany(AlergiaCatalogo::class, 'user_alergias', 'user_id', 'alergia_id')
            ->withPivot('observacion')->withTimestamps();
    }

    public function enfermedades()
    {
        return $this->belongsToMany(EnfermedadCatalogo::class, 'user_enfermedades', 'user_id', 'enfermedad_id')
            ->withPivot('fecha_diagnostico', 'observacion')->withTimestamps();
    }

    public function situaciones()
    {
        return $this->hasMany(UserSituacion::class);
    }

    public function medicamentos()
    {
        return $this->belongsToMany(MedicamentoCatalogo::class, 'user_medicamentos', 'user_id', 'medicamento_id')
            ->withPivot('dosis', 'frecuencia', 'activo')->withTimestamps();
    }

    public function consultas()
    {
        return $this->hasMany(Consulta::class);
    }

    public function alertas()
    {
        return $this->hasMany(Alerta::class);
    }

    public function seguimientos()
    {
        return $this->hasMany(Seguimiento::class);
    }

    public function esAdmin()
    {
        return $this->rol === 'admin';
    }

    public function esMedico()
    {
        return $this->rol === 'medico';
    }
}
