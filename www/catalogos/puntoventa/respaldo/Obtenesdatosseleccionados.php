<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');

require_once("../../clases/class.Sesion.php");
//creamos nuestra sesion.
$se = new Sesion();
//Inlcuimos las clases a utilizar
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Especialista.php");
require_once("../../clases/class.Fechas.php");
require_once("../../clases/class.Usuarios.php");

try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$especialista = new Especialista();
	$especialista->db=$db;
	$fechas=new Fechas();
	$usuarios=new Usuarios();
	$usuarios->db=$db;

  $idespecialista=$_POST['idespecialista'];
	$especialista->idespecialista=$idespecialista;
  $obtener=$especialista->ObtenerEspecialista();
  $fecha=$fechas->fecha_texto5($_POST['fecha']);
  $hora=substr($_POST['hora'],0,5);

  $idcliente=$se->obtenerSesion('usuariopago');
  $usuarios->id_usuario=$idcliente;
  $obtenerusuario=$usuarios->ObtenerDatosUsuario();
  $nombreusuario=$obtenerusuario['nombre'].' '.$obtenerusuario['paterno'].' '.$obtenerusuario['materno'];

  $db->commit();


  $respuesta['respuesta']=1;
  $respuesta['especialista']=$obtener;
  $respuesta['fecha']=$fecha;
  $respuesta['hora']=$hora;
  $respuesta['usuario']=$nombreusuario;

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