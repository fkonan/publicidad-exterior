<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    public function __construct()

    {
        $this->middleware('auth');
    }

    public function index(){

        $users = User::all();

        return view('dashboard.user.index', compact('users'));

    }

    public function indexAdmin(){
        $users= User::whereHas('roles',function($q){
            $q->whereIn('name', ['ADMIN', 'PLANEACION','ADMINISTRATIVA','ALMACEN','ALUMBRADO PUBLICO','ARCHIVO', 'CONTROL INTERNO','Control Interno Disciplinario','defensoria espacio', 'DESARROLLO SOCIAL', 'despacho','EDUCACION','HACIENDA-SFI','INFRAESTRUCTURA', 'JURIDICA', 'PENSIONES', 'PLANEACION','PRENSA','RECURSOS FISICOS', 'SALUD','SEC SALUD','SEC_GOBIERNO','TALENTO-NOMINA','TESORERIA-SFI','utsp','VALORIZACION','TECNICOS']);  }
    )->get();
    return view('dashboard.user.index', compact('users'));

    }

    public function editRoles($id){
    
        $usuarios_role = [];
        $user_data= User::findOrFail($id); // datos de usuario
        $users= User::where('id', $id)->with('roles')->get();   
    
        $ArrayUser = $users[0]['roles'];
        foreach ($ArrayUser as $usuarios){ // todos los roles por un solo usuario
            $usuarios_role[] = $usuarios->id;
         }
        $roles = Role::all(); // todos los roles

        return view('dashboard.user.edit', compact('user_data','usuarios_role', 'roles'));

    }

    public function assingRoles(Request $request){

       $user = User::findOrFail($request->id);

       if($user->syncRoles([$request->roles])){

        Alert::toast('Roles asignados con exito', 'success');
        return redirect('/dashboard/users');
       }else{
        Alert::error('Ha Ocurrido un error', 'No se realizo la asignación de permisos');
        return redirect('/dashboard/users');


       }


    }

    public function editPermission($id){
      
     $usuarios_permisos = [];
     $user= User::findOrFail($id);     
     $user->getAllPermissions();
     $arrayPermisos= $user['permissions'];
     foreach($arrayPermisos as $permiso){
         $usuarios_permisos[] = $permiso->id;
     }

     $permisos = Permission::all();
     $user_data = User::findOrFail($id);   

     return view('dashboard.user.editPermisos', compact('usuarios_permisos','permisos','user_data'));

    }

    public function AssingPermissions(Request $request){

        $user = User::findOrFail($request->id);

       if($user->syncPermissions([$request->permisos])){

        Alert::toast('Permisos asignados con exito', 'success');
        return redirect('/dashboard/users');
       }else{
        Alert::error('Ha Ocurrido un error', 'No se realizo la asignación de permisos');
        return redirect('/dashboard/users');    


    }




}

 public function editPermissionAdmin($id){

    $usuarios_permisos = [];
     $user= User::findOrFail($id);     
     $user->getAllPermissions();
     $arrayPermisos= $user['permissions'];
     foreach($arrayPermisos as $permiso){
         $usuarios_permisos[] = $permiso->id;
     }

     $filter = Permission::all();
     $permisos = $filter->whereIn('name',['ver-tramites','editar-tramite']);
     $user_data = User::findOrFail($id);   

     return view('dashboard.user.editPermisos', compact('usuarios_permisos','permisos','user_data'));



 }

}
