<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PgirhEmpresa extends Model
{
    protected $connection = 'mysql3';
    protected $table = 'empresas';
    protected $primaryKey = 'id';
}
