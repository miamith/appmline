<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Contabilidad
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($concepto,$monto,$sentido,$observacion,$fecrea,$agenciaRegis,$agente)
	{
		// Insertamos el registro
		$sql2="INSERT INTO ingresos_gastos (`iding_gas`, `concepto`, `monto`, `sentido`, `observacion`, `fecrea`, `agecrea`, `agentcrea`) VALUES (NULL,'$concepto','$monto','$sentido','$observacion','$fecrea','$agenciaRegis','$agente')";
		return ejecutarConsulta($sql2);

	}

	//Implementamos un método para editar registros
	public function editar($iding_gas,$concepto,$monto,$sentido,$observacion,$fecrea)
	{
			// Actualizamos la contabilidad
		$sql="UPDATE ingresos_gastos SET concepto='$concepto',monto='$monto',observacion='$sentido',fecrea='$fecrea',observacion='$observacion' WHERE iding_gas='$iding_gas'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para eliminar categorías
	public function eliminar($iding_gas)
	{
		$sql="DELETE FROM ingresos_gastos WHERE iding_gas='$iding_gas'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($iding_gas)
	{
		$sql="SELECT iding_gas,concepto,monto,fecrea,observacion,sentido FROM ingresos_gastos WHERE iding_gas='$iding_gas'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT iding_gas,concepto,monto as ingreso,'' as gasto,observacion,(select nombre from agencias WHERE idagencia=ingresos_gastos.agecrea) as agecrea,agentcrea,fecrea FROM ingresos_gastos WHERE sentido='C'
				UNION
			  SELECT iding_gas,concepto,'' as ingreso,monto as gasto,observacion,(select nombre from agencias WHERE idagencia=ingresos_gastos.agecrea) as agecrea,agentcrea,fecrea FROM ingresos_gastos WHERE sentido='D'";
		return ejecutarConsulta($sql);
	}


}

?>