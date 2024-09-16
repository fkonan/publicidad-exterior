<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class DocumentoUTSP extends Model
{
    

    protected $table = 'documentos_utsp';
    protected $primaryKey = 'id';

    public function observacion()
    {
        return $this->belongsTo(ObservacionUTSP::class, 'observacion_id');
    }

   
}
