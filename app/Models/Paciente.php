<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table = 'paciente';
    protected $primaryKey = 'id_paciente';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'apellidos',
        'fecha_nacimiento',
        'correo',
        'direccion',
        'fecha_registro',
        'telefono',
        'id_usuario',
        'eps',
        'rh',
        'estado'
    ];

    // 🔹 Relación con Usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id_usuario');
    }

    // 🔹 Relación con Citas
    public function citas()
    {
        return $this->hasMany(Cita::class, 'id_paciente', 'id_paciente');
    }

    // 🔹 Relación con Historial Médico
    public function historiales()
    {
        return $this->hasMany(Historial::class, 'id_paciente', 'id_paciente');
    }
}
