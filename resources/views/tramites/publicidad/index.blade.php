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
<div class="container mb-4 m-xs-x-3" id="body_eventos">
   @include('tramites.titulo')

   <div class="container-fluid">
      <div class="row mt-2">
         <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

            @include('tramites.publicidad.Introduccion')

            <form action="{{route('eventos.store')}}" method="POST" id="myForm" enctype="multipart/form-data"
               class="form-ciudadano">
               @csrf
               <div class="col-md-12 pl-1 pr-1 pt-3">
                  <h3 class="headline-l-govco mt-3 pl-0">Seleccione tipo de proceso</h3>
               </div>

               <a href="/publicidad-exterior/inicio" Style="font-size:15pt;">Solicitud de publicidad exterior</a><br>
               <a href="/publicidad-exterior/DocConsulta" Style="font-size:15pt;">Anexar documentos pendientes</a><br>
            </form>
         </div>
         <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            @include('tramites.publicidad.informativo')
         </div>
      </div>
   </div>
</div>
@include('tramites.publicidad.form_consulta')

@endsection