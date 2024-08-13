<?php
/*======================= INICIA VALIDACIÓN DE SESIÓN =========================*/

require_once "../../clases/class.Sesion.php";
//creamos nuestra sesion.
$se = new Sesion();

if (!isset($_SESSION['se_SAS'])) {
    /*header("Location: ../../login.php"); */echo "login";

    exit;
}

/*======================= TERMINA VALIDACIÓN DE SESIÓN =========================*/

//Importamos las clases que vamos a utilizar
require_once "../../clases/conexcion.php";
require_once "../../clases/class.Fechasinhabiles.php";
require_once "../../clases/class.Opcion.php";

require_once "../../clases/class.Funciones.php";
require_once '../../clases/class.MovimientoBitacora.php';

try
{
    //declaramos los objetos de clase
    $db     = new MySQL();
    $fechasinhabiles = new Fechasinhabiles();
    $f      = new Funciones();
    $md     = new MovimientoBitacora();

    //enviamos la conexión a las clases que lo requieren
    $fechasinhabiles->db = $db;
    $md->db     = $db;

    $db->begin();

    //Recbimos parametros
    $fechasinhabiles->idfechainhabil    = trim($_POST['id']);
    $fechasinhabiles->fecha = trim($_POST['fechainhabil']);
    $fechasinhabiles->estatus=$_POST['v_estatus'];
    $fechasinhabiles->idsucursal=$se->obtenerSesion('idsucursalsesion');
    if($fechasinhabiles->idfechainhabil==0){

            $fechasinhabiles->Guarderfechainhabil();
            $md->guardarMovimiento($f->guardar_cadena_utf8('Fechasinhabiles'), 'Fechasinhabiles', $f->guardar_cadena_utf8('Nuevo Fechasinhabiles creado con el ID-' . $fechasinhabiles->idFechasinhabiles));
    
        } else {

            $fechasinhabiles->ModificarFechasinhabil();
            $md->guardarMovimiento($f->guardar_cadena_utf8('Fechasinhabiles'), 'Fechasinhabiles', $f->guardar_cadena_utf8('Modificación de Fechasinhabiles -' . $fechasinhabiles->idFechasinhabiles));
    }

    $db->commit();
    echo "1|" . $fechasinhabiles->idfechainhabil;

} catch (Exception $e) {
    $db->rollback();
    echo "Error. " . $e;
}
