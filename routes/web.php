<?php

use App\Http\Controllers\PlaneacionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
   return view('login.index');
});
Route::get('/mantenimiento', function () {
   return view('tramites.mantenimiento');
});

// Route::get('/general/barrios/get', 'GeneralController@getBarrios')->name('general.getBarrios');



Route::post('/login', 'LoginController@login')->name('login');
Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard.index');
Route::get('/logout/{user}', 'LoginController@logout')->name('logout');




Route::group(['middleware' => ['role:SUPER-ADMIN']], function () {

   //RUTAS DE ROLES

   Route::get('/dashboard/role', 'RoleController@index')->name('role.index');
   Route::post('/dashboard/role/store', 'RoleController@store')->name('role.create');
   Route::get('/roles/create', 'RoleController@create')->name('role.add');
   Route::get('dashboard/roles/{id}/edit', 'RoleController@edit')->name('role.edit');
   Route::post('dashboard/roles/update', 'RoleController@update')->name('role.update');
   route::get('/dashboard/roles/destroy/{id}', 'RoleController@destroy')->name('role.destroy');
   Route::get('/roles/ver/{id}', 'RoleController@verPermisos')->name('roles.ver');


   //Rutas de permisos

   Route::get('/dashboard/permission', 'PermissionController@index')->name('permisos.index');
   Route::get('/dashboard/permission/{id}/edit', 'PermissionController@edit')->name('permisos.editar');
   Route::post('/dashboard/permission/store', 'PermissionController@store')->name('permisos.create');
   Route::post('/dashboard/permission/update', 'PermissionController@update')->name('permisos.update');
   Route::get('/dashboard/permission/destroy/{id}', 'PermissionController@destroy')->name('permisos.destroy');
   //
});


Route::group(['middleware' => ['role:SUPER-ADMIN|ADMIN']], function () {

   // RUTAS DE USUARIO

   Route::get('/dashboard/users', 'UserController@index')->name('user.index');
   Route::get('/dashboard/users/{id}/roleEdit', 'UserController@editRoles')->name('user.editRoles');
   Route::post('/dashboard/users/roleUpdate', 'UserController@assingRoles')->name('user.update');
   Route::get('/dashboard/users/{id}/permissionsEdit', 'UserController@editPermission')->name('user.editPermissions');
   Route::post('/dashboard/users/permissionsUpdate', 'UserController@AssingPermissions')->name('user.updatePermissions');
   Route::get('/dashboard/users/admin', 'UserController@indexAdmin')->name('user.indexAdmin');
   Route::get('/dashboard/users/{id}/permissionsEditAdmin', 'UserController@editPermissionAdmin')->name('user.editPermissionsAdmin');
});

// RUTAS DE PLANEACION VER TRAMITES
Route::group(['middleware' => ['role:SUPER-ADMIN|PLANEACION']], function () {
   Route::get('/tramites/planeacion', 'PlaneacionController@index')->name('planeacion.index');
});

Route::group(['middleware' => ['role_or_permission:SUPER-ADMIN|editar-tramite']], function () {
   Route::get('/tramites/planeacion/espacio', 'PlaneacionController@espacioIndex')->name('espacio.index');
   Route::get('/tramites/planeacion/espacio/{id}', 'PlaneacionController@detalleSolicitud')->name('espacio.detalle');
   Route::post('/tramites/planeacion/espacio/update', 'PlaneacionController@updateSolicitud')->name('espacio.update');
   Route::get('/tramites/planeacion/espacio/document/{id}', 'PlaneacionController@documentSolicitud')->name('espacio.documento');

   // rutas tramite categorizacion de parqueaderos

   Route::get('/tramites/planeacion/parqueaderos/', 'PlaneacionController@indexParqueaderos')->name('planeacion.parqueaderos.index');
   Route::get('/tramites/planeacion/parqueadero/{id}', 'PlaneacionController@parqueaderoDetalle')->name('planeacion.parqueaderos.detalle');
   Route::get('/tramites/planeacion/parqueadero/auditoria/{id}', 'PlaneacionController@parqueaderoDetalleAuditoria')->name('planeacion.parqueaderos.detalle.auditoria');

   Route::get('/tramites/planeacion/publicidad', 'PublicidadAdmin@planeacion')->name('planeacion.publicidad.index');
});

//RUTAS INHUMACIONES

Route::get('/inhumaciones', 'InhumacionesController@index')->name('inhumaciones.index');
Route::post('/inhumaciones/search', 'InhumacionesController@search')->name('inhumaciones.search');
Route::post('/inhumaciones/experiencia', 'InhumacionesController@experiencia')->name('inhumaciones.experiencia');


// experiencia globally

Route::post('/experiencia/tramites', 'HomeController@experienciaTramites')->name('experiencia.tramites');
Route::get('/tramites/trazabilidad/{radicado}/{tramite}', 'HomeController@trazabilidadTramites')->name('tramite.trazabilidad');


// RUTAS CATEGORIZACION DE PARQUEADEROS

Route::get('/categorizacion-parqueaderos', 'ParqueaderosController@index')->name('parqueaderos.index');
Route::post('/categorizacion-parqueaderos/store', 'ParqueaderosController@store')->name('parqueaderos.store');
Route::get('/categorizacion-parqueaderos/confirmacion', 'ParqueaderosController@confirmacion')->name('parqueaderos.confirmacion');
Route::get('/categorizacion-parqueaderos/finalizar', 'ParqueaderosController@end')->name('parqueaderos.finalizar');
Route::post('/categorizacion-parqueaderos/consulta', 'ParqueaderosController@consulta')->name('parqueadero.consulta');
Route::get('/categorizacion-parqueaderos/consulta', 'ParqueaderosController@consultarTramite')->name('parqueadero.consultaTramite');
Route::get('/categorizacion-parqueaderos/detalle/{id}', 'ParqueaderosController@detalle')->name('parqueadero.detalle');
Route::post('/categorizacion-parqueaderos/updateDocs', 'ParqueaderosController@updateDocs')->name('parqueadero.updateDocs');
Route::get('/categorizacion-parqueaderos/registro', 'ParqueaderosController@registro')->name('parqueadero.registro');

// RUTAS EVENTOS PUBLICOS

Route::get('/eventos-publicos', 'EventosController@index')->name('eventos.index');
Route::post('/eventos-publicos/store', 'EventosController@store')->name('eventos.store');
Route::get('/eventos-publicos/confirmacion', 'EventosController@confirmacion')->name('eventos.confirmacion');
Route::get('/eventos-publicos/finalizar', 'EventosController@end')->name('eventos.finalizar');
Route::post('/eventos-publicos/consulta', 'EventosController@consulta')->name('eventos.consulta');
Route::get('/eventos-publicos/consulta', 'EventosController@consultarTramite')->name('eventos.consultaTramite');
Route::get('/eventos-publicos/detalle/{id}', 'EventosController@detalle')->name('eventos.detalle');
Route::post('/eventos-publicos/updateDocs', 'EventosController@updateDocs')->name('eventos.updateDocs');
Route::get('/eventos-publicos/registro', 'EventosController@registro')->name('eventos.registro');

// RUTAS METROLINEA

Route::get('/registro-metrolinea', 'MetrolineaController@index')->name('metrolinea.index');
Route::post('/registro-metrolinea/store', 'MetrolineaController@store')->name('metrolinea.store');
Route::get('/registro-metrolinea/confirmacion', 'MetrolineaController@confirmacion')->name('metrolinea.confirmacion');
Route::get('/registro-metrolinea/finalizar', 'MetrolineaController@end')->name('metrolinea.finalizar');
Route::post('/registro-metrolinea/consulta', 'MetrolineaController@consulta')->name('metrolinea.consulta');
Route::post('/registro-metrolinea/entidades', 'MetrolineaController@entidades')->name('metrolinea.entidades');
Route::get('/registro-metrolinea/detalle/{id}', 'MetrolineaController@detalle')->name('metrolinea.detalle');
Route::post('/registro-metrolinea/updateDocs', 'MetrolineaController@updateDocs')->name('metrolinea.updateDocs');
// RUTAS DE PUBLICIDAD EXTERIOR

// Route::get('/publicidad-exterior', 'PublicidadController@index')->name('publicidad.index')->middleware('maintenance');
// Route::get('/publicidad-exterior/inicio', 'PublicidadController@inicio')->name('publicidad.inicio')->middleware('maintenance');
// Route::post('/publicidad-exterior/solicitud', 'PublicidadController@solicitud')->name('publicidad.solicitud');
// Route::post('/publicidad-exterior/finalizar', 'PublicidadController@finalizar')->name('publicidad.finalizar');
// Route::get('/publicidad-exterior/confirmacion', 'PublicidadController@confirmacion')->name('publicidad.confirmacion')->middleware('maintenance');
// Route::get('/publicidad-exterior/finalizar', 'PublicidadController@end')->name('publicidad.finalizar')->middleware('maintenance');
// Route::get('/publicidad-exterior/DocConsulta','PublicidadController@DocConsulta')->name('publicidad.DocConsulta')->middleware('maintenance');
// Route::post('/publicidad-exterior/consulta','PublicidadController@consulta')->name('publicidad.consulta');
// Route::get('/publicidad-exterior/DocPendientes','PublicidadController@DocPendientes')->name('publicidad.DocPendientes')->middleware('maintenance');
// Route::post('/publicidad-exterior/Guardar', 'PublicidadController@Guardar')->name('publicidad.Guardar');

Route::get('/publicidad-exterior', 'PublicidadController@index')->name('publicidad.index');

Route::get('/publicidad-exterior/validar-documento', 'PublicidadController@validarDocumento')->name('publicidad.validarDocumento');
Route::post('/publicidad-exterior/personas/guardar', 'PublicidadController@personasGuardar')->name('publicidad.personas.guardar');
Route::get('/publicidad-exterior/solicitud/{documento}', 'PublicidadController@solicitud')->name('publicidad.solicitud');
Route::get('/publicidad-exterior/cargar-documentos/{modalidad}', 'PublicidadController@cargarDocumentos')->name('publicidad.cargarDocumentos');

Route::get('/publicidad-exterior/inicio', 'PublicidadController@inicio')->name('publicidad.inicio');
Route::post('/publicidad-exterior/solicitud', 'PublicidadController@solicitud')->name('publicidad.solicitud');
Route::post('/publicidad-exterior/finalizar', 'PublicidadController@finalizar')->name('publicidad.finalizar');
Route::get('/publicidad-exterior/confirmacion', 'PublicidadController@confirmacion')->name('publicidad.confirmacion');
Route::get('/publicidad-exterior/finalizar', 'PublicidadController@end')->name('publicidad.finalizar');
Route::get('/publicidad-exterior/DocConsulta', 'PublicidadController@DocConsulta')->name('publicidad.DocConsulta');
Route::post('/publicidad-exterior/consulta', 'PublicidadController@consulta')->name('publicidad.consulta');
Route::get('/publicidad-exterior/DocPendientes', 'PublicidadController@DocPendientes')->name('publicidad.DocPendientes');
Route::post('/publicidad-exterior/Guardar', 'PublicidadController@Guardar')->name('publicidad.Guardar');

Route::get('/publicidad-exterior/detalle/{id}', 'PublicidadController@detalle')->name('publicidad.detalle');
Route::post('/publicidad-exterior/updateDocs', 'PublicidadController@updateDocs')->name('publicidad.updateDocs');
Route::get('/publicidad-exterior/detalle-requisitos/{id}', 'PublicidadController@detalleRequisitos')->name('publicidad.detalleRequisitos');
Route::post('/publicidad-exterior/updateReq', 'PublicidadController@updateReque')->name('publicidad.updateReq');

// RUTAS DE ENCUESTA POT

Route::get('/planeacion/encuesta-pot', 'PlaneacionController@indexPot')->name('pot.index');
Route::post('/planeacion/encuesta-pot/barrios', 'PlaneacionController@barriosComunas')->name('pot.barrios');
Route::post('/planeacion/encuesta-pot/veredas', 'PlaneacionController@veredaCorregimiento')->name('pot.veredas');
Route::post('/planeacion/encuesta-pot/validacionDocumento', 'PlaneacionController@validacionDocumento')->name('pot.documento');
Route::post('/planeacion/encuesta-pot/store', 'PlaneacionController@potStore')->name('pot.store');
Route::get('/planeacion/encuesta-pot/confirmacion', 'PlaneacionController@confirmacionPot')->name('pot.confirmacion');

//RUTAS DE ESPECTACULOS Publicos
Route::get('/espectaculos-publicos', 'EspectaculosController@index')->name('espectaculos.index');
Route::get('/espectaculos-publicos/registro', 'EspectaculosController@registro')->name('espectaculos.registro');
Route::post('/espectaculos-publicos/store', 'EspectaculosController@store')->name('espectaculos.store');
Route::get('/espectaculos-publicos/confirmacion', 'EspectaculosController@confirmacion')->name('espectaculos.confirmacion');
Route::get('/espectaculos-publicos/finalizar', 'EspectaculosController@end')->name('espectaculos.finalizar');
Route::post('/espectaculos-publicos/consulta', 'EspectaculosController@consulta')->name('espectaculos.consulta');
Route::get('/espectaculos-publicos/detalle/{id}', 'EspectaculosController@detalle')->name('espectaculos.detalle');
Route::post('/espectaculos-publicos/updateDocs', 'EspectaculosController@updateDocs')->name('espectaculo.updateDocs');
Route::post('/espectaculos-publicos/updateCer', 'EspectaculosController@updateCer')->name('espectaculo.updateCer');
Route::get('/espectaculos-publicos/cancelar/{id}', 'EspectaculosController@cancelar')->name('espectaculos.cancelar');
Route::post('/espectaculos-publicos/cancelarSolicitud/', 'EspectaculosController@cancelarSolicitud')->name('espectaculos.cancelarSolicitud');
//Rutas
Route::get('/espectaculos-publicos/liquidacion/{id}', 'EspectaculosController@certificadoBoleteria')->name('espectaculos.certiBoleteria');

//Rutas de Liquidacion Oficial de Estampillas
Route::get('/liquidacion-estampillas', 'LiqEstampillasController@index')->name('liqestampillas.index');
Route::get('/liquidacion-estampillas/registro', 'LiqEstampillasController@registro')->name('liqestampillas.registro');
Route::post('/liquidacion-estampillas/store', 'LiqEstampillasController@store')->name('liqestampillas.store');
Route::get('/liquidacion-estampillas/confirmacion', 'LiqEstampillasController@confirmacion')->name('liqestampillas.confirmacion');


//RUTAS FAMILIA Familia
Route::get('/familia-lactante', 'SaludController@indexFamilia')->name('familia.index');
Route::post('/familia-lactante/store', 'SaludController@storeFamilia')->name('familia.store');
Route::get('/familia-lactante/confirmacion', 'SaludController@confirmacion')->name('familia.confirmacion');
Route::get('/familia-lactante/finalizar', 'SaludController@end')->name('familia.finalizar');

// RUTAS CERTIFICADO DE DISCAPACIDAD
Route::get('/certificado-discapacidad', 'DiscapacidadController@index')->name('discapacidad.index');
Route::post('/certificado-discapacidad/store', 'DiscapacidadController@store')->name('discapacidad.store');
Route::get('/certificado-discapacidad/confirmacion', 'DiscapacidadController@confirmacion')->name('discapacidad.confirmacion');
Route::get('/certificado-discapacidad/finalizar', 'DiscapacidadController@end')->name('discapacidad.finalizar');
Route::post('/certificado-discapacidad/consulta', 'DiscapacidadController@consulta')->name('discapacidad.consulta');
Route::get('/certificado-discapacidad/detalle/{id}', 'DiscapacidadController@detalle')->name('discapacidad.detalle');
Route::post('/certificado-discapacidad/updateDocs', 'DiscapacidadController@updateDocs')->name('discapacidad.updateDocs');
Route::get('/certificado-discapacidad/registro', 'DiscapacidadController@registro')->name('discapacidad.registro');




// RUTAS DE INTERIOR VER TRAMITES
Route::group(['middleware' => ['role:SUPER-ADMIN|SEC_GOBIERNO']], function () {
   Route::get('/tramites/interior', 'InteriorController@index')->name('interior.index');
});

Route::group(['middleware' => ['role_or_permission:SUPER-ADMIN|SEC_GOBIERNO|editar-tramite']], function () {
   //tramites parqueaderos
   Route::get('/tramites/interior/parqueaderos', 'InteriorController@parqueaderoIndex')->name('interior.parqueaderos.index');
   Route::get('/tramites/interior/parqueadero/{id}', 'InteriorController@parqueaderoDetalle')->name('interior.parqueaderos.detalle');
   Route::post('tramites/interior/parqueaderos/update/', 'InteriorController@parqueaderoUpdate')->name('interior.parqueaderos.update');

   // tramite de eventos
   Route::get('/tramites/interior/eventos', 'InteriorController@eventosIndex')->name('interior.eventos.index');
   Route::get('/tramites/interior/evento/{id}', 'InteriorController@eventoDetalle')->name('interior.eventos.detalle');
   Route::post('tramites/interior/eventos/update/', 'InteriorController@eventosUpdate')->name('interior.eventos.update');

   //tramite publicdad exterior
   Route::get('/tramites/interior/publicidad', 'InteriorController@publicidadIndex')->name('interior.publicidad.index');
   Route::get('/tramites/interior/publicidad/{modalidad}', 'PublicidadAdmin@interior')->name('interior.publicidad.listarSolicitudes');
   Route::get('/tramites/interior/publicidad/detalle/{id}', 'PublicidadAdmin@detalle')->name('interior.publicidad.detalle');
   Route::post('/tramites/interior/publicidad/', 'PublicidadAdmin@AgregarNovedad')->name('interior.publicidad.update');
   Route::post('/tramites/interior/publicidad/liquidacion', 'PublicidadAdmin@Liquidacion')->name('interior.publicidad.liquidacion');
   Route::get('/tramites/interior/publicidad/detalle/downoadPdf/{id}', 'PublicidadAdmin@downloadPdf')->name('interior.publicidad.donwloadPdf');
});

// RUTAS AREAS DE CESION TIPO A

Route::get('/Dadep', 'DadepController@index')->name('Dadep.index');
Route::get('/Dadep/Solicitud', 'DadepController@solicitud')->name('Dadep.solicitud');
Route::post('/Dadep/solicitar', 'DadepController@solicitar')->name('Dadep.solicitar');
Route::post('/Dadep/finalizar', 'DadepController@finalizar')->name('Dadep.finalizar');
Route::post('/Dadep/consulta', 'DadepController@consulta')->name('Dadep.consulta');
Route::get('/Dadep/DocConsulta', 'DadepController@DocConsulta')->name('Dadep.DocConsulta');
Route::get('/Dadep/DocPendientes', 'DadepController@DocPendientes')->name('Dadep.DocPendientes');
Route::post('/Dadep/Guardar', 'DadepController@Guardar')->name('Dadep.Guardar');


// RUTAS AREAS DE CESION TIPO B

Route::get('/Dadep/solLegalizacion', 'DadepController@solLegalizacion')->name('Dadep.solLegalizacion');
Route::post('/Dadep/solicitarB', 'DadepController@solicitarB')->name('Dadep.solicitarB');
Route::post('/Dadep/finalizarB', 'DadepController@finalizarB')->name('Dadep.finalizarB');
Route::get('/Dadep/Correcciones', 'DadepController@Correcciones')->name('Dadep.Correcciones');
Route::get('/Dadep/updateCorrecciones', 'DadepController@updateCorrecciones')->name('Dadep.updateCorrecciones');
Route::post('/Dadep/GuardarB', 'DadepController@GuardarB')->name('Dadep.GuardarB');

// RUTAS DE DADEP ADMIN
Route::group(['middleware' => ['role:SUPER-ADMIN|defensoria espacio']], function () {
   Route::get('/tramites/DadepAdmin', 'DadepAdminController@index')->name('DadepAdmin.index');
});

Route::group(['middleware' => ['role_or_permission:SUPER-ADMIN|editar-tramite']], function () {
   Route::get('/tramites/DadepAdmin/Cesion/{tipo}', 'DadepAdminController@Cesion')->name('Cesion.index');
   Route::get('/tramites/DadepAdmin/Cesion/detalle/{id}', 'DadepAdminController@detalleSolicitud')->name('Cesion.detalle');
   Route::post('/tramites/DadepAdmin/Cesion/finalizar', 'DadepAdminController@finalizar')->name('Cesion.finalizar');
});

//RUTAS PARA SALUD
//publicidad parte salud
Route::group(['middleware' => ['role:SUPER-ADMIN|SALUD|SEC SALUD']], function () {
   Route::get('/tramites/salud', 'SaludController@index')->name('salud.index');
});



Route::group(['middleware' => ['role_or_permission:SUPER-ADMIN|SEC SALUD|editar-tramite']], function () {
   //tramite publicdad exterior
   // Route::get('/tramites/salud/publicidad','PublicidadAdmin@salud')->name('salud.publicidad.index');
   // Route::get('/tramites/salud/publicidad/detalle/{id}','PublicidadAdmin@detalle')->name('salud.publicidad.detalle');
   //Route::post('/tramites/salud/publicidad/','SaludController@publicidadUpdate')->name('salud.publicidad.update');

   //PGIRH
   Route::get('/tramites/salud/pgirh', 'SaludController@indexEmpresas')->name('salud.pgirh.index');
   Route::get('/tramites/salud/pgirh/reportes/{id}', 'SaludController@reportesEmpresas')->name('salud.pgirh.reportes');
   Route::get('/tramites/salud/pgirh/excel/{id}/{empresa}/{nit}/{gestor}/{sede}', 'SaludController@excelDetalle')->name('salud.pgirh.detalle');

   Route::get('/tramites/salud/pgirh/reportes', 'SaludController@indexReportes')->name('salud.pgirh.reportes.general');
   Route::get('/tramites/salud/pgirh/getSedes/{id}', 'SaludController@getSedes')->name('salud.pgirh.sedes');
   Route::post('tramites/salud/pgirh/exportReport', 'SaludController@exportReport')->name('tramites.pghir.rh1.reportes');

   //AUTORIZACION DE LA CERTIFICACION DE DISCAPACIDAD
   Route::get('/tramites/salud/discapacidad', 'SaludController@indexDiscapacidad')->name('salud.discapacidad.index');
   Route::get('/tramites/salud/discapacidad/{id}', 'SaludController@discapacidadDetalle')->name('salud.discapacidad.detalle');
   Route::post('tramites/salud/discapacidad/update/', 'SaludController@discapacidadUpdate')->name('salud.discapacidad.update');

   //tramite publicdad exterior
   Route::get('/tramites/salud/publicidad', 'PublicidadAdmin@salud')->name('salud.publicidad.index');
});

//publicidad parte transito
Route::group(['middleware' => ['role:SUPER-ADMIN|TRANSITO|TRANSITO']], function () {
   // Route::get('/tramites/transito/publicidad','PublicidadAdmin@transito')->name('transito.publicidad.index');

   Route::get('/tramites/transito', 'PublicidadAdmin@transito')->name('transito.index');
   //Route::get('/tramites/transito/publicidad','PublicidadAdmin@transito')->name('transito.publicidad.index');
});

// RUTAS DE HACIENDA PARA VER TRAMITES
Route::group(['middleware' => ['role:SUPER-ADMIN|HACIENDA-SFI']], function () {
   Route::get('/tramites/hacienda', 'HaciendaController@index')->name('hacienda.index');
});

Route::group(['middleware' => ['role_or_permission:SUPER-ADMIN|HACIENDA-SFI|editar-tramite']], function () {
   Route::get('/tramites/hacienda/espectaculos', 'HaciendaController@espectaculoIndex')->name('hacienda.espectaculos.index');
   Route::get('/tramites/hacienda/espectaculos/{id}', 'HaciendaController@espectaculoDetalle')->name('hacienda.espectaculos.detalle');
   Route::post('tramites/hacienda/espectaculos/update/', 'HaciendaController@espectaculoUpdate')->name('hacienda.espectaculos.update');

   //tramite publicdad exterior
   Route::get('/tramites/hacienda/publicidad', 'PublicidadAdmin@hacienda')->name('hacienda.publicidad.index');
});
//empleo-joven
Route::group(['middleware' => ['role_or_permission:SUPER-ADMIN|reporte-empleo-joven']], function () {
   Route::get('/tramites/hacienda/empleo-joven', 'HaciendaController@indexReportes')->name('hacienda.empleo-joven.index');
   Route::get('/tramites/hacienda/empleo-joven/reporte', 'HaciendaController@reporteEmpleoJoven')->name('hacienda.empleo-joven.reporte');
});
//metrolinea
Route::group(['middleware' => ['role_or_permission:SUPER-ADMIN|reporte-metrolinea']], function () {
   Route::get('/tramites/hacienda/metrolinea', 'HaciendaController@indexMetrolinea')->name('hacienda.metrolinea.index');
   Route::get('/tramites/hacienda/metrolinea/reporte', 'HaciendaController@reporteMetrolinea')->name('hacienda.metrolinea.reporte');
});

//RITA

Route::group(['middleware' => ['role:SUPER-ADMIN|JURIDICA']], function () {
   Route::get('/tramites/juridica', 'JuridicaController@index')->name('juridica.index');
});
Route::group(['middleware' => ['role_or_permission:SUPER-ADMIN|canal-denuncia']], function () {
   Route::get('/tramites/juridica/rita', 'JuridicaController@main')->name('juridica.rita.main');
   Route::get('/tramites/juridica/rita/denuncias', 'JuridicaController@denuncias')->name('juridica.rita.index');
   Route::get('/tramites/juridica/rita/{id}', 'JuridicaController@denunciasDetalle')->name('juridica.rita.detalle');
   Route::post('/tramites/juridica/rita', 'JuridicaController@updateDenuncia')->name('juridica.rita.update');
   Route::get('/tramites/juridica/reportes/rita', 'JuridicaController@reporte')->name('juridica.rita.reporte');
   Route::post('/tramites/rita/reportes', 'JuridicaController@queryReport')->name('tramites.juridica.reports');
});

Route::group(['middleware' => ['role_or_permission:SUPER-ADMIN|consultas-uso']], function () {

   Route::get('/tramites/planeacion/uso-suelo/', 'PlaneacionController@indexUsoSuelo')->name('planeacion.uso-suelo.index');
   Route::post('/tramites/planeacion/uso-suelo', 'PlaneacionController@queryReport')->name('tramites.planeacion.reportes.uso');
   Route::get('/tramites/planeacion/uso-suelo/{id}', 'PlaneacionController@usoDetalle')->name('planeacion.uso.detalle');
   Route::get('/tramites/planeacion/tablero-uso/', 'PlaneacionController@usoTablero')->name('planeacion.uso.tablero');
});
Route::group(['middleware' => ['role_or_permission:SUPER-ADMIN|reportes-tramites']], function () {

   Route::get('/tramites/reportes/', 'ReportesController@index')->name('reportes.index');
   Route::get('/tramites/reportes/uso-suelo', 'ReportesController@usosuelo')->name('reportes.uso-suelo');
   Route::get('/tramites/reportes/rita', 'ReportesController@rita')->name('reportes.rita');
   Route::get('/tramites/reportes/impuestos', 'ReportesController@impuestos')->name('reportes.impuestos');
   Route::get('/tramites/reportes/convocatoria-educacion', 'ReportesController@convocatoria')->name('reportes.becas');
   Route::get('/tramites/reportes/empleo-joven', 'ReportesController@empleoJoven')->name('reportes.empleo');
   Route::get('/tramites/reportes/metrolinea', 'ReportesController@metrolinea')->name('reportes.metrolinea');
   Route::get('/tramites/reportes/familia-lactante', 'ReportesController@familiaLactante')->name('reportes.lactante');
   Route::get('/tramites/reportes/categorizacion-parqueaderos', 'ReportesController@categorizacion')->name('reportes.categorizacion');
   Route::get('/tramites/reportes/certificacion-discapacidad', 'ReportesController@discapacidad')->name('reportes.discapacidad');
   Route::get('/tramites/reportes/intranet', 'ReportesController@intranet')->name('reportes.intranet');
   Route::get('/tramites/reportes/espectaculos-publicos', 'ReportesController@espectaculos')->name('reportes.espectaculos');
   Route::get('/tramites/reportes/espectaculos-artes', 'ReportesController@espectectaculosArtes')->name('reportes.espectaculosArtes');
   Route::get('/tramites/reportes/rh1', 'ReportesController@rh1')->name('reportes.rh1');
   Route::get('/tramites/reportes/presupuestos', 'ReportesController@presupuestos')->name('reportes.presupuestos');
});

//RUTAS PARA EDUCACION
//publicidad parte salud
Route::group(['middleware' => ['role:SUPER-ADMIN|EDUCACION']], function () {
   Route::get('/tramites/educacion', 'EducacionController@index')->name('educacion.index');
});

Route::group(['middleware' => ['role_or_permission:SUPER-ADMIN|convocatoria-educacion']], function () {
   Route::get('/tramites/educacion/convocatoria', 'EducacionController@convocatoria')->name('educacion.convocatoria');
});

Route::get('/tramites/general', 'GeneralController@index')->name('general.index');
Route::get('/tramites/general/certificado_predios', 'GeneralController@indexCertificado')->name('general.certificado.index');
Route::get('/tramites/general/{predio}', 'GeneralController@searcByPredio')->name('general.certificado.search.predio');
Route::post('/tramites/general/certificado_predios/search', 'GeneralController@searchPredio')->name('tramites.general.certificado.search');

// RUTAS DE DADEP ADMIN
Route::group(['middleware' => ['role_or_permission:SUPER-ADMIN|reportes-certificado-predios']], function () {
   Route::get('/tramites/certificado-predios/index', 'GeneralController@reports')->name('certificados.reportes');
   Route::get('/tramites/certificado-predios/search/{id}', 'GeneralController@exportDocument')->name('certificados.search');
   Route::post('/tramites/certificado-predios/search', 'GeneralController@searchCertificado')->name('tramites.general.certificado.query');
});
// RUTAS DE UTSP CONTROLLER
Route::group(['middleware' => ['role_or_permission:SUPER-ADMIN|modulo-UTSP']], function () {
   Route::get('/tramites/UTSP/index', 'UTSPController@index')->name('utsp.index');
   Route::get('/tramites/UTSP/register', 'UTSPController@indexRegister')->name('utsp.index.register');
   Route::get('/tramites/UTSP/reportes', 'UTSPController@reportes')->name('utsp.reportes');
   Route::get('/tramites/UTSP/loadData', 'UTSPController@loadData')->name('utsp.loadData');
   Route::get('/tramites/UTSP/loadData/{id}', 'UTSPController@loadTrazabilidad')->name('utsp.loadTrazabilidad');
   Route::get('/tramites/UTSP/search/{id}', 'UTSPController@searchCaso')->name('utsp.search.caso');
   Route::get('/tramites/UTSP/document/{id}', 'UTSPController@downloadDocument')->name('utsp.document');
   Route::post('/tramites/UTSP/searchUTSP', 'UTSPController@searchUTSP')->name('utsp.search.UTSP');
   Route::post('/tramites/UTSP/searchComuna', 'UTSPController@searchComuna')->name('utsp.search.comuna');
   Route::post('/tramites/UTSP/store', 'UTSPController@store')->name('utsp.store');
   Route::post('/tramites/UTSP/actionStore', 'UTSPController@storeAction')->name('utsp.actionStore');
   // Route::get('/tramites/certificado-predios/search/{id}','GeneralController@exportDocument')->name('certificados.search');
});



//phpinfo

// Route::get('/phpinfo', function () {
//     return phpinfo();
// });
