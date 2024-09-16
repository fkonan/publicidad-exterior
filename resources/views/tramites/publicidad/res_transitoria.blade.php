<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Resolución Permanente</title>
   <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>
<style>
   @page {
      size: legal;
      margin: 0;
   }

   @media print {

      html,
      body {
         font-family: Arial;
         font-size: 16px;
         position: relative;
         width: 210mm;
         height: 297mm;
      }
   }

   @page {
      margin: 40px 50px 50px;
   }

   #header {
      position: fixed;
      left: 0px;
      top: -107px;
      right: 0px;
      height: 90px;
      text-align: center;
      margin-bottom: 10px;
   }

   /* #footer { position: fixed; right: 0px; bottom: 10px; text-align: center; border-top: 1px solid black;}
    #footer .pagenum:before { content: "Page " counter(page); } */

   .tg {
      border-collapse: collapse;
      border-spacing: 0;
      width: 100%
   }

   .tg td {
      border-color: black;
      border-style: solid;
      border-width: 1px;
      font-family: Arial, Helvetica, sans-serif;
      font-size: 10px;
      overflow: hidden;
      padding: 2px 2px;
      word-break: normal;
   }

   .tg th {
      border-color: black;
      border-style: solid;
      border-width: 1px;
      font-family: Arial, Helvetica, sans-serif;
      font-size: 10px;
      font-weight: normal;
      overflow: hidden;
      padding: 2px 2px;
      word-break: normal;
   }

   .tg .tg-0pky {
      border-color: inherit;
      text-align: left;
      vertical-align: middle
   }

   .caja-table {
      page-break-inside: avoid;
      /* page-break-inside: avoid; */
      /* page-break-before: always; */
   }

   .tl {
      border-collapse: collapse;
      border-spacing: 0;
   }

   .tl td {
      border-color: black;
      border-style: solid;
      border-width: 1px;
      font-family: Arial, sans-serif;
      font-size: 10px;
      overflow: hidden;
      padding: 2px 2px;
      word-break: normal;
   }

   .tl th {
      border-color: black;
      border-style: solid;
      border-width: 1px;
      font-family: Arial, sans-serif;
      font-size: 10px;
      font-weight: normal;
      overflow: hidden;
      padding: 2px 2px;
      word-break: normal;
   }

   .tl .tl-0pky {
      border-color: inherit;
      text-align: left;
      vertical-align: middle;
   }

   footer {
      text-align: right;
      position: absolute;
      bottom: 0;
      width: 100%;
      height: 100px;
      color: black;
      font-size: 10px;
      font-family: Arial, sans-serif;
      font-style: italic;

   }
</style>

<body>
   <header>
      <div class="row">
         <div class="col-md-12">
            <img src="{{ public_path('img/res_transitoria.png') }}" class="img-fluid" width="100%">
         </div>
      </div>
   </header>

   <footer>
      <p style="text-align:right;">
         Calle 35 N° 10 – 43 Centro Administrativo, Edificio Fase I<br>
         Carrera 11 N° 34 – 52, Edificio Fase II,<br>
         Conmutador: (57-7) 6337000 Fax 6521777<br>
         Página Web: www.bucaramanga.gov.co,<br>
         Código postal 680006<br>
         Bucaramanga, Departamento de Santander, Colombia
      </p>
   </footer>
   <div class="container-fluid">
      <div class="row" style="margin-top:20px;">
         <div class="col-md-12">
            <table class="tg" style="width:500px; margin-left: auto;margin-right: auto;">
               <thead>
                  <tr>
                     <td class="tg-0pky" width="200">CONTRIBUYENTE RESPONSABLE</td>
                     <td class="tg-0pky">
                        <p align="justify" style="text-transform: uppercase;margin:0; padding:0">
                           {{ $solicitud->nombre_responsable . ' ' . $solicitud->apellido_responsable }}</p>
                     </td>
                  </tr>
                  <tr>
                     <td class="tg-0pky" width="200">NIT O CEDULA DE CIUDADANÍA</td>
                     <td class="tg-0pky">
                        <p align="justify" style="text-transform: uppercase;margin:0; padding:0">
                           {{ $solicitud->numero_documento }}</p>
                     </td>
                  </tr>
                  <tr>
                     <td class="tg-0pky" width="200">REPRESENTANTE LEGAL</td>
                     <td class="tg-0pky">
                        <p align="justify" style="text-transform: uppercase;margin:0; padding:0">
                           {{ $persona->PersonaNombre . ' ' . $persona->PersonaApe }}</p>
                     </td>
                  </tr>
                  <tr>
                     <td class="tg-0pky" width="200">DIRECCIÓN</td>
                     <td class="tg-0pky">
                        <p align="justify" style="text-transform: uppercase;margin:0; padding:0">
                           {{ $persona->PersonaDir }}</p>
                     </td>
                  </tr>
                  <tr>
                     <td class="tg-0pky" width="200">TIPO DE PUBLICIDAD</td>
                     <td class="tg-0pky">
                        <p align="justify" style="text-transform: uppercase;margin:0; padding:0">
                           {{ $solicitud->modalidad }}</p>
                     </td>
                  </tr>
                  <tr>
                     <td class="tg-0pky" width="200">CANTIDAD</td>
                     <td class="tg-0pky">
                        <p align="justify" style="text-transform: uppercase;margin:0; padding:0">
                           {{ $solicitud->numero_elementos }}</p>
                     </td>
                  </tr>
                  <tr>
                     <td class="tg-0pky" width="200">DIMENSIÓN</td>
                     @php $area = $detalle->alto_publicidad * $detalle->ancho_publicidad;@endphp
                     <td class="tg-0pky">
                        <p align="justify" style="text-transform: uppercase;margin:0; padding:0">
                           {{ $area . 'MTS2' }}</p>
                     </td>
                  </tr>
                  <tr>
                     <td class="tg-0pky" width="200">UBICACIÓN</td>
                     <td class="tg-0pky">
                        <p align="justify" style="text-transform: uppercase;margin:0; padding:0">
                           {{ $detalle->ubicacion_aviso }}</p>
                     </td>
                  </tr>
                  <tr>
                     <td class="tg-0pky" width="200">PERIODO DE COBRO</td>
                     <td class="tg-0pky">
                        <p align="justify" style="text-transform: uppercase;margin:0; padding:0">
                           {{ $detalle->fecha_inicial_fijacion . ' ' . $detalle->fecha_final_fijacion }}</p>
                     </td>
                  </tr>
                  <tr>
                     <td class="tg-0pky" width="200">CONTENIDO DEL AVISO</td>
                     <td class="tg-0pky">
                        <p align="justify" style="text-transform: uppercase;margin:0; padding:0">
                           {{ $detalle->observacion_medidas }}</p>
                     </td>
                  </tr>
               </thead>
            </table>
         </div>
         <div class="col-md-12 bg-danger" style="text-align: center;">
            <p>EL PRESENTE ACTO ADMINISTRATIVO SE PROFIERE DE CONFORMIDAD CON EL DECRETO 0040 DE 2022 <span
                  style="font-style:oblique;">"Por medio del cual se compila el régimen tributario del Municipio de
                  Bucaramanga"</span></p>
         </div>
      </div>
   </div>
   @php
      $fecha_inicial = date_create($detalle->fecha_inicial_fijacion);
      $fecha_final = date_create($detalle->fecha_final_fijacion);
      $resultado = date_diff($fecha_inicial, $fecha_final);
      $dias = $resultado->format('%R%a');
      //   $mes = $resultado->format('%m');
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
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12" style="text-align:center;">
            <p><strong>C O N S I D E R A C I O N E S:</strong></p>
         </div>
         <div class="row">
            <ol type="A">
               <li style="text-align:justify;">En desarrollo de la ley 140 de 1994, por la cual se reglamenta la
                  publicidad exterior visual en el territorio nacional, se expidió el Decreto 0040 de 2022, el cual
                  en los artículos 122 y siguientes regula los aspectos sobre publicidad exterior visual en el
                  Municipio de Bucaramanga. Establece la norma citada que la publicidad de carácter transitorio es decir
                  aquella que está destinada a mantenerse por un lapso igual o inferior a treinta (30) días y cuya
                  dimensión es
                  de {{ $area }} metros cuadrados causara impuesto equivalente a un (1) salarios mínimo legal
                  mensual. por año. Señala igualmente que la publicidad de carácter transitorio y cuyas dimensiones
                  sean superiores o inferiores a {{ $area }} metros cuadrados causará un impuesto proporcional
                  a lo establecido en el inciso precedente.
               </li>

               <li style="text-align:justify;">El artículo 131 del Decreto 0040 de 2022, señala que la Secretaria de
                  Hacienda Municipal practicará
                  liquidación oficial del impuesto de publicidad exterior visual a partir de la información que le
                  suministre la secretaria del Interior sobre las solicitudes de registro, conforme las disposiciones
                  reglamentarias vigentes.
               </li>

               <li style="text-align:justify;">Artículo 5. Administración y Control. La Administración y control de los
                  tributos Municipales es
                  competencia de la Secretaría de Hacienda. Dentro de las funciones de Administración y control de los
                  tributos se encuentran, en otras, la fiscalización, el cobro, la liquidación oficial, la discusión, el
                  recaudo y las devoluciones.
                  <br>
                  Los contribuyentes, responsables, agentes de retención y terceros, están obligados a facilitarlas
                  tareas
                  de la Administración Tributaria Municipal, observando los deberes y obligaciones que les impongan las
                  normas tributarias.
               </li>

               <li style="text-align:justify;">El contribuyente antes mencionado instaló en esta jurisdicción
                  {{ $solicitud->numero_elementos }}
                  UNIDADES PUBLICITARIAS,
                  constituyéndose en sujeto pasivo del impuesto de publicidad exterior visual y conforme a la
                  comunicación
                  interna emanada de la secretaria del Interior consta que cuenta con el visto bueno de aprobación de
                  instalación.
               </li>
                <li style="text-align:justify;">La Presente Liquidación Oficial, se practica teniendo como fecha la suministrada por el Contribuyente, 
                  sin perjuicio de las facultades de fiscalización tributaria
               </li>

               <li style="text-align:justify;">Los contribuyentes responsables de los impuestos que no cancele
                  oportunamente deberán liquidar y
                  pagar intereses moratorios, por cada día calendario de retardo en el pago. Para tal efecto, la
                  totalidad
                  de los intereses de mora, se liquidarán con base en la tasa de interés vigente en el momento del
                  respectivo pago, calculada de conformidad con lo previsto en el artículo 635 del Estatuto tributario
                  Nacional, modificado por el artículo 279 de la ley 1819 de 2016.
               </li>
            </ol>
         </div>

         <div class="container-fluid" style=" display:block;page-break-before:always;">
            <header>
               <div class="row">
                  <div class="col-md-12">
                     <img src="{{ public_path('img/res_transitoria.png') }}" class="img-fluid" width="100%">
                  </div>
               </div>
            </header>

            <footer>
               <p style="text-align:right;">
                  Calle 35 N° 10 – 43 Centro Administrativo, Edificio Fase I<br>
                  Carrera 11 N° 34 – 52, Edificio Fase II,<br>
                  Conmutador: (57-7) 6337000 Fax 6521777<br>
                  Página Web: www.bucaramanga.gov.co,<br>
                  Código postal 680006<br>
                  Bucaramanga, Departamento de Santander, Colombia
               </p>
            </footer>
            <div class="col-md-12" style="text-align:center;margin-top:30px;">
               <p><strong>R E S U E L V E:</strong></p>
            </div>
            <div class="row">

               <p>
                  <strong>ARTÍCULO PRIMERO:</strong> Practicar la siguiente liquidación del impuesto de Publicidad
                  Exterior
                  Visual, acorde con las características antes mencionadas así:
               </p>
               <div class="col-md-12">
                  <table class="tg" width="100%">
                     <thead>
                        <tr>
                           <td class="tg-0pky" width="250">NOMBRE DEL SOLICITANTE</td>
                           <td class="tg-0pky">
                              <p align="justify" style="text-transform: uppercase;margin:0; padding:0">
                                 {{ $solicitud->nombre_responsable . ' ' . $solicitud->apellido_responsable }}</p>
                           </td>
                        </tr>
                        <tr>
                           <td class="tg-0pky" width="200">NIT - CC</td>
                           <td class="tg-0pky">
                              <p align="justify" style="text-transform: uppercase;margin:0; padding:0">
                                 {{ $solicitud->numero_documento }}</p>
                           </td>
                        </tr>
                     </thead>
                  </table>
                  <table class="tg" width="100%">
                     <thead>
                        <tr>
                           @php $area = $detalle->alto_publicidad * $detalle->ancho_publicidad;@endphp
                           <td style="text-align:center;" class="tg-0pky" width="auto">TOTAL <br> DIMENSIÓN</td>
                           <td style="text-align:center;" class="tg-0pky" width="auto">VALOR IMPUESTO <br> ELEMENTO
                              PUBLICITARIO <br> INDIVIDUAL</td>
                           <td style="text-align:center;" class="tg-0pky" width="auto">CANTIDAD DE PUBLICIDAD</td>
                           <td style="text-align:center;" class="tg-0pky" width="auto">PERIODO DE COBRO</td>
                           <td style="text-align:center;" class="tg-0pky" width="auto">No DE DIAS</td>
                           <td style="text-align:center;" class="tg-0pky" width="auto">TOTAL</td>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td style="height:70px;" class="tg-0pky">
                              <p align="center" style="text-transform: uppercase;margin:0; padding:0">
                                 {{ $area . ' MTS2' }}</p>
                           </td>

                           <td style="height:70px;" class="tg-0pky">
                              <p align="center" style="text-transform: uppercase;margin:0; padding:0">
                                 ${{ number_format($valor_mensual, 2) }}
                              </p>
                           </td>

                           <td style="height:70px;" class="tg-0pky">
                              <p align="center" style="text-transform: uppercase;margin:0; padding:0">
                                 {{ $solicitud->numero_elementos }}</p>
                           </td>

                           <td style="height:70px;" class="tg-0pky">
                              <p align="center" style="text-transform: uppercase;margin:0; padding:0">
                                 DEL {{ $detalle->fecha_inicial_fijacion . ' AL ' . $detalle->fecha_final_fijacion }}
                              </p>
                           </td>

                           <td style="height:70px;" class="tg-0pky">
                              <p align="center" style="text-transform: uppercase;margin:0; padding:0">
                                 {{ $dias }}
                              </p>
                           </td>

                           <td style="height:70px;" class="tg-0pky">
                              <p align="center" style="text-transform: uppercase;margin:0; padding:0">
                                 ${{ number_format($valor_total, 2) }}
                              </p>
                           </td>
                        </tr>
                     </tbody>
                     <tfoot>
                        <tr>
                           <td colspan="5">
                              TOTAL A PAGAR
                           </td>
                           <td>
                              ${{ number_format($valor_total, 2) }}
                           </td>
                        </tr>
                     </tfoot>
                  </table>
                  <p align="justify">
                     <strong>ARTÍCULO SEGUNDO:</strong> Los responsables de este impuesto que por cualquier razón
                     desistan
                     de la fijación de la publicidad deberán informarlo a la Secretaria de Hacienda Municipal, con
                     anticipación a la fecha señalada para la Fijación, a fin de que esta secretaria puede constatar la
                     inexistencia del hecho generador. Mientas el responsable no informe dicha circunstancia estará
                     obligado a cancelar el impuesto liquidado por concepto de Publicidad exterior visual.
                  </p>
                  <p align="justify">
                     <strong>ARTÍCULO TERCERO:</strong> Contra la presente resolución procede al recurso de
                     reconsideración, interpuesto ante la Secretaria de Hacienda, dentro de los dos (2) meses siguientes
                     a
                     la notificación del mismo, de conformidad con lo establecido en el artículo 361 del Decreto 0040 de
                     2022 Compilación Régimen Tributario en concordancia con el Art. 720 del Estatuto Tributario
                     Nacional.
                  </p>
                  <p align="justify">
                     <strong>ARTÍCULO CUARTO:</strong> Enviar copia de la presente Resolución al contribuyente y
                     consecutivo para los fines pertinentes.
                  </p>
                  <p align="justify">
                     <strong>ARTÍCULO TERCERO:</strong> Notificar la presente resolución según los términos y
                     procedimientos establecidos en los artículos 227 y siguientes del Decreto 0040 de marzo 25 de 2022
                     mediante el cual se compilo el número de régimen tributario del Municipio de Bucaramanga.
                  </p>
                  <p>
                     La Presente Liquidación Oficial, se practica teniendo como fecha la suministrada por el
                     Contribuyente, sin perjuicio de las facultades de fiscalización tributaria.
                  </p>
               </div>


               <div class="col-md-12" style="margin-top:100px; text-align:center;">
                  <h3>NAYARIN SAHARAY ROJAS TELLEZ</h3>
                  <h4>Secretaría de Hacienda</h4>
               </div>
               <div class="col-md-12">
                  <p>
                     P/: Luz Ángela Caballero C. <br>
                     <span style="font-size:10px;">Contratista encargada</span>
                  </p>
                  <p>
                     R/: Lina María Manrique Duarte <br>
                     <span style="font-size:10px;">Subsecretaria de Hacienda</span>
                  </p>
               </div>
            </div>
         </div>
      </div>
   </div>
</body>

</html>
