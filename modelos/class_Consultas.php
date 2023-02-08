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
	public function consultasEnviosFechaRemitente($fecha_inicio,$fecha_final,$DNIremitente,$pais,$agencia_em,$rol,$ap)
	{
		// CONTROL DEL ROL DEL USUARIO
		switch ($rol){
		
		case 'Agencia':
			$sql="SELECT rem.nomcompleto,rem.tel,t.monto,t.comision,t.codigo,
			(select nombre from agencias WHERE idagencia=t.ageenvia) as agenciaA,rep.nomcompler,
			(select nombre from agencias WHERE idagencia=t.agerecibe) as agenciaB,t.fecrea,t.estadot 
			FROM clientes rem,transaccion t, receptor rep 
			WHERE rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor 
			AND DATE(t.fecrea)>='$fecha_inicio' AND t.ageenvia='$agencia_em' AND t.codigo_ope='001'
			AND DATE(t.fecrea)<='$fecha_final' AND t.remitente='$DNIremitente'";
			return ejecutarConsulta($sql);
		break;

		default:
			$sql="SELECT rem.nomcompleto,rem.tel,t.monto,t.comision,t.codigo,
			(select nombre from agencias WHERE idagencia=t.ageenvia) as agenciaA,rep.nomcompler,
			(select nombre from agencias WHERE idagencia=t.agerecibe) as agenciaB,t.fecrea,t.estadot 
			FROM clientes rem,transaccion t, receptor rep 
			WHERE rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor AND DATE(t.fecrea)>='$fecha_inicio' AND DATE(t.fecrea)<='$fecha_final' AND t.remitente='$DNIremitente'";
			return ejecutarConsulta($sql);

		} // FIN SWITCH
	}



  //Implementar un método para listar los registros
	public function consultaOperacionesSimple($fecha_inicio,$fecha_final,$pais,$agencia_em,$rol,$ap)
	{
		// CONTROL DEL ROL DEL USUARIO
		switch ($rol){
		
		case 'Agencia':
			$sql="SELECT 
			(select nomcompleto FROM clientes c WHERE c.DNIremitente=t.remitente ) as nomcompletoRemitente,
			(select nomcompleto FROM clientes c WHERE c.DNIremitente=t.receptor ) as nomcompletoBeneficiario,
			t.cuenta_remi,t.cuenta_recep,t.monto,t.codigo,t.codigo_ope,t.sentido,
			CASE t.codigo_ope
			WHEN '000' THEN 'Creacion UV Banco'
				WHEN '002' THEN 'Venta UV'
				WHEN '003' THEN 'Restitucion UV'
				WHEN '004' THEN 'Aprovisionar Caja'
				WHEN '003' THEN 'DESAprovisionar Caja UV'
				WHEN '006' THEN 'Pago comisiones Agencia'
				WHEN '007' THEN 'Retiro comisiones Caja'
				WHEN '008' THEN 'Aprovisionar UV Comercial'
				WHEN '009' THEN 'Restituir UV Comercial'
				END AS codigo_ope_DESC,t.descripcion,
			(select nombre from agencias WHERE idagencia=t.ageenvia) as agenciaA,
			(select nombre from agencias WHERE idagencia=t.agerecibe) as agenciaB,t.agentcreat,
			t.fecrea,t.estadot 
			FROM transaccion t 
			WHERE DATE(t.fecrea)>='$fecha_inicio' AND t.ageenvia='$agencia_em' AND t.codigo_ope!='001'
			AND DATE(t.fecrea)<='$fecha_final' pais_origen='$pais' ";
			return ejecutarConsulta($sql);
		break;

		default:
			$sql="SELECT 
			(select nomcompleto FROM clientes c WHERE c.DNIremitente=t.remitente ) as nomcompletoRemitente,
			(select nomcompleto FROM clientes c WHERE c.DNIremitente=t.receptor ) as nomcompletoBeneficiario,
			t.cuenta_remi,t.cuenta_recep,t.monto,t.codigo,t.codigo_ope,t.sentido,
			CASE t.codigo_ope
			WHEN '000' THEN 'Creacion UV Banco'
				WHEN '002' THEN 'Venta UV'
				WHEN '003' THEN 'Restitucion UV'
				WHEN '004' THEN 'Aprovisionar Caja'
				WHEN '003' THEN 'DESAprovisionar Caja UV'
				WHEN '006' THEN 'Pago comisiones Agencia'
				WHEN '007' THEN 'Retiro comisiones Caja'
				WHEN '008' THEN 'Aprovisionar UV Comercial'
				WHEN '009' THEN 'Restituir UV Comercial'
				END AS codigo_ope_DESC,t.descripcion,
			t.descripcion,
			(select nombre from agencias WHERE idagencia=t.ageenvia) as agenciaA,
			(select nombre from agencias WHERE idagencia=t.agerecibe) as agenciaB,t.agentcreat,
			t.fecrea,t.estadot 
			FROM transaccion t 
			WHERE DATE(t.fecrea)>='$fecha_inicio' AND t.codigo_ope!='001'
			AND DATE(t.fecrea)<='$fecha_final'";
			return ejecutarConsulta($sql);

		} // FIN SWITCH
	}

	

	//Implementar un método para listar los registros
	public function consultaOperacionesCODIGO_OPE($fecha_inicio,$fecha_final,$codigo_ope,$pais,$agencia_em,$rol,$ap)
	{
		// CONTROL DEL ROL DEL USUARIO
		switch ($rol){
		
		case 'Agencia':
			$sql="SELECT 
			(select nomcompleto FROM clientes c WHERE c.DNIremitente=t.remitente ) as nomcompletoRemitente,
			(select nomcompleto FROM clientes c WHERE c.DNIremitente=t.receptor ) as nomcompletoBeneficiario,
			t.cuenta_remi,t.cuenta_recep,t.monto,t.codigo,t.codigo_ope,t.sentido,
			CASE t.codigo_ope
			WHEN '000' THEN 'Creacion UV Banco'
				WHEN '002' THEN 'Venta UV'
				WHEN '003' THEN 'Restitucion UV'
				WHEN '004' THEN 'Aprovisionar Caja'
				WHEN '003' THEN 'DESAprovisionar Caja UV'
				WHEN '006' THEN 'Pago comisiones Agencia'
				WHEN '007' THEN 'Retiro comisiones Caja'
				WHEN '008' THEN 'Aprovisionar UV Comercial'
				WHEN '009' THEN 'Restituir UV Comercial'
				END AS codigo_ope_DESC,t.descripcion,
			(select nombre from agencias WHERE idagencia=t.ageenvia) as agenciaA,
			(select nombre from agencias WHERE idagencia=t.agerecibe) as agenciaB,t.agentcreat,
			t.fecrea,t.estadot 
			FROM transaccion t 
			WHERE DATE(t.fecrea)>='$fecha_inicio' AND t.ageenvia='$agencia_em' AND t.codigo_ope!='001'
			AND DATE(t.fecrea)<='$fecha_final' pais_origen='$pais' AND t.codigo_ope='$codigo_ope' ";
			return ejecutarConsulta($sql);
		break;

		default:
			$sql="SELECT 
			(select nomcompleto FROM clientes c WHERE c.DNIremitente=t.remitente ) as nomcompletoRemitente,
			(select nomcompleto FROM clientes c WHERE c.DNIremitente=t.receptor ) as nomcompletoBeneficiario,
			t.cuenta_remi,t.cuenta_recep,t.monto,t.codigo,t.codigo_ope,t.sentido,
			CASE t.codigo_ope
			WHEN '000' THEN 'Creacion UV Banco'
				WHEN '002' THEN 'Venta UV'
				WHEN '003' THEN 'Restitucion UV'
				WHEN '004' THEN 'Aprovisionar Caja'
				WHEN '003' THEN 'DESAprovisionar Caja UV'
				WHEN '006' THEN 'Pago comisiones Agencia'
				WHEN '007' THEN 'Retiro comisiones Caja'
				WHEN '008' THEN 'Aprovisionar UV Comercial'
				WHEN '009' THEN 'Restituir UV Comercial'
				END AS codigo_ope_DESC,t.descripcion,
			(select nombre from agencias WHERE idagencia=t.ageenvia) as agenciaA,
			(select nombre from agencias WHERE idagencia=t.agerecibe) as agenciaB,t.agentcreat,
			t.fecrea,t.estadot 
			FROM transaccion t 
			WHERE DATE(t.fecrea)>='$fecha_inicio' AND t.codigo_ope!='001' AND t.codigo_ope='$codigo_ope'
			AND DATE(t.fecrea)<='$fecha_final'";
			return ejecutarConsulta($sql);

		} // FIN SWITCH
	}
	

//Implementar un método para listar los registros
	public function consultaOperacionesAGENCIA($fecha_inicio,$fecha_final,$agencia,$pais,$agencia_em,$rol,$ap)
	{
		// CONTROL DEL ROL DEL USUARIO
		switch ($rol){
		
		case 'Agencia':
			$sql="SELECT 
			(select nomcompleto FROM clientes c WHERE c.DNIremitente=t.remitente ) as nomcompletoRemitente,
			(select nomcompleto FROM clientes c WHERE c.DNIremitente=t.receptor ) as nomcompletoBeneficiario,
			t.cuenta_remi,t.cuenta_recep,t.monto,t.codigo,t.codigo_ope,t.sentido,
			CASE t.codigo_ope
			WHEN '000' THEN 'Creacion UV Banco'
				WHEN '002' THEN 'Venta UV'
				WHEN '003' THEN 'Restitucion UV'
				WHEN '004' THEN 'Aprovisionar Caja'
				WHEN '003' THEN 'DESAprovisionar Caja UV'
				WHEN '006' THEN 'Pago comisiones Agencia'
				WHEN '007' THEN 'Retiro comisiones Caja'
				WHEN '008' THEN 'Aprovisionar UV Comercial'
				WHEN '009' THEN 'Restituir UV Comercial'
				END AS codigo_ope_DESC,t.descripcion,
			(select nombre from agencias WHERE idagencia=t.ageenvia) as agenciaA,
			(select nombre from agencias WHERE idagencia=t.agerecibe) as agenciaB,t.agentcreat,
			t.fecrea,t.estadot 
			FROM transaccion t 
			WHERE DATE(t.fecrea)>='$fecha_inicio' AND t.ageenvia='$agencia_em' AND t.codigo_ope!='001'
			AND DATE(t.fecrea)<='$fecha_final' pais_origen='$pais' AND t.ageenvia='$agencia' ";
			return ejecutarConsulta($sql);
		break;

		default:
			$sql="SELECT 
			(select nomcompleto FROM clientes c WHERE c.DNIremitente=t.remitente ) as nomcompletoRemitente,
			(select nomcompleto FROM clientes c WHERE c.DNIremitente=t.receptor ) as nomcompletoBeneficiario,
			t.cuenta_remi,t.cuenta_recep,t.monto,t.codigo,t.codigo_ope,t.sentido,
			CASE t.codigo_ope
			WHEN '000' THEN 'Creacion UV Banco'
				WHEN '002' THEN 'Venta UV'
				WHEN '003' THEN 'Restitucion UV'
				WHEN '004' THEN 'Aprovisionar Caja'
				WHEN '003' THEN 'DESAprovisionar Caja UV'
				WHEN '006' THEN 'Pago comisiones Agencia'
				WHEN '007' THEN 'Retiro comisiones Caja'
				WHEN '008' THEN 'Aprovisionar UV Comercial'
				WHEN '009' THEN 'Restituir UV Comercial'
				END AS codigo_ope_DESC,t.descripcion,
			(select nombre from agencias WHERE idagencia=t.ageenvia) as agenciaA,
			(select nombre from agencias WHERE idagencia=t.agerecibe) as agenciaB,t.agentcreat,
			t.fecrea,t.estadot 
			FROM transaccion t 
			WHERE DATE(t.fecrea)>='$fecha_inicio' AND t.codigo_ope!='001' AND t.ageenvia='$agencia'
			AND DATE(t.fecrea)<='$fecha_final'";
			return ejecutarConsulta($sql);

		} // FIN SWITCH
	}


	//Implementar un método para listar los registros
	public function consultaOperacionesAP($fecha_inicio,$fecha_final,$apFil,$pais,$agencia_em,$rol,$ap)
	{
		// CONTROL DEL ROL DEL USUARIO
		switch ($rol){
		
		case 'Agencia':
			$sql="SELECT 
			(select nomcompleto FROM clientes c WHERE c.DNIremitente=t.remitente ) as nomcompletoRemitente,
			(select nomcompleto FROM clientes c WHERE c.DNIremitente=t.receptor ) as nomcompletoBeneficiario,
			t.cuenta_remi,t.cuenta_recep,t.monto,t.codigo,t.codigo_ope,t.sentido,
			CASE t.codigo_ope
			WHEN '000' THEN 'Creacion UV Banco'
				WHEN '002' THEN 'Venta UV'
				WHEN '003' THEN 'Restitucion UV'
				WHEN '004' THEN 'Aprovisionar Caja'
				WHEN '003' THEN 'DESAprovisionar Caja UV'
				WHEN '006' THEN 'Pago comisiones Agencia'
				WHEN '007' THEN 'Retiro comisiones Caja'
				WHEN '008' THEN 'Aprovisionar UV Comercial'
				WHEN '009' THEN 'Restituir UV Comercial'
				END AS codigo_ope_DESC,t.descripcion,
			(select nombre from agencias WHERE idagencia=t.ageenvia) as agenciaA,
			(select nombre from agencias WHERE idagencia=t.agerecibe) as agenciaB,t.agentcreat,
			t.fecrea,t.estadot 
			FROM transaccion t 
			WHERE DATE(t.fecrea)>='$fecha_inicio' AND t.ageenvia='$agencia_em' AND t.codigo_ope!='001'
			AND DATE(t.fecrea)<='$fecha_final' pais_origen='$pais' AND t.agentcreat='$apFil' ";
			return ejecutarConsulta($sql);
		break;

		default:
			$sql="SELECT 
			(select nomcompleto FROM clientes c WHERE c.DNIremitente=t.remitente ) as nomcompletoRemitente,
			(select nomcompleto FROM clientes c WHERE c.DNIremitente=t.receptor ) as nomcompletoBeneficiario,
			t.cuenta_remi,t.cuenta_recep,t.monto,t.codigo,t.codigo_ope,t.sentido,
			CASE t.codigo_ope
			WHEN '000' THEN 'Creacion UV Banco'
				WHEN '002' THEN 'Venta UV'
				WHEN '003' THEN 'Restitucion UV'
				WHEN '004' THEN 'Aprovisionar Caja'
				WHEN '003' THEN 'DESAprovisionar Caja UV'
				WHEN '006' THEN 'Pago comisiones Agencia'
				WHEN '007' THEN 'Retiro comisiones Caja'
				WHEN '008' THEN 'Aprovisionar UV Comercial'
				WHEN '009' THEN 'Restituir UV Comercial'
				END AS codigo_ope_DESC,t.descripcion,
			(select nombre from agencias WHERE idagencia=t.ageenvia) as agenciaA,
			(select nombre from agencias WHERE idagencia=t.agerecibe) as agenciaB,t.agentcreat,
			t.fecrea,t.estadot 
			FROM transaccion t 
			WHERE DATE(t.fecrea)>='$fecha_inicio' AND t.codigo_ope!='001' AND t.agentcreat='$apFil'
			AND DATE(t.fecrea)<='$fecha_final'";
			return ejecutarConsulta($sql);

		} // FIN SWITCH
	}


//Implementar un método para listar los registros
	public function consultaOperacionesFULL($fecha_inicio,$fecha_final,$codigo_ope,$agencia,$apFil,$pais,$agencia_em,$rol,$ap)
	{
		// CONTROL DEL ROL DEL USUARIO
		switch ($rol){
		
		case 'Agencia':
			$sql="SELECT 
			(select nomcompleto FROM clientes c WHERE c.DNIremitente=t.remitente ) as nomcompletoRemitente,
			(select nomcompleto FROM clientes c WHERE c.DNIremitente=t.receptor ) as nomcompletoBeneficiario,
			t.cuenta_remi,t.cuenta_recep,t.monto,t.codigo,t.codigo_ope,t.sentido,
			CASE t.codigo_ope
			WHEN '000' THEN 'Creacion UV Banco'
				WHEN '002' THEN 'Venta UV'
				WHEN '003' THEN 'Restitucion UV'
				WHEN '004' THEN 'Aprovisionar Caja'
				WHEN '003' THEN 'DESAprovisionar Caja UV'
				WHEN '006' THEN 'Pago comisiones Agencia'
				WHEN '007' THEN 'Retiro comisiones Caja'
				WHEN '008' THEN 'Aprovisionar UV Comercial'
				WHEN '009' THEN 'Restituir UV Comercial'
				END AS codigo_ope_DESC,t.descripcion,
			(select nombre from agencias WHERE idagencia=t.ageenvia) as agenciaA,
			(select nombre from agencias WHERE idagencia=t.agerecibe) as agenciaB,t.agentcreat,
			t.fecrea,t.estadot 
			FROM transaccion t 
			WHERE DATE(t.fecrea)>='$fecha_inicio' AND t.ageenvia='$agencia_em' AND t.codigo_ope!='001'
			AND DATE(t.fecrea)<='$fecha_final' pais_origen='$pais' 
			AND t.agentcreat='$apFil' AND t.ageenvia='$agencia' AND t.codigo_ope='$codigo_ope' ";
			return ejecutarConsulta($sql);
		break;

		default:
			$sql="SELECT 
			(select nomcompleto FROM clientes c WHERE c.DNIremitente=t.remitente ) as nomcompletoRemitente,
			(select nomcompleto FROM clientes c WHERE c.DNIremitente=t.receptor ) as nomcompletoBeneficiario,
			t.cuenta_remi,t.cuenta_recep,t.monto,t.codigo,t.codigo_ope,t.sentido,
			CASE t.codigo_ope
			WHEN '000' THEN 'Creacion UV Banco'
				WHEN '002' THEN 'Venta UV'
				WHEN '003' THEN 'Restitucion UV'
				WHEN '004' THEN 'Aprovisionar Caja'
				WHEN '003' THEN 'DESAprovisionar Caja UV'
				WHEN '006' THEN 'Pago comisiones Agencia'
				WHEN '007' THEN 'Retiro comisiones Caja'
				WHEN '008' THEN 'Aprovisionar UV Comercial'
				WHEN '009' THEN 'Restituir UV Comercial'
				END AS codigo_ope_DESC,t.descripcion,
			(select nombre from agencias WHERE idagencia=t.ageenvia) as agenciaA,
			(select nombre from agencias WHERE idagencia=t.agerecibe) as agenciaB,t.agentcreat,
			t.fecrea,t.estadot 
			FROM transaccion t 
			WHERE DATE(t.fecrea)>='$fecha_inicio' AND t.codigo_ope!='001' 
			AND t.agentcreat='$apFil' AND t.ageenvia='$agencia' AND t.codigo_ope='$codigo_ope'
			AND DATE(t.fecrea)<='$fecha_final'";
			return ejecutarConsulta($sql);

		} // FIN SWITCH
	}


//Implementar un método para listar los registros
	public function consultaOperacionesMENOS_OPE($fecha_inicio,$fecha_final,$agencia,$apFil,$pais,$agencia_em,$rol,$ap)
	{
		// CONTROL DEL ROL DEL USUARIO
		switch ($rol){
		
		case 'Agencia':
			$sql="SELECT 
			(select nomcompleto FROM clientes c WHERE c.DNIremitente=t.remitente ) as nomcompletoRemitente,
			(select nomcompleto FROM clientes c WHERE c.DNIremitente=t.receptor ) as nomcompletoBeneficiario,
			t.cuenta_remi,t.cuenta_recep,t.monto,t.codigo,t.codigo_ope,t.sentido,
			CASE t.codigo_ope
			WHEN '000' THEN 'Creacion UV Banco'
				WHEN '002' THEN 'Venta UV'
				WHEN '003' THEN 'Restitucion UV'
				WHEN '004' THEN 'Aprovisionar Caja'
				WHEN '003' THEN 'DESAprovisionar Caja UV'
				WHEN '006' THEN 'Pago comisiones Agencia'
				WHEN '007' THEN 'Retiro comisiones Caja'
				WHEN '008' THEN 'Aprovisionar UV Comercial'
				WHEN '009' THEN 'Restituir UV Comercial'
				END AS codigo_ope_DESC,t.descripcion,
			(select nombre from agencias WHERE idagencia=t.ageenvia) as agenciaA,
			(select nombre from agencias WHERE idagencia=t.agerecibe) as agenciaB,t.agentcreat,
			t.fecrea,t.estadot 
			FROM transaccion t 
			WHERE DATE(t.fecrea)>='$fecha_inicio' AND t.ageenvia='$agencia_em' AND t.codigo_ope!='001'
			AND DATE(t.fecrea)<='$fecha_final' pais_origen='$pais' 
			AND t.agentcreat='$apFil' AND t.ageenvia='$agencia' ";
			return ejecutarConsulta($sql);
		break;

		default:
			$sql="SELECT 
			(select nomcompleto FROM clientes c WHERE c.DNIremitente=t.remitente ) as nomcompletoRemitente,
			(select nomcompleto FROM clientes c WHERE c.DNIremitente=t.receptor ) as nomcompletoBeneficiario,
			t.cuenta_remi,t.cuenta_recep,t.monto,t.codigo,t.codigo_ope,t.sentido,
			CASE t.codigo_ope
			WHEN '000' THEN 'Creacion UV Banco'
				WHEN '002' THEN 'Venta UV'
				WHEN '003' THEN 'Restitucion UV'
				WHEN '004' THEN 'Aprovisionar Caja'
				WHEN '003' THEN 'DESAprovisionar Caja UV'
				WHEN '006' THEN 'Pago comisiones Agencia'
				WHEN '007' THEN 'Retiro comisiones Caja'
				WHEN '008' THEN 'Aprovisionar UV Comercial'
				WHEN '009' THEN 'Restituir UV Comercial'
				END AS codigo_ope_DESC,t.descripcion,.ageenvia) as agenciaA,
			(select nombre from agencias WHERE idagencia=t.agerecibe) as agenciaB,t.agentcreat,
			t.fecrea,t.estadot 
			FROM transaccion t 
			WHERE DATE(t.fecrea)>='$fecha_inicio' AND t.codigo_ope!='001' 
			AND t.agentcreat='$apFil' AND t.ageenvia='$agencia'
			AND DATE(t.fecrea)<='$fecha_final'";
			return ejecutarConsulta($sql);

		} // FIN SWITCH
	}

	//Implementar un método para listar los registros
	public function consultaOperacionesMENOS_AP($fecha_inicio,$fecha_final,$codigo_ope,$agencia,$pais,$agencia_em,$rol,$ap)
	{
		// CONTROL DEL ROL DEL USUARIO
		switch ($rol){
		
		case 'Agencia':
			$sql="SELECT 
			(select nomcompleto FROM clientes c WHERE c.DNIremitente=t.remitente ) as nomcompletoRemitente,
			(select nomcompleto FROM clientes c WHERE c.DNIremitente=t.receptor ) as nomcompletoBeneficiario,
			t.cuenta_remi,t.cuenta_recep,t.monto,t.codigo,t.codigo_ope,t.sentido,
			CASE t.codigo_ope
			WHEN '000' THEN 'Creacion UV Banco'
				WHEN '002' THEN 'Venta UV'
				WHEN '003' THEN 'Restitucion UV'
				WHEN '004' THEN 'Aprovisionar Caja'
				WHEN '003' THEN 'DESAprovisionar Caja UV'
				WHEN '006' THEN 'Pago comisiones Agencia'
				WHEN '007' THEN 'Retiro comisiones Caja'
				WHEN '008' THEN 'Aprovisionar UV Comercial'
				WHEN '009' THEN 'Restituir UV Comercial'
				END AS codigo_ope_DESC,t.descripcion,
			(select nombre from agencias WHERE idagencia=t.ageenvia) as agenciaA,
			(select nombre from agencias WHERE idagencia=t.agerecibe) as agenciaB,t.agentcreat,
			t.fecrea,t.estadot 
			FROM transaccion t 
			WHERE DATE(t.fecrea)>='$fecha_inicio' AND t.ageenvia='$agencia_em' AND t.codigo_ope!='001'
			AND DATE(t.fecrea)<='$fecha_final' pais_origen='$pais' 
			AND t.ageenvia='$agencia' AND t.codigo_ope='$codigo_ope' ";
			return ejecutarConsulta($sql);
		break;

		default:
			$sql="SELECT 
			(select nomcompleto FROM clientes c WHERE c.DNIremitente=t.remitente ) as nomcompletoRemitente,
			(select nomcompleto FROM clientes c WHERE c.DNIremitente=t.receptor ) as nomcompletoBeneficiario,
			t.cuenta_remi,t.cuenta_recep,t.monto,t.codigo,t.codigo_ope,t.sentido,
			CASE t.codigo_ope
			WHEN '000' THEN 'Creacion UV Banco'
				WHEN '002' THEN 'Venta UV'
				WHEN '003' THEN 'Restitucion UV'
				WHEN '004' THEN 'Aprovisionar Caja'
				WHEN '003' THEN 'DESAprovisionar Caja UV'
				WHEN '006' THEN 'Pago comisiones Agencia'
				WHEN '007' THEN 'Retiro comisiones Caja'
				WHEN '008' THEN 'Aprovisionar UV Comercial'
				WHEN '009' THEN 'Restituir UV Comercial'
				END AS codigo_ope_DESC,t.descripcion,
			(select nombre from agencias WHERE idagencia=t.ageenvia) as agenciaA,
			(select nombre from agencias WHERE idagencia=t.agerecibe) as agenciaB,t.agentcreat,
			t.fecrea,t.estadot 
			FROM transaccion t 
			WHERE DATE(t.fecrea)>='$fecha_inicio' AND t.codigo_ope!='001' 
			AND t.ageenvia='$agencia' AND t.codigo_ope='$codigo_ope'
			AND DATE(t.fecrea)<='$fecha_final'";
			return ejecutarConsulta($sql);

		} // FIN SWITCH
	}


	//Implementar un método para listar los registros
	public function consultaOperacionesMENOS_AGENCIA($fecha_inicio,$fecha_final,$codigo_ope,$apFil,$pais,$agencia_em,$rol,$ap)
	{
		// CONTROL DEL ROL DEL USUARIO
		switch ($rol){
		
		case 'Agencia':
			$sql="SELECT 
			(select nomcompleto FROM clientes c WHERE c.DNIremitente=t.remitente ) as nomcompletoRemitente,
			(select nomcompleto FROM clientes c WHERE c.DNIremitente=t.receptor ) as nomcompletoBeneficiario,
			t.cuenta_remi,t.cuenta_recep,t.monto,t.codigo,t.codigo_ope,t.sentido,
			CASE t.codigo_ope
			WHEN '000' THEN 'Creacion UV Banco'
			WHEN '000' THEN 'Creacion UV Banco'
				WHEN '002' THEN 'Venta UV'
				WHEN '003' THEN 'Restitucion UV'
				WHEN '004' THEN 'Aprovisionar Caja'
				WHEN '003' THEN 'DESAprovisionar Caja UV'
				WHEN '006' THEN 'Pago comisiones Agencia'
				WHEN '007' THEN 'Retiro comisiones Caja'
				WHEN '008' THEN 'Aprovisionar UV Comercial'
				WHEN '009' THEN 'Restituir UV Comercial'
				END AS codigo_ope_DESC,t.descripcion,
			(select nombre from agencias WHERE idagencia=t.ageenvia) as agenciaA,
			(select nombre from agencias WHERE idagencia=t.agerecibe) as agenciaB,t.agentcreat,
			t.fecrea,t.estadot 
			FROM transaccion t 
			WHERE DATE(t.fecrea)>='$fecha_inicio' AND t.ageenvia='$agencia_em' AND t.codigo_ope!='001'
			AND DATE(t.fecrea)<='$fecha_final' pais_origen='$pais' 
			AND t.agentcreat='$apFil' AND t.codigo_ope='$codigo_ope' ";
			return ejecutarConsulta($sql);
		break;

		default:
			$sql="SELECT 
			(select nomcompleto FROM clientes c WHERE c.DNIremitente=t.remitente ) as nomcompletoRemitente,
			(select nomcompleto FROM clientes c WHERE c.DNIremitente=t.receptor ) as nomcompletoBeneficiario,
			t.cuenta_remi,t.cuenta_recep,t.monto,t.codigo,t.codigo_ope,t.sentido,
			CASE t.codigo_ope
			WHEN '000' THEN 'Creacion UV Banco'
				WHEN '002' THEN 'Venta UV'
				WHEN '003' THEN 'Restitucion UV'
				WHEN '004' THEN 'Aprovisionar Caja'
				WHEN '003' THEN 'DESAprovisionar Caja UV'
				WHEN '006' THEN 'Pago comisiones Agencia'
				WHEN '007' THEN 'Retiro comisiones Caja'
				WHEN '008' THEN 'Aprovisionar UV Comercial'
				WHEN '009' THEN 'Restituir UV Comercial'
				END AS codigo_ope_DESC,t.descripcion,
			(select nombre from agencias WHERE idagencia=t.ageenvia) as agenciaA,
			(select nombre from agencias WHERE idagencia=t.agerecibe) as agenciaB,t.agentcreat,
			t.fecrea,t.estadot 
			FROM transaccion t 
			WHERE DATE(t.fecrea)>='$fecha_inicio' AND t.codigo_ope!='001' 
			AND t.agentcreat='$apFil' AND t.codigo_ope='$codigo_ope'
			AND DATE(t.fecrea)<='$fecha_final'";
			return ejecutarConsulta($sql);

		} // FIN SWITCH
	}






	public function consultasEnviosFechas($fecha_inicio,$fecha_final,$pais,$agencia_em,$rol,$ap)
		{
			// CONTROL DEL ROL DEL USUARIO
			switch ($rol){
			
	
			case 'Agencia':
				$sql="SELECT rem.nomcompleto,rem.tel,t.monto,t.comision,t.codigo,
				(select nombre from agencias WHERE idagencia=t.ageenvia) as agenciaA,rep.nomcompler,
				(select nombre from agencias WHERE idagencia=t.agerecibe) as agenciaB,t.fecrea,t.estadot 
				FROM clientes rem,transaccion t, receptor rep 
				WHERE rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor
				AND t.ageenvia='$agencia_em' AND t.codigo_ope='001'
				AND DATE(t.fecrea)>='$fecha_inicio' AND DATE(t.fecrea)<='$fecha_final'";
				return ejecutarConsulta($sql);
			 break;

			 default:
			 $sql="SELECT rem.nomcompleto,rem.tel,t.monto,t.comision,t.codigo,
				(select nombre from agencias WHERE idagencia=t.ageenvia) as agenciaA,rep.nomcompler,
				(select nombre from agencias WHERE idagencia=t.agerecibe) as agenciaB,t.fecrea,t.estadot 
				FROM clientes rem,transaccion t, receptor rep 
				WHERE rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor 
				AND DATE(t.fecrea)>='$fecha_inicio' AND DATE(t.fecrea)<='$fecha_final'";
				return ejecutarConsulta($sql);
		
			  } // FIN SWITCH
	}


	/////////////////////////// RECIBOS INICIO /////////////////////////////////////////////////////////777
		//Implementar un método para listar los registros
	public function consultasRecibosFechaRemitente($fecha_inicio,$fecha_final,$DNIremitente,$pais,$agencia_em,$rol,$ap)
	{
		// CONTROL DEL ROL DEL USUARIO
		switch ($rol){
		

			case 'Agencia':

				$sql="SELECT rem.nomcompleto,telr,direccionr,idreceptor,
				(select DNIreceptorh FROM bkhis h WHERE h.idtransaccionh=t.idtransaccion AND h.codigoh=t.codigo) as DNIreceptor, 
				t.monto,t.comision,t.codigo,
				(select nombre from agencias WHERE idagencia=t.ageenvia) as agenciaA,rep.nomcompler,
				(select nombre from agencias WHERE idagencia=t.agerecibe) as agenciaB,
				t.fecrea,t.estadot FROM clientes rem,transaccion t, receptor rep 
				WHERE rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor 
				AND t.estadot IN ('Recibido') AND DATE(t.fecrea)>='$fecha_inicio' 
				AND DATE(t.fecrea)<='$fecha_final' AND t.remitente='$DNIremitente'
				AND t.agerecibe='$agencia_em' AND t.codigo_ope='001'
				ORDER BY t.fecrea DESC";
				return ejecutarConsulta($sql);
			break;

			default:
			$sql="SELECT rem.nomcompleto,telr,direccionr,idreceptor,
			(select DNIreceptorh FROM bkhis h WHERE h.idtransaccionh=t.idtransaccion AND h.codigoh=t.codigo) as DNIreceptor, 
			t.monto,t.comision,t.codigo,
			(select nombre from agencias WHERE idagencia=t.ageenvia) as agenciaA,rep.nomcompler,
			(select nombre from agencias WHERE idagencia=t.agerecibe) as agenciaB,
			t.fecrea,t.estadot FROM clientes rem,transaccion t, receptor rep 
			WHERE rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor AND t.codigo_ope='001' 
			AND t.estadot IN ('Recibido') AND DATE(t.fecrea)>='$fecha_inicio' 
			AND DATE(t.fecrea)<='$fecha_final' AND t.remitente='$DNIremitente' ORDER BY t.fecrea DESC";
			return ejecutarConsulta($sql);
	
			} // FIN SWITCH

	}



		public function consultasRecibosFechas($fecha_inicio,$fecha_final,$pais,$agencia_em,$rol)
		{
			// CONTROL DEL ROL DEL USUARIO
			switch ($rol){
			
	
				case 'Agencia':
				
					$sql="SELECT rem.nomcompleto,telr,direccionr,idreceptor, 
					(select DNIreceptorh FROM bkhis h WHERE h.idtransaccionh=t.idtransaccion AND h.codigoh=t.codigo) as DNIreceptor, 
					t.monto,t.comision,t.codigo, (select nombre from agencias WHERE idagencia=t.ageenvia) as agenciaA,
					rep.nomcompler, (select nombre from agencias WHERE idagencia=t.agerecibe) as agenciaB,t.fecrea,
					t.estadot FROM clientes rem,transaccion t, receptor rep WHERE rem.DNIremitente=t.remitente 
					AND t.receptor=rep.idreceptor AND t.estadot IN ('Recibido') AND t.codigo_ope='001'
					AND t.agerecibe='$agencia_em'
					AND DATE(t.fecrea)>='$fecha_inicio' AND DATE(t.fecrea)<='$fecha_final' ORDER BY t.fecrea DESC";
					return ejecutarConsulta($sql);
				break;
				default:
				$sql="SELECT rem.nomcompleto,telr,direccionr,idreceptor, 
					(select DNIreceptorh FROM bkhis h WHERE h.idtransaccionh=t.idtransaccion AND h.codigoh=t.codigo) as DNIreceptor, 
					t.monto,t.comision,t.codigo, (select nombre from agencias WHERE idagencia=t.ageenvia) as agenciaA,
					rep.nomcompler, (select nombre from agencias WHERE idagencia=t.agerecibe) as agenciaB,t.fecrea,
					t.estadot FROM clientes rem,transaccion t, receptor rep WHERE rem.DNIremitente=t.remitente 
					AND t.receptor=rep.idreceptor AND t.estadot IN ('Recibido') AND t.codigo_ope='001'
					AND DATE(t.fecrea)>='$fecha_inicio' AND DATE(t.fecrea)<='$fecha_final' ORDER BY t.fecrea DESC";
					return ejecutarConsulta($sql);
			} // FINC WITCH

	}


		public function totalenvios($pais,$agencia_em,$rol,$ap)

		{
             // ageenvia Y agerecibe
				$sql="SELECT IFNULL(SUM(monto),0) as monto FROM clientes rem,transaccion t, receptor rep 
				WHERE rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor 
				AND t.codigo_ope='001' AND t.estadot IN ('Pendiente','Recibido')
				AND t.ageenvia='$agencia_em'";
				return ejecutarConsulta($sql);
	

	
	}

		public function totalenviosHOY($pais,$agencia_em,$rol,$ap)
	{
		$sql="SELECT IFNULL(SUM(monto),0) as monto FROM clientes rem,transaccion t, receptor rep 
		WHERE rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor 
		AND t.codigo_ope='001'
		AND t.estadot IN ('Pendiente','Recibido') AND DATE(t.fecrea)=curdate()
		AND t.ageenvia='$agencia_em'";
		return ejecutarConsulta($sql);
	}

		public function totalrecibos($pais,$agencia_em,$rol,$ap)
	{
		$sql="SELECT IFNULL(SUM(monto),0) as monto FROM clientes rem,transaccion t, receptor rep 
		WHERE rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor 
		AND t.codigo_ope='001' 
		AND t.estadot='Recibido' AND t.agerecibe='$agencia_em'";
		return ejecutarConsulta($sql);
	}


		public function totalrecibosHOY($pais,$agencia_em,$rol,$ap)
	{
		$sql="SELECT IFNULL(SUM(monto),0) as monto FROM clientes rem,transaccion t, receptor rep 
		WHERE rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor 
		AND t.codigo_ope='001' 
		AND t.estadot='Recibido' AND DATE(t.fecrea)=curdate() AND t.agerecibe='$agencia_em'";
		return ejecutarConsulta($sql);
	}

			public function totalcomisionesMLINE($pais,$agencia_em,$rol,$ap)
	{
		$sql="SELECT IFNULL(SUM(comi_empre),0) as monto FROM clientes rem,transaccion t, receptor rep 
		WHERE rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor
		AND t.codigo_ope='001'
		AND t.estadot IN ('Pendiente','Recibido')";
		return ejecutarConsulta($sql);
	}

			public function totalcomisionesEnvio($pais,$agencia_em,$rol,$ap)
	{
		$sql="SELECT IFNULL(SUM(comi_remi),0) as monto FROM clientes rem,transaccion t, receptor rep 
		WHERE rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor
		AND t.codigo_ope='001'
		AND t.estadot IN ('Pendiente','Recibido') AND t.ageenvia='$agencia_em'";
		return ejecutarConsulta($sql);
	}

		public function totalcomisionesRetitos($pais,$agencia_em,$rol,$ap)
	{
		$sql="SELECT IFNULL(SUM(comi_benef),0) as monto FROM clientes rem,transaccion t, receptor rep 
		WHERE rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor
		AND t.codigo_ope='001'
		AND t.estadot IN ('Pendiente','Recibido') AND t.agerecibe='$agencia_em'";
		return ejecutarConsulta($sql);
	}


		public function totalcomisionesHOYEnvios($pais,$agencia_em,$rol,$ap)
	{
		$sql="SELECT IFNULL(SUM(comision),0) as monto FROM clientes rem,transaccion t, receptor rep 
		WHERE rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor 
		AND t.estadot IN ('Pendiente','Recibido') 
		AND DATE(t.fecrea)=curdate() AND t.ageenvia='$agencia_em'";
		return ejecutarConsulta($sql);
	}


	public function totalcomisionesHOYRetiros($pais,$agencia_em,$rol,$ap)
	{
		$sql="SELECT IFNULL(SUM(comision),0) as monto FROM clientes rem,transaccion t, receptor rep 
		WHERE rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor 
		AND t.estadot IN ('Pendiente','Recibido') 
		AND DATE(t.fecrea)=curdate() AND t.agerecibe='$agencia_em'";
		return ejecutarConsulta($sql);
	}

	 public function totalcomisionesGENERALES($pais,$agencia_em,$rol,$ap)
	{
		$sql="SELECT IFNULL(SUM(comision),0) as monto FROM clientes rem,transaccion t, receptor rep 
		WHERE rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor
		AND t.codigo_ope='001'
		AND t.estadot IN ('Pendiente','Recibido') AND t.ageenvia='$agencia_em'";
		return ejecutarConsulta($sql);
	}
	

	 public function totalIVA()
	{
		$sql="SELECT IFNULL(SUM(IVA),0) as monto FROM clientes rem,transaccion t, receptor rep 
		WHERE rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor
		AND t.codigo_ope='001'
		AND t.estadot IN ('Pendiente','Recibido')";
		return ejecutarConsulta($sql);
	}

	 public function totalSaldoCAPITAL()
	{
		$sql="SELECT saldo as monto FROM `cuentas` 
		WHERE firma='INTERNA' AND tipo_cuenta='CUENTA_CAPITAL'";
		return ejecutarConsulta($sql);
	}
	////////////////////////  GRAFICAS  ///////////////////////////////////////

		public function totalenviosUltimos_10dias($pais,$agencia_em,$rol,$ap)
	{
		$sql="SELECT CONCAT(DAY(t.fecrea),'-',MONTH(t.fecrea)) as fecha,SUM(monto) as total FROM clientes rem,
		transaccion t, receptor rep WHERE rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor 
		AND t.estadot IN ('Pendiente','Recibido') AND t.ageenvia='$agencia_em'
		GROUP BY t.fecrea ORDER BY t.fecrea DESC limit 0,10";
		return ejecutarConsulta($sql);
	}

		public function totalrecibosUltimos_10dias($pais,$agencia_em,$rol,$ap)
	{
		$sql="SELECT CONCAT(DAY(t.fecrea),'-',MONTH(t.fecrea)) as fecha,SUM(monto) as total FROM clientes rem,
		transaccion t, receptor rep 
		WHERE rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor 
		AND t.estadot IN ('Recibido')AND t.ageenvia='$agencia_em'
		GROUP BY t.fecrea ORDER BY t.fecrea DESC limit 0,10";
		return ejecutarConsulta($sql);
	}

	  /*public function ClientesMasEnvios()
	{
		$sql="SELECT rem.nomcompleto,SUM(monto) as total FROM clientes rem,transaccion t, receptor rep WHERE rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor AND t.estadot IN ('Pendiente','Recibido') GROUP BY rem.nomcompleto ORDER BY rem.nomcompleto DESC limit 0,20";
		return ejecutarConsulta($sql);
	}


	public function CompaniaMasBilletes()
	{
		$sql="SELECT company, count(idbillete) as totalB FROM billetes GROUP BY company ORDER BY company DESC limit 0,20";
		return ejecutarConsulta($sql);
	}*/





			//Implementar un método para listar los registros y mostrar en el select
	public function selectRemitente()
	{
		$sql="SELECT DNIremitente, nomcompleto FROM clientes";
		return ejecutarConsulta($sql);	
	}


}

?>