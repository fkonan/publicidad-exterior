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
                                <a style="color: #004fbf;" class="breadcrumb-text" href="#">
                                        Juridica</a>                                    
                            </div>
                        </li>
                        <li class="breadcrumb-item ">
                            <div class="image-icon">
                                <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                                <p class="ml-3 ml-md-0 "><b style="color: #004fbf;text-transform: none;">
                                    Canal de denuncia RITA
                                    </b></p>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="col-md-12 pt-4" style="padding-left: 10px!important">
            <h1 class="headline-xl-govco">Canal Denuncia RITA</h1>
            <div class="row pt-5">
                  
               {{-- INICIO CARD  --}}
              <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                <div class="card govco-card animate__animated animate__flipInY">
                    <div class="row">
                      <div class="col-sm-6 col-md-6 col-lg-6">
                        <img class="card-img govco-card-image govco-card-image-left" src="{{asset('img/denuncias.png')}}" />
                      </div>
                      <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="card-header govco-card-header">
                          <a>Información de las denuncías</a>
                        </div>
                        <div class="card-body">
                          <p>Para ver la denuncias clic <a href="{{route('juridica.rita.index')}}">aqui</a> </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- </ FIN CARD --}}
               {{-- INICIO CARD  --}}
              <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                <div class="card govco-card animate__animated animate__flipInY">
                    <div class="row">
                      <div class="col-sm-6 col-md-6 col-lg-6">
                        <img class="card-img govco-card-image govco-card-image-left" src="{{asset('img/estadisticas.jpg')}}" />
                      </div>
                      <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="card-header govco-card-header">
                          <a>Reportes de las denuncias</a>
                        </div><br>
                        <div class="card-body">
                          <p>Para generar los reportes clic <a href="{{route('juridica.rita.reporte')}}">aqui</a> </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- </ FIN CARD --}}
                                    
            </div>
        </div>



    </div>
@endsection