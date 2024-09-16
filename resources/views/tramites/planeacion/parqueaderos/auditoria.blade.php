@extends('layouts.menu')

@section('dashboard')

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
                                    Categorización de parqueaderos
                                    </b></p>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="col-md-12 pt-4" style="padding-left: 10px!important">
            <h1 class="headline-xl-govco"> Observa Solicitud</h1>
            <div class="row pt-5">

                <div style="" class="table-simple-headblue-govco col-md-12 animate__animated animate__bounceInRight">              
                    <table style="width: 100%;" class="table display table-responsive-md table-responsive-md"  cellpadding="20" width="100%">
                      <thead>
                        <tr>
                          <th colspan="3">
                            Solicitud N° - {{$solicitud->radicado}} 
                          </th>
                        </tr>
                      </thead>
                    <tbody>
                    <tr>
                    <td><strong>Radicado N°-&nbsp;<br>
                   </strong>{{$solicitud->radicado}}</td>
                    <td colspan="2"><strong>Nombre del solicitante:</strong><br>
                        {{$solicitud->nom_solicitante}} {{$solicitud->ape_solicitante}}
                    </td>                 
                     
                   
                    </tr>
                    <tr>
                    <td><strong>Número de Identificación</strong><br>
                        {{$solicitud->identificacion_solicitante}}
                   </td>
                    <td colspan="2"><strong>Direccion del solicitante</strong>
                    <br>{{$solicitud->direccion_solicitante}} - {{$solicitud->barrio_solicitante}}                     
                   </td>                    
                    </tr>

                    <tr>
                    <td><strong>Telefono solicitante:</strong><br>
                        {{$solicitud->tel_solicitante}}
                    </td>
                    <td><strong>Correo Solicitante:</strong><br>
                        {{$solicitud->email_responsable}}
                    </td>
                    <td><strong></strong><br>
                        {{-- vacip --}}
                     </td>
                    </tr>
    
                     <tr>
                    <td><strong>Razón social Parqueadero y/o Empresa</strong><br>
                        {{$solicitud->nombre_empresa}}
                    </td>
                    <td colspan="2"><strong>Telefono:</strong><br>
                        {{$solicitud->tel_empresa}}
                    </td>
                    
                    </tr>
    
                     <tr>
                    <td><strong>Dirección Parqueadero y/o Empresa:</strong><br>
                        {{$solicitud->direccion_empresa}}
                    </td>
                    <td colspan="2"><strong>Barrio:</strong><br>
                        {{$solicitud->barrio_empresa}}
                    </td>                
                                   
                    </tr>
                   

                 

                    <tr style="background-color:#004884">
                        <td colspan="3" style="background-color:#004884; color:white">Documentos Adjuntos</td>
                    </tr>

                    <tr>
                        <td><strong>Camara de Comercio y/o RUt:</strong><br>
                            <a href="https://tramitesenlinea.bucaramanga.gov.co/{{$solicitud->adjunto_camara_rut}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                        </td>
                       
                        <td><strong>Planos Aprobados:</strong><br>
                            <a href="https://tramitesenlinea.bucaramanga.gov.co/{{$solicitud->adjunto_planos}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                        </td>
                    </tr>
                    <tr>
                        <td ><strong>Licencia de construcción:</strong><br>
                            @if($solicitud->adjunto_licencia || $solicitud->adjunto_licencia != null)
                            <a href="https://tramitesenlinea.bucaramanga.gov.co/{{$solicitud->adjunto_licencia}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                            @else
                            <small>No hay documento adjunto</small>                      
                            @endif
                        </td>

                        <td><strong>Concepto Técnico:</strong><br>
                            <a href="https://tramitesenlinea.bucaramanga.gov.co/{{$solicitud->adjunto_resPlaneacion}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                        </td>

                    </tr>

                    <tr>                      

                        <td colspan="2"><strong>Observaciones de la solicitud:</strong><br>
                           @if($solicitud->observaciones_solicitud == null || $solicitud->observaciones_solicitud == '' )
                             <small>No hay Observaciones</small>
                            @else
                             {{$solicitud->observaciones_solicitud}} 
                             @endif
                        </td>


                    </tr>
                    <tr>
                        <td><strong>Fecha y hora de la solicitud</strong><br>
                            {{$solicitud->created_at}}
                        </td>
                        <td><strong>Fecha de actuación</strong><br>
                            @if($solicitud->fecha_actuacion == null || $solicitud->fecha_actuacion == '' )
                            <small>No hay fecha de actuaciones</small>
                           @else
                            {{$solicitud->fecha_actuacion}} 
                            @endif
                        </td>
                        <td>                                          
                         
                        </td>
                    </tr>                
                  
                   
                                        
    
                    </tbody>
                    </table>
                     </div>


            </div>
        </div>



    </div>

@endsection