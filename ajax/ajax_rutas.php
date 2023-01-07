<?php 
require_once "../modelos/class_Ruta.php";

$ruta=new Ruta();


$idruta=isset($_POST["idruta"])? limpiarCadena($_POST["idruta"]):"";
$nombreR=isset($_POST["nombreR"])? limpiarCadena($_POST["nombreR"]):"";
$descripcionr=isset($_POST["descripcionr"])? limpiarCadena($_POST["descripcionr"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idruta)){
			$rspta=$ruta->insertar($nombreR,$descripcionr);
			echo $rspta ? "Ruta registrada" : "Ruta no se pudo registrar";
		}
		else {
			$rspta=$ruta->editar($idruta,$nombreR,$descripcionr);
			echo $rspta ? "Ruta actualizada" : "Ruta no se pudo actualizar";
		}
	break;

	case 'eliminar':
		$rspta=$ruta->eliminar($idruta);
 		echo $rspta ? "Ruta eliminada" : "Ruta no se puede eliminar";
	break;

	case 'mostrar':
		$rspta=$ruta->mostrar($idruta);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$ruta->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<a title="Eliminar" class="label bg-red" href="#" onclick="eliminar('.$reg->idruta.')"><i class="fa fa-remove" ></i></a>'.
 					' <a title="Editar" href="#" onclick="mostrar('.$reg->idruta.')"><i class="fa fa-edit"></i></a>',
 				"1"=>$reg->nombreR,
 				"2"=>$reg->descripcionr
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