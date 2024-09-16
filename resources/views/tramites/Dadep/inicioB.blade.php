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

				<form action="{{route('Dadep.solicitarB')}}" method="POST" id="myForm" enctype="multipart/form-data"  class="form-ciudadano">
					@csrf
				   
							<!-- datos Generales-->
					<h3 class="headline-l-govco mt-3 pl-0">1. Datos Generales de la Solicitud</h3>

					{{-- @if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				   @endif --}}

					<div class="row form-group mt-2">

						<div class="col-md-6 pl-1 pr-1 pt-3">
							<label for="tipo_documento" class="form-label">Tipo de Documento * </label>
							<select class="form-control  @error('tipo_documento') is-invalid @enderror"
								name="tipo_documento" id="tipo_documento" >
								<option value="">Seleccione</option>
								<option value="Cedula de Ciudadania">Cedula de Ciudadanía</option>
								<option value="C.E.">Cedula de Extranjería</option>
								<option value="NIT">NIT</option>
							</select>
							@error('tipo_documento')
								<span class="invalid-feedback" role="alert">
									<strong class="text-danger">{{ $message }}</strong>
								</span>
							@enderror
						</div>
						<div class="col-md-6 pl-1 pr-1 pt-3">
							<label for="ide_responsable" class="form-label">Número de Identificación* </label>
							<input value="{{ old('ide_responsable') }}" type="text"
								class="form-control number_validate  @error('ide_responsable') is-invalid @enderror"
								name="ide_responsable" id="ide_responsable" maxlength="15" minlength="4" required
								onkeypress="return Numeros(event)"  required onchange="ShowSelected();">
							@error('ide_responsable')
								<span class="invalid-feedback" role="alert">
									<strong class="text-danger">{{ $message }}</strong>
								</span>
							@enderror
						</div>

						<div class="col-md-12  pl-1 pr-1 pt-3 text-left mt-4" style="padding-left: 0px!important">

							<button style="font-size:15px;" type="submit" class="btn btn-round btn-middle btn_enviar_solicitud" >Enviar Solicitud</button>
							
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
