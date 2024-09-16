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
                                        UTSP
                                    </b></p>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="col-md-12 pt-4" style="padding-left: 10px!important">
            <h1 class="headline-xl-govco">Modulo de Gestión de Usuarios UTSP</h1>
            <div class="row pt-5">

              {{-- INICIO CARD --}}
                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                    <div class="card govco-card animate__animated animate__flipInX" style="max-height: 500px!important; height:500px!important;">
                        <div class="card-header govco-card-header">
                            <h4>
                                Registro de Solicitudes</h4>
                        </div>

                        <div class="card-body">
                            <p style="text-align: justify"> Esta opcion es para registar una nueva solicitud:                            
                            </p>
                            <div class="container mt-1">
                                <img src="{{asset('img/register-utsp.png')}}" alt="Descripción de la imagen" class="img-fluid w-75 mx-auto d-block">
                              </div>

                        </div>
                        <div class="card-footer govco-card-footer govco-center mt-3">

                            <a class="btn-low-mix-govco align-column-govco"
                                href="{{ route('utsp.index.register') }}">
                                <span class="btn-mix-govco__title">Ver mas detalles</span>
                                <span class="btn-mix-govco__icon govco-icon govco-icon-simpled-arrow"></span>
                            </a>
                        </div>
                    </div>
                </div>
                {{-- </ FIN CARD --}}

                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                    <div class="card govco-card animate__animated animate__flipInX" style="max-height: 500px!important;height:500px!important;">
                        <div class="card-header govco-card-header">
                            <h4>
                                Registrar Actuaciones</h4>
                        </div>

                        <div class="card-body">
                            <p style="text-align: justify"> Esta opcion permite interactuar sobre las solicitudes abiertas
                                </p>
                                <div class="container mt-1">
                                    <img src="{{asset('img/actuacion-utsp.png')}}" alt="Descripción de la imagen" class="img-fluid w-75 mx-auto d-block">
                                  </div>
                        </div>
                        <div class="card-footer govco-card-footer govco-center mt-3">

                            <a class="btn-low-mix-govco align-column-govco"
                                href="{{route('utsp.loadData')}}">
                                <span class="btn-mix-govco__title">Ver mas detalles</span>
                                <span class="btn-mix-govco__icon govco-icon govco-icon-simpled-arrow"></span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                    <div class="card govco-card animate__animated animate__flipInX" style="max-height: 500px!important;height:500px!important;">
                        <div class="card-header govco-card-header">
                            <h4>Reportes</h4>
                        </div>

                        <div class="card-body">
                            <p style="text-align: justify pt-1">Modulo de reportes de atenciones en el UTSP
                            </p>
                            <div class="container mt-1">
                                <img src="{{asset('img/reports-utsp.png')}}" alt="Descripción de la imagen" class="img-fluid w-75 mx-auto d-block">
                              </div>
                        </div>
                        <div class="card-footer govco-card-footer govco-center mt-3">

                            <a class="btn-low-mix-govco align-column-govco"
                                href="{{route('utsp.reportes')}}">
                                <span class="btn-mix-govco__title">Ver mas detalles</span>
                                <span class="btn-mix-govco__icon govco-icon govco-icon-simpled-arrow"></span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>



    </div>
@endsection
