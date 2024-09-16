@extends('layouts.menu')

@section('dashboard')

<style>
    th.sorting_desc::after, th.sorting_asc::after{
      right: 0!important;
      content: ""!important;
   }
</style>

<?php $tramite= 'CERTIFICACION DE DISCAPACIDAD';?>


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
                                        Salud</a>                                    
                            </div>
                        </li>
                        <li class="breadcrumb-item ">
                            <div class="image-icon">
                                <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                                <p class="ml-3 ml-md-0 "><b style="color: #004fbf;text-transform: none;">
                                    Autorización de la certificación de discapacidad
                                    </b></p>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-md-12 pt-4" style="padding-left: 10px!important">
            <h1 class="headline-xl-govco">Solicitudes de Autorización de la certificación de discapacidad</h1>
            <div class="row pt-5">

                <div class="tabs-govco col-md-12 animate__animated animate__bounceInRight">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Enviadas  <span class="badge badge-primary">{{$count_enviadas}}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pendientes-tab" data-toggle="tab" href="#pendientes" role="tab" aria-controls="pendientes" aria-selected="false">Pendientes  <span class="badge badge-primary">{{$count_pendientes}}</span></a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Actualizadas  <span class="badge badge-primary">{{$count_actualizadas}}</span></a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="false">Radicadas  <span class="badge badge-primary">{{$count_radicadas}}</span></a>
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
                                            <th style="color: #004884;">Nombres del responsable</th>
                                            <th style="color: #004884;">Identificación del responsable</th>
                                            <th style="color: #004884;">Correo de la solicitud</th>
                                            <th style="color: #004884;">Nombre del Ciudadano</th>
                                            <th style="color: #004884;;">Identificación ciudadano</th>
                                            <th style="color: #004884;;">Detalle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sEnviadas as $solicitudesE)
                                            <tr>
                                                <td>{{ $solicitudesE->radicado }}</td>
                                                <td>{{ $solicitudesE->nom_responsable }} {{ $solicitudesE->ape_responsable }} </td>
                                                <td>{{ $solicitudesE->ide_responsable }}</td>
                                                <td>{{ $solicitudesE->email_responsable }}</td>
                                                <td>{{ $solicitudesE->nom_solicitante }} {{$solicitudesE->ape_solicitante}}</td>
                                                <td>{{ $solicitudesE->ide_solicitante }}</td>                                               
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a type="button" class="btn-symbolic-govco align-column-govco" href="{{route('salud.discapacidad.detalle', $solicitudesE->id)}}">
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
                                            <th style="color: #004884;">Nombres del responsable</th>
                                            <th style="color: #004884;">Identificación del responsable</th>
                                            <th style="color: #004884;">Correo de la solicitud</th>
                                            <th style="color: #004884;">Nombre del Ciudadano</th>
                                            <th style="color: #004884;;">Identificación ciudadano</th>
                                            <th style="color: #004884;;">Detalle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sPendientes as $solicitudesPe)
                                        <tr>
                                        <td>{{ $solicitudesPe->radicado }}</td>
                                                <td>{{ $solicitudesPe->nom_responsable }} {{ $solicitudesPe->ape_responsable }} </td>
                                                <td>{{ $solicitudesPe->ide_responsable }}</td>
                                                <td>{{ $solicitudesPe->email_responsable }}</td>
                                                <td>{{ $solicitudesPe->nom_solicitante }} {{$solicitudesPe->ape_solicitante}}</td>
                                                <td>{{ $solicitudesPe->ide_solicitante }}</td>                                               
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a type="button" class="btn-symbolic-govco align-column-govco" href="{{route('salud.discapacidad.detalle', $solicitudesPe->id)}}">
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
                                            <th style="color: #004884;">Nombres del responsable</th>
                                            <th style="color: #004884;">Identificación del responsable</th>
                                            <th style="color: #004884;">Correo de la solicitud</th>
                                            <th style="color: #004884;">Nombre del Ciudadano</th>
                                            <th style="color: #004884;;">Identificación ciudadano</th>
                                            <th style="color: #004884;;">Detalle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sActualizadas as $solicitudesAct)
                                        <tr>
                                                   <td>{{ $solicitudesAct->radicado }}</td>
                                                    <td>{{ $solicitudesAct->nom_responsable }} {{ $solicitudesAct->ape_responsable }} </td>
                                                    <td>{{ $solicitudesAct->ide_responsable }}</td>
                                                    <td>{{ $solicitudesAct->email_responsable }}</td>
                                                    <td>{{ $solicitudesAct->nom_solicitante }} {{$solicitudesAct->ape_solicitante}}</td>
                                                    <td>{{ $solicitudesAct->ide_solicitante }}</td>                                               
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a type="button" class="btn-symbolic-govco align-column-govco" href="{{route('salud.discapacidad.detalle', $solicitudesAct->id)}}">
                                                                <span class="govco-icon govco-icon-attached-n"></span>
                                                                <span class="btn-govco-text">Detalles</span></a>   
                                                                
                                                                <a type="button" class="btn-symbolic-govco align-column-govco pl-0 ml-0" href="{{route('tramite.trazabilidad', ['radicado'=>$solicitudesAct->radicado , 'tramite' => $tramite] )}}">
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
                                        <th style="color: #004884;">Nombres del responsable</th>
                                        <th style="color: #004884;">Identificación del responsable</th>
                                        <th style="color: #004884;">Correo de la solicitud</th>
                                        <th style="color: #004884;">Nombre del Ciudadano</th>
                                        <th style="color: #004884;;">Identificación ciudadano</th>
                                        <th style="color: #004884;;">Detalle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sRadicadas as $solicitudesRa)
                                    <tr>
                                        <td>{{ $solicitudesRa->radicado }}</td>
                                         <td>{{ $solicitudesRa->nom_responsable }} {{ $solicitudesRa->ape_responsable }} </td>
                                         <td>{{ $solicitudesRa->ide_responsable }}</td>
                                         <td>{{ $solicitudesRa->email_responsable }}</td>
                                         <td>{{ $solicitudesRa->nom_solicitante }} {{$solicitudesRa->ape_solicitante}}</td>
                                         <td>{{ $solicitudesRa->ide_solicitante }}</td>                                               
                                         <td>
                                             <div class="btn-group" role="group">
                                                 <a type="button" class="btn-symbolic-govco align-column-govco" href="{{route('salud.discapacidad.detalle', $solicitudesRa->id)}}">
                                                     <span class="govco-icon govco-icon-attached-n"></span>
                                                     <span class="btn-govco-text">Detalles</span></a>   
                                                     
                                                     <a type="button" class="btn-symbolic-govco align-column-govco pl-0 ml-0" href="{{route('tramite.trazabilidad', ['radicado'=>$solicitudesRa->radicado , 'tramite' => $tramite] )}}">
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
                                        <th style="color: #004884;">Nombres del responsable</th>
                                        <th style="color: #004884;">Identificación del responsable</th>
                                        <th style="color: #004884;">Correo de la solicitud</th>
                                        <th style="color: #004884;">Nombre del Ciudadano</th>
                                        <th style="color: #004884;;">Identificación ciudadano</th>
                                        <th style="color: #004884;;">Detalle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sAprobadas as $solicitudesAP)
                                    <tr>
                                        <td>{{ $solicitudesAP->radicado }}</td>
                                         <td>{{ $solicitudesAP->nom_responsable }} {{ $solicitudesAP->ape_responsable }} </td>
                                         <td>{{ $solicitudesAP->ide_responsable }}</td>
                                         <td>{{ $solicitudesAP->email_responsable }}</td>
                                         <td>{{ $solicitudesAP->nom_solicitante }} {{$solicitudesAP->ape_solicitante}}</td>
                                         <td>{{ $solicitudesAP->ide_solicitante }}</td>                                               
                                         <td>
                                             <div class="btn-group" role="group">
                                                 <a type="button" class="btn-symbolic-govco align-column-govco" href="{{route('salud.discapacidad.detalle', $solicitudesAP->id)}}">
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
                                        <th style="color: #004884;">Nombres del responsable</th>
                                        <th style="color: #004884;">Identificación del responsable</th>
                                        <th style="color: #004884;">Correo de la solicitud</th>
                                        <th style="color: #004884;">Nombre del Ciudadano</th>
                                        <th style="color: #004884;;">Identificación ciudadano</th>
                                        <th style="color: #004884;;">Detalle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sRechazadas as $solicitudesRecha)
                                    <tr>
                                        <td>{{ $solicitudesRecha->radicado }}</td>
                                         <td>{{ $solicitudesRecha->nom_responsable }} {{ $solicitudesRecha->ape_responsable }} </td>
                                         <td>{{ $solicitudesRecha->ide_responsable }}</td>
                                         <td>{{ $solicitudesRecha->email_responsable }}</td>
                                         <td>{{ $solicitudesRecha->nom_solicitante }} {{$solicitudesRecha->ape_solicitante}}</td>
                                         <td>{{ $solicitudesRecha->ide_solicitante }}</td>                                               
                                         <td>
                                             <div class="btn-group" role="group">
                                                 <a type="button" class="btn-symbolic-govco align-column-govco" href="{{route('salud.discapacidad.detalle', $solicitudesRecha->id)}}">
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