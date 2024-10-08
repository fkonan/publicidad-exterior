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

            <form action="{{ route('publicidad.Guardar') }}" method="POST" id="frmDocPendientes" enctype="multipart/form-data"
               class="form-ciudadano">
               <input type="hidden" name="PersonaId" value="{{ $Datos->PersonaId }}">
               <input type="hidden" name="Radicado" value="{{ $Solicitud->radicado }}">
               <input type="hidden" name="estado_sig" value="{{ $estado[0]->estado_sig }}">
               <input type="hidden" name="novedad_id" value="{{ $estado[0]->novedad_id }}">
               @csrf

               <!-- datos Generales-->

               <h3 class="headline-l-govco mt-3 pl-0">Publicidad exterior visual.</h3>

               <h4>Solicitante:</h4>
               <!-- Tabla Solicitante-->
               <table>
                  <tr>
                     <td>Nombre o Razón social:</td>
                     <td>{{ $Datos->PersonaNombre }} {{ $Datos->PersonaApe }}</td>
                  </tr>

                  <tr>
                     <td>Número de documento:</td>
                     <td>{{ $Datos->PersonaTipDoc }} {{ $Datos->PersonaDoc }}</td>
                  </tr>

                  <tr>
                     <td>Correo electronico:</td>
                     <td>{{ $Datos->PersonaMail }}</td>
                  </tr>
               </table>

               <h4 class="mt-2">Datos de la publicidad:</h4>
               <!-- Tabla Predio-->
               <table>
                  <tr>
                     <td>Modalidad:</td>
                     <td>{{ $Solicitud->modalidad }}</td>
                  </tr>
               </table>

               <h4 class="mt-2">Solicitud:</h4>
               <!-- Tabla Solicitud-->
               <table>
                  <tr>
                     <td>Numero de radicado:</td>
                     <td>{{ $Solicitud->radicado }}</td>
                  </tr>

                  <tr>
                     <td>Estado de la solicitud:</td>
                     <td>{{ $Solicitud->novedad }}</td>
                  </tr>
               </table>

               <div class="row form-group mt-2">
                  <!--Adjuntos-->

                  <div class="col-md-12 pl-1 pr-1 pt-3">
                     <h3 class="headline-l-govco mt-3 pl-0">Adjunte solicitados</h3>
                  </div>

                  @foreach ( $adjuntos as $adjunto)
                     <div class="col-md-6 pl-1 pr-1 pt-3">
                        <label for="{{$adjunto->codigo_adjunto}}" class="form-label">{{$adjunto->titulo_adjunto}}</label> &nbsp;
                        <small style="font-size: 11px!important; text-align:justify!important;"><em
                              style="font-size: 11px!important; text-align:justify!important;">Adjunte los documentos
                              pendientes solicitados por la Alcaldía de Bucaramanga</em>
                        </small>
                        <div class="form-group">
                           <div class="file-loading">
                              <input class=" @error('{{$adjunto->codigo_adjunto}}') is-invalid @enderror documentos_adjuntos" id="{{$adjunto->codigo_adjunto}}"
                                 accept="application/pdf" name="{{$adjunto->codigo_adjunto}}" type="file" data-overwrite-initial="true">
                              @error('{{$adjunto->codigo_adjunto}}')
                              <span class="invalid-feedback" role="alert">
                                 <strong class="text-danger">{{ $message }}</strong>
                              </span>
                              @enderror
                           </div>
                        </div>
                     </div>
                  @endforeach

                  @include('tramites.habeasData')
                  <div class="col-md-11 pl-1 pr-1 pt-3">
                     <p>Autorizo para que las comunicaciones, documentos y/o actos administrativos quela entidad
                        profiera a mi nombre sean notificados al correo registado al inicio de la solicitud</p>
                     @error('notificacion_correo')
                     <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                     </span>
                     @enderror
                     <div class="form-check-inline">
                        <label class="radiolist-govco radiobutton-govco">
                           <input type="radio" name="notificacion_correo" id="rb_si" value="SI" required checked />
                           <label for="rb_si">SI</label>
                        </label>
                     </div>
                     <div class="form-check-inline">
                        <label class="radiolist-govco radiobutton-govco">
                           <input type="radio" name="notificacion_correo" id="rb_no" value="NO" />
                           <label for="rb_no">NO</label>
                        </label>
                     </div>
                  </div>

                  <div class="col-md-12  pl-1 pr-1 pt-3 text-left mt-4" style="padding-left: 0px!important">

                     <button style="font-size:15px;" type="submit"
                        class="btn btn-round btn-middle btn_enviar_solicitud">Actualizar </button>

                     <button style="font-size:15px;" class="btn btn-round btn-middle btn_carga d-none" type="button"
                        disabled><span class="spinner-grow spinner-grow-sm text-primary" role="status"
                           aria-hidden="true"></span> Enviando...</button>
                  </div>
               </div>
            </form>
         </div>
         <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            @include('tramites.publicidad.informativo')
         </div>
      </div>
   </div>
</div>
@endsection
