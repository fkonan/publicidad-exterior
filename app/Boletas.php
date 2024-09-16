<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Boletas extends Model
{
    protected $connection = 'sqlsrv';
    protected $table = 'tipo_boleteria';
    protected $primaryKey = 'id';

    public function fromDateTime($value)
    {
        return Carbon::parse(parent::fromDateTime($value))->format('Y-d-m H:i:s');
    }
    
}
