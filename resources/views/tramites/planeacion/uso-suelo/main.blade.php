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
                            <a style="color: #004fbf;" class="breadcrumb-text" href="/dashboard">Tramites en Linea</a>
                        </div>
                    </li>
                    <li class="breadcrumb-item ">
                        <div class="image-icon">
                            <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                            <a style="color: #004fbf;" class="breadcrumb-text" href="{{route('planeacion.index')}}">
                                Planeacion</a>
                        </div>
                    </li>
                    <li class="breadcrumb-item ">
                        <div class="image-icon">
                            <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                            <a style="color: #004fbf;" class="breadcrumb-text" href="{{route('planeacion.uso-suelo.index')}}">
                                Reportes Uso de suelo</a>
                        </div>
                    </li>
                    <li class="breadcrumb-item ">
                        <div class="image-icon">
                            <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                            <p class="ml-3 ml-md-0 "><b style="color: #004fbf;text-transform: none;">
                                    Tablero de control
                                </b></p>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
      </div>

        <div class="col-md-12 pt-4" style="padding-left: 10px!important">
            <h1 class="headline-xl-govco">Tablero de control Uso Suelo</h1>
            <div class="row pt-5">

              <div class="col-md-12">
                <div class="embed-responsive embed-responsive-21by9">
                  <iframe class="embed-responsive-item" src="https://app.powerbi.com/view?r=eyJrIjoiNDU0NzhkZTQtZDRlZS00NmU1LWFiZTktNzdjNzFmNDY4Y2EyIiwidCI6Ijc4NjgzZmYyLTBjMjAtNGJkYS1iYzc3LWQ0YjJhODdmMmE2YSIsImMiOjR9"></iframe>
                </div>
              </div>
              <div class="col-md-3 pl-0 mr-0">
                <a class="btn btn-round btn-high" href="{{ URL::route('planeacion.uso-suelo.index') }}"
                    style="float: left;">Volver</a>
            </div>
                  

             
            </div>
        </div>



    </div>
@endsection