<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Persona
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	public function generarCodigo($longitud) {
		 $key = '';
		 $pattern = '123Z4S5V6L7Q8M90ABCDEFGHIJKLMNOPQRSTVWYZ';
		 $max = strlen($pattern)-1;
		 for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
		 return $key;
		}
	//Implementamos un método para insertar registros
	public function insertar($nombreremitente,$nombrereceptor,$telefonorem,$telefonorec,$dirremitente,$agente,$dirreceptor,$DNIremitente,$DNIreceptor,$tipo,$monto,$comision,$agenciaA,$agenciaB,$codigo,$descripcion)
	{
		// Insercion primera en tabla Remitente
		$sql="INSERT INTO remitentes (DNIremitente,nomcompleto,tel,direccion,agentcreaR,fecreaR,estado) VALUES ('$DNIremitente','$nombreremitente','$telefonorem','$dirremitente','$agente',now(),'1')";
		ejecutarConsulta($sql);
		// Insertamos el receptor
		$sql="INSERT INTO receptor (idreceptor,DNIreceptor,nomcompler,telr,direccionr,agentcrea,fecrea) VALUES (NULL,'$DNIreceptor','$nombrereceptor','$telefonorec','$dirreceptor','$agente',now())";
		$idreceptornew=ejecutarConsulta_retornarID($sql);
		// insercion de la transaccion o el mismo envio
		$sql="INSERT INTO transaccion (idtransaccion,remitente,receptor,ageenvia,agerecibe,tipo,monto,comision,codigo,descripcion,sms_mobil,estadot,agentcreat,agenmod,fecrea,femodif) VALUES (NULL,'$DNIremitente','$idreceptornew','$agenciaA','$agenciaB','$tipo','$monto','$comision','$codigo','$descripcion','insertar_sms_mobile','Pendiente','$agente',NULL,now(),NULL)";
		$idtransaccion=ejecutarConsulta_retornarID($sql);

		// insercion de la bkhis o el mismo envio para guardar historial
		$sql="INSERT INTO bkhis (idbkhis, DNIremitenteh, nomcompletoch, telch, direccionch, agentcreaRh, idreceptorh, DNIreceptorh, nomcomplerh, telrh, direccionrh, agentcrearetorh, idtransaccionh, ageenviah, agerecibeh, tipoh, montoh, comisionh, codigoh, estadoth, descripcion, agentcreh, agentvalida, fecrea, operacion, fechavalidacion)  VALUES (NULL,'$DNIremitente','$nombreremitente','$telefonorem','$dirremitente','$agente','$idreceptornew','$DNIreceptor','$nombrereceptor','$telefonorec','$dirreceptor','$agente','$idtransaccion','$agenciaA','$agenciaB','$tipo','$monto','$comision','$codigo','Pendiente','$descripcion','$agente',NULL,now(),'Envio normal',NULL)";
		return ejecutarConsulta($sql);

	}

		public function insertarCopia($nombreremitente,$telefonorem,$dirremitente,$DNIreceptor,$nombrereceptor,$telefonorec,$dirreceptor,$DNIremitente,$idreceptor,$agenciaA,$agenciaB,$tipo,$monto,$comision,$codigo,$descripcion,$agente)
	{
		// Actualizamos remitente
		$sql="UPDATE remitentes SET nomcompleto='$nombreremitente',tel='$telefonorem',direccion='$dirremitente' WHERE DNIremitente='$DNIremitente'";
		 ejecutarConsulta($sql);
		// Actualizamos receptor
		$sql="UPDATE receptor SET DNIreceptor='$DNIreceptor',nomcompler='$nombrereceptor',telr='$telefonorec',direccionr='$dirreceptor' WHERE idreceptor='$idreceptor'";
		ejecutarConsulta($sql);
		// insercion de la transaccion o el mismo envio
		$sql="INSERT INTO transaccion (`idtransaccion`, `remitente`, `receptor`, `ageenvia`, `agerecibe`, `tipo`, `monto`, `comision`, `codigo`, `descripcion`, `sms_mobil`, `estadot`, `agentcreat`, `agenmod`, `fecrea`, `femodif`) VALUES (NULL,'$DNIremitente','$idreceptor','$agenciaA','$agenciaB','$tipo','$monto','$comision','$codigo','$descripcion','solo_sms_mobile','Pendiente','$agente',NULL,now(),NULL)";
				$idtransaccion=ejecutarConsulta_retornarID($sql);

		// insercion de la bkhis o el mismo envio para guardar historial
		$sql="INSERT INTO bkhis (`idbkhis`, `DNIremitenteh`, `nomcompletoch`, `telch`, `direccionch`, `agentcreaRh`, `idreceptorh`, `DNIreceptorh`, `nomcomplerh`, `telrh`, `direccionrh`, `agentcrearetorh`, `idtransaccionh`, `ageenviah`, `agerecibeh`, `tipoh`, `montoh`, `comisionh`, `codigoh`, `estadoth`, `descripcion`, `agentcreh`, `agentvalida`, `fecrea`, `operacion`, `fechavalidacion`) VALUES (NULL,'$DNIremitente','$nombreremitente','$telefonorem','$dirremitente','$agente','$idreceptor','$DNIreceptor','$nombrereceptor','$telefonorec','$dirreceptor','$agente','$idtransaccion','$agenciaA','$agenciaB','$tipo','$monto','$comision','$codigo','Pendiente','$descripcion','$agente',NULL,now(),'Envio normal',NULL)";
		return ejecutarConsulta($sql);
	}

		public function insertarCopiaR($nombreremitente,$telefonorem,$dirremitente,$DNIreceptor,$nombrereceptor,$telefonorec,$dirreceptor,$DNIremitente,$idreceptor,$agenciaA,$agenciaB,$tipo,$monto,$comision,$codigo,$descripcion,$agente)
	{
		// Actualizamos remitente
		$sql="UPDATE remitentes SET nomcompleto='$nombreremitente',tel='$telefonorem',direccion='$dirremitente' WHERE DNIremitente='$DNIremitente'";
		 ejecutarConsulta($sql);
		// Insertamos receptor
		$sql="INSERT INTO receptor (`idreceptor`, `DNIreceptor`, `nomcompler`, `telr`, `direccionr`, `agentcrea`, `fecrea`)  VALUES (NULL,'$DNIreceptor','$nombrereceptor','$telefonorec','$dirreceptor','$agente',now())";
		$idreceptornew=ejecutarConsulta_retornarID($sql);
		// Insercion de la transaccion o el mismo envio
		$sql="INSERT INTO transaccion (`idtransaccion`, `remitente`, `receptor`, `ageenvia`, `agerecibe`, `tipo`, `monto`, `comision`, `codigo`, `descripcion`, `sms_mobil`, `estadot`, `agentcreat`, `agenmod`, `fecrea`, `femodif`) VALUES (NULL,'$DNIremitente','$idreceptornew','$agenciaA','$agenciaB','$tipo','$monto','$comision','$codigo','$descripcion','sms_mobile copia','Pendiente','$agente',NULL,now(),NULL)";
		$idtransaccion=ejecutarConsulta_retornarID($sql);

		// insercion de la bkhis o el mismo envio para guardar historial
		$sql="INSERT INTO bkhis (`idbkhis`, `DNIremitenteh`, `nomcompletoch`, `telch`, `direccionch`, `agentcreaRh`, `idreceptorh`, `DNIreceptorh`, `nomcomplerh`, `telrh`, `direccionrh`, `agentcrearetorh`, `idtransaccionh`, `ageenviah`, `agerecibeh`, `tipoh`, `montoh`, `comisionh`, `codigoh`, `estadoth`, `descripcion`, `agentcreh`, `agentvalida`, `fecrea`, `operacion`, `fechavalidacion`) VALUES (NULL,'$DNIremitente','$nombreremitente','$telefonorem','$dirremitente','$agente','$idreceptornew','$DNIreceptor','$nombrereceptor','$telefonorec','$dirreceptor','$agente','$idtransaccion','$agenciaA','$agenciaB','$tipo','$monto','$comision','$codigo','Pendiente','$descripcion','$agente',NULL,now(),'Envio normal',NULL)";
		return ejecutarConsulta($sql);

	}

	//Implementamos un método para editar registros
	public function editar($idtransaccion,$idreceptor,$nombreremitente,$nombrereceptor,$telefonorem,$telefonorec,$dirremitente,$agente,$dirreceptor,$DNIremitente,$DNIreceptor,$tipo,$monto,$comision,$codigoAc,$agenciaA,$agenciaB,$descripcion)
	{
		// Actualizamos remitente
		$sql="UPDATE remitentes SET nomcompleto='$nombreremitente',tel='$telefonorem',direccion='$dirremitente' WHERE DNIremitente='$DNIremitente'";
		 ejecutarConsulta($sql);
			// Actualizamos receptor
		$sql="UPDATE receptor SET DNIreceptor='$DNIreceptor',nomcompler='$nombrereceptor',telr='$telefonorec',direccionr='$dirreceptor' WHERE idreceptor='$idreceptor'";
		ejecutarConsulta($sql);
			// Actualizamos transaccion
		$sql="UPDATE transaccion SET remitente='$DNIremitente',receptor='$idreceptor',ageenvia='$agenciaA',agerecibe='$agenciaB',tipo='$tipo',estadot='Revalidar',descripcion='$descripcion',agenmod='$agente',femodif=now() WHERE idtransaccion='$idtransaccion'";
		ejecutarConsulta($sql);
					// insercion de la bkhis o el mismo envio para guardar historial
		$sql="INSERT INTO bkhis (`idbkhis`, `DNIremitenteh`, `nomcompletoch`, `telch`, `direccionch`, `agentcreaRh`, `idreceptorh`, `DNIreceptorh`, `nomcomplerh`, `telrh`, `direccionrh`, `agentcrearetorh`, `idtransaccionh`, `ageenviah`, `agerecibeh`, `tipoh`, `montoh`, `comisionh`, `codigoh`, `estadoth`, `descripcion`, `agentcreh`, `agentvalida`, `fecrea`, `operacion`, `fechavalidacion`)  VALUES (NULL,'$DNIremitente','$nombreremitente','$telefonorem','$dirremitente','$agente','$idreceptor','$DNIreceptor','$nombrereceptor','$telefonorec','$dirreceptor','$agente','$idtransaccion','$agenciaA','$agenciaB','$tipo','$monto','$comision','$codigoAc','Revalidar','$descripcion','$agente',NULL,now(),'Solicitud Modificacion envio',NULL)";
		return ejecutarConsulta($sql);


	}

	//Implementamos un método para eliminar categorías
	public function eliminar($idtransaccion,$agente)
	{
		$sql="UPDATE transaccion SET estadot='Cancelado',agenmod='$agente',femodif=now() WHERE idtransaccion='$idtransaccion'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idtransaccion)
	{
		$sql="SELECT rem.nomcompleto as nombreremitente,rep.nomcompler as nombrereceptor,rem.tel as telefonorem,rep.telr as telefonorec,rem.direccion as dirremitente,direccionr as dirreceptor,DNIremitente,DNIreceptor,t.tipo,t.ageenvia as agenciaA,t.agerecibe as agenciaB,t.monto,t.comision,t.descripcion,t.idtransaccion, rep.idreceptor,t.codigo,t.estadot,t.fecrea,t.agentcreat FROM remitentes rem,transaccion t, receptor rep WHERE rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor AND t.idtransaccion='$idtransaccion'";
		return ejecutarConsultaSimpleFila($sql);
	}

		//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrarRecibo($idtransaccion)
	{
		$sql="SELECT rem.nomcompleto as nombreremitente,rep.nomcompler as nombrereceptor,rem.tel as telefonorem,rep.telr as telefonorec,rem.direccion as dirremitente,direccionr as dirreceptor,DNIremitente,DNIreceptor,t.tipo,t.ageenvia as agenciaA,t.agerecibe as agenciaB,t.monto,t.comision,t.descripcion,t.idtransaccion, rep.idreceptor,t.codigo,t.estadot,t.fecrea,t.agentcreat,idbkhis FROM remitentes rem,transaccion t, receptor rep, bkhis h WHERE t.idtransaccion=h.idtransaccionh AND h.estadoth in ('Pendiente','Recibido') AND rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor AND t.idtransaccion='$idtransaccion'";
		return ejecutarConsultaSimpleFila($sql);
	}

//Implementar un método para mostrar los datos de un registro a modificar
	public function buscarRemitenteRellenarNuevo($nomcompleto)
	{
		if ($nomcompleto=='') {
			$nomcompleto='No existe este nombre';
		}
		//$sql="SELECT nomcompleto,tel,direccion,DNIremitente FROM remitentes WHERE nomcompleto LIKE '%$nomcompleto%'";
		$sql="SELECT nomcompleto,tel,direccion,DNIremitente FROM remitentes WHERE nomcompleto LIKE '%$nomcompleto%' AND estado='1' AND nomcompleto!='Administrador del sistema'";
		return ejecutarConsultaSimpleFila($sql);

	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function buscarReceptorRellenarNuevo($nomcompler)
	{
		if ($nomcompler=='') {
			$nomcompler='No existe este nombre';
		}

		$sql="SELECT idreceptor,nomcompler,telr,direccionr,DNIreceptor FROM receptor WHERE nomcompler LIKE '%$nomcompler%'";
		return ejecutarConsultaSimpleFila($sql);

	}

	//Implementar un método para listar los registros
	public function listarEnvios($agenciaEnvia)
	{
		$sql="SELECT t.idtransaccion,rem.nomcompleto,rem.tel,t.monto,t.comision,t.codigo,(select nombre from agencias WHERE idagencia=t.ageenvia) as agenciaA,rep.nomcompler,(select nombre from agencias WHERE idagencia=t.agerecibe) as agenciaB,t.fecrea,t.estadot FROM remitentes rem,transaccion t, receptor rep WHERE rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor AND t.ageenvia='$agenciaEnvia'";
		return ejecutarConsulta($sql);
	}

		//Implementar un método para listar los registros y mostrar en el select
	public function selectAgencias()
	{
		$sql="SELECT * FROM agencias";
		return ejecutarConsulta($sql);		
	}

			//Implementar un método para listar los registros y mostrar en el select
	public function selectAgenciaEmpleado($idempleado)
	{
		$sql="SELECT idagencia,nombre FROM agencias a,empleados e where a.idagencia=e.agencia_em AND e.idempleado='$idempleado'";
		return ejecutarConsulta($sql);		
	}

    // Implementar un metodo para listar agencias que no son del usuario
	public function selectAgenciaReceptora($agencia_em)
	{
		$sql="SELECT idagencia,nombre FROM agencias WHERE idagencia!='$agencia_em'";
		return ejecutarConsulta($sql);
	}

		//Implementar un método para filtar las comisiones
	public function comisiones($monto)
	{
		$sql="SELECT idTasas,comisiont FROM tasas WHERE Monto1<='$monto' AND Monto2>='$monto'";
		return ejecutarConsultaSimpleFila($sql);		
	}

			//Implementar un método para solicitar mooificacion en un envio erroneo
	public function smsSolicitud($idtransaccionsms,$descripcionsms,$mensaje,$monantes,$agente)
	{
		$sql="UPDATE transaccion SET estadot='Revalidar',descripcion='$descripcionsms' WHERE idtransaccion='$idtransaccionsms'";
		ejecutarConsulta($sql);
			// insercion de la transaccion o el mismo envio
		$sql="INSERT INTO solicitud  (`idsolicitud`, `transaccion`, `monantes`, `mondespues`, `agentcrea`, `agentmod`, `mensaje`, `fecrea`, `fevalidacion`) VALUES (NULL,'$idtransaccionsms','$monantes',NULL,'$agente',NULL,'$mensaje',now(),NULL)";
		return ejecutarConsulta($sql);

	}
				//Implementar un método para solicitar mooificacion en un envio erroneo
	public function Validacion($idtransaccionsms,$agente,$descripcionsms,$mensaje,$monantes,$mondespues)
	{
		$sql="UPDATE transaccion SET estadot='Revalidar',descripcion='$descripcionsms' WHERE idtransaccion='$idtransaccionsms'";
		return ejecutarConsulta($sql);
			// insercion de la transaccion o el mismo envio
		$sql="INSERT INTO solicitud  (`idsolicitud`, `transaccion`, `monantes`, `mondespues`, `agentcrea`, `agentmod`, `mensaje`, `fecrea`, `fevalidacion`) VALUES (NULL,'$idtransaccionsms',NULL,NULL,'$agente',NULL,'$mensaje',now())";
		return ejecutarConsulta($sql);

	}

		//Implementar un método para mostrar los datos del Ticket de una transaccion
	public function mostrarTicket($idtransaccion)
	{
		$sql="SELECT rem.nomcompleto as nombreremitente,rep.nomcompler as nombrereceptor,rem.tel as telefonorem,rep.telr as telefonorec,rem.direccion as dirremitente,rep.direccionr as dirreceptor,rem.DNIremitente,rep.DNIreceptor,t.tipo,(select nombre from agencias WHERE idagencia=t.ageenvia) as agenciaA,(select nombre from agencias WHERE idagencia=t.agerecibe) as agenciaB,t.monto,t.comision,t.descripcion,t.idtransaccion, rep.idreceptor,t.codigo,t.fecrea,t.agentcreat FROM remitentes rem,transaccion t, receptor rep WHERE rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor AND t.idtransaccion='$idtransaccion'";
		return ejecutarConsulta($sql);
	}

    		//Implementar un método para mostrar los datos del Ticket de una transaccion
	public function mostrarTicketRecibo($idtransaccion)
	{
		$sql="SELECT rem.nomcompleto as nombreremitente,rep.nomcompler as nombrereceptor,rem.tel as telefonorem,rep.telr as telefonorec,rem.direccion as dirremitente,rep.direccionr as dirreceptor,rem.DNIremitente,rep.DNIreceptor,t.tipo,(select nombre from agencias WHERE idagencia=t.ageenvia) as agenciaA,(select nombre from agencias WHERE idagencia=t.agerecibe) as agenciaB,t.monto,t.comision,t.descripcion,t.idtransaccion, rep.idreceptor,t.codigo,t.fecrea,t.agenmod FROM remitentes rem,transaccion t, receptor rep WHERE rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor AND t.idtransaccion='$idtransaccion'";
		return ejecutarConsulta($sql);
	}


		//Implementar un método para mostrar los datos del Ticket de una transaccion CASO DEL PRIMER ENVIO
	public function mostrarTicket2($codigo)
	{
		$sql="SELECT rem.nomcompleto as nombreremitente,rep.nomcompler as nombrereceptor,rem.tel as telefonorem,rep.telr as telefonorec,rem.direccion as dirremitente,rep.direccionr as dirreceptor,rem.DNIremitente,rep.DNIreceptor,t.tipo,(select nombre from agencias WHERE idagencia=t.ageenvia) as agenciaA,(select nombre from agencias WHERE idagencia=t.agerecibe) as agenciaB,t.monto,t.comision,t.descripcion,t.idtransaccion, rep.idreceptor,t.codigo,t.fecrea,t.agentcreat FROM remitentes rem,transaccion t, receptor rep WHERE rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor AND t.codigo='$codigo'";
		return ejecutarConsulta($sql);
	}


	/////////////////////////// RECIBOS INICIO /////////////////////////////////////////////////////////////////////
		//Implementar un método para listar los registros
	public function listarRecibos($agenciaRecibe)
	{
		$sql="SELECT t.idtransaccion,rem.nomcompleto,telr,direccionr,idreceptor,DNIreceptor,t.monto,t.comision,t.codigo,(select nombre from agencias WHERE idagencia=t.ageenvia) as agenciaA,rep.nomcompler,(select nombre from agencias WHERE idagencia=t.agerecibe) as agenciaB,t.fecrea,t.estadot FROM remitentes rem,transaccion t, receptor rep WHERE rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor AND t.agerecibe='$agenciaRecibe' AND t.estadot IN ('Pendiente','Recibido') ORDER BY t.fecrea DESC";
		return ejecutarConsulta($sql);
	}

		//Implementamos un método para editar registros
	public function editarRecibir($idtransaccion,$idreceptor,$nomcompler,$comision,$agencia,$telefonorec,$dirreceptor,$DNIreceptor,$descripcion,$agente,$idbkhis)
	{
		// Actualizamos receptor
		$sql="UPDATE receptor SET nomcompler='$nomcompler',telr='$telefonorec',direccionr='$dirreceptor',DNIreceptor='$DNIreceptor' WHERE idreceptor='$idreceptor'";
		 ejecutarConsulta($sql);
			// Actualizamos transaccion
		$sql="UPDATE transaccion SET descripcion='$descripcion',estadot='Recibido',agenmod='$agente',femodif=now() WHERE idtransaccion='$idtransaccion'";
		 ejecutarConsulta($sql);
		 		// Insertamos el registro de las comisiones a la contabilidad
		   $concepto="Comisiones de envio ".$agencia;
		   $observacion="Receptor ".$nomcompler;
		$sql="INSERT INTO ingresos_gastos (`iding_gas`, `concepto`, `monto`, `sentido`, `observacion`, `fecrea`, `agecrea`, `agentcrea`) VALUES (NULL,'$concepto','$comision','C','$observacion',now(),'$agencia','$agente')";
		ejecutarConsulta($sql);
		 // Actualizamos el estado de bkhis
		$sql="UPDATE bkhis SET estadoth='Recibido' WHERE idtransaccionh='$idtransaccion' AND idbkhis='$idbkhis'";
		return ejecutarConsulta($sql);
	}

}

?>