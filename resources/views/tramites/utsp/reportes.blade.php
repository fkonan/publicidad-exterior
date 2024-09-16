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
            overflow-x: hidden !important;
        }
        .selectCustomize + .select2-container {
            margin-top: 10px!important;
        }

       
    </style>


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
                                <a style="color: #004fbf;" class="breadcrumb-text" href="{{ route('utsp.index') }}">UTSP</a>
                            </div>
                        </li>
                        <li class="breadcrumb-item ">
                            <div class="image-icon">
                                <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                                <p class="ml-3 ml-md-0 "><b style="color: #004fbf;text-transform: none;">
                                        Reportes UTSP
                                    </b></p>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-md-12 pt-4" style="padding-left: 10px!important">
            <h1 class="headline-xl-govco">Reportes UTSP</h1>
            {{-- <p>Ir a Tablero de control<a class="btn btn-link text-info" href="{{route('planeacion.uso.tablero')}}">Clic Aqui</a></p> --}}
            <div class="row pt-5">
                <div class="tabs-govco col-md-12 animate__animated animate__bounceInRight">
                    <form method="POST" action="{{route('utsp.search.UTSP')}}" id="formSearchUTSP">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mt-2">
                                <div class="form-group">
                                    <label for="empresa_publica" class="form-label">Empresa de Servicios Publicos </label>
                                    <select name="empresa_publica" id="empresa_publica"
                                        class="form-control  @error('empresa_publica') is-invalid  @enderror">
                                        <option value="">Seleccione..</option>
                                        @foreach ($empresas as $key => $value)
                                            <option value="{{ $value }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('empresa_publica')
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 d-none" id="divOtherCompany">
                                <label for="otra_empresa" class="form-label">Otra empresa de servicios publicos* </label>
                                <input value="{{ old('otra_empresa') }}" type="text"
                                    class="form-control  @error('otra_empresa') is-invalid @enderror" name="otra_empresa"
                                    id="otra_empresa" maxlength="40" minlength="4" onkeypress="return Letras(event)"
                                    onkeyup="aMayusculas(this.value,this.id)" tabindex="10"
                                    placeholder="Ej: Empresa de Aseo ....">
                                @error('observacion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="estado">Usuario</label>
                                    <select name="usuarios" id="usuarios"
                                        class="form-control selectCustomize  @error('usuarios') is-invalid  @enderror">
                                        <option value="">Seleccione..</option>
                                        @foreach ($usuarios as $user)
                                            <option value="{{ $user->numero_documento }}"> {{ $user->numero_documento }} -
                                                {{ $user->apellido_usuario }} {{ $user->nombre_usuario }} </option>
                                        @endforeach
                                    </select>
                                    @error('usuarios')
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                           
                            <div class="col-md-3">
                                <div class="form-group">
                                        <label for="radicado" class="form-label">Radicado </label>
                                        <input value="{{old('radicado')}}" type="text" class="form-control  @error('radicado') is-invalid @enderror" name="radicado" id="radicado"  maxlength="60" minlength="4"  onkeypress="return NumDoc(event)" onkeyup="aMayusculas(this.value,this.id)"  placeholder="Ej: UTSP-0001">
                                        @error('radicado')
                                        <span class="invalid-feedback" role="alert">
                                           <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="barrio" class="form-label">Barrio </label>
                                    <select name="barrio" id="barrio" class="form-control barrioUtsp @error('barrio') is-invalid  @enderror">
                                        <option value=""></option>
                                        @foreach ($Barrios as $barrio)
                                        <option value="{{$barrio->codigo}}">{{$barrio->nombre}}</option>
                                            
                                        @endforeach
                                    </select>
                                     @error('barrio')
                                     <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                         </span>
                                     @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tipo_atencion" class="form-label">Tipo de Atencion </label>
                                <select name="tipo_atencion" id="tipo_atencion" class="form-control  @error('tipo_atencion') is-invalid  @enderror">
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
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tipo_servicio" class="form-label">Tipo de Servicio</label>
                                <select name="tipo_servicio" id="tipo_servicio" class="form-control  @error('tipo_servicio') is-invalid  @enderror">
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
                            </div>

                            {{-- <div class="col-md-4">
                            <div class="form-group">
                                <label for="estado">Identificacion</label>
                                <input value="{{old('identificacion')}}" type="text" class="form-control razon_social  @error('identificacion') is-invalid @enderror info_general" name="identificacion" id="identificacion" maxlength="15" minlength="4" onkeypress="return NumDoc(event)" placeholder="Ej: 1098716212">
                                @error('asunto')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="estado">Desde</label>
                                    <input value="{{ old('fecha_inicial') }}" type="date"
                                        class="form-control  @error('fecha_inicial') is-invalid @enderror info_general"
                                        name="fecha_inicial" id="fecha_inicial">
                                    @error('fecha_inicial')
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group pt-3">
                                    <label for="estado">Hasta</label>
                                    <input value="{{ old('fecha_final') }}" type="date"
                                        class="form-control  @error('fecha_final') is-invalid @enderror info_general"
                                        name="fecha_final" id="fecha_final" max="{{ date('Y-m-d') }}">
                                    @error('asunto')
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                           <div class="col-md-8">
                            <div class="form-group">
                            <label for="direccion_solicitante" class="form-label">Dirección o Nomenclatura del Ciudadano* </label><button type="button" class="btn btn-link"><span style="text-transform: lowercase; font-size: 12px;" class="text-primary" data-toggle="modal" id="button-modal" data-target="#ModalDirecciones" tabindex="20">(Clic para insertar direccion)</span></button>
                            <input type="text" value="{{old('direccion_solicitante')}}" class="form-control  @error('direccion_solicitante') is-invalid @enderror" name="direccion_solicitante" id="direccion_solicitante"  maxlength="120" readonly  placeholder="Ej: CARRERA 12 # 13-10">
                            @error('direccion_solicitante')
                            <span class="invalid-feedback" role="alert">
                               <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                           </div>
                            <div class="col-md-2 pt-3">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-round btn-high-mix-govco"><span
                                            class="govco-icon govco-icon-search-cn text-white"></span>
                                        <span class="btn-govco-text text-white">Buscar</span>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-4 pt-4">
                                <div class="form-group">
                                    <a class="btn btn-link" id="btnClean" href="">LIMPIAR BUSQUEDA <svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24">
                                            <path fill="#240bda"
                                                d="M16 11h-1V4c0-1.66-1.34-3-3-3S9 2.34 9 4v7H8c-2.76 0-5 2.24-5 5v5c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2v-5c0-2.76-2.24-5-5-5zm3 10h-2v-3c0-.55-.45-1-1-1s-1 .45-1 1v3h-2v-3c0-.55-.45-1-1-1s-1 .45-1 1v3H9v-3c0-.55-.45-1-1-1s-1 .45-1 1v3H5v-5c0-1.65 1.35-3 3-3h8c1.65 0 3 1.35 3 3v5z" />
                                        </svg></a>
                                </div>
                            </div>

                        </div>

                    </form>
                    <div class="col-md-3 pl-0 mr-0">
                        <a class="btn btn-round" href="{{ URL::route('utsp.index') }}"
                            style="float: left; background-color:#BABABA">Volver</a>
                    </div>

                </div>



            </div>





        </div>
    </div>

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



    

    @push('custom-scripts')
        <script>
            $(document).ready(function() {



                // $('#empresa').change(function() {

                //     let sede = document.getElementById('sede');
                //     let empresa_id = $(this).val();
                //     let option = document.createElement('option');
                //     $.ajax({
                //         type: "GET",
                //         url: `/tramites/salud/pgirh/getSedes/${empresa_id}`,
                //         dataType: "json",

                //         success: function(response) {
                //             if (response.success) {
                //                 sede.innerHTML = '';

                //                option.value = ''
                //                option.textContent =' Seleccione..'
                //                sede.appendChild(option);
                //                 response.sedes.forEach((el) => {
                //                     const optionElement = document.createElement("option");
                //                     optionElement.value = el.id;
                //                     optionElement.textContent = `${el.nombre_sede} - ${el.direccion}`;
                //                     sede.appendChild(optionElement);
                //                 })


                //             } else {
                //                 sede.innerHTML = '';
                //                 option.value = ''
                //                 option.textContent =' Seleccione..'
                //                 sede.appendChild(option);
                //                 return;

                //             }
                //         },
                //         error: function() {
                //             alert("error de petición ajax");
                //         },
                //     });


                // })

               

                $("#usuarios").select2({
                    width: "100%",
                    placeholder: "Seleccione una opción..",
                });
                $("#barrio").select2({
                    width: "100%",
                    placeholder: "Seleccione una opción..",
                });
                $('#empresa_publica').change(function(e) {
                    if ($(this).val() == 'Otra') {
                        $('#divOtherCompany').removeClass('d-none');
                        $('#otra_empresa').prop('required', true);
                    } else {
                        $('#otra_empresa').prop('required', false);
                        $('#divOtherCompany').addClass('d-none');

                    }
                });

                 $('#btnClean').click(function(e){
                    e.preventDefault();
                    $('.form-control').val(null).trigger('change');
                    $('.form-control').val('');








                })


            });
        </script>
    @endpush
@endsection
