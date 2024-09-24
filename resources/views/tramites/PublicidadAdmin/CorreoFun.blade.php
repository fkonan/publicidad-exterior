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


<p> <strong>Estimado Funcionario</strong>,</p>

<p>
   Notificamos que se ha registrado una novedad, para el proceso publicidad exterior visual,
   radicado con el número: <strong>{{ $Solicitud['radicado'] }}</strong>.<br>
   Tipo de novedad: <strong>{{ $Solicitud['NovedadTipo'] }}</strong><br>
   Estado: <strong>{{ $Solicitud['NovedadEstado'] }}</strong><br>
   Comentarios: <strong>{{ $Solicitud['Comentario'] }}</strong><br>
   Dependencia donde se encuentra el proceso: <strong>{{ $Solicitud['dependencia'] }}</strong><br>
   Por favor hacer seguimiento a travez de la plataforma aquí: <a
      href="https://tramitesenlinea.bucaramanga.gov.co/" target="_blank">Consulta publicidad exterior</a>
</p>
@if($Solicitud['liquidacion']!='')
<h3>Se ha generado el siguiente enlace para que pueda generar el recibo de pago o realizar el pago en línea:
   <a href="{{$Solicitud['liquidacion']}}" target="_blank">Pago en línea</a>
</h3>
@endif
