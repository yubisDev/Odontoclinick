<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pagos';
    protected $primaryKey = 'id_pago';
    public $timestamps = false;
    
    protected $fillable = [
        'id_cita',
        'fecha_pago',
        'monto',
        'metodo_pago',
    ];

    public function cita()
    {
        return $this->belongsTo(Cita::class, 'id_cita', 'id_cita');
    }
}
