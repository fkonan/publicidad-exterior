@extends('layouts.menu')

@section('dashboard')
    <style>
        th.sorting_desc::after,
        th.sorting_asc::after {
            right: 0 !important;
            content: "" !important;
        }
        .btnpdf{
       background-color: #5A945E;
       border: #5A945E;
       border-radius: 5px;
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
            <h1 class="headline-xl-govco">Obtener Reportes</h1>
            <div class="row pt-5">
                <div class="tabs-govco col-md-12 animate__animated animate__bounceInRight">

                    <div class="col-md-12 pt-4">
                        <div id="container_table" class="table-pagination-govco">
                            <table id="DataTables_Table_0"
                                class="table display table-responsive-md table-responsive-md tablas_export-rita" width="100%"
                                style="text-align: left!important;">
                                <thead>
                                    <tr>
                                        <th style="color: #004884;">Radicado</th>
                                        <th style="color: #004884;">Asunto</th>
                                        <th style="color: #004884;">Estado</th>
                                        <th style="color: #004884;">Medio de Respuesta</th>
                                        <th style="color: #004884;" class="d-none">tipo de solicitud</th>
                                        <th style="color: #004884;" class="d-none">tipo de persona</th> 
                                        <th style="color: #004884;" class="d-none">tipo de documento</th> 
                                        <th style="color: #004884;" class="d-none">identificación</th> 
                                        <th style="color: #004884;" class="d-none">nombres</th> 
                                        <th style="color: #004884;" class="d-none">apellidos</th> 
                                        <th style="color: #004884;" class="d-none">razon social</th> 
                                        <th style="color: #004884;" class="d-none">telefono movil</th> 
                                        <th style="color: #004884;" class="d-none">telefono fijo</th> 
                                        <th style="color: #004884;" class="d-none">direccion</th> 
                                        <th style="color: #004884;" class="d-none">barrio</th> 
                                        <th style="color: #004884;" class="d-none">email</th> 
                                        <th style="color: #004884;" class="d-none">pais</th> 
                                        <th style="color: #004884;" class="d-none">departamento</th> 
                                        <th style="color: #004884;" class="d-none">municipio</th> 
                                        <th style="color: #004884;" class="d-none">Lugar de la denuncia</th> 
                                        <th style="color: #004884;" class="d-none">Cuando Ocurrio la denuncia</th> 
                                        <th style="color: #004884;" class="d-none">Involucrados de la denuncia</th> 
                                        <th style="color: #004884;" class="d-none">Hechos</th> 
                                        
                                        <th style="color: #004884;" class="d-none">Existe algun riesgo</th> 
                                        <th style="color: #004884;" class="d-none">Es un proceso de seleccion</th> 
                                        <th style="color: #004884;" class="d-none">Tipo de contrato</th> 
                                        <th style="color: #004884;" class="d-none">Informacion del contrato</th> 
                                       <th style="color: #004884;" class="d-none">Fecha aproximada del contrato</th> 
                                        <th style="color: #004884;" class="d-none">Lugar del Contrato</th> 
                                        <th style="color: #004884;" class="d-none">Entidad del Contrato</th> 
                                        <th style="color: #004884;" class="d-none">Link Secop</th> 
                                        <th style="color: #004884;" class="d-none">Tiene evidencias</th> 
                                        <th style="color: #004884;" class="d-none">Ha denunciado Anteriormente</th> 
                                        <th style="color: #004884;" class="d-none">Entidad donde ha denunciado</th> 
                                        <th style="color: #004884;" class="d-none">Otra Entidad</th> 
                                        <th style="color: #004884;" class="d-none">Como impacta a su organizacion</th> 
                                        <th style="color: #004884;" class="d-none">Contacto Adicional</th> 
                                        <th style="color: #004884;" class="d-none">Lo han Intentado disuadir</th> 
                                        <th style="color: #004884;" class="d-none">Quien lo disuade</th> 
                                        <th style="color: #004884;" class="d-none">Fecha limite de respuesta</th>                                         
                                        <th style="color: #004884;" class="d-none">Observaciones</th> 
                                        <th style="color: #004884;;">Detalle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($query as $rita)
                                        <tr>
                                            <td>{{ $rita->radicado }}</td>
                                            <td>{{ $rita->asunto }}</td>
                                            <td>{{ $rita->estado_solicitud }}</td>
                                            <td>{{ $rita->medio_respuesta }}</td>  

                                            <td class="d-none">{{ $rita->tipo_solicitud }}</td>    
                                            <td class="d-none">{{$rita->tipo_persona}}</td> 
                                            <td class="d-none">{{$rita->tipo_doc}}</td> 
                                            <td class="d-none">{{$rita->identificacion}}</td> 
                                            <td class="d-none">{{$rita->nombres}}</td> 
                                            <td class="d-none">{{$rita->apellidos}}</td> 
                                            <td class="d-none">{{$rita->razon_social}}</td> 
                                            <td class="d-none">{{$rita->telefono_movil}}</td> 
                                            <td class="d-none">{{$rita->telefono_fijo}}</td> 
                                            <td class="d-none">{{$rita->direccion}}</td> 
                                            <td class="d-none">{{$rita->barrio}}</td> 
                                            <td class="d-none">{{$rita->email_responsable}}</td> 
                                            <td class="d-none">{{$rita->pais}}</td> 
                                            <td class="d-none">{{$rita->departamento}}</td> 
                                            <td class="d-none">{{$rita->municipio}}</td> 
                                            <td class="d-none">{{$rita->lugar_denuncia}}</td> 
                                            <td class="d-none">{{$rita->cuando_denuncia}}</td> 
                                            <td class="d-none">{{$rita->involucrados_denuncia}}</td> 
                                            <td class="d-none">{{$rita->descripcion_hechos}}</td>                                            
                                            <td class="d-none">{{$rita->riesgo_denuncia}}</td> 
                                            <td class="d-none">{{$rita->proceso_seleccion}}</td> 
                                            <td class="d-none">{{$rita->tipo_contrato}}</td> 
                                            <td class="d-none">{{$rita->informacion_contrato}}</td>
                                            <td class="d-none">{{$rita->fecha_aprox_proceso}}</td> 
                                            <td class="d-none">{{$rita->lugar_contrato}}</td> 
                                            <td class="d-none">{{$rita->entidad_contrato}}</td> 
                                            <td class="d-none">{{$rita->link_contrato}}</td> 
                                            <td class="d-none">{{$rita->tiene_evidencias}}</td> 
                                            <td class="d-none">{{$rita->ha_denunciado}}</td> 
                                            <td class="d-none">{{$rita->entidad_denuncia}}</td> 
                                            <td class="d-none">{{$rita->otra_entidad}}</td> 
                                            <td class="d-none">{{$rita->impacta_organizacion}}</td> 
                                            <td class="d-none">{{$rita->contacto_adicional}}</td> 
                                            <td class="d-none">{{$rita->disuadirlo}}</td> 
                                            <td class="d-none">{{$rita->quien_disuade}}</td> 
                                            <td class="d-none">{{$rita->fecha_limite}}</td>	
                                            <td class="d-none">{{$rita->observaciones_solicitud}}</td>                                      
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a type="button" class="btn-symbolic-govco align-column-govco" href="{{route('juridica.rita.detalle', $rita->id)}}">Ver Denuncia</a>   
                                                     
                                                
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>

                        </div>
                    </div>
                    
                <div class="col-md-3 pl-0 mr-0">
                    <a class="btn btn-round btn-high" href="{{ URL::route('juridica.rita.reporte') }}"
                        style="float: left;">Volver</a>
                </div>

                </div>
                  

                    
                </div>





            </div>
        </div>



    </div>
@endsection
