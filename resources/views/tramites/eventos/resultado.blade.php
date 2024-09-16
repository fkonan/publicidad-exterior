@extends('layouts.app')

@section('content')
<style>
    th.sorting_desc::after, th.sorting_asc::after{
      right: -16px!important;
   }
</style>

    <div class="container mt-3 mb-4 m-xs-x-3">
    <div class="row pl-4">
            <div class="px-0 col-md-9 col-xs-12 col-sm-12">
                <nav aria-label="Miga de pan" style="max-height: 20px;">
                    <ol class="breadcrumb" style="background-color: #FFFFFF;">
                        <li class="breadcrumb-item ml-3 ml-md-0">
                            <a style="color: #004fbf; font-size:14px;" class="breadcrumb-text" href="https://www.bucaramanga.gov.co/" tabindex="3">Inicio</a>
                        </li>
                        <li class="breadcrumb-item ">
                            <div class="image-icon">
                                <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                                <a style="color: #004fbf; font-size:14px;" class="breadcrumb-text" href="https://www.bucaramanga.gov.co/tramites/"  tabindex="4">Tramites y servicios</a>
                            </div>
                        </li>
                        <li class="breadcrumb-item ">
                            <div class="image-icon">
                                <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                                <p class="ml-3 ml-md-0 text-miga" style="color: #004884; font-size:14px;">
                                        Permisos para Espectáculos Públicos
                                    </p>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row mt-2">
                <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
                    <div class="col-md-12" style="padding-left: 0!important">
                        <div class="card step-progress border-0" style="font-size: 10px; background-color: transparent !important;">
                            <div class="step-slider">
                                <!--<div data-id="step1" class="step-slider-item active" ><p style="padding-top: 0px;margin-top:5px;"></p></div>-->
                                @if($QuerySolicitud[0]->estado_solicitud == 'RECHAZADA' || $QuerySolicitud[0]->estado_solicitud == 'APROBADA')
                                <div data-id="step2" class="step-slider-item active">
                                    <p style="padding-top: 0px;margin-top:5px;color: #BABABA;" id="barra_progreso"><span
                                            class="circle_cero">1</span> Inicio</p>
                                </div>
                                <div data-id="step3" class="step-slider-item active">
                                    <p style="padding-top: 0px;margin-top:5px;color: #BABABA" id="barra_progreso"><span
                                            class="circle_cero">2 </span> Hago mi solicitud</p>
                                </div>
                                <div data-id="step4" class="step-slider-item active">
                                    <p style="padding-top: 0px;margin-top:5px; color: #BABABA" id="barra_progreso"><span
                                            class="circle_cero">3</span>Procesan mi solicitud</p>
                                </div>
                                <div data-id="step5" class="step-slider-item active">
                                    <p style="padding-top: 0px;margin-top:5px; color: #3366CC" id="barra_progreso"><span
                                            class="circle_uno">4</span> Respuesta</p>
                                </div>

                                @else     
                                <div data-id="step2" class="step-slider-item active">
                                    <p style="padding-top: 0px;margin-top:5px;color: #BABABA;" id="barra_progreso"><span
                                            class="circle_cero">1</span> Inicio</p>
                                </div>
                                <div data-id="step3" class="step-slider-item active">
                                    <p style="padding-top: 0px;margin-top:5px;color: #BABABA" id="barra_progreso"><span
                                            class="circle_cero">2 </span> Hago mi solicitud</p>
                                </div>
                                <div data-id="step4" class="step-slider-item">
                                    <p style="padding-top: 0px;margin-top:5px; color: #3366CC" id="barra_progreso"><span
                                            class="circle_uno">3</span>Procesan mi solicitud</p>
                                </div>
                                <div data-id="step5" class="step-slider-item">
                                    <p style="padding-top: 0px;margin-top:5px;" id="barra_progreso"><span
                                            class="circle_dos">4</span> Respuesta</p>
                                </div>
                                @endif
   
                            </div>
                        </div>
                    </div> 
                    <h3 class="Headline-l">Respuesta de Consulta</h3>
                    <p class="text-justify">A través de la siguiente funcionalidad podrás observar el estado actual en el que se encuentra su solicitud presentada ante la Alcaldía de Bucaramanga en el trámite de <B style="text-transform: uppercase;">Permiso para espectáculos públicos diferentes a las artes escénicas</B>, depende del estado actual de su trámite podrá interactuar sobre su solicitud o ejercer acciones sobre la misma. </p>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <!---contenido de cajas -->

                    <div class="accordion accordion-govco mb-3" id="">
                        <div class="card mb-0">
                            <div class="card-header row no-gutters" id="">
                                <button class="btn-link row no-gutters" type="button">
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                       <a  type="button" href="{{asset('library/Manuales/M-TIC-1400-170-015 M. Usuario Permi. Espect. Difere. Artes (ciudadano).pdf')}}" target="_blank"><h4 class="headline-s-govco" tabindex="5">Manual de usuario</h4></a>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <div class="btn-icon-close">
                                            {{-- <span class="govco-icon govco-icon-shortu-arrow-n size-1x"></span> --}}
                                            {{-- <span class="govco-icon govco-icon-shortd-arrow-n size-1x"></span> --}}
                                        </div>
                                    </div>
                                </button>
                            </div>                        
                        </div>
                    </div>
                       

                    <div class="accordion accordion-govco" id="EjemploAccordion-2">
                        <div class="card mb-0">
                            <div class="card-header row no-gutters" id="headingUno">
                                <button class="btn-link row no-gutters collapsed" type="button" data-toggle="collapse"
                                    data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9" tabindex="6">
                                        <h4 class="headline-s-govco">¿Tienes dudas?</h4>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <div class="btn-icon-close">                                            
                                            <span class="govco-icon govco-icon-shortd-arrow-n size-1x"></span>
                                        </div>
                                    </div>
                                </button>
                            </div>
                            <div id="collapse1" class="collapse mb-3" aria-labelledby="headingUno"
                                data-parent="#EjemploAccordion-2">
                                <div class="card-body bg-color-selago">
                                    <div class="container">
                                        <p class="form-inline my-0"><span class="govco-icon govco-icon-email"></span> <a
                                                style="color: #3366CC; font-size: 13px!important;" href="mailto:contactenos@bucaramanga.gov.co" target="_blank" tabindex="7"> ccalderon@bucaramanga.gov.co</a></p>
                                        <p class="form-inline my-0"><span class="govco-icon govco-icon-call-center"></span><a
                                                style="color: #3366CC; font-size: 13px!important;" tabindex="7" href="tel:0376337000"> (+57)7 633 70 00 EXT 315</a></p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion accordion-govco" id="acc4">
                        <div class="card">
                            <div class="card-header row no-gutters" id="c4">
                                <button class="btn-link row no-gutters collapsed" type="button" data-toggle="collapse"
                                    data-target="#coll4" aria-expanded="false" aria-controls="coll4" id="btn_colapse">
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9" tabindex="8">
                                        <h4 class="headline-s-govco">¿Como fue tu experiencia durante el proceso?</h4>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <div class="btn-icon-close">
                                            <span class="govco-icon govco-icon-shortd-arrow-n size-1x"></span>
                                        </div>
                                    </div>
                                </button>
                            </div>
                            <div id="coll4" class="collapse" aria-labelledby="c4" data-parent="#acc4">
                                <div class="card-body bg-color-selago">
                                    <div class="row justify-content-center spacer no-gutters">
                                        <div class="col-3 pl-3 pt-2">
                                            <button type="button" id="btn-facil-global"class="btn-symbolic-govco align-column-govco btn-facil-global" tabindex="8" value="FACIL">
                                                <span class="govco-icon govco-icon-check-cn size-3x"></span>
                                                <span class="btn-govco-text">Facil</span>
                                            </button>
                                        </div>

                                        <div class="col-3 pl-3 pt-2">
                                            <button type="button" id="btn-dificil-global"
                                                class="btn-symbolic-govco align-column-govco btn-dificil-global"
                                                value="DIFICIL" tabindex="8">
                                                <span class="govco-icon govco-icon-x-cn size-3x"></span>
                                                <span class="btn-govco-text">Dificil</span>
                                            </button>
                                        </div>
                                    </div>
                                    {{-- modulo tramites --}}
                                    <input id="modulo" type="hidden" class="form-control modulo"
                                        value="PERMISOS PARA ESPECTACULOS PUBLICOS">


                                    <div class="container text-center">
                                        <button type="button" class="btn btn-round btn-middle btn-block"
                                            id="btn-sugerencias" data-toggle="tooltip" data-placement="right"
                                            title="Después de escribir tus sugerencias oprime FACIL o DIFICIL para enviarlas"
                                            style="" tabindex="8">Escribe
                                            tus sugerencias</button><br>
                                        <div id="Texto_sugerencias" style="display: none;">
                                            <p style="color:#3366CC;"> Gracias por compartir tu experiencia</p>
                                        </div>

                                        <div id="text-button" style="padding-bottom: 10px; display: none;">
                                            <label class="text-left small">Escribe tus comentarios</label>
                                            <textarea class="form-control pb-2" rows="5"
                                                placeholder="Queremos conocer tu experiencia, sugerencias y consejos"
                                                id="text-area" tabindex="8" maxlength="300" onkeypress="return Direccion(event)"
                                                onkeyup="aMayusculas(this.value,this.id)"></textarea>
                                                <button type="button" class="btn btn-round btn-middle btn-block enviar-sugerencias"
                                                id="enviar-sugerencias" data-toggle="tooltip" data-placement="right" title="enviar sugerencias" tabindex="8">Envia tus sugerencias</button>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- tercer acordion --}}

                    <div class="accordion accordion-govco pt-0 d-none" id="acc3">
                        <div class="card">
                            <div class="card-header row no-gutters" id="c3">
                                <button class="btn-link row no-gutters collapsed" type="button" data-toggle="collapse"
                                    data-target="#coll3" aria-expanded="false" aria-controls="coll3">
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                        <span class="title">Consulto mi Solicitud</span>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <div class="btn-icon-close">
                                            <span class="govco-icon govco-icon-minus"></span>
                                            <span class="govco-icon govco-icon-simpled-arrow"></span>
                                        </div>
                                    </div>
                                </button>
                            </div>
                            <div id="coll3" class="collapse" aria-labelledby="c3" data-parent="#acc3">
                                <div class="card-body bg-color-selago">
                                    <div class="container text-center">
                                        <button data-toggle="modal" data-target="#ModalConsulta" type="button"
                                            class="btn btn-round btn-middle">CONSULTE AQUÍ
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>          
                  
                  
                                  
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
                                            <th style="color: #004884;">Nombres Reponsable</th>                                            
                                            <th style="color: #004884;">Ubicación del evento</th>
                                            <th style="color: #004884;;">Fecha del evento</th>
                                            <th style="color: #004884;">Estado de la solicitud</th>
                                            <th style="color: #004884;">Fecha de Solicitud</th>
                                            <th style="color: #004884;">Detalle </th>

                                        </tr>
                                    </thead>
                                    @foreach ($QuerySolicitud as $solicitud)
                                    <tr>
                                       <td>{{$solicitud->radicado}}</td>
                                       <td>@if($solicitud->tipo_persona == 1)
                                       {{$solicitud->nom_responsable}} {{$solicitud->ape_responsable}} 
                                       @else
                                       {{$solicitud->razon_social}}
                                       @endif 
                                    </td>
                                       <td>{{$solicitud->ubicacion_evento}} -{{$solicitud->barrio_evento}}</td>
                                       <td>{{$solicitud->fecha_evento}}</td>
                                       <td>@if ($solicitud->estado_solicitud == 'ENVIADA')
                                        <p style="color: #069169;font-weight:bold">ENVIADA<span class="govco-icon govco-icon-check-p size-1x"></span></p>
                                         @elseif($solicitud->estado_solicitud == 'PENDIENTE')
                                         <p style="color: #3772FF;font-weight:bold">PENDIENTE<span class="govco-icon govco-icon-eye-p size-1x"></span></p>                                        
                                         @elseif($solicitud->estado_solicitud == 'APROBADA')
                                         <p style="color: #069169;font-weight:bold">APROBADA<span class="govco-icon govco-icon-like size-1x"></span></p>
                                         @elseif($solicitud->estado_solicitud == 'RECHAZADA')
                                         <p style="color: #A80521;font-weight:bold">RECHAZADA<span class="govco-icon govco-icon-x-n size-1x"></span></p>
                                       @endif</td>
                                       <td>{{$solicitud->created_at}}</td>
                                       <td>
                                        @if ($solicitud->estado_solicitud == 'ENVIADA')
                                        <small>Su solicitud aun no ha sido revisada</small>
                                        @elseif($solicitud->estado_solicitud == 'REVISION-PLANEACION' || $solicitud->estado_solicitud == 'RESPUESTA-PLANEACION')
                                        <small>TRÁMITE EN CONCEPTO TÉCNICO</small>
                                        @else
                                        <a href="{{route('eventos.detalle', Crypt::encrypt($solicitud->id))}}" class="btn-symbolic-govco align-column-govco">
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
                            <a class="btn btn-round btn-high" href="{{ URL::route('eventos.index') }}" style="float: left;">Volver</a>
                        </div>

                    </div>

                </div>

            
        </div>
    </div>
        



        
        

            </div>
        </div>
    </div>
    </div>

    </div>     

@endsection


