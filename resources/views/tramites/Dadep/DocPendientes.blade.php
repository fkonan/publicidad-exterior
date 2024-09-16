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
							</small>
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
							<label for="documento1" class="form-label">Escritura Pública<small
									style="font-size: 11px!important;text-align:justify!important;"><em
										style="font-size: 11px!important"> Adjuntar Minuta o escritura pública en la cual se encuentren identificadas y determinadas las áreas de cesión gratuita del municipio de Bucaramanga  .</em> <br> </small></label><br>
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
							<label for="documento2" class="form-label">Licencia de urbanización<small
									style="font-size: 11!important;" aling="justify"><em
										style="font-size: 11px!important" aling="justify">: Adjuntar licencia de urbanización en sus diferentes modalidades, 
										licencia de parcelación o el acto administrativo que hubiese establecido las areas objeto de la entrega.</em></small> </label>
							<div class="form-group">
								<div class="file-loading">
									<input class=" @error('documento2') is-invalid @enderror documentos_adjuntos"
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
							<label for="documento3" class="form-label">Matricula inmobiliaria</label>
							<small style="font-size: 11px!important; text-align:justify!important;"><em
									style="font-size: 11px!important; text-align:justify!important;">Adjuntar certificado de libertad y tradición del predio en mayor extensión, 
									donde consten las adquisiciones del predio, cuya fecha de expedición no sea mayor a un mes.</em>
							</small>
							<div class="form-group">
								<div class="file-loading">
									<input class=" @error('documento3') is-invalid @enderror documentos_adjuntos"
										id="documento3" accept="application/pdf" name="documento3" type="file"
										data-overwrite-initial="true">
									@error('documento3')
										<span class="invalid-feedback" role="alert">
											<strong class="text-danger">{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
						</div>

						<div class="col-md-6 pl-1 pr-1 pt-3">
							<label for="documento4" class="form-label">Estudio de titulos</label>
							<small style="font-size: 11px!important; text-align:justify!important;"><em
									style="font-size: 11px!important; text-align:justify!important;">Adjuntar estudio de titulos que acredite la propiedad del solicitante,
									y la de todos los actos jurídicos que conforman la tradición de los inmuebles en los últimos diez(10) años.</em>
							</small>
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
							<label for="documento5" class="form-label">Planos</label>
							<small style="font-size: 11px!important; text-align:justify!important;"><em
									style="font-size: 11px!important; text-align:justify!important;">Adjuntar planos.</em><br><br><br><br>
							</small>
							<div class="form-group">
								<div class="file-loading">
									<input class=" @error('documento5') is-invalid @enderror documentos_adjuntos"
										id="documento5" accept="application/pdf" name="documento5" type="file"
										data-overwrite-initial="true">
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
									style="font-size: 11px!important; text-align:justify!important;">Adjuntar poder.</em><br><br><br><br>
							</small>
							<div class="form-group">
								<div class="file-loading">
									<input class=" @error('documento6') is-invalid @enderror documentos_adjuntos"
										id="documento6" accept="application/pdf" name="documento6" type="file"
										data-overwrite-initial="true">
									@error('documento6')
										<span class="invalid-feedback" role="alert">
											<strong class="text-danger">{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
						</div>
					@include('tramites.habeasData')
					  <div class="col-md-12  pl-1 pr-1 pt-3 text-left mt-4" style="padding-left: 0px!important">
							
							<button style="font-size:15px;" type="submit" class="btn btn-round btn-middle btn_enviar_solicitud">Actualizar </button>
							
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
