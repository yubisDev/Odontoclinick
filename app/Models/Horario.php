<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $table = 'horarios';
    protected $primaryKey = 'id_horarios';

    /**
     * Indica si el modelo debe ser timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_doctor',
        'dia_semana',
        'hora_inicio',
        'hora_fin',
        'cant_pacientes',
    ];

    /**
     * Get the doctor associated with the schedule.
     */
    public function medico()
    {
        return $this->belongsTo(Medico::class, 'id_doctor');
    }
}
