<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pagos';
    protected $fillable = [
        'id_socio', 'id_concepto', 'fecha_pago', 'monto_pagado', 'id_estado', 'observacion'
    ];

    public function socio()
    {
        return $this->belongsTo(Socio::class, 'id_socio');
    }

    public function concepto()
    {
        return $this->belongsTo(Concepto::class, 'id_concepto');
    }
    public function estadoPago()
    {
        return $this->belongsTo(EstadoPago::class, 'id_estado');
    }
}
