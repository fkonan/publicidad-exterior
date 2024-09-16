<?php

namespace App;
use App\DocUpdate;

use Illuminate\Database\Eloquent\Model;

class PublicidadNovedad extends Model
{
    protected $table = 'publicidad_novedad';
    protected $primaryKey = 'NovedadId';

    protected $fillable=[
       
    ];

    public function documentos(){     

        return $this->hasOne(DocUpdate::class); //relacion 1  a 1

    }
    
}
