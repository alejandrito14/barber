<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Cita.php");
require_once("clases/class.Funciones.php");
require_once("clases/class.Carrito.php");
require_once("clases/class.Paquetes.php");

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
	$db->begin();

	$idusuario=$_POST['iduser'];
	$producto=json_decode($_POST['producto']);
	$idsucursal=$_POST['idsucursal'];

	$idpaquete=$producto->{'idpaquete'};
	$costo=$producto->{'price'};
	$cantidad=$producto->{'cant'};
	$titulosgrupos=$producto->{'titulosgrupos'};
	
	$paquetes->idpaquete=$idpaquete;
	$obtenerpaquete=$paquetes->ObtenerPaquete2();
	$costototal=$cantidad*$costo;
	$carrito->idusuarios=$idusuario;
	$carrito->idpaquete=$idpaquete;
	$carrito->cantidad=1;
	$carrito->costounitario=$costo;
	$carrito->costototal=$costototal;
	$carrito->idsucursal=$idsucursal;
	$carrito->idespecialista=0;
	$carrito->idcitaapartada=0;
	$carrito->nombrepaquete=$obtenerpaquete[0]->nombrepaquete;
	$carrito->titulosgrupos=json_decode($titulosgrupos);
	$carrito->estatus=1;
	$carrito->AgregarCarrito();
	

	$db->commit();


	  


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