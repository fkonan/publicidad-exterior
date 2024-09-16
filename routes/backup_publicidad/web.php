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

Route::post('/login', 'LoginController@login')->name('login');
Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard.index');
Route::get('/logout/{user}', 'LoginController@logout')->name('logout');




Route::group(['middleware' => ['role:SUPER-ADMIN']], function () {

    //RUTAS DE ROLES

Route::get('/dashboard/role', 'RoleController@index')->name('role.index');
Route::post('/dashboard/role/store', 'RoleController@store')->name('role.create');
Route::get('/roles/create','RoleController@create')->name('role.add');
Route::get('dashboard/roles/{id}/edit','RoleController@edit')->name('role.edit');
Route::post('dashboard/roles/update', 'RoleController@update')->name('role.update');
route::get('/dashboard/roles/destroy/{id}', 'RoleController@destroy')->name('role.destroy');
Route::get('/roles/ver/{id}','RoleController@verPermisos')->name('roles.ver');


//Rutas de permisos

Route::get('/dashboard/permission', 'PermissionController@index')->name('permisos.index');
Route::get('/dashboard/permission/{id}/edit', 'PermissionController@edit')->name('permisos.editar');
Route::post('/dashboard/permission/store', 'PermissionController@store')->name('permisos.create');
Route::post('/dashboard/permission/update', 'PermissionController@update')->name('permisos.update');
Route::get('/dashboard/permission/destroy/{id}','PermissionController@destroy')->name('permisos.destroy');
    //
});


Route::group(['middleware' => ['role:SUPER-ADMIN|ADMIN']], function () {

// RUTAS DE USUARIO

Route::get('/dashboard/users', 'UserController@index')->name('user.index');
Route::get('/dashboard/users/{id}/roleEdit', 'UserController@editRoles')->name('user.editRoles');
Route::post('/dashboard/users/roleUpdate', 'UserController@assingRoles')->name('user.update');
Route::get('/dashboard/users/{id}/permissionsEdit', 'UserController@editPermission')->name('user.editPermissions');
Route::post('/dashboard/users/permissionsUpdate', 'UserController@AssingPermissions')->name('user.updatePermissions');
Route::get('/dashboard/users/admin','UserController@indexAdmin')->name('user.indexAdmin');
Route::get('/dashboard/users/{id}/permissionsEditAdmin', 'UserController@editPermissionAdmin')->name('user.editPermissionsAdmin');

});

// RUTAS DE PLANEACION VER TRAMITES
Route::group(['middleware' => ['role:SUPER-ADMIN|PLANEACION']], function () {
    Route::get('/tramites/planeacion','PlaneacionController@index')->name('planeacion.index');
});

Route::group(['middleware' => ['role_or_permission:SUPER-ADMIN|editar-tramite']], function () {
    Route::get('/tramites/planeacion/espacio','PlaneacionController@espacioIndex')->name('espacio.index');
    Route::get('/tramites/planeacion/espacio/{id}', 'PlaneacionController@detalleSolicitud')->name('espacio.detalle');
    Route::post('/tramites/planeacion/espacio/update','PlaneacionController@updateSolicitud')->name('espacio.update');
     // rutas tramite categorizacion de parqueaderos

    Route::get('/tramites/planeacion/parqueaderos/', 'PlaneacionController@indexParqueaderos')->name('planeacion.parqueaderos.index');
    Route::get('/tramites/planeacion/parqueadero/{id}','PlaneacionController@parqueaderoDetalle')->name('planeacion.parqueaderos.detalle');
    Route::get('/tramites/planeacion/parqueadero/auditoria/{id}','PlaneacionController@parqueaderoDetalleAuditoria')->name('planeacion.parqueaderos.detalle.auditoria');

    //tramite publicdad exterior
    Route::get('/tramites/planeacion/publicidad','PlaneacionController@publicidadIndex')->name('planeacion.publicidad.index');
    Route::get('/tramites/planeacion/publicidad/detalle/{id}','PlaneacionController@publicidadDetalle')->name('planeacion.publicidad.detalle');
    Route::post('/tramites/planeacion/publicidad/','PlaneacionController@publicidadUpdate')->name('planeacion.publicidad.update');

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
Route::post('/categorizacion-parqueaderos/consulta','ParqueaderosController@consulta')->name('parqueadero.consulta');
Route::get('/categorizacion-parqueaderos/detalle/{id}', 'ParqueaderosController@detalle')->name('parqueadero.detalle');
Route::post('/categorizacion-parqueaderos/updateDocs', 'ParqueaderosController@updateDocs')->name('parqueadero.updateDocs');

// RUTAS EVENTOS PUBLICOS

Route::get('/eventos-publicos', 'EventosController@index')->name('eventos.index');
Route::post('/eventos-publicos/store', 'EventosController@store')->name('eventos.store');
Route::get('/eventos-publicos/confirmacion', 'EventosController@confirmacion')->name('eventos.confirmacion');
Route::get('/eventos-publicos/finalizar', 'EventosController@end')->name('eventos.finalizar');
Route::post('/eventos-publicos/consulta','EventosController@consulta')->name('eventos.consulta');
Route::get('/eventos-publicos/detalle/{id}', 'EventosController@detalle')->name('eventos.detalle');
Route::post('/eventos-publicos/updateDocs', 'EventosController@updateDocs')->name('eventos.updateDocs');

// RUTAS METROLINEA

Route::get('/registro-metrolinea', 'MetrolineaController@index')->name('metrolinea.index');
Route::post('/registro-metrolinea/store', 'MetrolineaController@store')->name('metrolinea.store');
Route::get('/registro-metrolinea/confirmacion', 'MetrolineaController@confirmacion')->name('metrolinea.confirmacion');
Route::get('/registro-metrolinea/finalizar', 'MetrolineaController@end')->name('metrolinea.finalizar');
Route::post('/registro-metrolinea/consulta', 'MetrolineaController@consulta')->name('metrolinea.consulta');

// RUTAS DE PUBLICIDAD EXTERIOR

Route::get('/publicidad-exterior', 'PublicidadController@index')->name('publicidad.index');
Route::get('/publicidad-exterior/cargarDatosVallas', 'PublicidadController@cargarDatosVallas')->name('publicidad.cargarDatosVallas');
Route::get('/publicidad-exterior/cargarDatosMurales', 'PublicidadController@cargarDatosMurales')->name('publicidad.cargarDatosMurales');
Route::get('/publicidad-exterior/cargarDatosPasacalles', 'PublicidadController@cargarDatosPasacalles')->name('publicidad.cargarDatosPasacalles');
Route::get('/publicidad-exterior/cargarDatosAerea', 'PublicidadController@cargarDatosAerea')->name('publicidad.cargarDatosAerea');
Route::get('/publicidad-exterior/cargarDatosPendones', 'PublicidadController@cargarDatosPendones')->name('publicidad.cargarDatosPendones');
Route::get('/publicidad-exterior/cargarDatosMovil', 'PublicidadController@cargarDatosMovil')->name('publicidad.cargarDatosMovil');
Route::post('/publicidad-exterior/store', 'PublicidadController@store')->name('publicidad.store');
Route::get('/publicidad-exterior/confirmacion', 'PublicidadController@confirmacion')->name('publicidad.confirmacion');
Route::get('/publicidad-exterior/finalizar', 'PublicidadController@end')->name('publicidad.finalizar');
Route::post('/publicidad-exterior/consulta','PublicidadController@consulta')->name('publicidad.consulta');
Route::get('/publicidad-exterior/detalle/{id}', 'PublicidadController@detalle')->name('publicidad.detalle');
Route::post('/publicidad-exterior/updateDocs', 'PublicidadController@updateDocs')->name('publicidad.updateDocs');
Route::get('/publicidad-exterior/detalle-requisitos/{id}', 'PublicidadController@detalleRequisitos')->name('publicidad.detalleRequisitos');
Route::post('/publicidad-exterior/updateReq', 'PublicidadController@updateReque')->name('publicidad.updateReq');

//RUTAS DE ESPECTACULOS Publicos
Route::get('/espectaculos-publicos', 'EspectaculosController@index')->name('espectaculos.index');
Route::post('/espectaculos-publicos/store', 'EspectaculosController@store')->name('espectaculos.store');
Route::get('/espectaculos-publicos/confirmacion', 'EspectaculosController@confirmacion')->name('espectaculos.confirmacion');
Route::get('/espectaculos-publicos/finalizar', 'EspectaculosController@end')->name('espectaculos.finalizar');
Route::post('/espectaculos-publicos/consulta','EspectaculosController@consulta')->name('espectaculos.consulta');
Route::get('/espectaculos-publicos/detalle/{id}', 'EspectaculosController@detalle')->name('espectaculos.detalle');
Route::post('/espectaculos-publicos/updateDocs', 'EspectaculosController@updateDocs')->name('espectaculo.updateDocs');
Route::post('/espectaculos-publicos/updateCer', 'EspectaculosController@updateCer')->name('espectaculo.updateCer');
Route::get('/espectaculos-publicos/cancelar/{id}', 'EspectaculosController@cancelar')->name('espectaculos.cancelar');
Route::post('/espectaculos-publicos/cancelarSolicitud/', 'EspectaculosController@cancelarSolicitud')->name('espectaculos.cancelarSolicitud');
//Rutas
Route::get('/espectaculos-publicos/liquidacion/{id}', 'EspectaculosController@certificadoBoleteria')->name('espectaculos.certiBoleteria');


//PRUEBAS
Route::get('/pruebas', 'EspectaculosController@pruebas')->name('pruebas.pruebas');


// RUTAS DE INTERIOR VER TRAMITES
Route::group(['middleware' => ['role:SUPER-ADMIN|SEC_GOBIERNO']], function () {
    Route::get('/tramites/interior','InteriorController@index')->name('interior.index');
});

Route::group(['middleware' => ['role_or_permission:SUPER-ADMIN|SEC_GOBIERNO|editar-tramite']], function () { 
    //tramites parqueaderos
    Route::get('/tramites/interior/parqueaderos','InteriorController@parqueaderoIndex')->name('interior.parqueaderos.index');
    Route::get('/tramites/interior/parqueadero/{id}','InteriorController@parqueaderoDetalle')->name('interior.parqueaderos.detalle');
    Route::post('tramites/interior/parqueaderos/update/', 'InteriorController@parqueaderoUpdate' )->name('interior.parqueaderos.update');
     
    // tramite de eventos
    Route::get('/tramites/interior/eventos','InteriorController@eventosIndex')->name('interior.eventos.index');
    Route::get('/tramites/interior/evento/{id}','InteriorController@eventoDetalle')->name('interior.eventos.detalle');
    Route::post('tramites/interior/eventos/update/', 'InteriorController@eventosUpdate' )->name('interior.eventos.update');

    //tramite publicdad exterior
    Route::get('/tramites/interior/publicidad','InteriorController@publicidadIndex')->name('interior.publicidad.index');
    Route::get('/tramites/interior/publicidad/{modalidad}','InteriorController@publicidadListarSolicitudes')->name('interior.publicidad.listarSolicitudes');
    Route::get('/tramites/interior/publicidad/detalle/{id}','InteriorController@publicidadDetalle')->name('interior.publicidad.detalle');
    Route::post('/tramites/interior/publicidad/','InteriorController@publicidadUpdate')->name('interior.publicidad.update');


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
    Route::get('/tramites/DadepAdmin','DadepAdminController@index')->name('DadepAdmin.index');
  });

    Route::group(['middleware' => ['role_or_permission:SUPER-ADMIN|editar-tramite']], function () {
    Route::get('/tramites/DadepAdmin/Cesion/{tipo}','DadepAdminController@Cesion')->name('Cesion.index');
    Route::get('/tramites/DadepAdmin/Cesion/detalle/{id}', 'DadepAdminController@detalleSolicitud')->name('Cesion.detalle');
    Route::post('/tramites/DadepAdmin/Cesion/finalizar', 'DadepAdminController@finalizar')->name('Cesion.finalizar');
   
  });


  // RUTAS DE HACIENDA PARA VER TRAMITES
Route::group(['middleware' => ['role:SUPER-ADMIN|HACIENDA-SFI']], function () {
    Route::get('/tramites/hacienda','HaciendaController@index')->name('hacienda.index');
});

Route::group(['middleware' => ['role_or_permission:SUPER-ADMIN|HACIENDA-SFI|editar-tramite']], function () { 
    Route::get('/tramites/hacienda/espectaculos','HaciendaController@espectaculoIndex')->name('hacienda.espectaculos.index');
    Route::get('/tramites/hacienda/espectaculos/{id}','HaciendaController@espectaculoDetalle')->name('hacienda.espectaculos.detalle');
    Route::post('tramites/hacienda/espectaculos/update/', 'HaciendaController@espectaculoUpdate' )->name('hacienda.espectaculos.update');
    
     //tramite publicdad exterior
     Route::get('/tramites/hacienda/publicidad','HaciendaController@publicidadIndex')->name('hacienda.publicidad.index');
   //   Route::get('/tramites/hacienda/publicidad/{modalidad}','HaciendaController@publicidadListarSolicitudes')->name('hacienda.publicidad.listarSolicitudes');
     Route::get('/tramites/hacienda/publicidad/detalle/{id}','HaciendaController@publicidadDetalle')->name('hacienda.publicidad.detalle');
     Route::post('/tramites/hacienda/publicidad/','HaciendaController@publicidadUpdate')->name('hacienda.publicidad.update');

    // // tramite de eventos
    // Route::get('/tramites/interior/eventos','InteriorController@eventosIndex')->name('interior.eventos.index');
    // Route::get('/tramites/interior/evento/{id}','InteriorController@eventoDetalle')->name('interior.eventos.detalle');
    // Route::post('tramites/interior/eventos/update/', 'InteriorController@eventosUpdate' )->name('interior.eventos.update');
});

//publicidad parte salud
Route::group(['middleware' => ['role:SUPER-ADMIN|SALUD|SEC SALUD']], function () {
   Route::get('/tramites/salud','SaludController@index')->name('salud.index');
});

Route::group(['middleware' => ['role_or_permission:SUPER-ADMIN|editar-tramite']], function () {
   //tramite publicdad exterior
   Route::get('/tramites/salud/publicidad','SaludController@publicidadIndex')->name('salud.publicidad.index');
   Route::get('/tramites/salud/publicidad/detalle/{id}','SaludController@publicidadDetalle')->name('salud.publicidad.detalle');
   Route::post('/tramites/salud/publicidad/','SaludController@publicidadUpdate')->name('salud.publicidad.update');
});


