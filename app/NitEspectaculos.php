<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NitEspectaculos extends Model
{ 
    protected $connection = 'sqlsrv';
    protected $table = 'nit_espectaculos';
    protected $primaryKey = 'id';

    public function getDateFormat(){
        return 'Y-d-m H:i:s';
        }
}
