@extends('layouts.app')

@section('title', 'Certificado de Discapacidad')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">


    <div class="container mt-3 mb-4 m-xs-x-3">
        <div class="row pl-4">
            <div class="px-0 col-md-9 col-xs-12 col-sm-12">
                <nav aria-label="Miga de pan" style="max-height: 20px;">
                    <ol class="breadcrumb" style="background-color: #FFFFFF;">
                     <li class="breadcrumb-item ml-3 ml-md-0">
                        <a style="color: #004fbf; font-size:14px;" class="breadcrumb-text" href="https://www.bucaramanga.gov.co" target="_blank" tabindex="3">Inicio</a>
                    </li>
                    <li class="breadcrumb-item ">
                        <div class="image-icon">
                            <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                            <a style="color: #004fbf; font-size:14px;" class="breadcrumb-text" href="https://www.bucaramanga.gov.co/tramites/" target="_blank" tabindex="4">Tramites y servicios</a>
                        </div>
                    </li>
                    <li class="breadcrumb-item ">
                     <div class="image-icon">
                         <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                         <p class="ml-3 ml-md-0 text-discapacidad" style="color: #004884; font-size:14px;">
                           Autorización de la certificación de discapacidad
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

                    <form action="{{route('discapacidad.store')}}" method="POST" id="formDiscapacidad" enctype="multipart/form-data" class="formDiscapacidad">
                        @csrf
                        <div class="card govco-card border-0 shadow-none" style="border-radius: 0px;">

                            <h1 class="headline-xl-govco">Autorización de la certificación de discapacidad</h1>

                            {{-- <div class="alert-primary-govco alert alert-dismissible fade show mt-3"
                            aria-label="Alerta informativa">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar"
                                title="Cerrar">&times;</button>
                            <div class="alert-heading">
                                <span class="govco-icon govco-icon-bell-sound-p size-2x"></span>
                                <span class="headline-l-govco">Importante</span>
                            </div>
                            <p style="text-align: justify"> Objetivo del tramite </p>
                        </div> --}}
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

                        <h3 class="headline-l-govco mt-3 pl-0">1. Datos del responsable de la solicitud <br> <span class="small-text-govco">*Campos obligatorios</span></h3>

                        <div class="row form-group mt-2">
                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="nom_responsable" class="form-label">Nombres del Solicitante y/o Responsable * </label>
                                <input value="{{old('nom_responsable')}}" type="text" class="form-control name_validate  @error('nom_responsable') is-invalid @enderror" name="nom_responsable" id="nom_responsable"  maxlength="25" minlength="4" required onkeypress="return Letras(event)" onkeyup="aMayusculas(this.value,this.id)" tabindex="9" placeholder="Ej: Mario">
                                @error('nom_responsable')
                                <span class="invalid-feedback" role="alert">
                                   <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="ape_responsable" class="form-label">Apellidos del Solicitante y/o Responsable * </label>
                                <input value="{{old('ape_responsable')}}" type="text" class="form-control name_validate  @error('ape_responsable') is-invalid @enderror" name="ape_responsable" id="ape_responsable"  maxlength="25" minlength="4" required onkeypress="return Letras(event)" onkeyup="aMayusculas(this.value,this.id)" tabindex="10" placeholder="Ej: Perez">
                                @error('ape_responsable')
                                <span class="invalid-feedback" role="alert">
                                   <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                           
                            <div class="col-md-6 pl-1 pr-1 pt-3">
                               <label for="ide_responsable" class="form-label">Numero de Identificación Responsable* </label>
                               <input value="{{old('ide_responsable')}}" type="text" class="form-control document_validate  @error('ide_responsable') is-invalid @enderror" name="ide_responsable" id="ide_responsable"  maxlength="15" minlength="4" required onkeypress="return Numeros(event)" tabindex="11" placeholder="Ej: 80786231">
                               @error('ide_responsable')
                               <span class="invalid-feedback" role="alert">
                                  <strong class="text-danger">{{ $message }}</strong>
                                 </span>
                                 @enderror
                              </div>
                              <div class="col-md-6 pl-1 pr-1 pt-3">
                                 <label for="tel_responsable" class="form-label">Teléfono / Celular Reponsable * </label>
                                 <input value="{{old('tel_responsable')}}" type="text" class="form-control  @error('tel_responsable') is-invalid @enderror number_validate" name="tel_responsable" id="tel_responsable"  maxlength="10" minlength="7" required onkeypress="return Numeros(event)" tabindex="12" placeholder="Ej: 316675237">
                                 @error('tel_responsable')
                                 <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                     </span>
                                 @enderror
                             </div>
 
                              <div class="col-md-6 pl-1 pr-1 pt-3">
                                  <label for="email_responsable" class="form-label">Correo Electronico Responsable * </label>
                                  <input value="{{old('email_responsable')}}" type="text" class="form-control  @error('email_responsable') is-invalid @enderror email_validate" name="email_responsable" id="email_responsable" tabindex="12" placeholder="Ej: mario.perez@gmail.com" required>
                                  @error('email_responsable')
                                  <span class="invalid-feedback" role="alert">
                                     <strong class="text-danger">{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
  
                              <div class="col-md-6 pl-1 pr-1 pt-3">
                                  <label for="email_confirmado" class="form-label">Confirme su correo* </label>
                                  <input type="text" onpaste="return false;" class="form-control  @error('email_confirmado') is-invalid @enderror email_validate" name="email_confirmado" id="email_confirmado"  required onpaste="return false;" tabindex="13" placeholder="Ej: mario.perez@gmail.com">
                                  @error('email_confirmado')
                                  <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-md-12">                                 
                              <h3 class="headline-l-govco mt-3 pl-0">2. Datos del Ciudadano <br> <span class="small-text-govco">*Campos obligatorios</span></h3>
                              </div>
                              
                              <div class="col-md-6 pl-1 pr-1 pt-3">
                                 <label for="nom_solicitante" class="form-label">Nombres del Ciudadano* </label>
                                 <input value="{{old('nom_solicitante')}}" type="text" class="form-control name_validate  @error('nom_solicitante') is-invalid @enderror" name="nom_solicitante" id="nom_solicitante"  maxlength="25" minlength="4" required onkeypress="return Letras(event)" onkeyup="aMayusculas(this.value,this.id)" tabindex="14" placeholder="Ej: Juan">
                                 @error('nom_solicitante')
                                 <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                     </span>
                                 @enderror
                             </div>

                             <div class="col-md-6 pl-1 pr-1 pt-3">
                              <label for="ape_solicitante" class="form-label">Apellidos del Ciudadano * </label>
                              <input value="{{old('ape_solicitante')}}" type="text" class="form-control name_validate  @error('ape_solicitante') is-invalid @enderror" name="ape_solicitante" id="ape_solicitante"  maxlength="25" minlength="4" required onkeypress="return Letras(event)" onkeyup="aMayusculas(this.value,this.id)" tabindex="15" placeholder="Ej: Ariza" >
                              @error('ape_solicitante')
                              <span class="invalid-feedback" role="alert">
                                 <strong class="text-danger">{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>

                           <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="tipo_identificacion_sol" class="form-label">Tipo de Documento del Ciudadano*</label>
                                <select class="form-control select_general @error('tipo_identificacion_sol') is-invalid @enderror" name="tipo_identificacion_sol" id="tipo_identificacion_sol" required tabindex="16">
                                    <option value="">Seleccione</option>
                                    <option value="R.C.">Registro Civil</option>
                                    <option value="T.I.">Tarjeta de Identidad</option>
                                    <option value="C.C.">Cedula de Ciudadanía</option>
                                    <option value="C.E.">Cedula de Extranjería</option>
                                    <option value="P.P.">Pasaporte</option>
                                    <option value="Salvoconducto">Salvo Conducto</option>
                                    <option value="P.P.T">Permiso Permanente Transitorio</option>
                                </select>
                                @error('tipo_identificacion_sol')
                                <span class="invalid-feedback" role="alert">
                                   <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> 

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                              <label for="ide_solicitante" class="form-label">Numero de Identificación Ciudadano* </label>
                              <input value="{{old('ide_solicitante')}}" type="text" class="form-control document_validate  @error('ide_solicitante') is-invalid @enderror" name="ide_solicitante" id="ide_solicitante"  maxlength="15" minlength="4" required onkeypress="return Numeros(event)" tabindex="17" placeholder="Ej: 1098678945">
                              @error('ide_solicitante')
                              <span class="invalid-feedback" role="alert">
                                 <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                             </div>

                             <div class="col-md-6 pl-1 pr-1 pt-3">
                              <label for="correo_solicitante" class="form-label">Correo Electronico del Ciudadano </label>
                              <input value="{{old('correo_solicitante')}}" type="text" class="form-control  @error('correo_solicitante') is-invalid @enderror email_validate" name="correo_solicitante" id="correo_solicitante" tabindex="18" placeholder="Ej: juan.ariza@hotmail.com">
                              @error('correo_solicitante')
                              <span class="invalid-feedback" role="alert">
                                 <strong class="text-danger">{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>

                          <div class="col-md-6 pl-1 pr-1 pt-3">
                           <label for="tel_solicitante" class="form-label">Teléfono / Celular Ciudadano </label>
                           <input value="{{old('tel_solicitante')}}" type="text" class="form-control  @error('tel_solicitante') is-invalid @enderror tel_solicitante" name="tel_solicitante" id="tel_solicitante"  maxlength="10" minlength="7" onkeypress="return Numeros(event)" tabindex="19" placeholder="Ej: 6076950678" >
                           @error('tel_solicitante')
                           <span class="invalid-feedback" role="alert">
                              <strong class="text-danger">{{ $message }}</strong>
                               </span>
                           @enderror
                       </div>


                            <div class="col-md-12 pl-1 pt-3">

                                <label for="direccion_solicitante" class="form-label">Dirección o Nomenclatura del Ciudadano* </label><button type="button" class="btn btn-link"><span style="text-transform: lowercase; font-size: 12px;" class="text-primary" data-toggle="modal" id="button-modal" data-target="#ModalDirecciones" tabindex="20">(Clic para insertar direccion)</span></button>
                                <input type="text" value="{{old('direccion_solicitante')}}" class="form-control  @error('direccion_solicitante') is-invalid @enderror" name="direccion_solicitante" id="direccion_solicitante"  maxlength="120" required readonly  placeholder="Ej: CARRERA 12 # 13-10">
                                @error('direccion_solicitante')
                                <span class="invalid-feedback" role="alert">
                                   <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                                <label for="barrio_solicitante" class="form-label">Barrio* </label>
                               <select name="barrio_solicitante" id="barrio_solicitante" class="form-control @error('barrio_solicitante') is-invalid @enderror" required tabindex="21">
                                   <option value=""></option>
                                   @foreach ($Barrios as $barrio)
                                   <option value="{{$barrio->nombre}}">{{$barrio->nombre}}</option>
                                       
                                   @endforeach
                               </select>
                                @error('barrio_solicitante')
                                <span class="invalid-feedback" role="alert">
                                   <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 pl-1 pr-1 pt-3">
                              <label for="ciudad" class="form-label">Ciudad * </label>
                              <input value="BUCARAMANGA" type="text" class="form-control name_validate  @error('ciudad') is-invalid @enderror" name="ciudad" id="ciudad"   maxlength="25" minlength="4" required onkeypress="return Letras(event)" onkeyup="aMayusculas(this.value,this.id)" readonly >
                              @error('ciudad')
                              <span class="invalid-feedback" role="alert">
                                 <strong class="text-danger">{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                                                  

                            

                            

                            <h3 class="headline-l-govco mt-3 pl-0">3. Documentos Adjuntos de la Solicitud <br> <span class="small-text-govco">*Campos obligatorios</span></h3>
                            
                            <div class="col-md-12 pl-1 pr-1 pt-3">
                                {{-- <label for="archivo_documento" class="form-label">Copia Documento de Identidad* <br> <small class="text-danger"  style="font-size: 11px!important">Solo se permiten archivos .pdf con un tamaño máximo de 10MB</small> </label>
                            <div class="form-group">
                                <div class="file-loading">
                                    <input class=" @error('archivo_documento') is-invalid @enderror documentos_adjuntos" id="archivo_documento" accept="application/pdf" name="archivo_documento" type="file" data-overwrite-initial="true" required>
                                    @error('archivo_documento')
                                    <span class="invalid-feedback" role="alert">
                                       <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> --}}
                            <div class="form-group">                                  
                              <label for="input-file-simple-label" class="inputfile-gov">
                                  <strong>Adjunte Copia Documento de Identidad*: </strong> <br />
                                  <span class="mensaje">Tipo de archivo permitido .PDF hasta de 10MB</span>

                               </label>
                              
                          <div class="custom-file file-govco">
                             <input type="file" accept="application/pdf"  name="archivo_documento" class="custom-file-input input-file-govco" id="archivo_documentos" onchange="uploadHandler(event,'archivo_documentos')" required tabindex="22"/>
                             <label class="custom-file-label label-file-govco @error('archivo_documentos') is-invalid @enderror"  ondrop="dropHandler(event, 'archivo_documentos')" ondragover="dragOverHandler(event, 'archivo_documentos')"  for="archivo_documentos"><span class="govco-icon govco-icon-attached-n size-2x"></span>
                              Arrastre aquí su archivo o haga click para añadir.</label>
                             @error('archivo_documento')
                                  <span class="invalid-feedback" role="alert">
                                      <strong class="text-danger">{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                       </div>
                            </div>                            

                            <div class="col-md-12 pl-1 pr-1 pt-3">
                                {{-- <label for="archivo_recibo" class="form-label">Copia Recibo Servicios Publicos* <br> <small class="text-danger"  style="font-size: 11px!important">Solo se permiten archivos .pdf con un tamaño máximo de 10MB</small> </label>
                            <div class="form-group">
                                <div class="file-loading">
                                    <input class=" @error('archivo_recibo') is-invalid @enderror documentos_adjuntos" id="archivo_recibo" accept="application/pdf" name="archivo_recibo" type="file" data-overwrite-initial="true" required>
                                    @error('archivo_recibo')
                                    <span class="invalid-feedback" role="alert">
                                       <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> --}}
                            <div class="form-group">                                  
                              <label for="input-file-simple-label" class="inputfile-gov">
                                  <strong>Adjunte Copia Recibo Servicios Publicos*: </strong> <br />
                                  <span class="mensaje">Tipo de archivo permitido .PDF hasta de 10MB</span>

                               </label>
                              
                          <div class="custom-file file-govco">
                             <input type="file" accept="application/pdf"  name="archivo_recibo" class="custom-file-input input-file-govco" id="archivo_recibo" onchange="uploadHandler(event,'archivo_recibo')" required tabindex="23"/>
                             <label class="custom-file-label label-file-govco @error('archivo_recibo') is-invalid @enderror"  ondrop="dropHandler(event, 'archivo_recibo')" ondragover="dragOverHandler(event, 'archivo_recibo')"  for="archivo_recibo"><span class="govco-icon govco-icon-attached-n size-2x"></span>
                              Arrastre aquí su archivo o haga click para añadir.</label>
                             @error('archivo_recibo')
                                  <span class="invalid-feedback" role="alert">
                                      <strong class="text-danger">{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                       </div>
                            </div>

                            
                            <div class="col-md-12 pl-1 pr-1 pt-3">
                                {{-- <label for="archivo_historia_clinica" class="form-label">Historia Clinica Ciudadano* <br> <small class="text-danger"  style="font-size: 11px!important">Solo se permiten archivos .pdf con un tamaño máximo de 10MB</small></label>
                            <div class="form-group">
                                <div class="file-loading">
                                    <input class=" @error('archivo_historia_clinica') is-invalid @enderror documentos_adjuntos" id="archivo_historia_clinica" accept="application/pdf" name="archivo_historia_clinica" type="file" data-overwrite-initial="true" required>
                                    @error('archivo_historia_clinica')
                                    <span class="invalid-feedback" role="alert">
                                       <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> --}}
                            <div class="form-group">                                  
                              <label for="input-file-simple-label" class="inputfile-gov">
                                  <strong>Adjunte Historia Clinica Ciudadano*: </strong> <br />
                                  <span class="mensaje">Tipo de archivo permitido .PDF hasta de 10MB</span>

                               </label>
                              
                          <div class="custom-file file-govco">
                             <input type="file" accept="application/pdf"  name="archivo_historia_clinica" class="custom-file-input input-file-govco" id="archivo_historia_clinica" onchange="uploadHandler(event,'archivo_historia_clinica')" required tabindex="24"/>
                             <label class="custom-file-label label-file-govco @error('archivo_historia_clinica') is-invalid @enderror"  ondrop="dropHandler(event, 'archivo_historia_clinica')" ondragover="dragOverHandler(event, 'archivo_historia_clinica')"  for="archivo_historia_clinica"><span class="govco-icon govco-icon-attached-n size-2x"></span>
                              Arrastre aquí su archivo o haga click para añadir.</label>
                             @error('archivo_historia_clinica')
                                  <span class="invalid-feedback" role="alert">
                                      <strong class="text-danger">{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                       </div>
                            </div>

                            {{-- por definir cuarto documento --}}
                            <div class="col-md-12 pl-1 pt-3">
                                <h4 class="headline-m-govco">Aviso de privacidad y autorización tratamiento de datos personales</h4>
                           

                            <a class="btn btn-low px-0" href="https://www.bucaramanga.gov.co/Inicio/autorizacion-de-tratamiento-de-datos-personales/" target="_blank" tabindex="24">Autorizo el tratamiento de datos personales</a>
                            <label class="d-inline">
                               <input type="checkbox"  class="check-style" id="AT00" name="tratamiento_datos"  value="SI" tabindex="24" required />
                               <label for="AT00"> </label>
                            </label><br>
                          

                            <a class="btn btn-low px-0" href="https://www.bucaramanga.gov.co/wp-content/uploads/2018/12/Resolucion-340-Dic-26-2018-y-Politica.pdf" target="_blank" tabindex="25">Acepto términos y condiciones</a>
                            <label class="d-inline" tabindex="25">
                               <input type="checkbox" class="check-style" id="AT01" name="acepto_terminos"  value="SI" tabindex="25" required />
                               <label for="AT01"> </label>
                            </label>

                            <p class="text-justify">Confirmo que soy mayor de edad y con plena capacidad para diligenciar el presente formulario.
                               Así mismo declaro que la información aquí suministrada corresponde a la verdad.
                               Declaro que he leído, entiendo y acepto las políticas de tratamiento de los datos que suministro,
                               de conformidad con la Ley 1581 de 2012 y demás normas concordantes
                              <label class="d-inline" tabindex="26">
                                 <input type="checkbox" class="check-style" id="AT02" name="confirmo_mayorEdad" tabindex="26"  value="SI" required/>
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
                           <div class="form-check-inline" tabindex="27">
                              <label class="" tabindex="27">
                                 <input type="radio" name="compartir_informacion" id="rb_si" value="SI" tabindex="27" class="radio-per-gov"/>
                                 <label for="rb_si">SI</label>
                              </label>
                           </div>
                           <div class="form-check-inline" tabindex="28">
                              <label class="" tabindex="28">
                                 <input type="radio" name="compartir_informacion" id="rb_no" value="NO" tabindex="28" class="radio-per-gov"/>
                                 <label for="rb_no">NO</label>
                              </label>
                           </div>
                          
                        </div>

                         <div class="col-md-12  pl-1 pr-1 pt-3 text-left mt-4" style="padding-left: 0px!important">
                           <div class="g-recaptcha" data-sitekey="6LdzXDwcAAAAAOgw8LzMLMjgnI2spGFhuCoMYlGc" data-tabindex="29"></div>
                            <button style="font-size:15px;" type="submit" class="btn btn-round btn-middle btn_enviar_solicitud" name="consultar" onclick="return confirm('¿Esta seguro de realizar esta solicitud ?')" tabindex="30">Enviar Solicitud</button>
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
                                    <a  type="button" href="#" target="_blank"><h4 class="headline-s-govco" tabindex="5">Manual de usuario</h4></a>
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
                                          style="color: #3366CC; font-size: 13px!important;" href="mailto:laquinonez@bucaramanga.gov.co"
                                          target="_blank" tabindex="7">laquinonez@bucaramanga.gov.co</a></p>
                                  <p class="form-inline my-0"><span class="govco-icon govco-icon-call-center"></span><a
                                          style="color: #3366CC; font-size: 13px!important;" href="tel:6076337000"> (+57) 6076337000 ext:184</a></p>

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
                           {{-- modulo tramites --}}
                           <input id="modulo" type="hidden" class="form-control modulo" value="CERTIFICACION DE DISCAPACIDAD">


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
                                       id="text-area" maxlength="300" onkeypress="return Direccion(event)"
                                       onkeyup="aMayusculas(this.value,this.id)"></textarea>
                                       <button type="button" class="btn btn-round btn-middle btn-block enviar-sugerencias"
                                       id="enviar-sugerencias" data-toggle="tooltip" data-placement="right" title="enviar sugerencias" tabindex="8">Envia tus sugerencias</button>
                                      
                               </div>

                           </div>
                       </div>
                   </div>
                   <div class="row justify-content-center">
                     <a href="{{route('discapacidad.index')}}"><button style="font-size:15px;" type="button" class="btn btn-round btn-middle" id="btn-back" tabindex="8">Volver al inicio del tramite</button></a>
                   </div>

               </div>

           </div>

                  
                    
                    {{-- tercer acordion --}}

                    {{-- <div class="accordion accordion-govco pt-0" id="acc3">
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
                     </div> --}}
                    
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
                           <label style="color:#111111;" class="input" for="DD01" style="font-family: 'Barlow', sans-serif;"> Calle - Carrera *</label>
                           <select name="DD01" id="DD01" type="text" class="form-control input-md modal1" required="required" title="Selecciona el tipo de indicación inicial para la dirección que desea ingresar" tabindex="20">
                              <option value=""></option>
                              @foreach ($Parametros2 as $parametro2)
                              <option value="{{$parametro2->ParDes}}">{{$parametro2->ParDes}}</option>
                              @endforeach

                             
                           </select>
                        </div>
                     </div>

                     <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                        <div class="form-group">
                           <label style="color:#111111;" class="input" for="DD02" style="font-family: 'Barlow', sans-serif;">N° - Nombre * </label>
                           <input id="DD02" name="DD02" type="text" class="form-control modal1" maxlength="20" required="required" title="En este campo se deberá digitar número o nombre según corresponda a la selección en el campo anterior, te recomendamos observar el campo de visualización que se encuentra al final de este módulo para organizar tu dirección correctamente." onkeypress="return NumDoc(event)" onchange="aMayusculas(this.value,this.id)" style="height: 29px!important;" tabindex="20" placeholder="EJ: 10">
                        </div>
                     </div>

                     <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                        <div class="form-group">
                           <label style="color:#111111;" class="input" for="DD03" style="font-family: 'Barlow', sans-serif;">Letra </label>
                           <select id="DD03" name="DD03" type="text" class="form-control input-md modal1" title="Selecciona una letra si tu indicación de dirección en el campo anterior contiene esta opción, si no la posee déjala en blanco" tabindex="20">
                              <option value=""></option>
                              @foreach ($Parametros1 as $parametro1)
                              <option value="{{$parametro1->ParNom}}">{{$parametro1->ParNom}}</option>
                              @endforeach
                              
                           </select>
                        </div>
                     </div>

                     <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"><br>
                        <div class="form-group">
                           <label style="color:#111111;" class="input" for="DD04" style="font-family: 'Barlow', sans-serif;">Numero* </label>
                           <input id="DD04" name="DD04" type="text" class="form-control modal1" maxlength="4" title="Digita en este campo el primer número de tu dirección" onkeypress="return Numeros(event)" required="required" style="height: 29px!important;" placeholder="EJ: 30" tabindex="20">
                        </div>
                     </div>

                     <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                        <div class="form-group">
                           <label style="color:#111111;" class="input" for="DD05" style="font-family: 'Barlow', sans-serif;">Letra </label>
                           <select id="DD05" name="DD05" type="text" class="form-control input-md modal1" title="Selecciona una letra si tu indicación de dirección en el campo anterior contiene esta opción, si no la posee déjala en blanco" tabindex="12">
                              <option value=""></option>
                              @foreach ($Parametros1 as $parametro1)
                              <option value="{{$parametro1->ParNom}}">{{$parametro1->ParNom}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>

                     <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"><br>
                        <div class="form-group">
                           <label style="color:#111111;" class="input" for="DD06" style="font-family: 'Barlow', sans-serif;">Numero* </label>
                           <input id="DD06" name="DD06" type="text" class="form-control modal1" maxlength="4" title="Digita en este campo el primer número de tu dirección" onkeypress="return Numeros(event)" style="height: 29px!important;" placeholder="Ej:22" tabindex="20">
                        </div>
                     </div>

                     <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                        <div class="form-group">
                           <label style="color:#111111;" class="input" for="DD07" style="font-family: 'Barlow', sans-serif;">Letra </label>
                           <select id="DD07" name="DD07" type="text" class="form-control input-md modal1" title="Selecciona una letra si tu indicación de dirección en el campo anterior contiene esta opción, si no la posee déjala en blanco" tabindex="20">
                              <option value=""></option>
                              @foreach ($Parametros1 as $parametro1)
                              <option value="{{$parametro1->ParNom}}">{{$parametro1->ParNom}}</option>
                              @endforeach
                              
                           </select>
                        </div>
                     </div>

                     <div class="col-lg-6 col-md-2 col-sm-12 col-xs-12 caja_ultima"><br>
                        <div class="form-group">
                           <label style="color:#111111;" class="input" for="DD08" style="font-family: 'Barlow', sans-serif;">Complemento </label>
                           <input id="DD08" name="DD08" type="text" class="form-control  modal1" maxlength="80" title="Digita en este el complemento de tu direccion" onkeyup="aMayusculas(this.value,this.id)" placeholder="Ej: EDF EL MIRADOR DEL SOL" tabindex="20">
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
                  
                  <button style="font-size:15px;" type="button" class="btn btn-round btn-middle btn-outline-info" id="btnDireccion" value="Boton" tabindex="20">Ingresar Dirección</button>
                  <button style="font-size:15px;" type="button" class="btn btn-round btn-middle btn-outline-info" data-dismiss="modal" tabindex="20">Cerrar</button>
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
                             <label style="color:#111111;" class="input" for="DD01" style="font-family: 'Barlow', sans-serif;"> Calle - Carrera *</label>
                             <select name="DD01" id="DD010" type="text" class="form-control input-md modal2" required="required" title="Selecciona el tipo de indicación inicial para la dirección que desea ingresar">
                                <option value=""></option>
                                @foreach ($Parametros2 as $parametro2)
                                <option value="{{$parametro2->ParDes}}">{{$parametro2->ParDes}}</option>
                                @endforeach

                               
                             </select>
                          </div>
                       </div>
  
                       <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                          <div class="form-group">
                             <label style="color:#111111;" class="input" for="DD02" style="font-family: 'Barlow', sans-serif;">N° - Nombre * </label>
                             <input id="DD020" name="DD02" type="text" class="form-control modal2" maxlength="20" required="required" title="En este campo se deberá digitar número o nombre según corresponda a la selección en el campo anterior, te recomendamos observar el campo de visualización que se encuentra al final de este módulo para organizar tu dirección correctamente." onkeypress="return NumDoc(event)" onchange="aMayusculas(this.value,this.id)" style="height: 29px!important;">
                          </div>
                       </div>
  
                       <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                          <div class="form-group">
                             <label style="color:#111111;" class="input" for="DD03" style="font-family: 'Barlow', sans-serif;">Letra </label>
                             <select id="DD030" name="DD03" type="text" class="form-control input-md modal2" title="Selecciona una letra si tu indicación de dirección en el campo anterior contiene esta opción, si no la posee déjala en blanco">
                                <option value=""></option>
                                @foreach ($Parametros1 as $parametro1)
                                <option value="{{$parametro1->ParNom}}">{{$parametro1->ParNom}}</option>
                                @endforeach
                                
                             </select>
                          </div>
                       </div>
  
                       <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"><br>
                          <div class="form-group">
                             <label style="color:#111111;" class="input" for="DD04" style="font-family: 'Barlow', sans-serif;">Numero* </label>
                             <input id="DD040" name="DD04" type="text" class="form-control modal2" maxlength="4" title="Digita en este campo el primer número de tu dirección" onkeypress="return Numeros(event)" required="required" style="height: 29px!important;">
                          </div>
                       </div>
  
                       <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                          <div class="form-group">
                             <label style="color:#111111;" class="input" for="DD05" style="font-family: 'Barlow', sans-serif;">Letra </label>
                             <select id="DD050" name="DD050" type="text" class="form-control input-md modal2" title="Selecciona una letra si tu indicación de dirección en el campo anterior contiene esta opción, si no la posee déjala en blanco">
                                <option value=""></option>
                                @foreach ($Parametros1 as $parametro1)
                                <option value="{{$parametro1->ParNom}}">{{$parametro1->ParNom}}</option>
                                @endforeach
                             </select>
                          </div>
                       </div>
  
                       <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"><br>
                          <div class="form-group">
                             <label style="color:#111111;" class="input" for="DD06" style="font-family: 'Barlow', sans-serif;">Numero* </label>
                             <input id="DD060" name="DD06" type="text" class="form-control modal2" maxlength="4" title="Digita en este campo el primer número de tu dirección" onkeypress="return Numeros(event)" style="height: 29px!important;">
                          </div>
                       </div>
  
                       <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                          <div class="form-group">
                             <label style="color:#111111;" class="input" for="DD07" style="font-family: 'Barlow', sans-serif;">Letra </label>
                             <select id="DD070" name="DD070" type="text" class="form-control input-md modal2" title="Selecciona una letra si tu indicación de dirección en el campo anterior contiene esta opción, si no la posee déjala en blanco">
                                <option value=""></option>
                                @foreach ($Parametros1 as $parametro1)
                                <option value="{{$parametro1->ParNom}}">{{$parametro1->ParNom}}</option>
                                @endforeach
                                
                             </select>
                          </div>
                       </div>
  
                       <div class="col-lg-6 col-md-2 col-sm-12 col-xs-12 caja_ultima"><br>
                          <div class="form-group">
                             <label style="color:#111111;" class="input" for="DD08" style="font-family: 'Barlow', sans-serif;">Complemento </label>
                             <input id="DD080" name="DD08" type="text" class="form-control modal2" maxlength="80" title="Digita en este el complemento de tu direccion" onkeyup="aMayusculas(this.value,this.id)">
                          </div>
                       </div>
  
                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><br><br>
                          <div class="form-group">
                             <input style="background-color: #004884; color: #FFFFFF; font-weight: bold; border-radius:8px;" name="Direccion" id="DD0000" type="text" class="form-control input-md DD00" data-toggle="tooltip" title="Previsualizador de la dirección introducida" data-delay='{"show":"30", "hide":"30"}' placeholder="Pre visualizador de direcciones" required="required" readonly>
                          </div>
                       </div>
  
                      
                    </div>
                 </div>
  
                 <div class="modal-footer">
                    
                    <button style="font-size:15px;" type="button" class="btn btn-round btn-middle btn-outline-info" id="btnDireccionEmpresas" value="Boton">Ingresar Dirección</button>
                    <button style="font-size:15px;" type="button" class="btn btn-round btn-middle btn-outline-info" data-dismiss="modal">Cerrar</button>
                 </div>
              </form>
           </div>
        </div>
     </div> --}}

     {{-- MODAL CONSULTAR SOLICITUD --}}
     
     <div id="ModalConsulta" class="modal fade center" role="dialog">
        <div class="modal-dialog modal-lg" style="max-width: 1000px!important;">
           <!-- Modal content-->
           <div class="modal-content">
              <div class="modal-header" style="background:#E5EEFB;">
                 <h4 class="modal-title">Consultar Solicitud</h4>
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <form method="post" action="{{route('discapacidad.consulta')}}">
                @csrf
                 <div class="modal-body">
                    <div class="row form-row">
                       <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><br>
                          <div class="form-group">
                             <label style="color:#111111;" class="input" for="DD01" style="font-family: 'Barlow', sans-serif;">Buscar Por </label>
                             <select id="VD01" name="tipo_parametro" class="form-control input-md" title="Seleccione la opción para validar el documento" required="required">
                                <option value="">Seleccione</option>
                                <option value="radicado">Numero de radicado</option>                                
                                <option value="ide_responsable">Documento de identificación del responsable</option>
  
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
                   
                    <button type="submit" class="btn btn-round btn-middle btn-outline-info"  id="Boton">Realizar Búsqueda</button>
                    <button type="button" class="btn btn-round btn-middle btn-outline-info" data-dismiss="modal">Cerrar</button>
                 </div>
              </form>
           </div>
        </div>
     </div>


@endsection