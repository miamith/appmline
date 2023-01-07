<?php 
require_once "../modelos/class_Perfil.php";

$perfil=new Perfil();


$ap=isset($_POST["ap"])? limpiarCadena($_POST["ap"]):"";
$nuevaPass=isset($_POST["nuevaPass"])? limpiarCadena($_POST["nuevaPass"]):"";
$idEmpleado=isset($_POST["idEmpleado"])? limpiarCadena($_POST["idEmpleado"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
	$clavehash=hash("SHA256",$nuevaPass);
		if (!empty($idEmpleado)){
			$rspta=$perfil->insertar($idEmpleado,$clavehash);
			echo $rspta ? "Contraseña usuario actualizada" : "Contraseña usuario no se pudo actualizar";
		}
	break;

	case 'mostrar':
		$rspta=$perfil->mostrar($idEmpleado);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
				$rspta=$perfil->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>' <a title="Editar" href="#" onclick="mostrar('.$reg->idEmpleado.')"><i class="fa fa-edit"></i></a>',
 				"1"=>$reg->nomcompleto,
 				"2"=>$reg->ap,
 				"3"=>$reg->agecrea
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