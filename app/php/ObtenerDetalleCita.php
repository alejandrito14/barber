<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Cita.php");
require_once("clases/class.Funciones.php");
require_once("clases/class.Fechas.php");
require_once("clases/class.Paquetes.php");
require_once("clases/class.Calificacion.php");

try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$lo = new Cita();
	$f=new Funciones();
	$fechas = new Fechas();
	$paquetes = new Paquetes();
	$paquetes->db = $db;
	$calificacion=new Calificacion();
	$calificacion->db=$db;

	//Enviamos la conexion a la clase
	$lo->db = $db;

	$idcita=$_POST['idcita'];
	$idusuario=$_POST['iduser'];
	$lo->idcita=$idcita;
	$lo->idusuario=$idusuario;
	$obtenerdetallecita=$lo->Obtenerdetallecita();
	$obtenerdetallecita[0]->fecha=date('d-m-Y',strtotime($obtenerdetallecita[0]->fechacita));

	$obtenerdetallecita[0]->fechaformato=$fechas->fecha_texto5($obtenerdetallecita[0]->fechacita);
	$calificacion->idcita=$idcita;
	$obtener=$calificacion->ObtenerCalificacionCita();

	$obtenerdetallecita[0]->llevacalificacion=count($obtener);
       $paquetes->idpaquete=$obtenerdetallecita[0]->idpaquete;
       $obtenerpaquete=$paquetes->ObtenerPaquete2();
            $obtenerdetallecita[0]->precioante=0;

            if ($obtenerpaquete[0]->promocion==1) {
                $obtenerdetallecita[0]->precioante=$obtenerpaquete[0]->precioventa;

            }
    

	$respuesta['respuesta']=$obtenerdetallecita[0];
	
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