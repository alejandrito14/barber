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
	$mes=$_POST['mes'];
	$anio=$_POST['anio'];
	$productofechasdia=[];
	$sucursal->idusuario=$idusuario;
	$obtenersucursal=$sucursal->AccesoSucursal();

	$lo->idsucursal=$obtenersucursal[0]->idsucursales;
	

	 $primerdia= date('Y-m-d', mktime(0,0,0, $mes, 1, $anio));

     $day = date("d", mktime(0,0,0, $mes+1, 0, $anio));
 
    $ultimodia=date('Y-m-d', mktime(0,0,0, $mes, $day, $anio));

 	 $fechainicio=strtotime($primerdia);
    $fechafin=strtotime($ultimodia);
    $productofechas=array();
	$arrayfechasdisponibles=[];

    for($i=$fechainicio; $i<=$fechafin; $i+=86400){

		$fechaconsulta=date("Y-m-d", $i);
    	
		$dia_semana = date("w", strtotime($fechaconsulta)); 

		$lo->fecha=$fechaconsulta;
		$obtenernotas=$lo->ListadoNotasProductos();
			if (count($obtenernotas)>0) {
				
				array_push($productofechas, $fechaconsulta);
			}
			 
		
		}

		$fechafiltro=date('Y-m-d');

		$lo->fecha=$fechafiltro;
		$obtener=$lo->ListadoNotasDescripcionProductos();


		$textoestatus=array('Pendiente','Aceptado','Cancelado');

	for ($i=0; $i < count($obtener); $i++) { 
		
		$fecha=$obtener[$i]->fecha;
		$dianumero=explode('-',$fecha);
		$obtener[$i]->fechaformatopago=explode(' ',$dianumero[2])[0].'/'.$fechas->mesesAnho3[$fechas->mesdelano($fecha)-1].' '.$dianumero[0];
			$obtener[$i]->monto=$obtener[$i]->total;
			
			$obtener[$i]->concepto=$obtener[$i]->folio;
			$obtener[$i]->textoestatus=$textoestatus[$obtener[$i]->estatus];


			$lo->idnotapago=$obtener[$i]->idnotapago;
			$obtenerdescripcion=$lo->ObtenerdescripcionNota();
			$total=0;
			for ($j=0; $j <count($obtenerdescripcion) ; $j++) { 

				$total=$total+$obtenerdescripcion[$j]->monto;
			
			}
			$obtener[$i]->total=$total;


		}

		

	//echo $mes;
	
	$respuesta['respuesta']=1;
	$respuesta['productofechas']=$productofechas;
	$respuesta['productofechasdia']=$obtener;
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