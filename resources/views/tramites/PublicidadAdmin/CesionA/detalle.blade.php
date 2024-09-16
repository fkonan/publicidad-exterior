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
                                <a style="color: #004fbf;" class="breadcrumb-text" href="#">Dadep</a>  
                                                                          
                            </div>
                        </li>
                        <li class="breadcrumb-item ">
                            <div class="image-icon">
                                <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                                <p class="ml-3 ml-md-0 "><b style="color: #004fbf;text-transform: none;">
                                        Áreas de cesión</b>
                                </p>
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
                            Datos de Solicitud
                          </th>
                        </tr>
                      </thead>
                    <tbody>
						<tr>
							<td><strong>Radicado N°-&nbsp;<br></strong>{{$solicitud->Radicado}}</td>
							<td colspan="2"><strong>Tipo de solicitud:</strong><br> Recibo de áreas de cesión públicas obligatorias y cesiones tipo A </td>    
						</tr>
						<tr>
						 <td><strong>Estado de la solicitud:</strong><br>
							 @if($solicitud->SolicitudEstado == 'ENVIADA')
								<p style="color: #069169;font-weight:bold">ENVIADA<span class="govco-icon govco-icon-check-p size-1x"></span></p>
							 @elseif($solicitud->SolicitudEstado == 'PENDIENTE')
								 <p style="color: #3772FF;font-weight:bold">PENDIENTE<span class="govco-icon govco-icon-eye-p size-1x"></span></p>
							 @elseif($solicitud->SolicitudEstado == 'EN PROGRESO')
								 <p style="color: #F3561F;font-weight:bold">EN PROGRESO<span class="govco-icon govco-icon-reload-n size-1x"></span></p>
							 @elseif($solicitud->SolicitudEstado == 'APROBADA')
								 <p style="color: #069169;font-weight:bold">APROBADA<span class="govco-icon govco-icon-like size-1x"></span></p>
							 @elseif($solicitud->SolicitudEstado == 'RECHAZADA')
								 <p style="color: #A80521;font-weight:bold">RECHAZADA<span class="govco-icon govco-icon-x-n size-1x"></span></p>
							@endif                            
                        </td>

						<td><strong>Fecha y hora de la solicitud</strong><br>
                            {{$solicitud->created_at}}
                        </td>
                    </tr>
                    
                    
                    
						<tr style="background-color:#004884">
							<td colspan="3" style="background-color:#004884; color:white">Datos del predio</td>
						</tr>

						<tr>
							
							<td ><strong>Direccion del Predio</strong>
							<br>{{$solicitud->PredioDir}} - {{$solicitud->PredioBarrio}} &nbsp;&nbsp;
						   </td>  
							<td><strong>Area Total</strong><br>
								{{$solicitud->PredioAreaTotal}}
						    </td>
						    <td><strong>Area Cesion</strong><br>
								{{$solicitud->PredioAreaCesion}}
						    </td>
							                  
					   </tr>

					   <tr>
							<td><strong>Matricula inmobiliaria:</strong><br>

								@if($solicitud->PredioMatricula == null || $solicitud->PredioMatricula == '' )
									<small>No hay # de matricula.</small>
								   @else
								   {{$solicitud->PredioMatricula}}
								@endif

								
							</td>
							<td><strong>Escritura pública:</strong><br>
								@if($solicitud->PredioEscritura == null || $solicitud->PredioEscritura == '' )
									<small>No hay # de escritura.</small>
								   @else
								   {{$solicitud->PredioEscritura}}
								@endif
								
							</td>
						   <td><strong>Licencia de urbanización:</strong><br>
								@if($solicitud->PredioLicencia == null || $solicitud->PredioLicencia == '' )
									<small>No hay # de licencia.</small>
								   @else
								   {{$solicitud->PredioLicencia}}
								@endif
								
							</td>
					</tr>
					<tr style="background-color:#004884">
							<td colspan="3" style="background-color:#004884; color:white">Datos del solicitante</td>
					</tr>
    
                    <tr>
						<td><strong>Numero y tipo de Documento:</strong><br>
							{{$personas->PersonaTipDoc}} {{$personas->PersonaDoc}}
						</td>
						<td><strong>Nombre:</strong><br>
							{{$personas->PersonaNombre}} {{$personas->PersonaApe}}
						</td>
			        </tr>
    
                    <tr>
						<td><strong>Telefono:</strong><br>
							{{$personas->PersonaTel}} 
						</td>
						<td><strong>Email:</strong><br>
							{{$personas->PersonaMail}}
						</td>                         
                    </tr>
                   
                    <tr style="background-color:#004884">
                        <td colspan="3" style="background-color:#004884; color:white">Documentos Adjuntos</td>
                    </tr>
			 
                    <tr>									
                       <td colspan="3" >
							<div class="row">
								@foreach ($documentos as $documento)
								<div class="col-xs-12 col-md-6 col-xl-4" >
									<label>{{$documento->DocTitulo}}:</label><br>
									<a href="/{{$documento->DocRuta}}"" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
								</div>	
								@endforeach
							</div>
                       </td>
                    </tr>
			
                
                       
                    <tr style="background-color:#004884">
							<td colspan="3" style="background-color:#004884; color:white">Novedades</td>
					</tr>
                    <tr>
						 <th>Tipo de Novedad</th>
						 <th>Observaciones</th>
						 <th>Estado</th>
					</tr>
					@foreach ($novedades as $novedad)
					<tr>
						 <td>{{$novedad->NovedadTipo}}</td>
						 <td>{{$novedad->NovedadComentario}}</td>
						 <td>{{$novedad->NovedadEstado}}</td>
					</tr>
					@endforeach
					<tr>
						  
                        <td>
                            @if($solicitud->documento_respuesta != null)
                            <strong>Documento de respuesta:</strong><br>
                            <a href="https://tramitesenlinea.bucaramanga.gov.co/{{$solicitud->documento_respuesta}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>                                                         
                            @else                                
                            @endif
                        
                        </td>
                    </tr>
                    @if($solicitud->estado_solicitud == 'PENDIENTE' && $solicitud->fecha_pendiente != null) 
                    <tr>
                        <td>
                            <strong>Fecha limite para cargar documentos:</strong><br>
                            {{$solicitud->fecha_pendiente}}

                        </td>
                    </tr>
                    @endif
                    
                    @if($solicitud->SolicitudEstado!="RECHAZADA" && $solicitud->SolicitudEstado!="APROBADA")
                    
                    {{-- aqui va el form --}}
                    <form method="POST"  class="form-ciudadano" action="{{route('Cesion.finalizar')}}"  enctype="multipart/form-data" id="myForm1">
					<input type= "hidden" name="SolicitudId" id= "SolicitudId" value= "{{$solicitud->SolicitudId}}">
                        @csrf
                    <tr>
						<td>
                            <div class="form-group">
                                <label for="estado">Tipo de novedad*</label>
                                <select class="form-control  @error('estado_solicitud') is-invalid @enderror" name="tiponovedad" id="tiponovedad" required onchange="javascript:cambiarEstado(this.value);">
                                    <option value="">Seleccione</option>
                                    <option value="1">Revision de documentos</option>
                                    <option value="2">Progamación de visita</option>
                                    <option value="3">Registro de visita</option>
                                    <option value="4">Registro de oficio</option>
                                </select>
                                @error('estado_solicitud')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                            <div class="form-group">
                                <label for="estado">Estado de la novedad*</label>
                                 <select class="form-control  @error('estado_solicitud') is-invalid @enderror estado" name="Novedad[0]" id="estado0" >
                                    <option value="">Seleccione</option>
                                </select>
                                <select class="form-control  @error('estado_solicitud') is-invalid @enderror estado d-none" name="Novedad[1]" id="estado1" >
                                   
                                    <option value="COMPLETO">COMPLETO</option>
                                    <option value="INCOMPLETO">INCOMPLETO</option>
                                    <option value="RECHAZADO">RECHAZADO</option>
                                 </select>
                                 <select class="form-control  @error('estado_solicitud') is-invalid @enderror estado d-none" name="Novedad[2]" id="estado2" >
                                    
                                    <option value="PROGRAMADO">PROGRAMADO</option>
                                 </select>
                                 <select class="form-control  @error('estado_solicitud') is-invalid @enderror estado d-none" name="Novedad[3]" id="estado3" >
                                   
                                    <option value="FAVORABLE">FAVORABLE</option>
                                    <option value="NO FAVORABLE">NO FAVORABLE</option>
                                 </select>
                                 <select class="form-control  @error('estado_solicitud') is-invalid @enderror estado d-none" name="Novedad[4]" id="estado4" >
                                    
                                    <option value="APROBADO">APROBADO</option>
                                    <option value="RECHAZADO">RECHAZADO</option>                                   
                                 </select>
                                 <script language="javascript">
									function cambiarEstado(num){
										$('.estado').addClass('d-none');
										var nombre = "#estado" + num;
										$(nombre).removeClass('d-none');
									}
                          
                                 </script>
                                 
                                @error('estado_solicitud')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
								@enderror
                            </div>
                        </td>
                         <td colspan="2" >
                            <div class="form-group">
                             <label for="observaciones">Observaciones*</label>
                                 <textarea name="NovedadComentario" id="NovedadComentario" onkeypress="return Observaciones(event)"  maxlength="500" class="form-control  @error('observaciones_solicitud') is-invalid @enderror" id="observaciones" cols="2" rows="4" required></textarea>
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
                                <input type="file" accept="application/pdf" name="documento0" id="documento_respuesta" class="form-control @error('observaciones_solicitud') is-invalid @enderror">
                                @error('documento_respuesta')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>

                        </td>
                        <td colspan="2">
                            <div class="form-group">
                                <input type="hidden" name="username" value="">

                                <button type="submit" id="myBtnEspacio" class="btn btn-round btn-middle btn-outline-info" id="Boton">Actualizar estado</button>
                                <button style="font-size:15px;" class="btn btn-round btn-middle btn_carga d-none" type="button" disabled><span class="spinner-grow spinner-grow-sm text-primary" role="status" aria-hidden="true"></span> Actualizando estado...</button>
                                <a href="{{url('/tramites/DadepAdmin/Cesion/A')}}" class="btn btn-round btn-high">Volver</a>


                            </div>
                        </td>
                    </tr>
                    </form>
                    {{-- fin del form --}}
                    @endif
                    </tbody>
                    </table>
                   </div>
              
            </div>
        </div>
    </div>


@endsection
