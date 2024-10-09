@extends('layouts.menu')

@section('dashboard')

<style>
   th.sorting_desc::after,
   th.sorting_asc::after {
      right: 0 !important;
      content: "" !important;
   }
</style>

<?php $tramite = 'PUBLICIDAD EXTERIOR'; ?>

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
                     <a style="color: #004fbf;" class="breadcrumb-text" href="#">Trámites en Línea</a>
                  </div>
               </li>
               <li class="breadcrumb-item ">
                  <div class="image-icon">
                     <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                     <a style="color: #004fbf;" class="breadcrumb-text" href="#">
                        Interior</a>
                  </div>
               </li>
               <li class="breadcrumb-item ">
                  <div class="image-icon">
                     <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                     <p class="ml-3 ml-md-0 "><b style="color: #004fbf;text-transform: none;">
                           Publicidad exterior
                        </b></p>
                  </div>
               </li>
            </ol>
         </nav>
      </div>
   </div>

   <div class="row pt-4" style="padding-left: 10px!important">
      <h1 class="headline-xl-govco">Listado de modalidades</h1>
      <div class="row">

         <div class="col-md-6">
            <div class="card govco-card">
               <div class="card-header govco-card-header">
                  <span class="govco-icon govco-icon-analytic-p"> </span>
                  VALLAS COMERCIALES
                  <span class="badge badge-warning">{{ $count_vallas }}</span>
               </div>
               <div class="card-body">
                  <p class="card-text">A continuación se listarán las solicitudes de esta modalidad</p>
               </div>
               <div class="card-footer govco-card-footer govco-center">
                  <a class="btn-low-mix-govco align-column-govco"
                     href="{{ route('interior.publicidad.listarSolicitudes', 'vallas') }}">
                     <span class="btn-mix-govco__title">Ver más detalles</span>
                     <span class="btn-mix-govco__icon govco-icon govco-icon-simpled-arrow"></span>
                  </a>
               </div>
            </div>
         </div>

         <div class="col-md-6">
            <div class="card govco-card">
               <div class="card-header govco-card-header">
                  <span class="govco-icon govco-icon-analytic-p"> </span>
                  AVISOS TIPO COLOMBINA
                  <span class="badge badge-warning">{{ $count_colombina }}</span>
               </div>
               <div class="card-body">
                  <p class="card-text">A continuación se listarán las solicitudes de esta modalidad</p>
               </div>
               <div class="card-footer govco-card-footer govco-center">

                  <a class="btn-low-mix-govco align-column-govco"
                     href="{{ route('interior.publicidad.listarSolicitudes', 'colombina') }}">
                     <span class="btn-mix-govco__title">Ver más detalles</span>
                     <span class="btn-mix-govco__icon govco-icon govco-icon-simpled-arrow"></span>
                  </a>
               </div>
            </div>
         </div>

         <div class="col-md-6">
            <div class="card govco-card">
               <div class="card-header govco-card-header">
                  <span class="govco-icon govco-icon-analytic-p"> </span>
                  AVISOS DE IDENTIFICACIÓN DE PROYECTOS INMOBILIARIOS
                  <span class="badge badge-warning">{{ $count_inmobiliarios }}</span>
               </div>
               <div class="card-body">
                  <p class="card-text">A continuación se listarán las solicitudes de esta modalidad</p>
               </div>
               <div class="card-footer govco-card-footer govco-center">
                  <a class="btn-low-mix-govco align-column-govco"
                     href="{{ route('interior.publicidad.listarSolicitudes', 'inmobiliarios') }}">
                     <span class="btn-mix-govco__title">Ver más detalles</span>
                     <span class="btn-mix-govco__icon govco-icon govco-icon-simpled-arrow"></span>
                  </a>
               </div>
            </div>
         </div>

         <div class="col-md-6">
            <div class="card govco-card">
               <div class="card-header govco-card-header">
                  <span class="govco-icon govco-icon-analytic-p"> </span>
                  AVISOS DE IDENTIFICACIÓN DE ESTABLECIMIENTOS COMERCIALES
                  <span class="badge badge-warning">{{ $count_comerciales }}</span>
               </div>
               <div class="card-body">
                  <p class="card-text">A continuación se listarán las solicitudes de esta modalidad</p>
               </div>
               <div class="card-footer govco-card-footer govco-center">

                  <a class="btn-low-mix-govco align-column-govco"
                     href="{{ route('interior.publicidad.listarSolicitudes', 'comerciales') }}">
                     <span class="btn-mix-govco__title">Ver más detalles</span>
                     <span class="btn-mix-govco__icon govco-icon govco-icon-simpled-arrow"></span>
                  </a>
               </div>
            </div>
         </div>





         <div class="col-md-6">
            <div class="card govco-card">
               <div class="card-header govco-card-header">
                  <span class="govco-icon govco-icon-analytic-p"> </span>
                  PUBLICIDAD AÉREA
                  <span class="badge badge-warning">{{ $count_aerea }}</span>
               </div>
               <div class="card-body">
                  <p class="card-text">A continuación se listarán las solicitudes de esta modalidad</p>
               </div>
               <div class="card-footer govco-card-footer govco-center">

                  <a class="btn-low-mix-govco align-column-govco"
                     href="{{ route('interior.publicidad.listarSolicitudes', 'aerea') }}">
                     <span class="btn-mix-govco__title">Ver más detalles</span>
                     <span class="btn-mix-govco__icon govco-icon govco-icon-simpled-arrow"></span>
                  </a>
               </div>
            </div>
         </div>



         <div class="col-md-6">
            <div class="card govco-card">
               <div class="card-header govco-card-header">
                  <span class="govco-icon govco-icon-analytic-p"> </span>
                  MURALES ARTISTICOS
                  <span class="badge badge-warning">{{ $count_murales }}</span>
               </div>
               <div class="card-body">
                  <p class="card-text">A continuación se listarán las solicitudes de esta modalidad</p>
               </div>
               <div class="card-footer govco-card-footer govco-center">

                  <a class="btn-low-mix-govco align-column-govco"
                     href="{{ route('interior.publicidad.listarSolicitudes', 'murales') }}">
                     <span class="btn-mix-govco__title">Ver más detalles</span>
                     <span class="btn-mix-govco__icon govco-icon govco-icon-simpled-arrow"></span>
                  </a>
               </div>
            </div>
         </div>

         <div class="col-md-4">
            <div class="card govco-card">
               <div class="card-header govco-card-header">
                  <span class="govco-icon govco-icon-analytic-p"> </span>
                  PENDONES
                  <span class="badge badge-warning">{{ $count_pendones }}</span>
               </div>
               <div class="card-body">
                  <p class="card-text">A continuación se listarán las solicitudes de esta modalidad</p>
               </div>
               <div class="card-footer govco-card-footer govco-center">
                  <a class="btn-low-mix-govco align-column-govco"
                     href="{{ route('interior.publicidad.listarSolicitudes', 'pendones') }}">
                     <span class="btn-mix-govco__title">Ver más detalles</span>
                     <span class="btn-mix-govco__icon govco-icon govco-icon-simpled-arrow"></span>
                  </a>
               </div>
            </div>
         </div>

         <div class="col-md-4">
            <div class="card govco-card">
               <div class="card-header govco-card-header">
                  <span class="govco-icon govco-icon-analytic-p"> </span>
                  PASACALLES
                  <span class="badge badge-warning">{{ $count_pasacalles }}</span>
               </div>
               <div class="card-body">
                  <p class="card-text">A continuación se listarán las solicitudes de esta modalidad</p>
               </div>
               <div class="card-footer govco-card-footer govco-center">

                  <a class="btn-low-mix-govco align-column-govco"
                     href="{{ route('interior.publicidad.listarSolicitudes', 'pasacalles') }}">
                     <span class="btn-mix-govco__title">Ver más detalles</span>
                     <span class="btn-mix-govco__icon govco-icon govco-icon-simpled-arrow"></span>
                  </a>
               </div>
            </div>
         </div>

         <div class="col-md-4">
            <div class="card govco-card">
               <div class="card-header govco-card-header">
                  <span class="govco-icon govco-icon-analytic-p"> </span>
                  PUBLICIDAD MOVIL
                  <span class="badge badge-warning">{{ $count_movil }}</span>
               </div>
               <div class="card-body">
                  <p class="card-text">A continuación se listarán las solicitudes de esta modalidad</p>
               </div>
               <div class="card-footer govco-card-footer govco-center">

                  <a class="btn-low-mix-govco align-column-govco"
                     href="{{ route('interior.publicidad.listarSolicitudes', 'movil') }}">
                     <span class="btn-mix-govco__title">Ver más detalles</span>
                     <span class="btn-mix-govco__icon govco-icon govco-icon-simpled-arrow"></span>
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
