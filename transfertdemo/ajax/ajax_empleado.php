<?php 
session_start();
require_once "../modelos/class_Empleado.php";

$consulta=new Empleado();

$idempleado=isset($_POST["idempleado"])? limpiarCadena($_POST["idempleado"]):"";
$ap=isset($_POST["ap"])? limpiarCadena($_POST["ap"]):"";
$cargo=isset($_POST["cargo"])? limpiarCadena($_POST["cargo"]):"";
$salario=isset($_POST["salario"])? limpiarCadena($_POST["salario"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$tel=isset($_POST["tel"])? limpiarCadena($_POST["tel"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$DNIremitente=isset($_POST["DNIremitente"])? limpiarCadena($_POST["DNIremitente"]):"";
$feinicioempleo=isset($_POST["feinicioempleo"])? limpiarCadena($_POST["feinicioempleo"]):"";
$agenciaA=isset($_POST["agenciaA"])? limpiarCadena($_POST["agenciaA"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idempleado)){
			$rspta=$consulta->insertar($DNIremitente,$nombre,$tel,$direccion,$_SESSION['ap'],$ap,$cargo,$salario,$feinicioempleo,$agenciaA);
			echo $rspta ? "Empleado registrado" : "Empleado no se pudo registrar";
		}
		else {
			$rspta=$consulta->editar($idempleado,$ap,$DNIremitente,$cargo,$salario,$_SESSION['ap'],$nombre,$tel,$direccion,$feinicioempleo,$agenciaA);
			echo $rspta ? "Empleado actualizado" : "Empleado no se pudo actualizar";
		}
	break;

	case 'eliminar':
		$rspta=$consulta->eliminar($idempleado);
 		echo $rspta ? "Empleado eliminado " : "Empleado no se puede eliminar";
	break;

	case 'mostrar':
		$rspta=$consulta->mostrar($idempleado);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$consulta->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<a title="Eliminar" class="label bg-red" href="#" onclick="eliminar('.$reg->idempleado.')"><i class="fa fa-remove" ></i></a>'.
 					' <a title="Editar" href="#" onclick="mostrar('.$reg->idempleado.')"><i class="fa fa-edit"></i></a>',
 				"1"=>$reg->nomcompleto,
 				"2"=>$reg->DNI,
 				"3"=>$reg->tel,
 				"4"=>$reg->cargo,
 				"5"=>$reg->salario,
 				"6"=>$reg->ap,
 				"7"=>$reg->direccion,
 				"8"=>$reg->agecrea,
 				"9"=>$reg->fecrea,
 				"10"=>$reg->feinicioempleo,
 				"11"=>$reg->femod

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