<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $table = 'inventario';
    protected $primaryKey = 'id_inventario';
    public $timestamps = false; // porque tu tabla no tiene created_at/updated_at

    protected $fillable = [
        'id_producto',
        'cantidad_disponible',
        'stock',
        'fecha_entrada',
        'fecha_salida',
    ];

    // Relación con productos
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }
}
