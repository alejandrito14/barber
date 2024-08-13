<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Cita.php");
require_once("../../clases/class.Fechas.php");
require_once("../../clases/class.Sucursal.php");
require_once("../../clases/class.PagConfig.php");
require_once("../../clases/class.Notapago.php");
require_once("../../clases/class.NotapagoCancelada.php");
require_once "../../clases/class.Usuarios.php";

try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$lo = new Cita();
	$lo->db=$db;
	$f=new Funciones();
	$fechas=new Fechas();
	$sucursal=new Sucursal();
	$sucursal->db=$db;
	$notapago=new Notapago();
    $notapago->db=$db;
    $notapagocancelada=new NotapagoCancelada();
    $notapagocancelada->db=$db;

    $obj->db=$db;
     $db->begin();
    $idusuariocancela=$_SESSION['se_sas_Usuario'];
	$idusuario=$_POST['idusuario'];

	$idnotapago=$_POST['idnotapago'];
	$motivocancelacion=$_POST['motivocancela'];

  	$notapago->idnotapago=$idnotapago;
	
		$idnotapagodescripcion=$_POST['idnotapago_descripcion'];
	
	$notapago->idnotapagodescripcion=$idnotapagodescripcion;
	$notapago->cancelado=1;
	$notapago->fechacancelado=date('Y-m-d H:i:s');
	$notapago->motivocancelacion=$motivocancelacion;
	$notapago->idusuariocancela=$idusuariocancela;
	$notapago->ActualizarEstatusdescripcion();

	
    

    $notapago->idnotapago=$idnotapago;
 

    $notapago->ActualizarNotacancelada();

 
   
  


 	$db->commit();
	
	$respuesta['respuesta']=1;
	$respuesta['detallecita']=[];
	$respuesta['montoamonedero']=0;
	
	//Retornamos en formato JSON 
	$myJSON = json_encode($respuesta);
	echo $myJSON;

}catch(Exception $e){
	$db->rollback();
	//echo "Error. ".$e;
	
	$array->resultado = "Error: ".$e;
	$array->msg = "Error al ejecutar el php";
	$array->id = '0';
		//Retornamos en formato JSON 
	$myJSON = json_encode($array);
	echo $myJSON;
}
?>