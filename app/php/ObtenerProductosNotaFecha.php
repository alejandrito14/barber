<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Funciones.php");
require_once("clases/class.Notapago.php");
require_once("clases/class.Fechas.php");
require_once("clases/class.Sucursal.php");

try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$lo = new Notapago();
	$lo->db=$db;
	$f=new Funciones();
	$fechas=new Fechas();
	$sucursal=new Sucursal();
	$sucursal->db=$db;
	$idusuario=$_POST['idusuario'];
	$fecha=$_POST['fecha'];

	$sucursal->idusuario=$idusuario;
	$obtenersucursal=$sucursal->AccesoSucursal();

	$lo->idsucursal=$obtenersucursal[0]->idsucursales;
	$fechafiltro=date('Y-m-d',strtotime($fecha));

	$lo->fecha=$fechafiltro;
	$obtener=$lo->ListadoNotasDescripcionProductos();


		$textoestatus=array('Pendiente','Aceptado','Cancelado');

	for ($i=0; $i < count($obtener); $i++) { 
		
		$fecha=$obtener[$i]->fecha;
		$dianumero=explode('-',$fecha);
		$obtener[$i]->fechaformatopago=explode(' ',$dianumero[2])[0].'/'.$fechas->mesesAnho3[$fechas->mesdelano($fecha)-1].' '.$dianumero[0];
		/*	$obtener[$i]->monto=$obtener[$i]->total;
			
			$obtener[$i]->concepto=$obtener[$i]->folio;*/
			$obtener[$i]->textoestatus=$textoestatus[$obtener[$i]->estatus];


			/*$lo->idnotapago=$obtener[$i]->idnotapago;
			$obtenerdescripcion=$lo->ObtenerdescripcionNota();
			$total=0;
			for ($j=0; $j <count($obtenerdescripcion) ; $j++) { 

				$total=$total+$obtenerdescripcion[$j]->monto;
			
			}*/
			$obtener[$i]->total=$total;


		}
		
		$diatexto=$fechas->diasSemanaCorto[date('N', strtotime($fechafiltro))];

	$fechaformato=$diatexto.' '.date('d',strtotime($fechafiltro)).' de '.$fechas->mesesEnEspañol[date('F',strtotime($fechafiltro))].' de '.date('Y', strtotime($fechafiltro));
	//echo $mes;
	
	$respuesta['respuesta']=1;
	$respuesta['notasproducto']=$obtener;
	$respuesta['fechafiltro']=$fechaformato;	
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