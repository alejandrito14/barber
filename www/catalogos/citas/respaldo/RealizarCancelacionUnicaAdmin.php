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

	$idcita=$_POST['idcita'];
	$motivocancelacion=$_POST['motivocancela'];
	$lo->idcita=$idcita;

  $notapago->idcita=$idcita;
	$obtenercitanota=$lo->BuscarCitaNotapagodescripcion();
		$idnotapagodescripcion=$obtenercitanota[0]->idnotapago_descripcion;
	
	$notapago->idnotapagodescripcion=$idnotapagodescripcion;
	$notapago->cancelado=1;
	$notapago->fechacancelado=date('Y-m-d H:i:s');
	$notapago->motivocancelacion=$motivocancelacion;
	$notapago->idusuariocancela=$idusuariocancela;
	$notapago->ActualizarEstatusdescripcion();

	$lo->cancelacion=1;
	$lo->estatus=3;
	$lo->fechacancelacion=$notapago->fechacancelado;
	$lo->motivocancelacion=$motivocancelacion;
	$lo->idusuariocancela=$idusuariocancela;
	$lo->CancelarCita();
  
	  $iduser=$idusuario;

$obtenerdetallenota=$notapago->ObtenerdescripcionNotaCita();


    $montocancelado=0;
    for ($i=0; $i < count($obtenerdetallenota); $i++) { 
        $montocancelado=$montocancelado+$obtenerdetallenota[$i]->monto;
      
          
    }
    
	$monto=$montocancelado-$obtenerdetallenota[0]->montocupon-$obtenerdetallenota[0]->monederoaplicado;
	$idnotapago=$obtenerdetallenota[0]->idnotapago;
	$nombrepaquete=$obtenerdetallenota[0]->concepto;

	/* $contador=$notapago->ActualizarConsecutivo();
    $fecha = explode('-', date('d-m-Y'));
    $anio = substr($fecha[2], 2, 4);
    $folio = $fecha[0].$fecha[1].$anio.$contador;*/


     	   
            
          // $notapago->Creardescripcionpago();

       // $contador=$notapago->ActualizarConsecutivoCancelado();
	   /* $fecha = explode('-', date('d-m-Y'));
	    $anio = substr($fecha[2], 2, 4);
	    $foliocancelacion = $fecha[0].$fecha[1].$anio.$contador;*/

         /* $notapagocancelada->foliocancelacion=$foliocancelacion;

		   $notapagocancelada->montocancelacion=$obtenercitanota[0]->monto;

		   $notapagocancelada->motivocancelacion=$motivocancelacion;


		   $notapagocancelada->estatus=1;
		   $notapagocancelada->idnotapagocancelada=$idnotapago;
		   $notapagocancelada->idnotapago_descripcion=$idnotapagodescripcion;

		   $notapagocancelada->idnotapago= $idnotapagonueva;*/
         //  $notapagocancelada->GuardarNotaCancelada();
    $montomonedero=$montocancelado-$obtenerdetallenota[0]->montocupon-$obtenerdetallenota[0]->montomonedero;

    if ($montomonedero>0 && $obtenercitanota[0]->estatusnota==1) {
             # code...
           
     $usuarios=new Usuarios();
     $usuarios->db=$db;
    
     $usuarios->id_usuario = $idusuario;
     
     $row_cliente = $usuarios->ObtenerUsuario();
     $saldo_anterior = $row_cliente[0]->monedero;

    if ($saldo_anterior=='') {
       $saldo_anterior=0;
    }
      $montomonedero=$montomonedero;
    //Calculamos nuevo saldo
    $nuevo_saldo = $saldo_anterior + $montomonedero;
    $sql = "UPDATE usuarios SET monedero = '$nuevo_saldo' WHERE idusuarios = '$iduser'";
   
    $db->consulta($sql);
    //Guardamos el movimiento en tabla cliente_monedero
    $tipo=0;
    $concepto="Abono por cancelacion";
    $sql_movimiento = "INSERT INTO monedero (idusuarios,monto,modalidad,tipo,saldo_ant,saldo_act,concepto,idnota) VALUES ('$iduser','$montomonedero','2','$tipo','$saldo_anterior','$nuevo_saldo','$concepto','$idnotapago');";
    //echo $sql_movimiento;die();
  
     $db->consulta($sql_movimiento);

   }else{
    $montomonedero=0;
   }


   $notapago->idnotapago=$idnotapago;
   $obtenerdetallenota=$notapago->ObtenerdescripcionNotaNoCanceladas();

   if (count($obtenerdetallenota)>0) {
      $montodetalle=0;
      $monederoaplicado=0;
      $montocupon=0;
       for ($i=0; $i <count($obtenerdetallenota) ; $i++) { 
     
        $montodescripcion=$obtenerdetallenota[$i]->monto-$obtenerdetallenota[$i]->montocupon-$obtenerdetallenota[$i]->monederoaplicado;

        $montodetalle=$montodetalle+$montodescripcion;

        $monederoaplicado=$monederoaplicado+$obtenerdetallenota[$i]->monederoaplicado;

     }


   
     $notapago->montomonedero=$monederoaplicado; 
     $notapago->total=$montodetalle;
     $notapago->subtotal=$montodetalle;
     $notapago->iva=0;
     $notapago->comisiontotal=0;
     $notapago->descuento=0;
     $notapago->descuentomembresia=0;
     $notapago->estatus=$obtenercitanota[0]->estatusnota;
     $notapago->ActualizarNotapago();


   }else{

    $notapago->ActualizarNotacancelada();

 
   }
  


 	$db->commit();
	
	$respuesta['respuesta']=1;
	$respuesta['detallecita']=$obtenercitanota[0];
	$respuesta['montoamonedero']=$montomonedero;
	
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