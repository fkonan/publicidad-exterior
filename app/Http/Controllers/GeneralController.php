<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auditoria;
use App\CertificadoPredio;
use App\User;
use App\Parametro;
use App\Barrio;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Connection;
use Illuminate\Database\QueryException;
use PDF;

class GeneralController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth', ['except' => ['getBarrios', 'getParametros']]);
	}

	public function index()
	{
		return view('tramites.general.index');
	}

	public function indexCertificado()
	{
		return view('tramites.general.certificado_predios.reportes');
	}

	public function searchPredio(Request $request)
	{

		$this->validate($request, [
			'numero_predial' => 'required|numeric|min:4|max:999999999999999',
			'matricula' => 'required|string|max:15',
		]);

		$predio = ($request->numero_predial) ? $request->numero_predial : '%';
		$matricula = ($request->matricula) ? $request->matricula : '%';


		$sql = "SELECT *
           FROM [Gx_Alcaldia].[dbo].[ActivosFijosPredios]
           WHERE  [AFPreNumeroPredio] = '$predio'
	        AND [AFPreMatriculaInmo] = '$matricula'";
		$query = DB::connection('sqlsrv2')->select($sql);
		if (isset($query) || $query->count() > 0) {

			$ultimo_id = CertificadoPredio::latest('id')->first();
			// return $ultimo_id;
			if (!$ultimo_id) {
				$idRadicado = 1;
			} else {
				$idRadicado = $ultimo_id->id + 1;
			}
			$radicado = "CP-" . str_pad($idRadicado, 4, "0", STR_PAD_LEFT);

			$certificado = new CertificadoPredio();
			$certificado->radicado = $radicado;
			$certificado->numero_predial = $predio;
			$certificado->matricula = $matricula;
			$certificado->direccion = $query[0]->AFPreDireccion;
			$certificado->complemento = $query[0]->AFPreComplemento;
			$certificado->codigo = $query[0]->AFPreCodigo;
			$certificado->nombre_usuario = auth()->user()->name;
			$certificado->user = auth()->user()->username;
			$certificado->secretaria = auth()->user()->secretaria;
			$certificado->fecha = date('Y-m-d');

			$auditoria = Auditoria::create([
				'usuario' => auth()->user()->username,
				'proceso_afectado' => 'Radicado-' . $radicado,
				'tramite' => 'CERTIFICADO DE PREDIOS',
				'radicado' => $radicado,
				'accion' => 'Generacion de certificado',
				'observacion' => 'El usuario ' . auth()->user()->username . 'genera un certificado de predios en la plataforma'

			]);
			if ($certificado->save()) {
				setlocale(LC_TIME, 'es_ES');
				$numeroDia = date('d'); // Obtiene el número del día
				$nombreDia = utf8_encode(strftime('%A')); // Obtiene el nombre del día en español
				$nombreMes = utf8_encode(strftime('%B')); // Obtiene el nombre del mes en español
				$anoActual = date('Y');
				$fechaActual = "$nombreDia ($numeroDia) del mes de $nombreMes de $anoActual";
				$pdf = PDF::loadView('tramites.general.certificado_predios.certificado', compact('certificado', 'fechaActual'));
				$filename = "certificado_de_predio-$radicado.pdf";
				return $pdf->download($filename);
			}
		} else {
			Alert::info('Atencion!', 'No se encontraron resultados para esta búsqueda');
			return redirect()->route('planeacion.uso-suelo.index');
		}
	}

	public function searcByPredio($predio)
	{
		$sql =   DB::connection('sqlsrv2')
			->table('ActivosFijosPredios')
			->where('AFPreNumeroPredio', $predio)
			->get();
		if (isset($sql) && $sql->count() == 1) {
			if ($sql[0]->AFPreComplemento == '') {
				return response()->json(['success' => false, 'datos' => []]);
			}
			if (strpos($sql[0]->AFPreMatriculaInmo, "300-") !== 0) {
				return response()->json(['success' => false, 'datos' => []]);
			}

			return response()->json(['success' => true, 'datos' => $sql]);
		} else {
			return response()->json(['success' => false, 'datos' => []]);
		}
	}
	public function reports()
	{
		$secretarias = User::select(DB::raw("CONVERT(TRIM(BINARY secretaria) USING utf8) as secretaria"))
			->distinct()
			->orderBy('secretaria')
			->pluck('secretaria', 'secretaria');

		return view('tramites.general.certificado_predios.main', compact('secretarias'));
	}

	public function searchCertificado(Request $request)
	{


		if (
			!$request->numero_predial &&
			!$request->radicado &&
			!$request->matricula &&
			!$request->fecha_inicial &&
			!$request->fecha_final &&
			!$request->secretaria &&
			!$request->direccion

		) {
			Alert::info('Atencion!', 'Todos los campos de busqueda estan vacios');
			return redirect()->route('certificados.reportes');
		}
		if ($request->fecha_inicial && $request->fecha_final) {
			if ($request->fecha_inicial > $request->fecha_final) {
				Alert::info('Atencion!', 'La fecha inicial no puede ser mayor que la fecha final');
				return redirect()->route('certificados.reportes');
			}
		}

		$codigo = ($request->numero_predial) ? $request->numero_predial : '%';
		$matricula = ($request->matricula) ? $request->matricula : '%';
		$radicado = ($request->radicado) ? $request->radicado : '%';
		$direccion = ($request->direccion) ? trim($request->direccion) : '%';
		$fecha_inicial = ($request->fecha_inicial) ? $request->fecha_inicial : '2019-01-01';
		$fecha_final = ($request->fecha_final) ? $request->fecha_final : '2050-12-31';
		$secretaria = ($request->secretaria) ? $request->secretaria : '%';

		$certificado = CertificadoPredio::where('radicado', 'LIKE', "%$radicado")
			->where('numero_predial', 'LIKE', "%$codigo")
			->where('matricula', 'LIKE', "%$matricula")
			->where('direccion', 'LIKE', "%$direccion%")
			->where(function ($query) use ($secretaria) {
				$query->whereRaw("IFNULL(secretaria, '') LIKE ?", ["$secretaria"]);
			})
			->whereBetween('fecha', [$fecha_inicial, $fecha_final])
			->get();



		if (isset($certificado) || $certificado->count() > 0) {
			return view('tramites.general.certificado_predios.export', compact('certificado'));
		} else {
			Alert::info('Atencion!', 'No se encontraron resultados para esta búsqueda');
			return redirect()->route('certificados.reportes');
		}
	}

	public function exportDocument($id)
	{
		$certificado = CertificadoPredio::findOrFail($id);
		$radicado = $certificado->radicado;

		$timestamp = strtotime($certificado->fecha);

		$numeroDia = date('d', $timestamp);
		setlocale(LC_TIME, 'es_ES');
		$nombreDia = utf8_encode(strftime('%A', $timestamp));
		$nombreMes = utf8_encode(strftime('%B', $timestamp));
		$anoActual = date('Y', $timestamp);
		$fechaActual = "$nombreDia ($numeroDia) del mes de $nombreMes de $anoActual";
		$pdf = PDF::loadView('tramites.general.certificado_predios.certificado', ['certificado' => $certificado, 'fechaActual' => $fechaActual]);
		$filename = "certificado_de_predio-$radicado.pdf";
		return $pdf->download($filename);
	}

	public function getBarrios()
	{
		$barrios = Barrio::all();
		return response()->json(['barrios' => $barrios]);
	}

	public function getParametros()
	{
		$parametros = Parametro::all();
		return response()->json(['parametros' => $parametros]);
	}
}
