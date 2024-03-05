<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.LeerQr.php");
require_once("clases/class.Cita.php");
require_once("clases/class.Paquetes.php");
require_once("clases/class.Fechas.php");

try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$lo = new LeerQr();
	$cita=new Cita();
	$token->db=$db;
	$cita->db=$db;

	$fechas = new Fechas();
	$paquetes = new Paquetes();
	$paquetes->db =$db;
	//Enviamos la conexion a la clase
	$lo->db = $db;
	$idcita=$_POST['idcita'];
	$idusuarios=$_POST['id_user'];
	$idqrgenerado=$_POST['idqrgenerado'];
	$lo->idusuarios=$idusuarios;
	$lo->idqrgenerado=$idqrgenerado;
	$lo->idcita=$_POST['idcita'];
	$arra=$lo->VerificarSihasidoleido();

	$validado=0;
	if (count($arra)>0) {
		$validado=1;
	
	

	$cita->idcita=$idcita;
	$cita->idusuario=$idusuarios;
	$obtenerdetallecita=$cita->Obtenerdetallecita();
	$obtenerdetallecita[0]->fecha=date('d-m-Y',strtotime($obtenerdetallecita[0]->fechacita));

	$obtenerdetallecita[0]->fechaformato=$fechas->fecha_texto5($obtenerdetallecita[0]->fechacita);




     $paquetes->idpaquete=$obtenerdetallecita[0]->idpaquete;
     $obtenerpaquete=$paquetes->ObtenerPaquete2();
     $obtenerdetallecita[0]->precioante=0;

            if ($obtenerpaquete[0]->promocion==1) {
                $obtenerdetallecita[0]->precioante=$obtenerpaquete[0]->precioventa;

            }	
	
        }

	$respuesta['respuesta']=$validado;
	$respuesta['datosqr']=$arra;
	$respuesta['detallecita']=$obtenerdetallecita;
	
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