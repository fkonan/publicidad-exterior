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
            <h1 class="headline-xl-govco">Administración Solicitud</h1>
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
                        <td colspan="3"><strong>Licencia de construcción:</strong><br>
                            @if($solicitud->adjunto_licencia || $solicitud->adjunto_licencia != null)
                            <a href="https://tramitesenlinea.bucaramanga.gov.co/{{$solicitud->adjunto_licencia}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                            @else
                            <small>No hay documento adjunto</small>                      
                            @endif
                        </td>

                    </tr>

                    <tr style="background-color:#004884">
                        <td colspan="3" style="background-color:#004884; color:white">Administración del Tramite</td>
                    </tr>

                    <tr>
                        <td><strong>Estado de la solicitud:</strong><br>
                            @if ($solicitud->estado_solicitud == 'ENVIADA')
                                        <p style="color: #069169;font-weight:bold">ENVIADA<span class="govco-icon govco-icon-check-p size-1x"></span></p>
                                         @elseif($solicitud->estado_solicitud == 'PENDIENTE')
                                         <p style="color: #3772FF;font-weight:bold">PENDIENTE<span class="govco-icon govco-icon-eye-p size-1x"></span></p>
                                         @elseif($solicitud->estado_solicitud == 'REVISION-PLANEACION')
                                         <p style="color: #F3561F;font-weight:bold">TRÁMITE EN CONCEPTO TÉCNICO<span class="govco-icon govco-icon-right-arrow-cn size-1x"></span></p>
                                         @elseif($solicitud->estado_solicitud == 'RESPUESTA-PLANEACION')
                                         <p style="color: #F42E62;font-weight:bold">RESPUESTA TRÁMITE DE CONCEPTO TÉCNICO<span class="govco-icon govco-icon-left-arrow-cn size-1x"></span></p>
                                         @elseif($solicitud->estado_solicitud == 'APROBADA')
                                         <p style="color: #069169;font-weight:bold">APROBADA<span class="govco-icon govco-icon-like size-1x"></span></p>
                                         @elseif($solicitud->estado_solicitud == 'RECHAZADA')
                                         <p style="color: #A80521;font-weight:bold">RECHAZADA<span class="govco-icon govco-icon-x-n size-1x"></span></p>
                                       @endif
                            
                        </td>

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
                    
                    {{-- aqui va el form --}}
                    <form class="myFormDefault form-ciudadano" method="POST" action="{{route('interior.parqueaderos.update')}}"  enctype="multipart/form-data" id="myForm">
                        @csrf
                    <tr>
                       
                        <td>
                            <div class="form-group">
                             <label for="observaciones_planeacion">Observaciones*</label>
                                 <textarea name="observaciones_planeacion" id="observaciones_planeacion" onkeypress="return Direccion(event)"  maxlength="950" class="form-control  @error('observaciones_planeacion') is-invalid @enderror" cols="2" rows="3" required></textarea>
                                 @error('observaciones_planeacion')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror

                            
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label for="documento_respuesta_planeacion">Cargar Respuesta Tecnica</label>
                                <input type="file" accept="application/pdf" name="documento_respuesta_planeacion" id="documento_respuesta_planeacion" class="form-control @error('documento_respuesta_planeacion') is-invalid @enderror" required>
                                @error('documento_respuesta_planeacion')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>

                        </td>
                    </tr>

                    <tr>
                        
                        <td colspan="2">
                            <div class="form-group">
                                <input type="hidden"  name="estado_solicitud" value="RESPUESTA-PLANEACION">
                                <input type="hidden" class="estado_actual" id="estado_sol" value="{{$solicitud->estado_solicitud}}">
                                <input type="hidden" name="username" value="{{auth()->user()->username}}">
                                <input type="hidden" name="id" value="{{$solicitud->id}}">
                                <button type="submit"  onclick="return confirm('¿Esta seguro de generar esta respuesta ?')"  id="myBtn_planeacion" class="btn btn-round btn-middle btn-outline-info btn_enviar_solicitud"  id="Boton">Actualizar estado</button>
                                <button style="font-size:15px;" class="btn btn-round btn-middle btn_carga d-none" type="button" disabled><span class="spinner-grow spinner-grow-sm text-primary" role="status" aria-hidden="true"></span> Actualizando estado...</button>
                                <a href="{{url('/tramites/planeacion/parqueaderos')}}" class="btn btn-round btn-high">Volver</a>


                            </div>
                        </td>
                    </tr>
                    </form>
                    {{-- fin del form --}}






                     
                   
                      
                   
    
                    </tbody>
                    </table>
                     </div>


            </div>
        </div>



    </div>

@endsection