@extends('layouts.menu')

@section('dashboard')

    <div class="container mt-3 mb-4 m-xs-x-3">

        <div class="row pl-4">
            <div class="px-0 col-md-11">
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
                                        Intervención del Espacio Publico para Localización de Equipamiento
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
                    <td colspan="2"><strong>Tipo de solicitud:</strong><br>
                        {{$solicitud->modalidad}}
                    </td>                 
                     
                   
                    </tr>
                    <tr>
                    <td><strong>Modalidades de construcción</strong><br>
                        {{$solicitud->construccion}}
                   </td>
                    <td colspan="2"><strong>Direccion del Predio</strong>
                    <br>{{$solicitud->direccion_predio}} - {{$solicitud->barrio}} &nbsp;&nbsp;
                    <small><b>Vereda</b> : {{$solicitud->vereda}}</small>
                   </td>                    
                    </tr>

                    <tr>
                    <td><strong>Matricula:</strong><br>

                        @if($solicitud->matricula == null || $solicitud->matricula == '' )
                            <small>No hay # de matricula.</small>
                           @else
                           {{$solicitud->matricula}}
                        @endif

                        
                    </td>
                    <td><strong>Identificación Catrastal:</strong><br>
                        @if($solicitud->identificacion_catastral == null || $solicitud->identificacion_catastral == '' )
                            <small>No hay # de matricula.</small>
                           @else
                           {{$solicitud->identificacion_catastral}}
                        @endif
                        
                    </td>
                    <td><strong>Nombres del Titular:</strong><br>
                        {{$solicitud->nom_titular}} {{$solicitud->ape_titular}}
                     </td>
                    </tr>
    
                     <tr>
                    <td><strong>Identificacion del titular</strong><br>
                        {{$solicitud->identificacion_titular}}
                    </td>
                    <td><strong>Telefono del titular:</strong><br>
                        {{$solicitud->tel_titular}}
                    </td>
                    <td><strong>Email Titular</strong><br>
                        {{$solicitud->email_titular}}
                    </td>
                    </tr>
    
                     <tr>
                    <td><strong>Profesional Encargado:</strong><br>
                        {{$solicitud->nom_profesional}} {{$solicitud->ape_profesional}}
                    </td>
                    <td><strong>N° Identificación Profesional:</strong><br>
                        {{$solicitud->ide_profesional}}
                    </td>                
                     <td><strong>Matricula Profesional:</strong><br>
                        {{$solicitud->matricula_profesional}}
                  
                    </td>               
                    </tr>
                    <tr>
                    <td ><strong>Fecha de expedicion de matricula: </strong><br>
                        {{$solicitud->fecha_matricula}}
                    </td>
                    <td colspan="2" ><strong>Nombre del Responsable de la Solicitud: </strong><br>
                        {{$solicitud->nom_responsable}} {{$solicitud->ape_responsable}}
                    </td>
                    </tr>

                    <tr>
                        <td ><strong>Identificación del Responsable: </strong><br>
                            {{$solicitud->ide_responsable}}
                        </td>

                        <td ><strong>Telefono del responsable: </strong><br>
                            {{$solicitud->tel_responsable}}
                        </td>

                        <td ><strong>Email del responsable: </strong><br>
                            {{$solicitud->email_responsable}}
                        </td>

                    </tr>

                    <tr style="background-color:#004884">
                        <td colspan="3" style="background-color:#004884; color:white">Documentos Adjuntos</td>
                    </tr>

                    <tr>
                        <td><strong>Documento de Identidad Solicitante:</strong><br>
                            <a href="https://ocupacionespaciopublico.bucaramanga.gov.co/{{$solicitud->archivo_documento}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                        </td>
                        <td><strong>Poder especial:</strong><br>
                            <a href="https://ocupacionespaciopublico.bucaramanga.gov.co/{{$solicitud->archivo_poder}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                        </td>
                        <td><strong>Descripción del proyecto:</strong><br>
                            <a href="https://ocupacionespaciopublico.bucaramanga.gov.co/{{$solicitud->archivo_descripcion}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"><strong>Planos del proyecto:</strong><br>
                            <a href="https://ocupacionespaciopublico.bucaramanga.gov.co/{{$solicitud->archivo_planos}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
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
                                         @elseif($solicitud->estado_solicitud == 'VISITA-TECNICA')
                                         <p style="color: #F3561F;font-weight:bold">VISITA TECNICA<span class="govco-icon govco-icon-reload-n size-1x"></span></p>
                                         @elseif($solicitud->estado_solicitud == 'EN ESTUDIO')
                                         <p style="color: #FFAB00;font-weight:bold">EN ESTUDIO<span class="govco-icon govco-icon-edit-p  size-1x"></span></p>
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
                            @if($solicitud->documento_respuesta != null)
                            <strong>Documento de respuesta:</strong><br>
                            <a href="https://tramitesenlinea.bucaramanga.gov.co/{{$solicitud->documento_respuesta}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>                                                         
                            @else                                
                            @endif
                        


                           
                        </td>
                    </tr>
                    @if($solicitud->documento_visita != null)
                    <tr>
                        <td colspan="3"><strong>Concepto Visita:</strong><br>
                            <a href="/{{$solicitud->documento_visita}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                        </td>


                    </tr>

                    @endif
                    @if($solicitud->estado_solicitud == 'PENDIENTE' && $solicitud->fecha_pendiente != null) 
                    <tr>
                        <td colspan="3">
                            <strong>Fecha limite para cargar documentos:</strong><br>
                            {{$solicitud->fecha_pendiente}}

                        </td>
                    </tr>
                    @endif
                    
                    {{-- aqui va el form --}}
                    <form method="POST"  class="form-ciudadano" action="{{route('espacio.update')}}"  enctype="multipart/form-data" id="myForm1">
                        @csrf
                    <tr>
                        <td colspan="1">
                            <div class="form-group">
                                <label for="estado">Cambiar Estado de la solicitud*</label>
                                <select class="form-control  @error('estado_solicitud') is-invalid @enderror estado" name="estado_solicitud" id="estado" required>
                                    <option value="">Seleccione</option>
                                    <option value="PENDIENTE">PENDIENTE</option>
                                    <option value="VISITA-TECNICA">VISITA TECNICA</option>
                                    <option value="EN ESTUDIO">EN ESTUDIO</option>
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
                                 <textarea name="observaciones_solicitud" id="observaciones_espacio" onkeypress="return Observaciones(event)"  maxlength="4800" class="form-control  @error('observaciones_solicitud') is-invalid @enderror" id="observaciones" cols="3" rows="6" required></textarea>
                                 @error('observaciones_solicitud')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror

                            
                            </div>
                        </td>
                    </tr>
                    <tr id="caja_visita" class="d-none">
                        <td colspan="1">
                            <div class="form-group">
                                <label for="documento_visita">Cargar Concepto de Visita Tecnica &nbsp;<br> (es opcional)</label>
                                <input type="file" accept="application/pdf" name="documento_visita" id="documento_visita" class="form-control @error('observaciones_solicitud') is-invalid @enderror">
                                @error('documento_visita')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>

                        </td>
                        <td colspan="2"></td>

                    </tr>

                    <tr>
                        <td colspan="2">
                            <div class="form-group">
                                <label for="documento_respuesta">Cargar Respuesta</label>
                                <input type="file" accept="application/pdf" name="documento_respuesta" id="documento_respuesta" class="form-control @error('observaciones_solicitud') is-invalid @enderror" disabled>
                                @error('documento_respuesta')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>

                        </td>
                        <td colspan="1">
                            <div class="form-group">
                                <input type="hidden" id="estado_sol_espacio" value="{{$solicitud->estado_solicitud}}">
                                <input type="hidden" name="username" value="{{auth()->user()->username}}">
                                <input type="hidden" name="id" value="{{$solicitud->id}}">
                                <button type="submit"  onclick="return confirm('¿Esta seguro de generar esta respuesta ?')"  id="myBtnEspacio" class="btn btn-round btn-middle btn-outline-info btn_enviar_solicitud"  id="Boton">Actualizar estado</button>
                                <button style="font-size:15px;" class="btn btn-round btn-middle btn_carga d-none" type="button" disabled><span class="spinner-grow spinner-grow-sm text-primary" role="status" aria-hidden="true"></span> Actualizando estado...</button>
                                <a href="{{url('/tramites/planeacion/espacio')}}" class="btn btn-round btn-high">Volver</a>


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