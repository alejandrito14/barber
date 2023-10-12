<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Cupones.php");
require_once("clases/class.Carrito.php");

require_once("clases/class.Funciones.php");

/*require_once("clases/class.Sms.php");
require_once("clases/class.phpmailer.php");
require_once("clases/emails/class.Emails.php");*/

try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$lo = new Cupones();
	$f=new Funciones();
	$car=new Carrito();
	$car->db=$db;

	//Enviamos la conexion a la clase
	$lo->db = $db;


	$idCliente=$_POST['iduser'];
	$idsucursal=$_POST['idsucursal'];
	$idcupon=$_POST['idcupon'];
	$codigocupon=$_POST['codigocupon'];
	$car->idusuarios=$idCliente;
	$carrito=$car->ObtenerCarrito();

	$lo->idcupon=$idcupon;
	$lo->codigocupon=$codigocupon;
	$lo->idsucursales=$idsucursal;
	$cupones =$lo->ObtenerCuponCodigo();

	$fechaactual=date('Y-m-d');
	$mensaje=array();
	$cuponesvalidos=array();
	$agregar=0;


	if (count($cupones)>0) {
		# code...
	
			$fechainicial=date('Y-m-d',strtotime($cupones[0]->fechainicial));
			$fechafinal=date('Y-m-d',strtotime($cupones[0]->fechafinal));
		
		if ($fechaactual>=$fechainicial && $fechaactual<=$fechafinal) {

				$horainicial=date('H:i',strtotime($cupones[0]->horainicial));
				$horafinal=date('H:i',strtotime($cupones[0]->horafinal));

				$horaactual=date('H:i');

				if ($horaactual>=$horainicial && $horaactual<=$horafinal) {
								
					$agregar=1;

					}else{
					$m='Cupón no válido, fuera de horario';
					array_push($mensaje, $m);
						$agregar=0;
					}

					if ($agregar==1) {

							$lo->idcupon=$cupones[0]->idcupon;
							$lo->codigocupon=$cupones[0]->codigocupon;
							$obtenerusodeveces=$lo->ObtenerUsoCupon();
							

						if ($cupones[0]->lusototal==0) {

							$agregar=1;
							
						}else{


						if ($obtenerusodeveces<$cupones[0]->lusototal) {

							$agregar=1;

						}else{
							$m='Cupón no válido, limité de uso';
							array_push($mensaje, $m);

							$agregar=0;
						}

					}

				}

				if ($agregar==1) {
					if ($cupones[0]->lusosucursal==0) {
						$agregar=1;
					}else{

						$obtenerusodevecessursal=$lo->ObtenerUsoCuponSucursal($cupones[0]->lusosucursal);

							if ($obtenerusodevecessursal==1) {
							$agregar=1;

						
							}else{

							$m='Cupón no válido, limité de uso';
												array_push($mensaje, $m);

								$agregar=0;

							}

					}

				}

				if ($agregar==1) {

							
							if ($cupones[0]->lusodia==0) {
								$agregar=1;
							}else{

								$fechaactual=date('Y-m-d');
								$obtenernumerovecesdia=$lo->ObtenerUsoCuponDia($fechaactual);
							
								if ($obtenernumerovecesdia<$cupones[0]->lusodia) {

									$agregar=1;

								}else{

									$agregar=0;
								$m='Cupón no válido, limité de uso';
													array_push($mensaje, $m);


								}

							}
								
						}


								if ($agregar==1) {

									if ($cupones[0]->lusocliente==0) {
										$agregar=1;
									
									}else{

										$obtenernumerovecescliente=$lo->ObtenerUsoCliente($idCliente);
						

										if ($obtenernumerovecescliente<$cupones[0]->lusocliente) {
											$agregar=1;
										}else{

											$agregar=0;
									$m='Cupón no válido, excedió el uso para el cliente en sesión';
									array_push($mensaje, $m);

										}
									}

						

							}



							
							if ($agregar==1) {
							if ($cupones[0]->tsucursales==0) {

								$obtenersucursales=$lo->ObtenerCuponSucursalesCliente($idsucursal);	

										if (count($obtenersucursales)>0) {
												$agregar=1;
											}else{

												$agregar=0;

									$m='Cupón no válido, no disponible en esta sucursal';
									array_push($mensaje, $m);

											}	
								}


							}

						
							if ($agregar==1) {
							if ($cupones[0]->tclientes==1) {
									$agregar=1;

								}else{


								$verificardisponibilidadcuponcliente=$lo->VerificarDisponibilidadCuponCliente($idCliente);	

									if($verificardisponibilidadcuponcliente==1) {
										$agregar=1;
									}else{

										$agregar=0;
								$m='Cupón no válido, no disponible para el cliente';

								array_push($mensaje, $m);

									}

								}
							}




						

						if ($agregar==1) {

							$cupones[0]->fechafinalformato=date('d/m/Y',strtotime($cupones[0]->fechafinal));

							$obtenerpaquetes=array();
							$obtenersucursales=array();

							if ($cupones[0]->tpaquetes==0) {

								$obtenerpaquetes=$lo->ObtenerCuponPaquetes();
 
								}
						
							if ($cupones[0]->tsucursales==0) {

								$obtenersucursales=$lo->ObtenerCuponSucursales();		
								}

						$cupones[0]->paquetes=$obtenerpaquetes;
						$cupones[0]->sucursales=$obtenersucursales;




						}
						
					}else{




						$m='Cupón no válido, fuera de rango de fechas';
									array_push($mensaje, $m);
					}

				}else{

					$m='Cupón no válido';
				array_push($mensaje, $m);

				}

				$encontrado=0;
				$montopaquetesencontrados=0;
				$total=0;
				$porcentaje=0;
				$monto=0;
				$arrayencontrados=array();
				$montoadescontar=0;
			if ($agregar==1) {
				
				if (count($obtenerpaquetes)>0) {
					# code...
				$encontrado=0;
				for ($i=0; $i < count($carrito); $i++) { 
			
							$idpaquete=$carrito[$i]->{'idpaquete'};
							$cant=$carrito[$i]->{'cant'}; //cantidad de paquete
							$opciones=$carrito[$i]->{'opciones'};//array
							$textoopciones=$carrito[$i]->{'texto'};
							$nombre=$carrito[$i]->{'nombrepaquete'};
							$precio=$carrito[$i]->{'costototal'};
							$cantidad=$carrito[$i]->{'cantidad'}; //
							$considerar=$carrito[$i]->{'considerar'}; //
							$promocion=$carrito[$i]->{'promocion'}; //promocion de paquete
							$porfechas=$carrito[$i]->{'porfechas'}; //cantidad de paquete
							$repetitivo=$carrito[$i]->{'repetitivo'}; //cantidad de paquete
							$directo=$carrito[$i]->{'directo'}; //cantidad de paquete
							$descripcion=$carrito[$i]->{'descripcion'}; //
							$precioriginal=str_replace("$",'',$carrito[$i]->{'precioriginal'});
							$comentarios=$carrito[$i]->{'comentariopaquete'};
								$carrito[$i]->{'montoadescontar'}=0;
							if ($promocion==0) {
								# code...
							
							$buscar=$lo->BuscarEnArray($obtenerpaquetes,$idpaquete);
								$carrito[$i]->{'encontrado'}=0;

							if ($buscar==1) {
								$encontrado=1;
								$carrito[$i]->{'encontrado'}=1;
							$montopaquetesencontrados=$montopaquetesencontrados+$precio;

							$paqueteencontrado=array('idpaquete'=>$idpaquete,'nombre'=>$nombre);
							array_push($arrayencontrados,$paqueteencontrado);

							}

							$total=$total+$precio;

						}else{

						if ($promocion==1 && $cupones[0]->aplicarsobrepromo==1) {
								


									$total=$total+$precio;	
							}


						}

						


					}



					



				}else{



					for ($i=0; $i < count($carrito); $i++) { 
			
							$idpaquete=$carrito[$i]->{'idpaquete'};
							$cant=$carrito[$i]->{'cant'}; //cantidad de paquete
							$opciones=$carrito[$i]->{'opciones'};//array
							$textoopciones=$carrito[$i]->{'texto'};
							$nombre=$carrito[$i]->{'nombrepaquete'};
							$precio=$carrito[$i]->{'costototal'};
							$cantidad=$carrito[$i]->{'cantidad'}; //
							$considerar=$carrito[$i]->{'considerar'}; //
							$promocion=$carrito[$i]->{'promocion'}; //cantidad de paquete
							$porfechas=$carrito[$i]->{'porfechas'}; //cantidad de paquete
							$repetitivo=$carrito[$i]->{'repetitivo'}; //cantidad de paquete
							$directo=$carrito[$i]->{'directo'}; //cantidad de paquete
							$descripcion=$carrito[$i]->{'descripcion'}; //
							$precioriginal=str_replace("$",'',$carrito[$i]->{'costototal'});
							$comentarios=$carrito[$i]->{'comentariopaquete'};
							$carrito[$i]->{'encontrado'}=0;
							$carrito[$i]->{'montoadescontar'}=0;
							if ($promocion==0) {

								$total=$total+$precio;
								$carrito[$i]->{'encontrado'}=1;

									}else{

							if ($promocion==1 && $cupones[0]->aplicarsobrepromo==1) {
						
								$carrito[$i]->{'encontrado'}=1;


									$total=$total+$precio;	
							}
						}
							

					}

					$encontrado=1;
				}


					

				
			}



			if ($agregar==1) {
				

				if ($cupones[0]->montocompra==0) {
					$agregar=1;
				}else{


					if ($total>$cupones[0]->montocompra) {
						$agregar=1;
					}else{

						$agregar=0;
						$m='Cupón no válido, el mínimo de compra es $'.$cupones[0]->montocompra." ";
							array_push($mensaje, $m);
					}
				}
			}


			if ($agregar==1) {
				if ($cupones[0]->cantidadcompra==0) {
					$agregar=1;
				}else{

					if (count($carrito)<$cupones[0]->cantidadcompra) {
						$agregar=0;
						$m='Cupón no válido,la cantidad mínima de paquetes es '.$cupones[0]->cantidadcompra." ";
							array_push($mensaje, $m);
					}else{

						$agregar=1;
					}

				}
			}

			$comprascliente=0;

			if ($agregar==1) {
				
				if ($cupones[0]->secuenciaventa=='') {
					$agregar=1;
				}else{

					$pos = strpos($cupones[0]->secuenciaventa,',');
					$validaventa=0;
					if ($pos!==false || $cupones[0]->secuenciaventa!='') {
						$arrayventa=explode(',',$cupones[0]->secuenciaventa);

						if ($cupones[0]->tsucursales==0) {
							$obtenersucursales=$lo->ObtenerSucursales();
						}else{

							$obtenersucursales=$lo->ObtenerSucursalescupon();
						}
						$lo->idsucursales=$obtenersucursales[0]->sucursales;

						$totalventas=$lo->ventasrealizadasporclienteperiodo($idCliente,$fechainicial,$fechafinal);

						$comprascliente=$totalventas[0]->totalventas+1;


						for ($i=0; $i <count($arrayventa) ; $i++) { 
							
							if ($arrayventa[$i]==$comprascliente) {
								
								$validaventa=1;
								break;
							}
						}


							if ($validaventa==1) {
								$agregar=1;

							}else{

									$valor=0;
									for ($i=0; $i <count($arrayventa) ; $i++) { 
							
										if ($comprascliente<$arrayventa[$i]) {
											
											$valor=$arrayventa[$i];
											break;
										}
									}

								$agregar=0;

								if ($valor!=0) {

									$m='Cupón no válido, aplicará en tu compra no. '.$valor;
									array_push($mensaje, $m);	
								}else{

									$m='Cupón no válido, no se encontró valor de frecuencia por venta';
									array_push($mensaje, $m);	


								}
								
							}


					}
				}
			}
			 $variabledescuento="";
				if ($encontrado==1) {
					# code...
				
				if ($cupones[0]->tipodescuento == 0) {
							//porcentaje
							$porcentaje=$cupones[0]->descuento;

							if ($montopaquetesencontrados>0) {
								
								$montoadescontar=($montopaquetesencontrados*$porcentaje)/100;
							}else{


								$montoadescontar=($total*$porcentaje)/100;		
							}
							
							$variabledescuento=number_format($porcentaje,0).'%';
						}

						if ($cupones[0]->tipodescuento == 1) {
							
							$montoadescontar=$cupones[0]->descuento;

							if ($montopaquetesencontrados>0) {
								
								if (floatval($montopaquetesencontrados) < floatval($montoadescontar)) {
										$montoadescontar=floatval($montopaquetesencontrados);
									}
								
							}
							$variabledescuento="$";

						}

					}else{

						if (count($obtenerpaquetes)>0) {
							# code...
						
						$agregar=0;
						
						$conta=0;
						for ($i=0; $i < count($obtenerpaquetes); $i++) { 

							$concatenar.=$obtenerpaquetes[$i]->nombrepaquete;
							
										if ($i<$conta) {
											$concatenar.=',';
										}

								$conta++;
									}
						$m='Cupón no válido, solo se puede aplicar a los paquetes en su descripción: '.$concatenar;
						array_push($mensaje, $m);

						}
					}

						

							if ($agregar==1) {
								$m='Cupón válido';
								array_push($mensaje, $m);
							}

			
							$totalcarrito=0;

						for ($i=0; $i < count($carrito); $i++) { 	
									$precio=$carrito[$i]->{'costototal'};
									$totalcarrito=$totalcarrito+$precio;
							}

							$elementos=0;
							$uno=0;
						for ($i=0; $i < count($carrito); $i++) { 	

								if ($carrito[$i]->{'encontrado'}==1) {
									$elementos++;
									$uno=1;
								}
								
							}

				/*if ($agregar==1) {
						if ($uno==1) {
								
							
						$division=$montoadescontar/$elementos;
*/
					

					/*	for ($i=0; $i < count($carrito); $i++) { 	

							if ($carrito[$i]->{'encontrado'}==1) {
									

							$carrito[$i]->{'descuento'}=$division;
							
								}else{

									$carrito[$i]->{'descuento'}=0;
								}
								
							}*/

				/*		}

					}
*/

					

	if ($agregar==1) {



						if (count($arrayencontrados)) {
									for ($i=0; $i < count($arrayencontrados); $i++) { 


											for ($x=0; $x < count($carrito); $x++) { 

													if ($arrayencontrados[$i]['idpaquete']==$carrito[$x]->{'idpaquete'}) {

																if ($cupones[0]->tipodescuento == 0) {
															$porcentaje=$cupones[0]->descuento;
															$total=$carrito[$x]->{'costototal'};
														
																$montoadescontar=($total*$porcentaje)/100;		
															
														}

															if ($cupones[0]->tipodescuento == 1) {
																
																$montoadescontar=$cupones[0]->descuento;
															}

											$carrito[$x]->{'montoadescontar'}=$montoadescontar;
												$montopaquetes=$montopaquetes+$montoadescontar;

												$car->idcupon=$cupones[0]->idcupon;
												$car->montocupon=$montoadescontar;
												$car->codigocupon=$cupones[0]->codigocupon;
												$car->idcarrito=$carrito[$x]->{'idcarrito'};


													}

											}
											
									}
						}else{

									for ($x=0; $x < count($carrito); $x++) { 

																if ($cupones[0]->tipodescuento == 0) {
															$porcentaje=$cupones[0]->descuento;
															$total=$carrito[$x]->{'costototal'};
														
																$montoadescontar=($total*$porcentaje)/100;		
															
														}

															if ($cupones[0]->tipodescuento == 1) {
																
																$montoadescontar=$cupones[0]->descuento;
															}

											$carrito[$x]->{'montoadescontar'}=$montoadescontar;
														
											$montopaquetes=$montopaquetes+$montoadescontar;

												$car->idcupon=$cupones[0]->idcupon;
												$car->montocupon=$montoadescontar;
												$car->codigocupon=$cupones[0]->codigocupon;
												$car->idcarrito=$carrito[$x]->{'idcarrito'};
													

											}


						}

					}
		


						$total=$totalcarrito-abs($montopaquetes);

		$nuevostotales=array('montopaquetes'=>$montopaquetes,'nuevototal'=>$total,'ventas'=>($comprascliente-1),'totalcarrito'=>$totalcarrito,'tipodescuento'=>$cupones[0]->tipodescuento,'variabledescuento'=>$variabledescuento);

		
	//}

	//var_dump($cupones);


	$respuesta['respuesta']=$agregar;
	$respuesta['cupones']=$cupones;
	$respuesta['mensaje']=$mensaje;
	$respuesta['nuevototal']=$nuevostotales;
	$respuesta['encontrados']=$arrayencontrados;
	$respuesta['carrito']=$carrito;


	
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