<?php
/*======================= INICIA VALIDACIÓN DE SESIÓN =========================*/

require_once("../../clases/class.Sesion.php");
//creamos nuestra sesion.
$se = new Sesion();

if(!isset($_SESSION['se_SAS']))
{
	/*header("Location: ../../login.php"); */ echo "login";

	exit;
}

/*======================= TERMINA VALIDACIÓN DE SESIÓN =========================*/

//Importamos las clases que vamos a utilizar
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Cita.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Fechas.php");
require_once("../../clases/class.Especialista.php");
require_once("../../clases/class.Notapago.php");
require_once("../../clases/class.Imagencita.php");
try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$lo = new Cita();
	$f=new Funciones();
	$fechas = new Fechas();
	$especialista=new Especialista();
	$especialista->db=$db;
	$notapago=new Notapago();
	$notapago->db=$db;
	$imagencita=new Imagencita();
	$imagencita->db=$db;
	//Enviamos la conexion a la clase
	$lo->db = $db;

	$idcita=$_POST['idcita'];
	$idusuario=$_POST['iduser'];
	$lo->idcita=$idcita;
	$lo->idusuario=$idusuario;
	$especialista->idusuarios=$idusuario;
	$notapago->idcita=$idcita;

	$obtenerdetallecita=$lo->ObtenerdetallecitaAdmin();
	$obtenerdetallecita[0]->fecha=date('d-m-Y',strtotime($obtenerdetallecita[0]->fechacita));

	$imagencita->idcita=$idcita;
	$obtenerimagenes=$imagencita->ObtenerImagenesCita();

	$obtenerdetallecita[0]->fechaformato=$fechas->fecha_texto5($obtenerdetallecita[0]->fechacita);

	$obtenerdetallecita[0]->fechacheckin=date('d/m/Y H:i:s',strtotime($obtenerdetallecita[0]->fechacheckin));
	$obtenerdetallecita[0]->fechacheckout=date('d/m/Y H:i:s',strtotime($obtenerdetallecita[0]->finalizacita));





	$codigo=$se->obtenerSesion('codservicio');
    $obtener[0]->imagen=$codigo.'/'.$obtener[0]->imagen;

   $pagada= $notapago->VerificarCitaPagada();


   if (count($obtenerimagenes)>0) {
   		for ($i=0; $i <count($obtenerimagenes) ; $i++) { 

   			$imagen=$obtenerimagenes[$i]->foto;
   			$ruta="app/".$_SESSION['carpetaapp']."/php/upload/imagencita/$imagen";

   			$obtenerimagenes[$i]->ruta=$ruta;
   		}
   }

   $sipago=0;
   if (count($pagada)==0) {
   	$sipago=1;

   }

   $obtenerdetallecita[0]->idnotapago=0;

   if ($sipago==0) {
    $obtenerdetallecita[0]->idnotapago=$pagada[0]->idnotapago;
   }

	$obtenerdetallecita[0]->pagada=$sipago;

	$respuesta['respuesta']=$obtenerdetallecita[0];
	$respuesta['imagenes']=$obtenerimagenes;
	
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