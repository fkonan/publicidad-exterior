@extends('layouts.app')

@section('content')


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
                                        Publicidad Exterior
                                    </b></p>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="col-md-12 pt-4">
            <h1 class="headline-xl-govco">Detalle de solicitudes</h1>
            <div class="row pt-5">
                <div class="col-md-12 justify-content-center">
                    <form method="POST" action="{{ route('publicidad.updateDocs') }}" enctype="multipart/form-data"
                        id="myForm">
                        @csrf
                        <input type="hidden" name="id" value="{{ $solicitud->id }}">
                        <div class="card govco-card animate__animated animate__bounceInRight">
                            <div class="card-header govco-card-header">
                                <span class="govco-icon govco-icon-analytic size-3x pr-3"> </span>
                                Solicitud N°- {{ $solicitud->radicado }}
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nombre del solicitante</label>
                                            <input type="text" class="form-control"
                                                value="{{ $solicitud->nombre_responsable }} {{ $solicitud->apellido_responsable }}"
                                                readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Estado de la Solicitud</label>
                                            <input type="text" class="form-control"
                                                value="{{ $solicitud->estado_solicitud }}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Observaciones de la solicitud</label>
                                            <textarea rows="4" class="form-control"
                                                disabled>{{ $solicitud->observacion_solicitud }}</textarea>

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Fecha de actuacion</label>
                                            <input type="text" class="form-control"
                                                value="{{ $solicitud->fecha_actuacion }}" readonly>
                                        </div>
                                    </div>

                                    @if ($solicitud->estado_solicitud == 'RECHAZADA')

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Viabilidad Técnica</h5>
                                                <a href="http://tramitesenlinea.test/{{ $solicitud->adjunto_resPlaneacion }}"
                                                    target="_blank">Descargar documento</a>&nbsp;&nbsp;<i
                                                    class="fa fa-download"></i>
                                            </div>
                                        </div>

                                    @endif

                                    @if ($solicitud->estado_solicitud == 'APROBADA')

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Acto administrativo de respuesta</h5>
                                                <a href="http://tramitesenlinea.test/{{ $solicitud->adjunto_respuesta }}"
                                                    target="_blank">Descargar documento</a>&nbsp;&nbsp;<i
                                                    class="fa fa-download"></i>
                                            </div>
                                        </div>

                                    @endif

                                    {{-- AQUI VA APROBADA --}}

                                    @if ($solicitud->estado_solicitud == 'PENDIENTE' && $solicitud->act_documentos == null)

                                        <div class="col-md-12">
                                            <h5>Cargue sus archivos pendientes <small>Faltan {{ $diff }} dia(s)
                                                    para el vencimiento del plazo</small></h5>

                                        </div>

                                        @switch($solicitud->modalidad)
                                            @case('VALLAS')
                                                <div class="col-md-6 form-group">
                                                    <label for="adj_certificado_lyt" class="form-label">Certificado de
                                                        libertad y tradición &nbsp; <br> <small class="text-danger"
                                                            style="font-size: 11px!important">Solo se permiten archivos .pdf con
                                                            un tamaño máximo de 10MB</small> </label>
                                                    <div class="form-group">
                                                        <div class="file-loading">
                                                            <input
                                                                class=" @error('adj_certificado_lyt') is-invalid @enderror adj_certificado_lyt"
                                                                id="adj_certificado_lyt" accept="application/pdf"
                                                                name="adj_certificado_lyt" type="file"
                                                                data-overwrite-initial="true">

                                                            @error('adj_certificado_lyt')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong class="text-danger">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label for="adj_camara_comercio" class="form-label">Camara de Comercio
                                                        &nbsp; <small style="font-size: 10px!important"><em
                                                                style="font-size: 10px!important">(Mínimo 3 meses de
                                                                antigüedad)</em> </small> &nbsp; y/o RUT<br> <small
                                                            class="text-danger" style="font-size: 11px!important">Solo se
                                                            permiten archivos .pdf con un tamaño máximo de 10MB</small> </label>
                                                    <div class="form-group">
                                                        <div class="file-loading">
                                                            <input
                                                                class=" @error('adj_camara_comercio') is-invalid @enderror adj_camara_comercio"
                                                                id="adj_camara_comercio" accept="application/pdf"
                                                                name="adj_camara_comercio" type="file"
                                                                data-overwrite-initial="true">

                                                            @error('adj_camara_comercio')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong class="text-danger">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label for="adj_autorizacion_propietarios"
                                                        class="form-label">Autorización del propietario &nbsp; <br> <small
                                                            class="text-danger" style="font-size: 11px!important">Solo se
                                                            permiten archivos .pdf con un tamaño máximo de 10MB</small> </label>
                                                    <div class="form-group">
                                                        <div class="file-loading">
                                                            <input
                                                                class=" @error('adj_autorizacion_propietarios') is-invalid @enderror adj_autorizacion_propietarios"
                                                                id="adj_autorizacion_propietarios" accept="application/pdf"
                                                                name="adj_autorizacion_propietarios" type="file"
                                                                data-overwrite-initial="true">

                                                            @error('adj_autorizacion_propietarios')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong class="text-danger">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label for="adj_fotomontaje" class="form-label">Fotomontaje o plano
                                                        digitalizado &nbsp; <br> <small class="text-danger"
                                                            style="font-size: 11px!important">Solo se permiten archivos .pdf con
                                                            un tamaño máximo de 10MB</small> </label>
                                                    <div class="form-group">
                                                        <div class="file-loading">
                                                            <input
                                                                class=" @error('adj_fotomontaje') is-invalid @enderror adj_fotomontaje"
                                                                id="adj_fotomontaje" accept="application/pdf"
                                                                name="adj_fotomontaje" type="file"
                                                                data-overwrite-initial="true">

                                                            @error('adj_fotomontaje')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong class="text-danger">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            @break

                                            @case(2)
                                                Second case...
                                            @break
                                        @endswitch

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <button type="submit"
                                                    onclick="return confirm('¿Esta seguro de actualizar los documentos ?')"
                                                    class="btn btn-round btn-middle btn-outline-info" id="Boton">Actualizar
                                                    documentos</button>
                                            </div>
                                        </div>

                                    @elseif($solicitud->estado_solicitud == 'PENDIENTE' && $solicitud->act_documentos ==
                                        'SI')
                                        <div class="col-md-4">
                                            <h6>Atención!!</h6>
                                            <p>Usted ya realizó una actualización de documentos el dia
                                                {{ $solicitud->updated_at }}</p>
                                        </div>



                                    @endif
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="col-md-3">
                                    <a class="btn btn-round btn-high" href="{{ URL::route('publicidad.index') }}"
                                        style="float: left;">Volver</a>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>








    </div>

@endsection
