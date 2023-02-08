<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Pais
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nompais,$descripcion,$limienviolocal,$limienvioint,$moneda,$iva,$porcenenvio,$porcenrecibir,$porcenenviopaq,$porcenrecibirpaq,$partnerapi,$prefijoTel,$agente)
	{
		// Insercion datos de pais para su uso
		$sql="INSERT INTO paises (`idpais`, `nombre`, `descripcion`, `prefijoTel`,`limite_envioLOCAL`, `limite_envioINT`, `moneda`, `IVA`, `porcenENVIO`, `porcenRECIBIR`, `porcenENVIO_PAQ`, `porcenRECI_PAQ`, `partnerAPI`, `uscreador`, `fecrea`, `eliminado`) 
                          VALUES (NULL,'$nompais','$descripcion','$prefijoTel','$limienviolocal','$limienvioint','$moneda','$iva','$porcenenvio','$porcenrecibir','$porcenenviopaq','$porcenrecibirpaq','$partnerapi','$agente', now(), 0)";
		ejecutarConsulta($sql);

	}

	//Implementamos un método para editar registros
	public function editar($idpais,$nompais,$descripcion,$limienviolocal,$limienvioint,$moneda,$iva,$porcenenvio,$porcenrecibir,$porcenenviopaq,$porcenrecibirpaq,$partnerapi,$prefijoTel,$agente)
	{
			// Actualizamos pais
		$sql="UPDATE paises SET nombre='$nompais',descripcion='$descripcion',prefijoTel='$prefijoTel', limite_envioLOCAL='$limienviolocal',
                                limite_envioINT='$limienvioint',moneda='$moneda',IVA='$iva',porcenENVIO='$porcenenvio',
                                porcenRECIBIR='$porcenrecibir',porcenENVIO_PAQ='$porcenenviopaq',porcenRECI_PAQ='$porcenrecibirpaq',partnerAPI='$partnerapi',usmodif='$agente',femodif=now() WHERE idPais='$idpais'";
		return ejecutarConsulta($sql);

	}

	//Implementamos un método para eliminar categorías
	public function eliminar($idpais,$agente)
	{
		$sql="UPDATE paises SET eliminado=1,usmodif='$agente',femodif=now() WHERE idPais='$idpais'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idpais)
	{
		$sql="SELECT * FROM paises WHERE idPais='$idpais'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM paises WHERE eliminado=0";
		return ejecutarConsulta($sql);
	}



}

?>