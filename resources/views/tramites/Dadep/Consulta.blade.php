@extends('layouts.app')
@section('title', 'Areas de cesion')
@section('content')

    

<style>
 .clockpicker-button {
		background-color: #3366CC !important;
		color: white !important;
	}
	table{
		border-collapse: collapse;
		width:100%;
		margin-bottom:24px;
	}
	td{
		width:50%;
	}
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container mt-3 mb-4 m-xs-x-3" id="body_eventos">
	@include('tramites.titulo')

	<div class="container-fluid">
		<div class="row mt-2">
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
				
				@include('tramites.Dadep.Introduccion')

     <h3 class="headline-l-govco mt-3 pl-0">Proceso de entrega de área de cesión.</h3>
    
      <h4>Solicitante:</h4>  
       <!-- Tabla Solicitante-->             
    <table>
		<tr>
		  <td>Nombre o Razón social:</td>
		  <td>{{$Persona->PersonaNombre}} {{$Persona->PersonaApe}}</td>
		</tr>

		<tr>
		  <td>Tipo y número de documento:</td>
		  <td>{{$Persona->PersonaTipDoc}} {{$Persona->PersonaDoc}}</td>
		</tr>
        
		 <tr>
		  <td>Correo electronico:</td>
		  <td>{{$Persona->PersonaMail}}</td>
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
			</div>
			
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				@include('tramites.Dadep.informativo')
			</div>
		</div>
	</div>
</div> 
@include('tramites.Dadep.form_consulta')
@endsection
                  

        
