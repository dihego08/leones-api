<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periodicidad extends Model
{
    protected $table = 'periodicidad';
    protected $primaryKey = 'id';
    //public $timestamps = false;
    protected $fillable = [
        'periodicidad'
    ];
}
