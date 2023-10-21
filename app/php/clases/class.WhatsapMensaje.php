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
	public function EnviarMensaje()
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
}

		',
		  CURLOPT_HTTPHEADER => array(
		    'Content-Type: application/json',
		    'Authorization: Bearer '.$this->accestoken.''
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		return $response;

	}




public function MensajeSaludo()
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
        "name": "saludo",
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

}

}



 ?>