<?php
//Incluímos inicialmente la conexión a la base de datos
require_once "../config/Conexion.php";
require __DIR__ . '/../vendor/autoload.php';
use Twilio\Rest\Client;

Class Mensajeria {

    //Implementamos nuestro constructor
	public function __construct()
	{

	}



    public function SMS($mensaje,$telefono){

        $account_sid = TWILIO_ACCOUNT_SID;
        $auth_token = TWILIO_AUTH_TOKEN;
        
        $twilio_number = "M_LINEMONEY";
        
        $client = new Client($account_sid, $auth_token);
        $client->messages->create(
            // Where to send a text message (your cell phone?)
            $telefono,
            array(
                'from' => $twilio_number,
                'body' => $mensaje
            )
        );
    }

    public function prefijoTel($pais)
	{
		$sql="SELECT prefijoTel FROM paises WHERE  idPais='$pais'";
		 $reg=ejecutarConsulta($sql);
        $row = $reg->fetch_assoc();
        return $row['prefijoTel'];
	}


}

?>