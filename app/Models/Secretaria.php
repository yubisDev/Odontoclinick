<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Medico;

class Secretaria extends Model
{
    use HasFactory;

    protected $table = 'secretaria'; // Nombre de la tabla
    protected $primaryKey = 'id_secretaria';
    public $timestamps = false; // Si no tienes created_at / updated_at

    protected $fillable = [
        'nombre',
        'apellidos',
        'telefono',
        'fecha_ingreso',
        'id_usuario',
        'estado',
        'correo',
    ];

    // Relación con usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id_usuario');
    }

    // Scope para traer solo las activas
    public function scopeActivas($query)
    {
        return $query->where('estado', 'activo');
    }

    // Scope para traer solo las inactivas
    public function scopeInactivas($query)
    {
        return $query->where('estado', 'inactivo');
    }

    /**
     * Cambiar el estado de la secretaria a inactiva
     */
    public function inactivar()
    {
        $this->estado = 'inactivo';
        $this->save();
    }

    /**
     * Cambiar el estado de la secretaria a activa
     */
    public function reactivar()
    {
        $this->estado = 'activo';
        $this->save();
    }
}
