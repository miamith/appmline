<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Agencia
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre,$descripcion,$agente)
	{
		$sql="INSERT INTO agencias (`idagencia`, `nombre`, `descripcion`, `agentcrea`, `fecrea`) VALUES (NULL,'$nombre','$descripcion','$agente',now())";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idagencia,$nombre,$descripcion)
	{
		$sql="UPDATE agencias SET nombre='$nombre',descripcion='$descripcion' WHERE idagencia='$idagencia'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para eliminar categorías
	public function eliminar($idagencia)
	{
		$sql="DELETE FROM  agencias WHERE idagencia='$idagencia'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idagencia)
	{
		$sql="SELECT idagencia,nombre,descripcion FROM agencias WHERE idagencia='$idagencia'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT idagencia, nombre,descripcion,agentcrea,fecrea FROM agencias";
		return ejecutarConsulta($sql);
	}


}

?>