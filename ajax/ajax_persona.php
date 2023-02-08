<?php 
session_start();
require_once "../modelos/class_Envios_recibos.php";
require_once "../modelos/class_SMS.php";
$envio=new Persona();
$notificacion=new Mensajeria();


$idtransaccion=isset($_POST["idtransaccion"])? limpiarCadena($_POST["idtransaccion"]):"";
$idreceptor=isset($_POST["idreceptor"])? limpiarCadena($_POST["idreceptor"]):"";
$nombreremitente=isset($_POST["nombreremitente"])? limpiarCadena($_POST["nombreremitente"]):"";
$nombrereceptor=isset($_POST["nombrereceptor"])? limpiarCadena($_POST["nombrereceptor"]):"";
$telefonorem=isset($_POST["telefonorem"])? limpiarCadena($_POST["telefonorem"]):"";
$telefonorec=isset($_POST["telefonorec"])? limpiarCadena($_POST["telefonorec"]):"";
$dirremitente=isset($_POST["dirremitente"])? limpiarCadena($_POST["dirremitente"]):"";
$dirreceptor=isset($_POST["dirreceptor"])? limpiarCadena($_POST["dirreceptor"]):"";
$DNIremitente=isset($_POST["DNIremitente"])? limpiarCadena($_POST["DNIremitente"]):"";
$DNIreceptor=isset($_POST["DNIreceptor"])? limpiarCadena($_POST["DNIreceptor"]):""; // TODO: del formulario pago
$tipo=isset($_POST["tipo"])? limpiarCadena($_POST["tipo"]):"";
$monto=isset($_POST["monto"])? limpiarCadena($_POST["monto"]):"";
$comision=isset($_POST["comision"])? limpiarCadena($_POST["comision"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$secreto=isset($_POST["secreto"])? limpiarCadena($_POST["secreto"]):"";
$pais_destino=isset($_POST["pais_destino"])? limpiarCadena($_POST["pais_destino"]):"";
$comi_remi=isset($_POST["comi_remi"])? limpiarCadena($_POST["comi_remi"]):"";
$comi_benef=isset($_POST["comi_benef"])? limpiarCadena($_POST["comi_benef"]):"";
$aCobrar=isset($_POST["aCobrar"])? limpiarCadena($_POST["aCobrar"]):"";
$cobrar=isset($_POST["cobrar"])? limpiarCadena($_POST["cobrar"]):""; //TODO: Este es del formulario de pagar


// Bloque solicitud y validacion
$idtransaccionsms=isset($_POST["idtransaccionsms"])? limpiarCadena($_POST["idtransaccionsms"]):"";
$idsolicitud=isset($_POST["idsolicitud"])? limpiarCadena($_POST["idsolicitud"]):"";
$descripcionsms=isset($_POST["descripcionsms"])? limpiarCadena($_POST["descripcionsms"]):"";
$mensaje=isset($_POST["mensaje"])? limpiarCadena($_POST["mensaje"]):"";
$monantes=isset($_POST["monantes"])? limpiarCadena($_POST["monantes"]):"";
$nomcompleto=isset($_POST["nomcompleto"])? limpiarCadena($_POST["nomcompleto"]):"";
$nomcompler=isset($_POST["nomcompler"])? limpiarCadena($_POST["nomcompler"]):"";
$existeR=isset($_POST["existeR"])? limpiarCadena($_POST["existeR"]):"";
$existeC=isset($_POST["existeC"])? limpiarCadena($_POST["existeC"]):"";
$referenciaAc=isset($_POST["referenciaAc"])? limpiarCadena($_POST["referenciaAc"]):"";
$codigoAc=isset($_POST["codigoAc"])? limpiarCadena($_POST["codigoAc"]):"";
$telr=isset($_POST["telr"])? limpiarCadena($_POST["telr"]):"";
$idbkhis=isset($_POST["idbkhis"])? limpiarCadena($_POST["idbkhis"]):"";

$codigo=$envio->generarCodigo(8);
$referencia=$envio->generarCodigo(12);

// Campo de buscar envio a cobrar
$codigoB=isset($_POST["codigo"])? limpiarCadena($_POST["codigo"]):""; 

switch ($_GET["op"]){

	case 'guardaryeditar':

// Comisiones desde la BD:  idTasas,comisiont, moneda, IVA,porcenENVIO,porcenRECIBIR
$respuesCom=$envio -> comisiones2($monto,$pais_destino, $_SESSION['pais']);
$regComision = $respuesCom-> fetch_object();
$comisiontDB=$regComision->comisiont;
$moneda=$regComision->moneda;
$IVAconfig=$regComision->IVA;
$porcenENVIO=$regComision->porcenENVIO;
$porcenRECIBIR=$regComision->porcenRECIBIR;
// Operar saldos
$IVA=($comisiontDB * $IVAconfig)/100;
$comReparto=($comisiontDB - $IVA);
$comi_remi=($comReparto * $porcenENVIO)/100;
$comi_benef=($comReparto * $porcenRECIBIR)/100;
$comi_empre=($comReparto - $comi_remi - $comi_benef);


// Verificar saldo Remitente
$respuestaAgente=$envio-> verificarSaldo($_SESSION['DNI'],$_SESSION['ap'], $_SESSION['ncpCorriente'], $_SESSION['ncpComisiones']);
$regAgente = $respuestaAgente->fetch_object();
$saldoNCPcorriente=(int)$regAgente->saldoNCPcorriente;
$saldoNCPcomisiones=(int)$regAgente->saldoNCPcomisiones;
$NCPcorriente=$regAgente->NCPcorriente;
$NCPcomisiones=$regAgente->NCPcomisiones;
// Operar saldos
$saldoAgenRemitRestanteNCorri=($saldoNCPcorriente - $monto - $comisiontDB);
$saldo_rescuenta=($saldoNCPcorriente - $comisiontDB - $monto);
$cobrar=($monto - $comisiontDB);
$saldoNCPcomisionesFINAL=($saldoNCPcomisiones + $comi_remi);
	// Regular saldo Beneficiario

// TOMAR LAS CUENTAS DE EMPRESA IVA Y COMISIONES
$respuestaMline=$envio-> verificarSaldoMLINE();
$regSistema = $respuestaMline->fetch_object();

$NCPcomisionesMLINE=(int)($regSistema->NCPcomisionesMLINE);
$NCPivaMLINE=($regSistema->NCPivaMLINE);
$saldoNCPcomisionesMLINE=(int)($regSistema->saldoNCPcomisionesMLINE + $comi_empre);
$saldoNCPivaMLINE=(int)($regSistema->saldoNCPivaMLINE + $IVA);
	
// VERFICAR SALDO ANTES DE ENVIAR

if($monto > $saldoNCPcorriente){ // INCIO SI HAY SALDO

	echo "Saldo insuficiente, no se ha podido realizar el envio";

} else{

	if (empty($idtransaccion) && empty($existeR) && empty($existeC)){ // Ese codigo si.
		$rspta=$envio->insertar($referencia,$nombreremitente,$nombrereceptor,$telefonorem,$telefonorec,$dirremitente,
		$_SESSION['ap'],$dirreceptor,$DNIremitente,$tipo,$monto,$comision,$_SESSION['agencia_em'],
		$codigo,$secreto,$comi_empre, $comi_remi,$comi_benef,$IVA,$saldo_rescuenta,$cobrar,
		$saldoNCPcomisionesFINAL,$NCPcomisiones,$NCPcorriente,
		$pais_destino, $descripcion,$_SESSION['pais'],$_SESSION['caja'],
		$NCPcomisionesMLINE,$NCPivaMLINE,$saldoNCPcomisionesMLINE,$saldoNCPivaMLINE);
		echo $rspta ? "Envio registrado" : "Envio no se pudo registrar";
		// ENVIAR MENSAJE MOVIL
		if ($rspta) {
			$smsRemitente="♻ Su transferencia de dinero a .$nombrereceptor.  
			código .$codigo. ha sido efectuada con éxito, gracias por confiar en nosotros";
			$smsReceptor="♻ Ha recibido una transferencia de dinero de .$nombreremitente., código .$codigo., 
			diríjase a cualquier punto de M_lineMoney con su DIP o Pasaporte";
			$respuesta=$notificacion-> SMS($smsRemitente,($respuesta=$notificacion-> prefijoTel($_SESSION['pais'])).$telefonorem);
			$respuesta=$notificacion-> SMS($smsReceptor,($respuesta=$notificacion-> prefijoTel($pais_destino)).$telefonorec);
		}
		echo '<script> window.open("../reportes/exTicket2.php?id='.$codigo.'","_blank"); </script>';

	}
	elseif (empty($idtransaccion) && !empty($existeR) && !empty($existeC)) { // se usa
		$rspta=$envio->insertarCopia($referencia,$nombreremitente,$nombrereceptor,$telefonorem,$telefonorec,$dirremitente,
		$_SESSION['ap'],$dirreceptor,$DNIremitente,$tipo,$monto,$comision,$_SESSION['agencia_em'],
		$codigo,$secreto,$comi_empre, $comi_remi,$comi_benef,$IVA,$saldo_rescuenta,$cobrar,
		$saldoNCPcomisionesFINAL,$NCPcomisiones,$NCPcorriente,
		$pais_destino, $descripcion,$_SESSION['pais'],$_SESSION['caja'],$idreceptor,
		$NCPcomisionesMLINE,$NCPivaMLINE,$saldoNCPcomisionesMLINE,$saldoNCPivaMLINE);
		echo $rspta ? "Envio con copia del remitente y receptor realizado " : "Envio copia remitente y receptor no se pudo realizar";
		// ENVIAR MENSAJE MOVIL
		if ($rspta) {
			$smsRemitente="♻ Su transferencia de dinero a .$nombrereceptor.  
			código .$codigo. ha sido efectuada con éxito, gracias por confiar en nosotros";
			$smsReceptor="♻ Ha recibido una transferencia de dinero de .$nombreremitente., código .$codigo., 
			diríjase a cualquier punto de M_lineMoney con su DIP o Pasaporte";
			$respuesta=$notificacion-> SMS($smsRemitente,($respuesta=$notificacion-> prefijoTel($_SESSION['pais'])).$telefonorem);
			$respuesta=$notificacion-> SMS($smsReceptor,($respuesta=$notificacion-> prefijoTel($pais_destino)).$telefonorec);
		}
		echo '<script> window.open("../reportes/exTicket2.php?id='.$codigo.'","_blank"); </script>';

	}elseif (empty($idtransaccion) && !empty($existeR) && empty($existeC)){ // se usa tampoco
		$rspta=$envio->insertarCopiaR($referencia,$nombreremitente,$nombrereceptor,$telefonorem,$telefonorec,$dirremitente,
		$_SESSION['ap'],$dirreceptor,$DNIremitente,$tipo,$monto,$comision,$_SESSION['agencia_em'],
		$codigo,$secreto,$comi_empre, $comi_remi,$comi_benef,$IVA,$saldo_rescuenta,$cobrar,
		$saldoNCPcomisionesFINAL,$NCPcomisiones,$NCPcorriente,
		$pais_destino, $descripcion,$_SESSION['pais'],$_SESSION['caja'],
		$NCPcomisionesMLINE,$NCPivaMLINE,$saldoNCPcomisionesMLINE,$saldoNCPivaMLINE);
		echo $rspta ? "Envio con copia del remitente realizado " : "Envio copia remitente no se pudo realizar";
		// ENVIAR MENSAJE MOVIL
		if ($rspta) {
			$smsRemitente="♻ Su transferencia de dinero a .$nombrereceptor.  
			código .$codigo. ha sido efectuada con éxito, gracias por confiar en nosotros";
			$smsReceptor="♻ Ha recibido una transferencia de dinero de .$nombreremitente., código .$codigo., 
			diríjase a cualquier punto de M_lineMoney con su DIP o Pasaporte";
			$respuesta=$notificacion-> SMS($smsRemitente,($respuesta=$notificacion-> prefijoTel($_SESSION['pais'])).$telefonorem);
			$respuesta=$notificacion-> SMS($smsReceptor,($respuesta=$notificacion-> prefijoTel($pais_destino)).$telefonorec);
		}
		echo '<script> window.open("../reportes/exTicket2.php?id='.$codigo.'","_blank"); </script>';
	
	}elseif (empty($idtransaccion) && empty($existeR) && !empty($existeC)){ // se usa tampoco
		$rspta=$envio->insertarCopiaBen($referencia,$nombreremitente,$nombrereceptor,$telefonorem,$telefonorec,$dirremitente,
		$_SESSION['ap'],$dirreceptor,$DNIremitente,$tipo,$monto,$comision,$_SESSION['agencia_em'],
		$codigo,$secreto,$comi_empre, $comi_remi,$comi_benef,$IVA,$saldo_rescuenta,$cobrar,
		$saldoNCPcomisionesFINAL,$NCPcomisiones,$NCPcorriente,
		$pais_destino, $descripcion,$_SESSION['pais'],$_SESSION['caja'],$idreceptor,
		$NCPcomisionesMLINE,$NCPivaMLINE,$saldoNCPcomisionesMLINE,$saldoNCPivaMLINE);
		echo $rspta ? "Envio con copia del beneficiario realizado " : "Envio copia remitente no se pudo realizar";
		// ENVIAR MENSAJE MOVIL
		if ($rspta) {
			$smsRemitente="♻ Su transferencia de dinero a .$nombrereceptor.  
			código .$codigo. ha sido efectuada con éxito, gracias por confiar en nosotros";
			$smsReceptor="♻ Ha recibido una transferencia de dinero de .$nombreremitente., código .$codigo., 
			diríjase a cualquier punto de M_lineMoney con su DIP o Pasaporte";
			$respuesta=$notificacion-> SMS($smsRemitente,($respuesta=$notificacion-> prefijoTel($_SESSION['pais'])).$telefonorem);
			$respuesta=$notificacion-> SMS($smsReceptor,($respuesta=$notificacion-> prefijoTel($pais_destino)).$telefonorec);
		}
		echo '<script> window.open("../reportes/exTicket2.php?id='.$codigo.'","_blank"); </script>';
		

	
	}else{ // Ese codigo si ES PARA MANDAR UNA MODIFICACION DE ALGUN DATO ERRONEO EN EL ENVIO
		$rspta=$envio->editar($referenciaAc,$codigoAc,$idtransaccion,$referencia,$nombreremitente,$nombrereceptor,$telefonorem,$telefonorec,$dirremitente,
		$_SESSION['ap'],$dirreceptor,$DNIremitente,$tipo,$monto,$comision,$_SESSION['agencia_em'],
		$codigo,$secreto,$comi_empre, $comi_remi,$comi_benef,$IVA,$saldo_rescuenta,$cobrar,
		$saldoNCPcomisionesFINAL,$NCPcomisiones,$NCPcorriente,
		$pais_destino, $descripcion,$_SESSION['pais'],$_SESSION['caja'],$idreceptor,
		$NCPcomisionesMLINE,$NCPivaMLINE,$saldoNCPcomisionesMLINE,$saldoNCPivaMLINE);
		echo $rspta ? "Envio de solicitud de modificacion realizado" : "Envio de solicitud no se pudo realizar";
		//echo '<script> window.open("../reportes/exTicket.php?id='.$idtransaccion.'","_blank"); </script>';
	}



}  // FIN SI HAY SALDO


	break;

	case 'eliminar':
		$rspta=$envio->eliminar($idtransaccion,$_SESSION['ap']);
 		echo $rspta ? "Envio eliminado o cancelado PASACION DE DINERO FISICO" : "Envio no se puede eliminar o cancelar";
	break;

	case 'mostrar':
		$rspta=$envio->mostrar($idtransaccion);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

		case 'mostrarRecibo':
		$rspta=$envio->mostrarRecibo($idtransaccion);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listarEnvios':
		$rspta=$envio->listarEnvios($_SESSION['agencia_em'],$_SESSION['ap'],$_SESSION['rol']);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->estadot=='Pendiente')?
 					' <a title="Editar enviando solicitud" href="#" onclick="mostrar('.$reg->idtransaccion.')"><i class="fa fa-edit"></i></a>'.
 					' <a title="Imprimir ticket" target="_blank" href="../reportes/exTicket.php?id='.$reg->idtransaccion.'" onclick="verTiket('.$reg->idtransaccion.')"><i class="fa fa-ticket"></i></a>'
					:
 					' <a title="Recibido o revalidar" href="#" onclick="mostrar('.$reg->idtransaccion.')"><i class="fa fa-edit"></i></a>'.
 					' <a title="Imprimir ticket" target="_blank" href="../reportes/exTicket2.php?id='.$reg->codigo.'" ><i class="fa fa-ticket"></i></a>',
 				"1"=>$reg->nomcompleto,
 				"2"=>$reg->tel,
 				"3"=>number_format($reg->monto, 0, '', ','),
				"4"=>number_format($reg->cobrar, 0, '', ','),
 				"5"=>number_format($reg->comision, 0, '', ','),
 				"6"=>$reg->codigo,
 				"7"=>$reg->agenciaA,
 				"8"=>$reg->nomcompler,
 				"9"=>$reg->agenciaB,
				"10"=>$reg->agentcreat,
 				"11"=>$reg->fecrea,
 				"12"=>($reg->estadot=='Pendiente')?'<span class="label bg-orange">'.$reg->estadot.'</span>':
 				'<span class="label bg-red">'.$reg->estadot.'</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case "selectAgencia":
		require_once "../modelos/class_Envios_recibos.php";
		$agencia = new Persona();

		$rspta = $agencia->selectAgencias($_SESSION['pais'],$_SESSION['agencia_em'],$_SESSION['rol'],$_SESSION['ap']);
					echo '<option value="">Elije agencia</option>';
		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idagencia . '>' . $reg->nombre . '</option>';
				}
	break;

		case "selectAgenciaEmpleado":
		require_once "../modelos/class_Envios_recibos.php";
		$agenciae = new Persona();

		$rspta = $agenciae->selectAgenciaEmpleado($_SESSION['idempleado']);

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idagencia . '>' . $reg->nombre . '</option>';
				}
		break;

    case "selectAgenciaReceptora":
	require_once "../modelos/class_Envios_recibos.php";
	$agenciar = new Persona();
	$rspta = $agenciar->selectAgenciaReceptora($_SESSION['agencia_em']);
	while ($reg = $rspta->fetch_object())
	      {
			  echo '<option value=' . $reg->idagencia . '>' . $reg->nombre . '</option>';
		  }
    break;
	
	case 'traerSaldoActual':
	      //Funcion para traer el saldo asincrono y poner en html
		require_once "../modelos/class_Envios_recibos.php";
		$traeSaldo = new Persona();
		$rspta=$traeSaldo->traerSaldoActual($_SESSION['DNI'], $_SESSION['ncpCorriente']);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'buscarRemitenteRellenarNuevo':
	      //echo $nomcompleto.":Donde este mi nombre";
		require_once "../modelos/class_Envios_recibos.php";
		$busqRell = new Persona();
		$rspta=$busqRell->buscarRemitenteRellenarNuevo($DNIremitente);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'buscarReceptorRellenarNuevo':
	      //echo $nomcompler.":Donde esta mi nombre";
		require_once "../modelos/class_Envios_recibos.php";
		$busqRell = new Persona();
		$rspta=$busqRell->buscarReceptorRellenarNuevo($telr);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

		case 'buscarEnvio':
	      //echo $nomcompler.":Donde esta mi codigo";
		require_once "../modelos/class_Envios_recibos.php";
		$buscarCodigoEnvio = new Persona();
		$rspta=$buscarCodigoEnvio->buscarEnvioClas($codigoB);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	// Buscar el monto a cobrar si coincide
		case 'verificarMontoCOBRAR':
	      //echo $nomcompler.":Donde esta mi codigo";
		require_once "../modelos/class_Envios_recibos.php";
		$buscarMontoCobrar = new Persona();
		$rspta=$buscarMontoCobrar->verificarMontoCOBRAR($codigoB,$cobrar);
 		//Codificar el resultado utilizando json
		echo json_encode($rspta);
	break;

	// Buscar el CODIGO SECRETO
	case 'verificarCodigoSECRETO':
		//echo $nomcompler.":Donde esta mi codigo";
	  require_once "../modelos/class_Envios_recibos.php";
	  $buscarSECRETO= new Persona();
	  $rspta=$buscarSECRETO->verificarCodigoSECRETO($codigoB,$secreto);
	   //Codificar el resultado utilizando json
	  echo json_encode($rspta);
  break;
	


	case 'ponerComisiones':
		require_once "../modelos/class_Envios_recibos.php";
		$comision = new Persona();
		$rspta=$comision->comisiones($monto, $pais_destino, $_SESSION['pais']);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;


	case 'smsSolicitudValidar':
			require_once "../modelos/class_Envios_recibos.php";
		    $solicitud = new Persona();
		if (empty($idsolicitud)){
			$rspta=$solicitud->smsSolicitud($idtransaccionsms,$descripcionsms,$mensaje,$monantes,$_SESSION['ap']);
			echo $rspta ? "Solicitud enviada" : "Solicitud no se pudo enviar";
		}
		else {
			/*$rspta=$solicitud->Validacion($idtransaccionsms,$_SESSION['ap'],$descripcionsms,$mensaje,$mondespues);
			echo $rspta ? "Solicitud autorizada" : "Solicitud no se pudo autorizar";*/
		}
		break;



		////////////////////////////////////////// RECIBOS INICIO ////////////////////////////////////////////////////////////


	case 'listarRecibos':


		$rspta=$envio->listarRecibos($_SESSION['agencia_em']);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->estadot=='Pendiente')?
 					' <a title="Recibir" href="#" onclick="mostrar('.$reg->idtransaccion.',1)"><i class="fa fa-edit"></i></a>'
 					//' <a title="Imprimir ticket" target="_blank" href="../reportes/exTicketRecibo.php?id='.$reg->idtransaccion.'" onclick="verTiket('.$reg->idtransaccion.')"><i class="fa fa-ticket"></i></a>'
					:
 					' <a title="Recibido" href="#" onclick="mostrar('.$reg->idtransaccion.',0)"><i class="fa fa-edit"></i></a>'.
 					' <a title="Imprimir ticket" target="_blank" href="../reportes/exTicketRecibo.php?id='.$reg->idtransaccion.'" ><i class="fa fa-ticket"></i></a>',
 				"1"=>$reg->nomcompler,
 				"2"=>$reg->telr,
 				"3"=>number_format($reg->monto, 0, '', ','),
				"4"=>number_format($reg->cobrar, 0, '', ','),
 				"5"=>$reg->codigo,
 				"6"=>$reg->agenciaB,
 				"7"=>$reg->nomcompleto,
 				"8"=>$reg->agenciaA,
 				"9"=>$reg->fecrea,
 				"10"=>($reg->estadot=='Pendiente')?'<span class="label bg-orange">'.$reg->estadot.'</span>':
 				'<span class="label bg-green">'.$reg->estadot.'</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;



	case 'guardarRecibir':
	
// Verificar saldo PAGADOR, ESTE CODIGO ESTA EN ENVIAR TAMBIEN, tenemos que obtener los saldos de las NCP
$respuestaAgente=$envio-> verificarSaldo($_SESSION['DNI'],$_SESSION['ap'], $_SESSION['ncpCorriente'], $_SESSION['ncpComisiones']);
$regAgente = $respuestaAgente->fetch_object();
$saldoNCPcorriente=intval($regAgente->saldoNCPcorriente);
$saldoNCPcomisiones=intval($regAgente->saldoNCPcomisiones);
$NCPcorriente=$regAgente->NCPcorriente;
$NCPcomisiones=$regAgente->NCPcomisiones;
// Operar saldos
$saldoAgenPagoRestanteNCorri=(intval($saldoNCPcorriente) + intval($cobrar));
$saldo_rescuenta=(intval($saldoNCPcorriente) + intval($cobrar));
$saldoNCPcomisionesFINAL=(intval($saldoNCPcomisiones) + intval($comi_benef));

		$rspta=$envio->editarRecibir($idtransaccion,$idreceptor,$nombrereceptor,$comision,$comi_benef,$cobrar,
		$_SESSION['agencia_em'],$telefonorec,$dirreceptor,$DNIreceptor,$descripcion,$_SESSION['ap'],$idbkhis,
		$NCPcorriente,$NCPcomisiones,$saldoAgenPagoRestanteNCorri,$saldoNCPcomisionesFINAL,$saldo_rescuenta);
		echo $rspta ? "Envio recibido" : "Envio no se pudo recibir";
		echo $rspta ? '<script> window.open("../reportes/exTicketRecibo.php?id='.$idtransaccion.'","_blank"); </script>' : 'Algo salio mal !!';

	break;


}

// CODIGO RECICLAJE

/*'<a title="Eliminar" class="label bg-red" href="#" onclick="eliminar('.$reg->idtransaccion.')"><i class="fa fa-remove" ></i></a>'.*/
?>