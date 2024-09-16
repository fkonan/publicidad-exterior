@extends('layouts.menu')

@section('dashboard')
<style>
    th.sorting_desc::after, th.sorting_asc::after{
      right: 0!important;
      content: ""!important;
   }
</style>

<?php $tramite= 'LICENCIA DE INTERVENCION DE ESPACIO PUBLICO PARA LOCALIZACION DE EQUIPAMIENTO';?>


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
                                        Planeacion</a>                                    
                            </div>
                        </li>
                        <li class="breadcrumb-item ">
                            <div class="image-icon">
                                <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                                <p class="ml-3 ml-md-0 "><b style="color: #004fbf;text-transform: none;">
                                        Intervención del Espacio Publico
                                    </b></p>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-md-12 pt-4" style="padding-left: 10px!important">
            <h1 class="headline-xl-govco">Solicitudes Espacio Publico para la localización de equipamiento</h1>
            <div class="row pt-5">
            
            @if($porCerrar > 0)
            <div class="col-md-4 pb-4">
                <button type="button" class="btn btn-danger btn-block btn-sm" style="background-color:#A80521!important;">
                    <span class="govco-icon govco-icon-exclamation-cn size-1x text-white"></span> &nbsp; Solicitudes pendientes por cerrarse automaticamente <span class="badge badge-light">{{$porCerrar}}</span>
                  </button>
            </div>
            @endif

                <div class="tabs-govco col-md-12 animate__animated animate__bounceInRight">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Enviadas <span class="badge badge-primary">{{$count_enviadas}}</span></a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">En Progreso <span class="badge badge-primary">{{$count_progreso}}</span></a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="false">Pendientes <span class="badge badge-primary">{{$count_pendientes}}</span></a>
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
                                            <th style="color: #004884;">Modalidad</th>
                                            <th style="color: #004884;">Construcción-Dirección</th>
                                            <th style="color: #004884;">Nombre Solicitante</th>
                                            <th style="color: #004884;">Identificación Solicitante</th>
                                            <th style="color: #004884;;">Teléfono Solicitante</th>
                                            <th style="color: #004884;;">Correo Solicitante</th>
                                            <th style="color: #004884;;">Detalle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sEnviadas as $solicitudesE)
                                            <tr>
                                                <td>{{ $solicitudesE->radicado }}</td>
                                                <td>{{ $solicitudesE->modalidad }}</td>
                                                <td>{{ $solicitudesE->construccion }} - {{$solicitudesE->direccion_predio}}</td>
                                                <td>{{ $solicitudesE->nom_responsable }} {{$solicitudesE->ape_responsable}}</td>
                                                <td>{{ $solicitudesE->ide_responsable }}</td>
                                                <td>{{ $solicitudesE->tel_responsable }}</td>
                                                <td>{{ $solicitudesE->email_responsable }}</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a type="button" class="btn-symbolic-govco align-column-govco" href="{{route('espacio.detalle', $solicitudesE->id)}}">
                                                            <span class="govco-icon govco-icon-attached-n"></span>
                                                            <span class="btn-govco-text">Detalles</span></a>

                                                            <a type="button" class="btn-symbolic-govco align-column-govco pl-0 ml-0" href="{{route('tramite.trazabilidad', ['radicado'=>$solicitudesE->radicado , 'tramite' => $tramite] )}}">
                                                                <span class="govco-icon govco-icon-analytic-cn"></span>
                                                                <span class="btn-govco-text text-sm">Reporte</span></a>
                                                                                                      
                                                    
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
                    <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                        {{-- TABLA EN PROGRESO --}}
                        <div class="col-md-12 pt-4">
                            <div id="container_table" class="table-pagination-govco">
                                <table id="DataTables_Table_0"
                                    class="table display table-responsive-md table-responsive-md tablas" width="100%"
                                    style="text-align: left!important;">
                                    <thead>
                                        <tr>
                                            <th style="color: #004884;">Radicado</th>
                                            <th style="color: #004884;">Modalidad</th>
                                            <th style="color: #004884;">Construccion- - Direccion</th>
                                            <th style="color: #004884;">Nombre Solicitante</th>
                                            <th style="color: #004884;">Identificación Solicitante</th>
                                            <th style="color: #004884;;">Teléfono Solicitante</th>
                                            <th style="color: #004884;;">Correo Solicitante</th>
                                            <th style="color: #004884;;">Detalle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sProgreso as $solicitudesPr)
                                            <tr>
                                                <td>{{ $solicitudesPr->radicado }}</td>
                                                <td>{{ $solicitudesPr->modalidad }}</td>
                                                <td>{{ $solicitudesPr->construccion }} - {{$solicitudesPr->direccion_predio}}</td>
                                                <td>{{ $solicitudesPr->nom_responsable }} {{$solicitudesPr->ape_responsable}}</td>
                                                <td>{{ $solicitudesPr->ide_responsable }}</td>                                                
                                                <td>{{ $solicitudesPr->tel_responsable }}</td>
                                                <td>{{ $solicitudesPr->email_responsable }}</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a type="button" class="btn-symbolic-govco align-column-govco" href="{{route('espacio.detalle', $solicitudesPr->id)}}">
                                                            <span class="govco-icon govco-icon-attached-n"></span>
                                                            <span class="btn-govco-text">Detalles</span></a>

                                                            <a type="button" class="btn-symbolic-govco align-column-govco pl-0 ml-0" href="{{route('tramite.trazabilidad', ['radicado'=>$solicitudesPr->radicado , 'tramite' => $tramite] )}}">
                                                                <span class="govco-icon govco-icon-analytic-cn"></span>
                                                                <span class="btn-govco-text text-sm">Reporte</span></a>
                                                                                                      
                                                    
                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>

                                </table>

                            </div>
                        </div>
                        {{-- </ TABLA DE PROGRESO FIN --}}
                    </div>
                    <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                       {{-- TABLA DE PENDIENTES --}}
                       <div class="col-md-12 pt-4">
                        <div id="container_table" class="table-pagination-govco">
                            <table id="DataTables_Table_0"
                                class="table display table-responsive-md table-responsive-md tablas" width="100%"
                                style="text-align: left!important;">
                                <thead>
                                    <tr>
                                        <th style="color: #004884;">Radicado</th>
                                        <th style="color: #004884;">Modalidad</th>
                                        <th style="color: #004884;">Construccion- - Direccion</th>
                                        <th style="color: #004884;">Nombre Solicitante</th>
                                        <th style="color: #004884;">Identificación Solicitante</th>
                                        <th style="color: #004884;;">Teléfono Solicitante</th>
                                        <th style="color: #004884;;">Correo Solicitante</th>
                                        <th style="color: #004884;;">Archivos Actualizados</th>
                                        <th style="color: #004884;;">Detalle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sPendientes as $solicitudesPE)
                                        <tr>
                                            <td>{{ $solicitudesPE->radicado }}</td>
                                            <td>{{ $solicitudesPE->modalidad }}</td>
                                            <td>{{ $solicitudesPE->construccion }} - {{$solicitudesPE->direccion_predio}}</td>
                                            <td>{{ $solicitudesPE->nom_responsable }} {{$solicitudesPE->ape_responsable}}</td>
                                            <td>{{ $solicitudesPE->ide_responsable }}</td>
                                            <td>{{ $solicitudesPE->tel_responsable }}</td>
                                            <td>{{ $solicitudesPE->email_responsable }}</td>
                                            <td>@if($solicitudesPE->act_documentos == 'SI')
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
                                                    <a type="button" class="btn-symbolic-govco align-column-govco" href="{{route('espacio.detalle', $solicitudesPE->id)}}">
                                                        <span class="govco-icon govco-icon-attached-n"></span>
                                                        <span class="btn-govco-text">Detalles</span></a>
                                                        <a type="button" class="btn-symbolic-govco align-column-govco pl-0 ml-0" href="{{route('tramite.trazabilidad', ['radicado'=>$solicitudesPE->radicado , 'tramite' => $tramite] )}}">
                                                            <span class="govco-icon govco-icon-analytic-cn"></span>
                                                            <span class="btn-govco-text text-sm">Reporte</span></a>

                                                
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>

                        </div>
                    </div>
                    {{-- </ TABLA DE PENDIENTE FIN --}}
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
                                        <th style="color: #004884;">Modalidad</th>
                                        <th style="color: #004884;">Construccion- - Direccion</th>
                                        <th style="color: #004884;">Nombre Solicitante</th>
                                        <th style="color: #004884;">Identificación Solicitante</th>
                                        <th style="color: #004884;;">Teléfono Solicitante</th>
                                        <th style="color: #004884;;">Correo Solicitante</th>
                                        <th style="color: #004884;;">Detalle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sAprobadas as $solicitudesAP)
                                        <tr>
                                            <td>{{ $solicitudesAP->radicado }}</td>
                                            <td>{{ $solicitudesAP->modalidad }}</td>
                                            <td>{{ $solicitudesAP->construccion }} - {{$solicitudesAP->direccion_predio}}</td>
                                            <td>{{ $solicitudesAP->nom_responsable }} {{$solicitudesAP->ape_responsable}}</td>
                                            <td>{{ $solicitudesAP->ide_responsable }}</td>
                                            <td>{{ $solicitudesAP->tel_responsable }}</td>
                                            <td>{{ $solicitudesAP->email_responsable }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a type="button" class="btn-symbolic-govco align-column-govco" href="{{route('espacio.detalle', $solicitudesAP->id)}}">
                                                        <span class="govco-icon govco-icon-attached-n"></span>
                                                        <span class="btn-govco-text">Detalles</span></a>  
                                                        
                                                        <a type="button" class="btn-symbolic-govco align-column-govco pl-0 ml-0" href="{{route('tramite.trazabilidad', ['radicado'=>$solicitudesAP->radicado , 'tramite' => $tramite] )}}">
                                                            <span class="govco-icon govco-icon-analytic-cn"></span>
                                                            <span class="btn-govco-text text-sm">Reporte</span></a>
                                                
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
                                        <th style="color: #004884;">Modalidad</th>
                                        <th style="color: #004884;">Construccion- - Direccion</th>
                                        <th style="color: #004884;">Nombre Solicitante</th>
                                        <th style="color: #004884;">Identificación Solicitante</th>
                                        <th style="color: #004884;;">Teléfono Solicitante</th>
                                        <th style="color: #004884;;">Correo Solicitante</th>
                                        <th style="color: #004884;;">Detalle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sRechazadas as $solicitudesRE)
                                        <tr>
                                            <td>{{ $solicitudesRE->radicado }}</td>
                                            <td>{{ $solicitudesRE->modalidad }}</td>
                                            <td>{{ $solicitudesRE->construccion }} - {{$solicitudesRE->direccion_predio}}</td>
                                            <td>{{ $solicitudesRE->nom_responsable }} {{$solicitudesRE->ape_responsable}}</td>
                                            <td>{{ $solicitudesRE->ide_responsable }}</td>
                                            <td>{{ $solicitudesRE->tel_responsable }}</td>
                                            <td>{{ $solicitudesRE->email_responsable }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a type="button" class="btn-symbolic-govco align-column-govco" href="{{route('espacio.detalle', $solicitudesRE->id)}}">
                                                        <span class="govco-icon govco-icon-attached-n"></span>
                                                        <span class="btn-govco-text">Detalles</span></a>
                                                        
                                                        <a type="button" class="btn-symbolic-govco align-column-govco pl-0 ml-0" href="{{route('tramite.trazabilidad', ['radicado'=>$solicitudesRE->radicado , 'tramite' => $tramite] )}}">
                                                            <span class="govco-icon govco-icon-analytic-cn"></span>
                                                            <span class="btn-govco-text text-sms">Reporte</span></a>
                                                
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