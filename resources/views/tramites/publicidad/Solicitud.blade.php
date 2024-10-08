@extends('layouts.app')
@section('title', 'Registro de publicidad exterior visual')
@section('content')

<style>
   .clockpicker-button {
      background-color: #3366CC !important;
      color: white !important;
   }
</style>

<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container" id="body_eventos">
   @include('tramites.titulo')

   <div class="row mt-2">
      <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
         <form action="{{ route('publicidad.finalizar') }}" method="POST" id="frmSolicitud"
            enctype="multipart/form-data" class="form-ciudadanox">
            <input type="hidden" name="PersonaId" value="{{ $datos->PersonaId }}">
            @csrf

            <!--Datos de la solicitud-->
            <div class="row">
               <div class="col-md-12">
                  <h3 class="headline-l-govco">2. Datos de la solicitud</h3>
               </div>
            </div>

            <div class="row">
               <div class="col-md-12  text-right" style="font-size: 16px;">
                  @if($datos->PersonaTip=="Natural")
                  <p class="mb-0"><b>Solicitante:</b> {{$datos->PersonaDoc}} - {{$datos->PersonaNombre .'
                     '.$datos->PersonaApe}}
                  </p>
                  @else
                  <p class="mb-0"><b>Solicitante:</b> {{$datos->PersonaDoc}} - {{$datos->PersonaRazon}}</p>
                  @endif
               </div>
            </div>

            <div class="row mb-3">
               <div class="col-md-12">
                  <label for="publicidad_modalidad" class="form-label">Modalidad de publicidad * </label>
                  <select class="form-control " name="publicidad_modalidad" id="publicidad_modalidad" required>
                     <option value="">Seleccione</option>
                     <option value="comerciales" data-modalidad="comerciales">AVISOS DE IDENTIFICACIÓN DE ESTABLECIMIENTOS COMERCIALES</option>
                     <option value="inmobiliarios" data-modalidad="inmobiliarios">AVISOS DE IDENTIFICACIÓN DE PROYECTOS
                        INMOBILIARIOS</option>
                     <option value="colombina" data-modalidad="colombina">AVISOS TIPO COLOMBINA</option>
                     <option value="murales" data-modalidad="murales">MURALES ARTISTICOS</option>
                     <option value="vallas" data-modalidad="vallas">VALLAS COMERCIALES - PANTALLAS LED - TABLEROS
                        ELECTRÓNICOS</option>
                     <option value="pendones" data-modalidad="pendones">PENDONES</option>
                     <option value="pasacalles" data-modalidad="pasacalles">PASACALLES PARA ENTIDADES PUBLICAS</option>
                     <option value="aerea" data-modalidad="aerea">PUBLICIDAD AÉREA</option>
                     <option value="movil" data-modalidad="movil">PUBLICIDAD MOVIL</option>
                  </select>
                  @error('publicidad_modalidad')
                  <span class="invalid-feedback" role="alert">
                     <strong class="text-danger">{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
            </div>

            <div class="row mb-3">
               <div class="col-md-4">
                  <label for="tipo_publicidad" class="form-label">Tipo de publicidad<code>*</code></label>
                  <select class="form-control  @error('tipo_publicidad') is-invalid @enderror" name="tipo_publicidad"
                     id="tipo_publicidad" required>
                     <option value="">Seleccione</option>
                     <option value="RENOVACION" {{ old('tipo_publicidad')=='RENOVACION' ? 'selected' : '' }}>
                        RENOVACIÓN
                     </option>
                     <option value="PRIMERA VEZ" {{ old('tipo_publicidad')=='PRIMERA VEZ' ? 'selected' : '' }}>
                        PRIMERA VEZ
                     </option>
                  </select>

                  @error('tipo_publicidad')
                  <span class="invalid-feedback" role="alert">
                     <strong class="text-danger">{{ $message }}</strong>
                  </span>
                  @enderror
               </div>

               <div class="d-none col-md-8" id="divRenovacion">
                  <div class="row">

                     <div class="col-md-6">
                        <label for="fecha_renovacion" class="form-label">Fecha de renovación<code>*</code></label>
                        <input type="date" value="{{ old('fecha_renovacion') }}"
                           class="form-control  @error('fecha_renovacion') is-invalid @enderror" name="fecha_renovacion"
                           id="fecha_renovacion" required>
                        @error('fecha_renovacion')
                        <span class="invalid-feedback" role="alert">
                           <strong class="text-danger">{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>

                     <div class="col-md-6">
                        <label for="fecha_vencimiento" class="form-label">Fecha de vencimiento<code>*</code></label>
                        <input type="date" value="{{ old('fecha_vencimiento') }}"
                           class="form-control  @error('fecha_vencimiento') is-invalid @enderror"
                           name="fecha_vencimiento" id="fecha_vencimiento" required>
                        @error('fecha_vencimiento')
                        <span class="invalid-feedback" role="alert">
                           <strong class="text-danger">{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
               </div>
            </div>

            <div id="divVistasModalidades"></div>

            <div class="row mb-3">
               <div class="col-md-12">
                  <h3 class="headline-l-govco">3. Documentos para adjuntar en la solicitud</h3>
               </div>
            </div>
            <div class="row mb-3" id="divAdjuntos"></div>
            @include('tramites.habeasData')

            <div class="col-md-12  pl-1 pr-1 pt-3 text-left mt-4" style="padding-left: 0px!important">
               {{-- <div class="g-recaptcha" data-sitekey="6LdzXDwcAAAAAOgw8LzMLMjgnI2spGFhuCoMYlGc"></div> --}}

               <button style="font-size:15px;" type="submit" class="btn btn-round btn-middle btn_enviar_solicitud"
                  id="btn_enviar_solicitud">Enviar
                  Solicitud</button>

               <button style="font-size:15px;" class="btn btn-round btn-middle btn_carga d-none" type="button"
                  disabled><span class="spinner-grow spinner-grow-sm text-primary" role="status"
                     aria-hidden="true"></span>
                  Enviando...</button>
            </div>
         </form>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
         @include('tramites.publicidad.informativo')
      </div>
   </div>
</div>
@include('tramites.publicidad.form_consulta')
@include('tramites.direccion')

{{-- @push('scripts')
<script type="text/javascript" src="{{ asset('js/publicidad_vallas.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/publicidad_comerciales.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/publicidad_colombina.js') }}"></script>
@endpush --}}


@endsection
