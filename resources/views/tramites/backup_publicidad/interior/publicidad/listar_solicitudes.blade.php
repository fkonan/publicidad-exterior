@extends('layouts.menu')

@section('dashboard')

    <style>
        th.sorting_desc::after,
        th.sorting_asc::after {
            right: 0 !important;
            content: "" !important;
        }

    </style>

    <?php $tramite = 'PUBLICIDAD EXTERIOR'; ?>
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
                                <a style="color: #004fbf;" class="breadcrumb-text" href="#">Tramites en Linea</a>
                            </div>
                        </li>
                        <li class="breadcrumb-item ">
                            <div class="image-icon">
                                <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                                <a style="color: #004fbf;" class="breadcrumb-text" href="#">
                                    Interior</a>
                            </div>
                        </li>
                        <li class="breadcrumb-item ">
                            <div class="image-icon">
                                <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                                <p class="ml-3 ml-md-0 ">
                                    <b style="color: #004fbf;text-transform: none;">
                                        Publicidad Exterior
                                    </b>
                                </p>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-md-12 pt-4" style="padding-left: 10px!important">
            <h1 class="headline-xl-govco">Solicitudes de {{ $modalidad }}</h1>
            <div class="row pt-5">

                @if ($porCerrar > 0)
                    <div class="col-md-4 pb-4">
                        <button type="button" class="btn btn-danger btn-block btn-sm"
                            style="background-color:#A80521!important;">
                            <span class="govco-icon govco-icon-exclamation-cn size-1x text-white"></span> &nbsp; Solicitudes
                            pendientes por cerrarse automaticamente <span
                                class="badge badge-light">{{ $porCerrar }}</span>
                        </button>
                    </div>
                @endif

                @if ($porCerrarPlaneacion > 0)
                    <div class="col-md-4 pb-4">
                        <button type="button" class="btn btn-warning btn-block btn-sm"
                            style="background-color:#FFAB00!important;">
                            <span class="govco-icon govco-icon-exclamation-cn size-1x text-white"></span>Solicitudes
                            pendientes de Concepto Técnico por cerrarse <span
                                class="badge badge-light">{{ $porCerrarPlaneacion }}</span>
                        </button>
                    </div>
                @endif
                <div class="tabs-govco col-md-12 animate__animated animate__bounceInRight">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                aria-controls="home" aria-selected="true">Enviadas <span
                                    class="badge badge-primary">{{ $count_enviadas }}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pendientes-tab" data-toggle="tab" href="#pendientes" role="tab"
                                aria-controls="pendientes" aria-selected="false">Pendientes <span
                                    class="badge badge-primary">{{ $count_pendientes }}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="documentos-tab" data-toggle="tab" href="#documentos" role="tab"
                                aria-controls="documentos" aria-selected="false">Doc. Actualizados <span
                                    class="badge badge-primary">{{ $count_documentos }}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                aria-controls="profile" aria-selected="false">En Concepto Técnico <span
                                    class="badge badge-primary">{{ $count_enRevision }}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab"
                                aria-controls="messages" aria-selected="false">Respuesta Concepto Técnico <span
                                    class="badge badge-primary">{{ $count_revisadas }}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab"
                                aria-controls="settings" aria-selected="false">Requisitos Finales <span
                                    class="badge badge-primary">{{ $count_requisitos }}</span></a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" id="rechazadas-tab" data-toggle="tab" href="#rechazadas" role="tab"
                                aria-controls="rechazadas" aria-selected="false">Rechazadas <span
                                    class="badge badge-primary">{{ $count_rechazadas }}</span></a>
                        </li> --}}
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            {{-- TABLA DE ENVIADOS --}}
                            <div class="col-md-12 pt-4">
                                <div id="container_table" class="table-pagination-govco">
                                    <table id="DataTables_Table_0"
                                        class="table display table-responsive-md table-responsive-md tablas tablas-publicidad" width="100%"
                                        style="text-align: left!important;">
                                        <thead>
                                            <tr>
                                                <th style="color: #004884;">Radicado</th>
                                                <th style="color: #004884;">Nombres Solicitante</th>
                                                <th style="color: #004884;">Identificación del solicitante</th>
                                                <th style="color: #004884;">Correo del Solicitante</th>
                                                <th style="color: #004884;">Teléfono del solicitante</th>
                                                <th style="color: #004884;;">Detalle</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sEnviadas as $solicitudesE)
                                                <tr>
                                                    <td>{{ $solicitudesE->radicado }}</td>
                                                    <td>{{ $solicitudesE->nombre_responsable }}
                                                        {{ $solicitudesE->apellido_responsable }} </td>
                                                    <td>{{ $solicitudesE->numero_documento }}</td>
                                                    <td>{{ $solicitudesE->email_responsable }}</td>
                                                    <td>{{ $solicitudesE->telefono_responsable }}</td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a type="button" class="btn-symbolic-govco align-column-govco"
                                                                href="{{ route('interior.publicidad.detalle', $solicitudesE->id) }}">
                                                                <span class="govco-icon govco-icon-attached-n"></span>
                                                                <span class="btn-govco-text">Detalles</span>
                                                            </a>

                                                            <a type="button"
                                                                class="btn-symbolic-govco align-column-govco pl-0 ml-0"
                                                                href="{{ route('tramite.trazabilidad', ['radicado' => $solicitudesE->radicado, 'tramite' => $tramite]) }}">
                                                                <span class="govco-icon govco-icon-analytic-cn"></span>
                                                                <span class="btn-govco-text text-sm">Trazabilidad</span>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- </ TABLA DE ENVIADOS FIN --}}
                        </div>
                        <div class="tab-pane" id="pendientes" role="tabpanel" aria-labelledby="pendientes-tab">

                            {{-- TABLA PENDIENTES --}}
                            <div class="col-md-12 pt-4">
                                <div id="container_table" class="table-pagination-govco">
                                    <table id="DataTables_Table_0"
                                        class="table display table-responsive-md table-responsive-md tablas tablas-publicidad" width="100%"
                                        style="text-align: left!important;">
                                        <thead>
                                            <tr>
                                                <th style="color: #004884;">Radicado</th>
                                                <th style="color: #004884;">Nombres Solicitante</th>
                                                <th style="color: #004884;">Identificación del solicitante</th>
                                                <th style="color: #004884;">Correo del Solicitante</th>
                                                <th style="color: #004884;">Teléfono del solicitante</th>
                                                <th style="color: #004884;;">Detalle</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sPendientes as $solicitudesP)
                                                <tr>
                                                    <td>{{ $solicitudesP->radicado }}</td>
                                                    <td>{{ $solicitudesP->nombre_responsable }}
                                                        {{ $solicitudesP->apellido_responsable }} </td>
                                                    <td>{{ $solicitudesP->numero_documento }}</td>
                                                    <td>{{ $solicitudesP->email_responsable }}</td>
                                                    <td>{{ $solicitudesP->telefono_responsable }}</td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a type="button" class="btn-symbolic-govco align-column-govco"
                                                                href="{{ route('interior.publicidad.detalle', $solicitudesP->id) }}">
                                                                <span class="govco-icon govco-icon-attached-n"></span>
                                                                <span class="btn-govco-text">Detalles</span>
                                                            </a>

                                                            <a type="button"
                                                                class="btn-symbolic-govco align-column-govco pl-0 ml-0"
                                                                href="{{ route('tramite.trazabilidad', ['radicado' => $solicitudesP->radicado, 'tramite' => $tramite]) }}">
                                                                <span class="govco-icon govco-icon-analytic-cn"></span>
                                                                <span class="btn-govco-text text-sm">Trazabilidad</span>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- </ TABLA DE PENDIENTES FIN --}}
                        </div>

                        <div class="tab-pane" id="documentos" role="tabpanel" aria-labelledby="documentos-tab">

                            {{-- TABLA DOCUMENTOS ACTUALIZADOS --}}
                            <div class="col-md-12 pt-4">
                                <div id="container_table" class="table-pagination-govco">
                                    <table id="DataTables_Table_0"
                                        class="table display table-responsive-md table-responsive-md tablas tablas-publicidad" width="100%"
                                        style="text-align: left!important;">
                                        <thead>
                                            <tr>
                                                <th style="color: #004884;">Radicado</th>
                                                <th style="color: #004884;">Nombres Solicitante</th>
                                                <th style="color: #004884;">Identificación del solicitante</th>
                                                <th style="color: #004884;">Correo del Solicitante</th>
                                                <th style="color: #004884;">Teléfono del solicitante</th>
                                                <th style="color: #004884;;">Detalle</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sDocumentos as $solicitudesE)
                                                <tr>
                                                    <td>{{ $solicitudesE->radicado }}</td>
                                                    <td>{{ $solicitudesE->nombre_responsable }}
                                                        {{ $solicitudesE->apellido_responsable }} </td>
                                                    <td>{{ $solicitudesE->numero_documento }}</td>
                                                    <td>{{ $solicitudesE->email_responsable }}</td>
                                                    <td>{{ $solicitudesE->telefono_responsable }}</td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a type="button" class="btn-symbolic-govco align-column-govco"
                                                                href="{{ route('interior.publicidad.detalle', $solicitudesE->id) }}">
                                                                <span class="govco-icon govco-icon-attached-n"></span>
                                                                <span class="btn-govco-text">Detalles</span>
                                                            </a>

                                                            <a type="button"
                                                                class="btn-symbolic-govco align-column-govco pl-0 ml-0"
                                                                href="{{ route('tramite.trazabilidad', ['radicado' => $solicitudesE->radicado, 'tramite' => $tramite]) }}">
                                                                <span class="govco-icon govco-icon-analytic-cn"></span>
                                                                <span class="btn-govco-text text-sm">Trazabilidad</span>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- </ TABLA DE DOCUMENTOS ACTUALIZADOS FIN --}}
                        </div>
                        <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                            {{-- TABLA EN REVISION DE PLANEACION --}}
                            <div class="col-md-12 pt-4">
                                <div id="container_table" class="table-pagination-govco">
                                    <table id="DataTables_Table_0"
                                        class="table display table-responsive-md table-responsive-md tablas tablas-publicidad" width="100%"
                                        style="text-align: left!important;">
                                        <thead>
                                            <tr>
                                                <th style="color: #004884;">Radicado</th>
                                                <th style="color: #004884;">Nombres Solicitante</th>
                                                <th style="color: #004884;">Identificación del solicitante</th>
                                                <th style="color: #004884;">Correo del Solicitante</th>
                                                <th style="color: #004884;">Teléfono del solicitante</th>
                                                <th style="color: #004884;">Detalle</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sEnRevision as $solicitudesE)
                                                <tr>
                                                    <td>{{ $solicitudesE->radicado }}</td>
                                                    <td>{{ $solicitudesE->nombre_responsable }}
                                                        {{ $solicitudesE->apellido_responsable }} </td>
                                                    <td>{{ $solicitudesE->numero_documento }}</td>
                                                    <td>{{ $solicitudesE->email_responsable }}</td>
                                                    <td>{{ $solicitudesE->telefono_responsable }}</td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a type="button" class="btn-symbolic-govco align-column-govco"
                                                                href="{{ route('interior.publicidad.detalle', $solicitudesE->id) }}">
                                                                <span class="govco-icon govco-icon-attached-n"></span>
                                                                <span class="btn-govco-text">Detalles</span>
                                                            </a>

                                                            <a type="button"
                                                                class="btn-symbolic-govco align-column-govco pl-0 ml-0"
                                                                href="{{ route('tramite.trazabilidad', ['radicado' => $solicitudesE->radicado, 'tramite' => $tramite]) }}">
                                                                <span class="govco-icon govco-icon-analytic-cn"></span>
                                                                <span class="btn-govco-text text-sm">Trazabilidad</span>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- </ TABLA EN REVISION DE PLANEACION FIN --}}
                        </div>
                        <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                            {{-- TABLA REVISADAS PLANEACION --}}
                            <div class="col-md-12 pt-4">
                                <div id="container_table" class="table-pagination-govco">
                                    <table id="DataTables_Table_0"
                                        class="table display table-responsive-md table-responsive-md tablas" width="100%"
                                        style="text-align: left!important;">
                                        <thead>
                                            <tr>
                                                <th style="color: #004884;">Radicado</th>
                                                <th style="color: #004884;">Nombres Solicitante</th>
                                                <th style="color: #004884;">Identificación del solicitante</th>
                                                <th style="color: #004884;">Correo del Solicitante</th>
                                                <th style="color: #004884;">Teléfono del solicitante</th>
                                                <th style="color: #004884;;">Detalle</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sRevisadas as $solicitudesE)
                                                <tr>
                                                    <td>{{ $solicitudesE->radicado }}</td>
                                                    <td>{{ $solicitudesE->nombre_responsable }}
                                                        {{ $solicitudesE->apellido_responsable }} </td>
                                                    <td>{{ $solicitudesE->numero_documento }}</td>
                                                    <td>{{ $solicitudesE->email_responsable }}</td>
                                                    <td>{{ $solicitudesE->telefono_responsable }}</td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a type="button" class="btn-symbolic-govco align-column-govco"
                                                                href="{{ route('interior.publicidad.detalle', $solicitudesE->id) }}">
                                                                <span class="govco-icon govco-icon-attached-n"></span>
                                                                <span class="btn-govco-text">Detalles</span>
                                                            </a>

                                                            <a type="button"
                                                                class="btn-symbolic-govco align-column-govco pl-0 ml-0"
                                                                href="{{ route('tramite.trazabilidad', ['radicado' => $solicitudesE->radicado, 'tramite' => $tramite]) }}">
                                                                <span class="govco-icon govco-icon-analytic-cn"></span>
                                                                <span class="btn-govco-text text-sm">Trazabilidad</span>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- </ TABLA DE REVISADAS PLANEACION FIN --}}
                        </div>
                        {{-- tabla requsitos --}}
                        <div class="tab-pane" id="settings" role="tabpanel" aria-labelledby="settings-tab">

                            
                            <div class="col-md-12 pt-4">
                                <div id="container_table" class="table-pagination-govco">
                                    <table id="DataTables_Table_0"
                                        class="table display table-responsive-md table-responsive-md tablas" width="100%"
                                        style="text-align: left!important;">
                                        <thead>
                                            <tr>
                                                <th style="color: #004884;">Estado Requisitos</th>
                                                <th style="color: #004884;">Radicado</th>
                                                <th style="color: #004884;">Nombres Solicitante</th>
                                                <th style="color: #004884;">Identificación del solicitante</th>
                                                <th style="color: #004884;">Correo del Solicitante</th>
                                                <th style="color: #004884;">Teléfono del solicitante</th>
                                                <th style="color: #004884;;">Detalle</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sRequisitos as $solicitudesE)
                                                <tr>
                                                    <td>@if($solicitudesE->act_documentos == 'SI')
                                                        <div class="tag-govco tag-positive">
                                                          <span class="label text-success">Requisitos Cargados</span><span class="govco-icon govco-icon-check-cn size-2x tag-remove" aria-label="Close"></span>
                                                        </div>
                                                        @else
                                                        <div class="tag-govco tag-positive">
                                                          <span class="label text-danger">Requisitos sin Cargar</span><span class="govco-icon govco-icon-x-cn size-2x tag-remove" aria-label="Close"></span>
                                                        </div>                                            
                                                        @endif
                                                        </td> 
                                                    <td>{{ $solicitudesE->radicado }}</td>
                                                    <td>{{ $solicitudesE->nombre_responsable }}
                                                        {{ $solicitudesE->apellido_responsable }} </td>
                                                    <td>{{ $solicitudesE->numero_documento }}</td>
                                                    <td>{{ $solicitudesE->email_responsable }}</td>
                                                    <td>{{ $solicitudesE->telefono_responsable }}</td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a type="button" class="btn-symbolic-govco align-column-govco"
                                                                href="{{ route('interior.publicidad.detalle', $solicitudesE->id) }}">
                                                                <span class="govco-icon govco-icon-attached-n"></span>
                                                                <span class="btn-govco-text">Detalles</span>
                                                            </a>

                                                            <a type="button"
                                                                class="btn-symbolic-govco align-column-govco pl-0 ml-0"
                                                                href="{{ route('tramite.trazabilidad', ['radicado' => $solicitudesE->radicado, 'tramite' => $tramite]) }}">
                                                                <span class="govco-icon govco-icon-analytic-cn"></span>
                                                                <span class="btn-govco-text text-sm">Trazabilidad</span>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
                        {{-- tabla rechazadas --}}
                        {{-- <div class="tab-pane" id="rechazadas" role="tabpanel" aria-labelledby="rechazadas-tab">
                            
                            <div class="col-md-12 pt-4">
                                <div id="container_table" class="table-pagination-govco">
                                    <table id="DataTables_Table_0"
                                        class="table display table-responsive-md table-responsive-md tablas" width="100%"
                                        style="text-align: left!important;">
                                        <thead>
                                            <tr>
                                                <th style="color: #004884;">Radicado</th>
                                                <th style="color: #004884;">Nombres Solicitante</th>
                                                <th style="color: #004884;">Identificación del solicitante</th>
                                                <th style="color: #004884;">Correo del Solicitante</th>
                                                <th style="color: #004884;">Teléfono del solicitante</th>
                                                <th style="color: #004884;;">Detalle</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sEnviadas as $solicitudesE)
                                                <tr>
                                                    <td>{{ $solicitudesE->radicado }}</td>
                                                    <td>{{ $solicitudesE->nombre_responsable }}
                                                        {{ $solicitudesE->apellido_responsable }} </td>
                                                    <td>{{ $solicitudesE->numero_documento }}</td>
                                                    <td>{{ $solicitudesE->email_responsable }}</td>
                                                    <td>{{ $solicitudesE->telefono_responsable }}</td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a type="button" class="btn-symbolic-govco align-column-govco"
                                                                href="{{ route('interior.publicidad.detalle', $solicitudesE->id) }}">
                                                                <span class="govco-icon govco-icon-attached-n"></span>
                                                                <span class="btn-govco-text">Detalles</span>
                                                            </a>

                                                            <a type="button"
                                                                class="btn-symbolic-govco align-column-govco pl-0 ml-0"
                                                                href="{{ route('tramite.trazabilidad', ['radicado' => $solicitudesE->radicado, 'tramite' => $tramite]) }}">
                                                                <span class="govco-icon govco-icon-analytic-cn"></span>
                                                                <span class="btn-govco-text text-sm">Trazabilidad</span>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div> --}}
                    </div>
                </div>





            </div>
        </div>



    </div>
@endsection
