<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Carrito.php");
require_once("clases/class.Funciones.php");
require_once("clases/class.Fechas.php");
require_once("clases/class.Paquetes.php");
require_once("clases/class.Tarjetalealtad.php");
require_once("clases/class.Canje.php");


/*require_once("clases/class.Sms.php");
require_once("clases/class.phpmailer.php");
require_once("clases/emails/class.Emails.php");*/

try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$lo = new Carrito();
	$f=new Funciones();
	$fechas=new Fechas();
	$paquetes=new Paquetes();
	$paquetes->db=$db;
	//Enviamos la conexion a la clase
	$lo->db = $db;

	$canje = new Canje();
	$canje->db=$db;

	$tarjeta = new Tarjetalealtad();
	$tarjeta->db=$db;
	//$idcategoria=$_POST['idcategoria'];
	$iduser=$_POST['idusuario'];
	$lo->idusuarios=$iduser;
	$obtenercarrito=$lo->ObtenerCarrito();
	
	$totalcarrito=0;
	for ($i=0; $i < count($obtenercarrito); $i++) { 
		
		
			$fechacita=date('Y-m-d',strtotime($obtenercarrito[$i]->fecha));
			
			$obtenercarrito[$i]->fechaformato=$fechas->fecha_texto5($fechacita).' '.$obtenercarrito[$i]->horainicial.'Hrs.';
			$paquetes->idpaquete=$obtenercarrito[$i]->idpaquete;
			$obtenerpaquete=$paquetes->ObtenerPaquete2();
			$obtenercarrito[$i]->precioante=0;

			if ($obtenerpaquete[0]->promocion==1) {
				$obtenercarrito[$i]->precioante=$obtenerpaquete[0]->precioventa;
		
			}

	if ($obtenercarrito[$i]->idcanje==null) {
				// code...
			
	$tarjeta->idusuario=$iduser;
	$tarjeta->idsucursal=$obtenercarrito[$i]->idsucursal; 
	
	$obtenerasignada=$tarjeta->ObtenerTarjetasAsignadas();

	$idtarjetalealtadporcanjear=0;
	$asignacion=[];

	if (count($obtenerasignada)>0) {
	
		for ($j=0; $j <count($obtenerasignada) ; $j++) { 

			$tarjeta->idtarjetalealtad=$obtenerasignada[$j]->idtarjetalealtad;
			$obtenerbene=$tarjeta->VerificarProductosTarjeta($obtenercarrito[$i]->idpaquete);


			if (count($obtenerbene)>0) {
			
			if ($obtenerasignada[$j]->cantidadproducto==$obtenerasignada[$j]->cantidadrequerida) {
				
				$idtarjetalealtadporcanjear=$obtenerasignada[$j]->idtarjetalealtad;
				$asignacion=$obtenerasignada[$j];
				break;
				}
			}
		}

	}
	$idcanje=0;

	$canje->idproducto=$obtenercarrito[$i]->idpaquete;
    $canje->idtarjetalealtadasignacion=$asignacion->{'idtarjetalealtadasignacion'};
    $buscarcanje=$canje->BuscarCanjeProceso();

        $canjeproceso=0;
        $canje->idcanje=0;
        if ($idtarjetalealtadporcanjear!=0 && count($buscarcanje)==0) {


        	$tienecanjeenproceso=$tarjeta->VerificarCanje();
        if (count($tienecanjeenproceso)==0) {
      		$canjeproceso=1;
            $canje->idusuario=$tarjeta->idusuario;
            
            $canje->cantidad=1;

            $canje->GuardarCanje();
            $idcanje=$canje->idcanje;
       

		
		
		$canje->idtarjetalealtad=$idtarjetalealtadporcanjear;
		$obtenerproductos=$tarjeta->ObtenerBeneficiosTarjeta();

		$canje->idtarjetalealtadasignacion=$asignacion->{'idtarjetalealtadasignacion'};


		
		
		}else{
			$idtarjetalealtadporcanjear=0;
			$idcanje=0;
		}
		

	}


			
				
			
		if ($idcanje>0) {
				$costo=0.00;
				$obtenercarrito[$i]->costototal='0.00';
				$canje->idcarrito=$obtenercarrito[$i]->idcarrito;
				$canje->idcanje=$idcanje;
				$canje->GuardarCarritoCanje();

				$lo->idcarrito=$obtenercarrito[$i]->idcarrito;
				$lo->cantidad=$obtenercarrito[$i]->cantidad;
				$lo->costototal='0.00';
				$lo->costounitario='0.00';
				$lo->ActualizarCarritoCosto();
				$obtenercarrito[$i]->idcanje=$idcanje;
			}

		}

			$totalcarrito=$totalcarrito+$obtenercarrito[$i]->costototal;
			/*$lo->idcarrito=$obtenercarrito[$i]->idcarrito;
			$lo->ActualizarValoresCarrito();*/
			
	}


	
	$respuesta['respuesta']=$obtenercarrito;
	$respuesta['totalcarrito']=$totalcarrito;
	//Retornamos en formato JSON 
	$myJSON = json_encode($respuesta);
	echo $myJSON;

}catch(Exception $e){
	//$db->rollback();
	//echo "Error. ".$e;
	
	$array->resultado = "Error: ".$e;
	$array->msg = "Error al ejecutar el php";
	$array->id = '0';
		//Retornamos en formato JSON 
	$myJSON = json_encode($array);
	echo $myJSON;
}
?>