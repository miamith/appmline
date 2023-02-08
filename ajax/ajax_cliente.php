<?php
session_start(); 
require_once "../modelos/class_Cliente.php";
$cliente=new Cliente();


$modif=isset($_POST["modif"])? limpiarCadena($_POST["modif"]):"";
$DNIremitente=isset($_POST["DNIremitente"])? limpiarCadena($_POST["DNIremitente"]):"";
$nomcompleto=isset($_POST["nomcompleto"])? limpiarCadena($_POST["nomcompleto"]):"";
$tel=isset($_POST["tel"])? limpiarCadena($_POST["tel"]):"";
$pais=isset($_POST["pais"])? limpiarCadena($_POST["pais"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$agencia_cli=isset($_POST["agencia_cli"])? limpiarCadena($_POST["agencia_cli"]):"";
$estado=isset($_POST["estado"])? limpiarCadena($_POST["estado"]):"";
$ncp=isset($_POST["ncp"])? limpiarCadena($_POST["ncp"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($modif)){

			$rspta=$cliente->insertar($DNIremitente,$nomcompleto,$tel,$pais,$direccion,$agencia_cli,$estado,$ncp,
			$_SESSION['ap']);
			echo $rspta ? "Cliente registrado" : "Cliente no se pudo registrar";
		}
		else {
			$rspta=$cliente->editar($DNIremitente,$nomcompleto,$tel,$pais,$direccion,$agencia_cli,$estado,$ncp,
			$_SESSION['ap']);
			echo $rspta ? "Cliente Actualizado" : "Cliente no se pudo actualizar";
		}
	break;

	case 'eliminar':
		$rspta=$cliente->eliminar($DNIremitente,$_SESSION['ap']);
 		echo $rspta ? "Cliente eliminado" : "Cliente no se puede eliminar";
	break;

	case 'mostrar':
		$rspta=$cliente->mostrar($DNIremitente);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$cliente->listar();
 		//Vamos a declarar un array
 		$data= Array();
        $enum=1;
 		while ($reg=$rspta->fetch_object()){
			
 			$data[]=array(
 				"0"=>'<a title="Eliminar" class="label bg-red" href="#" onclick="eliminar('.$reg->DNIremitente.')"><i class="fa fa-remove" ></i></a>'.
 					' <a title="Editar" href="#" onclick="mostrar('.$reg->DNIremitente.')"><i class="fa fa-edit"></i></a>',
				"1"=>$enum,
				"2"=>$reg->nomcompleto,
 				"3"=>$reg->DNIremitente,
				"4"=>$reg->ncp,
				"5"=>number_format($reg->saldo, 0, '', ','),
				"6"=>$reg->tel,
 				"7"=>$reg->pais_nombre,
				"8"=>$reg->agencia,
				"9"=>$reg->direccion,
				"10"=>($reg->estado=='1')?'<span class="label bg-green">Activo</span>':
 				'<span class="label bg-danger">Supendido</span>',
				"11"=>$reg->agencrea,
 				"12"=>$reg->fecrea
 				);
			$enum++;
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


		case "selectClientes": // Clientes
			require_once "../modelos/class_Cliente.php";
			$const = new Cliente();
			$rspta=$const->selectClientes($_SESSION['pais'],$_SESSION['agencia_em'],$_SESSION['rol'],$_SESSION['ap']);
			
			while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->DNIremitente . '>' . $reg->nomcompleto . '</option>';
				}

			break;
}

?>