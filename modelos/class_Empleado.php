<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Empleado
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	
	public function insertar($ap,$DNIremitente,$cargo,$rol,$salario,$agenciaA,
							$pais,$ciudad,$interno,$agente,$feinicioempleo,$nomcompleto,$tel,$direccion)
	{
		// Insercion primera en tabla Clientes
		$sql="INSERT INTO clientes (`DNIremitente`, `nomcompleto`, `tel`, `pais`, `direccion`, `agencia_cli`,
									 `estado`, `agencrea`, `fecrea`, `agenmodif`, `femodif`) 
					VALUES ('$DNIremitente','$nomcompleto','$tel','$pais','$direccion','$agenciaA','1','$agente',now(),NULL,NULL)";
		ejecutarConsulta($sql);

		// Insertamos el empleado
		$sql="INSERT INTO empleados (`idempleado`, `ap`, `password`, `DNI`, `cargo`, `rol`, `salario`, 
									`agencia_em`, `pais`, `ciudad`, `interno`, `condicion`, `agecrea`, `fecrea`, `feinicioempleo`, `femod`) 
					 VALUES (NULL,'$ap',NULL,'$DNIremitente','$cargo','$rol','$salario','$agenciaA','$pais','$ciudad',
					 		 '$interno','1','$agente',now(),'$feinicioempleo',NULL)";
		return ejecutarConsulta($sql);

	}

	//Implementamos un método para editar registros
	public function editar($idempleado,$ap,$DNIremitente,$cargo,$rol,$salario,$agenciaA,
							$pais,$ciudad,$interno,$agente,$feinicioempleo,$nomcompleto,$tel,$direccion)
	{
		// Actualizamos CLIENTE
		$sql="UPDATE clientes SET nomcompleto='$nomcompleto',tel='$tel',pais='$pais',direccion='$direccion',agencia_cli='$agenciaA',agenmodif='$agente'  
			 WHERE DNIremitente='$DNIremitente'";
		 ejecutarConsulta($sql);
			// Actualizamos EMPLEADO
		$sql="UPDATE empleados SET ap='$ap',DNI='$DNIremitente',cargo='$cargo',rol='$rol',salario='$salario',agencia_em='$agenciaA',
					 pais='$pais',ciudad='$ciudad',interno='$interno',feinicioempleo='$feinicioempleo',femod=now() WHERE idempleado='$idempleado'";
		return ejecutarConsulta($sql);
		
	}

	//Implementamos un método para eliminar categorías
	public function eliminar($idempleado)
	{
		$sql="DELETE FROM empleados WHERE idempleado='$idempleado'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idempleado)
	{
		$sql="SELECT idempleado,ap,DNI,cargo,salario,nomcompleto,tel,direccion,feinicioempleo,agencia_em FROM empleados,remitentes WHERE remitentes.DNIremitente=empleados.DNI AND idempleado='$idempleado'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT idempleado,ap,DNI,cargo,pais as pais_nombre,ciudad,interno,agencia_em as agenciaA,rol,salario,nomcompleto,tel,direccion,fecrea,feinicioempleo,femod,agecrea FROM empleados,remitentes WHERE remitentes.DNIremitente=empleados.DNI";
		return ejecutarConsulta($sql);

	}

}

?>