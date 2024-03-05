<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Servicios.php");
require_once("clases/class.Funciones.php");
require_once("clases/class.Fechas.php");
require_once("clases/class.Usuarios.php");
require_once("clases/class.NotificacionPush.php");


	$notificaciones=new NotificacionPush();

	$array=array();
	$token="eD5F_-CKTaad_w1GnCvFfx:APA91bHiOHAylf1pdB6UF6CaxWzsTZ1CCdlgW09OqFcoztv1scOuG8vbAipNu9wgO8gBUvvuZ2yo4K1iDwi9KW7o14Up7WokPAecyBSgPzhSOK_O3KwHSSzfJNdOeFP_iQaWZcO2fvPW";
	 array_push($array,$token);
	 $titulonotificacion="Notificación de asignación";
	 $texto="";
	$notificaciones->EnviarNotificacion($array,$texto,$titulonotificacion);
				

 ?>