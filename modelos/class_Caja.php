<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Caja
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($cliente,$agencia,$nombre,$cajero,$ncpCorriente,$ncpComisiones,$montoMaxEnvio,$cajacerrada,$agente)
	{ 
		
        // Insertar de una Agencia caja
       $sql2="INSERT INTO `cajas` (`idCaja`, `nombre`, `agencia`, `cliente`, `cajero`, `ncpCorriente`, `ncpComisiones`,
                                 `auditada`, `montoMaxEnvio`, `cajacerrada`, `fecrea`, `usCreador`) 
                     VALUES (NULL,'$nombre','$agencia', '$cliente', '$cajero','$ncpCorriente','$ncpComisiones',
                             'NO', '$montoMaxEnvio', '$cajacerrada',now(), '$agente')";
        return ejecutarConsulta($sql2);

	}

	//Implementamos un método para editar registros
	public function editar($idCaja,$cliente,$agencia,$nombre,$cajero,$ncpCorriente,$ncpComisiones,$montoMaxEnvio,$cajacerrada,$agente)
	{
		$sql="UPDATE cajas SET nombre='$nombre',cliente='$cliente',agencia='$agencia',cajero='$cajero',
                                ncpCorriente='$ncpCorriente', ncpComisiones='$ncpComisiones', montoMaxEnvio='$montoMaxEnvio',
                                cajacerrada='$cajacerrada'
							  WHERE idCaja='$idCaja'";
		return ejecutarConsulta($sql);


	}

	//Implementamos un método para eliminar categorías
	public function eliminar($idCaja)
	{
		$sql="UPDATE cajas SET cajacerrada='SI'
	 						  WHERE idCaja='$idCaja'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idCaja)
	{
		$sql="SELECT `idCaja`, `nombre`, `agencia`, `cliente`, `cajero`, `ncpCorriente`, `ncpComisiones`, 
                    `auditada`, `montoMaxEnvio`, `cajacerrada`, `fecrea`, `usCreador` FROM `cajas` WHERE idCaja='$idCaja'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar($pais,$agencia_em,$rol,$ap)
	{
		// CONTROL DEL ROL DEL USUARIO
		switch ($rol){
		

			case 'Agencia':

                $sql="SELECT idCaja,nombre,
                (select a.nombre from agencias a where a.idagencia=agencia) as agencia,
                (select nomcompleto from clientes c where c.DNIremitente=cliente) as cliente,
                (select nomcompleto from clientes c, empleados e where c.DNIremitente=e.DNI AND e.ap=cajero) as cajero, 
                (SELECT saldo FROM cuentas c WHERE c.numerocuenta=ncpCorriente) as ncpCorrienteSaldo, 
                (SELECT saldo FROM cuentas c WHERE c.numerocuenta=ncpComisiones) as ncpComisionesSaldo,
                ncpCorriente, 
                ncpComisiones,
                montoMaxEnvio,cajacerrada,fecrea,usCreador FROM `cajas` 
                WHERE agencia='$agencia_em'";
		    return ejecutarConsulta($sql);
            break;
            case 'Cajero':

                $sql="SELECT idCaja,nombre,
                (select a.nombre from agencias a where a.idagencia=agencia) as agencia,
                (select nomcompleto from clientes c where c.DNIremitente=cliente) as cliente,
                (select nomcompleto from clientes c, empleados e where c.DNIremitente=e.DNI AND e.ap=cajero) as cajero, 
                (SELECT saldo FROM cuentas c WHERE c.numerocuenta=ncpCorriente) as ncpCorrienteSaldo, 
                (SELECT saldo FROM cuentas c WHERE c.numerocuenta=ncpComisiones) as ncpComisionesSaldo,
                ncpCorriente, 
                ncpComisiones,
                montoMaxEnvio,cajacerrada,fecrea,usCreador FROM `cajas` 
                WHERE agencia='$agencia_em' AND cajero='$ap'";
		    return ejecutarConsulta($sql);
            break;
            default:
                $sql="SELECT idCaja,nombre,
                (select a.nombre from agencias a where a.idagencia=agencia) as agencia,
                (select nomcompleto from clientes c where c.DNIremitente=cliente) as cliente,
                (select nomcompleto from clientes c, empleados e where c.DNIremitente=e.DNI AND e.ap=cajero) as cajero, 
                (SELECT saldo FROM cuentas c WHERE c.numerocuenta=ncpCorriente) as ncpCorrienteSaldo, 
                (SELECT saldo FROM cuentas c WHERE c.numerocuenta=ncpComisiones) as ncpComisionesSaldo,
                ncpCorriente, 
                ncpComisiones,
                montoMaxEnvio,cajacerrada,fecrea,usCreador FROM `cajas`";
            return ejecutarConsulta($sql);
        } // FIN SWITCH

	}


    
    		//Implementar un método para poner agencia del cliente
	public function ponerAgenciaCliente($cliente)
	{
		$sql="SELECT idempleado,DNI, agencia_em FROM empleados WHERE DNI='$cliente'";
		return ejecutarConsultaSimpleFila($sql);		
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

            $sql="SELECT numerocuenta,pais, saldo,
            (SELECT agencia_em FROM empleados e WHERE e.DNI=a.DNIremitente) as agencia_em 
            FROM clientes a, cuentas b WHERE a.DNIremitente=b.cliente AND a.DNIremitente='$cliente' 
            AND b.tipo_cuenta='CUENTA_COMISIONES'";
		    return ejecutarConsultaSimpleFila($sql);
        } else {
            $sql="SELECT numerocuenta,pais, saldo,
            (SELECT agencia_em FROM empleados e WHERE e.DNI=a.DNIremitente) as agencia_em 
            FROM clientes a, cuentas b WHERE a.DNIremitente=b.cliente AND a.DNIremitente='$cliente' 
            AND b.tipo_cuenta='CUENTA_CORRIENTE'";
            return ejecutarConsultaSimpleFila($sql);	
        }
        	
	}

// Buscar Cuentas del cajero
    //Implementar un método para filtar 
	public function ponerNCPCajero($cajero)
	{
		
            $sql="SELECT e.DNI,
            (select numerocuenta FROM cuentas c WHERE c.tipo_cuenta='CUENTA_CORRIENTE' AND e.DNI=c.cliente) as ncpCorriente,
            (select numerocuenta FROM cuentas c WHERE c.tipo_cuenta='CUENTA_COMISIONES' AND e.DNI=c.cliente) as ncpComisiones
            FROM empleados e 
            WHERE e.rol IN ('Cajero','CajeroUV')
            AND e.ap='$cajero'";
		    return ejecutarConsultaSimpleFila($sql);
        	
	}


  //Implementar un método para filtar 
	public function verificarSaldo($clienteremitente,$ncpremitente)
	{
		$sql="SELECT numerocuenta,saldo FROM clientes a, cuentas b WHERE a.DNIremitente=b.cliente AND a.DNIremitente='$clienteremitente' AND b.numerocuenta='$ncpremitente'";
		return ejecutarConsulta($sql);		
	}

    	//Implementamos un método para insertar registros
	public function insertarDineroEnCaja($referencia,$clienteremitente,$clientebeneficiario,$paisorigen,$paisdestino,$agenciaremitente,$ncpremitente,
    $agenciabeneficiaria,$ncpbeneficiaria,$monto,$saldoRemitenteRestante,$saldoBeneficiarioResultante,$tipo,$codigo,$descripcion,$idCajaOP,$agente)
	{ 

        // Insertar de una Agencia caja PARA LINEA DE CAJA SENTIDO CREDITO
       $sql="INSERT INTO `transaccion`(`idtransaccion`, `referencia`, `remitente`, `cuenta_remi`, `receptor`, 
                          `cuenta_recep`, `ageenvia`, `agerecibe`, `pais_origen`, `pais_destino`, `tipo`, `monto`,`cobrar`,
                           `comision`, `comi_empre`, `comi_remi`, `comi_benef`, `IVA`, `saldo_rescuenta`, `codigo`,
                           `codigo_ope`, `sentido`, `descripcion`, `secreto`, `sms_mobil`, `estadot`, `objeto`, `agentcreat`,
                            `agenmod`, `fecrea`, `femodif`) 
                     VALUES (NULL,'$referencia','$clienteremitente', '$ncpremitente', '$clientebeneficiario','$ncpbeneficiaria',
                     '$agenciaremitente','$agenciabeneficiaria','$paisorigen','$paisdestino','$tipo','$monto',NULL, NULL,
                     NULL, NULL, NULL, NULL, NULL,'$codigo','004','C','$descripcion',NULL,'sin sms movil','Recibido','$idCajaOP',
                      '$agente', NULL, now(), NULL)";
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
            NULL, NULL, NULL, NULL, NULL,'$codigo','004','D','$descripcion',NULL,'sin sms movil','Recibido','$idCajaOP',
            '$agente', NULL, now(), NULL)";
            return ejecutarConsulta($sql);


	}


    		//Implementar un método para listar los registros y mostrar en el select
/* 	public function selectEmpleado()
    {
        $sql="SELECT idempleado,ap,DNI,(select nomcompleto from clientes r WHERE r.DNIremitente=DNI) as nomcompleto FROM empleados";
        return ejecutarConsulta($sql);		
    } */


}

?>