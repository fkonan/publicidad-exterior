<?php

namespace App;

use App\DocUpdate;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
   protected $table = 'personas';
   protected $primaryKey = 'PersonaId';


   protected $fillable = [
      "PersonaTip",
      "PersonaTipDoc",
      "PersonaDoc",
      "PersonaNombre",
      "PersonaApe",
      "PersonaRazon",
      "PersonaTel",
      "PersonaMail",
      "PersonaDir",
      "PersonaBarrio"

   ];

   public function documentos()
   {

      return $this->hasOne(DocUpdate::class); //relacion 1  a 1

   }
}
