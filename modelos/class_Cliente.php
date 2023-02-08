<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Cliente
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($DNIremitente,$nomcompleto,$tel,$pais,$direccion,$agencia_cli,$estado,$ncp,$agente)
	{ 
		// Insertar cuenta corriente
		//CUENTA_CORRIENTE, CUENTA_AHORRO, CUENTA_IVA, CUENTA_COMISIONES, CUENTA_AGENCIA, CUENTA_GASTOS, CUENTA_CAPITAL, CUENTA_PERDIDAS
	   $sql="INSERT INTO `cuentas` (`numerocuenta`, `cliente`, `saldo`, `tipo_cuenta`, `agencialigada`, `gestor`, `firma`, 
									`cuenta_cerrada`, `femovimiento`, `usCreador`, `fecreacion`, `control`) 
					 VALUES ('$ncp', '$DNIremitente', '0', 'CUENTA_CORRIENTE', NULL, NULL, 'ESCANEAR', 'NO', NULL, '$agente', now(), '0')";
		ejecutarConsulta($sql);
		
		$sql="INSERT INTO clientes (`DNIremitente`, `nomcompleto`, `tel`, `pais`, `direccion`, `agencia_cli`,
                                     `estado`, `agencrea`, `fecrea`, `agenmodif`, `femodif`) 
					VALUES ('$DNIremitente','$nomcompleto','$tel','$pais','$direccion','$agencia_cli','$estado','$agente',now(),NULL,NULL)";
		return ejecutarConsulta($sql);


	}

	//Implementamos un método para editar registros
	public function editar($DNIremitente,$nomcompleto,$tel,$pais,$direccion,$agencia_cli,$estado,$agente)
	{
		$sql="UPDATE clientes SET nomcompleto='$nomcompleto',tel='$tel',pais='$pais',direccion='$direccion',
								 agencia_cli='$agencia_cli',estado='$estado',agenmodif='$agente',femodif=now()
							  WHERE DNIremitente='$DNIremitente'";
		return ejecutarConsulta($sql);


	}

	//Implementamos un método para eliminar categorías
	public function eliminar($DNIremitente,$agente)
	{
		$sql="UPDATE clientes SET estado=3,agenmodif='$agente',femodif=now()
	 						  WHERE DNIremitente LIKE '%$DNIremitente'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($DNIremitente)
	{
		$sql="SELECT DNIremitente, nomcompleto,tel,pais,agencia_cli,direccion,estado,
        (select numerocuenta FROM cuentas c WHERE c.cliente=clientes.DNIremitente AND c.tipo_cuenta='CUENTA_CORRIENTE') as numerocuenta 
        FROM clientes WHERE  DNIremitente LIKE '%$DNIremitente'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
    		$sql="SELECT DNIremitente, nomcompleto,tel,
            (select numerocuenta FROM cuentas c WHERE c.cliente=clientes.DNIremitente AND c.tipo_cuenta='CUENTA_CORRIENTE') as ncp,
            (select saldo FROM cuentas c WHERE c.cliente=clientes.DNIremitente AND c.tipo_cuenta='CUENTA_CORRIENTE') as saldo, 
            (SELECT nombre FROM paises WHERE idPais=pais) as pais_nombre,
            (select nombre from agencias where idagencia=agencia_cli) as agencia, 
            direccion,estado,agencrea,fecrea FROM clientes WHERE estado!='3'";
		return ejecutarConsulta($sql);
	}

	// Selec de clientes
	public function selectClientes($pais,$agencia_em,$rol,$ap)
	{
		// CONTROL DEL ROL DEL USUARIO
		switch ($rol){
		
		   case 'Agencia':
				$sql="SELECT DNIremitente, nomcompleto 
				FROM clientes 
				WHERE estado!='3' AND agencia_cli='$agencia_em' AND pais='$pais'";
				return ejecutarConsulta($sql);
			break;
			default:
			$sql="SELECT DNIremitente, nomcompleto FROM clientes WHERE estado!='3'";
				return ejecutarConsulta($sql);
		
		   }  // FIN SWITCH

	}


}

?>