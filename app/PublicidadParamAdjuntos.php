<?php

namespace App;

use App\DocUpdate;

use Illuminate\Database\Eloquent\Model;

class PublicidadParamAdjuntos extends Model
{
   protected $table = 'publicidad_config_adjuntos';
   protected $primaryKey = 'id';

   protected $fillable = [];
}
