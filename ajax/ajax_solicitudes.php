<?php 
session_start();
require_once "../modelos/class_Solicitud.php";

$consulta=new Solicitud();

$idtransaccionh=isset($_POST["idtransaccionh"])? limpiarCadena($_POST["idtransaccionh"]):"";
$idbkhiss=isset($_POST["idbkhiss"])? limpiarCadena($_POST["idbkhiss"]):"";
$idbkhish=isset($_POST["idbkhish"])? limpiarCadena($_POST["idbkhish"]):"";

$DNIremitenteh=isset($_POST["DNIremitenteh"])? limpiarCadena($_POST["DNIremitenteh"]):"";
$nomcompletoch=isset($_POST["nomcompletoch"])? limpiarCadena($_POST["nomcompletoch"]):"";
$telch=isset($_POST["telch"])? limpiarCadena($_POST["telch"]):"";
$direccionch=isset($_POST["direccionch"])? limpiarCadena($_POST["direccionch"]):"";
$idreceptorh=isset($_POST["idreceptorh"])? limpiarCadena($_POST["idreceptorh"]):"";
$DNIreceptorh=isset($_POST["DNIreceptorh"])? limpiarCadena($_POST["DNIreceptorh"]):"";
$nomcomplerh=isset($_POST["nomcomplerh"])? limpiarCadena($_POST["nomcomplerh"]):"";
$telrh=isset($_POST["telrh"])? limpiarCadena($_POST["telrh"]):"";
$direccionrh=isset($_POST["direccionrh"])? limpiarCadena($_POST["direccionrh"]):"";
$ageenviah=isset($_POST["ageenviah"])? limpiarCadena($_POST["ageenviah"]):"";
$agerecibeh=isset($_POST["agerecibeh"])? limpiarCadena($_POST["agerecibeh"]):"";
$tipoh=isset($_POST["tipoh"])? limpiarCadena($_POST["tipoh"]):"";
$montoh=isset($_POST["montoh"])? limpiarCadena($_POST["montoh"]):"";
$comisionh=isset($_POST["comisionh"])? limpiarCadena($_POST["comisionh"]):"";
$estadoth=isset($_POST["estadoth"])? limpiarCadena($_POST["estadoth"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$agentcreh=isset($_POST["agentcreh"])? limpiarCadena($_POST["agentcreh"]):"";
$fecrea=isset($_POST["fecrea"])? limpiarCadena($_POST["fecrea"]):"";
$fechavalidacion=isset($_POST["fechavalidacion"])? limpiarCadena($_POST["fechavalidacion"]):"";



switch ($_GET["op"]){

	case 'editar':
      if (isset($idtransaccionh)) {
      		$rspta=$consulta->editar($idtransaccionh,$idbkhish,$idbkhiss,$_SESSION['ap']);
			echo $rspta ? "Solicitud validada" : "Solicitud no se pudo validar";
      }
	break;

	case 'eliminar':
		$rspta=$consulta->eliminar($idbkhish);
 		echo $rspta ? "Solicitud eliminada " : "Solicitud no se puede eliminar";
	break;

	case 'mostrarbkhisOri':
		$rspta=$consulta->mostrarbkhisOri($idtransaccionh);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'mostrarbkhisCam':
		$rspta=$consulta->mostrarbkhisCam($idtransaccionh);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;


	case 'listar':
		$rspta=$consulta->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<a title="Eliminar" class="label bg-red" href="#" onclick="eliminar('.$reg->idbkhis.')"><i class="fa fa-remove" ></i></a>'.
 					' <a title="Editar" href="#" onclick="mostrarbkhis('.$reg->idtransaccionh.')"><i class="fa fa-edit"></i></a>',
 				"1"=>$reg->codigoh,
 				"2"=>$reg->nomcompletoch,
 				"3"=>$reg->nomcomplerh,
 				"4"=>number_format($reg->montoh, 0, '', ','),
 				"5"=>'<div class="direct-chat-text" style="margin:0;">'.$reg->descripcion.'</div>',
 				"6"=>$reg->operacion,
 				"7"=>$reg->agentcreh,
 				"8"=>$reg->fecrea,
 				"9"=>$reg->fechavalidacion,
 				"10"=>($reg->estadoth=='Revalidar')?'<span class="label bg-orange">'.$reg->estadoth.'</span>':
 				'<span class="label bg-green">'.$reg->estadoth.'</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'cancelar':
		$rspt=$consulta->cancelar($idtransaccionh,$idbkhish,$idbkhiss,$_SESSION['ap']);
 		echo $rspt ? "Envio y solicitud cancelado " : "Envio y solicitud no se pudo cancelar";

	break;

	case 'restaurar':
		$rspt=$consulta->restaurar($DNIremitenteh,$nomcompletoch,$telch,$direccionch,$idreceptorh,$DNIreceptorh,$nomcomplerh,$telrh,$direccionrh,$ageenviah,$agerecibeh,$tipoh,$montoh,$comisionh,$estadoth,$descripcion,$agentcreh,$fecrea,$fechavalidacion,$idtransaccionh);
 		echo $rspt ? "Restauracion exitosa " : "No se pudo restaurar";

	break;

}
?>