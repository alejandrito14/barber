<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');
//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Imagencitacomentario.php");
require_once("clases/class.Funciones.php");
require_once("clases/class.Usuarios.php");

try
{
	//Declaramos objetos de clases
	$db = new MySQL();
	$lo = new Imagencitacomentario();
	$f=new Funciones();
	$usuarios=new Usuarios();
	$usuarios->db=$db;
	$lo->db=$db;
	$db->begin();



		$idimageneliminar=$_POST['idimagenescita'];
		$lo->idimagencita=$idimageneliminar;
		$datosimagenindividual=$lo->obtenerImagen();
		$imageneliminar=$datosimagenindividual[0]->foto;

		$ruta="upload/imagencita/";

		if($imageneliminar != "")
		{
		 unlink($ruta.$imageneliminar); 
		}

		$lo->EliminarImagenCita();
		$db->commit();

	$respuesta['respuesta']=1;
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