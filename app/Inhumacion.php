<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inhumacion extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'inhumaciones';
    protected $primaryKey = 'IdInhumacion';
}
