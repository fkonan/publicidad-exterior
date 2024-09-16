@extends('layouts.app')
@section('title', 'Incorporación y entrega de las áreas de cesión a favor del municipio')
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
			   
				<form action="{{route('Dadep.finalizarB')}}" method="POST" id="myForm" enctype="multipart/form-data"  class="form-ciudadano">
					<input type= "hidden" name="PersonaId" value= "{{$Datos->PersonaId}}">
					@csrf
					
					<!-- datos Generales-->
					@include('tramites.ciudadano')
					
					  
						  <!--Datos del predio-->   
					<div class="row form-group mt-2">  
						<div class="col-md-12 pl-1 pr-1 pt-3">
							<h3 class="headline-l-govco mt-3 pl-0">3. Datos del predio</h3>
						</div>
					  
						
						<div class="col-md-12 pl-1 pt-3">
							<label for="dir_responsable_sol" class="form-label">Dirección o Nomenclatura del Responsable*</label>
							<button type="button" class="btn btn-link" onclick='javascript:campo="#dir_responsable";'><span
									style="text-transform: lowercase; font-size: 12px;" class="text-primary"
									data-toggle="modal" data-target="#ModalDireccionesEventos">(Clic para insertar
									direccion)</span></button>
							<input type="text" value=""
								class="form-control  @error('dir_responsable_sol') is-invalid @enderror"
								name="dir_responsable" id="dir_responsable" maxlength="120" required readonly>
							@error('dir_responsable_sol')
								<span class="invalid-feedback" role="alert">
									<strong class="text-danger">{{ $message }}</strong>
								</span>
							@enderror
						</div>
						
						<div class="col-md-6 pl-1 pr-1 pt-3">
							<label for="barrio_responsable" class="form-label">Barrio* </label>
							<select name="barrio_responsable" id="barrio_responsable"
								class="form-control @error('barrio_responsable') is-invalid @enderror barrios" >
								<option value=""></option>
								@foreach ($Barrios as $barrio)
								<option {{ old('barrio_responsable_pre') == $barrio->nombre ? "selected" : "" }}  value="{{ $barrio->nombre }}">{{ $barrio->nombre }}</option>
								@endforeach
							</select>
							@error('barrio_responsable')
								<span class="invalid-feedback" role="alert">
									<strong class="text-danger">{{ $message }}</strong>
								</span>
							@enderror
						</div>
						
						
						 <div class="col-md-6 pl-1 pr-1 pt-3">
							<label for="PredioMatricula" class="form-label">Folio matricula inmobiliaria* </label>
							<input value="{{ old('PredioMatricula') }}" type="text"
								class="form-control  @error('PredioMatricula') is-invalid @enderror PredioMatricula"
								name="PredioMatricula" id="PredioMatricula" maxlength="10" minlength="7" required
								onkeypress="">
							@error('PredioMatricula')
								<span class="invalid-feedback" role="alert">
									<strong class="text-danger">{{ $message }}</strong>
								</span>
							@enderror
						</div>
						
						 <div class="col-md-6 pl-1 pr-1 pt-3">
							<label for="PredioCatastral" class="form-label">Número predial o identificación catastral* </label>
							<input value="{{ old('PredioCatastral') }}" type="text"
								class="form-control  @error('PredioCatastral') is-invalid @enderror PredioCatastral"
								name="PredioCatastral" id="PredioCatastral" maxlength="10" minlength="7" required
								onkeypress="">
							@error('PredioCatastral')
								<span class="invalid-feedback" role="alert">
									<strong class="text-danger">{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>
					 
						<!--Adjuntos-->
					<div class="row form-group mt-2">  
						<div class="col-md-12 pl-1 pr-1 pt-3">
							<h3 class="headline-l-govco mt-3 pl-0">4. Documentos Adjuntos de la Solicitud</h3>
						</div>


						<div class="col-md-6 pl-1 pr-1 pt-3">
							<label for="documento0" class="form-label">Documento de identificación* &nbsp;
							<small style="font-size: 11px!important; text-align:justify!important;"><em
									style="font-size: 11px!important; text-align:justify!important;">Adjuntar cédula de
									ciudadanía (persona natural sea el responsable) o certificado existencia
									y representación legal no mayor a un mes(responsable sea una persona jurídica)</em>
							</small></label>
							<div class="form-group">
								<div class="file-loading">
									<input class=" @error('documento0') is-invalid @enderror documentos_adjuntos"
										id="documento0" accept="application/pdf" name="documento0" type="file"
										data-overwrite-initial="true" required >
									@error('documento0')
										<span class="invalid-feedback" role="alert">
											<strong class="text-danger">{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
						</div>
						
						<div class="col-md-6 pl-1 pr-1 pt-3">
							<label for="documento1" class="form-label">Solicitud de inicio del procedimiento escrituración*
							 <small style="font-size: 11px!important;text-align:justify!important;">
								 <em style="font-size: 11px!important">Adjuntar solicitud de inicio del procedimiento de escrituración.
								 </em><br><br> 
							</small>
							</label>
							<div class="form-group">
								<div class="file-loading">
									<input	class=" @error('documento1') is-invalid @enderror documentos_adjuntos"
										id="documento1" accept="application/pdf" name="documento1"
										type="file" data-overwrite-initial="true" required>
									@error('documento1')
										<span class="invalid-feedback" role="alert">
											<strong class="text-danger">{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
						</div>
						
						<div class="col-md-6 pl-1 pr-1 pt-3">
							<label for="documento2" class="form-label">Acto administrativo de legalización y documentos técnicos* <small
									style="font-size: 11px!important;text-align:justify!important;"><em
										style="font-size: 11px!important">Adjuntar acto administrativa de legalización y documentos técnicos emitido por planeación.</em> <br> </small></label><br>
							<div class="form-group">
								<div class="file-loading">
									<input	class=" @error('documento2') is-invalid @enderror documentos_adjuntos"
										id="documento2" accept="application/pdf" name="documento2"
										type="file" data-overwrite-initial="true" required>
									@error('documento2')
										<span class="invalid-feedback" role="alert">
											<strong class="text-danger">{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
						</div>

						<div class="col-md-6 pl-1 pr-1 pt-3">
							<label for="documento3" class="form-label">Minuta o escritura pública*
							 <small style="font-size: 11px!important;text-align:justify!important;"><em
										style="font-size: 11px!important"> Adjuntar Minuta en la cual se encuentren identificadas y determinadas las áreas de cesión gratuita del municipio de Bucaramanga  .</em> <br> </small></label><br>
							<div class="form-group">
								<div class="file-loading">
									<input	class=" @error('documento3') is-invalid @enderror documentos_adjuntos"
										id="documento3" accept="application/pdf" name="documento3"
										type="file" data-overwrite-initial="true" required>
									@error('documento3')
										<span class="invalid-feedback" role="alert">
											<strong class="text-danger">{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
						</div>

						<div class="col-md-6 pl-1 pr-1 pt-3">
							<label for="documento4" class="form-label">Matricula inmobiliaria*
							<small style="font-size: 11px!important; text-align:justify!important;"><em
									style="font-size: 11px!important; text-align:justify!important;">Adjuntar certificado de libertad y tradición del predio en mayor extensión, 
									donde consten las adquisiciones del predio, cuya fecha sea vigencia del presente año.</em>
							</small></label>
							<div class="form-group">
								<div class="file-loading">
									<input class=" @error('documento4') is-invalid @enderror documentos_adjuntos"
										id="documento4" accept="application/pdf" name="documento4" type="file"
										data-overwrite-initial="true" required>
									@error('documento4')
										<span class="invalid-feedback" role="alert">
											<strong class="text-danger">{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
						</div>

						<div class="col-md-6 pl-1 pr-1 pt-3">
							<label for="documento5" class="form-label">Estudio de titulos*
							<small style="font-size: 11px!important; text-align:justify!important;"><em
									style="font-size: 11px!important; text-align:justify!important;">Adjuntar estudio de titulos que acredite la propiedad del solicitante,
									y la de todos los actos jurídicos que conforman la tradición de los inmuebles en los últimos diez(10)años.</em>
							</small></label>
							<div class="form-group">
								<div class="file-loading">
									<input class=" @error('documento5') is-invalid @enderror documentos_adjuntos"
										id="documento5" accept="application/pdf" name="documento5" type="file"
										data-overwrite-initial="true" required >
									@error('documento5')
										<span class="invalid-feedback" role="alert">
											<strong class="text-danger">{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
						</div>
						
						<div class="col-md-6 pl-1 pr-1 pt-3">
							<label for="documento6" class="form-label">Poder*
							<small style="font-size: 11px!important; text-align:justify!important;"><em
									style="font-size: 11px!important; text-align:justify!important;">Adjuntar poder otorgado por el titular.</em><br><br><br><br>
							</small></label>
							<div class="form-group">
								<div class="file-loading">
									<input class=" @error('documento6') is-invalid @enderror documentos_adjuntos"
										id="documento6" accept="application/pdf" name="documento6" type="file"
										data-overwrite-initial="true" required>
									@error('documento6')
										<span class="invalid-feedback" role="alert">
											<strong class="text-danger">{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
						</div>
							
						<div class="col-md-6 pl-1 pr-1 pt-3">
							<label for="documento7" class="form-label">Planos*
							<small style="font-size: 11px!important; text-align:justify!important;"><em
									style="font-size: 11px!important; text-align:justify!important;">Adjuntar planos.</em><br><br><br><br>
							</small></label>
							<div class="form-group">
								<div class="file-loading">
									<input class=" @error('documento7') is-invalid @enderror documentos_adjuntos"
										id="documento7" accept="application/pdf" name="documento7" type="file"
										data-overwrite-initial="true" required>
									@error('documento7')
										<span class="invalid-feedback" role="alert">
											<strong class="text-danger">{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
						</div>
					</div>

					  @include('tramites.habeasData')
					  <div class="col-md-12  pl-1 pr-1 pt-3 text-left mt-4" style="padding-left: 0px!important">
							
							<button style="font-size:15px;" type="submit" class="btn btn-round btn-middle btn_enviar_solicitud">Enviar Solicitud</button>
							
							<button style="font-size:15px;" class="btn btn-round btn-middle btn_carga d-none" type="button" disabled><span class="spinner-grow spinner-grow-sm text-primary" role="status" aria-hidden="true"></span> Enviando...</button>
						</div>
					</div>
				</form>

			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				@include('tramites.Dadep.informativo')
			</div>
		</div>
	</div>
</div> 
@include('tramites.Dadep.form_consulta')
@include('tramites.direccion')

       
@endsection
