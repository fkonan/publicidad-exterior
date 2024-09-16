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
                   
                   <div class="col-md-12">

                <div class="alert-success-govco alert alert-dismissible fade show animate__animated animate__bounceInRight" aria-label="Alerta: caso de éxito">
                     <div class="alert-heading">
                      <span class="govco-icon govco-icon-check-cn size-2x"></span>
                      <span class="headline-l-govco">Tu solicitud se realizo correctamente</span>
                      
                    </div>
                    <p>Apreciado Ciudadano, su solicitud ha sido recibida satisfactoriamente para consultar el estado de sus solicitud tenga en cuenta el siguiente numero de radicado: <strong> {{$Cs->Radicado}}</strong></p>
                  </div>


            </div>
            <div class="col-md-4">
                <button style="font-size:15px;" type="button" class="btn btn-round btn-middle" name="consultar"><a href="{{URL::route('Dadep.index')}}">Finalizar</a></button>


            </div>
                  
                 </div>
              
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				@include('tramites.Dadep.informativo')
			</div>
		</div>
	</div>
</div> 
@include('tramites.Dadep.form_consulta')
@endsection
