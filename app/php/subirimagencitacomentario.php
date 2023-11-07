<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');

error_reporting(0);

//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Imagencita.php");
require_once("clases/class.Funciones.php");

try
{		
	//Declaramos objetos de clases
	$db = new MySQL();
	$act = new Imagencita();
	$f = new Funciones();
	
	$db->begin();
	
	//Enviamos la conexion a las clases
	$act->db = $db;
	
	//Recibimos datos
	//$descripcion = utf8_decode($_REQUEST['descripcion']);
	/*$id = $_REQUEST['iduser'];
	
	$act->idCliente = $id;*/
		
	//guardamos el registro
	/*$act->guardar_registro_foto();
	$idultimo = $act->idactividades_fotos;*/
	
	$new_image_name = urldecode($_FILES["file"]["name"]);
    //move_uploaded_file($_FILES["file"]["tmp_name"], "upload/".$new_image_name);
	
	foreach($_FILES as $key) 
	  {
		if($key['error'] == UPLOAD_ERR_OK ){//Verificamos si se subio correctamente
		   	$date=date('Y-m-d H:i:s');
			$nombre = $date.'_'.$key['name'];//Obtenemos el nombre del archivo
			
			$nombre_img = $nombre;
			
			//$nombre = $nombre_img[0].".jpg";
			/*$nombre = $nombre_img[0];*/
			
		  	$temporal = $key['tmp_name']; //Obtenemos el nombre del archivo temporal
		  		  
		  	move_uploaded_file($temporal,"upload/imagencita/".$nombre); //Movemos el archivo temporal a la ruta especificada
		  	//El echo es para que lo reciba jquery y lo ponga en el div "cargados"
		  	$act->foto = $nombre;
		  	//$act->actualizar_nombre_foto();
		}
	  }
	
	//Almacenamos los datos obtenidos en una variable			
	$array[0] = array("respuesta"=>"1", "ruta"=>$nombre);  
	
	$db->commit();
	

	//Convertirmos a JSON
	$myJSON = json_encode($array);
	print_r($myJSON);
		
}catch(Exception $e){
	$db->rollback();
	$array[0] = array("respuesta"=>"0");  
	print_r($myJSON);
}

?>