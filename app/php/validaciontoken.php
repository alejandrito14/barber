<?php
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');

//Inlcuimos las clases a utilizar
require_once "clases/conexcion.php";
require_once "clases/class.Usuarios.php";
//require_once("clases/class.Token.php");
require_once "clases/class.Funciones.php";

require_once "clases/class.AltiriaSMS.php";

try
{

    //Declaramos objetos de clases
    $db = new MySQL();
    $lo = new Usuarios();
    $f  = new Funciones();

    //Enviamos la conexion a la clase
    $lo->db = $db;

    $token     = $_POST['token'];
    $idcliente = $_POST['idcliente'];

    $lo->codigosms = $token;
    $lo->idusuarios = $idcliente;

    $validar = $lo->validarToken();
    $obtenerusuario= $lo->ObtenerUsuario();
    $monedero=0;
    if ($obtenerusuario[0]->monedero>0) {
        $monedero=1;
    }

    $arra = array('tokenvalidado' => $validar,'usuario'=>$obtenerusuario[0],'monedero'=>$monedero);

    $respuesta['respuesta'] = $arra;

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