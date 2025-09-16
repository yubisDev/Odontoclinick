<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // 👇 Le decimos que la tabla real en la BD es 'usuarios'
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false; // porque tu tabla no tiene created_at ni updated_at

    // 👇 Campos que se pueden asignar en masa
    protected $fillable = [
        'nombre_usuario',
        'contraseña',
        'id_rol',
        'estado',
    ];

    // 👇 Si usas autenticación, indícale la columna del password
    protected $hidden = [
        'contraseña',
    ];

    // 👇 Relación: un usuario puede ser un médico
    public function medico()
    {
        return $this->hasOne(Medico::class, 'id_usuario', 'id_usuario');
    }

    // 👇 Relación: un usuario puede ser una secretaria
    public function secretaria()
    {
        return $this->hasOne(Secretaria::class, 'id_usuario', 'id_usuario');
    }

    // 👇 Relación: cada usuario tiene un rol
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol', 'id_rol');
    }

    public function getAuthPassword()
    {
        return $this->contraseña;
    }

}
