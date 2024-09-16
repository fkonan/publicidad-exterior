@extends('layouts.app')
@section('analitycs')
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-P4F62ET0GR"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-P4F62ET0GR');
</script>

@endsection

@section('title', 'Eventos Publicos')
@section('content')



    <style>
        .clockpicker-button {
            background-color: #3366CC !important;
            color: white !important;
        }

    </style>

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <div class="container mt-3 mb-4 m-xs-x-3" id="body_eventos">
        <div class="row pl-4">
            <div class="px-0 col-md-9 col-xs-12 col-sm-12">
                <nav aria-label="Miga de pan" style="max-height: 20px;">
                    <ol class="breadcrumb" style="background-color: #FFFFFF;">
                        <li class="breadcrumb-item ml-3 ml-md-0">
                            <a style="color: #004fbf; font-size:14px;" class="breadcrumb-text" href="https://www.bucaramanga.gov.co/" tabindex="3">Inicio</a>
                        </li>
                        <li class="breadcrumb-item ">
                            <div class="image-icon">
                                <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                                <a style="color: #004fbf; font-size:14px;" class="breadcrumb-text" href="https://www.bucaramanga.gov.co/tramites/" tabindex="4">Tramites y servicios</a>
                            </div>
                        </li>
                        <li class="breadcrumb-item ">
                            <div class="image-icon">
                                <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                                <p class="ml-3 ml-md-0 text-miga" style="color: #004884; font-size:14px;">
                                        Permisos para Espectáculos Públicos
                                    </p>
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
                        <div class="card step-progress border-0" style="font-size: 10px; background-color: transparent !important;">
                            <div class="step-slider">
                                <!--<div data-id="step1" class="step-slider-item active" ><p style="padding-top: 0px;margin-top:5px;"></p></div>-->
                                <div data-id="step2" class="step-slider-item active">
                                    <p style="padding-top: 0px;margin-top:5px;color: #BABABA;" id="barra_progreso"><span
                                            class="circle_cero">1</span> Inicio</p>
                                </div>
                                <div data-id="step3" class="step-slider-item">
                                    <p style="padding-top: 0px;margin-top:5px;color: #3366CC" id="barra_progreso"><span
                                            class="circle_uno">2 </span> Hago mi solicitud</p>
                                </div>
                                <div data-id="step4" class="step-slider-item">
                                    <p style="padding-top: 0px;margin-top:5px; color: #4B4B4B" id="barra_progreso"><span
                                            class="circle_dos">3</span>Procesan mi solicitud</p>
                                </div>
                                <div data-id="step5" class="step-slider-item">
                                    <p style="padding-top: 0px;margin-top:5px; color: #4B4B4B" id="barra_progreso"><span
                                            class="circle_dos">4</span> Respuesta</p>
                                </div>

                            </div>
                        </div>
                    </div>

                    <form action="{{route('eventos.store')}}" method="POST" id="formEventos" enctype="multipart/form-data"  class="formEventos">
                        @csrf
                        <div class="card govco-card border-0 shadow-none" style="border-radius: 0px;">

                            <h1 class="headline-xl-govco">Permiso para espectáculos públicos diferentes a las artes escénicas.</h1>

                            <div class="alert-primary-govco alert alert-dismissible fade show mt-3"
                                aria-label="Alerta informativa">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar"
                                    title="Cerrar">&times;</button>
                                <div class="alert-heading">
                                    <span class="govco-icon govco-icon-bell-sound-p size-2x"></span>
                                    <span class="headline-l-govco">Importante</span>
                                </div>
                                <p style="text-align: justify">Trámite para obtener la autorización para la realización de espectáculos públicos diferentes a las artes escénicas previo cumplimiento de los requisitos establecidos en las normas para su desarrollo. Dicha actividad no podrá realizarse sin autorización, y debe ser solicitado con mínimo 15 días hábiles para su autorización </p>
                            </div>
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

                        <h3 class="headline-l-govco mt-3 pl-0">1. Datos Generales de la Solicitud <br> <span class="small-text-govco">*Campos obligatorios</span></h3>

                       

                        <div class="row form-group mt-2">

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="tipo_persona" class="form-label">Tipo de persona * </label>
                                <select class="form-control select_general  @error('tipo_persona') is-invalid @enderror"
                                    name="tipo_persona" id="tipo_persona" tabindex="9" required>
                                    <option value="">Seleccione</option>
                                    <option value="1">Natural</option>
                                    <option value="2">Juridica</option>
                                </select>
                                @error('tipo_persona')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3"></div>


                            <div class="col-md-6 pl-1 pr-1 pt-3 caja_nombres d-none">
                                <label for="nom_responsable" class="form-label">Nombres del Solicitante y/o Responsable *
                                </label>
                                <input value="{{ old('nom_responsable') }}" type="text"
                                    class="form-control name_validate  @error('nom_solicitante') is-invalid @enderror"
                                    name="nom_responsable" id="nom_responsable" maxlength="25" minlength="4"
                                    onkeypress="return Letras(event)" onkeyup="aMayusculas(this.value,this.id)" tabindex="9" placeholder="Ej: Mariana">
                                @error('nom_responsable')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3 caja_nombres d-none">
                                <label for="ape_responsable" class="form-label">Apellidos del Solicitante y/o Responsable *
                                </label>
                                <input value="{{ old('ape_responsable') }}" type="text"
                                    class="form-control name_validate  @error('ape_responsable') is-invalid @enderror"
                                    name="ape_responsable" id="ape_responsable" maxlength="25" minlength="4"
                                    onkeypress="return Letras(event)" onkeyup="aMayusculas(this.value,this.id)" tabindex="9" placeholder="Ej: Garcia">
                                @error('ape_responsable')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-12 pl-1 pr-1 pt-3 d-none caja_razon">
                                <label for="razon_social" class="form-label">Razon Social y/o Responsable * </label>
                                <input type="text"
                                    class="form-control   @error('razon_social') is-invalid @enderror "
                                    name="razon_social" id="razon_responsable" maxlength="100" minlength="4"
                                    onkeypress="return Observaciones(event)" onkeyup="aMayusculas(this.value,this.id)" tabindex="9" placeholder="Ej: Eventos y producciones Hernandez">
                                @error('razon_social')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="tipo_documento" class="form-label">Tipo de Documento * </label>
                                <select class="form-control select_general  @error('tipo_documento') is-invalid @enderror"
                                    name="tipo_documento" id="tipo_documento" required tabindex="10">
                                    <option value="">Seleccione</option>
                                    <option value="C.C.">Cedula de Ciudadanía</option>
                                    <option value="C.E.">Cedula de Extranjería</option>
                                    <option value="NIT">NIT</option>
                                </select>
                                @error('tipo_documento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="ide_responsable" class="form-label">Número de Identificación* </label>
                                <input value="{{ old('ide_responsable') }}" type="text"
                                    class="form-control number_validate  @error('ide_responsable') is-invalid @enderror"
                                    name="ide_responsable" id="ide_responsable" maxlength="15" minlength="4" required
                                    onkeypress="return Numeros(event)" tabindex="11" placeholder="Ej: 1098654213">
                                @error('ide_responsable')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-12 pl-1 pt-3">

                                <label for="dir_responsable_sol" class="form-label">Dirección o Nomenclatura del Responsable*
                                </label><button type="button" class="btn btn-link"><span style="text-transform: lowercase; font-size: 12px;" class="text-primary" data-toggle="modal" data-target="#ModalDireccionesEventos" id="button-modal" tabindex="12">(Clic para insertar
                                        direccion)</span></button>
                                <input type="text" value="{{ old('dir_responsable_sol') }}"
                                    class="form-control  @error('dir_responsable_sol') is-invalid @enderror"
                                    name="dir_responsable_sol" id="dir_responsable_sol" maxlength="120" required readonly placeholder="Ej: Diagonal 17a # 13- 45">
                                @error('dir_responsable_sol')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="barrio_responsable_sol" class="form-label">Barrio* </label>
                                <select name="barrio_responsable_sol" id="barrio_responsable_sol"
                                    class="form-control @error('barrio_responsable_sol') is-invalid @enderror barrios" required tabindex="13">
                                    <option value=""></option>
                                    @foreach ($Barrios as $barrio)
                                        <option {{ old('barrio_responsable_sol') == $barrio->nombre ? "selected" : "" }}  value="{{ $barrio->nombre }}">{{ $barrio->nombre }}</option>

                                    @endforeach
                                </select>
                                @error('barrio_responsable_sol')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="tel_responsable" class="form-label">Teléfono / Celular Responsable* </label>
                                <input value="{{ old('tel_responsable') }}" type="text"
                                    class="form-control  @error('tel_responsable') is-invalid @enderror number_validate"
                                    name="tel_responsable" id="tel_responsable" maxlength="10" minlength="7" required
                                    onkeypress="return Numeros(event)" tabindex="14" placeholder="Ej: 3196822345">
                                @error('tel_responsable')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="email_responsable" class="form-label">Correo Electronico Responsable * </label>
                                <input value="{{ old('email_responsable') }}" type="text"
                                    class="form-control  @error('email_responsable') is-invalid @enderror email_validate"
                                    name="email_responsable" id="email_responsable" required tabindex="15" placeholder="Ej: mariana.garcia@gmail.com">
                                @error('email_responsable')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="email_confirmado" class="form-label">Confirme su correo* </label>
                                <input type="text"
                                    class="form-control  @error('email_confirmado') is-invalid @enderror email_validate"
                                    name="email_confirmado" id="email_confirmado" required onpaste="return false;" tabindex="16" placeholder="Ej: mariana.garcia@gmail.com">
                                @error('email_confirmado')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="fecha_evento" class="form-label">Fecha del evento* </label>
                                <input type="date" class="form-control  @error('fecha_evento') is-invalid @enderror "
                                    name="fecha_evento" value="{{old('fecha_evento')}} "id="fecha_evento" data-toggle="tooltip" data-placement="bottom"
                                    title="15 días con antelación a la realización del evento." required tabindex="17">
                                @error('fecha_evento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-3 pl-1 pr-1 pt-3">
                                <label for="hora_inicio" class="form-label">Hora de inicio* </label>
                                <div class="input-group clockpicker">
                                    <input type="text" value="{{old('hora_inicio')}}" class="form-control @error('hora_inicio') is-invalid @enderror "
                                        value="00:00" name="hora_inicio" id="hora_inicio" required tabindex="18" placeholder="Ej: 3:30PM">
                                </div>
                                @error('hora_inicio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-3 pl-1 pr-1 pt-3">
                                <label for="hora_fin" class="form-label">Hora fin* </label>
                                <div class="input-group clockpicker">
                                    <input type="text" value="{{old('hora_fin')}}" class="form-control @error('hora_fin') is-invalid @enderror "
                                        value="00:00" name="hora_fin" id="hora_fin" required tabindex="19" placeholder="Ej: 8:30PM">
                                </div>
                                @error('hora_fin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-12 pl-1 pt-3">

                                <label for="ubicacion_evento" class="form-label">Ubicación del evento </label><button
                                    type="button" class="btn btn-link"><span
                                        style="text-transform: lowercase; font-size: 12px;" class="text-primary"
                                        data-toggle="modal" tabindex="20" id="button-modal-2" data-target="#ModalUbicacion">(Clic para insertar
                                        direccion)</span></button>
                                <input type="text" value="{{ old('ubicacion_evento') }}"
                                    class="form-control  @error('ubicacion_evento') is-invalid @enderror"
                                    name="ubicacion_evento" id="ubicacion_evento" maxlength="120" required readonly placeholder="Ej: Calle 20 # 3 - 45 Plazoleta de eventos">
                                @error('ubicacion_evento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="barrio_evento" class="form-label">Barrio* </label>
                                <select name="barrio_evento" id="barrio_evento"
                                    class="form-control @error('barrio_evento') is-invalid @enderror barrios" required tabindex="21">
                                    <option value=""></option>
                                    @foreach ($Barrios as $barrio)
                                        <option {{ old('barrio_evento') == $barrio->nombre ? "selected" : "" }}  value="{{ $barrio->nombre }}">{{ $barrio->nombre }}</option>

                                    @endforeach
                                </select>
                                @error('barrio_evento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="cant_personas" class="form-label">Numero Aprox de asistentes* </label>
                                <input type="text" name="cant_personas" id="cant_personas" class="form-control @error('cant_personas') is-invalid @enderror" onkeypress="return Numeros(event)" maxlength="10" required tabindex="22" placeholder="Ej:400">                                 
                                                                
                                @error('cant_personas')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="pub_ext" class="form-label">Para promocionar el evento se hará uso de publicidad exterior visual* </label>
                                <select  name="pub_ext" id="pub_ext" class="form-control select_general @error('pub_ext') is-invalid @enderror"  required tabindex="23">
                                    <option value="">Seleccione</option>
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                
                                </select>                                            
                                @error('pub_ext')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="reproduccion_musica" class="form-label">En el evento se hará uso o reproducción de obras artísticas (música)* </label>
                                <select  name="reproduccion_musica" id="reproduccion_musica" class="form-control select_general @error('reproduccion_musica') is-invalid @enderror"  required tabindex="24">
                                    <option value="">Seleccione</option>
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                
                                </select>                                            
                                @error('reproduccion_musica')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="col-md-12 pl-1 pr-1 pt-3">
                                <label for="descripcion_evento" class="form-label">Descripción del evento* </label>
                                <textarea rows="3" class="form-control" name="descripcion_evento" id="descripcion_evento"
                                    required maxlength="550" onkeypress="return Observaciones(event)"
                                    onkeyup="aMayusculas(this.value,this.id)" tabindex="25" placeholder="Ej: Se realizar un evento publico con atracciones mecanicas...">{{{ old('descripcion_evento') }}}</textarea>
                                @error('descripcion_evento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-12 pl-1 pr-1 pt-3">
                                <h3 class="headline-l-govco mt-3 pl-0">2. Documentos Adjuntos de la Solicitud <br> <span class="small-text-govco">*Campos obligatorios</span></h3>
                            </div>


                            <div class="col-md-12 pl-1 pr-1 pt-3">
                                {{-- <label for="adj_cedulaRes_arch" class="form-label">Documento de identificación*</label> &nbsp;
                                <small style="font-size: 11px!important; text-align:justify!important;"><em
                                        style="font-size: 11px!important; text-align:justify!important;">Adjunto cédula de
                                        ciudadanía (persona natural sea el responsable del evento) o certificado existencia
                                        y representación legal (responsable del evento sea una persona jurídica)</em>
                                </small></label>
                                <div class="form-group">
                                    <div class="file-loading">
                                        <input class=" @error('adj_cedulaRes_arch') is-invalid @enderror documentos_adjuntos"
                                            id="adj_cedulaRes_arch" accept="application/pdf" name="adj_cedulaRes_arch" type="file"
                                            data-overwrite-initial="true" required>
                                        @error('adj_cedulaRes_arch')
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="form-group">                                  
                                    <label for="input-file-simple-label" class="inputfile-gov">
                                        <strong>Documento de identificación* </strong> <br />
                                        <span class="mensaje">Tipo de archivo permitido .PDF hasta de 10MB</span><br>
                                        <small style="text-align:justify; font-size:12px;">Adjunto cédula de ciudadanía (persona natural sea el responsable del evento) o certificado existencia y representación legal (responsable del evento sea una persona jurídica)</small><br>                                       
      
                                     </label>
                                    
                                <div class="custom-file file-govco">
                                   <input type="file" accept="application/pdf"  name="adj_cedulaRes_arch" class="custom-file-input input-file-govco" id="adj_cedulaRes_arch" onchange="uploadHandler(event,'adj_cedulaRes_arch')" required tabindex="26"/>
                                   <label class="custom-file-label label-file-govco @error('adj_cedulaRes_arch') is-invalid @enderror"  ondrop="dropHandler(event, 'adj_cedulaRes_arch')" ondragover="dragOverHandler(event, 'adj_cedulaRes_arch')"  for="adj_cedulaRes_arch"><span class="govco-icon govco-icon-attached-n size-2x"></span>
                                    Arrastre aquí su archivo o haga click para añadir.</label>
                                   @error('adj_cedulaRes_arch')
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                             </div>
                            </div>

                            <div class="col-md-12 pl-1 pr-1 pt-3">
                                {{-- <label for="adj_logisticaEvento_arch" class="form-label">Certificación de Empresa Logística legalmente constituida &nbsp; <small
                                        style="font-size: 11px!important;text-align:justify!important;"><em
                                            style="font-size: 11px!important"> Adjuntar oficio que conste la prestación del servicio de seguridad y vigilancia del evento.</em> <br> </small></label><br>
                                <div class="form-group">
                                    <div class="file-loading">
                                        <input
                                            class=" @error('adj_logisticaEvento_arch') is-invalid @enderror documentos_adjuntos"
                                            id="adj_logisticaEvento_arch" accept="application/pdf" name="adj_logisticaEvento_arch"
                                            type="file" data-overwrite-initial="true">
                                        @error('adj_logisticaEvento_arch')
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="form-group">                                  
                                    <label for="input-file-simple-label" class="inputfile-gov">
                                        <strong>Certificación de Empresa Logística legalmente constituida </strong> <br />
                                        <span class="mensaje">Tipo de archivo permitido .PDF hasta de 10MB</span><br>
                                        <small style="text-align:justify; font-size:12px;">Adjuntar oficio que conste la prestación del servicio de seguridad y vigilancia del evento</small><br>                                       
      
                                     </label>
                                    
                                <div class="custom-file file-govco">
                                   <input type="file" accept="application/pdf"  name="adj_logisticaEvento_arch" class="custom-file-input input-file-govco" id="adj_logisticaEvento_arch" onchange="uploadHandler(event,'adj_logisticaEvento_arch')"  tabindex="27"/>
                                   <label class="custom-file-label label-file-govco @error('adj_logisticaEvento_arch') is-invalid @enderror"  ondrop="dropHandler(event, 'adj_logisticaEvento_arch')" ondragover="dragOverHandler(event, 'adj_logisticaEvento_arch')"  for="adj_logisticaEvento_arch"><span class="govco-icon govco-icon-attached-n size-2x"></span>
                                    Arrastre aquí su archivo o haga click para añadir.</label>
                                   @error('adj_logisticaEvento_arch')
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                             </div>
                            </div>

                            <div class="col-md-12 pl-1 pr-1 pt-3">
                                {{-- <label for="adj_certificadoEMAB_arch" class="form-label">Certificado de Aseo*&nbsp; <small
                                        style="font-size: 11!important;" aling="justify"><em
                                            style="font-size: 11px!important" aling="justify">: Adjuntar el certificado emitido por la EMAB o el compromiso de aseo del lugar en donde se desarrolla el evento. El compromiso de aseo será válido siempre y cuando en el evento participen hasta 50 personas</em></small> </label><br><br><br><br>
                                <div class="form-group">
                                    <div class="file-loading">
                                        <input
                                            class=" @error('adj_certificadoEMAB_arch') is-invalid @enderror documentos_adjuntos"
                                            id="adj_certificadoEMAB_arch" accept="application/pdf" name="adj_certificadoEMAB_arch"
                                            type="file" data-overwrite-initial="true" required>
                                        @error('adj_certificadoEMAB_arch')
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="form-group">                                  
                                    <label for="input-file-simple-label" class="inputfile-gov">
                                        <strong>Certificado de Aseo* </strong> <br />
                                        <span class="mensaje">Tipo de archivo permitido .PDF hasta de 10MB</span><br>
                                        <small style="text-align:justify; font-size:12px;">Adjuntar el certificado emitido por la EMAB o el compromiso de aseo del lugar en donde se desarrolla el evento. El compromiso de aseo será válido siempre y cuando en el evento participen hasta 50 personas</small><br>                                       
      
                                     </label>
                                    
                                <div class="custom-file file-govco">
                                   <input type="file" accept="application/pdf"  name="adj_certificadoEMAB_arch" class="custom-file-input input-file-govco" id="adj_certificadoEMAB_arch" onchange="uploadHandler(event,'adj_certificadoEMAB_arch')"  tabindex="28" required/>
                                   <label class="custom-file-label label-file-govco @error('adj_certificadoEMAB_arch') is-invalid @enderror"  ondrop="dropHandler(event, 'adj_certificadoEMAB_arch')" ondragover="dragOverHandler(event, 'adj_certificadoEMAB_arch')"  for="adj_certificadoEMAB_arch"><span class="govco-icon govco-icon-attached-n size-2x"></span>
                                    Arrastre aquí su archivo o haga click para añadir.</label>
                                   @error('adj_certificadoEMAB_arch')
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                             </div>
                            </div>

                            <div class="col-md-12 pl-1 pr-1 pt-3">
                                {{-- <label for="adj_contratoArr_arch" class="form-label">Autorización del lugar* &nbsp; <small
                                        style="font-size: 11!important;" aling="justify"><em
                                            style="font-size: 10px!important" aling="justify">Adjuntar certificación escrita o contrato de arrendamiento suscrito por el propietario, administrador, arrendador o poseedor legal del inmueble destinado para desarrollar el evento. Si el evento es en espacio público se debe adjuntar la viabilidad escrita por la Oficina de Parque y Zonas Verdes de la Secretaría de Infraestructura para el uso y ocupación del espacio público de la zona. (Calle 35 No. 10 – 43 Edificio Fase I Piso 4).</em></small> </label>
                                <div class="form-group">
                                    <div class="file-loading">
                                        <input class=" @error('adj_contratoArr_arch') is-invalid @enderror documentos_adjuntos"
                                            id="adj_contratoArr_arch" accept="application/pdf" name="adj_contratoArr_arch" type="file"
                                            data-overwrite-initial="true" required>
                                        @error('adj_contratoArr_arch')
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="form-group">                                  
                                    <label for="input-file-simple-label" class="inputfile-gov">
                                        <strong>Autorización del lugar*</strong> <br />
                                        <span class="mensaje">Tipo de archivo permitido .PDF hasta de 10MB</span><br>
                                        <small style="text-align:justify; font-size:12px;">Adjuntar certificación escrita o contrato de arrendamiento suscrito por el propietario, administrador, arrendador o poseedor legal del inmueble destinado para desarrollar el evento. Si el evento es en espacio público se debe adjuntar la viabilidad escrita por la Oficina de Parque y Zonas Verdes de la Secretaría de Infraestructura para el uso y ocupación del espacio público de la zona. (Calle 35 No. 10 – 43 Edificio Fase I Piso 4).</small><br>                                       
      
                                     </label>
                                    
                                <div class="custom-file file-govco">
                                   <input type="file" accept="application/pdf"  name="adj_contratoArr_arch" class="custom-file-input input-file-govco" id="adj_contratoArr_arch" onchange="uploadHandler(event,'adj_contratoArr_arch')"  tabindex="29" required/>
                                   <label class="custom-file-label label-file-govco @error('adj_contratoArr_arch') is-invalid @enderror"  ondrop="dropHandler(event, 'adj_contratoArr_arch')" ondragover="dragOverHandler(event, 'adj_contratoArr_arch')"  for="adj_contratoArr_arch"><span class="govco-icon govco-icon-attached-n size-2x"></span>
                                    Arrastre aquí su archivo o haga click para añadir.</label>
                                   @error('adj_contratoArr_arch')
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                             </div>
                        </div>


                            <div class="col-md-12 pl-1 pr-1 pt-3">
                                {{-- <label for="adj_conceptoTecAmb_arch" class="form-label">Concepto Tecnico Sanitario y Ambiental
                                    *&nbsp; <small style="font-size: 11!important;" aling="justify"><em
                                            style="font-size: 11px!important" aling="justify"> Adjuntar Concepto técnico
                                            sanitario y ambiental, emitido por la Subsecretaria de Medio Ambiente de la
                                            Secretaria de Salud Municipal. (Calle 35 # 10-43 Fase I Piso 2).</em></small>
                                </label><br>
                                <div class="form-group">
                                    <div class="file-loading">
                                        <input
                                            class=" @error('adj_conceptoTecAmb_arch') is-invalid @enderror documentos_adjuntos"
                                            id="adj_conceptoTecAmb_arch" accept="application/pdf" name="adj_conceptoTecAmb_arch"
                                            type="file" data-overwrite-initial="true" required>
                                        @error('adj_conceptoTecAmb_arch')
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="form-group">                                  
                                    <label for="input-file-simple-label" class="inputfile-gov">
                                        <strong>Concepto Tecnico Sanitario y Ambiental *</strong> <br />
                                        <span class="mensaje">Tipo de archivo permitido .PDF hasta de 10MB</span><br>
                                        <small style="text-align:justify; font-size:12px;">Adjuntar Concepto técnico
                                            sanitario y ambiental, emitido por la Subsecretaria de Medio Ambiente de la
                                            Secretaria de Salud Municipal. (Calle 35 # 10-43 Fase I Piso 2).</small><br>                                       
      
                                     </label>
                                    
                                <div class="custom-file file-govco">
                                   <input type="file" accept="application/pdf"  name="adj_conceptoTecAmb_arch" class="custom-file-input input-file-govco" id="adj_conceptoTecAmb_arch" onchange="uploadHandler(event,'adj_conceptoTecAmb_arch')"  tabindex="30" required/>
                                   <label class="custom-file-label label-file-govco @error('adj_conceptoTecAmb_arch') is-invalid @enderror"  ondrop="dropHandler(event, 'adj_conceptoTecAmb_arch')" ondragover="dragOverHandler(event, 'adj_conceptoTecAmb_arch')"  for="adj_conceptoTecAmb_arch"><span class="govco-icon govco-icon-attached-n size-2x"></span>
                                    Arrastre aquí su archivo o haga click para añadir.</label>
                                   @error('adj_conceptoTecAmb_arch')
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                             </div>
                            </div>
                          

                            <div class="col-md-12 pl-1 pr-1 pt-3">
                                {{-- <label for="adj_certificadoPONAL_arch" class="form-label">Certificado MEBUC*&nbsp; <small
                                        style="font-size: 11!important;" aling="justify"><em
                                            style="font-size: 11px!important" aling="justify"> Adjuntar Certificado de
                                            conocimiento del Evento por parte del Comando Operativo de Seguridad Ciudadana
                                            de la Policía Metropolitana. (PONAL). (Calle 41 # 11-44).</em></small> </label><br>
                                <div class="form-group">
                                    <div class="file-loading">
                                        <input
                                            class=" @error('adj_certificadoPONAL_arch') is-invalid @enderror documentos_adjuntos"
                                            id="adj_certificadoPONAL_arch" accept="application/pdf" name="adj_certificadoPONAL_arch"
                                            type="file" data-overwrite-initial="true" required>
                                        @error('adj_certificadoPONAL_arch')
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="form-group">                                  
                                    <label for="input-file-simple-label" class="inputfile-gov">
                                        <strong>Certificado MEBUC*</strong> <br />
                                        <span class="mensaje">Tipo de archivo permitido .PDF hasta de 10MB</span><br>
                                        <small style="text-align:justify; font-size:12px;">Adjuntar Certificado de
                                            conocimiento del Evento por parte del Comando Operativo de Seguridad Ciudadana
                                            de la Policía Metropolitana. (PONAL). (Calle 41 # 11-44).</small><br>                                      
                                           </label>                                    
                                <div class="custom-file file-govco">
                                   <input type="file" accept="application/pdf"  name="adj_certificadoPONAL_arch" class="custom-file-input input-file-govco" id="adj_certificadoPONAL_arch" onchange="uploadHandler(event,'adj_certificadoPONAL_arch')"  tabindex="31" required/>
                                   <label class="custom-file-label label-file-govco @error('adj_certificadoPONAL_arch') is-invalid @enderror"  ondrop="dropHandler(event, 'adj_certificadoPONAL_arch')" ondragover="dragOverHandler(event, 'adj_certificadoPONAL_arch')"  for="adj_certificadoPONAL_arch"><span class="govco-icon govco-icon-attached-n size-2x"></span>
                                    Arrastre aquí su archivo o haga click para añadir.</label>
                                   @error('adj_certificadoPONAL_arch')
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                             </div>
                            </div>

                            <div class="col-md-12 pl-1 pr-1 pt-3 caja-cmgrd">
                                {{-- <label for="adj_certificadoBomberos_arch" class="form-label">Concepto de Bomberos de Bucaramanga*&nbsp; <small style="font-size: 11!important;" aling="justify"><em
                                            style="font-size: 11px!important" aling="justify"> Adjuntar Oficio que acredite
                                            el cumplimiento de las condiciones de seguridad de acuerdo al protocolo
                                            establecido por el Cuerpo de Bomberos de Bucaramanga.(Calle 44 No. 10 – 13).</em></small> </label><br>
                                <div class="form-group">
                                    <div class="file-loading">
                                        <input
                                            class=" @error('adj_certificadoBomberos_arch') is-invalid @enderror documentos_adjuntos"
                                            id="adj_certificadoBomberos_arch" accept="application/pdf"
                                            name="adj_certificadoBomberos_arch" type="file" data-overwrite-initial="true"
                                            >
                                        @error('adj_certificadoBomberos_arch')
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div> --}}

                                <div class="form-group">                                  
                                    <label for="input-file-simple-label" class="inputfile-gov">
                                        <strong>Concepto de Bomberos de Bucaramanga*</strong> <br />
                                        <span class="mensaje">Tipo de archivo permitido .PDF hasta de 10MB</span><br>
                                        <small style="text-align:justify; font-size:12px;"> Adjuntar Oficio que acredite
                                            el cumplimiento de las condiciones de seguridad de acuerdo al protocolo
                                            establecido por el Cuerpo de Bomberos de Bucaramanga.(Calle 44 No. 10 – 13).</small><br>                                      
                                           </label>                                    
                                <div class="custom-file file-govco">
                                   <input type="file" accept="application/pdf"  name="adj_certificadoBomberos_arch" class="custom-file-input input-file-govco" id="adj_certificadoBomberos_arch" onchange="uploadHandler(event,'adj_certificadoBomberos_arch')"  tabindex="32"/>
                                   <label class="custom-file-label label-file-govco @error('adj_certificadoBomberos_arch') is-invalid @enderror"  ondrop="dropHandler(event, 'adj_certificadoBomberos_arch')" ondragover="dragOverHandler(event, 'adj_certificadoBomberos_arch')"  for="adj_certificadoBomberos_arch"><span class="govco-icon govco-icon-attached-n size-2x"></span>
                                    Arrastre aquí su archivo o haga click para añadir.</label>
                                   @error('adj_certificadoBomberos_arch')
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                             </div>
                                
                            </div>

                            <div class="col-md-12 pl-1 pr-1 pt-3 caja-cmgrd">
                                {{-- <label for="adj_hospitalaria_arch" class="form-label">Constancia de prestación servicio prehospitalario*&nbsp; <small style="font-size: 11!important;" aling="justify"><em
                                            style="font-size: 11px!important" aling="justify">Adjuntar constancia del servicio a prestar con un organismo de socorro: Defensa Civil o Cruz Roja.</em></small> </label><br><br>
                                <div class="form-group">
                                    <div class="file-loading">
                                        <input class=" @error('adj_hospitalaria_arch') is-invalid @enderror documentos_adjuntos"
                                            id="adj_hospitalaria_arch" accept="application/pdf" name="adj_hospitalaria_arch"
                                            type="file" data-overwrite-initial="true">
                                        @error('adj_hospitalaria_arch')
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="form-group">                                  
                                    <label for="input-file-simple-label" class="inputfile-gov">
                                        <strong>Constancia de prestación servicio prehospitalario*</strong> <br />
                                        <span class="mensaje">Tipo de archivo permitido .PDF hasta de 10MB</span><br>
                                        <small style="text-align:justify; font-size:12px;"> Adjuntar constancia del servicio a prestar con un organismo de socorro: Defensa Civil o Cruz Roja.</small><br>                                      
                                           </label>                                    
                                <div class="custom-file file-govco">
                                   <input type="file" accept="application/pdf"  name="adj_hospitalaria_arch" class="custom-file-input input-file-govco" id="adj_hospitalaria_arch" onchange="uploadHandler(event,'adj_hospitalaria_arch')"  tabindex="33"/>
                                   <label class="custom-file-label label-file-govco @error('adj_hospitalaria_arch') is-invalid @enderror"  ondrop="dropHandler(event, 'adj_hospitalaria_arch')" ondragover="dragOverHandler(event, 'adj_hospitalaria_arch')"  for="adj_hospitalaria_arch"><span class="govco-icon govco-icon-attached-n size-2x"></span>
                                    Arrastre aquí su archivo o haga click para añadir.</label>
                                   @error('adj_hospitalaria_arch')
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                             </div>
                            </div>

                            <div class="col-md-12 pl-1 pr-1 pt-3">
                                {{-- <label for="adj_poliza_arch" class="form-label">Póliza de responsabilidad civil*&nbsp; <small
                                        style="font-size: 11!important;" aling="justify"><em
                                            style="font-size: 11px!important" aling="justify"> Adjuntar Póliza de
                                            Responsabilidad Civil Extracontractual que ampare los riesgos que el evento
                                            conlleva, debe ser adquirida por el organizador con empresa aseguradora de su
                                            elección, a favor del Municipio de Bucaramanga, especificando lugar, fecha del
                                            evento. </em></small> </label><br>
                                <div class="form-group">
                                    <div class="file-loading">
                                        <input class=" @error('adj_poliza_arch') is-invalid @enderror documentos_adjuntos"
                                            id="adj_poliza_arch" accept="application/pdf" name="adj_poliza_arch" type="file"
                                            data-overwrite-initial="true" required>
                                        @error('adj_poliza_arch')
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="form-group">                                  
                                    <label for="input-file-simple-label" class="inputfile-gov">
                                        <strong>Póliza de responsabilidad civil*</strong> <br />
                                        <span class="mensaje">Tipo de archivo permitido .PDF hasta de 10MB</span><br>
                                        <small style="text-align:justify; font-size:12px;"> Adjuntar Póliza de
                                            Responsabilidad Civil Extracontractual que ampare los riesgos que el evento
                                            conlleva, debe ser adquirida por el organizador con empresa aseguradora de su
                                            elección, a favor del Municipio de Bucaramanga, especificando lugar, fecha del
                                            evento.</small><br>                                      
                                           </label>                                    
                                <div class="custom-file file-govco">
                                   <input type="file" accept="application/pdf"  name="adj_poliza_arch" class="custom-file-input input-file-govco" id="adj_poliza_arch" onchange="uploadHandler(event,'adj_poliza_arch')"  tabindex="34" required/>
                                   <label class="custom-file-label label-file-govco @error('adj_poliza_arch') is-invalid @enderror"  ondrop="dropHandler(event, 'adj_poliza_arch')" ondragover="dragOverHandler(event, 'adj_poliza_arch')"  for="adj_poliza_arch"><span class="govco-icon govco-icon-attached-n size-2x"></span>
                                    Arrastre aquí su archivo o haga click para añadir.</label>
                                   @error('adj_poliza_arch')
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                             </div>
                            </div>

                            <div class="col-md-12 pl-1 pr-1 pt-3 caja_publicidad">
                                {{-- <label for="adj_publicidad_arch" class="form-label">Soporte de Pago Publicidad Exterior*&nbsp;
                                    <small style="font-size: 11!important;" aling="justify"><em
                                            style="font-size: 11px!important" aling="justify"> Adjuntar Pago de impuesto
                                            publicidad exterior visual o paz y salvo de publicidad exterior visual de que no
                                            van a exhibir ningún tipo de publicidad. (Oficina de publicidad exterior visual-
                                            Secretaria del Interior) (Calle 35 No. 10 – 43 Edificio Fase I Piso 3).
                                        </em></small> </label><br>
                                <div class="form-group">
                                    <div class="file-loading">
                                        <input class=" @error('adj_publicidad_arch') is-invalid @enderror documentos_adjuntos"
                                            id="adj_publicidad_arch" accept="application/pdf" name="adj_publicidad_arch" type="file"
                                            data-overwrite-initial="true">
                                        @error('adj_publicidad_arch')
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="form-group">                                  
                                    <label for="input-file-simple-label" class="inputfile-gov">
                                        <strong>Soporte de Pago Publicidad Exterior*</strong> <br />
                                        <span class="mensaje">Tipo de archivo permitido .PDF hasta de 10MB</span><br>
                                        <small style="text-align:justify; font-size:12px;"> Adjuntar Pago de impuesto
                                            publicidad exterior visual o paz y salvo de publicidad exterior visual de que no
                                            van a exhibir ningún tipo de publicidad. (Oficina de publicidad exterior visual-
                                            Secretaria del Interior) (Calle 35 No. 10 – 43 Edificio Fase I Piso 3).</small><br>                                      
                                           </label>                                    
                                <div class="custom-file file-govco">
                                   <input type="file" accept="application/pdf"  name="adj_publicidad_arch" class="custom-file-input input-file-govco" id="adj_publicidad_arch" onchange="uploadHandler(event,'adj_publicidad_arch')"  tabindex="35"/>
                                   <label class="custom-file-label label-file-govco @error('adj_publicidad_arch') is-invalid @enderror"  ondrop="dropHandler(event, 'adj_publicidad_arch')" ondragover="dragOverHandler(event, 'adj_publicidad_arch')"  for="adj_publicidad_arch"><span class="govco-icon govco-icon-attached-n size-2x"></span>
                                    Arrastre aquí su archivo o haga click para añadir.</label>
                                   @error('adj_publicidad_arch')
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                             </div>
                            </div>
                            

                            <div class="col-md-12 pl-1 pr-1 pt-3">
                                {{-- <label for="adj_autorizacionTra_arch" class="form-label">Autorización de Transito &nbsp; <small
                                        style="font-size: 11px!important"><em style="font-size: 11px!important"> Adjuntar
                                            autorización de la Direccion de transito de Bucaramanga si el evento lo requiere
                                            (depende del sitio)</em></small></label><br><br>
                                <div class="form-group">
                                    <div class="file-loading">
                                        <input
                                            class=" @error('adj_autorizacionTra_arch') is-invalid @enderror documentos_adjuntos"
                                            id="adj_autorizacionTra_arch" accept="application/pdf" name="adj_autorizacionTra_arch"
                                            type="file" data-overwrite-initial="true">
                                        @error('adj_autorizacionTra_arch')
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="form-group">                                  
                                    <label for="input-file-simple-label" class="inputfile-gov">
                                        <strong>Autorización de Transito</strong> <br />
                                        <span class="mensaje">Tipo de archivo permitido .PDF hasta de 10MB</span><br>
                                        <small style="text-align:justify; font-size:12px;"> Adjuntar
                                            autorización de la Direccion de transito de Bucaramanga si el evento lo requiere
                                            (depende del sitio)</small><br>                                      
                                           </label>                                    
                                <div class="custom-file file-govco">
                                   <input type="file" accept="application/pdf"  name="adj_autorizacionTra_arch" class="custom-file-input input-file-govco" id="adj_autorizacionTra_arch" onchange="uploadHandler(event,'adj_autorizacionTra_arch')"  tabindex="36"/>
                                   <label class="custom-file-label label-file-govco @error('adj_autorizacionTra_arch') is-invalid @enderror"  ondrop="dropHandler(event, 'adj_autorizacionTra_arch')" ondragover="dragOverHandler(event, 'adj_autorizacionTra_arch')"  for="adj_autorizacionTra_arch"><span class="govco-icon govco-icon-attached-n size-2x"></span>
                                    Arrastre aquí su archivo o haga click para añadir.</label>
                                   @error('adj_autorizacionTra_arch')
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                             </div>
                            </div>

                            <div class="col-md-12 pl-1 pr-1 pt-3 caja_derechos">
                                {{-- <label for="adj_derAutor_arch" class="form-label">Autorización derechos de Autor*&nbsp; <small
                                        style="font-size: 11!important;" aling="justify"><em
                                            style="font-size: 11px!important" aling="justify"> Adjuntar certificado que
                                            acredite Los derechos de autor previstos en la ley y presentar su respectiva
                                            autorización, si en el evento público se ejecutaran obras causantes de dichos
                                            pagos.</em></small> </label><br>
                                <div class="form-group">
                                    <div class="file-loading">
                                        <input class=" @error('adj_derAutor_arch') is-invalid @enderror documentos_adjuntos"
                                            id="adj_derAutor_arch" accept="application/pdf" name="adj_derAutor_arch" type="file"
                                            data-overwrite-initial="true" required>
                                        @error('adj_derAutor_arch')
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="form-group">                                  
                                    <label for="input-file-simple-label" class="inputfile-gov">
                                        <strong>Autorización derechos de Autor*</strong> <br />
                                        <span class="mensaje">Tipo de archivo permitido .PDF hasta de 10MB</span><br>
                                        <small style="text-align:justify; font-size:12px;">Adjuntar certificado que
                                            acredite Los derechos de autor previstos en la ley y presentar su respectiva
                                            autorización, si en el evento público se ejecutaran obras causantes de dichos
                                            pagos.</small><br>                                      
                                           </label>                                    
                                <div class="custom-file file-govco">
                                   <input type="file" accept="application/pdf"  name="adj_derAutor_arch" class="custom-file-input input-file-govco" id="adj_derAutor_arch" onchange="uploadHandler(event,'adj_derAutor_arch')"  tabindex="37" required/>
                                   <label class="custom-file-label label-file-govco @error('adj_derAutor_arch') is-invalid @enderror"  ondrop="dropHandler(event, 'adj_derAutor_arch')" ondragover="dragOverHandler(event, 'adj_derAutor_arch')"  for="adj_derAutor_arch"><span class="govco-icon govco-icon-attached-n size-2x"></span>
                                    Arrastre aquí su archivo o haga click para añadir.</label>
                                   @error('adj_derAutor_arch')
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                             </div>
                            </div>

                            <div class="col-md-12 pl-1 pr-1 pt-3 caja-cmgrd">
                                {{-- <label for="adj_conceptoCMGRD_arch" class="form-label">Concepto del Comité de Gestion del Riesgo
                                    *&nbsp; <small style="font-size: 11!important;" aling="justify"><em
                                            style="font-size: 11px!important" aling="justify">Concepto técnico emitido por
                                            CMGRD, del plan de emergencia y contingencia, que deberá constar por escrito
                                            incluyendo las recomendaciones. (No continuar con el trámite de los demás
                                            requisitos sin haber obtenido primero la certificación favorable emitida por el
                                            Comité).</em></small> </label>
                                <div class="form-group">
                                    <div class="file-loading">
                                        <input class=" @error('adj_conceptoCMGRD_arch') is-invalid @enderror documentos_adjuntos"
                                            id="adj_conceptoCMGRD_arch" accept="application/pdf" name="adj_conceptoCMGRD_arch"
                                            type="file" data-overwrite-initial="true">
                                        @error('adj_conceptoCMGRD_arch')
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="form-group">                                  
                                    <label for="input-file-simple-label" class="inputfile-gov">
                                        <strong>Concepto del Comité de Gestion del Riesgo*</strong> <br />
                                        <span class="mensaje">Tipo de archivo permitido .PDF hasta de 10MB</span><br>
                                        <small style="text-align:justify; font-size:12px;">Concepto técnico emitido por
                                            CMGRD, del plan de emergencia y contingencia, que deberá constar por escrito
                                            incluyendo las recomendaciones. (No continuar con el trámite de los demás
                                            requisitos sin haber obtenido primero la certificación favorable emitida por el
                                            Comité).</small><br>                                      
                                           </label>                                    
                                <div class="custom-file file-govco">
                                   <input type="file" accept="application/pdf"  name="adj_conceptoCMGRD_arch" class="custom-file-input input-file-govco" id="adj_conceptoCMGRD_arch" onchange="uploadHandler(event,'adj_conceptoCMGRD_arch')"  tabindex="38"/>
                                   <label class="custom-file-label label-file-govco @error('adj_conceptoCMGRD_arch') is-invalid @enderror"  ondrop="dropHandler(event, 'adj_conceptoCMGRD_arch')" ondragover="dragOverHandler(event, 'adj_conceptoCMGRD_arch')"  for="adj_conceptoCMGRD_arch"><span class="govco-icon govco-icon-attached-n size-2x"></span>
                                    Arrastre aquí su archivo o haga click para añadir.</label>
                                   @error('adj_conceptoCMGRD_arch')
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                             </div>
                            </div>



                            <div class="col-md-12 pl-1 pt-3">
                                <h4 class="headline-m-govco">Aviso de privacidad y autorización tratamiento de datos
                                    personales</h4>

                                <a class="btn btn-low px-0"
                                    href="https://www.bucaramanga.gov.co/Inicio/autorizacion-de-tratamiento-de-datos-personales/"
                                    target="_blank">Autorizo el tratamiento de datos personales</a>
                                <label class="d-inline labelGen" tabindex="39" >
                                    <input type="checkbox" class="check-style" id="AT00" name="tratamiento_datos"  value="SI" tabindex="39" required />
                                    <label for="AT00"> </label>
                                </label><br>

                                <a class="btn btn-low px-0"
                                    href="https://www.bucaramanga.gov.co/wp-content/uploads/2018/12/Resolucion-340-Dic-26-2018-y-Politica.pdf"
                                    target="_blank" >Acepto términos y condiciones</a>
                                <label class="d-inline labelGen" tabindex="40">
                                    <input type="checkbox" class="check-style" id="AT01" name="acepto_terminos"  value="SI"  tabindex="40" required/>
                                    <label for="AT01"> </label>
                                </label>
                                <p class="text-justify">Confirmo que soy mayor de edad y con plena capacidad para
                                    diligenciar el presente formulario.
                                    Así mismo declaro que la información aquí suministrada corresponde a la verdad.
                                    Declaro que he leído, entiendo y acepto las políticas de tratamiento de los datos que
                                    suministro,
                                    de conformidad con la Ley 1581 de 2012 y demás normas concordantes
                                    <label class="d-inline labelGen" tabindex="40">
                                        <input type="checkbox" class="check-style" id="AT02" name="confirmo_mayorEdad"  value="SI" tabindex="40" required />
                                        <label for="AT02"> </label>
                                    </label>
                                </p>
                            </div>
                            <div class="col-md-11 pl-1 pr-1 pt-3">
                                <p>Acepto que la información aquí registrada sea compartida con otras entidades y/o
                                    terceros vinculados a la Alcaldía de Bucaramanga</p>
                                @error('compartir_informacion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="form-check-inline">
                                    <label class="labelGen"  tabindex="41">
                                        <input type="radio" name="compartir_informacion" id="rb_si" value="SI" class="radio-per-gov"  tabindex="41"/>
                                        <label for="rb_si">SI</label>
                                    </label>
                                </div>
                                <div class="form-check-inline" >
                                    <label class="labelGen" tabindex="42">
                                        <input type="radio" name="compartir_informacion" id="rb_no" value="NO"  class="radio-per-gov"  tabindex="42"/>
                                        <label for="rb_no">NO</label>
                                    </label>
                                </div>

                            </div>

                            <div class="col-md-12  pl-1 pr-1 pt-3 text-left mt-4" style="padding-left: 0px!important">

                            <div class="g-recaptcha" data-sitekey="6LdzXDwcAAAAAOgw8LzMLMjgnI2spGFhuCoMYlGc"  data-tabindex="42"></div>
                                
                                <button style="font-size:15px;" type="submit" class="btn btn-round btn-middle btn_enviar_solicitud" onclick="return confirm('¿Esta seguro de realizar esta solicitud ?, ¿ Revisó bien los anexos?, si esta seguro oprima aceptar')"  tabindex="43">Enviar Solicitud</button>
                                
                                <button style="font-size:15px;" class="btn btn-round btn-middle btn_carga d-none" type="button" disabled><span class="spinner-grow spinner-grow-sm text-primary" role="status" aria-hidden="true"></span> Enviando...</button>
                            </div>
                        </div>
                    </form>
                </div>



                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <!---contenido de cajas -->

                    <div class="accordion accordion-govco mb-3" id="">
                        <div class="card mb-0">
                            <div class="card-header row no-gutters" id="">
                                <button class="btn-link row no-gutters" type="button">
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                       <a  type="button" href="{{asset('library/Manuales/M-TIC-1400-170-015 M. Usuario Permi. Espect. Difere. Artes (ciudadano).pdf')}}" target="_blank"><h4 class="headline-s-govco" tabindex="5">Manual de usuario</h4></a>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <div class="btn-icon-close">
                                            {{-- <span class="govco-icon govco-icon-shortu-arrow-n size-1x"></span> --}}
                                            {{-- <span class="govco-icon govco-icon-shortd-arrow-n size-1x"></span> --}}
                                        </div>
                                    </div>
                                </button>
                            </div>                        
                        </div>
                    </div>
                       

                    <div class="accordion accordion-govco" id="EjemploAccordion-2">
                        <div class="card mb-0">
                            <div class="card-header row no-gutters" id="headingUno">
                                <button class="btn-link row no-gutters collapsed" type="button" data-toggle="collapse"
                                    data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9" tabindex="6">
                                        <h4 class="headline-s-govco">¿Tienes dudas?</h4>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <div class="btn-icon-close">                                            
                                            <span class="govco-icon govco-icon-shortd-arrow-n size-1x"></span>
                                        </div>
                                    </div>
                                </button>
                            </div>
                            <div id="collapse1" class="collapse mb-3" aria-labelledby="headingUno"
                                data-parent="#EjemploAccordion-2">
                                <div class="card-body bg-color-selago">
                                    <div class="container">
                                        <p class="form-inline my-0"><span class="govco-icon govco-icon-email"></span> <a
                                                style="color: #3366CC; font-size: 13px!important;" href="mailto:contactenos@bucaramanga.gov.co" target="_blank" tabindex="7"> ccalderon@bucaramanga.gov.co</a></p>
                                        <p class="form-inline my-0"><span class="govco-icon govco-icon-call-center"></span><a
                                                style="color: #3366CC; font-size: 13px!important;" tabindex="7" href="tel:0376337000"> (+57)7 633 70 00 EXT 315</a></p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion accordion-govco" id="acc4">
                        <div class="card">
                            <div class="card-header row no-gutters" id="c4">
                                <button class="btn-link row no-gutters collapsed" type="button" data-toggle="collapse"
                                    data-target="#coll4" aria-expanded="false" aria-controls="coll4" id="btn_colapse">
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9" tabindex="8">
                                        <h4 class="headline-s-govco">¿Como fue tu experiencia durante el proceso?</h4>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <div class="btn-icon-close">
                                            <span class="govco-icon govco-icon-shortd-arrow-n size-1x"></span>
                                        </div>
                                    </div>
                                </button>
                            </div>
                            <div id="coll4" class="collapse" aria-labelledby="c4" data-parent="#acc4">
                                <div class="card-body bg-color-selago">
                                    <div class="row justify-content-center spacer no-gutters">
                                        <div class="col-3 pl-3 pt-2">
                                            <button type="button" id="btn-facil-global"class="btn-symbolic-govco align-column-govco btn-facil-global" tabindex="8" value="FACIL">
                                                <span class="govco-icon govco-icon-check-cn size-3x"></span>
                                                <span class="btn-govco-text">Facil</span>
                                            </button>
                                        </div>

                                        <div class="col-3 pl-3 pt-2">
                                            <button type="button" id="btn-dificil-global"
                                                class="btn-symbolic-govco align-column-govco btn-dificil-global"
                                                value="DIFICIL" tabindex="8">
                                                <span class="govco-icon govco-icon-x-cn size-3x"></span>
                                                <span class="btn-govco-text">Dificil</span>
                                            </button>
                                        </div>
                                    </div>
                                    {{-- modulo tramites --}}
                                    <input id="modulo" type="hidden" class="form-control modulo"
                                        value="PERMISOS PARA ESPECTACULOS PUBLICOS">


                                    <div class="container text-center">
                                        <button type="button" class="btn btn-round btn-middle btn-block"
                                            id="btn-sugerencias" data-toggle="tooltip" data-placement="right"
                                            title="Después de escribir tus sugerencias oprime FACIL o DIFICIL para enviarlas"
                                            style="" tabindex="8">Escribe
                                            tus sugerencias</button><br>
                                        <div id="Texto_sugerencias" style="display: none;">
                                            <p style="color:#3366CC;"> Gracias por compartir tu experiencia</p>
                                        </div>

                                        <div id="text-button" style="padding-bottom: 10px; display: none;">
                                            <label class="text-left small">Escribe tus comentarios</label>
                                            <textarea class="form-control pb-2" rows="5"
                                                placeholder="Queremos conocer tu experiencia, sugerencias y consejos"
                                                id="text-area" tabindex="8" maxlength="300" onkeypress="return Direccion(event)"
                                                onkeyup="aMayusculas(this.value,this.id)"></textarea>
                                                <button type="button" class="btn btn-round btn-middle btn-block enviar-sugerencias"
                                                id="enviar-sugerencias" data-toggle="tooltip" data-placement="right" title="enviar sugerencias" tabindex="8">Envia tus sugerencias</button>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row justify-content-center">
                        <a href="{{route('eventos.index')}}"><button style="font-size:15px;" type="button" class="btn btn-round btn-middle" id="btn-back" tabindex="8">Volver al inicio del tramite</button></a>
                      </div>

                    {{-- tercer acordion --}}

                   

                </div>
            </div>
        </div>



    </div>
    {{-- fin contenedor pricincipal --}}

    {{-- MODAL DIRECCIONES --}}

    <div id="ModalDireccionesEventos" class="modal fade center" role="dialog">
        <div class="modal-dialog modal-lg" style="max-width: 1000px!important;">

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
                                <label style="color:#111111;" class="input" for="DD01"
                                    style="font-family: 'Barlow', sans-serif;"> Calle - Carrera *</label>
                                <select name="DD01" id="DD01" type="text" class="form-control input-md modal1"
                                    required="required"
                                    title="Selecciona el tipo de indicación inicial para la dirección que desea ingresar" tabindex="12">
                                    <option value=""></option>
                                    @foreach ($Parametros2 as $parametro2)
                                        <option value="{{ $parametro2->ParDes }}">{{ $parametro2->ParDes }}</option>
                                    @endforeach


                                </select>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                            <div class="form-group">
                                <label style="color:#111111;" class="input" for="DD02"
                                    style="font-family: 'Barlow', sans-serif;">N° - Nombre * </label>
                                <input id="DD02" name="DD02" type="text" class="form-control modal1" maxlength="20"
                                    required="required"
                                    title="En este campo se deberá digitar número o nombre según corresponda a la selección en el campo anterior, te recomendamos observar el campo de visualización que se encuentra al final de este módulo para organizar tu dirección correctamente."
                                    onkeypress="return NumDoc(event)" onchange="aMayusculas(this.value,this.id)"
                                    style="height: 29px!important;" tabindex="12" placeholder="Ej: 12">
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                            <div class="form-group">
                                <label style="color:#111111;" class="input" for="DD03"
                                    style="font-family: 'Barlow', sans-serif;">Letra </label>
                                <select id="DD03" name="DD03" type="text" class="form-control input-md modal1"
                                    title="Selecciona una letra si tu indicación de dirección en el campo anterior contiene esta opción, si no la posee déjala en blanco" tabindex="12">
                                    <option value=""></option>
                                    @foreach ($Parametros1 as $parametro1)
                                        <option value="{{ $parametro1->ParNom }}">{{ $parametro1->ParNom }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"><br>
                            <div class="form-group">
                                <label style="color:#111111;" class="input" for="DD04"
                                    style="font-family: 'Barlow', sans-serif;">Numero* </label>
                                <input id="DD04" name="DD04" type="text" class="form-control modal1" maxlength="4"
                                    title="Digita en este campo el primer número de tu dirección"
                                    onkeypress="return Numeros(event)" required="required" style="height: 29px!important;" placeholder="Ej: 35" tabindex="12">
                            </div>
                        </div> 

                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                            <div class="form-group">
                                <label style="color:#111111;" class="input" for="DD05"
                                    style="font-family: 'Barlow', sans-serif;">Letra </label>
                                <select id="DD05" name="DD05" type="text" class="form-control input-md modal1"
                                    title="Selecciona una letra si tu indicación de dirección en el campo anterior contiene esta opción, si no la posee déjala en blanco" tabindex="12">
                                    <option value=""></option>
                                    @foreach ($Parametros1 as $parametro1)
                                        <option value="{{ $parametro1->ParNom }}">{{ $parametro1->ParNom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"><br>
                            <div class="form-group">
                                <label style="color:#111111;" class="input" for="DD06"
                                    style="font-family: 'Barlow', sans-serif;">Numero* </label>
                                <input id="DD06" name="DD06" type="text" class="form-control modal1" maxlength="4"
                                    title="Digita en este campo el primer número de tu dirección"
                                    onkeypress="return Numeros(event)" style="height: 29px!important;" tabindex="12" placeholder="Ej: 75">
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                            <div class="form-group">
                                <label style="color:#111111;" class="input" for="DD07"
                                    style="font-family: 'Barlow', sans-serif;">Letra </label>
                                <select id="DD07" name="DD07" type="text" class="form-control input-md modal1"
                                    title="Selecciona una letra si tu indicación de dirección en el campo anterior contiene esta opción, si no la posee déjala en blanco" tabindex="12">
                                    <option value=""></option>
                                    @foreach ($Parametros1 as $parametro1)
                                        <option value="{{ $parametro1->ParNom }}">{{ $parametro1->ParNom }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-2 col-sm-12 col-xs-12 caja_ultima"><br>
                            <div class="form-group">
                                <label style="color:#111111;" class="input" for="DD08"
                                    style="font-family: 'Barlow', sans-serif;">Complemento </label>
                                <input id="DD08" name="DD08" type="text" class="form-control modal1" maxlength="80"
                                    title="Digita en este el complemento de tu direccion"
                                    onkeyup="aMayusculas(this.value,this.id)" tabindex="12" placeholder="Ej: Conjunto Villareal">
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><br><br>
                            <div class="form-group">
                                <input
                                    style="background-color: #004884; color: #FFFFFF; font-weight: bold; border-radius:8px;"
                                    name="Direccion" id="DD000" type="text" class="form-control input-md DD00"
                                    data-toggle="tooltip" title="Previsualizador de la dirección introducida"
                                    data-delay='{"show":"30", "hide":"30"}' placeholder="Pre visualizador de direcciones"
                                    required="required" readonly>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="modal-footer">

                    <button style="font-size:15px;" type="button" class="btn btn-round btn-middle btn-outline-info"
                        id="btnDireccionEventos" value="Boton" tabindex="12">Ingresar Dirección</button>
                    <button style="font-size:15px;" type="button" class="btn btn-round btn-middle btn-outline-info"
                        data-dismiss="modal" tabindex="12">Cerrar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div id="ModalUbicacion" class="modal fade center" role="dialog">
        <div class="modal-dialog modal-lg" style="max-width: 1000px!important;">

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
                                <label style="color:#111111;" class="input" for="DD01"
                                    style="font-family: 'Barlow', sans-serif;"> Calle - Carrera *</label>
                                <select name="DD01" id="DD010" type="text" class="form-control input-md modal2"
                                    required="required"
                                    title="Selecciona el tipo de indicación inicial para la dirección que desea ingresar" tabindex="20">
                                    <option value=""></option>
                                    @foreach ($Parametros2 as $parametro2)
                                        <option value="{{ $parametro2->ParDes }}">{{ $parametro2->ParDes }}</option>
                                    @endforeach


                                </select>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                            <div class="form-group">
                                <label style="color:#111111;" class="input" for="DD02"
                                    style="font-family: 'Barlow', sans-serif;">N° - Nombre * </label>
                                <input id="DD020" name="DD02" type="text" class="form-control modal2" maxlength="20"
                                    required="required"
                                    title="En este campo se deberá digitar número o nombre según corresponda a la selección en el campo anterior, te recomendamos observar el campo de visualización que se encuentra al final de este módulo para organizar tu dirección correctamente."
                                    onkeypress="return NumDoc(event)" onchange="aMayusculas(this.value,this.id)"
                                    style="height: 29px!important;" tabindex="20" placeholder="Ej: 20">
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                            <div class="form-group">
                                <label style="color:#111111;" class="input" for="DD03"
                                    style="font-family: 'Barlow', sans-serif;">Letra </label>
                                <select id="DD030" name="DD03" type="text" class="form-control input-md modal2"
                                    title="Selecciona una letra si tu indicación de dirección en el campo anterior contiene esta opción, si no la posee déjala en blanco" tabindex="20">
                                    <option value=""></option>
                                    @foreach ($Parametros1 as $parametro1)
                                        <option value="{{ $parametro1->ParNom }}">{{ $parametro1->ParNom }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"><br>
                            <div class="form-group">
                                <label style="color:#111111;" class="input" for="DD04"
                                    style="font-family: 'Barlow', sans-serif;">Numero* </label>
                                <input id="DD040" name="DD04" type="text" class="form-control modal2" maxlength="4"
                                    title="Digita en este campo el primer número de tu dirección"
                                    onkeypress="return Numeros(event)" required="required" style="height: 29px!important;" tabindex="20" placeholder="Ej: 3">
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                            <div class="form-group">
                                <label style="color:#111111;" class="input" for="DD05"
                                    style="font-family: 'Barlow', sans-serif;">Letra </label>
                                <select id="DD050" name="DD050" type="text" class="form-control input-md modal2"
                                    title="Selecciona una letra si tu indicación de dirección en el campo anterior contiene esta opción, si no la posee déjala en blanco" tabindex="20">
                                    <option value=""></option>
                                    @foreach ($Parametros1 as $parametro1)
                                        <option value="{{ $parametro1->ParNom }}">{{ $parametro1->ParNom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"><br>
                            <div class="form-group">
                                <label style="color:#111111;" class="input" for="DD06"
                                    style="font-family: 'Barlow', sans-serif;">Numero* </label>
                                <input id="DD060" name="DD06" type="text" class="form-control modal2" maxlength="4"
                                    title="Digita en este campo el primer número de tu dirección"
                                    onkeypress="return Numeros(event)" style="height: 29px!important;" tabindex="20" placeholder="Ej: 45">
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                            <div class="form-group">
                                <label style="color:#111111;" class="input" for="DD07"
                                    style="font-family: 'Barlow', sans-serif;">Letra </label>
                                <select id="DD070" name="DD070" type="text" class="form-control input-md modal2"
                                    title="Selecciona una letra si tu indicación de dirección en el campo anterior contiene esta opción, si no la posee déjala en blanco" tabindex="20">
                                    <option value=""></option>
                                    @foreach ($Parametros1 as $parametro1)
                                        <option value="{{ $parametro1->ParNom }}">{{ $parametro1->ParNom }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-2 col-sm-12 col-xs-12 caja_ultima"><br>
                            <div class="form-group">
                                <label style="color:#111111;" class="input" for="DD08"
                                    style="font-family: 'Barlow', sans-serif;">Complemento </label>
                                <input id="DD080" name="DD08" type="text" class="form-control modal2" maxlength="80"
                                    title="Digita en este el complemento de tu direccion"
                                    onkeyup="aMayusculas(this.value,this.id)" tabindex="20" placeholder="Ej: Plazoleta Luis Carlos Galan">
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><br><br>
                            <div class="form-group">
                                <input
                                    style="background-color: #004884; color: #FFFFFF; font-weight: bold; border-radius:8px;"
                                    name="Direccion" id="DD0000" type="text" class="form-control input-md DD00"
                                    data-toggle="tooltip" title="Previsualizador de la dirección introducida"
                                    data-delay='{"show":"30", "hide":"30"}' placeholder="Pre visualizador de direcciones"
                                    required="required" readonly>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="modal-footer">

                    <button style="font-size:15px;" type="button" class="btn btn-round btn-middle btn-outline-info"
                        id="btnModalUbicacionEvento" tabindex="20" value="Boton">Ingresar Dirección</button>
                    <button style="font-size:15px;" type="button" class="btn btn-round btn-middle btn-outline-info"
                        data-dismiss="modal" tabindex="20">Cerrar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL CONSULTAR SOLICITUD --}}

    <div id="ModalConsulta" class="modal fade center" role="dialog">
        <div class="modal-dialog modal-lg" style="max-width: 1000px!important;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="background:#E5EEFB;">
                    <h4 class="modal-title">Consultar Solicitud</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="post" action="{{ route('eventos.consulta') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row form-row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><br>
                                <div class="form-group">
                                    <label style="color:#111111;" class="input" for="DD01"
                                        style="font-family: 'Barlow', sans-serif;">Buscar Por </label>
                                    <select id="VD01" name="tipo_parametro" class="form-control select_general input-md"
                                        title="Seleccione la opción para validar el documento" required="required">
                                        <option value="">Seleccione</option>
                                        <option value="radicado">Numero de radicado</option>
                                        <option value="ide_responsable">Documento de identificación Solicitante
                                        </option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><br>
                                <div class="form-group">
                                    <label style="color:#111111;" class="input" for="DD01"
                                        style="font-family: 'Barlow', sans-serif;">Digite Numero </label>
                                    <input type="text" name="parametro" id="VD00" class="form-control input-md"
                                        title="Seleccione la opción para validar el documento" required="required"
                                        onkeypress="return Numeros(event)" onkeyup="aMayusculas(this.value,this.id)"
                                        maxlength="40" minlength="5">

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">

                        <button type="submit" class="btn btn-round btn-middle btn-outline-info" id="Boton">Realizar Búsqueda</button>
                        <button type="button" class="btn btn-round btn-middle btn-outline-info"
                            data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
