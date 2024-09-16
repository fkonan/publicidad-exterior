@extends('layouts.menu')

@section('dashboard')
<style>
    th.sorting_desc::after, th.sorting_asc::after{
      right: 0!important;
      content: ""!important;
   }
</style>

<?php $tramite= 'LICENCIA DE INTERVENCION DE ESPACIO PUBLICO PARA LOCALIZACION DE EQUIPAMIENTO';?>


<div class="container mt-3 mb-4 m-xs-x-3">

	<div class="row pl-4">
		<div class="px-0 col-md-9">
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
									 Recibo de áreas de cesión.
								</b></p>
						</div>
					</li>
				</ol>
			</nav>
		</div>
	</div>
	<div class="col-md-12 pt-4" style="padding-left: 10px!important">
		@if($tipo == "A")
			<h2 class="headline-xl-govco">Solicitudes para entrega de áreas de cesión tipo A</h1>
	    @else
			<h2 class="headline-xl-govco">Solicitudes para procesos de legalización de asentamientos humanos </h1>
		@endif
		<div class="row pt-5">
		
		   <!-- cerrar pendiente-->
			<div class="col-md-4 pb-4">
				<button type="button" class="btn btn-danger btn-block btn-sm" style="background-color:#A80521!important;">
					<span class="govco-icon govco-icon-exclamation-cn size-1x text-white"></span> &nbsp; Solicitudes pendientes por cerrarse automaticamente <span class="badge badge-light">{{$PORCERRAR}}</span>
				  </button>
			</div>
		  <!-- Fin de cerrar-->

			<div class="tabs-govco col-md-12 animate__animated animate__bounceInRight">
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					 @foreach ($sGrupos as $sEnviadas)	
					<li class="nav-item">
					<a class="nav-link {{$sEnviadas->activo}}" 
						id="{{$sEnviadas->titulo}}-tab" 
						data-toggle="tab" 
						href="#{{$sEnviadas->titulo}}" 
						role="tab" 
						aria-controls="{{$sEnviadas->titulo}}" 
						>{{$sEnviadas->nombre}}
						<span class="badge badge-primary">{{$sEnviadas->cantidad}}</span>
					</a>
					</li>
					
					@endforeach
				</ul>
			
				<div class="tab-content">
					
				 
					 @foreach ($sGrupos as $sEnviadas)	
					<div class="tab-pane {{$sEnviadas->activo}}" id="{{$sEnviadas->titulo}}" role="tabpanel" aria-labelledby="{{$sEnviadas->titulo}}-tab">
					   {{-- TABLA DE ENVIADOS --}}
						<div class="col-md-12 pt-4">
							<div id="container_table" class="table-pagination-govco">
								<table id="DataTables_Table_0"
									class="table display table-responsive-md table-responsive-md tablas" width="100%"
									style="text-align: left!important;">
									<thead>
										<tr>
											<th style="color: #004884;">Radicado</th>
											<th style="color: #004884;">Nombre Solicitante</th>
											<th style="color: #004884;">Identificación Solicitante</th>
											<th style="color: #004884;;">Teléfono Solicitante</th>
											<th style="color: #004884;;">Correo Solicitante</th>
											<th style="color: #004884;">Dirección</th>
											
										</tr>
									</thead>
									<tbody>
										@foreach ($sEnviadas->datos as $solicitudesE)
											<tr>
												<td>{{ $solicitudesE->Radicado }}</td>
												<td>{{ $solicitudesE->PersonaNombre }} {{$solicitudesE->PersonaApe}}</td>
												<td>{{ $solicitudesE->PersonaDoc }}</td>
												<td>{{ $solicitudesE->PersonaTel }}</td>
												<td>{{ $solicitudesE->PersonaMail }}</td>
												<td>{{ $solicitudesE->PredioDir }}</td>
												
												<td>
													<div class="btn-group" role="group">
														<a type="button" class="btn-symbolic-govco align-column-govco" href="{{route('Cesion.detalle', $solicitudesE->SolicitudId)}}">
															<span class="govco-icon govco-icon-attached-n"></span>
															<span class="btn-govco-text">Detalles</span></a>                                                                                                                                  
													 </div>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
						{{-- </ TABLA DE ENVIADOS FIN --}}
					</div>
					@endforeach
				</div>
			</div>
		</div>   
	</div>
</div>
@endsection
