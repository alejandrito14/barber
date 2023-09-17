<?php
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');

//Inlcuimos las clases a utilizar
require_once "clases/conexcion.php";
require_once "clases/class.Carrito.php";
require_once "clases/class.Funciones.php";
require_once "clases/class.Cita.php";


try
{

    //Declaramos objetos de clases
    $db = new MySQL();
    $lo = new Carrito();
    $f  = new Funciones();
    $cita = new Cita();
    //$db->begin();
    //Enviamos la conexion a la clase
    $lo->db    = $db;
    $cita->db=  $db;
        $db->begin();
    $id_user=$_POST['id_user'];
    //$db->begin();
    //Recibimos parametros
    $lo->idusuarios=$id_user;
    $fechaActual=date('Y-m-d H:i:s');

    $fechaRestada = date('Y-m-d H:i:s', strtotime($fechaActual . ' -1 hour'));
    $lo->fechacreacion=$fechaRestada;
     // Restar 1 hora

    $obtenerdecarrito= $lo->ObtenerCarritoAnterior();


   for ($i=0; $i <count($obtenerdecarrito) ; $i++) { 

        if($obtenerdecarrito[$i]->idcitaapartada>0) {
           
           $cita->idcitaapartado=$obtenerdecarrito[0]->idcitaapartada;
           
           $cita->EliminarCitaApartada();
       }
          $lo->idcarrito=$obtenerdecarrito[$i]->idcarrito;
          $lo->BorrardelCarrito();
       

   }

   

 
   $db->commit();


   
    //$db->commit();

 
    

    $respuesta['respuesta'] = 1;
    //Retornamos en formato JSON
    $myJSON = json_encode($respuesta);
    echo $myJSON;

} catch (Exception $e) {
    $db->rollback();
    //echo "Error. ".$e;

    $array->resultado = "Error: " . $e;
    $array->msg       = "Error al ejecutar el php";
    $array->id        = '0';
    //Retornamos en formato JSON
    $myJSON = json_encode($array);
    echo $myJSON;
}