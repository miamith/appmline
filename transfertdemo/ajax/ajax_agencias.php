<?php
session_start(); 
require_once "../modelos/class_Agencia.php";
$agencia=new Agencia();


$idagencia=isset($_POST["idagencia"])? limpiarCadena($_POST["idagencia"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idagencia)){
			$rspta=$agencia->insertar($nombre,$descripcion,$_SESSION['ap']);
			echo $rspta ? "Agencia registrada" : "Agencia no se pudo registrar";
		}
		else {
			$rspta=$agencia->editar($idagencia,$nombre,$descripcion);
			echo $rspta ? "Agencia Emisoractualizada" : "Agencia no se pudo actualizar";
		}
	break;

	case 'eliminar':
		$rspta=$agencia->eliminar($idagencia);
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
 				"3"=>$reg->agentcrea,
 				"4"=>$reg->fecrea
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