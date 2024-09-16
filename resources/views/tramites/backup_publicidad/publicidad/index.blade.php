@extends('layouts.app')

@section('title', 'Publicidad Exterior Visual')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container mt-3 mb-4 m-xs-x-3">
   <div class="row pl-4">
      <div class="px-0 col-md-9 col-xs-12 col-sm-12">
         <nav aria-label="Miga de pan" style="max-height: 20px;">
            <ol class="breadcrumb" style="background-color: #FFFFFF;">
               <li class="breadcrumb-item ml-3 ml-md-0">
                  <a style="color: #004fbf;" class="breadcrumb-text" href="https://www.gov.co/home/">Inicio</a>
               </li>
               <li class="breadcrumb-item ">
                  <div class="image-icon">
                     <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                     <a style="color: #004fbf;" class="breadcrumb-text" href="#">Tramites y servicios</a>
                  </div>
               </li>
               <li class="breadcrumb-item ">
                  <div class="image-icon">
                     <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                     <p class="ml-3 ml-md-0 "><b style="color: #004fbf;text-transform: none;">
                           Publicidad Exterior Visual
                        </b></p>
                  </div>
               </li>
            </ol>
         </nav>
      </div>
   </div>

   <div class="container-fluid">
      <div class="row mt-2">
         <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
            <div class="col-md-12" style="padding-left: 0!important">
               <div class="card step-progress border-0" style="font-size: 10px;">
                  <div class="step-slider">
                     <div data-id="step2" class="step-slider-item active">
                        <p style="padding-top: 0px;margin-top:5px;color: #3366CC;" id="barra_progreso"><span class="circle_uno">1</span> Inicio</p>
                     </div>
                     <div data-id="step3" class="step-slider-item">
                        <p style="padding-top: 0px;margin-top:5px;color: #3366CC" id="barra_progreso"><span class="circle_uno">2 </span> Hago mi solicitud</p>
                     </div>
                     <div data-id="step4" class="step-slider-item">
                        <p style="padding-top: 0px;margin-top:5px;" id="barra_progreso"><span class="circle_dos">3</span>Procesan mi solicitud</p>
                     </div>
                     <div data-id="step5" class="step-slider-item">
                        <p style="padding-top: 0px;margin-top:5px;" id="barra_progreso"><span class="circle_dos">4</span> Respuesta</p>
                     </div>
                  </div>
               </div>
            </div>

            <form action="{{ route('publicidad.store') }}" method="POST" id="myForm" enctype="multipart/form-data" class="form-ciudadano">
               @csrf
               @if ($errors->any())
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                           @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                           @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
               @endif
               <div class="card govco-card border-0 shadow-none" style="border-radius: 0px;">

                  <h1 class="headline-xl-govco">Publicidad Exterior Visual</h1>

                  <div class="alert-primary-govco alert alert-dismissible fade show mt-3" aria-label="Alerta informativa">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar" title="Cerrar">&times;</button>
                     <div class="alert-heading">
                        <span class="govco-icon govco-icon-bell-sound-p size-2x"></span>
                        <span class="headline-l-govco">Importante</span>
                     </div>
                     <p style="text-align: justify"> Descripción del tramite </p>
                  </div>

                  <h3 class="headline-l-govco mt-3 pl-0">1. Datos Generales de la Solicitud</h3>

                  <div class="row">
                     <div class="col-md-12 form-group">
                        <label for="modalidad" class="form-label">Modalidad de publicidad * </label>
                        <select class="form-control  @error('modalidad') is-invalid @enderror" name="modalidad" id="modalidad" required>
                           <option value="">Seleccione</option>
                           <option value="VALLAS" data-valor="/publicidad-exterior/cargarDatosVallas" data-mod="vallas">VALLAS COMERCIALES - PANTALLAS LED - TABLEROS ELECTRONICOS</option>
                           <option value="PENDONES" data-valor="/publicidad-exterior/cargarDatosPendones" data-mod="avisos">AVISOS Y PENDONES</option>
                           <option value="MURALES" data-valor="/publicidad-exterior/cargarDatosMurales" data-mod="murales">MURALES ARTISTICOS EN PROPIEDAD PRIVADA</option>
                           <option value="PASACALLES" data-valor="/publicidad-exterior/cargarDatosPasacalles" data-mod="pasacalles">PASACALLES PARA ENTIDADES
                              PUBLICAS</option>
                           <option value="PUBLICIDAD AEREA" data-valor="/publicidad-exterior/cargarDatosAerea" data-mod="aerea">PUBLICIDAD AEREA</option>
                           <option value="MOVIL" data-valor="/publicidad-exterior/cargarDatosMovil" data-mod="movil">PUBLICIDAD MOVIL</option>
                        </select>

                        @error('modalidad')
                        <span class="invalid-feedback" role="alert">
                           <strong class="text-danger">{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  
                  <div class="row">
                     <div class="col-md-4">
                        <label for="tipo_publicidad" class="form-label">Tipo de publicidad <code>*</code>
                        </label>
                        <select class="form-control  @error('tipo_publicidad') is-invalid @enderror" name="tipo_publicidad" id="tipo_publicidad" required>
                           <option value="">Seleccione</option>
                           <option value="RENOVACION" {{ old('tipo_publicidad') == 'RENOVACION' ? 'selected' : '' }}>RENOVACIÓN
                           </option>
                           <option value="PRIMERA VEZ" {{ old('tipo_publicidad') == 'PRIMERA VEZ' ? 'selected' : '' }}>PRIMERA VEZ
                           </option>
                        </select>

                        @error('modadalidad')
                        <span class="invalid-feedback" role="alert">
                           <strong class="text-danger">{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>

                     <div class="col-md-4">
                        <label for="publicidad_instalada" class="form-label">Publicidad instalada? *
                        </label>
                        <select class="form-control  @error('publicidad_instalada') is-invalid @enderror" name="publicidad_instalada" id="publicidad_instalada" required>
                           <option value="">Seleccione</option>
                           <option value="SI">SI</option>
                           <option value="NO">NO</option>
                        </select>

                        @error('publicidad_instalada')
                        <span class="invalid-feedback" role="alert">
                           <strong class="text-danger">{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>

                     <div class="col-md-4 d-none" id="div_fecha_instalacion">
                        <label for="fecha_instalacion" class="form-label">Fecha de instalación
                           <code>*</code> </label>
                        <input type="date" value="{{ old('fecha_instalacion') }}" class="form-control  @error('fecha_instalacion') is-invalid @enderror" name="fecha_instalacion" id="fecha_instalacion">

                        @error('fecha_instalacion')
                        <span class="invalid-feedback" role="alert">
                           <strong class="text-danger">{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  
                  <div class="row form-group">
                     <div class="col-md-4">
                        <label for="numero_elementos" class="form-label">Número de elementos <code>*</code>
                        </label>
                        <input type="number" value="{{ old('numero_elementos') }}" class="form-control  @error('numero_elementos') is-invalid @enderror" name="numero_elementos" id="numero_elementos" required>

                        @error('numero_elementos')
                        <span class="invalid-feedback" role="alert">
                           <strong class="text-danger">{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                     
                     <div class="col-md-4">
                        <label for="ancho_publicidad" class="form-label">Ancho de la publicidad
                           <code>*</code> </label>
                        <input type="number" value="{{ old('ancho_publicidad') }}" class="form-control  @error('ancho_publicidad') is-invalid @enderror" name="ancho_publicidad" id="ancho_publicidad" required>

                        @error('ancho_publicidad')
                        <span class="invalid-feedback" role="alert">
                           <strong class="text-danger">{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                     
                     <div class="col-md-4">
                        <label for="alto_publicidad" class="form-label">Alto de la publicidad <code>*</code>
                        </label>
                        <input type="number" value="{{ old('alto_publicidad') }}" class="form-control  @error('alto_publicidad') is-invalid @enderror" name="alto_publicidad" id="alto_publicidad" required>

                        @error('alto_publicidad')
                        <span class="invalid-feedback" role="alert">
                           <strong class="text-danger">{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-12">
                        <label for="observacion_medidas" class="form-label">Observaciones de las medidas
                           <code>*</code> </label>
                        <textarea name="observacion_medidas" class="form-control" rows="5" placeholder="Digita las observaciones" id="observacion_medidas" maxlength="300"></textarea>

                        @error('observacion_medidas')
                        <span class="invalid-feedback" role="alert">
                           <strong class="text-danger">{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-12 form-group">
                        <label for="ubicacion_aviso" class="form-label">Dirección o Nomenclatura del aviso <code>*</code></label>
                        <button type="button" class="btn btn-link">
                           <span style="text-transform: lowercase; font-size: 12px;" class="text-primary" data-toggle="modal" data-target="#ModalDireccionesAviso" data-focus="true">(Clic para insertar dirección)
                           </span>
                        </button>
                        <input type="text" value="{{ old('ubicacion_aviso') }}" class="form-control @error('ubicacion_aviso') is-invalid @enderror" name="ubicacion_aviso" id="ubicacion_aviso" maxlength="120" required readonly>

                        @error('ubicacion_aviso')
                        <span class="invalid-feedback" role="alert">
                           <strong class="text-danger">{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                     <div class="col-md-12 form-group">
                        <label for="barrio_aviso" class="form-label">Barrio</label>
                        <select class="form-control  @error('barrio_aviso') is-invalid @enderror" name="barrio_aviso" id="barrio_aviso">
                           <option value="">Seleccione</option>
                           @foreach ($Barrios as $barrio)
                           <option value="{{ $barrio->codigo }}">{{ $barrio->nombre }}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>

                  <hr>

                  <div class="row" id="camposAdicionales"></div>

                  {{-- <div class="col-md-12 pl-1 pr-1 pt-3 caja-submodalidad d-none">
                              <label for="sub_modalidad" class="form-label">Sub-Modalidad Avisos y Pendones * </label>

                              <select class="form-control  @error('sub_modalidad') is-invalid @enderror" name="sub_modalidad" id="sub_modalidad" >
                                 <option value="">Seleccione</option>
                                 <option value="AVISOS DE IDENTIFICACION DE ESTABLECIMEINTOS COMERCIALES">AVISOS DE IDENTIFICACION DE ESTABLECIMEINTOS COMERCIALES</option>
                                 <option value="IDENTIFICACION PROYECTOS INMOBOLIARIOS">IDENTIFICACION PROYECTOS INMOBOLIARIOS</option>
                                 <option value="AVISOS TIPO COLOMBINA">AVISOS TIPO COLOMBINA</option>
                                 <option value="PENDONES">PENDONES</option>                              
                              </select>
                           
                              @error('sub_modalidad')
                                 <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                  </span>
                  @enderror
                  --}}

                  <h3 class="headline-l-govco mt-3 pl-0">2. Datos del Solicitante</h3>

                  <div class="row">
                     <div class="col-md-6 form-group">
                        <label for="tipo_documento" class="form-label">Tipo de Documento <code>*</code>
                        </label>
                        <select class="form-control  @error('tipo_documento') is-invalid @enderror" name="tipo_documento" id="tipo_documento" required>
                           <option value="">Seleccione</option>
                           <option value="T.I." {{ old('tipo_documento') == 'T.I.' ? 'selected' : '' }}>
                              Tarjeta de Identidad</option>
                           <option value="C.C." {{ old('tipo_documento') == 'C.C.' ? 'selected' : '' }}>
                              Cedula de Ciudadanía</option>
                           <option value="C.E." {{ old('tipo_documento') == 'C.E.' ? 'selected' : '' }}>
                              Cedula de Extranjería</option>
                           <option value="P.P." {{ old('tipo_documento') == 'P.P.' ? 'selected' : '' }}>
                              Pasaporte</option>
                        </select>

                        @error('tipo_documento')
                        <span class="invalid-feedback" role="alert">
                           <strong class="text-danger">{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>

                     <div class="col-md-6 form-group">
                        <label for="numero_documento" class="form-label">Numero de Identificacion
                           <code>*</code> </label>
                        <input type="text" value="{{ old('numero_documento') }}" class="form-control document_validate  @error('numero_documento') is-invalid @enderror" name="numero_documento" id="numero_documento" maxlength="20" minlength="4" required onkeypress="return Numeros(event)">

                        @error('numero_documento')
                        <span class="invalid-feedback" role="alert">
                           <strong class="text-danger">{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  
                  <div class="row">
                     <div class="col-md-6 form-group">
                        <label for="nombre_responsable" class="form-label">Nombres del Solicitante y/o
                           Responsable <code>*</code> </label>
                        <input type="text" value="{{ old('nombre_responsable') }}" class="form-control name_validate  @error('nombre_responsable') is-invalid @enderror" name="nombre_responsable" id="nombre_responsable" maxlength="40" minlength="4" required onkeypress="return Letras(event)" onkeyup="aMayusculas(this.value,this.id)">

                        @error('nombre_responsable')
                        <span class="invalid-feedback" role="alert">
                           <strong class="text-danger">{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>

                     <div class="col-md-6 form-group">
                        <label for="apellido_responsable" class="form-label">Apellidos del Solicitante y/o
                           Responsable <code>*</code> </label>
                        <input type="text" value="{{ old('apellido_responsable') }}" class="form-control name_validate  @error('apellido_responsable') is-invalid @enderror" name="apellido_responsable" id="apellido_responsable" maxlength="40" minlength="4" required onkeypress="return Letras(event)" onkeyup="aMayusculas(this.value,this.id)">

                        @error('apellido_responsable')
                        <span class="invalid-feedback" role="alert">
                           <strong class="text-danger">{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-6 form-group">
                        <label for="telefono_responsable" class="form-label">Teléfono / Celular
                           <code>*</code> </label>
                        <input value="{{ old('telefono_responsable') }}" type="text" class="form-control  @error('telefono_responsable') is-invalid @enderror number_validate" name="telefono_responsable" id="telefono_responsable" maxlength="100" minlength="4" required onkeypress="return Numeros(event)">

                        @error('telefono_responsable')
                        <span class="invalid-feedback" role="alert">
                           <strong class="text-danger">{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>

                     <div class="col-md-6 form-group">
                        <label for="email_responsable" class="form-label">Correo Electrónico Responsable
                           <code>*</code> </label>
                        <input value="{{ old('email_responsable') }}" type="mail" class="form-control  @error('email_responsable') is-invalid @enderror email_validate" name="email_responsable" id="email_responsable" required>

                        @error('email_responsable')
                        <span class="invalid-feedback" role="alert">
                           <strong class="text-danger">{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-6 form-group">
                        <label for="confirmar_email" class="form-label">Confirmar Correo <code>*</code> </label>
                        <input value="{{ old('confirmar_email') }}" type="mail" class="form-control  @error('confirmar_email') is-invalid @enderror email_validate" name="confirmar_email" id="confirmar_email" required>

                        @error('confirmar_email')
                        <span class="invalid-feedback" role="alert">
                           <strong class="text-danger">{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>

                  <h3 class="headline-l-govco mt-3 pl-0">3. Documentos Adjuntos de la Solicitud</h3>
                  
                  <div class="row" id="camposAdjuntos"></div>

                  {{-- por definir cuarto documento --}}
                  <div class="row">
                     <div class="col-md-12 pl-1 pt-3">
                        <h4 class="headline-m-govco">Aviso de privacidad y autorización tratamiento de datos
                           personales</h4>

                        <a class="btn btn-low px-0" href="https://www.bucaramanga.gov.co/Inicio/autorizacion-de-tratamiento-de-datos-personales/" target="_blank">Autorizo el tratamiento de datos personales</a>
                        <label class="checkbox-govco d-inline">
                           <input type="checkbox" id="AT00" name="tratamiento_datos" checked value="SI" />
                           <label for="AT00"> </label>
                        </label><br>

                        <a class="btn btn-low px-0" href="https://www.bucaramanga.gov.co/Inicio/autorizacion-de-tratamiento-de-datos-personales/" target="_blank">Acepto términos y condiciones</a>
                        <label class="checkbox-govco d-inline">
                           <input type="checkbox" id="AT01" name="acepto_terminos" checked value="SI" />
                           <label for="AT01"> </label>
                        </label>
                        <p class="text-justify">Confirmo que soy mayor de edad y con plena capacidad para
                           diligenciar el presente formulario.
                           Así mismo declaro que la información aquí suministrada corresponde a la verdad.
                           Declaro que he leído, entiendo y acepto las políticas de tratamiento de los datos
                           que suministro,
                           de conformidad con la Ley 1581 de 2012 y demás normas concordantes
                           <label class="checkbox-govco d-inline">
                              <input type="checkbox" id="AT02" name="confirmo_mayorEdad" checked value="SI" />
                              <label for="AT02"> </label>
                           </label>
                        </p>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-11 pl-1 pr-1 pt-3">
                        <p>Acepto que la información aquí registrada sea compartida con otras entidades y/o
                           terceros vinculados a la Alcaldía de Bucaramanga</p>
                        @error('compartir_informacion')
                        <span class="invalid-feedback" role="alert">
                           <strong class="text-danger">{{ $message }}</strong>
                        </span>
                        @enderror
                        <div class="form-check-inline">
                           <label class="radiolist-govco radiobutton-govco">
                              <input type="radio" name="compartir_informacion" id="rb_si" value="SI" required checked />
                              <label for="rb_si">SI</label>
                           </label>
                        </div>
                        <div class="form-check-inline">
                           <label class="radiolist-govco radiobutton-govco">
                              <input type="radio" name="compartir_informacion" id="rb_no" value="NO" />
                              <label for="rb_no">NO</label>
                           </label>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12  pl-1 pr-1 pt-3 text-left mt-4" style="padding-left: 0px!important">
                        <div class="g-recaptcha" data-sitekey="6LcoZ0IcAAAAAJO2XZZyhHvhacYdwmr4xKZ5DjgN">
                        </div>
                        <button style="font-size:15px;" type="submit" class="btn btn-round btn-middle btn_enviar_solicitud" name="consultar" onclick="return confirm('¿Esta seguro de realizar esta solicitud ?')">Enviar
                           Solicitud</button>
                        <button style="font-size:15px;" class="btn btn-round btn-middle btn_carga d-none" type="button" disabled><span class="spinner-grow spinner-grow-sm text-primary" role="status" aria-hidden="true"></span> Enviando...</button>
                     </div>
                  </div>
               </div>
            </form>
         </div>
         <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="accordion accordion-govco" id="EjemploAccordion-2">
               <div class="card mb-0">
                  <div class="card-header row no-gutters" id="headingUno">
                     <button class="btn-link row no-gutters collapsed" type="button" data-toggle="collapse" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                           <span class="title">¿Tienes dudas?</span>
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                           <div class="btn-icon-close">
                              <span class="govco-icon govco-icon-minus"></span>
                              <span class="govco-icon govco-icon-simpled-arrow"></span>
                           </div>
                        </div>
                     </button>
                  </div>
                  <div id="collapse1" class="collapse" aria-labelledby="headingUno" data-parent="#EjemploAccordion-2">
                     <div class="card-body bg-color-selago">
                        <div class="container">
                           <p class="form-inline my-0"><span class="govco-icon govco-icon-email"></span> <a style="color: #3366CC;" href="mailto:cjguerrero@bucaramanga.gov.co" target="_blank"> cjguerrero@bucaramanga.gov.co</a></p>
                           <p class="form-inline"><span class="govco-icon govco-icon-call-center"></span><a style="color: #3366CC;" href="tel:0376337000"> (+57)7 633 70 00</a></p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <div class="accordion accordion-govco" id="acc4">
               <div class="card">
                  <div class="card-header row no-gutters" id="c4">
                     <button class="btn-link row no-gutters collapsed" type="button" data-toggle="collapse" data-target="#coll4" aria-expanded="false" aria-controls="coll4" id="btn_colapse">
                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                           <span class="title">¿Como fue tu experiencia durante el proceso?</span>
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                           <div class="btn-icon-close">
                              <span class="govco-icon govco-icon-minus"></span>
                              <span class="govco-icon govco-icon-simpled-arrow"></span>
                           </div>
                        </div>
                     </button>
                  </div>
                  <div id="coll4" class="collapse" aria-labelledby="c4" data-parent="#acc4">
                     <div class="card-body bg-color-selago">
                        <div class="row justify-content-center spacer no-gutters">
                           <div class="col-3 pl-3 pt-2">
                              <button type="button" id="btn-facil-global" class="btn-symbolic-govco align-column-govco btn-facil-global" value="FACIL">
                                 <span class="govco-icon govco-icon-check-cn size-3x"></span>
                                 <span class="btn-govco-text">Facil</span>
                              </button>
                           </div>

                           <div class="col-3 pl-3 pt-2">
                              <button type="button" id="btn-dificil-global" class="btn-symbolic-govco align-column-govco btn-dificil-global" value="DIFICIL">
                                 <span class="govco-icon govco-icon-x-cn size-3x"></span>
                                 <span class="btn-govco-text">Dificil</span>
                              </button>
                           </div>
                        </div>
                        {{-- modulo tramites --}}
                        <input id="modulo" type="hidden" class="form-control modulo" value="PUBLICIDAD EXTERIOR">

                        <div class="container text-center">
                           <button type="button" class="btn btn-round btn-middle btn-block" id="btn-sugerencias" data-toggle="tooltip" data-placement="right" title="Después de escribir tus sugerencias oprime FACIL o DIFICIL para enviarlas" style="">Escribe
                              tus sugerencias</button><br>
                           <div id="Texto_sugerencias" style="display: none;">
                              <p style="color:#3366CC;"> Gracias por compartir tu experiencia</p>
                           </div>

                           <div id="text-button" style="padding-bottom: 10px; display: none;">
                              <label class="text-left small">Escribe tus comentarios</label>
                              <textarea class="form-control pb-2" rows="5" placeholder="Queremos conocer tu experiencia, sugerencias y consejos" id="text-area" maxlength="300" onkeypress="return Direccion(event)" onkeyup="aMayusculas(this.value,this.id)"></textarea>

                           </div>

                        </div>
                     </div>
                  </div>
               </div>
            </div>

            {{-- tercer acordion --}}

            <div class="accordion accordion-govco pt-0" id="acc3">
               <div class="card">
                  <div class="card-header row no-gutters" id="c3">
                     <button class="btn-link row no-gutters collapsed" type="button" data-toggle="collapse" data-target="#coll3" aria-expanded="false" aria-controls="coll3">
                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                           <span class="title">Consulto mi Solicitud</span>
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                           <div class="btn-icon-close">
                              <span class="govco-icon govco-icon-minus"></span>
                              <span class="govco-icon govco-icon-simpled-arrow"></span>
                           </div>
                        </div>
                     </button>
                  </div>
                  <div id="coll3" class="collapse" aria-labelledby="c3" data-parent="#acc3">
                     <div class="card-body bg-color-selago">
                        <div class="container text-center">
                           <button data-toggle="modal" data-target="#ModalConsulta" type="button" class="btn btn-round btn-middle">CONSULTE AQUÍ
                           </button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

{{-- fin contenedor pricincipal --}}

{{-- MODAL DIRECCIONES --}}


{{-- MODAL CONSULTAR SOLICITUD --}}

<div id="ModalConsulta" class="modal fade center" role="dialog">
   <div class="modal-dialog modal-lg" style="max-width: 1000px!important;">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header" style="background:#E5EEFB;">
            <h4 class="modal-title">Consultar Solicitud</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
            @if ($errors->any())
               <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <ul>
                     @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                     @endforeach
                  </ul>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>
            @endif
            <form action="{{route('publicidad.consulta')}}" method="post">
            @csrf
            <div class="modal-body">
               <div class="row form-row">
                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><br>
                     <div class="form-group">
                        <label style="color:#111111;" class="input" for="DD01" style="font-family: 'Barlow', sans-serif;">Buscar Por </label>
                        <select id="VD01" name="tipo_parametro" class="form-control input-md" title="Seleccione la opción para validar el documento" required="required">
                           <option value="">Seleccione</option>
                           <option value="radicado">Numero de radicado</option>
                           <option value="identificacion_solicitante">Documento de identificación Solicitante
                           </option>

                        </select>
                     </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><br>
                     <div class="form-group">
                        <label style="color:#111111;" class="input" for="DD01" style="font-family: 'Barlow', sans-serif;">Digite Numero </label>
                        <input type="text" name="parametro" id="VD00" class="form-control input-md" title="Seleccione la opción para validar el documento" required="required" onkeypress="return Numeros(event)" onkeyup="aMayusculas(this.value,this.id)" maxlength="40" minlength="5">

                     </div>
                  </div>
               </div>
            </div>

            <div class="modal-footer">

               <button type="submit" class="btn btn-round btn-middle btn-outline-info" id="Boton">Realizar
                  Búsqueda</button>
               <button type="button" class="btn btn-round btn-middle btn-outline-info" data-dismiss="modal">Cerrar</button>
            </div>
            </form>
      </div>
   </div>
</div>

@endsection

<div class="modal fade" id="ModalDireccionesAviso" tabindex="-1" role="dialog" aria-labelledby="ModalDireccionesAvisoLabel" aria-hidden="true">
   <div class="modal-dialog modal-xl" role="document" style="max-width: 1000px!important;">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header" style="background:#E5EEFB;">
            <h4 class="modal-title">Ingresa tu Dirección</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body">
            <div class="row form-row">
               <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                  <div class="form-group">
                     <label style="color:#111111;" class="input" for="DD01" style="font-family: 'Barlow', sans-serif;"> Calle - Carrera *</label>
                     <select name="DD01" id="DD01" type="text" class="form-control input-md modal1" required="required" title="Selecciona el tipo de indicación inicial para la dirección que desea ingresar">
                        <option value=""></option>
                        @foreach ($Parametros2 as $parametro2)
                        <option value="{{ $parametro2->ParDes }}">{{ $parametro2->ParDes }}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
               <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                  <div class="form-group">
                     <label style="color:#111111;" class="input" for="DD02" style="font-family: 'Barlow', sans-serif;">N° - Nombre * </label>
                     <input id="DD02" name="DD02" type="text" class="form-control modal1" maxlength="20" required="required" title="En este campo se deberá digitar número o nombre según corresponda a la selección en el campo anterior, te recomendamos observar el campo de visualización que se encuentra al final de este módulo para organizar tu dirección correctamente." onkeypress="return NumDoc(event)" onchange="aMayusculas(this.value,this.id)" style="height: 29px!important;">
                  </div>
               </div>
               <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                  <div class="form-group">
                     <label style="color:#111111;" class="input" for="DD03" style="font-family: 'Barlow', sans-serif;">Letra </label>
                     <select id="DD03" name="DD03" type="text" class="form-control input-md modal1" title="Selecciona una letra si tu indicación de dirección en el campo anterior contiene esta opción, si no la posee déjala en blanco">
                        <option value=""></option>
                        @foreach ($Parametros1 as $parametro1)
                        <option value="{{ $parametro1->ParNom }}">{{ $parametro1->ParNom }}</option>
                        @endforeach

                     </select>
                  </div>
               </div>

               <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"><br>
                  <div class="form-group">
                     <label style="color:#111111;" class="input" for="DD04" style="font-family: 'Barlow', sans-serif;">Numero* </label>
                     <input id="DD04" name="DD04" type="text" class="form-control modal1" maxlength="4" title="Digita en este campo el primer número de tu dirección" onkeypress="return Numeros(event)" required="required" style="height: 29px!important;">
                  </div>
               </div>

               <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                  <div class="form-group">
                     <label style="color:#111111;" class="input" for="DD05" style="font-family: 'Barlow', sans-serif;">Letra </label>
                     <select id="DD05" name="DD05" type="text" class="form-control input-md modal1" title="Selecciona una letra si tu indicación de dirección en el campo anterior contiene esta opción, si no la posee déjala en blanco">
                        <option value=""></option>
                        @foreach ($Parametros1 as $parametro1)
                        <option value="{{ $parametro1->ParNom }}">{{ $parametro1->ParNom }}</option>
                        @endforeach
                     </select>
                  </div>
               </div>

               <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"><br>
                  <div class="form-group">
                     <label style="color:#111111;" class="input" for="DD06" style="font-family: 'Barlow', sans-serif;">Numero* </label>
                     <input id="DD06" name="DD06" type="text" class="form-control modal1" maxlength="4" title="Digita en este campo el primer número de tu dirección" onkeypress="return Numeros(event)" style="height: 29px!important;">
                  </div>
               </div>

               <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                  <div class="form-group">
                     <label style="color:#111111;" class="input" for="DD07" style="font-family: 'Barlow', sans-serif;">Letra </label>
                     <select id="DD07" name="DD07" type="text" class="form-control input-md modal1" title="Selecciona una letra si tu indicación de dirección en el campo anterior contiene esta opción, si no la posee déjala en blanco">
                        <option value=""></option>
                        @foreach ($Parametros1 as $parametro1)
                        <option value="{{ $parametro1->ParNom }}">{{ $parametro1->ParNom }}</option>
                        @endforeach

                     </select>
                  </div>
               </div>

               <div class="col-lg-6 col-md-2 col-sm-12 col-xs-12 caja_ultima"><br>
                  <div class="form-group">
                     <label style="color:#111111;" class="input" for="DD08" style="font-family: 'Barlow', sans-serif;">Complemento </label>
                     <input id="DD08" name="DD08" type="text" class="form-control modal1" maxlength="80" title="Digita en este el complemento de tu direccion" onkeyup="aMayusculas(this.value,this.id)">
                  </div>
               </div>

               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><br><br>
                  <div class="form-group">
                     <input style="background-color: #004884; color: #FFFFFF; font-weight: bold; border-radius:8px;" name="Direccion" id="DD000" type="text" class="form-control input-md DD00" data-toggle="tooltip" title="Previsualizador de la dirección introducida" data-delay='{"show":"30", "hide":"30"}' placeholder="Pre visualizador de direcciones" required="required" readonly>
                  </div>
               </div>
            </div>
         </div>

         <div class="modal-footer">
            <button style="font-size:15px;" type="button" class="btn btn-round btn-middle btn-outline-info" id="btnDireccionAviso" value="Boton">Ingresar Dirección</button>
            <button style="font-size:15px;" type="button" class="btn btn-round btn-middle btn-outline-info" data-dismiss="modal">Cerrar</button>
         </div>
         </form>
      </div>
   </div>
</div>