<?php
session_start(); 
require_once "../modelos/class_Cuenta.php";
$cuenta=new Cuenta();


$modif=isset($_POST["modif"])? limpiarCadena($_POST["modif"]):"";
$numerocuenta =isset($_POST["numerocuenta"])? limpiarCadena($_POST["numerocuenta"]):"";
$cliente=isset($_POST["cliente"])? limpiarCadena($_POST["cliente"]):"";
$saldo=isset($_POST["saldo"])? limpiarCadena($_POST["saldo"]):"";
$tipo_cuenta=isset($_POST["tipo_cuenta"])? limpiarCadena($_POST["tipo_cuenta"]):"";
$agencialigada=isset($_POST["agencialigada"])? limpiarCadena($_POST["agencialigada"]):"";
$gestor=isset($_POST["gestor"])? limpiarCadena($_POST["gestor"]):"";
$cuenta_cerrada=isset($_POST["cuenta_cerrada"])? limpiarCadena($_POST["cuenta_cerrada"]):"";


$clienteremitente=isset($_POST["clienteremitente"])? limpiarCadena($_POST["clienteremitente"]):"";
$clientebeneficiario=isset($_POST["clientebeneficiario"])? limpiarCadena($_POST["clientebeneficiario"]):"";



switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($modif)){

			$rspta=$cuenta->insertar($numerocuenta,$cliente,$saldo,$tipo_cuenta,$agencialigada,$gestor,$cuenta_cerrada,$_SESSION['ap']);
			echo $rspta ? "Cuenta creada" : "Cuenta no se pudo registrar";
		}
		else {
			$rspta=$cuenta->editar($numerocuenta,$cliente,$saldo,$tipo_cuenta,$agencialigada,$gestor,$cuenta_cerrada,$_SESSION['ap']);
			echo $rspta ? "Cuenta Actualizada" : "Cuenta no se pudo actualizar";
		}
	break;

	case 'eliminar':
		$rspta=$cuenta->eliminar($numerocuenta);
 		echo $rspta ? "Cuenta cerrada" : "Cuenta no se puede cerrar";
	break;

	case 'mostrar':
		$rspta=$cuenta->mostrar($numerocuenta);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$cuenta->listar($_SESSION['pais'],$_SESSION['agencia_em'],$_SESSION['rol'],$_SESSION['ap']);
 		//Vamos a declarar un array
 		$data= Array();
        $enum=1;
 		while ($reg=$rspta->fetch_object()){

						// CONTROL DEL ROL DEL USUARIO
		switch ($_SESSION['rol']){

			case 'Agencia': // SI ES UN USUARIO MASTER O AGENCIA FRANQUICIA
			case 'CajeroUV': // SI ES UN USUARIO DE LA CAJA UV venta de unidades
			
 			$data[]=array(
 				"0"=>'<a title="Editar" href="#" onclick="mostrar('.$reg->numerocuenta.')"><i class="fa fa-edit"></i></a>',
				"1"=>$enum,
				"2"=>$reg->nomcompleto,
 				"3"=>$reg->numerocuenta,
				"4"=>$reg->tipo_cuenta,
                "5"=>number_format($reg->saldo, 0, '', ','),
				"6"=>$reg->nomagencialigada,
 				"7"=>$reg->nomgestor,
				"8"=>$reg->nombre_pais,
                "9"=>$reg->tel,
				"10"=>($reg->cuenta_cerrada=='NO')?'<span class="label bg-green">No</span>':
                '<span class="label bg-red">Si</span>',
				"11"=>$reg->femovimiento,
				"12"=>$reg->usCreador,
 				"13"=>$reg->fecreacion
 				);
			$enum++;
			break;

			default: // Sea Admin, Super Admin, Supervisor
			$data[]=array(
				"0"=>'<a title="Cerrar" class="label bg-red" href="#" onclick="eliminar('.$reg->numerocuenta.')"><i class="fa fa-remove" ></i></a>'.
					' <a title="Editar" href="#" onclick="mostrar('.$reg->numerocuenta.')"><i class="fa fa-edit"></i></a>',
			   "1"=>$enum,
			   "2"=>$reg->nomcompleto,
				"3"=>$reg->numerocuenta,
			   "4"=>$reg->tipo_cuenta,
			   "5"=>number_format($reg->saldo, 0, '', ','),
			   "6"=>$reg->nomagencialigada,
				"7"=>$reg->nomgestor,
			   "8"=>$reg->nombre_pais,
			   "9"=>$reg->tel,
			   "10"=>($reg->cuenta_cerrada=='NO')?'<span class="label bg-green">No</span>':
			   '<span class="label bg-red">Si</span>',
			   "11"=>$reg->femovimiento,
			   "12"=>$reg->usCreador,
				"13"=>$reg->fecreacion
				);
		   $enum++;

		} // FIN SWITCH

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


		case "generarNCPcliente": // CUENTA cliente
			require_once "../modelos/class_Usuario.php";
			$const = new Usuario();
			$rspta=$const->generarNCPcliente($DNIremitente);
			//Codificar el resultado utilizando json
			echo json_encode($rspta);

			break;

    case "selectEmpleado":
        require_once "../modelos/class_Cuenta.php";
        $cons = new Cuenta();

        $rspta = $cons->selectEmpleado();
                    echo '<option value="">Ninguno</option>';
        while ($reg = $rspta->fetch_object())
                {
                    echo '<option value=' . $reg->ap . '>' . $reg->ap . '-' . $reg->nomcompleto . '</option>';
                }
        break;

		
		case "selectCuentasRemitente": // RESPONSABLE
			require_once "../modelos/class_Cuenta.php";
			$cons = new Cuenta();
	
			$rspta = $cons->selectCuentasRemitente($clienteremitente);
	
						echo '<option value="">Selecciona cuenta</option>';
			while ($reg = $rspta->fetch_object())
					{
						echo '<option value='.$reg->numerocuenta.'>' . $reg->numerocuenta . '-' . $reg->tipo_cuenta . '</option> ';
					}
			break;
		
			case "selectCuentasBeneficiaria": // RESPONSABLE
				require_once "../modelos/class_Cuenta.php";
				$cons = new Cuenta();
		
				$rspta = $cons->selectCuentasBeneficiaria($clientebeneficiario);
		
							echo '<option value="">Selecciona cuenta</option>';
				while ($reg = $rspta->fetch_object())
						{
							echo '<option value='.$reg->numerocuenta.'>' . $reg->numerocuenta . '-' . $reg->tipo_cuenta . '</option> ';
						}
				break;

			// TRAER SALDO ACTUAL DE LA CUENTA DEL CLIENTE
			case "traerSaldoActual": // CUENTA cliente
				require_once "../modelos/class_Cuenta.php";
				$const = new Cuenta();
				$rspta=$const->traerSaldoActual($numerocuenta);
				//Codificar el resultado utilizando json
				echo json_encode($rspta);
	
			break;
}

?>