@extends('layouts.menu')

@section('dashboard')
    <style>
        th.sorting_desc::after,
        th.sorting_asc::after {
            right: 0 !important;
            content: "" !important;
        }
    </style>

    <?php $tramite = 'RITA'; ?>

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
            <h1 class="headline-xl-govco">Denuncias RITA</h1>
            <div class="row pt-5">

                @if ($porCerrar > 0)
                    <div class="col-md-4 pb-4">
                        <button type="button" class="btn btn-danger btn-block btn-sm"
                            style="background-color:#A80521!important;">
                            <span class="govco-icon govco-icon-exclamation-cn size-1x text-white"></span> &nbsp; Solicitudes
                            pendientes proximas a la fecha limite <span class="badge badge-light">{{ $porCerrar }}</span>
                        </button>
                    </div>
                @endif




                <div class="tabs-govco col-md-12 animate__animated animate__bounceInRight rita">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                aria-controls="home" aria-selected="true">Radicadas <span
                                    class="badge badge-primary">{{ $countRa }}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pendientes-tab" data-toggle="tab" href="#pendientes" role="tab"
                                aria-controls="pendientes" aria-selected="false">Contestadas <span
                                    class="badge badge-primary">{{ $countCon }}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                aria-controls="profile" aria-selected="false">Remitidas por competencia <span
                                    class="badge badge-primary">{{ $countRemi }}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab"
                                aria-controls="messages" aria-selected="false">Nulas <span
                                    class="badge badge-primary">{{ $countNoCon }}</span></a>
                        </li>                       
                       
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            {{-- TABLA DE RADICADOS --}}
                            <div class="col-md-12 pt-4">
                                <div id="container_table" class="table-pagination-govco">
                                    <table id="DataTables_Table_0"
                                        class="table display table-responsive-md table-responsive-md tablas-rita"
                                        width="100%" style="text-align: left!important;">
                                        <thead>
                                            <tr>
                                                <th style="color: #004884;">Radicado</th>
                                                <th style="color: #004884;">Asunto</th>
                                                <th style="color: #004884;">Tipo de solicitud</th>
                                                <th style="color: #004884;">Fecha Limite</th>
                                                <th style="color: #004884;;">Detalle</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($deRadicadas as $denunuciasRA)
                                                <tr>
                                                    <td>{{ $denunuciasRA->radicado }}</td>
                                                    <td>{{ $denunuciasRA->asunto }}</td>
                                                    <td>{{ $denunuciasRA->tipo_solicitud }}</td>
                                                    <td>{{ $denunuciasRA->fecha_limite }}</td>

                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a type="button"
                                                                class="btn-symbolic-govco align-column-govco"
                                                                href="{{ route('juridica.rita.detalle', $denunuciasRA->id) }}">
                                                                <span class="govco-icon govco-icon-attached-n"></span>
                                                                <span class="btn-govco-text">Detalle Denuncia</span></a>

                                                            {{-- <a type="button" class="btn-symbolic-govco align-column-govco pl-0 ml-0" href="{{route('tramite.trazabilidad', ['radicado'=>$solicitudesE->radicado , 'tramite' => $tramite] )}}">
                                                                <span class="govco-icon govco-icon-analytic-cn"></span>
                                                                <span class="btn-govco-text text-sm">Trazabilidad</span></a> --}}

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
                        <div class="tab-pane" id="pendientes" role="tabpanel" aria-labelledby="pendientes-tab">

                            {{-- TABLA CONTESTADAS --}}
                            <div class="col-md-12 pt-4">
                                <div id="container_table" class="table-pagination-govco">
                                    <table id="DataTables_Table_0"
                                        class="table display tablas-rita"
                                        width="100%" style="text-align: left!important;">
                                        <thead>
                                            <tr>
                                                <th style="color: #004884;">Radicado</th>
                                                <th style="color: #004884;">Asunto</th>
                                                <th style="color: #004884;">Tipo de solicitud</th>
                                                <th style="color: #004884;">Detalle</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($deContestada as $denunuciasCON)
                                                <tr>
                                                    <td>{{ $denunuciasCON->radicado }}</td>
                                                    <td>{{ $denunuciasCON->asunto }}</td>
                                                    <td>{{ $denunuciasCON->tipo_solicitud }}</td>

                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a type="button"
                                                                class="btn-symbolic-govco align-column-govco"
                                                                href="{{ route('juridica.rita.detalle', $denunuciasCON->id) }}">
                                                                <span class="govco-icon govco-icon-attached-n"></span>
                                                                <span class="btn-govco-text">Detalle Denuncia</span></a>

                                                            {{-- <a type="button" class="btn-symbolic-govco align-column-govco pl-0 ml-0" href="{{route('tramite.trazabilidad', ['radicado'=>$solicitudesE->radicado , 'tramite' => $tramite] )}}">
                                                                <span class="govco-icon govco-icon-analytic-cn"></span>
                                                                <span class="btn-govco-text text-sm">Trazabilidad</span></a> --}}

                                                        </div>
                                                    </td>

                                                </tr>
                                            @endforeach

                                        </tbody>

                                    </table>

                                </div>
                            </div>
                            {{-- </ TABLA DE PENDIENTES FIN --}}
                        </div>
                        <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                            {{-- TABLA DE REMITIDAS POR COMPETENCIA --}}
                            <div class="col-md-12 pt-4">
                                <div id="container_table" class="table-pagination-govco">
                                    <table id="DataTables_Table_0"
                                        class="table display table-responsive-md table-responsive-md tablas-rita"
                                        width="100%" style="text-align: left!important;">
                                        <thead>
                                            <tr>
                                                <th style="color: #004884;">Radicado</th>
                                                <th style="color: #004884;">Asunto</th>
                                                <th style="color: #004884;">Tipo de solicitud</th>
                                                <th style="color: #004884;;">Detalle</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($deRemitidas as $denunuciasREM)
                                                <tr>
                                                    <td>{{ $denunuciasREM->radicado }}</td>
                                                    <td>{{ $denunuciasREM->asunto }}</td>
                                                    <td>{{ $denunuciasREM->tipo_solicitud }}</td>

                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a type="button"
                                                                class="btn-symbolic-govco align-column-govco"
                                                                href="{{ route('juridica.rita.detalle', $denunuciasREM->id) }}">
                                                                <span class="govco-icon govco-icon-attached-n"></span>
                                                                <span class="btn-govco-text">Detalle Denuncia</span></a>

                                                            {{-- <a type="button" class="btn-symbolic-govco align-column-govco pl-0 ml-0" href="{{route('tramite.trazabilidad', ['radicado'=>$solicitudesE->radicado , 'tramite' => $tramite] )}}">
                                                                <span class="govco-icon govco-icon-analytic-cn"></span>
                                                                <span class="btn-govco-text text-sm">Trazabilidad</span></a> --}}

                                                        </div>
                                                    </td>

                                                </tr>
                                            @endforeach

                                        </tbody>

                                    </table>

                                </div>
                            </div>
                            {{-- </ TABLA EN REVISION DE PLANEACION FIN --}}
                        </div>
                        <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                            {{-- TABLA NULAS --}}
                            <div class="col-md-12 pt-4">
                                <div id="container_table" class="table-pagination-govco">
                                    <table id="DataTables_Table_0"
                                        class="table display table-responsive-md table-responsive-md tablas-rita"
                                        width="100%" style="text-align: left!important;">
                                        <thead>
                                            <tr>
                                                <th style="color: #004884;">Radicado</th>
                                                <th style="color: #004884;">Asunto</th>
                                                <th style="color: #004884;">Tipo de solicitud</th>
                                                <th style="color: #004884;;">Detalle</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($deNoContestada as $denunuciasNUL)
                                                <tr>
                                                    <td>{{ $denunuciasNUL->radicado }}</td>
                                                    <td>{{ $denunuciasNUL->asunto }}</td>
                                                    <td>{{ $denunuciasNUL->tipo_solicitud }}</td>

                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a type="button"
                                                                class="btn-symbolic-govco align-column-govco"
                                                                href="{{ route('juridica.rita.detalle', $denunuciasNUL->id) }}">
                                                                <span class="govco-icon govco-icon-attached-n"></span>
                                                                <span class="btn-govco-text">Detalle Denuncia</span></a>

                                                            {{-- <a type="button" class="btn-symbolic-govco align-column-govco pl-0 ml-0" href="{{route('tramite.trazabilidad', ['radicado'=>$solicitudesE->radicado , 'tramite' => $tramite] )}}">
                                                            <span class="govco-icon govco-icon-analytic-cn"></span>
                                                            <span class="btn-govco-text text-sm">Trazabilidad</span></a> --}}

                                                        </div>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            {{-- </ TABLA DE REVISADAS PLANEACION FIN --}}
                        </div>

                    </div>
                    <div class="col-md-3">
                        <a class="btn btn-round btn-high" href="{{ URL::route('juridica.rita.main') }}"
                            style="float: left;">Volver</a>
                    </div>
                </div>





            </div>
        </div>



    </div>
@endsection
