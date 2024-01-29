<?php
/*======================= INICIA VALIDACIÓN DE SESIÓN =========================*/

require_once "../../clases/class.Sesion.php";
//creamos nuestra sesion.
$se = new Sesion();

if (!isset($_SESSION['se_SAS'])) {
    /*header("Location: ../../login.php"); */echo "login";

    exit;
}
//Importamos las clases que vamos a utilizar
require_once "../../clases/conexcion.php";
require_once "../../clases/class.Comision.php";
require_once "../../clases/class.Funciones.php";
require_once '../../clases/class.MovimientoBitacora.php';
require_once '../../clases/class.Paquetes.php';



try {
	
	$db     = new MySQL();
    $comision = new Comision();
    $f      = new Funciones();
    $paquetes=new Paquetes();
    $paquetes->db=$db;
    $md     = new MovimientoBitacora();
    $md->db     = $db;
    //enviamos la conexión a las clases que lo requieren
    $comision->db = $db;


    

} catch (Exception $e) {
	
}






?>