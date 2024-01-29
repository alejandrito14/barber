<?php 


require_once("../../clases/class.Sesion.php");
//creamos nuestra sesion.
$se = new Sesion();

 
if(!isset($_SESSION['se_SAS']))
{
    //header("Location: ../login.php");
    echo "login";
    exit;
}

//Inlcuimos las clases a utilizar
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Paquetes.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.CategoriaPaquete.php");

require_once "../../clases/class.PagConfig.php";
try
{
    
    //Declaramos objetos de clases
    $db = new MySQL();
    $lo = new Paquetes();
    $f=new Funciones();
    $categoriapaq=new CategoriaPaquete();
    $categoriapaq->db=$db;
    //Enviamos la conexion a la clase
    $lo->db = $db;
    $categoriapaq->idcategoriapaquete=$_POST['idcategoriapaquete'];
    $obtener=$categoriapaq->VerificarSiCategoriaTieneSub();
    $contar=count($obtener); 

    $respuesta['respuesta']=$contar;

    //Retornamos en formato JSON 
    $myJSON = json_encode($respuesta);
    echo $myJSON;

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