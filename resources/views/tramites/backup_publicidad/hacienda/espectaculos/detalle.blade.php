@extends('layouts.menu')

@section('dashboard')

    <div class="container mt-3 mb-4 m-xs-x-3">

        <div class="row pl-4">
            <div class="px-0 col-md-11">
                <nav aria-label="Miga de pan" style="max-height: 20px;">
                    <ol class="breadcrumb" style="background-color: #FFFFFF;">
                        <li class="breadcrumb-item ml-3 ml-md-0">
                            <a style="color: #004fbf;" class="breadcrumb-text" href="https://www.gov.co/home/">Inicio</a>
                        </li>
                        <li class="breadcrumb-item ">
                            <div class="image-icon">
                                <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                                <a style="color: #004fbf;" class="breadcrumb-text" href="#">Tramites en Linea</a>
                            </div>
                        </li>
                        <li class="breadcrumb-item ">
                            <div class="image-icon">
                                <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                                <a style="color: #004fbf;" class="breadcrumb-text" href="#">
                                    Hacienda</a>
                            </div>
                        </li>
                        <li class="breadcrumb-item ">
                            <div class="image-icon">
                                <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                                <p class="ml-3 ml-md-0 "><b style="color: #004fbf;text-transform: none;">
                                        Espectáculos Publicos
                                    </b></p>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="col-md-12 pt-4" style="padding-left: 10px!important">
            <h1 class="headline-xl-govco">Administración Solicitud</h1>
            <div class="row pt-5">

                <div style="" class="table-simple-headblue-govco col-md-12 animate__animated animate__bounceInRight">
                    <table style="width: 100%;" class="table display table-responsive-md table-responsive-md"
                        cellpadding="20" width="100%">
                        <thead>
                            <tr>
                                <th colspan="3">
                                    Solicitud N° - {{ $solicitud->radicado }} &nbsp;&nbsp;&nbsp; Datos Básicos
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Radicado N°-&nbsp;<br>
                                    </strong>{{ $solicitud->radicado }}</td>
                                <td colspan="2"><strong>Responsable de la Solicitud:</strong><br>
                                    {{ $solicitud->nombre_o_razon }}
                                </td>


                            </tr>
                            <tr>
                                <td><strong>Numero de identificación:</strong><br>
                                    {{ $solicitud->tipo_identificacion }} {{ $solicitud->numero_identificacion }}
                                </td>
                                <td colspan="2"><strong>Dirección de Notificación</strong>
                                    <br>{{ $solicitud->direccion_notificacion }} - {{ $solicitud->barrio_notificacion }}
                                    &nbsp;&nbsp;

                                </td>
                            </tr>

                            <tr>
                                <td><strong>Telefono de contacto:</strong><br>
                                    {{ $solicitud->telefono_movil }}
                                </td>
                                <td colspan="2"><strong>Email:</strong><br>
                                    {{ $solicitud->email_responsable }}

                                </td>
                            <tr style="background-color:#004884">
                                <td colspan="3" style="background-color:#004884; color:white">
                                    Datos del evento
                                </td>
                            </tr>

                            <tr>
                                <td><strong>Tipo de evento:</strong><br>
                                    @if ($solicitud->evento_id == 1)
                                        UNICO
                                    @else
                                        SUCESIVO
                                    @endif
                                </td>

                                <td><strong>Nombre del evento:</strong><br>
                                    {{ $solicitud->nombre_evento }}
                                </td>

                            </tr>

                            <tr>
                                <td><strong>Fecha del Evento:</strong><br>
                                    {{ $solicitud->fecha_inicio_evento }} hasta {{ $solicitud->fecha_fin_evento }}
                                </td>
                                <td colspan="2"><strong>Hora del evento:</strong><br>
                                    {{ $solicitud->hora_inicio }} - {{ $solicitud->hora_fin }}
                                </td>

                            </tr>
                            <tr>
                                <td><strong>Lugar Evento: </strong><br>
                                    {{ $solicitud->lugar_evento }}
                                </td>
                                <td colspan="2"><strong>Descripción del evento: </strong><br>
                                    {{ $solicitud->descripcion_evento }}
                                </td>
                            </tr>

                            <tr>
                                <td><strong>Tipo de Garantia: </strong><br>
                                    {{ $solicitud->tipo_garantia }}
                                </td>


                                @if ($solicitud->numero_poliza_cheque != null || $solicitud->valor_poliza_cheque != null)
                                    <td colspan="2">
                                        <strong>N° Garantia y Valor:</strong><br>
                                        #{{ $solicitud->numero_poliza_cheque }} - ${{ $solicitud->valor_poliza_cheque }}
                                    </td>
                                @else
                                    <td colspan="2">
                                        <strong></strong><br>

                                    </td>
                                @endif

                            </tr>

                            @if($solicitud->exento_imp !=null)
                            <tr>
                                <td colspan="3"><strong>Exento de Impuesto: </strong><br>
                                    {{ $solicitud->exento_imp }}
                                
                                </td>
                            </tr>



                            @endif

                            <tr>
                                <td colspan="3">
                                    <div class="table-simple-headblue-govco">
                                        <table class="table display table-responsive-sm table-responsive-md"
                                            style="width:100%" id="tablaBoleteriaAdmin">
                                            <thead>
                                                <tr>
                                                    <th>Tipo de Boleteria</th>
                                                    <th>Valor</th>
                                                    <th>N° de boletas Impresas</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($boletas as $boleta)
                                                    <tr>
                                                        <td>{{ $boleta->clase_boleta }}</td>
                                                        <td class="valor_boleteria">{{ $boleta->valor }} </td>
                                                        <td>{{ $boleta->numero_boletas_emitidas }}</td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>

                            <tr style="background-color:#004884">
                                <td colspan="3" style="background-color:#004884; color:white">Documentos Adjuntos</td>
                            </tr>

                            <tr>
                                <td><strong>RUT:</strong><br>
                                    <a href="https://tramitesenlineapruebas.bucaramanga.gov.co/{{ $solicitud->adj_RUT }}"
                                        target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                                </td>
                                <td><strong>Camara de comercio:</strong><br>
                                    <a href="https://tramitesenlineapruebas.bucaramanga.gov.co/{{ $solicitud->adj_camara_comercio }}"
                                        target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                                </td>
                                <td><strong>Certificación de boleteria:</strong><br>
                                    <a href="https://tramitesenlineapruebas.bucaramanga.gov.co/{{ $solicitud->adj_certificacion_boleteria_emitida }}"
                                        target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                                </td>

                            </tr>
                            <tr>

                                <td><strong>Copia de documento de Identidad:</strong><br>
                                    <a href="https://tramitesenlineapruebas.bucaramanga.gov.co/{{ $solicitud->adj_documentoident }}"
                                        target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                                </td>

                                <td colspan="2"><strong>Solicitud por escrito:</strong><br>
                                    <a href="https://tramitesenlineapruebas.bucaramanga.gov.co/{{ $solicitud->adj_solicitud }}"
                                        target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                                </td>

                            </tr>
                            @if ($solicitud->adj_documentoGarantia != null || $solicitud->adj_acta_reunion != null)

                                <tr>

                                    <td><strong>Garantia Entregada:</strong><br>
                                        <a href="https://tramitesenlineapruebas.bucaramanga.gov.co/{{ $solicitud->adj_documentoGarantia }}"
                                            target="_blank">Descargar documento</a>&nbsp;&nbsp;<i
                                            class="fa fa-download"></i>
                                    </td>

                                    <td><strong>Acta de reunion de entrega:</strong><br>
                                        <a href="https://tramitesenlineapruebas.bucaramanga.gov.co/{{ $solicitud->adj_acta_reunion }}"
                                            target="_blank">Descargar documento</a>&nbsp;&nbsp;<i
                                            class="fa fa-download"></i>
                                    </td>
                                    @if ($solicitud->adj_actReu_revocatorio != null)

                                        <td><strong>Acta de reunion de devolución:</strong><br>
                                            <a href="https://tramitesenlineapruebas.bucaramanga.gov.co/{{ $solicitud->adj_actReu_revocatorio }}"
                                                target="_blank">Descargar documento</a>&nbsp;&nbsp;<i
                                                class="fa fa-download"></i>
                                        </td>

                                    @else
                                        <td></td>
                                    @endif

                                </tr>


                            @endif

                            @if ($solicitud->adj_evento_cancelado != null)

                                <tr>

                                    <td colspan="3"><strong>Oficio de Cancelación:</strong><br>
                                        <a href="https://tramitesenlineapruebas.bucaramanga.gov.co/{{ $solicitud->adj_evento_cancelado }}"
                                            target="_blank">Descargar documento</a>&nbsp;&nbsp;<i
                                            class="fa fa-download"></i>
                                    </td>


                                </tr>


                            @endif

                            @if ($solicitud->adj_certificacion_boleteria_vendida != null)

                                <tr>

                                    <td colspan="3"><strong>Certificado de Boleteria Vendida:</strong><br>
                                        <a href="https://tramitesenlineapruebas.bucaramanga.gov.co/{{ $solicitud->adj_certificacion_boleteria_vendida }}"
                                            target="_blank">Descargar documento</a>&nbsp;&nbsp;<i
                                            class="fa fa-download"></i>
                                    </td>
                                </tr>

                            @endif

                            @if ($solicitud->adj_acto_administrativo != null)
                                <tr>
                                    <td><strong>Acto administrativo:</strong><br>
                                        <a href="https://tramitesenlineapruebas.bucaramanga.gov.co/{{ $solicitud->adj_acto_administrativo }}"
                                            target="_blank">Descargar documento</a>&nbsp;&nbsp;<i
                                            class="fa fa-download"></i>
                                    </td>
                                    @if ($solicitud->adj_acto_revocatorio != null)
                                        <td colspan="2"><strong>Acto administrativo revocatorio:</strong><br>
                                            <a href="https://tramitesenlineapruebas.bucaramanga.gov.co/{{ $solicitud->adj_acto_revocatorio }}"
                                                target="_blank">Descargar documento</a>&nbsp;&nbsp;<i
                                                class="fa fa-download"></i>
                                        </td>
                                    @else
                                        <td colspan="2"><strong></strong><br>

                                        </td>
                                    @endif
                                </tr>
                            @endif

                            @if ($solicitud->adj_otros != null)

                                <tr>

                                    <td colspan="3"><strong>Otros Adjuntos:</strong><br>
                                        <a href="https://tramitesenlineapruebas.bucaramanga.gov.co/{{ $solicitud->adj_otros }}"
                                            target="_blank">Descargar documento</a>&nbsp;&nbsp;<i
                                            class="fa fa-download"></i>
                                    </td>


                                </tr>


                            @endif

                            

                            


                            <tr style="background-color:#004884">
                                <td colspan="3" style="background-color:#004884; color:white">Administración del Tramite
                                </td>
                            </tr>

                            <tr>
                                <td><strong>Estado de la solicitud:</strong><br>
                                    @if ($solicitud->estado_solicitud == 'ENVIADA')
                                        <p style="color: #069169;font-weight:bold">ENVIADA<span
                                                class="govco-icon govco-icon-check-p size-1x"></span></p>
                                    @elseif($solicitud->estado_solicitud == 'PENDIENTE')
                                        <p style="color: #3772FF;font-weight:bold">PENDIENTE<span
                                                class="govco-icon govco-icon-eye-p size-1x"></span></p>
                                    @elseif($solicitud->estado_solicitud == 'ENTREGA_GARANTIA')
                                        <p style="color: #F3561F;font-weight:bold">GARANTIA ENTREGADA<span
                                                class="govco-icon govco-icon-document-n size-1x"></span></p>
                                    @elseif($solicitud->estado_solicitud == 'DOCUMENTOS_ACTUALIZADOS')
                                        <p style="color: #FFAB00;font-weight:bold">DOCUMENTOS ACTUALIZADOS<span
                                                class="govco-icon govco-icon-edit-p  size-1x"></span></p>
                                    @elseif($solicitud->estado_solicitud == 'EVENTO_APROBADO')
                                        <p style="color: #069169;font-weight:bold">APROBADA<span
                                                class="govco-icon govco-icon-like size-1x"></span></p>
                                    @elseif($solicitud->estado_solicitud == 'RECHAZADA')
                                        <p style="color: #A80521;font-weight:bold">RECHAZADA<span
                                                class="govco-icon govco-icon-x-n size-1x"></span></p>
                                    @elseif($solicitud->estado_solicitud == 'EVENTO_CANCELADO')
                                        <p style="color: #eeeeee;font-weight:bold">SOLICITUD CANCELADA<span
                                                class="govco-icon govco-icon-x-n size-1x"></span></p>
                                    @elseif($solicitud->estado_solicitud == 'ACTO_REVOCADO')
                                        <p style="color: #4B4B4B;font-weight:bold">ACTO ADMINISTRATIVO REVOCADO<span
                                                class="govco-icon govco-icon-left-arrow-cn size-1x"></span></p>
                                    @elseif($solicitud->estado_solicitud == 'DEVOLUCION_GARANTIA')
                                        <p style="color: #F3561F;font-weight:bold">GARANTIA DEVUELTA<span
                                                class="govco-icon govco-icon-document-n size-1x"></span></p>
                                    @elseif($solicitud->estado_solicitud == 'EVENTO_FINALIZADO')
                                        <p style="color: #000000;font-weight:bold">SOLICITUD CERRADA<span
                                                class="govco-icon govco-icon-legal size-1x"></span></p>
                                    @elseif($solicitud->estado_solicitud == 'EVENTO_REALIZADO')
                                        <p style="color: #069169;font-weight:bold">SOLICITUD EN LIQUIDACION<span
                                                class="govco-icon govco-icon-peso-col size-1x"></span></p>
                                    @elseif($solicitud->estado_solicitud == 'PAGO_REALIZADO')
                                        <p style="color: #004884;font-weight:bold">PAGO REALIZADO<span
                                                class="govco-icon govco-icon-peso-col-cn size-1x"></span></p>
                                    @endif

                                </td>
                                <td><strong>Fecha y hora de la solicitud</strong><br>
                                    {{ $solicitud->created_at }}
                                </td>
                                <td><strong>Fecha de actuación</strong><br>
                                    @if ($solicitud->fecha_actuacion == null || $solicitud->fecha_actuacion == '')
                                        <small>No hay fecha de actuaciones</small>
                                    @else
                                        {{ $solicitud->fecha_actuacion }}
                                    @endif
                                </td>

                            </tr>

                            @if ($solicitud->estado_solicitud == 'EVENTO_REALIZADO' && $fechas != null)

                                <tr>
                                    <td colspan="3"><strong>Estado del pago</strong><br>


                                        <div class="table-simple-headblue-govco">
                                            <table class="table display table-responsive-sm table-responsive-md"
                                                style="width:100%" id="tablaEstadoPago">
                                                <thead>
                                                    <tr>
                                                        <th>Radicado de Pago</th>
                                                        <th>Fecha limite de Declaración y Pago</th>
                                                        <th>Estado</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($fechas as $fecha)
                                                        <tr>
                                                            <td>{{ $fecha->radicado_pago }}</td>
                                                            <td class="text-danger">
                                                                {{ $fecha->fecha_limite_liquidacion }} </td>
                                                            <td class="text-success">{{ $fecha->estado }}</td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>



                                    </td>
                                </tr>



                            @endif

                            <tr>
                                <td colspan="3"><strong>Observaciones de la solicitud:</strong><br>
                                    @if ($solicitud->observaciones == null || $solicitud->observaciones == '')
                                        <small>No hay Observaciones</small>
                                    @else
                                        {{ $solicitud->observaciones }}
                                    @endif
                                </td>
                            </tr>
                            {{-- <tr>
                        
                        <td>
                            @if ($solicitud->documento_respuesta != null)
                            <strong>Documento de respuesta:</strong><br>
                            <a href="http://tramitesenlinea.test/{{$solicitud->documento_respuesta}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>                                                         
                            @else                                
                            @endif
                        


                           
                        </td>
                    </tr> --}}

                            {{-- aqui va el form --}}
                            <form method="POST" class="form-espectaculos"
                                action="{{ route('hacienda.espectaculos.update') }}" enctype="multipart/form-data"
                                id="myForm1">
                                @csrf
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label for="estado">Cambiar Estado de la solicitud*</label>
                                            <select class="form-control  @error('estado_solicitud') is-invalid @enderror"
                                                name="estado_solicitud" id="estado_espectaculos" required>
                                                <option value="">Seleccione</option>
                                                <option value="ENTREGA_GARANTIA">APORTA GARANTIA FISICA</option>
                                                <option value="PENDIENTE">DOCUMENTOS PENDIENTES</option>
                                                <option value="EVENTO_APROBADO">SOLICITUD APROBADA</option>
                                                <option value="EVENTO_REALIZADO">EVENTO REALIZADO</option>
                                                <option value="EVENTO_NO_REALIZADO">EVENTO NO REALIZADO</option>
                                                <option value="ACTO_REVOCADO">ACTO REVOCATORIO</option>
                                                <option value="EVENTO_FINALIZADO">SOLICITUD CERRADA</option>
                                                <option value="DEVOLUCION_GARANTIA">DEVOLUCION DE GARANTIA</option>
                                                <option value="RECHAZADA">SOLICITUD RECHAZADA</option>
                                                <option value="EVENTO_CANCELADO">EVENTO CANCELADO</option>
                                                <option value="PAGO_REALIZADO">PAGO REALIZADO</option>

                                            </select>
                                            @error('estado_solicitud')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </td>
                                    <td colspan="2">
                                        <div class="form-group">
                                            <label for="observaciones">Observaciones*</label>
                                            <textarea name="observaciones_solicitud" id="observaciones_espectaculos"
                                                onkeypress="return Observaciones(event)" maxlength="500"
                                                class="form-control  @error('observaciones_solicitud') is-invalid @enderror"
                                                id="observaciones" cols="2" rows="3" required></textarea>
                                            @error('observaciones_solicitud')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                            @enderror


                                        </div>
                                    </td>
                                </tr>
                    @if ($errors->any())
                    <tr>
                        <td colspan="2">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                        </div>
                        </td>
                    </tr>
                    @endif 

                   @if($solicitud->adj_otros != null && ($solicitud->estado_solicitud =='ENVIADA' || $solicitud->estado_solicitud =='DOCUMENTOS_ACTUALIZADOS'))

                   <tr>
                    <td colspan="1">
                        <div class="form-group">
                            <label for="arch_acto_revocatorio">Exento de Impuesto?*</label>
                            <select class="form-control" name="exento_imp" id="exento_imp" required>
                                <option value="">Seleccione</option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                            @error('arch_acto_revocatorio')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </td>

                    <td colspan="2"></td>

                </tr>
                   
                   @endif


                                <tr class="caja-garantia d-none animate__backInUp">
                                    <td><strong>Tipo de garantia*:</strong><br>
                                        <input value="{{ $solicitud->tipo_garantia }}" type="text"
                                            class="form-control name_validate  @error('tipo_garantia') is-invalid @enderror garantia"
                                            name="tipo_garantia" id="tipo_garantia" placeholder="Ejemplo: CHEQUE"
                                            maxlength="25" minlength="4" onkeypress="return Letras(event)"
                                            onkeyup="aMayusculas(this.value,this.id)">
                                        @error('tipo_garantia')
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </td>

                                    <td><strong>N° de Poliza o Cheque*:</strong><br>
                                        <input type="text"
                                            class="form-control document_validate  @error('numero_poliza_cheque') is-invalid @enderror garantia"
                                            name="numero_poliza_cheque" id="numero_poliza_cheque" maxlength="30"
                                            minlength="4" onkeypress="return Numeros(event)">
                                        @error('numero_poliza_cheque')
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </td>

                                    <td><strong>Valor Garantia*:</strong><br>
                                        <input type="text"
                                            class="form-control @error('valor_poliza') is-invalid @enderror garantia"
                                            name="valor_poliza" id="valor_poliza" maxlength="30" minlength="4"
                                            onkeypress="return Numeros(event)">
                                        <input type="hidden" name="valor_poliza_cheque" id="valor_poliza_cheque">
                                        @error('valor_poliza')
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </td>
                                </tr>
                                <tr class="caja-garantia d-none animate__backInUp">
                                    <td>
                                        <div class="form-group">
                                            <label for="arch_documentoGarantia">Adjuntar Garantía escaneada*</label>
                                            <input type="file" accept="application/pdf" name="arch_documentoGarantia"
                                                id="arch_documentoGarantia"
                                                class="form-control @error('arch_documentoGarantia') is-invalid @enderror garantia size_documents">
                                            @error('arch_documentoGarantia')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </td>
                                    <td colspan="2">
                                        <div class="form-group">
                                            <label for="arch_acta_reunion">Adjuntar Acta de Entrega*</label>
                                            <input type="file" accept="application/pdf" name="arch_acta_reunion"
                                                id="arch_acta_reunion"
                                                class="form-control @error('arch_acta_reunion') is-invalid @enderror garantia size_documents">
                                            @error('arch_acta_reunion')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </td>


                                </tr>

                                <tr class="caja-acto d-none">
                                    <td>
                                        <div class="form-group">
                                            <label for="arch_acto_administrativo">Adjunte Acto Administrativo*</label>
                                            <input type="file" accept="application/pdf" name="arch_acto_administrativo"
                                                id="arch_acto_administrativo"
                                                class="form-control @error('arch_acta_reunion') is-invalid @enderror size_documents">
                                            @error('arch_acto_administrativo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </td>

                                </tr>

                                <tr class="caja-acto-revoca d-none">
                                    <td>
                                        <div class="form-group">
                                            <label for="arch_acto_revocatorio">Adjunte Acto Administrativo
                                                Revocatorio*</label>
                                            <input type="file" accept="application/pdf" name="arch_acto_revocatorio"
                                                id="arch_acto_revocatorio"
                                                class="form-control @error('arch_acta_reunion') is-invalid @enderror size_documents">
                                            @error('arch_acto_revocatorio')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </td>

                                </tr>

                                <tr class="caja-acta-reunion d-none">
                                    <td>
                                        <div class="form-group">
                                            <label for="arch_actReu_revocatorio">Adjuntar Acta de Reunion*</label>
                                            <input type="file" accept="application/pdf" name="arch_actReu_revocatorio"
                                                id="arch_actReu_revocatorio"
                                                class="form-control @error('arch_acta_reunion') is-invalid @enderror size_documents">
                                            @error('arch_actReu_revocatorio')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </td>

                                </tr>

                                <tr>
                                    {{-- <td>
                            <div class="form-group">
                                <label for="documento_respuesta">Cargar Respuesta</label>
                                <input type="file" accept="application/pdf" name="documento_respuesta" id="documento_respuesta" class="form-control @error('observaciones_solicitud') is-invalid @enderror" disabled>
                                @error('documento_respuesta')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>

                        </td> --}}
                                    <td colspan="2">
                                        <div class="form-group">
                                            <input type="hidden" id="estado_espectaculos_hidden"
                                                value="{{ $solicitud->estado_solicitud }}">
                                            <input type="hidden" name="username" value="{{ auth()->user()->username }}">
                                            <input type="hidden" name="id" value="{{ $solicitud->id }}">
                                            <button type="submit"
                                                onclick="return confirm('¿Esta seguro de generar esta respuesta ?')"
                                                id="myBtnEspectaculos"
                                                class="btn btn-round btn-middle btn-outline-info btn_enviar_solicitud"
                                                id="Boton">Actualizar estado</button>
                                            <button style="font-size:15px;"
                                                class="btn btn-round btn-middle btn_carga d-none" type="button"
                                                disabled><span class="spinner-grow spinner-grow-sm text-primary"
                                                    role="status" aria-hidden="true"></span> Actualizando estado...</button>
                                            <a href="{{ url('/tramites/hacienda/espectaculos') }}"
                                                class="btn btn-round btn-high">Volver</a>



                                        </div>
                                    </td>
                                </tr>
                            </form>
                            {{-- fin del form --}}











                        </tbody>
                    </table>
                </div>


            </div>
        </div>



    </div>

@endsection
