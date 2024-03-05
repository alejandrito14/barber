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
require_once("clases/class.Carrito.php");

try
{

    //Declaramos objetos de clases
    $db = new MySQL();
    $lo = new Usuarios();
    $f  = new Funciones();
    $carrito=new Carrito();
    $carrito->db=$db;
   /* $paginaconfi     = new Configuracion();
    $paginaconfi->db = $db;
    $obtenerconfiguracion=$paginaconfi->ObtenerInformacionConfiguracion();

    $ediciondedatoscliente=$obtenerconfiguracion['ediciondedatoscliente'];
    $mostraranuncios=$obtenerconfiguracion['mostraranuncios'];
*/
    //Enviamos la conexion a la clase
    $lo->db    = $db;
    $idusuario = $_POST['id_user'];
    $lo->idusuarios  = $idusuario;

    $obtenerusuario=$lo->ObtenerUsuario();
    $email=$obtenerusuario[0]->email;
    $contra=$obtenerusuario[0]->contra;
     //Recibimos parametros
    $nombre   = $_POST['nombre'];
    $paterno  = $_POST['paterno'];
    $materno  = $_POST['materno'];

    $sexo     = $_POST['sexoseleccionado'];
    $fecha    =$_POST['fecha'];

    $email   = $email;
    

   /* $telefono = $f->guardar_cadena_utf8($_POST['v_telefono']);
   
    
    $nivel    = $_POST['v_nivel'];
    $posicion = $_POST['v_posicion'];
    $curp     = $f->guardar_cadena_utf8($_POST['v_curp']);*/

  /*  $v_codigopostal = $f->guardar_cadena_utf8($_POST['v_codigopostal']);
    $v_pais         = $f->guardar_cadena_utf8($_POST['v_pais']);
    $v_estado       = $f->guardar_cadena_utf8($_POST['v_estado']);
    $v_municipio    = $f->guardar_cadena_utf8($_POST['v_municipio']);
    $v_colonia      = $_POST['v_colonia'];
    $v_referencia   = $_POST['v_referencia'];
    $v_edad         = $f->guardar_cadena_utf8($_POST['v_edad']);
    $v_celular      = $f->guardar_cadena_utf8($_POST['v_celular']);*/

    //$rutaine = $_POST['rutaine'];

   /* $no_exterior        = $_POST['noexterior'];
    $no_interior        = $_POST['nointerior'];
    $calle1             = $_POST['calle1'];
    $calle2             = $_POST['calle2'];
    $v_tipoasentamiento = $_POST['v_tipoasentamiento'];
    $calle              = $_POST['calle'];*/
    $sistema            = $_POST['sistema'];
    $tokenfirebase      = $_POST['tokenfirebase'];
    $uuid               = $_POST['uuid'];

    $lo->nombre   = $nombre;
    $lo->paterno  = $paterno;
    $lo->materno  = $materno;
    $lo->email    = $email;
    $lo->clave    = $contra;
    $lo->tipousuario=3;
    $lo->fecha    = $fecha;

  
    $lo->sexo     = $sexo;
   /* $lo->telefono = $telefono;
   
    
    
    /*$lo->usuario  = $email;
  
    $lo->nivel    = $nivel;
    $lo->posicion = $posicion;*/
    $lo->curp     = "";
    $lo->estatus  = 1;

 

    //$lo->principaldireccion = 1;
    $lo->sistema    = $sistema;
   
    $lo->usuario=$obtenerusuario[0]->usuario;
    $lo->clave=$obtenerusuario[0]->clave;

  
        $lo->ActualizarUsuario();


        $arra = array('existe' => 1, 'idusuario' => $lo->idusuarios, 'nombre' => $lo->nombre, 'paterno' => $lo->paterno, 'materno' => $lo->materno, 'celular' => $v_celular, 'email' => $email,'usuario' => $usuario);

  

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
