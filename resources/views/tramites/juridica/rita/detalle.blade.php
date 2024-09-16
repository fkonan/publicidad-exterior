@extends('layouts.menu')

@section('dashboard')
    <style>
        .loader {
            position: relative;
            text-align: center;
            margin: 15px auto 35px auto;
            z-index: 9999;
            display: block;
            width: 80px;
            height: 80px;
            border: 10px solid rgba(0, 0, 0, .3);
            border-radius: 50%;
            border-top-color: #004884;
            animation: spin 1s ease-in-out infinite;
            -webkit-animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                -webkit-transform: rotate(360deg);
            }
        }

        @-webkit-keyframes spin {
            to {
                -webkit-transform: rotate(360deg);
            }
        }
    </style>

    <div class="container mt-3 mb-4 m-xs-x-3 ">

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
                                    Jurídica</a>
                            </div>
                        </li>
                        <li class="breadcrumb-item ">
                            <div class="image-icon">
                                <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                                <p class="ml-3 ml-md-0 "><b style="color: #004fbf;text-transform: none;">
                                        Canala de denuncias (RITA)
                                    </b></p>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="col-md-12 pt-4">
            <h1 class="headline-xl-govco">Administración Solicitud</h1>
            <div class="row pt-5">
                <div class="col-md-12 justify-content-center">

                    <div class="card govco-card animate__animated animate__bounceInRight">
                        <div class="card-header govco-card-header">
                            <span class="govco-icon govco-icon-analytic size-3x pr-3"> </span>
                            Seguimiento de la Denuncia
                        </div>

                        <div class="col-md-12 justify-content-center pt-4">

                            <div class="tabs-govco col-md-12 animate__animated animate__bounceInRight">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home"
                                            role="tab" aria-controls="home" aria-selected="true">Información General
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile"
                                            role="tab" aria-controls="profile" aria-selected="false">Informacion
                                            Especifica</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages"
                                            role="tab" aria-controls="messages" aria-selected="false">Trazabilidad</a>
                                    </li>
                                    @if($solicitud[0]->estado_solicitud == 'RADICADA')
                                    <li class="nav-item">
                                        <a class="nav-link" id="admin-tab" data-toggle="tab" href="#admin" role="tab"
                                            aria-controls="messages" aria-selected="false">Administración</a>
                                    </li>
                                    @endif

                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        {{-- TABLA DE ENVIADOS --}}
                                        <div class="col-md-12 pt-4">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <p><strong>Radicado:</strong><br>
                                                        {{ $solicitud[0]->radicado }}</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p><strong>Tipo de Solicitud:</strong><br>
                                                        {{ $solicitud[0]->tipo_solicitud }}</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p><strong>Tipo de Persona:</strong><br>
                                                        {{ $solicitud[0]->tipo_persona ? $solicitud[0]->tipo_persona : 'NO REGISTRA' }}
                                                    </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p><strong>Numero de Identificacion:</strong><br>
                                                        {{ $solicitud[0]->identificacion ? $solicitud[0]->identificacion : 'NO REGISTRA' }}
                                                    </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p><strong>Nombres y/o Razon Social:</strong><br>
                                                        {{ $solicitud[0]->razon_social ? $solicitud[0]->razon_social : $solicitud[0]->nombres . ' ' . $solicitud[0]->apellidos }}
                                                    </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p><strong>Telefono Movil:</strong><br>
                                                        {{ $solicitud[0]->telefono_movil ? $solicitud[0]->telefono_movil : 'NO REGISTRA' }}
                                                    </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p><strong>Telefono Fijo:</strong><br>
                                                        {{ $solicitud[0]->telefono_fijo ? $solicitud[0]->telefono_fijo : 'NO REGISTRA' }}
                                                    </p>
                                                </div>
                                                <div class="col-md-8">
                                                    <p><strong>Direccion:</strong><br>
                                                        {{ $solicitud[0]->direccion ? $solicitud[0]->direccion . ' ' . $solicitud[0]->barrio : 'NO REGISTRA' }}
                                                    </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p><strong>Correo Electronico:</strong><br>
                                                        {{ $solicitud[0]->email_responsable ? $solicitud[0]->email_responsable : 'NO REGISTRA' }}
                                                    </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p><strong>Departamento:</strong><br>
                                                        {{ $solicitud[0]->departamento ? $solicitud[0]->departamento : 'NO REGISTRA' }}
                                                    </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p><strong>Municipio:</strong><br>
                                                        {{ $solicitud[0]->municipio ? $solicitud[0]->municipio : 'NO REGISTRA' }}
                                                    </p>
                                                </div>
                                            </div>

                                            {{-- </ TABLA DE ENVIADOS FIN --}}
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        {{-- tabla de garantia entregada --}}

                                        <div class="row">
                                            <div class="col-md-6">
                                                <p><strong>Asunto:</strong><br>
                                                    {{ $solicitud[0]->asunto }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><strong>¿Dónde fue el lugar de la irregularidad?</strong><br>
                                                    {{ $solicitud[0]->lugar_denuncia }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><strong>¿Cuándo ocurrieron los hechos?</strong><br>
                                                    {{ $solicitud[0]->cuando_denuncia ? $solicitud[0]->cuando_denuncia : 'NO REGISTRA' }}
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><strong>¿Quiénes estan involucrados?</strong><br>
                                                    {{ $solicitud[0]->identificacion ? $solicitud[0]->involucrados_denuncia : 'NO REGISTRA' }}
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><strong>Descripcion de los hechos:</strong><br>
                                                    {{ $solicitud[0]->descripcion_hechos ? $solicitud[0]->descripcion_hechos : 'NO REGISTRA' }}
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><strong>Documento Adjunto:</strong><br>
                                                    @if ($solicitud[0]->adj_descripcion != null)
                                                        <a href="https://canaldenuncia.bucaramanga.gov.co/{{ $solicitud[0]->adj_descripcion }}"
                                                            target="_blank">Descargar documento</a>&nbsp;&nbsp;<i
                                                            class="fa fa-download"></i>
                                                    @else
                                                        NO REGISTRA
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><strong>Existe algún riesgo para usted o para los demás</strong><br>
                                                    {{ $solicitud[0]->riesgo_denuncia ? $solicitud[0]->riesgo_denuncia : 'NO REGISTRA' }}
                                                </p>
                                            </div>

                                            @if ($solicitud[0]->proceso_seleccion == 'SI')
                                                <div class="col-md-4">
                                                    <p><strong>Tipo de contrato:</strong><br>
                                                        {{ $solicitud[0]->tipo_contrato ? $solicitud[0]->tipo_contrato : 'NO REGISTRA' }}
                                                    </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p><strong>Información que permita identificar el proceso de selección o
                                                            el contrato</strong><br>
                                                        {{ $solicitud[0]->informacion_contrato ? $solicitud[0]->informacion_contrato : 'NO REGISTRA' }}
                                                    </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p><strong>Documento Adjunto:</strong><br>
                                                        @if ($solicitud[0]->adj_informacion != null)
                                                            <a href="https://canaldenuncia.bucaramanga.gov.co/{{ $solicitud[0]->adj_informacion }}"
                                                                target="_blank">Descargar documento</a>&nbsp;&nbsp;<i
                                                                class="fa fa-download"></i>
                                                        @else
                                                            NO REGISTRA
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p><strong>Fecha Aproximada:</strong><br>
                                                        {{ $solicitud[0]->fecha_aprox_proceso ? $solicitud[0]->fecha_aprox_proceso : 'NO REGISTRA' }}
                                                    </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p><strong>Lugar de ejecución del contrato:</strong><br>
                                                        {{ $solicitud[0]->lugar_contrato ? $solicitud[0]->lugar_contrato : 'NO REGISTRA' }}
                                                    </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p><strong>Entidad contratante:</strong><br>
                                                        {{ $solicitud[0]->entidad_contrato ? $solicitud[0]->entidad_contrato : 'NO REGISTRA' }}
                                                    </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p><strong>link del secop II o referencia del proceso</strong><br>
                                                        {{ $solicitud[0]->link_contrato ? $solicitud[0]->link_contrato : 'NO REGISTRA' }}
                                                    </p>
                                                </div>
                                            @else
                                                <div class="col-md-4">
                                                    <p><strong>Proceso de selección:</strong><br>
                                                        {{ $solicitud[0]->proceso_seleccion }}</p>
                                                </div>
                                            @endif

                                            @if ($solicitud[0]->tiene_evidencias == 'SI')
                                                <div class="col-md-6 pb-2">
                                                    <p><strong>Evidencias Anexas:</strong></p>
                                                    @foreach ($anexos as $anexo)
                                                        @if ($anexo->titulo == 'Anexos')
                                                            <a href="https://canaldenuncia.bucaramanga.gov.co/{{ $anexo->ruta }}"
                                                                target="_blank">{{ $anexo->nombre_archivo }}</a>&nbsp;&nbsp;<i
                                                                class="fa fa-download"></i><br>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="col-md-6">
                                                    <p><strong>Evidencias Denuncia:</strong><br>
                                                        {{ $solicitud[0]->tiene_evidencias }}</p>
                                                </div>
                                            @endif


                                            @if ($solicitud[0]->ha_denunciado == 'SI')
                                                <div class="col-md-4">
                                                    <p><strong>Entidad en la que ha denunciado:</strong><br>
                                                        {{ $solicitud[0]->entidad_denuncia ? $solicitud[0]->entidad_denuncia : 'NO REGISTRA' }}
                                                    </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p><strong>Otra entidad:</strong><br>
                                                        {{ $solicitud[0]->otra_entidad ? $solicitud[0]->otra_entidad : 'NO REGISTRA' }}
                                                    </p>
                                                </div>
                                            @else
                                                <div class="col-md-6">
                                                    <p><strong>Ha denunciado anteriormente:</strong><br>
                                                        {{ $solicitud[0]->ha_denunciado }}</p>
                                                </div>
                                            @endif
                                            <div class="col-md-6">
                                                <p><strong>Cómo impacta a la organización desde su punto de
                                                        vista:</strong><br>
                                                    {{ $solicitud[0]->impacta_organizacion ? $solicitud[0]->impacta_organizacion : 'NO REGISTRA' }}
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><strong>Contacto Adicional:</strong><br>
                                                    {{ $solicitud[0]->contacto_adicional ? $solicitud[0]->contacto_adicional : 'NO REGISTRA' }}
                                                </p>
                                            </div>

                                            @if ($solicitud[0]->disuadirlo == 'SI')
                                                <div class="col-md-4">
                                                    <p><strong>Quien intenta disuadir:</strong><br>
                                                        {{ $solicitud[0]->quien_disuade ? $solicitud[0]->quien_disuade : 'NO REGISTRA' }}
                                                    </p>
                                                </div>
                                            @else
                                                <div class="col-md-4">
                                                    <p><strong>Alguien ha tratado de ocultar esto o disuadirlo de
                                                            denunciar:</strong><br>
                                                        {{ $solicitud[0]->disuadirlo }}</p>
                                                </div>
                                            @endif


                                        </div>

                                    </div>

                                    <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                                        {{-- TABLA DE PENDIENTES --}}
                                        <div class="row">

                                            <div class="col-md-6">
                                                <p><strong>Estado Denuncia:</strong><br>
                                                    <span
                                                        class="headline-l-govco">{{ $solicitud[0]->estado_solicitud }}</span>
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><strong>Observaciones</strong>:</strong><br>
                                                    {{ $solicitud[0]->observaciones_solicitud ? $solicitud[0]->observaciones_solicitud : 'NO REGISTRA' }}
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><strong>Medio de Respuesta</strong>:</strong><br>
                                                    {{ $solicitud[0]->medio_respuesta ? $solicitud[0]->medio_respuesta : 'NO REGISTRA' }}
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><strong>Fecha limite de respuesta</strong>:</strong><br>
                                                    {{ $solicitud[0]->fecha_limite ? $solicitud[0]->fecha_limite : 'NO REGISTRA' }}
                                                </p>
                                            </div>

                                            @if (!$respuestas->isEmpty())
                                            <div class="col-md-6 pb-2">
                                                <p><strong>Adjuntos de Respuesta:</strong></p>
                                                @foreach ($respuestas as $respuesta)
                                                    
                                                        <a href="/{{ $respuesta->ruta }}"
                                                            target="_blank">{{ $respuesta->nombre_archivo }}</a>&nbsp;&nbsp;<i
                                                            class="fa fa-download"></i><br>
                                                   
                                                @endforeach
                                            </div>
                                        @endif

                                            <div class="col-md-12">
                                                <p>
                                                <p><strong>Acciones</strong>:</strong></p>

                                                <table id="DataTables_Table_0" class="table display table-responsive-md"
                                                    width="100%" style="text-align: left!important;">
                                                    <thead>
                                                        <tr>
                                                            <th style="color: #004884;">Acción</th>
                                                            <th style="color: #004884;">Observación</th>
                                                            <th style="color: #004884;">Fecha</th>

                                                    </thead>
                                                    <tbody>
                                                        @foreach ($trazabilidad as $traza)
                                                            <tr>
                                                                <td>{{ $traza->accion }}</td>
                                                                <td>{{ $traza->observacion }}</td>
                                                                <td>{{ $traza->created_at }}</td>

                                                            </tr>
                                                        @endforeach

                                                    </tbody>

                                                </table>
                                            </div>

                                           

                                        </div>
                                        {{-- </ TABLA DE PENDIENTE FIN --}}
                                    </div>

                                    <div class="tab-pane" id="admin" role="tabpanel" aria-labelledby="admin-tab">
                                        {{-- TABLA DE PENDIENTES --}}
                                        <form class="myFormDefault" method="#" action=""
                                            enctype="multipart/form-data" id="myFormRita">
                                            @csrf

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="estado">Cambiar Estado de la solicitud*</label>
                                                        <select
                                                            class="form-control  @error('estado_solicitud') is-invalid @enderror"
                                                            name="estado_solicitud" id="estado_rita" required>
                                                            <option value="">Seleccione</option>
                                                            <option value="CONTESTADA">ATENDIDA</option>
                                                            <option value="REMITIDA POR COMPETENCIA">REMITIR POR
                                                                COMPETENCIA</option>
                                                            <option value="NO CONTESTADA">RECHAZAR</option>

                                                        </select>
                                                        @error('estado_solicitud')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong class="text-danger">{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label for="observaciones">Observaciones*</label>
                                                        <textarea name="observaciones_solicitud" id="observaciones_rita" onkeypress="return Direccion(event)"
                                                            maxlength="1000" class="form-control  @error('observaciones_solicitud') is-invalid @enderror" cols="3"
                                                            rows="7" style="resize:none" required></textarea>
                                                        @error('observaciones_solicitud')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong class="text-danger">{{ $message }}</strong>
                                                            </span>
                                                        @enderror


                                                    </div>
                                                </div>

                                                <div class="col-md-8 pl-1 pr-1 pt-1">
                                                    <p class="pl-2"><strong>Documentos Adjuntos de
                                                            Respuesta:</strong><br></p>
                                                    <div id="top">
                                                        <div class="alert alert-danger print-error-msg alert-dismissible fade show"
                                                            style="display:none" role="alert">
                                                            <button type="button" class="close" data-dismiss="alert"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span></button>
                                                            <ul></ul>
                                                        </div>
                                                    </div>
                                                    <label for="attachment">
                                                        <a class="btn btn-round btn-middle btn-outline-info"
                                                            role="button" aria-disabled="false">+ Añadir Archivos</a>

                                                    </label>
                                                    <input type="file" name="evidencias[]"
                                                        accept="application/pdf,.doc,.docx,.png, .jpg, .jpegapplication/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                                                        id="attachment" style="visibility: hidden; position: absolute;"
                                                        class="info_evidencias" multiple />

                                                    </p>
                                                    <div id="files-area">
                                                        <span id="filesList">
                                                            <span id="files-names"></span>
                                                        </span>
                                                    </div>
                                                    @error('evidencias')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="hidden" class="estado_actual" id="estado_rita"
                                                            value="{{ $solicitud[0]->estado_solicitud }}">

                                                        <input type="hidden" name="id"
                                                            value="{{ $solicitud[0]->id }}">
                                                        <button type="submit"
                                                            onclick="return confirm('¿Esta seguro de generar esta respuesta ?')"
                                                            id="myBtnRita"
                                                            class="btn btn-round btn-high-mix-govco float-right">Actualizar estado</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <a class="btn btn-round btn-high" href="{{ URL::route('juridica.rita.index') }}"
                                style="float: left;">Volver</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    @push('rita-js')
        <script type="text/javascript" src="{{ asset('js/rita.js') }}"></script>
    @endpush

    {{-- modal de carga --}}
    <div class="modal fade" id="loadMe" tabindex="-1" role="dialog" aria-labelledby="loadMeLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="loader"></div>
                    <div clas="loader-txt">
                        <p>Enviando solicitud <br><br><small>Por favor espere...
                            </small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
