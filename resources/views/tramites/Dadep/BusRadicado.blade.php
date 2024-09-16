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

				<form action="/Dadep/{{$funcion}}" method="GET" id="myForm" enctype="multipart/form-data"  class="form-ciudadano">
					@csrf
				   
							<!-- datos Generales-->
					<h3 class="headline-l-govco mt-3 pl-0">Actualizaciones</h3>

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

						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><br>
							<div class="form-group">
								<label style="color:#111111;" class="input" for="DD01"
									style="font-family: 'Barlow', sans-serif;">Numero Identificación </label>
								<input type="text" name="identificacion" id="identificacion" class="form-control input-md"
									title="Seleccione la opción para validar el documento" required="required"
									onkeypress="return Numeros(event)" onkeyup="aMayusculas(this.value,this.id)"
									maxlength="40" minlength="5">
							</div>
						</div>
						
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><br>
							<div class="form-group">
								<label style="color:#111111;" class="input" for="DD01"
									style="font-family: 'Barlow', sans-serif;">Numero Radicado </label>
								<input type="text" name="Radicado" id="Radicado" class="form-control input-md"
									title="Seleccione la opción para validar el documento" required="required"
									onkeypress="" onkeyup="aMayusculas(this.value,this.id)"
									maxlength="10" minlength="8">
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
