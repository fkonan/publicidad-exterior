<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class EspectaculosPublicos extends Model
{  
    protected $connection = 'sqlsrv';
    protected $table = 'LOESTAMPI';
    protected $primaryKey = 'LoNroLiq';

    protected $fillable=[

        "LoTipDoc",
        "LoNumIde",
        "LoNumActAdm",
        "LoFecAct",
        "LoEnti",
        "LoCargo",
        "LoCodigo",
        "LoGrado",
        "LoValMen",
        "LoTipNom",
        "LoEmail",
        "LoTel",


    ];
    public function getDateFormat(){
        return 'Y-d-m H:i:s';
        }


}