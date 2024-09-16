@extends('layouts.menu')
@section('title', 'Modulo de Gestion UTSP')

@section('dashboard')
<style>
    .loader {
            position: relative;
            text-align: center;
            margin: 15px auto 35px auto;
            z-index: 9999;
            display: block;
            width: 80px;
            height: 80px;
            border: 10px solid rgba(0, 0, 0, .3);
            border-radius: 50%;
            border-top-color: #004884;
            animation: spin 1s ease-in-out infinite;
            -webkit-animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                -webkit-transform: rotate(360deg);
            }
        }

        @-webkit-keyframes spin {
            to {
                -webkit-transform: rotate(360deg);
            }
        }
        body {
        overflow-x: hidden!important;
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
                            <a style="color: #004fbf;" class="breadcrumb-text" href="{{route('utsp.index')}}">UTSP</a>
                        </div>
                    </li>
                    <li class="breadcrumb-item ">
                        <div class="image-icon">
                            <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                            <a style="color: #004fbf;" class="breadcrumb-text" href="{{route('utsp.reportes')}}">Reportes UTSP</a>
                        </div>
                    </li>
                    <li class="breadcrumb-item ">
                        <div class="image-icon">
                            <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                            <p class="ml-3 ml-md-0 "><b style="color: #004fbf;text-transform: none;">
                                    Reporte de Solicitud {{$solicitud->radicado}}
                                </b></p>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="col-md-12 pt-4" style="padding-left: 10px!important">
        <h1 class="headline-xl-govco">Reporte de  Solicitud</h1>
        <div class="row pt-5">

            <div style="" class="table-simple-headblue-govco col-md-12 animate__animated animate__bounceInRight">              
                <table style="width: 100%;" class="table display table-responsive-md table-responsive-md"  cellpadding="20" width="100%">
                  <thead>
                    <tr>
                      <th colspan="3">
                        Solicitud {{$solicitud->radicado}} - {{$solicitud->fecha_radicacion}}
                      </th>
                    </tr>
                  </thead>
                <tbody>
                <tr>
                <td><strong>Radicado N°&nbsp;<br>
               </strong>{{$solicitud->radicado}}</td>
                <td><strong>Nombre del Usuario/Solicitante:</strong><br>
                    {{$solicitud->nombre_usuario}} {{$solicitud->apellido_usuario}}
                </td>
                <td><strong>Número de Identificación</strong><br>
                    {{$solicitud->tipo_documento}}-{{$solicitud->numero_documento}}
               </td>                 
                 
               
                </tr>
                <tr>
                
                <td colspan="2"><strong>Direccion del Usuario/Solicitante</strong>
                <br>{{$solicitud->direccion}} - {{$solicitud->nombre_barrio}}                    
               </td>
               <td><b>Comuna:</b><br> {{$solicitud->comuna}} </td>                    
                </tr>

                <tr>
                <td><strong>Telefono Usuario/Solicitante:</strong><br>
                    {{$solicitud->telefono}}
                </td>
                <td><strong>Correo Usuario/Solicitante:</strong><br>
                    {{$solicitud->correo_electronico}}
                </td>
                <td><strong>Fecha de Radicacion</strong><br>
                    {{$solicitud->fecha_radicacion}}
                 </td>
                </tr>

                 <tr>                
                <td colspan="2"><strong>Asunto:</strong><br>
                    {{$solicitud->asunto}}
                </td>
                             
                <td colspan="1"><strong>Empresa de Servicios Publicos:</strong><br>
                    {{$solicitud->empresa_publica}}
                </td>
                             
                
                </tr>

                 <tr>
                <td><strong>Tipo de Atencion:</strong><br>
                    {{$solicitud->tipo_atencion}}
                </td>
                <td><strong>Tipo de Servicio:</strong><br>
                    {{$solicitud->tipo_servicio}}
                </td>  
                <td><strong>Funcionario Responsable:</strong><br>
                    {{$solicitud->username}}
                </td>                
                
                               
                </tr>
               

             

                <tr style="background-color:#004884">
                    <td colspan="3" style="background-color:#004884; color:white">Trazabilidad de la Solicitud</td>
                </tr>

              
                <tr>
                    <td colspan="3">

                        <table class="table table-bordered">
                            <thead style="background-color: black">
                                <th class="text-center">#</th>
                                <th class="text-center">Tramite</th>
                                {{-- <th class="text-center">Empresa de servicios publicos</th> --}}
                                <th class="text-center">Fecha</th>
                                <th class="text-center">Observacion</th>
                                <th class="text-center">Funcionario</th>
                                <th class="text-center">Documentos</th>
                            </thead>
                            <tbody>
                                @foreach($solicitud['observaciones'] as $observaciones)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="text-center">{{$observaciones->tipo_tramite}}</td>
                                    {{-- <td class="text-center">{{$observaciones->empresa_servicios}}</td> --}}
                                    <td class="text-center">{{$observaciones->fecha}}</td>
                                    <td class="text-center">{{$observaciones->observacion}}</td>
                                    <td class="text-center">{{$observaciones->user->name}}</td>
                                    <td class="text-center">
                                        <ol>
                                        @foreach($observaciones->documentos as $documento)
                                        <li style="font-size:14px;">
                                        <a  style="font-size:14px;"href="{{ asset($documento->ruta) }}" target="_blank">{{ $documento->nombre_documento }}🗎</a>
                                    </li>
                                    @endforeach
                               </ol>      
                                                            
                                </td>
                            </tr>
                                @endforeach
                            </tbody>

                        </table>


                       
                    </td>

                </tr>

                <tr style="background-color:#004884">
                    <td colspan="3" style="background-color:#004884; color:white">Estado del Tramite</td>
                </tr>

                <tr>
                    <td colspan="3"><strong>Estado de la solicitud:</strong><br>
                        @if ($solicitud->estado_solicitud == 'ABIERTO')
                                    <p style="color: #069169;font-weight:bold">ABIERTA<span class="govco-icon govco-icon-check-p size-1x"></span></p>
                                     
                                     @elseif($solicitud->estado_solicitud == 'CERRADO')
                                     <p style="color: #A80521;font-weight:bold">CERRADA<span class="govco-icon govco-icon-x-n size-1x"></span></p>
                        @endif                        
                    </td>              
                </tr>  
                <tr>
                    <td colspan="3">
                        <div class="col-md-3 pl-0 mr-0">
                            <a class="btn btn-round btn-high"
                                style="float: left; color:#FFFFFF" onclick="volverAtras()">Atras</a>
                        </div></td>                     
                    
                </tr>           
                
             
                    

                </tbody>
                </table>
                 </div>


        </div>
    </div>



</div>
<script>
    function volverAtras() {
      window.history.back();
    }
  </script>



@endsection
