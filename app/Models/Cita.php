<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $table = 'citas';          // nombre de la tabla
    protected $primaryKey = 'id_cita';   // clave primaria
    public $timestamps = false;          // no hay created_at ni updated_at

    protected $fillable = [
        'id_paciente',
        'id_horario',
        'fecha_horario',
        'estado',
        'notas',
        'id_doctor',
    ];

    // Relación con Paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'id_paciente', 'id_paciente');
    }

    // Relación con Médico (doctor)
    public function doctor()
    {
        return $this->belongsTo(Medico::class, 'id_doctor', 'id_medico');
    }

    // Si tienes horario como modelo aparte, también puedes relacionarlo
    // public function horario()
    // {
    //     return $this->belongsTo(Horario::class, 'id_horario', 'id_horario');
    // }
}
