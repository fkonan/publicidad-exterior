<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Evento;

class DocUpdate extends Model
{
    protected $table = 'eventos_update_doc';
    protected $primaryKey = 'id';

    protected $fillable=[
        
        "evento_id",
        "adj_logisticaEvento",
        "adj_cedulaRes",
        "adj_autorizacionTra",
        "adj_contratoArr",
        "adj_conceptoCMGRD",
        "adj_conceptoTecAmb",
        "adj_certificadoPONAL",
        "adj_certificadoBomberos",
        "adj_hospitalaria",
        "adj_poliza",
        "adj_publicidad",    
        "adj_certificadoEMAB",
        "adj_derAutor",
        
    ];

    public function suceso(){
        return $this->belongsTo(Evento::class, 'persona_id');
    }






}
