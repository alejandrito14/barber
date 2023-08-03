<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Cita.php");
require_once("clases/class.Funciones.php");
require_once("clases/class.Carrito.php");
require_once("clases/class.Paquetes.php");
require_once("clases/class.Fechas.php");

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
	$fechas=new Fechas();
	$db->begin();



	$horario=explode('_', $_POST['horario']);
	$cita->horainicial=$horario[0];
	$cita->horafinal=$horario[1];
	$cita->idsucursal=$_POST['idsucursal'];
	$cita->idpaquete=$_POST['idpaquete'];
	$cita->idespecialista=$_POST['idespecialista'];
	$cita->fecha=$_POST['fecha'];
	$cita->estatus=0;
	$cita->idusuario=$_POST['idusuario'];
	$costo=$_POST['costo'];
	$cantidad=$_POST['cantidad'];
	$costototal=$costo*$cantidad;
	$paquetes->idpaquete=$cita->idpaquete;
	$obtenerpaquete=$paquetes->ObtenerPaquete2();

	
	$cita->GuardarCitaApartado();
	$carrito->idusuarios=$cita->idusuario;
	$carrito->idpaquete=$cita->idpaquete;
	$carrito->cantidad=1;
	$carrito->costounitario=$costo;
	$carrito->costototal=$costototal;
	$carrito->idsucursal=$cita->idsucursal;
	$carrito->idespecialista=$cita->idespecialista;
	$carrito->idcitaapartada=$cita->idcitaapartado;
	$carrito->nombrepaquete=$obtenerpaquete[0]->nombrepaquete;
	$carrito->estatus=1;
	$carrito->AgregarCarrito();
	

	$obtenercita=$cita->ObtenerCitaCreada();
	$db->commit();

	$diatexto=$fechas->diasSemanaCorto[date('N', strtotime($obtenercita[0]->fecha))];

	$fechaformato=$diatexto.' '.date('d',strtotime($obtenercita[0]->fecha)).' de '.$fechas->mesesEnEspañol[date('F',strtotime($obtenercita[0]->fecha))].' de '.date('Y', strtotime($obtenercita[0]->fecha));
	
	$obtenercita[0]->fecha=$fechaformato;
	  


	$respuesta['idusuarios']=$cita->idusuario;
	$respuesta['cita']=$obtenercita;
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