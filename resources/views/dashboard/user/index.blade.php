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
            <h1 class="headline-xl-govco">Administracion de Usuarios</h1>
            <div class="row pt-5">                
                <div class="col-md-12 justify-content-center">

                    <div class="card govco-card animate__animated animate__bounceInRight">
                        <div class="card-header govco-card-header">
                            <span class="govco-icon govco-icon-tramite-presencial size-3x pr-3"> </span>
                            Usuarios
                        </div>

                        <div class="col-md-12 justify-content-center pt-4">
                            <div id="container_table" class="table-pagination-govco">

                                <table id="DataTables_Table_0"
                                    class="table display table-responsive-sm table-responsive-md tablas" width="100%"
                                    style="text-align: left!important;">
                                    <thead>
                                        <tr>
                                            <th style="color: #004884;" class="">Id</th>
                                            <th style="color: #004884;">Nombre</th>
                                            <th style="color: #004884;;">Correo</th>
                                            <th style="color: #004884;;">Oficina</th>
                                            <th style="color: #004884;;">Tipo Contrato</th>
                                            <th style="color: #004884;;">Acciones</th>


                                           


                                        </tr>
                                    </thead>

                                    <tbody>

                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->secretaria }}</td>
                                                <td>{{ $user->tipo_contrato }}</td>

                                                <td>   
                                                    <div class="btn-group" role="group">
                                                        @hasrole('SUPER-ADMIN')
                                                    <a class="btn btn-sm btn-warning assignRole" href="{{route('user.editRoles', $user->id)}}">
                                                        Asignar Roles </a>
                                                        <a class="btn btn-sm btn-primary assignPermissions" href="{{route('user.editPermissions', $user->id)}}">
                                                            Asignar Permisos </a> 
                                                            @endrole
                                                            @hasrole('ADMIN')
                                                            <a class="btn btn-sm btn-success" href="{{route('user.editPermissionsAdmin', $user->id)}}">Asignar Permisos</a>
                                                            @endrole
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
                                style="float: left;">Inicio</a>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
    </div>

    <script>         
                            
          
    </script>

@endsection