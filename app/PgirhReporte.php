<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PgirhReporte extends Model
{
    protected $connection = 'mysql3';
    protected $table = 'reporte';
    protected $primaryKey = 'id';
}
