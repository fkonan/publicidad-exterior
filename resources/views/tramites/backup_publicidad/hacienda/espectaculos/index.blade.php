@extends('layouts.menu')

@section('dashboard')

<style>
    th.sorting_desc::after, th.sorting_asc::after{
      right: -16px!important;
   }
</style>

<?php $tramite= 'ESPECTACULOS PUBLICOS';?>

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
                                        Hacienda</a>                                    
                            </div>
                        </li>
                        <li class="breadcrumb-item ">
                            <div class="image-icon">
                                <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                                <p class="ml-3 ml-md-0 "><b style="color: #004fbf;text-transform: none;">
                                    Espectáculos públicos
                                    </b></p>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-md-12 pt-4" style="padding-left: 10px!important">
            <h1 class="headline-xl-govco">Solicitudes de Espectáculos Públicos</h1>
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
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Garantia Entregada<span class="badge badge-primary">{{$count_garantias}}</span></a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="false">Pendientes <span class="badge badge-primary">{{$count_pendientes}}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="estudio-tab" data-toggle="tab" href="#estudio" role="tab" aria-controls="estudio" aria-selected="false">Documentos Actualizados <span class="badge badge-primary">{{$count_enEstudio}}</span></a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">Aprobadas <span class="badge badge-primary">{{$count_aprobadas}}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="rechazadas-tab" data-toggle="tab" href="#rechazadas" role="tab" aria-controls="rechazadas" aria-selected="false">Liquidación <span class="badge badge-primary">{{$count_liquidacion}}</span></a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="pagadas-tab" data-toggle="tab" href="#pagadas" role="tab" aria-controls="pagadas" aria-selected="false">Pago Efectivo <span class="badge badge-primary">{{$count_pagados}}</span></a>
                            </li>
                    </ul>
                
                    <div class="tab-content">
                    <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                       {{-- TABLA DE ENVIADOS --}}
                        <div class="col-md-12 pt-4">
                            <div id="container_table" class="table-pagination-govco">
                                <table id="DataTables_Table_0"
                                    class="table display table-responsive-md table-responsive-md tablas-espectaculos" width="100%"
                                    style="text-align: left!important;">
                                    <thead>
                                        <tr>
                                            <th style="color: #004884;">Radicado</th>
                                            <th style="color: #004884;">Responsable Espectaculo</th>
                                            <th style="color: #004884;">Nombre del evento</th>
                                            <th style="color: #004884;">Lugar Evento</th>
                                            <th style="color: #004884;">Fecha del evento</th>
                                            <th style="color: #004884;;">Telefono</th>                                            
                                            <th style="color: #004884;;">Detalle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sEnviadas as $solicitudesE)
                                            <tr>
                                                <td>{{ $solicitudesE->radicado }}</td>
                                                <td>{{ $solicitudesE->nombre_o_razon }}</td>
                                                <td>{{ $solicitudesE->nombre_evento }}</td>
                                                <td>{{ $solicitudesE->lugar_evento }}</td>
                                                <td>{{ $solicitudesE->fecha_inicio_evento }} - {{$solicitudesE->fecha_inicio_evento}}</td>                                               
                                                <td>{{ $solicitudesE->telefono_movil }}</td>
                                                
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a type="button" class="btn-symbolic-govco align-column-govco" href="{{route('hacienda.espectaculos.detalle', $solicitudesE->id)}}">
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
                    <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        {{-- tabla de garantia entregada --}}
                        
                        <div class="col-md-12 pt-4">
                            <div id="container_table" class="table-pagination-govco">
                                <table id="DataTables_Table_0" class="table display table-responsive-md  tablas-espectaculos" width="100%" style="text-align: left!important;">
                                    <thead>
                                        <tr>
                                            <th style="color: #004884;">Radicado</th>
                                            <th style="color: #004884;">Responsable Espectaculo</th>
                                            <th style="color: #004884;">Nombre del evento</th>
                                            <th style="color: #004884;">Lugar Evento</th>
                                            <th style="color: #004884;">Fecha del evento</th>
                                            <th style="color: #004884;;">Telefono</th>                                            
                                            <th style="color: #004884;;">Detalle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sGarantia as $solicitudesG)
                                            <tr>
                                                <td>{{ $solicitudesG->radicado }}</td>
                                                <td>{{ $solicitudesG->nombre_o_razon }}</td>
                                                <td>{{ $solicitudesG->nombre_evento }}</td>
                                                <td>{{ $solicitudesG->lugar_evento }}</td>
                                                <td>{{ $solicitudesG->fecha_inicio_evento }} - {{$solicitudesG->fecha_inicio_evento}}</td>                                               
                                                <td>{{ $solicitudesG->telefono_movil }}</td>
                                                
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a type="button" class="btn-symbolic-govco align-column-govco" href="{{route('hacienda.espectaculos.detalle', $solicitudesG->id)}}">
                                                            <span class="govco-icon govco-icon-attached-n"></span>
                                                            <span class="btn-govco-text">Detalles</span></a>

                                                            <a type="button" class="btn-symbolic-govco align-column-govco pl-0 ml-0" href="{{route('tramite.trazabilidad', ['radicado'=>$solicitudesG->radicado , 'tramite' => $tramite] )}}">
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
                       
                    </div>
                    <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                       {{-- TABLA DE PENDIENTES --}}
                       <div class="col-md-12 pt-4">
                        <div id="container_table" class="table-pagination-govco">
                            <table id="DataTables_Table_0"
                                class="table display table-responsive-md table-responsive-md tablas-espectaculos" width="100%"
                                style="text-align: left!important;">
                                <thead>
                                    <tr>
                                            <th style="color: #004884;">Radicado</th>
                                            <th style="color: #004884;">Responsable Espectaculo</th>
                                            <th style="color: #004884;">Nombre del evento</th>
                                            <th style="color: #004884;">Lugar Evento</th>
                                            <th style="color: #004884;">Fecha del evento</th>
                                            <th style="color: #004884;;">Telefono</th>                                            
                                            <th style="color: #004884;;">Detalle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sPendientes as $solicitudesPE)
                                        <tr>
                                               <td>{{ $solicitudesPE->radicado }}</td>
                                                <td>{{ $solicitudesPE->nombre_o_razon }}</td>
                                                <td>{{ $solicitudesPE->nombre_evento }}</td>
                                                <td>{{ $solicitudesPE->lugar_evento }}</td>
                                                <td>{{ $solicitudesPE->fecha_inicio_evento }} - {{$solicitudesPE->fecha_inicio_evento}}</td>                                               
                                                <td>{{ $solicitudesPE->telefono_movil }}</td>
                                            
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a type="button" class="btn-symbolic-govco align-column-govco" href="{{route('hacienda.espectaculos.detalle', $solicitudesPE->id)}}">
                                                        <span class="govco-icon govco-icon-attached-n"></span>
                                                        <span class="btn-govco-text">Detalles</span></a>                                                       
                                                        <a type="button" class="btn-symbolic-govco align-column-govco pl-0 ml-0" href="{{route('tramite.trazabilidad', ['radicado'=>$solicitudesPE->radicado , 'tramite' => $tramite] )}}">
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
                    {{-- </ TABLA DE PENDIENTE FIN --}}
                </div>

            
            <div class="tab-pane" id="estudio" role="tabpanel" aria-labelledby="estudio-tab">

               
               <div class="col-md-12 pt-4">
                <div id="container_table" class="table-pagination-govco">
                    <table id="DataTables_Table_0"
                        class="table display table-responsive-md table-responsive-md tablas-espectaculos" width="100%"
                        style="text-align: left!important;">
                        <thead>
                            <tr>
                                <th style="color: #004884;">Radicado</th>
                                <th style="color: #004884;">Responsable Espectaculo</th>
                                <th style="color: #004884;">Nombre del evento</th>
                                <th style="color: #004884;">Lugar Evento</th>
                                <th style="color: #004884;">Fecha del evento</th>
                                <th style="color: #004884;;">Telefono</th>                                            
                                <th style="color: #004884;;">Detalle</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sEstudio as $solicitudesES)
                            <tr>
                                <td>{{ $solicitudesES->radicado }}</td>
                                 <td>{{ $solicitudesES->nombre_o_razon }}</td>
                                 <td>{{ $solicitudesES->nombre_evento }}</td>
                                 <td>{{ $solicitudesES->lugar_evento }}</td>
                                 <td>{{ $solicitudesES->fecha_inicio_evento }} - {{$solicitudesES->fecha_inicio_evento}}</td>                                               
                                 <td>{{ $solicitudesES->telefono_movil }}</td>
                             
                             <td>
                                 <div class="btn-group" role="group">
                                     <a type="button" class="btn-symbolic-govco align-column-govco" href="{{route('hacienda.espectaculos.detalle', $solicitudesES->id)}}">
                                         <span class="govco-icon govco-icon-attached-n"></span>
                                         <span class="btn-govco-text">Detalles</span></a>                                                       
                                         <a type="button" class="btn-symbolic-govco align-column-govco pl-0 ml-0" href="{{route('tramite.trazabilidad', ['radicado'=>$solicitudesES->radicado , 'tramite' => $tramite] )}}">
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
           
            </div>



                    <div class="tab-pane" id="settings" role="tabpanel" aria-labelledby="settings-tab">

                        
                       <div class="col-md-12 pt-4">
                        <div id="container_table" class="table-pagination-govco">
                            <table id="DataTables_Table_0"
                                class="table display table-responsive-md table-responsive-md tablas-espectaculos" width="100%"
                                style="text-align: left!important;">
                                <thead>
                                    <tr>
                                        <th style="color: #004884;">Radicado</th>
                                        <th style="color: #004884;">Responsable Espectaculo</th>
                                        <th style="color: #004884;">Nombre del evento</th>
                                        <th style="color: #004884;">Lugar Evento</th>
                                        <th style="color: #004884;">Fecha del evento</th>
                                        <th style="color: #004884;;">Telefono</th>                                            
                                        <th style="color: #004884;;">Detalle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sAprobadas as $solicitudesAP)
                                    <tr>
                                        <td>{{ $solicitudesAP->radicado }}</td>
                                         <td>{{ $solicitudesAP->nombre_o_razon }}</td>
                                         <td>{{ $solicitudesAP->nombre_evento }}</td>
                                         <td>{{ $solicitudesAP->lugar_evento }}</td>
                                         <td>{{ $solicitudesAP->fecha_inicio_evento }} - {{$solicitudesAP->fecha_inicio_evento}}</td>                                               
                                         <td>{{ $solicitudesAP->telefono_movil }}</td>
                                     
                                     <td>
                                         <div class="btn-group" role="group">
                                             <a type="button" class="btn-symbolic-govco align-column-govco" href="{{route('hacienda.espectaculos.detalle', $solicitudesAP->id)}}">
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
                    
                    </div>
                    <div class="tab-pane" id="rechazadas" role="tabpanel" aria-labelledby="rechazadas-tab">
                        {{-- TABLA DE EN LIQUIDACION --}}
                       <div class="col-md-12 pt-4">
                        <div id="container_table" class="table-pagination-govco">
                            <table id="DataTables_Table_0"
                                class="table display table-responsive-md table-responsive-md tablas-espectaculos" width="100%"
                                style="text-align: left!important;">
                                <thead>
                                    <tr>
                                        <th style="color: #004884;">Radicado</th>
                                        <th style="color: #004884;">Responsable Espectaculo</th>
                                        <th style="color: #004884;">Nombre del evento</th>
                                        <th style="color: #004884;">Lugar Evento</th>
                                        <th style="color: #004884;">Fecha del evento</th>
                                        <th style="color: #004884;;">Telefono</th>                                            
                                        <th style="color: #004884;;">Detalle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sLiquidacion as $solicitudesLIQ)
                                        <tr>
                                               <td>{{ $solicitudesLIQ->radicado }}</td>
                                                <td>{{ $solicitudesLIQ->nombre_o_razon }}</td>
                                                <td>{{ $solicitudesLIQ->nombre_evento }}</td>
                                                <td>{{ $solicitudesLIQ->lugar_evento }}</td>
                                                <td>{{ $solicitudesLIQ->fecha_inicio_evento }} - {{$solicitudesLIQ->fecha_inicio_evento}}</td>                                               
                                                <td>{{ $solicitudesLIQ->telefono_movil }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a type="button" class="btn-symbolic-govco align-column-govco" href="{{route('hacienda.espectaculos.detalle', $solicitudesLIQ->id)}}">
                                                        <span class="govco-icon govco-icon-attached-n"></span>
                                                        <span class="btn-govco-text">Detalles</span></a>
                                                        
                                                        <a type="button" class="btn-symbolic-govco align-column-govco pl-0 ml-0" href="{{route('tramite.trazabilidad', ['radicado'=>$solicitudesLIQ->radicado , 'tramite' => $tramite] )}}">
                                                            <span class="govco-icon govco-icon-analytic-cn"></span>
                                                            <span class="btn-govco-text text-sms">Trazabilidad</span></a>
                                                
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
                    <div class="tab-pane" id="pagadas" role="tabpanel" aria-labelledby="pagadas-tab">
                        {{-- TABLA DE PAGADAS --}}
                       <div class="col-md-12 pt-4">
                        <div id="container_table" class="table-pagination-govco">
                            <table id="DataTables_Table_0"
                                class="table display table-responsive-md table-responsive-md tablas-espectaculos" width="100%"
                                style="text-align: left!important;">
                                <thead>
                                    <tr>
                                        <th style="color: #004884;">Radicado</th>
                                        <th style="color: #004884;">Responsable Espectaculo</th>
                                        <th style="color: #004884;">Nombre del evento</th>
                                        <th style="color: #004884;">Lugar Evento</th>
                                        <th style="color: #004884;">Fecha del evento</th>
                                        <th style="color: #004884;;">Telefono</th>                                            
                                        <th style="color: #004884;;">Detalle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sPagados as $solicitudesPAG)
                                        <tr>
                                               <td>{{ $solicitudesPAG->radicado }}</td>
                                                <td>{{ $solicitudesPAG->nombre_o_razon }}</td>
                                                <td>{{ $solicitudesPAG->nombre_evento }}</td>
                                                <td>{{ $solicitudesPAG->lugar_evento }}</td>
                                                <td>{{ $solicitudesPAG->fecha_inicio_evento }} - {{$solicitudesPAG->fecha_inicio_evento}}</td>                                               
                                                <td>{{ $solicitudesPAG->telefono_movil }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a type="button" class="btn-symbolic-govco align-column-govco" href="{{route('hacienda.espectaculos.detalle', $solicitudesPAG->id)}}">
                                                        <span class="govco-icon govco-icon-attached-n"></span>
                                                        <span class="btn-govco-text">Detalles</span></a>
                                                        
                                                        <a type="button" class="btn-symbolic-govco align-column-govco pl-0 ml-0" href="{{route('tramite.trazabilidad', ['radicado'=>$solicitudesPAG->radicado , 'tramite' => $tramite] )}}">
                                                            <span class="govco-icon govco-icon-analytic-cn"></span>
                                                            <span class="btn-govco-text text-sms">Trazabilidad</span></a>
                                                
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>

                        </div>
                    </div>
                    {{-- </ TABLA DE PAGADAS --}}
                    </div>

                    </div>
                </div>


                {{-- SEGUNDO PANEL --}}


                <div class="tabs-govco col-md-12 animate__animated animate__bounceInRight pt-5">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                        <a class="nav-link active" id="cancel-tab" data-toggle="tab" href="#cancel" role="tab" aria-controls="cancel" aria-selected="true">En cancelación <span class="badge badge-primary">{{$count_canceladas}}</span></a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" id="revoca-tab" data-toggle="tab" href="#revoca" role="tab" aria-controls="revoca" aria-selected="false">Acto Revocado<span class="badge badge-primary">{{$count_revoca}}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="devolucion-tab" data-toggle="tab" href="#devolucion" role="tab" aria-controls="devolucion" aria-selected="false">Garantia en Devolución <span class="badge badge-primary">{{$count_devolucion}}</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="cerradas-tab" data-toggle="tab" href="#cerradas" role="tab" aria-controls="cerradas" aria-selected="false">Solicitudes Cerradas <span class="badge badge-primary">{{$count_cerradas}}</span></a>
                        </li>
                        {{-- <li class="nav-item">
                        <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">Aprobadas <span class="badge badge-primary">{{$count_aprobadas}}</span></a>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a class="nav-link" id="rechazadas-tab" data-toggle="tab" href="#rechazadas" role="tab" aria-controls="rechazadas" aria-selected="false">liquidación <span class="badge badge-primary">{{$count_rechazadas}}</span></a>
                        </li> --}}
                    </ul>
                
                    <div class="tab-content">
                    <div class="tab-pane active" id="cancel" role="tabpanel" aria-labelledby="cancel-tab">
                      
                        <div class="col-md-12 pt-4">
                            <div id="container_table" class="table-pagination-govco">
                                <table id="DataTables_Table_0"
                                    class="table display table-responsive-md table-responsive-md tablas-espectaculos" width="100%"
                                    style="text-align: left!important;">
                                    <thead>
                                        <tr>
                                            <th style="color: #004884;">Radicado</th>
                                            <th style="color: #004884;">Responsable Espectaculo</th>
                                            <th style="color: #004884;">Nombre del evento</th>
                                            <th style="color: #004884;">Lugar Evento</th>
                                            <th style="color: #004884;">Fecha del evento</th>
                                            <th style="color: #004884;;">Telefono</th>                                            
                                            <th style="color: #004884;;">Detalle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sCanceladas as $solicitudesCancel)
                                            <tr>
                                                <td>{{ $solicitudesCancel->radicado }}</td>
                                                <td>{{ $solicitudesCancel->nombre_o_razon }}</td>
                                                <td>{{ $solicitudesCancel->nombre_evento }}</td>
                                                <td>{{ $solicitudesCancel->lugar_evento }}</td>
                                                <td>{{ $solicitudesCancel->fecha_inicio_evento }} - {{$solicitudesCancel->fecha_inicio_evento}}</td>                                               
                                                <td>{{ $solicitudesCancel->telefono_movil }}</td>
                                                
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a type="button" class="btn-symbolic-govco align-column-govco" href="{{route('hacienda.espectaculos.detalle', $solicitudesCancel->id)}}">
                                                            <span class="govco-icon govco-icon-attached-n"></span>
                                                            <span class="btn-govco-text">Detalles</span></a>

                                                            <a type="button" class="btn-symbolic-govco align-column-govco pl-0 ml-0" href="{{route('tramite.trazabilidad', ['radicado'=>$solicitudesCancel->radicado , 'tramite' => $tramite] )}}">
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
                        
                    </div>
                    {{-- ACTO REVOCADOS --}}
                    <div class="tab-pane" id="revoca" role="tabpanel" aria-labelledby="revoca-tab">
                                               
                        <div class="col-md-12 pt-4">
                            <div id="container_table" class="table-pagination-govco">
                                <table id="DataTables_Table_0" class="table display table-responsive-md  tablas-espectaculos" width="100%" style="text-align: left!important;">
                                    <thead>
                                        <tr>
                                            <th style="color: #004884;">Radicado</th>
                                            <th style="color: #004884;">Responsable Espectaculo</th>
                                            <th style="color: #004884;">Nombre del evento</th>
                                            <th style="color: #004884;">Lugar Evento</th>
                                            <th style="color: #004884;">Fecha del evento</th>
                                            <th style="color: #004884;;">Telefono</th>                                            
                                            <th style="color: #004884;;">Detalle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sActoRevoca as $solicitudesRevoca)
                                            <tr>
                                                <td>{{ $solicitudesRevoca->radicado }}</td>
                                                <td>{{ $solicitudesRevoca->nombre_o_razon }}</td>
                                                <td>{{ $solicitudesRevoca->nombre_evento }}</td>
                                                <td>{{ $solicitudesRevoca->lugar_evento }}</td>
                                                <td>{{ $solicitudesRevoca->fecha_inicio_evento }} - {{$solicitudesRevoca->fecha_inicio_evento}}</td>                                               
                                                <td>{{ $solicitudesRevoca->telefono_movil }}</td>
                                                
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a type="button" class="btn-symbolic-govco align-column-govco" href="{{route('hacienda.espectaculos.detalle', $solicitudesRevoca->id)}}">
                                                            <span class="govco-icon govco-icon-attached-n"></span>
                                                            <span class="btn-govco-text">Detalles</span></a>

                                                            <a type="button" class="btn-symbolic-govco align-column-govco pl-0 ml-0" href="{{route('tramite.trazabilidad', ['radicado'=>$solicitudesRevoca->radicado , 'tramite' => $tramite] )}}">
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
                       
                    </div>
                  {{-- GARANTIA EN DEVOLUCION --}}
                  <div class="tab-pane" id="devolucion" role="tabpanel" aria-labelledby="devolucion-tab">
                      
                    <div class="col-md-12 pt-4">
                     <div id="container_table" class="table-pagination-govco">
                         <table id="DataTables_Table_0"
                             class="table display table-responsive-md table-responsive-md tablas-espectaculos" width="100%"
                             style="text-align: left!important;">
                             <thead>
                                 <tr>
                                         <th style="color: #004884;">Radicado</th>
                                         <th style="color: #004884;">Responsable Espectaculo</th>
                                         <th style="color: #004884;">Nombre del evento</th>
                                         <th style="color: #004884;">Lugar Evento</th>
                                         <th style="color: #004884;">Fecha del evento</th>
                                         <th style="color: #004884;;">Telefono</th>                                            
                                         <th style="color: #004884;;">Detalle</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @foreach ($sDevolucion as $solicitudesDE)
                                     <tr>
                                            <td>{{ $solicitudesDE->radicado }}</td>
                                             <td>{{ $solicitudesDE->nombre_o_razon }}</td>
                                             <td>{{ $solicitudesDE->nombre_evento }}</td>
                                             <td>{{ $solicitudesDE->lugar_evento }}</td>
                                             <td>{{ $solicitudesDE->fecha_inicio_evento }} - {{$solicitudesDE->fecha_inicio_evento}}</td>                                               
                                             <td>{{ $solicitudesDE->telefono_movil }}</td>
                                         
                                         <td>
                                             <div class="btn-group" role="group">
                                                 <a type="button" class="btn-symbolic-govco align-column-govco" href="{{route('hacienda.espectaculos.detalle', $solicitudesDE->id)}}">
                                                     <span class="govco-icon govco-icon-attached-n"></span>
                                                     <span class="btn-govco-text">Detalles</span></a>                                                       
                                                     <a type="button" class="btn-symbolic-govco align-column-govco pl-0 ml-0" href="{{route('tramite.trazabilidad', ['radicado'=>$solicitudesDE->radicado , 'tramite' => $tramite] )}}">
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
                
             </div> 

         {{-- SOLICITUDES CERRADAS --}}
         <div class="tab-pane" id="cerradas" role="tabpanel" aria-labelledby="cerradas-tab">

            
            <div class="col-md-12 pt-4">
             <div id="container_table" class="table-pagination-govco">
                 <table id="DataTables_Table_0"
                     class="table display table-responsive-md table-responsive-md tablas-espectaculos" width="100%"
                     style="text-align: left!important;">
                     <thead>
                         <tr>
                             <th style="color: #004884;">Radicado</th>
                             <th style="color: #004884;">Responsable Espectaculo</th>
                             <th style="color: #004884;">Nombre del evento</th>
                             <th style="color: #004884;">Lugar Evento</th>
                             <th style="color: #004884;">Fecha del evento</th>
                             <th style="color: #004884;;">Telefono</th>                                            
                             <th style="color: #004884;;">Detalle</th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($sCerradas as $solicitudesCER)
                         <tr>
                             <td>{{ $solicitudesCER->radicado }}</td>
                              <td>{{ $solicitudesCER->nombre_o_razon }}</td>
                              <td>{{ $solicitudesCER->nombre_evento }}</td>
                              <td>{{ $solicitudesCER->lugar_evento }}</td>
                              <td>{{ $solicitudesCER->fecha_inicio_evento }} - {{$solicitudesCER->fecha_inicio_evento}}</td>                                               
                              <td>{{ $solicitudesCER->telefono_movil }}</td>
                          
                          <td>
                              <div class="btn-group" role="group">
                                  <a type="button" class="btn-symbolic-govco align-column-govco" href="{{route('hacienda.espectaculos.detalle', $solicitudesCER->id)}}">
                                      <span class="govco-icon govco-icon-attached-n"></span>
                                      <span class="btn-govco-text">Detalles</span></a>                                                       
                                      <a type="button" class="btn-symbolic-govco align-column-govco pl-0 ml-0" href="{{route('tramite.trazabilidad', ['radicado'=>$solicitudesCER->radicado , 'tramite' => $tramite] )}}">
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
        
         </div>


                    {{-- <div class="tab-pane" id="settings" role="tabpanel" aria-labelledby="settings-tab">

                        
                       <div class="col-md-12 pt-4">
                        <div id="container_table" class="table-pagination-govco">
                            <table id="DataTables_Table_0"
                                class="table display table-responsive-md table-responsive-md tablas-espectaculos" width="100%"
                                style="text-align: left!important;">
                                <thead>
                                    <tr>
                                        <th style="color: #004884;">Radicado</th>
                                        <th style="color: #004884;">Responsable Espectaculo</th>
                                        <th style="color: #004884;">Nombre del evento</th>
                                        <th style="color: #004884;">Lugar Evento</th>
                                        <th style="color: #004884;">Fecha del evento</th>
                                        <th style="color: #004884;;">Telefono</th>                                            
                                        <th style="color: #004884;;">Detalle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sAprobadas as $solicitudesAP)
                                    <tr>
                                        <td>{{ $solicitudesAP->radicado }}</td>
                                         <td>{{ $solicitudesAP->nombre_o_razon }}</td>
                                         <td>{{ $solicitudesAP->nombre_evento }}</td>
                                         <td>{{ $solicitudesAP->lugar_evento }}</td>
                                         <td>{{ $solicitudesAP->fecha_inicio_evento }} - {{$solicitudesAP->fecha_inicio_evento}}</td>                                               
                                         <td>{{ $solicitudesAP->telefono_movil }}</td>
                                     
                                     <td>
                                         <div class="btn-group" role="group">
                                             <a type="button" class="btn-symbolic-govco align-column-govco" href="{{route('hacienda.espectaculos.detalle', $solicitudesAP->id)}}">
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
                    
                    </div> --}}
                     {{-- <div class="tab-pane" id="rechazadas" role="tabpanel" aria-labelledby="rechazadas-tab">
                       
                       <div class="col-md-12 pt-4">
                        <div id="container_table" class="table-pagination-govco">
                            <table id="DataTables_Table_0"
                                class="table display table-responsive-md table-responsive-md tablas-espectaculos" width="100%"
                                style="text-align: left!important;">
                                <thead>
                                    <tr>
                                        <th style="color: #004884;">Radicado</th>
                                        <th style="color: #004884;">Responsable Espectaculo</th>
                                        <th style="color: #004884;">Nombre del evento</th>
                                        <th style="color: #004884;">Lugar Evento</th>
                                        <th style="color: #004884;">Fecha del evento</th>
                                        <th style="color: #004884;;">Telefono</th>                                            
                                        <th style="color: #004884;;">Detalle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sRechazadas as $solicitudesRE)
                                        <tr>
                                               <td>{{ $solicitudesRE->radicado }}</td>
                                                <td>{{ $solicitudesRE->nombre_o_razon }}</td>
                                                <td>{{ $solicitudesRE->nombre_evento }}</td>
                                                <td>{{ $solicitudesRE->lugar_evento }}</td>
                                                <td>{{ $solicitudesRE->fecha_inicio_evento }} - {{$solicitudesPE->fecha_inicio_evento}}</td>                                               
                                                <td>{{ $solicitudesRE->telefono_movil }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a type="button" class="btn-symbolic-govco align-column-govco" href="{{route('espacio.detalle', $solicitudesRE->id)}}">
                                                        <span class="govco-icon govco-icon-attached-n"></span>
                                                        <span class="btn-govco-text">Detalles</span></a>
                                                        
                                                        <a type="button" class="btn-symbolic-govco align-column-govco pl-0 ml-0" href="{{route('tramite.trazabilidad', ['radicado'=>$solicitudesRE->radicado , 'tramite' => $tramite] )}}">
                                                            <span class="govco-icon govco-icon-analytic-cn"></span>
                                                            <span class="btn-govco-text text-sms">Trazabilidad</span></a>
                                                
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>

                        </div>
                    </div>
                 
                    </div>  --}}
                    </div>
                </div>          
            </div>
        </div>



    </div>
    @endsection