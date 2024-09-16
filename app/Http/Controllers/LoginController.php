<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use App\User;
use App\Session;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class LoginController extends Controller
{
   //

   public function login(Request $request)
   {


      $credentials = $request->only('username', 'password');
      if (Auth::attempt($credentials)) {

         $session = Session::create([
            'user' => $request->username,
            'action' => 'LOGIN'
         ]);

         return redirect()->route('dashboard.index');
      } else {
         Alert::error('Ha Ocurrido un error', 'No ha sido posible crear la sesión');
         return redirect('/');
      }



      //conexion a dominio
      define('DOMINIO', 'bucaramanga.gov.co');
      define('DN', 'dc=bucaramanga,dc=gov,dc=co');
      $puertoldap = 389;
      $dn = DN;
      $user = trim($request->username) . '@' . DOMINIO;

      //conexion a al servidor de directorios
      $ldapconn = ldap_connect("LDAP://131.110.1.2", $puertoldap) or die("Could not connect to LDAP server.");
      ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
      ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);


      if ($ldapconn) {

         $ldapbind = @ldap_bind($ldapconn, $user, $request->password);

         if ($ldapbind) {
            $filter = "(|(SAMAccountName=" . trim($request->username) . "))";
            $fields = array("SAMAccountName", "description", "physicaldeliveryofficename", "userprincipalname", "distinguishedname", "dn");

            $sr = ldap_search($ldapconn, $dn, $filter, $fields);
            $info = ldap_get_entries($ldapconn, $sr);
            $tipo = $info[0]['description']['0'];
            $secretaria = $info[0]['physicaldeliveryofficename']['0'];
            $arrayOU = explode(',', $info[0]['dn']);
            $nombre = str_replace("CN=", "", $arrayOU[0]);
            $objeto = str_replace("OU=", "", $arrayOU[1]);

            $consultaUser = User::where('email', $user)->get(); // valida si ya existe

            if ($consultaUser->count() < 1 || $consultaUser->isEmpty()) {

               $usuario = User::create([
                  'name' => $nombre,
                  'email' => $user,
                  'username' => $request->username,
                  'secretaria' => $secretaria,
                  'tipo_contrato' => $tipo,
                  'password' => Hash::make($request->password),


               ]);
               $usuario->assignRole($objeto);
            } else {
               //update user
               $userCurrent = User::findOrFail($consultaUser[0]->id);
               $userCurrent->password = Hash::make($request->password);
               $userCurrent->save();
            }


            $credentials = $request->only('username', 'password');
            if (Auth::attempt($credentials)) {

               $session = Session::create([
                  'user' => $request->username,
                  'action' => 'LOGIN'
               ]);

               return redirect()->route('dashboard.index');
            } else {
               Alert::error('Ha Ocurrido un error', 'No ha sido posible crear la sesión');
               return redirect('/');
            }
         } else {
            return back()->withErrors(['username' => 'usuario no valido', 'password' => 'password no valido']) // devuelve los errores
               ->withInput($request->old('username'), $request->old('password'));
         }
      }
   }

   public function logout($user)
   {

      Auth::logout();
      $session = Session::create([
         'user' => $user,
         'action' => 'LOGOUT'
      ]);
      return redirect('/');
   }
}
