<?php
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');

//Inlcuimos las clases a utilizar
require_once "clases/conexcion.php";
require_once "clases/class.Paquetes.php";
require_once "clases/class.Funciones.php";
require_once "clases/class.Canje.php";
require_once "clases/class.Tarjetalealtad.php";


try
{

    //Declaramos objetos de clases
    $db = new MySQL();
    $lo = new Canje();
    $f  = new Funciones();
    $tarjetalealtad=new Tarjetalealtad();
    $tarjetalealtad->db=$db;
    //Enviamos la conexion a la clase
    $lo->db    = $db;
   
    $idpaquete = $_POST['idpaquete'];
    $idusuario=$_POST['idusuario'];
    $idsucursal=$_POST['idsucursal'];
    $idtarjetalealtadasignacion=$_POST['idtarjetalealtadasignacion'];
    //Recibimos parametros
    $lo->idproducto=$idpaquete;
    $lo->idusuario=$idusuario;
    $lo->estatus=0;
    $lo->idtarjetalealtadasignacion=$idtarjetalealtadasignacion;
    $lo->cantidad=1;

    $tarjetalealtad->idproducto=$idpaquete;
    $tarjetalealtad->idtarjetalealtadasignacion=$idtarjetalealtadasignacion;
   /*$asignacion= $tarjetalealtad->ObtenerAsignaciontarjeta();


    $verificarCanjeCompleto=$lo->VerificarCanjeCompleto();

     if ($asignacion[0]->cantidadbeneficio!=count($buscarcanje)) {*/

    $buscarcanje=$lo->BuscarCanjeProceso();

   
        
    
        $canjeproceso=0;
        $lo->idcanje=0;
        if (count($buscarcanje)==0) {
            
            $lo->GuardarCanje();
            
        }else{

            $canjeproceso=1;


        }

    /*}else{


    $canjeproceso=2;
}
*/
    

    

    $respuesta['respuesta'] = 1;
    $respuesta['canjeproceso']=$canjeproceso;
    $respuesta['idcanje']=$lo->idcanje;

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