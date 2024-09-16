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
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
				
				@include('tramites.Dadep.Introduccion')

				<form action="{{route('eventos.store')}}" method="POST" id="myForm" enctype="multipart/form-data"  class="form-ciudadano">
					@csrf
					<div class="col-md-12 pl-1 pr-1 pt-3">
					   <h3 class="headline-l-govco mt-3 pl-0">Seleccione tipo de proceso</h3>
					 </div>
					 
					 <a href="/Dadep/Solicitud" Style="font-size:15pt;">Recibo de áreas de Cesión Publicas Obligatorias y Cesiones Tipo A</a><br>
					 <a href="/Dadep/solLegalizacion"  Style="font-size:15pt;">Recibo de áreas de Cesión Publicas Obligatorias y Cesiones Tipo A en procesos  de legalización de Asentamientos Humanos</a><br>
					 <a style = "display:none;" href=""  Style="font-size:15pt;">C- Recuperacion de areas de cesión</a><br>
					 <a href="/Dadep/DocConsulta"  Style="font-size:15pt;">Anexar documentos pendientes</a><br>
					 <a href="/Dadep/Correcciones"  Style="font-size:15pt;">Anexar correcciones</a>
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
