@extends('layouts.app')
@section('title', 'Inhumaciones')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">


    <div class="container mt-3 mb-4 m-xs-x-3">
        <div class="row pl-4">
            <div class="px-0 col-md-9 col-xs-12 col-sm-12">
                <nav aria-label="Miga de pan" style="max-height: 20px;">
                    <ol class="breadcrumb" style="background-color: #FFFFFF;">
                        <li class="breadcrumb-item ml-3 ml-md-0">
                            <a style="color: #004fbf;font-size:14px;" class="breadcrumb-text" href="https://www.bucaramanga.gov.co" tabindex="3">Inicio</a>
                        </li>
                        <li class="breadcrumb-item ">
                            <div class="image-icon">
                                <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                                <a style="color: #004fbf;font-size:14px;" class="breadcrumb-text" href="https://www.bucaramanga.gov.co/tramites/"  tabindex="4">Tramites y servicios</a>
                            </div>
                        </li>
                        <li class="breadcrumb-item ">
                            <div class="image-icon">
                                <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                                <p class="ml-3 ml-md-0 text-miga" style="color: #004884; font-size:14px;">
                                        Inhumaciones
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
                        <div class="card step-progress border-0" style="font-size: 10px;background-color: transparent !important;">
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
                                    <p style="padding-top: 0px;margin-top:5px;color: #4B4B4B" id="barra_progreso"><span
                                            class="circle_dos">3</span>Procesan mi solicitud</p>
                                </div>
                                <div data-id="step5" class="step-slider-item">
                                    <p style="padding-top: 0px;margin-top:5px;color: #4B4B4B" id="barra_progreso"><span
                                            class="circle_dos">4</span> Respuesta</p>
                                </div>

                            </div>
                        </div>
                    </div>

                    <form action="{{route('inhumaciones.search')}}" method="POST" id="formInhuma" class="formInhuma">
                        @csrf
                        <div class="card govco-card border-0 shadow-none" style="border-radius: 0px;">

                            <h1 class="headline-xl-govco">Consulta de Inhumaciones</h1>

                            <div class="alert-primary-govco alert alert-dismissible fade show mt-3"
                            aria-label="Alerta informativa">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar"
                                title="Cerrar">&times;</button>
                            <div class="alert-heading">
                                <span class="govco-icon govco-icon-bell-sound-p size-2x"></span>
                                <span class="headline-l-govco">Importante</span>
                            </div>
                            <p style="text-align: justify"> La Página de consulta de Inhumaciones se creó con el fin de apoyar a la ciudadanía que necesita saber La Notaria o Registraduría Nacional del Estado Civil en la que se llevó a cabo el Registro de la Defunción de la persona fallecida objeto de la consulta, el cual debe digitar en los campos la información que se le solicita y dar Click en el botón indicado </p>
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

                        <h3 class="headline-l-govco mt-3 pl-0">1. Datos de consulta <br> <span class="small-text-govco">*Campos obligatorios</span></h3>
                        
                        <div class="row form-group mt-2">
                        <div class="col-md-6 pl-1 pr-1 pt-3">
                            <label for="nom_solicitante" class="form-label">Nombres Solicitante * </label>
                            <input value="{{old('nom_solicitante')}}" type="text" class="form-control name_validate  @error('nom_solicitante') is-invalid @enderror" name="nom_solicitante" id="nom_solicitante"  maxlength="25" minlength="4" required onkeypress="return Letras(event)" onkeyup="aMayusculas(this.value,this.id)" placeholder="Ej: Jesus" tabindex="9">
                            @error('nom_solicitante')
                            <span class="invalid-feedback" role="alert">
                               <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6 pl-1 pr-1 pt-3">
                            <label for="ape_solicitante" class="form-label">Apellidos Solicitante * </label>
                            <input value="{{old('ape_solicitante')}}" type="text" class="form-control name_validate  @error('ape_solicitante') is-invalid @enderror" name="ape_solicitante" id="ape_solicitante"  maxlength="25" minlength="4" required onkeypress="return Letras(event)" onkeyup="aMayusculas(this.value,this.id)" placeholder="Ej: Vargas" tabindex="10" >
                            @error('ape_solicitante')
                            <span class="invalid-feedback" role="alert">
                               <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-4 pl-1 pr-1 pt-3">
                            <label for="identificacion_solicitante" class="form-label">C.C. Solicitante* </label>
                            <input value="{{old('identificacion_solicitante')}}" type="text" class="form-control document_validate  @error('identificacion_solicitante') is-invalid @enderror" name="identificacion_solicitante" id="identificacion_solicitante"  maxlength="15" minlength="4" required onkeypress="return Numeros(event)" placeholder="Ej: 102039049" tabindex="11">
                            @error('identificacion_solicitante')
                            <span class="invalid-feedback" role="alert">
                               <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-8 pl-1 pr-1 pt-3">
                            <label for="email_solicitante" class="form-label">Correo Electronico Solicitante * </label>
                            <input value="{{old('email_solicitante')}}" class="form-control email_validate @error('email_solicitante') is-invalid @enderror" onkeypress="return Email(event)" name="email_solicitante" id="email_solicitante"  required placeholder="Ej: pepito@gmail.com" tabindex="12">
                            @error('email_solicitante')
                            <span class="invalid-feedback" role="alert">
                               <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6 pl-1 pr-1 pt-3">
                            <label for="tipo_consulta" class="form-label">Consultar Por*</label>
                            <select class="form-control select_general  @error('tipo_consulta') is-invalid @enderror" name="tipo_consulta" id="tipo_consulta" required tabindex="13">
                                <option value="">Seleccione</option>
                                <option value="InNumDoc">Numero de documento del fallecido</option>
                                <option value="InNumCerFun">Certificado de defunción</option>                                

                            </select>

                            @error('tipo_consulta')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6 pl-1 pr-1 pt-3">
                            <label for="numero_busqueda" class="form-label">Valor de Busqueda* </label>
                            <input value="{{old('numero_busqueda')}}" type="text" class="form-control document_validate  @error('numero_busqueda') is-invalid @enderror" name="numero_busqueda" id="numero_busqueda"  maxlength="15" minlength="4" required onkeypress="return NumDoc(event)" placeholder="Ej: 13921267" tabindex="14" >
                            @error('numero_busqueda')
                            <span class="invalid-feedback" role="alert">
                               <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-12 pl-1 pr-1 pt-3 mt-3">
                            <h4 class="headline-m-govco">Aviso de privacidad y autorización tratamiento de datos personales</h4>

                            <a class="btn btn-low px-0" href="https://www.bucaramanga.gov.co/Inicio/autorizacion-de-tratamiento-de-datos-personales/" target="_blank" tabindex="15">Autorizo el tratamiento de datos personales</a>
                            <label class="d-inline labelGen" tabindex="16">
                               <input type="checkbox" class="check-style" id="AT00" name="tratamiento_datos" value="SI" tabindex="16" required/>
                               <label for="AT00"> </label>
                            </label><br>

                            <a class="btn btn-low px-0" href="https://www.bucaramanga.gov.co/wp-content/uploads/2018/12/Resolucion-340-Dic-26-2018-y-Politica.pdf" target="_blank" tabindex="17">Acepto términos y condiciones</a>
                            <label class="d-inline labelGen" tabindex="18" >
                               <input type="checkbox" class="check-style" id="AT01" name="acepto_terminos" value="SI" tabindex="18"  required/>
                               <label for="AT01"> </label>
                            </label>
                            <p class="text-justify">Confirmo que soy mayor de edad y con plena capacidad para diligenciar el presente formulario.
                               Así mismo declaro que la información aquí suministrada corresponde a la verdad.
                               Declaro que he leído, entiendo y acepto las políticas de tratamiento de los datos que suministro,
                               de conformidad con la Ley 1581 de 2012 y demás normas concordantes
                               <label class="d-inline labelGen" tabindex="19">
                                  <input type="checkbox" class="check-style" id="AT02" name="confirmo_mayorEdad"  value="SI" tabindex="19" required/>
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
                               <label class="labelGen" tabindex="20">
                                  <input type="radio" class="radio-per-gov" name="compartir_informacion" id="rb_si" value="SI" tabindex="20"/>
                                  <label for="rb_si">SI</label>
                               </label>
                            </div>
                            <div class="form-check-inline">
                               <label class="labelGen" tabindex="21">
                                  <input type="radio" class="radio-per-gov" name="compartir_informacion" id="rb_no" value="NO" tabindex="21"/>
                                  <label for="rb_no">NO</label>
                               </label>
                            </div>
                            
                           
                         </div>

                         <div class="col-md-12  pl-1 pr-1 pt-3 text-left mt-4" style="padding-left: 0px!important">
                        <div class="g-recaptcha" data-sitekey="6LdzXDwcAAAAAOgw8LzMLMjgnI2spGFhuCoMYlGc" data-tabindex="22"></div>

                            <button style="font-size:15px;" type="submit" class="btn btn-round btn-middle btn_enviar_solicitud" name="consultar" onclick="return confirm('¿Esta seguro de realizar esta solicitud ?')" tabindex="23">Realizar Consulta</button>
                            <button style="font-size:15px;" class="btn btn-round btn-middle btn_carga d-none" type="button" disabled><span class="spinner-grow spinner-grow-sm text-primary" role="status" aria-hidden="true"></span> Consultando...</button>
                         </div>

                        
                        </div>

                       


                        
                        {{-- fin del card --}}
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
                                       <a  type="button" href="{{asset('library/Manuales/M-TIC-1400-170-012 Manual Usuario Inhumacion-ciudadano.pdf')}}" target="_blank"><h4 class="headline-s-govco" tabindex="5">Manual de usuario</h4></a>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <div class="btn-icon-close">
                                            {{-- <span class="govco-icon govco-icon-shortu-arrow-n size-1x"></span> --}}
                                            {{-- <span class="govco-icon govco-icon-shortd-arrow-n size-1x"></span> --}}
                                        </div>
                                    </div>
                                </button>
                            </div>
                            {{-- <div id="collapse1" class="collapse mb-3" aria-labelledby="headingUno"
                                data-parent="#EjemploAccordion-2">
                                <div class="card-body bg-color-selago">
                                    <div class="container">
                                        <p class="form-inline my-0"><span class="govco-icon govco-icon-email"></span> <a
                                                style="color: #3366CC; font-size: 13px!important;" href="mailto:contactenos@bucaramanga.gov.co"
                                                target="_blank"> contactenos@bucaramanga.gov.co</a></p>
                                        <p class="form-inline my-0"><span class="govco-icon govco-icon-call-center"></span><a
                                                style="color: #3366CC; font-size: 13px!important;" href="tel:0376337000"> (+57)7 633 70 00</a></p>

                                                 <p class="form-inline my-0"><span class="govco-icon govco-icon-attached-n 2x"></span><a
                                                    style="color: #3366CC; font-size: 13px!important;" href="{{asset('library/Manuales/M-TIC-1400-170-012 Manual Usuario Inhumacion-ciudadano.pdf')}}" target="_blank">Descargue manual de usuario</a></p> -
                                                
                                    </div>
                                </div>
                            </div> --}}
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
                                                style="color: #3366CC; font-size: 13px!important;" href="mailto:contactenos@bucaramanga.gov.co"
                                                target="_blank" tabindex="7"> contactenos@bucaramanga.gov.co</a></p>
                                        <p class="form-inline my-0"><span class="govco-icon govco-icon-call-center"></span><a
                                                style="color: #3366CC; font-size: 13px!important;" href="tel:0376337000"> (+57)7 633 70 00</a></p>

                                                {{-- <p class="form-inline my-0"><span class="govco-icon govco-icon-attached-n 2x"></span><a
                                                    style="color: #3366CC; font-size: 13px!important;" href="{{asset('library/Manuales/M-TIC-1400-170-012 Manual Usuario Inhumacion-ciudadano.pdf')}}" target="_blank">Descargue manual de usuario</a></p> --}}
                                                
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
                            <div id="coll4" class="collapse mb-3" aria-labelledby="c4" data-parent="#acc4">
                                <div class="card-body bg-color-selago">
                                    <div class="row justify-content-center spacer no-gutters">
                                        <div class="col-3 pl-3 pt-2">
                                            <button type="button" id="Facil" class="btn-symbolic-govco align-column-govco btn-facil"
                                                value="FACIL" tabindex="8">
                                                <span class="govco-icon govco-icon-check-cn size-3x"></span>
                                                <span class="btn-govco-text">Facil</span>
                                            </button>
                                        </div>

                                        <div class="col-3 pl-3 pt-2">
                                            <button type="button" id="Dificil" class="btn-symbolic-govco align-column-govco btn-dificil"
                                                value="DIFICIL" tabindex="8">
                                                <span class="govco-icon govco-icon-x-cn size-3x"></span>
                                                <span class="btn-govco-text">Dificil</span>
                                            </button>
                                        </div>
                                    </div>


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
                                                <button type="button" class="btn btn-round btn-middle btn-block enviar-sugerencias-inhuma"
                                                id="enviar-sugerencias-inhuma" data-toggle="tooltip" data-placement="right"
                                                title="envia sugerencias" tabindex="8">Envia
                                                tus sugerencias</button>
                                              
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>                
                </div>
            </div>
        </div>

    </div>


@endsection