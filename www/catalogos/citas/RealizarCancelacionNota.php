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
require_once "../../clases/class.WhatsapMensaje.php";

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

    $whatsap=new WhatsapMensaje();
    $whatsap->db=$db;

    $paginaconfi     = new PagConfig();
    $paginaconfi->db = $db;
    $obtenerconfiguracion=$paginaconfi->ObtenerInformacionConfiguracion();

    $obj->db=$db;
     $db->begin();
    $idusuariocancela=$_SESSION['se_sas_Usuario'];
	$motivocancelacion=$_POST['motivocancela'];

 

	$idnotapago=$_POST['idnotapago'];

    $idnotapagodescripcion=$_POST['idnotapago_descripcion'];


  
	$notapago->idnotapagodescripcion=$idnotapagodescripcion;
	$notapago->cancelado=1;
	$notapago->fechacancelado=date('Y-m-d H:i:s');
	$notapago->motivocancelacion=$motivocancelacion;
	$notapago->idusuariocancela=$idusuariocancela;
	$notapago->ActualizarEstatusdescripcion();

	
    $notapago->idnotapago=$idnotapago;
    $notapago->ActualizarNotacancelada();

    
    $obtenernota=$notapago->Obtenernota();


    $obtenerdetallenota=$notapago->ObtenerdescripcionNota();
    $montocancelado=0;
    for ($i=0; $i < count($obtenerdetallenota); $i++) { 
        $montocancelado=$montocancelado+$obtenerdetallenota[$i]->monto;
      
       
        $idnotapagodescripcion=$obtenerdetallenota[$i]->idnotapago_descripcion;
        $nombrepaquetedes.=$obtenerdetallenota[$i]->concepto;

      
          
          $notapago->idnotapagodescripcion=$idnotapagodescripcion;
          $notapago->ActualizarEstatusdescripcion();

         
          
    }

     $usuarios=new Usuarios();
     $usuarios->db=$db;
    
     $usuarios->id_usuario = $obtenernota[0]->idusuario;
    
     $row_cliente = $usuarios->ObtenerUsuario();

    $obtenerconfiguracion=$paginaconfi->ObtenerInformacionConfiguracion();

        $nombrecliente='Cliente:'.$row_cliente[0]->nombre.' '.$row_cliente[0]->paterno;
        $whatsapp=new WhatsapMensaje();
       
        $whatsapp->Version=$obtenerconfiguracion['faceversion'];
        $whatsapp->accestoken=$obtenerconfiguracion['tokenface'];
        $whatsapp->phoneid=$obtenerconfiguracion['phoneid'];
        $celularsucursal=str_replace(array('(', ')', '-'), '',$celularsucursal);
        $whatsapp->tophone=$celularsucursal;

     
        /*if ($tpv==0) {
        $whatsapp->MensajeCancelacion($folio,$nombrepaquetedes,$nombrecliente);
            }*/

 	$db->commit();
	
	$respuesta['respuesta']=1;
	$respuesta['detallecita']=$obtenercitanota[0];
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