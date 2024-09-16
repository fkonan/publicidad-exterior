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
                                <a style="color: #004fbf;" class="breadcrumb-text" href="#">Tramites en Linea</a>
                            </div>
                        </li>
                        <li class="breadcrumb-item ">
                            <div class="image-icon">
                                <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                                <a style="color: #004fbf;" class="breadcrumb-text" href="{{ route('utsp.index') }}">UTSP</a>
                            </div>
                        </li>
                        <li class="breadcrumb-item ">
                            <div class="image-icon">
                                <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                                <a style="color: #004fbf;" class="breadcrumb-text" href="{{ route('utsp.reportes') }}">REPORTES UTSP</a>
                            </div>
                        </li>
                        <li class="breadcrumb-item ">
                            <div class="image-icon">
                                <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                                <p class="ml-3 ml-md-0 "><b style="color: #004fbf;text-transform: none;">
                                        Extraer Reportes
                                    </b></p>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
          </div>
        <div class="col-md-12 pt-4" style="padding-left: 10px!important">
            <h1 class="headline-xl-govco">Descargar Reportes UTSP</h1>
            <div class="row pt-5">
                <div class="tabs-govco col-md-12 animate__animated animate__bounceInRight">

                    <div class="col-md-12 pt-4">
                        <div id="container_table" class="table-pagination-govco">
                            <table id="DataTables_Table_0"
                                class="table display table-responsive-md table-responsive-md tablas-export-UTSP" width="100%"
                                style="text-align: left!important;">
                                <thead>
                                    <tr>
                                        <th style="color: #004884;">Radicado</th>
                                        <th style="color: #004884;">Nombres</th>
                                        <th style="color: #004884;">Apellidos</th>
                                        <th style="color: #004884;">Documento</th>
                                        <th style="color: #004884;">Asunto</th>
                                        <th style="color: #004884;">Fecha</th>
                                        <th style="color: #004884;" class="d-none">Tipo de documento</th>
                                        <th style="color: #004884;" class="d-none">Correo </th>
                                        <th style="color: #004884;" class="d-none">Telefono</th>
                                        <th style="color: #004884;" class="d-none">Direccion</th>
                                        <th style="color: #004884;" class="d-none">Barrio</th>
                                        <th style="color: #004884;" class="d-none">Comuna</th>
                                        <th style="color: #004884;" class="d-none">Tipo de Empresa</th>
                                        <th style="color: #004884;" class="d-none">Tipo de Servicio</th>
                                        <th style="color: #004884;" class="d-none">Empresa</th>
                                        <th style="color: #004884;" class="d-none">Usuario</th>                                      
                                        <th style="color: #004884;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($atencion as $solicitud)
                                        <tr>
                                            <td>{{ $solicitud->radicado }}</td>
                                            <td>{{ $solicitud->nombre_usuario }}</td>
                                            <td>{{ $solicitud->apellido_usuario }}</td>
                                            <td>{{ $solicitud->numero_documento }}</td>
                                            <td>{{ $solicitud->asunto}}</td>
                                            <td>{{ $solicitud->fecha_radicacion }}</td>
                                            <td class="d-none">{{ $solicitud->tipo_documento }}</td>
                                            <td class="d-none">{{ $solicitud->correo_electronico }}</td>
                                            <td class="d-none">{{ $solicitud->telefono }}</td>
                                            <td class="d-none">{{ $solicitud->direccion }}</td>
                                            <td class="d-none">{{ $solicitud->nombre_barrio }}</td>
                                            <td class="d-none">{{ $solicitud->comuna }}</td>
                                            <td class="d-none">{{ $solicitud->tipo_atencion }}</td>
                                            <td class="d-none">{{ $solicitud->tipo_servicio }}</td>                                            
                                            <td class="d-none">{{ $solicitud->empresa_publica }}</td>
                                            <td class="d-none">{{ $solicitud->username }}</td>
                                            
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a type="button" class="btn btn-link p-0"
                                                        href="{{ route('utsp.search.caso', $solicitud->id) }}" title="Ver Solicitud">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="#0e0af0" d="M8.95 11.8L6.525 9.4l1.05-1.05l1.35 1.35l2.5-2.5l1.05 1.05L8.95 11.8ZM19.6 21l-6.3-6.3q-.75.6-1.725.95T9.5 16q-2.725 0-4.612-1.888T3 9.5q0-2.725 1.888-4.612T9.5 3q2.725 0 4.613 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l6.3 6.3l-1.4 1.4ZM9.5 14q1.875 0 3.188-1.312T14 9.5q0-1.875-1.312-3.187T9.5 5Q7.625 5 6.313 6.313T5 9.5q0 1.875 1.313 3.188T9.5 14Z"/></svg></a>
                                                    <a type="button" class="btn btn-link p-0"
                                                        href="{{ route('utsp.document', $solicitud->id) }}" title="Descargar Formato PDF" target="_blank">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="#dc0404" d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2m-9.5 8.5c0 .8-.7 1.5-1.5 1.5H7v2H5.5V9H8c.8 0 1.5.7 1.5 1.5v1m5 2c0 .8-.7 1.5-1.5 1.5h-2.5V9H13c.8 0 1.5.7 1.5 1.5v3m4-3H17v1h1.5V13H17v2h-1.5V9h3v1.5m-6.5 0h1v3h-1v-3m-5 0h1v1H7v-1Z"/></svg></a>


                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>
                        </div>
                    </div>
                    <div class="col-md-3 pl-0 mr-0">
                        <a class="btn btn-round btn-high" href="{{ URL::route('utsp.reportes') }}"
                            style="float: left;">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('custom-scripts')
    <script>
        $(document).ready(function() {

            $(".tablas-export-UTSP").ready(function() {
        let date = new Date();
        
        $(".tablas-export-UTSP").DataTable({
            dom: "Bfrtip",
            buttons: [{
                extend: "excelHtml5",
                text: '<span class="text-white"> <svg width="18" height="18" viewBox="0 0 24 24" class="text-white"><path fill="currentColor" class="text-white" d="m13.2 12l2.8 4h-2.4L12 13.714L10.4 16H8l2.8-4L8 8h2.4l1.6 2.286L13.6 8H15V4H5v16h14V8h-3l-2.8 4zM3 2.992C3 2.444 3.447 2 3.999 2H16l5 5v13.993A1 1 0 0 1 20.007 22H3.993A1 1 0 0 1 3 21.008V2.992z"/></svg>Exportar</span>',
                className: "btnpdf",
                titleAttr: "Exportar a Excel",
                title: "Reporte UTSP " + date.toDateString(),
                exportOptions: {
                    columns: [ 0,1,2, 3,4,5,6,7,8,9,10,11,12,13,14,15]
                }
            }, ],

            language: {
                sProcessing: "Procesando...",
                sLengthMenu: "Mostrar _MENU_ registros",
                sZeroRecords: "No se encontraron resultados",
                sEmptyTable: "Ningún dato disponible en esta tabla",
                sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
                sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
                sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
                sInfoPostFix: "",
                sSearch: "Buscar:",
                sUrl: "",
                sInfoThousands: ",",
                sLoadingRecords: "Cargando...",
                oPaginate: {
                    sFirst: "Primero",
                    sLast: "Último",
                    sNext: "Siguiente",
                    sPrevious: "Anterior",
                },

                oAria: {
                    sSortAscending: ": Activar para ordenar la columna de manera ascendente",
                    sSortDescending: ": Activar para ordenar la columna de manera descendente",
                },
            },
            responsive: true,
            scrollX: 200,
            scrollCollapse: true,
        });
    });

        });
        </script>
    @endpush

   
@endsection
