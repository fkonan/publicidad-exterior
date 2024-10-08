 <tr style="background-color:#004884">
	<td colspan="3" style="background-color:#004884; color:white">Documentos Adjuntos</td>
</tr>

<tr>
   <td colspan="3" >
		<div class="row">
			@foreach ($documentos as $documento)
			<div class="col-xs-12 col-md-6 col-xl-4" >
				<label>{{$documento->nombre_adjunto}}:</label><br>
				<a href="{{asset('storage/' .$documento->ruta)}}" target="_blank">Descargar documento</a>&nbsp;&nbsp;<i class="fa fa-download"></i>
			</div>
			@endforeach
		</div>
   </td>
</tr>
