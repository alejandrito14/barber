<?php

/*======================= INICIA VALIDACIÓN DE SESIÓN =========================*/

require_once("../../../clases/class.Sesion.php");
//creamos nuestra sesion.
$se = new Sesion();

if(!isset($_SESSION['se_SAS']))
{
	/*header("Location: ../../login.php"); */ echo "login";

	exit;
}


$tipousaurio = $_SESSION['se_sas_Tipo'];  //variables de sesion
$lista_empresas = $_SESSION['se_liempresas']; //variables de sesion

//validaciones para todo el sistema


/*======================= TERMINA VALIDACIÓN DE SESIÓN =========================*/


require_once ("../../../clases/dompdf/autoload.inc.php");
//Importamos nuestras clases
require_once("../../../clases/conexcion.php");
require_once("../../../clases/class.Reportes.php");
require_once("../../../clases/class.Funciones.php");
require_once("../../../clases/class.Botones.php");


require_once("../../../clases/class.Pagos.php");
require_once("../../../clases/class.Usuarios.php");
require_once("../../../clases/class.Servicios.php");
require_once("../../../clases/class.Fechas.php");
require_once("../../../clases/class.Notapago.php");
$arraynotamontotipo=array();
$arrayaplicacion=array();

 

//Se crean los objetos de clase
$db = new MySQL();
$reporte = new Reportes();
$f = new Funciones();
$bt = new Botones_permisos();
$pagos=new Pagos();
$pagos->db=$db;
$usuarios=new Usuarios();
$usuarios->db=$db;
$fechas=new Fechas();
$nota=new Notapago();
$nota->db=$db;
$estatuspago=array('pendiente','proceso','aceptado','rechazado','reembolso','sin reembolso');
$estatusaceptado=array('NO ACEPTADO','ACEPTADO');
$estatusapagado=array('NO PAGADO','PAGADO','PENDIENTE POR VALIDAR');
//Recibo parametros del filtro
	$idservicio=$_GET['idservicio'];
	$pantalla=$_GET['pantalla'];

	$idmanejocaja=$_GET['idmanejocaja'];
	$sqlfechapago="";

	$sqlmanejocaja="SELECT manejocaja.*,CONCAT(usuarios.nombre,' ',usuarios.paterno,' ',usuarios.materno) as usuario  FROM manejocaja
	left join usuarios on manejocaja.idusuario=usuarios.idusuarios
	 WHERE idmanejocaja='$idmanejocaja'";

		$resp1=$db->consulta($sqlmanejocaja);
		$cont1 = $db->num_rows($resp1);


		$arraymanejo=array();
		$contador1=0;
		if ($cont1>0) {

			while ($objeto1=$db->fetch_object($resp1)) {

				$arraymanejo[$contador1]=$objeto1;
				$contador1++;
			} 
		}
		
		$fechainicio=$arraymanejo[0]->fechainicio;
$fechafin=$arraymanejo[0]->fechafin;
	$sql="
			SELECT
			notapago.idnotapago,
			notapago.total,
			notapago.subtotal,
			notapago.montomonedero,
			notapago.estatus,
			notapago.tipopago,
			notapago.idtipopago,
			metodopago.registro,
			notapago.tpv


			FROM
			notapago
			
		
			JOIN manejocajanota

			ON notapago.idnotapago = manejocajanota.idnotapago 
			
			LEFT JOIN (SELECT COUNT(*) as registro,notapago_notapagometodopago.idnotapago 
			FROM notapago_notapagometodopago GROUP BY notapago_notapagometodopago.idnotapago ) AS 
			metodopago on metodopago.idnotapago=notapago.idnotapago 



			WHERE idmanejocaja='$idmanejocaja' AND notapago.estatus=1



	
		
		";

				/*UNION 
			
			SELECT
			notapago.idnotapago,
			notapago.total,
			notapago.subtotal,
			notapago.montomonedero,
			notapago.estatus,
			notapago.tipopago,
			notapago.idtipopago,
			metodopago.registro,
			notapago.tpv

			FROM
			notapago
			LEFT JOIN manejocajanota

			ON notapago.idnotapago = manejocajanota.idnotapago 
				LEFT JOIN (SELECT COUNT(*) as registro,notapago_notapagometodopago.idnotapago 
			FROM notapago_notapagometodopago GROUP BY notapago_notapagometodopago.idnotapago ) AS 
			metodopago on metodopago.idnotapago=notapago.idnotapago 
		WHERE notapago.fecha>='$fechainicio' and notapago.fecha<='$fechafin' and manejocajanota.idmanejocaja IS NULL AND tpv=0
*/
		
		
		$resp=$db->consulta($sql);
		$cont = $db->num_rows($resp);


		$array=array();
		$contador=0;
		if ($cont>0) {

			while ($objeto=$db->fetch_object($resp)) {

				
				if ($objeto->tpv==1) {
					
				

				if ($objeto->registro!=null) {
					

				$sql2="SELECT
				notapagometodopago.idtipopago,
				notapagometodopago.tipopago,
				notapagometodopago.montocampo,
				notapago_notapagometodopago.idnotapagometodopago,
				notapago_notapagometodopago.idnotapago
				FROM
				notapago_notapagometodopago
				JOIN notapagometodopago
				ON notapago_notapagometodopago.idnotapagometodopago = notapagometodopago.idnotapagometodopago WHERE idnotapago='$objeto->idnotapago'";

				$resp1=$db->consulta($sql2);
				$cont1 = $db->num_rows($resp1);

						$array=array();
					$contador=0;
					if ($cont1>0) {

						while ($objeto2=$db->fetch_object($resp1)) {
							$tipopago=$objeto2->tipopago;


							$monto=$objeto2->montocampo;

							$arraynotamontotipo= AgregaraMetodo($tipopago,$monto,$arraynotamontotipo);

						}

					}


				}else{

					$monto=$objeto->total;
					$tipopago=$objeto->tipopago;
					$arraynotamontotipo= AgregaraMetodo($tipopago,$monto,$arraynotamontotipo);


				}


				if ($objeto->montomonedero!=null && $objeto->montomonedero>0) {

					$monto=$objeto->montomonedero;
					$tipopago='Monedero';
					$arraynotamontotipo= AgregaraMetodo($tipopago,$monto,$arraynotamontotipo);
				}
			}else{

					//array_push($arrayaplicacion,$objeto);
					$monto=$objeto->total;
					$tipopago=$objeto->tipopago;

						$arrayaplicacion=AgregaraMetodoApp($tipopago,$monto,$arrayaplicacion);
				
				
				} 
			}
		
		}
		

		
	function agruparPorTipoPago($array) {
    $agrupado = array();

    foreach ($array as $elemento) {
        $tipopago = trim($elemento['tipopago']);
        $monto = $elemento['monto'];

        if (!isset($agrupado[$tipopago])) {
            $agrupado[$tipopago] = array(
                'tipopago' => $tipopago,
                'total' => 0 // Inicializamos el total a 0
            );
        }

        // Sumamos el monto al total correspondiente al tipo de pago
        $agrupado[$tipopago]['total'] += $monto;
    }

    // Convertimos el array asociativo a un array indexado
    return array_values($agrupado);
}

	





	function AgregaraMetodo($tipopago,$monto,$arraynotamontotipo)
	{

		if (count($arraynotamontotipo)==0) {
			
			$objetotipo=array('tipopago'=>$tipopago,'monto'=>$monto);


			array_push($arraynotamontotipo, $objetotipo);


			
		}else{
			
			$encontrado=0;
			for ($i=0; $i < count($arraynotamontotipo); $i++) { 
				
				//echo $tipopago.'=='.$arraynotamontotipo[$i]['tipopago'];

				if ($tipopago==$arraynotamontotipo[$i]['tipopago']) {
					$montoarray=$arraynotamontotipo[$i]['monto'];

					$montoarraysuma=$arraynotamontotipo[$i]['monto']+$monto;

					$arraynotamontotipo[$i]['monto']=$montoarraysuma;
					$encontrado=1;
					break;

				}
			}


			if ($encontrado==0) {
				$objetotipo=array('tipopago'=>$tipopago,'monto'=>$monto);
				
				array_push($arraynotamontotipo, $objetotipo);
			}

		}
		//print_r($arraynotamontotipo);
		return $arraynotamontotipo;
	}


	function AgregaraMetodoApp($tipopago,$monto,$arrayaplicacion)
	{

		if (count($arrayaplicacion)==0) {
			
			$objetotipo=array('tipopago'=>$tipopago,'monto'=>$monto);


			array_push($arrayaplicacion, $objetotipo);


			
		}else{
			
			$encontrado=0;
			for ($i=0; $i < count($arrayaplicacion); $i++) { 
				
				//echo $tipopago.'=='.$arraynotamontotipo[$i]['tipopago'];

				if ($tipopago==$arrayaplicacion[$i]['tipopago']) {
					$montoarray=$arrayaplicacion[$i]['monto'];

					$montoarraysuma=$arrayaplicacion[$i]['monto']+$monto;

					$arrayaplicacion[$i]['monto']=$montoarraysuma;
					$encontrado=1;
					break;

				}
			}


			if ($encontrado==0) {
				$objetotipo=array('tipopago'=>$tipopago,'monto'=>$monto);
				
				array_push($arrayaplicacion, $objetotipo);
			}

		}
		return $arrayaplicacion;
	}


 
if($pantalla==0) {
	# code...

//id alumno/alumno/tutor/celular/tipo de servicio/id servicio/servicio/aceptado/pagado/monto
$filename = "Rep_manejocaja_".$idmanejocaja.".xls";
header("Content-Type: application/vnd.ms-excel charset=iso-8859-1");
header('Content-Disposition: attachment; filename="'.$filename.'"');

}

?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 
 <style>
 	.wrap2 { 
 
  height:50px;
  overflow: auto;
  width:100px;
}
 </style>

 		<table class="table  table table-striped table-bordered vertabla"> 
 			<tr>
				<td style="width: 50%">ID CIERRE</td>
            	<td style="width: 50%;"><?php echo $arraymanejo[0]->idmanejocaja; ?></td>
        	</tr>

        	<tr>
				<td style="width: 50%">USUARIO</td>
            	<td style="width: 50%;"><?php echo $arraymanejo[0]->usuario; ?></td>
        	</tr>  
			<tr>
				<td style="width: 50%">FECHA APERTURA</td>
            	<td style="width: 50%;"><?php echo date('d/m/Y H:i:s',strtotime($arraymanejo[0]->fechainicio)); ?></td>
        	</tr> 

        	<tr>
         	   <td style="width: 50%">MONTO INICIAL:</td>
				<td style="width: 50%;">$<?php echo number_format($arraymanejo[0]->montoinicial,2,'.',','); ?></td>
        	</tr> 
			<tr>
         	   <td style="width: 50%">FECHA CIERRE:</td>
				<td style="width: 50%;"><?php echo date('d/m/Y H:i:s',strtotime($arraymanejo[0]->fechafin)); ?></td>
        	</tr>
	       


 		</table>

 		<table class="table  table table-striped table-bordered  vertabla" border="1" style="">
 			<thead>
			  <tr bgcolor="#3B3B3B" style="color: #FFFFFF; text-align: left;">
			    <th style="width: 50%;">TIPO DE PAGO</th>
			    <th style="width: 50%;">MONTO</th>
			   
			  </tr>
		  </thead>
		  <tbody>
		  	
		 	<?php 

		 $array=agruparPorTipoPago($arraynotamontotipo);
		  for ($i=0; $i <count($array) ; $i++) {
		  			
		  		 ?>
		  		<tr>
		  			<td id=""><?php echo $array[$i]['tipopago']; ?> </td>	
					<td id="">$<?php echo number_format($array[$i]['total'],2,'.',',');?> </td>	
						
		  		</tr>
		

		  <?php } ?>
		 	
		  </tbody>

		</table>

		<?php if (count($arrayaplicacion)): ?>
			
		<H4>PAGOS EN LA APLICACIÓN</H4>

		<table class="table  table table-striped table-bordered  vertabla" border="1" style="">
 			<thead>
			  <tr bgcolor="#3B3B3B" style="color: #FFFFFF; text-align: left;">
			    <th style="width: 50%;">TIPO DE PAGO</th>
			    <th style="width: 50%;">MONTO</th>
			   
			  </tr>
		  </thead>
		  <tbody>
		  	
		 	<?php 

		 $array=agruparPorTipoPago($arrayaplicacion);

		  for ($i=0; $i <count($array) ; $i++) {
		  			
		  		 ?>
		  		<tr>
		  			<td id=""><?php echo $array[$i]['tipopago']; ?> </td>	
					<td id="">$<?php echo number_format($array[$i]['total'],2,'.',',');?> </td>	
						
		  		</tr>
		

		  <?php } ?>
		 	
		  </tbody>

		</table>


		<?php endif ?>

<?php 
use Dompdf\Dompdf;
if ($pantalla==2){


$dompdf = new DOMPDF();
$dompdf->load_html(ob_get_clean());
$dompdf->render();
$pdf = $dompdf->output();
$filename = "Rep_manejocaja_".$idmanejocaja.".xls";
file_put_contents($filename, $pdf);
$dompdf->stream($filename);

	} 
?>
