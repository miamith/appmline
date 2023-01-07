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
	public function insertar($DNIremitente,$nombre,$tel,$direccion,$agente,$ap,$cargo,$salario,$feinicioempleo,$agenciaA)
	{
		// Insercion primera en tabla Remitente
		$sql="INSERT INTO remitentes (`DNIremitente`, `nomcompleto`, `tel`, `direccion`, `agentcreaR`, `fecreaR`, `estado`) VALUES ('$DNIremitente','$nombre','$tel','$direccion','$agente',now(),'1')";
		ejecutarConsulta($sql);
		// Insertamos el billete comprado
		$sql="INSERT INTO empleados (`idempleado`, `ap`, `password`, `DNI`, `cargo`, `salario`, `agencia_em`, `condicion`, `agecrea`, `fecrea`, `feinicioempleo`, `femod`) VALUES (NULL,'$ap',NULL,'$DNIremitente','$cargo','$salario','$agenciaA',NULL,'$agente',now(),'$feinicioempleo',NULL)";
		return ejecutarConsulta($sql);

	}

	//Implementamos un método para editar registros
	public function editar($idempleado,$ap,$DNIremitente,$cargo,$salario,$agente,$nombre,$tel,$direccion,$feinicioempleo,$agenciaA)
	{
		// Actualizamos remitente
		$sql="UPDATE remitentes SET nomcompleto='$nombre',tel='$tel',direccion='$direccion' WHERE DNIremitente='$DNIremitente'";
		 ejecutarConsulta($sql);
			// Actualizamos billete
		$sql="UPDATE empleados SET ap='$ap',cargo='$cargo',salario='$salario',agencia_em='$agenciaA',agecrea='$agente',feinicioempleo='$feinicioempleo',femod=now() WHERE idempleado='$idempleado'";
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
		$sql="SELECT idempleado,ap,DNI,cargo,salario,nomcompleto,tel,direccion,fecrea,feinicioempleo,femod,agecrea FROM empleados,remitentes WHERE remitentes.DNIremitente=empleados.DNI";
		return ejecutarConsulta($sql);
	}

}

?>