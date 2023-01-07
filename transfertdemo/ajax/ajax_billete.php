<?php 
session_start();
require_once "../modelos/class_Billete.php";

$consulta=new Billete();

$idbillete=isset($_POST["idbillete"])? limpiarCadena($_POST["idbillete"]):"";
$company=isset($_POST["company"])? limpiarCadena($_POST["company"]):"";
$ruta=isset($_POST["ruta"])? limpiarCadena($_POST["ruta"]):"";
$fechaemision=isset($_POST["fechaemision"])? limpiarCadena($_POST["fechaemision"]):"";
$fesali=isset($_POST["fesali"])? limpiarCadena($_POST["fesali"]):"";
$fevuel=isset($_POST["fevuel"])? limpiarCadena($_POST["fevuel"]):"";
$numvuel=isset($_POST["numvuel"])? limpiarCadena($_POST["numvuel"]):"";
$nompasa=isset($_POST["nompasa"])? limpiarCadena($_POST["nompasa"]):"";
$DNIremitente=isset($_POST["DNIremitente"])? limpiarCadena($_POST["DNIremitente"]):"";
$localiz=isset($_POST["localiz"])? limpiarCadena($_POST["localiz"]):"";
$precio=isset($_POST["precio"])? limpiarCadena($_POST["precio"]):"";
$agencia=isset($_POST["agencia"])? limpiarCadena($_POST["agencia"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idbillete)){
			$rspta=$consulta->insertar($company,$ruta,$fechaemision,$fesali,$fevuel,$numvuel,$nompasa,$_SESSION['ap'],$DNIremitente,$localiz,$precio,$descripcion,$agencia);
			echo $rspta ? "Billete registrado" : "Billete no se pudo registrar";
		}
		else {
			$rspta=$consulta->editar($idbillete,$company,$ruta,$fechaemision,$fesali,$fevuel,$numvuel,$nompasa,$DNIremitente,$localiz,$precio,$descripcion,$agencia);
			echo $rspta ? "Billete actualizado" : "Billete no se pudo actualizar";
		}
	break;

	case 'eliminar':
		$rspta=$consulta->eliminar($idbillete);
 		echo $rspta ? "Billete eliminado " : "Billete no se puede eliminar";
	break;

	case 'mostrar':
		$rspta=$consulta->mostrar($idbillete);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$consulta->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<a title="Eliminar" class="label bg-red" href="#" onclick="eliminar('.$reg->idbillete.')"><i class="fa fa-remove" ></i></a>'.
 					' <a title="Editar" href="#" onclick="mostrar('.$reg->idbillete.')"><i class="fa fa-edit"></i></a>',
 				"1"=>$reg->nomcompleto,
 				"2"=>$reg->company,
 				"3"=>$reg->ruta,
 				"4"=>$reg->numvuel,
 				"5"=>$reg->fesali,
 				"6"=>$reg->fevuel,
 				"7"=>$reg->localiz,
 				"8"=>$reg->precio,
 				"9"=>$reg->descripcion,
 				"10"=>$reg->agencia,
 				"11"=>$reg->agentcrea,
 				"12"=>$reg->fechaemision
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
		require_once "../modelos/class_Billete.php";
		$agencia = new Billete();

		$rspta = $agencia->selectAgencias();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idagencia . '>' . $reg->nombre . '</option>';
				}
	break;

	case "selectRuta":
		require_once "../modelos/class_Billete.php";
		$ruta = new Billete();

		$rspta = $ruta->selectRutas();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idruta . '>' . $reg->nombreR . '</option>';
				}
	break;

}
?>