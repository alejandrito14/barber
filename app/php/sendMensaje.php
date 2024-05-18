<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');

//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.WhatsapMensaje.php");
require_once("clases/class.Funciones.php");



try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$f=new Funciones();
	$mensaje=new WhatsapMensaje();
	$mensaje->db=$db;
/*	$mensaje->Version='v17.0';
*/	//$mensaje->phoneid='136352302900365';
/*	$mensaje->phoneid='162367660284534';
*/	$mensaje->tophone='529612170864';
	$texto='hola';
	/*$mensaje->accestoken='EAAPR4S8LbikBO5OooXf3Uz8fFxvpf9r4zSKZBz5otYZAgNtYBwt4flObUw5YT0ZCXKDXO3BmUV3NfOWFZBsCErVHEor4ZBeoRDv5HcC0lMDujBFGYj9DXLmoYw1OzcbfUaMDjhXUt4p05I6ZArul74mHTNpXeDhg67YoCORxTlXjbLcPBP9ZCYs34cYZA7Jd';*/
	$mensaje->texto="1402";

	$mensaje->Version='v19.0';
    $mensaje->phoneid='210109905527925';
    //$mensaje->tophone='52'.$lo->celular;
  
    //$mensaje->accestoken='EAAPR4S8LbikBO5OooXf3Uz8fFxvpf9r4zSKZBz5otYZAgNtYBwt4flObUw5YT0ZCXKDXO3BmUV3NfOWFZBsCErVHEor4ZBeoRDv5HcC0lMDujBFGYj9DXLmoYw1OzcbfUaMDjhXUt4p05I6ZArul74mHTNpXeDhg67YoCORxTlXjbLcPBP9ZCYs34cYZA7Jd';

   $mensaje->accestoken='EAAFJOpHSczABO8IJZC2ZBdTfsfoBQ1A8Krce3IemwECQGlySltZAjL4ZC8USCh1yg1aNEKoSLOMvZAZCGe2WeMZCXiXfJU5YgVdRodJo88Sm2gY5tjdc1pDNfSeWZCbJ5ujPHq7SzGby8I6kn4WDXJl1CNsAnk4k3ans3nlmFOtHxZBhxTjYJ0coebdGdFhdZAexj5';

	$mensaje->MensajeSaludo();
	


	/*
	$res = array('respuesta' =>1);

	$respuesta['respuesta']=$sucursales;
	$respuesta['imagenes']=$imagenes;
	
	//Retornamos en formato JSON 
	$myJSON = json_encode($res);
	echo $myJSON;
*/
}catch(Exception $e){
	//$db->rollback();
	//echo "Error. ".$e;
	
	$array->resultado = "Error: ".$e;
	$array->msg = "Error al ejecutar el php";
	$array->id = '0';
		//Retornamos en formato JSON 
	$myJSON = json_encode($array);
	echo $myJSON;
}





 ?>