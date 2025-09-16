<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $table = 'Horarios';
    protected $primaryKey = 'id_horarios';
    protected $fillable = ['hora_inicio', 'hora_fin', 'cant_pacientes', 'id_medico_fk'];

    public function medico()
    {
        return $this->belongsTo(Medico::class, 'id_medico_fk');
    }

    public function citas()
    {
        return $this->hasMany(Cita::class, 'id_horario');
    }
}
