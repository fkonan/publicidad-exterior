<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro de Seguimiento UTSP</title>



    <style type="text/css">
        @page {
            size: A4;
            margin: 0;
        }

        @media print {

            html,
            body {
                width: 210mm;
                height: 297mm;

            }

        }

        @page {
            margin: 50px 40px 30px 40px;
        }

        header {
            position: fixed;
            left: 0px;
            top: 0;
            right: 0px;
            height: 50px;
            text-align: center;
            float: left;
        }


        body {
            font-family: Arial, Helvetica, sans-serif;
            margin-top: 115px;
        }

        .cursiva {
            font-style: italic;
            color: #252525;
            font-size: 14px;
        }
        .big {
            font-weight: bolder;
            color: #252525;
            font-size: 18px;
            font-style: normal;
        }
        .footer {
          position: fixed; 
          left: 0px; 
          bottom: 0px;
          right: 0px;
          height: 10px; 
        }


        
    </style>
</head>

<body>

    <header>

        <img src="{{ asset('img/cabezote-UTSP.PNG') }}" width="100%">
    </header>
    <div class="footer">
      <p style="font-size:8px">Generado {{date('Y-m-d H:i:s')}}</p>
  </div>

    <section style="margin-top:15px;">        
        

        <table style="border-collapse: collapse;width: 100%;">
            <tbody>
                <tr>
                    <td style="border: 1px solid #000; width:20%; text-align:center;height:5%;">
                        <b>Caso N°. {{ $solicitud->radicado }}</b>
                    </td>
                    <td style="width:5%;"></td>
                    <td style="width: 30%">
                        <b>Fecha:</b> <span class="cursiva">{{ $solicitud->fecha_radicacion }}</span>
                    </td>
                    <td style="width:45%">
                        <b>Servicio Público:</b> <span class="cursiva">{{ $solicitud->empresa_publica }}</span>
                    </td>
                </tr>
            </tbody>
        </table>
        <table style="border-collapse: collapse;width: 100%; margin-top:15px;">
            <tbody>
                <tr>
                    <td style="width: 70%">
                        <b>Usuario:</b> <span class="cursiva">{{ $solicitud->nombre_usuario }}
                                {{ $solicitud->apellido_usuario }}</span>
                    </td>
                    <td style="width:30%">
                        <b>CC:</b> <span class="cursiva">{{ $solicitud->numero_documento }}</span>
                    </td>
                </tr>
            </tbody>

        </table>
        <table style="border-collapse: collapse;width: 100%;  margin-top:15px;">
            <tbody>
                <tr>
                    <td style="width: 60%">
                        <b>Correo Electronico:</b> <span class="cursiva">{{ $solicitud->correo_electronico }}</span>
                        
                    </td>
                    <td style="width:40%">
                        <b>Telefono:</b> <span class="cursiva">{{ $solicitud->telefono }}</span>
                    </td>
                </tr>
            </tbody>

        </table>
        <table style="border-collapse: collapse;width: 100%;  margin-top:15px;">
            <tbody>
                <tr>
                    <td style="width: 50%">
                        <b>Direccion:</b> <span class="cursiva">{{ $solicitud->direccion }}</span>
                        
                    </td>
                    <td style="width:25%">
                        <b>Barrio:</b> <span class="cursiva">{{ $solicitud->nombre_barrio }}</span>
                    </td>
                    <td style="width:25%">
                        <b>Comuna:</b> <span class="cursiva">{{ $solicitud->comuna }}</span>
                    </td>
                </tr>
            </tbody>

        </table>
        <table style="border-collapse: collapse;width: 100%;  margin-top:15px;">
            <tbody>
                <tr>
                    <td style="width: 50%">
                        <b>Tipo de Atencion:</b> <span class="cursiva">{{ $solicitud->tipo_atencion }}</span>
                        
                    </td>
                    <td style="width:50%">
                        <b>Tipo de servicio:</b> <span class="cursiva">{{ $solicitud->tipo_servicio }}</span>
                    </td>
                   
                </tr>
            </tbody>

        </table>
        <table style="border-collapse: collapse;width: 100%;  margin-top:15px;">
            <tbody>
                <tr>
                   
                    <td style="width:100%">
                        <b>Empresa de servicios Publicos :</b> <span class="cursiva">{{ $solicitud->empresa_publica }}</span>
                    </td>
                </tr>
            </tbody>

        </table>
        <table style="border-collapse: collapse;width: 100%;  margin-top:15px;">
            <tbody>
                <tr>
                   
                    <td style="width:100%">
                        <b>Estado del Tramite :</b> <mark><span class="big">{{ $solicitud->estado_solicitud }}</span></mark>
                    </td>
                </tr>
            </tbody>

        </table>
        <table style="border-collapse: collapse;width: 100%;  margin-top:25px;">
            <tbody>
                <tr>
                   
                    <td style="border: 1px solid #000; width:100%; padding:10px;">
                        <b>Asunto :</b><br>
                        <p style="text-align:justify;">{{$solicitud->asunto}}</p>
                        <b>Cierre :</b><br>
                    </td>
                </tr>
                <tr>
                   
                    <td style="border: 1px solid #000; width:100%; text-align; padding:5px;">
                        <p style="text-align:center;padding:0;margin:0;"><b>OBSERVACIONES</b></p>
                       
                    </td>
                </tr>
            </tbody>

        </table>
        <table style="border-collapse: collapse;width: 100%;">
          <thead>            
            <th style=" border: 1px solid #000;width:10%;">FECHA</th>
            <th style=" border: 1px solid #000;width:50%;">DETALLE</th>
            <th style=" border: 1px solid #000;width:20%;">FUNCIONARIO</th>
            <th style=" border: 1px solid #000;width:20%;">ADJUNTOS</th>
          </thead>
        </table>
        <table style="border-collapse: collapse;width: 100%;">
          <tbody>
            @foreach($solicitud['observaciones'] as $observaciones)
            <tr>
                <td style="border: 1px solid #000; width:10%; text-align:center;"><span class="cursiva">{{$observaciones->fecha}}</td></td>
                <td style="border: 1px solid #000; width:50%; text-align:justify;"><span class="cursiva">{{$observaciones->observacion}}</span></td>             
                <td style="border: 1px solid #000; width:20%; text-align:center;"><span class="cursiva">{{$observaciones->user->name}}</span></td>
                <td style="border: 1px solid #000; width:20%; text-align:left;">
                    <ol>
                    @foreach($observaciones->documentos as $documento)
                    <li style="font-size:12px;">
                    <a  style="font-size:12px;"href="{{ asset($documento->ruta) }}" target="_blank">{{ $documento->nombre_documento }}</a><br>
                </li>
                @endforeach
               </ol>      
                                        
            </td>
            </tr>
            @endforeach          
                    
          </tbody>         

        </table>
        <div><p style="text-align:justify; font-size:10px;">
          <b>EL MUNICIPIO DE BUCARAMANGA</b> identificado con NIT 890.201.222-0, en calidad de responsable del tratamiento de datos personales y dando cumplimiento a la ley 1581 de 2012 y sus decretos reglamentarios, solicita la autorización previa, libre, expresa y debidamente informada, para dar tratamiento a sus datos personales conforme a las siguientes finalidades: a) acompañar y asesorar al usuario, suscriptor o peticionario para la elaboración de quejas, peticiones o reclamos; b) llevar soporte y trámite de los convenios que se llevan con las empresas de servicios públicos; c) presentar informes administrativos internos y externos; d) permitir comunicación con el usuario, suscriptor o peticionario para informarlo o notificarlo sobre su solicitud; e) generar la trazabilidad de la petición, queja o reclamo que interponga los usuarios, suscriptores o peticionarios. Le recordamos que puede consultar La Política de tratamiento de Información Personal del MUNICIPIO DE BUCARAMANGA, en la página web: www.bucaramanga.gov.co donde podrá conocer los derechos que le asisten como titular y también sobre los canales de atención establecidos para ello</p></div>
    </section>
    {{-- <table width="100%;"  style="border-collapse: collapse;width: 100%; margin: 0; padding: 0;">
          <tbody>
            <tr>
              <td style="width:20%" style="border: 1px solid #000;">
                <p><b>N°. {{$solicitud->radicado}}</b></p>
              </td>
              <td style="width:30%">
                <p><b>Fecha:</b> <span class="cursiva">{{$solicitud->fecha_radicacion}}</span></p>
              </td>
              <td style="width:50%">
                <p><b>Servidor Publico:</b> <span class="cursiva">{{$solicitud->username}}</span></p>
              </td>
            </tr>
          </tbody>

        </table> --}}

    {{-- <div class="row">
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
                      
                      @if ($solicitud->modalidad == 'CONSTRUCCION Y REHABILITACION' && $solicitud->construccion != null)
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


    </div> --}}
    <script type="text/php">if (isset($pdf))
      {
          $x = 375;
          $y = 101;            
          $text = "Pagina {PAGE_NUM} de {PAGE_COUNT}";
          $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "bold");
          $size = 11;
          $color = array(0,0,0);
          $word_space = 0.0;  //  default
          $char_space = 0.0;  //  default
          $angle = 0.0;   //  default
          $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
      }</script>
</body>

</html>
