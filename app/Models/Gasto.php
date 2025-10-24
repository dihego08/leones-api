<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    protected $table = 'gastos';
    public $timestamps = false;
    protected $fillable = [
         	'concepto', 'monto', 'fecha_creacion', 'id_usuario_creacion', 'fecha_modificacion', 'id_usuario_modificacion', 'fecha', 'id_socio'
    ];

    public function socio()
    {
        return $this->belongsTo(Socio::class, 'id_socio');
    }
}
