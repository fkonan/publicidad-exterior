@extends('layouts.menu')

@section('dashboard')
<style>
    body {
   overflow-x: hidden!important;
  } 
  .accordion-govco .card .card-header button{
   background-color: #004884!important;
  }
  .accordion-govco .card .card-header button.collapsed{
   margin-bottom: 0!important;
  }
  .link-tramite:hover{
   text-decoration: underline;
  }
</style>
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
                        <a style="color: #004fbf;" class="breadcrumb-text" href="/dashboard">Tramites en Linea</a>
                     </div>
                  </li>
                  <li class="breadcrumb-item ">
                     <div class="image-icon">
                        <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                        <p class="ml-3 ml-md-0 "><b style="color: #004fbf;text-transform: none;">
                              Reportes de Tramites en Linea
                           </b></p>
                     </div>
                  </li>
               </ol>
            </nav>
         </div>
      </div>

      <div class="col-md-12 pt-4" style="padding-left: 10px!important">
         <h1 class="headline-xl-govco">Reportes de Tramites en Linea y Sistemas de Información</h1>
         <div class="row pt-5">
           <div class="col-md-12"> 
            <div class="accordion accordion-govco" id="EjemploAccordion1">
               <div class="card">
                   <div class="card-header row no-gutters" id="headingUno">
                       <button class="btn-link row no-gutters collapsed" type="button" data-toggle="collapse" data-target="#collapseUno" aria-expanded="false" aria-controls="collapseUno">
                           <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                               <span class="title text-white">Secretaría de Planeacion</span>
                           </div>
                           <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                               <div class="btn-icon-close">                                  
                                   <span class="govco-icon govco-icon-minus"></span>
                                   <span class="govco-icon-plus govco-icon govco-icon-shortd-arrow-n size-1x" style="color:#FFFFFF"></span>
                               </div>
                           </div>
                       </button>
                   </div>
                   <div id="collapseUno" class="collapse" aria-labelledby="headingUno" data-parent="#EjemploAccordion1">
                       <div class="card-body bg-color-selago">
                           <p>
                              <ol>
                                 <li><h5 class="link-tramite"><a class="link-tramite" href="{{route('reportes.uso-suelo')}}">Tramite de concepto de uso de suelo</a></h5></li>
                                 <li><h5 class="link-tramite"><a class="link-tramite" href="{{route('reportes.presupuestos')}}">Presupuestos Participativos</a></h5></li>
                              </ol>
                           </p>
                       </div>
                   </div>
               </div>
               <div class="card">
                   <div class="card-header row no-gutters" id="headingDos">
                       <button class="btn-link row no-gutters collapsed" type="button" data-toggle="collapse" data-target="#collapseDos" aria-expanded="false" aria-controls="collapseDos">
                           <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                               <span class="title text-white">Secretaria Juridica</span>
                           </div>
                           <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                               <div class="btn-icon-close">                                  
                                   <span class="govco-icon govco-icon-minus"></span>
                                   <span class="govco-icon-plus govco-icon govco-icon-shortd-arrow-n size-1x" style="color:#FFFFFF"></span>
                               </div>
                           </div>
                       </button>
                   </div>
                   <div id="collapseDos" class="collapse" aria-labelledby="headingDos" data-parent="#EjemploAccordion1">
                       <div class="card-body bg-color-selago">
                        <p>
                            <ol>
                               <li><h5 class="link-tramite"><a class="link-tramite" href="{{route('reportes.rita')}}">Canal Denuncias AntiCorrupcion</a></h5></li>
                            </ol>
                         </p>
                       </div>
                   </div>
               </div>
               <div class="card">
                   <div class="card-header row no-gutters" id="headingTres">
                       <button class="btn-link row no-gutters collapsed" type="button" data-toggle="collapse" data-target="#collapseTres" aria-expanded="false" aria-controls="collapseTres">
                           <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                            <span class="title text-white">Secretaria de Hacienda</span>
                           </div>
                           <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                               <div class="btn-icon-close">                                 
                                   <span class="govco-icon govco-icon-minus"></span>
                                   <span class="govco-icon-plus govco-icon govco-icon-shortd-arrow-n size-1x" style="color:#FFFFFF"></span>

                               </div>
                           </div>
                       </button>
                   </div>
                   <div id="collapseTres" class="collapse" aria-labelledby="headingTres" data-parent="#EjemploAccordion1">
                       <div class="card-body bg-color-selago">
                        <p>
                            <ol>
                               <li><h5 class="link-tramite"><a class="link-tramite" href="{{route('reportes.impuestos')}}">Impuestos</a></h5></li>
                               <li><h5 class="link-tramite"><a class="link-tramite" href="{{route('reportes.empleo')}}">Empleabilidad Joven</a></h5></li>
                               <li><h5 class="link-tramite"><a class="link-tramite" href="{{route('reportes.metrolinea')}}">Subsidio Metrolinea</a></h5></li>
                               <li><h5 class="link-tramite"><a class="link-tramite" href="{{route('reportes.espectaculos')}}">Espectaculos Publicos</a></h5></li>
                            </ol>
                         </p>
                       </div>
                   </div>
               </div>
               <div class="card">
                   <div class="card-header row no-gutters" id="headingCuatro">
                       <button class="btn-link row no-gutters collapsed" type="button" data-toggle="collapse" data-target="#collapseCuatro" aria-expanded="false" aria-controls="collapseTres">
                           <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                            <span class="title text-white">Secretaria de Educacion</span>
                           </div>
                           <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                               <div class="btn-icon-close">                                 
                                   <span class="govco-icon govco-icon-minus"></span>
                                   <span class="govco-icon-plus govco-icon govco-icon-shortd-arrow-n size-1x" style="color:#FFFFFF"></span>

                               </div>
                           </div>
                       </button>
                   </div>
                   <div id="collapseCuatro" class="collapse" aria-labelledby="headingCuatro" data-parent="#EjemploAccordion1">
                       <div class="card-body bg-color-selago">
                        <p>
                            <ol>
                               <li><h5 class="link-tramite"><a class="link-tramite" href="{{route('reportes.becas')}}">Convocatoria de Subsidio de Educación Superior</a></h5></li>
                            </ol>
                         </p>
                       </div>
                   </div>
               </div>
               <div class="card">
                   <div class="card-header row no-gutters" id="headingCinco">
                       <button class="btn-link row no-gutters collapsed" type="button" data-toggle="collapse" data-target="#collapseCinco" aria-expanded="false" aria-controls="collapseTres">
                           <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                            <span class="title text-white">Secretaria de Salud y Ambiente</span>
                           </div>
                           <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                               <div class="btn-icon-close">                                 
                                   <span class="govco-icon govco-icon-minus"></span>
                                   <span class="govco-icon-plus govco-icon govco-icon-shortd-arrow-n size-1x" style="color:#FFFFFF"></span>

                               </div>
                           </div>
                       </button>
                   </div>
                   <div id="collapseCinco" class="collapse" aria-labelledby="headingCinco" data-parent="#EjemploAccordion1">
                       <div class="card-body bg-color-selago">
                        <p>
                            <ol>
                               <li><h5 class="link-tramite"><a class="link-tramite" href="{{route('reportes.lactante')}}">Salas Amigas de la Familia Lactante en el Entorno Laboral</a></h5></li>
                               <li><h5 class="link-tramite"><a class="link-tramite" href="{{route('reportes.discapacidad')}}">Autorización de la certificacion de la discapacidad</a></h5></li>
                               <li><h5 class="link-tramite"><a class="link-tramite" href="{{route('reportes.rh1')}}">Reportes RH1</a></h5></li>
                            </ol>
                         </p>
                       </div>
                   </div>
               </div>
               <div class="card">
                   <div class="card-header row no-gutters" id="headingSeis">
                       <button class="btn-link row no-gutters collapsed" type="button" data-toggle="collapse" data-target="#collapseSeis" aria-expanded="false" aria-controls="collapseTres">
                           <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                            <span class="title text-white">Secretaria de Interior</span>
                           </div>
                           <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                               <div class="btn-icon-close">                                 
                                   <span class="govco-icon govco-icon-minus"></span>
                                   <span class="govco-icon-plus govco-icon govco-icon-shortd-arrow-n size-1x" style="color:#FFFFFF"></span>

                               </div>
                           </div>
                       </button>
                   </div>
                   <div id="collapseSeis" class="collapse" aria-labelledby="headingSeis" data-parent="#EjemploAccordion1">
                       <div class="card-body bg-color-selago">
                        <p>
                            <ol>
                               <li><h5 class="link-tramite"><a class="link-tramite" href="{{route('reportes.categorizacion')}}">Categorización de Parqueaderos</a></h5></li>
                               <li><h5 class="link-tramite"><a class="link-tramite" href="{{route('reportes.espectaculosArtes')}}">Permiso para espectáculos públicos diferentes a las artes escénicas. </a></h5></li>
                            </ol>
                         </p>
                       </div>
                   </div>
               </div>
               <div class="card">
                <div class="card-header row no-gutters" id="headingSiete">
                    <button class="btn-link row no-gutters collapsed" type="button" data-toggle="collapse" data-target="#collapseSiete" aria-expanded="false" aria-controls="collapseTres">
                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                         <span class="title text-white">Oficina TIC</span>
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                            <div class="btn-icon-close">                                 
                                <span class="govco-icon govco-icon-minus"></span>
                                <span class="govco-icon-plus govco-icon govco-icon-shortd-arrow-n size-1x" style="color:#FFFFFF"></span>

                            </div>
                        </div>
                    </button>
                </div>
                <div id="collapseSiete" class="collapse" aria-labelledby="headingSiete" data-parent="#EjemploAccordion1">
                    <div class="card-body bg-color-selago">
                     <p>
                         <ol>
                            <li><h5 class="link-tramite"><a class="link-tramite" href="{{route('reportes.intranet')}}">Intranet</a></h5></li>
                         </ol>
                      </p>
                    </div>
                </div>
            </div>
             </div>

           </div>
           <div class="col-md-3 pl-0 mr-0">
            <a class="btn btn-round btn-high" href="{{ URL::route('dashboard.index') }}"
                style="float: left;">Volver</a>
        </div>
            

         </div>
      </div>



   </div>
@endsection
