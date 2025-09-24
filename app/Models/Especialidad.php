<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla, ya que no sigue la convención de pluralización de Laravel.
    protected $table = 'especialidad';

    // Especifica la clave primaria, ya que no se llama 'id' por defecto.
    protected $primaryKey = 'id_especialidad';

    // Los campos que se pueden asignar masivamente
    protected $fillable = ['nombre_especialidad'];

    // Si tu tabla no usa timestamps (created_at y updated_at), desactívalos.
    public $timestamps = false;
}