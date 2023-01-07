<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Tasa
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($Descripcion,$Monto1,$Monto2,$comisiont,$agente)
	{
		$sql="INSERT INTO tasas VALUES (NULL,'$Descripcion','$Monto1','$Monto2','$comisiont',now(),'$agente')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idTasas,$Descripcion,$Monto1,$Monto2,$comisiont)
	{
		$sql="UPDATE tasas SET Descripcion='$Descripcion',Monto1='$Monto1',Monto2='$Monto2',comisiont='$comisiont' WHERE idTasas='$idTasas'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para eliminar categorías
	public function eliminar($idTasas)
	{
		$sql="DELETE FROM tasas WHERE idTasas='$idTasas'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idTasas)
	{
		$sql="SELECT idTasas,Descripcion,Monto1,Monto2,comisiont FROM tasas WHERE idTasas='$idTasas'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT idTasas,Descripcion,Monto1,Monto2,comisiont,fecreat,agencrea FROM tasas";
		return ejecutarConsulta($sql);
	}


}

?>