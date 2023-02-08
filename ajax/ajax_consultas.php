<?php 
session_start(); 
require_once "../modelos/class_Consultas.php";

$envio=new Consulta();




switch ($_GET["op"]){

	case 'consultaEnvioFechaCliente':

	$fecha_inicio=$_REQUEST["fecha_inicio"];
    $fecha_final=$_REQUEST["fecha_final"];
    $DNIremitente=$_REQUEST["DNIremitente"];

	if (empty($DNIremitente)){
		$rspta=$envio->consultasEnviosFechas($fecha_inicio,$fecha_final,$_SESSION['pais'],$_SESSION['agencia_em'],$_SESSION['rol'],$_SESSION['ap']);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->nomcompleto,
 				"1"=>$reg->tel,
 				"2"=>number_format($reg->monto, 0, '', ','),
 				"3"=>number_format($reg->comision, 0, '', ','),
 				"4"=>$reg->codigo,
 				"5"=>$reg->agenciaA,
 				"6"=>$reg->nomcompler,
 				"7"=>$reg->agenciaB,
 				"8"=>$reg->fecrea,
 				"9"=>($reg->estadot=='Pendiente')?'<span class="label bg-orange">'.$reg->estadot.'</span>':
 				'<span class="label bg-red">'.$reg->estadot.'</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

       } else {
		$rspta=$envio->consultasEnviosFechaRemitente($fecha_inicio,$fecha_final,$DNIremitente,$_SESSION['pais'],$_SESSION['agencia_em'],$_SESSION['rol'],$_SESSION['ap']);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->nomcompleto,
 				"1"=>$reg->tel,
 				"2"=>number_format($reg->monto, 0, '', ','),
 				"3"=>number_format($reg->comision, 0, '', ','),
 				"4"=>$reg->codigo,
 				"5"=>$reg->agenciaA,
 				"6"=>$reg->nomcompler,
 				"7"=>$reg->agenciaB,
 				"8"=>$reg->fecrea,
 				"9"=>($reg->estadot=='Pendiente')?'<span class="label bg-orange">'.$reg->estadot.'</span>':
 				'<span class="label bg-red">'.$reg->estadot.'</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);



		 }

	break;

		////////////////////////////////////////// RECIBOS INICIO ////////////////////////////////////////////////////////////

	case 'consultaReciboFechaCliente':

	$fecha_inicio=$_REQUEST["fecha_inicio"];
    $fecha_final=$_REQUEST["fecha_final"];
    $DNIremitente=$_REQUEST["DNIremitente"];

	if (empty($DNIremitente)){
		$rspta=$envio->consultasRecibosFechas($fecha_inicio,$fecha_final,$_SESSION['pais'],$_SESSION['agencia_em'],$_SESSION['rol'],$_SESSION['ap']);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->nomcompler,
 				"1"=>$reg->telr,
 				"2"=>number_format($reg->monto, 0, '', ','),
 				"3"=>$reg->codigo,
 				"4"=>$reg->agenciaB,
 				"5"=>$reg->nomcompleto,
 				"6"=>$reg->agenciaA,
 				"7"=>$reg->fecrea,
 				"8"=>($reg->estadot=='Pendiente')?'<span class="label bg-orange">'.$reg->estadot.'</span>':
 				'<span class="label bg-green">'.$reg->estadot.'</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
	} else {
		$rspta=$envio->consultasRecibosFechaRemitente($fecha_inicio,$fecha_final,$DNIremitente,$_SESSION['pais'],$_SESSION['agencia_em'],$_SESSION['rol'],$_SESSION['ap']);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->nomcompler,
 				"1"=>$reg->telr,
 				"2"=>number_format($reg->monto, 0, '', ','),
 				"3"=>$reg->codigo,
 				"4"=>$reg->agenciaB,
 				"5"=>$reg->nomcompleto,
 				"6"=>$reg->agenciaA,
 				"7"=>$reg->fecrea,
 				"8"=>($reg->estadot=='Recibido')?'<span class="label bg-green">'.$reg->estadot.'</span>':
 				'<span class="label bg-orange">'.$reg->estadot.'</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);


	}

	break;


	///////////////////////////////////////// OPERACIONES /////////////////////////////////////////////
	case 'consultaOperacionesFechaTipoAgenciaAP':

		$fecha_inicio=$_REQUEST["fecha_inicio"];
		$fecha_final=$_REQUEST["fecha_final"];
		$codigo_ope=$_REQUEST["codigo_ope"];
		$agencia=$_REQUEST["agencia"];
		$ap=$_REQUEST["ap"];

		if (empty($codigo_ope) && empty($agencia) && empty($ap) ){
			$rspta=$envio->consultaOperacionesSimple($fecha_inicio,$fecha_final,$_SESSION['pais'],$_SESSION['agencia_em'],$_SESSION['rol'],$_SESSION['ap']);
			 //Vamos a declarar un array
			 $data= Array();
	
			 while ($reg=$rspta->fetch_object()){
				 $data[]=array(
					 "0"=>$reg->nomcompletoRemitente,
					 "1"=>$reg->cuenta_remi,
					 "2"=>number_format($reg->monto, 0, '', ','),
					 "3"=>$reg->codigo,
					 "4"=>$reg->codigo_ope,
					 "5"=>$reg->codigo_ope_DESC,
					 "6"=>($reg->sentido=='D')?'<span class="label bg-orange">Debito</span>':
					 '<span class="label bg-green">Credito</span>',
					 "7"=>$reg->descripcion,
					 "8"=>$reg->agenciaA,
					 "9"=>$reg->agenciaB,
					 "10"=>$reg->nomcompletoBeneficiario,
					 "11"=>$reg->cuenta_recep,
					 "12"=>$reg->agentcreat,
					 "13"=>$reg->fecrea,
					 "14"=>($reg->estadot=='Pendiente')?'<span class="label bg-orange">'.$reg->estadot.'</span>':
					 '<span class="label bg-green">'.$reg->estadot.'</span>'
					 );
			 }
			 $results = array(
				 "sEcho"=>1, //Información para el datatables
				 "iTotalRecords"=>count($data), //enviamos el total registros al datatable
				 "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
				 "aaData"=>$data);
			 echo json_encode($results);
		} elseif(!empty($codigo_ope) && empty($agencia) && empty($ap) ) {
			$rspta=$envio->consultaOperacionesCODIGO_OPE($fecha_inicio,$fecha_final,$codigo_ope,$_SESSION['pais'],$_SESSION['agencia_em'],$_SESSION['rol'],$_SESSION['ap']);
			 //Vamos a declarar un array
			 $data= Array();
	
			 while ($reg=$rspta->fetch_object()){
				 $data[]=array(
					 "0"=>$reg->nomcompletoRemitente,
					 "1"=>$reg->cuenta_remi,
					 "2"=>number_format($reg->monto, 0, '', ','),
					 "3"=>$reg->codigo,
					 "4"=>$reg->codigo_ope,
					 "5"=>$reg->codigo_ope_DESC,
					 "6"=>($reg->sentido=='D')?'<span class="label bg-orange">Debito</span>':
					 '<span class="label bg-green">Credito</span>',
					 "7"=>$reg->descripcion,
					 "8"=>$reg->agenciaA,
					 "9"=>$reg->agenciaB,
					 "10"=>$reg->nomcompletoBeneficiario,
					 "11"=>$reg->cuenta_recep,
					 "12"=>$reg->agentcreat,
					 "13"=>$reg->fecrea,
					 "14"=>($reg->estadot=='Pendiente')?'<span class="label bg-orange">'.$reg->estadot.'</span>':
					 '<span class="label bg-green">'.$reg->estadot.'</span>'
					 );
			 }
			 $results = array(
				 "sEcho"=>1, //Información para el datatables
				 "iTotalRecords"=>count($data), //enviamos el total registros al datatable
				 "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
				 "aaData"=>$data);
			 echo json_encode($results);
	
	
		} elseif(empty($codigo_ope) && !empty($agencia) && empty($ap) ) {
			$rspta=$envio->consultaOperacionesAGENCIA($fecha_inicio,$fecha_final,$agencia,$_SESSION['pais'],$_SESSION['agencia_em'],$_SESSION['rol'],$_SESSION['ap']);
			 //Vamos a declarar un array
			 $data= Array();
	
			 while ($reg=$rspta->fetch_object()){
				 $data[]=array(
					 "0"=>$reg->nomcompletoRemitente,
					 "1"=>$reg->cuenta_remi,
					 "2"=>number_format($reg->monto, 0, '', ','),
					 "3"=>$reg->codigo,
					 "4"=>$reg->codigo_ope,
					 "5"=>$reg->codigo_ope_DESC,
					 "6"=>($reg->sentido=='D')?'<span class="label bg-orange">Debito</span>':
					 '<span class="label bg-green">Credito</span>',
					 "7"=>$reg->descripcion,
					 "8"=>$reg->agenciaA,
					 "9"=>$reg->agenciaB,
					 "10"=>$reg->nomcompletoBeneficiario,
					 "11"=>$reg->cuenta_recep,
					 "12"=>$reg->agentcreat,
					 "13"=>$reg->fecrea,
					 "14"=>($reg->estadot=='Pendiente')?'<span class="label bg-orange">'.$reg->estadot.'</span>':
					 '<span class="label bg-green">'.$reg->estadot.'</span>'
					 );
			 }
			 $results = array(
				 "sEcho"=>1, //Información para el datatables
				 "iTotalRecords"=>count($data), //enviamos el total registros al datatable
				 "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
				 "aaData"=>$data);
			 echo json_encode($results);
	
	
			} elseif(empty($codigo_ope) && empty($agencia) && !empty($ap) ) {
				$rspta=$envio->consultaOperacionesAP($fecha_inicio,$fecha_final,$ap,$_SESSION['pais'],$_SESSION['agencia_em'],$_SESSION['rol'],$_SESSION['ap']);
				 //Vamos a declarar un array
				 $data= Array();
		
				 while ($reg=$rspta->fetch_object()){
					 $data[]=array(
						 "0"=>$reg->nomcompletoRemitente,
						 "1"=>$reg->cuenta_remi,
						 "2"=>number_format($reg->monto, 0, '', ','),
						 "3"=>$reg->codigo,
						 "4"=>$reg->codigo_ope,
						 "5"=>$reg->codigo_ope_DESC,
						 "6"=>($reg->sentido=='D')?'<span class="label bg-orange">Debito</span>':
						 '<span class="label bg-green">Credito</span>',
						 "7"=>$reg->descripcion,
						 "8"=>$reg->agenciaA,
						 "9"=>$reg->agenciaB,
						 "10"=>$reg->nomcompletoBeneficiario,
						 "11"=>$reg->cuenta_recep,
						 "12"=>$reg->agentcreat,
						 "13"=>$reg->fecrea,
						 "14"=>($reg->estadot=='Pendiente')?'<span class="label bg-orange">'.$reg->estadot.'</span>':
						 '<span class="label bg-green">'.$reg->estadot.'</span>'
						 );
				 }
				 $results = array(
					 "sEcho"=>1, //Información para el datatables
					 "iTotalRecords"=>count($data), //enviamos el total registros al datatable
					 "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
					 "aaData"=>$data);
				 echo json_encode($results);
		
		
				} elseif(!empty($codigo_ope) && !empty($agencia) && !empty($ap) ) {
					$rspta=$envio->consultaOperacionesFULL($fecha_inicio,$fecha_final,$codigo_ope,$agencia,$ap,$_SESSION['pais'],$_SESSION['agencia_em'],$_SESSION['rol'],$_SESSION['ap']);
					 //Vamos a declarar un array
					 $data= Array();
			
					 while ($reg=$rspta->fetch_object()){
						 $data[]=array(
							 "0"=>$reg->nomcompletoRemitente,
							 "1"=>$reg->cuenta_remi,
							 "2"=>number_format($reg->monto, 0, '', ','),
							 "3"=>$reg->codigo,
							 "4"=>$reg->codigo_ope,
							 "5"=>$reg->codigo_ope_DESC,
							 "6"=>($reg->sentido=='D')?'<span class="label bg-orange">Debito</span>':
							 '<span class="label bg-green">Credito</span>',
							 "7"=>$reg->descripcion,
							 "8"=>$reg->agenciaA,
							 "9"=>$reg->agenciaB,
							 "10"=>$reg->nomcompletoBeneficiario,
							 "11"=>$reg->cuenta_recep,
							 "12"=>$reg->agentcreat,
							 "13"=>$reg->fecrea,
							 "14"=>($reg->estadot=='Pendiente')?'<span class="label bg-orange">'.$reg->estadot.'</span>':
							 '<span class="label bg-green">'.$reg->estadot.'</span>'
							 );
					 }
					 $results = array(
						 "sEcho"=>1, //Información para el datatables
						 "iTotalRecords"=>count($data), //enviamos el total registros al datatable
						 "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
						 "aaData"=>$data);
					 echo json_encode($results);
			
			
					} elseif(empty($codigo_ope) && !empty($agencia) && !empty($ap) ) {
						$rspta=$envio->consultaOperacionesMENOS_OPE($fecha_inicio,$fecha_final,$agencia,$ap,$_SESSION['pais'],$_SESSION['agencia_em'],$_SESSION['rol'],$_SESSION['ap']);
						 //Vamos a declarar un array
						 $data= Array();
				
						 while ($reg=$rspta->fetch_object()){
							 $data[]=array(
								 "0"=>$reg->nomcompletoRemitente,
								 "1"=>$reg->cuenta_remi,
								 "2"=>number_format($reg->monto, 0, '', ','),
								 "3"=>$reg->codigo,
								 "4"=>$reg->codigo_ope,
								 "5"=>$reg->codigo_ope_DESC,
								 "6"=>($reg->sentido=='D')?'<span class="label bg-orange">Debito</span>':
								 '<span class="label bg-green">Credito</span>',
								 "7"=>$reg->descripcion,
								 "8"=>$reg->agenciaA,
								 "9"=>$reg->agenciaB,
								 "10"=>$reg->nomcompletoBeneficiario,
								 "11"=>$reg->cuenta_recep,
								 "12"=>$reg->agentcreat,
								 "13"=>$reg->fecrea,
								 "14"=>($reg->estadot=='Pendiente')?'<span class="label bg-orange">'.$reg->estadot.'</span>':
								 '<span class="label bg-green">'.$reg->estadot.'</span>'
								 );
						 }
						 $results = array(
							 "sEcho"=>1, //Información para el datatables
							 "iTotalRecords"=>count($data), //enviamos el total registros al datatable
							 "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
							 "aaData"=>$data);
						 echo json_encode($results);
				
				
						} elseif(!empty($codigo_ope) && !empty($agencia) && empty($ap) ) {
							$rspta=$envio->consultaOperacionesMENOS_AP($fecha_inicio,$fecha_final,$codigo_ope,$agencia,$_SESSION['pais'],$_SESSION['agencia_em'],$_SESSION['rol'],$_SESSION['ap']);
							 //Vamos a declarar un array
							 $data= Array();
					
							 while ($reg=$rspta->fetch_object()){
								 $data[]=array(
									 "0"=>$reg->nomcompletoRemitente,
									 "1"=>$reg->cuenta_remi,
									 "2"=>number_format($reg->monto, 0, '', ','),
									 "3"=>$reg->codigo,
									 "4"=>$reg->codigo_ope,
									 "5"=>$reg->codigo_ope_DESC,
									 "6"=>($reg->sentido=='D')?'<span class="label bg-orange">Debito</span>':
									 '<span class="label bg-green">Credito</span>',
									 "7"=>$reg->descripcion,
									 "8"=>$reg->agenciaA,
									 "9"=>$reg->agenciaB,
									 "10"=>$reg->nomcompletoBeneficiario,
									 "11"=>$reg->cuenta_recep,
									 "12"=>$reg->agentcreat,
									 "13"=>$reg->fecrea,
									 "14"=>($reg->estadot=='Pendiente')?'<span class="label bg-orange">'.$reg->estadot.'</span>':
									 '<span class="label bg-green">'.$reg->estadot.'</span>'
									 );
							 }
							 $results = array(
								 "sEcho"=>1, //Información para el datatables
								 "iTotalRecords"=>count($data), //enviamos el total registros al datatable
								 "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
								 "aaData"=>$data);
							 echo json_encode($results);
					
					
							} elseif(!empty($codigo_ope) && empty($agencia) && !empty($ap) ) {
								$rspta=$envio->consultaOperacionesMENOS_AGENCIA($fecha_inicio,$fecha_final,$codigo_ope,$ap,$_SESSION['pais'],$_SESSION['agencia_em'],$_SESSION['rol'],$_SESSION['ap']);
								 //Vamos a declarar un array
								 $data= Array();
						
								 while ($reg=$rspta->fetch_object()){
									 $data[]=array(
										 "0"=>$reg->nomcompletoRemitente,
										 "1"=>$reg->cuenta_remi,
										 "2"=>number_format($reg->monto, 0, '', ','),
										 "3"=>$reg->codigo,
										 "4"=>$reg->codigo_ope,
										 "5"=>$reg->codigo_ope_DESC,
										 "6"=>($reg->sentido=='D')?'<span class="label bg-orange">Debito</span>':
										 '<span class="label bg-green">Credito</span>',
										 "7"=>$reg->descripcion,
										 "8"=>$reg->agenciaA,
										 "9"=>$reg->agenciaB,
										 "10"=>$reg->nomcompletoBeneficiario,
										 "11"=>$reg->cuenta_recep,
										 "12"=>$reg->agentcreat,
										 "13"=>$reg->fecrea,
										 "14"=>($reg->estadot=='Pendiente')?'<span class="label bg-orange">'.$reg->estadot.'</span>':
										 '<span class="label bg-green">'.$reg->estadot.'</span>'
										 );
								 }
								 $results = array(
									 "sEcho"=>1, //Información para el datatables
									 "iTotalRecords"=>count($data), //enviamos el total registros al datatable
									 "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
									 "aaData"=>$data);
								 echo json_encode($results);
						
						
								}
	
		break;
	






	case "selectRemitente":
		require_once "../modelos/class_Consultas.php";
		$cons = new Consulta();

		$rspta = $cons->selectRemitente();
        echo '<option value="">Todos</option>';
		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->DNIremitente . '>' .$reg->nomcompleto. '</option>';
				}
		break;

}

?>