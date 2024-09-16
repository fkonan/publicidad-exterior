<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Metrolinea extends Model
{
    protected $table = 'caracterizacion_metrolinea';
    protected $primaryKey = 'id';

    protected $fillable=[
        "numero_solicitud",
        "tipo_poblacion",
        "nombre_usuario",
        "email_solicitante",
        "apellido_usuario",
        "tratamiento_datos",
        "fecha_nacimiento",
        "edad",
        "estado_civil",
        "nombre_acudiente",
        "nivel_estudios",
        "tipo_documento",
        "documento_usuario",
        "sexo",
        "orientacion_sexual",
        "telefono_usuario",
        "email_usuario",
        "id_municipio",
        "barrio",
        "corregimiento",
        "direccion_usuario",
        "institucion_educativa",
        "estrato_socioeconomico",
        "ruta_frecuente",
        "trabaja_actualmente",
        "entrega_tarjeta",
        "discapacidad",
        "adj_documentoIdentidad",
        "adj_certiVecindad",
        "adj_certificadoEstudio",
        "estado_solicitud",
        "fecha_actuacion",
        "tratamiento_datos",
        "acepto_terminos",
        "confirmo_mayorEdad",
        "compartir_informacion",
        "adj_docAcudiente",
        "adj_docSisben",
        "adj_deportistas_artistas",
        "adj_discapacidad",
        "tiene_sisben",
        "nombre_cuidador",
        "autorizacion_tratamiento_compartido"


      ];
}
