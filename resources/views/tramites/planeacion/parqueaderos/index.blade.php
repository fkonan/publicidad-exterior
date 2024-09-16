@extends('layouts.menu')

@section('dashboard')
<?php $tramite= 'CATEGORIZACION DE PARQUEADEROS';?>

<style>
    th.sorting_desc::after, th.sorting_asc::after{
      right: 0!important;
      content: ""!important;
   }
</style>

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
                                        Parqueaderos
                                    </b></p>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-md-12 pt-4" style="padding-left: 10px!important">
            <h1 class="headline-xl-govco">Solicitudes Concepto Técnico Parqueaderos</h1>
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
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Solicitudes Sec Interior  <span class="badge badge-primary">{{$contador_revision}}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="respuestas-tab" data-toggle="tab" href="#respuestas" role="tab" aria-controls="home" aria-selected="true">Respuesta de Conceptos Técnicos  <span class="badge badge-primary">{{$contador_revisadas}}</span></a>
                        </li>
                        
                    </ul>
                
                    <div class="tab-content">
                    <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                       {{-- TABLA DE ENVIADOS --}}
                         {{-- TABLA REVISADAS PLANEACION --}}
                       <div class="col-md-12 pt-4">
                        <div id="container_table" class="table-pagination-govco">
                            <table id="DataTables_Table_0"
                                class="table display table-responsive-md table-responsive-md tablas" width="100%"
                                style="text-align: left!important;">
                                <thead>
                                    <tr>
                                        <th style="color: #004884;;">Fecha Limite de Respuesta</th>
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
                                    @foreach ($sEnRevision as $solicitudesRe)
                                    <tr>
                                        <td><strong>{{ \Carbon\Carbon::parse($solicitudesRe->fecha_pendiente_planeacion)->diffForHumans() }}</strong>(<small>{{$solicitudesRe->fecha_pendiente_planeacion}}</small>)</p></td>
                                        <td>{{ $solicitudesRe->radicado }}</td>                                        
                                        <td>{{ $solicitudesRe->nom_solicitante }} {{ $solicitudesRe->ape_solicitante }} </td>
                                        <td>{{ $solicitudesRe->identificacion_solicitante }}</td>
                                        <td>{{ $solicitudesRe->email_responsable }}</td>
                                        <td>{{ $solicitudesRe->tel_solicitante }}</td>
                                        <td>{{ $solicitudesRe->nombre_empresa }}</td>                                       
                                        <td>{{ $solicitudesRe->direccion_empresa }}- {{$solicitudesRe->barrio_empresa }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a type="button" class="btn-symbolic-govco align-column-govco" href="{{route('planeacion.parqueaderos.detalle', $solicitudesRe->id)}}">
                                                    <span class="govco-icon govco-icon-attached-n"></span>
                                                    <span class="btn-govco-text">Detalles</span></a>                                               
                                            
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
                    
                    <div class="tab-pane" id="respuestas" role="tabpanel" aria-labelledby="respuestas-tab">

                        {{-- TABLA de RESPUESTA DE CONCEPTOS TECNICOS --}}
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
                <a type="button" class="btn-symbolic-govco align-column-govco" href="{{route('planeacion.parqueaderos.detalle.auditoria', $solicitudesRe->id)}}">
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
                        {{-- </ TABLA de RESPUESTA DE CONCEPTOS TECNICOS--}}
                    </div>
                                          
                    </div>
                </div>


            


            </div>
        </div>



    </div>
    @endsection