<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experiencia extends Model
{    
    protected $connection = 'mysql2';
    protected $table = 'experiencia';
    protected $primaryKey = 'id';

    protected $fillable =[        
        "valor",
        "tramite",        
        "sugerencias"
    ];
}
