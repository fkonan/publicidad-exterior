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
                            <a style="color: #004fbf;" class="breadcrumb-text" href="{{route('salud.index')}}">
                                Salud</a>
                        </div>
                    </li>
                    <li class="breadcrumb-item ">
                        <div class="image-icon">
                            <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                            <a style="color: #004fbf;" class="breadcrumb-text" href="{{route('salud.pgirh.index')}}">
                                Formulario RH1</a>
                        </div>
                    </li>
                    <li class="breadcrumb-item ">
                        <div class="image-icon">
                            <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                            <p class="ml-3 ml-md-0 "><b style="color: #004fbf;text-transform: none;">
                                    REPORTES RH1
                                </b></p>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="col-md-12 pt-4" style="padding-left: 10px!important">
        <h1 class="headline-xl-govco">Reportes RH1</h1>
        {{-- <p>Ir a Tablero de control<a class="btn btn-link text-info" href="{{route('planeacion.uso.tablero')}}">Clic Aqui</a></p> --}}
        <div class="row pt-5">
            <div class="tabs-govco col-md-12 animate__animated animate__bounceInRight">
                <form method="POST" action="{{route('tramites.pghir.rh1.reportes')}}" id="formReportRH1">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <div class="form-group">
                                <label for="estado">Empresa</label>
                                <select class="form-control  @error('empresa') is-invalid @enderror" name="empresa" id="empresa">
                                    <option value="">Seleccione</option>
                                    @foreach ($empresas as $empresa)
                                    <option value="{{$empresa->id}}">{{$empresa->razon_social}}- {{$empresa->nit}}</option>
                                    @endforeach


                                </select>
                                @error('empresa')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="estado">Sedes</label>
                                <select class="form-control  @error('sede') is-invalid @enderror" name="sede" id="sede">
                                 <option value="">Seleccione..</option>
                                </select>
                                @error('sede')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="estado">Vigencia</label>
                                <select class="form-control  @error('year') is-invalid @enderror" name="year" id="year" >
                                    <option value="">Seleccione..</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                   
                                   </select>
                                   @error('year')
                                   <span class="invalid-feedback" role="alert">
                                       <strong class="text-danger">{{ $message }}</strong>
                                   </span>
                                   @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="estado">Semestre</label>
                                <select class="form-control  @error('semestre') is-invalid @enderror" name="semestre" id="semestre">
                                    <option value="">Seleccione..</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>                                   
                                   
                                   </select>
                                   @error('semestre')
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
                                <input value="{{old('fecha_inicial')}}" type="date" class="form-control  @error('fecha_inicial') is-invalid @enderror info_general" name="fecha_inicial" id="fecha_inicial">
                                @error('fecha_inicial')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="estado">Hasta</label>
                                <input value="{{old('fecha_final')}}" type="date" class="form-control  @error('fecha_final') is-invalid @enderror info_general" name="fecha_final" id="fecha_final" max="{{date('Y-m-d')}}">
                                @error('asunto')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>                        
            <div class="col-md-2 pt-3">
                <div class="form-group">
                    <button type="submit" class="btn btn-round btn-high-mix-govco"><span class="govco-icon govco-icon-search-cn text-white"></span>
                        <span class="btn-govco-text text-white">Buscar</span>
                    </button>
                </div>
            </div>
            <div class="col-md-4 pt-4">
                <div class="form-group">
                    <a class="btn btn-link" id="btnClean" href="">LIMPIAR BUSQUEDA <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="#240bda" d="M16 11h-1V4c0-1.66-1.34-3-3-3S9 2.34 9 4v7H8c-2.76 0-5 2.24-5 5v5c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2v-5c0-2.76-2.24-5-5-5zm3 10h-2v-3c0-.55-.45-1-1-1s-1 .45-1 1v3h-2v-3c0-.55-.45-1-1-1s-1 .45-1 1v3H9v-3c0-.55-.45-1-1-1s-1 .45-1 1v3H5v-5c0-1.65 1.35-3 3-3h8c1.65 0 3 1.35 3 3v5z"/></svg></a>
                </div>
            </div>
            
        </div>

        </form>
        <div class="col-md-3 pl-0 mr-0">
            <a class="btn btn-round" href="{{ URL::route('salud.pgirh.index') }}" style="float: left; background-color:#BABABA">Volver</a>
        </div>

    </div>



</div>





</div>
</div>



</div>

@push('custom-scripts')
<script>
    $(document).ready(function() {



        $('#empresa').change(function() {

            let sede = document.getElementById('sede');
            let empresa_id = $(this).val();
            let option = document.createElement('option');
            $.ajax({
                type: "GET",
                url: `/tramites/salud/pgirh/getSedes/${empresa_id}`,
                dataType: "json",

                success: function(response) {
                    if (response.success) {
                        sede.innerHTML = '';
                       
                       option.value = ''
                       option.textContent =' Seleccione..'
                       sede.appendChild(option);
                        response.sedes.forEach((el) => {
                            const optionElement = document.createElement("option");
                            optionElement.value = el.id;
                            optionElement.textContent = `${el.nombre_sede} - ${el.direccion}`;
                            sede.appendChild(optionElement);
                        })


                    } else {
                        sede.innerHTML = '';
                        option.value = ''
                        option.textContent =' Seleccione..'
                        sede.appendChild(option);
                        return;

                    }
                },
                error: function() {
                    alert("error de petición ajax");
                },
            });


        })

        $('#btnClean').click(function(e){
            e.preventDefault();
            location.reload();
            



            
        })

       
        $("#empresa").select2({
            width: "100%",
            placeholder: "Seleccione una opción..",
        });

    });
</script>
@endpush
@endsection