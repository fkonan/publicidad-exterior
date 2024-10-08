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


   <div class="row">
      <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12 mt-2">
         {{-- @include('tramites.publicidad.Introduccion') --}}

         <form method="POST" id="myForm" class="form-ciudadano">
            @csrf
            <!-- datos Generales-->
            <h2>Caracterización del ciudadano</h2>
            <h3 class="headline-l-govco mt-3 pl-0">1. Datos Generales</h3>

            <div class="row">
               <div class="col-md-6">
                  <label for="PersonaTipDoc" class="form-label">Tipo de Documento *</label>
                  <select class="form-control  @error('PersonaTipDoc') is-invalid @enderror" name="PersonaTipDoc"
                     id="PersonaTipDoc" required>
                     <option value="">Seleccione</option>
                     <option value="C.C">Cedula de Ciudadanía</option>
                     <option value="C.E.">Cedula de Extranjería</option>
                     <option value="NIT">NIT</option>
                  </select>
                  @error('PersonaTipDoc')
                  <span class="invalid-feedback" role="alert">
                     <strong class="text-danger">{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="col-md-6">
                  <label for="PersonaDoc" class="form-label">Número de Identificación* </label>
                  <input value="{{ old('PersonaDoc') }}" type="text" required
                     class="form-control number_validate  @error('PersonaDoc') is-invalid @enderror" name="PersonaDoc"
                     id="PersonaDoc" maxlength="15" minlength="4" required onkeypress="return Numeros(event)" required>
                  @error('PersonaDoc')
                  <span class="invalid-feedback" role="alert">
                     <strong class="text-danger">{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="col-md-12" style="padding-left: 0px!important">
                  <button type="button" class="btn btn-round btn-middle btnValidar">Validar</button>
                  <a href="/publicidad-exterior" class="btn btn-round btn-middle">Volver</a>
               </div>
            </div>
            <div id="divInfo" class="d-none">
               <div class="row mb-3">
                  <div class="col-md-4">
                     <label for="PersonaTip" class="form-label">Tipo de persona* </label>
                     <select class="form-control  @error('PersonaTip') is-invalid @enderror" name="PersonaTip"
                        id="PersonaTip" required>
                        <option value="">Seleccione</option>
                        <option value="Natural">Natural</option>
                        <option value="Juridica">Juridica</option>
                     </select>
                     @error('PersonaTip')
                     <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="col-md-4" id="natural_nombre">
                     <label for="PersonaNombre" class="form-label">Nombres*
                     </label>
                     <input type="text" class="form-control name_validate  @error('PersonaNombre') is-invalid @enderror"
                        name="PersonaNombre" id="PersonaNombre" maxlength="25" minlength="4"
                        onkeypress="return Letras(event)" onkeyup="aMayusculas(this.value,this.id)">
                     @error('PersonaNombre')
                     <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="col-md-4" id="natural_ape">
                     <label for="PersonaApe" class="form-label">Apellidos*
                     </label>
                     <input type="text"
                        class="form-control name_validate  @error('nom_solicitante') is-invalid @enderror"
                        name="PersonaApe" id="PersonaApe" maxlength="25" minlength="4" onkeypress="return Letras(event)"
                        onkeyup="aMayusculas(this.value,this.id)">
                     @error('PersonaApe')
                     <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="col-md-8 d-none" id="juridica">
                     <label for="PersonaRazon" class="form-label">Razon Social y/o Responsable * </label>
                     <input type="text" class="form-control   @error('PersonaRazon') is-invalid @enderror "
                        name="PersonaRazon" id="PersonaRazon" maxlength="150" minlength="4"
                        onkeypress="return Observaciones(event)" onkeyup="aMayusculas(this.value,this.id)">
                     @error('PersonaRazon')
                     <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>
               <div class="row mb-3">
                  <div class="col-md-8">
                     <label for="dir_responsable_sol" class="form-label">Dirección de notificación fisica*
                     </label><button type="button" class="btn btn-link py-0"
                        onclick='javascript:campo="#dir_solicitante";'><span
                           style="text-transform: lowercase; font-size: 12px;" class="text-primary" data-toggle="modal"
                           data-target="#ModalDireccionesEventos">(Clic para insertar
                           direccion)</span></button>
                     <input type="text" class="form-control  @error('dir_responsable_sol') is-invalid @enderror"
                        name="dir_solicitante" id="dir_solicitante" maxlength="120" required readonly>
                     @error('dir_responsable_sol')
                     <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>

                  <div class="col-md-4">
                     <label for="PersonaBarrio" class="form-label">Barrio* </label>
                     <select name="PersonaBarrio" id="PersonaBarrio"
                        class="form-control @error('PersonaBarrio') is-invalid @enderror PersonaBarrio" required>
                        <option value=""></option>
                        @foreach ($Barrios as $barrio)
                        <option value="{{ $barrio->nombre }}">{{ $barrio->nombre }}</option>
                        @endforeach
                     </select>
                     @error('PersonaBarrio')
                     <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="PersonaTel" class="form-label">Teléfono / Celular* </label>
                     <input value="{{ old('PersonaTel') }}" type="text"
                        class="form-control  @error('PersonaTel') is-invalid @enderror number_validate"
                        name="PersonaTel" id="PersonaTel" maxlength="10" minlength="7"
                        onkeypress="return Numeros(event)">
                     @error('PersonaTel')
                     <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>

                  <div class="col-md-8">
                     <label for="PersonaMail" class="form-label">Correo Electronico* </label>
                     <input value="{{ old('PersonaMail') }}" type="mail"
                        class="form-control  @error('PersonaMail') is-invalid @enderror email_validate"
                        name="PersonaMail" id="PersonaMail">
                     @error('PersonaMail')
                     <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="col-md-12" style="padding-left: 0px!important">
                     <button type="submit" class="btn btn-round btn-middle btnGuardar">Enviar</button>
                  </div>
               </div>
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
@endsection
