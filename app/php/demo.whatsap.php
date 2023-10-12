
<?php 

		//Ejemplo de cÃ³digo de envio de 
		un archivo (soporta los formatos de audio, video, imagen, pdf que soporta whatsapp)
		$data = [
			"numero" => "525555555555", // Poner el numero de telefono destino con codigo del pais 
			"url" => "https://whatzmeapi.com/images/about-us.png", // URL que contiene el archivo a enviar
			"nombrearchivo" => "whatzmeapi.png", // Con este nombre se guarda el archivo en el dipositivo del destinatario.
			"textoimagen" => "Hola este texto es de prueba y acompaÃ±a al archivo" // Si el formato es imagen el texto puede ser mas largo y contener emojis
		];
		$json = json_encode($data); // Codifica los datos en formato json
		try {
		
		
		// URL del API que contiene el token e invoca al servicio enviar-archivo
		$url = 'https://whatzmeapi.com:10501/rest/api/enviar-archivo?token=XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX';
		//Los demas servicios disponibles asi como los parametros de envio y valores de respuesta, los puedes encontrar aqui https://whatzmeapi.com:10501/rest/swagger-ui.html
		
		$context = stream_context_create([
					'http' => [
						'method' => 'POST',
						'header' => "Content-type: application/json\r\n" .
									"Accept: application/json\r\n" .
									"Connection: close\r\n" .
									"Content-length: " . strlen($json) . "\r\n",
						'protocol_version' => 1.1,
						'content' => $json
					],
					'ssl' => [
						'verify_peer' => false,
						'verify_peer_name' => false
					]
				]);
		// Envia la peticion y obtiene la respuesta
		$rawdata = file_get_contents($url, false, $context);
		
		//Resultado de la peticion, siempre debe devolver un formato JSON.
		$resultado = '';
		
		if ($rawdata === false) {
			$resultado = "No se pudo hacer la peticion.";
		}
		$data = json_decode($rawdata, true);
		if (JSON_ERROR_NONE !== json_last_error()) {
			$resultado = "Error al enviar o recibir el JSON: " . json_last_error_msg();
		}
		$resultado = "WhatsApp enviado correctamente";
		
		
		} catch (Exception $exw){
			echo($exw->getMessage());
		}