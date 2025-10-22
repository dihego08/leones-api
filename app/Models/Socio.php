<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Socio extends Model
{
    protected $table = 'socios';
    protected $fillable = [
        'nombres', 'apellidos', 'dni', 'telefono', 'direccion', 'estado'
    ];

    public function pagos()
    {
        return $this->hasMany(Pago::class, 'socio_id');
    }
}
