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
                                <a style="color: #004fbf;" class="breadcrumb-text" href="#">Tramites en Línea</a>
                            </div>
                        </li>
                        <li class="breadcrumb-item ">
                            <div class="image-icon">
                                <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                                <a style="color: #004fbf;" class="breadcrumb-text" href="#">
                                    Planeación</a>
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
                                    @if ($solicitud->estado_solicitud == 'REVISION-CONCEPTOS-PLANEACION')
                                        <p style="color: #069169;font-weight:bold">Pendiente concepto técnico<span
                                                class="govco-icon govco-icon-check-p size-1x"></span></p>
                                    @endif
                                </td>

                                <td><strong>Observaciones de la solicitud:</strong><br>
                                    @if ($solicitud->observacion_solicitud == null || $solicitud->observacion_solicitud == '')
                                        <small>No hay Observaciones</small>
                                    @else
                                        {{ $solicitud->observacion_solicitud }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><strong>Fecha y hora de la solicitud</strong><br>
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
                            <form method="POST" action="{{ route('planeacion.publicidad.update') }}"
                                enctype="multipart/form-data" id="frmEstadoPublicidadPlaneacion">
                                @csrf
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label for="adj_concepto_planeacion">Cargar Concepto Técnico</label>
                                            <input type="file" accept="application/pdf" name="adj_concepto_planeacion"
                                                required id="adj_concepto_planeacion"
                                                class="form-control @error('adj_concepto_planeacion') is-invalid @enderror">
                                            @error('adj_concepto_planeacion')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </td>
                                    <td colspan="2">
                                        <div class="form-group">
                                            <label for="observacion">Observaciones*</label>
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
                                                onclick="return confirm('¿Esta seguro de generar esta respuesta?')"
                                                id="btnPlaneacion"
                                                class="btn btn-round btn-middle btn-outline-info btn_enviar_solicitud">Enviar
                                                concepto técnico</button>
                                            <a href="{{ route('planeacion.publicidad.index') }}"
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
