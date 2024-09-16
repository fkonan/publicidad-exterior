<?php

namespace App;
use App\DocUpdate;

use Illuminate\Database\Eloquent\Model;

class DadepNovedad extends Model
{
    protected $table = 'dadep_novedad';
    protected $primaryKey = 'NovedadId';

    protected $fillable=[
       
    ];

    public function documentos(){     

        return $this->hasOne(DocUpdate::class); //relacion 1  a 1

    }
    
}
