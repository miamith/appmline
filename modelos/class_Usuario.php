<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Usuario
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

//Implementamos un método para insertar registros
	public function insertar($ap,$password,$condicion,$permisos)
	{
		$sql="UPDATE empleados SET password='$password',condicion='$condicion',femod=now() WHERE idempleado='$ap'";
		ejecutarConsulta($sql);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($permisos))
		{
			$sql_detalle = "INSERT INTO permiso_empleado(id_permisoempleado,id_permiso,empleado) VALUES(NULL,'$permisos[$num_elementos]','$ap')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;
		
		
	}
	//Implementamos un método para editar registros
	public function editar($idempleado,$password,$condicion,$permisos)
	{
		$sql="UPDATE empleados SET password='$password',condicion='$condicion',femod=now() WHERE idempleado='$idempleado'";
		ejecutarConsulta($sql);

		//Eliminamos todos los permisos asignados para volverlos a registrar
		$sqldel="DELETE FROM permiso_empleado WHERE empleado='$idempleado'";
		ejecutarConsulta($sqldel);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($permisos))
		{
			$sql_detalle = "INSERT INTO permiso_empleado (id_permisoempleado,id_permiso,empleado) VALUES(NULL,'$permisos[$num_elementos]','$idempleado')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;
	}

	//Implementamos un método para eliminar categorías
	public function eliminar($idempleado)
	{
		
		$sql="UPDATE empleados SET password='',condicion='0',femod=now() WHERE idempleado='$idempleado'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idempleado)
	{
		$sql="SELECT idempleado,ap,password,condicion FROM empleados WHERE idempleado='$idempleado'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT idempleado,(select nomcompleto from remitentes r WHERE r.DNIremitente=DNI) as nomcompleto,ap,(select nombre from permiso p,permiso_empleado r WHERE p.idpermiso=r.id_permiso AND r.empleado=empleados.idempleado limit 0,1) as permisos,condicion,fecrea,agecrea FROM empleados WHERE password!='' AND condicion!='' AND ap!='ap001531'";
		return ejecutarConsulta($sql);
	}

		//Implementar un método para listar los registros y mostrar en el select
	public function selectEmpleado()
	{
		$sql="SELECT idempleado,ap,DNI,(select nomcompleto from remitentes r WHERE r.DNIremitente=DNI) as nomcompleto FROM empleados";
		return ejecutarConsulta($sql);		
	}
		//Implementar un método para listar los registros y mostrar en el select
	public function generarNCPagencia($responsable)
	{
		$sql="SELECT idempleado,ap,DNI FROM empleados WHERE ap='$responsable'";

		return ejecutarConsultaSimpleFila($sql);		
	}
	

		//Función para verificar el acceso al sistema
	public function verificar($ap,$password)
    {
    	$sql="SELECT idempleado, nomcompleto,ap,cargo,tel,direccion,agencia_em FROM empleados e,remitentes r WHERE r.DNIremitente=e.DNI AND ap='$ap' AND password='$password' AND condicion='1'";
    	return ejecutarConsulta($sql);  
    }

	//Implementar un método para listar los permisos marcados
	public function listarmarcados($idempleado)
	{
		$sql="SELECT * FROM permiso_empleado WHERE empleado='$idempleado'";
		return ejecutarConsulta($sql);
	}
	


}

?>