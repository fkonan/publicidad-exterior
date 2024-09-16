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

<div class="container mt-3 mb-4 m-xs-x-3" id="body_eventos">
   @include('tramites.titulo')

   <div class="container-fluid">
      <div class="row mt-2">
         <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">

            @include('tramites.publicidad.Introduccion')

            <form action="{{ route('publicidad.finalizar') }}" method="POST" id="frmSolicitud"
               enctype="multipart/form-data" class="form-ciudadanox">
               <input type="hidden" name="PersonaId" value="{{ $datos->PersonaId }}">
               @csrf

               <!--Datos de la solicitud-->
               <div class="row mb-2">
                  <div class="col-md-12">
                     <h3 class="headline-l-govco">2. Datos de la solicitud</h3>
                  </div>
               </div>

               <div class="row mb-3">
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

               <div class="row mb-2">
                  <div class="col-md-12 form-group">
                     <label for="ubicacion_aviso" class="form-label">Dirección de ubicación del elemento publicitario*
                     </label>
                     <input type="text" class="form-control  @error('ubicacion_aviso') is-invalid @enderror"
                        name="ubicacion_aviso" id="ubicacion_aviso" maxlength="120" required>
                     @error('ubicacion_aviso')
                     <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>

               <div class="row mb-3">
                  <div class="col-md-12">
                     <label for="modalidad" class="form-label">Modalidad de publicidad * </label>
                     <select class="form-control " name="modalidad" id="modalidad" required>
                        <option value="">Seleccione</option>
                        <option value="0" data-mod="vallas">VALLAS COMERCIALES - PANTALLAS LED - TABLEROS
                           ELECTRÓNICOS</option>
                        <option value="1" data-mod="pendones">AVISOS Y PENDONES</option>
                        <option value="2" data-mod="murales">MURALES ARTISTICOS EN PROPIEDAD PRIVADA</option>
                        <option value="3" data-mod="pasacalles">PASACALLES PARA ENTIDADES PUBLICAS</option>
                        <option value="4" data-mod="aerea">PUBLICIDAD AÉREA</option>
                        <option value="5" data-mod="movil">PUBLICIDAD MOVIL</option>
                     </select>
                     @error('modalidad')
                     <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>

               <div class="row mb-3 d-none" id="divVallas">
                  <div class="col-md-6">
                     <label for="tipo_valla" class="form-label">Tipo de vallas<code>*</code> </label>
                     <select class="form-control  @error('tipo_valla') is-invalid @enderror" name="tipo_valla"
                        id="tipo_valla">
                        <option value="">Seleccione</option>
                        <option value="CONVENCIONAL">CONVENCIONAL</option>
                        <option value="TUBULAR">TUBULAR</option>
                     </select>

                     @error('tipo_valla')
                     <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="col-md-6">
                     <label for="tipo_publicidad" class="form-label">Tipo de publicidad <code>*</code>
                     </label>
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
               </div>

               <div class="row mb-2 d-none" id="divRenovacion">
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
                        class="form-control  @error('fecha_vencimiento') is-invalid @enderror" name="fecha_vencimiento"
                        id="fecha_vencimiento" required>
                     @error('fecha_vencimiento')
                     <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>

               <div class="row">
                  <div class="col-md-4">
                     <label for="ancho_publicidad" class="form-label">Ancho del elemento publicitario
                        (mts)<code>*</code>
                     </label>
                     <input type="number" value="{{ old('ancho_publicidad') }}"
                        class="form-control  @error('ancho_publicidad') is-invalid @enderror" name="ancho_publicidad"
                        id="ancho_publicidad" required>

                     @error('ancho_publicidad')
                     <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>

                  <div class="col-md-4">
                     <label for="alto_publicidad" class="form-label">Alto del elemento publicitario
                        (mts)<code>*</code></label>
                     <input type="number" value="{{ old('alto_publicidad') }}"
                        class="form-control  @error('alto_publicidad') is-invalid @enderror" name="alto_publicidad"
                        id="alto_publicidad" required>
                     <br>
                     @error('alto_publicidad')
                     <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>

               <div class="row mb-2">
                  <div class="col-md-4">
                     <label for="numero_caras" class="form-label">Número de caras<code>*</code> </label>
                     <input type="number" value="{{ old('numero_caras') }}"
                        class="form-control  @error('numero_caras') is-invalid @enderror" name="numero_caras"
                        id="numero_caras">

                     @error('numero_caras')
                     <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>

                  <div class="col-md-4">
                     <label for="area_total" class="form-label">Area total</label>
                     <input type="number" class="form-control" name="area_total" id="area_total" readonly required>
                  </div>

                  <div class="col-md-4">
                     <label for="numero_elementos" class="form-label">Número de elementos<code>*</code></label>
                     <input type="number" class="form-control  @error('numero_elementos') is-invalid @enderror"
                        name="numero_elementos" id="numero_elementos" required>

                     @error('numero_elementos')
                     <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>

               <div class="row">
                  <div class="col-md-12">
                     <label for="observacion_medidas" class="form-label">Observaciones adicionales</label>
                     <textarea name="observacion_medidas" class="form-control" rows="5"
                        placeholder="Digita las observaciones" id="observacion_medidas" maxlength="300"></textarea>

                     @error('observacion_medidas')
                     <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>

               <!--Fin Datos de la solicitud-->
               <div class="row mt-3 mb-2">
                  <div class="col-md-12">
                     <h3 class="headline-l-govco">3. Documentos para adjuntar en la solicitud</h3>
                  </div>
               </div>
               <div class="row" id="divAdjuntos"></div>

               <div class="row form-group mt-2">

                  <!--Pendones-->

                  <div class="col-md-12 adicional d-none" id="adicional0">
                     <label for="sub_modalidad" class="form-label">Sub-Modalidad Avisos y Pendones * </label>

                     <select class="form-control  @error('subModalidad') is-invalid @enderror" name="subModalidad"
                        id="subModalidad" onchange="javascript: adicionales(this.value);">
                        <option value="">Seleccione</option>
                        <option value="6">AVISOS DE IDENTIFICACIÓN DE ESTABLECIMIENTOS COMERCIALES</option>
                        <option value="7">IDENTIFICACIÓN PROYECTOS INMOBOLIARIOS</option>
                        <option value="8">AVISOS TIPO COLOMBINA</option>
                     </select><br>

                     @error('sub_modalidad')
                     <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>

                  <div class="col-md-6  adicional d-none" id="adicional1">
                     <label for="alto_fachada" class="form-label">Alto de la fachada(mts)<code>*</code>
                     </label>
                     <input type="number" value="{{ old('alto_fachada') }}"
                        class="form-control  @error('alto_publicidad') is-invalid @enderror" name="alto_fachada"
                        id="alto_fachada">

                     @error('alto_publicidad')
                     <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>

                  <div class="col-md-6 adicional d-none" id="adicional2">
                     <label for="ancho_fachada" class="form-label">Ancho de la
                        fachada(mts)<code>*</code></label>
                     <input type="number" value="{{ old('ancho_fachada') }}"
                        class="form-control  @error('ancho_fachada') is-invalid @enderror" name="ancho_fachada"
                        id="ancho_fachada"><br>

                     @error('ancho_publicidad')
                     <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>

                  <div class="col-md-6  adicional d-none" id="adicional3">
                     <label for="propiedad_privada" class="form-label">¿Se encuentra en propiedad privada?
                        <code>*</code>
                     </label>
                     <select class="form-control  @error('propiedad_privada') is-invalid @enderror"
                        name="propiedad_privada" id="propiedad_privada">
                        <option value="">Seleccione</option>
                        <option value="NO">NO</option>
                        <option value="SI">SI</option>
                     </select>

                     @error('')
                     <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>

                  <div class="col-md-6  adicional d-none" id="adicional4">
                     <label for="inferior_treintaDias" class="form-label">¿Publicidad inferior a 30 dias?
                        <code>*</code> </label>
                     <select class="form-control  @error('inferior_treintaDias') is-invalid @enderror"
                        name="inferior_treintaDias" id="inferior_treintaDias">
                        <option value="">Seleccione</option>
                        <option value="NO">NO</option>
                        <option value="SI">SI</option>
                     </select><br>

                     @error('')
                     <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>




                  <!--todos - Movil-->
                  @php
                  $maxDate=date('Y').'-12-31';
                  @endphp


                  <!--Movil-->

                  <div class="col-md-6 adicional d-none" id="adicional9">
                     <label for="vehiculos" class="form-label">Número de vehículos<code>*</code> </label>
                     <input type="number" value="{{ old('vehiculos') }}"
                        class="form-control  @error('vehiculos') is-invalid @enderror" name="vehiculos" id="vehiculos">

                     @error('vehiculos')
                     <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <script>
                     function adicionales(tipo) {
                                    $('.adicional').addClass('d-none');
                                    var movil = [9];
                                    var vallas = [5, 6, 7, 8];
                                    var murales = [7, 8];
                                    var pendones = [0, 3, 4, 7, 8];
                                    var aerea = [7, 8];
                                    var pasacalles = [7, 8];
                                    var pendones1 = [0, 1, 2, 3, 4, 7, 8];
                                    var pendones2 = [0, 1, 2, 3, 4, 7, 8];
                                    var pendones3 = [0, 3, 4, 7, 8];
                                    var doc = [vallas, pendones, murales, pasacalles, aerea, movil, pendones1, pendones2, pendones3];
                                    var grupos = doc[tipo];

                                    for (i = 0; i < grupos.length; i++) {
                                        var nombre = "#adicional" + grupos[i];
                                        $(nombre).find('input,select').attr('required', true);
                                        $(nombre).removeClass('d-none');
                                    }
                                }

                                function Instalacion(tipo) {
                                    if (tipo == "RENOVACION") {
                                        $('.Finstalacion').removeClass('d-none');
                                    } else {

                                        $('.Finstalacion').addClass('d-none');
                                    }
                                }

                                function validarFecha() {
                                    var fecha_ini = $('#fecha_instalacion').val();
                                    var fecha_fin = $('#fecha_instalacion_retiro').val();
                                    if (fecha_ini > fecha_fin) {
                                        alert('La fecha inicial de la publiciada no puede ser mayor que la fecha final');
                                        $('#fecha_instalacion_retiro').val('');
                                        fecha_fin.focus();
                                    }
                                }
                  </script>
               </div>

               <!--Adjuntos-->
               {{-- @include('tramites.publicidad.documentos') --}}


               @include('tramites.habeasData')

               <div class="col-md-12  pl-1 pr-1 pt-3 text-left mt-4" style="padding-left: 0px!important">
                  {{-- <div class="g-recaptcha" data-sitekey="6LdzXDwcAAAAAOgw8LzMLMjgnI2spGFhuCoMYlGc"></div> --}}

                  <button style="font-size:15px;" type="submit"
                     class="btn btn-round btn-middle btn_enviar_solicitud">Enviar
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
</div>
@include('tramites.publicidad.form_consulta')
@include('tramites.direccion')


@endsection
