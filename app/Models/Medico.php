<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;

    protected $table = 'medicos'; // o 'medicos' según tu BD
    protected $primaryKey = 'id_doctor';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'apellidos',
        'telefono',
        'correo',
        'estado',
        'id_usuario',
        'id_especialidad',
    ];

    // Relación con usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id_usuario');
    }

    // Scope para traer solo los activos
    public function scopeActivos($query)
    {
        return $query->where('estado', 'activo'); // asegúrate que el campo se llame así
    }

    // Relación con especialidad
    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class, 'id_especialidad', 'id_especialidad');
    }

    // Relación con citas
    public function citas()
    {
        return $this->hasMany(Cita::class, 'id_doctor', 'id_doctor');
    }

    public function getRouteKeyName()
{
    return 'id_doctor';
}

}
