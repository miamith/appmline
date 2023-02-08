<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link href="../public/dist/css/ticket.css" rel="stylesheet" type="text/css">
</head>
<body onload="window.print();">
<?php

//Incluímos la clase Venta
require_once "../modelos/class_Envios_recibos.php";
//Instanaciamos a la clase con el objeto venta
$ver = new Persona();
//En el objeto $rspta Obtenemos los valores devueltos del método mostrar del modelo
$rspta = $ver->mostrarTicketRecibo($_GET["id"]); // idtransaccion
//Recorremos todos los valores obtenidos
 $reg = $rspta->fetch_object();

//Establecemos los datos de la empresa
$empresa = "Agencia de envios M_line S.L.";
$documento = "2047776897";
$direccion = "Santa Maria, An. E Venezuela";
$telefono = "+240 222 XXXXXX";
$email = "m_linemoney@gmail.com";

?>
<div class="zona_impresion">
<!-- codigo imprimir -->
<br>
<table border="0" align="center" width="300px">
    <tr>
        <td align="center">
        <!-- Mostramos los datos de la empresa en el documento HTML -->
        <span><img width="300" src="../public/dist/img/lgfactura.png" alt="Logo de factura m_line"></span>
        <span><img width="80" src="../public/dist/img/contacto.jpg" alt="Logo de contacto m_line"></span>
        <h2><b>Retiro de efectivo</b></h2>
        <h3><b>Informacion de la transaccion</b></h3>
        </td>
    </tr>
    <tr>
        <td>
          <b >Fecha de transaccion: <?php echo $reg->fecrea; ?></b><br><br>
          <b >Numero de transaccion: <?php echo $reg->codigo; ?></b><br><br>
          <b >Ciudad: <?php echo $reg->dirremitente; ?></b><br><br>
          <b >Cantidad enviada: <?php echo number_format($reg->monto, 0, '', '.'); ?></b><br><br>
          <b >Cantidad recibida: <?php echo number_format($reg->cobrar, 0, '', '.'); ?></b><br><br>
          <b >Comision pagada: <?php echo number_format($reg->comision, 0, '', '.'); ?></b><br><br>
          <b >Moneda: FCFA</b>
      </td>
    </tr>
    <tr>
        <!-- Mostramos los datos del remitente en el documento HTML -->
        <td align="center"><h3><b>Remitente</b></h3></td>
    </tr>
    <tr>
        <td>
          <b>Nombre: <?php echo $reg->nombreremitente; ?></b><br><br>
          <b>Telefono: <?php echo $reg->telefonorem; ?></b><br><br>
          <b>DIP: <?php echo $reg->DNIremitente; ?></b><br>
        </td>
    </tr>
    <tr>
        <!-- Mostramos los datos del remitente en el documento HTML -->
        <td align="center"><h3><b>Beneficiario</b></h3></td>
    </tr>
    <tr>
        <td>
          <b>Nombre: <?php echo $reg->nombrereceptor; ?></b><br><br>
          <b>Telefono: <?php echo $reg->telefonorec; ?></b><br><br>
          <b>Puesto: <?php echo $reg->agenciaA; ?></b><br><br>
          <b>Agente: <?php echo $reg->agentcreat; ?></b><br>
        </td>
    </tr>  
</table>
</br>
<!-- Mostramos los detalles de la venta en el documento HTML -->
<table border="0" align="center" width="300px">
     
    <tr>
      <td colspan="3" align="center">
                                      ¡Gracias por su envio!<br>
                                      M_line S.A.<br>
                                      Guinea Ecuatorial - <?php echo $reg->agenciaA; ?>
      </td>
    </tr>
</table>
</div>

</body>
</html>