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
$idmenumodulo = $_GET['idmenumodulo'];

//validaciones para todo el sistema





$tipousaurio = $_SESSION['se_sas_Tipo'];  //variables de sesion
$lista_empresas = $_SESSION['se_liempresas']; //variables de sesion

//validaciones para todo el sistema


/*======================= TERMINA VALIDACIÓN DE SESIÓN =========================*/


//Importamos nuestras clases
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Notapago.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Botones.php");
require_once("../../clases/class.Fechas.php");

//Se crean los objetos de clase
$db = new MySQL();
$Notapago = new Notapago();
$f = new Funciones();
$bt = new Botones_permisos();
$fechas=new Fechas();

$Notapago->db = $db;

try {	
		$idnotapago=$_POST['idnotapago'];
		$Notapago->idnotapago=$idnotapago;
		$notapagoelegida=$Notapago->Obtenernota();

		$idusuario=$notapagoelegida[0]->idusuario;

		$Notapago->idusuario=$idusuario;
		$obtenernotas=$Notapago->ObtenerNotasPagoPendientes();
        $codigo=$se->obtenerSesion('codservicio');

 
        $fechasnotas=array();
		if (count($obtenernotas)>0) {
			
			for ($i=0; $i <count($obtenernotas) ; $i++) { 
				
				$Notapago->idnotapago=$obtenernotas[$i]->idnotapago;

				 $obtenerpagosstripe=$Notapago->ObtenerdescripcionNota();

				 for ($j=0; $j < count($obtenerpagosstripe); $j++) { 
			        $obtenerpagosstripe[$j]->foto=$codigo.'/'.$obtenerpagosstripe[$j]->foto;
			       $fechaformato1="";
			        if ($obtenerpagosstripe[$j]->fecha!='') {
			        	# code...
			        
			        $diatexto=$fechas->diasSemanaCorto[date('N', strtotime($obtenerpagosstripe[$j]->fecha))];

				   $fechaformato1=$diatexto.' '.date('d',strtotime($obtenerpagosstripe[$j]->fecha)).' de '.$fechas->mesesEnEspañol[date('F',strtotime($obtenerpagosstripe[$j]->fecha))].' de '.date('Y', strtotime($obtenerpagosstripe[$j]->fecha));

			       

			    		}

			    	$obtenerpagosstripe[$j]->fechaformato=$fechaformato1;


			      }

				 $obtenernotas[$i]->detalle=$obtenerpagosstripe;


			$obtenernotas[$i]->fechaagrupar=date('d-m-Y',strtotime($obtenernotas[$i]->fecha));


			$diatexto=$fechas->diasSemanaCorto[date('N', strtotime($obtenernotas[$i]->fecha))];

			$fechaformato=$diatexto.' '.date('d',strtotime($obtenernotas[$i]->fecha)).' de '.$fechas->mesesEnEspañol[date('F',strtotime($obtenernotas[$i]->fecha))].' de '.date('Y', strtotime($obtenernotas[$i]->fecha));



			$objeto=array('fecha'=>$obtenernotas[$i]->fechaagrupar,'fechaformato'=>$fechaformato);

			array_push($fechasnotas,$objeto);



			}



		}



		$agrupadoPorFecha = [];

foreach ($fechasnotas as $elemento) {
    $fecha = $elemento['fecha'];

    if (!isset($agrupadoPorFecha[$fecha])) {
        $agrupadoPorFecha[$fecha] = [];
    }

    $agrupadoPorFecha[$fecha][] = $elemento;
}

$agrupadoPorFecha = array_values($agrupadoPorFecha);


        
		$respuesta['respuesta']=1;
		$respuesta['notaspago']=$obtenernotas;
		$respuesta['notaelegida']=$notapagoelegida;
		$respuesta['fechasnotas']=$agrupadoPorFecha;

		echo json_encode($respuesta);
	} catch (Exception $e) {
				
			
		echo json_encode($e);

	}	





?>