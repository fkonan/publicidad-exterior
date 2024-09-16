@extends('layouts.menu')

@section('dashboard')
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
                                <a style="color: #004fbf;" class="breadcrumb-text" href="{{ route('reportes.index') }}">
                                    Reportes</a>
                            </div>
                        </li>
                        <li class="breadcrumb-item ">
                            <div class="image-icon">
                                <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                                <p class="ml-3 ml-md-0 "><b style="color: #004fbf;text-transform: none;">
                                        Familia Lactante
                                    </b></p>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="col-md-12 pt-4" style="padding-left: 10px!important">
            <h1 class="headline-xl-govco">Tablero Salas Amigas de la Familia Lactante en el Entorno Laboral</h1>
            <div class="row pt-5">

                <div class="col-md-12">
                    <div style="height: 200px">
                        <canvas id="myChart" width="200" height="200"></canvas>
                    </div>
                </div>
                <div class="col-md-3 pl-0 mr-0">
                    <a class="btn btn-round btn-high" href="{{ URL::route('reportes.index') }}"
                        style="float: left;">Volver</a>
                </div>



            </div>
        </div>



    </div>
    @push('reportes')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.2/chart.min.js"
            integrity="sha512-zjlf0U0eJmSo1Le4/zcZI51ks5SjuQXkU0yOdsOBubjSmio9iCUp8XPLkEAADZNBdR9crRy3cniZ65LF2w8sRA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>


        <script>
            var familia = {!! json_encode($query, JSON_HEX_TAG) !!};           
            
            const ctx = document.getElementById('myChart').getContext('2d');
            const chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Empresas Registradas'],
                    datasets: [{
                        label: 'Salas Amigas de la Familia Lactante',
                        data: [familia[0].solicitudes],
                        borderColor: 'rgba(230, 239, 253, 1)' ,
                        backgroundColor: 'rgba(141, 236, 103)'
                    }],
                },
                options: {
                    indexAxis: 'y', // <-- here
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        </script>
    @endpush
@endsection
