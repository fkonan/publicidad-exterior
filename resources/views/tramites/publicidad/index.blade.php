@extends('layouts.app')
@section('title', 'Registro de publicidad exterior visual')
@section('content')

<div class="container" id="body_eventos">

   @include('tramites.titulo')

   <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
         <div class="card govco-card border-0 shadow-none" style="border-radius: 0px;">
            <h1 class="headline-xl-govco">@yield('title')</h1>
            <p style="text-align: justify">El presente proceso, tiene como finalidad la legalización de toda la
               Publicidad
               Exterior visual, Comercial e Institucional (entidades públicas), que pretendan la exhibición de la misma,
               en
               sus diferentes modalidades y etapas.
               Conforme al proceso se recomienda seguir las instrucciones y cargar la documentación completa. Para
               alguna
               orientación adicional, comunicarse al número: 6337000 ext 362.</p>
            <div class="row justify-content-around">
               <div class="col-auto">
                  <a href="/publicidad-exterior/inicio" class="btn btn-round btn-middle">Radicar nueva solicitud</a>
               </div>
               <div class="col-auto">
                  <button data-toggle="modal" data-target="#ModalConsulta" type="button"
                     class="btn btn-round btn-middle">Consultar solicitud</button>
               </div>

               <div class="col-auto">
                  <a href="/publicidad-exterior/DocConsulta" Style="font-size:15pt;">Anexar documentos
                     pendientes</a><br>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
         @include('tramites.publicidad.informativo')
      </div>
   </div>
</div>
@include('tramites.publicidad.form_consulta')

@endsection
