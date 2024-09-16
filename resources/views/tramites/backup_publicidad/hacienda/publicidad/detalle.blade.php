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
                                <a style="color: #004fbf;" class="breadcrumb-text" href="#">Tramites en Linea</a>
                            </div>
                        </li>
                        <li class="breadcrumb-item ">
                            <div class="image-icon">
                                <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                                <a style="color: #004fbf;" class="breadcrumb-text" href="#">
                                    Interior</a>
                            </div>
                        </li>
                        <li class="breadcrumb-item ">
                            <div class="image-icon">
                                <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                                <p class="ml-3 ml-md-0 ">
                                    <b style="color: #004fbf;text-transform: none;">
                                        Publicidad Exterior
                                    </b>
                                </p>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="col-md-12 pt-4" style="padding-left: 10px!important">
            <h1 class="headline-xl-govco">Administración Solicitud</h1>
            <div class="row pt-3">
                <div class="table-simple-headblue-govco col-md-12 animate__animated animate__bounceInRight">
                    <table class="table table-responsive-md table-responsive-md">
                        <thead>
                            <tr>
                                <th colspan="3">
                                    Solicitud N° - {{ $solicitud->radicado }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <strong>Radicado N°-&nbsp;<br></strong>{{ $solicitud->radicado }}
                                </td>
                                <td>
                                    <strong>Tipo doc. del solicitante:</strong><br>
                                    {{ $solicitud->tipo_documento }}
                                </td>
                                <td><strong>Número de documento:</strong><br>
                                    {{ $solicitud->numero_documento }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3"><strong>Nombre del solicitante:</strong><br>
                                    {{ $solicitud->nombre_responsable }} {{ $solicitud->apellido_responsable }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="1"><strong>Teléfono/celular:</strong><br>
                                    {{ $solicitud->telefono_responsable }}
                                </td>
                                <td><strong>Correo eletrónico:</strong><br>
                                    {{ $solicitud->email_responsable }}
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><strong>Tipo de publicidad</strong><br>
                                    {{ $solicitud->tipo_publicidad }}
                                </td>
                                <td><strong>Publicidad instalada?</strong>
                                    <br>{{ $solicitud->publicidad_instalada }}
                                </td>
                                <td><strong>Fecha de la instalación</strong>
                                    <br>{{ $solicitud->fecha_instalacion }}
                                </td>
                            </tr>

                            <tr>
                                <td><strong>Número de elementos</strong><br>
                                    {{ $solicitud->numero_elementos }}
                                </td>
                                <td><strong>Ancho de la publicidad</strong><br>
                                    {{ $detalle->ancho_publicidad }}
                                </td>
                                <td><strong>Alto de la publicidad</strong><br>
                                    {{ $detalle->alto_publicidad }}
                                </td>
                            </tr>

                            <tr>
                                <td colspan="3"><strong>Observaciónes medidas de la solicitud</strong><br>
                                    {{ $detalle->observacion_medidas }}
                                </td>
                            </tr>

                            <tr>
                                <td colspan="3"><strong>Dirección o Nomenclatura del aviso</strong><br>
                                    {{ $detalle->ubicacion_aviso }}
                                </td>
                            </tr>

                            <tr>
                                <td colspan="3"><strong>Barrio</strong><br>
                                    {{ $detalle->nombre }}
                                </td>

                            </tr>
                            @switch($solicitud->modalidad)
                                @case('VALLAS')
                                    <tr>
                                        <td><strong>Tipo de valla</strong><br>
                                            {{ $detalle->tipo_valla }}
                                        </td>
                                        <td><strong>Numero de caras</strong><br>
                                            {{ $detalle->numero_caras }}
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Fecha de fijacion de la publicidad</strong><br>
                                            {{ $detalle->fecha_inicial_fijacion }}
                                        </td>
                                        <td><strong>Fechas de retiro de la publicidad</strong><br>
                                            {{ $detalle->fecha_final_fijacion }}
                                        </td>
                                        <td></td>
                                    </tr>
                                @break

                                @case(2)
                                    Second case...
                                @break
                            @endswitch


                            <tr style="background-color:#004884">
                                <td colspan="3" style="background-color:#004884; color:white">Documentos Adjuntos</td>
                            </tr>
                            @switch($solicitud->modalidad)
                                @case('VALLAS')
                                    <tr>
                                        @if ($detalle->adj_certificado_lyt != '')
                                            <td><strong>Certificado de libertad y tradición:</strong><br>
                                                <a href="/{{ $detalle->adj_certificado_lyt }}" target="_blank">Descargar
                                                    documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                                            </td>
                                        @endif
                                        @if ($detalle->adj_camara_comercio != '')
                                            <td><strong>Camara de comercio:</strong><br>
                                                <a href="/{{ $detalle->adj_camara_comercio }}" target="_blank">Descargar
                                                    documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        @if ($detalle->adj_autorizacion_propietarios != '')
                                            <td><strong>Autorización del propietario:</strong><br>
                                                <a href="/{{ $detalle->adj_autorizacion_propietarios }}"
                                                    target="_blank">Descargar documento</a>&nbsp;&nbsp;<i
                                                    class="fa fa-download"></i>
                                            </td>
                                        @endif
                                        @if ($detalle->adj_fotomontaje != '')
                                            <td><strong>Foto montaje o plano:</strong><br>
                                                <a href="/{{ $detalle->adj_fotomontaje }}" target="_blank">Descargar
                                                    documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                                            </td>
                                        @endif
                                       

                                </tr>
                                @if ($detalle->req_poliza != null || $detalle->req_tarjeta_profesional != null || $detalle->req_certi_civil != null)
                                    <tr style="background-color:#004884">
                                        <td colspan="3" style="background-color:#004884; color:white">Requisitos Finales</td>
                                    </tr>

                                    <tr>
                                        @if ($detalle->req_poliza != null)
                                            <td><strong>Polizas de cumplimiento:</strong><br>
                                                <a href="https://tramitesenlineapruebas.bucaramanga.gov.co/{{ $detalle->req_poliza }}"
                                                    target="_blank">Descargar documento</a>&nbsp;&nbsp;<i
                                                    class="fa fa-download"></i>
                                            </td>
                                        @else
                                            <td></td><strong></strong><br> </td>
                                        @endif

                                        @if ($detalle->req_tarjeta_profesional != null)
                                            <td><strong>Tarjeta Profesional Ing. Civil:</strong><br>
                                                <a href="https://tramitesenlineapruebas.bucaramanga.gov.co/{{ $detalle->req_tarjeta_profesional }}"
                                                    target="_blank">Descargar documento</a>&nbsp;&nbsp;<i
                                                    class="fa fa-download"></i>
                                            </td>
                                        @else
                                            <td></td><strong></strong><br> </td>
                                        @endif

                                        @if ($detalle->req_certi_civil != null)
                                            <td><strong>Certificaíon Ing. Civil:</strong><br>
                                                <a href="https://tramitesenlineapruebas.bucaramanga.gov.co/{{ $detalle->req_certi_civil }}"
                                                    target="_blank">Descargar documento</a>&nbsp;&nbsp;<i
                                                    class="fa fa-download"></i>
                                            </td>
                                        @else
                                            <td></td><strong></strong><br> </td>
                                        @endif

                                    </tr>

                                @endif
                                @break
                                @case(2)
                                    Second case...
                                @break
                            @endswitch


                            <tr style="background-color:#004884">
                                <td colspan="3" style="background-color:#004884; color:white">Administración del Tramite
                                </td>
                            </tr>

                            <tr>
                                <td><strong>Estado de la solicitud:</strong><br>
                                    @if ($solicitud->estado_solicitud == 'ENVIADA')
                                        <p style="color: #069169;font-weight:bold">ENVIADA<span
                                                class="govco-icon govco-icon-check-p size-1x"></span></p>
                                    @elseif($solicitud->estado_solicitud == 'PENDIENTE')
                                        <p style="color: #3772FF;font-weight:bold">PENDIENTE<span
                                                class="govco-icon govco-icon-eye-p size-1x"></span></p>
                                    @elseif($solicitud->estado_solicitud == 'REVISION-CONCEPTOS-PLANEACION')
                                        <p style="color: #F3561F;font-weight:bold">TRÁMITE EN CONCEPTO TÉCNICO DE
                                            PLANEACIÓN<span class="govco-icon govco-icon-right-arrow-cn size-1x"></span></p>
                                    @elseif($solicitud->estado_solicitud == 'REVISION-CONCEPTOS-SALUD')
                                        <p style="color: #F3561F;font-weight:bold">TRÁMITE EN CONCEPTO TÉCNICO DE SALUD<span
                                                class="govco-icon govco-icon-right-arrow-cn size-1x"></span></p>
                                    @elseif($solicitud->estado_solicitud == 'VIABILIDAD-PERMISO')
                                        <p style="color: #F42E62;font-weight:bold">RESPUESTA DE CONCEPTO TÉCNICO<span
                                                class="govco-icon govco-icon-left-arrow-cn size-1x"></span></p>
                                    @elseif($solicitud->estado_solicitud == 'DOC-ACT-CIUDADANO')
                                        <p style="color: #FFAB00;font-weight:bold">DOCUMENTOS ACTUALIZADOS<span
                                                class="govco-icon govco-icon-edit-p size-1x"></span></p>
                                    @elseif($solicitud->estado_solicitud == 'APROBADA')
                                        <p style="color: #069169;font-weight:bold">APROBADA<span
                                                class="govco-icon govco-icon-like size-1x"></span></p>
                                    @elseif($solicitud->estado_solicitud == 'RECHAZADA')
                                        <p style="color: #A80521;font-weight:bold">RECHAZADA<span
                                                class="govco-icon govco-icon-x-n size-1x"></span></p>
                                    @elseif($solicitud->estado_solicitud == 'REQUISITOS-FINALES')
                                        <p style="color: #069169;font-weight:bold">REQUISITOS-FINALES<span
                                                class="govco-icon govco-icon-check-p size-1x"></span></p>
                                    @endif
                                </td>

                                <td colspan="2"><strong>Observaciones de la solicitud:</strong><br>
                                    @if ($solicitud->observacion_solicitud == null || $solicitud->observacion_solicitud == '')
                                        <small>No hay Observaciones</small>
                                    @else
                                        {{ $solicitud->observacion_solicitud }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Fecha y hora de la solicitud</strong><br>
                                    {{ $solicitud->created_at }}
                                </td>
                                <td><strong>Fecha de actuación</strong><br>
                                    @if ($solicitud->fecha_actuacion == null || $solicitud->fecha_actuacion == '')
                                        <small>No hay fecha de actuaciones</small>
                                    @else
                                        {{ $solicitud->fecha_actuacion }}
                                    @endif
                                </td>

                            </tr>
                            @if ($solicitud->estado_solicitud == 'PENDIENTE' || $solicitud->estado_solicitud == 'REVISION-CONCEPTOS')
                                <tr>
                                    @if ($solicitud->estado_solicitud == 'PENDIENTE' && $solicitud->fecha_pendiente != null)
                                        <td><strong>Fecha límite para actualizar documentos</strong><br>
                                            {{ $solicitud->fecha_pendiente }}
                                        </td>
                                    @endif
                                    @if ($solicitud->estado_solicitud == 'REVISION-PLANEACION' && $solicitud->fecha_pendiente_planeacion != null)
                                        <td><strong>Fecha límite para concepto técnico</strong><br>
                                            {{ $solicitud->fecha_pendiente_planeacion }}
                                        </td>
                                    @endif
                                </tr>
                            @endif

                            {{-- aqui va el form --}}
                            <form method="POST" action="{{ route('interior.publicidad.update') }}"
                                enctype="multipart/form-data" id="frmEstadoPublicidad">
                                @csrf
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label for="estado">Cambiar Estado de la solicitud*</label>
                                            <select class="form-control  @error('estado_solicitud') is-invalid @enderror"
                                                name="estado_solicitud" id="estado_solicitud_publicidad" required>
                                                <option value="">Seleccione</option>
                                                @if ($solicitud->estado_solicitud == 'ENVIADA')
                                                    <option value="PENDIENTE">DOCUMENTOS PENDIENTES</option>
                                                    <option value="REVISION-CONCEPTOS-PLANEACION">REVISION-CONCEPTOS
                                                    </option>
                                                    <option value="RECHAZADA">RECHAZADA</option>
                                                @endif
                                                @if ($solicitud->estado_solicitud == 'PENDIENTE' || $solicitud->estado_solicitud == 'DOC-ACT-CIUDADANO')
                                                    <option value="PENDIENTE">DOCUMENTOS PENDIENTES</option>
                                                    <option value="REVISION-CONCEPTOS-PLANEACION">REVISION-CONCEPTOS
                                                    </option>
                                                    <option value="RECHAZADA">RECHAZADA</option>
                                                @endif
                                                @if ($solicitud->estado_solicitud == 'VIABILIDAD-PERMISO')
                                                    <option value="REQUISITOS-FINALES">REQUISITOS-FINALES</option>
                                                    <option value="RECHAZADA">RECHAZADA</option>
                                                @endif

                                                @if ($solicitud->estado_solicitud == 'REQUISITOS-FINALES')
                                                    <option value="REQUISITOS-FINALES-PENDIENTES">REQUISITOS-FINALES-PENDIENTES</option>
                                                    <option value="ORDEN-HACIENDA">ORDEN-HACIENDA</option>
                                                    <option value="RECHAZADA">RECHAZADA</option>
                                                @endif
                                            </select>
                                            @error('estado_solicitud')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </td>
                                    <td colspan="2">
                                        <div class="form-group">
                                            <label for="observacion">Observaciones *</label>
                                            <textarea name="observacion_solicitud" id="observacion"
                                                onkeypress="return Direccion(event)" maxlength="500"
                                                class="form-control  @error('observacion_solicitud') is-invalid @enderror"
                                                id="observacion" cols="2" rows="3" required></textarea>
                                            @error('observacion_solicitud')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                            @enderror


                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    {{-- <td>
                                        <div class="form-group">
                                            <label for="documento_respuesta">Cargar Respuesta</label>
                                            <input type="file" accept="application/pdf" name="documento_respuesta"
                                                id="documento_respuesta"
                                                class="form-control @error('observaciones_solicitud') is-invalid @enderror"
                                                disabled>
                                            @error('documento_respuesta')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </td> --}}
                                    <td></td>
                                    <td colspan="2">
                                        <div class="form-group">
                                            <input type="hidden" class="estado_actual" id="estado_sol"
                                                value="{{ $solicitud->estado_solicitud }}">
                                            <input type="hidden" name="username" value="{{ auth()->user()->username }}">
                                            <input type="hidden" name="id" value="{{ $solicitud->id }}">
                                            <input type="hidden" name="modalidad" value="{{ $solicitud->modalidad }}">
                                            <button type="submit"
                                                onclick="return confirm('¿Esta seguro de generar esta respuesta ?')"
                                                class="btn btn-round btn-middle btn-outline-info btn_enviar_solicitud"
                                                id="btnEstado">Actualizar estado</button>
                                            <a href="{{ url('/tramites/hacienda/publicidad/VALLAS') }}"
                                                class="btn btn-round btn-high">Volver</a>

                                        </div>
                                    </td>
                                </tr>
                            </form>
                            {{-- fin del form --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
