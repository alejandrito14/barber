<?php
/*======================= INICIA VALIDACIÓN DE SESIÓN =========================*/

require_once("../../clases/class.Sesion.php");
//creamos nuestra sesion.
$se = new Sesion();

if(!isset($_SESSION['se_SAS']))
{
    /*header("Location: ../../login.php"); */ echo "login";

    exit;
}

//Inlcuimos las clases a utilizar
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Sucursal.php");
require_once("../../clases/class.Fechas.php");

try
{

    //Declaramos objetos de clases
    $db = new MySQL();
    $lo = new Sucursal();
    $lo->db=$db;
   
   	$idusuario=$se->obtenerSesion('se_sas_Usuario');

   	$lo->idusuario=$idusuario;
   	$sucursales=$lo->SucursalAcceso();

   	if (count($sucursales)>0) {
   		for ($i=0; $i <count($sucursales) ; $i++) { 
   			 $img='./catalogos/sucursal/imagenes/'.$_SESSION['codservicio'].'/'.$sucursales[$i]->imagen;


   			 $sucursales[$i]->imagen=$img;
   		}
   	}
   	


    $respuesta['resultado']=$sucursales;
    
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