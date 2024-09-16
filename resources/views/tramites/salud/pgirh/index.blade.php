@extends('layouts.app')

@section('title', 'Te llevamos en el corazón - Metrolinea')
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
                                        Planeacion
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
                                <!--<div data-id="step1" class="step-slider-item active" ><p style="padding-top: 0px;margin-top:5px;"></p></div>-->
                                <div data-id="step2" class="step-slider-item active">
                                    <p style="padding-top: 0px;margin-top:5px;color: #3366CC;" id="barra_progreso"><span
                                            class="circle_uno">1</span> Inicio</p>
                                </div>
                                <div data-id="step3" class="step-slider-item">
                                    <p style="padding-top: 0px;margin-top:5px;color: #3366CC" id="barra_progreso"><span
                                            class="circle_uno">2 </span> Hago mi solicitud</p>
                                </div>
                                <div data-id="step4" class="step-slider-item">
                                    <p style="padding-top: 0px;margin-top:5px;" id="barra_progreso"><span
                                            class="circle_dos">3</span>Procesan mi solicitud</p>
                                </div>
                                <div data-id="step5" class="step-slider-item">
                                    <p style="padding-top: 0px;margin-top:5px;" id="barra_progreso"><span
                                            class="circle_dos">4</span> Respuesta</p>
                                </div>

                            </div>
                        </div>
                    </div>

                    <form action="{{route('metrolinea.store')}}" method="POST" id="FormMetrolinea" enctype="multipart/form-data" class="form-ciudadano">
                        @csrf
                        <div class="card govco-card border-0 shadow-none" style="border-radius: 0px;">

                            <h1 class="headline-xl-govco">Te llevamos en el corazón - Metrolinea</h1>

                            - @if ($errors->any())
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

                            <div class="alert-primary-govco alert alert-dismissible fade show mt-3"
                                aria-label="Alerta informativa">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar"
                                    title="Cerrar">&times;</button>
                                <div class="alert-heading">
                                    <span class="govco-icon govco-icon-bell-sound-p size-2x"></span>
                                    <span class="headline-l-govco">Importante</span>
                                </div>
                                <p style="text-align: justify"> Esta información debe ser 100% veraz y solo te podrás registrar una vez, asegúrate de validar tu información personal y documentos adjuntos antes de enviar de solicitud.</p>
                            </div>
                        </div>

                        <h3 class="headline-l-govco mt-3 pl-0">1. Datos Generales de la Solicitud</h3>

                        <div class="row form-group mt-2">

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="tipo_poblacion" class="form-label"> Tipo de Poblacion* </label>
                                <select class="form-control  @error('tipo_poblacion') is-invalid @enderror"
                                    name="tipo_poblacion" id="tipo_poblacion" required>
                                    <option value="">Seleccione</option>
                                    <option value="ESTUDIANTE-COLEGIO">ESTUDIANTE COLEGIO</option>
                                    <option value="ESTUDIANTE-UNIVERSIDAD">ESTUDIANTE UNIVERSITARIO / TECNOLOGO / TECNICO</option>
                                    <option value="DEPORTISTA-ARTISTA">DEPORTISTA / ARTISTA</option>
                                    <option value="ADULTO MAYOR">ADULTO MAYOR</option>
                                    <option value="PERSONAS CON DISCAPACIDAD">PERSONA CON DISCAPACIDAD</option>
                                </select>
                                @error('tipo_poblacion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="nombre_usuario" class="form-label">Nombres * </label>
                                <input value="{{ old('nombre_usuario') }}" type="text"
                                    class="form-control name_validate  @error('nombre_usuario') is-invalid @enderror"
                                    name="nombre_usuario" id="nombre_usuario" maxlength="25" minlength="4" required
                                    onkeypress="return Letras(event)" onkeyup="aMayusculas(this.value,this.id)">
                                @error('nombre_usuario')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="apellido_usuario" class="form-label">Apellidos* </label>
                                <input value="{{ old('apellido_usuario') }}" type="text"
                                    class="form-control name_validate  @error('apellido_usuario') is-invalid @enderror"
                                    name="apellido_usuario" id="apellido_usuario" maxlength="25" minlength="4" required
                                    onkeypress="return Letras(event)" onkeyup="aMayusculas(this.value,this.id)">
                                @error('apellido_usuario')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="tipo_documento" class="form-label">Tipo de Documento * </label>
                                <select class="form-control  @error('tipo_documento') is-invalid @enderror"
                                    name="tipo_documento" id="tipo_documento" required>
                                    <option value="">Seleccione</option>
                                    <option value="T.I.">Tarjeta de Identidad</option>
                                    <option value="C.C.">Cedula de Ciudadanía</option>
                                    {{-- <option value="C.E.">Cedula de Extranjería</option> --}}
                                    <option value="P.P.">Pasaporte</option>
                                </select>
                                @error('tipo_documento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="documento_usuario" class="form-label">Numero de Identificacion* </label>
                                <input value="{{ old('documento_usuario') }}" type="text"
                                    class="form-control document_validate  @error('documento_usuario') is-invalid @enderror"
                                    name="documento_usuario" id="documento_usuario" maxlength="15" minlength="4" required
                                    onkeypress="return Email(event)">
                                @error('documento_usuario')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento* </label>
                                <input type="date"
                                    class="form-control document_validate  @error('fecha_nacimiento') is-invalid @enderror"
                                    name="fecha_nacimiento" id="fecha_nacimiento" required>
                                @error('fecha_nacimiento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-12 pl-1 pt-3 caja_acudiente d-none">

                                <label for="nombre_acudiente" class="form-label">Nombre del acudiente*&nbsp; <small
                                        style="font-size: 11px!important"><em style="font-size: 11px!important">(Persona
                                            responsable de menor)</em> </small> </label>
                                <input type="text" value="{{ old('nombre_acudiente') }}"
                                    class="form-control  @error('nombre_acudiente') is-invalid @enderror"
                                    name="nombre_acudiente" id="nombre_acudiente" maxlength="120"
                                    onkeypress="return Letras(event)" onkeyup="aMayusculas(this.value,this.id)">
                                @error('nombre_acudiente')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-12 pl-1 pt-3 caja_discapacidad d-none">

                                <label for="nombre_cuidador" class="form-label">Nombre del cuidador primario&nbsp; <small
                                        style="font-size: 11px!important"><em style="font-size: 11px!important">(Persona
                                            responsable de la persona con discapacidad OPCIONAL)</em> </small> </label>
                                <input type="text" value="{{ old('nombre_cuidador') }}"
                                    class="form-control  @error('nombre_cuidador') is-invalid @enderror"
                                    name="nombre_cuidador" id="nombre_cuidador" maxlength="120"
                                    onkeypress="return Letras(event)" onkeyup="aMayusculas(this.value,this.id)">
                                @error('nombre_cuidador')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                <label for="estado_civil" class="form-label">Estado Civil* <small style="font-size: 10px!important"><em style="font-size: 10px!important">(del solicitante)</em> </small> </label>
                                <select class="form-control  @error('estado_civil') is-invalid @enderror"
                                    name="estado_civil" id="estado_civil" required>
                                    <option value="">Seleccione</option>
                                    <option value="Soltero">Soltero(a)</option>
                                    <option value="Casado">Casado(a)</option>
                                    <option value="Divorciado">Divorciado(a)</option>
                                    <option value="Concubinato">Concubinato</option>
                                    <option value="Viudo">Viudo(a)</option>
                                    <option value="Ninguno">Ninguno(a)</option>
                                </select>
                                @error('estado_civil')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3 ">
                                <label for="nivel_estudios" class="form-label">Nivel de estudios* <small
                                        style="font-size: 10px!important"><em style="font-size: 10px!important">(del solicitante)</em> </small> </label>
                                <select class="form-control  @error('nivel_estudios') is-invalid @enderror"
                                    name="nivel_estudios" id="nivel_estudios" required>
                                    <option value="">Seleccione</option>
                                    <option value="Ninguno">Ninguno</option>
                                    <option value="Basica Primaria">Básica Primaria</option>
                                    <option value="Basica Secundaria">Básica Secundaria</option>
                                    <option value="Educacion Media">Educación Media</option>
                                    <option value="Educacion Tecnica Profesional y/o Tecnologica">Educación Técnica
                                        Profesional y/o Tecnologica</option>
                                    <option value="Educacion Universitaria">Educación Universitaria</option>
                                    <option value="Postgrado">Postgrado</option>
                                </select>
                                @error('nivel_estudios')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="sexo" class="form-label">Sexo* </label>
                                <select class="form-control  @error('sexo') is-invalid @enderror" name="sexo" id="sexo"
                                    required>
                                    <option value="">Seleccione</option>
                                    <option value="Mujer">Mujer</option>
                                    <option value="Hombre">Hombre</option>
                                    <option value="Otro">Otro</option>
                                </select>
                                @error('sexo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="orientacion_sexual" class="form-label">Orientacion Sexual* </label>
                                <select name="orientacion_sexual" id="orientacion_sexual"
                                    class="form-control @error('orientacion_sexual') is-invalid @enderror" required>
                                    <option value="">Seleccione</option>
                                    @foreach ($orientacion_sexual as $orientacion)
                                        <option value="{{ $orientacion->OriDescripcion }}">
                                            {{ $orientacion->OriDescripcion }}</option>

                                    @endforeach
                                </select>
                                @error('orientacion_sexual')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> --}}

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="telefono_usuario" class="form-label">Teléfono / Celular * </label>
                                <input value="{{ old('telefono_usuario') }}" type="text"
                                    class="form-control  @error('telefono_usuario') is-invalid @enderror number_validate"
                                    name="telefono_usuario" id="telefono_usuario" maxlength="10" minlength="7" required
                                    onkeypress="return Numeros(event)">
                                @error('telefono_usuario')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="email_usuario" class="form-label">Correo Electronico *</label>
                                <input value="{{ old('email_usuario') }}" type="mail"
                                    class="form-control  @error('email_usuario') is-invalid @enderror email_validate"
                                    name="email_usuario" id="email_usuario" required>
                                @error('email_usuario')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="Municipio" class="form-label">Municipio* </label>
                                <input value="BUCARAMANGA" type="text"
                                    class="form-control  @error('Municipio') is-invalid @enderror name_validate"
                                    name="Municipio" id="Municipio" readonly>
                                @error('Municipio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="barrio" class="form-label">Barrio* </label>
                                <select name="barrio" id="barrio_solicitante"
                                    class="form-control @error('barrio') is-invalid @enderror" required>
                                    <option value=""></option>
                                    @foreach ($Barrios as $barrio)
                                        <option value="{{ $barrio->nombre }}">{{ $barrio->nombre }}</option>

                                    @endforeach
                                </select>
                                @error('barrio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="corregimiento" class="form-label">Corregimiento* </label>
                                <select name="corregimiento" id="corregimiento"
                                    class="form-control @error('corregimiento') is-invalid @enderror" required>
                                    <option value="">Seleccione</option>
                                    <option value="NO APLICA" selected>NO APLICA</option>
                                    <option value="CORREGIMIENTO 1">CORREGIMIENTO 1</option>
                                    <option value="CORREGIMIENTO 2">CORREGIMIENTO 2</option>
                                    <option value="CORREGIMIENTO 3">CORREGIMIENTO 3</option>

                                </select>
                                @error('corregimiento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-12 pl-1 pt-3">

                                <label for="direccion_usuario" class="form-label">Dirección*</label>
                                <input type="text" value="{{ old('direccion_usuario') }}"
                                    class="form-control  @error('direccion_usuario') is-invalid @enderror"
                                    name="direccion_usuario" id="direccion_usuario" maxlength="120" onkeypress="return Direccion(event)" required>
                                @error('direccion_usuario')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3 caja_estudios d-none">
                                <label for="institucion_educativa" class="form-label">Entidad Educativa* </label>
                                <select name="institucion_educativa" id="institucion_educativa"
                                    class="form-control @error('institucion_educativa') is-invalid @enderror select_general">
                                    <option value=""></option>
                                    {{-- @foreach ($instituciones as $institucion)
                                        <option value="{{ $institucion->nombre_institucion }}">{{ $institucion->nombre_institucion }}</option>

                                    @endforeach --}}
                                </select>
                                @error('institucion_educativa')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3 caja_discapacidad d-none">
                                <label for="discapacidad" class="form-label">Discapacidad* </label>
                                <select name="discapacidad" id="discapacidad"
                                    class="form-control @error('discapacidad') is-invalid @enderror select_general">
                                    <option value=""></option>
                                    @foreach ($discapacidades as $discapacidad)
                                        <option value="{{ $discapacidad->descripcion }}">{{ $discapacidad->descripcion }}</option>

                                    @endforeach
                                </select>
                                @error('discapacidad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="ruta_frecuente" class="form-label">Rutas frecuentes* </label>
                                <select name="ruta_frecuente[]" id="ruta_frecuente"
                                    class="form-control @error('ruta_frecuente') is-invalid @enderror" required multiple>                                    
                                    <option value="T1">T1</option>
                                    <option value="T2">T2</option>
                                    <option value="T3">T3</option>
                                    <option value="P1">P1</option>
                                    <option value="P2">P2</option>   
                                    <option value="P3">P3</option>
                                    <option value="P5">P5</option>  
                                    <option value="P6">P6</option>  
                                    <option value="P8">P8</option>
                                    <option value="P10">P10</option> 
                                    <option value="P13">P13</option>
                                    <option value="P15">P15</option>
                                    <option value="AN1">AN1</option>
                                    <option value="AN2">AN2</option> 
                                    <option value="AB1">AB1</option>  
                                    <option value="AB3">AB3</option>
                                    <option value="AP1">AP1</option> 
                                    <option value="AP2">AP2</option>
                                    <option value="AP3">AP3</option> 
                                    <option value="AP4">AP4</option>
                                    <option value="AP5">AP5</option>
                                    <option value="AP7">AP7</option>
                                    <option value="AP12">AP12</option>
                                    <option value="AP14">AP14</option>
                                    <option value="AC1">AC1</option> 
                                    <option value="AC4">AC4</option>
                                    <option value="AF1">AF1</option> 
                                    <option value="AF2">AF2</option>
                                    <option value="APD1">APD1</option> 
                                    <option value="APD3">APD3</option>
                                    <option value="APD4">APD4</option>
                                    <option value="APD6">APD6</option>
                                    <option value="APD7">APD7</option>
                                    <option value="APD9">APD9</option>                         

                                </select>
                                @error('ruta_frecuente')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="estrato_socioeconomico" class="form-label">Estrato* </label>
                                <select class="form-control  @error('estrato_socioeconomico') is-invalid @enderror" name="estrato_socioeconomico" id="estrato_socioeconomico"
                                    required>
                                    <option value="">Seleccione</option>
                                    <option value="1">Estrato 1</option>
                                    <option value="2">Estrato 2</option>
                                    <option value="3">Estrato 3</option>
                                    <option value="4">Estrato 4</option>
                                    <option value="5">Estrato 5</option>
                                    <option value="6">Estrato 6</option>
                                </select>
                                @error('estrato_socioeconomico')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="trabaja_actualmente" class="form-label">¿Se encuentra con trabajo actualmente? * </label>
                                <select class="form-control  @error('trabaja_actualmente') is-invalid @enderror" name="trabaja_actualmente" id="trabaja_actualmente"
                                    required>
                                    <option value="">Seleccione</option>
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                    
                                </select>
                                @error('trabaja_actualmente')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="tiene_sisben" class="form-label">¿Tiene sisben?* </label>
                                <select class="form-control  @error('tiene_sisben') is-invalid @enderror" name="tiene_sisben" id="tiene_sisben"
                                    required>
                                    <option value="">Seleccione</option>
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                    
                                </select>
                                @error('tiene_sisben')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                                                               
                          <h3 class="headline-l-govco mt-3 pl-0">2. Documentos Adjuntos de la Solicitud</h3>

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="archivo_documentoIdentidad" class="form-label">Copia de documento de identidad <br> <small class="text-danger"
                                        style="font-size: 11px!important">Solo se permiten archivos .pdf con un tamaño
                                        máximo de 3MB</small> </label><br><br>
                                <div class="form-group">
                                    <div class="file-loading">
                                        <input
                                            class=" @error('archivo_documentoIdentidad') is-invalid @enderror documentos_adjuntos_metrolinea"
                                            id="archivo_documentoIdentidad" accept="application/pdf" name="archivo_documentoIdentidad"
                                            type="file" data-overwrite-initial="true" required>
                                        @error('archivo_documentoIdentidad')
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            

                            <div class="col-md-6 pl-1 pr-1 pt-3 caja-certificadoVecindad d-none">
                                <label for="archivo_certiVencidad" class="form-label">Certificado de vecindad y recibo de servicio publico (unidos en un mismo pdf)* <br> <small
                                        class="text-danger" style="font-size: 11px!important">Solo se permiten archivos .pdf
                                        con un tamaño máximo de 3MB</small> </label>
                                <div class="form-group">
                                    <div class="file-loading">
                                        <input class=" @error('archivo_certiVencidad') is-invalid @enderror documentos_adjuntos_metrolinea"
                                            id="archivo_certiVencidad" accept="application/pdf" name="archivo_certiVencidad" type="file"
                                            data-overwrite-initial="true">
                                        @error('archivo_certiVencidad')
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6 pl-1 pr-1 pt-3 caja_certificadoEstudios d-none">
                                <label for="archivo_certificadoEstudio" class="form-label">Carnet Vigente de Entidad Educativa ó Certificado de matricula vigente*<br> <small
                                        class="text-danger" style="font-size: 11px!important">Solo se permiten archivos .pdf
                                        con un tamaño máximo de 3MB</small></label><br>
                                <div class="form-group">
                                    <div class="file-loading">
                                        <input class=" @error('archivo_certificadoEstudio') is-invalid @enderror documentos_adjuntos_metrolinea"
                                            id="archivo_certificadoEstudio" accept="application/pdf" name="archivo_certificadoEstudio"
                                            type="file" data-overwrite-initial="true">
                                        @error('archivo_certificadoEstudio')
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3 caja_docAcudiente d-none">
                                <label for="archivo_docAcudiente" class="form-label">Copia Documento de identificación del acudiente* <br> <small
                                        class="text-danger" style="font-size: 11px!important">Solo se permiten archivos .pdf
                                        con un tamaño máximo de 3MB</small></label>
                                <div class="form-group">
                                    <div class="file-loading">
                                        <input class=" @error('archivo_docAcudiente') is-invalid @enderror documentos_adjuntos_metrolinea"
                                            id="archivo_docAcudiente" accept="application/pdf" name="archivo_docAcudiente"
                                            type="file" data-overwrite-initial="true">
                                        @error('archivo_docAcudiente')
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3 caja_docSisben d-none">
                                <label for="archivo_docSisben" class="form-label">Copia calificación Sisben metodología 4: de A1 a C9.* <br> <small
                                        class="text-danger" style="font-size: 11px!important">Solo se permiten archivos .pdf
                                        con un tamaño máximo de 3MB</small></label><br>
                                <div class="form-group">
                                    <div class="file-loading">
                                        <input class=" @error('archivo_docSisben') is-invalid @enderror documentos_adjuntos_metrolinea"
                                            id="archivo_docSisben" accept="application/pdf" name="archivo_docSisben"
                                            type="file" data-overwrite-initial="true">
                                        @error('archivo_docSisben')
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3 caja_discapacidad d-none">
                                <label for="archivo_" class="form-label"> Registro de localización y caracterización de personas con discapacidad del Ministerio de Salud ó Circular Externa 009.* <br> <small
                                        class="text-danger" style="font-size: 11px!important">Solo se permiten archivos .pdf
                                        con un tamaño máximo de 3MB</small></label>
                                <div class="form-group">
                                    <div class="file-loading">
                                        <input class=" @error('archivo_discapacidad') is-invalid @enderror documentos_adjuntos_metrolinea"
                                            id="archivo_discapacidad" accept="application/pdf" name="archivo_discapacidad"
                                            type="file" data-overwrite-initial="true">
                                        @error('archivo_discapacidad')
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3 caja-deportistas d-none">
                                <label for="archivo_" class="form-label"> Carnét de escuelas de formación deportiva o artística vigente.* <br> <small
                                        class="text-danger" style="font-size: 11px!important">Solo se permiten archivos .pdf
                                        con un tamaño máximo de 3MB</small></label>
                                <div class="form-group">
                                    <div class="file-loading">
                                        <input class=" @error('archivo_deportistas_artistas') is-invalid @enderror documentos_adjuntos_metrolinea"
                                            id="archivo_deportistas_artistas" accept="application/pdf" name="archivo_deportistas_artistas"
                                            type="file" data-overwrite-initial="true">
                                        @error('archivo_deportistas_artistas')
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>



                            {{-- por definir cuarto documento --}}
                            <div class="col-md-12 pl-1 pt-3">
                                <h4 class="headline-m-govco">Aviso de privacidad y autorización tratamiento de datos
                                    personales</h4>

                                <a class="btn btn-low px-0"
                                    href="https://www.bucaramanga.gov.co/Inicio/autorizacion-de-tratamiento-de-datos-personales/"
                                    target="_blank">Autorizo el tratamiento de datos personales</a>
                                <label class="checkbox-govco d-inline">
                                    <input type="checkbox" id="AT00" name="tratamiento_datos" checked value="SI" />
                                    <label for="AT00"> </label>
                                </label><br>

                                <a class="btn btn-low px-0"
                                    href="https://www.bucaramanga.gov.co/wp-content/uploads/2018/12/Resolucion-340-Dic-26-2018-y-Politica.pdf"
                                    target="_blank">Acepto términos y condiciones</a>
                                <label class="checkbox-govco d-inline">
                                    <input type="checkbox" id="AT01" name="acepto_terminos" checked value="SI" />
                                    <label for="AT01"> </label>
                                </label>
                                <p class="text-justify">Autorizo al  MUNICIPIO DE BUCARAMANGA, identificado con NIT 890.201.222-0 y a METROLÍNEA S.A. con Nit. 830.507.387-3,  como los Responsables del Tratamiento  de los datos personales que comparto y, en virtud de la presente autorización, pueden procesar, recolectar, almacenar, usar, circular, suprimir, compartir, actualizar, transmitir y transferir de acuerdo con los términos y condiciones de las políticas de tratamiento vigentes, las cuales están en la página <a href="https://www.bucaramanga.gov.co/" target="_blank">www.bucaramanga.gov.co </a>  y  <a href="https://www.metrolinea.gov.co/v3.0/" target="_blank" >www.metrolinea.gov.co/v3.0/</a>, respectivamente.<label class="checkbox-govco d-inline">
                                    <input type="checkbox" id="AT03" name="autorizacion_tratamiento" checked value="SI" />
                                    <label for="AT03"> </label>
                                </label>
                            </p>
                                <p class="text-justify">Confirmo que soy mayor de edad y con plena capacidad para diligenciar el presente formulario (y/o como acudiente). Asi mismo declaro que la información aquí suministrada corresponde a la verdad. Declaro que he leído, entiendo y acepto las políticas de tratamiento de los datos que suministro, de conformidad con la Ley 1581 de 2012 y demás normas concordantes.<label class="checkbox-govco d-inline">
                                        <input type="checkbox" id="AT02" name="confirmo_mayorEdad" checked value="SI" />
                                        <label for="AT02"> </label>
                                    </label>
                                </p>

                               
                            </div>
                            <div class="col-md-12 pl-1 pr-1 pt-3">
                                <p class="text-justify">Acepto que la información aquí registrada sea compartida con otras entidades y/o terceros vinculados a la Alcaldía de Bucaramanga, en especial a Metrolinea para optar al beneficio de tarifa diferencial.</p>
                                @error('compartir_informacion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="form-check-inline">
                                    <label class="radiolist-govco radiobutton-govco">
                                        <input type="radio" class="compartir-info-metro" name="compartir_informacion" id="rb_si" value="SI" required
                                            checked />
                                        <label for="rb_si">SI</label>
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="radiolist-govco radiobutton-govco">
                                        <input type="radio" class="compartir-info-metro" name="compartir_informacion" id="rb_no" value="NO" />
                                        <label for="rb_no">NO</label>
                                    </label>
                                </div>
                            <p class="pt-4 text-justify" ><b>Nota: &nbsp;</b> Si usted requiere ejercer sus derechos sobre la protección de datos, puede contactar a través de los siguientes correos: <a href="mailto:protecciondatos@bucaramanga.gov.co" href="_blank">protecciondatos@bucaramanga.gov.co</a> y/o <a href="mailto:jrueda@metrolinea.gov.co">jrueda@metrolinea.gov.</a></p>
                            </div>

                            <div class="col-md-12  pl-1 pr-1 pt-3 text-left mt-4" style="padding-left: 0px!important">
                               
                                <div class="g-recaptcha" data-sitekey="6LccRDwcAAAAALTdA0arpJ6ilqwmIQF0Jv6qq7Rk"></div>

                                <input type="hidden" class="form-control" name="id_municipio" id="id_municipio" value="68001">
                                <input type="hidden" class="form-control" name="edad" id="edad">
                                <button style="font-size:15px;" type="submit" class="btn btn-round btn-middle btn_enviar_solicitud" name="consultar" onclick="return confirm('¿Esta seguro de enviar esta solicitud ?')">Enviar Solicitud</button>

                                <button style="font-size:15px;" class="btn btn-round btn-middle btn_carga d-none" type="button" disabled><span class="spinner-grow spinner-grow-sm text-primary" role="status" aria-hidden="true"></span> Enviando...</button>
                            </div>
                        </div>
                    </form>
                </div>








                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <!---contenido de cajas -->

                    <div class="accordion accordion-govco" id="EjemploAccordion-2">
                        <div class="card mb-0">
                            <div class="card-header row no-gutters" id="headingUno">
                                <button class="btn-link row no-gutters collapsed" type="button" data-toggle="collapse"
                                    data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
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
                            <div id="collapse1" class="collapse" aria-labelledby="headingUno"
                                data-parent="#EjemploAccordion-2">
                                <div class="card-body bg-color-selago">
                                    <div class="container">
                                        <p class="form-inline my-0">  Echa un vistazo a las preguntas frecuentes <a style="color: #3366CC;" href="https://www.bucaramanga.gov.co/beneficio-metrolinea/#seccion_preguntas" target="_blank">CLIC AQUÍ <span class="govco-icon govco-icon-hand-n size-1x "></span></a></p>
                                        {{-- <p class="form-inline"><span class="govco-icon govco-icon-call-center"></span><a
                                                style="color: #3366CC;" href="tel:0376337000"> (+57)7 633 70 00</a></p> --}}
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
                                            <button type="button" id="btn-facil-global"
                                                class="btn-symbolic-govco align-column-govco btn-facil-global"
                                                value="FACIL">
                                                <span class="govco-icon govco-icon-check-cn size-3x"></span>
                                                <span class="btn-govco-text">Facil</span>
                                            </button>
                                        </div>

                                        <div class="col-3 pl-3 pt-2">
                                            <button type="button" id="btn-dificil-global"
                                                class="btn-symbolic-govco align-column-govco btn-dificil-global"
                                                value="DIFICIL">
                                                <span class="govco-icon govco-icon-x-cn size-3x"></span>
                                                <span class="btn-govco-text">Dificil</span>
                                            </button>
                                        </div>
                                    </div>
                                    {{-- modulo tramites --}}
                                    <input id="modulo" type="hidden" class="form-control modulo"
                                        value="TE LLEVAMOS EN EL CORAZON-METROLINEA">


                                    <div class="container text-center">
                                        <button type="button" class="btn btn-round btn-middle btn-block"
                                            id="btn-sugerencias" data-toggle="tooltip" data-placement="right"
                                            title="Después de escribir tus sugerencias oprime FACIL o DIFICIL para enviarlas"
                                            style="">Escribe
                                            tus sugerencias</button><br>
                                        <div id="Texto_sugerencias" style="display: none;">
                                            <p style="color:#3366CC;"> Gracias por compartir tu experiencia</p>
                                        </div>

                                        <div id="text-button" style="padding-bottom: 10px; display: none;">
                                            <label class="text-left small">Escribe tus comentarios</label>
                                            <textarea class="form-control pb-2" rows="5"
                                                placeholder="Queremos conocer tu experiencia, sugerencias y consejos"
                                                id="text-area" maxlength="300" onkeypress="return Direccion(event)"
                                                onkeyup="aMayusculas(this.value,this.id)"></textarea>

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
                                <button class="btn-link row no-gutters collapsed" type="button" data-toggle="collapse"
                                    data-target="#coll3" aria-expanded="false" aria-controls="coll3">
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
                                        <button data-toggle="modal" data-target="#ModalConsulta" type="button"
                                            class="btn btn-round btn-middle">CONSULTE AQUÍ
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


    {{-- MODAL CONSULTAR SOLICITUD --}}

    <div id="ModalConsulta" class="modal fade center" role="dialog">
        <div class="modal-dialog modal-lg" style="max-width: 1000px!important;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="background:#E5EEFB;">
                    <h4 class="modal-title">Consultar Solicitud</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="post" action="{{ route('metrolinea.consulta') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row form-row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><br>
                                <div class="form-group">
                                    <label style="color:#111111;" class="input" for="DD01"
                                        style="font-family: 'Barlow', sans-serif;">Buscar Por </label>
                                    <select id="VD01" name="tipo_parametro" class="form-control input-md"
                                        title="Seleccione la opción para validar el documento" required="required">
                                        <option value="">Seleccione</option>
                                        <option value="numero_solicitud">Numero de solicitud</option>
                                        <option value="documento_usuario">Documento de identificación Solicitante
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
