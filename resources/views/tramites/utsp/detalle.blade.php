@extends('layouts.menu')
@section('title', 'Modulo de Gestion UTSP')

@section('dashboard')
<style>
    .loader {
            position: relative;
            text-align: center;
            margin: 15px auto 35px auto;
            z-index: 9999;
            display: block;
            width: 80px;
            height: 80px;
            border: 10px solid rgba(0, 0, 0, .3);
            border-radius: 50%;
            border-top-color: #004884;
            animation: spin 1s ease-in-out infinite;
            -webkit-animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                -webkit-transform: rotate(360deg);
            }
        }

        @-webkit-keyframes spin {
            to {
                -webkit-transform: rotate(360deg);
            }
        }
        body {
        overflow-x: hidden!important;
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
                            <a style="color: #004fbf;" class="breadcrumb-text" href="#">Tramites en Linea</a>
                        </div>
                    </li>
                    <li class="breadcrumb-item ">
                        <div class="image-icon">
                            <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                            <a style="color: #004fbf;" class="breadcrumb-text" href="{{route('utsp.index')}}">UTSP</a>
                        </div>
                    </li>
                    <li class="breadcrumb-item ">
                        <div class="image-icon">
                            <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                            <a style="color: #004fbf;" class="breadcrumb-text" href="{{route('utsp.loadData')}}">Registrar Actuacion</a>
                        </div>
                    </li>
                    <li class="breadcrumb-item ">
                        <div class="image-icon">
                            <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                            <p class="ml-3 ml-md-0 "><b style="color: #004fbf;text-transform: none;">
                                    Trazabilidad de Solicitud
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
                <table style="width: 100%;" class="table display table-responsive-md table-responsive-md"  cellpadding="20" width="100%">
                  <thead>
                    <tr>
                      <th colspan="3">
                        Caso N° {{$solicitud->radicado}} - {{$solicitud->fecha_radicacion}}
                      </th>
                    </tr>
                  </thead>
                <tbody>
                <tr>
                <td><strong>Radicado N°&nbsp;<br>
               </strong>{{$solicitud->radicado}}</td>
                <td><strong>Nombre del Usuario/Solicitante:</strong><br>
                    {{$solicitud->nombre_usuario}} {{$solicitud->apellido_usuario}}
                </td>
                <td><strong>Número de Identificación</strong><br>
                    {{$solicitud->tipo_documento}}-{{$solicitud->numero_documento}}
               </td>                 
                 
               
                </tr>
                <tr>
                
                <td colspan="2"><strong>Direccion del Usuario/Solicitante</strong>
                <br>{{$solicitud->direccion}} - {{$solicitud->nombre_barrio}}                    
               </td>
               <td><b>Comuna:</b><br> {{$solicitud->comuna}} </td>                    
                </tr>

                <tr>
                <td><strong>Telefono Usuario/Solicitante:</strong><br>
                    {{$solicitud->telefono}}
                </td>
                <td><strong>Correo Usuario/Solicitante:</strong><br>
                    {{$solicitud->correo_electronico}}
                </td>
                <td><strong>Fecha de Radicacion</strong><br>
                    {{$solicitud->fecha_radicacion}}
                 </td>
                </tr>

                 <tr>                
                <td colspan="2"><strong>Asunto:</strong><br>
                    {{$solicitud->asunto}}
                </td>
                             
                <td colspan="1"><strong>Empresa de Servicios Publicos:</strong><br>
                    {{$solicitud->empresa_publica}}
                </td>
                             
                
                </tr>

                 <tr>
                <td><strong>Tipo de Atencion:</strong><br>
                    {{$solicitud->tipo_atencion}}
                </td>
                <td><strong>Tipo de Servicio:</strong><br>
                    {{$solicitud->tipo_servicio}}
                </td>  
                <td><strong>Funcionario Responsable:</strong><br>
                    {{$solicitud->username}}

                </td>                
                
                               
                </tr>
               

             

                <tr style="background-color:#004884">
                    <td colspan="3" style="background-color:#004884; color:white">Trazabilidad de la Solicitud</td>
                </tr>

              
                <tr>
                    <td colspan="3">

                        <table class="table table-bordered">
                            <thead style="background-color: black">
                                <th class="text-center">#</th>
                                <th class="text-center">Tramite</th>
                                {{-- <th class="text-center">Empresa de servicios publicos</th> --}}
                                <th class="text-center">Fecha</th>
                                <th class="text-center">Observacion</th>
                                <th class="text-center">Funcionario</th>
                                <th class="text-center">Documentos</th>
                            </thead>
                            <tbody>
                                @foreach($solicitud['observaciones'] as $observaciones)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="text-center">{{$observaciones->tipo_tramite}}</td>
                                    {{-- <td class="text-center">{{$observaciones->empresa_servicios}}</td> --}}
                                    <td class="text-center">{{$observaciones->fecha}}</td>
                                    <td class="text-center">{{$observaciones->observacion}}</td>
                                    <td class="text-center">{{$observaciones->user->name}}</td>
                                    <td class="text-center">
                                        <ol>
                                        @foreach($observaciones->documentos as $documento)
                                        <li style="font-size:14px;">
                                        <a  style="font-size:14px;"href="{{ asset($documento->ruta) }}" target="_blank">{{ $documento->nombre_documento }}🗎</a>
                                    </li>
                                    @endforeach
                               </ol>      
                                                            
                                </td>
                            </tr>
                                @endforeach
                            </tbody>

                        </table>


                       
                    </td>

                </tr>

                <tr style="background-color:#004884">
                    <td colspan="3" style="background-color:#004884; color:white">Estado del Tramite</td>
                </tr>

                <tr>
                    <td colspan="3"><strong>Estado de la solicitud:</strong><br>
                        @if ($solicitud->estado_solicitud == 'ABIERTO')
                                    <p style="color: #069169;font-weight:bold">ABIERTA<span class="govco-icon govco-icon-check-p size-1x"></span></p>
                                     
                                     @elseif($solicitud->estado_solicitud == 'CERRADO')
                                     <p style="color: #A80521;font-weight:bold">CERRADA<span class="govco-icon govco-icon-x-n size-1x"></span></p>
                        @endif                        
                    </td>              
                </tr>             
                
             
                <tr style="background-color:#004884">
                    <td colspan="3" style="background-color:#004884; color:white">Actuar Sobre la solicitud</td>
                </tr>
                <form id="formUTSPAction" class="formUTSPAction" method="POST"  enctype="multipart/form-data">   @csrf
                <tr>
                   
                    <td colspan="2">
                        <div class="form-group">
                            <label for="tipo_tramite" class="form-label">Tipo de tramite* </label>
                            <select name="tipo_tramite" id="tipo_tramite" class="form-control  @error('tipo_tramite') is-invalid  @enderror" required>
                                <option value="">Seleccione..</option>
                                @foreach ($tipos_tramite as $key => $value)
                                <option value="{{$value}}">{{$value}}</option>
                                    
                                @endforeach
                            </select>
                             @error('tipo_tramite')
                             <span class="invalid-feedback" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                                 </span>
                             @enderror

                        
                        </div>
                    </td>
                    <td colspan="1">
                        <div class="form-group">
                            <label for="fecha" class="form-label">Fecha * </label>
                           <input value="{{old('fecha', $date)}}" type="date" class="form-control  @error('fecha') is-invalid @enderror" name="fecha" id="fecha" max="{{date('Y-m-d')}}"  required>
                           @error('fecha')
                           <span class="invalid-feedback" role="alert">
                              <strong class="text-danger">{{ $message }}</strong>
                               </span>
                           @enderror
                            

                        
                        </div>
                    </td>
                   
                   
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="form-group">
                         <label for="observaciones_planeacion">Observaciones de la accion a esta solicitud*</label>
                         <textarea placeholder="Observaciones de la accion a esta solicitud ..." class="form-control @error('observacion') is-invalid  @enderror" name="observacion" id="observacion" onkeypress="return NumDoc(event)" onkeyup="aMayusculas(this.value,this.id)" maxlength="600" rows="3" style="resize: none;" minlength="10" required></textarea>
                             @error('observaciones_planeacion')
                            <span class="invalid-feedback" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </span>
                        @enderror

                        
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="form-group">
                            <label for="asunto" class="form-label">Documentos adjuntos a las acciones de esta solicitud (.PDF)* </label><br>

                           
                            <label for="attachment">
                                <a class="btn btn-round btn-middle btn-outline-info"
                                    role="button" aria-disabled="false">+ Añadir Archivos</a>
 
                            </label>
                            <input type="file" name="evidencias[]"
                                accept="application/pdf"
                                id="attachment" style="visibility: hidden; position: absolute;"
                                class="info_evidencias" multiple />
 
                            </p>
                            <div id="files-area">
                                <span id="filesList">
                                    <span id="files-names"></span>
                                </span>
                            </div>
                            @error('evidencias')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                    <div class="form-group">
                        <label for="estado_solicitud" class="form-label">Estado de la solicitud* </label>
                        <select name="estado_solicitud" id="estado_solicitud" class="form-control  @error('estado_solicitud') is-invalid  @enderror" required>
                            <option value="">Seleccione..</option>                           
                            <option value="ABIERTO" {{ $solicitud->estado_solicitud == 'ABIERTO' ? 'selected' : ''}}>ABIERTO</option>                           
                            <option value="CERRADO" {{ $solicitud->estado_solicitud == 'CERRADO' ? 'selected' : ''}}>CERRADO</option>                           
                        </select>
                         @error('estado_solicitud')
                         <span class="invalid-feedback" role="alert">
                            <strong class="text-danger">{{ $message }}</strong>
                             </span>
                         @enderror

                    
                    </div>
                </td>

                </tr>

                <tr>                    
                    <td colspan="2">
                        <div class="form-group">                       
                                                     
                            <input type="hidden" name="id_solicitud" id="id_solicitud" value="{{$solicitud->id}}">
                            <input type="hidden" name="empresa_publica" id="empresa_publica" value="{{$solicitud->empresa_publica}}">
                            
                            <button style="font-size:15px;" type="submit" class="btn btn-round btn-middle" name="consultar" onclick="return confirm('¿Esta seguro de realizar accion ?')" >Registrar Actuacion</button>
                           
                            <a href="{{ URL::route('utsp.loadData') }}" class="btn btn-round btn-high">Volver</a>                       </div>
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

@push('utsp')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script type="text/javascript" src="{{ asset('js/utsp-action.js') }}"></script>

@endpush

 {{-- modal de carga --}}
 <div class="modal fade" id="loadMe" tabindex="-1" role="dialog" aria-labelledby="loadMeLabel">
   <div class="modal-dialog modal-sm" role="document">
       <div class="modal-content">
           <div class="modal-body text-center">
               <div class="loader"></div>
               <div clas="loader-txt">
                   <p>Realizando Actuaciones <br><br><small>Por favor espere...
                       </small></p>
               </div>
           </div>
       </div>
   </div>
</div>


@endsection
