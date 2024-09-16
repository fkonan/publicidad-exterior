@extends('layouts.menu')

@section('dashboard')
    <style>
        th.sorting_desc::after,
        th.sorting_asc::after {
            right: 0 !important;
            content: "" !important;
        }
        .ui-autocomplete {
         z-index: 2147483647;
      }
      body {
        overflow-x: hidden!important;
       } 
    </style>

    <?php $tramite = 'RITA'; ?>

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
                                <a style="color: #004fbf;" class="breadcrumb-text" href="/dashboard">Tramites en Linea</a>
                            </div>
                        </li>
                        <li class="breadcrumb-item ">
                            <div class="image-icon">
                                <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                                <a style="color: #004fbf;" class="breadcrumb-text" href="{{route('planeacion.index')}}">
                                    Planeacion</a>
                            </div>
                        </li>
                        <li class="breadcrumb-item ">
                            <div class="image-icon">
                                <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                                <p class="ml-3 ml-md-0 "><b style="color: #004fbf;text-transform: none;">
                                        Reportes de uso de suelo
                                    </b></p>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-md-12 pt-4" style="padding-left: 10px!important">
            <h1 class="headline-xl-govco">Reportes Uso de suelo</h1>
             <p>Ir a Tablero de control<a class="btn btn-link text-info" href="{{route('planeacion.uso.tablero')}}">Clic Aqui</a></p>
            <div class="row pt-5">
                <div class="tabs-govco col-md-12 animate__animated animate__bounceInRight">
                    <form method="POST" action="{{route('tramites.planeacion.reportes.uso')}}" id="formReportUso">
                        @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="estado">Estado de la solicitud</label>
                                <select
                                    class="form-control  @error('estado_solicitud') is-invalid @enderror"
                                    name="estado_solicitud" id="estado_solicitud">
                                    <option value="">Seleccione</option>
                                    <option value="COMPATIBLE">COMPATIBLE</option>
                                    <option value="INCOMPATIBLE">INCOMPATIBLE</option>
                                    <option value="CASO ESPECIAL">CASO ESPECIAL</option>                                    

                                </select>
                                @error('estado_solicitud')
                                <span class="invalid-feedback" role="alert">
                                   <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="estado">Radicado</label>
                                <input value="{{old('radicado')}}" type="text" class="form-control razon_social  @error('radicado') is-invalid @enderror info_general" name="radicado" id="radicado"  maxlength="20" minlength="4" onkeypress="return NumDoc(event)" placeholder="Ej: 2022251017">
                                @error('radicado')
                                <span class="invalid-feedback" role="alert">
                                   <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="estado">Identificacion</label>
                                <input value="{{old('identificacion')}}" type="text" class="form-control razon_social  @error('identificacion') is-invalid @enderror info_general" name="identificacion" id="identificacion"  maxlength="15" minlength="4" onkeypress="return NumDoc(event)" placeholder="Ej: 1098716212">
                                @error('asunto')
                                <span class="invalid-feedback" role="alert">
                                   <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="estado">Desde</label>
                                <input value="{{old('fecha_inicial')}}" type="date" class="form-control razon_social  @error('fecha_inicial') is-invalid @enderror info_general" name="fecha_inicial" id="fecha_inicial">
                                @error('asunto')
                                <span class="invalid-feedback" role="alert">
                                   <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="estado">Hasta</label>
                                <input value="{{old('fecha_final')}}" type="date" class="form-control razon_social  @error('fecha_final') is-invalid @enderror info_general" name="fecha_final" id="fecha_final">
                                @error('asunto')
                                <span class="invalid-feedback" role="alert">
                                   <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mt-2">
                           <div class="form-group">
                               <label for="estado">Unidad</label>
                               <select
                                   class="form-control  @error('unidad') is-invalid @enderror"
                                   name="unidad" id="unidad">
                                   <option value="">Seleccione</option>
                                   @foreach ($unidades as $unidad)
                                       <option value="{{$unidad->nombre}}">{{$unidad->nombre}}</option>
                                   @endforeach
                                                                    

                               </select>
                               @error('unidad')
                               <span class="invalid-feedback" role="alert">
                                  <strong class="text-danger">{{ $message }}</strong>
                                   </span>
                               @enderror
                           </div>
                       </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="codigo">Codigo Predial</label>
                                <input value="{{old('codigo')}}" type="text" class="form-control razon_social  @error('codigo') is-invalid @enderror info_general" name="codigo" id="codigo"  maxlength="17" minlength="4" onkeypress="return NumDoc(event)" placeholder="Ej: 68001010600830021">
                                @error('codigo')
                                <span class="invalid-feedback" role="alert">
                                   <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="direccion_busqueda" class="form-label">Dirección </label><button type="button" class="btn btn-link"><span style="text-transform: lowercase; font-size: 12px;" class="text-primary label-event" data-toggle="modal" id="button-modal" data-target="#modalDirecciones" tabindex="12">(Clic para insertar direccion)</span></button>
                            <input type="text" value="{{old('direccion_busqueda')}}" class="form-control  @error('direccion_busqueda') is-invalid @enderror" name="direccion_busqueda" id="direccion_busqueda"  maxlength="120" readonly placeholder="Ej: K 28 19 19">
                            @error('direccion_busqueda')
                            <span class="invalid-feedback" role="alert">
                               <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 pt-3">
                           <div class="form-group">
                               <label for="estado">Barrio*</label>
                               <select
                                   class="form-control  @error('barrio') is-invalid @enderror"
                                   name="barrio" id="barrio">
                                   <option value="">Seleccione</option>
                                   @foreach ($barrios as $barrio)
                                       <option value="{{$barrio->BarNom}}">{{$barrio->BarNom}}</option>
                                   @endforeach
                                                                    

                               </select>
                               @error('barrio')
                               <span class="invalid-feedback" role="alert">
                                  <strong class="text-danger">{{ $message }}</strong>
                                   </span>
                               @enderror
                           </div>
                       </div>
                        <div class="col-md-2 pt-3">
                            <div class="form-group">
                                <button  type="submit" class="btn btn-round btn-high-mix-govco"><span class="govco-icon govco-icon-search-cn text-white"></span>
                                    <span class="btn-govco-text text-white">Buscar</span>
                                  </button>
                            </div>
                        </div>
                    </div>
                    
                </form>
                <div class="col-md-3 pl-0 mr-0">
                    <a class="btn btn-round btn-high" href="{{ URL::route('planeacion.index') }}"
                        style="float: left;">Volver</a>
                </div>

                </div>
                  

                    
                </div>





            </div>
        </div>



    </div>
    <div id="modalDirecciones" class="modal fade center" role="dialog">
        <div class="modal-dialog modal-lg" style="max-width: 1000px!important;">
  
           <!-- Modal content-->
           <div class="modal-content">
              <div class="modal-header" style="background:#E5EEFB;">
  
                 <h4 class="modal-title">Ingresa tu Dirección</h4>
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <form method="POST" id="formDirecciones">
  
                 <div class="modal-body">
                    <div class="row form-row">
  
                       <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                          <div class="form-group">
                             <label style="color:#111111;" class="input" for="DM01" style="font-family: 'Barlow', sans-serif;"> Calle - Carrera *</label>
                             <select name="DM01" id="DM01" type="text" class="form-control" required="required" title="Selecciona el tipo de indicación inicial para la dirección que desea ingresar">
                                <option value="">Selecciona</option>
                                <option value="C">Calle</option>
                                <option value="K">Carrera</option>
                                <option value="A">Avenida</option>
                                <option value="ANILLO">Anillo</option>
                                <option value="D">Diagonal</option>
                                <option value="CIR">Circunvalar</option>
                                <option value="T">Transversal</option>
                                <option value="BL">Bulevar</option>
                                <option value="CS">Casa</option>
                                <option value="MZ">Manzana</option>
                             </select>
                          </div>
                       </div>

                       
  
                       <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                          <div class="form-group">
                             <label style="color:#111111;" class="input" for="DD02" style="font-family: 'Barlow', sans-serif;">N° - Nombre * </label>
                             <input id="DD02" name="DD02" type="text" class="form-control" maxlength="20" required="required" title="En este campo se deberá digitar número o nombre según corresponda a la selección en el campo anterior, te recomendamos observar el campo de visualización que se encuentra al final de este módulo para organizar tu dirección correctamente." onkeypress="return NumDoc(event)" onchange="aMayusculas(this.value,this.id)">
                          </div>
                       </div>
  
                       <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                          <div class="form-group">
                             <label style="color:#111111;" class="input" for="DM03" style="font-family: 'Barlow', sans-serif;">Letra </label>
                             <select id="DM03" name="DM03" type="text" class="form-control input-md" title="Selecciona una letra si tu indicación de dirección en el campo anterior contiene esta opción, si no la posee déjala en blanco">
                                <option value=""></option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                                <option value="F">F</option>
                                <option value="G">G</option>
                                <option value="H">H</option>
                                <option value="I">H</option>
                                <option value="J">J</option>
                                <option value="L">L</option>
                                <option value="M">M</option>
                                <option value="N">N</option>
                                <option value="O">O</option>
                                <option value="P">P</option>
                                <option value="Q">Q</option>
                                <option value="R">R</option>
                                <option value="S">S</option>
                                <option value="T">T</option>
                                <option value="W">W</option>
                                <option value="X">X</option>
                                <option value="Y">Y</option>
                                <option value="Z">Z</option>
                                <option value="AW">AW</option>
                                <option value="BW">BW</option>
                                <option value="BN">BN</option>
                                <option value="CW">CW</option>
                                <option value="DW">DW</option>
                                <option value="AN">AN</option>
                                <option value="NA">NA</option>
                                <option value="NB">NB</option>
                                <option value="BN">BN</option>
                                <option value="NC">NC</option>
                                <option value="CN">CN</option>
                                <option value="BIS">BIS</option>
                                <option value="A BIS">A BIS</option>
                                <option value="B BIS">B BIS</option>
                                <option value="C BIS">C BIS</option>
                                <option value="D BIS">D BIS</option>
                                <option value="N-BIS">N BIS</option>
                                <option value="OCC">OCC</option>
                                <option value="A OCC">B OCC</option>
                                <option value="B OCC">B OCC</option>
                                <option value="C OCC">C OCC</option>
                                <option value="D OCC">D OCC</option>
                                <option value="BQ">BLOQUE</option>
                                <option value="MZ">MANZANA</option>
                                <option value="CS">CASA</option>
                                <option value="AP">APARTAMENTO</option>
                                <option value="LT">LOTE</option>
                                <option value="LO">LOCAL</option>
                                <option value="PEAT">PEATONAL</option>
                                <option value="N PEAT">N PEATONAL</option>
                                <option value="NA PEAT">NB PEATONAL</option>
                                <option value="NB PEAT">NA PEATONAL</option>
                                <option value="A PEAT GUAY OCC CS">A PEATONAL GUAYACANES OCC</option>
                                <option value="B PEAT GUAY OCC CS">B PEATONAL GUAYACANES OCC</option>
                                <option value="C PEAT GUAY OCC CS">C PEATONAL GUAYACANES OCC</option>
                                <option value="D PEAT GUAY OCC CS">D PEATONAL GUAYACANES OCC</option>
                             </select>
                          </div>
                       </div>
  
                       <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"><br>
                          <div class="form-group">
                             <label style="color:#111111;" class="input" for="DD04" style="font-family: 'Barlow', sans-serif;">Numero* </label>
                             <input id="DD04" name="DD04" type="text" class="form-control" maxlength="4" title="Digita en este campo el primer número de tu dirección" onkeypress="return NumDoc(event)" required="required">
                          </div>
                       </div>
  
                       <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                          <div class="form-group">
                             <label style="color:#111111;" class="input" for="DM05" style="font-family: 'Barlow', sans-serif;">Letra </label>
                             <select id="DM05" name="DM05" type="text" class="form-control input-md" title="Selecciona una letra si tu indicación de dirección en el campo anterior contiene esta opción, si no la posee déjala en blanco">
                                <option value=""></option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                                <option value="F">F</option>
                                <option value="G">G</option>
                                <option value="H">H</option>
                                <option value="I">H</option>
                                <option value="J">J</option>
                                <option value="L">L</option>
                                <option value="M">M</option>
                                <option value="N">N</option>
                                <option value="O">O</option>
                                <option value="P">P</option>
                                <option value="Q">Q</option>
                                <option value="R">R</option>
                                <option value="S">S</option>
                                <option value="T">T</option>
                                <option value="W">W</option>
                                <option value="X">X</option>
                                <option value="Y">Y</option>
                                <option value="Z">Z</option>
                                <option value="AW">AW</option>
                                <option value="BW">BW</option>
                                <option value="BN">BN</option>
                                <option value="CW">CW</option>
                                <option value="DW">DW</option>
                                <option value="AN">AN</option>
                                <option value="NA">NA</option>
                                <option value="NB">NB</option>
                                <option value="BN">BN</option>
                                <option value="NC">NC</option>
                                <option value="CN">CN</option>
                                <option value="BIS">BIS</option>
                                <option value="A BIS">A BIS</option>
                                <option value="B BIS">B BIS</option>
                                <option value="C BIS">C BIS</option>
                                <option value="D BIS">D BIS</option>
                                <option value="N-BIS">N BIS</option>
                                <option value="OCC">OCC</option>
                                <option value="A OCC">B OCC</option>
                                <option value="B OCC">B OCC</option>
                                <option value="C OCC">C OCC</option>
                                <option value="D OCC">D OCC</option>
                                <option value="BQ">BLOQUE</option>
                                <option value="MZ">MANZANA</option>
                                <option value="CS">CASA</option>
                                <option value="AP">APARTAMENTO</option>
                                <option value="LT">LOTE</option>
                                <option value="LO">LOCAL</option>
                                <option value="PEAT">PEATONAL</option>
                                <option value="N PEAT">N PEATONAL</option>
                                <option value="NA PEAT">NB PEATONAL</option>
                                <option value="NB PEAT">NA PEATONAL</option>
                                <option value="A PEAT GUAY OCC CS">A PEATONAL GUAYACANES OCC</option>
                                <option value="B PEAT GUAY OCC CS">B PEATONAL GUAYACANES OCC</option>
                                <option value="C PEAT GUAY OCC CS">C PEATONAL GUAYACANES OCC</option>
                                <option value="D PEAT GUAY OCC CS">D PEATONAL GUAYACANES OCC</option>
                             </select>
                          </div>
                       </div>
  
                       <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"><br>
                          <div class="form-group">
                             <label style="color:#111111;" class="input" for="DD06" style="font-family: 'Barlow', sans-serif;">Numero* </label>
                             <input id="DD06" name="DD06" type="text" class="form-control" maxlength="4" title="Digita en este campo el primer número de tu dirección" onkeypress="return NumDoc(event)" required>
                          </div>
                       </div>
  
                       <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br>
                          <div class="form-group">
                             <label style="color:#111111;" class="input" for="DM07" style="font-family: 'Barlow', sans-serif;">Letra </label>
                             <select id="DM07" name="DM07" type="text" class="form-control input-md" title="Selecciona una letra si tu indicación de dirección en el campo anterior contiene esta opción, si no la posee déjala en blanco">
                                <option value=""></option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                                <option value="F">F</option>
                                <option value="G">G</option>
                                <option value="H">H</option>
                                <option value="I">H</option>
                                <option value="J">J</option>
                                <option value="L">L</option>
                                <option value="M">M</option>
                                <option value="N">N</option>
                                <option value="O">O</option>
                                <option value="P">P</option>
                                <option value="Q">Q</option>
                                <option value="R">R</option>
                                <option value="S">S</option>
                                <option value="T">T</option>
                                <option value="W">W</option>
                                <option value="X">X</option>
                                <option value="Y">Y</option>
                                <option value="Z">Z</option>
                                <option value="AW">AW</option>
                                <option value="BW">BW</option>
                                <option value="BN">BN</option>
                                <option value="CW">CW</option>
                                <option value="DW">DW</option>
                                <option value="AN">AN</option>
                                <option value="NA">NA</option>
                                <option value="NB">NB</option>
                                <option value="BN">BN</option>
                                <option value="NC">NC</option>
                                <option value="CN">CN</option>
                                <option value="BIS">BIS</option>
                                <option value="A BIS">A BIS</option>
                                <option value="B BIS">B BIS</option>
                                <option value="C BIS">C BIS</option>
                                <option value="D BIS">D BIS</option>
                                <option value="N-BIS">N BIS</option>
                                <option value="OCC">OCC</option>
                                <option value="A OCC">B OCC</option>
                                <option value="B OCC">B OCC</option>
                                <option value="C OCC">C OCC</option>
                                <option value="D OCC">D OCC</option>
                                <option value="BQ">BLOQUE</option>
                                <option value="MZ">MANZANA</option>
                                <option value="CS">CASA</option>
                                <option value="AP">APARTAMENTO</option>
                                <option value="LT">LOTE</option>
                                <option value="LO">LOCAL</option>
                                <option value="PEAT">PEATONAL</option>
                                <option value="N PEAT">N PEATONAL</option>
                                <option value="NA PEAT">NB PEATONAL</option>
                                <option value="NB PEAT">NA PEATONAL</option>
                                <option value="A PEAT GUAY OCC CS">A PEATONAL GUAYACANES OCC</option>
                                <option value="B PEAT GUAY OCC CS">B PEATONAL GUAYACANES OCC</option>
                                <option value="C PEAT GUAY OCC CS">C PEATONAL GUAYACANES OCC</option>
                                <option value="D PEAT GUAY OCC CS">D PEATONAL GUAYACANES OCC</option>
                             </select>
                          </div>
                       </div>
  
                       <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 caja_ultima" style="display: none"><br>
                          <div class="form-group">
                             <label style="color:#111111;" class="input" for="DD08" style="font-family: 'Barlow', sans-serif;">Complemento </label>
                             <input id="DD08" name="DD08" type="text" class="form-control" maxlength="4" title="Digita en este campo el primer número de tu dirección" onkeypress="return NumDoc(event)">
                          </div>
                       </div>
  
                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><br><br>
                          <div class="form-group">
                             <input style="background-color: #004884; color: #FFFFFF; font-weight: bold; border-radius:8px;" name="Direccion" id="DD00" type="text" class="form-control input-md" data-toggle="tooltip" title="Previsualizador de la dirección introducida" data-delay='{"show":"30", "hide":"30"}' placeholder="Pre visualizador de direcciones" required="required">
                          </div>
                       </div>
                       
                       <!--<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 15px;"><br>
                          <div class="col-lg-2 col-md-2 hidden-sm hidden-xs"></div>
                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                             <input name="Direccion" id="DD00" type="text" class="form-control input-md" data-toggle="tooltip" title="Previsualizador de la dirección introducida" data-delay='{"show":"30", "hide":"30"}' placeholder="Pre visualizador de direcciones" required="required">
                          </div>
                          <div class="col-lg-2 col-md-2 hidden-sm hidden-xs"></div>
                      </div>-->
  
                       <!--<video src="videos/video_ayuda.mp4" controls loop style="width: 950px;"></video>-->
                    </div>
                 </div>               
  
                 <div class="modal-footer">                  
  
                    <button style="font-size:15px;" type="submit" class="btn btn-round btn-middle btn-outline-info" name="Boton" id="btnIncluirDir" value="Boton">Incluir Direccion</button>
                    <button style="font-size:15px;" type="button" class="btn btn-round btn-middle btn-outline-info" data-dismiss="modal">Cerrar</button>
                 </div>
              </form>
           </div>
        </div>
     </div>
     @push('custom-scripts')     
     <script>
         $(document).on('change', function() {

            var dd01 = document.getElementById('DM01').value;
            var dd02 = document.getElementById('DD02').value;
            var dd03 = document.getElementById('DM03').value;
            var dd04 = document.getElementById('DD04').value;
            var dd05 = document.getElementById('DM05').value;
            var dd06 = document.getElementById('DD06').value;
            var dd07 = document.getElementById('DM07').value;
            var dd08 = document.getElementById('DD08').value;

            document.getElementById('DD00').value = dd01 + " " + dd02 + dd03 + " " + dd04 + dd05 + " " + dd06 + dd07 + " " + dd08;

         });


         var availableTags = [
            "BOLIVAR",
            "SANTANDER",
            "FONTANA"
         ];
         var avenidas = [
            "PAN DE AZUCAR",
            "EL-JARDIN",
            "QUEBRADA-SECA",
            "LA ROSITA",
            "GONZALEZ-VALENCIA",
            "ALTOS-DEL-JARDIN",
            "EDUARDO-SANTOS",
            "LOS BUCAROS",
            "T ORIENTAL",
            "CIRCUNVALAR",
            "BOULEVARD SANTANDER"
         ];

         var anillo = [
            "BAL DEL TEJAR",

         ];

         var transversal = [
            "METROPOLITANA",
            "72 CIRCUN",
            "ORIENTAL",
            "C METROPOLITANA"

         ];

         $(document).ready(function(){


         $('#DM01').change(function() {
           
            // $('#DD00').tooltip('show');

            var input8 = document.getElementById('DM01').value;
            console.log(input8);

            if (input8 == 'BL') {

               $("#DD02").autocomplete({
                  source: availableTags
               });


            } else if (input8 == 'A') {

               $("#DD02").autocomplete({
                  source: avenidas
               });

            } else if (input8 == 'ANILLO') {

               $("#DD02").autocomplete({
                  source: anillo
               });

            } else if (input8 == 'T') {
               $("#DD02").autocomplete({
                  source: transversal
               });
            } else {

            }

         });

         $('#DD07').change(function() {

            var input10 = document.getElementById('DD07').value;

            if (input10 == 'CS' || input10 == 'AP' || input10 == 'LO' || input == 'LT') {

               $('.caja_ultima').css('display', 'block');

            } else {
               $('.caja_ultima').css('display', 'none');

            }



         }) 
         $('#button-modal').click(function(){
          let formDir = document.getElementById('formDirecciones');
          formDir.reset();
         });
         
         $('#formDirecciones').submit(function(e){
           e.preventDefault();
           let dir = document.getElementById('DD00').value;
           $('#modalDirecciones').modal('hide');
           document.getElementById('direccion_busqueda').value = dir;         

           

         });
         $("#unidad").select2({
         width: "resolve",
        placeholder: "Seleccione una opción..",
    });
         
        });      
       
     </script>
     @endpush
@endsection
