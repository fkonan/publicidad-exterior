@extends('layouts.menu')

@section('dashboard')
<style>
    th.sorting_desc::after, th.sorting_asc::after{
      right: -16px!important;
   }
</style>

    <div class="container mt-3 mb-4 m-xs-x-3 pgirh">
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
                                <p class="ml-3 ml-md-0 "><b style="color: #004fbf;text-transform: none;">
                                        Registrar Actuación
                                    </b></p>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="col-md-12 pt-4">
            <h1 class="headline-xl-govco">Registro de Solicitudes Abiertas</h1>
            <div class="row pt-3">               
                <div class="col-md-12 justify-content-center">

                    <div class="card govco-card animate__animated animate__bounceInRight">
                        <div class="card-header govco-card-header">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="#0022cc" d="M8 17q.425 0 .713-.288T9 16q0-.425-.288-.713T8 15q-.425 0-.713.288T7 16q0 .425.288.713T8 17Zm0-4q.425 0 .713-.288T9 12q0-.425-.288-.713T8 11q-.425 0-.713.288T7 12q0 .425.288.713T8 13Zm0-4q.425 0 .713-.288T9 8q0-.425-.288-.713T8 7q-.425 0-.713.288T7 8q0 .425.288.713T8 9Zm3 8h6v-2h-6v2Zm0-4h6v-2h-6v2Zm0-4h6V7h-6v2ZM5 21q-.825 0-1.413-.588T3 19V5q0-.825.588-1.413T5 3h14q.825 0 1.413.588T21 5v14q0 .825-.588 1.413T19 21H5Zm0-2h14V5H5v14ZM5 5v14V5Z"/></svg>
                         Solicitudes
                        </div>

                        <div class="col-md-12 justify-content-center pt-4">
                            <div id="container_table" class="table-pagination-govco">

                                <table id="DataTables_Table_0"
                                    class="table display table-responsive-sm table-responsive-md tablas-pgirh" width="100%"
                                    style="text-align: left!important;">
                                    <thead>
                                        <tr>
                                            <th style="color: #004884;" class="text-center">Radicado</th>
                                            <th style="color: #004884;" class="text-center">Usuario</th>
                                            <th style="color: #004884;"  class="text-center">Documento</th>                                          
                                            <th style="color: #004884;"  class="text-center">Asunto</th>
                                            <th style="color: #004884;"  class="text-center">Fecha</th>                                            
                                            <th style="color: #004884;"  class="text-center">Acciones</th>

                                        </tr>
                                    </thead>
                                    @foreach ($atenciones as $solicitud)
                                    <tr>
                                        <td class="text-center">{{$solicitud->radicado}}</td>
                                       <td class="text-center">{{$solicitud->nombre_usuario}} {{$solicitud->apellido_usuario}}</td>
                                       <td  class="text-center">{{$solicitud->numero_documento}}</td>
                                        <td  class="text-center">{{$solicitud->asunto}}</td>
                                       <td  class="text-center">{{$solicitud->fecha_radicacion}} </td>                                    
                                     
                                   
                                       <td  class="text-center">
                                        <div class="btn-group d-flex justify-content-center" role="group">
                                            <a type="button" class="btn-symbolic-govco align-column-govco" href="{{route('utsp.loadTrazabilidad', $solicitud->id)}}">
                                                <svg style="margin-left:40px;" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                                    <path fill="#004884" d="M4 18h16V6H4v12zm7.5-11c2.49 0 4.5 2.01 4.5 4.5c0 .88-.26 1.69-.7 2.39l2.44 2.43l-1.42 1.42l-2.44-2.44c-.69.44-1.51.7-2.39.7C9.01 16 7 13.99 7 11.5S9.01 7 11.5 7z" opacity=".3"/>
                                                    <path fill="#004884" d="M11.49 16c.88 0 1.7-.26 2.39-.7l2.44 2.44l1.42-1.42l-2.44-2.43c.44-.7.7-1.51.7-2.39C16 9.01 13.99 7 11.5 7S7 9.01 7 11.5S9.01 16 11.49 16zm.01-7a2.5 2.5 0 0 1 0 5a2.5 2.5 0 0 1 0-5zM20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 14H4V6h16v12z"/>
                                                </svg>
                                                <span class="btn-govco-text">Ver Trazabilidad</span>
                                            </a>
                                        </div>
                                       </td>

                                    </tr>
                                        
                                    @endforeach


                                    </tbody>

                                </table>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <a class="btn btn-round btn-high" href="{{ URL::route('utsp.index') }}" style="float: left;">Volver</a>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
    </div>

    </div>     

@endsection


