<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConceptoMes extends Model
{
    protected $table = 'concepto_meses';
    protected $fillable = ['id_concepto', 'mes'];

    public $timestamps = false;

    public function concepto()
    {
        return $this->belongsTo(Concepto::class, 'id_concepto');
    }
}
