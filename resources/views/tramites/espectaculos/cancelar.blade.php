@extends('layouts.app')

@section('content')

    @if ($estado)


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
                                    <span class="breadcrumb govco-icon govco-icon-shortr-arrow"
                                        style="height: 22px;"></span>
                                    <p class="ml-3 ml-md-0 "><b style="color: #004fbf;text-transform: none;">
                                            Espectaculos Publicos
                                        </b></p>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row mt-2">

                    <div class="col-md-12 pt-4">


                        <h1 class="headline-xl-govco">Cancelación de Solicitud</h1>
                        <div class="row pt-5">
                            <div class="col-md-12 justify-content-center">
                                <form method="POST" action="{{ route('espectaculos.cancelarSolicitud') }}"
                                    enctype="multipart/form-data" id="form_cancelar_espec">
                                    <div class="card govco-card animate__animated animate__bounceInRight">
                                        <div class="card-header govco-card-header">
                                            <span class="govco-icon govco-icon-analytic size-3x pr-3"> </span>
                                            Solicitud N°- {{$radicado}}
                                        </div>
                                         @csrf
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="observaciones">Motivo de cancelación*</label>
                                                        <textarea name="observaciones" id="observaciones_espectaculos"
                                                            onkeypress="return Observaciones(event)"
                                                            onkeyup="aMayusculas(this.value,this.id)" maxlength="600" class="form-control  @error('observaciones') is-invalid @enderror"
                                                             rows="3" required></textarea>
                                                        @error('observaciones')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong class="text-danger">{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                               @if($estado !== 'ENVIADA')
                                                <div class="col-md-6 pl-1 pr-1 pt-3">
                                                    <label for="arch_evento_cancelado" class="form-label">Oficio de cancelacíon* <br> <small
                                                            class="text-danger" style="font-size: 11px!important">Solo se permiten archivos
                                                            .pdf con un tamaño máximo de 10MB</small> </label>
                                                    <div class="form-group">
                                                        <div class="file-loading">
                                                            <input
                                                                class=" @error('arch_evento_cancelado') is-invalid @enderror documentos_adjuntos"
                                                                id="arch_evento_cancelado" accept="application/pdf" name="arch_evento_cancelado"
                                                                type="file" data-overwrite-initial="true" required>
                                                            @error('arch_evento_cancelado')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong class="text-danger">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        
                                            <div class="col-md-12 pb-3">
                                                <input type="hidden" value="{{$id}}" name="id" class="form-control">
                                                <input type="hidden" name="estado_solicitud" value="{{$estado}}" class="form-control">
                                                <button style="font-size:15px;" type="submit" class="btn btn-round btn-middle" name="consultar" onclick="return confirm('¿Esta seguro de realizar esta accion ? Esta cambio no tiene reversa')">Cancelar Solicitud</button>
                                                <button style="font-size:15px;" type="button" class="btn btn-round btn-middle"><a href="{{ URL::route('espectaculos.index') }}">Volver</a></button>
                        
                        
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>
                   
                </div>
            </div>

        </div>
        <script>
            setTimeout(function() {
                window.location.href = '/espectaculos-publicos/';
            }, 480000);
        </script>
    @else

        <script>
            window.location = '/espectaculos-publicos';
        </script>




    @endif


@endsection
