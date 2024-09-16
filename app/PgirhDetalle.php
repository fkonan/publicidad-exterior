<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PgirhDetalle extends Model
{
    protected $connection = 'mysql3';
    protected $table = 'reporte_detalle';
    protected $primaryKey = 'id';
}
