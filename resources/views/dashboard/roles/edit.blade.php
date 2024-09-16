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
                                        Roles
                                    </b></p>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="col-md-12 pt-4">
            <h1 class="headline-xl-govco">Editar Roles</h1>
            <div class="row justify-content-center pt-5">
                <div class="col-md-6 justify-content-center">
                    <form method="POST" action="{{route('role.update')}}">
                        @csrf
                        <div class="card govco-card animate__animated animate__bounceInRight">
                            <div class="card-header govco-card-header">
                                <span class="govco-icon govco-icon-share-p size-3x pr-3"> </span>
                                Roles
                            </div>
                            <div class="card-body">
                                <input type="text" name="name" id="name" class="form-control input-md @error('name') is-invalid @enderror" required="required"
                                    onkeypress="return Direccion(event)" maxlength="40" minlength="3"
                                    value="{{ $roles_edit->name }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror

                                <div class="mb-3 form-group ">
                                    @foreach ($permissions as $permiso)

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="permission[]"
                                                id="permission_{{ $permiso->id }}" value="{{ $permiso->id }}" @if (is_array(old('permission')) && in_array("
                                                $permiso->id", old('permission'))) checked

                                        @elseif(is_array($permission_role) &&
                                            in_array("$permiso->id",$permission_role))
                                            checked @endif>
                                            <label class="custom-control-label"
                                                for="permission_{{ $permiso->id }}">{{ $permiso->name }}</label>
                                        </div>
                                    @endforeach
                                    <!--- La función is_array () comprueba si una variable es una matriz o no.--->
                                    <!--La función in_array () busca en una matriz un valor específico.-->



                                </div>
                            </div>
                            <div class="card-footer govco-card-footer">
                                <input type="hidden" name="id" value="{{$roles_edit->id}}">
                                <button type="submit" class="btn btn-round btn-middle btn-outline-info" id="Boton">Editar Rol</button>
                                <button type="button" class="btn btn-round btn-middle btn-outline-info"
                                    data-dismiss="modal"><a href="{{ url('/dashboard/role') }}">Volver</a></button>

                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>




    </div>

@endsection
