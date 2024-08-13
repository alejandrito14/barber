<?php
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');

//Inlcuimos las clases a utilizar
require_once "clases/conexcion.php";
require_once "clases/class.Usuarios.php";
require_once "clases/class.Funciones.php";
//require_once "clases/class.MovimientoBitacora.php";
require_once "clases/class.AltiriaSMS.php";
require_once "clases/class.phpmailer.php";
require_once "clases/emails/class.Emails.php";
//require_once("clases/class.PagConfig.php");

try
{

    //Declaramos objetos de clases
    $db = new MySQL();
    $lo = new Usuarios();
    $f  = new Funciones();

   
    //Enviamos la conexion a la clase
    $lo->db    = $db;
    $idusuario = $_POST['id_user'];
    //Recibimos parametros
    $nombre   = $_POST['v_nombre'];
    $paterno  = $_POST['v_paterno'];
    $materno  = $_POST['v_materno'];

    $sexo     = $f->guardar_cadena_utf8($_POST['sexoseleccionado']);
    $fecha    = $f->guardar_cadena_utf8($_POST['v_fecha']);

   

    $lo->nombre   = $nombre;
    $lo->paterno  = $paterno;
    $lo->materno  = $materno;
    $lo->email    = $email;
    $lo->clave    = $contra;
    $lo->tipousuario=3;
    $lo->fecha    = $fecha;
    $lo->sexo     = $sexo;
    $lo->curp     = "";
    $lo->estatus  = 1;
    $lo->sistema   = $sistema;
    $lo->idusuarios = $idusuario;
    $lo->tipo=3;
  
    $lo->GuardarUsuario(0);

    $lo->GuardarHijo();

    $arra = array('existe' => 1, 'idusuario' => $lo->idusuarios, 'nombre' => $lo->nombre, 'paterno' => $lo->paterno, 'materno' => $lo->materno, 'celular' => $v_celular, 'email' => $email,'usuario' => $usuario);

    

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