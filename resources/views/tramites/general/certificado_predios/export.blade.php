@extends('layouts.menu')

@section('dashboard')
    <style>
        th.sorting_desc::after,
        th.sorting_asc::after {
            right: 0 !important;
            content: "" !important;
        }

        .btnpdf {
            background-color: #5A945E;
            border: #5A945E;
            border-radius: 5px;
        }
       body {
        overflow-x: hidden!important;
       } 
    </style>



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
                                <a style="color: #004fbf;" class="breadcrumb-text" href="{{route('general.index')}}">
                                    General</a>
                            </div>
                        </li>
                        <li class="breadcrumb-item ">
                            <div class="image-icon">
                                <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                                <a style="color: #004fbf;" class="breadcrumb-text" href="{{route('certificados.reportes')}}">
                                    Reportes Certificado de Predios</a>
                            </div>
                        </li>
                        <li class="breadcrumb-item ">
                            <div class="image-icon">
                                <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                                <p class="ml-3 ml-md-0 "><b style="color: #004fbf;text-transform: none;">
                                        Extrater Reportes
                                    </b></p>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
          </div>
        <div class="col-md-12 pt-4" style="padding-left: 10px!important">
            <h1 class="headline-xl-govco">Descargar Reportes</h1>
            <div class="row pt-5">
                <div class="tabs-govco col-md-12 animate__animated animate__bounceInRight">

                    <div class="col-md-12 pt-4">
                        <div id="container_table" class="table-pagination-govco">
                            <table id="DataTables_Table_0"
                                class="table display table-responsive-md table-responsive-md tablas_export-predios" width="100%"
                                style="text-align: left!important;">
                                <thead>
                                    <tr>
                                        <th style="color: #004884;">Radicado</th>
                                        <th style="color: #004884;">Numero Predial</th>
                                        <th style="color: #004884;">Matricula</th>
                                        <th style="color: #004884;">Direccion</th>
                                        <th style="color: #004884;">Complemento</th>
                                        <th style="color: #004884;">Persona Solicitante</th>
                                        <th style="color: #004884;">Usuario</th>
                                        <th style="color: #004884;">Secretaria y/o Oficina</th>
                                        <th style="color: #004884;">Fecha</th>                                    
                                        <th style="color: #004884;">Documento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($certificado as $predio)
                                        <tr>
                                            <td>{{ $predio->radicado }}</td>
                                            <td>{{ $predio->numero_predial }}</td>
                                            <td>{{ $predio->matricula }}</td>
                                            <td>{{ $predio->direccion }}</td>
                                            <td>{{ $predio->complemento ? $predio->complemento : 'SIN COMPLEMENTO' }}</td>
                                            <td>{{ $predio->nombre_usuario }}</td>
                                            <td>{{ $predio->user }}</td>                                            
                                            <td>{{ $predio->secretaria }}</td>                                            
                                            <td>{{ $predio->fecha }}</td>                                            
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a type="button" class="btn-symbolic-govco align-column-govco"
                                                        href="{{ route('certificados.search', $predio->id) }}">Descargar
                                                        </a>


                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>
                        </div>
                    </div>
                    <div class="col-md-3 pl-0 mr-0">
                        <a class="btn btn-round btn-high" href="{{ URL::route('certificados.reportes') }}"
                            style="float: left;">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
