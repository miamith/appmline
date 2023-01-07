<?php 
session_start();
require_once "../modelos/class_Contabilidad.php";

$consulta=new Contabilidad();

$iding_gas=isset($_POST["iding_gas"])? limpiarCadena($_POST["iding_gas"]):"";
$concepto=isset($_POST["concepto"])? limpiarCadena($_POST["concepto"]):"";
$monto=isset($_POST["monto"])? limpiarCadena($_POST["monto"]):"";
$sentido=isset($_POST["sentido"])? limpiarCadena($_POST["sentido"]):"";
$fecrea=isset($_POST["fecrea"])? limpiarCadena($_POST["fecrea"]):"";
$observacion=isset($_POST["observacion"])? limpiarCadena($_POST["observacion"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($iding_gas)){
			$rspta=$consulta->insertar($concepto,$monto,$sentido,$observacion,$fecrea,$_SESSION['agencia_em'],$_SESSION['ap']);
			echo $rspta ? "Asiento contable registrado" : "Asiento contable no se pudo registrar";
		}
		else {
			$rspta=$consulta->editar($iding_gas,$concepto,$monto,$sentido,$observacion,$fecrea);
			echo $rspta ? "Asiento contable actualizado" : "Asiento contable no se pudo actualizar";
		}
	break;

	case 'eliminar':
		$rspta=$consulta->eliminar($iding_gas);
 		echo $rspta ? "Asiento contable eliminado " : "Asiento contable no se puede eliminar";
	break;

	case 'mostrar':
		$rspta=$consulta->mostrar($iding_gas);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$consulta->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<a title="Eliminar" class="label bg-red" href="#" onclick="eliminar('.$reg->iding_gas.')"><i class="fa fa-remove" ></i></a>'.
 					' <a title="Editar" href="#" onclick="mostrar('.$reg->iding_gas.')"><i class="fa fa-edit"></i></a>',
 				"1"=>$reg->concepto,
 				"2"=>$reg->ingreso,
 				"3"=>$reg->gasto,
 				"4"=>$reg->observacion,
 				"5"=>$reg->agecrea,
 				"6"=>$reg->agentcrea,
 				"7"=>$reg->fecrea
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