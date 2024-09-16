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
                                    Inhumaciones
                                </b></p>
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
                    <div class="card step-progress border-0" style="font-size: 10px;">
                        <div class="step-slider">
                            <!--<div data-id="step1" class="step-slider-item active" ><p style="padding-top: 0px;margin-top:5px;"></p></div>-->
                            <div data-id="step2" class="step-slider-item active">
                                <p style="padding-top: 0px;margin-top:5px;color: #3366CC;" id="barra_progreso"><span
                                        class="circle_uno">1</span> Inicio</p>
                            </div>
                            <div data-id="step3" class="step-slider-item active">
                                <p style="padding-top: 0px;margin-top:5px;color: #3366CC" id="barra_progreso"><span
                                        class="circle_uno">2 </span> Hago mi solicitud</p>
                            </div>
                            <div data-id="step4" class="step-slider-item active">
                                <p style="padding-top: 0px;margin-top:5px;;color: #3366CC" id="barra_progreso"><span
                                        class="circle_uno">3</span>Procesan mi solicitud</p>
                            </div>
                            <div data-id="step5" class="step-slider-item">
                                <p style="padding-top: 0px;margin-top:5px;" id="barra_progreso"><span
                                        class="circle_uno">4</span> Respuesta</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            {{-- datatable aca --}}

            <div class="col-md-12 pt-4">
                <h1 class="headline-xl-govco">Consulta de Inhumaciones</h1>
                <div class="row pt-5">
                    <div class="col-md-12 justify-content-center">
    
                        <div class="card govco-card animate__animated animate__bounceInRight">
                            <div class="card-header govco-card-header">
                                <span class="govco-icon govco-icon-search-cn size-3x pr-3"> </span>
                             Datos de consulta
                            </div>
    
                            <div class="col-md-12 justify-content-center pt-4">
                                <div id="container_table" class="table-pagination-govco">
    
                                    <table id="DataTables_Table_0"
                                        class="table display table-responsive-sm table-responsive-md tablas" width="100%"
                                        style="text-align: left!important;">
                                        <thead>
                                            <tr>
                                                <th style="color: #004884;" class="">Nombres Y apellidos</th>
                                                <th style="color: #004884;">Documento de Identificación</th>
                                                <th style="color: #004884;;">No Registro de Defunción</th>
                                                <th style="color: #004884;">No Certificado de Notaria</th>
                                                <th style="color: #004884;">Notaria Tramite</th>
                                                <th style="color: #004884;">Funeraria</th>
                                                <th style="color: #004884;">Cementerio</th>
                                               
    
                                            </tr>
                                        </thead>
                                        @foreach ($consulta as $solicitud)
                                        <tr>
                                           <td>{{$solicitud->InNom}} {{$solicitud->InApe}}</td>
                                           <td>{{$solicitud->InNumDoc}}</td>
                                           <td>{{$solicitud->InNumCerFun}}</td>
                                           <td>{{$solicitud->InNumCertNot}}</td>
                                           <td>{{$solicitud->InNotReg}}</td>
                                           <td>{{$solicitud->InFuneraria}}</td>
                                           <td>{{$solicitud->InCementerio}}</td>
                                         
                                         
    
                                        </tr>
                                            
                                        @endforeach
    
    
                                        </tbody>
    
                                    </table>
    
                                </div>
                            </div>
                            <div class="col-md-3">
                                <a class="btn btn-round btn-high" href="{{ URL::route('inhumaciones.index') }}" style="float: left;">Volver</a>
                            </div>
    
                        </div>
    
                    </div>
    
                </div>
            </div>


      </div>
    </div>

{{-- div final  --}}
</div> 


@endsection