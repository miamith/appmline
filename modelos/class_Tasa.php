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
	public function insertar($pais_origen,$pais_destino,$Descripcion,$Monto1,$Monto2,$MontoKILO,$MontoSOBRE,$comisiont,$agente)
	{
		
		$sql="INSERT INTO tasas (`idTasas`, `pais_origen`, `pais_destino`, `Descripcion`,
		                         `Monto1`, `Monto2`, `MontoKILO`, `MontoSOBRE`, `comisiont`,
								  `fecreat`,`agencrea`) 
					 VALUES (NULL,'$pais_origen','$pais_destino','$Descripcion','$Monto1','$Monto2',
					         '$MontoKILO','$MontoSOBRE','$comisiont',now(),'$agente')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idTasas,$pais_origen,$pais_destino,$Descripcion,$Monto1,$Monto2,$MontoKILO,$MontoSOBRE,$comisiont,$agente)
	{
		$sql="UPDATE tasas SET pais_origen='$pais_origen',pais_destino='$pais_destino',Descripcion='$Descripcion',
		                       Monto1='$Monto1',Monto2='$Monto2',MontoKILO='$MontoKILO',MontoSOBRE='$MontoSOBRE',
							   comisiont='$comisiont',agenmodif='$agente' 
							   WHERE idTasas='$idTasas'";
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
		$sql="SELECT idTasas,pais_origen,pais_destino,Descripcion,Monto1,Monto2,MontoKILO,MontoSOBRE,comisiont FROM tasas WHERE idTasas='$idTasas'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT idTasas,(SELECT nombre FROM paises WHERE idPais=pais_origen) as pais_origenNOM,
					(SELECT nombre FROM paises WHERE idPais=pais_destino) as pais_destinoNOM,
					Descripcion,Monto1,Monto2,MontoKILO,MontoSOBRE,comisiont,fecreat,agencrea FROM tasas";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros y mostrar en el select
	public function selectPaises()
	{
		$sql="SELECT idPais, nombre,moneda FROM paises";
		return ejecutarConsulta($sql);		
	}


}

?>