<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class AnexosRita extends Model
{
    
    protected $table = 'anexos_rita';
    protected $primaryKey = 'id';

    protected $fillable =[ 
        'rita_id',
        'radicado',
        'titulo',
        'nombre_archivo',
        'ruta',
      ];

}
