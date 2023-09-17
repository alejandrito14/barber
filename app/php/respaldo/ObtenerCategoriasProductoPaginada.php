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
    $pagina=1;
    if ($_POST['pagina']) {
       $pagina=$_POST['pagina'];
    }
    $conteo=$cantidadelementos[0]->cantidad;
    $productosPorPagina=$limitepaginado;
    # El límite es el número de productos por página
    $limit = $productosPorPagina;
        # El offset es saltar X productos que viene dado por multiplicar la página - 1 * los productos por página
    $offset = ($pagina - 1) * $productosPorPagina;
    
    $paginas = ceil($conteo / $productosPorPagina);

     $resultado=$lo->ObtenerCategoriaPaqueteLimit($limit,$offset);

    $respuesta['respuesta'] = $resultado;
    $respuesta['paginado']=$pagina;

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