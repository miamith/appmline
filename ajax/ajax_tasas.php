<?php 
session_start();
require_once "../modelos/class_Tasa.php";

$tasa=new Tasa();


$idTasas=isset($_POST["idTasas"])? limpiarCadena($_POST["idTasas"]):"";
$Descripcion=isset($_POST["Descripcion"])? limpiarCadena($_POST["Descripcion"]):"";
$Monto1=isset($_POST["Monto1"])? limpiarCadena($_POST["Monto1"]):"";
$Monto2=isset($_POST["Monto2"])? limpiarCadena($_POST["Monto2"]):"";
$comisiont=isset($_POST["comisiont"])? limpiarCadena($_POST["comisiont"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idTasas)){
			$rspta=$tasa->insertar($Descripcion,$Monto1,$Monto2,$comisiont,$_SESSION['ap']);
			echo $rspta ? "Tasa registrada" : "Tasa no se pudo registrar";
		}
		else {
			$rspta=$tasa->editar($idTasas,$Descripcion,$Monto1,$Monto2,$comisiont);
			echo $rspta ? "Tasa actualizada" : "Tasa no se pudo actualizar";
		}
	break;

	case 'eliminar':
		$rspta=$tasa->eliminar($idTasas);
 		echo $rspta ? "Tasa eliminada" : "Tasa no se puede eliminar";
	break;

	case 'mostrar':
		$rspta=$tasa->mostrar($idTasas);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$tasa->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<a title="Eliminar" class="label bg-red" href="#" onclick="eliminar('.$reg->idTasas.')"><i class="fa fa-remove" ></i></a>'.
 					' <a title="Editar" href="#" onclick="mostrar('.$reg->idTasas.')"><i class="fa fa-edit"></i></a>',
 				"1"=>$reg->Descripcion,
 				"2"=>number_format($reg->Monto1, 0, '', '.'),
 				"3"=>number_format($reg->Monto2, 0, '', '.'),
 				"4"=>number_format($reg->comisiont, 0, '', '.'),
 				"5"=>$reg->fecreat,
 				"6"=>$reg->agencrea
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
}
?>