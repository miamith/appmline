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
$empresa = "Agencia de envios ECUATUR S.L.";
$documento = "222 XXX XXX";
$direccion = "Rotonda, Cine Rial";
$telefono = "+240 222 000 000";
$email = "miamith@hotmail.com";

?>
<div class="zona_impresion">
<!-- codigo imprimir -->
<br>
<table border="0" align="center" width="300px">
    <tr>
        <td align="center">
        <!-- Mostramos los datos de la empresa en el documento HTML -->
        <h2><b>FORMULARIO DE RECEPCION </b></h2>
        ..:::::<strong> <?php echo $empresa; ?> </strong>:::::..<br>
        <?php echo $documento.' - '.$email; ?><br>
        <?php echo $direccion .' || '.$telefono; ?><br>
        </td>
    </tr>
    <tr>
        <td align="center"><?php echo $reg->fecrea; ?></td>
    </tr>
    <tr>
        <td align="center">-------------------------------------------------------------------------</td>
    </tr>
    <tr>
      <td align="center"></td>
    </tr>
    <tr>
        <!-- Mostramos los datos del remitente en el documento HTML -->
        <td><b>Receptor:</b> <?php echo $reg->nombrereceptor; ?></td>
    </tr>
    <tr>
        <td>Tel:<?php echo $reg->telefonorec." - DIP: ".$reg->DNIreceptor; ?></td>
    </tr>
    <tr>
        <td>Dirección: <?php echo $reg->dirreceptor; ?><br></td>
    </tr>
    <tr>
        <td align="center">&nbsp;</td>
    </tr>
    <tr>
        <!-- Mostramos los datos del receptor en el documento HTML -->
        <td><b>Remitente:</b> <?php echo $reg->nombreremitente; ?></td>
    </tr>
    <tr>
        <td>Tel:<?php echo $reg->telefonorem." - DIP: ".$reg->DNIremitente; ?></td>
    </tr>
    <tr>
        <td>Dirección: <?php echo $reg->dirremitente; ?></td>
    </tr>    
</table>
</br>
<!-- Mostramos los detalles de la venta en el documento HTML -->
<table border="0" align="center" width="300px">
    <tr>
        <td>MONTO ENVIO</td>
        <td>COMISION</td>
        <td align="right">CODIGO</td>
    </tr>
    <tr>
      <td colspan="3">==========================================</td>
    </tr>
    <tr>
        <td><b><?php echo $reg->monto; ?></b></td>
        <td>&nbsp;</td>
        <td align='right'><?php echo $reg->codigo; ?></td>
    </tr>
    <!-- Mostramos los totales del envio en el documento HTML -->
    <tr>
      <td colspan="3">Descripcion: <?php echo $reg->descripcion; ?></td>
    </tr>
<!--     <tr>
        <td>Agencias:</td>
        <td align="right">Desde <?php echo $reg->agenciaB; ?></td>
        <td align="right"> Hasta <?php echo $reg->agenciaA; ?></b></td>
    </tr> -->
    <tr>
      <td><b>EL CLIENTE</b></td>
      <td>&nbsp;</td>
      <td><b>EL AGENTE: <?php echo $reg->agenmod; ?></b></td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr> 
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>      
    <tr>
      <td colspan="3" align="center">¡Gracias por su envio!</td>
    </tr>
    <tr>
      <td colspan="3" align="center">Ecuatur S.L.</td>
    </tr>
    <tr>
      <td colspan="3" align="center">Guinea Ecuatorial - <?php echo $reg->agenciaB; ?></td>
    </tr>
    
</table>
<br>
</div>
<p>&nbsp;</p>

</body>
</html>