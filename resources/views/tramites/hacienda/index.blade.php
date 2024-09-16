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
                                        Hacienda
                                    </b></p>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="col-md-12 pt-4" style="padding-left: 10px!important">
            <h1 class="headline-xl-govco">Tramites secretaria de hacienda</h1>
            <div class="row pt-5">

                {{-- INICIO CARD --}}
                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                    <div class="card govco-card animate__animated animate__flipInX"
                        style="max-height: 500px!important; height: 500px!important">
                        <div class="card-header govco-card-header">
                            <h4>
                                Solicitud de registro de espectáculos públicos municipales</h4>
                        </div>

                        <div class="card-body">
                            <p style="text-align: justify">Aprobación del espectáculo publico Municipal y/o espectáculos
                                públicos con destino al deporte que no corresponda a las representaciones en vivo de
                                expresiones artísticas en teatro, danza, música, circo, magia y todas sus posibles prácticas
                                derivadas o creadas a partir de la imaginación, sensibilidad y conocimiento del ser humano.
                            </p>
                        </div>
                        <div class="card-footer govco-card-footer govco-center">
                            <a class="btn-low-mix-govco align-column-govco"
                                href="{{ route('hacienda.espectaculos.index') }}">
                                <span class="btn-mix-govco__title">Ver mas detalles</span>
                                <span class="btn-mix-govco__icon govco-icon govco-icon-simpled-arrow"></span>
                            </a>
                        </div>
                    </div>
                </div>
                {{-- INICIO CARD --}}
                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                    <div class="card govco-card animate__animated animate__flipInX"
                        style="max-height: 500px!important; height: 500px!important">
                        <div class="card-header govco-card-header">
                            <h4>
                                Reportes de Empleo Joven</h4>
                        </div>

                        <div class="card-body">
                            <br>
                            <br>                            
                            <p style="text-align: justify">Esta Opción tiene la funcionalidad de crear reportes en formato .xlsx del sistema de empleo joven.
                            Presiona en la opción ver detalles para realizar ir a la interfaz de descarga de activos
                            </p>
                        </div>
                        <div class="card-footer govco-card-footer govco-center">
                            <a class="btn-low-mix-govco align-column-govco"
                                href="{{route('hacienda.empleo-joven.index')}}">
                                <span class="btn-mix-govco__title">Ver mas detalles</span>
                                <span class="btn-mix-govco__icon govco-icon govco-icon-simpled-arrow"></span>
                            </a>
                        </div>
                    </div>
                </div>

              {{-- INICIO CARD --}}
                {{-- INICIO CARD --}}
                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                    <div class="card govco-card animate__animated animate__flipInX"
                        style="max-height: 500px!important; height: 500px!important">
                        <div class="card-header govco-card-header">
                            <h4>
                                Reportes de Metrolinea</h4>
                        </div>

                        <div class="card-body">
                            <br>
                            <br>                            
                            <p style="text-align: justify">Esta Opción tiene la funcionalidad de crear reportes en formato .xlsx del sistema de subsidio de metrolinea.
                            Presiona en la opción ver detalles para realizar ir a la interfaz de descarga de activos
                            </p>
                        </div>
                        <div class="card-footer govco-card-footer govco-center">
                            <a class="btn-low-mix-govco align-column-govco"
                                href="{{route('hacienda.metrolinea.index')}}">
                                <span class="btn-mix-govco__title">Ver mas detalles</span>
                                <span class="btn-mix-govco__icon govco-icon govco-icon-simpled-arrow"></span>
                            </a>
                        </div>
                    </div>
                </div>

              {{-- INICIO CARD --}}
                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                    <div class="card govco-card animate__animated animate__flipInX" style="max-height: 500px!important">
                        <div class="card-header govco-card-header">
                            <h4>
                                Publicidad Exterior</h4>
                        </div>

                        <div class="card-body">
                            <p style="text-align: justify"> Obtener la autorización para la realización de espectáculos
                                públicos diferentes a las artes escénicas previo cumplimiento de los requisitos establecidos
                                en las normas para su desarrollo. Dicha actividad no podrá realizarse sin autorización, y
                                debe ser solicitado con mínimo 15 días hábiles para su autorización.</p>
                                <br>
                                <br>
                                <br>
                        </div>
                        <div class="card-footer govco-card-footer govco-center mt-3">

                            <a class="btn-low-mix-govco align-column-govco"
                                href="{{ route('hacienda.publicidad.index') }}">
                                <span class="btn-mix-govco__title">Ver mas detalles</span>
                                <span class="btn-mix-govco__icon govco-icon govco-icon-simpled-arrow"></span>
                            </a>
                        </div>
                    </div>
                </div>
                {{-- </ FIN CARD --}}
            </div>



        </div>
    @endsection
