@extends('layouts.app')
@section('title', 'Servicio en Mantenimiento')
@section('content')

<style>
	.clockpicker-button {
		background-color: #3366CC !important;
		color: white !important;
	}
</style>

<div class="container mt-3 mb-4 m-xs-x-3">	

	<div class="container-fluid">
		<div class="row mt-2">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
				<div class="card govco-card border-0 shadow-none" style="border-radius: 0px;">

					<div class="background-image" style="background-image: url({{asset('img/mantenimiento-2.jpg')}}); height: 200px;"></div>


					<h1 class="headline-xl-govco">Servicios en Mantenimiento</h1>
					
					<div class="alert-primary-govco alert alert-dismissible fade show mt-3"
						aria-label="Alerta informativa">						
						<div class="alert-heading">
							<span class="govco-icon govco-icon-bell-sound-p size-2x"></span>
							<span class="headline-l-govco">Importante</span>
						</div>
						<p style="text-align: justify">Nuestra plataforma está actualmente en mantenimiento. </p>
						<p style="text-align: justify">Disculpa los inconvenientes. Estamos trabajando para mejorar nuestros servicios.</p>
						<p style="text-align: justify">Si necesitas asistencia inmediata, por favor contáctanos en:</p>
                        <p><b>Email:</b> <a href="mailto:contactenos@bucaramanga.gov.co" target="_blank">contactenos@bucaramanga.gov.co</a></p>
			
					</div>
				</div>

				
			</div>
			
		</div>
	</div>
</div> 


@endsection
