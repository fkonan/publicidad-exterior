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
                                <a style="color: #004fbf;" class="breadcrumb-text" href="{{ route('general.index') }}">
                                    General</a>
                            </div>
                        </li>
                        <li class="breadcrumb-item ">
                            <div class="image-icon">
                                <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                                <p class="ml-3 ml-md-0 "><b style="color: #004fbf;text-transform: none;">
                                        Certificado de Predios del Municipio
                                    </b></p>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-md-12 pt-4" style="padding-left: 10px!important">
            <h1 class="headline-xl-govco">Certificado de Predios del Municipio</h1>
            <div class="row pt-5">
                <div class="tabs-govco col-md-12 animate__animated animate__bounceInRight">
                    <form method="POST" action="{{ route('tramites.general.certificado.search') }}" id="formCertificado">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
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
                            <div class="col-md-2 pt-1 mt-1">
                                <div class="form-group">
                                    <button style="background-color: #069169!important;" type="button"
                                        class="btn btn-round btn-high-mix-govco btnBuscar" id="btnBusqueda"><span
                                            class="govco-icon govco-icon-search-cn text-white btnBuscar"></span>
                                        <span class="btn-govco-text text-white btnBuscar">Buscar</span>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-3 pt-1 mt-3">
                                <div class="form-group">
                                    <a class="btn btn-link btnLimpiar" href="#" style="float: left;"
                                        id="btnLimpiar">Limpiar</a>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="estado">Numero de matricula Inmobiliaria</label>
                                    <input value="{{ old('matricula') }}" type="text"
                                        class="form-control  @error('matricula') is-invalid @enderror info_general"
                                        name="matricula" id="matricula" maxlength="10" minlength="4"
                                        onkeypress=" return NumDoc(event)" readonly>
                                    @error('matricula')
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-4 pt-1">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-round btn-high-mix-govco" id="btnGenerar"
                                        disabled><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                            viewBox="0 0 24 24">
                                            <path fill="#f1eeee"
                                                d="m14 2l6 6v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h8m4 18V9h-5V4H6v16h12m-6-1l-4-4h2.5v-3h3v3H16l-4 4Z" />
                                        </svg>
                                        <span class="btn-govco-text text-white">Generar Certificado</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </form>
                    <div class="col-md-2 pl-0 mt-5 mr-0">
                        <a class="btn btn-link" href="{{ URL::route('general.index') }}" style="float: left;">Volver</a>
                    </div>

                </div>



            </div>





        </div>
    </div>



    </div>


    @push('reportes')
        <script>
            document.addEventListener('click', (e) => {
                if (e.target.matches('.btnBuscar')) {
                    const numeroRegex = /^[0-9]{10,15}$/;
                    let numero_predial = document.getElementById('numero_predial');
                    if (numero_predial.value == '' || numero_predial.value == undefined) {
                        Swal.fire(
                            'Atencion!!',
                            'El campo de numero predial es requerido, para realizar la consulta',
                            'warning'
                        );
                        return false;
                    }
                    if (numeroRegex.test(numero_predial.value)) {

                        fetch(`/tramites/general/${numero_predial.value}`)
                            .then(response => {
                                if (response.status === 200) {
                                    return response.json();
                                } else {
                                    throw new Error('La petición no fue exitosa');
                                }
                            })
                            .then(data => {

                                if (data.success) {
                                    document.getElementById('btnBusqueda').disabled = true;
                                    document.getElementById('btnGenerar').disabled = false;
                                    numero_predial.readOnly = true;
                                    document.getElementById('matricula').value = data.datos[0].AFPreMatriculaInmo;


                                } else {
                                    Swal.fire(
                                        'Atencion!!',
                                        `la consulta para el predial : ${numero_predial.value} no fue exitosa, Acércate a la Oficina DEL DADEP 3° Piso FASE I para solicitar tu certificado `,
                                        'error'
                                    )
                                    numero_predial.value = '';

                                }

                            })
                            .catch(error => {
                                // Manejo de errores
                                console.error('Error:', error);
                            });



                    } else {
                        Swal.fire(
                            'Atencion!! Formato invalido',
                            'Recuerda que el numero predial deben ser solo numeros y  un maximo de 15 caracteres',
                            'warning'
                        )

                        return false;
                    }

                }
                if (e.target.matches('.btnLimpiar')) {
                    e.preventDefault();
                    document.getElementById('btnBusqueda').disabled = false;
                    document.getElementById('btnGenerar').disabled = true;
                    document.getElementById('numero_predial').readOnly = false;
                    document.getElementById('numero_predial').value = '';
                    document.getElementById('matricula').value = ''

                }
            })
            document.getElementById('formCertificado').addEventListener('submit', function(e) {
                setTimeout(() => {
                    Swal.fire(
                        'Exitoso!!',
                        'Certificado generado exitosamente',
                        'success'
                    )
                    document.getElementById('btnBusqueda').disabled = false;
                    document.getElementById('btnGenerar').disabled = true;
                    document.getElementById('numero_predial').readOnly = false;
                    document.getElementById('numero_predial').value = '';
                    document.getElementById('matricula').value = ''
                    
                }, 3000);

            })
        </script>
    @endpush
@endsection
