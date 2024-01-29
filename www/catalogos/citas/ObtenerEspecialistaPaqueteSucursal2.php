<?php
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');
require_once("../../clases/class.Sesion.php");

//Importamos las clases que vamos a utilizar
require_once("../../clases/conexcion.php");

//require_once("clases/class.Categorias.php");
require_once("../../clases/class.Fechas.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Paquetes.php");
require_once("../../clases/class.Especialista.php");
require_once("../../clases/class.Cita.php");

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
	$se = new Sesion();

	//$categorias = new Categorias();
	$fechas = new Fechas();
	//$categorias->db=$db;
	$idsucursal=$se->obtenerSesion('idsucursalsesion');
	$idpaquete=$_POST['idpaquete'];
	$fecha=$_POST['fecha'];
	//$horaseleccionada=explode('_', $_POST['horaseleccionada']);

	$paquetes->idpaquete=$idpaquete;
	$obtenerpaquete=$paquetes->ObtenerPaquete2();
	$costopaquete=$obtenerpaquete[0]->precioventa;

	$especialista->idpaquete=$idpaquete;
	$especialista->idsucursal=$idsucursal;
	$obtenerespecialistas=$especialista->ObtenerEspecialistas(0);
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
			//$citas->horainicial=$horaseleccionada[0];
			//$citas->horafinal=$horaseleccionada[1];

			//$verificar=$citas->VerificarFechaHorarioEspecialista();

			//$verificarapartada=$citas->VerificarCitaApartada();

			//if (count($verificar)==0 ) {
				
				array_push($especialistasdisponibles, $obtenerespecialistas[$i]);
			//}



		}
	}


	for ($i=0; $i < count($especialistasdisponibles); $i++) { 
		
		$fotoperfil=$especialistasdisponibles[$i]->foto;
		if($fotoperfil==""){
				$carpeta=$_SESSION['carpetaapp']!=''?$_SESSION['carpetaapp'].'/':'';
				if ($especialistasdisponibles[$i]->sexo=='M') {

                 $rutaperfil="app/".$carpeta."php/imagenesapp/E.png";
                                          
                  }else{
                    $rutaperfil="app/".$carpeta."php/imagenesapp/F.png";
                                                
                  }
			}
			else{
				$carpeta=$_SESSION['carpetaapp']!=''?$_SESSION['carpetaapp'].'/':'';
			
				$rutaperfil="app/".$carpeta."php/upload/perfil/$fotoperfil";



			}

			$especialistasdisponibles[$i]->foto=$rutaperfil;

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