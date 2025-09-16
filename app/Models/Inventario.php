<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;

    protected $table = 'Inventario';
    protected $primaryKey = 'id_inventario';
    protected $fillable = ['id_producto', 'cantidad_disponible', 'stock', 'fecha_entrada', 'fecha_salida'];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}
