<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class AtencionUTSP extends Model
{
    

    protected $table = 'atencion_utsp';
    protected $primaryKey = 'id';


    public function observaciones()
    {
        return $this->hasMany(ObservacionUTSP::class, 'atencion_id');
    }

   
}
