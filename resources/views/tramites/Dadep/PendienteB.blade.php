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

				<form action="{{route('Dadep.GuardarB')}}" method="POST" id="myForm" enctype="multipart/form-data"  class="form-ciudadano">
					<input type="hidden" name ="Radicado" value="{{$Solicitud->Radicado}}">
					@csrf
				   
							<!-- datos Generales-->
					
					{{-- @if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				   @endif --}}

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
					
						<div class="col-md-12 pl-1 pr-1 pt-3">
							<label for="tipo_documento" class="form-label">¿Cumplió con los cambios requeridos para continuar con el proceso? * </label>
							<select class="form-control  @error('tipo_documento') is-invalid @enderror"
								name="estado_correccion" id="estado_correccion" >
								<option value="">Seleccione</option>
								<option value="SI">SI</option>
								<option value="NO">NO</option>
							</select>
							@error('tipo_documento')
								<span class="invalid-feedback" role="alert">
									<strong class="text-danger">{{ $message }}</strong>
								</span>
							@enderror
						</div>
						
							<div class="col-md-6 pl-1 pr-1 pt-3">
							<label for="documento0" class="form-label">Documentos adicionales</label>
							<small style="font-size: 11px!important; text-align:justify!important;"><em
									style="font-size: 11px!important; text-align:justify!important;">Adjuntar Documentos adicionales requeridos por el Dadep.</em><br><br><br><br>
							</small>
							<div class="form-group">
								<div class="file-loading">
									<input class=" @error('documento0') is-invalid @enderror documentos_adjuntos"
										id="documento0" accept="application/pdf" name="documento0" type="file"
										data-overwrite-initial="true">
									@error('documento0')
										<span class="invalid-feedback" role="alert">
											<strong class="text-danger">{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
						</div>

						<div class="col-md-12  pl-1 pr-1 pt-3 text-left mt-4" style="padding-left: 0px!important">

							<button style="font-size:15px;" type="submit" class="btn btn-round btn-middle btn_enviar_solicitud" >Actualizar</button>
							
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
@include('tramites.Dadep.form_consulta')

@endsection
