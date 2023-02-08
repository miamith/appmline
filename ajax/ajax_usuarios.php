<?php 
session_start();
require_once "../modelos/class_Usuario.php";

$consulta=new Usuario();


$ap=isset($_POST["ap"])? limpiarCadena($_POST["ap"]):"";
$password=isset($_POST["password"])? limpiarCadena($_POST["password"]):"";
$condicion=isset($_POST["condicion"])? limpiarCadena($_POST["condicion"]):"";
$apU=isset($_POST["apU"])? limpiarCadena($_POST["apU"]):"";
$idempleado=isset($_POST["idempleado"])? limpiarCadena($_POST["idempleado"]):"";



switch ($_GET["op"]){
	case 'guardaryeditar':
	//Hash SHA256 en la contraseña
		$clavehash=hash("SHA256",$password);

		if (empty($apU)){
			$rspta=$consulta->insertar($ap,$clavehash,$condicion,$_POST["permiso"]);
			//echo $rspta ? "Usuario registrado" : "No se pudieron registrar todos los datos del usuario";
		}
		else {
			$rspta=$consulta->editar($idempleado,$clavehash,$condicion,$_POST["permiso"]);
			echo $rspta ? "Usuario actualizado" : "Usuario no se pudo actualizar";
		}
	break;

	case 'eliminar':
		$rspta=$consulta->eliminar($idempleado);
 		echo $rspta ? "Usuario eliminado" : "Usuario no se puede eliminar";
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
 				"2"=>$reg->ap,
				"3"=>$reg->rol,
 				"4"=>($reg->permisos==0)?'<span class="label bg-red">Vea permisos</span>':'<span class="label bg-green">'.$reg->permisos.'</span>',
 				"5"=>($reg->condicion==1)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>',
 				"6"=>$reg->fecrea,
 				"7"=>$reg->agecrea
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

		case "selectEmpleado":
		require_once "../modelos/class_Usuario.php";
		$cons = new Usuario();

		$rspta = $cons->selectEmpleado($_SESSION['pais'],$_SESSION['agencia_em'],$_SESSION['rol'],$_SESSION['ap']);
					echo '<option value="">Selecciona empleado</option>';
		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idempleado . '>' . $reg->ap . '-' . $reg->nomcompleto . '</option>';
				}
		break;


		case "selectEmpleadoAP":
			require_once "../modelos/class_Usuario.php";
			$cons = new Usuario();
	
			$rspta = $cons->selectEmpleadoAP($_SESSION['pais'],$_SESSION['agencia_em'],$_SESSION['rol'],$_SESSION['ap']);
						echo '<option value="">Selecciona empleado</option>';
			while ($reg = $rspta->fetch_object())
					{
						echo '<option value=' . $reg->ap . '>' . $reg->ap . '-' . $reg->nomcompleto . '</option>';
					}
			break;
	
		case 'permisos':
		//Obtenemos todos los permisos de la tabla permisos
		require_once "../modelos/Permiso.php";
		$permiso = new Permiso();
		$rspta = $permiso->listar();

		//Obtener los permisos asignados al usuario
		$id=$_GET['id'];
		$marcados = $consulta->listarmarcados($id);
		//Declaramos el array para almacenar todos los permisos marcados
		$valores=array();

		//Almacenar los permisos asignados al usuario en el array
		while ($per = $marcados->fetch_object())
			{
				array_push($valores, $per->id_permiso);
			}

		//Mostramos la lista de permisos en la vista y si están o no marcados
		while ($reg = $rspta->fetch_object())
				{
					$sw=in_array($reg->idpermiso,$valores)?'checked':'';
					echo '<li> <input type="checkbox" '.$sw.'  name="permiso[]" value="'.$reg->idpermiso.'"> '.$reg->nombre.'</li>';
				}
	break;

		case 'verificar':

		$ap=$_POST['ap'];
	    $password=$_POST['password'];

	    //Hash SHA256 en la contraseña
		$clavehash=hash('SHA256',$password);

		$rspta=$consulta->verificar($ap, $clavehash);

		$fetch=$rspta->fetch_object();

		if (isset($fetch))
	    {
	        //Declaramos las variables de sesión
	        $_SESSION['idempleado']=$fetch->idempleado;
			$_SESSION['DNI']=$fetch->DNI;
	        $_SESSION['nomcompleto']=$fetch->nomcompleto;
	        $_SESSION['ap']=$fetch->ap;
	        $_SESSION['tel']=$fetch->tel;
	        $_SESSION['cargo']=$fetch->cargo;
	        $_SESSION['direccion']=$fetch->direccion;
	        $_SESSION['agencia_em']=$fetch->agencia_em;
			$_SESSION['pais']=$fetch->pais;
			$_SESSION['rol']=$fetch->rol; 
			$_SESSION['interno']=$fetch->interno;
			$_SESSION['ncpCorriente']=$fetch->ncpCorriente;
			$_SESSION['ncpComisiones']=$fetch->ncpComisiones;
			$_SESSION['caja']=$fetch->caja;
			$_SESSION['prefijoTel']=$fetch->prefijoTel;
	        //Obtenemos los permisos del usuario
	    	$marcados = $consulta->listarmarcados($fetch->idempleado);

	    	//Declaramos el array para almacenar todos los permisos marcados
			$valores=array();

			//Almacenamos los permisos marcados en el array
			while ($per = $marcados->fetch_object())
				{
					array_push($valores, $per->id_permiso);
				}

			//Determinamos los accesos del usuario
			in_array(1,$valores)?$_SESSION['escritorio']=1:$_SESSION['escritorio']=0;
			in_array(2,$valores)?$_SESSION['envios']=1:$_SESSION['envios']=0;
			in_array(3,$valores)?$_SESSION['recibos']=1:$_SESSION['recibos']=0;
			in_array(4,$valores)?$_SESSION['billetes']=1:$_SESSION['billetes']=0;
			in_array(5,$valores)?$_SESSION['empleados']=1:$_SESSION['empleados']=0;
			in_array(6,$valores)?$_SESSION['agencias']=1:$_SESSION['agencias']=0;
			in_array(7,$valores)?$_SESSION['consultas']=1:$_SESSION['consultas']=0; 
			in_array(8,$valores)?$_SESSION['tasas']=1:$_SESSION['tasas']=0;
			in_array(9,$valores)?$_SESSION['rutas']=1:$_SESSION['rutas']=0; 
			in_array(10,$valores)?$_SESSION['solicitudes']=1:$_SESSION['solicitudes']=0;
			in_array(11,$valores)?$_SESSION['usuarios']=1:$_SESSION['usuarios']=0;
			in_array(12,$valores)?$_SESSION['contabilidad']=1:$_SESSION['contabilidad']=0;
			in_array(13,$valores)?$_SESSION['acceso']=1:$_SESSION['acceso']=0;
			in_array(14,$valores)?$_SESSION['paises']=1:$_SESSION['paises']=0;
			in_array(15,$valores)?$_SESSION['clientes']=1:$_SESSION['clientes']=0;
			in_array(16,$valores)?$_SESSION['cuentas']=1:$_SESSION['cuentas']=0;
			in_array(17,$valores)?$_SESSION['cajas']=1:$_SESSION['cajas']=0;
			in_array(18,$valores)?$_SESSION['operaciones']=1:$_SESSION['operaciones']=0;
			in_array(19,$valores)?$_SESSION['banco']=1:$_SESSION['banco']=0;
			in_array(20,$valores)?$_SESSION['banco_comercial']=1:$_SESSION['banco_comercial']=0;



	    }
	    echo json_encode($fetch);
	break;

	case 'salir':
		//Limpiamos las variables de sesión   
        session_unset();
        //Destruìmos la sesión
        session_destroy();
        //Redireccionamos al login
        header("Location: ../index.php");

	break;

}
?>