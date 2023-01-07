<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Ruta
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombreR,$descripcionr)
	{
		$sql="INSERT INTO rutas (`idruta`, `nombreR`, `descripcionr`) VALUES (NULL,'$nombreR','$descripcionr')";
		return ejecutarConsulta($sql);
		
	}

	//Implementamos un método para editar registros
	public function editar($idruta,$nombreR,$descripcionr)
	{
		$sql="UPDATE rutas SET nombreR='$nombreR',descripcionr='$descripcionr' WHERE idruta='$idruta'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para eliminar categorías
	public function eliminar($idruta)
	{
		$sql="DELETE FROM  rutas WHERE idruta='$idruta'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idruta)
	{
		$sql="SELECT idruta,nombreR,descripcionr FROM rutas WHERE idruta='$idruta'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT idruta, nombreR,descripcionr FROM rutas";
		return ejecutarConsulta($sql);
	}


}

?>