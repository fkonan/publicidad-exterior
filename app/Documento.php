<?php

namespace App;
use App\DocUpdate;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table = 'documentos';
    protected $primaryKey = 'DocId';

    protected $fillable=[
       
    ];
    
}
