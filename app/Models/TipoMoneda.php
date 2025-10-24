<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoMoneda extends Model
{
    protected $table = 'tipo_moneda';
    protected $primaryKey = 'id';
    //public $timestamps = false;
    protected $fillable = [
        'tipo_moneda'
    ];
}
 	