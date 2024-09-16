@extends('layouts.menu')

@section('dashboard')

<style>
    th.sorting_desc::after, th.sorting_asc::after{
      right: 0!important;
      content: ""!important;
   }
</style>

<?php $tramite= 'CATEGORIZACION DE PARQUEADEROS';?>

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
                                <p class="ml-3 ml-md-0 "><b style="color: #004fbf;text-transform: none;">
                                        Categorización de parqueaderos
                                    </b></p>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-md-12 pt-4" style="padding-left: 10px!important">
            <h1 class="headline-xl-govco">Solicitudes de categorización de parqueaderos</h1>
            <div class="row pt-5">

            @if($porCerrar > 0)
            <div class="col-md-4 pb-4">
                <button type="button" class="btn btn-danger btn-block btn-sm" style="background-color:#A80521!important;">
                    <span class="govco-icon govco-icon-exclamation-cn size-1x text-white"></span> &nbsp; Solicitudes pendientes por cerrarse automaticamente <span class="badge badge-light">{{$porCerrar}}</span>
                  </button>
            </div>
            @endif

            @if($porCerrarPlaneacion > 0)
            <div class="col-md-4 pb-4">
                <button type="button" class="btn btn-warning btn-block btn-sm" style="background-color:#FFAB00!important;">
                    <span class="govco-icon govco-icon-exclamation-cn size-1x text-white"></span>Solicitudes pendientes de Concepto Técnico por cerrarse <span class="badge badge-light">{{$porCerrarPlaneacion}}</span>
                  </button>
            </div>
            @endif


                <div class="tabs-govco col-md-12 animate__animated animate__bounceInRight">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Enviadas <span class="badge badge-primary">{{$count_enviadas}}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pendientes-tab" data-toggle="tab" href="#pendientes" role="tab" aria-controls="pendientes" aria-selected="false">Pendientes <span class="badge badge-primary">{{$count_pendientes}}</span></a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Enviadas para Concepto Técnico <span class="badge badge-primary">{{$count_enRevision}}</span></a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="false">Respuesta Concepto Técnico <span class="badge badge-primary">{{$count_revisadas}}</span></a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">Aprobadas <span class="badge badge-primary">{{$count_aprobadas}}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="rechazadas-tab" data-toggle="tab" href="#rechazadas" role="tab" aria-controls="rechazadas" aria-selected="false">Rechazadas <span class="badge badge-primary">{{$count_rechazadas}}</span></a>
                            </li>
                    </ul>
                
                    <div class="tab-content">
                    <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                       {{-- TABLA DE ENVIADOS --}}
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
                                            <th style="color: #004884;">Teléfono  del solicitante</th>
                                            <th style="color: #004884;;">Razón Social/empresa</th>
                                            <th style="color: #004884;;">Dirección Parqueadero</th>
                                            <th style="color: #004884;;">Detalle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sEnviadas as $solicitudesE)
                                            <tr>
                                                <td>{{ $solicitudesE->radicado }}</td>
                                                <td>{{ $solicitudesE->nom_solicitante }} {{ $solicitudesE->ape_solicitante }} </td>
                                                <td>{{ $solicitudesE->identificacion_solicitante }}</td>
                                                <td>{{ $solicitudesE->email_responsable }}</td>
                                                <td>{{ $solicitudesE->tel_solicitante }}</td>
                                                <td>{{ $solicitudesE->nombre_empresa }}</td>
                                                <td>{{ $solicitudesE->direccion_empresa }}- {{$solicitudesE->barrio_empresa }}</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a type="button" class="btn-symbolic-govco align-column-govco" href="{{route('interior.parqueaderos.detalle', $solicitudesE->id)}}">
                                                            <span class="govco-icon govco-icon-attached-n"></span>
                                                            <span class="btn-govco-text">Detalles</span></a>
                                                            
                                                            <a type="button" class="btn-symbolic-govco align-column-govco pl-0 ml-0" href="{{route('tramite.trazabilidad', ['radicado'=>$solicitudesE->radicado , 'tramite' => $tramite] )}}">
                                                                <span class="govco-icon govco-icon-analytic-cn"></span>
                                                                <span class="btn-govco-text text-sm">Trazabilidad</span></a>
                                                    
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
                                    class="table display table-responsive-md table-responsive-md tablas" width="100%"
                                    style="text-align: left!important;">
                                    <thead>
                                        <tr>
                                            <th style="color: #004884;">Radicado</th>
                                            <th style="color: #004884;">Nombres Solicitante</th>
                                            <th style="color: #004884;">Identificación del solicitante</th>
                                            <th style="color: #004884;">Correo del Solicitante</th>
                                            <th style="color: #004884;">Teléfono  del solicitante</th>
                                            <th style="color: #004884;;">Razón Social/empresa</th>
                                            <th style="color: #004884;;">Dirección Parqueadero</th>
                                            <th style="color: #004884;;">Archivos Actualizados</th>
                                            <th style="color: #004884;;">Detalle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sPendientes as $solicitudesPe)
                                        <tr>
                                            <td>{{ $solicitudesPe->radicado }}</td>
                                            <td>{{ $solicitudesPe->nom_solicitante }} {{ $solicitudesPe->ape_solicitante }} </td>
                                            <td>{{ $solicitudesPe->identificacion_solicitante }}</td>
                                            <td>{{ $solicitudesPe->email_responsable }}</td>
                                            <td>{{ $solicitudesPe->tel_solicitante }}</td>
                                            <td>{{ $solicitudesPe->nombre_empresa }}</td>
                                            <td>{{ $solicitudesPe->direccion_empresa }}- {{$solicitudesPe->barrio_empresa }}</td>
                                            <td>@if($solicitudesPe->act_documentos == 'SI')
                                                <div class="tag-govco tag-positive">
                                                  <span class="label text-success">Archivos Actualizados</span><span class="govco-icon govco-icon-check-cn size-2x tag-remove" aria-label="Close"></span>
                                                </div>
                                                @else
                                                <div class="tag-govco tag-positive">
                                                  <span class="label text-danger">Archivos sin Actualizar</span><span class="govco-icon govco-icon-x-cn size-2x tag-remove" aria-label="Close"></span>
                                                </div>                                            
                                                @endif
                                                </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a type="button" class="btn-symbolic-govco align-column-govco" href="{{route('interior.parqueaderos.detalle', $solicitudesPe->id)}}">
                                                        <span class="govco-icon govco-icon-attached-n"></span>
                                                        <span class="btn-govco-text">Detalles</span></a>  
                                                        
                                                        <a type="button" class="btn-symbolic-govco align-column-govco pl-0 ml-0" href="{{route('tramite.trazabilidad', ['radicado'=>$solicitudesPe->radicado , 'tramite' => $tramite] )}}">
                                                            <span class="govco-icon govco-icon-analytic-cn"></span>
                                                            <span class="btn-govco-text text-sm">Trazabilidad</span></a> 
                                                        
                                                        
                                                
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
                    <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                        {{-- TABLA EN REVISION DE PLANEACION --}}
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
                                            <th style="color: #004884;">Teléfono  del solicitante</th>
                                            <th style="color: #004884;;">Razón Social/empresa</th>
                                            <th style="color: #004884;">Fecha máxima de respuesta </th>
                                            <th style="color: #004884;;">Dirección Parqueadero</th>
                                            <th style="color: #004884;;">Detalle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sEnRevision as $solicitudesEnRe)
                                        <tr>
                                            <td>{{ $solicitudesEnRe->radicado }}</td>
                                            <td>{{ $solicitudesEnRe->nom_solicitante }} {{ $solicitudesEnRe->ape_solicitante }} </td>
                                            <td>{{ $solicitudesEnRe->identificacion_solicitante }}</td>
                                            <td>{{ $solicitudesEnRe->email_responsable }}</td>
                                            <td>{{ $solicitudesEnRe->tel_solicitante }}</td>
                                            <td>{{ $solicitudesEnRe->nombre_empresa }}</td>
                                            <td>{{ $solicitudesEnRe->fecha_pendiente_planeacion }}</td>
                                            <td>{{ $solicitudesEnRe->direccion_empresa }}- {{$solicitudesEnRe->barrio_empresa }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a type="button" class="btn-symbolic-govco align-column-govco" href="{{route('interior.parqueaderos.detalle', $solicitudesEnRe->id)}}">
                                                        <span class="govco-icon govco-icon-attached-n"></span>
                                                        <span class="btn-govco-text">Detalles</span></a> 
                                                        
                                                        <a type="button" class="btn-symbolic-govco align-column-govco pl-0 ml-0" href="{{route('tramite.trazabilidad', ['radicado'=>$solicitudesEnRe->radicado , 'tramite' => $tramite] )}}">
                                                            <span class="govco-icon govco-icon-analytic-cn"></span>
                                                            <span class="btn-govco-text text-sm">Trazabilidad</span></a>  
                                                
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
                                        <th style="color: #004884;">Teléfono  del solicitante</th>
                                        <th style="color: #004884;;">Razón Social/empresa</th>
                                        <th style="color: #004884;;">Dirección Parqueadero</th>
                                        <th style="color: #004884;;">Detalle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sRevisadas as $solicitudesRe)
                                    <tr>
                                        <td>{{ $solicitudesRe->radicado }}</td>
                                        <td>{{ $solicitudesRe->nom_solicitante }} {{ $solicitudesRe->ape_solicitante }} </td>
                                        <td>{{ $solicitudesRe->identificacion_solicitante }}</td>
                                        <td>{{ $solicitudesRe->email_responsable }}</td>
                                        <td>{{ $solicitudesRe->tel_solicitante }}</td>
                                        <td>{{ $solicitudesRe->nombre_empresa }}</td>
                                        <td>{{ $solicitudesRe->direccion_empresa }}- {{$solicitudesRe->barrio_empresa }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a type="button" class="btn-symbolic-govco align-column-govco" href="{{route('interior.parqueaderos.detalle', $solicitudesRe->id)}}">
                                                    <span class="govco-icon govco-icon-attached-n"></span>
                                                    <span class="btn-govco-text">Detalles</span></a>  
                                                    
                                                    <a type="button" class="btn-symbolic-govco align-column-govco pl-0 ml-0" href="{{route('tramite.trazabilidad', ['radicado'=>$solicitudesRe->radicado , 'tramite' => $tramite] )}}">
                                                        <span class="govco-icon govco-icon-analytic-cn"></span>
                                                        <span class="btn-govco-text text-sm">Trazabilidad</span></a> 
                                            
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
                    <div class="tab-pane" id="settings" role="tabpanel" aria-labelledby="settings-tab">

                        {{-- TABLA DE APROBADAS --}}
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
                                        <th style="color: #004884;">Teléfono  del solicitante</th>
                                        <th style="color: #004884;;">Razón Social/empresa</th>
                                        <th style="color: #004884;;">Dirección Parqueadero</th>
                                        <th style="color: #004884;;">Detalle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sAprobadas as $solicitudesAP)
                                    <tr>
                                        <td>{{ $solicitudesAP->radicado }}</td>
                                        <td>{{ $solicitudesAP->nom_solicitante }} {{ $solicitudesAP->ape_solicitante }} </td>
                                        <td>{{ $solicitudesAP->identificacion_solicitante }}</td>
                                        <td>{{ $solicitudesAP->email_responsable }}</td>
                                        <td>{{ $solicitudesAP->tel_solicitante }}</td>
                                        <td>{{ $solicitudesAP->nombre_empresa }}</td>
                                        <td>{{ $solicitudesAP->direccion_empresa }}- {{$solicitudesAP->barrio_empresa }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a type="button" class="btn-symbolic-govco align-column-govco" href="{{route('interior.parqueaderos.detalle', $solicitudesAP->id)}}">
                                                    <span class="govco-icon govco-icon-attached-n"></span>
                                                    <span class="btn-govco-text">Detalles</span></a> 
                                                    
                                                    <a type="button" class="btn-symbolic-govco align-column-govco pl-0 ml-0" href="{{route('tramite.trazabilidad', ['radicado'=>$solicitudesAP->radicado , 'tramite' => $tramite] )}}">
                                                        <span class="govco-icon govco-icon-analytic-cn"></span>
                                                        <span class="btn-govco-text text-sm">Trazabilidad</span></a> 
                                            
                                            </div>
                                        </td>

                                    </tr>
                                    @endforeach

                                </tbody>

                            </table>

                        </div>
                    </div>
                    {{-- </ TABLA DE APROBADOS FIN --}}
                    </div>
                    <div class="tab-pane" id="rechazadas" role="tabpanel" aria-labelledby="rechazadas-tab">
                        {{-- TABLA DE RECHAZADAS --}}
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
                                        <th style="color: #004884;">Teléfono  del solicitante</th>
                                        <th style="color: #004884;;">Razón Social/empresa</th>
                                        <th style="color: #004884;;">Dirección Parqueadero</th>
                                        <th style="color: #004884;;">Detalle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sRechazadas as $solicitudesRecha)
                                    <tr>
                                        <td>{{ $solicitudesRecha->radicado }}</td>
                                        <td>{{ $solicitudesRecha->nom_solicitante }} {{ $solicitudesRecha->ape_solicitante }} </td>
                                        <td>{{ $solicitudesRecha->identificacion_solicitante }}</td>
                                        <td>{{ $solicitudesRecha->email_responsable }}</td>
                                        <td>{{ $solicitudesRecha->tel_solicitante }}</td>
                                        <td>{{ $solicitudesRecha->nombre_empresa }}</td>
                                        <td>{{ $solicitudesRecha->direccion_empresa }}- {{$solicitudesRecha->barrio_empresa }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a type="button" class="btn-symbolic-govco align-column-govco" href="{{route('interior.parqueaderos.detalle', $solicitudesRecha->id)}}">
                                                    <span class="govco-icon govco-icon-attached-n"></span>
                                                    <span class="btn-govco-text">Detalles</span></a>   
                                                    
                                                    <a type="button" class="btn-symbolic-govco align-column-govco pl-0 ml-0" href="{{route('tramite.trazabilidad', ['radicado'=>$solicitudesRecha->radicado , 'tramite' => $tramite] )}}">
                                                        <span class="govco-icon govco-icon-analytic-cn"></span>
                                                        <span class="btn-govco-text text-sm">Trazabilidad</span></a> 
                                            
                                            </div>
                                        </td>

                                    </tr>
                                    @endforeach

                                </tbody>

                            </table>

                        </div>
                    </div>
                    {{-- </ TABLA DE RECHAZADAS FIN --}}
                    </div>
                    </div>
                </div>


            


            </div>
        </div>



    </div>
    @endsection