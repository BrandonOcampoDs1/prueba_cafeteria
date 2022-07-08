<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'id_producto',
        'kv_nombre_producto',
        'kv_referencia',
        'kv_cantidad_vendida',
        'kv_fecha_venta',
    ];
}
