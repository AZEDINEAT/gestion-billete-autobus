<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservacion extends Model
{
    use HasFactory;

    protected $table = 'reservaciones';

    protected $fillable = [
    'nombre',
    'DNI',
    'correo_electronico',
    'direccion',
    'ciudad',
    'codigo_postal',
    'viaje_id'
    ];

    public function viaje()
    {
        return $this->belongsTo('App\Models\Viaje', 'viaje_id', 'id');
    }

}
