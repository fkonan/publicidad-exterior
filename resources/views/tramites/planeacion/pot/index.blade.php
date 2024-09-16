@extends('layouts.app')

@section('title', 'Encuesta POT')
@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
       span.step {
  background: #0B457F;
  border-radius: 1em;
  -moz-border-radius: 1em
  -webkit-border-radius: 1em;
  color: #ffffff;
  display: inline-block;
  font-weight: bold;
  line-height: 2em;
  margin-right: 5px;
  text-align: center;
  width: 4em; 
  font-size: 25px;
}



    </style>


    <div class="container mt-3 mb-4 m-xs-x-3">       
        <div class="container-fluid">
            <div class="row mt-2">
                <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">                   

                    <form action="{{route('pot.store')}}" method="POST" id="formPot" enctype="multipart/form-data" class="form-ciudadano">
                        @csrf
                        <div class="card govco-card border-0 shadow-none" style="border-radius: 0px; border-color:none!important;">

                            <h1 class="headline-xl-govco">Encuesta-POT</h1>

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

                            {{-- <div class="alert-primary-govco alert alert-dismissible fade show mt-3 animate__animated animate__backInDown"
                                aria-label="Alerta informativa">                                
                                <div class="alert-heading">
                                    <span class="govco-icon govco-icon-bell-sound-p size-2x"></span>
                                    <span class="headline-l-govco">Cantidad de personas que opinaron:</span>
                                </div>
                                {{-- @php $conteo = 10; @endphp 
                                <p class="text-center"><span class="step" id="conteo">{{
                                $conteo}}</span></p>
                            </div> --}}
                        </div>

                        <h3 class="headline-l-govco mt-3 pl-0">Datos Generales de la Encuesta</h3>

                        <div class="row form-group mt-2">
                            


                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="nombre_usuario" class="form-label"><strong>Nombres*</strong></label>
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
                                <label for="apellido_usuario" class="form-label"><strong>Apellidos*</strong></label>
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
                                <label for="documento_usuario" class="form-label"><strong>Numero de Identificacion*</strong></label>
                                <input value="{{ old('documento_usuario') }}" type="text"
                                    class="form-control document_validate  @error('documento_usuario') is-invalid @enderror"
                                    name="documento_usuario" id="documento_usuario_POT" maxlength="15" minlength="4" required
                                    onkeypress="return Numeros(event)">
                                @error('documento_usuario')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>                                             
                                                                             
                           
                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="edad" class="form-label"><strong>Edad*</strong></label>
                                <input value="{{ old('edad') }}" type="text"
                                    class="form-control  @error('edad') is-invalid @enderror age_validate"
                                    name="edad" id="edad" maxlength="2" max="99" min="1" required
                                    onkeypress="return Numeros(event)">
                                @error('edad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="correo_electronico" class="form-label"><strong>Correo Electronico</strong></label>
                                <input value="{{ old('correo_electronico') }}" type="mail"
                                    class="form-control  @error('correo_electronico') is-invalid @enderror email_validate"
                                    name="correo_electronico" id="correo_electronico" required>
                                @error('correo_electronico')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>     
                            
                            <div class="col-md-12 pl-1 pr-1 pt-3">
                               
                                    <strong class="pr-3"> ¿ Usted reside en ? : </strong>
                                    
                                    <input type="radio" name="residencia" id="exampleRadio1" value="barrio" class="ml-5 radio_bv" required/>
                                    <label for="exampleRadio1">1. Barrio</label>
                                    
                                   
                                    <input type="radio" name="residencia" id="exampleRadio2" value="vereda" class="ml-5 radio_bv" required/>
                                    <label for="exampleRadio2">2. Vereda</label>
                                    
                                
                                @error('residencia')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>   

                            <div class="col-md-6 pl-1 pr-1 pt-3 caja-barrios d-none">
                                <label for="barrio" class="form-label"><strong>Barrio*</strong></label>
                                <select name="barrio" id="barrio_pot"
                                    class="form-control @error('barrio') is-invalid @enderror barrios">
                                    <option value=""></option>
                                    @foreach ($Barrios as $barrio)
                                    <option value="{{ $barrio->codigo }}">{{ $barrio->nombre }}</option>

                                    @endforeach
                                </select>
                                @error('barrio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3 caja-barrios d-none">
                                <label for="comuna" class="form-label"><strong>Comuna</strong></label>
                                <input value="{{ old('comuna') }}" type="text"
                                    class="form-control name_validate  @error('comuna') is-invalid @enderror"
                                    name="comuna" id="comuna" maxlength="25" minlength="4"
                                    readonly>
                                @error('comuna')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            

                            <div class="col-md-6 pl-1 pr-1 pt-3 caja-veredas d-none">
                                <label for="vereda" class="form-label"><strong>Vereda*</strong></label>
                                <select name="vereda" id="vereda"
                                    class="form-control @error('vereda') is-invalid @enderror clase_veredas">
                                    <option value=""></option>
                                    @foreach ($veredas as $vereda)
                                    <option value="{{ $vereda->codigo }}">{{ $vereda->nombre }}</option>

                                    @endforeach                                
                                </select>
                                @error('vereda')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3 caja-veredas d-none">
                                <label for="corregimiento" class="form-label"><strong>Corregimiento</strong></label>
                                <input value="{{ old('corregimiento') }}" type="text"
                                    class="form-control name_validate  @error('corregimiento') is-invalid @enderror"
                                    name="corregimiento" id="corregimiento" maxlength="25" minlength="4"
                                    readonly>
                                @error('corregimiento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                              @enderror
                            </div>                           
                                                    
                                    
                                                            

                            <div class="col-md-12 pl-1 pr-1 pt-3">
                                <label for="tema" class="form-label"><strong>Tema*</strong><i>(seleccione la temática de su interés sobre la cual desea opinar)</i>.</label>
                                <select class="form-control  @error('tema') is-invalid @enderror" name="tema" id="tema"
                                    required>
                                    <option value="">Seleccione</option>
                                    <option value="Amenazas por fenomenos naturales y cambio climatico" subtext="Una Bucaramanga preparada frente a la amenazas por fenómenos naturales y adaptada al cambio climático.">Amenazas por fenomenos naturales y cambio climatico</option>
                                    <option value="Usos de Suelo" subtext="Una Bucaramanga con una distribución equilibrada de los usos de suelo.">Usos de Suelo</option>
                                    <option value="Espacio Publico" subtext="Una Bucaramanga con mas y mejor espacio publico para su uso goce y disfrutes.">Espacio Publico</option>
                                    <option value="Infraestructura de Movilidad" subtext="Una Bucaramanga con infraestructura de movilidad moderna y multimodal.">Infraestructura de Movilidad</option>
                                    <option value="Vivienda Y Habitat" subtext="Una Bucaramanga con oferta de vivienda y hábitat sostenible e incluyente.">Vivienda Y Habitat</option>
                                    <option value="Ruralidad" subtext="Una Bucaramanga fortalecida en su ruralidad.">Ruralidad</option>
                                </select>
                                @error('estrato_socioeconomico')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-12 pl-1 pr-1 pt-3 caja-observacion d-none">
                                <label for="observacion" id="observacion_label" class="form-label" style="font-weight: bold;"></label><br>
                                <small id="subtext"></small>
                                <textarea name="observacion" id="observacion_pot" class="form-control" rows="6" cols="4" minlength="10" maxlength="300" onkeypress="return Observaciones(event)" onkeyup="aMayusculas(this.value,this.id)" placeholder="Opine aca..."></textarea>
                                <small id="count"></small>
                                @error('observacion')
                                    <span class="invalid-feedback"  role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                              @enderror
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
                                <p class="text-justify">Autorizo al  MUNICIPIO DE BUCARAMANGA, identificado con NIT 890.201.222-0 y a METROLÍNEA S.A. con Nit. 830.507.387-3,  como los Responsables del Tratamiento  de los datos personales que comparto y, en virtud de la presente autorización, pueden procesar, recolectar, almacenar, usar, circular, suprimir, compartir, actualizar, transmitir y transferir de acuerdo con los términos y condiciones de las políticas de tratamiento vigentes, las cuales están en la página <a href="https://www.bucaramanga.gov.co/" target="_blank">www.bucaramanga.gov.co </a> <label class="checkbox-govco d-inline">
                                    <input type="checkbox" id="AT03" name="compartir_informacion" checked value="SI" />
                                    <label for="AT03"> </label>
                                </label>
                            </p>
                                <p class="text-justify">Confirmo que soy mayor de edad y con plena capacidad para diligenciar el presente formulario. Asi mismo declaro que la información aquí suministrada corresponde a la verdad. Declaro que he leído, entiendo y acepto las políticas de tratamiento de los datos que suministro, de conformidad con la Ley 1581 de 2012 y demás normas concordantes.<label class="checkbox-govco d-inline">
                                        <input type="checkbox" id="AT02" name="confirmo_mayorEdad" checked value="SI" />
                                        <label for="AT02"> </label>
                                    </label>
                                </p>

                               
                            </div>
                            

                            <div class="col-md-12  pl-1 pr-1 pt-3 text-left mt-4" style="padding-left: 0px!important">
                               
                                <div class="g-recaptcha" data-sitekey="6LdzXDwcAAAAAOgw8LzMLMjgnI2spGFhuCoMYlGc"></div>

                                {{-- <input type="hidden" class="form-control" name="id_municipio" id="id_municipio" value="68001">
                                <input type="hidden" class="form-control" name="edad" id="edad"> --}}
                                <button style="font-size:15px;" type="submit" class="btn btn-round btn-middle btn_enviar_solicitud" name="consultar" onclick="return confirm('¿Esta seguro de registrar esta encuesta ?')">Enviar Encuesta</button>

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
                                        {{-- <p class="form-inline my-0">  Echa un vistazo a las preguntas frecuentes <a style="color: #3366CC;" href="https://www.bucaramanga.gov.co/beneficio-metrolinea/#seccion_preguntas" target="_blank">CLIC AQUÍ <span class="govco-icon govco-icon-hand-n size-1x "></span></a></p> --}}
                                        <p class="form-inline"><span class="govco-icon govco-icon-call-center"></span><a
                                                style="color: #3366CC;" href="tel:0376337000"> (+57)7 633 70 00</a></p>
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
                                        value="ENCUESTA-POT">


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

                    {{-- <div class="accordion accordion-govco pt-0" id="acc3">
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
                    </div> --}}

                </div>
            </div>
        </div>



    </div>
    {{-- fin contenedor pricincipal --}}


    {{-- MODAL CONSULTAR SOLICITUD --}}

    


@endsection
