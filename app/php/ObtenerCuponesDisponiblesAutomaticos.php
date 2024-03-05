<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Cupones.php");
require_once("clases/class.Funciones.php");
/*require_once("clases/class.MovimientoBitacora.php");
*//*require_once("clases/class.Sms.php");
require_once("clases/class.phpmailer.php");
require_once("clases/emails/class.Emails.php");*/

try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$lo = new Cupones();
	$f=new Funciones();

	//Enviamos la conexion a la clase
	$lo->db = $db;


	$idCliente=$_POST['idusuario'];
	$idsucursal=$_POST['idsucursales'];
	$lo->idsucursales=$idsucursal;



	$cupones =$lo->ObtenerCuponesAutomaticos();
	//var_dump($cupones);

	$fechaactual=date('Y-m-d');

	$cuponesvalidos=array();
	for ($i=0; $i <count($cupones) ; $i++) { 

			$fechainicial=date('Y-m-d',strtotime($cupones[$i]->fechainicial));
			$fechafinal=date('Y-m-d',strtotime($cupones[$i]->fechafinal));
		
		if ($fechaactual>=$fechainicial && $fechaactual<=$fechafinal) {

				$horainicial=date('H:i',strtotime($cupones[$i]->horainicial));
				$horafinal=date('H:i',strtotime($cupones[$i]->horafinal));

				$horaactual=date('H:i');

				if ($horaactual>=$horainicial && $horaactual<=$horafinal) {
								
					$agregar=1;


					}else{

						$agregar=0;
					}


					if ($agregar==1) {

							$lo->idcupon=$cupones[$i]->idcupon;
							$lo->codigocupon=$cupones[$i]->codigocupon;
							$obtenerusodeveces=$lo->ObtenerUsoCupon();
							

						if ($cupones[$i]->lusototal==0) {

							$agregar=1;
							
						}else{


						if ($obtenerusodeveces<$cupones[$i]->lusototal) {

							$agregar=1;

						}else{

							$agregar=0;
						}

					}

				}

				//echo "agregar".$agregar;die();
				if ($agregar==1) {
					if ($cupones[$i]->lusosucursal==0) {
						$agregar=1;
					}else{

						$obtenerusodevecessursal=$lo->ObtenerUsoCuponSucursal($cupones[$i]->lusosucursal);

							if ($obtenerusodevecessursal==1) {
							$agregar=1;

						
							}else{


								$agregar=0;

							}

					}

				}
				//echo "agregar2".$agregar;die();

				if ($agregar==1) {

							
							if ($cupones[$i]->lusodia==0) {
								$agregar=1;
							}else{

								$fechaactual=date('Y-m-d');
								$obtenernumerovecesdia=$lo->ObtenerUsoCuponDia($fechaactual);
							
								if ($obtenernumerovecesdia<$cupones[$i]->lusodia) {

									$agregar=1;

								}else{

									$agregar=0;


								}

							}
								
						}

				//echo "agregar3".$agregar;die();

								if ($agregar==1) {

									if ($cupones[$i]->lusocliente==0) {
										$agregar=1;
									
									}else{

										$obtenernumerovecescliente=$lo->ObtenerUsoCliente($idCliente);
						

										if ($obtenernumerovecescliente<$cupones[$i]->lusocliente) {
											$agregar=1;
										}else{

											$agregar=0;
										}
									}

						

							}

								//	echo "agregar4".$agregar;die();

							if ($agregar==1) {
							if ($cupones[$i]->tsucursales==0) {

								$obtenersucursales=$lo->ObtenerCuponSucursalesCliente($idsucursal);	

										if (count($obtenersucursales)>0) {
												$agregar=1;
											}else{

												$agregar=0;
											}	
								}

							}

							if ($agregar==1) {
							if ($cupones[$i]->tclientes==1) {
									$agregar=1;

								}else{


								$verificardisponibilidadcuponcliente=$lo->VerificarDisponibilidadCuponCliente($idCliente);	

									if($verificardisponibilidadcuponcliente==1) {
										$agregar=1;
									}else{

										$agregar=0;
									}

								}
							}


					if ($agregar==1) {
									# code...
								//echo 'entro';
								if ($cupones[$i]->secuenciaventa!='') {

						if ($cupones[0]->tsucursales==1) {
							$obtenersucursales=$lo->ObtenerSucursales();
						}else{

							$obtenersucursales=$lo->ObtenerSucursalescupon();
						}
						$lo->idsucursales=$obtenersucursales[0]->sucursales;



				$totalventascliente=$lo->ventasrealizadasporclienteperiodo($idCliente,$fechainicial,$fechafinal);

					$totalventas=$totalventascliente[0]->totalventas;
				//	var_dump($totalventascliente);die();

								$arraysecuencia=explode(',', $cupones[$i]->secuenciaventa);
								$totalventas=$totalventas+1;


								$clave = array_search($totalventas, $arraysecuencia); // 

							
								//$agregar=0;
								if ($clave>=0) {
									$agregar=1;
								}
								if ($clave===false) {
									$agregar=0;
								}
								

							}
						}



										//echo "agregar5".$agregar;

						/*if ($agregar==1) {
								
						}*/



						if ($agregar==1) {

							$cupones[$i]->fechafinalformato=date('d/m/Y',strtotime($cupones[$i]->fechafinal));

							$obtenerpaquetes=array();
							$obtenersucursales=array();

							if ($cupones[$i]->tpaquetes==0) {

								$obtenerpaquetes=$lo->ObtenerCuponPaquetes();

								}
						
							if ($cupones[$i]->tsucursales==0) {

								$obtenersucursales=$lo->ObtenerCuponSucursales();		
								}

						$cupones[$i]->paquetes=$obtenerpaquetes;
						$cupones[$i]->sucursales=$obtenersucursales;

						array_push($cuponesvalidos, $cupones[$i]);



						}
						
					}



		

			

		}

		
	//}

	//var_dump($cupones);


	$respuesta['respuesta']=1;
	$respuesta['cupones']=$cuponesvalidos;
	
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