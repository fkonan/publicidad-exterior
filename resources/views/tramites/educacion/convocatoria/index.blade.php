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
                                <a style="color: #004fbf;" class="breadcrumb-text" href="{{ route('educacion.index') }}">
                                    Educacion</a>
                            </div>
                        </li>
                        <li class="breadcrumb-item ">
                            <div class="image-icon">
                                <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                                <p class="ml-3 ml-md-0 "><b style="color: #004fbf;text-transform: none;">
                                        Convocatoria de Educacion
                                    </b></p>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="col-md-12 pt-4" style="padding-left: 10px!important">
            <h1 class="headline-xl-govco">Convocatorias - Subsidios de Educación Superior</h1>
            <div class="row pt-5">

                <div class="col-md-12">
                    <h4>Convocatoria-Programas</h4>
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Programa</th>
                            <th scope="col">Cantidad</th>                            
                          </tr>
                        </thead>
                        <tbody>
                         @foreach ($query2 as $item)
                         <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$item->programa}}</td>
                            <td>{{$item->total_programa}}</td>                           
                          </tr>                             
                         @endforeach
                         <tr>
                            <td colspan="2" class="text-center"><h2 class="text-center">Total Inscripciones:</h2></td>
                            <th><p class="display-4">{{$query[0]->numero_inscripciones}}</p></th>
                           
                         </tr>
                        </tbody>
                      </table>
                </div>

                <div class="col-md-12 mt-4">
                    <h4>Convocatoria-Instituciones</h4>
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Institucion</th>
                            <th scope="col">Cantidad</th>                            
                          </tr>
                        </thead>
                        <tbody>
                         @foreach ($query3 as $item)
                         <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$item->institucion}}</td>
                            <td>{{$item->cantidad}}</td>                           
                          </tr>                             
                         @endforeach
                         <tr>
                            <td colspan="2" class="text-center"><h2 class="text-center">Total Inscripciones:</h2></td>
                            <th><p class="display-4">{{$query[0]->numero_inscripciones}}</p></th>
                           
                         </tr>
                        </tbody>
                      </table>
                </div>
                <div class="col-md-3 pl-0 mr-0">
                    <a class="btn btn-round btn-high" href="{{ URL::route('educacion.index') }}"
                        style="float: left;">Volver</a>
                </div>



            </div>
        </div>



    </div>
   
@endsection
