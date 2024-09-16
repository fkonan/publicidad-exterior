@extends('layouts.app')
@section('title', 'tramites en linea')

@section('content')

<div class="container mt-3 mb-4 m-xs-x-3">
  <div class="row pl-4">
      <div class="px-0 col-md-9">
          <nav aria-label="Miga de pan" style="max-height: 20px;">
              <ol class="breadcrumb" style="background-color: #FFFFFF;">
                  <li class="breadcrumb-item ml-3 ml-md-0">
                      <a style="color: #004fbf;" class="breadcrumb-text" href="https://www.gov.co/home/">Inicio</a>
                  </li>
                  <li class="breadcrumb-item ">
                      <div class="image-icon">
                          <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                          <a style="color: #004fbf;" class="breadcrumb-text" href="#">Tramites y servicios</a>
                      </div>
                  </li>
                  <li class="breadcrumb-item ">
                      <div class="image-icon">
                          <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                          <p class="ml-3 ml-md-0 "><b style="color: #004fbf;text-transform: none;">
                                  Inicio de sesión
                              </b></p>
                      </div>
                  </li>
              </ol>
          </nav>
      </div>
  </div>
 

<div class="container pt-3">
    <div class="row justify-content-center">      
       <div class="col-12 col-sm-12 col-md-4">      
          <div class="govco-form-signin">
         <form method="POST" role="form" action="{{route('login')}}">
          @csrf
          <div clas="text-center" align="center" >
        <span  class=" bd-highlight govco-icon govco-icon-key-cn"></span>
          </div><br>
      <h3 align="center" class="govco-title-sign-form headline-l-govco">Inicio de sesión</h3>
      <div class="form-group"><br>
        @if(session()->has('flash'))
            
        <div class="alert alert-warning alert-dismissible fade show" role="alert">{{session('flash')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></div>

        @endif
        <label for="inputEmail-govco">Usuario</label>       
        <input type="text" class="form-control input-govco @error('username') is-invalid @enderror" maxlength="15" id="username" name="username" value="{{old('username')}}" onkeypress="return Letras(event)" required autofocus>
        @error('username')
          <span class="invalid-feedback text-danger" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
              </span>
          @enderror
             
      </div>
      <div class="form-group">
        <label for="inputPassword-govco">Contraseña</label>
        <input type="password" class="form-control input-govco @error('password') is-invalid @enderror" maxlength="20" id="password_ldap" name="password" required>
        @error('password')
        <span class="invalid-feedback" role="alert">
          <strong class="text-danger">{{ $message }}</strong>
            </span>
        @enderror 
      </div>
      <div class="row">    
    </div>
      
      <div class="d-flex d-flex justify-content-between">
             <div class="checkbox mb-3">
                <label class="checkbox-govco">
                    <input type="checkbox" id="checkboxPassword-govco" class="check_pass" />
                    <label class="label_checkbox" for="checkboxPassword-govco"> Mostrar contraseña</label><br>
                </label><br>
              </div>
               <div class="d-flex d-flex justify-content-between">          
              <button type="submit" name="Boton" value="Boton" id="botonLogin" class="btn btn-sm btn-round btn-high mr-0 btn-block" style="height: fit-content; font-size: smaller;">Iniciar Sesión</button>
              </div>
          
      </div>
    </form>      
    </div>
    
  
  <div class="govco-form-sign-links">
    <div class="row">
     <div class="col-md-6 col-sm-12 col-12" id="btn_href">
    {{-- <a href="Forms/formRecoverPasswd.php" class="btn-low" style="font-size: smaller;">Olvidé mi contraseña</a> --}}
    </div>
    <div class="col-md-6 col-sm-12 col-12" id="btn_href">
    <!--<a href="Forms/formRegistrarUsuarios.php" class="btn-low" style="font-size: smaller; float: right;" id="btn_child_href" >Registrarme</a>-->
  </div>
  </div>
</div>
</div>
 </div>
</div>
</div>




@endsection