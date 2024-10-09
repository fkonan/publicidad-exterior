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

   td {}
</style>

<p style="font-size: 16px;"> <strong>Estimado {{ $Solicitud['nombre_completo'] }}</strong>,</p>

<p style="font-size: 14px;">
   Notificamos que se ha registrado una novedad, para el proceso publicidad exterior visual, radicado con el número:
   <strong>{{ $Solicitud['radicado'] }}.</strong>
</p>
<p style="font-size: 14px;">
<b>Tipo de novedad:</b> {{ $Solicitud->novedad }}</p>
<p style="font-size: 14px;">
   <b>Estado:</b> {{ $Solicitud->estado_solicitud }}
</p>
<p style="font-size: 14px;">
   <b>Comentarios:</b>{{ $Solicitud['comentarios'] }}
</p>
<p style="font-size: 14px;">
   <b>Consulte su solicitud aquí:</b> <a href="https://tramitesenlinea.bucaramanga.gov.co/publicidad-exterior"
      target="_blank">Consulta publicidad exterior</a>
</p>

@if($Solicitud['liquidacion']!='')
<h3>Se ha generado el siguiente enlace para que pueda generar el recibo de pago o realizar el pago en línea:
   <a href="{{$Solicitud['liquidacion']}}" target="_blank">Pago en línea</a>
</h3>
@endif
