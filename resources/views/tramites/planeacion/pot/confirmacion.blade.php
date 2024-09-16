@extends('layouts.app')

@section('content')

@if (Session::has('radicado_id'))  


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
                            <a style="color: #004fbf;" class="breadcrumb-text" href="#">Tramites y servicios</a>
                        </div>
                    </li>
                    <li class="breadcrumb-item ">
                        <div class="image-icon">
                            <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                            <p class="ml-3 ml-md-0 "><b style="color: #004fbf;text-transform: none;">
                                Planeación
                                </b></p>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row mt-2">
           
            <div class="col-md-12">

                <div class="alert-success-govco alert alert-dismissible fade show animate__animated animate__bounceInRight" aria-label="Alerta: caso de éxito">
                     <div class="alert-heading">
                      <span class="govco-icon govco-icon-check-cn size-2x"></span>
                      <span class="headline-l-govco">Gracias por tu Opinion</span>
                      
                    </div>
                    <p>Apreciado Ciudadano, tendremos en cuenta tu aporte. Planeando construimos Ciudad y territorio.</strong></p>
                  </div>


            </div>
            <div class="col-md-4">
                <button style="font-size:15px;" type="button" class="btn btn-round btn-middle" name="consultar"><a href="https://www.bucaramanga.gov.co/pot-bga/">Finalizar</a></button>


            </div>
        </div>
    </div>

</div>
<script>
    setTimeout(function() {
      window.location.href = 'https://www.bucaramanga.gov.co/pot-bga/';
   }, 120000);
</script>
@else

<script>
    window.location = 'https://www.bucaramanga.gov.co/pot-bga/';
</script>




@endif


@endsection