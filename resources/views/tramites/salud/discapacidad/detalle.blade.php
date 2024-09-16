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
            <h1 class="headline-xl-govco">Administración de la Solicitud</h1>
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
                    <td colspan="2"><strong>Nombre del responsable de la solicitud:</strong><br>
                        {{$solicitud->nom_responsable}} {{$solicitud->ape_responsable}}
                    </td>                 
                     
                   
                    </tr>
                    <tr>
                    <td><strong>identificación del responsable:</strong><br>
                        {{$solicitud->ide_responsable}}
                   </td>
                    <td><strong>Correo electronico del responsable:</strong>
                    <br>{{$solicitud->email_responsable}}                 
                   </td> 
                   <td><strong>Telefono del Responsable:</strong>
                    <br>{{$solicitud->tel_responsable}}                 
                   </td>                   
                    </tr>

                    <tr>
                    <td><strong>Nombre de la persona con discapacidad:</strong><br>
                        {{$solicitud->nom_solicitante}} {{$solicitud->ape_solicitante}}
                    </td>
                    <td><strong>Tipo de documento:</strong><br>
                        {{$solicitud->tipo_identificacion_sol }}
                    </td>
                    <td><strong>Identificacion de la persona con discapacidad:</strong><br>
                        {{$solicitud->ide_solicitante}}
                     </td>
                    </tr>
    
                     <tr>
                    <td><strong>Correo electronico:</strong><br>
                        {{$solicitud->correo_solicitante}}
                    </td>
                    <td colspan="2"><strong>Telefono:</strong><br>
                        {{$solicitud->tel_solicitante}}
                    </td>
                    
                    </tr>
    
                     <tr>
                    <td><strong>Dirección:</strong><br>
                        {{$solicitud->direccion_solicitante}}
                    </td>
                    <td colspan="2"><strong>Barrio:</strong><br>
                        {{$solicitud->barrio_solicitante}}
                    </td>                
                                   
                    </tr>
                   

                 

                    <tr style="background-color:#004884">
                        <td colspan="3" style="background-color:#004884; color:white">Documentos Adjuntos</td>
                    </tr>

                    <tr>
                        <td><strong>Recibo servicio publico:</strong><br>
                            <a href="/{{$solicitud->adj_recibo}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                        </td>
                       
                        <td><strong>Documento de identificación:</strong><br>
                            <a href="/{{$solicitud->adj_documento}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                        </td>
                        <td colspan="3"><strong>Historia Clinica:</strong><br>                            
                            <a href="/{{$solicitud->adj_historia_clinica}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>                           
                            
                            
                        </td>
                    </tr>
                    <tr>

                    </tr>
                    @if($solicitud->adj_certificado != null)
                    <tr style="background-color:#004884">
                        <td colspan="3" style="background-color:#004884; color:white">Documento de Respuesta:</td>
                    </tr>
                    <tr>
                        <td colspan="3"><strong>Autorización de la certificacion de discapacidad:</strong><br>
                            <a href="/{{$solicitud->adj_certificado}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                        </td>                    
                    </tr>
                    @endif                    

                    <tr style="background-color:#004884">
                        <td colspan="3" style="background-color:#004884; color:white">Administración del Tramite</td>
                    </tr>

                    <tr>
                        <td><strong>Estado de la solicitud:</strong><br>
                            @if ($solicitud->estado_solicitud == 'ENVIADA')
                                        <p style="color: #069169;font-weight:bold">ENVIADA<span class="govco-icon govco-icon-check-p size-1x"></span></p>
                                         @elseif($solicitud->estado_solicitud == 'PENDIENTE')
                                         <p style="color: #3772FF;font-weight:bold">PENDIENTE<span class="govco-icon govco-icon-eye-p size-1x"></span></p>
                                         @elseif($solicitud->estado_solicitud == 'ACTUALIZADA')
                                         <p style="color: #F3561F;font-weight:bold">DOCUMENTACION ACTUALIZADA<span class="govco-icon govco-icon-right-arrow-cn size-1x"></span></p>
                                         @elseif($solicitud->estado_solicitud == 'RADICADA')
                                         <p style="color: #F42E62;font-weight:bold">SOLICITUD EN CORRECTO ESTADO<span class="govco-icon govco-icon-left-arrow-cn size-1x"></span></p>
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
                       
                    </tr>
                    @if($solicitud->estado_solicitud == 'PENDIENTE')
                    <tr>
                        <td colspan="3"><strong>Fecha maxima de actualizacion de documentos:</strong><br>
                            <span class="text-danger">{{$solicitud->fecha_pendiente}}</span>
                        </td>
                    </tr>
                    @endif                    
                    {{-- aqui va el form --}}
                    <form class="myFormDefaultDiscapacidad" method="POST" action="{{route('salud.discapacidad.update')}}"  enctype="multipart/form-data" id="myForm">
                        @csrf
                    <tr>
                        <td>
                            <div class="form-group">
                                <label for="estado">Cambiar Estado de la solicitud*</label>
                                <select class="form-control  @error('estado_solicitud') is-invalid @enderror" name="estado_solicitud" id="estado_solicitud_discapacidad" required>
                                    <option value="">Seleccione</option>
                                    <option value="PENDIENTE">DOCUMENTOS PENDIENTES</option>
                                    <option value="RADICADA">SOLICITUD EN CORRECTO ESTADO</option>
                                    <option value="APROBADA">APROBADA</option>
                                    <option value="RECHAZADA">RECHAZADA</option>
                                </select>
                                @error('estado_solicitud')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </td>
                        <td colspan="2">
                            <div class="form-group">
                             <label for="observaciones">Observaciones*</label>
                                 <textarea name="observaciones_solicitud" id="observaciones_discapacidad" onkeypress="return Direccion(event)"  maxlength="1450" class="form-control  @error('observaciones_solicitud') is-invalid @enderror"  cols="3" rows="5" required></textarea>
                                 @error('observaciones_solicitud')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror                            
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group">
                                <label for="documento_respuesta">Cargar Respuesta</label>
                                <input type="file" accept="application/pdf" name="documento_respuesta" id="documento_respuesta" class="form-control @error('documento_respuesta') is-invalid @enderror" disabled>
                                @error('documento_respuesta')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>

                        </td>
                        <td colspan="2">
                            <div class="form-group">
                                <input type="hidden" class="estado_actual" id="estado_sol" value="{{$solicitud->estado_solicitud}}">
                                <input type="hidden" name="username" value="{{auth()->user()->username}}">
                                <input type="hidden" name="id" value="{{$solicitud->id}}">
                                <button type="submit"  onclick="return confirm('¿Esta seguro de generar esta respuesta ?')"  id="btn_discapacidad" class="btn btn-round btn-middle btn-outline-info"  >Actualizar estado</button>
                                <a href="{{url('/tramites/salud/discapacidad')}}" class="btn btn-round btn-high">Volver</a>


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