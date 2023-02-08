<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class BancoComercial
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre,$pais,$ciudad,$ncp,$responsable,$supervisor,$agente)
	{ 
		
		$sql="INSERT INTO `bancocomercial`(`idbancoc`, `nombre`, `pais`, `ciudad`, `ncp`, `responsable`, `gerente`, 
                                        `agentcrea`, `fecrea`, `agemodif`, `femodif`, `eliminado`) 
					VALUES (NULL,'$nombre','$pais','$ciudad','$ncp','$responsable','$supervisor','$agente',now(),NULL,NULL,'0')";
		return ejecutarConsulta($sql);
        //var_dump($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idbancoc,$nombre,$pais,$ciudad,$ncp,$responsable,$supervisor,$agente)
	{
		$sql="UPDATE bancocomercial SET nombre='$nombre',pais='$pais',ciudad='$ciudad',
								 ncp='$ncp',responsable='$responsable',gerente='$supervisor',agemodif='$agente',
                                 femodif=now()
							  WHERE idbancoc='$idbancoc'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para eliminar categorías
	public function eliminar($idbancoc,$agente)
	{
		$sql="UPDATE bancocomercial SET eliminado=1,agemodif='$agente',femodif=now()
	 						  WHERE idbancoc='$idbancoc'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idbancoc)
	{
		$sql="SELECT `idbancoc`, `nombre`, `pais`, `ciudad`, `ncp`, `responsable`, `gerente`, `agentcrea`, 
                    `fecrea`, `agemodif`, `femodif` FROM `bancocomercial` WHERE idbancoc='$idbancoc'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar($pais,$agencia_em,$rol,$ap)
	{
		// CONTROL DEL ROL DEL USUARIO
		switch ($rol){
		

			case 'Agencia':
				$sql="SELECT idbancoc, nombre,
                (SELECT nombre FROM paises WHERE idPais=pais) as pais_nombre,
                (SELECT nomcompleto FROM empleados e, clientes r WHERE e.DNI=r.DNIremitente AND ap=responsable) as responsable_nombre,
                (SELECT nomcompleto FROM empleados e,clientes r WHERE e.DNI=r.DNIremitente AND ap=gerente) as gerente,
                ciudad,ncp,
                (SELECT saldo FROM cuentas c WHERE c.numerocuenta=ncp) as ncpCorrienteSaldo, 
                responsable,gerente,agentcrea,fecrea 
        FROM bancocomercial WHERE eliminado=0 AND pais='$pais' AND responsable='$ap'";
				return ejecutarConsulta($sql);
			break;

			default:
			$sql="SELECT idbancoc, nombre,
            (SELECT nombre FROM paises WHERE idPais=pais) as pais_nombre,
            (SELECT nomcompleto FROM empleados e, clientes r WHERE e.DNI=r.DNIremitente AND ap=responsable) as responsable_nombre,
            (SELECT nomcompleto FROM empleados e,clientes r WHERE e.DNI=r.DNIremitente AND ap=gerente) as gerente,
            ciudad,ncp,
            (SELECT saldo FROM cuentas c WHERE c.numerocuenta=ncp) as ncpCorrienteSaldo, 
            responsable,gerente,agentcrea,fecrea 
    FROM bancocomercial WHERE eliminado=0";
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
	  public function insertarDineroEnBancoComercial($referencia,$clienteremitente,$clientebeneficiario,$paisorigen,$paisdestino,$agenciaremitente,$ncpremitente,
	  $agenciabeneficiaria,$ncpbeneficiaria,$monto,$saldoRemitenteRestante,$saldoBeneficiarioResultante,$tipo,$codigo,$descripcion,$idBancoComercialOP,$agente)
	  { 
  
		  // Insertar de una Agencia caja PARA LINEA DE CAJA SENTIDO CREDITO
		 $sql="INSERT INTO `transaccion`(`idtransaccion`, `referencia`, `remitente`, `cuenta_remi`, `receptor`, 
							`cuenta_recep`, `ageenvia`, `agerecibe`, `pais_origen`, `pais_destino`, `tipo`, `monto`,`cobrar`,
							 `comision`, `comi_empre`, `comi_remi`, `comi_benef`, `IVA`, `saldo_rescuenta`, `codigo`,
							 `codigo_ope`, `sentido`, `descripcion`, `secreto`, `sms_mobil`, `estadot`, `objeto`, `agentcreat`,
							  `agenmod`, `fecrea`, `femodif`)
					   VALUES (NULL,'$referencia','$clienteremitente', '$ncpremitente', '$clientebeneficiario','$ncpbeneficiaria',
					   '$agenciaremitente','$agenciabeneficiaria','$paisorigen','$paisdestino','1','$monto',NULL, NULL,
					   NULL, NULL, NULL, NULL, NULL,'$codigo','$tipo','C','$descripcion',NULL,'sin sms movil','Recibido','$idBancoComercialOP',
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
			  '$agenciaremitente','$agenciabeneficiaria','$paisorigen','$paisdestino','1','$monto', NULL,NULL,
			  NULL, NULL, NULL, NULL, NULL,'$codigo','$tipo','D','$descripcion',NULL,'sin sms movil','Recibido','$idBancoComercialOP',
			  '$agente', NULL, now(), NULL)";
			  return ejecutarConsulta($sql);  
  
	  }

 		// DEVOLVERLE A UNA AGENCIA SU DINERO
	    //Implementamos un método para insertar registros
		public function restituirDineroDeUnBancoComercial($referencia,$clienteremitente,$clientebeneficiario,$paisorigen,$paisdestino,$agenciaremitente,$ncpremitente,
		$agenciabeneficiaria,$ncpbeneficiaria,$monto,$saldoRemitenteRestante,$saldoBeneficiarioResultante,$tipo,$codigo,$descripcion,$idBancoComercialOP,$agente)
		{ 
	
			// Insertar de una Agencia  SENTIDO CREDITO
		   $sql="INSERT INTO `transaccion`(`idtransaccion`, `referencia`, `remitente`, `cuenta_remi`, `receptor`, 
							  `cuenta_recep`, `ageenvia`, `agerecibe`, `pais_origen`, `pais_destino`, `tipo`, `monto`,`cobrar`,
							   `comision`, `comi_empre`, `comi_remi`, `comi_benef`, `IVA`, `saldo_rescuenta`, `codigo`,
							   `codigo_ope`, `sentido`, `descripcion`, `secreto`, `sms_mobil`, `estadot`, `objeto`, `agentcreat`,
								`agenmod`, `fecrea`, `femodif`)
						 VALUES (NULL,'$referencia','$clienteremitente', '$ncpremitente', '$clientebeneficiario','$ncpbeneficiaria',
						 '$agenciaremitente','$agenciabeneficiaria','$paisorigen','$paisdestino','1','$monto',NULL, NULL,
						 NULL, NULL, NULL, NULL, NULL,'$codigo','$tipo','C','$descripcion',NULL,'sin sms movil','Recibido','$idBancoComercialOP',
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
				'$agenciaremitente','$agenciabeneficiaria','$paisorigen','$paisdestino','1','$monto', NULL,NULL,
				NULL, NULL, NULL, NULL, NULL,'$codigo','$tipo','D','$descripcion',NULL,'sin sms movil','Recibido','$idBancoComercialOP',
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