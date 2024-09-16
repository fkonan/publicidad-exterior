@extends('layouts.app')

@section('content')

    <style type="text/css">
    .card-footer{
        background-color:transparent!important;
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

                 <div class="col-md-12 pt-4">
                    <h1 class="headline-xl-govco">Detalle de solicitudes</h1>
                    <div class="row pt-5">
                    <div class="col-md-12 justify-content-center">
                  <form method="POST" action="{{route('discapacidad.updateDocs')}}"  enctype="multipart/form-data" id="myForm">
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
                         <input type="text" class="form-control" value="{{$solicitud->nom_solicitante}} {{$solicitud->ape_solicitante}}" readonly>
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
                        <textarea rows="4" class="form-control" disabled>{{$solicitud->observaciones_solicitud}}</textarea>
                        
                       </div>
                       </div>

                       <div class="col-md-6">  
                        <div class="form-group">
                        <label>Fecha de actuacion</label>
                         <input type="text" class="form-control" value="{{$solicitud->fecha_actuacion}}" readonly>
                       </div>
                       </div>

                       @if($solicitud->estado_solicitud == 'RECHAZADA')
                       
                       <div class="col-md-12"><h6>Atención!!</h6><p>SU SOLICITUD FUE RECHAZADA EL DIA : {{$solicitud->updated_at}}</p></div> 

                    

                       @elseif($solicitud->estado_solicitud == 'APROBADA')
                       
                       <div class="col-md-6">  
                        <div class="form-group">
                        <h5>Acto de respuesta</h5>
                          <a href="/{{$solicitud->adj_certificado}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                       </div>
                       </div>                       

                     

                       @elseif($solicitud->estado_solicitud == 'PENDIENTE' && $solicitud->act_documentos == null)                        
                        
                       <div class="col-md-12">
                           <h5>Cargue sus archivos pendientes <small>Faltan {{$diff}} dia(s) para el vencimiento del plazo</small></h5>

                        
                       </div>

                        <div class="col-md-4">  
                        <div class="form-group">
                            <label for="archivo_documento" class="form-label">Copia Documento de Identidad <br> <small class="text-danger"  style="font-size: 11px!important">Solo se permiten archivos .pdf con un tamaño máximo de 10MB</small> </label>                        
                            <div class="file-loading">
                            <input class="documentos_adjuntos" id="archivo_documento" accept="application/pdf" name="archivo_documento" type="file" data-overwrite-initial="true" >    
                         </div>
                       </div>
                    </div>

                       
                       <div class="col-md-4">  
                        <div class="form-group">
                            <label for="archivo_recibo" class="form-label">Copia Recibo Servicios Publicos <br> <small class="text-danger"  style="font-size: 11px!important">Solo se permiten archivos .pdf con un tamaño máximo de 10MB</small> </label>
                        <div class="file-loading">
                            <input class=" documentos_adjuntos" id="archivo_recibo" accept="application/pdf" name="archivo_recibo" type="file" data-overwrite-initial="true">
                        </div>                         
                       </div>
                       </div>
                      

                        <div class="col-md-4">  
                        <div class="form-group">
                            <label for="archivo_historia_clinica" class="form-label">Historia Clinica Ciudadano <br> <small class="text-danger"  style="font-size: 11px!important">Solo se permiten archivos .pdf con un tamaño máximo de 10MB</small></label>
                        <div class="file-loading">
                            <input class="documentos_adjuntos" id="archivo_historia_clinica" accept="application/pdf" name="archivo_historia_clinica" type="file" data-overwrite-initial="true"> 
                        </div>                         
                       </div>
                       </div>
                         
                       <div class="col-md-4">
                           <div class="form-group">
                               <button type="submit"  onclick="return confirm('¿Esta seguro de actualizar los documentos ?')"  class="btn btn-round btn-middle btn-outline-info"  id="Boton">Actualizar documentos</button>
                           </div>
                       </div>
                  
                @elseif($solicitud->estado_solicitud == 'ACTUALIZADA')
                <div class="col-md-12"><h6>Atención!!</h6><p>SU SOLICITUD SE ENCUENTRA EN TRAMITE DESPUES DE ACTUALIZAR LOS DOCUMENTOS EL DIA : {{$solicitud->updated_at}}</p></div> 

                @elseif($solicitud->estado_solicitud=='RADICADA')                                        
                <div class="col-md-12"><h6>Atención!!</h6><p>SU SOLICITUD SE ENCUENTRA EN TRAMITE</p></div> 

                 @endif
                        
                        </div> 
                        <div class="card-footer" style="background-color:tras;">
                            <div class="col-md-3">
                                <a class="btn btn-round btn-high" href="{{ URL::route('discapacidad.index') }}" style="float: left;">Volver</a>
                            </div> 
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
                            


                         




        </div>

@endsection