@extends('layouts.menu')

@section('dashboard')

<style>
    th.sorting_desc::after, th.sorting_asc::after{
      right: 0!important;
      content: ""!important;
   }
</style>

<?php $tramite= 'PERMISOS PARA ESPECTACULOS PUBLICOS';?>


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
                                        Permisos para Espectáculos Públicos
                                    </b></p>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-md-12 pt-4" style="padding-left: 10px!important">
            <h1 class="headline-xl-govco">Solicitudes de Permisos para Espectáculos Públicos</h1>
            <div class="row pt-5">

            @if($porCerrar > 0)
            <div class="col-md-4 pb-4">
                <button type="button" class="btn btn-danger btn-block btn-sm" style="background-color:#A80521!important;">
                    <span class="govco-icon govco-icon-exclamation-cn size-1x text-white"></span> &nbsp; Solicitudes pendientes por cerrarse automaticamente <span class="badge badge-light">{{$porCerrar}}</span>
                  </button>
            </div>
            @endif

            @if($porCumplirEvento > 0)
            <div class="col-md-4 pb-4">
                <button type="button" class="btn btn-warning btn-block btn-sm" style="background-color:#FFAB00!important;">
                    <span class="govco-icon govco-icon-exclamation-cn size-1x text-white"></span> &nbsp; Solicitudes pendientes con fecha de evento proximo por cerrarse <span class="badge badge-light">{{$porCumplirEvento}}</span>
                  </button>
            </div>
            @endif

            @if($porCumplirEnviada > 0)
            <div class="col-md-4 pb-4">
                <button type="button" class="btn btn-success btn-block btn-sm" style="background-color:#069169!important;">
                    <span class="govco-icon govco-icon-exclamation-cn size-1x text-white"></span> &nbsp; Solicitudes enviadas con fecha evento proximo <span class="badge badge-light">{{$porCumplirEnviada}}</span>
                  </button>
            </div>
            @endif



                <div class="tabs-govco col-md-12 animate__animated animate__bounceInRight">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Enviadas  <span class="badge badge-primary">{{$count_enviadas}}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pendientes-tab" data-toggle="tab" href="#pendientes" role="tab" aria-controls="pendientes" aria-selected="false">Pendientes  <span class="badge badge-primary">{{$count_pendientes}}</span></a>
                        </li>                      
                        <li class="nav-item">
                        <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">Aprobadas  <span class="badge badge-primary">{{$count_aprobadas}}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="rechazadas-tab" data-toggle="tab" href="#rechazadas" role="tab" aria-controls="rechazadas" aria-selected="false">Rechazadas  <span class="badge badge-primary">{{$count_rechazadas}}</span></a>
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
                                            <th style="color: #004884;">Responsable Solicitud</th>
                                            <th style="color: #004884;">Identificación del Responsable</th>
                                            <th style="color: #004884;">Correo del Solicitante</th>
                                            <th style="color: #004884;">Teléfono  del solicitante</th>                                            
                                            <th style="color: #004884;;">Dirección del evento</th>
                                            <th style="color: #004884;;">Detalle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sEnviadas as $solicitudesE)
                                            <tr>
                                                <td>{{ $solicitudesE->radicado }}</td>

                                                <td>@if($solicitudesE->tipo_persona == 1)
                                                    {{ $solicitudesE->nom_responsable }} {{ $solicitudesE->ape_responsable }}
                                                    @else
                                                    {{$solicitudesE->razon_social}}
                                                    @endif
                                                 </td>
                                                <td>{{ $solicitudesE->ide_responsable }}</td>
                                                <td>{{ $solicitudesE->email_responsable }}</td>
                                                <td>{{ $solicitudesE->tel_responsable }}</td>                                                
                                                <td>{{ $solicitudesE->ubicacion_evento }}- {{$solicitudesE->barrio_evento }}</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a type="button" class="btn-symbolic-govco align-column-govco" href="{{route('interior.eventos.detalle', $solicitudesE->id)}}">
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
                                            <th style="color: #004884;">Responsable Solicitud</th>
                                            <th style="color: #004884;">Identificación del Responsable</th>
                                            <th style="color: #004884;">Correo del Solicitante</th>
                                            <th style="color: #004884;">Teléfono  del solicitante</th>                                            
                                            <th style="color: #004884;;">Dirección del evento</th>
                                            <th style="color: #004884;">Estado documentos</th>
                                            <th style="color: #004884;;">Detalle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sPendientes as $solicitudesPe)
                                        <tr>
                                            <td>{{ $solicitudesPe->radicado }}</td>

                                                <td>@if($solicitudesPe->tipo_persona == 1)
                                                    {{ $solicitudesPe->nom_responsable }} {{ $solicitudesPe->ape_responsable }}
                                                    @else
                                                    {{$solicitudesPe->razon_social}}
                                                    @endif
                                                 </td>
                                                <td>{{ $solicitudesPe->ide_responsable }}</td>
                                                <td>{{ $solicitudesPe->email_responsable }}</td>
                                                <td>{{ $solicitudesPe->tel_responsable }}</td>                                                
                                                <td>{{ $solicitudesPe->ubicacion_evento }}- {{$solicitudesPe->barrio_evento }}</td>
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
                                                    <a type="button" class="btn-symbolic-govco align-column-govco" href="{{route('interior.eventos.detalle', $solicitudesPe->id)}}">
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
                                            <th style="color: #004884;">Responsable Solicitud</th>
                                            <th style="color: #004884;">Identificación del Responsable</th>
                                            <th style="color: #004884;">Correo del Solicitante</th>
                                            <th style="color: #004884;">Teléfono  del solicitante</th>                                            
                                            <th style="color: #004884;;">Dirección del evento</th>
                                            <th style="color: #004884;;">Detalle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sAprobadas as $solicitudesAP)
                                    <tr>
                                        <td>{{ $solicitudesAP->radicado }}</td>

                                                <td>@if($solicitudesAP->tipo_persona == 1)
                                                    {{ $solicitudesAP->nom_responsable }} {{ $solicitudesAP->ape_responsable }}
                                                    @else
                                                    {{$solicitudesAP->razon_social}}
                                                    @endif
                                                 </td>
                                                <td>{{ $solicitudesAP->ide_responsable }}</td>
                                                <td>{{ $solicitudesAP->email_responsable }}</td>
                                                <td>{{ $solicitudesAP->tel_responsable }}</td>                                                
                                                <td>{{ $solicitudesAP->ubicacion_evento }}- {{$solicitudesAP->barrio_evento }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a type="button" class="btn-symbolic-govco align-column-govco" href="{{route('interior.eventos.detalle', $solicitudesAP->id)}}">
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
                                            <th style="color: #004884;">Responsable Solicitud</th>
                                            <th style="color: #004884;">Identificación del Responsable</th>
                                            <th style="color: #004884;">Correo del Solicitante</th>
                                            <th style="color: #004884;">Teléfono  del solicitante</th>                                            
                                            <th style="color: #004884;;">Dirección del evento</th>
                                            <th style="color: #004884;;">Detalle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sRechazadas as $solicitudesRecha)
                                    <tr>
                                        <td>{{ $solicitudesRecha->radicado }}</td>

                                                <td>@if($solicitudesRecha->tipo_persona == 1)
                                                    {{ $solicitudesRecha->nom_responsable }} {{ $solicitudesRecha->ape_responsable }}
                                                    @else
                                                    {{$solicitudesRecha->razon_social}}
                                                    @endif
                                                 </td>
                                                <td>{{ $solicitudesRecha->ide_responsable }}</td>
                                                <td>{{ $solicitudesRecha->email_responsable }}</td>
                                                <td>{{ $solicitudesRecha->tel_responsable }}</td>                                                
                                                <td>{{ $solicitudesRecha->ubicacion_evento }}- {{$solicitudesRecha->barrio_evento }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a type="button" class="btn-symbolic-govco align-column-govco" href="{{route('interior.eventos.detalle', $solicitudesRecha->id)}}">
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