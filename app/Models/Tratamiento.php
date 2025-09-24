<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    use HasFactory;

    // Nombre exacto de la tabla
    protected $table = 'tratamientos';

    // Clave primaria personalizada
    protected $primaryKey = 'id_tratamiento';

    // Si no usas created_at / updated_at
    public $timestamps = false;

    // Campos permitidos para asignación masiva
    protected $fillable = [
        'nombre_tratamiento',
        'descripcion',
        'costo_tratamiento',
    ];
}
