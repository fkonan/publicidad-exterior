@extends('layouts.menu')

@section('dashboard')
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
                        <a style="color: #004fbf;" class="breadcrumb-text" href="#">Tramites en Linea</a>
                     </div>
                  </li>
                  <li class="breadcrumb-item ">
                     <div class="image-icon">
                        <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                        <p class="ml-3 ml-md-0 "><b style="color: #004fbf;text-transform: none;">
                              Generales
                           </b></p>
                     </div>
                  </li>
               </ol>
            </nav>
         </div>
      </div>

      <div class="col-md-12 pt-4" style="padding-left: 10px!important">
         <h1 class="headline-xl-govco">Tramites Generales</h1>
         <div class="row pt-5">

            {{-- INICIO CARD  --}}
            <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
               <div class="card govco-card animate__animated animate__flipInX" style="max-height: 800px!important">
                  <div class="card-header govco-card-header">
                     <h4>
                        Certificado de predios del Municipio</h4>
                  </div>

                  <div class="card-body">
                     <p style="text-align: justify">El objetivo del tramite es generar automaticamente el certificado de predios del municipio, verificando la el estado del predio por numero o matricula correspondiente. <br><br><br></p>
                  <div class="card-footer govco-card-footer govco-center">
                     <a class="btn-low-mix-govco align-column-govco" href="{{ route('general.certificado.index') }}">
                        <span class="btn-mix-govco__title">Ver mas detalles</span>
                        <span class="btn-mix-govco__icon govco-icon govco-icon-simpled-arrow"></span>
                     </a>
                  </div>
               </div>
            </div>
            {{-- </ FIN CARD --}}


            {{-- INICIO CARD 
            <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
               <div class="card govco-card animate__animated animate__flipInX" style="max-height: 500px!important">
                  <div class="card-header govco-card-header">
                     <h4>
                        Permiso para espectáculos públicos diferentes a las artes escénicas</h4>
                  </div>

                  <div class="card-body">
                     <p style="text-align: justify"> Obtener la autorización para la realización de espectáculos públicos
                        diferentes a las artes escénicas previo cumplimiento de los requisitos establecidos en las normas
                        para su desarrollo. Dicha actividad no podrá realizarse sin autorización, y debe ser solicitado con
                        mínimo 15 días hábiles para su autorización.</p>
                  </div>
                  <div class="card-footer govco-card-footer govco-center mt-3">

                     <a class="btn-low-mix-govco align-column-govco" href="{{ route('interior.eventos.index') }}">
                        <span class="btn-mix-govco__title">Ver mas detalles</span>
                        <span class="btn-mix-govco__icon govco-icon govco-icon-simpled-arrow"></span>
                     </a>
                  </div>
               </div>
            </div> --}}
            {{-- </ FIN CARD --}}
            {{-- INICIO CARD --}}
            {{-- <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
               <div class="card govco-card animate__animated animate__flipInX" style="max-height: 500px!important">
                  <div class="card-header govco-card-header">
                     <h4>
                        Publicidad Exterior</h4>
                  </div>

                  <div class="card-body">
                     <p style="text-align: justify"> Obtener la autorización para la realización de espectáculos
                        públicos diferentes a las artes escénicas previo cumplimiento de los requisitos establecidos
                        en las normas para su desarrollo. Dicha actividad no podrá realizarse sin autorización, y
                        debe ser solicitado con mínimo 15 días hábiles para su autorización.</p>
                  </div>
                  <div class="card-footer govco-card-footer govco-center mt-3">

                     <a class="btn-low-mix-govco align-column-govco" href="{{ route('interior.publicidad.index') }}">
                        <span class="btn-mix-govco__title">Ver mas detalles</span>
                        <span class="btn-mix-govco__icon govco-icon govco-icon-simpled-arrow"></span>
                     </a>
                  </div>
               </div>
            </div> --}}
            {{-- </ FIN CARD --}}


         </div>
      </div>



   </div>
@endsection
