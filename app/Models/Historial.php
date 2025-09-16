<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    use HasFactory;

    protected $table = 'Historial';
    protected $primaryKey = 'id_historial';
    protected $fillable = ['id_paciente', 'id_cita', 'fecha', 'procedimiento_realizado', 'id_doctor', 'diagnostico'];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'id_paciente');
    }

    public function cita()
    {
        return $this->belongsTo(Cita::class, 'id_cita');
    }

    public function medico()
    {
        return $this->belongsTo(Medico::class, 'id_doctor');
    }
}
