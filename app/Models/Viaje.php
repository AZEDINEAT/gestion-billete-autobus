<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Viaje extends Model
{
    use HasFactory;
    
    protected $table = 'viajes';

    protected $fillable = [
        'origen',
        'destino',
        'numero_bus',
        'num_asientos_dispo',
        'precio',
        'fecha_viaje',
        'hora_viaje',
        'hora_llegada',
        'duracion',
    ];
}
