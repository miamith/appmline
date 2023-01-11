<?php
session_start(); 
require_once "../modelos/class_Agencia.php";
$agencia=new Agencia();


$idagencia=isset($_POST["idagencia"])? limpiarCadena($_POST["idagencia"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$pais=isset($_POST["pais"])? limpiarCadena($_POST["pais"]):"";
$ciudad=isset($_POST["ciudad"])? limpiarCadena($_POST["ciudad"]):"";
$max_cajas=isset($_POST["max_cajas"])? limpiarCadena($_POST["max_cajas"]):"";
$ncp=isset($_POST["ncp"])? limpiarCadena($_POST["ncp"]):"";
$responsable=isset($_POST["responsable"])? limpiarCadena($_POST["responsable"]):"";



switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idagencia)){
			$rspta=$agencia->insertar($nombre,$descripcion,$pais,$ciudad,$max_cajas,$ncp,$responsable,$_SESSION['ap']);
			echo $rspta ? "Agencia registrada" : "Agencia no se pudo registrar";
		}
		else {
			$rspta=$agencia->editar($idagencia,$nombre,$descripcion,$pais,$ciudad,$max_cajas,$ncp,$responsable,$_SESSION['ap']);
			echo $rspta ? "Agencia Emisoractualizada" : "Agencia no se pudo actualizar";
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
		$rspta=$agencia->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<a title="Eliminar" class="label bg-red" href="#" onclick="eliminar('.$reg->idagencia.')"><i class="fa fa-remove" ></i></a>'.
 					' <a title="Editar" href="#" onclick="mostrar('.$reg->idagencia.')"><i class="fa fa-edit"></i></a>',
 				"1"=>$reg->nombre,
 				"2"=>$reg->descripcion,
				"3"=>$reg->pais_nombre,
 				"4"=>$reg->ciudad,
				"5"=>$reg->max_cajas,
				"6"=>$reg->ncp,
				"7"=>$reg->responsable_nombre,
 				"8"=>$reg->agentcrea,
 				"9"=>$reg->fecrea
 				);
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

		$rspta = $cons->selectEmpleado();

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
}
?>