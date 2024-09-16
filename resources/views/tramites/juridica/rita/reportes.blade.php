@extends('layouts.menu')

@section('dashboard')
    <style>
        th.sorting_desc::after,
        th.sorting_asc::after {
            right: 0 !important;
            content: "" !important;
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
                                <a style="color: #004fbf;" class="breadcrumb-text" href="#">Tramites en Linea</a>
                            </div>
                        </li>
                        <li class="breadcrumb-item ">
                            <div class="image-icon">
                                <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                                <a style="color: #004fbf;" class="breadcrumb-text" href="#">
                                    Juridica</a>
                            </div>
                        </li>
                        <li class="breadcrumb-item ">
                            <div class="image-icon">
                                <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                                <p class="ml-3 ml-md-0 "><b style="color: #004fbf;text-transform: none;">
                                        Canal de denuncia RITA
                                    </b></p>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-md-12 pt-4" style="padding-left: 10px!important">
            <h1 class="headline-xl-govco">Reportes</h1>
            <div class="row pt-5">
                <div class="tabs-govco col-md-12 animate__animated animate__bounceInRight">
                    <form method="POST" action="{{route('tramites.juridica.reports')}}" id="formReport">
                        @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="estado">Estado de la solicitud</label>
                                <select
                                    class="form-control  @error('estado_solicitud') is-invalid @enderror"
                                    name="estado_solicitud" id="estado_solicitud">
                                    <option value="">Seleccione</option>
                                    <option value="RADICADA">RADICADA</option>
                                    <option value="CONTESTADA">ATENDIDA</option>
                                    <option value="REMITIDA POR COMPETENCIA">REMITIR POR
                                        COMPETENCIA</option>
                                    <option value="NO CONTESTADA">RECHAZADA</option>

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
                                <input value="{{old('radicado')}}" type="text" class="form-control razon_social  @error('radicado') is-invalid @enderror info_general" name="radicado" id="radicado"  maxlength="10" minlength="4" onkeypress="return NumDoc(event)" placeholder="Ej: 2022251017">
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
                        <div class="col-md-4 ">
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
                        <div class="col-md-4">
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <button  type="submit" class="btn btn-round btn-high-mix-govco"><span class="govco-icon govco-icon-search-cn text-white"></span>
                                    <span class="btn-govco-text text-white">Buscar</span>
                                  </button>
                            </div>
                        </div>
                    </div>
                    
                </form>
                <div class="col-md-3 pl-0 mr-0">
                    <a class="btn btn-round btn-high" href="{{ URL::route('juridica.rita.main') }}"
                        style="float: left;">Volver</a>
                </div>

                </div>
                  

                    
                </div>





            </div>
        </div>



    </div>
@endsection
