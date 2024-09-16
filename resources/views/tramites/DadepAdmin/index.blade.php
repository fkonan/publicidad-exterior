@extends('layouts.menu')

@section('dashboard')

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
                                <p class="ml-3 ml-md-0 "><b style="color: #004fbf;text-transform: none;">
                                        Dadep
                                    </b></p>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="col-md-12 pt-4" style="padding-left: 10px!important">
            <h1 class="headline-xl-govco">Tramites Dadep</h1>
            <div class="row pt-5">
                  
               {{-- INICIO CARD  --}}
              <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
              <div class="card govco-card animate__animated animate__flipInX" style="max-height: 500px!important; height: 500px!important">
                    <div class="card-header govco-card-header">
                        <h4>
                      Recibo de áreas de cesión públicas obligatorias y cesiones tipo A</h4> 
                    </div>
                    
                    <div class="card-body">
                        <p style="text-align: justify">Es la parte de un predio transferido por el urbanizador de un desarrollo al municipio de Bucaramanga a titulo gratuito con destino a zonas verdes, parques y equipamiento comunal público.</p>
                      </div>
                      <div class="card-footer govco-card-footer govco-center">
                        <a class="btn-low-mix-govco align-column-govco" href="/tramites/DadepAdmin/Cesion/A">
                          <span class="btn-mix-govco__title">Ver mas detalles</span>
                          <span class="btn-mix-govco__icon govco-icon govco-icon-simpled-arrow"></span>
                        </a>
                      </div>                
                    </div>
                </div>
                {{--  FIN CARD --}}

                {{-- inicio card --}}
                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                    <div class="card govco-card animate__animated animate__flipInX" style="max-height: 500px!important; height:500px!important">
                        <div class="card-header govco-card-header">
                            <h4>Procesos de legalización de asentamientos humanos</h4> 
                        </div>
                        
                        <div class="card-body">
                            <p style="text-align: justify">Transferir y titular a favor del municipio las zonas de cesión obligatorias y demás bienes destinados 
                             al uso público aprobados en los procesos de legalización de asentamientos humanos en el Municipio de Bucaramanga.</p>
                        </div>
                        <div class="card-footer govco-card-footer govco-center">
							<a class="btn-low-mix-govco align-column-govco" href="/tramites/DadepAdmin/Cesion/B">
								<span class="btn-mix-govco__title">Ver mas detalles</span>
								<span class="btn-mix-govco__icon govco-icon govco-icon-simpled-arrow"></span>
							</a>
						</div>                
                    </div>
                 </div>
                {{-- fin del card --}}

                {{-- inicio card --}}
                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                    <div class="card govco-card animate__animated animate__flipInX" style="max-height: 500px!important; height:500px!important">
                        <div class="card-header govco-card-header">
                            <h4>Modulo Reportes de Certificado de Predios</h4> 
                        </div>
                        
                        <div class="card-body">
                            <p style="text-align: justify">Este modulo tiene como finalidad consultar, validar y revisar los certificados de predios del municipio generados internamente en el sistema de infomacion del Municipio de Bucaramanga.</p>
                        </div>
                        <div class="card-footer govco-card-footer govco-center">
							<a class="btn-low-mix-govco align-column-govco" href="/tramites/certificado-predios/index">
								<span class="btn-mix-govco__title">Ver mas detalles</span>
								<span class="btn-mix-govco__icon govco-icon govco-icon-simpled-arrow"></span>
							</a>
						</div>                
                    </div>
                 </div>
                {{-- fin del card --}}
                
               {{-- inicio card --}}
                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12" style= "display:none;">
                    <div class="card govco-card animate__animated animate__flipInX" style="max-height: 500px!important; height:500px!important">
                        <div class="card-header govco-card-header">
                            <h4>Recuperación de áreas de cesión</h4> 
                        </div>
                        
                        <div class="card-body">
                            <p style="text-align: justify"></p>
                        </div>
                        <div class="card-footer govco-card-footer govco-center">
							<a class="btn-low-mix-govco align-column-govco" href="/tramites/DadepAdmin/Cesion/C">
								<span class="btn-mix-govco__title">Ver mas detalles</span>
								<span class="btn-mix-govco__icon govco-icon govco-icon-simpled-arrow"></span>
							</a>
						</div>                
                    </div>
                 </div>
                {{-- fin del card --}}

            </div>
        </div>
    </div>
@endsection
