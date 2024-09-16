<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $table = 'session';
    protected $primaryKey = 'id';


    protected $fillable =[        
        "user",
        "action"
    ];


}
