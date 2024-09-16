@extends('layouts.app')

@section('title', 'Espectaculos Publicos')
@section('content')

    <style>
        .clockpicker-button {
            background-color: #3366CC !important;
            color: white !important;
        }

        /** SPINNER CREATION **/

        .loader {
            position: relative;
            text-align: center;
            margin: 15px auto 35px auto;
            z-index: 9999;
            display: block;
            width: 80px;
            height: 80px;
            border: 10px solid rgba(0, 0, 0, .3);
            border-radius: 50%;
            border-top-color: #004884;
            animation: spin 1s ease-in-out infinite;
            -webkit-animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                -webkit-transform: rotate(360deg);
            }
        }

        @-webkit-keyframes spin {
            to {
                -webkit-transform: rotate(360deg);
            }
        }

    </style>

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <div class="container mt-3 mb-4 m-xs-x-3">
    <div class="row pl-4">
            <div class="px-0 col-md-9 col-xs-12 col-sm-12">
                <nav aria-label="Miga de pan" style="max-height: 20px;">
                    <ol class="breadcrumb" style="background-color: #FFFFFF;">
                        <li class="breadcrumb-item ml-3 ml-md-0">
                            <a style="color: #004fbf; font-size:14px;" class="breadcrumb-text" href="https://www.bucaramanga.gov.co" tabindex="3">Inicio</a>
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
                                   Espectáculos públicos
                                    </p>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="container-fluid xxx">
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
                                    <p style="padding-top: 0px;margin-top:5px; color: #3366CC; " id="barra_progreso"><span
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

                    <form action="" method="" role="form" id="myForm" enctype="multipart/form-data"
                        class="form-ciudadano-espectaculos">
                        @csrf
                        <div class="card govco-card border-0 shadow-none" style="border-radius: 0px;">

                            <h1 class="headline-xl-govco">Pago en linea - Impuesto de espectáculos públicos</h1>

                            <div class="alert-primary-govco alert alert-dismissible fade show mt-3"
                                aria-label="Alerta informativa">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar"
                                    title="Cerrar">&times;</button>
                                <div class="alert-heading">
                                    <span class="govco-icon govco-icon-bell-sound-p size-2x"></span>
                                    <span class="headline-l-govco">Importante</span>
                                </div>
                                <p style="text-align: justify"> Este tramite esta diseñado para el registro del espectáculo
                                    publico Municipal y espectáculos públicos con destino al deporte que no corresponda a
                                    las representaciones en vivo de expresiones artísticas en teatro, danza, música, circo,
                                    magia y todas sus posibles prácticas derivadas o creadas a partir de la
                                    imaginación, sensibilidad y conocimiento del ser humano que congregan la gente por fuera
                                    del ámbito doméstico de que trata el artículo 3 de la ley 1493 de 2011 presentada por el
                                    productor de espectáculos públicos la persona Natural o Jurídica. </p>
                            </div>
                        </div>

                        <h3 class="headline-l-govco mt-3 pl-0">1. Datos Generales de la Solicitud <br> <span class="small-text-govco">*Campos obligatorios</span></h3>

                        <div id="top">
                            <div class="alert alert-danger print-error-msg alert-dismissible fade show" style="display:none"
                                role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <ul></ul>
                            </div>
                        </div>
                        <a href="#top" class="d-none" id="a-top"></a>



                        <div class="row form-group mt-2">
                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="tipo_persona" class="form-label">Tipo Persona * </label>
                                <select class="form-control  @error('tipo_persona') is-invalid @enderror"
                                    name="tipo_persona" id="tipo_persona_espec" required>
                                    <option value="">Seleccione</option>
                                    <option value="N">Natural</option>
                                    <option value="J">Jurídica</option>

                                </select>
                                @error('tipo_persona')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3 caja_nombres d-none">
                                <label for="nom_solicitante" class="form-label">Nombres del Solicitante y/o Responsable
                                    * </label>
                                <input value="{{ old('nom_solicitante') }}" type="text"
                                    class="form-control name_validate  @error('nom_solicitante') is-invalid @enderror"
                                    name="nom_solicitante" id="nom_solicitante" maxlength="25" minlength="4"
                                    onkeypress="return Letras(event)" onkeyup="aMayusculas(this.value,this.id)">
                                @error('nom_solicitante')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3 caja_nombres d-none">
                                <label for="ape_solicitante" class="form-label">Apellidos del Solicitante y/o
                                    Responsable * </label>
                                <input value="{{ old('ape_solicitante') }}" type="text"
                                    class="form-control name_validate  @error('ape_solicitante') is-invalid @enderror"
                                    name="ape_solicitante" id="ape_solicitante" maxlength="25" minlength="4"
                                    onkeypress="return Letras(event)" onkeyup="aMayusculas(this.value,this.id)">
                                @error('ape_solicitante')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-12 pl-1 pr-1 pt-3 caja_razon d-none">
                                <label for="razon_social" class="form-label">Razon Social * </label>
                                <input value="{{ old('razon_social') }}" type="text"
                                    class="form-control razon_social  @error('razon_social') is-invalid @enderror"
                                    name="razon_social" id="razon_social" maxlength="40" minlength="4"
                                    onkeypress="return Letras(event)" onkeyup="aMayusculas(this.value,this.id)">
                                @error('razon_social')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>



                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="tipo_identificacion" class="form-label">Tipo de Documento * </label>
                                <select class="form-control  @error('tipo_identificacion') is-invalid @enderror"
                                    name="tipo_identificacion" id="tipo_identificacion">
                                    <option value="">Seleccione</option>
                                    <option value="C.C.">Cedula de Ciudadanía</option>
                                    <option value="NIT">NIT</option>
                                </select>
                                @error('tipo_identificacion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="numero_identificacion" class="form-label">Numero de Identificacion* </label>
                                <input value="{{ old('numero_identificacion') }}" type="text"
                                    class="form-control document_validate  @error('numero_identificacion') is-invalid @enderror"
                                    name="numero_identificacion" id="numero_identificacion" maxlength="15" minlength="4"
                                    onkeypress="return Numeros(event)" required>
                                @error('numero_identificacion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-12 pl-1 pt-3">

                                <label for="direccion_notificacion" class="form-label">Dirección de notificación*
                                </label><button type="button" class="btn btn-link"><span
                                        style="text-transform: lowercase; font-size: 12px;" class="text-primary"
                                        data-toggle="modal" data-target="#ModalDirecciones">(Clic para insertar
                                        direccion)</span></button>
                                <input type="text" value="{{ old('direccion_notificacion') }}"
                                    class="form-control  @error('direccion_notificacion') is-invalid @enderror"
                                    name="direccion_notificacion" id="direccion_solicitante" maxlength="120" required
                                    readonly>
                                @error('direccion_notificacion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="barrio_solicitante" class="form-label">Barrio* </label>
                                <select name="barrio_notificacion" id="barrio_solicitante"
                                    class="form-control @error('barrio_notificacion') is-invalid @enderror" required>
                                    <option value=""></option>
                                    @foreach ($Barrios as $barrio)
                                        <option value="{{ $barrio->nombre }}">{{ $barrio->nombre }}</option>

                                    @endforeach
                                </select>
                                @error('barrio_notificacion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="telefono_movil" class="form-label">Teléfono / Celular * </label>
                                <input value="{{ old('telefono_movil') }}" type="text"
                                    class="form-control  @error('telefono_movil') is-invalid @enderror number_validate"
                                    name="telefono_movil" id="telefono_movil" maxlength="10" minlength="7"
                                    onkeypress="return Numeros(event)" required>
                                @error('telefono_movil')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="email_responsable" class="form-label">Correo Electronico Responsable *
                                </label>
                                <input value="{{ old('email_responsable') }}" type="mail"
                                    class="form-control  @error('email_responsable') is-invalid @enderror email_validate"
                                    name="email_responsable" id="email_responsable" onkeypress="return Email(event)" required>
                                @error('email_responsable')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="email_confirmado" class="form-label">Confirme su correo* </label>
                                <input type="mail" onpaste="return false;"
                                    class="form-control  @error('email_confirmado') is-invalid @enderror email_validate"
                                    name="email_confirmado" id="email_confirmado" onkeypress="return Email(event)" required onpaste="return false;">
                                @error('email_confirmado')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-12 pl-1 pr-1 pt-3">
                                <label for="nombre_evento" class="form-label">Nombre del evento * </label>
                                <input value="{{ old('nombre_evento') }}" type="text"
                                    class="form-control razon_social  @error('nombre_evento') is-invalid @enderror"
                                    name="nombre_evento" id="nombre_evento" maxlength="240" minlength="4"
                                    onkeypress="return Letras(event)" onkeyup="aMayusculas(this.value,this.id)">
                                @error('nombre_evento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="id_evento" class="form-label">Tipo de evento * </label>
                                <select class="form-control  @error('id_evento') is-invalid @enderror" name="id_evento"
                                    id="id_evento" required>
                                    <option value="">Seleccione</option>
                                    <option value="1">UNICO</option>
                                    <option value="2">SUCESIVO</option>
                                </select>
                                @error('id_evento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="fecha_inicio_evento" class="form-label">Fecha de Evento * </label>
                                <input type="date" class="form-control  @error('fecha_inicio_evento') is-invalid @enderror"
                                    name="fecha_inicio_evento" id="fecha_inicio_evento">
                                @error('fecha_inicio_evento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3 caja-fecha-fin d-none">
                                <label for="fecha_fin_evento" class="form-label">Fecha de final del evento * </label>
                                <input type="date" class="form-control  @error('fecha_fin_evento') is-invalid @enderror"
                                    name="fecha_fin" id="fecha_fin_evento">
                                @error('fecha_fin_evento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-3 pl-1 pr-1 pt-3">
                                <label for="hora_inicio" class="form-label">Hora de inicio* </label>
                                <div class="input-group clockpicker">
                                    <input type="text" value="{{ old('hora_inicio') }}"
                                        class="form-control @error('hora_inicio') is-invalid @enderror " value="00:00"
                                        name="hora_inicio" id="hora_inicio" required>
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
                                    <input type="text" value="{{ old('hora_fin') }}"
                                        class="form-control @error('hora_fin') is-invalid @enderror " value="00:00"
                                        name="hora_fin" id="hora_fin" required>
                                </div>
                                @error('hora_fin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>




                            <div class="col-md-12 pl-1 pt-3">

                                <label for="lugar_evento" class="form-label">Ubicación del evento * </label><button
                                    type="button" class="btn btn-link"><span
                                        style="text-transform: lowercase; font-size: 12px;" class="text-primary"
                                        data-toggle="modal" data-target="#ModalDireccionesEmpresas">(Clic para insertar
                                        direccion)</span></button>
                                <input type="text" value="{{ old('lugar_evento') }}"
                                    class="form-control  @error('lugar_evento') is-invalid @enderror" name="direccion_evento"
                                    id="direccion_empresa" maxlength="120" required readonly>
                                @error('lugar_evento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="barrio_empresa" class="form-label">Barrio* </label>
                                <select name="barrio_evento" id="barrio_empresa"
                                    class="form-control @error('barrio_evento') is-invalid @enderror" required>
                                    <option value=""></option>
                                    @foreach ($Barrios as $barrio)
                                        <option value="{{ $barrio->nombre }}">{{ $barrio->nombre }}</option>

                                    @endforeach
                                </select>
                                @error('barrio_evento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-12 pl-1 pt-3">

                                <label for="descripcion_evento">Descripcion del evento*</label>
                                <textarea name="descripcion_evento" id="descripcion_evento"
                                    onkeypress="return Observaciones(event)" onkeyup="aMayusculas(this.value,this.id)"
                                    maxlength="500" class="form-control  @error('descripcion_evento') is-invalid @enderror"
                                    cols="2" rows="3" required></textarea>
                                @error('descripcion_evento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="col-md-12 pl-1 pt-3">
                                <label for="agregar_boleteria pb-3">Agregar Total de Boleteria <button type="button"
                                        class="btn btn-round btn-sm btn-middle" style="padding:5px!important;"
                                        onclick="openModal()">Anexar</button></label>
                                <div class="table-simple-headblue-govco">
                                    <table class="table display table-responsive-sm table-responsive-md" style="width:100%"
                                        id="tablaBoleteria">
                                        <thead>
                                            <tr>
                                                <th>Tipo de Boleteria</th>
                                                <th>Valor</th>
                                                <th>N° de boletas Impresas</th>
                                                <th>Acción</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="tipo_garantia" class="form-label">Tipo de Garantia * </label>
                                <input value="{{ old('tipo_garantia') }}" type="text"
                                    class="form-control name_validate  @error('tipo_garantia') is-invalid @enderror"
                                    name="tipo_garantia" id="tipo_garantia" placeholder="Ejemplo: CHEQUE" maxlength="25"
                                    minlength="4" onkeypress="return Letras(event)"
                                    onkeyup="aMayusculas(this.value,this.id)" required>
                                @error('tipo_garantia')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>






                            <h3 class="headline-l-govco mt-3 pl-0">2. Documentos Adjuntos de la Solicitud <br> <span class="small-text-govco">*Campos obligatorios</span></h3>

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="archivo_rut" class="form-label">RUT* <br><small class="text-danger"
                                        style="font-size: 11px!important">Solo se permiten archivos .pdf con un tamaño
                                        máximo de 10MB</small> </label>
                                <div class="form-group">
                                    <div class="file-loading">
                                        <input class=" @error('archivo_rut') is-invalid @enderror documentos_adjuntos"
                                            id="archivo_rut" accept="application/pdf" name="archivo_rut" type="file"
                                            data-overwrite-initial="true" required>
                                        @error('archivo_rut')
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="archivo_camara" class="form-label">Camara de Comercio* <br><small
                                        class="text-danger" style="font-size: 11px!important">Solo se permiten archivos
                                        .pdf con un tamaño máximo de 10MB</small> </label>
                                <div class="form-group">
                                    <div class="file-loading">
                                        <input class=" @error('archivo_camara') is-invalid @enderror documentos_adjuntos"
                                            id="archivo_camara" accept="application/pdf" name="archivo_camara" type="file"
                                            data-overwrite-initial="true" required>
                                        @error('archivo_camara')
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>



                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="archivo_boleteria" class="form-label">Certificacion Boleteria* <br> <small
                                        class="text-danger" style="font-size: 11px!important">Solo se permiten archivos
                                        .pdf con un tamaño máximo de 10MB</small> </label>
                                <div class="form-group">
                                    <div class="file-loading">
                                        <input
                                            class=" @error('archivo_boleteria') is-invalid @enderror documentos_adjuntos"
                                            id="archivo_boleteria" accept="application/pdf" name="archivo_boleteria"
                                            type="file" data-overwrite-initial="true" required>
                                        @error('archivo_boleteria')
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="archivo_copia_cedula" class="form-label">Copia de cedula de representante*
                                    <br> <small class="text-danger" style="font-size: 11px!important">Solo se permiten
                                        archivos .pdf con un tamaño máximo de 10MB</small></label>
                                <div class="form-group">
                                    <div class="file-loading">
                                        <input
                                            class=" @error('archivo_copia_cedula') is-invalid @enderror documentos_adjuntos"
                                            id="archivo_copia_cedula" accept="application/pdf" name="archivo_copia_cedula"
                                            type="file" data-overwrite-initial="true" required>
                                        @error('archivo_copia_cedula')
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="archivo_solicitud" class="form-label">Solicitud Firmada*
                                    <br> <small class="text-danger" style="font-size: 11px!important">Solo se permiten
                                        archivos .pdf con un tamaño máximo de 10MB</small></label>
                                <div class="form-group">
                                    <div class="file-loading">
                                        <input
                                            class=" @error('archivo_solicitud') is-invalid @enderror documentos_adjuntos"
                                            id="archivo_solicitud" accept="application/pdf" name="archivo_solicitud"
                                            type="file" data-overwrite-initial="true" required>
                                        @error('archivo_solicitud')
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="arch_otros" class="form-label">Otros Adjuntos (opcional)
                                    <br> <small class="text-danger" style="font-size: 11px!important">Solo se permiten
                                        archivos .pdf con un tamaño máximo de 10MB</small></label>
                                <div class="form-group">
                                    <div class="file-loading">
                                        <input class=" @error('arch_otros') is-invalid @enderror documentos_adjuntos"
                                            id="arch_otros" accept="application/pdf" name="arch_otros"
                                            type="file" data-overwrite-initial="true">
                                        @error('arch_otros')
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
                                <p class="text-justify">Confirmo que soy mayor de edad y con plena capacidad para
                                    diligenciar el presente formulario.
                                    Así mismo declaro que la información aquí suministrada corresponde a la verdad.
                                    Declaro que he leído, entiendo y acepto las políticas de tratamiento de los datos que
                                    suministro,
                                    de conformidad con la Ley 1581 de 2012 y demás normas concordantes
                                    <label class="checkbox-govco d-inline">
                                        <input type="checkbox" id="AT02" name="confirmo_mayorEdad" id="" checked
                                            value="SI" />
                                        <label for="AT02"> </label>
                                    </label>
                                </p>
                                <p class="text-justify">Para efectos de notificaciones y comunicaciones electrónicas, en materia tributaria, de acuerdo a lo establecido en el Decreto 0040 de 2022, Autorizo que sean notificados al siguiente correo: <span id="span-notificaciones"></span>
                                    <label class="checkbox-govco d-inline">
                                        <input type="checkbox" id="AT03" name="confirmo_notificaciones" checked
                                            value="SI" />
                                        <label for="AT03"> </label>
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
                                    <label class="radiolist-govco radiobutton-govco">
                                        <input type="radio" name="compartir_informacion" id="rb_si" value="SI" required
                                            checked />
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

                            <div class="col-md-12  pl-1 pr-1 pt-3 text-left mt-4" style="padding-left: 0px!important">
                                <div class="g-recaptcha" data-sitekey="6LdzXDwcAAAAAOgw8LzMLMjgnI2spGFhuCoMYlGc"></div>
                                <button style="font-size:15px;" type="submit" class="btn btn-round btn-middle btn_enviar_solicitud" name="consultar" onclick="return confirm('¿Esta seguro de realizar esta solicitud ?')">Enviar Solicitud</button>
                                <button style="font-size:15px;" class="btn btn-round btn-middle btn_carga d-none"
                                    type="button" disabled><span class="spinner-grow spinner-grow-sm text-primary"
                                        role="status" aria-hidden="true"></span> Enviando...</button>
                            </div>
                        </div>
                    </form>
                </div>








                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <!---contenido de cajas -->
                   {{-- manual --}}

                   <div class="accordion accordion-govco mb-3" id="">
                     <div class="card mb-0">
                         <div class="card-header row no-gutters" id="">
                             <button class="btn-link row no-gutters" type="button">
                                 <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                    <a  type="button" href="{{asset('library/Manuales/INSTRUCTIVO PARA REALIZAR SOLICITUD DEL REGISTRO DE ESPECTACULOS PUBLICOS EN EL MUNICIPIO DE BUCARAMANGA.pdf')}}" target="_blank"><h4 class="headline-s-govco" tabindex="5">Manual de usuario</h4></a>
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
                                  <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"  tabindex="6">
                                      <h4 class="headline-s-govco">¿Tienes dudas?</h4>
                                  </div>
                                  <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                      <div class="btn-icon-close">
                                          {{-- <span class="govco-icon govco-icon-shortu-arrow-n size-1x"></span> --}}
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
                                                style="color: #3366CC; font-size: 13px!important;" href="mailto:lcerquera@bucaramanga.gov.co"
                                                target="_blank" tabindex="7"> lcerquera@bucaramanga.gov.co</a></p>
                                        <p class="form-inline my-0"><span class="govco-icon govco-icon-call-center"></span><a
                                                style="color: #3366CC; font-size: 13px!important;" href="tel:0376337000"> (+57)7 633 70 00</a></p>

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
                                          {{-- <span class="govco-icon govco-icon-shortu-arrow-n size-1x"></span> --}}
                                          <span class="govco-icon govco-icon-shortd-arrow-n size-1x"></span>
                                      </div>
                                  </div>
                              </button>
                          </div>
                            <div id="coll4" class="collapse" aria-labelledby="c4" data-parent="#acc4">
                                <div class="card-body bg-color-selago">
                                    <div class="row justify-content-center spacer no-gutters">
                                        <div class="col-3 pl-3 pt-2">
                                            <button type="button" id="btn-facil-global" class="btn-symbolic-govco align-column-govco btn-facil-global" value="FACIL" tabindex="8">
                                                <span class="govco-icon govco-icon-check-cn size-3x"></span>
                                                <span class="btn-govco-text">Facil</span>
                                            </button>
                                        </div>

                                        <div class="col-3 pl-3 pt-2">
                                            <button type="button" id="btn-dificil-global" class="btn-symbolic-govco align-column-govco btn-dificil-global"  value="DIFICIL" tabindex="8">
                                                <span class="govco-icon govco-icon-x-cn size-3x"></span>
                                                <span class="btn-govco-text">Dificil</span>
                                            </button>
                                        </div>
                                    </div>
                                    {{-- modulo tramites --}}
                                    <input id="modulo" type="hidden" class="form-control modulo" value="ESPECTACULOS PUBLICOS">


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
                                                   id="enviar-sugerencias" data-toggle="tooltip" data-placement="right"
                                                   title=""style="" tabindex="8">Envia tus sugerencias</button>
                                               
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>   
                    <div class="row justify-content-center">
                        <a href="{{route('espectaculos.index')}}"><button style="font-size:15px;" type="button" class="btn btn-round btn-middle" id="btn-back" tabindex="8">Volver al inicio del tramite</button></a>
                      </div>              
                   
                                      
                </div>
            </div>
        </div>



    </div>
    {{-- fin contenedor pricincipal --}}

    {{-- MODAL DIRECCIONES --}}

    <div id="ModalDirecciones" class="modal fade center" role="dialog">
        <div class="modal-dialog modal-lg" style="max-width: 1000px!important;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="background:#E5EEFB;">
                    <h4 class="modal-title">Ingresa tu Dirección</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                 <form>
                <div class="modal-body">
                    <div class="row form-row">

                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                            <div class="form-group">
                                <label style="color:#111111;" class="input" for="DD01"
                                    style="font-family: 'Barlow', sans-serif;"> Calle - Carrera *</label>
                                <select name="DD01" id="DD01" type="text" class="form-control input-md modal1"
                                    required="required"
                                    title="Selecciona el tipo de indicación inicial para la dirección que desea ingresar">
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
                                    style="height: 29px!important;">
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                            <div class="form-group">
                                <label style="color:#111111;" class="input" for="DD03"
                                    style="font-family: 'Barlow', sans-serif;">Letra </label>
                                <select id="DD03" name="DD03" type="text" class="form-control input-md modal1"
                                    title="Selecciona una letra si tu indicación de dirección en el campo anterior contiene esta opción, si no la posee déjala en blanco">
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
                                    onkeypress="return Numeros(event)" required="required" style="height: 29px!important;">
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                            <div class="form-group">
                                <label style="color:#111111;" class="input" for="DD05"
                                    style="font-family: 'Barlow', sans-serif;">Letra </label>
                                <select id="DD05" name="DD05" type="text" class="form-control input-md modal1"
                                    title="Selecciona una letra si tu indicación de dirección en el campo anterior contiene esta opción, si no la posee déjala en blanco">
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
                                    onkeypress="return Numeros(event)" style="height: 29px!important;">
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                            <div class="form-group">
                                <label style="color:#111111;" class="input" for="DD07"
                                    style="font-family: 'Barlow', sans-serif;">Letra </label>
                                <select id="DD07" name="DD07" type="text" class="form-control input-md modal1"
                                    title="Selecciona una letra si tu indicación de dirección en el campo anterior contiene esta opción, si no la posee déjala en blanco">
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
                                    onkeyup="aMayusculas(this.value,this.id)">
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
                        id="btnDireccion" value="Boton">Ingresar Dirección</button>
                    <button style="font-size:15px;" type="button" class="btn btn-round btn-middle btn-outline-info"
                        data-dismiss="modal">Cerrar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div id="ModalDireccionesEmpresas" class="modal fade center" role="dialog">
        <div class="modal-dialog modal-lg" style="max-width: 1000px!important;">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="background:#E5EEFB;">

                    <h4 class="modal-title">Ingresa tu Dirección</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form>
                <div class="modal-body">
                    <div class="row form-row">

                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                            <div class="form-group">
                                <label style="color:#111111;" class="input" for="DD01"
                                    style="font-family: 'Barlow', sans-serif;"> Calle - Carrera *</label>
                                <select name="DD01" id="DD010" type="text" class="form-control input-md modal2"
                                    required="required"
                                    title="Selecciona el tipo de indicación inicial para la dirección que desea ingresar">
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
                                    style="height: 29px!important;">
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                            <div class="form-group">
                                <label style="color:#111111;" class="input" for="DD03"
                                    style="font-family: 'Barlow', sans-serif;">Letra </label>
                                <select id="DD030" name="DD03" type="text" class="form-control input-md modal2"
                                    title="Selecciona una letra si tu indicación de dirección en el campo anterior contiene esta opción, si no la posee déjala en blanco">
                                    <option></option>
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
                                    onkeypress="return Numeros(event)" required="required" style="height: 29px!important;">
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                            <div class="form-group">
                                <label style="color:#111111;" class="input" for="DD05"
                                    style="font-family: 'Barlow', sans-serif;">Letra </label>
                                <select id="DD050" name="DD050" type="text" class="form-control input-md modal2"
                                    title="Selecciona una letra si tu indicación de dirección en el campo anterior contiene esta opción, si no la posee déjala en blanco">
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
                                    onkeypress="return Numeros(event)" style="height: 29px!important;">
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                            <div class="form-group">
                                <label style="color:#111111;" class="input" for="DD07"
                                    style="font-family: 'Barlow', sans-serif;">Letra </label>
                                <select id="DD070" name="DD070" type="text" class="form-control input-md modal2"
                                    title="Selecciona una letra si tu indicación de dirección en el campo anterior contiene esta opción, si no la posee déjala en blanco">
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
                                    onkeyup="aMayusculas(this.value,this.id)">
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
                        id="btnDireccionEmpresas" value="Boton">Ingresar Dirección</button>
                    <button style="font-size:15px;" type="button" class="btn btn-round btn-middle btn-outline-info"
                        data-dismiss="modal">Cerrar</button>
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
                <form method="post" action="{{ route('espectaculos.consulta') }}">
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
                                        <option value="radicado">Numero de radicado</option>
                                        <option value="numero_identificacion">N° de identificación Solicitante
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

    {{-- MODAL BOLTERIA --}}

    <div id="ModalBoleteria" class="modal fade center" role="dialog">
        <div class="modal-dialog modal-lg" style="max-width: 1000px!important;">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="background:#E5EEFB;">

                    <h4 class="modal-title">Ingresa la Boleteria</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="row form-row">


                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"><br>
                            <div class="form-group">
                                <label style="color:#111111;" class="input" for="tipo_boleteria"
                                    style="font-family: 'Barlow', sans-serif;">Clase de Boleta* </label>
                                <input id="tipo_boleteria" name="tipo_boleteria" type="text" class="form-control"
                                    maxlength="80" placeholder="Ejem: Preferencial" title="Tipo de boleteria"
                                    onkeypress="return Letras(event)" onkeyup="aMayusculas(this.value,this.id)">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"><br>
                            <div class="form-group">
                                <label style="color:#111111;" class="input" for="valor_boleteria"
                                    style="font-family: 'Barlow', sans-serif;">Valor Boleteria *</label>
                                <input id="valor_boleteria" name="valor_boleteria" type="text" class="form-control"
                                    title="valor de boleteria" onkeypress="return Numeros(event)">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"><br>
                            <div class="form-group">
                                <label style="color:#111111;" class="input" for="cantidad_boleteria"
                                    style="font-family: 'Barlow', sans-serif;">Numero de Boletas *</label>
                                <input id="cantidad_boleteria" name="cantidad_boleteria" type="text" class="form-control"
                                    title="valor de boleteria" onkeypress="return Numeros(event)">
                            </div>
                        </div>





                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="parametro" id="parametro">
                    <button style="font-size:15px;" type="button" class="btn btn-round btn-middle btn-outline-info"
                        id="btnBoleteria" value="Boton" onclick="agregarFila()">Agregar Boletereria</button>
                    <button style="font-size:15px;" type="button" class="btn btn-round btn-middle btn-outline-info d-none"
                        id="btnEditBoleteria" onclick="updateFila()" value="Boton">Editar Boletereria</button>
                    <button style="font-size:15px;" type="button" onclick="borrarCampos()"
                        class="btn btn-round btn-middle btn-outline-info" data-dismiss="modal">Cerrar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal de carga --}}
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
    <script>
        let emailValidate = document.getElementById('email_confirmado');
        emailValidate.addEventListener('change',(e)=>{{ }
         document.getElementById('span-notificaciones').innerHTML = '';
         document.getElementById('span-notificaciones').innerHTML = `<mark><b>${e.target.value}</b></mark>`;
    
    })
    </script>

@endsection
