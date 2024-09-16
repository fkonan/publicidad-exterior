@extends('layouts.menu')

@section('title', 'Modulo de Gestion UTSP')
@section('dashboard')
<style>
.inputImportant {
    font-size: 16px;
    font-weight: bold;
}

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

body {
    overflow-x: hidden !important;
}
</style>

<meta name="csrf-token" content="{{ csrf_token() }}">


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
                            <a style="color: #004fbf;" class="breadcrumb-text" href="{{route('utsp.index')}}">UTSP</a>
                        </div>
                    </li>
                    <li class="breadcrumb-item ">
                        <div class="image-icon">
                            <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                            <p class="ml-3 ml-md-0 "><b style="color: #004fbf;text-transform: none;">
                                    Registrar Solicitud
                                </b></p>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">

                <form action="" method="POST" id="formUTSP" enctype="multipart/form-data" class="formUTSP">
                    @csrf
                    <div class="card govco-card border-0 shadow-none mt-4 animate__animated animate__bounceInRight"
                        style="border-radius: 0px;">

                        <h1 class="headline-xl-govco">CREAR SOLICITUD UTSP</h1>
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
                    <div id="top">
                        <div class="alert alert-danger print-error-msg alert-dismissible fade show" style="display:none"
                            role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <ul></ul>
                        </div>
                    </div>
                    <div class="card govco-card mt-2 animate__animated animate__bounceInRight" style="">
                        <div class="card-body px-5">

                            <h3 class="headline-l-govco mt-3 pl-0">1. Datos de la solicitud <br> <span
                                    class="small-text-govco">*Campos obligatorios</span></h3>

                            <div class="row form-group mt-2">

                                <div class="col-md-4 pl-1 pr-1 pt-3">
                                    <label for="radicado" class="form-label">Caso N° * </label>
                                    <input value="{{old('radicado', $radicado)}}" type="text"
                                        class="form-control name_validate inputImportant  @error('radicado') is-invalid @enderror"
                                        name="radicado" id="radicado" maxlength="60" minlength="4" required
                                        onkeypress="return Letras(event)" onkeyup="aMayusculas(this.value,this.id)"
                                        placeholder="Ej: Mario" readonly>
                                    @error('radicado')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-4 pl-1 pr-1 pt-3">
                                    <label for="funcionario" class="form-label">Funcionario * </label>
                                    <input value="{{old('funcionario', auth()->user()->name)}}" type="text"
                                        class="form-control name_validate inputImportant  @error('funcionario') is-invalid @enderror"
                                        name="funcionario" id="funcionario" maxlength="60" minlength="4" required
                                        onkeypress="return Letras(event)" onkeyup="aMayusculas(this.value,this.id)"
                                        placeholder="Ej: Mario" readonly>
                                    @error('funcionario')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-4 pl-1 pr-1 pt-3">
                                    <label for="fecha" class="form-label">Fecha * </label>
                                    <input value="{{old('fecha', $date)}}" type="date"
                                        class="form-control  @error('fecha') is-invalid @enderror" name="fecha"
                                        id="fecha" max="{{date('Y-m-d')}}" required>
                                    @error('fecha')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <hr>

                            <h3 class="headline-l-govco mt-3 pl-0">2. Datos del Responsable/Usuario <br> <span
                                    class="small-text-govco">*Campos obligatorios</span></h3>


                            <div class="row form-group mt-2">
                                <div class="col-md-6 pl-1 pr-1 pt-3">
                                    <label for="nombre_usuario" class="form-label">Nombres del Usuario y/o Responsable *
                                    </label>
                                    <input value="{{old('nombre_usuario')}}" type="text"
                                        class="form-control name_validate  @error('nombre_usuario') is-invalid @enderror"
                                        name="nombre_usuario" id="nombre_usuario" maxlength="20" minlength="4" required
                                        onkeypress="return Letras(event)" onkeyup="aMayusculas(this.value,this.id)"
                                        placeholder="Ej: Mario Jose">
                                    @error('nombre_usuario')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 pl-1 pr-1 pt-3">
                                    <label for="apellido_usuario" class="form-label">Apellidos del Usuario y/o
                                        Responsable *
                                    </label>
                                    <input value="{{old('apellido_usuario')}}" type="text"
                                        class="form-control name_validate  @error('apellido_usuario') is-invalid @enderror"
                                        name="apellido_usuario" id="apellido_usuario" maxlength="20" minlength="4"
                                        required onkeypress="return Letras(event)"
                                        onkeyup="aMayusculas(this.value,this.id)" tabindex="10"
                                        placeholder="Ej: Perez Ardila">
                                    @error('apellido_usuario')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 pl-1 pr-1 pt-3">
                                    <label for="tipo_documento" class="form-label">Tipo de Documento del
                                        Ciudadano*</label>
                                    <select
                                        class="form-control select_general @error('tipo_documento') is-invalid @enderror"
                                        name="tipo_documento" id="tipo_documento" required>
                                        <option value="">Seleccione</option>
                                        <option value="T.I.">Tarjeta de Identidad</option>
                                        <option value="C.C.">Cedula de Ciudadanía</option>
                                        <option value="C.E.">Cedula de Extranjería</option>
                                        <option value="P.P.">Pasaporte</option>
                                        <option value="Salvoconducto">Salvo Conducto</option>
                                        <option value="P.P.T">Permiso Permanente Transitorio</option>
                                    </select>
                                    @error('tipo_documento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>



                                <div class="col-md-6 pl-1 pr-1 pt-3">
                                    <label for="numero_documento" class="form-label">Numero de Identificación /Usuario*
                                    </label>
                                    <input value="{{old('numero_documento')}}" type="text"
                                        class="form-control document_validate  @error('numero_documento') is-invalid @enderror"
                                        name="numero_documento" id="numero_documento" maxlength="15" minlength="4"
                                        required onkeypress="return Numeros(event)" placeholder="Ej: 80786231">
                                    @error('numero_documento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 pl-1 pr-1 pt-3">
                                    <label for="email_responsable" class="form-label">Correo Electronico
                                        Responsable/Usuario *
                                    </label>
                                    <input value="{{old('email_responsable')}}" type="text"
                                        class="form-control  @error('email_responsable') is-invalid @enderror email_validate"
                                        name="email_responsable" id="email_responsable"
                                        placeholder="Ej: mario.perez@gmail.com" required>
                                    @error('email_responsable')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 pl-1 pr-1 pt-3">
                                    <label for="email_confirmado" class="form-label">Confirme su correo* </label>
                                    <input type="text" onpaste="return false;"
                                        class="form-control  @error('email_confirmado') is-invalid @enderror email_validate"
                                        name="email_confirmado" id="email_confirmado" required onpaste="return false;"
                                        placeholder="Ej: mario.perez@gmail.com">
                                    @error('email_confirmado')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 pl-1 pr-1 pt-3">
                                    <label for="telefono" class="form-label">Teléfono / Celular Reponsable * </label>
                                    <input value="{{old('telefono')}}" type="text"
                                        class="form-control  @error('telefono') is-invalid @enderror number_validate"
                                        name="telefono" id="telefono" maxlength="10" minlength="7" required
                                        onkeypress="return Numeros(event)" tabindex="12" placeholder="Ej: 316675237">
                                    @error('telefono')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>





                                <div class="col-md-12 pl-1 pt-3">

                                    <label for="direccion_solicitante" class="form-label">Dirección o Nomenclatura del
                                        Ciudadano*
                                    </label><button type="button" class="btn btn-link"><span
                                            style="text-transform: lowercase; font-size: 12px;" class="text-primary"
                                            data-toggle="modal" id="button-modal" data-target="#ModalDirecciones"
                                            tabindex="20">(Clic para insertar direccion)</span></button>
                                    <input type="text" value="{{old('direccion_solicitante')}}"
                                        class="form-control  @error('direccion_solicitante') is-invalid @enderror"
                                        name="direccion_solicitante" id="direccion_solicitante" maxlength="120" required
                                        readonly placeholder="Ej: CARRERA 12 # 13-10">
                                    @error('direccion_solicitante')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 pl-1 pr-1 pt-3">
                                    <label for="barrio_solicitante" class="form-label">Barrio* </label>
                                    <select name="barrio_solicitante" id="barrio_solicitante"
                                        class="form-control barrioUtsp @error('barrio_solicitante') is-invalid  @enderror"
                                        required>
                                        <option value=""></option>
                                        @foreach ($Barrios as $barrio)
                                        <option value="{{$barrio->codigo}}">{{$barrio->nombre}}</option>

                                        @endforeach
                                    </select>
                                    @error('barrio_solicitante')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 pl-1 pr-1 pt-3">
                                    <label for="comuna" class="form-label">Comuna * </label>
                                    <input value="" type="text"
                                        class="form-control name_validate  @error('comuna') is-invalid @enderror"
                                        name="comuna" id="comuna" maxlength="5" required
                                        onkeypress="return Numeros(event)" onkeyup="aMayusculas(this.value,this.id)"
                                        readonly>
                                    @error('comuna')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-4 pl-1 pr-1 pt-3">
                                    <label for="ciudad" class="form-label">Ciudad * </label>
                                    <input value="BUCARAMANGA" type="text"
                                        class="form-control name_validate  @error('ciudad') is-invalid @enderror"
                                        name="ciudad" id="ciudad" maxlength="25" minlength="4" required
                                        onkeypress="return Letras(event)" onkeyup="aMayusculas(this.value,this.id)"
                                        readonly>
                                    @error('ciudad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>







                            <h3 class="headline-l-govco mt-3 pl-0">3. Caracterizacion de la solicitud <br> <span
                                    class="small-text-govco">*Campos obligatorios</span></h3>

                            <div class="row form-group mt-2">

                                <div class="col-md-3 pl-1 pr-1 pt-3">
                                    <label for="tipo_atencion" class="form-label">Tipo de Atencion* </label>
                                    <select name="tipo_atencion" id="tipo_atencion"
                                        class="form-control  @error('tipo_atencion') is-invalid  @enderror" required>
                                        <option value="">Seleccione..</option>
                                        @foreach ($tipos_atencion as $key => $value)
                                        <option value="{{$value}}">{{$value}}</option>

                                        @endforeach
                                    </select>
                                    @error('tipo_atencion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-3 pl-1 pr-1 pt-3">
                                    <label for="tipo_servicio" class="form-label">Tipo de Servicio* </label>
                                    <select name="tipo_servicio" id="tipo_servicio"
                                        class="form-control  @error('tipo_servicio') is-invalid  @enderror" required>
                                        <option value="">Seleccione..</option>
                                        @foreach ($tipos_servicio as $key => $value)
                                        <option value="{{$value}}">{{$value}}</option>

                                        @endforeach
                                    </select>
                                    @error('tipo_servicio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 pl-1 pr-1 pt-3">
                                    <label for="asunto" class="form-label">Asunto* </label>
                                    <textarea placeholder="EL ASUNTO DE ESTA SOLICITUD ES ..."
                                        class="form-control @error('asunto') is-invalid  @enderror" name="asunto"
                                        id="asunto" onkeyup="aMayusculas(this.value,this.id)" maxlength="500" rows="4"
                                        style="resize: none;" minlength="10" required></textarea>
                                    @error('asunto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <h3 class="headline-l-govco mt-3 pl-0">4. Acciones sobre la Solicitud <br> <span
                                    class="small-text-govco">*Campos obligatorios</span></h3>

                            <div class="row form-group mt-2">

                                <div class="col-md-6 pl-1 pr-1 pt-3">
                                    <label for="tipo_tramite" class="form-label">Tipo de tramite* </label>
                                    <select name="tipo_tramite" id="tipo_tramite"
                                        class="form-control  @error('tipo_tramite') is-invalid  @enderror" required>
                                        <option value="">Seleccione..</option>
                                        @foreach ($tipos_tramite as $key => $value)
                                        <option value="{{$value}}">{{$value}}</option>

                                        @endforeach
                                    </select>
                                    @error('tipo_atencion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 pl-1 pr-1 pt-3">
                                    <label for="empresa_publica" class="form-label">Empresa de Servicios Publicos
                                    </label>
                                    <select name="empresa_publica" id="empresa_publica"
                                        class="form-control  @error('empresa_publica') is-invalid  @enderror" required>
                                        <option value="">Seleccione..</option>
                                        @foreach ($empresas as $key => $value)
                                        <option value="{{$value}}">{{$value}}</option>

                                        @endforeach
                                    </select>
                                    @error('empresa_publica')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                                <div class="col-md-12 pl-1 pr-1 pt-3 d-none" id="divOtherCompany">
                                    <label for="otra_empresa" class="form-label">Otra empresa de servicios publicos*
                                    </label>
                                    <input value="{{old('otra_empresa')}}" type="text"
                                        class="form-control  @error('otra_empresa') is-invalid @enderror"
                                        name="otra_empresa" id="otra_empresa" maxlength="40" minlength="4"
                                        onkeyup="aMayusculas(this.value,this.id)" tabindex="10"
                                        placeholder="Ej: Empresa de Aseo ....">
                                    @error('observacion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-12 pl-1 pr-1 pt-3">
                                    <label for="observacion" class="form-label">Observacion* </label>
                                    <textarea placeholder="Observaciones de la accion a esta solicitud ..."
                                        class="form-control @error('observacion') is-invalid  @enderror"
                                        name="observacion" id="observacion" onkeyup="aMayusculas(this.value,this.id)"
                                        maxlength="600" rows="3" style="resize: none;" minlength="10"
                                        required></textarea>
                                    @error('observacion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-12 pl-1 pr-1 pt-3">
                                    <label for="asunto" class="form-label">Documentos adjuntos a las acciones de esta
                                        solicitud
                                        (.PDF)* </label><br>


                                    <label for="attachment">
                                        <a class="btn btn-round btn-middle btn-outline-info" role="button"
                                            aria-disabled="false">+Añadir Archivos</a>

                                    </label>
                                    <input type="file" name="evidencias[]" accept="application/pdf" id="attachment"
                                        style="visibility: hidden; position: absolute;" class="info_evidencias"
                                        multiple />

                                    </p>
                                    <div id="files-area">
                                        <span id="filesList">
                                            <span id="files-names"></span>
                                        </span>
                                    </div>
                                    @error('evidencias')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>



                            </div>






                            {{-- por definir cuarto documento --}}
                            <div class="col-md-12 pl-1 pt-3">
                                <h4 class="headline-m-govco">Aviso de privacidad y autorización tratamiento de datos
                                    personales
                                </h4>


                                <a class="btn btn-low px-0"
                                    href="https://www.bucaramanga.gov.co/Inicio/autorizacion-de-tratamiento-de-datos-personales/"
                                    target="_blank" tabindex="24">El usuario autorizó el tratamiento de datos
                                    personales</a>
                                <label class="d-inline">
                                    <input type="checkbox" class="check-style" id="AT00" name="tratamiento_datos"
                                        value="SI" tabindex="24" required />
                                    <label for="AT00"> </label>
                                </label><br>


                                <a class="btn btn-low px-0"
                                    href="https://www.bucaramanga.gov.co/wp-content/uploads/2018/12/Resolucion-340-Dic-26-2018-y-Politica.pdf"
                                    target="_blank" tabindex="25">El usuario aceptó términos y condiciones</a>
                                <label class="d-inline" tabindex="25">
                                    <input type="checkbox" class="check-style" id="AT01" name="acepto_terminos"
                                        value="SI" tabindex="25" required />
                                    <label for="AT01"> </label>
                                </label>

                                {{-- <p class="text-justify">Confirmo que soy mayor de edad y con plena capacidad para
									diligenciar el presente formulario.
									Así mismo declaro que la información aquí suministrada corresponde a la verdad.
									Declaro que he leído, entiendo y acepto las políticas de tratamiento de los datos que
									suministro,
									de conformidad con la Ley 1581 de 2012 y demás normas concordantes
									<label class="d-inline" tabindex="26">
										<input type="checkbox" class="check-style" id="AT02" name="confirmo_mayorEdad"
											tabindex="26" value="SI" required />
										<label for="AT02"> </label>
									</label>
								</p> --}}
                            </div>
                            <div class="col-md-11 pl-1 pr-1 pt-3">
                                <p>EL Usuario Aceptó que la información aquí registrada sea compartida con otras
                                    entidades y/o
                                    terceros vinculados a la Alcaldía de Bucaramanga</p>
                                @error('compartir_informacion')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                                <div class="form-check-inline" tabindex="27">
                                    <label class="" tabindex="27">
                                        <input type="radio" name="compartir_informacion" id="rb_si" value="SI"
                                            tabindex="27" class="radio-per-gov" />
                                        <label for="rb_si">SI</label>
                                    </label>
                                </div>
                                <div class="form-check-inline" tabindex="28">
                                    <label class="" tabindex="28">
                                        <input type="radio" name="compartir_informacion" id="rb_no" value="NO"
                                            tabindex="28" class="radio-per-gov" />
                                        <label for="rb_no">NO</label>
                                    </label>
                                </div>

                            </div>

                            <div class="col-md-12  pl-1 pr-1 pt-3 text-left mt-4" style="padding-left: 0px!important">
                                <button style="font-size:15px;" type="submit"
                                    class="btn btn-round btn-middle btn_enviar_solicitud" name="consultar"
                                    onclick="return confirm('¿Esta seguro de realizar esta solicitud ?')">Registrar
                                    Solicitud</button>
                                {{-- <button style="font-size:15px;" class="btn btn-round btn-middle btn_carga d-none"
									type="button" disabled><span class="spinner-grow spinner-grow-sm text-primary" role="status"
										aria-hidden="true"></span> Enviando...</button> --}}
                            </div>
                        </div>
                    </div>
            </div>
            </form>
        </div>

        <div class="col-md-3 pl-0 mr-0">
            <a class="btn btn-round" href="{{ URL::route('utsp.index') }}"
                style="float: left; background-color:#BABABA">Atras</a>
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

            <div class="modal-body">
                <div class="row form-row">

                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                        <div class="form-group">
                            <label style="color:#111111;" class="input" for="DD01"
                                style="font-family: 'Barlow', sans-serif;">
                                Calle - Carrera *</label>
                            <select name="DD01" id="DD01" type="text" class="form-control input-md modal1"
                                required="required"
                                title="Selecciona el tipo de indicación inicial para la dirección que desea ingresar"
                                tabindex="20">
                                <option value=""></option>
                                @foreach ($Parametros2 as $parametro2)
                                <option value="{{$parametro2->ParDes}}">{{$parametro2->ParDes}}</option>
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
                                style="height: 29px!important;" tabindex="20" placeholder="EJ: 10">
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                        <div class="form-group">
                            <label style="color:#111111;" class="input" for="DD03"
                                style="font-family: 'Barlow', sans-serif;">Letra </label>
                            <select id="DD03" name="DD03" type="text" class="form-control input-md modal1"
                                title="Selecciona una letra si tu indicación de dirección en el campo anterior contiene esta opción, si no la posee déjala en blanco"
                                tabindex="20">
                                <option value=""></option>
                                @foreach ($Parametros1 as $parametro1)
                                <option value="{{$parametro1->ParNom}}">{{$parametro1->ParNom}}</option>
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
                                onkeypress="return Numeros(event)" required="required" style="height: 29px!important;"
                                placeholder="EJ: 30" tabindex="20">
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                        <div class="form-group">
                            <label style="color:#111111;" class="input" for="DD05"
                                style="font-family: 'Barlow', sans-serif;">Letra </label>
                            <select id="DD05" name="DD05" type="text" class="form-control input-md modal1"
                                title="Selecciona una letra si tu indicación de dirección en el campo anterior contiene esta opción, si no la posee déjala en blanco"
                                tabindex="12">
                                <option value=""></option>
                                @foreach ($Parametros1 as $parametro1)
                                <option value="{{$parametro1->ParNom}}">{{$parametro1->ParNom}}</option>
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
                                onkeypress="return Numeros(event)" style="height: 29px!important;" placeholder="Ej:22"
                                tabindex="20">
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                        <div class="form-group">
                            <label style="color:#111111;" class="input" for="DD07"
                                style="font-family: 'Barlow', sans-serif;">Letra </label>
                            <select id="DD07" name="DD07" type="text" class="form-control input-md modal1"
                                title="Selecciona una letra si tu indicación de dirección en el campo anterior contiene esta opción, si no la posee déjala en blanco"
                                tabindex="20">
                                <option value=""></option>
                                @foreach ($Parametros1 as $parametro1)
                                <option value="{{$parametro1->ParNom}}">{{$parametro1->ParNom}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-2 col-sm-12 col-xs-12 caja_ultima"><br>
                        <div class="form-group">
                            <label style="color:#111111;" class="input" for="DD08"
                                style="font-family: 'Barlow', sans-serif;">Complemento </label>
                            <input id="DD08" name="DD08" type="text" class="form-control  modal1" maxlength="80"
                                title="Digita en este el complemento de tu direccion"
                                onkeyup="aMayusculas(this.value,this.id)" placeholder="Ej: EDF EL MIRADOR DEL SOL"
                                tabindex="20">
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
                    id="btnDireccion" value="Boton" tabindex="20">Ingresar Dirección</button>
                <button style="font-size:15px;" type="button" class="btn btn-round btn-middle btn-outline-info"
                    data-dismiss="modal" tabindex="20">Cerrar</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- <div id="ModalDireccionesEmpresas" class="modal fade center" role="dialog">
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
							<label style="color:#111111;" class="input" for="DD01" style="font-family: 'Barlow', sans-serif;">
								Calle - Carrera *</label>
							<select name="DD01" id="DD010" type="text" class="form-control input-md modal2" required="required"
								title="Selecciona el tipo de indicación inicial para la dirección que desea ingresar">
								<option value=""></option>
								@foreach ($Parametros2 as $parametro2)
								<option value="{{$parametro2->ParDes}}">{{$parametro2->ParDes}}</option>
@endforeach


</select>
</div>
</div>

<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
    <div class="form-group">
        <label style="color:#111111;" class="input" for="DD02" style="font-family: 'Barlow', sans-serif;">N° - Nombre *
        </label>
        <input id="DD020" name="DD02" type="text" class="form-control modal2" maxlength="20" required="required"
            title="En este campo se deberá digitar número o nombre según corresponda a la selección en el campo anterior, te recomendamos observar el campo de visualización que se encuentra al final de este módulo para organizar tu dirección correctamente."
            onkeypress="return NumDoc(event)" onchange="aMayusculas(this.value,this.id)"
            style="height: 29px!important;">
    </div>
</div>

<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
    <div class="form-group">
        <label style="color:#111111;" class="input" for="DD03" style="font-family: 'Barlow', sans-serif;">Letra </label>
        <select id="DD030" name="DD03" type="text" class="form-control input-md modal2"
            title="Selecciona una letra si tu indicación de dirección en el campo anterior contiene esta opción, si no la posee déjala en blanco">
            <option value=""></option>
            @foreach ($Parametros1 as $parametro1)
            <option value="{{$parametro1->ParNom}}">{{$parametro1->ParNom}}</option>
            @endforeach

        </select>
    </div>
</div>

<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"><br>
    <div class="form-group">
        <label style="color:#111111;" class="input" for="DD04" style="font-family: 'Barlow', sans-serif;">Numero*
        </label>
        <input id="DD040" name="DD04" type="text" class="form-control modal2" maxlength="4"
            title="Digita en este campo el primer número de tu dirección" onkeypress="return Numeros(event)"
            required="required" style="height: 29px!important;">
    </div>
</div>

<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
    <div class="form-group">
        <label style="color:#111111;" class="input" for="DD05" style="font-family: 'Barlow', sans-serif;">Letra </label>
        <select id="DD050" name="DD050" type="text" class="form-control input-md modal2"
            title="Selecciona una letra si tu indicación de dirección en el campo anterior contiene esta opción, si no la posee déjala en blanco">
            <option value=""></option>
            @foreach ($Parametros1 as $parametro1)
            <option value="{{$parametro1->ParNom}}">{{$parametro1->ParNom}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"><br>
    <div class="form-group">
        <label style="color:#111111;" class="input" for="DD06" style="font-family: 'Barlow', sans-serif;">Numero*
        </label>
        <input id="DD060" name="DD06" type="text" class="form-control modal2" maxlength="4"
            title="Digita en este campo el primer número de tu dirección" onkeypress="return Numeros(event)"
            style="height: 29px!important;">
    </div>
</div>

<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
    <div class="form-group">
        <label style="color:#111111;" class="input" for="DD07" style="font-family: 'Barlow', sans-serif;">Letra </label>
        <select id="DD070" name="DD070" type="text" class="form-control input-md modal2"
            title="Selecciona una letra si tu indicación de dirección en el campo anterior contiene esta opción, si no la posee déjala en blanco">
            <option value=""></option>
            @foreach ($Parametros1 as $parametro1)
            <option value="{{$parametro1->ParNom}}">{{$parametro1->ParNom}}</option>
            @endforeach

        </select>
    </div>
</div>

<div class="col-lg-6 col-md-2 col-sm-12 col-xs-12 caja_ultima"><br>
    <div class="form-group">
        <label style="color:#111111;" class="input" for="DD08" style="font-family: 'Barlow', sans-serif;">Complemento
        </label>
        <input id="DD080" name="DD08" type="text" class="form-control modal2" maxlength="80"
            title="Digita en este el complemento de tu direccion" onkeyup="aMayusculas(this.value,this.id)">
    </div>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><br><br>
    <div class="form-group">
        <input style="background-color: #004884; color: #FFFFFF; font-weight: bold; border-radius:8px;" name="Direccion"
            id="DD0000" type="text" class="form-control input-md DD00" data-toggle="tooltip"
            title="Previsualizador de la dirección introducida" data-delay='{"show":"30", "hide":"30"}'
            placeholder="Pre visualizador de direcciones" required="required" readonly>
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
</div> --}}

{{-- MODAL CONSULTAR SOLICITUD --}}


@push('utsp')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<script type="text/javascript" src="{{ asset('js/utsp.js') }}"></script>

@endpush

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

@endsection