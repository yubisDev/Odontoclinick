<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    protected $table = 'historial';
    protected $primaryKey = 'id_historial';
    public $timestamps = false;

    protected $fillable = [
        'id_paciente',
        'id_cita',
        'fecha',
        'procedimiento_realizado',
        'id_doctor',
        'diagnostico'
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'id_paciente', 'id_paciente');
    }

    public function cita()
    {
        return $this->belongsTo(Cita::class, 'id_cita', 'id_cita');
    }

}
