<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Solicitud
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para editar registros
	public function editar($idtransaccionh,$idbkhish,$idbkhis,$agente)
	{
		// Actualizamos transaccion poniendo estado=Pendiente
		$sql="UPDATE transaccion SET estadot='Pendiente',femodif=now() WHERE idtransaccion='$idtransaccionh'";
		 ejecutarConsulta($sql);
			// Actualizamos bkhis las 2 lineas, esta es la linea valida, abajo la linea eliminada o no valida
		$sql="UPDATE bkhis SET estadoth='Pendiente',agentvalida='$agente',fechavalidacion=now() WHERE idtransaccionh='$idtransaccionh' AND idbkhis='$idbkhish' AND operacion='Solicitud Modificacion envio'";
		 ejecutarConsulta($sql);
		$sql="UPDATE bkhis SET estadoth='Cancelado',agentvalida='$agente',fechavalidacion=now() WHERE idtransaccionh='$idtransaccionh' AND idbkhis='$idbkhis' AND operacion='Envio normal'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para eliminar categorías
	public function eliminar($idbkhish)
	{
		$sql="DELETE FROM  bkhis WHERE idbkhis='$idbkhish'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrarbkhisOri($idtransaccionh)
	{
		$sql="SELECT * FROM bkhis WHERE operacion='Envio normal' AND idtransaccionh='$idtransaccionh'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrarbkhisCam($idtransaccionh)
	{
		$sql="SELECT * FROM bkhis WHERE operacion='Solicitud Modificacion envio' AND idtransaccionh='$idtransaccionh'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT idbkhis,idtransaccionh,codigoh,nomcompletoch,nomcomplerh,montoh,descripcion,operacion,agentcreh,fecrea,fechavalidacion,estadoth FROM bkhis WHERE operacion='Solicitud Modificacion envio'";
		return ejecutarConsulta($sql);
	}

		//Implementamos un método para cancelar solicitud
	public function cancelar($idtransaccionh,$idbkhish,$idbkhis,$agente)
			{
				// Actualizamos transaccion poniendo estado=Pendiente
				$sql="UPDATE transaccion SET estadot='Pendiente',femodif=now() WHERE idtransaccion='$idtransaccionh'";
				 ejecutarConsulta($sql);
					// Actualizamos bkhis solicitud
				$sql="UPDATE bkhis SET estadoth='Rechazado',agentvalida='$agente',fechavalidacion=now() WHERE idtransaccionh='$idtransaccionh' AND idbkhis='$idbkhish'";
				 ejecutarConsulta($sql);
				 
				 // Actualizamos el estado del envio con Pendiente a que se cobre asi.
				$sql="UPDATE bkhis SET estadoth='Pendiente',agentvalida='$agente',fechavalidacion=now() WHERE idtransaccionh='$idtransaccionh' AND idbkhis='$idbkhis'";
				return ejecutarConsulta($sql);
			}

			//Implementamos un método para cancelar solicitud
	public function restaurar($DNIremitenteh,$nomcompletoch,$telch,$direccionch,$idreceptorh,$DNIreceptorh,$nomcomplerh,$telrh,$direccionrh,$ageenviah,$agerecibeh,$tipoh,$montoh,$comisionh,$estadoth,$descripcion,$agentcreh,$fecrea,$fechavalidacion,$idtransaccionh)
			{
				// Actualizamos remitente
			  $sql="UPDATE clientes SET nomcompleto='$nomcompletoch',tel='$telch',direccion='$direccionch' WHERE DNIremitente='$DNIremitenteh'";
			  ejecutarConsulta($sql);
				// Actualizamos receptor
			  $sql="UPDATE receptor SET DNIreceptor='$DNIreceptorh',nomcompler='$nomcomplerh',telr='$telrh',direccionr='$direccionrh' WHERE idreceptor='$idreceptorh'";
			  ejecutarConsulta($sql);
				
				// Actualizamos transaccion
			  $sql="UPDATE transaccion SET ageenvia='$ageenviah',agerecibe='$agerecibeh',tipo='$tipoh',estadot='Pendiente',descripcion='$descripcion',femodif=now() WHERE idtransaccion='$idtransaccionh'";
		       return ejecutarConsulta($sql);
			}		

			

}

?>