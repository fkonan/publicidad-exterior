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
                                <a style="color: #004fbf;" class="breadcrumb-text" href="{{route('general.index')}}">
                                    General</a>
                            </div>
                        </li>
                        <li class="breadcrumb-item ">
                            <div class="image-icon">
                                <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                                <p class="ml-3 ml-md-0 "><b style="color: #004fbf;text-transform: none;">
                                        Certificado de predios del Municipio
                                    </b></p>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-md-12 pt-4" style="padding-left: 10px!important">
            <h1 class="headline-xl-govco">Reportes de Certificado de Predios</h1>
             {{-- <p>Ir a Tablero de control<a class="btn btn-link text-info" href="{{route('planeacion.uso.tablero')}}">Clic Aqui</a></p> --}}
            <div class="row pt-5">
                <div class="tabs-govco col-md-12 animate__animated animate__bounceInRight">
                    <form method="POST" action="{{route('tramites.general.certificado.query')}}" id="formReportCertificado">
                        @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="estado">Numero Predial*</label>
                                <input value="{{ old('numero_predial') }}" type="text"
                                    class="form-control  @error('numero_predial') is-invalid @enderror"
                                    name="numero_predial" id="numero_predial" maxlength="15" minlength="4"
                                    onkeypress="return Numeros(event)" placeholder="Ej: 010100010001000">
                                @error('numero_predial')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="estado">Numero de matricula Inmobiliaria</label>
                                <input value="{{ old('matricula') }}" type="text"
                                    class="form-control  @error('matricula') is-invalid @enderror"
                                    name="matricula" id="matricula_inmobiliaria" maxlength="10" minlength="4"
                                    onkeypress=" return NumDoc(event)" placeholder="300-379588">
                                @error('matricula')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="estado">Radicado</label>
                                <input value="{{old('radicado')}}" type="text" class="form-control razon_social  @error('radicado') is-invalid @enderror info_general" name="radicado" id="radicado"  maxlength="20" minlength="4" onkeypress="return NumDoc(event)" placeholder="Ej: CP-0001">
                                @error('radicado')
                                <span class="invalid-feedback" role="alert">
                                   <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="estado">Direccion</label>
                                <input value="{{old('direccion')}}" type="text" class="form-control razon_social  @error('direccion') is-invalid @enderror info_general" name="direccion" id="direccion"  maxlength="100" minlength="4" onkeypress="return Direccion(event)" placeholder="Ej: Lote LOTE DE TERRENO CESIÓN TIPO A">
                                @error('direccion')
                                <span class="invalid-feedback" role="alert">
                                   <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
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
                        <div class="col-md-3">
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
                               <label for="estado">Secretaria y/O Oficina</label>
                               <select
                                   class="form-control  @error('secretaria') is-invalid @enderror"
                                   name="secretaria" id="secretaria">
                                   <option value="">Seleccione</option>
                                   @foreach ($secretarias as $clave => $valor)
                                       <option value="{{$valor}}">{{$valor}}</option>
                                   @endforeach
                                                                    

                               </select>
                               @error('secretaria')
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
                    <a class="btn btn-round btn-high" href="{{ URL::route('general.index') }}"
                        style="float: left;">Volver</a>
                </div>

                </div>
                  

                    
                </div>





            </div>
        </div>



    </div>
    
     @push('reportes')     
     <script>
        
         $("#secretaria").select2({
         width: "resolve",
        placeholder: "Seleccione una opción..",
    });
         
          
       
     </script>
     @endpush
@endsection
