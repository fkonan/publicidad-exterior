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
            <h1 class="headline-xl-govco">Administracion de Roles</h1>
            <div class="row pt-5">
                <div class="col-md-4">
                    <button type="button" class="btn btn-round btn-high-mix-govco btn-high-inactive btn-rol">
                        <span class="btn-govco-text text-white">Crear Rol</span>
                        <span class="govco-icon govco-icon-right-arrow text-white"></span>
                    </button>
                </div>
                <div class="col-md-12 justify-content-center">

                    <div class="card govco-card animate__animated animate__bounceInRight">
                        <div class="card-header govco-card-header">
                            <span class="govco-icon govco-icon-share-p size-3x pr-3"> </span>
                            Roles
                        </div>

                        <div class="col-md-12 justify-content-center pt-4">
                            <div id="container_table" class="table-pagination-govco">

                                <table id="DataTables_Table_0"
                                    class="table display table-responsive-sm table-responsive-md tablas" width="100%"
                                    style="text-align: left!important;">
                                    <thead>
                                        <tr>
                                            <th style="color: #004884;" class="">id</th>
                                            <th style="color: #004884;">Rol</th>
                                            <th style="color: #004884;;">Acciones</th>


                                        </tr>
                                    </thead>

                                    <tbody>

                                        @foreach ($roles as $role)
                                            <tr>
                                                <td>{{ $role->id }}</td>
                                                <td>{{ $role->name }}</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                    <a class="btn btn-sm btn-warning" href="{{ route('role.edit', $role->id) }}">
                                                        Editar </a>
                                                    <a class="btn btn-sm btn-danger"
                                                        onclick="return confirm('¿ Estas seguro de eliminar este registro ?')"
                                                        href="{{ route('role.destroy', $role->id) }}"> Eliminar </a>
                                                    <a class="btn btn-sm btn-success btn-permisos"
                                                        idPermisos="{{ $role->id }}"> Ver Permisos </a>
                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>

                                </table>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <a class="btn btn-round btn-high" href="{{ url('/dashboard') }}"
                                style="float: left;">Volver</a>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
    </div>

    {{-- Modal de crear Roles --}}

    <div id="ModalRoles" class="modal fade center" role="dialog">
        <div class="modal-dialog modal-md">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="background:#E5EEFB;">
                    <h4 class="modal-title">Crear Rol</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="post" action="{{ route('role.create') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row form-row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><br>
                                <div class="form-group">
                                    <label style="color:#111111;" class="input" for="DD01"
                                        style="font-family: 'Barlow', sans-serif;">Nuevo Rol </label>
                                    <input type="text" name="name" value="{{ old('name') }}" id="name"
                                        class="form-control input-md @error('name') is-invalid @enderror"
                                        title="Digite nombre del Rol" required="required"
                                        onkeypress="return Direccion(event)" maxlength="50" minlength="3">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div id="resultado_dos" class="mb-3 form-group">

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">

                        <button type="submit" class="btn btn-round btn-middle btn-outline-info" id="Boton">Crear</button>
                        <button type="button" class="btn btn-round btn-middle btn-outline-info"
                            data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- modal de ver roles --}}

    <div class="modal fade" id="ModalVerRoles" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header" style="background:#E5EEFB;">
                    <h5 class="modal-title" id="ModalVerRoles">Ver Permisos Por Roles</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div id="resultado"></div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-round btn-middle btn-outline-info"
                        data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        // AJAX PARA CARGAR PERMISOS EN LOS ROLES

        $('.btn-rol').click(function() {

            $.ajax({
                type: 'GET',
                url: '/roles/create',
                success: function(response) {

                    console.log(response);
                    $('#resultado_dos').html('<div>');
                    for (var permiso in response) {
                        $('#resultado_dos').append(
                            '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" name="permission[]" id="permission_' +
                            permiso + '" value="' + parseInt(permiso) +
                            '"><label class="custom-control-label" for="permission_' + permiso +
                            '">' + response[permiso] + '</label></div>');
                    }
                    $('#resultado_dos').append('</div>');
                    $('#ModalRoles').modal('show');


                }
            });

        });

        // btn ajax para ver roles

        $('.btn-permisos').click(function() {

            var id = $(this).attr("idPermisos");

            $.ajax({
                type: 'GET',
                url: '/roles/ver/' + id,
                success: function(resp) {

                    console.log(resp);
                    $('#resultado').html('<ol>');
                    for (var permiso of resp) {
                        $('#resultado').append('<li>' + permiso + '</li>');
                    }
                    $('#resultado').append('</ol>');
                    $('#ModalVerRoles').modal('show');


                }
            });
        })

    </script>

    {{-- seccion de errores volvemos a llamar la funcion --}}

    @if (Session::has('errors'))

        <script>
            // AJAX PARA CARGAR PERMISOS EN LOS ROLES
            $.ajax({
                type: 'GET',
                url: '/roles/create',
                success: function(response) {

                    console.log(response);
                    $('#resultado_dos').html('<div>');
                    for (var permiso in response) {
                        $('#resultado_dos').append(
                            '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" name="permission[]" id="permission_' +
                            permiso + '" value="' + parseInt(permiso) +
                            '"><label class="custom-control-label" for="permission_' + permiso +
                            '">' + response[permiso] + '</label></div>');
                    }
                    $('#resultado_dos').append('</div>');
                    $('#ModalRoles').modal('show');


                }
            });

        </script>






    @endif








@endsection
