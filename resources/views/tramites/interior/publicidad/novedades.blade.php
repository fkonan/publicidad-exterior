@if($novedades)
<tr style="background-color:#004884">
   <td colspan="3" style="background-color:#004884; color:white">Novedades</td>
</tr>
<tr>
   <th>Novedad</th>
   <th>Estado</th>
   <th>Observaciones</th>
</tr>
@foreach ($novedades as $novedad)
<tr>
   <td>{{ $novedad->NovedadEstado}} </td>
   <td>{{ $novedad->NovedadTipo }} </td>
   <td>{{ $novedad->NovedadComentario }} | {{$novedad->created_at }}</td>
</tr>
@endforeach
@endif
<tr>
   {{-- aqui va el form --}}
   @if ($solicitud->estado_solicitud != 'RECHAZADA' && $solicitud->estado_solicitud != 'APROBADA')
   <form method="POST" class="form-ciudadano" action="{{ route('interior.publicidad.update') }}"
      enctype="multipart/form-data" id="myForm1">
      <input type="hidden" name="SolicitudId" id="SolicitudId" value="{{ $solicitud->id }}">
      @csrf
      @if ($solicitud->dependencia == 'HACIENDA' && $solicitud->estado_solicitud == 'PENDIENTE')
<tr>
   <td colspan="3">
      <h3>Pendiente por pago, una vez caiga el pago, cambiara automaticamente el estado</h3>
   </td>
</tr>
@else
@php
$novedadesCollection = collect($novedades);
$revisionDocumentos = $novedadesCollection->contains(function ($novedad) {
return $novedad->NovedadTipo === 'Revision de documentos';
});
@endphp
<tr>
   <td>
      <h3>Estado actual de la solicitud: </h3>
      <h4>{{$config_novedades[0]->titulo_estado}}</h4>
      <div class="form-group">
         <label for="novedad">{{$config_novedades[0]->novedad}} *</label>
         <select class="form-control  @error('novedad') is-invalid @enderror" name="novedad" id="novedad" required>
            <option value="">Seleccione una opción</option>
            @foreach ($config_novedades as $novedad)
            <option value="{{$novedad->novedad_id}}">{{$novedad->opcion}}
               @endforeach
         </select>
         @error('novedad')
         <span class="invalid-feedback" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
         </span>
         @enderror
      </div>
   </td>

   <td colspan="2">
      <div class="form-group">
         <label for="observacion">Observaciones</label>
         <textarea name="observacion" id="observacion" maxlength="255"
            class="form-control  @error('observacion') is-invalid @enderror" id="observacion" cols="2"
            rows="4"></textarea>
         @error('observacion')
         <span class="invalid-feedback" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
         </span>
         @enderror
      </div>
   </td>
</tr>
<tr>

</tr>
@if ($solicitud->dependencia == 'hacienda' && $pendiente_pago==false)
<tr>
   <td colspan="2">
      <button type="button" id="btnLiquidar" class="btn btn-round btn-middle btn-outline-info"
         onclick="cargarLiquidacion();">Liquidar</button>
   </td>
</tr>
@endif
<tr>
   <td>
      <div class="form-group">
         <label for="documento_respuesta">Cargar Respuesta</label>
         <input type="file" accept="application/pdf" name="documento_respuesta" id="documento_respuesta"
            class="form-control @error('documento_respuesta') is-invalid @enderror" @if ($solicitud->dependencia ==
         'SALUD' ||
         $solicitud->dependencia == 'PLANEACION')
         required @endif @if($config_novedades[0]->finaliza==1)required @endif>
         @error('documento_respuesta')
         <span class="invalid-feedback" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
         </span>
         @enderror
      </div>

   </td>
   @if($config_novedades[0]->finaliza==1)
   <td>
      <div class="form-group">
         <label for="fecha_inicio">Fecha de inicio</label>
         <input type="date" name="fecha_inicio" id="fecha_inicio"
            class="form-control @error('fecha_inicio') is-invalid @enderror" @if($config_novedades[0]->finaliza==1)
         required @endif>
         @error('fecha_inicio')
         <span class="invalid-feedback" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
         </span>
         @enderror
      </div>
   </td>

   <td>
      <div class="row">
         <div class="col">
            <label for="fecha_fin">Fecha final</label>
            <input type="date" name="fecha_fin" id="fecha_fin"
               class="form-control @error('fecha_fin') is-invalid @enderror" @if($config_novedades[0]->finaliza==1)
            required @endif>
            @error('fecha_fin')
            <span class="invalid-feedback" role="alert">
               <strong class="text-danger">{{ $message }}</strong>
            </span>
            @enderror
         </div>
         <div class="col">
            <label for="dia_publicidad">Duración de la publicidad (días)</label>
            <input class="form-control" type="text" name="dia_publicidad" id="dia_publicidad" readOnly value="0">
         </div>
      </div>
   </td>
   @endif

</tr>
<tr>
   <td>
      <div class="form-group">
         <button type="submit" id="myBtnEspacio" class="btn btn-round btn-middle btn-outline-info" id="Boton">Actualizar
         </button>
      </div>
   </td>
   <td>
      <a href="/tramites/interior/publicidad/{{ $solicitud->modalidad }}" class="btn btn-round btn-high">Volver</a>
   </td>
   <td></td>
</tr>


@endif
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
            $mes = $dias/30;
            $valor_m2 = round((1000000 * 4) / 48, 2);
            $area = $detalle->alto_publicidad * $detalle->ancho_publicidad;
            $valor_mensual = round(($area * $valor_m2) / 12, 2);
            $valor_transitoria = round(($area*1000000) / 48, 2);
            $tipo_liquidacion = '';

            if ($mes > 0) {
            $valor_total = $valor_mensual * $mes;
            $tipo_liquidacion = 'PERMANENTE';
            } else {
            $valor_total = $valor_transitoria;
            $tipo_liquidacion = 'TRANSITORIA';
            }
            @endphp

         </div>
      </div>
   </div>
</div>
</form>
@endif

{{-- fin del form --}}
