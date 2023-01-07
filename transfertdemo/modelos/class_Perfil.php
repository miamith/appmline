<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Perfil
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($idEmpleado,$password)
	{
		$sql="UPDATE empleados SET password='$password',femod=now() WHERE idempleado='$idEmpleado'";
		return ejecutarConsulta($sql);	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idEmpleado)
	{
		$sql="SELECT idempleado,ap,password,(select nomcompleto from remitentes r WHERE r.DNIremitente=DNI) as nomcompleto FROM empleados WHERE idempleado='$idEmpleado'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT idempleado,(select nomcompleto from remitentes r WHERE r.DNIremitente=DNI) as nomcompleto,ap,password,agecrea FROM empleados WHERE password!='' AND condicion!=''";
		return ejecutarConsulta($sql);
	}


}

?>