<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Imagencita.php");
require_once("clases/class.Funciones.php");
require_once("clases/class.Usuarios.php");


try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$lo = new Imagencita();
	$f=new Funciones();
	$usuarios=new Usuarios();
	$usuarios->db=$db;
	
	$db->begin();

	//Enviamos la conexion a la clase
	$lo->db = $db;

	$lo->idcita = trim($_POST['idcita']);
	$lo->idusuario=$_POST['iduser'];

	$lo->foto=$_POST['foto'];
	
	
	if($lo->idimagencita == 0)
	{
		//guardando
		$lo->GuardarImagen();
		$notititulo='Nueva';

		/*$md->guardarMovimiento($f->guardar_cadena_utf8('publicidad'),'publicidad',$f->guardar_cadena_utf8('Nuevo publicidad creado con el ID-'.$emp->idpublicidad));*/
	}else{
		$lo->modificarImagen();	
		$notititulo='Edición de';

		/*$md->guardarMovimiento($f->guardar_cadena_utf8('publicidad'),'publicidad',$f->guardar_cadena_utf8('Modificación del publicidad -'.$emp->idpublicidad));*/
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