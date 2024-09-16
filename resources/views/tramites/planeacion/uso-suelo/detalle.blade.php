@extends('layouts.menu')

@section('dashboard')
    <style>
      
    </style>

    <div class="container mt-3 mb-4 m-xs-x-3 ">

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
                                <a style="color: #004fbf;" class="breadcrumb-text" href="#">
                                    Planeacion</a>
                            </div>
                        </li>
                        <li class="breadcrumb-item ">
                            <div class="image-icon">
                                <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                                <p class="ml-3 ml-md-0 "><b style="color: #004fbf;text-transform: none;">
                                        Concepto de Uso de Suelo
                                    </b></p>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="col-md-12 pt-4" style="padding-left: 10px!important">
            <h1 class="headline-xl-govco">Solicitud N° {{$solicitud[0]->id_concepto}}</h1>
            <div class="row pt-5">

                <div style="" class="table-simple-headblue-govco col-md-12 animate__animated animate__bounceInRight">              
                    <table style="width: 100%;" class="table display table-responsive-md table-responsive-md"  cellpadding="20" width="100%">
                      <thead>
                        <tr>
                          <th colspan="3">
                            Solicitud N GOTUS° - {{$solicitud[0]->id_concepto}} 
                          </th>
                        </tr>
                      </thead>
                    <tbody>
                    <tr>
                    <td><strong>Radicado N°-&nbsp;<br>
                   </strong>{{$solicitud[0]->radicado}}</td>
                    <td><strong>Nombre del solicitante:</strong><br>
                        {{$solicitud[0]->nombre_solicitante}}
                    </td>   
                    <td><strong>Número de Identificación</strong><br>
                        {{$solicitud[0]->tipo_documento}} {{$solicitud[0]->documento_solicitante}}
                   </td>              
                     
                   
                    </tr>
                    <tr>                    
                    <td><strong>Fecha de expedición del documento</strong>
                    <br>{{$solicitud[0]->fecha_expedicion ? $solicitud[0]->fecha_expedicion : 'NO REGISTRA'}}                 
                   </td>  
                   <td><strong>Telefono solicitante:</strong><br>
                    {{$solicitud[0]->telefono_solicitante}}
                     </td> 
                     <td><strong>Correo Solicitante:</strong><br>
                        {{$solicitud[0]->correo_solicitante}}
                    </td>                 
                    </tr>

                    <tr>
                    
                   
                    <td><strong>Direccion Solicitante:</strong><br>
                        {{$solicitud[0]->direccion_solicitante}}
                     </td>
                     <td><strong>Direccion Validada</strong><br>
                        {{$solicitud[0]->direccion_ipu ? $solicitud[0]->direccion_ipu : 'NO REGISTRA'}}
                    </td>
                    <td><strong>Codigo Predial:</strong><br>
                        {{$solicitud[0]->codigo_predial}}
                    </td>
                    </tr>   
    
                     <tr>
                    <td><strong>Unidad</strong><br>
                        {{$solicitud[0]->unidad}}
                    </td>
                    <td><strong>Barrio:</strong><br>
                        {{$solicitud[0]->barrio ? $solicitud[0]->barrio:'NO REGISTRA'}}
                    </td>                
                    <td><strong>Estrato:</strong><br>
                        {{$solicitud[0]->estrato ? $solicitud[0]->estrato:'NO REGISTRA'}}
                    </td>                
                                   
                    </tr>
                   
                     <tr>
                    <td><strong>Estado:</strong><br>
                        <b>{{$solicitud[0]->ConEstado}}</b>
                    </td>
                    <td><strong>Zona Normativa:</strong><br>
                        {{$solicitud[0]->ConZonNor}}
                    </td>                
                    <td><strong>Area en Metros:</strong><br>
                        {{$solicitud[0]->ConAreCon}}
                    </td>                
                                   
                    </tr>
                    
                    @if($solicitud[0]->ConMotInc)
                     <tr>
                    <td colspan="3"><strong>Motivo:</strong><br>
                        {{$solicitud[0]->ConMotInc}}
                    </td>                    
                    @endif                
                                   
                                   
                    </tr> 

                     <tr>
                    <td><strong>Tratamiento Urbanistico</strong><br>
                        {{$solicitud[0]->ConTraUrb}}
                    </td>
                    <td colspan="2"><strong>Descargue el Concepto:</strong><br>
                        <a href="{{$solicitud[0]->documento}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                    </td>                
                                   
                                   
                    </tr>              
                                                     
                   
                      
                   
    
                    </tbody>
                    </table>
                     </div>


            </div>
            
        </div>
        <div class="col-md-3 pl-0 mr-0">
            <a class="btn btn-round btn-high" href="{{ URL::route('tramites.planeacion.reportes.uso') }}"
                style="float: left;">Volver</a>
        </div>



    </div>
   
@endsection
