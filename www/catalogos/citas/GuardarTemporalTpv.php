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
require_once("../../clases/class.Tpv.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Botones.php");
require_once("../../clases/class.Paquetes.php");
require_once("../../clases/class.Tiempo.php");
require_once("../../clases/class.Cita.php");


//Se crean los objetos de clase
$db = new MySQL();
$tpv = new Tpv();
$f = new Funciones();
$bt = new Botones_permisos();
$paquetes=new Paquetes();
$paquetes->db=$db;
$tiempo=new Tiempo();
$tiempo->db=$db;
$citas=new Cita();
$citas->db=$db;

$tpv->db = $db;
$db->begin();
try {
		
		$objeto=json_decode($_POST['objeto']);

		  $tpv->idusuarios=$se->obtenerSesion('usuariopago');
		  $tpv->idtpv=$se->obtenerSesion('idtpv');
		  $tpv->idpaquete=$objeto->idpaquete;
          $tpv->idespecialista=$objeto->idespecialista;
          $tpv->fecha=$objeto->fecha;
          $tpv->estatus=0;
          
          $costo=$objeto->precioventa;
          $cantidad=$objeto->cantidad;
          $costototal=$costo*$cantidad;
          $tpv->cantidad=$objeto->cantidad;
          $tpv->costounitario=$costo;
          $tpv->costototal=$costototal;
          $tpv->idsucursal=$objeto->idsucursal;
          $tpv->idespecialista=$objeto->idespecialista;
          $tpv->nombrepaquete=$objeto->nombrepaquete;
          $tpv->estatus=1;
          $horainicial=explode('_',$objeto->hora);
          $tpv->horainicial=$horainicial[0];
		  $intervalo=$objeto->intervaloservicio;
		  $horainicial=strtotime($horainicial[0]);
		   $nueva_hora = date('H:i', strtotime('+'.$intervalo.' minutes', $horainicial));
          $tpv->horafinal=$nueva_hora;


          if ($objeto->idtemporalcarrito==0) {
          	# code...
          
          $tpv->AgregarElementoTpv();

      }else{

      	$tpv->idtemporalcarrito=$objeto->idtemporalcarrito;
      	$tpv->ActualizarElementoTpv();
      }

$coincide=0;
$coincideintervalo=0;
$disponible=0;
		 $objeto->idtemporalcarrito=$tpv->idtemporalcarrito;
     if ($objeto->servicio==1) {
       # code...
     
     $paquetes->idpaquete=$objeto->idpaquete;
     $obtenerpaquete=$paquetes->ObtenerPaquete2();
     $intervalopaquete=$objeto->intervaloservicio;
     $obtenertiempos=$tiempo->ObtenerTiempos();
     $arraytiemposdispo=array();
      
     for ($i=0; $i <count($obtenertiempos) ; $i++) { 
        
      $tiempointervalo=$obtenertiempos[$i]->valor;

      $citas->idespecialista= $tpv->idespecialista;
      $citas->fecha=$tpv->fecha;
      $citas->horainicial=$tpv->horainicial;
      $horai=$citas->horainicial;

      $nuevaHora = date('H:i', strtotime($horai. ' +'.$tiempointervalo.' minutes'));
      
      $citas->horafinal=$nuevaHora;

      $verificar=$citas->VerificarFechaHorarioEspecialista2();

      
        if (count($verificar)==0) {

            if ($tiempointervalo==$intervalopaquete) {
                  $coincide=1;

                  $coincideintervalo=1;
                }
          
          $disponible=1;

          // $objeto=array('tiempo'=>$tiempointervalo,'disponible'=> $disponible,'coincide'=>$coincide);

           $obtenertiempos[$i]->disponible=$disponible;
           $obtenertiempos[$i]->coincide=$coincide;
          array_push($arraytiemposdispo, $obtenertiempos[$i]);


        }
         

       



     }

   }


          $db->commit();

    $respuesta['intervalopaquete']=$intervalopaquete;
		$respuesta['respuesta']=1;
		$respuesta['idtemporalcarrito']=$tpv->idtemporalcarrito;
    $respuesta['tiempodisponible']=$arraytiemposdispo;
    $respuesta['coincideintervalo']=$coincideintervalo;
		echo json_encode($respuesta);
	
	} catch (Exception $e) {
				
			$db->rollback();
		echo $e;

	}	





 ?>