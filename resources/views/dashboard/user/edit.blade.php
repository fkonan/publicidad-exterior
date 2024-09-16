@extends('layouts.menu')

@section('dashboard')

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
                                <a style="color: #004fbf;" class="breadcrumb-text" href="#">Dashboard</a>
                            </div>
                        </li>
                        <li class="breadcrumb-item ">
                            <div class="image-icon">
                                <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                                <p class="ml-3 ml-md-0 "><b style="color: #004fbf;text-transform: none;">
                                        Usuarios
                                    </b></p>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="col-md-12 pt-4">
            <h1 class="headline-xl-govco">Editar Roles de Usuarios</h1>
            <div class="row justify-content-center pt-5">
                <div class="col-md-6 justify-content-center">
                    <form method="POST" action="{{route('user.update')}}">
                        @csrf
                        <div class="card govco-card animate__animated animate__bounceInRight">
                            <div class="card-header govco-card-header">
                                <span class="govco-icon govco-icon-share-p size-3x pr-3"> </span>
                                Roles
                            </div>
                            <div class="card-body">
                                <label for="name">Username</label>
                                <input type="text" name="name" id="name"
                                    class="form-control input-md" required="required"
                                    onkeypress="return Direccion(event)" maxlength="40" minlength="3"
                                    value="{{ $user_data->username }}" readonly>
                                                               
                                    {{-- @foreach ($roles as $role)
                                       
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="roles[]"
                                                id="role_{{ $role->id }}" value="{{ $role->id }}" @if (is_array(old('roles')) && in_array("
                                                $permiso->id", old('roles'))) checked
                                           @elseif(is_array($usuarios_role) &&
                                            in_array("$role->id",$usuarios_role))
                                            checked @endif>
                                            <label class="custom-control-label"
                                                for="permission_{{ $role->id }}">{{ $role->name }}</label>
                                        
                                        </div>
                                    @endforeach --}}
                                    <!--- La función is_array () comprueba si una variable es una matriz o no.--->
                                    <!--La función in_array () busca en una matriz un valor específico.-->

                                  <div class="form-group pt-3">

                                     <label for="selectRoles">Selecciones Roles</label>
                                    <select multiple="multiple" class="form-control" name="roles[]" id="selectRoles"  title="Selecciona los roles">
                                        <option value=""></option>
                                        @foreach ($roles as $role)
                                       <option value="{{$role->id}}" @if (is_array(old('roles')) && in_array("
                                        $role->id", old('roles'))) selected @elseif(is_array($usuarios_role) && in_array("$role->id",$usuarios_role))
                                    selected @endif>{{$role->name}}</option>
                                        @endforeach



                                    </select>
                                    

                                  </div>
                                  

                                
                            </div>
                            <div class="card-footer govco-card-footer">
                                <input type="hidden" name="id" value="{{$user_data->id}}">
                                <button type="submit" class="btn btn-round btn-middle btn-outline-info" id="Boton">Editar Roles de Usuario</button>
                                <button type="button" class="btn btn-round btn-middle btn-outline-info"
                                    ><a href="{{ url('/dashboard/users') }}">Volver</a></button>

                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>




    </div>

@endsection
