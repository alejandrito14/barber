<?php
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');

//Importamos las clases que vamos a utilizar
require_once("clases/conexcion.php");

//require_once("clases/class.Categorias.php");
require_once("clases/class.Fechas.php");
require_once("clases/class.Funciones.php");
require_once("clases/class.Paquetes.php");
require_once("clases/class.Especialista.php");
require_once("clases/class.Cita.php");

try
{
	//declaramos los objetos de clase
	$db = new MySQL();
	$f = new Funciones();
	$paquetes=new Paquetes();
	$paquetes->db=$db;
	$especialista=new Especialista();
	$especialista->db=$db;
	$citas=new Cita();
	$citas->db=$db;
	//$categorias = new Categorias();
	$fechas = new Fechas();
	//$categorias->db=$db;
	$idsucursal=$_POST['idsucursal'];
	$idpaquete=$_POST['idpaquete'];
	$fecha=$_POST['fecha'];
	$horaseleccionada=explode('_', $_POST['horaseleccionada']);

	$paquetes->idpaquete=$idpaquete;
	$obtenerpaquete=$paquetes->ObtenerPaquete2();
	$costopaquete=$obtenerpaquete[0]->precioventa;
	$especialista->idpaquete=$idpaquete;
	$especialista->idsucursal=$idsucursal;
	$obtenerespecialistas=$especialista->ObtenerEspecialistas();
	$especialistasdisponibles=array();



	if (count($obtenerespecialistas)>0) {
		for ($i=0; $i < count($obtenerespecialistas); $i++) { $obtenerespecialistas[$i]->costo=$costopaquete;
			
			/*if ($obtenerespecialistas[$i]->costo=='') {

				

				
			}*/

			if ($obtenerespecialistas[$i]->preciofijo!='') {
				$obtenerespecialistas[$i]->costo=$obtenerespecialistas[$i]->preciofijo;

			}

			$citas->idespecialista=$obtenerespecialistas[$i]->idespecialista;
			$citas->fecha=$fecha;
			$citas->horainicial=$horaseleccionada[0];
			$citas->horafinal=$horaseleccionada[1];

			$verificar=$citas->VerificarFechaHorarioEspecialista();

			//$verificarapartada=$citas->VerificarCitaApartada();

			if (count($verificar)==0 ) {
				
				array_push($especialistasdisponibles, $obtenerespecialistas[$i]);
			}



		}
	}


	

	$respuesta['respuesta']=1;
	$respuesta['especialista']=$especialistasdisponibles;
	/*$respuesta['fechadia']=$fechadia;
	$respuesta['arrayfechasdias']=$arrayfechasdias;
*/
	echo json_encode($respuesta);


	
}catch(Exception $e)
{
	$db->rollback();
	echo "Error. ".$e;
}
?>