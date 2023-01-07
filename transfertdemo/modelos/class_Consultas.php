<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Consulta
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}



	//Implementar un método para listar los registros
	public function consultasEnviosFechaRemitente($fecha_inicio,$fecha_final,$DNIremitente)
	{
		$sql="SELECT rem.nomcompleto,rem.tel,t.monto,t.comision,t.codigo,(select nombre from agencias WHERE idagencia=t.ageenvia) as agenciaA,rep.nomcompler,(select nombre from agencias WHERE idagencia=t.agerecibe) as agenciaB,t.fecrea,t.estadot FROM remitentes rem,transaccion t, receptor rep WHERE rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor AND DATE(t.fecrea)>='$fecha_inicio' AND DATE(t.fecrea)<='$fecha_final' AND t.remitente='$DNIremitente'";
		return ejecutarConsulta($sql);
	}

		public function consultasEnviosFechas($fecha_inicio,$fecha_final)
	{
		$sql="SELECT rem.nomcompleto,rem.tel,t.monto,t.comision,t.codigo,(select nombre from agencias WHERE idagencia=t.ageenvia) as agenciaA,rep.nomcompler,(select nombre from agencias WHERE idagencia=t.agerecibe) as agenciaB,t.fecrea,t.estadot FROM remitentes rem,transaccion t, receptor rep WHERE rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor AND DATE(t.fecrea)>='$fecha_inicio' AND DATE(t.fecrea)<='$fecha_final'";
		return ejecutarConsulta($sql);
	}


	/////////////////////////// RECIBOS INICIO /////////////////////////////////////////////////////////777
		//Implementar un método para listar los registros
	public function consultasRecibosFechaRemitente($fecha_inicio,$fecha_final,$DNIremitente)
	{
		$sql="SELECT rem.nomcompleto,telr,direccionr,idreceptor,DNIreceptor,t.monto,t.comision,t.codigo,(select nombre from agencias WHERE idagencia=t.ageenvia) as agenciaA,rep.nomcompler,(select nombre from agencias WHERE idagencia=t.agerecibe) as agenciaB,t.fecrea,t.estadot FROM remitentes rem,transaccion t, receptor rep WHERE rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor AND t.estadot IN ('Pendiente','Recibido') AND DATE(t.fecrea)>='$fecha_inicio' AND DATE(t.fecrea)<='$fecha_final' AND t.remitente='$DNIremitente' ORDER BY t.fecrea DESC";
		return ejecutarConsulta($sql);
	}

		public function consultasRecibosFechas($fecha_inicio,$fecha_final)
	{
		$sql="SELECT rem.nomcompleto,telr,direccionr,idreceptor,DNIreceptor,t.monto,t.comision,t.codigo,(select nombre from agencias WHERE idagencia=t.ageenvia) as agenciaA,rep.nomcompler,(select nombre from agencias WHERE idagencia=t.agerecibe) as agenciaB,t.fecrea,t.estadot FROM remitentes rem,transaccion t, receptor rep WHERE rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor AND t.estadot IN ('Pendiente','Recibido') AND DATE(t.fecrea)>='$fecha_inicio' AND DATE(t.fecrea)<='$fecha_final' ORDER BY t.fecrea DESC";
		return ejecutarConsulta($sql);
	}

		public function totalenvios()
	{
		$sql="SELECT IFNULL(SUM(monto),0) as monto FROM remitentes rem,transaccion t, receptor rep WHERE rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor AND t.estadot IN ('Pendiente','Recibido')";
		return ejecutarConsulta($sql);
	}

		public function totalenviosHOY()
	{
		$sql="SELECT IFNULL(SUM(monto),0) as monto FROM remitentes rem,transaccion t, receptor rep WHERE rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor AND t.estadot IN ('Pendiente','Recibido') AND DATE(t.fecrea)=curdate()";
		return ejecutarConsulta($sql);
	}

		public function totalrecibos()
	{
		$sql="SELECT IFNULL(SUM(monto),0) as monto FROM remitentes rem,transaccion t, receptor rep WHERE rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor AND t.estadot='Recibido'";
		return ejecutarConsulta($sql);
	}


		public function totalrecibosHOY()
	{
		$sql="SELECT IFNULL(SUM(monto),0) as monto FROM remitentes rem,transaccion t, receptor rep WHERE rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor AND t.estadot='Recibido' AND DATE(t.fecrea)=curdate()";
		return ejecutarConsulta($sql);
	}

			public function totalcomisiones()
	{
		$sql="SELECT IFNULL(SUM(comision),0) as monto FROM remitentes rem,transaccion t, receptor rep WHERE rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor AND t.estadot IN ('Pendiente','Recibido')";
		return ejecutarConsulta($sql);
	}


		public function totalcomisionesHOY()
	{
		$sql="SELECT IFNULL(SUM(comision),0) as monto FROM remitentes rem,transaccion t, receptor rep WHERE rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor AND t.estadot IN ('Pendiente','Recibido') AND DATE(t.fecrea)=curdate()";
		return ejecutarConsulta($sql);
	}




	////////////////////////  GRAFICAS  ///////////////////////////////////////

		public function totalenviosUltimos_10dias()
	{
		$sql="SELECT CONCAT(DAY(t.fecrea),'-',MONTH(t.fecrea)) as fecha,SUM(monto) as total FROM remitentes rem,transaccion t, receptor rep WHERE rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor AND t.estadot IN ('Pendiente','Recibido') GROUP BY t.fecrea ORDER BY t.fecrea DESC limit 0,10";
		return ejecutarConsulta($sql);
	}

		public function totalrecibosUltimos_10dias()
	{
		$sql="SELECT CONCAT(DAY(t.fecrea),'-',MONTH(t.fecrea)) as fecha,SUM(monto) as total FROM remitentes rem,transaccion t, receptor rep WHERE rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor AND t.estadot IN ('Recibido') GROUP BY t.fecrea ORDER BY t.fecrea DESC limit 0,10";
		return ejecutarConsulta($sql);
	}

		public function ClientesMasEnvios()
	{
		$sql="SELECT rem.nomcompleto,SUM(monto) as total FROM remitentes rem,transaccion t, receptor rep WHERE rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor AND t.estadot IN ('Pendiente','Recibido') GROUP BY rem.nomcompleto ORDER BY rem.nomcompleto DESC limit 0,20";
		return ejecutarConsulta($sql);
	}

			public function CompaniaMasBilletes()
	{
		$sql="SELECT company, count(idbillete) as totalB FROM billetes GROUP BY company ORDER BY company DESC limit 0,20";
		return ejecutarConsulta($sql);
	}





			//Implementar un método para listar los registros y mostrar en el select
	public function selectRemitente()
	{
		$sql="SELECT DNIremitente, nomcompleto FROM remitentes";
		return ejecutarConsulta($sql);	
	}


}

?>