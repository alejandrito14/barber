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

//Inlcuimos las clases a utilizar
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Notapago.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Pagos.php");
require_once("../../clases/class.Pais.php");
require_once("../../clases/class.Estado.php");
require_once("../../clases/class.Municipio.php");
require_once("../../clases/class.Usocfdi.php");
require_once("../../clases/class.Paquetes.php");

require_once("../../clases/class.Fechas.php");
require_once("../../clases/class.Temporalcarrito.php");

try
{

    //Declaramos objetos de clases
    $db = new MySQL();
    $lo = new Notapago();
    $f  = new Funciones();
    $pagos = new Pagos();
    $pagos->db=$db;

    $pais = new Paises();
    $pais->db=$db;
    $paquetes=new Paquetes();
    $paquetes->db=$db;
    $fechas=new Fechas();
    $temporalcarrito=new Temporalcarrito();
    $temporalcarrito->db=$db;


    $estado=new Estado();
    $estado->db=$db;
    $municipio=new Municipio();
    $municipio->db=$db;
     $codigo=$se->obtenerSesion('codservicio');
    $usocfdi=new Usocfdi();
    $usocfdi->db=$db;
    //Enviamos la conexion a la clase
    $lo->db    = $db;
   
    $idnotapago = $_POST['idnotapago'];
    $id_user=$_POST['id_user'];
    //Recibimos parametros
    $lo->idnotapago=$idnotapago;
    $lo->idusuario=$id_user;
    $temporalcarrito->idnota=$idnotapago;

    $resultado=$lo->Obtenernota();
    $descuentos=array();
    $descuentosmembresia=array();
    if ($resultado[0]->idpagostripe!=0) {

    	/*$idpagostripe=$resultado[0]->idpagostripe;
    	$lo->idpagostripe=$idpagostripe;*/
 	     $obtenerpagosstripe=$lo->ObtenerdescripcionNota();


 	  
    }
   $obtenerimagenes=array();
    if ($resultado[0]->confoto==1) {
        
        $obtenerpagosstripe=$lo->ObtenerdescripcionNota();
        $obtenerimagenes=$lo->ObtenerImagenesComprobante();
    }

    if ($resultado[0]->confoto==0 && $resultado[0]->idpagostripe==0 ) {
          $obtenerpagosstripe=$lo->ObtenerdescripcionNota();
         /* $sumatotal=0;
          for ($i=0; $i <count($obtenerpagosstripe) ; $i++) { 
              $sumatotal=$sumatotal+$obtenerpagosstripe[$i]->monto;
          }
*/
    }
    if (count($obtenerpagosstripe)>0) {
        # code...
    
      for ($i=0; $i < count($obtenerpagosstripe); $i++) { 
            $pagos->idpago=$obtenerpagosstripe[$i]->idpago;
          

        }
    }
   

    if (count($obtenerpagosstripe)>0) {
        # code...
    
      for ($i=0; $i < count($obtenerpagosstripe); $i++) { 
        $obtenerpagosstripe[$i]->foto=$codigo.'/'.$obtenerpagosstripe[$i]->foto;
      }
  }


 $subtotalnota=0;
    $subtotalcupon=0;
    for ($i=0; $i < count($obtenerpagosstripe); $i++) { 
       $obtenerpagosstripe[$i]->fechaformato="";

       if ($obtenerpagosstripe[$i]->fecha!='' && $obtenerpagosstripe[$i]->fecha!=null) {
          /*$fechacita=date('Y-m-d',strtotime($obtenerpagosstripe[$i]->fecha));
            
           $obtenerpagosstripe[$i]->fechaformato=$fechas->fecha_texto5($fechacita).' '.$obtenerpagosstripe[$i]->horainicial.'Hrs.';*/


           $horainicial=$obtenerpagosstripe[$i]->horainicial;
           $horafinal=$obtenerpagosstripe[$i]->horafinal;

          $obtenerpagosstripe[$i]->intervaloservicio= $fechas->diferencia($horainicial,$horafinal);


            $fecha=$obtenerpagosstripe[$i]->fecha;
            $diatexto=$fechas->diasSemanaCorto[date('N', strtotime($fecha))];

            $fechaformato=$diatexto.' '.date('d',strtotime($fecha)).' de '.$fechas->mesesEnEspañol[date('F',strtotime($fecha))].' de '.date('Y', strtotime($fecha));

            $obtenerpagosstripe[$i]->fechaformato=$fechaformato;
       }


       $paquetes->idpaquete=$obtenerpagosstripe[$i]->idpaquete;
       $obtenerpaquete=$paquetes->ObtenerPaquete2();
            $obtenerpagosstripe[$i]->precioante=0;

            if ($obtenerpaquete[0]->promocion==1) {
                $obtenerpagosstripe[$i]->precioante=$obtenerpaquete[0]->precioventa;

                }

          $subtotalnota=$subtotalnota+$obtenerpagosstripe[$i]->monto;  
          $subtotalcupon =$subtotalcupon+$obtenerpagosstripe[$i]->montocupon;  
    }
         


    if ($resultado[0]->requierefactura==1) {

        $pais->id_pais=$resultado[0]->pais;
        $obtener=$pais->ObtenerDatosPais();

        $paisfact=$obtener;
       
        $estado->id_estado=$resultado[0]->estado;
        $obteneresta=$estado->ObtenerDatosEstado();

        $estadofact=$obteneresta;

        $municipio->idmunicipio=$resultado[0]->municipio;
        $obtenermuni=$municipio->ObtenerDatosMunicipio();
        $municipiofact=$obtenermuni;
        
        $resultado[0]->pais=$paisfact;
        $resultado[0]->estado= $estadofact;
        $resultado[0]->municipio=$municipiofact;

        $usocfdi->cmetodopago=$resultado[0]->metodopago;
        $usocfdi->cformapago=$resultado[0]->formapago;
        $usocfdi->cusocfdi=$resultado[0]->usocfdi;

        
    }else{

        $resultado[0]->municipio="";
        $resultado[0]->estado="";
        $resultado[0]->pais="";
        $resultado[0]->formapavalor="";
        $resultado[0]->metodopagovalor="";
        $resultado[0]->usocfdivalor="";

    }


    $temporalcarrito->EliminarCarritoTemporal();
    if (count($obtenerpagosstripe)>0) {
        for ($i=0; $i < count($obtenerpagosstripe); $i++) { 
            $temporalcarrito->fecha=$obtenerpagosstripe[$i]->fechacita;
            $temporalcarrito->horainicial=$obtenerpagosstripe[$i]->horainicial;
            $temporalcarrito->horafinal=$obtenerpagosstripe[$i]->horafinal;
            $temporalcarrito->idusuarios=$obtenerpagosstripe[$i]->idusuarios;
            $temporalcarrito->idpaquete=$obtenerpagosstripe[$i]->idpaquete;
            $temporalcarrito->cantidad=$obtenerpagosstripe[$i]->cantidad;
            $temporalcarrito->costounitario=$obtenerpagosstripe[$i]->costounitario;
            $temporalcarrito->costototal=$obtenerpagosstripe[$i]->monto;
            $temporalcarrito->idsucursal=$obtenerpagosstripe[$i]->idsucursal;
            $temporalcarrito->idespecialista=$obtenerpagosstripe[$i]->idespecialista;
            $temporalcarrito->idsucursal=$obtenerpagosstripe[$i]->idsucursal;
            $temporalcarrito->idcita=$obtenerpagosstripe[$i]->idcita;
           
            $temporalcarrito->nombrepaquete=$obtenerpagosstripe[$i]->concepto;
            $temporalcarrito->titulosgrupos='';
            $temporalcarrito->idnota=$idnotapago;
            $temporalcarrito->idnotadescripcion=$obtenerpagosstripe[$i]->idnotapago_descripcion;
            $temporalcarrito->AgregarTemporalCarrito();

        }
    }
    $obtenertemporal=$temporalcarrito->ObtenerTemporalCarrito();



    for ($i=0; $i < count($obtenertemporal); $i++) { 
          $fecha=$obtenertemporal[$i]->fechacita;
            $diatexto=$fechas->diasSemanaCorto[date('N', strtotime($fecha))];

            $fechaformato=$diatexto.' '.date('d',strtotime($fecha)).' de '.$fechas->mesesEnEspañol[date('F',strtotime($fecha))].' de '.date('Y', strtotime($fecha));

            $obtenertemporal[$i]->fechaformato=$fechaformato;

          
            $horainicial=$obtenertemporal[$i]->horainicial;
             $horafinal=$obtenertemporal[$i]->horafinal;
            $intervaloservicio=$fechas->diferencia($horainicial,$horafinal);
            $obtenertemporal[$i]->intervaloservicio=$intervaloservicio;

            $obtenertemporal[$i]->ruta='catalogos/paquetes/imagenespaquete/'.$codigo.'/'.$obtenertemporal[$i]->foto;
    }

    
    $resultado[0]->fechaentrega=date('d/m/Y H:i:s',strtotime($resultado[0]->fechaentrega));
    $respuesta['respuesta'] = $resultado;
    $respuesta['pagos']=$obtenertemporal;
    $respuesta['descuentos']=$descuentos;
    $respuesta['descuentosmembresia']=$descuentosmembresia;
    $respuesta['imagenescomprobante']=$obtenerimagenes;
      $respuesta['subtotalnota']=$subtotalnota;
    $respuesta['subtotalcupon']=$subtotalcupon;

    //Retornamos en formato JSON
    $myJSON = json_encode($respuesta);
    echo $myJSON;

} catch (Exception $e) {
    //$db->rollback();
    //echo "Error. ".$e;

    $array->resultado = "Error: " . $e;
    $array->msg       = "Error al ejecutar el php";
    $array->id        = '0';
    //Retornamos en formato JSON
    $myJSON = json_encode($array);
    echo $myJSON;
}