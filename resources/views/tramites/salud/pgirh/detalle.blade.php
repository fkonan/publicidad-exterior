@extends('layouts.menu')

@section('dashboard')
<style>
    th.sorting_desc::after, th.sorting_asc::after{
      right: -16px!important;
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
                                    Salud y Ambiente
                                    
                                    </b></p>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="col-md-12 pt-4">
            <h1 class="headline-xl-govco">Reportes RH1</h1>
            <div class="row pt-5">
                <div class="col-md-12 justify-content-center">

                    <div class="card govco-card animate__animated animate__bounceInRight">
                        <div class="card-header govco-card-header">
                            <span class="govco-icon govco-icon-building size-2x pr-3"> </span>
                            @if(count($reportes))
                            {{$reportes[0]->razon_social}}
                            @endif
                        </div>

                        <div class="col-md-12 justify-content-center pt-4">
                            <div id="container_table" class="table-pagination-govco">

                                <table id="DataTables_Table_0"
                                    class="table display table-responsive-sm table-responsive-md tablas-pgirh" width="100%"
                                    style="text-align: left!important;">
                                    <thead>
                                        <tr>
                                            <th class="d-none">id</th>
                                            <th style="color: #004884;" class="">Gestor de residuos</th>
                                            <th style="color: #004884;">Solicitante</th>                                          
                                            <th style="color: #004884;">Sede</th>                                          
                                            <th style="color: #004884;">Direccion</th>                                          
                                            <th style="color: #004884;">Año del reporte</th>
                                            <th style="color: #004884;">Semestre del Reporte</th>
                                            <th style="color: #004884;">Acta de disposición</th>
                                            <th style="color: #004884;">Fecha de Registro</th>
                                            <th style="color: #004884;">Acciones</th>

                                        </tr>
                                    </thead>
                                    @foreach ($reportes as $reporte)
                                    <tr>
                                        <td class="d-none">{{$reporte->id}}</td>
                                       <td>{{$reporte->gestor_residuos}}</td>
                                       <td>{{$reporte->nombre_solicitante}}</td>
                                       <td>{{($reporte->nombre_sede)? $reporte->nombre_sede: 'SIN SEDE'}}</td>
                                       <td>{{($reporte->direccion)? $reporte->direccion: $reporte->direccion_empresa}}</td>
                                        <td>{{$reporte->year}}</td>
                                       <td>{{$reporte->semestre}}</td>
                                       <td><a href="https://pgirh.bucaramanga.gov.co/{{$reporte->ruta_acta_disposicion}}" target="_blank" class="btn-symbolic-govco" role="button">
                                        <span class="govco-icon govco-icon-document-n"></span>
                                        <span class="btn-govco-text textright-govco">Documento</span>
                                    </a></td>
                                       <td>{{$reporte->created_at}}</td>
                                       <td>
                                        <div class="btn-group" role="group">
                                            <a type="button" class="btn-symbolic-govco align-column-govco" href="{{route('salud.pgirh.detalle', ['id'=>$reporte->id, 'empresa'=>$reporte->razon_social, 'nit' => $reporte->nit, 'gestor'=>$reporte->gestor_residuos, 'sede'=> ($reporte->nombre_sede)? $reporte->nombre_sede : 'SIN SEDE' ])}}">
                                                <span class="govco-icon govco-icon-statistics-n"></span>
                                                <span class="btn-govco-text">Exportar Excel</span></a>
                                        </div>
                                       </td>

                                    </tr>
                                        
                                    @endforeach


                                    </tbody>

                                </table>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <a class="btn btn-round btn-high" href="{{ URL::route('salud.pgirh.index') }}" style="float: left;">Volver</a>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
    </div>

    </div>     

@endsection
