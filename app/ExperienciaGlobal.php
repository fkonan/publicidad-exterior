<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExperienciaGlobal extends Model
{
    protected $table = 'experiencia';
    protected $primaryKey = 'id';

    protected $fillable =[        
        "valor",
        "tramite",        
        "sugerencias"
    ];
}
