@extends('layouts.app')

@section('content')

@if($solicitud->estado_solicitud == 'REQUISITOS-FINALES' || $solicitud->estado_solicitud == 'REQUISITOS-FINALES-PENDIENTES')

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
            <h1 class="headline-xl-govco">Requisitos Finales</h1>
            <div class="row pt-5">
                <div class="col-md-12 justify-content-center">
                    <form method="POST" action="{{ route('publicidad.updateReq') }}" enctype="multipart/form-data"
                        id="myForm">
                        @csrf
                        <input type="hidden" name="id" value="{{ $solicitud->id }}">
                        <input type="hidden" name="tipo_valla" value="{{ $detalle->tipo_valla }}">
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

                                   

                                    {{-- AQUI VA APROBADA --}}

                                    @if ($solicitud->estado_solicitud == 'REQUISITOS-FINALES' && $solicitud->act_documentos == null)

                                        <div class="col-md-12">
                                            <h5>Cargue sus archivos pendientes <small>Faltan {{ $diff }} dia(s)
                                                    para el vencimiento del plazo</small></h5>

                                        </div>
                                 @if ($errors->any())
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>
                                    @endif 

                                        @switch($detalle->tipo_valla)
                                            @case('TUBULAR')
                                                <div class="col-md-6 form-group">
                                                    <label for="req_certi_civil" class="form-label">Certificación de Ing Civil*
                                                     &nbsp; <br> <small class="text-danger"
                                                            style="font-size: 11px!important">Solo se permiten archivos .pdf con
                                                            un tamaño máximo de 10MB</small> </label>
                                                    <div class="form-group">
                                                        <div class="file-loading">
                                                            <input
                                                                class=" @error('req_certi_civil') is-invalid @enderror documentos_publicidad"
                                                                id="req_certi_civil" accept="application/pdf"
                                                                name="req_certi_civil" type="file"
                                                                data-overwrite-initial="true">

                                                            @error('req_certi_civil')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong class="text-danger">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label for="req_tarjeta_profesional" class="form-label">Tarjeta Profesional Ing. Civil*
                                                        &nbsp;<br> <small
                                                            class="text-danger" style="font-size: 11px!important">Solo se
                                                            permiten archivos .pdf con un tamaño máximo de 10MB</small> </label>
                                                    <div class="form-group">
                                                        <div class="file-loading">
                                                            <input
                                                                class=" @error('req_tarjeta_profesional') is-invalid @enderror documentos_publicidad"
                                                                id="req_tarjeta_profesional" accept="application/pdf"
                                                                name="req_tarjeta_profesional" type="file"
                                                                data-overwrite-initial="true">

                                                            @error('req_tarjeta_profesional')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong class="text-danger">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label for="req_poliza"
                                                        class="form-label">Poliza Cumplimiento* &nbsp; <br> <small
                                                            class="text-danger" style="font-size: 11px!important">Solo se
                                                            permiten archivos .pdf con un tamaño máximo de 10MB</small> </label>
                                                    <div class="form-group">
                                                        <div class="file-loading">
                                                            <input
                                                                class=" @error('req_poliza') is-invalid @enderror documentos_publicidad"
                                                                id="req_poliza" accept="application/pdf"
                                                                name="req_poliza" type="file"
                                                                data-overwrite-initial="true">

                                                            @error('req_poliza')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong class="text-danger">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                            @break

                                            @case('CONVENCIONAL')

                                            <div class="col-md-6 form-group">
                                                <label for="req_poliza"
                                                    class="form-label">Polizas de Cumplimiento* &nbsp; <br> <small
                                                        class="text-danger" style="font-size: 11px!important">Solo se
                                                        permiten archivos .pdf con un tamaño máximo de 10MB</small> </label>
                                                <div class="form-group">
                                                    <div class="file-loading">
                                                        <input
                                                            class=" @error('req_poliza') is-invalid @enderror documentos_publicidad"
                                                            id="req_poliza" accept="application/pdf"
                                                            name="req_poliza" type="file"
                                                            data-overwrite-initial="true">

                                                        @error('req_poliza')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong class="text-danger">{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                                
                                            @break
                                        @endswitch

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button type="submit" onclick="return confirm('¿Esta seguro de actualizar los documentos ?')"
                                                    class="btn btn-round btn-middle btn-outline-info" id="Boton">Actualizar documentos</button>
                                            </div>
                                        </div>

                                    @elseif($solicitud->estado_solicitud == 'REQUISITOS-FINALES' && $solicitud->act_documentos ==
                                        'SI')
                                        <div class="col-md-4">
                                            <h6>Atención!!</h6>
                                            <p>Usted ya realizó una actualización de documentos el dia
                                                {{ $solicitud->updated_at }} por favor espere a que sean revisados</p>
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

    @else
<script>
    alert('Usted ya paso la etapa de REQUISITOS FINALES')
    window.location = '/publicidad-exterior';
</script>

@endif


@endsection
