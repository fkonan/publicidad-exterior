@extends('layouts.menu')

@section('dashboard')
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
                     <a style="color: #004fbf;" class="breadcrumb-text" href="#">Trámites en Línea</a>
                  </div>
               </li>
               <li class="breadcrumb-item ">
                  <div class="image-icon">
                     <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                     <a style="color: #004fbf;" class="breadcrumb-text" href="#">
                        Interior</a>
                  </div>
               </li>
               <li class="breadcrumb-item ">
                  <div class="image-icon">
                     <span class="breadcrumb govco-icon govco-icon-shortr-arrow" style="height: 22px;"></span>
                     <p class="ml-3 ml-md-0 ">
                        <b style="color: #004fbf;text-transform: none;">
                           Publicidad Exterior
                        </b>
                     </p>
                  </div>
               </li>
            </ol>
         </nav>
      </div>
   </div>

   <div class="col-md-12 pt-4" style="padding-left: 10px!important">
      <h1 class="headline-xl-govco">Administración Solicitud</h1>
      <div class="row pt-3">
         <div class="table-simple-headblue-govco col-md-12 animate__animated animate__bounceInRight">
            <table class="table table-responsive-md table-responsive-md">
               <thead>
                  <tr>
                     <th colspan="3">
                        Solicitud N° - {{ $solicitud->radicado }}
                     </th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>
                        <strong>Radicado N°&nbsp;<br></strong>{{ $solicitud->radicado }}
                     </td>
                     <td>
                        <strong>Tipo doc. del solicitante:</strong><br>
                        {{ $persona->PersonaTipDoc }}
                     </td>
                     <td><strong>Número de documento:</strong><br>
                        {{ $persona->PersonaDoc }}
                     </td>
                  </tr>
                  <tr>
                     @if($persona->PersonaTipo == 'Juridica')
                     <td><strong>Razón social:</strong><br>
                        {{ $persona->PersonaRazon }}
                     </td>
                     @else
                     <td><strong>Nombre del solicitante:</strong><br>
                        {{ $persona->PersonaNombre }} {{ $persona->PersonaApe }}
                     </td>
                     @endif
                     <td><strong>Teléfono/celular:</strong><br>
                        {{ $persona->PersonaTel }}
                     </td>
                     <td><strong>Correo eletrónico:</strong><br>
                        {{ $persona->PersonaMail }}
                     </td>
                  </tr>
                  <tr>
                     <td><strong>Modalidad de la publicidad</strong><br>
                        {{ $solicitud->modalidad }}
                     </td>
                     @if($solicitud->modalidad=='vallas')
                     <td><strong>Tipo de valla</strong>
                        <br>{{ $detalle->tipo_valla }}
                     </td>
                     @endif
                     <td><strong>Tipo de publicidad</strong>
                        <br>{{ $solicitud->tipo_publicidad }}
                     </td>
                  </tr>

                  <tr>
                     <td><strong>Alto de la publicidad</strong><br>
                        {{ $detalle->alto_elemento }} (mts2)
                     </td>
                     <td><strong>Ancho de la publicidad</strong><br>
                        {{ $detalle->ancho_elemento }} (mts2)
                     </td>
                     <td><strong>No de caras</strong><br>
                        {{ $detalle->numero_caras }}
                     </td>

                  </tr>
                  <tr>
                     <td><strong>Área total (mts2)</strong><br>
                        {{ $detalle->area_total_elemento }}
                     </td>
                     <td><strong>Número de elementos</strong><br>
                        {{ $solicitud->numero_elementos }}
                     </td>
                     <td><strong>Ubicación del aviso</strong><br>
                        {{ $detalle->direccion_elemento }}
                     </td>
                  </tr>


                  <tr style="background-color:#004884">
                     <td colspan="32" style="background-color:#004884; color:white">Administración del Trámite
                     </td>
                  </tr>
                  <tr>
                     <td><strong>Estado de la solicitud:</strong><br>
                        <p style="color: #069169;font-weight:bold">{{$solicitud->estado_solicitud}} <span
                              class="govco-icon govco-icon-check-p size-1x"></span></p>
                        </p>
                     </td>
                     <td><strong>Fecha y hora de la solicitud</strong><br>
                        {{ $solicitud->created_at }}
                     </td>
                     <td></td>
                  </tr>

                  <!-- Documentos -->
                  @include('tramites.interior.publicidad.documentos')

                  <!-- Novedades -->
                  @include('tramites.interior.publicidad.novedades')
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
@endsection
<div class="modal fade" id="modalLiq" tabindex="-1" role="dialog" aria-labelledby="modalLiqLabel" aria-hidden="true"
   tabindex="1">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="modalLiqLabel">Detalle de la liquidación</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            @php
            $fecha_inicial = date_create($detalle->fecha_inicial_fijacion);
            $fecha_final = date_create($detalle->fecha_final_fijacion);
            $resultado = date_diff($fecha_inicial, $fecha_final);
            $dias = $resultado->format('%R%a');
            // $mes = $resultado->format('%m');
            $mes = $dias / 30;
            $valor_m2 = round((1000000 * 4) / 48, 2);
            $area = $detalle->alto_publicidad * $detalle->ancho_publicidad;
            $valor_mensual = round(($area * $valor_m2) / 12, 2);
            $valor_transitoria = round(($area * 1000000) / 48, 2);
            $tipo_liquidacion = '';

            if ($mes > 0) {
            $valor_total = $valor_mensual * $mes;
            $tipo_liquidacion = 'PERMANENTE';
            } else {
            $valor_total = $valor_transitoria;
            $tipo_liquidacion = 'TRANSITORIA';
            }
            @endphp
            <form method="POST" action="{{ route('interior.publicidad.liquidacion') }}" id="frmLiquidacion"
               enctype="multipart/form-data">
               @csrf
               <div class="row form-group">
                  <input type="hidden" value="{{ $detalle->publicidad_id }}" class="form-control" name="SolicitudId"
                     readonly id="publicidad_id">

                  <div class="col-md-3">
                     <label for="tipo_liquidacion" class="form-label">Tipo de liquidación</label>
                     <input type="text" value="{{ $tipo_liquidacion }}" class="form-control" name="tipo_liquidacion"
                        readonly id="tipo_liquidacion">
                  </div>

                  <div class="col-md-3">
                     <label for="salario_minimo" class="form-label">Salario minimo</label>
                     <input type="text" value="{{ '1.000.000' }}" class="form-control" name="salario_minimo" readonly
                        id="salario_minimo">
                  </div>
                  <div class="col-md-3">
                     <label for="area_publicidad" class="form-label">Área mt2</label>
                     <input type="number" value="{{ $area }}"
                        class="form-control  @error('area_publicidad') is-invalid @enderror" name="area_publicidad"
                        id="area_publicidad" required readonly>
                  </div>
                  <div class="col-md-3">
                     <label for="dias" class="form-label">Días de la publicidad</label>
                     <input type="number" value="{{ $dias + 0 }}"
                        class="form-control  @error('dias') is-invalid @enderror" name="dias" id="dias" required
                        readonly>
                  </div>

               </div>
               <div class="row">
                  <div class="col-md-3 d-none divPerma">
                     <label for="valor_m2" class="form-label">Valor M2</label>
                     <input type="number" value="{{ $valor_m2 }}"
                        class="form-control  @error('valor_m2') is-invalid @enderror" name="valor_m2" id="valor_m2"
                        required readonly>
                  </div>
                  <div class="col-md-3 d-none divPerma">
                     <label for="valor_mensual" class="form-label">Valor nensual</label>
                     <input type="number" value="{{ $valor_mensual }}"
                        class="form-control  @error('valor_mensual') is-invalid @enderror" name="valor_mensual"
                        id="valor_mensual" required readonly>
                  </div>
                  <div class="col-md-3 d-none divPerma">
                     <label for="meses_pautar" class="form-label">Meses a pautar</label>
                     <input type="number" value="{{ $mes }}"
                        class="form-control  @error('meses_pautar') is-invalid @enderror" name="meses_pautar"
                        id="meses_pautar" required readonly>
                  </div>
                  <div class="col-md-3">
                     <label for="valor_total_mostrar" class="form-label">Valor total</label>
                     <input type="text" value="${{ number_format($valor_total, 2) }}"
                        class="form-control  @error('valor_total_mostrar') is-invalid @enderror"
                        name="valor_total_mostrar" id="valor_total_mostrar" required readonly>

                     <input type="hidden" value="{{ $valor_total }}"
                        class="form-control  @error('valor_total') is-invalid @enderror" name="valor_total"
                        id="valor_total" required readonly>
                  </div>

                  <div class="col-md-3">
                     <label for="fecha_limite_mostrar" class="form-label">Fecha límite</label>
                     <input type="date" value="{{$fecha_limite}}"
                        class="form-control  @error('fecha_limite_mostrar') is-invalid @enderror"
                        name="fecha_limite_mostrar" id="fecha_limite_mostrar" required>

                     <input type="hidden" value="{{ $fecha_limite }}"
                        class="form-control  @error('fecha_limite') is-invalid @enderror" name="fecha_limite"
                        id="fecha_limite" required readonly>
                  </div>


                  {{-- <div class="col-md-5">
                     <label for="documento_respuesta">Cargar Respuesta</label>
                     <input type="file" accept="application/pdf" name="documento0" id="documento_respuestaH"
                        class="form-control @error('documento0') is-invalid @enderror" @if ($solicitud->dependencia ==
                     'SALUD' ||
                     $solicitud->dependencia == 'PLANEACION' ||
                     $solicitud->dependencia == 'HACIENDA') required @endif>
                     @error('documento0')
                     <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                     </span>
                     @enderror
                  </div> --}}

                  <div class="col-md-5 pt-4">
                     <label for="documento_respuesta">Resolución:</label>
                     <a href="downoadPdf/{{$detalle->publicidad_id}}" target="_blank">Descargar</a>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-primary">Guardar</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<script>
   function cargarLiquidacion() {
      $('#modalLiq').modal('show');
      let mes_pautar = document.getElementById('mes_pautar').value;
      if (mes_pautar > 0) {
         let divs = document.getElementsByClassName('divPerma');
         for (var i = 0; i < divs.length; i++) {
            divs[i].classList.remove("d-none");
         }
      }
   }
</script>
