<?php 
session_start();
require_once "../modelos/class_Empleado.php";

$consulta=new Empleado();

$idempleado=isset($_POST["idempleado"])? limpiarCadena($_POST["idempleado"]):"";
$ap=isset($_POST["ap"])? limpiarCadena($_POST["ap"]):"";
$cargo=isset($_POST["cargo"])? limpiarCadena($_POST["cargo"]):"";
$rol=isset($_POST["rol"])? limpiarCadena($_POST["rol"]):"";
$salario=isset($_POST["salario"])? limpiarCadena($_POST["salario"]):"";
$nomcompleto=isset($_POST["nomcompleto"])? limpiarCadena($_POST["nomcompleto"]):"";
$tel=isset($_POST["tel"])? limpiarCadena($_POST["tel"]):"";
$pais=isset($_POST["pais"])? limpiarCadena($_POST["pais"]):"";
$ciudad=isset($_POST["ciudad"])? limpiarCadena($_POST["ciudad"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$interno=isset($_POST["interno"])? limpiarCadena($_POST["interno"]):"";
$DNIremitente=isset($_POST["DNIremitente"])? limpiarCadena($_POST["DNIremitente"]):"";
$feinicioempleo=isset($_POST["feinicioempleo"])? limpiarCadena($_POST["feinicioempleo"]):"";
$agenciaA=isset($_POST["agenciaA"])? limpiarCadena($_POST["agenciaA"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idempleado)){
			$rspta=$consulta->insertar($ap,$DNIremitente,$cargo,$rol,$salario,$agenciaA,$pais,$ciudad,$interno,$_SESSION['ap'],$feinicioempleo,$nomcompleto,$tel,$direccion);
			echo $rspta ? "Empleado registrado" : "Empleado no se pudo registrar";
		}
		else {
			$rspta=$consulta->editar($idempleado,$ap,$DNIremitente,$cargo,$rol,$salario,$agenciaA,$pais,$ciudad,$interno,
			$_SESSION['ap'],$feinicioempleo,$nomcompleto,$tel,$direccion);
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
				"5"=>$reg->rol,
 				"6"=>$reg->salario,
 				"7"=>$reg->ap,
				"8"=>$reg->pais_nombre,
 				"9"=>$reg->ciudad,
				"10"=>$reg->direccion,
				"11"=>$reg->interno,
				"12"=>$reg->agenciaA,
 				"13"=>$reg->agecrea,
 				"14"=>$reg->fecrea,
 				"15"=>$reg->feinicioempleo

 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;


		// Buscar  si el DIP existe ya en uso
		case 'validarDIP':
		  $rspta=$consulta->validarDIP($DNIremitente);
		   //Codificar el resultado utilizando json
		  echo json_encode($rspta);
	  break;


	  	// Buscar  si el AP existe ya en uso
		case 'validarAP':
			$rspta=$consulta->validarAP($ap);
			 //Codificar el resultado utilizando json
			echo json_encode($rspta);
		break;
}
?>