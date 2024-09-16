@extends('layouts.app')

@section('title', 'Categorización de Parqueaderos')
@section('content')

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
                                 Categorización Parqueaderos
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
                  <div id="section-index">
                     <div class="card govco-card border-0 shadow-none" style="border-radius: 0px;">
                        <h1 class="headline-xl-govco">Categorización de Parqueaderos</h1>

                        <div class="alert-primary-govco alert alert-dismissible fade show mt-3"
                        aria-label="Alerta informativa">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar"
                            title="Cerrar">&times;</button>
                        <div class="alert-heading">
                            <span class="govco-icon govco-icon-bell-sound-p size-2x"></span>
                            <span class="headline-l-govco">Importante</span>
                        </div>
                        <p style="text-align: justify"> Este trámite tiene el objetivo de clasificar y categorizar mediante acto administrativo los parqueaderos públicos ubicados en el Municipio de Bucaramanga, ajustándose al procedimiento en sus diferentes etapas de legalización, en cumplimiento del Decreto 073 de 1985. </p>
                     </div>
                     
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="card gov-co-tramite-card">
                          <a href="{{route('parqueadero.registro')}}" tabindex="9"> <div class="card-header text-center">Radicar trámite</div></a>
                           <div class="card-body">
                              <p class="card-text">Inicie el trámite de categorizacion de parqueaderos.</p>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="card gov-co-tramite-card">
                           <a href="{{route('parqueadero.consultaTramite')}}"  type="button" tabindex="10"><div class="card-header text-center">Consulto mi solicitud</div></a>
                           <div class="card-body">
                              <p class="card-text">Consulte el estado de su solicitud ante la Alcaldia de Bucaramanga.</p>
                           </div>
                        </div>
                     </div>
                  </div>
                </div>
                </div>
                        
                            
                            


                       

                   
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <!---contenido de cajas -->
                   {{-- manual --}}

                   <div class="accordion accordion-govco mb-3" id="">
                     <div class="card mb-0">
                         <div class="card-header row no-gutters" id="">
                             <button class="btn-link row no-gutters" type="button">
                                 <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                    <a  type="button" href="{{asset('library/Manuales/M-TIC-1400-170-011 Manual usuario (ciudadano) parqueadero publico.pdf')}}" target="_blank"><h4 class="headline-s-govco" tabindex="5">Manual de usuario</h4></a>
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
                                                style="color: #3366CC; font-size: 13px!important;" href="mailto:cjguerrero@bucaramanga.gov.co"
                                                target="_blank" tabindex="7"> cjguerrero@bucaramanga.gov.co</a></p>
                                        <p class="form-inline my-0"><span class="govco-icon govco-icon-call-center"></span><a
                                                style="color: #3366CC; font-size: 13px!important;" href="tel:0376337000"> (+57)7 633 70 00 EXT 362</a></p>

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
                                    <input id="modulo" type="hidden" class="form-control modulo" value="CATEGORIZACION DE PARQUEADEROS">


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
                   
                    {{-- tercer acordion --}}

                    <div class="accordion accordion-govco pt-0 d-none" id="acc3">
                        <div class="card">
                           <div class="card-header row no-gutters" id="c3">
                              <button class="btn-link row no-gutters collapsed" type="button" data-toggle="collapse" data-target="#coll3" aria-expanded="false" aria-controls="coll3">
                                 <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">                                    
                                    <h4 class="headline-s-govco">Consulto mi Solicitud</h4>
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

     {{-- <div id="ModalDirecciones" class="modal fade center" role="dialog">
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
                             <select name="DD01" id="DD01" type="text" class="form-control input-md modal1" required="required" title="Selecciona el tipo de indicación inicial para la dirección que desea ingresar" tabindex="12">
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
                             <input id="DD02" name="DD02" type="text" class="form-control modal1" maxlength="20" required="required" title="En este campo se deberá digitar número o nombre según corresponda a la selección en el campo anterior, te recomendamos observar el campo de visualización que se encuentra al final de este módulo para organizar tu dirección correctamente." onkeypress="return NumDoc(event)" onchange="aMayusculas(this.value,this.id)" style="height: 29px!important;" tabindex="12" placeholder="EJ: 10">
                          </div>
                       </div>
  
                       <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                          <div class="form-group">
                             <label style="color:#111111;" class="input" for="DD03" style="font-family: 'Barlow', sans-serif;">Letra </label>
                             <select id="DD03" name="DD03" type="text" class="form-control input-md modal1" title="Selecciona una letra si tu indicación de dirección en el campo anterior contiene esta opción, si no la posee déjala en blanco" tabindex="12">
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
                             <input id="DD04" name="DD04" type="text" class="form-control modal1" maxlength="4" title="Digita en este campo el primer número de tu dirección" onkeypress="return Numeros(event)" required="required" style="height: 29px!important;" placeholder="EJ: 30" tabindex="12">
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
                             <input id="DD06" name="DD06" type="text" class="form-control modal1" maxlength="4" title="Digita en este campo el primer número de tu dirección" onkeypress="return Numeros(event)" style="height: 29px!important;" placeholder="Ej:22" tabindex="12">
                          </div>
                       </div>
  
                       <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                          <div class="form-group">
                             <label style="color:#111111;" class="input" for="DD07" style="font-family: 'Barlow', sans-serif;">Letra </label>
                             <select id="DD07" name="DD07" type="text" class="form-control input-md modal1" title="Selecciona una letra si tu indicación de dirección en el campo anterior contiene esta opción, si no la posee déjala en blanco" tabindex="12">
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
                             <input id="DD08" name="DD08" type="text" class="form-control  modal1" maxlength="80" title="Digita en este el complemento de tu direccion" onkeyup="aMayusculas(this.value,this.id)" placeholder="Ej: CASA ESQUINERA" tabindex="12">
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
                    
                    <button style="font-size:15px;" type="button" class="btn btn-round btn-middle btn-outline-info" id="btnDireccion" value="Boton" tabindex="12">Ingresar Dirección</button>
                    <button style="font-size:15px;" type="button" class="btn btn-round btn-middle btn-outline-info" data-dismiss="modal" tabindex="12">Cerrar</button>
                 </div>
              </form>
           </div>
        </div>
     </div> --}}

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
                             <select name="DD01" id="DD010" type="text" class="form-control input-md modal2" required="required" title="Selecciona el tipo de indicación inicial para la dirección que desea ingresar" tabindex="18">
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
                             <input id="DD020" name="DD02" type="text" class="form-control modal2" maxlength="20" required="required" title="En este campo se deberá digitar número o nombre según corresponda a la selección en el campo anterior, te recomendamos observar el campo de visualización que se encuentra al final de este módulo para organizar tu dirección correctamente." onkeypress="return NumDoc(event)" onchange="aMayusculas(this.value,this.id)" style="height: 29px!important;" tabindex="18" placeholder="Ej: 27">
                          </div>
                       </div>
  
                       <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                          <div class="form-group">
                             <label style="color:#111111;" class="input" for="DD03" style="font-family: 'Barlow', sans-serif;">Letra </label>
                             <select id="DD030" name="DD03" type="text" class="form-control input-md modal2" title="Selecciona una letra si tu indicación de dirección en el campo anterior contiene esta opción, si no la posee déjala en blanco" tabindex="18">
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
                             <input id="DD040" name="DD04" type="text" class="form-control modal2" maxlength="4" title="Digita en este campo el primer número de tu dirección" onkeypress="return Numeros(event)" required="required" style="height: 29px!important;" tabindex="18" placeholder="EJ:55">
                          </div>
                       </div>
  
                       <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                          <div class="form-group">
                             <label style="color:#111111;" class="input" for="DD05" style="font-family: 'Barlow', sans-serif;">Letra </label>
                             <select id="DD050" name="DD050" type="text" class="form-control input-md modal2" title="Selecciona una letra si tu indicación de dirección en el campo anterior contiene esta opción, si no la posee déjala en blanco" tabindex="18">
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
                             <input id="DD060" name="DD06" type="text" class="form-control modal2" maxlength="4" title="Digita en este campo el primer número de tu dirección" onkeypress="return Numeros(event)" style="height: 29px!important;" tabindex="18" placeholder="EJ:35">
                          </div>
                       </div>
  
                       <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                          <div class="form-group">
                             <label style="color:#111111;" class="input" for="DD07" style="font-family: 'Barlow', sans-serif;">Letra </label>
                             <select id="DD070" name="DD070" type="text" class="form-control input-md modal2" title="Selecciona una letra si tu indicación de dirección en el campo anterior contiene esta opción, si no la posee déjala en blanco" tabindex="18">
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
                             <input id="DD080" name="DD08" type="text" class="form-control modal2" maxlength="80" title="Digita en este el complemento de tu direccion" onkeyup="aMayusculas(this.value,this.id)" tabindex="18" placeholder="EJ: Conjunto Residencial">
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
                    
                    <button style="font-size:15px;" type="button" class="btn btn-round btn-middle btn-outline-info" id="btnDireccionEmpresas" value="Boton" tabindex="18">Ingresar Dirección</button>
                    <button style="font-size:15px;" type="button" class="btn btn-round btn-middle btn-outline-info" data-dismiss="modal" tabindex="18">Cerrar</button>
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
              <form method="post" action="{{route('parqueadero.consulta')}}">
                @csrf
                 <div class="modal-body">
                    <div class="row form-row">
                       <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><br>
                          <div class="form-group">
                             <label style="color:#111111;" class="input" for="DD01" style="font-family: 'Barlow', sans-serif;">Buscar Por </label>
                             <select id="VD01" name="tipo_parametro" class="form-control input-md select_general" title="Seleccione la opción para validar el documento" required="required" tabindex="11">
                                <option value="">Seleccione</option>
                                <option value="radicado">Numero de radicado</option>                                
                                <option value="identificacion_solicitante">Documento de identificación Solicitante</option>
  
                               </select>
                            </div>
                       </div>  
                       <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><br>
                          <div class="form-group">
                             <label style="color:#111111;" class="input" for="DD01" style="font-family: 'Barlow', sans-serif;">Digite Numero </label>
                            <input type="text" name="parametro" id="VD00" class="form-control input-md" title="Digite un numero valido" required="required" onkeypress="return Numeros(event)" onkeyup="aMayusculas(this.value,this.id)" maxlength="40" minlength="5" tabindex="12">
      
                          </div>
                       </div>
                    </div>
                 </div>
  
                 <div class="modal-footer">
                   
                    <button type="submit" class="btn btn-round btn-middle btn-outline-info"  id="Boton" tabindex="13">Realizar Búsqueda</button>
                    <button type="button" class="btn btn-round btn-middle btn-outline-info" data-dismiss="modal" tabindex="14">Cerrar</button>
                 </div>
              </form>
           </div>
        </div>
     </div>


@endsection