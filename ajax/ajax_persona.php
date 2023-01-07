<?php 
session_start();
require_once "../modelos/class_Envios_recibos.php";

$envio=new Persona();

$idtransaccion=isset($_POST["idtransaccion"])? limpiarCadena($_POST["idtransaccion"]):"";
$idreceptor=isset($_POST["idreceptor"])? limpiarCadena($_POST["idreceptor"]):"";
$nombreremitente=isset($_POST["nombreremitente"])? limpiarCadena($_POST["nombreremitente"]):"";
$nombrereceptor=isset($_POST["nombrereceptor"])? limpiarCadena($_POST["nombrereceptor"]):"";
$telefonorem=isset($_POST["telefonorem"])? limpiarCadena($_POST["telefonorem"]):"";
$telefonorec=isset($_POST["telefonorec"])? limpiarCadena($_POST["telefonorec"]):"";
$dirremitente=isset($_POST["dirremitente"])? limpiarCadena($_POST["dirremitente"]):"";
$dirreceptor=isset($_POST["dirreceptor"])? limpiarCadena($_POST["dirreceptor"]):"";
$DNIremitente=isset($_POST["DNIremitente"])? limpiarCadena($_POST["DNIremitente"]):"";
$DNIreceptor=isset($_POST["DNIreceptor"])? limpiarCadena($_POST["DNIreceptor"]):"";
$tipo=isset($_POST["tipo"])? limpiarCadena($_POST["tipo"]):"";
$monto=isset($_POST["monto"])? limpiarCadena($_POST["monto"]):"";
$comision=isset($_POST["comision"])? limpiarCadena($_POST["comision"]):"";
$agenciaA=isset($_POST["agenciaA"])? limpiarCadena($_POST["agenciaA"]):"";
$agenciaB=isset($_POST["agenciaB"])? limpiarCadena($_POST["agenciaB"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
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
$codigoAc=isset($_POST["codigoAc"])? limpiarCadena($_POST["codigoAc"]):"";
$idbkhis=isset($_POST["idbkhis"])? limpiarCadena($_POST["idbkhis"]):"";
$codigo=$envio->generarCodigo(6);

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idtransaccion) && empty($existeR) && empty($existeC)){ // Ese codigo si.
			$rspta=$envio->insertar($nombreremitente,$nombrereceptor,$telefonorem,$telefonorec,$dirremitente,$_SESSION['ap'],$dirreceptor,$DNIremitente,$DNIreceptor,$tipo,$monto,$comision,$agenciaA,$agenciaB,$codigo,$descripcion);
			echo $rspta ? "Envio registrado" : "Envio no se pudo registrar";
			echo '<script> window.open("../reportes/exTicket2.php?id='.$codigo.'","_blank"); </script>';
		}
		elseif (empty($idtransaccion) && !empty($existeR) && !empty($existeC)) { // se usa
			$rspta=$envio->insertarCopia($nombreremitente,$telefonorem,$dirremitente,$DNIreceptor,$nombrereceptor,$telefonorec,$dirreceptor,$DNIremitente,$idreceptor,$agenciaA,$agenciaB,$tipo,$monto,$comision,$codigo,$descripcion,$_SESSION['ap']);
			echo $rspta ? "Envio con copia remitente y receptor realizado " : "Envio copia remitente y receptor no se pudo realizar";
			echo '<script> window.open("../reportes/exTicket2.php?id='.$codigo.'","_blank"); </script>';

		}elseif (empty($idtransaccion) && !empty($existeR) && empty($existeC)){ // se usa tampoco
			$rspta=$envio->insertarCopiaR($nombreremitente,$telefonorem,$dirremitente,$DNIreceptor,$nombrereceptor,$telefonorec,$dirreceptor,$DNIremitente,$idreceptor,$agenciaA,$agenciaB,$tipo,$monto,$comision,$codigo,$descripcion,$_SESSION['ap']);
			echo $rspta ? "Envio con copia remitente realizado " : "Envio copia remitente no se pudo realizar";
			echo '<script> window.open("../reportes/exTicket2.php?id='.$codigo.'","_blank"); </script>';

		}else{ // Ese codigo si
			$rspta=$envio->editar($idtransaccion,$idreceptor,$nombreremitente,$nombrereceptor,$telefonorem,$telefonorec,$dirremitente,$_SESSION['ap'],$dirreceptor,$DNIremitente,$DNIreceptor,$tipo,$monto,$comision,$codigoAc,$agenciaA,$agenciaB,$descripcion,$idreceptor);
			echo $rspta ? "Envio de solicitud realizado" : "Envio de solicitud no se pudo realizar";
			//echo '<script> window.open("../reportes/exTicket.php?id='.$idtransaccion.'","_blank"); </script>';
		}

	break;

	case 'eliminar':
		$rspta=$envio->eliminar($idtransaccion,$_SESSION['ap']);
 		echo $rspta ? "Envio eliminado o cancelado" : "Envio no se puede eliminar o cancelar";
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
		$rspta=$envio->listarEnvios($_SESSION['agencia_em']);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->estadot=='Pendiente')?
 					' <a title="Editar enviando solicitud" href="#" onclick="mostrar('.$reg->idtransaccion.')"><i class="fa fa-edit"></i></a>'.
 					' <a title="Imprimir ticket" target="_blank" href="../reportes/exTicket.php?id='.$reg->idtransaccion.'" onclick="verTiket('.$reg->idtransaccion.')"><i class="fa fa-ticket"></i></a>':
 					' <a title="Recibido o revalidar" href="#" onclick="mostrar('.$reg->idtransaccion.')"><i class="fa fa-edit"></i></a>'.
 					' <a title="Imprimir ticket" target="_blank" href="../reportes/exTicket.php?id='.$reg->idtransaccion.'" ><i class="fa fa-ticket"></i></a>',
 				"1"=>$reg->nomcompleto,
 				"2"=>$reg->tel,
 				"3"=>number_format($reg->monto, 0, '', '.'),
 				"4"=>number_format($reg->comision, 0, '', '.'),
 				"5"=>$reg->codigo,
 				"6"=>$reg->agenciaA,
 				"7"=>$reg->nomcompler,
 				"8"=>$reg->agenciaB,
 				"9"=>$reg->fecrea,
 				"10"=>($reg->estadot=='Pendiente')?'<span class="label bg-orange">'.$reg->estadot.'</span>':
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

		$rspta = $agencia->selectAgencias();

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


	case 'buscarRemitenteRellenarNuevo':
	      //echo $nomcompleto.":Donde este mi nombre";
		require_once "../modelos/class_Envios_recibos.php";
		$busqRell = new Persona();
		$rspta=$busqRell->buscarRemitenteRellenarNuevo($nomcompleto);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'buscarReceptorRellenarNuevo':
	      //echo $nomcompler.":Donde esta mi nombre";
		require_once "../modelos/class_Envios_recibos.php";
		$busqRell = new Persona();
		$rspta=$busqRell->buscarReceptorRellenarNuevo($nomcompler);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'ponerComisiones':
		require_once "../modelos/class_Envios_recibos.php";
		$comision = new Persona();
		$rspta=$comision->comisiones($monto);
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
			$rspta=$solicitud->Validacion($idtransaccionsms,$_SESSION['ap'],$descripcionsms,$mensaje,$mondespues);
			echo $rspta ? "Solicitud autorizada" : "Solicitud no se pudo autorizar";
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
 					' <a title="Recibir" href="#" onclick="mostrar('.$reg->idtransaccion.',1)"><i class="fa fa-edit"></i></a>'.
 					' <a title="Imprimir ticket" target="_blank" href="../reportes/exTicketRecibo.php?id='.$reg->idtransaccion.'" onclick="verTiket('.$reg->idtransaccion.')"><i class="fa fa-ticket"></i></a>':
 					' <a title="Recibido" href="#" onclick="mostrar('.$reg->idtransaccion.',0)"><i class="fa fa-edit"></i></a>'.
 					' <a title="Imprimir ticket" target="_blank" href="../reportes/exTicketRecibo.php?id='.$reg->idtransaccion.'" ><i class="fa fa-ticket"></i></a>',
 				"1"=>$reg->nomcompler,
 				"2"=>$reg->telr,
 				"3"=>number_format($reg->monto, 0, '', '.'),
 				"4"=>$reg->codigo,
 				"5"=>$reg->agenciaB,
 				"6"=>$reg->nomcompleto,
 				"7"=>$reg->agenciaA,
 				"8"=>$reg->fecrea,
 				"9"=>($reg->estadot=='Pendiente')?'<span class="label bg-orange">'.$reg->estadot.'</span>':
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

			$rspta=$envio->editarRecibir($idtransaccion,$idreceptor,$nombrereceptor,$comision,$_SESSION['agencia_em'],$telefonorec,$dirreceptor,$DNIreceptor,$descripcion,$_SESSION['ap'],$idbkhis);
			echo $rspta ? "Envio recibido" : "Envio no se pudo recibir";
			echo '<script> window.open("../reportes/exTicketRecibo.php?id='.$idtransaccion.'","_blank"); </script>';

	    break;


}

// CODIGO RECICLAJE

/*'<a title="Eliminar" class="label bg-red" href="#" onclick="eliminar('.$reg->idtransaccion.')"><i class="fa fa-remove" ></i></a>'.*/
?>