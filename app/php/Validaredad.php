<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Usuarios.php");
require_once("clases/class.Fechas.php");

try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$usuario=new Usuarios();
	$fechas=new Fechas();
	$usuario->db=$db;
	$iduser=$_POST['idusuarios'];
	$usuario->idusuarios=$iduser;

	$obtenerusuario=$usuario->ObtenerUsuario();


	$fechana=$obtenerusuario[0]->fechanacimiento;

	$edadusuario="";
	if ($fechana!='') {
		$edadusuario=$fechas->busca_edad($fechana);
	}
	

	
	$respuesta['edadusuario']=$edadusuario;
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