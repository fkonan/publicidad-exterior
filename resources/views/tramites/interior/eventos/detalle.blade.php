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
                                        Interior</a>                                    
                            </div>
                        </li>
                        <li class="breadcrumb-item ">
                            <div class="image-icon">
                                <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                                <p class="ml-3 ml-md-0 "><b style="color: #004fbf;text-transform: none;">
                                    Permisos para Espectáculos Públicos
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
                    <td colspan="2"><strong>Responsable de la solicitud:</strong><br>
                        @if($solicitud->tipo_persona == 1)
                        {{$solicitud->nom_responsable}} {{$solicitud->ape_responsable}}
                        @else
                        {{$solicitud->razon_social}}
                        @endif
                    </td>                 
                     
                   
                    </tr>
                    <tr>
                    <td><strong>Número de Identificación</strong><br>
                        {{$solicitud->ide_responsable}}
                   </td>
                    <td colspan="2"><strong>Direccion del solicitante</strong>
                    <br>{{$solicitud->dir_responsable}}         
                   </td>                    
                    </tr>

                    <tr>
                    <td><strong>Telefono solicitante:</strong><br>
                        {{$solicitud->tel_responsable}}
                    </td>
                    <td colspan="2"><strong>Correo Solicitante:</strong><br>
                        {{$solicitud->email_responsable}}
                    </td>
                    <td><strong></strong><br>
                        {{-- vacip --}}
                     </td>
                    </tr>
    
                     <tr>
                    <td><strong>Ubicación del evento</strong><br>
                        {{$solicitud->ubicacion_evento}}
                    </td>
                    <td ><strong>Barrio del evento:</strong><br>
                        {{$solicitud->barrio_evento}}
                    </td>
                    
                    </tr>

                    <tr>
                        <td><strong>Asistencia al Evento:</strong><br>
                            {{$solicitud->cant_personas}} personas Aprox
                        </td>
                        <td ><strong>Uso de Publicidad Exterior:</strong><br>
                            {{$solicitud->pub_ext}}
                        </td>

                        <td ><strong>Reproduccion de Obras Artisticas:</strong><br>
                            {{$solicitud->reproduccion_musica}}
                        </td>
                        
                        
                    </tr>
    
                     <tr>
                    <td><strong>Fecha del evento</strong><br>
                        {{$solicitud->fecha_evento}}
                    </td>
                    <td colspan="2"><strong>Horario Evento:</strong><br>
                        {{$solicitud->hora_inicio}} hasta {{$solicitud->hora_fin}}
                    </td>                
                                   
                    </tr>

                    <tr>
                        <td colspan="3"><strong>Descripción del evento</strong><br>
                            {{$solicitud->descripcion_evento}}
                        </td>                                  
                                       
                   </tr>
                       
                   

                 

                    <tr style="background-color:#004884">
                        <td colspan="3" style="background-color:#004884; color:white">Documentos Adjuntos</td>
                    </tr>

                    <tr>
                        <td><strong>Logistica del evento:</strong><br>
                            @if($solicitud->adj_logisticaEvento != null)
                            <a href="https://tramitesenlinea.bucaramanga.gov.co/{{$solicitud->adj_logisticaEvento}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                            @else
                            <small>No hay documento adjunto</small>
                            @endif
                        </td>
                       
                        <td><strong>Autorización de transito:</strong><br>
                            @if($solicitud->adj_autorizacionTra != null)
                            <a href="https://tramitesenlinea.bucaramanga.gov.co/{{$solicitud->adj_autorizacionTra}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                            @else
                            <small>No hay documento adjunto</small>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Documento de identificación:</strong><br>
                            <a href="https://tramitesenlinea.bucaramanga.gov.co/{{$solicitud->adj_cedulaRes}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                        </td>

                        <td><strong>Contrato de arrendamiento:</strong><br>
                            <a href="https://tramitesenlinea.bucaramanga.gov.co/{{$solicitud->adj_contratoArr}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                        </td>

                    </tr>

                    <tr>
                        <td><strong>Concepto del Comité de Gestion del Riesgo:</strong><br>
                            @if($solicitud->adj_conceptoCMGRD != null)
                            <a href="https://tramitesenlinea.bucaramanga.gov.co/{{$solicitud->adj_conceptoCMGRD}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                            @else
                            <small>No hay documento adjunto</small>
                            @endif
                        </td>

                        <td><strong>Concepto Tecnico Sanitario y Ambiental:</strong><br>
                            <a href="https://tramitesenlinea.bucaramanga.gov.co/{{$solicitud->adj_conceptoTecAmb}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                        </td>

                    </tr>

                    <tr>
                        <td><strong>Certificado MEBUC:</strong><br>
                            <a href="https://tramitesenlinea.bucaramanga.gov.co/{{$solicitud->adj_certificadoPONAL}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                        </td>

                        <td><strong>Aprobación Bomberos Bucaramanga:</strong><br>
                            @if($solicitud->adj_certificadoBomberos != null)
                            <a href="https://tramitesenlinea.bucaramanga.gov.co/{{$solicitud->adj_certificadoBomberos}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                            @else
                            <small>No hay documento adjunto</small>
                            @endif

                        </td>

                    </tr>
                    <tr>
                        <td><strong>Prestación de Servicio Pre Hospitalaria:</strong><br>
                            @if($solicitud->adj_hospitalaria != null)
                            <a href="https://tramitesenlinea.bucaramanga.gov.co/{{$solicitud->adj_hospitalaria}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                            @else
                            <small>No hay documento adjunto</small>
                            @endif
                        </td>

                        <td><strong>Póliza de responsabilidad civil:</strong><br>
                            <a href="https://tramitesenlinea.bucaramanga.gov.co/{{$solicitud->adj_poliza}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                            
                        </td>

                    </tr>

                    <tr>
                        <td><strong>Soporte de Pago Publicidad Exterior:</strong><br>
                            @if($solicitud->adj_publicidad != null)
                            <a href="https://tramitesenlinea.bucaramanga.gov.co/{{$solicitud->adj_publicidad}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                            @else
                            <small>No hay documento adjunto</small>
                            @endif
                        </td>

                        <td><strong>Certificado de Aseo(EMAB):</strong><br>
                            <a href="https://tramitesenlinea.bucaramanga.gov.co/{{$solicitud->adj_certificadoEMAB}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                        </td>

                    </tr>
                    <tr>                        
                        <td><strong>Autorización derechos de Autor:</strong><br>
                            @if($solicitud->adj_derAutor != null)
                            <a href="https://tramitesenlinea.bucaramanga.gov.co/{{$solicitud->adj_derAutor}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                            @else
                            <small>No hay documento adjunto</small>
                            @endif
                        </td>

                    </tr>
                    
                    @if(sizeof($doc_update)!= 0)
                    
                    <tr style="background-color:#004884">
                        <td colspan="3" style="background-color:#004884; color:white">Documentos Actualizados</td>
                    </tr>
                    
                     <tr>

                     @if($doc_update[0]->adj_logisticaEvento != null || $doc_update[0]->adj_logisticaEvento != '')
                     <td><strong>Logistica del evento actualizado:</strong><br>                   
                        <a href="https://tramitesenlinea.bucaramanga.gov.co/{{$doc_update[0]->adj_logisticaEvento}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                    </td>
                     @endif

                     @if($doc_update[0]->adj_cedulaRes != null || $doc_update[0]->adj_cedulaRes != '')
                     <td><strong>Documento de identificación actualizado:</strong><br>                   
                        <a href="https://tramitesenlinea.bucaramanga.gov.co/{{$doc_update[0]->adj_cedulaRes}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                    </td>
                     @endif


                    </tr>

                    <tr>
                        @if($doc_update[0]->adj_autorizacionTra != null || $doc_update[0]->adj_autorizacionTra != '')
                        <td><strong>Autorización de transito actualizado:</strong><br>                   
                           <a href="https://tramitesenlinea.bucaramanga.gov.co/{{$doc_update[0]->adj_autorizacionTra}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                       </td>
                        @endif
   
                        @if($doc_update[0]->adj_contratoArr != null || $doc_update[0]->adj_contratoArr != '')
                        <td><strong>Contrato de arrendamiento actualizado:</strong><br>                   
                           <a href="https://tramitesenlinea.bucaramanga.gov.co/{{$doc_update[0]->adj_contratoArr}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                       </td>
                        @endif
   
   
                    </tr>
                    <tr>

                        @if($doc_update[0]->adj_conceptoCMGRD != null || $doc_update[0]->adj_conceptoCMGRD != '')
                        <td><strong>Concepto CMGRD actualizado:</strong><br>                   
                           <a href="https://tramitesenlinea.bucaramanga.gov.co/{{$doc_update[0]->adj_conceptoCMGRD}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                       </td>
                        @endif
   
                        @if($doc_update[0]->adj_conceptoTecAmb != null || $doc_update[0]->adj_conceptoTecAmb != '')
                        <td><strong>Concepto técnico ambiental actualizado:</strong><br>                   
                           <a href="https://tramitesenlinea.bucaramanga.gov.co/{{$doc_update[0]->adj_conceptoTecAmb}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                       </td>
                        @endif
   
   
                    </tr>
                    <tr>

                        @if($doc_update[0]->adj_certificadoPONAL != null || $doc_update[0]->adj_certificadoPONAL != '')
                        <td><strong>Certificado MEBUC actualizado:</strong><br>                   
                           <a href="https://tramitesenlinea.bucaramanga.gov.co/{{$doc_update[0]->adj_certificadoPONAL}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                       </td>
                        @endif
   
                        @if($doc_update[0]->adj_certificadoBomberos != null || $doc_update[0]->adj_certificadoBomberos != '')
                        <td><strong>Aprobación Bomberos actualizado:</strong><br>                   
                           <a href="https://tramitesenlinea.bucaramanga.gov.co/{{$doc_update[0]->adj_certificadoBomberos}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                       </td>
                        @endif   
   
                    </tr>
                    <tr>

                        @if($doc_update[0]->adj_hospitalaria != null || $doc_update[0]->adj_hospitalaria != '')
                        <td><strong>Servicio Pre-hospitalario actualizado:</strong><br>                   
                           <a href="https://tramitesenlinea.bucaramanga.gov.co/{{$doc_update[0]->adj_hospitalaria}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                       </td>
                        @endif
   
                        @if($doc_update[0]->adj_poliza != null || $doc_update[0]->adj_poliza != '')
                        <td><strong>Póliza de responsabilidad civil actualizado:</strong><br>                   
                           <a href="https://tramitesenlinea.bucaramanga.gov.co/{{$doc_update[0]->adj_poliza}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                       </td>
                        @endif
   
   
                    </tr>
                    <tr>

                        @if($doc_update[0]->adj_publicidad != null || $doc_update[0]->adj_publicidad != '')
                        <td><strong>Pago de publicidad exterior actualizado:</strong><br>                   
                           <a href="https://tramitesenlinea.bucaramanga.gov.co/{{$doc_update[0]->adj_publicidad}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                       </td>
                        @endif
   
                        @if($doc_update[0]->adj_certificadoEMAB != null || $doc_update[0]->adj_certificadoEMAB != '')
                        <td><strong>Certificado EMAB actualizado:</strong><br>                   
                           <a href="https://tramitesenlinea.bucaramanga.gov.co/{{$doc_update[0]->adj_certificadoEMAB}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                       </td>
                        @endif
   
   
                    </tr>
                    <tr>
                        @if($doc_update[0]->adj_derAutor != null || $doc_update[0]->adj_derAutor != '')
                        <td><strong>Autorización derechos de Autor actualizado:</strong><br>                   
                           <a href="https://tramitesenlinea.bucaramanga.gov.co/{{$doc_update[0]->adj_derAutor}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                       </td>
                        @endif                         
   
   
                    </tr>
                    @endif

                    @if($solicitud->adjunto_respuesta != null)

                    <tr style="background-color:#004884">
                        <td colspan="3" style="background-color:#004884; color:white">Acto administrativo</td>
                    </tr>
                    <tr>                        
                        <td>                           
                            <strong>Acto Administrativo:</strong><br>
                            <a href="https://tramitesenlinea.bucaramanga.gov.co/{{$solicitud->adjunto_respuesta}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>                                                     
                                               
                         
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
                    @if($solicitud->estado_solicitud == 'PENDIENTE' && $solicitud->fecha_pendiente != null)
                    <tr>
                        <td>
                            <strong>Fecha límite de actulización de documentos</strong><br>
                            {{$solicitud->fecha_pendiente}}

                        </td>
                    </tr>
                    @endif
                    
                    {{-- aqui va el form --}}
                    <form class="myFormDefault form-ciudadano" method="POST" action="{{route('interior.eventos.update')}}"  enctype="multipart/form-data" id="myForm_eventos">
                        @csrf
                    <tr>
                        <td>
                            <div class="form-group">
                                <label for="estado">Cambiar Estado de la solicitud*</label>
                                <select class="form-control  @error('estado_solicitud') is-invalid @enderror" name="estado_solicitud" id="estado_solicitud_eventos" required>
                                    <option value="">Seleccione</option>
                                    <option value="PENDIENTE">DOCUMENTOS PENDIENTES</option>                                    
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
                                 <textarea name="observaciones_solicitud" id="observaciones_eventos" onkeypress="return Observaciones(event)"  maxlength="900" class="form-control  @error('observaciones_solicitud') is-invalid @enderror"  cols="2" rows="4" required></textarea>
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
                                <input type="file" accept="application/pdf" name="documento_respuesta" id="documento_respuesta_eventos" class="form-control @error('observaciones_solicitud') is-invalid @enderror" disabled>
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
                                <button type="submit"  onclick="return confirm('¿Esta seguro de generar esta respuesta ?')"  id="myBtn_eventos" class="btn btn-round btn-middle btn-outline-info btn_enviar_solicitud" >Actualizar estado</button>
                                <button style="font-size:15px;" class="btn btn-round btn-middle btn_carga d-none" type="button" disabled><span class="spinner-grow spinner-grow-sm text-primary" role="status" aria-hidden="true"></span> Actualizando estado...</button>                
                                <a href="{{url('/tramites/interior/eventos')}}" class="btn btn-round btn-high">Volver</a>


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