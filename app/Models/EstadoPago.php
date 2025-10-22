<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoPago extends Model
{
    protected $table = 'estados_pago';
    protected $fillable = [
        'estado'
    ];
}
