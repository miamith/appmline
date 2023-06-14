<?php
session_start(); 
require_once "../modelos/class_Caja.php";
require_once "../modelos/class_Envios_recibos.php";
$envio= new Persona();
$caja=new Caja();


$idCaja=isset($_POST["idCaja"])? limpiarCadena($_POST["idCaja"]):"";
$cliente =isset($_POST["cliente"])? limpiarCadena($_POST["cliente"]):"";
$agencia=isset($_POST["agencia"])? limpiarCadena($_POST["agencia"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$cajero=isset($_POST["cajero"])? limpiarCadena($_POST["cajero"]):"";
$ncpCorriente=isset($_POST["ncpCorriente"])? limpiarCadena($_POST["ncpCorriente"]):"";
$ncpComisiones=isset($_POST["ncpComisiones"])? limpiarCadena($_POST["ncpComisiones"]):"";
$montoMaxEnvio=isset($_POST["montoMaxEnvio"])? limpiarCadena($_POST["montoMaxEnvio"]):"";
$cajacerrada=isset($_POST["cajacerrada"])? limpiarCadena($_POST["cajacerrada"]):"";

// OPERACIONES EN LA CAJA CAMPOS DEL MODAL
$idCajaOP =isset($_POST["idCajaOP"])? limpiarCadena($_POST["idCajaOP"]):"";
$clienteremitente =isset($_POST["clienteremitente"])? limpiarCadena($_POST["clienteremitente"]):"";
$clientebeneficiario =isset($_POST["clientebeneficiario"])? limpiarCadena($_POST["clientebeneficiario"]):"";
$paisorigen =isset($_POST["paisorigen"])? limpiarCadena($_POST["paisorigen"]):"";
$paisdestino =isset($_POST["paisdestino"])? limpiarCadena($_POST["paisdestino"]):"";
$ncpremitente =isset($_POST["ncpremitente"])? limpiarCadena($_POST["ncpremitente"]):"";
$agenciabeneficiaria =isset($_POST["agenciabeneficiaria"])? limpiarCadena($_POST["agenciabeneficiaria"]):"";
$ncpbeneficiaria =isset($_POST["ncpbeneficiaria"])? limpiarCadena($_POST["ncpbeneficiaria"]):"";
$agenciaremitente =isset($_POST["agenciaremitente"])? limpiarCadena($_POST["agenciaremitente"]):"";
$monto =isset($_POST["monto"])? limpiarCadena($_POST["monto"]):"";
$tipo =isset($_POST["tipo"])? limpiarCadena($_POST["tipo"]):"";
$descripcion =isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$referencia=$envio->generarCodigo(8); 
$codigo=$envio->generarCodigo(6); 

/* 
001 -> Enviar dinero
002 -> Vender UV a una agencia
003 -> Restituir UV de una agencia
004 -> Aprovisionar una CAJA
005 -> Restitur aprovisionamiento de un CAJA
006 -> Cobrar comisiones efectivo
007 -> Pasar comisiones CAJA a Agencia.
 */


switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idCaja)){

			$rspta=$caja->insertar($cliente,$agencia,$nombre,$cajero,$ncpCorriente,$ncpComisiones,$montoMaxEnvio,$cajacerrada,$_SESSION['ap']);
			echo $rspta ? "Caja creada" : "Caja no se pudo registrar";
		}
		else {
			$rspta=$caja->editar($idCaja,$cliente,$agencia,$nombre,$cajero,$ncpCorriente,$ncpComisiones,$montoMaxEnvio,$cajacerrada,$_SESSION['ap']);
			echo $rspta ? "Caja Actualizada" : "Caja no se pudo actualizar";
		}
	break;

	case 'eliminar':
		$rspta=$caja->eliminar($idCaja);
 		echo $rspta ? "Caja cerrada" : "Caja no se puede cerrar";
	break;

	case 'mostrar':
		$rspta=$caja->mostrar($idCaja);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$caja->listar($_SESSION['pais'],$_SESSION['agencia_em'],$_SESSION['rol'],$_SESSION['ap']);
 		//Vamos a declarar un array
 		$data= Array();
        $enum=1;
 		while ($reg=$rspta->fetch_object()){
			
			// CONTROL DEL ROL DEL USUARIO
		switch ($_SESSION['rol']){

			case 'Agencia': // SI ES UN USUARIO MASTER O AGENCIA FRANQUICIA
			case 'CajeroUV': // SI ES UN USUARIO DE LA CAJA UV venta de unidades

 			$data[]=array(
 				"0"=>'<a title="Editar" href="#" onclick="mostrar('.$reg->idCaja.')"><i class="fa fa-edit"></i></a>',
				"1"=>$enum,
				"2"=>$reg->nombre,
 				"3"=>$reg->agencia,
				"4"=>$reg->cliente,
                "5"=>$reg->cajero,
                "6"=>number_format($reg->ncpCorrienteSaldo, 0, '', ','),
                "7"=>number_format($reg->ncpComisionesSaldo, 0, '', ','),
                "8"=>$reg->ncpCorriente,
				"9"=>$reg->ncpComisiones,
                "10"=>number_format($reg->montoMaxEnvio, 0, '', ','),
				"11"=>($reg->cajacerrada=='NO')?'<span class="label bg-green">No</span>':
                '<span class="label bg-red">Si</span>',
				"12"=>$reg->usCreador,
 				"13"=>$reg->fecrea
 				);
			$enum++;
			break;

			default:
		
			$data[]=array(
				"0"=>'<a title="Cerrar" class="label bg-red" href="#" onclick="eliminar('.$reg->idCaja.')"><i class="fa fa-remove" ></i></a>'.
					' <a title="Editar" href="#" onclick="mostrar('.$reg->idCaja.')"><i class="fa fa-edit"></i></a>',
			   "1"=>$enum,
			   "2"=>$reg->nombre,
			   "3"=>$reg->agencia,
			   "4"=>$reg->cliente,
			   "5"=>$reg->cajero,
			   "6"=>number_format($reg->ncpCorrienteSaldo, 0, '', ','),
			   "7"=>number_format($reg->ncpComisionesSaldo, 0, '', ','),
			   "8"=>$reg->ncpCorriente,
			   "9"=>$reg->ncpComisiones,
			   "10"=>number_format($reg->montoMaxEnvio, 0, '', ','),
			   "11"=>($reg->cajacerrada=='NO')?'<span class="label bg-green">No</span>':
			   '<span class="label bg-red">Si</span>',
			   "12"=>$reg->usCreador,
			   "13"=>$reg->fecrea
				);
		   $enum++;


		}

 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	/// Popular agecia del cliente automaticamente
	case 'ponerAgenciaCliente':
		$rspta=$caja->ponerAgenciaCliente($cliente);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

    
    case 'ponerNCPclienteRemitente':
		$rspta=$caja->buscarNCPcliente($clienteremitente, $tipo);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

    case 'ponerNCPclienteBeneficiario':
		$rspta=$caja->buscarNCPcliente($clientebeneficiario, $tipo);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	// funcion para mandar y refrescar SALDO EN EL HEADER ponerNCPySaldo
    case 'ponerNCPySaldo':
		$rspta=$caja->ponerNCPySaldo($_SESSION['ap']);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;	

	// Poner las cuentas del cajero automaticamente en la caja a asignarle
    case 'ponerNCPCajero':
		$rspta=$caja->ponerNCPCajero($cajero);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;


    // OPERAR EN CAJA
    case 'debitarCreditarCaja':
        // Verificar saldo Remitente
       $respuestaRemi=$caja-> verificarSaldo($clienteremitente,$ncpremitente);
       $regRemi = $respuestaRemi->fetch_object();
       $saldoRemi=$regRemi->saldo;
       // Operar saldos
       $saldoRemitenteRestante=($saldoRemi - $monto);

        // Regular saldo Beneficiario
        $respuestaBenef=$caja-> verificarSaldo($clientebeneficiario,$ncpbeneficiaria);
        $regBenef = $respuestaBenef->fetch_object();
        $saldoBenef=$regBenef->saldo;

       $saldoBeneficiarioResultante=($saldoBenef + $monto);


       if ($monto < $saldoRemi) {
   
            if ($tipo==3 ){  // PONER DINERO EN LA CAJA QUE PARTE DE LA AGENCIA O MASTER

                $rspta=$caja->insertarDineroEnCaja($referencia,$clienteremitente,$clientebeneficiario,$paisorigen,$paisdestino,$agenciaremitente,$ncpremitente,
                                        $agenciabeneficiaria,$ncpbeneficiaria,$monto,$saldoRemitenteRestante,$saldoBeneficiarioResultante,$tipo,$codigo,$descripcion,$idCajaOP,$_SESSION['ap']);
                echo $rspta ? "Caja aprovisionada" : "Caja no se pudo aprovisionar";
            }
            else {
                $rspta=$caja->editar($idCaja,$cliente,$agencia,$nombre,$cajero,$ncpCorriente,$ncpComisiones,$montoMaxEnvio,$cajacerrada,$_SESSION['ap']);
                echo $rspta ? "Caja Actualizada" : "Caja no se pudo actualizar";
            }

        } else {
             echo "Saldo insuficiente para realizar esta operacion";
        }

	break;

}

?>