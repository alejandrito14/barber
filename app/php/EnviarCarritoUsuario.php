<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Carrito.php");
require_once("clases/class.Funciones.php");
require_once("clases/class.Fechas.php");
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
	$usuarios=new Usuarios();
	$usuarios->db=$db;

	//Enviamos la conexion a la clase
	$lo->db = $db;
	$db->begin();


	$idcliente=$_POST['idcliente'];
	$iduser=$_POST['id_user'];
	$usuarios->idusuarios=$idcliente;
	$obtenerusuario= $usuarios->ObtenerUsuario();



	if ($iduser!=$idcliente) {
		$lo->idusuarios=$iduser;

		$obtenercarrito=$lo->ObtenerCarrito();

		if (count($obtenercarrito)>0) {
			for ($i=0; $i < count($obtenercarrito); $i++) {
				$lo->idusuarios=$idcliente; 
				$lo->idcarrito=$obtenercarrito[$i]->idcarrito;
				$lo->ActualizarIdUsuarioCarrito();

				if ($obtenercarrito[$i]->idcitaapartada) {
					$lo->idcitaapartada=$obtenercarrito[$i]->idcitaapartada;
					$lo->ActualizarIdusuarioCita();
				}

			}
		}


		$respuesta=1;
		

	}else{

		$respuesta=1;
	}

	 $monedero=0;
    if ($obtenerusuario[0]->monedero>0) {
        $monedero=1;
    }
	$db->commit();

	$res = array('respuesta' =>$respuesta,'usuario'=>$obtenerusuario[0],'monedero'=>$monedero);

	/*$respuesta['respuesta']=$sucursales;
	$respuesta['imagenes']=$imagenes;*/
	
	//Retornamos en formato JSON 
	$myJSON = json_encode($res);
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