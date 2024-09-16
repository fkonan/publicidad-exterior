<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function __construct()

    {
        $this->middleware('auth');
    }


    public function index()
    {

        $permisos = Permission::all();
        return view('dashboard.permisos.index', compact('permisos'));
    }

    public function store(Request $request)
    {

        $request->validate(['name' => 'required|unique:permissions']);

        $permisos = Permission::create(['name' => $request->name]);
        if ($permisos) {
            Alert::toast('Permiso creado con exito', 'success');
            return redirect('/dashboard/permission');
        } else {
            Alert::error('Ha Ocurrido un error', 'No se realizo el registro del permiso');
            return redirect()->route('permisos.index');
        }
    }
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('dashboard.permisos.edit', compact('permission'));
    }

    public function update(Request $request)
    {
        $request->validate(['name' => 'required|unique:permissions,name,', $request->id,]);
        $role = Permission::findOrFail($request->id);
        $role->update($request->all());
        if ($role) {
            Alert::toast('Permiso actualizado con exito', 'success');
            return redirect()->route('permisos.index');
        } else {
            Alert::error('Ha Ocurrido un error', 'No se realizo actualización del permiso');
            return redirect()->route('permisos.index');
        }
    }
    public function destroy($id)
    {

        $permission = Permission::findOrFail($id);

        if ($permission->delete()) {
            Alert::toast('Permiso eliminado con exito', 'success');
            return redirect()->route('permisos.index');
        } else {
            Alert::error('Ha Ocurrido un error', 'No se realizo el delete del permiso');
            return redirect()->route('permisos.index');
        }
    }
}
