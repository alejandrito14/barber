<?php
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');

//Inlcuimos las clases a utilizar
require_once "clases/conexcion.php";
require_once "clases/class.CategoriaPaquete.php";
require_once "clases/class.Funciones.php";
require_once "clases/class.PagConfig.php";


try
{

    //Declaramos objetos de clases
    $db = new MySQL();
    $lo = new CategoriaPaquete();
    $f  = new Funciones();
    $pagina=new PagConfig();
    $pagina->db=$db;
    //Enviamos la conexion a la clase
    $lo->db    = $db;

    $obtenerconfi=$pagina->ObtenerInformacionConfiguracion();
    $limitepaginado=$obtenerconfi['cantidadelementospaginado'];

    $cantidadelementos=$lo->ObtenerCantidadCategoriaPaquete();
    $inicio=0;
    if (isset($_POST['inicio'])) {
       $inicio=$_POST['inicio'];
    }
    $conteo=$limitepaginado;
   
     $resultado=$lo->ObtenerCategoriaPaqueteLimit($inicio,$conteo);

     $inicio=$inicio+$conteo;

     $totalelementos=$lo->ObtenerCategoriaPaqueteTotal();

    $respuesta['respuesta'] = $resultado;
    $respuesta['inicio']=$inicio;
    $respuesta['totalelementos']=count($totalelementos);
    

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