<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Carrito.php");
require_once("clases/class.Funciones.php");
require_once("clases/class.Fechas.php");
require_once("clases/class.Paquetes.php");
require_once("clases/class.Usuarios.php");

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

	$usuarios=new Usuarios();
	$usuarios->db=$db;
	//Enviamos la conexion a la clase
	$lo->db = $db;


	//$idcategoria=$_POST['idcategoria'];
	$iduser=$_POST['idusuario'];
	$lo->idusuarios=$iduser;
	$idusuario=$iduser;
	$usuarios->idusuarios=$idusuario;
	$obtenerhijos=$usuarios->ObtenerHijos();

	for ($i=0; $i < count($obtenerhijos); $i++) { 
		$idusuario.=','.$obtenerhijos[$i]->idusuarios;
	}

	$lo->idusuarios=$idusuario;

	$obtenercarrito=$lo->ObtenerCarrito();
	$cortesiasporagregar=0;
	$concortesia=0;
	$totalcarrito=0;
	$carritofaltacortesia=array();

	
	for ($i=0; $i < count($obtenercarrito); $i++) { 
		
			if ($obtenercarrito[$i]->concortesia==1) {
				# code...
				$concortesia=1;
			if ($obtenercarrito[$i]->colococortesia==0) {
				$cortesiasporagregar++;
				array_push($carritofaltacortesia, $obtenercarrito[$i]);

				
			}


		}
			
	}


	
	$respuesta['respuesta']=$carritofaltacortesia;
	$respuesta['cortesiasporagregar']=$cortesiasporagregar;
	$respuesta['concortesia']=$concortesia;
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