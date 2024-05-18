<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Cita.php");
require_once("clases/class.Funciones.php");
require_once("clases/class.Carrito.php");
require_once("clases/class.Paquetes.php");
require_once("clases/class.Fechas.php");
require_once "clases/class.Canje.php";
require_once("clases/class.Tarjetalealtad.php");


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
	$lo = new Canje();
	$lo->db=$db;
	$tarjeta = new Tarjetalealtad();


	$tarjeta->db = $db;


	$horario=explode('_', $_POST['horario']);
	$cita->horainicial=$horario[0];
	$cita->horafinal=$horario[1];
	$cita->idsucursal=$_POST['idsucursal'];
	$cita->idpaquete=$_POST['idpaquete'];
	$cita->idespecialista=$_POST['idespecialista'];
	$cita->fecha=$_POST['fecha'];
	$cita->estatus=0;
	$cita->idusuario=$_POST['idusuario'];
	$costo=$_POST['costo'];
	$cantidad=$_POST['cantidad'];
	$costototal=$costo*$cantidad;
	$paquetes->idpaquete=$cita->idpaquete;
	$obtenerpaquete=$paquetes->ObtenerPaquete2();
	$idcanje=isset($_POST['idcanje'])?$_POST['idcanje']:0;

	
	$cita->GuardarCitaApartado();
	$carrito->idusuarios=$cita->idusuario;
	$carrito->idpaquete=$cita->idpaquete;
	$carrito->cantidad=1;
	

	$obtenercita=$cita->ObtenerCitaCreada();
	$db->commit();

	$diatexto=$fechas->diasSemanaCorto[date('N', strtotime($obtenercita[0]->fecha))];

	$fechaformato=$diatexto.' '.date('d',strtotime($obtenercita[0]->fecha)).' de '.$fechas->mesesEnEspañol[date('F',strtotime($obtenercita[0]->fecha))].' de '.date('Y', strtotime($obtenercita[0]->fecha));
	
	$obtenercita[0]->fecha=$fechaformato;






	


	$tarjeta->idusuario=$cita->idusuario;
	$tarjeta->idsucursal=$cita->idsucursal; 
	$obtenerasignada=$tarjeta->ObtenerTarjetasAsignadas();
	$idtarjetalealtadporcanjear=0;
	$asignacion=[];

	if (count($obtenerasignada)>0) {
	
		for ($i=0; $i <count($obtenerasignada) ; $i++) { 

			$tarjeta->idtarjetalealtad=$obtenerasignada[$i]->idtarjetalealtad;
			$obtenerbene=$tarjeta->VerificarProductosTarjeta($cita->idpaquete);
			if (count($obtenerbene)>0) {
			
			if ($obtenerasignada[$i]->cantidadproducto==$obtenerasignada[$i]->cantidadrequerida) {
				
				$idtarjetalealtadporcanjear=$obtenerasignada[$i]->idtarjetalealtad;
				$asignacion=$obtenerasignada[$i];
				break;
				}
			}
		}

	}




    $lo->idproducto=$cita->idpaquete;
    $lo->idtarjetalealtadasignacion=$asignacion->{'idtarjetalealtadasignacion'};
    $buscarcanje=$lo->BuscarCanjeProceso();

        $canjeproceso=0;
        $lo->idcanje=0;
        if ($idtarjetalealtadporcanjear!=0 && count($buscarcanje)==0) {


        	$tienecanjeenproceso=$tarjeta->VerificarCanje();
        if (count($tienecanjeenproceso)==0) {
      		$canjeproceso=1;
            $lo->idusuario=$tarjeta->idusuario;
            $lo->idproducto=$cita->idpaquete;
            $lo->cantidad=1;

            $lo->GuardarCanje();
            $idcanje=$lo->idcanje;
       

	
		
		$lo->idtarjetalealtad=$idtarjetalealtadporcanjear;
		$obtenerproductos=$tarjeta->ObtenerBeneficiosTarjeta();

		$lo->idtarjetalealtadasignacion=$asignacion->{'idtarjetalealtadasignacion'};


		
		
		}else{
			$idtarjetalealtadporcanjear=0;
			$idcanje=0;
		}
		

	}

	if ($idcanje>0) {
		$costo=0;
		$costototal=0;
	}
	$carrito->costounitario=$costo;
	$carrito->costototal=$costototal;
	$carrito->idsucursal=$cita->idsucursal;
	$carrito->idespecialista=$cita->idespecialista;
	$carrito->idcitaapartada=$cita->idcitaapartado;
	$carrito->nombrepaquete=$obtenerpaquete[0]->nombrepaquete;
	$carrito->estatus=1;
	$carrito->AgregarCarrito();
	

	if ($idcanje>0) {
		$lo->idcarrito=$carrito->idcarrito;
		$lo->idcanje=$idcanje;
		$lo->GuardarCarritoCanje();

	}
	  

	$respuesta['idusuarios']=$cita->idusuario;
	$respuesta['cita']=$obtenercita;
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