<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Cuenta
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($numerocuenta,$cliente,$saldo,$tipo_cuenta,$agencialigada,$gestor,$cuenta_cerrada,$agente)
	{ 
		
		/*$sql="INSERT INTO clientes (`DNIremitente`, `nomcompleto`, `tel`, `pais`, `direccion`, `agencia_cli`,
                                     `estado`, `agencrea`, `fecrea`, `agenmodif`, `femodif`) 
					VALUES ('$DNIremitente','$nomcompleto','$tel','$pais','$direccion','$agencia_cli','$estado','$agente',now(),NULL,NULL)";
		return ejecutarConsulta($sql);*/

        // Insertar cuenta corriente
        //CUENTA_CORRIENTE, CUENTA_AHORRO, CUENTA_IVA, CUENTA_COMISIONES, CUENTA_AGENCIA, CUENTA_GASTOS, CUENTA_CAPITAL, CUENTA_PERDIDAS
       $sql2="INSERT INTO `cuentas` (`numerocuenta`, `cliente`, `saldo`, `tipo_cuenta`, `agencialigada`, `gestor`,`firma`, 
                                    `cuenta_cerrada`, `femovimiento`, `usCreador`, `fecreacion`, `control`) 
                     VALUES ('$numerocuenta', '$cliente', '0', '$tipo_cuenta', '$agencialigada', '$gestor','ESCANEAR', '$cuenta_cerrada', NULL, '$agente', now(), '0')";
        return ejecutarConsulta($sql2);

	}

	//Implementamos un método para editar registros
	public function editar($numerocuenta,$cliente,$saldo,$tipo_cuenta,$agencialigada,$gestor,$cuenta_cerrada,$agente)
	{
		$sql="UPDATE cuentas SET agencialigada='$agencialigada',
								 gestor='$gestor', cuenta_cerrada='$cuenta_cerrada'
							  WHERE numerocuenta='$numerocuenta'";
		return ejecutarConsulta($sql);


	}

	//Implementamos un método para eliminar categorías
	public function eliminar($numerocuenta)
	{
		$sql="UPDATE cuentas SET cuenta_cerrada='SI'
	 						  WHERE numerocuenta='$numerocuenta'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($numerocuenta)
	{
		$sql="SELECT numerocuenta, cliente,saldo,tipo_cuenta,agencialigada,gestor,cuenta_cerrada 
        FROM cuentas WHERE  numerocuenta='$numerocuenta'";
		return ejecutarConsultaSimpleFila($sql);
	}

		//Cuentas a mostrar segun cliente selecionado
	public function selectCuentasRemitente($clienteremitente)
	{
		$sql="SELECT numerocuenta, tipo_cuenta 
        FROM cuentas WHERE  cliente='$clienteremitente'
		AND cuenta_cerrada='NO'";
		return ejecutarConsulta($sql);
	}

	//Cuentas a mostrar segun cliente selecionado
	public function selectCuentasBeneficiaria($clientebeneficiario)
	{
		$sql="SELECT numerocuenta, tipo_cuenta 
        FROM cuentas WHERE  cliente='$clientebeneficiario'
		AND cuenta_cerrada='NO'";
		return ejecutarConsulta($sql);
	}
	
		//Mostrar o traer el saldo actual de la cuenta seleccinada del cliente
	public function traerSaldoActual($numerocuenta)
	{
		$sql="SELECT saldo, tipo_cuenta, cliente 
        FROM cuentas WHERE  numerocuenta='$numerocuenta'
		AND cuenta_cerrada='NO'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar($pais,$agencia_em,$rol,$ap)
	{

        $sql="SELECT 
        (select nomcompleto from clientes c where c.DNIremitente=cliente) as nomcompleto,
        `numerocuenta`, `cliente`, `saldo`, `tipo_cuenta`, `agencialigada`,
        (select a.nombre from agencias a where a.idagencia=agencialigada) as nomagencialigada,
        `gestor`,
        (select em.ap from empleados em where em.ap=gestor) as nomgestor,
        (select p.nombre from clientes c, paises p where c.pais=p.idPais AND c.DNIremitente=cliente) as nombre_pais,
        (select c.tel from clientes c where c.DNIremitente=cliente) as tel,
        `firma`,
        `cuenta_cerrada`, `femovimiento`, `usCreador`, `fecreacion`, `control` FROM `cuentas`";

		return ejecutarConsulta($sql);
	}


    		//Implementar un método para listar los registros y mostrar en el select
	public function selectEmpleado()
	{
		$sql="SELECT idempleado,ap,DNI, agencia_em, (select nomcompleto from clientes r WHERE r.DNIremitente=DNI) as nomcompleto FROM empleados";
		return ejecutarConsulta($sql);		
	}


}

?>