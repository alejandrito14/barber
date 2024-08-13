<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');

require_once("../../clases/class.Sesion.php");
//creamos nuestra sesion.
$se = new Sesion();
//Inlcuimos las clases a utilizar
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Cita.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Carrito.php");
require_once("../../clases/class.Paquetes.php");
require_once("../../clases/class.Fechas.php");
require_once("../../clases/class.Notapago.php");
require_once("../../clases/class.PagConfig.php");
require_once("../../clases/class.Tipodepagos.php");

try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$cita = new Cita();
	$f=new Funciones();
	$carrito=new Carrito();
	$paquetes=new Paquetes();
	$paquetes->db=$db;
	$cita->db=$db;
	$carrito->db=$db;
	$fechas=new Fechas();
	$db->begin();


  $paquetesseleccionados=json_decode($_POST['paquetes']);
   $cita->idusuario=$se->obtenerSesion('usuariopago');
   $idusuario=$se->obtenerSesion('usuariopago');

  $cita->idsucursal=$se->obtenerSesion('idsucursalsesion');
  $carrito->idsucursal=$se->obtenerSesion('idsucursalsesion');
  for ($i=0; $i <count($paquetesseleccionados) ; $i++) { 

      

      if ($paquetesseleccionados[$i]->servicio==1) { //es un servicio
         
         $hora=explode('_',$paquetesseleccionados[$i]->hora);

          $horainicials=$hora[0];
          $horafinals=$hora[1];
         
          $hora=$paquetesseleccionados[$i]->hora;

          $valortiempo=$paquetesseleccionados[$i]->intervaloservicio;

          if ($hora!=0) {
            $horario=explode('_', $hora);
            $cita->horainicial=$horario[0];

            $hora_original = strtotime($horario[0]);
            $nueva_hora = date('H:i', strtotime('+'.$valortiempo.' minutes', $hora_original));

            $cita->horafinal=$nueva_hora;

          }else{

            $cita->horainicial='';
            $cita->horafinal='';
          }
          
          if ($horainicials!='' && $horafinals!='') {
            $cita->horainicials='';
            $cita->horafinals='';
          }
         
         
          



          $cita->idpaquete=$paquetesseleccionados[$i]->idpaquete;
          $cita->idespecialista=$paquetesseleccionados[$i]->idespecialista;
          $cita->fecha=$paquetesseleccionados[$i]->fecha;
          $cita->estatus=0;
          
          $costo=$paquetesseleccionados[$i]->precioventa;
          $cantidad=1;
          $costototal=$costo*$cantidad;
          $paquetes->idpaquete=$cita->idpaquete;
          $obtenerpaquete=$paquetes->ObtenerPaquete2();
          $iduser=$cita->idusuario;
          
          $cita->GuardarCitaApartado();
          $carrito->idusuarios=$cita->idusuario;
          $carrito->idpaquete=$cita->idpaquete;
          $carrito->cantidad=1;
          $carrito->costounitario=$costo;
          $carrito->costototal=$costototal;
          $carrito->idsucursal=$cita->idsucursal;
          $carrito->idespecialista=$cita->idespecialista;
          $carrito->idcitaapartada=$cita->idcitaapartado;
          $carrito->nombrepaquete=$obtenerpaquete[0]->nombrepaquete;
          $carrito->estatus=1;
          $carrito->AgregarCarrito();

 

      }else{

          


          $idpaquete=$paquetesseleccionados[$i]->idpaquete;
            $cantidad=$paquetesseleccionados[$i]->cantidad;
            $paquetes->idpaquete=$idpaquete;
            $obtenerpaquete=$paquetes->ObtenerDatosPaquete();

            $carrito->idusuarios=$idusuario;
            $carrito->idpaquete=$idpaquete;
            $carrito->cantidad=$cantidad;
            $carrito->costounitario=$obtenerpaquete[0]->precioventa;
            $costo=$obtenerpaquete[0]->precioventa*$cantidad;
            $carrito->costototal=$costo;
            $carrito->nombrepaquete=$obtenerpaquete[0]->nombrepaquete;
            $carrito->estatus=1;
            
            $carrito->idespecialista=$paquetesseleccionados[$i]->idespecialista;
             $carrito->idcitaapartada=0;
            $obtenerdecarrito=$carrito->BuscarPaqueteCarrito();

            if (count($obtenerdecarrito)>0) {
               $precioventa=$obtenerdecarrito[0]->precioventa;

                $cantidad=$obtenerdecarrito[0]->cantidad+$carrito->cantidad;
                $carrito->cantidad=$cantidad;
                $costo=$precioventa*$cantidad;
                $carrito->costototal=$costo;
                $carrito->costounitario=$precioventa;

                $carrito->idcarrito= $obtenerdecarrito[0]->idcarrito;

                $carrito->ActualizarCarritoCosto();


            }else{

                $carrito->AgregarCarrito();
  
            }


      }





  }

  /*$horainicials=$_POST['horainicials'];
  $horafinals=$_POST['horafinals'];
  $cita->idusuario=$se->obtenerSesion('usuariopago');
	$hora=$_POST['horario'];
  $valortiempo=$_POST['valorseleccionado'];

  if ($hora!=0) {
    $horario=explode('_', $_POST['horario']);
    $cita->horainicial=$horario[0];

    $hora_original = strtotime($horario[0]);
    $nueva_hora = date('H:i', strtotime('+'.$valortiempo.' minutes', $hora_original));

    $cita->horafinal=$nueva_hora;

  }else{

    $cita->horainicial='';
    $cita->horafinal='';
  }
	
  if ($horainicials!='' && $horafinals!='') {
    $cita->horainicials=$horainicials;
    $cita->horafinals=$horafinals;
  }
 
 
	$cita->idsucursal=$se->obtenerSesion('idsucursalsesion');



	$cita->idpaquete=$_POST['idpaquete'];
	$cita->idespecialista=$_POST['idespecialista'];
	$cita->fecha=$_POST['fecha'];
	$cita->estatus=0;
	
	$costo=$_POST['costo'];
	$cantidad=$_POST['cantidad'];
	$costototal=$costo*$cantidad;
	$paquetes->idpaquete=$cita->idpaquete;
	$obtenerpaquete=$paquetes->ObtenerPaquete2();
	$iduser=$cita->idusuario;
	
	$cita->GuardarCitaApartado();
	$carrito->idusuarios=$cita->idusuario;
	$carrito->idpaquete=$cita->idpaquete;
	$carrito->cantidad=1;
	$carrito->costounitario=$costo;
	$carrito->costototal=$costototal;
	$carrito->idsucursal=$cita->idsucursal;
	$carrito->idespecialista=$cita->idespecialista;
	$carrito->idcitaapartada=$cita->idcitaapartado;
	$carrito->nombrepaquete=$obtenerpaquete[0]->nombrepaquete;
	$carrito->estatus=1;
	$carrito->AgregarCarrito();*/




	

	/*$obtenercita=$cita->ObtenerCitaCreada();



	 $notapago=new Notapago();
   $notapago->db=$db;
   $obj->db=$db;
     
     $f = new Funciones();*/
  /* $lo=new ServiciosAsignados();
   $lo->db=$db;*/
  /* $idnotapago=0;
   $paginaconfi     = new PagConfig();
     $paginaconfi->db = $db;
     $obtenerconfiguracion=$paginaconfi->ObtenerInformacionConfiguracion();
   $obj->idusuarios=$iduser;*/

    /*$contador=$notapago->ActualizarConsecutivo();
    $fecha = explode('-', date('d-m-Y'));
    $anio = substr($fecha[2], 2, 4);
    $folio = $fecha[0].$fecha[1].$anio.$contador;
     $tipopago=new Tipodepagos();
     $tipopago->db=$db;
     $tipopago->idtipodepago=$idtipodepago;
     */
   /*  $obtenertipopago=$tipopago->ObtenerTipodepago2();
     $variable=$obtenertipopago[0]->tipo;*/

 
            //$idtipodepago=$_POST['idtipodepago'];
           

        

   /*      $notapago->idusuario=$iduser;
         $notapago->subtotal=$costo;
         $notapago->iva=0;
         $notapago->total=$costo;
         $notapago->comisiontotal=0;
         $notapago->montomonedero=0;
         $notapago->estatus=0;
         $notapago->tipopago=$obtenertipopago[0]->tipo;
         $notapago->idtipopago=$idtipodepago;
         $notapago->confoto=$confoto;
         $notapago->datostarjeta=$datostarjeta;
         $notapago->datostarjeta2=$datostarjeta2;
         $notapago->idpagostripe=0;
         $notapago->folio=$folio;
         $notapago->descuento=0;
         $notapago->descuentomembresia=0;
         $notapago->requierefactura=$requierefactura;
         $notapago->checkConfirm=0;

         $notapago->comisionpornota=0;
         $notapago->comisionnota=0;
         $notapago->tipocomisionpornota=$tipocomisionpornota;
         $notapago->idusuariodatofiscal=0;
          
         $notapago->codigocupon="";
         $notapago->montocupon=0;
         $notapago->idcupon=0;
        
         $idnotapago=$notapago->idnotapago;

         $notapago->tipodepagosinprocesar=$variable;
		 $notapago->idtipopagosinprocesar=$idtipodepago;
		 $notapago->requierefactura=0;
		 $notapago->CrearNotapago();



		 	    $cita->idusuario=$obtenercita[0]->idusuarios;
                $cita->idcitaapartado=$obtenercita[$i]->idcitaapartada;
                $obtenerapartada=$cita->ObtenerCitaCreada();

                $cita->horacita=$obtenercita[0]->horainicial;
                $cita->fechacita=$obtenercita[0]->fecha;
                $cita->estatus=0;
                
                $cita->idusuario=$iduser;
                $cita->idespecialista=$obtenercita[0]->idespecialista;
                $cita->horainicial=$obtenercita[0]->horainicial;
                $cita->horafinal=$obtenercita[0]->horafinal;

                $cita->idsucursal=$obtenercita[0]->idsucursal;
                $cita->idpaquete=$obtenercita[0]->idpaquete;
                $cita->costo=$costototal;
                $cita->idcortesia=0;


                $cita->CitaCreada();
                $tipo=1;


              $notapago->descripcion=$obtenerpaquete[0]->nombrepaquete;
              $notapago->cantidad=$cantidad;
              $notapago->monto=$costototal;
              $notapago->idpaquete=$obtenerpaquete[0]->idpaquete;
              $notapago->idcita=$cita->idcita;
              $notapago->costounitario=$costo;
               $notapago->tipo=$tipo;
               $notapago->monederoaplicado=0;
              $notapago->Creardescripcionpago();
              */
               
             /* $carrito->estatus=2;
              $carrito->ActualizarEstatusCarrito();
*/


	$db->commit();

	/*$diatexto=$fechas->diasSemanaCorto[date('N', strtotime($obtenercita[0]->fecha))];

	$fechaformato=$diatexto.' '.date('d',strtotime($obtenercita[0]->fecha)).' de '.$fechas->mesesEnEspañol[date('F',strtotime($obtenercita[0]->fecha))].' de '.date('Y', strtotime($obtenercita[0]->fecha));
	
	$obtenercita[0]->fecha=$fechaformato;
	  
*/

	$respuesta['idusuarios']=$cita->idusuario;
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