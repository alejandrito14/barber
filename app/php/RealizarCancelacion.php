<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Funciones.php");
require_once("clases/class.Cita.php");
require_once("clases/class.Fechas.php");
require_once("clases/class.Sucursal.php");
require_once("clases/class.PagConfig.php");
require_once("clases/class.Notapago.php");
require_once("clases/class.NotapagoCancelada.php");
require_once "clases/class.Usuarios.php";

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
     $db->begin();
    $obj->db=$db;
    

	$idusuario=$_POST['idusuarios'];
	$idcita=$_POST['idcita'];
	$motivocancelacion=$_POST['motivocancela'];
	$lo->idcita=$idcita;


	$obtenercitanota=$lo->BuscarCitaNotapagodescripcion();
		$idnotapagodescripcion=$obtenercitanota[0]->idnotapago_descripcion;
	
	$notapago->idnotapagodescripcion=$idnotapagodescripcion;
	$notapago->cancelado=1;
	$notapago->fechacancelado=date('Y-m-d H:i:s');
	$notapago->motivocancelacion=$motivocancelacion;
	$notapago->idusuariocancela=$idusuario;
	$notapago->ActualizarEstatusdescripcion();

	$lo->cancelacion=1;
	$lo->estatus=3;
	$lo->fechacancelacion=$notapago->fechacancelado;
	$lo->motivocancelacion=$motivocancelacion;
	$lo->idusuariocancela=$idusuario;
	$lo->CancelarCita();

    $notapago->idnotapago=$obtenercitanota[0]->idnotapago;
  $notapago->ActualizarNotacancelada();

    $obtenernota=$notapago->Obtenernota();
    $obtenerdetallenota=$notapago->ObtenerdescripcionNota();
    $montocancelado=0;
    for ($i=0; $i < count($obtenerdetallenota); $i++) { 
        $montocancelado=$montocancelado+$obtenerdetallenota[$i]->monto;
    }
    
    //var_dump($montocancelado);die();
	$monto=$montocancelado-$obtenernota[0]->montocupon-$obtenernota[0]->montomonedero;


	$idnotapago=$obtenercitanota[0]->idnotapago;
	$nombrepaquete=$obtenercitanota[0]->descripcion;

	/* $contador=$notapago->ActualizarConsecutivo();
    $fecha = explode('-', date('d-m-Y'));
    $anio = substr($fecha[2], 2, 4);
    $folio = $fecha[0].$fecha[1].$anio.$contador;
*/
 
     	 $notapago->idusuario=$idusuario;
         $notapago->subtotal=$monto;
         $notapago->iva=0;
         $notapago->total=$monto;
         $notapago->comisiontotal=0;
         $notapago->montomonedero=0;
         $notapago->estatus=2;
         $notapago->tipopago='';
         $notapago->idtipopago=0;
         $notapago->confoto='';
         $notapago->datostarjeta='';
         $notapago->datostarjeta2='';
         $notapago->idpagostripe=0;
         $notapago->folio=$folio;
         $notapago->descuento=0;
         $notapago->descuentomembresia=0;
         $notapago->requierefactura=0;
         $notapago->checkConfirm=0;
         $notapago->comisionpornota=0;
         $notapago->comisionnota=0;
         $notapago->tipocomisionpornota=0;
         $notapago->idusuariodatofiscal=0;
         $notapago->montocupon=0;
         $notapago->idcupon=0;

         //$notapago->CrearNotapago();
         $idnotapagonueva=$notapago->idnotapago;


          $notapago->descripcion=$obtenercitanota[0]->descripcion;
          $notapago->cantidad=$obtenercitanota[0]->cantidad;
          $notapago->monto=$obtenercitanota[0]->monto;
          $notapago->idpaquete=$obtenercitanota[0]->idpaquete;
          $notapago->idcita=$obtenercitanota[0]->idcita;
          $notapago->costounitario=$obtenercitanota[0]->costounitario;
          $notapago->tipo=1;
          $notapago->idnotapago=$idnotapagonueva;
          $notapago->monederoaplicado=$obtenercitanota[0]->monederoaplicado;

          // $notapago->Creardescripcionpago();

        //$contador=$notapago->ActualizarConsecutivoCancelado();
	    $fecha = explode('-', date('d-m-Y'));
	    $anio = substr($fecha[2], 2, 4);
	    /*$foliocancelacion = $fecha[0].$fecha[1].$anio.$contador;

          $notapagocancelada->foliocancelacion=$foliocancelacion;

		   $notapagocancelada->montocancelacion=$obtenercitanota[0]->monto;

		   $notapagocancelada->motivocancelacion=$motivocancelacion;


		   $notapagocancelada->estatus=1;
		   $notapagocancelada->idnotapagocancelada=$idnotapago;
		   $notapagocancelada->idnotapago_descripcion=$idnotapagodescripcion;

		   $notapagocancelada->idnotapago= $idnotapagonueva;*/
          // $notapagocancelada->GuardarNotaCancelada();


     $usuarios=new Usuarios();
     $usuarios->db=$db;
     $montomonedero=$montocancelado-$obtenernota[0]->montocupon-$obtenernota[0]->montomonedero;
    $usuarios->idusuarios = $idusuario;
    $iduser=$idusuario;
    $row_cliente = $usuarios->ObtenerUsuario();
    $saldo_anterior = $row_cliente[0]->monedero;
     if ($saldo_anterior=='') {
       $saldo_anterior=0;
    }
    $montomonedero=$montomonedero+$obtenernota[0]->montomonedero;
    //Calculamos nuevo saldo

    if ( $montomonedero>0 && $obtenercitanota[0]->estatusnota==1) {
        # code...
    
    $nuevo_saldo = $saldo_anterior + $montomonedero;
    $sql = "UPDATE usuarios SET monedero = '$nuevo_saldo' WHERE idusuarios = '$iduser'";
    
    $db->consulta($sql);
    //Guardamos el movimiento en tabla cliente_monedero
    $tipo=0;
    $concepto="Abono por cancelacion";
    $sql_movimiento = "INSERT INTO monedero (idusuarios,monto,modalidad,tipo,saldo_ant,saldo_act,concepto,idnota) VALUES ('$iduser','$montomonedero','2','$tipo','$saldo_anterior','$nuevo_saldo','$concepto','$idnotapago');";
  
     $db->consulta($sql_movimiento);
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