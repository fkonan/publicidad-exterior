<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class ObservacionUTSP extends Model
{
    

    protected $table = 'observacion_utsp';
    protected $primaryKey = 'id';

    public function atencion()
    {
        return $this->belongsTo(AtencionUTSP::class, 'atencion_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function documentos()
    {
        return $this->hasMany(DocumentoUTSP::class, 'observacion_id');
    }

   
}
