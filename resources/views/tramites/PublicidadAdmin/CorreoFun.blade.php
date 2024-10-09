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


<p style="font-size: 16px;"> <strong>Estimado Funcionario</strong>,</p>

<p style="font-size: 14px;">
   Notificamos que se ha registrado una novedad, para el proceso publicidad exterior visual, radicado con el número:
   <strong>{{ $Solicitud['radicado'] }}.</strong>
</p>
<p style="font-size: 14px;">
   <b>Tipo de novedad:</b> {{ $Solicitud->novedad }}
</p>
<p style="font-size: 14px;">
   <b>Estado:</b> {{ $Solicitud->estado_solicitud }}
</p>
<p style="font-size: 14px;">
<b>Comentarios:</b>{{ $Solicitud['comentarios'] }}
</p>

<p style="font-size: 14px;">
   <b>Por favor hacer seguimiento a travez de la plataforma aquí:</b> <a href="https://tramitesenlinea.bucaramanga.gov.co/"
      target="_blank">Realizar seguimiento</a>
</p>
