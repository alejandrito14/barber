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
	$se = new Sesion();

	$citas=new Cita();
	$citas->db=$db;
	//$categorias = new Categorias();
	$fechas = new Fechas();
	//$categorias->db=$db;
	$idsucursal=$se->obtenerSesion('idsucursalsesion');
	$idpaquete=$_POST['idpaquete'];
	$fecha=$_POST['fecha'];
	$horaseleccionada=explode('_', $_POST['horaseleccionada']);
	$idnotapago=$_POST['idnotapago'];

	$objeto=json_decode($_POST['objeto']);
	$idtemporalcarrito=0;

	if ($objeto->idtemporalcarrito!='') {
		$idtemporalcarrito=$objeto->idtemporalcarrito;
	}

	$idespecialistasele=$_POST['idespecialistasele']!='undefined'?$_POST['idespecialistasele']:'';

	$paquetes->idpaquete=$idpaquete;
	$obtenerpaquete=$paquetes->ObtenerPaquete2();
	$costopaquete=$obtenerpaquete[0]->precioventa;
	$especialista->idpaquete=$idpaquete;
	$especialista->idsucursal=$idsucursal;
	$obtenerespecialistas=$especialista->ObtenerEspecialistas($idespecialistasele);
	$especialistasdisponibles=array();



	if (count($obtenerespecialistas)>0) {
		for ($i=0; $i < count($obtenerespecialistas); $i++) { $obtenerespecialistas[$i]->costo=$costopaquete;
			
		

			if ($obtenerespecialistas[$i]->preciofijo!='') {
				$obtenerespecialistas[$i]->costo=$obtenerespecialistas[$i]->preciofijo;

			}

			$citas->idespecialista=$obtenerespecialistas[$i]->idespecialista;
			$citas->fecha=$fecha;
			$citas->horainicial=date('H:i',strtotime($horaseleccionada[0]));

			$intervaloservicio=$objeto->intervaloservicio;
			
			$nuevaHora = date('H:i', strtotime($citas->horainicial . ' +'.$intervaloservicio.' minutes'));

			$citas->horafinal=$nuevaHora;
			$idcita=$objeto->idcitaapartada;

			$verificar=$citas->VerificarFechaHorarioEspecialistaMenosActual($idcita);

			//$verificarapartada=$citas->VerificarCitaApartada();
			$verificarconnota=$citas->VerificarConNota($idnotapago,$idtemporalcarrito);

			
			if (count($verificar)==0 && count($verificarconnota)==0) {
				
				array_push($especialistasdisponibles, $obtenerespecialistas[$i]);
			}



		}
	}

	//var_dump($especialistasdisponibles);die();
	/*if ($idespecialistasele!='') {
		$encontrado=0;
		for ($i=0; $i < count($especialistasdisponibles); $i++) { 

			if ($especialistasdisponibles[$i]->idespecialista==$idespecialistasele) {

				$encontrado=1;
				return 0;
			}

		}
		
		if ($encontrado==0) {
			
			$especialista->idespecialista=$idespecialistasele;
			$obtenerespe=$especialista->ObtenerEspecialista();
			$nombre=$obtenerespe[0]->nombre;
			$paterno=$obtenerespe[0]->paterno;
			$materno=$obtenerespe[0]->materno;
			$sexo=$obtenerespe[0]->sexo;
			$idsucursal=$obtenerespe[0]->idsucursal;
			$idusuarios=$obtenerespe[0]->idusuarios;
			$foto=$obtenerespe[0]->foto;
			$orden=$obtenerespe[0]->orden;
			$costo=0;
			$idespecialista=$especialista->idespecialista;

			$array=array('nombre'=>$nombre,'paterno'=>$paterno,'materno'=>$materno,'sexo'=>$sexo,'idsucursal'=>$idsucursal,'idusuarios'=>$idusuarios,'foto'=>$foto,'orden'=>$orden,'costo'=>$costo,'idespecialista'=>$idespecialista);
			//array_push($especialistasdisponibles,$array);

		}
		


	}*/


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