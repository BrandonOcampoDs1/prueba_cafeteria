<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'kp_nombre_producto',
        'kp_referencia',
        'kp_precio',
        'kp_peso',
        'kp_categoria',
        'kp_stock',
        'kp_fecha_creación'
    ];
}
