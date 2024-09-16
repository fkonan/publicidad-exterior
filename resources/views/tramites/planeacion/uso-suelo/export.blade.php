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
                                class="table display table-responsive-md table-responsive-md tablas_export-uso" width="100%"
                                style="text-align: left!important;">
                                <thead>
                                    <tr>
                                        <th style="color: #004884;">Radicado</th>
                                        <th style="color: #004884;">Documento</th>
                                        <th style="color: #004884;">Nombres</th>
                                        <th style="color: #004884;">Estado</th>
                                        <th style="color: #004884;">Dirección de Predio</th>
                                        <th style="color: #004884;">Codigo Predial</th>
                                        <th style="color: #004884;">Fecha</th>
                                        <th style="color: #004884;" class="d-none">Tipo de documento</th>
                                        <th style="color: #004884;" class="d-none">Fecha Expedicion Documento</th>
                                        <th style="color: #004884;" class="d-none">Correo </th>
                                        <th style="color: #004884;" class="d-none">Telefono</th>
                                        <th style="color: #004884;" class="d-none">Unidad</th>
                                        <th style="color: #004884;" class="d-none">Area de Actividad</th>
                                        <th style="color: #004884;" class="d-none">Barrio</th>
                                        <th style="color: #004884;" class="d-none">Estrato</th>
                                        <th style="color: #004884;" class="d-none">Zona Normativa</th>
                                        <th style="color: #004884;" class="d-none">Area en MTS</th>
                                        <th style="color: #004884;" class="d-none">Tratamiento Urbanisitico</th>
                                        <th style="color: #004884;" class="d-none">Motivo Negacion</th>
                                        <th style="color: #004884;" class="d-none">Documento</th>

                                        <th style="color: #004884;;">Detalle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($query as $uso)
                                        <tr>
                                            <td>{{ $uso->radicado }}</td>
                                            <td>{{ $uso->documento_solicitante }}</td>
                                            <td>{{ $uso->nombre_solicitante }}</td>
                                            <td>{{ $uso->ConEstado }}</td>
                                            <td>{{ $uso->direccion_ipu ? $uso->direccion_ipu : 'SIN VALIDAR' }}</td>
                                            <td>{{ $uso->codigo_predial }}</td>
                                            <td>{{ $uso->ConFecReg }}</td>
                                            <td class="d-none">{{ $uso->tipo_documento }}</td>
                                            <td class="d-none">{{ $uso->fecha_expedicion }}</td>
                                            <td class="d-none">{{ $uso->correo_solicitante }}</td>
                                            <td class="d-none">{{ $uso->telefono_solicitante }}</td>
                                            <td class="d-none">{{ $uso->unidad }}</td>
                                            <td class="d-none">{{ $uso->area_actividad }}</td>
                                            <td class="d-none">{{ $uso->barrio }}</td>
                                            <td class="d-none">{{ $uso->estrato }}</td>                                            
                                            <td class="d-none">{{ $uso->ConZonNor }}</td>
                                            <td class="d-none">{{ $uso->ConAreCon }}</td>
                                            <td class="d-none">{{ $uso->ConTraUrb }}</td>
                                            <td class="d-none">{{ $uso->ConMotInc }}</td>
                                            <td class="d-none">{{ $uso->documento }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a type="button" class="btn-symbolic-govco align-column-govco"
                                                        href="{{ route('planeacion.uso.detalle', $uso->id_concepto) }}">Ver
                                                        +</a>


                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>
                        </div>
                    </div>
                    <div class="col-md-3 pl-0 mr-0">
                        <a class="btn btn-round btn-high" href="{{ URL::route('tramites.planeacion.reportes.uso') }}"
                            style="float: left;">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
