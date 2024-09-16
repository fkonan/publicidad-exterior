@extends('layouts.app')

@section('content')
<style>
    th.sorting_desc::after, th.sorting_asc::after{
      right: -16px!important;
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
                                <a style="color: #004fbf;" class="breadcrumb-text" href="#">Tramites y servicios</a>
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

        <div class="col-md-12 pt-4">
            <h1 class="headline-xl-govco">Consulta de Solicitudes</h1>
            <div class="row pt-5">
                <div class="col-md-12 justify-content-center">

                    <div class="card govco-card animate__animated animate__bounceInRight">
                        <div class="card-header govco-card-header">
                            <span class="govco-icon govco-icon-analytic size-3x pr-3"> </span>
                         Trazabilidad de la Solicitudes
                        </div>

                        <div class="col-md-12 justify-content-center pt-4">
                            <div id="container_table" class="table-pagination-govco">

                                <table id="DataTables_Table_0"
                                    class="table display table-responsive-sm table-responsive-md tablas" width="100%"
                                    style="text-align: left!important;">
                                    <thead>
                                        <tr>
                                            <th style="color: #004884;" class="">Radicado</th>
                                            <th style="color: #004884;">Nombres Ciudadano</th>                                            
                                            <th style="color: #004884;">Identificación Ciudadano</th>
                                            <th style="color: #004884;;">Email de la solicitud</th>
                                            <th style="color: #004884;">Estado de la solicitud</th>
                                            <th style="color: #004884;">Fecha de Solicitud</th>
                                            <th style="color: #004884;">Detalle </th>

                                        </tr>
                                    </thead>
                                    @foreach ($QuerySolicitud as $solicitud)
                                    <tr>
                                       <td>{{$solicitud->radicado}}</td>
                                       <td>{{$solicitud->nom_solicitante}} {{$solicitud->ape_solicitante}} </td>
                                       <td>{{$solicitud->ide_solicitante}}</td>
                                       <td>{{$solicitud->email_responsable}}</td>
                                       <td>@if ($solicitud->estado_solicitud == 'ENVIADA')
                                        <p style="color: #069169;font-weight:bold">ENVIADA<span class="govco-icon govco-icon-check-p size-1x"></span></p>
                                         @elseif($solicitud->estado_solicitud == 'PENDIENTE')
                                         <p style="color: #3772FF;font-weight:bold">PENDIENTE<span class="govco-icon govco-icon-eye-p size-1x"></span></p>
                                         @elseif($solicitud->estado_solicitud == 'ACTUALIZADA' || $solicitud->estado_solicitud == 'RADICADA')
                                         <p style="color: #F3561F;font-weight:bold">EN PROGRESO<span class="govco-icon govco-icon-reload-n size-1x"></span></p>
                                         @elseif($solicitud->estado_solicitud == 'APROBADA')
                                         <p style="color: #069169;font-weight:bold">APROBADA<span class="govco-icon govco-icon-like size-1x"></span></p>
                                         @elseif($solicitud->estado_solicitud == 'RECHAZADA')
                                         <p style="color: #A80521;font-weight:bold">RECHAZADA<span class="govco-icon govco-icon-x-n size-1x"></span></p>
                                       @endif</td>
                                       <td>{{$solicitud->created_at}}</td>
                                       <td>
                                        @if ($solicitud->estado_solicitud == 'ENVIADA')
                                        <a href="{{route('discapacidad.detalle', Crypt::encrypt($solicitud->id))}}" class="btn-symbolic-govco align-column-govco">
                                            <span class="govco-icon govco-icon-search-cn"></span>
                                            <span class="btn-govco-text">Detalle</span>                                        
                                        @else
                                        <a href="{{route('discapacidad.detalle', Crypt::encrypt($solicitud->id))}}" class="btn-symbolic-govco align-column-govco">
                                            <span class="govco-icon govco-icon-search-cn"></span>
                                            <span class="btn-govco-text">Detalle</span>
                                        </a>

                                        @endif
                                        
                                        
                                    </td>

                                    </tr>
                                        
                                    @endforeach


                                    </tbody>

                                </table>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <a class="btn btn-round btn-high" href="{{ URL::route('discapacidad.index') }}" style="float: left;">Volver</a>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
    </div>

    </div>     

@endsection


