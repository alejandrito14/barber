<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


require_once("../../clases/class.Sesion.php");
//creamos nuestra sesion.
$se = new Sesion();
$codigo=$se->obtenerSesion('codservicio');

//Inlcuimos las clases a utilizar
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Cita.php");
require_once("../../clases/class.Fechas.php");
require_once("../../clases/class.Sucursal.php");
require_once("../../clases/class.PagConfig.php");
require_once("../../clases/class.Notapago.php");
require_once("../../clases/class.NotapagoCancelada.php");
require_once "../../clases/class.Usuarios.php";

try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$lo = new Cita();
	$lo->db=$db;
	$f=new Funciones();
	$fechas=new Fechas();
	$sucursal=new Sucursal();
	$sucursal->db=$db;
	$notapago=new Notapago();
    $notapago->db=$db;
    $notapagocancelada=new NotapagoCancelada();
    $notapagocancelada->db=$db;

    $obj->db=$db;
     $db->begin();
    $idusuariocancela=$_SESSION['se_sas_Usuario'];
	$idusuario=$_POST['idusuarios'];
	$idnotapago=$_POST['idnotapago'];
	$idnotapago_descripcion=$_POST['idnotapago_descripcion'];
	$motivocancelacion=$_POST['motivocancela'];
	$notapago->idnotapago_descripcion=$idnotapago_descripcion;

$obtenernotadescripcion=$notapago->Obtenerdescripcion();
$idnotapagodescripcion=$obtenernotadescripcion[0]->idnotapago_descripcion;
	
  $notapago->idnotapago=$idnotapago;

  	
	$obtenerdetallenota=$notapago->ObtenerdescripcionNota();
	    $montocancelado=0;
	   
	    $obtenerpagosstripe=$notapago->ObtenerdescripcionNota();
 
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
		
		$respuesta['respuesta']=1;
		$respuesta['descripcion']=$obtenerpagosstripe;

		echo json_encode($respuesta);
	} catch (Exception $e) {
				
			
		echo json_encode($e);

	}	





?>