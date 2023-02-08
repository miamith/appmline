<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["ap"]))
{
  header("Location: login.html");
}
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link href="../public/dist/css/ticket.css" rel="stylesheet" type="text/css">
</head>
<body onload="window.print();">
<?php

//Incluímos la clase Venta
require_once "../modelos/class_Agencia.php";
//Instanaciamos a la clase con el objeto venta
$ver = new Agencia();
//En el objeto $rspta Obtenemos los valores devueltos del método mostrar del modelo
$rspta = $ver->mostrarTicketVentaUV($_GET["id"]); // codigo de transaccion
//Recorremos todos los valores obtenidos
 $reg = $rspta->fetch_object();

//Establecemos los datos de la empresa
$empresa = "Agencia de envios M_line S.A.";
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
        <span><img width="310" src="../public/dist/img/lgfactura.png" alt="Logo de factura m_line"></span>
        <br><br>
        <span><img width="120" src="../public/dist/img/contacto.jpg" alt="Logo de contacto m_line"></span>
        <h1><b>Transaccion UV</b></h1>
        <h3><b>Informacion de la transaccion</b></h3>
        </td>
    </tr>
    <tr>
        <td>
          <b >Fecha de transaccion: <?php echo $reg->fecrea; ?></b><br><br>
          <b >Numero de transaccion: <?php echo $reg->codigo; ?></b><br><br>
          <b >Desde: <?php echo $reg->agenciaA; ?></b><br><br>
          <b >A: <?php echo $reg->agenciaB; ?></b><br><br>
          <b >Tipo operacion: Debito <?php echo $reg->agenciaB; ?></b><br><br>
          <b >Observacion: <?php echo $reg->descripcion; ?></b><br><br>
          <b >Cantidad: <?php echo number_format($reg->monto, 0, '', '.'); ?></b><br><br>
          <b >Moneda: FCFA</b>
      </td>
    </tr>
    <tr>
        <td>
          <b>Puesto: <?php echo $reg->agenciaA; ?></b><br><br>
          <b>Agente: <?php echo $reg->agentcreat.' '.$reg->nombreremitente; ?></b><br>
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