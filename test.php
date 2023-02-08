<?php
require_once "./modelos/class_SMS.php";


$notificacion=new Mensajeria();

echo $code=$notificacion->prefijoTel(1);


/*

$tel="+240222589550";
$smsRemitente="♻Ha recibido una transferencia de dinero de Miguel Angel MITUY código  396583, diríjase a cualquier punto de M_linemoney con su DIP o Pasaporte";
$smsReceptor="♻ Hola desde mi casa";
$respuesta=$notificacion-> SMS($smsRemitente,$tel);
//$respuesta=$notificacion-> SMS($smsReceptor,$tel); */


?>