<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Concepto extends Model
{
    protected $table = 'conceptos';
    protected $fillable = [
        'nombre', 'descripcion', 'monto', 'id_periodicidad', 'estado'
    ];

    public function pagos()
    {
        return $this->hasMany(Pago::class, 'concepto_id');
    }
    public function periodicidad()
    {
        return $this->belongsTo(Periodicidad::class, 'id_periodicidad');
    }
}
