@extends('layouts.menu')

@section('dashboard')
<style>
    th.sorting_desc::after, th.sorting_asc::after{
      right: -16px!important;
   }
   .btnpdf{
       background-color: #004fbf;
       border: #004fbf;
       border-radius: 5px;
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
                                <a style="color: #004fbf;" class="breadcrumb-text" href="#">Tramites y servicios</a>
                            </div>
                        </li>
                        <li class="breadcrumb-item ">
                            <div class="image-icon">
                                <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                                <p class="ml-3 ml-md-0 "><b style="color: #004fbf;text-transform: none;">
                                    Trazabilidad
                                    </b></p>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="col-md-12 pt-4">
            <h1 class="headline-xl-govco">Consulta de Solicitud</h1>
            <div class="row pt-5">
                <div class="col-md-12 justify-content-center">

                    <div class="card govco-card animate__animated animate__bounceInRight">
                        <div class="card-header govco-card-header">
                            <span class="govco-icon govco-icon-analytic size-3x pr-3"> </span>
                         Trazabilidad de la Solicitud
                        </div>

                        <div class="col-md-12 justify-content-center pt-4">
                            <div id="container_table" class="table-pagination-govco">

                                <table id="DataTables_Table_0"
                                    class="table display table-responsive-sm table-responsive-md tablas_export" width="100%"
                                    style="text-align: left!important;">
                                    <thead>
                                        <tr>
                                            <th style="color: #004884;" class="">Radicado</th>
                                            <th style="color: #004884;">Usuario-Ciudadano</th>                                            
                                            <th style="color: #004884;">Proceso afectado</th>
                                            <th style="color: #004884;;">Tramite</th>
                                            <th style="color: #004884;">Acción Realizada</th>
                                            <th style="color: #004884;">Observación</th>
                                            <th style="color: #004884;">Fecha de Acción</th>
                                            

                                        </tr>
                                    </thead>
                                    @foreach ($traza as $solicitud)
                                    <tr>
                                       <td>{{$solicitud->radicado}}</td>
                                       <td>{{$solicitud->usuario}} </td>
                                       <td>{{$solicitud->proceso_afectado}}</td>
                                       <td>{{$solicitud->tramite}}</td>
                                       <td>{{$solicitud->accion}}</td>
                                       <td>{{$solicitud->observacion}}</td>
                                       <td>{{$solicitud->created_at}}</td>                                       

                                    </tr>
                                        
                                    @endforeach


                                    </tbody>

                                </table>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <input type="hidden" name="radicado" id="radicado" value="{{$traza[0]->radicado}}">
                            <a class="btn btn-round btn-high" href="javascript:history.back();" style="float: left;">Volver</a>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
    </div>

    </div>     

@endsection


