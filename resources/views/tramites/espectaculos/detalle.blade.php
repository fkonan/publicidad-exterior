@extends('layouts.app')

@section('content')


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
                  <form method="POST" action="{{route('espectaculo.updateDocs')}}"  enctype="multipart/form-data" id="myForm">
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

                       @if($solicitud->estado_solicitud == 'RECHAZADA')
                       
                       <div class="col-md-6">  
                        <div class="form-group">
                        <h5>Viabilidad Técnica</h5>
                          <a href="http://tramitesenlinea.test/{{$solicitud->adjunto_resPlaneacion}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                       </div>
                       </div>

                       @endif



                       @if($solicitud->estado_solicitud == 'EVENTO_APROBADO')
                       
                       <div class="col-md-6">  
                        <div class="form-group">
                        <h5>Acto administrativo de aprobación de evento</h5>
                          <a href="https://tramitesenlineapruebas.bucaramanga.gov.co/{{$solicitud->adj_acto_administrativo}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                       </div>
                       </div>

                       @endif

                       @if($solicitud->estado_solicitud == 'ACTO_REVOCADO')
                       
                       <div class="col-md-6">  
                        <div class="form-group">
                        <h5>Acto administrativo revocatorio</h5>
                          <a href="https://tramitesenlineapruebas.bucaramanga.gov.co/{{$solicitud->adj_acto_revocatorio}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                       </div>
                       </div>

                       @endif

                       {{-- AQUI VA APROBADA --}}

                       @if($solicitud->estado_solicitud == 'PENDIENTE' && $solicitud->act_documentos == null)                        
                        
                       <div class="col-md-12">
                           <h5>Cargue sus archivos pendientes <small>Faltan {{$diff}} dia(s) para el vencimiento del plazo</small></h5>

                        
                       </div>

                       <div class="col-md-6 pl-1 pr-1 pt-3">
                        <label for="archivo_rut" class="form-label">RUT <br><small class="text-danger"
                                style="font-size: 11px!important">Solo se permiten archivos .pdf con un tamaño
                                máximo de 10MB</small> </label>
                        <div class="form-group">
                            <div class="file-loading">
                                <input class=" @error('archivo_rut') is-invalid @enderror documentos_adjuntos"
                                    id="archivo_rut" accept="application/pdf" name="archivo_rut" type="file"
                                    data-overwrite-initial="true">
                                @error('archivo_rut')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 pl-1 pr-1 pt-3">
                        <label for="archivo_camara" class="form-label">Camara de Comercio <br><small
                                class="text-danger" style="font-size: 11px!important">Solo se permiten archivos
                                .pdf con un tamaño máximo de 10MB</small> </label>
                        <div class="form-group">
                            <div class="file-loading">
                                <input class=" @error('archivo_camara') is-invalid @enderror documentos_adjuntos"id="archivo_camara" accept="application/pdf" name="archivo_camara" type="file"  data-overwrite-initial="true">
                                @error('archivo_camara') <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                      

                    <div class="col-md-6 pl-1 pr-1 pt-3">
                        <label for="archivo_boleteria" class="form-label">Certificacion Boleteria <br> <small
                                class="text-danger" style="font-size: 11px!important">Solo se permiten archivos
                                .pdf con un tamaño máximo de 10MB</small> </label>
                        <div class="form-group">
                            <div class="file-loading">
                                <input
                                    class=" @error('archivo_boleteria') is-invalid @enderror documentos_adjuntos"
                                    id="archivo_boleteria" accept="application/pdf" name="archivo_boleteria"
                                    type="file" data-overwrite-initial="true">
                                @error('archivo_boleteria')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 pl-1 pr-1 pt-3">
                        <label for="archivo_copia_cedula" class="form-label">Copia de cedula de representante                            <br> <small class="text-danger" style="font-size: 11px!important">Solo se permiten
                                archivos .pdf con un tamaño máximo de 10MB</small></label>
                        <div class="form-group">
                            <div class="file-loading">
                                <input
                                    class=" @error('archivo_copia_cedula') is-invalid @enderror documentos_adjuntos"
                                    id="archivo_copia_cedula" accept="application/pdf" name="archivo_copia_cedula"
                                    type="file" data-overwrite-initial="true">
                                @error('archivo_copia_cedula')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 pl-1 pr-1 pt-3">
                        <label for="archivo_solicitud" class="form-label">Solicitud Firmada <br> <small class="text-danger" style="font-size: 11px!important">Solo se permiten
                                archivos .pdf con un tamaño máximo de 10MB</small></label>
                        <div class="form-group">
                            <div class="file-loading">
                                <input
                                    class=" @error('archivo_solicitud') is-invalid @enderror documentos_adjuntos"
                                    id="archivo_solicitud" accept="application/pdf" name="archivo_solicitud"
                                    type="file" data-overwrite-initial="true">
                                @error('archivo_solicitud')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 pl-1 pr-1 pt-3">
                        <label for="arch_otros" class="form-label">Otros Adjuntos
                            <br> <small class="text-danger" style="font-size: 11px!important">Solo se permiten
                                archivos .pdf con un tamaño máximo de 10MB</small></label>
                        <div class="form-group">
                            <div class="file-loading">
                                <input class=" @error('arch_otros') is-invalid @enderror documentos_adjuntos"
                                    id="arch_otros" accept="application/pdf" name="arch_otros"
                                    type="file" data-overwrite-initial="true">
                                @error('arch_otros')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                         
                       <div class="col-md-12">
                           <div class="form-group">
                               <button type="submit"  onclick="return confirm('¿Esta seguro de actualizar los documentos ?')"  class="btn btn-round btn-middle btn-outline-info"  id="Boton">Actualizar documentos</button>
                           </div>
                       </div>
                      
                @elseif($solicitud->estado_solicitud == 'PENDIENTE' && $solicitud->act_documentos == 'SI')
                         <div class="col-md-4"><h6>Atención!!</h6><p>Usted ya realizó una actualización de documentos el dia {{$solicitud->updated_at}}</p></div> 

                @elseif($solicitud->estado_solicitud=='REVISION-PLANEACION' || $solicitud->estado_solicitud=='RESPUESTA-PLANEACION')                                        
                <div class="col-md-4"><h6>Atención!!</h6><p>Su solicitud se encuentra en CONCEPTO TÉCNICO</p></div> 

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

@endsection