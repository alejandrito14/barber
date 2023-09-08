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


	$idcarrito=$_POST['idcarrito'];
	$idcortesia=$_POST['idcortesia'];
	$carrito->idcortesia=$idcortesia;
	$carrito->idcarrito=$idcarrito;
	$carrito->colococortesia=1;
	$carrito->fechacortesia=date('Y-m-d H:i:s');
	$carrito->GuardarCortesiaCarrito();

	$obtenercarrito=$carrito->ObtenerDelCarrito();
	$idcitaapartada=$obtenercarrito[0]->idcitaapartada;
	if (count($idcitaapartada)>0) {
		$cita->idcitaapartado=$idcitaapartada;
		$cita->idcortesia=$idcortesia;
		$cita->ActualizarCortesiaCita();
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