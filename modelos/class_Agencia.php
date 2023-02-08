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
	public function insertar($nombre,$descripcion,$pais,$ciudad,$max_cajas,$ncp,$ncpComisiones,$responsable,$responsableMline,$agente)
	{ 
		
		$sql="INSERT INTO agencias (`idagencia`, `nombre`, `descripcion`,`pais`,`ciudad`, `max_cajas`,
									`ncp`,`ncpComisiones`, `responsable`,`responsableMline`,`agentcrea`, `fecrea`) 
					VALUES (NULL,'$nombre','$descripcion','$pais','$ciudad','$max_cajas','$ncp','$ncpComisiones','$responsable','$responsableMline','$agente',now())";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idagencia,$nombre,$descripcion,$pais,$ciudad,$max_cajas,$ncp,$ncpComisiones,$responsable,$responsableMline,$agente)
	{
		$sql="UPDATE agencias SET nombre='$nombre',descripcion='$descripcion',pais='$pais',ciudad='$ciudad',
								 ncp='$ncp',ncpComisiones='$ncpComisiones',responsable='$responsable',responsableMline='$responsableMline',max_cajas='$max_cajas',agemodif='$agente',femodif=now()
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
		$sql="SELECT idagencia,nombre,descripcion,pais,ciudad,max_cajas,ncp,ncpComisiones,
		responsable,responsableMline FROM agencias WHERE idagencia='$idagencia'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar($pais,$agencia_em,$rol,$ap)
	{
		// CONTROL DEL ROL DEL USUARIO
		switch ($rol){
		

			case 'Agencia':
				$sql="SELECT idagencia, nombre,descripcion,
						(SELECT nombre FROM paises WHERE idPais=pais) as pais_nombre,
						(SELECT nomcompleto FROM empleados e, clientes r WHERE e.DNI=r.DNIremitente AND ap=responsable) as responsable_nombre,
						(SELECT nomcompleto FROM empleados e,clientes r WHERE e.DNI=r.DNIremitente AND ap=responsableMline) as responsable_Mline,
						ciudad,max_cajas,ncp,ncpComisiones,
						(SELECT saldo FROM cuentas c WHERE c.numerocuenta=ncp) as ncpCorrienteSaldo, 
						(SELECT saldo FROM cuentas c WHERE c.numerocuenta=ncpComisiones) as ncpComisionesSaldo,
						responsable,responsableMline,agentcrea,fecrea 
				FROM agencias WHERE eliminado=0 AND pais='$pais' AND responsable='$ap'";
				return ejecutarConsulta($sql);
			break;

			default:
			$sql="SELECT idagencia, nombre,descripcion,
							(SELECT nombre FROM paises WHERE idPais=pais) as pais_nombre,
							(SELECT nomcompleto FROM empleados e, clientes r WHERE e.DNI=r.DNIremitente AND ap=responsable) as responsable_nombre,
							(SELECT nomcompleto FROM empleados e,clientes r WHERE e.DNI=r.DNIremitente AND ap=responsableMline) as responsable_Mline,
							ciudad,max_cajas,ncp,ncpComisiones,
							(SELECT saldo FROM cuentas c WHERE c.numerocuenta=ncp) as ncpCorrienteSaldo, 
							(SELECT saldo FROM cuentas c WHERE c.numerocuenta=ncpComisiones) as ncpComisionesSaldo,
							responsable,responsableMline,agentcrea,fecrea 
							FROM agencias WHERE eliminado=0";
			return ejecutarConsulta($sql);


		} // FIN SWITCH
	}


	//Implementar un método PARA PONER SALDOS EN EL HEADER Y EN LOS INPUTS DEL FORMULARIO DEL HERADER
	public function ponerNCPySaldo($agente)
	{
		
            $sql="SELECT numerocuenta,c.pais, saldo FROM clientes a, cuentas b, empleados c 
            WHERE a.DNIremitente=b.cliente AND a.DNIremitente=c.DNI AND c.ap='$agente' AND b.tipo_cuenta='CUENTA_CORRIENTE'";
            return ejecutarConsultaSimpleFila($sql);	
        	
	}

	  //Implementar un método para filtar 
	  public function buscarNCPcliente($cliente, $tipo)
	  {
		  
		  if ($tipo==5 || $tipo==6 ) {
  
			  $sql="SELECT numerocuenta,pais, saldo FROM clientes a, cuentas b WHERE a.DNIremitente=b.cliente AND a.DNIremitente='$cliente' AND b.tipo_cuenta='CUENTA_COMISIONES'";
			  return ejecutarConsultaSimpleFila($sql);
		  } else {
			  $sql="SELECT numerocuenta,pais, saldo FROM clientes a, cuentas b WHERE a.DNIremitente=b.cliente AND a.DNIremitente='$cliente' AND b.tipo_cuenta='CUENTA_CORRIENTE'";
			  return ejecutarConsultaSimpleFila($sql);	
		  }
			  
	  }
	//Implementar un método para filtar 
	  public function verificarSaldo($clienteremitente,$ncpremitente)
	  {
		  $sql="SELECT numerocuenta,saldo FROM clientes a, cuentas b WHERE a.DNIremitente=b.cliente AND a.DNIremitente='$clienteremitente' AND b.numerocuenta='$ncpremitente'";
		  return ejecutarConsulta($sql);		
	  }
  
		  //Implementamos un método para insertar registros
	  public function insertarDineroEnAgencia($referencia,$clienteremitente,$clientebeneficiario,$paisorigen,$paisdestino,$agenciaremitente,$ncpremitente,
	  $agenciabeneficiaria,$ncpbeneficiaria,$monto,$saldoRemitenteRestante,$saldoBeneficiarioResultante,$tipo,$codigo,$descripcion,$idAgenciaOP,$agente)
	  { 
  
		  // Insertar de una Agencia caja PARA LINEA DE CAJA SENTIDO CREDITO
		 $sql="INSERT INTO `transaccion`(`idtransaccion`, `referencia`, `remitente`, `cuenta_remi`, `receptor`, 
							`cuenta_recep`, `ageenvia`, `agerecibe`, `pais_origen`, `pais_destino`, `tipo`, `monto`,`cobrar`,
							 `comision`, `comi_empre`, `comi_remi`, `comi_benef`, `IVA`, `saldo_rescuenta`, `codigo`,
							 `codigo_ope`, `sentido`, `descripcion`, `secreto`, `sms_mobil`, `estadot`, `objeto`, `agentcreat`,
							  `agenmod`, `fecrea`, `femodif`)
					   VALUES (NULL,'$referencia','$clienteremitente', '$ncpremitente', '$clientebeneficiario','$ncpbeneficiaria',
					   '$agenciaremitente','$agenciabeneficiaria','$paisorigen','$paisdestino','$tipo','$monto',NULL, NULL,
					   NULL, NULL, NULL, NULL, NULL,'$codigo','002','C','$descripcion',NULL,'sin sms movil','Recibido','$idAgenciaOP',
						'$agente', NULL, now(), NULL)";
		 //var_dump($sql);
		   ejecutarConsulta($sql);
		   
		  // Actualizar SALDO NCP REMITENTE
		  $sql="UPDATE `cuentas` SET `saldo`='$saldoRemitenteRestante',`femovimiento`=now()
								 WHERE numerocuenta='$ncpremitente'";
		  ejecutarConsulta($sql);
				  // Actualizar SALDO NCP BENEFICIARIO
		  $sql="UPDATE `cuentas` SET `saldo`='$saldoBeneficiarioResultante',`femovimiento`=now()
								 WHERE numerocuenta='$ncpbeneficiaria'";
		  ejecutarConsulta($sql); 

		  				  // Insertar de una Agencia caja PARA LINEA DE CAJA SENTIDO DEBITO
		 $sql="INSERT INTO `transaccion`(`idtransaccion`, `referencia`, `remitente`, `cuenta_remi`, `receptor`, 
					  `cuenta_recep`, `ageenvia`, `agerecibe`, `pais_origen`, `pais_destino`, `tipo`, `monto`,`cobrar`,
					  `comision`, `comi_empre`, `comi_remi`, `comi_benef`, `IVA`, `saldo_rescuenta`, `codigo`,
					  `codigo_ope`, `sentido`, `descripcion`, `secreto`, `sms_mobil`, `estadot`, `objeto`, `agentcreat`,
					  `agenmod`, `fecrea`, `femodif`) 
			  VALUES (NULL,'$referencia','$clienteremitente', '$ncpremitente', '$clientebeneficiario','$ncpbeneficiaria',
			  '$agenciaremitente','$agenciabeneficiaria','$paisorigen','$paisdestino','$tipo','$monto', NULL,NULL,
			  NULL, NULL, NULL, NULL, NULL,'$codigo','002','D','$descripcion',NULL,'sin sms movil','Recibido','$idAgenciaOP',
			  '$agente', NULL, now(), NULL)";
			  return ejecutarConsulta($sql);  
  
	  }

 		// DEVOLVERLE A UNA AGENCIA SU DINERO
	    //Implementamos un método para insertar registros
		public function restituirDineroDeUnaAgencia($referencia,$clienteremitente,$clientebeneficiario,$paisorigen,$paisdestino,$agenciaremitente,$ncpremitente,
		$agenciabeneficiaria,$ncpbeneficiaria,$monto,$saldoRemitenteRestante,$saldoBeneficiarioResultante,$tipo,$codigo,$descripcion,$idAgenciaOP,$agente)
		{ 
	
			// Insertar de una Agencia  SENTIDO CREDITO
		   $sql="INSERT INTO `transaccion`(`idtransaccion`, `referencia`, `remitente`, `cuenta_remi`, `receptor`, 
							  `cuenta_recep`, `ageenvia`, `agerecibe`, `pais_origen`, `pais_destino`, `tipo`, `monto`,`cobrar`,
							   `comision`, `comi_empre`, `comi_remi`, `comi_benef`, `IVA`, `saldo_rescuenta`, `codigo`,
							   `codigo_ope`, `sentido`, `descripcion`, `secreto`, `sms_mobil`, `estadot`, `objeto`, `agentcreat`,
								`agenmod`, `fecrea`, `femodif`)
						 VALUES (NULL,'$referencia','$clienteremitente', '$ncpremitente', '$clientebeneficiario','$ncpbeneficiaria',
						 '$agenciaremitente','$agenciabeneficiaria','$paisorigen','$paisdestino','$tipo','$monto',NULL, NULL,
						 NULL, NULL, NULL, NULL, NULL,'$codigo','003','C','$descripcion',NULL,'sin sms movil','Recibido','$idAgenciaOP',
						  '$agente', NULL, now(), NULL)";
		   //var_dump($sql);
			 ejecutarConsulta($sql);
			 
			// Actualizar SALDO NCP REMITENTE
			$sql="UPDATE `cuentas` SET `saldo`='$saldoRemitenteRestante',`femovimiento`=now()
								   WHERE numerocuenta='$ncpremitente'";
			ejecutarConsulta($sql);
					// Actualizar SALDO NCP BENEFICIARIO
			$sql="UPDATE `cuentas` SET `saldo`='$saldoBeneficiarioResultante',`femovimiento`=now()
								   WHERE numerocuenta='$ncpbeneficiaria'";
			ejecutarConsulta($sql); 
  
							  // Insertar de una Agencia caja PARA LINEA DE CAJA SENTIDO DEBITO
		   $sql="INSERT INTO `transaccion`(`idtransaccion`, `referencia`, `remitente`, `cuenta_remi`, `receptor`, 
						`cuenta_recep`, `ageenvia`, `agerecibe`, `pais_origen`, `pais_destino`, `tipo`, `monto`,`cobrar`,
						`comision`, `comi_empre`, `comi_remi`, `comi_benef`, `IVA`, `saldo_rescuenta`, `codigo`,
						`codigo_ope`, `sentido`, `descripcion`, `secreto`, `sms_mobil`, `estadot`, `objeto`, `agentcreat`,
						`agenmod`, `fecrea`, `femodif`) 
				VALUES (NULL,'$referencia','$clienteremitente', '$ncpremitente', '$clientebeneficiario','$ncpbeneficiaria',
				'$agenciaremitente','$agenciabeneficiaria','$paisorigen','$paisdestino','$tipo','$monto', NULL,NULL,
				NULL, NULL, NULL, NULL, NULL,'$codigo','003','D','$descripcion',NULL,'sin sms movil','Recibido','$idAgenciaOP',
				'$agente', NULL, now(), NULL)";
				return ejecutarConsulta($sql);			
	
		}
	  	
	 
	  	// PAGARLE A UNA AGENCIA SUS COMISIONES
	    //Implementamos un método para insertar registros
		public function pagarComisionesDeUnaAgencia($referencia,$clienteremitente,$clientebeneficiario,$paisorigen,$paisdestino,$agenciaremitente,$ncpremitente,
		$agenciabeneficiaria,$ncpbeneficiaria,$monto,$saldoRemitenteRestante,$saldoBeneficiarioResultante,$tipo,$codigo,$descripcion,$idAgenciaOP,$agente)
		{ 
	
			// Insertar de una Agencia caja PARA LINEA DE CAJA SENTIDO CREDITO
		   $sql="INSERT INTO `transaccion`(`idtransaccion`, `referencia`, `remitente`, `cuenta_remi`, `receptor`, 
							  `cuenta_recep`, `ageenvia`, `agerecibe`, `pais_origen`, `pais_destino`, `tipo`, `monto`,`cobrar`,
							   `comision`, `comi_empre`, `comi_remi`, `comi_benef`, `IVA`, `saldo_rescuenta`, `codigo`,
							   `codigo_ope`, `sentido`, `descripcion`, `secreto`, `sms_mobil`, `estadot`, `objeto`, `agentcreat`,
								`agenmod`, `fecrea`, `femodif`)
						 VALUES (NULL,'$referencia','$clienteremitente', '$ncpremitente', '$clientebeneficiario','$ncpbeneficiaria',
						 '$agenciaremitente','$agenciabeneficiaria','$paisorigen','$paisdestino','$tipo','$monto',NULL, NULL,
						 NULL, NULL, NULL, NULL, NULL,'$codigo','006','C','$descripcion',NULL,'sin sms movil','Recibido','$idAgenciaOP',
						  '$agente', NULL, now(), NULL)";
		   //var_dump($sql);
			 ejecutarConsulta($sql);
			 
			// Actualizar SALDO NCP REMITENTE
			$sql="UPDATE `cuentas` SET `saldo`='$saldoRemitenteRestante',`femovimiento`=now()
								   WHERE numerocuenta='$ncpremitente'";
			ejecutarConsulta($sql);
					// Actualizar SALDO NCP BENEFICIARIO
			$sql="UPDATE `cuentas` SET `saldo`='$saldoBeneficiarioResultante',`femovimiento`=now()
								   WHERE numerocuenta='$ncpbeneficiaria'";
			ejecutarConsulta($sql); 
  
							  // Insertar de una Agencia caja PARA LINEA DE CAJA SENTIDO DEBITO
		   $sql="INSERT INTO `transaccion`(`idtransaccion`, `referencia`, `remitente`, `cuenta_remi`, `receptor`, 
						`cuenta_recep`, `ageenvia`, `agerecibe`, `pais_origen`, `pais_destino`, `tipo`, `monto`,`cobrar`,
						`comision`, `comi_empre`, `comi_remi`, `comi_benef`, `IVA`, `saldo_rescuenta`, `codigo`,
						`codigo_ope`, `sentido`, `descripcion`, `secreto`, `sms_mobil`, `estadot`, `objeto`, `agentcreat`,
						`agenmod`, `fecrea`, `femodif`) 
				VALUES (NULL,'$referencia','$clienteremitente', '$ncpremitente', '$clientebeneficiario','$ncpbeneficiaria',
				'$agenciaremitente','$agenciabeneficiaria','$paisorigen','$paisdestino','$tipo','$monto', NULL,NULL,
				NULL, NULL, NULL, NULL, NULL,'$codigo','006','D','$descripcion',NULL,'sin sms movil','Recibido','$idAgenciaOP',
				'$agente', NULL, now(), NULL)";
				return ejecutarConsulta($sql);			
	
		}


		// IMPRIMIR FACTURA
		   		//Implementar un método para mostrar los datos del Ticket de una transaccion
	public function mostrarTicketVentaUV($codigo)
	{
		$sql="SELECT rem.nomcompleto as nombreremitente,
		(select nomcompleto  FROM clientes c WHERE c.DNIremitente=t.receptor ) as nombrereceptor, 
		 t.tipo,(select nombre from agencias WHERE idagencia=t.ageenvia) as agenciaA, 
		 (select nombre from agencias WHERE idagencia=t.agerecibe) as agenciaB, t.monto,
		 t.descripcion, t.codigo,t.fecrea, t.agentcreat FROM clientes rem,
		 transaccion t WHERE rem.DNIremitente=t.remitente 
		 AND t.codigo_ope='002' AND t.sentido='C' AND t.estadot='Recibido'
		 AND t.codigo='$codigo'";
		return ejecutarConsulta($sql);
	}
	
  
  


}

?>