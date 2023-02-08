<?php
session_start(); 
require_once "../modelos/class_Banco.php";
require_once "../modelos/class_Envios_recibos.php";
$envio= new Persona();
$banco=new Banco();


$idbanco=isset($_POST["idbanco"])? limpiarCadena($_POST["idbanco"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$pais=isset($_POST["pais"])? limpiarCadena($_POST["pais"]):"";
$max_agencias=isset($_POST["max_agencias"])? limpiarCadena($_POST["max_agencias"]):"";
$ncp=isset($_POST["ncp"])? limpiarCadena($_POST["ncp"]):"";
$ncpComisiones=isset($_POST["ncpComisiones"])? limpiarCadena($_POST["ncpComisiones"]):"";
$ncpIVA=isset($_POST["ncpIVA"])? limpiarCadena($_POST["ncpIVA"]):"";
$responsable=isset($_POST["responsable"])? limpiarCadena($_POST["responsable"]):"";


// OPERACIONES EN EL BANCO CAMPOS DEL MODAL
$idbancoOP =isset($_POST["idbancoOP"])? limpiarCadena($_POST["idbancoOP"]):"";
$ncpCREDITAR =isset($_POST["ncpCREDITAR"])? limpiarCadena($_POST["ncpCREDITAR"]):"";
$nombreBeneficiario =isset($_POST["nombreBeneficiario"])? limpiarCadena($_POST["nombreBeneficiario"]):"";
$saldoCapital =isset($_POST["saldoCapital"])? limpiarCadena($_POST["saldoCapital"]):"";
$bancoOP =isset($_POST["bancoOP"])? limpiarCadena($_POST["bancoOP"]):"";
$monto =isset($_POST["monto"])? limpiarCadena($_POST["monto"]):"";
$tipo =isset($_POST["tipo"])? limpiarCadena($_POST["tipo"]):"";
$descripcion =isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$referencia=$envio->generarCodigo(12); 
$codigo=$envio->generarCodigo(8); 



switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idbanco)){
			$rspta=$banco->insertar($nombre,$descripcion,$pais,$max_agencias,$ncp,$ncpComisiones,$ncpIVA,$responsable,$_SESSION['ap']);
			echo $rspta ? "Banco registrado" : "Banco no se pudo registrar";
		}
		else {
			$rspta=$banco->editar($idbanco,$nombre,$descripcion,$pais,$max_agencias,$ncp,$ncpComisiones,$ncpIVA,$responsable,$_SESSION['ap']);
			echo $rspta ? "Banco actualizado" : "Banco no se pudo actualizar";
		}
	break;


	case 'eliminar':
		$rspta=$banco->eliminar($idbanco,$_SESSION['ap']);
 		echo $rspta ? "Banco eliminado" : "Banco no se puede eliminar";
	break;

	case 'mostrar':
		$rspta=$banco->mostrar($idbanco);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$banco->listar($_SESSION['pais'],$_SESSION['agencia_em'],$_SESSION['rol'],$_SESSION['ap']);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			
			// CONTROL DEL ROL DEL USUARIO
		switch ($_SESSION['rol']){

			case 'Administrador': // SI ES UN USUARIO MASTER O banco FRANQUICIA
			case 'Agencia': // SI ES UN USUARIO MASTER O banco FRANQUICIA
			case 'CajeroUV': // SI ES UN USUARIO DE LA CAJA UV venta de unidades

			$data[]=array(


 				"0"=>'<a title="Editar" href="#" onclick="mostrar('.$reg->idbanco.')"><i class="fa fa-edit"></i></>',
 				"1"=>$reg->nombre,
 				"2"=>$reg->descripcion,
				"3"=>$reg->pais_nombre,
				"4"=>$reg->ncp,
				"5"=>number_format($reg->ncpCapitalSaldo, 0, '', ','),
				"6"=>$reg->ncpComisiones,
                "7"=>number_format($reg->ncpComisionesSaldo, 0, '', ','),
                "8"=>$reg->ncpIVA,
                "9"=>number_format($reg->ncpIVASaldo, 0, '', ','),
				"10"=>$reg->responsable_nombre,
 				"11"=>$reg->agentcrea,
 				"12"=>$reg->fecrea
 				);
			break;
			
			default:
			$data[]=array(

				"0"=>'<a title="Eliminar" class="label bg-red" href="#" onclick="eliminar('.$reg->idbanco.')"><i class="fa fa-remove" ></i></a>'.
					' <a title="Editar" href="#" onclick="mostrar('.$reg->idbanco.')"><i class="fa fa-edit"></i></a>',
                    "1"=>$reg->nombre,
                    "2"=>$reg->descripcion,
                   "3"=>$reg->pais_nombre,
                   "4"=>$reg->ncp,
                   "5"=>number_format($reg->ncpCapitalSaldo, 0, '', ','),
                   "6"=>$reg->ncpComisiones,
                   "7"=>number_format($reg->ncpComisionesSaldo, 0, '', ','),
                   "8"=>$reg->ncpIVA,
                   "9"=>number_format($reg->ncpIVASaldo, 0, '', ','),
                   "10"=>$reg->responsable_nombre,
                    "11"=>$reg->agentcrea,
                    "12"=>$reg->fecrea
				);

			} // FIN switch
		
			}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	
	 	case "generarNCPCreaBanco": // CUENTA banco
			require_once "../modelos/class_Banco.php";
			$const = new Banco();
			$rspta=$const->generarNCPCreaBanco($responsable);
			//Codificar el resultado utilizando json
			echo json_encode($rspta);

			break;
    
    // TRAER SALDO ACTUAL DE LA CUENTA CAPITAL
    case "traerSaldoActual": // CUENTA cliente
        require_once "../modelos/class_Banco.php";
        $const = new Banco();
        $rspta=$const->traerSaldoActual($numerocuenta);
        //Codificar el resultado utilizando json
        var_dump($rspta);
        //echo json_encode($rspta);

    break;
		

			
    // OPERAR EN banco
    case 'CrearSaldoUV':
        // Verificar saldo Remitente CUENTA DEL CAPITAL DEK SUPERVISOR
       // Operar saldos
       $saldoBancoFinal=($saldoCapital + $monto);
   
            if ($tipo==000 ){  // CREAR DINERO O UV EN LA CUENTA CAPITAL

                $rspta=$banco->insertarDineroEnbanco($referencia,$nombreBeneficiario,$ncpCREDITAR,$monto,$saldoBancoFinal,$tipo,$codigo,$descripcion,$idbancoOP,$_SESSION['pais'],$_SESSION['ap'],$_SESSION['agencia_em']);
                echo $rspta ? "Banco aprovisionado" : "banco no se pudo aprovisionar";
				//echo $rspta ? '<script> window.open("../reportes/exTicketVentaUVphp?id='.$codigo.'","_blank"); </script>' : 'Algo salio mal !!';


            }
			
	break;
}
?>