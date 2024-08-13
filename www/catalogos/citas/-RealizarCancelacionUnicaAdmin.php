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
require_once "../../clases/class.PagConfig.php";

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
	$idusuario=$_POST['idusuario'];

	$idcita=$_POST['idcita'];
	$motivocancelacion=$_POST['motivocancela'];
	$lo->idcita=$idcita;

  $notapago->idcita=$idcita;
	$obtenercitanota=$lo->BuscarCitaNotapagodescripcion();

	$tpv=$obtenercitanota[0]->tpv;
		$idnotapagodescripcion=$obtenercitanota[0]->idnotapago_descripcion;
   $folio=$obtenercitanota[0]->folio;
   $sucursal->idsucursales=$obtenercitanota[0]->idsucursalnota;
   $datossucursal=$sucursal->ObtenerSucursal();
   $celularsucursal=$datossucursal[0]->celular;


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
  


$obtenerdetallenota=$notapago->ObtenerdescripcionNotaCita();

	$nombrepaquetedes="";
    $montocancelado=0;
    for ($i=0; $i < count($obtenerdetallenota); $i++) { 
        $montocancelado=$montocancelado+$obtenerdetallenota[$i]->monto;
      
        
        $idcitar=$obtenerdetallenota[$i]->idcita;
       
        $idnotapagodescripcion=$obtenerdetallenota[$i]->idnotapago_descripcion;
        $nombrepaquetedes.=$obtenerdetallenota[$i]->concepto;
        
        $lo->idcita=$idcitar;

        if($idcitar>0) {
          $lo->fechacancelacion=$notapago->fechacancelado;
          $lo->motivocancelacion=$motivocancelacion;
          $lo->cancelacion=1;
          $lo->estatus=3;
          $lo->idusuariocancela=$idusuariocancela;
          $lo->CancelarCita();
          
          $notapago->idnotapagodescripcion=$idnotapagodescripcion;
          $notapago->ActualizarEstatusdescripcion();



            $nombrepaquetedes.='\nFecha:'.$fechas->fecha_texto5($obtenerdetallenota[$i]->fechacita).'\n';
            $nombrepaquetedes.='Hora:'.$obtenerdetallenota[$i]->horainicial.'-'.$obtenerdetallenota[$i]->horafinal.'Hrs.\n';
            $nombrepaquetedes.='Barbero:'.$obtenerdetallenota[$i]->usuarioespecialista.'\n';
          }


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
  
  	 $usuarios=new Usuarios();
     $usuarios->db=$db;
     $usuarios->id_usuario = $idusuario;
     $iduser=$idusuario;
     $row_cliente = $usuarios->ObtenerUsuario();
     $saldo_anterior = $row_cliente[0]->monedero;


    if ($montomonedero>0 && $obtenercitanota[0]->estatusnota==1) {
             # code...
           
    
    if ($saldo_anterior=='') {
       $saldo_anterior=0;
    }
      $montomonedero=$montomonedero+$obtenercitanota[0]->monederoaplicado;
    //Calculamos nuevo saldo
    $nuevo_saldo = $saldo_anterior + $montomonedero;
    $sql = "UPDATE usuarios SET monedero = '$nuevo_saldo' WHERE idusuarios = '$iduser'";
   
    $db->consulta($sql);
    //Guardamos el movimiento en tabla cliente_monedero
    $tipo=0;
    $concepto="Abono por cancelacion";
    $sql_movimiento = "INSERT INTO monedero (idusuarios,monto,modalidad,tipo,saldo_ant,saldo_act,concepto,idnota) VALUES ('$idusuario','$montomonedero','2','$tipo','$saldo_anterior','$nuevo_saldo','$concepto','$idnotapago')";
  	
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
  


   		$nombrecliente='Cliente:'.$row_cliente[0]->nombre.' '.$row_cliente[0]->paterno;
        $whatsapp=new WhatsapMensaje();
       
        $whatsapp->Version=$obtenerconfiguracion['faceversion'];
        $whatsapp->accestoken=$obtenerconfiguracion['tokenface'];
        $whatsapp->phoneid=$obtenerconfiguracion['phoneid'];
        $celularsucursal=str_replace(array('(', ')', '-'), '',$celularsucursal);
        $whatsapp->tophone=$celularsucursal;
       if ($tpv==0) {
       	// code...
      	  $whatsapp->MensajeCancelacion($folio,$nombrepaquetedes,$nombrecliente);

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