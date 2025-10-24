<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Concepto extends Model
{
    protected $table = 'conceptos';
    protected $fillable = [
        'nombre', 'descripcion', 'monto', 'id_periodicidad', 'estado', 'id_tipo_moneda'
    ];

    public function pagos()
    {
        return $this->hasMany(Pago::class, 'concepto_id');
    }
    public function periodicidad()
    {
        return $this->belongsTo(Periodicidad::class, 'id_periodicidad');
    }
    public function tipo_moneda()
    {
        return $this->belongsTo(TipoMoneda::class, 'id_tipo_moneda');
    }
}
