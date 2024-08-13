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
require_once("../../clases/class.CategoriaPaquete.php");
require_once("../../clases/class.Funciones.php");


try
{
    $venderproductos=0;
    if(isset($_POST['venderproductos'])){

        $venderproductos=$_POST['venderproductos'];

    }

    //Declaramos objetos de clases
    $db = new MySQL();
    $lo = new CategoriaPaquete();
    $f  = new Funciones();
    //Enviamos la conexion a la clase
    $lo->db    = $db;
    //Recibimos parametros
    if ($venderproductos==0) {
        $resultado=$lo->ObtenerCategoriasPrincipales();
    }else{

         $resultado=$lo->ObtenerCategoriasPrincipalesFiltroProductos();
    }
   


    $codigo=$_SESSION['codservicio'];

if (count($resultado)>0) {
            for ($i=0; $i < count($resultado); $i++) { 
                
                $foto=$resultado[$i]->foto;
                $ruta="";
                if ($foto!='') {
                    $ruta="./catalogos/categoriapaquete/imagenescategoria/".$codigo."/".$foto;
                }
                

                $resultado[$i]->ruta=$ruta;
            }
        }
    
    $respuesta['respuesta'] = $resultado;

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
?>