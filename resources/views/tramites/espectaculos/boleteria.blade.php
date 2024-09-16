@extends('layouts.app')

@section('content')

@if($solicitud->estado_solicitud == 'EVENTO_REALIZADO')

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
                                        Espectáculos públicos
                                        </b></p>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

                 <div class="col-md-12 pt-4">
                    <h1 class="headline-xl-govco">Detalle de solicitudes</h1>
                    <div class="row pt-5">
                    <div class="col-md-12 justify-content-center">
                  <form method="POST" action="{{route('espectaculo.updateCer')}}"  enctype="multipart/form-data" id="myForm">
                     @csrf
                     <input type="hidden" name="id" value="{{$solicitud->id}}">
                    <div class="card govco-card animate__animated animate__bounceInRight">
                        <div class="card-header govco-card-header">
                            <span class="govco-icon govco-icon-analytic size-3x pr-3"> </span>
                         Solicitud N°- {{$solicitud->radicado}} 
                        </div>

                        <div class="card-body">
                        <div class="row">
                         <div class="col-md-6">  
                        <div class="form-group">
                        <label>Nombre del solicitante</label>
                         <input type="text" class="form-control" value="{{$solicitud->nombre_o_razon}}" readonly>
                       </div>
                       </div>

                        <div class="col-md-6">  
                        <div class="form-group">
                        <label>Estado de la Solicitud</label>
                         <input type="text" class="form-control" value="{{$solicitud->estado_solicitud}}" readonly>
                       </div>
                       </div>

                       <div class="col-md-6">  
                        <div class="form-group">
                        <label>Observaciones de la solicitud</label>
                        <textarea rows="4" class="form-control" disabled>{{$solicitud->observaciones}}</textarea>
                        
                       </div>
                       </div>

                       <div class="col-md-6">  
                        <div class="form-group">
                        <label>Fecha de actuación</label>
                         <input type="text" class="form-control" value="{{$solicitud->fecha_actuacion}}" readonly>
                       </div>
                       </div>
                       
                       <div class="col-md-12">
                           <h5>Estado de Pago</h5>
                       <div class="table-simple-headblue-govco">
                        <table class="table display table-responsive-sm table-responsive-md" style="width:100%"
                            id="tablaEstadoPago">
                            <thead>
                                <tr>
                                    <th>Radicado de Pago</th>
                                    <th>Dia del evento a Declarar</th>
                                    <th>Fecha limite de Declaración y Pago</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fechas as $fecha)
                                <tr>
                                    <td>{{$fecha->radicado_pago}}</td>
                                    <td>{{$fecha->fecha_liquidacion}}</td>
                                    <td class="text-danger">{{$fecha->fecha_limite_liquidacion}} </td>
                                    <td class="text-success">{{$fecha->estado}}</td>
                                </tr>                                        
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

                      


                     

                       @if($solicitud->estado_solicitud == 'EVENTO_REALIZADO')                        
                        
                       <div class="col-md-12">
                           <h5>Cargue el certificado de boleteria vendida &nbsp;&nbsp;<small></small></h5>
                        @if($solicitud->estado_documentos!=null)
                         
                        <h5 class="text-danger">Usted ya realizo el cargue de un documento anteriormente</h5>
                        
                        @endif
                        
                       </div>

                       <div class="col-md-6 pl-1 pr-1 pt-3">
                        <label for="arch_certificacion_boleteria_vendida" class="form-label">Certificación de Boleteria Vendida* <br><small class="text-danger"
                                style="font-size: 11px!important">Solo se permiten archivos .pdf con un tamaño
                                máximo de 10MB</small> </label>
                        <div class="form-group">
                            <div class="file-loading">
                                <input class=" @error('arch_certificacion_boleteria_vendida') is-invalid @enderror documentos_adjuntos"
                                    id="arch_certificacion_boleteria_vendida" accept="application/pdf" name="arch_certificacion_boleteria_vendida" type="file"
                                    data-overwrite-initial="true" required>
                                @error('arch_certificacion_boleteria_vendida')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    
                       <div class="col-md-12">
                           <div class="form-group">
                               <button type="submit"  onclick="return confirm('¿Esta seguro de subir este documento ?')"  class="btn btn-round btn-middle btn-outline-info"  id="Boton">Cargar Documento</button>
                           </div>
                       </div>                    
               
                 @endif
                        </div>
                        </div> 
                        <div class="card-footer">
                            <div class="col-md-3">
                                <a class="btn btn-round btn-high" href="{{ URL::route('espectaculos.index') }}" style="float: left;">Volver</a>
                            </div> 
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
                            


                         




        </div>

@else
<script>
    alert('Usted ya realizo la liquidacion')
    window.location = '/espectaculos-publicos';
</script>

@endif

@endsection