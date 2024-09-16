<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Auditoria;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use App\Mail\NotificacionDiscapacidad;

class EducacionController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }

    public function index()
    {
        return view('tramites.educacion.index');
    }

    public function convocatoria(){
        $sql = "SELECT COUNT(id) AS 'numero_inscripciones'
         FROM datos_generales";

         $sql2 = "SELECT COUNT(dg.id) as  total_programa, pe.programa,i.institucion FROM datos_generales AS dg
         INNER JOIN programa_educativo as pe
         ON pe.id = dg.programa1_id
         INNER JOIN institucion as i
         ON pe.institucion_id = i.id
         GROUP BY pe.programa
         ORDER BY  i.institucion";

         $sql3 = "SELECT institucion,COUNT(dg.id) AS cantidad FROM datos_generales AS dg
         INNER JOIN programa_educativo AS pe ON dg.programa1_id=pe.id
         INNER JOIN institucion AS i ON pe.`institucion_id`=i.id
         GROUP BY institucion";

        $query = DB::connection('mysql7')->select($sql);
        $query2 = DB::connection('mysql7')->select($sql2);
        $query3 = DB::connection('mysql7')->select($sql3);
        return view('tramites.educacion.convocatoria.index', compact('query','query2','query3'));
        
    }

  
}
