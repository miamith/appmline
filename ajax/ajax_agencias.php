<?php
session_start(); 
require_once "../modelos/class_Agencia.php";
require_once "../modelos/class_Envios_recibos.php";
$envio= new Persona();
$agencia=new Agencia();


$idagencia=isset($_POST["idagencia"])? limpiarCadena($_POST["idagencia"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$pais=isset($_POST["pais"])? limpiarCadena($_POST["pais"]):"";
$ciudad=isset($_POST["ciudad"])? limpiarCadena($_POST["ciudad"]):"";
$max_cajas=isset($_POST["max_cajas"])? limpiarCadena($_POST["max_cajas"]):"";
$ncp=isset($_POST["ncp"])? limpiarCadena($_POST["ncp"]):"";
$ncpComisiones=isset($_POST["ncpComisiones"])? limpiarCadena($_POST["ncpComisiones"]):"";
$responsable=isset($_POST["responsable"])? limpiarCadena($_POST["responsable"]):"";
$responsableMline=isset($_POST["responsableMline"])? limpiarCadena($_POST["responsableMline"]):"";

// OPERACIONES EN LA CAJA CAMPOS DEL MODAL
$idAgenciaOP =isset($_POST["idAgenciaOP"])? limpiarCadena($_POST["idAgenciaOP"]):"";
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
$referencia=$envio->generarCodigo(12); 
$codigo=$envio->generarCodigo(8); 



switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idagencia)){
			$rspta=$agencia->insertar($nombre,$descripcion,$pais,$ciudad,$max_cajas,$ncp,$ncpComisiones,$responsable,$responsableMline,$_SESSION['ap']);
			echo $rspta ? "Agencia registrada" : "Agencia no se pudo registrar";
		}
		else {
			$rspta=$agencia->editar($idagencia,$nombre,$descripcion,$pais,$ciudad,$max_cajas,$ncp,$ncpComisiones,$responsable,$responsableMline,$_SESSION['ap']);
			echo $rspta ? "Agencia actualizada" : "Agencia no se pudo actualizar";
		}
	break;

	case 'eliminar':
		$rspta=$agencia->eliminar($idagencia,$_SESSION['ap']);
 		echo $rspta ? "Agencia eliminada" : "Agencia no se puede eliminar";
	break;

	case 'mostrar':
		$rspta=$agencia->mostrar($idagencia);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$agencia->listar($_SESSION['pais'],$_SESSION['agencia_em'],$_SESSION['rol'],$_SESSION['ap']);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			
			// CONTROL DEL ROL DEL USUARIO
		switch ($_SESSION['rol']){

			case 'Administrador': // SI ES UN USUARIO MASTER O AGENCIA FRANQUICIA
			case 'Agencia': // SI ES UN USUARIO MASTER O AGENCIA FRANQUICIA
			case 'CajeroUV': // SI ES UN USUARIO DE LA CAJA UV venta de unidades

			$data[]=array(

 				"0"=>'<a title="Editar" href="#" onclick="mostrar('.$reg->idagencia.')"><i class="fa fa-edit"></i></>',
 				"1"=>$reg->nombre,
 				"2"=>$reg->descripcion,
				"3"=>$reg->pais_nombre,
 				"4"=>$reg->ciudad,
				"5"=>$reg->max_cajas,
				"6"=>$reg->ncp,
				"7"=>number_format($reg->ncpCorrienteSaldo, 0, '', ','),
				"8"=>$reg->ncpComisiones,
                "9"=>number_format($reg->ncpComisionesSaldo, 0, '', ','),
				"10"=>$reg->responsable_nombre,
				"11"=>$reg->responsable_Mline,
 				"12"=>$reg->agentcrea,
 				"13"=>$reg->fecrea
 				);
			break;
			
			default:
			$data[]=array(

				"0"=>'<a title="Eliminar" class="label bg-red" href="#" onclick="eliminar('.$reg->idagencia.')"><i class="fa fa-remove" ></i></a>'.
					' <a title="Editar" href="#" onclick="mostrar('.$reg->idagencia.')"><i class="fa fa-edit"></i></a>',
				"1"=>$reg->nombre,
				"2"=>$reg->descripcion,
			   	"3"=>$reg->pais_nombre,
				"4"=>$reg->ciudad,
			   	"5"=>$reg->max_cajas,
			   	"6"=>$reg->ncp,
			   	"7"=>number_format($reg->ncpCorrienteSaldo, 0, '', ','),
			   	"8"=>$reg->ncpComisiones,
			   	"9"=>number_format($reg->ncpComisionesSaldo, 0, '', ','),
			   	"10"=>$reg->responsable_nombre,
			   	"11"=>$reg->responsable_Mline,
				"12"=>$reg->agentcrea,
				"13"=>$reg->fecrea
				);

			} // FIN switch
		
			}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case "selectPaises":
		require_once "../modelos/class_Tasa.php";
		$paises = new Tasa();

		$rspta = $paises->selectPaises();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idPais . '>' . $reg->nombre . ' ' . $reg->moneda. '</option>';
				}
	break;

	case "selectEmpleado": // RESPONSABLE
		require_once "../modelos/class_Usuario.php";
		$cons = new Usuario();

		$rspta = $cons->selectEmpleado($_SESSION['pais'],$_SESSION['agencia_em'],$_SESSION['rol'],$_SESSION['ap']);

					echo '<option value="">Ninguno</option>';
		while ($reg = $rspta->fetch_object())
				{
					echo '<option value='.$reg->ap.'>' . $reg->ap . '-' . $reg->nomcompleto . '</option>';
				}
		break;
		


		case "generarNCPagencia": // CUENTA AGENCIA
			require_once "../modelos/class_Usuario.php";
			$const = new Usuario();
			$rspta=$const->generarNCPagencia($responsable);
			//Codificar el resultado utilizando json
			echo json_encode($rspta);

			break;
	
	 
			case 'ponerNCPclienteRemitente':
				$rspta=$agencia->buscarNCPcliente($clienteremitente, $tipo);
				 //Codificar el resultado utilizando json
				 echo json_encode($rspta);
			break;
		
			case 'ponerNCPclienteBeneficiario':
				$rspta=$agencia->buscarNCPcliente($clientebeneficiario, $tipo);
				 //Codificar el resultado utilizando json
				 echo json_encode($rspta);
			break;
		
			// funcion para mandar y refrescar SALDO EN EL HEADER ponerNCPySaldo
			case 'ponerNCPySaldo':
				$rspta=$agencia->ponerNCPySaldo($_SESSION['ap']);
				 //Codificar el resultado utilizando json
				 echo json_encode($rspta);
			break;	

			
    // OPERAR EN AGENCIA
    case 'debitarCreditarAgencia':
        // Verificar saldo Remitente
       $respuestaRemi=$agencia-> verificarSaldo($clienteremitente,$ncpremitente);
       $regRemi = $respuestaRemi->fetch_object();
       $saldoRemi=$regRemi->saldo;
       // Operar saldos
       $saldoRemitenteRestante=($saldoRemi - $monto);

        // Regular saldo Beneficiario
        $respuestaBenef=$agencia-> verificarSaldo($clientebeneficiario,$ncpbeneficiaria);
        $regBenef = $respuestaBenef->fetch_object();
        $saldoBenef=$regBenef->saldo;

       $saldoBeneficiarioResultante=($saldoBenef + $monto);


       if ($monto < $saldoRemi) {
   
            if ($tipo==3 ){  // PONER DINERO EN LA AGENCIA QUE ES MASTER

                $rspta=$agencia->insertarDineroEnAgencia($referencia,$clienteremitente,$clientebeneficiario,$paisorigen,$paisdestino,$agenciaremitente,$ncpremitente,
                                        $agenciabeneficiaria,$ncpbeneficiaria,$monto,$saldoRemitenteRestante,$saldoBeneficiarioResultante,$tipo,$codigo,$descripcion,$idAgenciaOP,$_SESSION['ap']);
                echo $rspta ? "Agencia aprovisionada" : "Agencia no se pudo aprovisionar";
				echo $rspta ? '<script> window.open("../reportes/exTicketVentaUVphp?id='.$codigo.'","_blank"); </script>' : 'Algo salio mal !!';


            }
			elseif ($tipo==5 ) { // RESTITUIR DINERO DADO A UNA AGENCIA O DEVOLUCIONES
				$rspta=$agencia->restituirDineroDeUnaAgencia($referencia,$clienteremitente,$clientebeneficiario,$paisorigen,$paisdestino,$agenciaremitente,$ncpremitente,
				$agenciabeneficiaria,$ncpbeneficiaria,$monto,$saldoRemitenteRestante,$saldoBeneficiarioResultante,$tipo,$codigo,$descripcion,$idAgenciaOP,$_SESSION['ap']);
				echo $rspta ? "Restitucion efectuada a la agencia" : "Restitucion no se pudo efectuar a la agencia";

               
            }
            elseif ($tipo==6 ) { // PAGAR A UNA AGENCIA COMISIONES TRABAJADAS
				$rspta=$agencia->pagarComisionesDeUnaAgencia($referencia,$clienteremitente,$clientebeneficiario,$paisorigen,$paisdestino,$agenciaremitente,$ncpremitente,
				$agenciabeneficiaria,$ncpbeneficiaria,$monto,$saldoRemitenteRestante,$saldoBeneficiarioResultante,$tipo,$codigo,$descripcion,$idAgenciaOP,$_SESSION['ap']);
				echo $rspta ? "Comisiones pagadas a la agencia" : "Comisiones no se pudo pagar a la agencia";

               
            }

        } else {
             echo "Saldo insuficiente para realizar esta operacion";
        }

	break;
}
?>