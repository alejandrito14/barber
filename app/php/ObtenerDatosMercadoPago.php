<?php 

header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');
error_reporting(E_ALL);

//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.ClienteMercadoPago.php");
require_once("clases/class.Tipodepagos.php");





try
{


	$obj = new ClienteMercadoPago();
	$folio = "";
	//Declaramos objetos de clases
	$db = new MySQL();

	//Enviamos la conexion a la clase
	$obj->db = $db;
	$obj->idusuarios=$_POST['idcliente'];
    $fname = $_POST['fname'];

    $idtipodepago=$_POST['idtipodepago'];
    //$idtipodepago=3;//SOLOTEST
    

    $tipopago=new Tipodepagos();
    $tipopago->db=$db;
    $tipopago->idtipodepago=$idtipodepago;
    $obtenertipopago=$tipopago->ObtenerTipodepago2();
    $skey=$obtenertipopago[0]->claveprivada;
    $pub_key=$obtenertipopago[0]->clavepublica;
    $obj->skey=$skey;
         	$access_token = $skey;

 switch ($fname) {
	  case 'setupIntent':
            

            $idclientestripe = ObtenerIdClienteMercadopago($obj);
            
     		

            $output = json_encode($setupIntent);
            echo $output;


             
             break;

          case 'getCardList':
           

            $idclientestripe = ObtenerIdClienteMercadopago($obj,$access_token); 
          	
          
            if ($idclientestripe != null) {
               $obtenerlistado=ObtenerListadoTarjeta($idclientestripe,$access_token);
              
               	$array['tarjetas']=$obtenerlistado;
                echo json_encode($array);
            }
            else{
                echo json_encode(array(), JSON_FORCE_OBJECT);
            }            
        break;


        case 'SaveTarjet'

        	$numerotarjeta=$_POST['numerotarjeta'];
        	$mesexpiracion=$_POST['mesexpiracion'];
        	$anioexpiracion=$_POST['anioexpiracion'];
        	$nombredeltitular=$_POST['nombredeltitular']
        	$cardtoken=GuardarTarjeta($access_token, $numerotarjeta, $mesexpiracion, $nombredeltitular, $cvv);



        break;
        default:
            $array->resultado = "Error: ".$e;
            $array->msg = "Error al ejecutar el php";
            $array->id = '0';
            //Retornamos en formato JSON 
            $myJSON = json_encode($array);
            echo $myJSON;
      }

} 
catch(Exception $e){
	$array->resultado = "Error: ".$e;
	$array->msg = "Error al ejecutar el php";
	$array->id = '0';
		//Retornamos en formato JSON 
	$myJSON = json_encode($array);
	echo $myJSON;
}

function ObtenerIdClienteMercadopago($obj,$access_token)
{

    $dbresult = $obj->ObtenerIDCustomer();
    $a_result=$obj->db->fetch_assoc($dbresult);
    $row_resultado=$obj->db->num_rows($dbresult);
    $idclientestripe='';
    if ($row_resultado>0) {
          $idclientestripe = $a_result['customerid_mercadopago']; 

    }


    if($idclientestripe == '')
    {
        $dbresult = $obj->ObtenerDatosCliente();
        $a_result=$obj->db->fetch_assoc($dbresult);
        $nombrecliente = $a_result['nombre'] . " " . $a_result['paterno'];
       $correo=$a_result['email'];
     	
		$url = "https://api.mercadopago.com/v1/customers";

		$data = array(
		    "email" => 'alelike11@gmail.com',
		    "first_name"=>$a_result['nombre'],
		     "last_name"=>$a_result['paterno'].' '.$a_result['materno'],
		);
		
		$options = array(
		    CURLOPT_URL => $url,
		    CURLOPT_HTTPHEADER => array(
		        "Authorization: Bearer " . $access_token,
		        "Content-Type: application/json"
		    ),
		    CURLOPT_POST => true,
		    CURLOPT_POSTFIELDS => json_encode($data),
		    CURLOPT_RETURNTRANSFER => true
		);

		$curl = curl_init();
		curl_setopt_array($curl, $options);
		$response = curl_exec($curl);
		curl_close($curl);

// Manejar la respuesta
		if ($response) {
		    $customer = json_decode($response);
		  
		    $obj->customerid=$customer->id;
		        $obj->GuardarIdCustomer();
		        $idclientestripe = $customer->id;
		} else {
		    echo "Error al crear el cliente";
		}

        
    } 
    return $idclientestripe;
}

 function ObtenerListadoTarjeta($idclientestripe,$access_token)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://api.mercadopago.com/v1/customers/".$idclientestripe."/cards");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	    "Authorization: Bearer ".$access_token
	));


	$response = curl_exec($ch);
	$tarjetas=array();
	$cards = json_decode($response, true);
	foreach ($cards as $card) {
	    // Accede a los datos de cada tarjeta
	    $cardId = $card['id'];
	    $cardNumber = $card['last_four_digits'];
	    $arrayt = array('cardid' =>$cardId ,'cardNumber'=>$cardNumber );

	    array_push($tarjetas, $arrayt);

	    
	}
	//$cards = json_decode($response, true);
	return $tarjetas;
}

function GuardarTarjeta($access_token,$numerotarjeta,$mesexpiracion,$nombredeltitular,$cvv)
{
	// Datos de autenticación

// Datos de la tarjeta
$card_number = $numerotarjeta;
$card_expiration_month = $mesexpiracion;
$card_expiration_year =$anioexpiracion;
$card_holder_name = $nombredeltitular;
$card_identification_type = 'CPF';
$card_identification_number = $cvv;

// URL de la API de Mercado Pago
$url = 'https://api.mercadopago.com/v1/card_tokens?access_token=' . $access_token;

// Datos del request
$data = array(
    'card_number' => $card_number,
    'expiration_month' => $card_expiration_month,
    'expiration_year' => $card_expiration_year,
    'cardholder' => array(
        'name' => $card_holder_name,
        'identification' => array(
            'type' => $card_identification_type,
            'number' => $card_identification_number
        )
    )
);

// Configuración de cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

// Realizar la solicitud
$response = curl_exec($ch);
curl_close($ch);

// Decodificar la respuesta JSON
$result = json_decode($response, true);

// Verificar si se generó el card_token correctamente

	if (isset($result['id'])) {
	    $card_token = $result['id'];
	   // echo 'El card_token se generó correctamente: ' . $card_token;

	    return $cardtoken;
	} else {
	    echo 'Hubo un error al generar el card_token: ' . $result['message'];
	}



}
?>