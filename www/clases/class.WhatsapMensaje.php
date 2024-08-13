<?php 
/**
 * 
 */
class WhatsapMensaje
{
	
	public $db;
	public $token;
	public $phoneid;
	public $Version;
	public $tophone;
	public $accestoken;
	public $texto;
  public $texto1;
  public $texto2;
  public $link;

	public function EnviarMensaje()
	{
	/*	curl -i -X POST \
  https://graph.facebook.com/v18.0/210109905527925/messages \
  -H 'Authorization: Bearer EAAFJOpHSczABOZBgP0LJHOrlj84ZBvuP11f0UCDHaSm6McADjuHEJTz88bxSNJfi2GzsRcYlmA3FOWG4v0jIlJpdwqZCZAg5KMu2GL5JE2PCoZC6amKZCdTtGApCmT2ZCjZBOgo8H74uwZADoZAhiv3d2JivcPZCmujlJcr6venFtlsebWe3n867aR0wXl4yVBZByzIymoley6HPGmQUL34IBwZDZD' \
  -H 'Content-Type: application/json' \
  -d '{ "messaging_product": "whatsapp", "to": "529612170864", "type": "template", "template": { "name": "hello_world", "language": { "code": "en_US" } } }'*/

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://graph.facebook.com/'.$this->Version.'/'.$this->phoneid.'/messages',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>'{
    "messaging_product": "whatsapp",
    "to": "'.$this->tophone.'",
    "type": "template",
    "template": {
        "name": "hello_world",
        "language": {
            "code": "en_US"
        },
        "components": [
            {
                "type": "body",
                "text":"Hi",
                "example": {
                  "body_text": [
                   
                  ]
                }
            },
           
        ]
    }
}

		',
		  CURLOPT_HTTPHEADER => array(
		    'Content-Type: application/json',
		    'Authorization: Bearer '.$this->accestoken.''
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);

    echo $response;
		return $response;

	}




/*public function MensajeSaludo()
{
	
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://graph.facebook.com/'.$this->Version.'/'.$this->phoneid.'/messages',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "messaging_product": "whatsapp",
    "to": "'.$this->tophone.'",
    "type": "template",
    "template": {
        "name": "hello_world",
        "language": {
            "code": "en_US"
        }
    }
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: Bearer '.$this->accestoken.''
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

}*/



public function Envio2($value='')
{
 
$curlCommand = 'curl -i -X POST https://graph.facebook.com/'.$this->Version.'/'.$this->phoneid.'/messages ' .
  '-H "Authorization: Bearer '.$this->accestoken .'' .
  '-H "Content-Type: application/json" ' .
  '-d \'{
    "messaging_product": "whatsapp",
    "to": "'.$this->tophone.'",
    "type": "template",
    "template": {
        "name": "enviotoken",
        "language": {
            "code": "es_MX"
        },
        "components": [
            {
                "type": "body",
                "parameters": [
                    {
                       "type": "text",
                       "text": "'.$this->texto.'"
                    }
                ]
            },
            {
              "type": "button",
              "sub_type": "url",
              "index": 0,
              "parameters": [
                {
                  "type": "text",
                  "text": "'.$this->texto.'"
                }
              ]
            }
          ]
      }
  }\'';

$output = shell_exec($curlCommand);

 var_dump($output);


}


public function EnviarMensajeReserva()
  {
    

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://graph.facebook.com/'.$this->Version.'/'.$this->phoneid.'/messages',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
  "messaging_product": "whatsapp",
  "to": "'.$this->tophone.'",
  "type": "template",
  "template": {
    "name": "notificacionpedido",
    "language": {
      "code": "es_MX"
    },
    "components": [
      {
        "type": "header",
        "parameters": [
          {
            "type": "text",
            "text": "Tu reserva woliss"
          }
        ]
      },
      {
        "type": "body",
        "parameters": [
          {
            "type": "text",
            "text": "'.$this->texto1.'"
          },
          {
            "type": "text",
            "text": "'.$this->texto2.'"
          },
          
        ]
      }
    ]
  }
}


    ',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: Bearer '.$this->accestoken.''
      ),
    ));

    $response = curl_exec($curl);
   echo  json_encode($response);
    curl_close($curl);
    return $response;

  }


public function MensajeNotapago($folio,$detalle,$nombrecliente)
{
   /* $folio = "12345"; // Ejemplo de valor para el parámetro $folio
    $detalle = "Detalle del pedido"; // Ejemplo de valor para el parámetro $detalle
    $nombrecliente = "Nombre del cliente"; // Ejemplo de valor para el parámetro $nombrecliente
*/

   // $detalle = "Detalle del pedido";
    $curl = curl_init();

    // Define los parámetros del cuerpo como un array asociativo
    $body_params = array(
        "messaging_product" => "whatsapp",
        "to" => $this->tophone,
        "type" => "template",
        "template" => array(
            "name" => "notificacionpedido",
            "language" => array(
                "code" => "es_MX"
            ),
            // Agrega la sección de encabezado con el parámetro $folio
            "components" => array(
                array(
                    "type" => "header",
                    "parameters" => array(
                        array(
                            "type" => "text",
                            "text" => $folio
                        )
                    )
                ),
                // Agrega la sección de cuerpo con los parámetros $detalle y $nombrecliente
                array(
                    "type" => "body",
                    "parameters" => array(
                        array(
                            "type" => "text",
                            "text" => $nombrecliente
                        ),
                        array(
                            "type" => "text",
                            "text" =>$detalle 
                        )
                    )
                )
            )
        ),
        // Agrega otros parámetros adicionales al cuerpo si es necesario
        "parametro1" => "valor1",
        "parametro2" => "valor2"
    );

    // Convierte los parámetros del cuerpo a JSON
    $body_json = json_encode($body_params);

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://graph.facebook.com/'.$this->Version.'/'.$this->phoneid.'/messages',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => $body_json, // Usa los parámetros del cuerpo JSON
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: Bearer '.$this->accestoken // Mantiene el parámetro del encabezado existente
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    //echo $response;
}



public function MensajeCancelacion($folio,$detalle,$nombrecliente)
{
  /* $folio = "12345"; // Ejemplo de valor para el parámetro $folio
    $detalle = "Detalle del pedido"; // Ejemplo de valor para el parámetro $detalle
    $nombrecliente = "Nombre del cliente"; // Ejemplo de valor para el parámetro $nombrecliente
*/

   // $detalle = "Detalle del pedido";
    $curl = curl_init();

    // Define los parámetros del cuerpo como un array asociativo
    $body_params = array(
        "messaging_product" => "whatsapp",
        "to" => $this->tophone,
        "type" => "template",
        "template" => array(
            "name" => "notificacionpedidocancel1",
            "language" => array(
                "code" => "es_MX"
            ),
            // Agrega la sección de encabezado con el parámetro $folio
            "components" => array(
                array(
                    "type" => "header",
                    "parameters" => array(
                        array(
                            "type" => "text",
                            "text" => $folio
                        )
                    )
                ),
                // Agrega la sección de cuerpo con los parámetros $detalle y $nombrecliente
                array(
                    "type" => "body",
                    "parameters" => array(
                        array(
                            "type" => "text",
                            "text" => $nombrecliente
                        ),
                        array(
                            "type" => "text",
                            "text" =>$detalle 
                        )
                    )
                )
            )
        ),
        // Agrega otros parámetros adicionales al cuerpo si es necesario
        "parametro1" => "valor1",
        "parametro2" => "valor2"
    );

    // Convierte los parámetros del cuerpo a JSON
    $body_json = json_encode($body_params);

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://graph.facebook.com/'.$this->Version.'/'.$this->phoneid.'/messages',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => $body_json, // Usa los parámetros del cuerpo JSON
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: Bearer '.$this->accestoken // Mantiene el parámetro del encabezado existente
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    //echo $response;
}


public function MensajeReagenda($folio,$detalle,$nombrecliente)
{
  

   // $detalle = "Detalle del pedido";
    $curl = curl_init();

    // Define los parámetros del cuerpo como un array asociativo
    $body_params = array(
        "messaging_product" => "whatsapp",
        "to" => $this->tophone,
        "type" => "template",
        "template" => array(
            "name" => "notificacionpedidoreagenda",
            "language" => array(
                "code" => "es_MX"
            ),
            // Agrega la sección de encabezado con el parámetro $folio
            "components" => array(
                array(
                    "type" => "header",
                    "parameters" => array(
                        array(
                            "type" => "text",
                            "text" => $folio
                        )
                    )
                ),
                // Agrega la sección de cuerpo con los parámetros $detalle y $nombrecliente
                array(
                    "type" => "body",
                    "parameters" => array(
                        array(
                            "type" => "text",
                            "text" => $nombrecliente
                        ),
                        array(
                            "type" => "text",
                            "text" =>$detalle 
                        )
                    )
                )
            )
        ),
        // Agrega otros parámetros adicionales al cuerpo si es necesario
        "parametro1" => "valor1",
        "parametro2" => "valor2"
    );

    // Convierte los parámetros del cuerpo a JSON
    $body_json = json_encode($body_params);

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://graph.facebook.com/'.$this->Version.'/'.$this->phoneid.'/messages',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => $body_json, // Usa los parámetros del cuerpo JSON
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: Bearer '.$this->accestoken // Mantiene el parámetro del encabezado existente
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    //echo $response;
}



}



 ?>