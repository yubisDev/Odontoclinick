<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $table = 'paciente'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id_paciente';
    public $timestamps = false; // No usamos created_at / updated_at

    protected $fillable = [
        'nombre',
        'apellidos',
        'fecha_nacimiento',
        'correo',
        'direccion',
        'fecha_registro',
        'telefono',
        'id_acompanante',
        'id_usuario',
        'eps',
        'rh',
        'estado',
        
    ];

    // Relación con usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id_usuario');
    }

    // Scope para traer solo los pacientes activos
    public function scopeActivas($query)
    {
        return $query->where('estado', 'activo');
    }

    // Scope para traer solo los pacientes inactivos
    public function scopeInactivas($query)
    {
        return $query->where('estado', 'inactivo');
    }
}
