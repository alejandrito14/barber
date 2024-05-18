<?php
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');

//Inlcuimos las clases a utilizar
require_once "clases/conexcion.php";
require_once "clases/class.Paquetes.php";
require_once "clases/class.Funciones.php";


try
{

    //Declaramos objetos de clases
    $db = new MySQL();
    $lo = new Paquetes();
    $f  = new Funciones();
 
    //Enviamos la conexion a la clase
    $lo->db    = $db;
   
    $idpaquete = $_POST['idpaquete'];
    //Recibimos parametros
    $lo->idpaquete=$idpaquete;
    $lo->estatus=0;
    $resultado=$lo->ActualizarPaqueteEstatus();
    

    $respuesta['respuesta'] = 1;

    //Retornamos en formato JSON
    $myJSON = json_encode($respuesta);
    echo $myJSON;

} catch (Exception $e) {
    //$db->rollback();
    //echo "Error. ".$e;

    $array->resultado = "Error: " . $e;
    $array->msg       = "Error al ejecutar el php";
    $array->id        = '0';
    //Retornamos en formato JSON
    $myJSON = json_encode($array);
    echo $myJSON;
}