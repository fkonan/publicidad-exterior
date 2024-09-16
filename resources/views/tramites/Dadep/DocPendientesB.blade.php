@extends('layouts.app')
@section('title', 'Areas de cesion')
@section('content')

<style>
	.clockpicker-button {
		background-color: #3366CC !important;
		color: white !important;
	}

</style>

<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container mt-3 mb-4 m-xs-x-3" id="body_eventos">
	@include('tramites.titulo')	

	<div class="container-fluid">
		<div class="row mt-2">
			<div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
				@include('tramites.Dadep.Introduccion')
			   
				<form action="{{route('Dadep.Guardar')}}" method="POST" id="myForm" enctype="multipart/form-data"  class="form-ciudadano">
					<input type= "hidden" name="PersonaId" value= "{{$Datos->PersonaId}}">
					<input type= "hidden" name="Radicado" value= "{{$Solicitud->Radicado}}">
					@csrf
					
					<!-- datos Generales-->
					
	<h3 class="headline-l-govco mt-3 pl-0">Proceso de entrega de área de cesión.</h3>
    
      <h4>Solicitante:</h4>  
       <!-- Tabla Solicitante-->             
    <table>
		<tr>
		  <td>Nombre o Razón social:</td>
		  <td>{{$Datos->PersonaNombre}} {{$Datos->PersonaApe}}</td>
		</tr>

		<tr>
		  <td>Tipo y número de documento:</td>
		  <td>{{$Datos->PersonaTipDoc}} {{$Datos->PersonaDoc}}</td>
		</tr>
        
		 <tr>
		  <td>Correo electronico:</td>
		  <td>{{$Datos->PersonaMail}}</td>
		</tr>
  </table>
  
    <h4>Predio:</h4>    
    <!-- Tabla Predio-->              
    <table>
		<tr>
		  <td>Dirección:</td>
		  <td>{{$Solicitud->PredioDir}}</td>
		</tr>

		<tr>
		  <td>Area total:</td>
		  <td>{{$Solicitud->PredioAreaTotal}}</td>
		</tr>
		
		 <tr>
		  <td>Area de cesión:</td>
		  <td>{{$Solicitud->PredioAreaCesion}}</td>
		</tr>
	</table>
   
     <h4>Solicitud:</h4>  
       <!-- Tabla Solicitud-->             
    <table>
    <tr>
	  <td>Numero de radicado:</td>
      <td>{{$Solicitud->Radicado}}</td>
    </tr>

    <tr>
      <td>Estado de la solicitud:</td>
      <td>{{$Solicitud->SolicitudEstado}}</td>
    </tr>
  </table> 
					
				<div class="row form-group mt-2">
						<!--Adjuntos-->
						
						<div class="col-md-12 pl-1 pr-1 pt-3">
							<h3 class="headline-l-govco mt-3 pl-0">Adjunte solo los documentos solicitados</h3>
						</div>
						<div class="col-md-6 pl-1 pr-1 pt-3">
							<label for="documento0" class="form-label">Documento de identificación</label> &nbsp;
							<small style="font-size: 11px!important; text-align:justify!important;"><em
									style="font-size: 11px!important; text-align:justify!important;">Adjuntar cédula de
									ciudadanía (persona natural sea el responsable) o certificado existencia
									y representación legal no mayor a un mes(responsable sea una persona jurídica)</em>
							</small></label>
							<div class="form-group">
								<div class="file-loading">
									<input class=" @error('documento0') is-invalid @enderror documentos_adjuntos"
										id="documento0" accept="application/pdf" name="documento0" type="file"
										data-overwrite-initial="true" >
									@error('documento0')
										<span class="invalid-feedback" role="alert">
											<strong class="text-danger">{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
						</div>
						
						<div class="col-md-6 pl-1 pr-1 pt-3">
							<label for="documento1" class="form-label">Solicitud de inicio del procedimiento escrituración<small
									style="font-size: 11px!important;text-align:justify!important;"><em
										style="font-size: 11px!important">Adjuntar solicitud de inicio del procedimiento de escrituración.</em> <br> </small></label><br>
							<div class="form-group">
								<div class="file-loading">
									<input	class=" @error('documento1') is-invalid @enderror documentos_adjuntos"
										id="documento1" accept="application/pdf" name="documento1"
										type="file" data-overwrite-initial="true">
									@error('documento1')
										<span class="invalid-feedback" role="alert">
											<strong class="text-danger">{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
						</div>
						
						<div class="col-md-6 pl-1 pr-1 pt-3">
							<label for="documento2" class="form-label">Acto administrativo de legalización y documentos técnicos <small
									style="font-size: 11px!important;text-align:justify!important;"><em
										style="font-size: 11px!important">Adjuntar acto administrativa de legalización y documentos técnicos emitido por planeación.</em> <br> </small></label><br>
							<div class="form-group">
								<div class="file-loading">
									<input	class=" @error('documento2') is-invalid @enderror documentos_adjuntos"
										id="documento2" accept="application/pdf" name="documento2"
										type="file" data-overwrite-initial="true">
									@error('documento2')
										<span class="invalid-feedback" role="alert">
											<strong class="text-danger">{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
						</div>

						<div class="col-md-6 pl-1 pr-1 pt-3">
							<label for="documento3" class="form-label">Minuta o escritura pública<small
									style="font-size: 11px!important;text-align:justify!important;"><em
										style="font-size: 11px!important"> Adjuntar Minuta en la cual se encuentren identificadas y determinadas las áreas de cesión gratuita del municipio de Bucaramanga  .</em> <br> </small></label><br>
							<div class="form-group">
								<div class="file-loading">
									<input	class=" @error('documento3') is-invalid @enderror documentos_adjuntos"
										id="documento3" accept="application/pdf" name="documento3"
										type="file" data-overwrite-initial="true">
									@error('documento3')
										<span class="invalid-feedback" role="alert">
											<strong class="text-danger">{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
						</div>

						<div class="col-md-6 pl-1 pr-1 pt-3">
							<label for="documento4" class="form-label">Matricula inmobiliaria</label>
							<small style="font-size: 11px!important; text-align:justify!important;"><em
									style="font-size: 11px!important; text-align:justify!important;">Adjuntar certificado de libertad y tradición del predio en mayor extensión, 
									donde consten las adquisiciones del predio, cuya fecha sea vigencia del presente año.</em>
							</small></label>
							<div class="form-group">
								<div class="file-loading">
									<input class=" @error('documento4') is-invalid @enderror documentos_adjuntos"
										id="documento4" accept="application/pdf" name="documento4" type="file"
										data-overwrite-initial="true">
									@error('documento4')
										<span class="invalid-feedback" role="alert">
											<strong class="text-danger">{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
						</div>

						<div class="col-md-6 pl-1 pr-1 pt-3">
							<label for="documento5" class="form-label">Estudio de titulos</label>
							<small style="font-size: 11px!important; text-align:justify!important;"><em
									style="font-size: 11px!important; text-align:justify!important;">Adjuntar estudio de titulos que acredite la propiedad del solicitante,
									y la de todos los actos jurídicos que conforman la tradición de los inmuebles en los últimos diez(10) años.</em>
							</small></label>
							<div class="form-group">
								<div class="file-loading">
									<input class=" @error('documento5') is-invalid @enderror documentos_adjuntos"
										id="documento5" accept="application/pdf" name="documento5" type="file"
										data-overwrite-initial="true" >
									@error('documento5')
										<span class="invalid-feedback" role="alert">
											<strong class="text-danger">{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
						</div>
						
						<div class="col-md-6 pl-1 pr-1 pt-3">
							<label for="documento6" class="form-label">Poder</label>
							<small style="font-size: 11px!important; text-align:justify!important;"><em
									style="font-size: 11px!important; text-align:justify!important;">Adjuntar poder otorgado por el titular.</em><br><br><br><br>
							</small></label>
							<div class="form-group">
								<div class="file-loading">
									<input class=" @error('documento6') is-invalid @enderror documentos_adjuntos"
										id="documento6" accept="application/pdf" name="documento6" type="file"
										data-overwrite-initial="true" >
									@error('documento6')
										<span class="invalid-feedback" role="alert">
											<strong class="text-danger">{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
						</div>
							
						<div class="col-md-6 pl-1 pr-1 pt-3">
							<label for="documento7" class="form-label">Planos</label>
							<small style="font-size: 11px!important; text-align:justify!important;"><em
									style="font-size: 11px!important; text-align:justify!important;">Adjuntar planos.</em><br><br><br><br>
							</small></label>
							<div class="form-group">
								<div class="file-loading">
									<input class=" @error('documento7') is-invalid @enderror documentos_adjuntos"
										id="documento7" accept="application/pdf" name="documento7" type="file"
										data-overwrite-initial="true">
									@error('documento7')
										<span class="invalid-feedback" role="alert">
											<strong class="text-danger">{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
						</div>

						<div class="col-md-12 pl-1 pt-3">
							<h4 class="headline-m-govco">Aviso de privacidad y autorización tratamiento de datos personales</h4>

							<a class="btn btn-low px-0"
								href="https://www.bucaramanga.gov.co/Inicio/autorizacion-de-tratamiento-de-datos-personales/"
								target="_blank">Autorizo el tratamiento de datos personales</a>
							<label class="checkbox-govco d-inline">
								<input type="checkbox" id="AT00" name="tratamiento_datos" checked value="SI" />
								<label for="AT00"> </label>
							</label><br>

							<a class="btn btn-low px-0"
								href="https://www.bucaramanga.gov.co/Inicio/autorizacion-de-tratamiento-de-datos-personales/"
								target="_blank">Acepto términos y condiciones</a>
							<label class="checkbox-govco d-inline">
								<input type="checkbox" id="AT01" name="acepto_terminos" checked value="SI" />
								<label for="AT01"> </label>
							</label>
							<p class="text-justify">Confirmo que soy mayor de edad y con plena capacidad para
								diligenciar el presente formulario.
								Así mismo declaro que la información aquí suministrada corresponde a la verdad.
								Declaro que he leído, entiendo y acepto las políticas de tratamiento de los datos que
								suministro, de conformidad con la Ley 1581 de 2012 y demás normas concordantes
								<label class="checkbox-govco d-inline">
									<input type="checkbox" id="AT02" name="confirmo_mayorEdad" checked value="SI" />
									<label for="AT02"> </label>
								</label>
							</p>
						</div>
						<div class="col-md-11 pl-1 pr-1 pt-3">
							<p>Acepto que la información aquí registrada sea compartida con otras entidades y/o
								terceros vinculados a la Alcaldía de Bucaramanga</p>
							@error('compartir_informacion')
								<span class="invalid-feedback" role="alert">
									<strong class="text-danger">{{ $message }}</strong>
								</span>
							@enderror
							<div class="form-check-inline">
								<label class="radiolist-govco radiobutton-govco">
									<input type="radio" name="compartir_informacion" id="rb_si" value="SI" required checked/>
									<label for="rb_si">SI</label>
								</label>
							</div>
							<div class="form-check-inline">
								<label class="radiolist-govco radiobutton-govco">
									<input type="radio" name="compartir_informacion" id="rb_no" value="NO" />
									<label for="rb_no">NO</label>
								</label>
							</div>
						</div>

						<div class="col-md-12  pl-1 pr-1 pt-3 text-left mt-4" style="padding-left: 0px!important">

					  <!--  <div class="g-recaptcha" data-sitekey="6LcoZ0IcAAAAAJO2XZZyhHvhacYdwmr4xKZ5DjgN"></div>-->
							
							<button style="font-size:15px;" type="submit" class="btn btn-round btn-middle btn_enviar_solicitud">Enviar Solicitud</button>
							
							<button style="font-size:15px;" class="btn btn-round btn-middle btn_carga d-none" type="button" disabled><span class="spinner-grow spinner-grow-sm text-primary" role="status" aria-hidden="true"></span> Enviando...</button>
						</div>
					</div>
				</form>
            </div>
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				@include('tramites.Dadep.informativo')
			</div>
		</div>
	</div>
</div>  
@endsection
