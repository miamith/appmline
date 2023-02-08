<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Banco
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre,$descripcion,$pais,$max_agencias,$ncp,$ncpComisiones,$ncpIVA,$responsable,$agente)
	{ 
		
		$sql="INSERT INTO `banco`(`idbanco`, `nombre`, `descripcion`, `pais`, `max_agencias`, `ncp`, `ncpComisiones`, 
                            `ncpIVA`, `responsable`, `agentcrea`, `fecrea`, `agenmodif`, `femodif`, `eliminado`)
                    VALUES (NULL,'$nombre','$descripcion','$pais','$max_agencias','$ncp','$ncpComisiones','$ncpIVA',
                    '$responsable','$agente',now(), NULL,NULL, '0')";
		return ejecutarConsulta($sql);
        
	}

	//Implementamos un método para editar registros
	public function editar($idbanco,$nombre,$descripcion,$pais,$max_agencias,$ncp,$ncpComisiones,$ncpIVA,$responsable,$agente)
	{
		$sql="UPDATE banco SET nombre='$nombre',descripcion='$descripcion',pais='$pais',max_agencias='$max_agencias',
								 ncp='$ncp',ncpComisiones='$ncpComisiones',ncpIVA='$ncpIVA',responsable='$responsable',
                                 agenmodif='$agente',femodif=now()
							  WHERE idbanco='$idbanco'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para eliminar categorías
	public function eliminar($idbanco,$agente)
	{
		$sql="UPDATE banco SET eliminado=1,agenmodif='$agente',femodif=now()
	 						  WHERE idbanco='$idbanco'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idbanco)
	{
		$sql="SELECT idbanco,nombre,descripcion,pais,max_agencias,ncp,ncpComisiones,ncpIVA,
		responsable FROM banco WHERE idbanco='$idbanco'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar($pais,$agencia_em,$rol,$ap)
	{
		// CONTROL DEL ROL DEL USUARIO
		switch ($rol){
		
            case 'Administrador':
            case 'Agencia':
			case 'CajeroUV':
            case 'Cajero':
				$sql="SELECT idbanco, nombre,descripcion,
                        (SELECT nombre FROM paises WHERE idPais=pais) as pais_nombre,
                        (SELECT nomcompleto FROM empleados e, clientes r WHERE e.DNI=r.DNIremitente AND ap=responsable) as responsable_nombre,
                        max_agencias,ncp,ncpComisiones,ncpIVA,
                        (SELECT saldo FROM cuentas c WHERE c.numerocuenta=ncp) as ncpCapitalSaldo, 
                        (SELECT saldo FROM cuentas c WHERE c.numerocuenta=ncpComisiones) as ncpComisionesSaldo,
                        (SELECT saldo FROM cuentas c WHERE c.numerocuenta=ncpIVA) as ncpIVASaldo,
                        responsable,agentcrea,fecrea 
                FROM banco WHERE eliminado=0 AND pais='$pais' AND responsable='$ap'";
				return ejecutarConsulta($sql);
			break;

			default:
                    $sql="SELECT idbanco, nombre,descripcion,
                    (SELECT nombre FROM paises WHERE idPais=pais) as pais_nombre,
                    (SELECT nomcompleto FROM empleados e, clientes r WHERE e.DNI=r.DNIremitente AND ap=responsable) as responsable_nombre,
                    max_agencias,ncp,ncpComisiones,ncpIVA,
                    (SELECT saldo FROM cuentas c WHERE c.numerocuenta=ncp) as ncpCapitalSaldo, 
                    (SELECT saldo FROM cuentas c WHERE c.numerocuenta=ncpComisiones) as ncpComisionesSaldo,
                    (SELECT saldo FROM cuentas c WHERE c.numerocuenta=ncpIVA) as ncpIVASaldo,
                    responsable,agentcrea,fecrea 
            FROM banco WHERE eliminado=0";
			return ejecutarConsulta($sql);


		} // FIN SWITCH
	}




            //Implementar un método para listar los registros y mostrar en el select
        public function generarNCPCreaBanco($responsable)
        {
            $sql="SELECT idempleado,ap,DNI FROM empleados WHERE ap='$responsable'";
    
            return ejecutarConsultaSimpleFila($sql);		
        }

		//Mostrar o traer el saldo actual de la cuenta seleccinada del cliente
        public function traerSaldoActual($numerocuenta)
        {
            $sql="SELECT saldo, tipo_cuenta, cliente 
            FROM cuentas WHERE  numerocuenta='$numerocuenta'
            AND cuenta_cerrada='NO'";
            return ejecutarConsultaSimpleFila($sql);
        }



  
		  //Implementamos un método para insertar registros
	  public function insertarDineroEnbanco($referencia,$nombreBeneficiario,$ncpCREDITAR,$monto,$saldoBancoFinal,$tipo,$codigo,$descripcion,$idbancoOP,$paisorigen,$agente,$agencia_em)
	  { 
  
		  // Insertar de una Agencia caja PARA LINEA DE CAJA SENTIDO CREDITO
		 $sql="INSERT INTO `transaccion`(`idtransaccion`, `referencia`, `remitente`, `cuenta_remi`, `receptor`, 
							`cuenta_recep`, `ageenvia`, `agerecibe`, `pais_origen`, `pais_destino`, `tipo`, `monto`,`cobrar`,
							 `comision`, `comi_empre`, `comi_remi`, `comi_benef`, `IVA`, `saldo_rescuenta`, `codigo`,
							 `codigo_ope`, `sentido`, `descripcion`, `secreto`, `sms_mobil`, `estadot`, `objeto`, `agentcreat`,
							  `agenmod`, `fecrea`, `femodif`)
					   VALUES (NULL,'$referencia','$nombreBeneficiario','$ncpCREDITAR','$nombreBeneficiario','$ncpCREDITAR',
					   '$agencia_em','$agencia_em','$paisorigen','$paisorigen','1','$monto',NULL,NULL,
					   NULL,NULL,NULL,NULL,NULL,'$codigo','000','C','$descripcion',NULL,'sin sms movil RECARGA BANCO','Recibido','$idbancoOP',
						'$agente', NULL, now(), NULL)";
		 //var_dump($sql);
		  ejecutarConsulta($sql);
		   
		  // Actualizar SALDO NCP BANCO CAPITAL
		  $sql="UPDATE `cuentas` SET `saldo`='$saldoBancoFinal',`femovimiento`=now()
								 WHERE numerocuenta='$ncpCREDITAR'";
		  return ejecutarConsulta($sql);
	 
  
	  }

 		
  
  


}

?>