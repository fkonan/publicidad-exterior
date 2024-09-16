<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportesController extends Controller
{
    public function index(){
        return view('tramites.reportes.index');
    }
    public function usosuelo(){
        return view('tramites.reportes.uso-suelo.index');
    }
    public function impuestos(){
        return view('tramites.reportes.impuestos.index');
    }

    public function rita(){
         $sql = "SELECT estado_solicitud AS 'estado' ,COUNT(id) AS 'numero', YEAR(created_at) AS 'year'
         FROM rita 
         GROUP BY estado_solicitud, YEAR(created_at) 
         ORDER BY YEAR(created_at)";

        $query = DB::connection('mysql')->select($sql);
        return view('tramites.reportes.rita.index', compact('query'));
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
        return view('tramites.reportes.becas-educacion.index', compact('query','query2','query3'));
        
    }

    public function empleoJoven(){
        $sql = "SELECT COUNT(id) AS 'empleados'
         FROM empleado";
        $sql2 = "SELECT COUNT(id) AS 'empresas'
         FROM empresa";
        $query = DB::connection('mysql4')->select($sql);
        $query2 = DB::connection('mysql4')->select($sql2);
        return view('tramites.reportes.empleo-joven.index', compact('query','query2'));
       

    }

    public function metrolinea(){
        $sql = "SELECT COUNT(id) AS 'solicitudes'
         FROM caracterizacion_metrolinea";
        $sql2 = "SELECT COUNT(id) AS 'numero', estado_solicitud as estado
         FROM caracterizacion_metrolinea
         GROUP BY estado_solicitud
         ORDER BY estado_solicitud";
        $query = DB::connection('mysql')->select($sql);
        $query2 = DB::connection('mysql')->select($sql2);       
        return view('tramites.reportes.metrolinea.index', compact('query','query2'));
       

    }

    public function familiaLactante(){
        $sql = "SELECT COUNT(id) AS 'solicitudes'
         FROM familia_lactante";       
        $query = DB::connection('mysql')->select($sql);             
        return view('tramites.reportes.familia-lactante.index', compact('query'));
       

    }
    public function categorizacion(){
        return view('tramites.reportes.categorizacion.index');
    }
    public function discapacidad(){
        return view('tramites.reportes.discapacidad.index');
    }

    public function intranet(){
        $sql = "SELECT COUNT(id) AS 'ingresos'
         FROM intranet.session s WHERE  `action` ='LOGIN'";
         $sql2 = "SELECT COUNT(id) AS 'usuarios'
         FROM intranet.users u";         
        $query = DB::connection('mysql8')->select($sql);
        $query2 = DB::connection('mysql8')->select($sql2);       
        return view('tramites.reportes.intranet.index', compact('query','query2'));       

    }

    public function espectaculos(){
        return view('tramites.reportes.espectaculos-publicos.index');
    }
    public function espectectaculosArtes(){
        return view('tramites.reportes.permisos-artes.index');
    }
    public function rh1(){
        return view('tramites.reportes.pgirh.index');
    }
    public function presupuestos(){
        return view('tramites.reportes.presupuestos.index');
    }

    
}
