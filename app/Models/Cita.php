<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $table = 'citas';
    protected $primaryKey = 'id_cita';
    public $timestamps = false;

    protected $fillable = [
        'id_paciente',
        'fecha_horario',
        'estado',
        'notas',
        'id_doctor',
    ];

    // Relación con paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'id_paciente', 'id_paciente');
    }

    // Relación con médico
    public function medico()
    {
        return $this->belongsTo(Medico::class, 'id_doctor', 'id_doctor');
    }

}
