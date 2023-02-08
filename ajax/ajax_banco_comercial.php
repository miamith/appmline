<?php
session_start(); 
require_once "../modelos/class_BancoComercial.php";
require_once "../modelos/class_Envios_recibos.php";
$envio= new Persona();
$bancoC=new BancoComercial();


$idbancoc=isset($_POST["idbancoc"])? limpiarCadena($_POST["idbancoc"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$pais=isset($_POST["pais"])? limpiarCadena($_POST["pais"]):"";
$ciudad=isset($_POST["ciudad"])? limpiarCadena($_POST["ciudad"]):"";
$ncp=isset($_POST["ncp"])? limpiarCadena($_POST["ncp"]):"";
$responsable=isset($_POST["responsable"])? limpiarCadena($_POST["responsable"]):"";
$supervisor=isset($_POST["supervisor"])? limpiarCadena($_POST["supervisor"]):"";

// OPERACIONES EN EL BANCO COMERCIAL CAMPOS DEL MODAL
$idBancoComercialOP =isset($_POST["idBancoComercialOP"])? limpiarCadena($_POST["idBancoComercialOP"]):"";
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
		if (empty($idbancoc)){
			$rspta=$bancoC->insertar($nombre,$pais,$ciudad,$ncp,$responsable,$supervisor,$_SESSION['ap']);
			echo $rspta ? "Banco comercial registrado" : "Banco comercial no se pudo registrar";
		}
		else {
			$rspta=$bancoC->editar($idbancoc,$nombre,$pais,$ciudad,$ncp,$responsable,$supervisor,$_SESSION['ap']);
			echo $rspta ? "Banco comercial actualizado" : "Banco comercial no se pudo actualizar";
		}
	break;

	case 'eliminar':
		$rspta=$bancoC->eliminar($idbancoc,$_SESSION['ap']);
 		echo $rspta ? "Banco comercial eliminado" : "Banco comercial no se puede eliminar";
	break;

	case 'mostrar':
		$rspta=$bancoC->mostrar($idbancoc);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$bancoC->listar($_SESSION['pais'],$_SESSION['agencia_em'],$_SESSION['rol'],$_SESSION['ap']);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			
			// CONTROL DEL ROL DEL USUARIO
		switch ($_SESSION['rol']){

			case 'Administrador': // SI ES UN USUARIO MASTER O AGENCIA FRANQUICIA
			case 'Agencia': // SI ES UN USUARIO MASTER O AGENCIA FRANQUICIA
			case 'CajeroUV': // SI ES UN USUARIO DE LA CAJA UV venta de unidades

			$data[]=array(

 				"0"=>'<a title="Editar" href="#" onclick="mostrar('.$reg->idbancoc.')"><i class="fa fa-edit"></i></>',
 				"1"=>$reg->nombre,
			   	"2"=>$reg->pais_nombre,
				"3"=>$reg->ciudad,
			   	"4"=>$reg->ncp,
			   	"5"=>number_format($reg->ncpCorrienteSaldo, 0, '', ','),
			   	"6"=>$reg->responsable_nombre,
			   	"7"=>$reg->gerente,
				"8"=>$reg->agentcrea,
				"9"=>$reg->fecrea
 				);
			break;
			
			default:
			$data[]=array(

				"0"=>'<a title="Eliminar" class="label bg-red" href="#" onclick="eliminar('.$reg->idbancoc.')"><i class="fa fa-remove" ></i></a>'.
					' <a title="Editar" href="#" onclick="mostrar('.$reg->idbancoc.')"><i class="fa fa-edit"></i></a>',
				"1"=>$reg->nombre,
			   	"2"=>$reg->pais_nombre,
				"3"=>$reg->ciudad,
			   	"4"=>$reg->ncp,
			   	"5"=>number_format($reg->ncpCorrienteSaldo, 0, '', ','),
			   	"6"=>$reg->responsable_nombre,
			   	"7"=>$reg->gerente,
				"8"=>$reg->agentcrea,
				"9"=>$reg->fecrea
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
		


		case "generarNCPBancoComercial": // CUENTA ADMINISTRADOR COMERCIAL
			require_once "../modelos/class_Usuario.php";
			$const = new Usuario();
			$rspta=$const->generarNCPBancoComercial($responsable);
			//Codificar el resultado utilizando json
			echo json_encode($rspta);

			break;
	
	 
			case 'ponerNCPclienteRemitente':
				$rspta=$bancoC->buscarNCPcliente($clienteremitente, $tipo);
				 //Codificar el resultado utilizando json
				 echo json_encode($rspta);
			break;
		
			case 'ponerNCPclienteBeneficiario':
				$rspta=$bancoC->buscarNCPcliente($clientebeneficiario, $tipo);
				 //Codificar el resultado utilizando json
				 echo json_encode($rspta);
			break;
		
			// funcion para mandar y refrescar SALDO EN EL HEADER ponerNCPySaldo
			case 'ponerNCPySaldo':
				$rspta=$bancoC->ponerNCPySaldo($_SESSION['ap']);
				 //Codificar el resultado utilizando json
				 echo json_encode($rspta);
			break;	

			
    // OPERAR ENBANCO COMERCIAL
    case 'debitarCreditarBancoComercial':
        // Verificar saldo Remitente
       $respuestaRemi=$bancoC-> verificarSaldo($clienteremitente,$ncpremitente);
       $regRemi = $respuestaRemi->fetch_object();
       $saldoRemi=$regRemi->saldo;
       // Operar saldos
       $saldoRemitenteRestante=($saldoRemi - $monto);

        // Regular saldo Beneficiario
        $respuestaBenef=$bancoC-> verificarSaldo($clientebeneficiario,$ncpbeneficiaria);
        $regBenef = $respuestaBenef->fetch_object();
        $saldoBenef=$regBenef->saldo;

       $saldoBeneficiarioResultante=($saldoBenef + $monto);


       if ($monto < $saldoRemi) {
   
            if ($tipo=='008' ){  // PONER DINERO AL BANCO COMERCIAL

                $rspta=$bancoC->insertarDineroEnBancoComercial($referencia,$clienteremitente,$clientebeneficiario,$paisorigen,$paisdestino,$agenciaremitente,$ncpremitente,
                                        $agenciabeneficiaria,$ncpbeneficiaria,$monto,$saldoRemitenteRestante,$saldoBeneficiarioResultante,$tipo,$codigo,$descripcion,$idBancoComercialOP,$_SESSION['ap']);
                echo $rspta ? "Comercial aprovisionado" : "Comercial no se pudo aprovisionar";
				//echo $rspta ? '<script> window.open("../reportes/exTicketVentaUVphp?id='.$codigo.'","_blank"); </script>' : 'Algo salio mal !!';


            }
			elseif ($tipo=='009' ) { // RESTITUIR DINERO DADO DEL BANCO COMERCIAL
				$rspta=$bancoC->restituirDineroDeUnBancoComercial($referencia,$clienteremitente,$clientebeneficiario,$paisorigen,$paisdestino,$agenciaremitente,$ncpremitente,
				$agenciabeneficiaria,$ncpbeneficiaria,$monto,$saldoRemitenteRestante,$saldoBeneficiarioResultante,$tipo,$codigo,$descripcion,$idBancoComercialOP,$_SESSION['ap']);
				echo $rspta ? "Restitucion efectuada del comercial" : "Restitucion no se pudo efectuar al comercial";

               
            }

        } else {
             echo "Saldo insuficiente para realizar esta operacion señor Supervisor";
        }

	break;
}
?>