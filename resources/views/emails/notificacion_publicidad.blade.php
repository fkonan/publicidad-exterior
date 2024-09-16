<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <!-- css CDN -->
    <link href="https://cdn.www.gov.co/v2/assets/cdn.min.css" rel="stylesheet">
    <title>Publicidad Exterior</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body style="margin: 0; padding: 0;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="padding: 10px 0 10px 0;">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc; border-collapse: collapse;">
                    <tr>
                        <td bgcolor="#3772FF" align="center" style="padding: 0 0 0 0; color: #153643; font-size: 20px; font-weight: bold; font-family: Arial, sans-serif;">
                            <img src="https://cdn.www.gov.co/assets/images/logo.png" height="25" alt="Logo Gov.co" style="float: right; padding-top: 15px; padding-bottom:10px;" />

                            <img src="https://emergencia.bucaramanga.gov.co/Frame/img/Asset_full.png" height="40" alt="Logo Gov.co" style="float: left; padding-top: 15px; padding-bottom:10px; padding-left:8px;" />


                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" style="padding: 0px 30px 20px 30px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px;"></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
                                        <small><em style="color:f5f5f5; font-size:12px;"><?php echo date('Y-m-d'); ?></em></small><br><br>


                                        <h3 align="justify">Notificación de envió de solicitud N°
                                            {{ $detalleCorreo['radicado'] }}.<br>
                                        </h3>
                                        <p align="justify">Cordial saludo, <strong> {{ $detalleCorreo['nombres'] }}
                                            </strong> .
                                        <p>

                                        <p align="justify">Usted ha realizado una solicitud para publicidad exterior visual, si desea realizar alguna consulta sobre el estado de la
                                            solicitud diríjase a la pagina <a href="https://tramitesenlinea.bucaramanga.gov.co/publicidad-exterior">
                                                https://tramitesenlinea.bucaramanga.gov.co/publicidad-exterior
                                            </a> Con el numero de radicado
                                            <strong>{{ $detalleCorreo['radicado'] }}</strong> opción <u>consulto mi
                                                solicitud</u>.
                                        </p>

                                        <p align="justify">Si tiene alguna inquietud referente a la solicitud favor
                                            comunicarse al correo <a href="mailto:cjguerrero@bucaramanga.gov.co">cjguerrero@bucaramanga.gov.co</a>
                                            y realizar la observación o comunicarse al número telefónico <a href="tel:6337000">6337000</a>ext.</p>

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#3772FF" style="padding: 30px 30px 30px 30px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;" width="75%">
                                        © 2021 Secretaria de Interior - Alcaldía de Bucaramanga.<br />
                                        &reg; Todos los derechos reservados.
                                    </td>
                                    <td align="right" width="25%">
                                        <table border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;">


                                                    </a>
                                                </td>
                                                <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
                                                <td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;">


                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>