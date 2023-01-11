<?php 
session_start();
require_once "../modelos/class_Tasa.php";

$tasa=new Tasa();


$idTasas=isset($_POST["idTasas"])? limpiarCadena($_POST["idTasas"]):"";
$pais_origen=isset($_POST["pais_origen"])? limpiarCadena($_POST["pais_origen"]):"";
$pais_destino=isset($_POST["pais_destino"])? limpiarCadena($_POST["pais_destino"]):"";
$Descripcion=isset($_POST["Descripcion"])? limpiarCadena($_POST["Descripcion"]):"";
$Monto1=isset($_POST["Monto1"])? limpiarCadena($_POST["Monto1"]):"";
$Monto2=isset($_POST["Monto2"])? limpiarCadena($_POST["Monto2"]):"";
$comisiont=isset($_POST["comisiont"])? limpiarCadena($_POST["comisiont"]):"";
$MontoKILO=isset($_POST["MontoKILO"])? limpiarCadena($_POST["MontoKILO"]):"";
$MontoSOBRE=isset($_POST["MontoSOBRE"])? limpiarCadena($_POST["MontoSOBRE"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idTasas)){
			$rspta=$tasa->insertar($pais_origen,$pais_destino,$Descripcion,$Monto1,$Monto2,$MontoKILO,$MontoSOBRE,$comisiont,$_SESSION['ap']);
			echo $rspta ? "Tasa registrada" : "Tasa no se pudo registrar";
		}
		else {
			$rspta=$tasa->editar($idTasas,$pais_origen,$pais_destino,$Descripcion,$Monto1,$Monto2,$MontoKILO,$MontoSOBRE,$comisiont,$_SESSION['ap']);
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
				"1"=>$reg->pais_origenNOM,
				"2"=>$reg->pais_destinoNOM,
				"3"=>$reg->Descripcion,
 				"4"=>number_format($reg->Monto1, 0, '', ','),
 				"5"=>number_format($reg->Monto2, 0, '', ','),
				"6"=>number_format($reg->MontoKILO, 0, '', ','),
				"7"=>number_format($reg->MontoSOBRE, 0, '', ','),
 				"8"=>number_format($reg->comisiont, 0, '', ','),
 				"9"=>$reg->fecreat,
 				"10"=>$reg->agencrea
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

}
?>