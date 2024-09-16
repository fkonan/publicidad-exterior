<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulario Solicitud</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">  
      
    

</head>
<style type="text/css">
    table.table-bordered > thead > tr > th{
  border:1px solid #000;
}
table.table-bordered > tbody > tr > th{
  border:1px solid #000;
}
table.table-bordered > tbody > tr > td{
  border:1px solid #000;
}
</style>
<body>
    <div class="container-fluid">        
        <div class="row">
            <div class="col-md-12">
                <img src="{{asset('img/encabezado.PNG')}}" class="img-fluid">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            <p style="font-size: 10px; text-align:justify;">Es la autorización previa para ocupar o para intervenir bienes de uso público incluidos en el espacio público, de conformidad con las normas urbanísticas adoptadas en el Plan de Ordenamiento Territorial, en los instrumentos que lo desarrollen y complementen y demás normatividad vigente</p>
            
            <table class="table table-bordered">
                    <thead>
                      <tr style="background-color: #D9D9D9">
                        <th scope="col" colspan="4" style="text-align:center;padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;">1. IDENTIFICACION DE LA SOLICITUD</th> 
                        
                      </tr>
                      <tr>
                        <th scope="col" colspan="2" style="text-align:left;padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;"><p style="font-size:12px; padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;">RADICADO &nbsp;<span style="font-size:10px;color:#3D3C3B">{{$solicitud->radicado}}</span> </p></th> 

                        <th scope="col" colspan="2" style="text-align:left;padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;"><p style="font-size:12px; padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;">FECHA SOLICITUD &nbsp;<span style="font-size:10px;color:#3D3C3B">{{$solicitud->created_at}}</span> </p></th> 
                        
                      </tr>
                      
                      <tr>
                        <th scope="col" colspan="4" style="text-align:center;padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;"><p style="font-size:14px;">MODALIDAD LICENCIA DE INTERVENCION DE ESPACIO PUBLICO</p></th> 
                        
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row" colspan="3" style="padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;"><p style="font-size:10px;padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;">{{$solicitud->modalidad}}</p></th>
                        <th scope="row" valign="middle" colspan="1" style="text-align:center;padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;vertical-align:middle;">X</th>
                        
                      </tr>
                      
                      @if($solicitud->modalidad == 'CONSTRUCCION Y REHABILITACION' && $solicitud->construccion != null)
                      <tr>
                        <th scope="col" colspan="4" style="text-align:left;padding-top:5px;margin-top:0px;padding-bottom:5px;margin-bottom:0px;"><p style="font-size:12px; padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;">TIPO DE CONSTRUCCION Y REHABILITACIÓN</p></th> 
                        
                      </tr>

                      <tr>
                        <th scope="row" valign="middle" colspan="3" style="padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;"><p style="font-size:10px;padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;">{{$solicitud->construccion}}</p></th>
                        <th scope="row" colspan="1" style="text-align:center;padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px; padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;vertical-align:middle;">X</th>
                        
                      </tr>

                      @endif

                      <tr style="background-color: #D9D9D9">
                        <th scope="col" colspan="4" style="text-align:center;padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;">2.	INFORMACION SOBRE EL PREDIO</th> 
                        
                      </tr>

                      <tr>
                        <th scope="col" colspan="2" style="text-align:left;padding-top:5px;margin-top:0px;padding-bottom:5px;margin-bottom:0px;"><p style="font-size:12px; padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;">2.1.	DIRECCION O NOMENCLATURA ACTUAL <br> <span style="font-size:10px;color:#3D3C3B">{{$solicitud->direccion_predio}}</span> </p></th> 

                        <th scope="col" colspan="2" style="text-align:left;padding-top:5px;margin-top:0px;padding-bottom:5px;margin-bottom:0px;"><p style="font-size:12px; padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;">2.2.	No. MATRICULA INMOBIIARIA <br>  <span style="font-size:10px;color:#3D3C3B">{{$solicitud->matricula}}</span> </p></th> 
                        
                      </tr>

                      <tr>
                        <th scope="col" colspan="2" style="text-align:left;padding-top:5px;margin-top:0px;padding-bottom:5px;margin-bottom:0px;"><p style="font-size:12px; padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;">2.3 No. IDENTIFICACION CATASTRAL  <br> <span style="font-size:10px;color:#3D3C3B">{{$solicitud->identificacion_catastral}}</span> </p></th> 

                        <th scope="col" colspan="2" style="text-align:left;padding-top:5px;margin-top:0px;padding-bottom:5px;margin-bottom:0px;"><p style="font-size:12px; padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;">2.4.	INFORMACION GENERAL  <br>  <span style="font-size:10px;color:#3D3C3B">{{$solicitud->barrio}} - {{$solicitud->vereda}}</span> </p></th> 
                        
                      </tr>

                      <tr style="background-color: #D9D9D9">
                        <th scope="col" colspan="4" style="text-align:center;padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;">3.	TITUALES Y PROFESIONALES RESPONSABLES.</th> 
                        
                      </tr>
                      <tr>
                        <th scope="col" colspan="4" style="text-align:left;padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;"><p style="font-size:12px; padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;">3.1 TITULAR(ES)</p></th> 
                        
                      </tr>

                      <tr>
                        <th scope="col" colspan="2" style="text-align:left;padding-top:5px;margin-top:0px;padding-bottom:5px;margin-bottom:0px;"><p style="font-size:12px; padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;">NOMBRES <br> <span style="font-size:10px;color:#3D3C3B">{{$solicitud->nom_titular}} {{$solicitud->ape_titular}}</span> </p></th> 

                        <th scope="col" colspan="2" style="text-align:left;padding-top:5px;margin-top:0px;padding-bottom:5px;margin-bottom:0px;"><p style="font-size:12px; padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;">C.C o NIT <br>  <span style="font-size:10px;color:#3D3C3B">{{$solicitud->identificacion_titular}}</span> </p></th> 
                        
                      </tr>

                      <tr>
                        <th scope="col" colspan="2" style="text-align:left;padding-top:5px;margin-top:0px;padding-bottom:5px;margin-bottom:0px;"><p style="font-size:12px; padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;">TELEFONO/CELULAR <br> <span style="font-size:10px;color:#3D3C3B">{{$solicitud->tel_titular}}</span> </p></th> 

                        <th scope="col" colspan="2" style="text-align:left;padding-top:5px;margin-top:0px;padding-bottom:5px;margin-bottom:0px;"><p style="font-size:12px; padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;">CORREO ELECTRONICO<br>  <span style="font-size:10px;color:#3D3C3B">{{$solicitud->email_titular}}</span> </p></th> 
                        
                      </tr>

                      <tr>
                        <th scope="col" colspan="4" style="text-align:left;padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;"><p style="font-size:12px; padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;">3.2 PROFESIONAL RESPONSABLE </p></th> 
                        
                      </tr>

                      <tr>
                        <th scope="col" colspan="2" style="text-align:left;padding-top:5px;margin-top:0px;padding-bottom:5px;margin-bottom:0px;"><p style="font-size:12px; padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;">NOMBRES <br> <span style="font-size:10px;color:#3D3C3B">{{$solicitud->nom_profesional}} {{$solicitud->ape_profesional}}</span> </p></th> 

                        <th scope="col" colspan="2" style="text-align:left;padding-top:5px;margin-top:0px;padding-bottom:5px;margin-bottom:0px;"><p style="font-size:12px; padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;">CEDULA DE CIUDADANIA<br>  <span style="font-size:10px;color:#3D3C3B">{{$solicitud->ide_profesional}}</span> </p></th> 
                        
                      </tr>

                      <tr>
                        <th scope="col" colspan="2" style="text-align:left;padding-top:5px;margin-top:0px;padding-bottom:5px;margin-bottom:0px;"><p style="font-size:12px; padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;">N° MATRICULA PROFESIONAL<br> <span style="font-size:10px;color:#3D3C3B">{{$solicitud->matricula_profesional}}</span> </p></th> 

                        <th scope="col" colspan="2" style="text-align:left;padding-top:5px;margin-top:0px;padding-bottom:5px;margin-bottom:0px;"><p style="font-size:12px; padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;">FECHA DE EXPEDICION DE MATRICULA<br>  <span style="font-size:10px;color:#3D3C3B">{{$solicitud->fecha_matricula}}</span> </p></th> 
                        
                      </tr>
                      <tr>
                        <th scope="col" colspan="4" style="text-align:left;padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;"><p style="font-size:12px; padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;">3.3 RESPONSABLE DE LA SOLICITUD</p></th> 
                        
                      </tr>

                      <tr>
                        <th scope="col" colspan="2" style="text-align:left;padding-top:5px;margin-top:0px;padding-bottom:5px;margin-bottom:0px;"><p style="font-size:12px; padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;">NOMBRE<br> <span style="font-size:10px;color:#3D3C3B">{{$solicitud->nom_responsable}} {{$solicitud->ape_responsable}}</span> </p></th> 

                        <th scope="col" colspan="2" style="text-align:left;padding-top:5px;margin-top:0px;padding-bottom:5px;margin-bottom:0px;"><p style="font-size:12px; padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;">CEDULA DE CIUDADANIA<br>  <span style="font-size:10px;color:#3D3C3B">{{$solicitud->ide_responsable}}</span> </p></th> 
                        
                      </tr>

                      <tr>
                        <th scope="col" colspan="2" style="text-align:left;padding-top:5px;margin-top:0px;padding-bottom:5px;margin-bottom:0px;"><p style="font-size:12px; padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;">TELEFONO/CELULAR<br> <span style="font-size:10px;color:#3D3C3B">{{$solicitud->tel_responsable}}</span> </p></th> 

                        <th scope="col" colspan="2" style="text-align:left;padding-top:5px;margin-top:0px;padding-bottom:5px;margin-bottom:0px;"><p style="font-size:12px; padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;">CORREO ELECTRONICO<br>  <span style="font-size:10px;color:#3D3C3B">{{$solicitud->email_responsable}}</span> </p></th> 
                        
                      </tr>

                      <tr>
                        <th scope="col" colspan="4" style="text-align:left;padding-top:5px;margin-top:0px;padding-bottom:5px;margin-bottom:0px;"><p style="font-size:12px; padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;">DIRECCION DE CORRESPONDENCIA<br> <span style="font-size:10px;color:#3D3C3B">{{$solicitud->dir_responsable}}</span> </p></th>                         
                        
                      </tr>                  
                                 
                     
                    </tbody>
                  </table> 

            </div>
        </div>
        </div>
    </div>

    <div class="container-fluid" style=" display:block;
    page-break-before:always;">

    <div class="row">
      <div class="col-md-12">
          <img src="{{asset('img/encabezado_3.PNG')}}" class="img-fluid">
      </div>
    </div>

    <div class="row" style="margin-top: 15px; padding-top: 15px;">
      <div class="col-md-12" style="margin-top: 15px; padding-top: 15px;">
        <table class="table table-bordered">
          <thead>
            <tr style="background-color: #D9D9D9">
              <th scope="col" colspan="4" style="text-align:center;padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;">DOCUMENTOS QUE ACOMPAÑAN LA SOLICITUD</th>               
            </tr>

            <tr>
              <th scope="col" colspan="4" style="text-align:center;padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;"><p style="font-size:12px; padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;">DOCUMENTOS COMUNES A TODA SOLICITUD. </p></th> 
              
            </tr>
            <tr>
              <th scope="row" valign="middle" colspan="1" style="text-align:center;padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;vertical-align:middle;">X</th>
              <th scope="row" colspan="3" style="padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;"><p style="font-size:10px;padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;">Copia del documento de identidad del solicitante cuando se trate de personas naturales o certificado de existencia y representación legal, cuya fecha de expedición no sea superior a un mes, cuando se trate de personas jurídicas.</p></th>                        

            </tr>

            <tr>
              <th scope="row" valign="middle" colspan="1" style="text-align:center;padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;vertical-align:middle;">X</th>
              <th scope="row" colspan="3" style="padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;"><p style="font-size:10px;padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;">Poder especial debidamente otorgado, ante notario o juez de la república, cuando se actúe mediante apoderado o mandatario, con la correspondiente presentación personal</p></th>
                        

            </tr>

            <tr>
              <th scope="col" colspan="4" style="text-align:center;padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;"><p style="font-size:12px; padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;">DOCUMENTOS ADICIONALES EN LICENCIAS DE INTERVENCION Y OCUPACIÓN DEL ESPACIO PÚBLICO. </p></th> 
              
            </tr>

            <tr>
              <th scope="row" valign="middle" colspan="1" style="text-align:center;padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;vertical-align:middle;">X</th>
              <th scope="row" colspan="3" style="padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;"><p style="font-size:10px;padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;">1. Descripción del proyecto, indicando las características generales, los elementos urbanos a intervenir en el espacio público, la escala y cobertura</p></th>
            </tr>

            <tr>
              <th scope="row" valign="middle" colspan="1" style="text-align:center;padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px; vertical-align:middle;">X</th>
              <th scope="row" colspan="3" style="padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;"><p style="font-size:10px;padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;">2. Copia de los planos de diseño del Proyecto, acotados y rotulados indicando la identificación del solicitante, la escala, el contenido del plano y la orientación norte. <br><br>

                Los planos deben estar firmados por el profesional responsable del diseño y deben contener la siguiente información:<br><br>
                
                <b>a.</b>	Localización del proyecto en el espacio público a intervenir en escala 1:250 o 1:200 que guarde concordancia con los cuadros de áreas y mojones del plano urbanístico cuando este exista<br>
                <b>b.</b>	Localización del proyecto en el espacio público a intervenir en escala 1:250 o 1:200 que guarde concordancia con los cuadros de áreas y mojones del plano urbanístico cuando este exista.<br>
                <b>c.</b>	Para equipamientos comunales se deben presentar, plantas, cortes y fachadas del proyecto arquitectónico a escala 1:200 o 1:100.<br>
                <b>d.</b>	Cuadro de áreas que determine índices de ocupación, porcentajes de zonas duras, zonas verdes, áreas libres y construidas según sea el caso y cuadro de arborización en el evento de existir. <br>
                <b>e.</b>	Registro fotográfico de la zona a intervenir. <br>
                <b>f.</b>	Especificaciones de diseño y construcción del espacio público.<br>
                </p></th>
                        

            </tr>
            

          </thead>
          <tbody>

          </tbody>
        </table>

      </div>
    </div>


    </div>
   
</body>
</html>