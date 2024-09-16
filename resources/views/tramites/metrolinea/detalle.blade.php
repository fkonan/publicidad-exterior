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
                                        Te llevamos en el corazón
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
                  <form method="POST" action="{{route('metrolinea.updateDocs')}}"  enctype="multipart/form-data" id="myForm">
                     @csrf
                     <input type="hidden" name="id" value="{{$solicitud->id}}">
                    <div class="card govco-card animate__animated animate__bounceInRight">
                        <div class="card-header govco-card-header">
                            <span class="govco-icon govco-icon-analytic size-3x pr-3"> </span>
                         Solicitud N°- {{$solicitud->numero_solicitud}} 
                        </div>

                        <div class="card-body">
                        <div class="row">
                         <div class="col-md-12">  
                        <div class="form-group">
                        <mark style="background-color:red; color:white"><b style="color:white!important;"> !!IMPORTANTE LEA DETENIDAMENTE LAS OBSERVACIONES Y SEA MUY CUIDADOSO AL CARGAR LOS DOCUMENTOS, RECUERDE QUE SOLO DEBE CARGAR EL DOCUMENTO SOLICITADO EN LA OBSERVACIÓN (LOS DEMAS DOCUMENTOS NO SON NECESARIOS) </b></mark><br><br>
                        <label>Nombre del postulado al beneficio</label>
                         <input type="text" class="form-control" value="{{$solicitud->nombre_usuario}} {{$solicitud->apellido_usuario}}" readonly>
                       </div>
                       </div>

                        

                       <div class="col-md-12">  
                        <div class="form-group">
                       
                        <label>Observaciones de la solicitud</label>
                        <textarea rows="4" class="form-control" disabled> {{$solicitud->observaciones_solicitud}}</textarea>
                        
                       </div>
                       </div>

                       <div class="col-md-6 pl-1 pr-1 pt-3">
                        <label for="archivo_documentoIdentidad" class="form-label">Copia de documento de identidad <br> <small class="text-danger"
                                style="font-size: 11px!important">Solo se permiten archivos .pdf con un tamaño
                                máximo de 3MB</small> </label><br><br>
                        <div class="form-group">
                            <div class="file-loading">
                                <input
                                    class="documentos_adjuntos_metrolinea"
                                    id="archivo_documentoIdentidad" accept="application/pdf" name="archivo_documentoIdentidad"
                                    type="file" data-overwrite-initial="true">
                               
                            </div>
                        </div>
                    </div>

                    @if($solicitud->adj_certiVecindad != null || $solicitud->adj_certiVecindad != '')

                    <div class="col-md-6 pl-1 pr-1 pt-3 caja-certificadoVecindad d-">
                        <label for="archivo_certiVencidad" class="form-label">Certificado de vecindad y recibo de servicio publico (unidos en un mismo pdf)* <br> <small
                                class="text-danger" style="font-size: 11px!important">Solo se permiten archivos .pdf
                                con un tamaño máximo de 3MB</small> </label>
                        <div class="form-group">
                            <div class="file-loading">
                                <input class="documentos_adjuntos_metrolinea"
                                    id="archivo_certiVencidad" accept="application/pdf" name="archivo_certiVencidad" type="file"
                                    data-overwrite-initial="true">
                               
                            </div>
                        </div>
                    </div>                   
                      
                    @endif

                     @if($solicitud->adj_certificadoEstudio != null || $solicitud->adj_certificadoEstudio != '')

                     <div class="col-md-6 pl-1 pr-1 pt-3 caja_certificadoEstudios">
                        <label for="archivo_certificadoEstudio" class="form-label">Carnet Vigente de Entidad Educativa ó Certificado de matricula vigente*<br> <small
                                class="text-danger" style="font-size: 11px!important">Solo se permiten archivos .pdf
                                con un tamaño máximo de 3MB</small></label><br>
                        <div class="form-group">
                            <div class="file-loading">
                                <input class="documentos_adjuntos_metrolinea"
                                    id="archivo_certificadoEstudio" accept="application/pdf" name="archivo_certificadoEstudio"
                                    type="file" data-overwrite-initial="true">
                               
                            </div>
                        </div>
                    </div>                   
                      
                    @endif

                    @if($solicitud->adj_docAcudiente != null || $solicitud->adj_docAcudiente != '')

                    <div class="col-md-6 pl-1 pr-1 pt-3 caja_docAcudiente">
                        <label for="archivo_docAcudiente" class="form-label">Copia Documento de identificación del acudiente* <br> <small
                                class="text-danger" style="font-size: 11px!important">Solo se permiten archivos .pdf
                                con un tamaño máximo de 3MB</small></label>
                        <div class="form-group">
                            <div class="file-loading">
                                <input class="documentos_adjuntos_metrolinea"
                                    id="archivo_docAcudiente" accept="application/pdf" name="archivo_docAcudiente"
                                    type="file" data-overwrite-initial="true">
                               
                            </div>
                        </div>
                    </div>               
                     
                   @endif

                   @if($solicitud->adj_docSisben != null || $solicitud->adj_docSisben != '')

                   <div class="col-md-6 pl-1 pr-1 pt-3 caja_docSisben">
                    <label for="archivo_docSisben" class="form-label">Copia calificación Sisben metodología 4: de A1 a C9.* <br> <small
                            class="text-danger" style="font-size: 11px!important">Solo se permiten archivos .pdf
                            con un tamaño máximo de 3MB</small></label><br>
                    <div class="form-group">
                        <div class="file-loading">
                            <input class="documentos_adjuntos_metrolinea"
                                id="archivo_docSisben" accept="application/pdf" name="archivo_docSisben"
                                type="file" data-overwrite-initial="true">
                            
                        </div>
                    </div>
                </div>              
                     
                   @endif

                   @if($solicitud->adj_deportistas_artistas != null || $solicitud->adj_deportistas_artistas != '')

                   <div class="col-md-6 pl-1 pr-1 pt-3 caja-deportistas">
                    <label for="archivo_" class="form-label"> Carnét de escuelas de formación deportiva o artística vigente.* <br> <small
                            class="text-danger" style="font-size: 11px!important">Solo se permiten archivos .pdf
                            con un tamaño máximo de 3MB</small></label>
                    <div class="form-group">
                        <div class="file-loading">
                            <input class="documentos_adjuntos_metrolinea"
                                id="archivo_deportistas_artistas" accept="application/pdf" name="archivo_deportistas_artistas"
                                type="file" data-overwrite-initial="true">
                            
                        </div>
                    </div>
                </div>            
                     
                   @endif

                   @if($solicitud->adj_discapacidad != null || $solicitud->adj_discapacidad != '')

                   <div class="col-md-6 pl-1 pr-1 pt-3 caja_discapacidad">
                    <label for="archivo_" class="form-label"> Registro de localización y caracterización de personas con discapacidad del Ministerio de Salud ó Circular Externa 009.* <br> <small
                            class="text-danger" style="font-size: 11px!important">Solo se permiten archivos .pdf
                            con un tamaño máximo de 3MB</small></label>
                    <div class="form-group">
                        <div class="file-loading">
                            <input class="documentos_adjuntos_metrolinea"
                                id="archivo_discapacidad" accept="application/pdf" name="archivo_discapacidad"
                                type="file" data-overwrite-initial="true">
                            
                        </div>
                    </div>
                </div>          
                     
                   @endif                    
                             
                     
                    

                   <div class="col-md-12 pl-1 pr-1 pt-3 ">                    
                                               
                           <div class="form-group">
                               <button type="submit"  onclick="return confirm('¿Esta seguro de actualizar los documentos ?')" class="btn btn-round btn-middle btn-outline-info"  id="Boton">Actualizar documentos</button>
                           </div>
                       
                      
               
                        </div>
                        </div> 
                        <div class="card-footer">
                            <div class="col-md-3">
                                <a class="btn btn-round btn-high" href="{{ URL::route('metrolinea.index') }}" style="float: left;">Volver</a>
                            </div> 
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
                            


                         




        </div>

@endsection