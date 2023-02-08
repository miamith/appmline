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
		$input='123456789987654321123450987654321567890';
			$input_length = strlen($input);
			$random_string = '';
			for($i = 0; $i < $longitud; $i++) {
				$random_character = $input[mt_rand(0, $input_length - 1)];
				$random_string .= $random_character;
			}
			return $random_string;
		}
			
	//Implementamos un método para insertar registros
	public function insertar($referencia,$nombreremitente,$nombrereceptor,$telefonorem,$telefonorec,$dirremitente,
						$agente,$dirreceptor,$DNIremitente,$tipo,$monto,$comision,$agencia_em,
						$codigo,$secreto,$comi_empre, $comi_remi,$comi_benef,$IVA,$saldo_rescuenta,$cobrar,
						$saldoNCPcomisionesFINAL,$NCPcomisiones,$NCPcorriente,$pais_destino, $descripcion,$pais,$objeto,
						$NCPcomisionesMLINE,$NCPivaMLINE,$saldoNCPcomisionesMLINE,$saldoNCPivaMLINE)
	{
		// Insercion primera en tabla Cliente esta VEZ
		$sql="INSERT INTO `clientes`(`DNIremitente`, `nomcompleto`, `tel`, `pais`, `direccion`, `agencia_cli`,
									 `estado`, `agencrea`, `fecrea`, `agenmodif`, `femodif`)
					 VALUES ('$DNIremitente','$nombreremitente','$telefonorem','$pais','$dirremitente','$agencia_em',
					 			'1','$agente',now(),NULL,NULL)";
		ejecutarConsulta($sql);
		// Insertamos el receptor
		$sql="INSERT INTO `receptor`(`idreceptor`, `nomcompler`, `telr`, `direccionr`, `agentcrea`, `fecrea`) 
							VALUES (NULL,'$nombrereceptor','$telefonorec','$dirreceptor','$agente',now())";
		$idreceptornew=ejecutarConsulta_retornarID($sql);
		// insercion de la transaccion o el mismo envio
		$sql="INSERT INTO `transaccion`(`idtransaccion`, `referencia`, `remitente`, `cuenta_remi`, `receptor`, 
					`cuenta_recep`, `ageenvia`, `agerecibe`, `pais_origen`, `pais_destino`, `tipo`, `monto`, `cobrar`,
					`comision`, `comi_empre`, `comi_remi`, `comi_benef`, `IVA`, `saldo_rescuenta`, `codigo`, 
					`codigo_ope`, `sentido`, `descripcion`, `secreto`, `sms_mobil`, `estadot`, `objeto`, `agentcreat`,
					 `agenmod`, `fecrea`, `femodif`)
					VALUES (NULL, '$referencia','$DNIremitente',NULL,'$idreceptornew', NULL,'$agencia_em',NULL,'$pais',
					'$pais_destino','$tipo','$monto','$cobrar','$comision','$comi_empre','$comi_remi','$comi_benef','$IVA',
					'$saldo_rescuenta','$codigo','001','D','$descripcion','$secreto','insertar_sms_mobile','Pendiente',
					'$objeto','$agente',NULL,now(),NULL)";
		 $idtransaccion=ejecutarConsulta_retornarID($sql);


		// insercion de la bkhis o el mismo envio para guardar historial
		$sql="INSERT INTO `bkhis`(`idbkhis`, `referenciah`, `DNIremitenteh`, `nomcompletoch`, `cuentach`, `telch`,
		`direccionch`, `agentcreaRh`, `idreceptorh`, `DNIreceptorh`, `nomcomplerh`, `cuentarh`, `telrh`, `direccionrh`,
		 `agentcrearetorh`, `idtransaccionh`, `ageenviah`, `agerecibeh`, `tipoh`, `montoh`, `comisionh`, `codigoh`, 
		 `codigo_opeh`, `sentidoh`, `estadoth`, `descripcion`, `agentcreh`, `agentvalida`, `fecrea`, `operacion`, 
		 `fechavalidacion`)  
			  VALUES (NULL,'$referencia','$DNIremitente','$nombreremitente',NULL,'$telefonorem','$dirremitente',
			  '$agente','$idreceptornew',NULL,'$nombrereceptor',NULL,'$telefonorec','$dirreceptor','$agente',
			  '$idtransaccion','$agencia_em',NULL,'$tipo','$monto','$comision','$codigo','001','D','Pendiente',
			  '$descripcion','$agente',NULL,now(),'Envio normal',NULL)";
		ejecutarConsulta($sql); 

		        // Actualizar SALDO NCP REMITENTE CORRIENTE CAJERO
        $sql="UPDATE `cuentas` SET `saldo`='$saldo_rescuenta',`femovimiento`=now()
                               WHERE numerocuenta='$NCPcorriente'";
		ejecutarConsulta($sql);
		        // Actualizar SALDO NCP REMITENTE COMISIONES CAJERO
        $sql="UPDATE `cuentas` SET `saldo`='$saldoNCPcomisionesFINAL',`femovimiento`=now()
                               WHERE numerocuenta='$NCPcomisiones'";
		ejecutarConsulta($sql);

                // Actualizar SALDO NCP COMISIONES EMPRESA TODO:Pendiente
        $sql="UPDATE `cuentas` SET `saldo`='$saldoNCPcomisionesMLINE',`femovimiento`=now()
                               WHERE numerocuenta='$NCPcomisionesMLINE'";
        ejecutarConsulta($sql);
		        // Actualizar SALDO NCP COMISIONES IVA EMPRESA TODO:Pendiente
        $sql="UPDATE `cuentas` SET `saldo`='$NCPivaMLINE',`femovimiento`=now()
                               WHERE numerocuenta='$saldoNCPivaMLINE'";
    return ejecutarConsulta($sql); // LA ULTIMA CONSULTA SI TOMA return



	}

		public function insertarCopia($referencia,$nombreremitente,$nombrereceptor,$telefonorem,$telefonorec,$dirremitente,
		$agente,$dirreceptor,$DNIremitente,$tipo,$monto,$comision,$agencia_em,
		$codigo,$secreto,$comi_empre, $comi_remi,$comi_benef,$IVA,$saldo_rescuenta,$cobrar,
		$saldoNCPcomisionesFINAL,$NCPcomisiones,$NCPcorriente,$pais_destino, $descripcion,$pais,$objeto,$idreceptor,
		$NCPcomisionesMLINE,$NCPivaMLINE,$saldoNCPcomisionesMLINE,$saldoNCPivaMLINE)
	{
		// Actualizamos remitente
		$sql="UPDATE `clientes` SET `nomcompleto`='$nombreremitente',`tel`='$telefonorem',`pais`='$pais',
			`direccion`='$dirremitente',`agencia_cli`='$agencia_em',`agenmodif`='$agente',`femodif`=now()
			WHERE DNIremitente='$DNIremitente'";
		 ejecutarConsulta($sql);
		// Actualizamos receptor
		
		$sql="UPDATE `receptor` SET `nomcompler`='$nombrereceptor',`telr`='$telefonorec',`direccionr`='$dirreceptor' 
			WHERE idreceptor='$idreceptor'";
		ejecutarConsulta($sql);
		// insercion de la transaccion o el mismo envio
		$sql="INSERT INTO `transaccion`(`idtransaccion`, `referencia`, `remitente`, `cuenta_remi`, `receptor`, 
			`cuenta_recep`, `ageenvia`, `agerecibe`, `pais_origen`, `pais_destino`, `tipo`, `monto`, `cobrar`,
			`comision`, `comi_empre`, `comi_remi`, `comi_benef`, `IVA`, `saldo_rescuenta`, `codigo`, 
			`codigo_ope`, `sentido`, `descripcion`, `secreto`, `sms_mobil`, `estadot`, `objeto`, `agentcreat`,
			`agenmod`, `fecrea`, `femodif`)
			VALUES (NULL, '$referencia','$DNIremitente',NULL,'$idreceptor', NULL,'$agencia_em',NULL,'$pais',
			'$pais_destino','$tipo','$monto','$cobrar','$comision','$comi_empre','$comi_remi','$comi_benef','$IVA',
			'$saldo_rescuenta','$codigo','001','D','$descripcion','$secreto','insertar_sms_mobile','Pendiente',
			'$objeto','$agente',NULL,now(),NULL)";
		$idtransaccion=ejecutarConsulta_retornarID($sql);

		// insercion de la bkhis o el mismo envio para guardar historial
		$sql="INSERT INTO `bkhis`(`idbkhis`, `referenciah`, `DNIremitenteh`, `nomcompletoch`, `cuentach`, `telch`,
				`direccionch`, `agentcreaRh`, `idreceptorh`, `DNIreceptorh`, `nomcomplerh`, `cuentarh`, `telrh`, `direccionrh`,
				`agentcrearetorh`, `idtransaccionh`, `ageenviah`, `agerecibeh`, `tipoh`, `montoh`, `comisionh`, `codigoh`, 
				`codigo_opeh`, `sentidoh`, `estadoth`, `descripcion`, `agentcreh`, `agentvalida`, `fecrea`, `operacion`, 
				`fechavalidacion`)  
			  VALUES (NULL,'$referencia','$DNIremitente','$nombreremitente',NULL,'$telefonorem','$dirremitente',
			  '$agente','$idreceptor',NULL,'$nombrereceptor',NULL,'$telefonorec','$dirreceptor','$agente',
			  '$idtransaccion','$agencia_em',NULL,'$tipo','$monto','$comision','$codigo','001','D','Pendiente',
			  '$descripcion','$agente',NULL,now(),'Envio normal',NULL)";
		ejecutarConsulta($sql);

				        // Actualizar SALDO NCP REMITENTE CORRIENTE CAJERO
				$sql="UPDATE `cuentas` SET `saldo`='$saldo_rescuenta',`femovimiento`=now()
									WHERE numerocuenta='$NCPcorriente'";
				ejecutarConsulta($sql);
						// Actualizar SALDO NCP REMITENTE COMISIONES CAJERO
				$sql="UPDATE `cuentas` SET `saldo`='$saldoNCPcomisionesFINAL',`femovimiento`=now()
									WHERE numerocuenta='$NCPcomisiones'";
		ejecutarConsulta($sql);

                // Actualizar SALDO NCP COMISIONES EMPRESA TODO:Pendiente
        $sql="UPDATE `cuentas` SET `saldo`='$saldoNCPcomisionesMLINE',`femovimiento`=now()
                               WHERE numerocuenta='$NCPcomisionesMLINE'";
        ejecutarConsulta($sql);
		        // Actualizar SALDO NCP COMISIONES IVA EMPRESA TODO:Pendiente
        $sql="UPDATE `cuentas` SET `saldo`='$NCPivaMLINE',`femovimiento`=now()
                               WHERE numerocuenta='$saldoNCPivaMLINE'";
    return ejecutarConsulta($sql); // LA ULTIMA CONSULTA SI TOMA return


	
	}

		public function insertarCopiaR($referencia,$nombreremitente,$nombrereceptor,$telefonorem,$telefonorec,$dirremitente,
		$agente,$dirreceptor,$DNIremitente,$tipo,$monto,$comision,$agencia_em,
		$codigo,$secreto,$comi_empre, $comi_remi,$comi_benef,$IVA,$saldo_rescuenta,$cobrar,
		$saldoNCPcomisionesFINAL,$NCPcomisiones,$NCPcorriente,$pais_destino, $descripcion,$pais,$objeto,
		$NCPcomisionesMLINE,$NCPivaMLINE,$saldoNCPcomisionesMLINE,$saldoNCPivaMLINE)
	{
		// Actualizamos remitente
		$sql="UPDATE `clientes` SET `nomcompleto`='$nombreremitente',`tel`='$telefonorem',`pais`='$pais',
			`direccion`='$dirremitente',`agencia_cli`='$agencia_em',`agenmodif`='$agente',`femodif`=now()
			WHERE DNIremitente='$DNIremitente'";
		 ejecutarConsulta($sql);
		
		// Insertamos el receptor
		$sql="INSERT INTO `receptor`(`idreceptor`, `nomcompler`, `telr`, `direccionr`, `agentcrea`, `fecrea`) 
							VALUES (NULL,'$nombrereceptor','$telefonorec','$dirreceptor','$agente',now())";
		 $idreceptornew=ejecutarConsulta_retornarID($sql);

		// Insercion de la transaccion o el mismo envio
		$sql="INSERT INTO `transaccion`(`idtransaccion`, `referencia`, `remitente`, `cuenta_remi`, `receptor`, 
		`cuenta_recep`, `ageenvia`, `agerecibe`, `pais_origen`, `pais_destino`, `tipo`, `monto`, `cobrar`,
		`comision`, `comi_empre`, `comi_remi`, `comi_benef`, `IVA`, `saldo_rescuenta`, `codigo`, 
		`codigo_ope`, `sentido`, `descripcion`, `secreto`, `sms_mobil`, `estadot`, `objeto`, `agentcreat`,
		 `agenmod`, `fecrea`, `femodif`)
		VALUES (NULL, '$referencia','$DNIremitente',NULL,'$idreceptornew', NULL,'$agencia_em',NULL,'$pais',
		'$pais_destino','$tipo','$monto','$cobrar','$comision','$comi_empre','$comi_remi','$comi_benef','$IVA',
		'$saldo_rescuenta','$codigo','001','D','$descripcion','$secreto','insertar_sms_mobile','Pendiente',
		'$objeto','$agente',NULL,now(),NULL)";
		$idtransaccion=ejecutarConsulta_retornarID($sql);

		// insercion de la bkhis o el mismo envio para guardar historial
		$sql="INSERT INTO `bkhis`(`idbkhis`, `referenciah`, `DNIremitenteh`, `nomcompletoch`, `cuentach`, `telch`,
			`direccionch`, `agentcreaRh`, `idreceptorh`, `DNIreceptorh`, `nomcomplerh`, `cuentarh`, `telrh`, `direccionrh`,
			`agentcrearetorh`, `idtransaccionh`, `ageenviah`, `agerecibeh`, `tipoh`, `montoh`, `comisionh`, `codigoh`, 
			`codigo_opeh`, `sentidoh`, `estadoth`, `descripcion`, `agentcreh`, `agentvalida`, `fecrea`, `operacion`, 
			`fechavalidacion`)  
			VALUES (NULL,'$referencia','$DNIremitente','$nombreremitente',NULL,'$telefonorem','$dirremitente',
			'$agente','$idreceptornew',NULL,'$nombrereceptor',NULL,'$telefonorec','$dirreceptor','$agente',
			'$idtransaccion','$agencia_em',NULL,'$tipo','$monto','$comision','$codigo','001','D','Pendiente',
			'$descripcion','$agente',NULL,now(),'Envio normal',NULL)";
		ejecutarConsulta($sql);

		// Actualizar SALDO NCP REMITENTE CORRIENTE CAJERO
				$sql="UPDATE `cuentas` SET `saldo`='$saldo_rescuenta',`femovimiento`=now()
									WHERE numerocuenta='$NCPcorriente'";
				ejecutarConsulta($sql);
						// Actualizar SALDO NCP REMITENTE COMISIONES CAJERO
				$sql="UPDATE `cuentas` SET `saldo`='$saldoNCPcomisionesFINAL',`femovimiento`=now()
									WHERE numerocuenta='$NCPcomisiones'";
		ejecutarConsulta($sql);

                // Actualizar SALDO NCP COMISIONES EMPRESA TODO:Pendiente
        $sql="UPDATE `cuentas` SET `saldo`='$saldoNCPcomisionesMLINE',`femovimiento`=now()
                               WHERE numerocuenta='$NCPcomisionesMLINE'";
        ejecutarConsulta($sql);
		        // Actualizar SALDO NCP COMISIONES IVA EMPRESA TODO:Pendiente
        $sql="UPDATE `cuentas` SET `saldo`='$NCPivaMLINE',`femovimiento`=now()
                               WHERE numerocuenta='$saldoNCPivaMLINE'";
    return ejecutarConsulta($sql); // LA ULTIMA CONSULTA SI TOMA return




	}


	public function insertarCopiaBen($referencia,$nombreremitente,$nombrereceptor,$telefonorem,$telefonorec,$dirremitente,
	$agente,$dirreceptor,$DNIremitente,$tipo,$monto,$comision,$agencia_em,
	$codigo,$secreto,$comi_empre, $comi_remi,$comi_benef,$IVA,$saldo_rescuenta,$cobrar,
	$saldoNCPcomisionesFINAL,$NCPcomisiones,$NCPcorriente,$pais_destino, $descripcion,$pais,$objeto,$idreceptor,
	$NCPcomisionesMLINE,$NCPivaMLINE,$saldoNCPcomisionesMLINE,$saldoNCPivaMLINE)
	{
			// Insercion primera en tabla Cliente esta VEZ
		$sql="INSERT INTO `clientes`(`DNIremitente`, `nomcompleto`, `tel`, `pais`, `direccion`, `agencia_cli`,
									 `estado`, `agencrea`, `fecrea`, `agenmodif`, `femodif`)
					 VALUES ('$DNIremitente','$nombreremitente','$telefonorem','$pais','$dirremitente','$agencia_em',
					 			'1','$agente',now(),NULL,NULL)";
		ejecutarConsulta($sql);

				// Actualizamos receptor
		$sql="UPDATE `receptor` SET `nomcompler`='$nombrereceptor',`telr`='$telefonorec',`direccionr`='$dirreceptor' 
			WHERE idreceptor='$idreceptor'";
		ejecutarConsulta($sql);

				// insercion de la transaccion o el mismo envio
		$sql="INSERT INTO `transaccion`(`idtransaccion`, `referencia`, `remitente`, `cuenta_remi`, `receptor`, 
			`cuenta_recep`, `ageenvia`, `agerecibe`, `pais_origen`, `pais_destino`, `tipo`, `monto`, `cobrar`,
			`comision`, `comi_empre`, `comi_remi`, `comi_benef`, `IVA`, `saldo_rescuenta`, `codigo`, 
			`codigo_ope`, `sentido`, `descripcion`, `secreto`, `sms_mobil`, `estadot`, `objeto`, `agentcreat`,
			`agenmod`, `fecrea`, `femodif`)
			VALUES (NULL, '$referencia','$DNIremitente',NULL,'$idreceptor', NULL,'$agencia_em',NULL,'$pais',
			'$pais_destino','$tipo','$monto','$cobrar','$comision','$comi_empre','$comi_remi','$comi_benef','$IVA',
			'$saldo_rescuenta','$codigo','001','D','$descripcion','$secreto','insertar_sms_mobile','Pendiente',
			'$objeto','$agente',NULL,now(),NULL)";
		$idtransaccion=ejecutarConsulta_retornarID($sql);

		// insercion de la bkhis o el mismo envio para guardar historial
		$sql="INSERT INTO `bkhis`(`idbkhis`, `referenciah`, `DNIremitenteh`, `nomcompletoch`, `cuentach`, `telch`,
				`direccionch`, `agentcreaRh`, `idreceptorh`, `DNIreceptorh`, `nomcomplerh`, `cuentarh`, `telrh`, `direccionrh`,
				`agentcrearetorh`, `idtransaccionh`, `ageenviah`, `agerecibeh`, `tipoh`, `montoh`, `comisionh`, `codigoh`, 
				`codigo_opeh`, `sentidoh`, `estadoth`, `descripcion`, `agentcreh`, `agentvalida`, `fecrea`, `operacion`, 
				`fechavalidacion`)  
			  VALUES (NULL,'$referencia','$DNIremitente','$nombreremitente',NULL,'$telefonorem','$dirremitente',
			  '$agente','$idreceptor',NULL,'$nombrereceptor',NULL,'$telefonorec','$dirreceptor','$agente',
			  '$idtransaccion','$agencia_em',NULL,'$tipo','$monto','$comision','$codigo','001','D','Pendiente',
			  '$descripcion','$agente',NULL,now(),'Envio normal',NULL)";
		ejecutarConsulta($sql);

				        // Actualizar SALDO NCP REMITENTE CORRIENTE CAJERO
				$sql="UPDATE `cuentas` SET `saldo`='$saldo_rescuenta',`femovimiento`=now()
									WHERE numerocuenta='$NCPcorriente'";
				ejecutarConsulta($sql);
						// Actualizar SALDO NCP REMITENTE COMISIONES CAJERO
				$sql="UPDATE `cuentas` SET `saldo`='$saldoNCPcomisionesFINAL',`femovimiento`=now()
									WHERE numerocuenta='$NCPcomisiones'";
		ejecutarConsulta($sql);

                // Actualizar SALDO NCP COMISIONES EMPRESA TODO:Pendiente
        $sql="UPDATE `cuentas` SET `saldo`='$saldoNCPcomisionesMLINE',`femovimiento`=now()
                               WHERE numerocuenta='$NCPcomisionesMLINE'";
        ejecutarConsulta($sql);
		        // Actualizar SALDO NCP COMISIONES IVA EMPRESA TODO:Pendiente
        $sql="UPDATE `cuentas` SET `saldo`='$NCPivaMLINE',`femovimiento`=now()
                               WHERE numerocuenta='$saldoNCPivaMLINE'";
    return ejecutarConsulta($sql); // LA ULTIMA CONSULTA SI TOMA return

		
	}

	//Implementamos un método para editar registros 
	public function editar($referenciaAc,$codigoAc,$idtransaccion,$referencia,$nombreremitente,$nombrereceptor,$telefonorem,$telefonorec,$dirremitente,
			$agente,$dirreceptor,$DNIremitente,$tipo,$monto,$comision,$agencia_em,
			$codigo,$secreto,$comi_empre, $comi_remi,$comi_benef,$IVA,$saldo_rescuenta,$cobrar,
			$saldoNCPcomisionesFINAL,$NCPcomisiones,$NCPcorriente,$pais_destino, $descripcion,$pais,$objeto,$idreceptor,
			$NCPcomisionesMLINE,$NCPivaMLINE,$saldoNCPcomisionesMLINE,$saldoNCPivaMLINE)
	{
		
		// Actualizamos remitente
		$sql="UPDATE `clientes` SET `nomcompleto`='$nombreremitente',`tel`='$telefonorem',`pais`='$pais',
			`direccion`='$dirremitente',`agencia_cli`='$agencia_em',`agenmodif`='$agente',`femodif`=now()
			WHERE DNIremitente='$DNIremitente'";
		 ejecutarConsulta($sql);
		// Actualizamos receptor
		
		$sql="UPDATE `receptor` SET `nomcompler`='$nombrereceptor',`telr`='$telefonorec',`direccionr`='$dirreceptor' 
			WHERE idreceptor='$idreceptor'";
		ejecutarConsulta($sql);

			// Actualizamos transaccion
		$sql="UPDATE transaccion SET remitente='$DNIremitente',receptor='$idreceptor',ageenvia='$agencia_em',
		      tipo='$tipo',estadot='Revalidar',descripcion='$descripcion',agenmod='$agente',
			  secreto='$secreto', pais_origen='$pais', pais_destino='$pais_destino',
			  femodif=now() WHERE idtransaccion='$idtransaccion'";
		ejecutarConsulta($sql);

					// insercion de la bkhis o el mismo envio para guardar historial
			$sql="INSERT INTO `bkhis`(`idbkhis`, `referenciah`, `DNIremitenteh`, `nomcompletoch`, `cuentach`, `telch`,
				`direccionch`, `agentcreaRh`, `idreceptorh`, `DNIreceptorh`, `nomcomplerh`, `cuentarh`, `telrh`, `direccionrh`,
				`agentcrearetorh`, `idtransaccionh`, `ageenviah`, `agerecibeh`, `tipoh`, `montoh`, `comisionh`, `codigoh`, 
				`codigo_opeh`, `sentidoh`, `estadoth`, `descripcion`, `agentcreh`, `agentvalida`, `fecrea`, `operacion`, 
				`fechavalidacion`)  
			  VALUES (NULL,'$referenciaAc','$DNIremitente','$nombreremitente',NULL,'$telefonorem','$dirremitente',
			  '$agente','$idreceptor',NULL,'$nombrereceptor',NULL,'$telefonorec','$dirreceptor','$agente',
			  '$idtransaccion','$agencia_em',NULL,'$tipo','$monto','$comision','$codigoAc','001','D','Revalidar',
			  '$descripcion','$agente',NULL,now(),'Solicitud Modificacion envio',NULL)";
	return	ejecutarConsulta($sql);

	// TODO: La contabilidad de debitar y creditar las cuentas que se impactaron antes y despues SE HARA EN LA VALIDACION


	}

		// Vericar saldos de envios CUENTAS DEL USUARIO O CAJERO QUE ENVIA DINERO
	public function traerSaldoActual($DNI,$ncpCorriente)
	{
		$sql="SELECT saldo FROM cuentas WHERE cliente='$DNI' AND numerocuenta='$ncpCorriente'";
		return ejecutarConsulta($sql);		
	}

	// Vericar saldos de envios CUENTAS DEL USUARIO O CAJERO QUE ENVIA DINERO
	public function verificarSaldo($DNI,$ap,$ncpCorriente,$ncpComisiones)
	{
		$sql="SELECT
		(select numerocuenta from cuentas c where c.numerocuenta='$ncpCorriente') as NCPcorriente,
		(select numerocuenta from cuentas c where c.numerocuenta='$ncpComisiones') as NCPcomisiones,
		(select saldo from cuentas c where c.numerocuenta='$ncpCorriente') as saldoNCPcorriente,
		(select saldo from cuentas c where c.numerocuenta='$ncpComisiones') as saldoNCPcomisiones
		 FROM clientes a WHERE a.DNIremitente='$DNI'";
		return ejecutarConsulta($sql);		
	}

	// Vericar saldos de CUENTAS INTERNA DE LA EMPRESA QUE TIENEN VALOR EN CAMPO FIRMA=INTERNA
	public function verificarSaldoMLINE()
	{
		$sql="SELECT
		(select numerocuenta from cuentas c where c.firma='INTERNA' AND c.tipo_cuenta='CUENTA_COMISIONES') as NCPcomisionesMLINE,
		(select numerocuenta from cuentas c where c.firma='INTERNA' AND c.tipo_cuenta='CUENTA_IVA') as NCPivaMLINE,
        (select saldo from cuentas c where c.firma='INTERNA' AND c.tipo_cuenta='CUENTA_COMISIONES') as saldoNCPcomisionesMLINE,
		(select saldo from cuentas c where c.firma='INTERNA' AND c.tipo_cuenta='CUENTA_IVA') as saldoNCPivaMLINE
		 FROM clientes LIMIT 1";
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
		$sql="SELECT c.nomcompleto as nombreremitente,rep.nomcompler as nombrereceptor,c.tel as telefonorem,
		rep.telr as telefonorec,c.direccion as dirremitente,direccionr as dirreceptor,DNIremitente,pais_destino,
		t.tipo,t.ageenvia,t.agerecibe,t.monto,t.cobrar,t.comision,
        t.comi_remi,t.secreto,referencia,secreto,
        t.descripcion,t.idtransaccion, 
		rep.idreceptor,t.codigo,t.estadot,t.fecrea,t.agentcreat
		FROM clientes c,transaccion t, receptor rep 
		WHERE c.DNIremitente=t.remitente AND t.receptor=rep.idreceptor AND t.idtransaccion='$idtransaccion'";
		return ejecutarConsultaSimpleFila($sql);
	}

		//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrarRecibo($idtransaccion)
	{
		$sql="SELECT rem.nomcompleto as nombreremitente,rep.nomcompler as nombrereceptor,rem.tel as telefonorem,
				rep.telr as telefonorec,rem.direccion as dirremitente,direccionr as dirreceptor,DNIremitente,
				(select distinct DNIreceptorh from bkhis h WHERE h.idtransaccionh=t.idtransaccion ) as DNIreceptor,
				t.tipo,t.ageenvia as agenciaA,t.agerecibe as agenciaB,t.monto,t.cobrar,t.comision,t.comi_benef,
				t.descripcion,t.idtransaccion, rep.idreceptor,t.codigo,t.estadot,t.fecrea,t.agentcreat,idbkhis 
				FROM clientes rem,transaccion t, receptor rep, bkhis h 
				WHERE t.idtransaccion=h.idtransaccionh 
				AND h.estadoth in ('Pendiente','Recibido') 
				AND rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor AND t.idtransaccion='$idtransaccion'";
		return ejecutarConsultaSimpleFila($sql);
	}

//Implementar un método para mostrar los datos de un registro a modificar
	public function buscarRemitenteRellenarNuevo($DNIremitente)
	{
		if ($DNIremitente=='') {
			$DNIremitente='No existe este cliente';
		}
		//$sql="SELECT nomcompleto,tel,direccion,DNIremitente FROM clientes WHERE nomcompleto LIKE '%$nomcompleto%'";
		$sql="SELECT nomcompleto,tel,direccion,DNIremitente FROM clientes WHERE DNIremitente LIKE '%$DNIremitente%' AND estado='1' AND nomcompleto!='Administrador del sistema'";
		return ejecutarConsultaSimpleFila($sql);

	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function buscarReceptorRellenarNuevo($telr)
	{
		if ($telr=='') {
			$telr='No existe este beneficiario';
		}

		$sql="SELECT idreceptor,nomcompler,telr,direccionr FROM receptor WHERE telr LIKE '%$telr%'";
		return ejecutarConsultaSimpleFila($sql);

	}


	//Implementar un método para BUSCAR CODIGO DE ENVIO
	public function buscarEnvioClas($codigo)
	{
		if ($codigo=='') {
			$codigo='No existe tal monto';
		}

		$sql="SELECT rem.nomcompleto as nombreremitente,rep.nomcompler as nombrereceptor,rem.tel as telefonorem,
		rep.telr as telefonorec,rem.direccion as dirremitente,direccionr as dirreceptor,DNIremitente,
		(select distinct DNIreceptorh from bkhis h WHERE h.idtransaccionh=t.idtransaccion ) as DNIreceptor,
		t.tipo,t.ageenvia as agenciaA,t.agerecibe as agenciaB,t.monto,t.cobrar,t.comision,t.comi_benef,
		t.descripcion,t.idtransaccion, rep.idreceptor,t.codigo,t.estadot,t.fecrea,t.agentcreat,idbkhis 
		FROM clientes rem,transaccion t, receptor rep, bkhis h 
		WHERE t.idtransaccion=h.idtransaccionh 
		AND rem.DNIremitente=h.DNIremitenteh
		AND rep.idreceptor=h.idreceptorh
		AND t.estadot='Pendiente'
		AND t.codigo='$codigo'";
		return ejecutarConsultaSimpleFila($sql);

	}

	//Implementar un método para BUSCAR MONTO A COBRAR
	public function verificarMontoCOBRAR($codigo,$cobrar)
	{
		if ($codigo=='') {
			$codigo='No existe tal codigo';
		}

		$sql="SELECT t.monto,t.cobrar,t.comision,t.comi_benef
		FROM transaccion t 
		WHERE t.estadot='Pendiente'
		AND t.cobrar='$cobrar'
		AND t.codigo='$codigo'";
		return ejecutarConsultaSimpleFila($sql);

	}

	//Implementar un método para BUSCAR MONTO A COBRAR
	public function verificarCodigoSECRETO($codigo,$secreto)
	{
		if ($codigo=='') {
			$codigo='No existe tal codigo';
		}

		$sql="SELECT secreto
		FROM transaccion t 
		WHERE t.estadot='Pendiente'
		AND t.secreto='$secreto'
		AND t.codigo='$codigo'";
		return ejecutarConsultaSimpleFila($sql);

	}	
	

	//Implementar un método para listar los registros
	public function listarEnvios($agenciaEnvia,$agente,$rol)
	{
		
		$sql="SELECT t.idtransaccion,c.nomcompleto,c.tel,t.monto,t.cobrar,t.comision,t.codigo,
		(select nombre from agencias WHERE idagencia=t.ageenvia) as agenciaA,rep.nomcompler,(select nombre from agencias WHERE idagencia=t.agerecibe) as agenciaB,
		t.fecrea,t.estadot ,t.agentcreat
        FROM clientes c,transaccion t, receptor rep 
        WHERE c.DNIremitente=t.remitente AND t.receptor=rep.idreceptor 
		AND t.agentcreat='$agente'
		AND t.ageenvia='$agenciaEnvia'";
		return ejecutarConsulta($sql);
	}

		//Implementar un método para listar los registros y mostrar en el select
	public function selectAgencias($pais,$agencia_em,$rol,$ap)
	{
		// CONTROL DEL ROL DEL USUARIO
		switch ($rol){
		
			case 'Agencia':
				$sql="SELECT * FROM agencias 
				WHERE eliminado=0 AND idagencia='$agencia_em' AND pais='$pais'";
				return ejecutarConsulta($sql);
			break;
			default:
				$sql="SELECT * FROM agencias WHERE eliminado=0";
				return ejecutarConsulta($sql);
			
			
		} //  FIN SWITCH
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
	public function comisiones($monto,$pais_destino, $pais)
	{
		
		$sql="SELECT idTasas,comisiont, moneda, IVA,porcenENVIO,porcenRECIBIR FROM tasas,paises
				WHERE Monto1<='$monto' AND Monto2>='$monto' AND pais_origen='$pais'
				and tasas.pais_origen=paises.idPais AND tasas.pais_destino=paises.idPais
				and pais_destino='$pais_destino'";
		return ejecutarConsultaSimpleFila($sql);

	}

			//Implementar un método para filtar las comisiones
			public function comisiones2($monto,$pais_destino, $pais)
			{
						
				$sql="SELECT idTasas,comisiont, moneda, IVA,porcenENVIO,porcenRECIBIR FROM tasas,paises
						WHERE Monto1<='$monto' AND Monto2>='$monto' AND pais_origen='$pais'
						and tasas.pais_origen=paises.idPais AND tasas.pais_destino=paises.idPais
						and pais_destino='$pais_destino'";
				return ejecutarConsulta($sql);		
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
		$sql="SELECT rem.nomcompleto as nombreremitente, rep.nomcompler as nombrereceptor,rem.tel as telefonorem,
		rep.telr as telefonorec, rem.direccion as dirremitente,rep.direccionr as dirreceptor,rem.DNIremitente,
		t.tipo,(select nombre from agencias WHERE idagencia=t.ageenvia) as agenciaA,
		(select nombre from agencias WHERE idagencia=t.agerecibe) as agenciaB,t.monto,t.cobrar,t.comision,t.descripcion,
		t.idtransaccion, rep.idreceptor,t.codigo,t.fecrea,t.agentcreat 
		FROM clientes rem,transaccion t, receptor rep 
		WHERE rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor AND t.idtransaccion='$idtransaccion'";
		return ejecutarConsulta($sql);
	}

    		//Implementar un método para mostrar los datos del Ticket de una transaccion
	public function mostrarTicketRecibo($idtransaccion)
	{
		$sql="SELECT rem.nomcompleto as nombreremitente,rep.nomcompler as nombrereceptor,rem.tel as telefonorem,
		 rep.telr as telefonorec,rem.direccion as dirremitente,rep.direccionr as dirreceptor,rem.DNIremitente, 
		 (select distinct DNIreceptorh from bkhis h WHERE h.idtransaccionh=t.idtransaccion ) as DNIreceptor, 
		 t.tipo,(select nombre from agencias WHERE idagencia=t.ageenvia) as agenciaA, 
		 (select nombre from agencias WHERE idagencia=t.agerecibe) as agenciaB,t.monto,t.cobrar,t.comision,
		 t.descripcion, t.idtransaccion, rep.idreceptor,t.codigo,t.fecrea,t.agenmod FROM clientes rem,
		 transaccion t, receptor rep, bkhis h WHERE rem.DNIremitente=t.remitente 
		 AND rem.DNIremitente=h.DNIremitenteh AND rep.idreceptor=h.idreceptorh 
		 AND t.idtransaccion='$idtransaccion'";
		return ejecutarConsulta($sql);
	}


		//Implementar un método para mostrar los datos del Ticket de una transaccion CASO DEL PRIMER ENVIO
		// TODO: Es caso recibe el codigo generado del envio al realizarlo al instante
	public function mostrarTicket2($codigo)
	{
		$sql="SELECT rem.nomcompleto as nombreremitente,rep.nomcompler as nombrereceptor,rem.tel as telefonorem,
		rep.telr as telefonorec,rem.direccion as dirremitente,rep.direccionr as dirreceptor,rem.DNIremitente,
		(select distinct DNIreceptorh from bkhis h WHERE h.idtransaccionh=t.idtransaccion ) as DNIreceptor,
		t.tipo,(select nombre from agencias WHERE idagencia=t.ageenvia) as agenciaA,
		(select nombre from agencias WHERE idagencia=t.agerecibe) as agenciaB,t.monto,t.cobrar,t.comision,t.descripcion,
		t.idtransaccion, rep.idreceptor,t.codigo,t.fecrea,t.agentcreat 
		FROM clientes rem,transaccion t, receptor rep 
		WHERE rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor AND t.codigo='$codigo'";
		return ejecutarConsulta($sql);
	}


	/////////////////////////// RECIBOS INICIO /////////////////////////////////////////////////////////////////////
		//Implementar un método para listar los registros
		// AND t.estadot IN ('Pendiente','Recibido') ORDER BY t.fecrea DESC";
	public function listarRecibos($agenciaRecibe)
	{

		$sql="SELECT t.idtransaccion,rem.nomcompleto,telr,direccionr,idreceptor, t.monto,t.cobrar,t.comision,t.codigo,
		(select nombre from agencias WHERE idagencia=t.ageenvia) as agenciaA, rep.nomcompler,
		(select nombre from agencias WHERE idagencia=t.agerecibe) as agenciaB,t.fecrea,t.estadot 
		FROM clientes rem,transaccion t, receptor rep 
		WHERE rem.DNIremitente=t.remitente AND t.receptor=rep.idreceptor
		AND t.agerecibe= '$agenciaRecibe'
        AND t.codigo_ope='001'
		AND t.estadot='Recibido' ORDER BY t.fecrea DESC";
		return ejecutarConsulta($sql);
	}

		//Implementamos un método para editar registros
	public function editarRecibir($idtransaccion,$idreceptor,$nombrereceptor,$comision,$comi_benef,$cobrar,
	$agencia,$telefonorec,$dirreceptor,$DNIreceptor,$descripcion,$agente,$idbkhis,
	$NCPcorriente,$NCPcomisiones,$saldoAgenPagoRestanteNCorri,$saldoNCPcomisionesFINAL,$saldo_rescuenta)
	{
		
		// Actualizamos transaccion
		$sql="UPDATE transaccion SET descripcion='$descripcion', estadot='Recibido',agenmod='$agente',
		agerecibe='$agencia', femodif=now() WHERE idtransaccion='$idtransaccion'";
		ejecutarConsulta($sql);

		// Insertamos el registro de las comisiones a la contabilidad BRUTO 
		$concepto="Comisiones de envio BRUTO ".$agencia;
		$observacion="Receptor ".$nombrereceptor;
		$sql="INSERT INTO ingresos_gastos (`iding_gas`, `concepto`, `monto`, `sentido`, `observacion`,
		 `fecrea`, `agecrea`, `agentcrea`) 
		 VALUES (NULL,'$concepto','$comision','C','$observacion',now(),'$agencia','$agente')";
		ejecutarConsulta($sql);

		// Insertamos el registro de las comisiones a la contabilidad NETO BENEFICIARIO 
		$concepto="Comisiones de envio NETO ".$agencia;
		$observacion="Receptor ".$nombrereceptor;
		$sql="INSERT INTO ingresos_gastos (`iding_gas`, `concepto`, `monto`, `sentido`, `observacion`,
		 `fecrea`, `agecrea`, `agentcrea`) 
		 VALUES (NULL,'$concepto','$comi_benef','C','$observacion',now(),'$agencia','$agente')";
		ejecutarConsulta($sql);
		// Actualizamos DNIreceptor en bkhis, para mantener alli la del DNI que ha cobrado
		// Antes teniamos DNIreceptor en el formulario de envio, que no se ponia en el momento de envio iba vacio
		// Ahora al cobrar se completaba este campo aqui, pero se nos olvido el detalle por que reutilizamos el codigo, en la antigua version estaba asi, pero en la nueva ya no nos acordamos como era y ELIMINAMOS DNIreceptor en envio
		 // Actualizamos el estado de bkhis
		$sql="UPDATE bkhis SET estadoth='Recibido', agerecibeh='$agencia', DNIreceptorh='$DNIreceptor' 
		WHERE idtransaccionh='$idtransaccion' AND idbkhis='$idbkhis'";
		ejecutarConsulta($sql);

		//TODO: CONTABILIZAR COMISIONES
		// Actualizar SALDO NCP REMITENTE CORRIENTE CAJERO
		  // Actualizar SALDO NCP PAGADOR CORRIENTE CAJERO
				$sql="UPDATE `cuentas` SET `saldo`='$saldoAgenPagoRestanteNCorri',`femovimiento`=now()
									WHERE numerocuenta='$NCPcorriente'";
				ejecutarConsulta($sql);
						// Actualizar SALDO NCP REMITENTE COMISIONES CAJERO
				$sql="UPDATE `cuentas` SET `saldo`='$saldoNCPcomisionesFINAL',`femovimiento`=now()
									WHERE numerocuenta='$NCPcomisiones'";
		return ejecutarConsulta($sql);

	}

}

?>