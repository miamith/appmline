<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Billete
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($company,$ruta,$fechaemision,$fesali,$fevuel,$numvuel,$nompasa,$agente,$DNIremitente,$localiz,$precio,$descripcion,$agencia)
	{
		// Insercion primera en tabla Remitente
		$sql="INSERT INTO clientes (`DNIremitente`, `nomcompleto`, `tel`, `direccion`, `agentcreaR`, `fecreaR`, `estado`) VALUES ('$DNIremitente','$nompasa',NULL,'Compra de billete','$agente',now(),'1')";
		ejecutarConsulta($sql);
		// Insertamos el billete comprado
		$sql2="INSERT INTO billetes (`idbillete`, `company`, `ruta`, `fechaemision`, `fesali`, `fevuel`, `numvuel`, `nompasa`, `localiz`, `precio`, `descripcion`, `agencia`, `fecrea`, `agentcrea`) VALUES (NULL,'$company','$ruta','$fechaemision','$fesali','$fevuel','$numvuel','$DNIremitente','$localiz','$precio','$descripcion','$agencia',now(),'$agente')";
		return ejecutarConsulta($sql2);

	}

	//Implementamos un método para editar registros
	public function editar($idbillete,$company,$ruta,$fechaemision,$fesali,$fevuel,$numvuel,$nompasa,$DNIremitente,$localiz,$precio,$descripcion,$agencia)
	{
		// Actualizamos remitente
		$sql="UPDATE clientes SET nomcompleto='$nompasa' WHERE DNIremitente='$DNIremitente'";
		 ejecutarConsulta($sql);
			// Actualizamos billete
		$sql="UPDATE billetes SET company='$company',ruta='$ruta',fechaemision='$fechaemision',fesali='$fesali',fevuel='$fevuel',numvuel='$numvuel',nompasa='$DNIremitente',localiz='$localiz',precio='$precio',descripcion='$descripcion',agencia='$agencia' WHERE idbillete='$idbillete'";
		return ejecutarConsulta($sql);
/*
				$sql="UPDATE billetes SET company='$company',ruta='$ruta',fechaemision='$fechaemision',fesali='$fesali',fevuel='$fevuel',numvuel='$numvuel',nompasa='$DNIremitente',localiz='$localiz',precio='$precio',descripcion='$descripcion',agencia='$agencia' WHERE idbillete='$idbillete'";
		return ejecutarConsulta($sql);*/
	}

	//Implementamos un método para eliminar categorías
	public function eliminar($idbillete)
	{
		$sql="DELETE FROM billetes WHERE idbillete='$idbillete'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idbillete)
	{
		$sql="SELECT idbillete,company,ruta,fechaemision,fesali,fevuel,numvuel,(select nomcompleto from clientes WHERE DNIremitente=nompasa) as nomcompleto,nompasa as DNIremitente,localiz,precio,descripcion,agencia FROM billetes WHERE idbillete='$idbillete'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT idbillete,company,(select nombreR from rutas WHERE idruta=ruta) as ruta,fesali,fevuel,numvuel,(select nomcompleto from clientes WHERE DNIremitente=nompasa) as nomcompleto,localiz,precio,descripcion,(select nombre from agencias WHERE idagencia=agencia) as agencia,agentcrea,fechaemision FROM billetes";
		return ejecutarConsulta($sql);
	}

		//Implementar un método para listar los registros y mostrar en el select
	public function selectAgencias()
	{
		$sql="SELECT * FROM agencias";
		return ejecutarConsulta($sql);		
	}

		//Implementar un método para filtar las comisiones
	public function selectRutas()
	{
		$sql="SELECT * FROM rutas";
		return ejecutarConsulta($sql);		
	}

}

?>