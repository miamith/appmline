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
	public function insertar($nombre,$descripcion,$pais,$ciudad,$max_cajas,$ncp,$responsable,$agente)
	{ 
		
		$sql="INSERT INTO agencias (`idagencia`, `nombre`, `descripcion`,`pais`,`ciudad`, `max_cajas`,
									`ncp`, `responsable`,`agentcrea`, `fecrea`) 
					VALUES (NULL,'$nombre','$descripcion',$pais,$ciudad,$max_cajas,$ncp,$responsable,'$agente',now())";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idagencia,$nombre,$descripcion,$pais,$ciudad,$max_cajas,$ncp,$responsable,$agente)
	{
		$sql="UPDATE agencias SET nombre='$nombre',descripcion='$descripcion',pais='$pais',ciudad='$ciudad',
								 ncp='$ncp',responsable='$responsable',max_cajas='$max_cajas',agemodif='$agente',femodif=now()
							  WHERE idagencia='$idagencia'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para eliminar categorías
	public function eliminar($idagencia,$agente)
	{
		$sql="UPDATE agencias SET eliminado=1,agemodif='$agente',femodif=now()
	 						  WHERE idagencia='$idagencia'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idagencia)
	{
		$sql="SELECT idagencia,nombre,descripcion,pais,ciudad,max_cajas,ncp,responsable FROM agencias WHERE idagencia='$idagencia'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT idagencia, nombre,descripcion,
					(SELECT nombre FROM paises WHERE idPais=pais) as pais_nombre,
					(SELECT nomcompleto FROM empleados e,remitentes r WHERE e.DNI=r.DNIremitente AND ap=responsable) as responsable_nombre,
					ciudad,max_cajas,ncp,responsable,agentcrea,fecrea 
					FROM agencias WHERE eliminado=0";
		return ejecutarConsulta($sql);
	}


}

?>