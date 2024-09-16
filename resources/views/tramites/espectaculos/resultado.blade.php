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
                                    Espectaculos Publicos
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
                                            <th style="color: #004884;">Responsable de la solicitud</th>                                          
                                            <th style="color: #004884;;">Lugar de evento</th>
                                            <th style="color: #004884;">Fecha del evento</th>
                                            <th style="color: #004884;">Nombre del evento</th>
                                            <th style="color: #004884;">Estado Solicitud</th>
                                            <th style="color: #004884;">Fecha de solicitud</th>
                                            <th style="color: #004884;">Detalle </th>

                                        </tr>
                                    </thead>
                                    @foreach ($QuerySolicitud as $solicitud)
                                    <tr>
                                       <td>{{$solicitud->radicado}}</td>
                                       <td>{{$solicitud->nombre_o_razon}}</td>
                                       <td>{{$solicitud->lugar_evento}}</td>
                                       <td>{{$solicitud->fecha_inicio_evento}} hasta {{$solicitud->fecha_fin_evento}}</td>
                                       <td>{{$solicitud->nombre_evento}}</td>
                                      
                                       <td>@if ($solicitud->estado_solicitud == 'ENVIADA')
                                        <p style="color: #069169;font-weight:bold">ENVIADA<span class="govco-icon govco-icon-check-p size-1x"></span></p>
                                         @elseif($solicitud->estado_solicitud == 'PENDIENTE')
                                         <p style="color: #3772FF;font-weight:bold">PENDIENTE<span class="govco-icon govco-icon-eye-p size-1x"></span></p>
                                         @elseif($solicitud->estado_solicitud == 'ENTREGA_GARANTIA')
                                         <p style="color: #F3561F;font-weight:bold">GARANTIA ENTREGADA<span class="govco-icon govco-icon-document-n size-1x"></span></p>
                                         @elseif($solicitud->estado_solicitud == 'REVISION-PLANEACION' || $solicitud->estado_solicitud == 'RESPUESTA-PLANEACION')
                                         <p style="color: #F3561F;font-weight:bold">EN PROGRESO<span class="govco-icon govco-icon-reload-n size-1x"></span></p>
                                         @elseif($solicitud->estado_solicitud == 'EVENTO_APROBADO')
                                         <p style="color: #069169;font-weight:bold">APROBADA<span class="govco-icon govco-icon-like size-1x"></span></p>
                                         @elseif($solicitud->estado_solicitud == 'EVENTO_CANCELADO')
                                         <p style="color: #A80521;font-weight:bold">EVENTO EN CANCELACION<span class="govco-icon govco-icon-x-n size-1x"></span></p>
                                         @elseif($solicitud->estado_solicitud == 'ACTO_REVOCADO')
                                         <p style="color: #4B4B4B;font-weight:bold">ACTO REVOCADO<span class="govco-icon govco-icon-left-arrow-cn size-1x"></span></p>
                                         @elseif($solicitud->estado_solicitud == 'DEVOLUCION_GARANTIA')                                         
                                         <p style="color: #F3561F;font-weight:bold">GARANTIA DEVUELTA<span class="govco-icon govco-icon-document-n size-1x"></span></p>
                                         @elseif($solicitud->estado_solicitud == 'EVENTO_FINALIZADO')
                                         <p style="color: #000000;font-weight:bold">SOLICITUD CERRADA<span class="govco-icon govco-icon-legal size-1x"></span></p>
                                         @elseif($solicitud->estado_solicitud == 'EVENTO_REALIZADO')
                                         <p style="color: #069169;font-weight:bold">SOLICITUD EN LIQUIDACION<span class="govco-icon govco-icon-peso-col size-1x"></span></p>
                                         @elseif($solicitud->estado_solicitud == 'DOCUMENTOS_ACTUALIZADOS')
                                         <p style="color: #FFAB00;font-weight:bold">SOLICITUD EN REVISION <span class="govco-icon govco-icon-edit-p  size-1x"></span></p>
                                         @elseif($solicitud->estado_solicitud == 'PAGO_REALIZADO')
                                         <p style="color: #004884;font-weight:bold">PAGO REALIZADO<span class="govco-icon govco-icon-peso-col-cn size-1x"></span></p>
                                       @endif</td>
                                       <td>{{$solicitud->created_at}}</td>
                                       <td>
                                        @if ($solicitud->estado_solicitud == 'ENVIADA')
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{route('espectaculos.detalle', Crypt::encrypt($solicitud->id))}}" class="btn-symbolic-govco align-column-govco" role="button">
                                                <span class="govco-icon govco-icon-search-cn"></span>
                                                <span class="btn-govco-text">Detalle</span></a>
    
                                                <a href="{{route('espectaculos.cancelar', Crypt::encrypt($solicitud->id))}}" class="btn-symbolic-govco align-column-govco btn-eliminar" role="button" onclick="return confirm('¿Esta seguro de cancelar esta solicitud ?')">
                                                    <span class="govco-icon govco-icon-x-cn"></span>
                                                    <span class="btn-govco-text">Cancelar</span>
                                                </a>
    
                                            </div>
                                        @elseif($solicitud->estado_solicitud == 'EVENTO_REALIZADO')
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{route('espectaculos.certiBoleteria', Crypt::encrypt($solicitud->id))}}" class="btn-symbolic-govco align-column-govco" role="button">
                                            <span class="govco-icon govco-icon-searchdoc"></span>
                                            <span class="btn-govco-text">Cargar Certificación de Boleteria E Informacion de Pago</span></a>

                                            <a href="https://impuestos.bucaramanga.gov.co/Espectaculos/index" target="_blank" class="btn-symbolic-govco align-column-govco" role="button">
                                                <span class="govco-icon govco-icon-shortr-arrow"></span>
                                                <span class="btn-govco-text">Elaborar Declaración</span></a>
                                        </div>
                                        
                                        @else
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{route('espectaculos.detalle', Crypt::encrypt($solicitud->id))}}" class="btn-symbolic-govco align-column-govco" role="button">
                                                <span class="govco-icon govco-icon-search-cn"></span>
                                                <span class="btn-govco-text">Detalle</span></a>
    
                                                <a href="{{route('espectaculos.cancelar', Crypt::encrypt($solicitud->id))}}" class="btn-symbolic-govco align-column-govco btn-eliminar" role="button" onclick="return confirm('¿Esta seguro de cancelar esta solicitud ?')">
                                                    <span class="govco-icon govco-icon-x-cn"></span>
                                                    <span class="btn-govco-text">Cancelar</span>
                                                </a>
    
                                            </div>

                                        @endif
                                        
                                        
                                    </td>

                                    </tr>
                                        
                                    @endforeach


                                    </tbody>

                                </table>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <a class="btn btn-round btn-high" href="{{ URL::route('espectaculos.index') }}" style="float: left;">Volver</a>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
    </div>

    </div>     

@endsection


