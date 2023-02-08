<?php 
session_start();
require_once "../modelos/class_Pais.php";

$consulta=new Pais();

$idpais=isset($_POST["idpais"])? limpiarCadena($_POST["idpais"]):"";
$nompais=isset($_POST["nompais"])? limpiarCadena($_POST["nompais"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$limienviolocal=isset($_POST["limienviolocal"])? limpiarCadena($_POST["limienviolocal"]):"";
$limienvioint=isset($_POST["limienvioint"])? limpiarCadena($_POST["limienvioint"]):"";
$moneda=isset($_POST["moneda"])? limpiarCadena($_POST["moneda"]):"";
$iva=isset($_POST["iva"])? limpiarCadena($_POST["iva"]):"";
$porcenenvio=isset($_POST["porcenenvio"])? limpiarCadena($_POST["porcenenvio"]):"";
$porcenrecibir=isset($_POST["porcenrecibir"])? limpiarCadena($_POST["porcenrecibir"]):"";
$porcenenviopaq=isset($_POST["porcenenviopaq"])? limpiarCadena($_POST["porcenenviopaq"]):"";
$porcenrecibirpaq=isset($_POST["porcenrecibirpaq"])? limpiarCadena($_POST["porcenrecibirpaq"]):"";
$partnerapi=isset($_POST["partnerapi"])? limpiarCadena($_POST["partnerapi"]):"";
$prefijoTel=isset($_POST["prefijoTel"])? limpiarCadena($_POST["prefijoTel"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idpais)){
			$rspta=$consulta->insertar($nompais,$descripcion,$limienviolocal,$limienvioint,$moneda,$iva,$porcenenvio,$porcenrecibir,$porcenenviopaq,$porcenrecibirpaq,$partnerapi,$prefijoTel,$_SESSION['ap']);
			echo $rspta ? "Pais registrado" : "Pais no se pudo registrar";
		}
		else {
			$rspta=$consulta->editar($idpais,$nompais,$descripcion,$limienviolocal,$limienvioint,$moneda,$iva,$porcenenvio,$porcenrecibir,$porcenenviopaq,$porcenrecibirpaq,$partnerapi,$prefijoTel,$_SESSION['ap']);
			echo $rspta ? "Pais actualizado" : "Pais no se pudo actualizar";
		}
	break;

	case 'eliminar':
		$rspta=$consulta->eliminar($idpais,$_SESSION['ap']);
 		echo $rspta ? "Pais eliminado " : "Pais no se puede eliminar";
	break;

	case 'mostrar':
		$rspta=$consulta->mostrar($idpais);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$consulta->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<a title="Eliminar" class="label bg-red" href="#" onclick="eliminar('.$reg->idPais.')"><i class="fa fa-remove" ></i></a>'.
 					' <a title="Editar" href="#" onclick="mostrar('.$reg->idPais.')"><i class="fa fa-edit"></i></a>',
 				"1"=>$reg->nombre,
 				"2"=>$reg->descripcion,
 				"3"=>$reg->limite_envioLOCAL,
 				"4"=>$reg->limite_envioINT,
 				"5"=>$reg->moneda,
 				"6"=>$reg->IVA,
 				"7"=>$reg->porcenENVIO,
 				"8"=>$reg->porcenRECIBIR,
 				"9"=>$reg->porcenENVIO_PAQ,
 				"10"=>$reg->porcenRECI_PAQ,
 				"11"=>$reg->partnerAPI,
 				"12"=>$reg->uscreador,
                "13"=>$reg->fecrea,
				"14"=>$reg->prefijoTel
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