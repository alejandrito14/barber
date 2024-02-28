<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');

require_once("../../clases/class.Sesion.php");
//creamos nuestra sesion.
$se = new Sesion();
//Inlcuimos las clases a utilizar
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Cita.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Carrito.php");
require_once("../../clases/class.Paquetes.php");
require_once("../../clases/class.Fechas.php");
require_once("../../clases/class.Especialista.php");
require_once("../../clases/class.Sucursal.php");

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
	$especialista=new Especialista();
	$especialista->db=$db;
	$fechas=new Fechas();
	$sucursal=new Sucursal();
	$sucursal->db=$db;

	$db->begin();


	$idcortesia=$_POST['idcortesia'];
	$horario=explode('_', $_POST['horario']);
	$horainicial=$horario[0];
	$horafinal=$horario[1];
	$idsucursal=$se->obtenerSesion('idsucursalsesion');
	$idpaquete=$_POST['idpaquete'];
	$idespecialista=$_POST['idespecialista'];
	$fecha=$_POST['fecha'];
	$idusuario=$se->obtenerSesion('usuariopago');
	$costo=$_POST['costo'];
	$paquetes->idpaquete=$idpaquete;
	$obtenerpaquete=$paquetes->ObtenerPaquete2();

	$especialista->idespecialista=$idespecialista;
	$obtenerespecialista=$especialista->ObtenerEspecialista();


	$diatexto=$fechas->diasSemanaCorto[date('N', strtotime($fecha))];

	$fechaformato=$diatexto.' '.date('d',strtotime($fecha)).' de '.$fechas->mesesEnEspañol[date('F',strtotime($fecha))].' de '.date('Y', strtotime($fecha));

	$sucursal->idsucursales=$idsucursal;
	$datosucursal=$sucursal->ObtenerSucursal();

	$paquetes->idpaquete=$idcortesia;
	$obtenercortesia=$paquetes->ObtenerPaqueteCortesia();


	$respuesta['paquete']=$obtenerpaquete;
	$respuesta['especialista']=$obtenerespecialista;
	$respuesta['hora']=$horario;
	$respuesta['fecha']=$fechaformato;
	$respuesta['sucursal']=$datosucursal[0];
	$respuesta['cortesia']=$obtenercortesia;
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