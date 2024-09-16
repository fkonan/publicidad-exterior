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
                                        Permisos
                                    </b></p>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="col-md-12 pt-4">
            <h1 class="headline-xl-govco">Editar Permisos</h1>
            <div class="row justify-content-center pt-5">
                <div class="col-md-6 justify-content-center">
                    <form method="POST" action="{{route('permisos.update')}}">
                        @csrf
                        <div class="card govco-card animate__animated animate__bounceInRight">
                        <div class="card-header govco-card-header">
                            <span class="govco-icon govco-icon-key-cn size-3x pr-3"> </span>
                            Permisos
                        </div>
                        <div class="card-body">
                            <input type="text" name="name" id="name" class="form-control input-md @error('name') is-invalid @enderror"
                                         required="required" onkeypress="return Direccion(event)" maxlength="40" minlength="3" value="{{$permission->name}}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                          </div>
                          <div class="card-footer govco-card-footer">
                            <input type="hidden" name="id" value="{{$permission->id}}">
                            <button type="submit" class="btn btn-round btn-middle btn-outline-info" id="Boton">Editar Permiso</button>
                            <button type="button" class="btn btn-round btn-middle btn-outline-info"
                                data-dismiss="modal"><a href="{{url('/dashboard/permission')}}">Volver</a></button>
                            
                          </div>

                    </div>
                    </form>
                </div>
            </div>
        </div>




    </div>

@endsection
