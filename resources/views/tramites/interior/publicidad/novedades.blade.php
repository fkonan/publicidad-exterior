@if($novedades)
<tr style="background-color:#004884">
   <td colspan="3" style="background-color:#004884; color:white">Novedades</td>
</tr>
<tr>
   <th>Tipo de Novedad</th>
   <th>Observaciones</th>
   <th>Estado</th>
</tr>
@foreach ($novedades as $novedad)
<tr>
   <td>{{ $novedad->NovedadTipo }}</td>
   <td>{{ $novedad->NovedadComentario }}</td>
   <td>{{ $novedad->NovedadEstado}} | {{$novedad->created_at }}</td>
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
      <div class="form-group">
         <label for="estado">Tipo de novedad* </label>
         <select class="form-control  @error('estado_solicitud') is-invalid @enderror" name="tiponovedad"
            id="tiponovedad" required onchange="javascript:cambiarEstado(this.value);">
            <option value="">Seleccione</option>

            @if ($solicitud->dependencia == 'INTERIOR')
               @if (!$revisionDocumentos)
               <option value="1">Revision de documentos</option>
               @endif

               @if ($solicitud->modalidad != 'PASACALLES')
               <option value="5">Presentación de requisitos finales</option>
               @endif

               @if ($solicitud->modalidad == 'VALLAS')
               <option value="6">Revisión documentos finales</option>
               @endif

               <option value="8">Acto administrativo</option>
            @endif

            @if ($solicitud->dependencia == 'PLANEACION')
            <option value="2">Concepto tecnico planeación</option>
            @endif
            @if ($solicitud->dependencia == 'TRANSITO')
            <option value="3">Concepto tecnico transito</option>
            @endif
            @if ($solicitud->dependencia == 'SALUD')
            <option value="4">concepto tecnico salud</option>
            @endif
            @if ($solicitud->dependencia == 'HACIENDA')
            <option value="7">Liquidacion</option>
            @endif
         </select>
         @error('estado_solicitud')
         <span class="invalid-feedback" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
         </span>
         @enderror
      </div>
      <div class="form-group">
         <label for="estado">Estado de la novedad*</label>
         <select class="form-control  @error('estado_solicitud') is-invalid @enderror estado" name="Novedad[0]"
            id="estado0">
            <option value="">Seleccione</option>
         </select>
         <select class="form-control  @error('estado_solicitud') is-invalid @enderror estado d-none" name="Novedad[1]"
            id="estado1">
            <option value="COMPLETO">COMPLETO</option>
            <option value="INCOMPLETO">INCOMPLETO</option>
            <option value="RECHAZADO">RECHAZADO</option>
         </select>
         <select class="form-control  @error('estado_solicitud') is-invalid @enderror estado d-none" name="Novedad[2]"
            id="estado2">
            <option value="FAVORABLE">FAVORABLE</option>
            <option value="NO FAVORABLE">NO FAVORABLE</option>
         </select>
         <select class="form-control  @error('estado_solicitud') is-invalid @enderror estado d-none" name="Novedad[3]"
            id="estado3">
            <option value="FAVORABLE">FAVORABLE</option>
            <option value="NO FAVORABLE">NO FAVORABLE</option>
         </select>
         <select class="form-control  @error('estado_solicitud') is-invalid @enderror estado d-none" name="Novedad[4]"
            id="estado4">
            <option value="FAVORABLE">FAVORABLE</option>
            <option value="NO FAVORABLE">NO FAVORABLE</option>
         </select>
         <select class="form-control  @error('estado_solicitud') is-invalid @enderror estado d-none" name="Novedad[5]"
            id="estado5">
            <option value="VIABLE">VIABLE</option>
            <option value="NO VIABLE">NO VIABLE</option>
         </select>
         <select class="form-control  @error('estado_solicitud') is-invalid @enderror estado d-none" name="Novedad[6]"
            id="estado6">
            <option value="COMPLETO">COMPLETO</option>
            <option value="INCOMPLETO">INCOMPLETO</option>
         </select>
         <select class="form-control  @error('estado_solicitud') is-invalid @enderror estado d-none" name="Novedad[7]"
            id="estado7">
            <option value="LIQUIDADO">LIQUIDADO</option>
         </select>
         <select class="form-control  @error('estado_solicitud') is-invalid @enderror estado d-none" name="Novedad[8]"
            id="estado8">
            <option value="APROBADO">APROBADO</option>
         </select>

         <script language="javascript">
            function cambiarEstado(num) {
               $('.estado').addClass('d-none');
               var nombre = "#estado" + num;
               $(nombre).removeClass('d-none');
            }
         </script>

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
         <textarea name="NovedadComentario" id="NovedadComentario" onkeypress="return Observaciones(event)"
            maxlength="500" class="form-control  @error('observaciones_solicitud') is-invalid @enderror"
            id="observaciones" cols="2" rows="4" required></textarea>
         @error('observaciones_solicitud')
         <span class="invalid-feedback" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
         </span>
         @enderror

      </div>
   </td>
</tr>
@if ($solicitud->dependencia == 'HACIENDA' && $pendiente_pago==false)
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
         <input type="file" accept="application/pdf" name="documento0" id="documento_respuesta"
            class="form-control @error('documento0') is-invalid @enderror" @if ($solicitud->dependencia == 'SALUD' ||
         $solicitud->dependencia == 'PLANEACION')
         required @endif>
         @error('documento0')
         <span class="invalid-feedback" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
         </span>
         @enderror
      </div>

   </td>
   <td colspan="2">
      <div class="form-group">
         <button type="submit" id="myBtnEspacio" class="btn btn-round btn-middle btn-outline-info" id="Boton">Actualizar
            estado</button>
         <button style="font-size:15px;" class="btn btn-round btn-middle btn_carga d-none" type="button" disabled><span
               class="spinner-grow spinner-grow-sm text-primary" role="status" aria-hidden="true"></span> Actualizando
            estado...</button>
         <a href="/tramites/interior/publicidad/{{ $solicitud->modalidad }}" class="btn btn-round btn-high">Volver</a>
      </div>
   </td>
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
