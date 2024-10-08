<!DOCTYPE html>
<html lang="es">

<head>
   @yield('analitycs')
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">

   <!-- Icono -->
   <link href="{{asset('img/icono.png')}}" rel="icon">
   <link href="{{asset('img/icono.png')}}" rel="apple-touch-icon">

   <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700"
      rel="stylesheet">
   <link href="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
   <link href="https://cdn.www.gov.co/v2/assets/cdn.min.css" rel="stylesheet">
   <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
   <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
   <link rel="stylesheet" type="text/css" href="{{asset('css/step.css')}}">
   <link rel="stylesheet" type="text/css" href="{{asset('css/footer.min.css')}}">
   <link rel="stylesheet" type="text/css" href="{{asset('css/inputfile.min.css')}}">
   <link rel="stylesheet" type="text/css" href="{{asset('css/card.min.css')}}">

   <link rel="stylesheet" type="text/css"
      href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css">

   {{-- animate css --}}

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />


   {{-- LIBRARY INPUT FILE --}}
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" crossorigin="anonymous">
   <link href="{{asset('library/BoostrapFile/css/fileinput.css')}}" media="all" rel="stylesheet" type="text/css" />
   <link href="{{asset('library/BoostrapFile/themes/explorer-fas/theme.css')}}" media="all" rel="stylesheet"
      type="text/css" />
   {{-- datatables--}}
   <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />

   {{-- clock picker --}}
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.min.css"
      integrity="sha512-MT4B7BDQpIoW1D7HNPZNMhCD2G6CDXia4tjCdgqQLyq2a9uQnLPLgMNbdPY7g6di3hHjAI8NGVqhstenYrzY1Q=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />

   {{-- captcha --}}
   {{-- <script src='https://www.google.com/recaptcha/api.js'></script> --}}

   <title>@yield('title')</title>
</head>

<body id="body">

   <nav class="navbar navbar-expand-lg fixed-top navbar-govco" id="nav-header" style="height:48px;">
      <div class="navbar-container container pl-2" style="height:48px;">
         <div class="navbar-logo float-left">
            <a class="navbar-brand" href="https://www.gov.co/" target="_blank" title="Ir al portal Gov.co">
               <img src="https://cdn.www.gov.co/assets/images/logo.png" height="30" alt="Logo Gov.co"
                  title="Ir al portal Gov.co" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapsible"
               aria-controls="navbarCollapsible" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
            </button>
         </div>
         <div class="collapse navbar-collapse float-right">
            <div class="nav-primary mx-auto">
               <ul class="navbar-nav ml-auto nav-items nav-items-desktop">
               </ul>
            </div>
            <div class="nav-link ml-auto mr-2 text-white">
               <p class="content-link my-0">
                  <a class="btn-low" href="https://www.gov.co/" target="_blank" tabindex="-1">
                     Ir a Gov.co
                  </a>
               </p>
            </div>
         </div>
      </div>
      <div class='nav-secondary show-transition' id="nav-secondary" style="background: #FFF!important">
         <!--<div class="container">
           <div class="collapse navbar-collapse navbar-first-menu">
              <ul class="navbar-nav w-100 d-flex nav-items nav-items-desktop">
                 <li class="nav-item">
                    <a href="https://www.bucaramanga.gov.co/Inicio/" target="_blank" class="nav-link">Pagina Principal</a>
                 </li>
                 <li class="nav-item active">
                    <a href="/ficha-tramites-y-servicios/" class="nav-link">Trámites y servicios</a>
                 </li>

              </ul>
           </div>
        </div>--->
      </div>
      <div class="navbar-nav navbar-notifications" id="notificationHeader"></div>
   </nav>

   <section class="container">
      <div class="row" style="padding-top: 6%;">
         <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="container-fluid">
               <a href="https://www.bucaramanga.gov.co/" target="_blank"
                  title="Ir al Portal Inicio Alcaldia de Bucaramanga">
                  <img src="{{ asset('img/ALCALDIA.png') }}" alt="logo Alcaldia"
                     title="Ir al Portal Inicio Alcaldia de Bucaramanga" class="img_alcaldia img-fluid float-left mt-2"
                     width="100px" height="100px">
               </a>

            </div>
         </div>
      </div>
   </section>


   <main class="py-2">
      @yield('content')
   </main>
   {{-- inlcude sweetalert --}}
   @include('sweetalert::alert')

   <footer class="gov-co-footer">
      <div class="gov-co-footer-presetacion gov-co-footer-tramites">
         <div class="gov-co-footer-autoridad" style="border-radius:10px!important;">
            <div class="footer-titulo">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col">
                        <h5 class="headline-l-govco" tabindex="200">Alcaldía de Bucaramanga</h5>
                        <h5 class="headline-l-govco" tabindex="201">Sede principal</h5>
                     </div>
                  </div>
               </div>
            </div>
            <div class="footer-logo-autoridad">
               <div class="containder-fluid">
                  <div class="row">
                     <div class="col">
                        <a href="https://www.bucaramanga.gov.co/" target="_blank"
                           title="Ir al Portal Inicio Alcaldia de Bucaramanga">
                           <img src="{{ asset('img/ALCALDIA.png') }}" class="img-fluid" width="100px" height="100px"
                              alt="logo Alcaldia" title="Ir al Portal Inicio Alcaldia de Bucaramanga">
                        </a>

                     </div>
                  </div>
               </div>
            </div>
            <div class="footer-presentacion">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col">
                        {{-- vacio --}}
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="contenido-sede-gov-co gov-detalles">
                           <p style="font-size:0.9rem;" tabindex="202"><b style="font-size:0.9rem;">Dirección Fase I:
                              </b> Calle 35 # 10-43, Bucaramanga, Colombia.</p>
                           <p style="font-size:0.9rem;" tabindex="203"><b style="font-size:0.9rem;">Código Postal:</b>
                              680006. Código Dane: 68001.</p>
                           <p style="font-size:0.9rem;" tabindex="204"><b style="font-size:0.9rem;">Horario de
                                 Atención:</b> Lunes a jueves de 07:00 a.m. a 12:00 m y de 01:00 p.m. a 05:30 p.m. /
                              Viernes de 07:00 a.m. a 04:00 p.m.</p>
                           <p style="font-size:0.9rem;"> <b style="font-size:0.9rem;">Teléfono Conmutador:</b> <a
                                 href="tel:6076337000" style="font-size:0.9rem;" tabindex="205"> (607) 633 70 00</a></p>
                           <p style="font-size:0.9rem;"> <b style="font-size:0.9rem;">Linea Gratuita:</b> <a
                                 href="tel:6076525555" style="font-size:0.9rem;" tabindex="206"> (607) 652 55 55</a></p>
                           <p style="font-size:0.9rem;"> <b style="font-size:0.9rem;">Correo Institucional:</b> <a
                                 href="mailto:contactenos@bucaramanga.gov.co" style="font-size:0.9rem; "
                                 tabindex="207">contactenos@bucaramanga.gov.co</a></p>
                           <p style="font-size:0.9rem;"> <b style="font-size:0.9rem;">Correo de notificaciones
                                 judiciales:</b> <a href="mailto:notificaciones@bucaramanga.gov.co"
                                 style="font-size:0.9rem;" tabindex="208">notificaciones@bucaramanga.gov.co</a></p>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="gov-co-redes-sociales">
                           <a class="gov-co-link-presentacion" href="https://www.facebook.com/alcaldiadebucaramanga/"
                              target="_blank" tabindex="209" title="Sitio Oficial Facebook de Alcaldia de Bucaramanga">
                              <img src="https://www.bucaramanga.gov.co/wp-content/uploads/2021/03/icon_face.png"
                                 alt="Logo Facebook">
                              {{-- <span class="fab fa-facebook" style="color:#004884"></span>
                              --}}@alcaldiadebucaramanga

                           </a>
                           <a class="gov-co-link-presentacion" href="https://twitter.com/AlcaldiaBGA" target="_blank"
                              tabindex="210" title="Sitio Oficial Twitter de Alcaldia de Bucaramanga">
                              <img src="https://www.bucaramanga.gov.co/wp-content/uploads/2021/03/icon_tweeter.png"
                                 alt="Logo Twitter">@AlcaldiaBGA
                           </a>
                           <a class="gov-co-link-presentacion" href="https://www.instagram.com/alcaldiabga/"
                              target="_blank" tabindex="211"
                              title="Sitio Oficial Instragram de Alcaldia de Bucaramanga">
                              <img src="https://www.bucaramanga.gov.co/wp-content/uploads/2021/03/icon_insta.png"
                                 alt="Logo Instagram">
                              @alcaldiabga
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="footer-politicas poli-tramites">
               <div class="container-fluid">
                  <div class="row p-0">
                     <div class="col-md-12 col-xs-12 co-12 p-0">
                        <div class="gov-co-politicas">
                           <a class="goc-co-link-poli"
                              href="https://www.bucaramanga.gov.co/wp-content/uploads/2018/12/Resolucion-340-Dic-26-2018-y-Politica.pdf"
                              target="_blank" tabindex="212">Política de tratamiento de datos personales</a><br>
                           <a class="goc-co-link-poli" href="https://www.bucaramanga.gov.co/mapa-del-sitio/"
                              target="_blank" tabindex="213">Mapa del sitio</a>
                           <a class="goc-co-link-poli"
                              href="https://www.bucaramanga.gov.co/autorizacion-de-tratamiento-de-datos-personales/"
                              target="_blank" tabindex="214">Autorización de tratamiento de datos personales</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="gov-co-footer-pie">
         <div class="py-3 row mx-2">
            <div class="col-md-1"></div>
            <div class="col-md-4">

               <div class="d-inline"> <a href="https://www.colombia.co/" target="_blank" title="Ir a Marca Colombia">
                     <img class="img-fluid" src="{{ asset('img/logo_colombia.png') }}" style="height:40px!important;"
                        alt="Logo Marca Colombia" title="Ir Marca Colombia" /></a></div>
               <div class="d-inline border-right"></div>
               <div class="d-inline" style><a href="https://www.gov.co/" target="_blank" title="Ir a Portal GOV.CO"><img
                        class="img-fluid" src="https://cdn.www.gov.co/assets/images/logo.png" width="120" height="60"
                        alt="Logo Gov.co" title="Ir a Portal GOV.CO" /></a> </div>
            </div>
            <div class="col-md-5 d-flex justify-content-end">
               <p class="content-link my-0 text-white">
                  <a class="text-white" href="https://www.gov.co/" target="_blank" tabindex="215">
                     Conoce GOV.CO aquí
                  </a>
               </p>
            </div>
            <div class="col-md-2"></div>
         </div>
      </div>
   </footer>

   <!-- BARRA DE ACCESIBILIDAD -->
   <div class="block block--gov-accessibility">
      <div class="block-options">
         <a class="contrast-ref">
            <span class="govco-icon govco-icon-contrast-n"></span>
            <label> Contraste </label>
         </a>
         <a class="min-fontsize">
            <span class="govco-icon govco-icon-less-size-n"></span>
            <label class="align-middle"> Reducir letra </label>
         </a>
         <a class="max-fontsize">
            <span class="govco-icon govco-icon-more-size-n"></span>
            <label class="align-middle"> Aumentar letra </label>
         </a>
         <a target="_blank" href="https://centroderelevo.gov.co/632/w3-channel.html">
            <span class="govco-icon govco-icon-relief-n"></span>
            <label class="align-middle"> Centro de relevo </label>
         </a>
      </div>
   </div>
   {{-- volver arriba --}}

   <div class="scroll-to-top show-scrollTop">
      <button type="button" class="ir-arriba">
         <span class="govco-icon govco-icon-shortu-arrow-n btn-svg-up-hover">
         </span>
         <span class="label-button-star-up">
            <h6 class="mt-2">Volver a arriba</h6>
         </span>
      </button>
   </div>

   {{-- alerta --}}
   <div class="alert-wrong-govco alert alert-dismissible d-none" style="background:#A80521!important;"
      id="alert-gov-co-error" aria-label="Alerta: caso de error">
      <div class="alert-heading">
         <span class="govco-icon govco-icon-sad-face-n size-2x" style="color:#fff!important;"></span>
         <span class="headline-l-govco" style="color:#fff!important;">Debes escribir una sugerencia</span>
      </div>
   </div>



   <div class="modal fade" id="loadMe" tabindex="-1" role="dialog" aria-labelledby="loadMeLabel">
      <div class="modal-dialog modal-sm" role="document">
         <div class="modal-content">
            <div class="modal-body text-center">
               <div class="loader"></div>
               <div clas="loader-txt">
                  <p>Enviando solicitud <br><br><small>Por favor espere...
                     </small></p>
               </div>
            </div>
         </div>
      </div>
   </div>



   {{-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"
      integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script> --}}
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
      integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
      integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
   </script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
   </script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   {{-- DATATABLES --}}
   <!-- js jquery datatable -->
   <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
   {{-- LIBRARY INPUT FILE --}}
   <script src="{{asset('library/BoostrapFile/js/plugins/piexif.js')}}" type="text/javascript"></script>
   <script src="{{asset('library/BoostrapFile/js/plugins/sortable.js')}}" type="text/javascript"></script>
   <script src="{{asset('library/BoostrapFile/js/fileinput.js')}}" type="text/javascript"></script>
   <script src="{{asset('library/BoostrapFile/js/locales/es.js')}}" type="text/javascript"></script>
   <script src="{{asset('library/BoostrapFile/themes/fas/theme.js')}}" type="text/javascript"></script>
   <script src="{{asset('library/BoostrapFile/themes/explorer-fas/theme.js')}}" type="text/javascript"></script>

   {{-- clockpikcer--}}
   <script src="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/jquery-clockpicker.min.js"
      integrity="sha512-x0qixPCOQbS3xAQw8BL9qjhAh185N7JSw39hzE/ff71BXg7P1fkynTqcLYMlNmwRDtgdoYgURIvos+NJ6g0rNg=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   {{-- moment js --}}
   <script type="text/javascript" src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>

   <!--- cdn  GOV.CO --->
   <script type="text/javascript" src="{{ asset('js/inputfile.js') }}"></script>
   <script type="text/javascript" src="{{ asset('js/funciones.js') }}"></script>
   <script type="text/javascript" src="{{ asset('js/validate.js') }}"></script>
   <script type="text/javascript" src="{{ asset('js/utils.js') }}"></script>
   <script type="text/javascript" src="{{ asset('js/dadep.js') }}"></script>
   <script type="text/javascript" src="{{ asset('js/publicidad_exterior.js') }}"></script>
   @stack('scripts')



</body>

</html>
