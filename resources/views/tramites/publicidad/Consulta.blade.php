@extends('layouts.app')
@section('title', 'Registro de publicidad exterior visual')
@section('content')
<style>
    .clockpicker-button {
        background-color: #3366CC !important;
        color: white !important;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 24px;
    }

    td {
        width: 50%;
    }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container mt-3 mb-4 m-xs-x-3" id="body_eventos">
    @include('tramites.titulo')

    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">


                <h3 class="headline-l-govco mt-3 pl-0">Publicidad exterior visual</h3>

                <h4>Solicitante:</h4>
                <!-- Tabla Solicitante-->
                <table>
                    <tr>
                        <td>Nombre o Razón social:</td>
                        <td>{{ $Persona->PersonaNombre }} {{ $Persona->PersonaApe }}</td>
                    </tr>

                    <tr>
                        <td>Tipo y número de documento:</td>
                        <td>{{ $Persona->PersonaTipDoc }} {{ $Persona->PersonaDoc }}</td>
                    </tr>

                    <tr>
                        <td>Correo electrónico:</td>
                        <td>{{ $Persona->PersonaMail }}</td>
                    </tr>
                </table>

                <h4>Datos de la publicidad:</h4>
                <!-- Tabla Predio-->
                <table>
                    <tr>
                        <td>Modalidad:</td>
                        <td>{{ $Solicitud->modalidad }}</td>
                    </tr>

                </table>
                <h4>Solicitud:</h4>
                <!-- Tabla Solicitud-->
                <table>
                    <tr>
                        <td>Número de radicado:</td>
                        <td>{{ $Solicitud->radicado }}</td>
                    </tr>

                    <tr>
                        <td>Estado de la solicitud:</td>
                        <td class="@if($Solicitud->estado_solicitud=='APROBADA'){{'text-success font-bold'}}@else{{''}}@endif">{{ $Solicitud->novedad }}</td>

                    </tr>
                    <tr>
                        <td>Dependencia:</td>
                        <td class="font-bold">{{ $Solicitud->dependencia }}</td>
                    </tr>


                    @if (isset($documento))
                    <tr style="background-color:#004884">
                        <td colspan="3" style="background-color:#004884; color:white">Documentos Adjuntos</td>
                    </tr>

                    <tr>
                        <td colspan="3">
                            <div class="row">
                                <div class="col-xs-12 col-md-6 col-xl-6">
                                    <label>{{ $documento->nombre_adjunto }}:</label><br>
                                    <a href="{{asset('storage/' .$documento->ruta)}}" target=" _blank">Descargar
                                        documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endif
                    @if(isset($liquidacion))
                    <tr>
                        <td class="py-2" colspan="3">
                            <p>Esta pendiente realizar el pago de la liquidación para continuar con el proceso</p>
                            <a class="badge badge-success" href="{{$liquidacion[0]->url_pago}}" target="_blank">
                                <h6 class="my-0 text-white">Descargar recibo o pagar en línea</h6>
                            </a>
                        </td>
                    </tr>
                    @endif
                </table>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                @include('tramites.publicidad.informativo')
            </div>
        </div>
    </div>
</div>
@include('tramites.publicidad.form_consulta')
@endsection
