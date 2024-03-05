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
	$usuario=new Usuarios();
	$usuario->db=$db;
	//Enviamos la conexion a la clase
	$lo->db = $db;


	//$idcategoria=$_POST['idcategoria'];
	$iduser=$_POST['idusuario'];
	$lo->idusuarios=$iduser;
	$usuario->idusuarios=$iduser;
	$obtener=$usuario->ObtenerUsuario();
	$monederousuario=$obtener[0]->monedero;

	

	$obtenercarrito=$lo->ObtenerCarrito();
	$monederoporagregar=0;
	$concortesia=0;
	$totalcarrito=0;
	$carritofaltamonedero=array();

	$sumarmonedero=0;
	for ($i=0; $i < count($obtenercarrito); $i++) { 

		$sumarmonedero=$sumarmonedero+$obtenercarrito[$i]->montomonedero;
		
			if ($obtenercarrito[$i]->montomonedero==0) {
				
				$monederoporagregar++;
				array_push($carritofaltamonedero, $obtenercarrito[$i]);

		}
			
	}
	$monederototal=$monederousuario-$sumarmonedero;
	if ($sumarmonedero<$monederousuario) {
		
	
	}else{
		$carritofaltamonedero=array();

	}


	
	$respuesta['respuesta']=$carritofaltamonedero;
	$respuesta['monederoporagregar']=$monederoporagregar;
	$respuesta['monederousuario']=$obtener[0]->monedero;
	$respuesta['monederoporusar']=$monederototal;
	$respuesta['monederousado']=$sumarmonedero;
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