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
                                        Permiso para espectáculos públicos diferentes a las artes escénicas
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
                  <form method="POST" action="{{route('eventos.updateDocs')}}"  enctype="multipart/form-data" id="myForm">
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
                        <label>Nombre del Responsable</label>
                         <input type="text" class="form-control" value="{{$responsable}}" readonly>
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
                        <textarea rows="6" class="form-control" disabled>{{$solicitud->observaciones_solicitud}}</textarea>
                        
                       </div>
                       </div>

                       <div class="col-md-6">  
                        <div class="form-group">
                        <label>Fecha de actuacion</label>
                         <input type="text" class="form-control" value="{{$solicitud->fecha_actuacion}}" readonly>
                       </div>
                       </div>

                       @if($solicitud->estado_solicitud == 'APROBADA' || $solicitud->estado_solicitud == 'RECHAZADA')
                       
                       <div class="col-md-6">  
                        <div class="form-group">
                        <h5>Acto administrativo de respuesta</h5>
                          <a href="https://tramitesenlinea.bucaramanga.gov.co/{{$solicitud->adjunto_respuesta}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                       </div>
                       </div>

                       @endif

                       {{-- AQUI VA APROBADA --}}

                       @if($solicitud->estado_solicitud == 'PENDIENTE' && $solicitud->act_documentos == null)                        
                        
                       <div class="col-md-12">
                         <h5>Cargue sus archivos pendientes <small>Faltan {{$diff}} dia(s) para el vencimiento del plazo</small></h5>                        
                       </div>

                       <div class="col-md-4 pl-1 pr-1 pt-3">
                        <label for="adj_cedulaRes_arch" class="form-label">Documento de identificación</label> &nbsp;
                        <small style="font-size: 11px!important; text-align:justify!important;"><em
                                style="font-size: 11px!important; text-align:justify!important;">Adjunto cédula de
                                ciudadanía (persona natural sea el responsable del evento) o certificado existencia
                                y representación legal (responsable del evento sea una persona jurídica)</em>
                        </small></label>
                        <div class="form-group">
                            <div class="file-loading">
                                <input class=" @error('adj_cedulaRes_arch') is-invalid @enderror documentos_adjuntos"
                                    id="adj_cedulaRes_arch" accept="application/pdf" name="adj_cedulaRes_arch" type="file"
                                    data-overwrite-initial="true">
                               
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 pl-1 pr-1 pt-3">
                        <label for="adj_logisticaEvento_arch" class="form-label"> Certificación de Empresa Logística legalmente constituida &nbsp; <small
                            style="font-size: 11px!important;text-align:justify!important;"><em
                                style="font-size: 11px!important"> Adjuntar oficio que conste la prestación del servicio de seguridad y vigilancia del evento. </em> <br> </small></label><br>
                        <div class="form-group">
                            <div class="file-loading">
                                <input
                                    class=" @error('adj_logisticaEvento_arch') is-invalid @enderror documentos_adjuntos"
                                    id="adj_logisticaEvento_arch" accept="application/pdf" name="adj_logisticaEvento_arch"
                                    type="file" data-overwrite-initial="true">
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 pl-1 pr-1 pt-3">
                        <label for="adj_autorizacionTra_arch" class="form-label">Autorización de Transito &nbsp; <small
                                style="font-size: 11px!important"><em style="font-size: 11px!important"> Adjuntar
                                    autorización de la Direccion de transito de Bucaramanga si el evento lo requiere
                                    (depende del sitio)</em></small></label><br><br>
                        <div class="form-group">
                            <div class="file-loading">
                                <input
                                    class=" @error('adj_autorizacionTra_arch') is-invalid @enderror documentos_adjuntos"
                                    id="adj_autorizacionTra_arch" accept="application/pdf" name="adj_autorizacionTra_arch"
                                    type="file" data-overwrite-initial="true">
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 pl-1 pr-1 pt-3">
                        <label for="adj_contratoArr_arch" class="form-label"> Autorización del lugar &nbsp; <small
                            style="font-size: 11!important;" aling="justify"><em
                                style="font-size: 10px!important" aling="justify"> Adjuntar certificación escrita o contrato de arrendamiento suscrito por el propietario, administrador, arrendador o poseedor legal del inmueble destinado para desarrollar el evento. Si el evento es en espacio público se debe adjuntar la viabilidad escrita por la Oficina de Parque y Zonas Verdes de la Secretaría de Infraestructura para el uso y ocupación del espacio público de la zona. (Calle 35 No. 10 – 43 Edificio Fase I Piso 4).</em></small> </label>
                        <div class="form-group">
                            <div class="file-loading">
                                <input class=" @error('adj_contratoArr_arch') is-invalid @enderror documentos_adjuntos"
                                    id="adj_contratoArr_arch" accept="application/pdf" name="adj_contratoArr_arch" type="file"
                                    data-overwrite-initial="true">
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 pl-1 pr-1 pt-3">
                        <label for="adj_conceptoCMGRD_arch" class="form-label">Concepto del Comité de Gestion del Riesgo
                            &nbsp; <small style="font-size: 11!important;" aling="justify"><em
                                    style="font-size: 11px!important" aling="justify">Concepto técnico emitido por
                                    CMGRD, del plan de emergencia y contingencia, que deberá constar por escrito
                                    incluyendo las recomendaciones. (No continuar con el trámite de los demás
                                    requisitos sin haber obtenido primero la certificación favorable emitida por el
                                    Comité).</em></small> </label><br><br>
                        <div class="form-group">
                            <div class="file-loading">
                                <input class=" @error('adj_conceptoCMGRD_arch') is-invalid @enderror documentos_adjuntos"
                                    id="adj_conceptoCMGRD_arch" accept="application/pdf" name="adj_conceptoCMGRD_arch"
                                    type="file" data-overwrite-initial="true">
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 pl-1 pr-1 pt-3">
                        <label for="adj_conceptoTecAmb_arch" class="form-label">Concepto Tecnico Sanitario y Ambiental
                            &nbsp; <small style="font-size: 11!important;" aling="justify"><em
                                    style="font-size: 11px!important" aling="justify"> Adjuntar Concepto técnico
                                    sanitario y ambiental, emitido por la Subsecretaria de Medio Ambiente de la
                                    Secretaria de Salud Municipal. (Calle 35 # 10-43 Fase I Piso 2).</em></small>
                        </label><br><br><br><br>
                        <div class="form-group">
                            <div class="file-loading">
                                <input
                                    class=" @error('adj_conceptoTecAmb_arch') is-invalid @enderror documentos_adjuntos"
                                    id="adj_conceptoTecAmb_arch" accept="application/pdf" name="adj_conceptoTecAmb_arch"
                                    type="file" data-overwrite-initial="true" >
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 pl-1 pr-1 pt-3">
                        <label for="adj_certificadoPONAL_arch" class="form-label">Certificado MEBUC&nbsp; <small
                            style="font-size: 11!important;" aling="justify"><em
                                style="font-size: 11px!important" aling="justify"> Adjuntar Certificado de
                                conocimiento del Evento por parte del Comando Operativo de Seguridad Ciudadana
                                de la Policía Metropolitana (PONAL)(Calle 41 # 11-44).</em></small> </label><br>
                        <div class="form-group">
                            <div class="file-loading">
                                <input
                                    class=" @error('adj_certificadoPONAL_arch') is-invalid @enderror documentos_adjuntos"
                                    id="adj_certificadoPONAL_arch" accept="application/pdf" name="adj_certificadoPONAL_arch"
                                    type="file" data-overwrite-initial="true">
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 pl-1 pr-1 pt-3">
                        <label for="adj_certificadoBomberos_arch" class="form-label">Concepto de Bomberos de Bucaramanga&nbsp; <small style="font-size: 11!important;" aling="justify"><em
                            style="font-size: 11px!important" aling="justify"> Adjuntar Oficio que acredite
                            el cumplimiento de las condiciones de seguridad de acuerdo al protocolo
                            establecido por el Cuerpo de Bomberos de Bucaramanga. (Calle 44 No. 10 – 13).</em></small> </label><br>
                        <div class="form-group">
                            <div class="file-loading">
                                <input
                                    class=" @error('adj_certificadoBomberos_arch') is-invalid @enderror documentos_adjuntos"
                                    id="adj_certificadoBomberos_arch" accept="application/pdf"
                                    name="adj_certificadoBomberos_arch" type="file" data-overwrite-initial="true"
                                    >
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 pl-1 pr-1 pt-3">
                        <label for="adj_hospitalaria_arch" class="form-label">Constancia de prestación servicio prehospitalario&nbsp; <small style="font-size: 11!important;" aling="justify"><em
                            style="font-size: 11px!important" aling="justify"> Adjuntar constancia del servicio a prestar con un organismo de socorro: Defensa Civil o Cruz Roja.</em></small> </label><br><br>
                        <div class="form-group">
                            <div class="file-loading">
                                <input class=" @error('adj_hospitalaria_arch') is-invalid @enderror documentos_adjuntos"
                                    id="adj_hospitalaria_arch" accept="application/pdf" name="adj_hospitalaria_arch"
                                    type="file" data-overwrite-initial="true">
                               
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 pl-1 pr-1 pt-3">
                        <label for="adj_poliza_arch" class="form-label">Póliza de responsabilidad civil&nbsp; <small
                                style="font-size: 11!important;" aling="justify"><em
                                    style="font-size: 11px!important" aling="justify"> Adjuntar Póliza de
                                    Responsabilidad Civil Extracontractual que ampare los riesgos que el evento
                                    conlleva, debe ser adquirida por el organizador con empresa aseguradora de su
                                    elección, a favor del Municipio de Bucaramanga, especificando lugar, fecha del
                                    evento. </em></small> </label><br><br>
                        <div class="form-group">
                            <div class="file-loading">
                                <input class=" @error('adj_poliza_arch') is-invalid @enderror documentos_adjuntos"
                                    id="adj_poliza_arch" accept="application/pdf" name="adj_poliza_arch" type="file"
                                    data-overwrite-initial="true">
                               
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 pl-1 pr-1 pt-3">
                        <label for="adj_publicidad_arch" class="form-label">Soporte de Pago Publicidad Exterior*&nbsp;
                            <small style="font-size: 11!important;" aling="justify"><em
                                    style="font-size: 11px!important" aling="justify"> Adjuntar Pago de impuesto
                                    publicidad exterior visual o paz y salvo de publicidad exterior visual de que no
                                    van a exhibir ningún tipo de publicidad. (Oficina de publicidad exterior visual-
                                    Secretaria del Interior) (Calle 35 No. 10 – 43 Edificio Fase I Piso 3).
                                </em></small> </label><br>
                        <div class="form-group">
                            <div class="file-loading">
                                <input class=" @error('adj_publicidad_arch') is-invalid @enderror documentos_adjuntos"
                                    id="adj_publicidad_arch" accept="application/pdf" name="adj_publicidad_arch" type="file"
                                    data-overwrite-initial="true">
                               
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 pl-1 pr-1 pt-3">
                        <label for="adj_certificadoEMAB_arch" class="form-label">Certificado de Aseo&nbsp; <small
                            style="font-size: 11!important;" aling="justify"><em
                                style="font-size: 11px!important" aling="justify">  Adjuntar el certificado emitido por la EMAB o el compromiso de aseo del lugar en donde se desarrolla el evento. El compromiso de aseo será válido siempre y cuando en el evento participen hasta 50 personas.</em></small> </label><br><br><br>
                        <div class="form-group">
                            <div class="file-loading">
                                <input
                                    class=" @error('adj_certificadoEMAB_arch') is-invalid @enderror documentos_adjuntos"
                                    id="adj_certificadoEMAB_arch" accept="application/pdf" name="adj_certificadoEMAB_arch"
                                    type="file" data-overwrite-initial="true">
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 pl-1 pr-1 pt-3">
                        <label for="adj_derAutor_arch" class="form-label">Autorización derechos de Autor&nbsp; <small
                                style="font-size: 11!important;" aling="justify"><em
                                    style="font-size: 11px!important" aling="justify"> Adjuntar certificado que
                                    acredite Los derechos de autor previstos en la ley y presentar su respectiva
                                    autorización, si en el evento público se ejecutaran obras causantes de dichos
                                    pagos.</em></small> </label><br>
                        <div class="form-group">
                            <div class="file-loading">
                                <input class=" @error('adj_derAutor_arch') is-invalid @enderror documentos_adjuntos"
                                    id="adj_derAutor_arch" accept="application/pdf" name="adj_derAutor_arch" type="file"
                                    data-overwrite-initial="true">
                               
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

                                                              

                 @endif
                        </div>
                        </div> 
                        <div class="card-footer">
                            <div class="col-md-3">
                                <a class="btn btn-round btn-high" href="{{ URL::route('eventos.index') }}" style="float: left;">Volver</a>
                            </div> 
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
                            


                         




        </div>

@endsection