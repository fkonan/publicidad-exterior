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
                                Categorización de parqueaderos
                                </b></p>
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
                    <div class="card step-progress border-0" style="font-size: 10px;">
                        <div class="step-slider">
                            <!--<div data-id="step1" class="step-slider-item active" ><p style="padding-top: 0px;margin-top:5px;"></p></div>-->
                            <div data-id="step2" class="step-slider-item active">
                                <p style="padding-top: 0px;margin-top:5px;color: #BABABA;" id="barra_progreso"><span
                                        class="circle_cero">1</span> Inicio</p>
                            </div>
                            <div data-id="step3" class="step-slider-item active">
                                <p style="padding-top: 0px;margin-top:5px;color: #BABABA" id="barra_progreso"><span
                                        class="circle_cero">2 </span> Hago mi solicitud</p>
                            </div>
                            <div data-id="step4" class="step-slider-item">
                                <p style="padding-top: 0px;margin-top:5px;;color: #3366CC" id="barra_progreso"><span
                                        class="circle_uno">3</span>Procesan mi solicitud</p>
                            </div>
                            <div data-id="step5" class="step-slider-item">
                                <p style="padding-top: 0px;margin-top:5px; color: #4B4B4B" id="barra_progreso"><span
                                        class="circle_dos">4</span> Respuesta</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">

                <div class="alert-success-govco alert alert-dismissible fade show animate__animated animate__bounceInRight" aria-label="Alerta: caso de éxito">
                     <div class="alert-heading">
                      <span class="govco-icon govco-icon-check-cn size-2x"></span>
                      <span class="headline-l-govco">Tu solicitud se realizo correctamente</span>
                      
                    </div>
                    <p>Apreciado Ciudadano, su solicitud ha sido recibida satisfactoriamente para consultar el estado de sus solicitud tenga en cuenta el siguiente numero de radicado: <strong> {{session('radicado_id')}}</strong></p>
                    <p><strong>Duracion:</strong> 30 dias</p>
                  </div>


            </div>
            <div class="col-md-4">
                <button style="font-size:15px;" type="button" class="btn btn-round btn-middle" name="consultar"><a href="{{URL::route('parqueaderos.finalizar')}}">Finalizar</a></button>


            </div>
        </div>
    </div>

</div>
<script>
    setTimeout(function() {
      window.location.href = '/categorizacion-parqueaderos/finalizar';
   }, 120000);
</script>
@else

<script>
    window.location = '/categorizacion-parqueaderos';
</script>




@endif


@endsection