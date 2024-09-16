<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()

    {
        $this->middleware('auth');
    }

    public function index()
    {

        $roles = Role::all();
        return view('dashboard.roles.index', compact('roles'));
    }

    public function store(Request $request)
    {
        

        $request->validate(['name' => 'required|unique:roles']);
        $role = new Role($request->all());
        $role->save();
        $role->permissions()->sync($request->permission);
        if($role){
            Alert::toast('Role creado con exito', 'success');
            return redirect()->route('role.index');
        }else{
            Alert::error('Ha Ocurrido un error', 'No se realizo el registro del Rol');
            return redirect()->route('role.index');
        }
        
    }

    public function create()
    {

        $permissions = Permission::all()->pluck('name', 'id');
        return response()->json($permissions);
    }

    public function edit($id){

        $permission_role =[];
        foreach (Role::findById($id)->permissions as $permisos){ // todos los permisos por 1 solo rol
           $permission_role[] = $permisos->id;
        }
        
      
        $roles_edit = Role::findById($id);  
        $permissions = Permission::all();
        return view('dashboard.roles.edit', compact('roles_edit', 'permissions','permission_role'));
     
     }

     public function update(Request $request){
  
        $request->validate(['name'=>'required|unique:roles,name,'.$request->id,]);
        $role = Role::findOrFail($request->id);
     
        $role->update($request->all());
        $role->permissions()->sync($request->permission);

        if($role){
            Alert::toast('Role actualizado con exito', 'success');
            return redirect()->route('role.index');

        }else{
            Alert::error('Ha Ocurrido un error', 'No se actualizo el registro del Rol');
            return redirect()->route('role.index');

        }     
        
     
     }
     public function destroy($id){
        $role = Role::findOrFail($id);
        
        if($role->delete()){
            Alert::toast('Role eliminado con exito', 'success');
            return redirect()->route('role.index');
           
        }else{
            Alert::error('Ha Ocurrido un error', 'No se elimino el registro del Rol');
            return redirect()->route('role.index'); 
     
        }
     }
     public function verPermisos($id){
         
        $roles_permisos = Role::findById($id)->permissions()->pluck('name');        
        return response()->json($roles_permisos);
     
     
     }
}
