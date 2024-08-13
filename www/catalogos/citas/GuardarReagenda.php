<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("../../clases/conexcion.php");

require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Fechas.php");
require_once("../../clases/class.Cita.php");
require_once("../../clases/class.Sucursal.php");
require_once "../../clases/class.Usuarios.php";
require_once "../../clases/class.WhatsapMensaje.php";

require_once "../../clases/class.PagConfig.php";

try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$f=new Funciones();
	$fechas=new Fechas();
	$cita = new Cita();
	$cita->db=$db;
	$sucursal=new Sucursal();
	$sucursal->db=$db;
	 $db->begin();
	$idusuarios=$_POST['iduser'];
	$idcita=$_POST['idcita'];
	
	$horarioseleccionado=$_POST['horarioseleccionado'];
	$fechaseleccionada=$_POST['fechaseleccionada'];
	$idespecialistaseleccionado=$_POST['idespecialistaseleccionado'];
	$hora=explode('_', $horarioseleccionado);
	$horainicial=$hora[0];
	$horafinal=$hora[1];

	


     $paginaconfi     = new PagConfig();
     $paginaconfi->db = $db;
     $obtenerconfiguracion=$paginaconfi->ObtenerInformacionConfiguracion();


	$idcortesiaseleccionado=$_POST['idcortesiaseleccionado'];
	$valorseleccionado=$_POST['valorseleccionado'];


  $hora_original = strtotime($hora[0]);
  $nueva_hora = date('H:i', strtotime('+'.$valorseleccionado.' minutes', $hora_original));

  	$cita->idusuario=$idusuarios;
	$cita->idcita=$idcita;
	$cita->horainicial=$horainicial;
	$cita->horafinal=$nueva_hora;
	$cita->fecha=$fechaseleccionada;
	$cita->idespecialista=$idespecialistaseleccionado;
	$cita->idcortesia=$idcortesiaseleccionado;

	$cita->GuardarReagenda();

	$cita->idcita=$idcita;
	$obtenercitanota=$cita->BuscarCitaNotapagodescripcion();
		$idnotapagodescripcion=$obtenercitanota[0]->idnotapago_descripcion;
   $tpv=$obtenercitanota[0]->tpv;
   $idusuarios=$obtenercitanota[0]->idusuarios;

   	$usuarios=new Usuarios();
     $usuarios->db=$db;
    
     $usuarios->id_usuario = $idusuarios;
     $iduser=$idusuarios;
     $row_cliente = $usuarios->ObtenerUsuario();
     $saldo_anterior = $row_cliente[0]->monedero;

   $cita->idusuario=$idusuarios;
        //obtenerfolio
   $folio=$obtenercitanota[0]->folio;
   $sucursal->idsucursales=$obtenercitanota[0]->idsucursalnota;
   $datossucursal=$sucursal->ObtenerSucursal();
   $celularsucursal=$datossucursal[0]->celular;
		$nombrepaquetedes="";

   			$obtenerdetallecita=$cita->Obtenerdetallecita();
   			$nombrepaquetedes.='Servicio:'.$obtenerdetallecita[0]->concepto;
	 		$nombrepaquetedes.='\nFecha:'.$fechas->fecha_texto5($obtenerdetallecita[0]->fechacita).'\n';
            $nombrepaquetedes.='Hora:'.$obtenerdetallecita[0]->horainicial.'-'.$obtenerdetallecita[0]->horafinal.'Hrs.\n';
            $nombrepaquetedes.='Barbero:'.$obtenerdetallecita[0]->usuarioespecialista.'\n';

         $nombrecliente='Cliente:'.$row_cliente[0]->nombre.' '.$row_cliente[0]->paterno;
        $whatsapp=new WhatsapMensaje();
       
        $whatsapp->Version=$obtenerconfiguracion['faceversion'];
        $whatsapp->accestoken=$obtenerconfiguracion['tokenface'];
        $whatsapp->phoneid=$obtenerconfiguracion['phoneid'];
        $celularsucursal=str_replace(array('(', ')', '-'), '',$celularsucursal);
        $whatsapp->tophone=$celularsucursal;

     
      
        if ($tpv==0) {
        	
        $whatsapp->MensajeReagenda($folio,$nombrepaquetedes,$nombrecliente);
            }

 	$db->commit();

	$respuesta['respuesta']=1;
	
	
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