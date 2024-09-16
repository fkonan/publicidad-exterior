<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certificado de Predios</title>
</head>
<style>   
   @page {
    size: 8.5in 13in; /* Tamaño de página para oficio */
    margin: 1in; /* Márgenes izquierdo y derecho */
    margin-top: 0.3in; /* Márgen superior */
    margin-bottom: 0.5in; /* Márgen inferior */
    padding: 10px; /* Espacio de relleno dentro de la página */
    page-break-before: always; /* Iniciar una nueva página antes de este elemento */
    page-break-after: always; /* Iniciar una nueva página después de este elemento */
    content: "Página " counter(page); /* Numeración de páginas */
}
    @media print {
    html, body {
    width: 210mm;
    height: 297mm;
    
    }
    
    }
    @page {
    margin-top: 140px; /* Margen superior */
    margin-bottom: 150px; /* Margen inferior */
    margin-left: 50px; /* Margen izquierdo */
    margin-right: 50px; /* Margen derecho */
}
    #header { position: fixed; left: 0px; top: -100px; right: 0px; height: 150px; text-align: center; float:left;}
    #footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 150px; }

    @font-face {
        font-family: Arial, Helvetica, sans-serif;
        font-style: normal;
        font-weight: normal;
      
      }
      body{
        font-family: Arial, Helvetica, sans-serif;
      }

      .tg  {border-collapse:collapse;border-spacing:0;}
      .tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
        overflow:hidden;padding:7px 5px;word-break:normal;}
      .tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
        font-weight:normal;overflow:hidden;padding:7px 5px;word-break:normal;}
      .tg .tg-8ot9{border-color:inherit;font-size:15px;text-align:center;vertical-align:top}
      .tg .tg-0lax{text-align:left;vertical-align:top}
      .tg .tg-cbs6{font-size:15px;text-align:left;vertical-align:top}

      li{
        margin: 10px 0;
      }

   
    </style>
<body>
    <div id="header">
        <table width="100%">
        <tbody>
        <tr>    
            <td style="width:100px;  text-align:top;"> <img src="{{asset('img/logoalcaldia.png')}}"  width="80px" height="85px"/></td>
            <td style="width:440PX;  text-align:top;">
          <td style="width:100px;  text-align:top;"> <p>RADICADO:<br><strong>{{$certificado->radicado}}</strong></p></td>

           
        </tr>
        </tbody>
        </table>
    </div>
        
        <div  id="footer">
        <table width="100%">
        <tbody>
        <tr>      
        <td style="width:200px;  text-align:top;"><p style="font-size:10px" align="right">
        Calle 35 N° 10 – 43 Centro Administrativo, Edifício Fase I <br>
        Carrera 11 N° 34 – 52, Edifício Fase II<br>
        Conmutador: (57-7) 6337000 Fax 6521777<br>
        Página Web: www.bucaramanga.gov.co<br>
        Código Postal: 680006<br>
        Bucaramanga, Departamento de Santander, Colombia</p>
        </td>
        </tr>
        </tbody>
        </table>
        </div>
        
       

        <h4 style="text-align: center">EL SUSCRITO DIRECTOR DEL DEPARTAMENTO DE LA DEFENSORIA DE ESPACIO PÚBLICO DEL MUNICIPIO DE BUCARAMANGA, EN EJERCICIO DE LAS FACULTADES Y FUNCIONES ASIGNADAS A ESTA DEPENDENCIA MEDIANTE ACUERDO MUNICIPAL No 035 de 2002 y DECRETO MUNICIPAL 012 DE 2003.</h4>
        <h4 style="text-align: center">Certifica:</h4>
        <p  style="text-align: justify">Que, efectuadas las consultas respectivas en el Inventario General del Patrimonio Inmobiliario Municipal, el Geoportal del Área Metropolitana de Bucaramanga, la Ventanilla Única de Registro- VUR de la Superintendencia de Notariado y Registro, Constancia de Estado Predial, fue posible establecer que el predio que a continuación se describe es de propiedad del Municipio de Bucaramanga.</p>

        <table class="tg" style="width: 100%">
            <thead>
              <tr>
                <th class="tg-8ot9" colspan="2"><span style="font-weight:bold;">PREDIO PROPIEDAD DEL MUNICIPIO</span></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="tg-0lax" style="width: 30%"><span style="font-weight:bold;">I.UBICACIÓN</span></td>
                <td class="tg-0lax" style="width:70%;text-transform: uppercase;">{{$certificado->direccion}}</td>
              </tr>
              <tr>
                <td class="tg-0lax" style="width: 30%"><span style="font-weight:bold;">II. NÚMERO PREDIAL </span></td>
                <td class="tg-0lax" style="width:70%">{{$certificado->numero_predial}}</td>
              </tr>
              <tr>
                <td class="tg-0lax" style="width:30%"><span style="font-weight:bold;">III. MATRÍCULA INMOBILIARIA </span></td>
                <td class="tg-0lax" style="width:70%">{{$certificado->matricula}}</td>
              </tr>
              <tr>
                <td class="tg-0lax" style="width:30%"><span style="font-weight:bold;">IV. TÍTULO DE ADQUISICIÓN </span> </td>
                <td class="tg-0lax" style="width:70%;text-transform: uppercase;">{{$certificado->complemento}}</td>
              </tr>
              <tr>
                <td class="tg-0lax" style="width:30%"><span style="font-weight:bold;">V. ÁREA Y LINDEROS </span> </td>
                <td class="tg-0lax" style="width:70%;text-transform: uppercase;">{{$certificado->complemento}}</td>
              </tr>
              <tr>
                <td class="tg-0lax" style="width:30%"><span style="font-weight:bold;">VI. PROPIETARIO </span> </td>
                <td class="tg-0lax" style="width:70%;text-transform: uppercase;"> Municipio de Bucaramanga </td>
              </tr>
             
            </tbody>
            </table>
            <p style="text-align: justify">Se deja constancia que en caso de presentarse inconsistencia de áreas y linderos de tipo predial se debe iniciar el debido proceso de saneamiento por parte del municipio. </p>            <p style="text-align: justify">Esta certificación no constituye concepto de uso de suelo.</p>              
            <p style="text-align: justify">Se expide en Bucaramanga el @php echo $fechaActual @endphp.</p>
                </p>

            <p style="text-align:center;padding-top:15px;">
               <img src="{{asset('img/firma-dadep.png')}}"  style="width: 220px;text-align: center; height:80px;">  <br>
               <b>MANUEL JOSÉ TORRES GONZÁLEZ</b><br>               
               Director<br>
               Departamento Administrativo de la Defensoría del Espacio Publico
            </p> 
            <p style="text-align: start;font-size:12px;">C.c. Archivo DADEP</p>
          
</body>
</html>