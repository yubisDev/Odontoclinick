<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    use HasFactory;

    protected $table = 'especialidad'; 
    protected $primaryKey = 'id_especialidad';
    public $timestamps = false;

    protected $fillable = [
        'nombre_especialidad'
    ];

    public function medicos()
    {
        return $this->hasMany(Medico::class, 'id_especialidad', 'id_especialidad');
    }
}
