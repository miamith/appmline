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
	public function insertar($idempleado,$password)
	{
		$sql="UPDATE empleados SET password='$password',femod=now() WHERE idempleado='$idempleado'";
		return ejecutarConsulta($sql);
		}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idempleado)
	{
		$sql="SELECT idempleado,ap,rol,password,(select nomcompleto from clientes r 
		WHERE r.DNIremitente=DNI) as nomcompleto FROM empleados WHERE idempleado='$idempleado'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar($idempleado)
	{
		$sql="SELECT idempleado,
		(select nomcompleto from clientes r WHERE r.DNIremitente=DNI) as nomcompleto,ap,rol,password,agecrea 
		FROM empleados WHERE password!='' AND condicion!='' AND idempleado='$idempleado'";
		return ejecutarConsulta($sql);
	}


}

?>