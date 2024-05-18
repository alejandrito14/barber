<?php 
/**
 * 
 */
class Especialista 
{
	
	public $db;
	public $idsucursal;
	public $idusuarios;

	public $idpaquete;

	public $horainicial;
	public $horafinal;
	public $dia;
	public $fecha;
	public $fechas;

	public function ObtenerEspecialistas()
	{
		$sql = "SELECT 
				usuarios.nombre,
				usuarios.idusuarios,
				usuarios.paterno,
				usuarios.materno,
				usuarios.sexo,
				especialista.idespecialista,
				especialista.idsucursal,
				usuarios.orden,
				usuarios.foto
			FROM especialista
			left JOIN sucursal ON especialista.idsucursal=sucursal.idsucursal
			left join usuarios on especialista.idusuarios=usuarios.idusuarios


			
		 WHERE usuarios.estatus=1 AND especialista.bloqueo=0 and sucursal.idsucursal='$this->idsucursal' ORDER BY usuarios.orden asc ";

		
			$resp = $this->db->consulta($sql);
			$cont = $this->db->num_rows($resp);


			$array=array();
			$contador=0;
			if ($cont>0) {

				while ($objeto=$this->db->fetch_object($resp)) {

					$array[$contador]=$objeto;
					$contador++;
				} 
			}
			return $array;
	}


	public function ObtenerCosto()
	{
			$sql="SELECT *FROM paquetes_especialista
			WHERE idespecialista='$this->idespecialista' AND idpaquete='$this->idpaquete'";
			$resp = $this->db->consulta($sql);
			$cont = $this->db->num_rows($resp);


			$array=array();
			$contador=0;
			if ($cont>0) {

				while ($objeto=$this->db->fetch_object($resp)) {

					$array[$contador]=$objeto;
					$contador++;
				} 
			}
			return $array;
	}


	public function ObtenerHorariosEspecialista()
	{
		$sql="SELECT *FROM horarioespecialista
			WHERE idespecialista='$this->idespecialista'";
			$resp = $this->db->consulta($sql);
			$cont = $this->db->num_rows($resp);


			$array=array();
			$contador=0;
			if ($cont>0) {

				while ($objeto=$this->db->fetch_object($resp)) {

					$array[$contador]=$objeto;
					$contador++;
				} 
			}
			return $array;
	}


	public function BuscarHoraAusente()
	{
		$sql="SELECT *FROM horariosausente
			WHERE fecha='$this->fecha' and '$this->horainicial'<=horafinal AND '$this->horafinal'>=horainicial AND idespecialista='$this->idespecialista'";

			$resp = $this->db->consulta($sql);
			$cont = $this->db->num_rows($resp);


			$array=array();
			$contador=0;
			if ($cont>0) {

				while ($objeto=$this->db->fetch_object($resp)) {

					$array[$contador]=$objeto;
					$contador++;
				} 
			}
			return $array;
	}


	public function EvaluarHorarioDisponible()
	{
		/*$sql="SELECT *FROM citas
			WHERE fechacita='$this->fecha' and '$this->horainicial'<=horafinal AND '$this->horafinal'>=horainicial AND idespecialista='$this->idespecialista'";*/

			$sql="SELECT *FROM citas
			WHERE fechacita='$this->fecha' and horainicial>='$this->horainicial' AND horafinal<='$this->horafinal' AND idespecialista='$this->idespecialista' AND estatus IN(0,1,2)";
			
			$resp = $this->db->consulta($sql);
			$cont = $this->db->num_rows($resp);


			$array=array();
			$contador=0;
			if ($cont>0) {

				while ($objeto=$this->db->fetch_object($resp)) {

					$array[$contador]=$objeto;
					$contador++;
				} 
			}
			return $array;
	}


public function ObtenerHorariosEspecialistadia($numdia)
	{
		$sql="SELECT *FROM horarioespecialista
			WHERE idespecialista='$this->idespecialista' AND dia='$numdia'";

			$resp = $this->db->consulta($sql);
			$cont = $this->db->num_rows($resp);


			$array=array();
			$contador=0;
			if ($cont>0) {

				while ($objeto=$this->db->fetch_object($resp)) {

					$array[$contador]=$objeto;
					$contador++;
				} 
			}
			return $array;
	}



	public function HorarioAtencion($numdia)
	{
			$sql="SELECT *FROM horarioespecialista
			WHERE idespecialista='$this->idespecialista' AND dia='$numdia' AND '$this->horainicial'>=horainicial AND '$this->horafinal'<=horafinal";
			$resp = $this->db->consulta($sql);
			$cont = $this->db->num_rows($resp);


			$array=array();
			$contador=0;
			if ($cont>0) {

				while ($objeto=$this->db->fetch_object($resp)) {

					$array[$contador]=$objeto;
					$contador++;
				} 
			}
			return $array;
		}

	public function ObtenerIdEspecialista()
		{
			$sql="SELECT *FROM especialista
			WHERE idusuarios='$this->idusuarios'";
			$resp = $this->db->consulta($sql);
			$cont = $this->db->num_rows($resp);


			$array=array();
			$contador=0;
			if ($cont>0) {

				while ($objeto=$this->db->fetch_object($resp)) {

					$array[$contador]=$objeto;
					$contador++;
				} 
			}
			return $array;
		}

		public function ObtenerEspecialistasSucursales()
		{
			$sql = "SELECT 
				usuarios.nombre,
				usuarios.idusuarios,
				usuarios.paterno,
				usuarios.materno,
				especialista.idsucursal,
				especialista.idespecialista,
				usuarios.foto
			FROM especialista
			left JOIN sucursal ON especialista.idsucursal=sucursal.idsucursal
			left join usuarios on especialista.idusuarios=usuarios.idusuarios
		
		 WHERE usuarios.estatus=1  AND especialista.idsucursal IN ($this->idsucursal) GROUP BY usuarios.idusuarios";
		
			$resp = $this->db->consulta($sql);
			$cont = $this->db->num_rows($resp);


			$array=array();
			$contador=0;
			if ($cont>0) {

				while ($objeto=$this->db->fetch_object($resp)) {

					$array[$contador]=$objeto;
					$contador++;
				} 
			}
			return $array;
		}

	public function ActualizarBloqueo()
		{
		$query="UPDATE especialista SET 
		bloqueo='$this->estatus'
		 WHERE idespecialista='$this->idespecialista' ";
		
		$result = $this->db->consulta($query);
		}


	public function ObtenerEspecialista()
	{
		$sql = "SELECT 
				usuarios.nombre,
				usuarios.idusuarios,
				usuarios.paterno,
				usuarios.materno,
				especialista.idsucursal,
				especialista.idespecialista,
				usuarios.foto,
				especialista.descripcionespecialista
			FROM especialista
			left JOIN sucursal ON especialista.idsucursal=sucursal.idsucursal
			left join usuarios on especialista.idusuarios=usuarios.idusuarios
		
		 WHERE especialista.idespecialista IN ($this->idespecialista) ";
		
			$resp = $this->db->consulta($sql);
			$cont = $this->db->num_rows($resp);


			$array=array();
			$contador=0;
			if ($cont>0) {

				while ($objeto=$this->db->fetch_object($resp)) {

					$array[$contador]=$objeto;
					$contador++;
				} 
			}
			return $array;
	}

	

	public function obtenerCalificacionesEspecialista()
	{
		$sql = "SELECT
			citas.idespecialista,
			calificacion.calificacion,
			usuarios.nombre,
			usuarios.paterno,
			usuarios.materno,
			citas.idcita,
			calificacion.comentario
			FROM
			calificacion
			JOIN citas
			ON calificacion.idcita = citas.idcita 
			JOIN usuarios
			ON calificacion.idusuarios = usuarios.idusuarios WHERE idespecialista='$this->idespecialista' ";


			$resp = $this->db->consulta($sql);
			$cont = $this->db->num_rows($resp);


			$array=array();
			$contador=0;
			if ($cont>0) {

				while ($objeto=$this->db->fetch_object($resp)) {

					$array[$contador]=$objeto;
					$contador++;
				} 
			}
			return $array;
	}

	public function ObtenerPaquetesEspecialista()
	{
		$sql = "SELECT
				paquetes.idpaquete,
				paquetes.nombrepaquete,
				paquetes_especialista.idespecialista,
				paquetes_especialista.costo,
				paquetesucursal.idsucursal,
				paquetes.intervaloservicio
				FROM
				paquetes_especialista
				LEFT JOIN paquetes
				ON paquetes_especialista.idpaquete = paquetes.idpaquete 
				LEFT JOIN paquetesucursal
				ON paquetes.idpaquete = paquetesucursal.idpaquete
 				WHERE paquetes_especialista.idespecialista='$this->idespecialista' AND paquetesucursal.idsucursal='$this->idsucursal' AND paquetes.estatus=1";


			$resp = $this->db->consulta($sql);
			$cont = $this->db->num_rows($resp);


			$array=array();
			$contador=0;
			if ($cont>0) {

				while ($objeto=$this->db->fetch_object($resp)) {

					$array[$contador]=$objeto;
					$contador++;
				} 
			}
			return $array;
	}

	public function EvaluarHorarioApartado()
	{
		/*$sql="SELECT *FROM citaapartado
			WHERE fecha='$this->fecha' and '$this->horainicial'<=horafinal AND '$this->horafinal'>=horainicial AND idespecialista='$this->idespecialista'";*/
			$sql="SELECT *FROM citaapartado
				WHERE fecha='$this->fecha' 
				and horainicial>='$this->horainicial' AND 
				horafinal<='$this->horafinal' AND idespecialista='$this->idespecialista' AND idusuario='$this->idusuarios'";

		
			$resp = $this->db->consulta($sql);
			$cont = $this->db->num_rows($resp);


			$array=array();
			$contador=0;
			if ($cont>0) {

				while ($objeto=$this->db->fetch_object($resp)) {

					$array[$contador]=$objeto;
					$contador++;
				} 
			}
			return $array;
	}


/*	public function EvaluarEspecialistas($intervalo,$paqueteDuracion)
	{
		$intervalosespecialista=[];
		$especialistasdisponibles=array();
			$sql="SELECT *FROM  especialista 
			left join usuarios on especialista.idusuarios=usuarios.idusuarios
			 WHERE usuarios.estatus=1 and especialista.idsucursal='$this->idsucursal'";


			$resp = $this->db->consulta($sql);
			$cont = $this->db->num_rows($resp);


			$array=array();
			$contador=0;
			if ($cont>0) {

				while ($objeto=$this->db->fetch_object($resp)) {
					$this->idespecialista=$objeto->idespecialista;
					$this->fecha=date('Y-m-d');
					$this->horaactual=date('H:i');
					$hora_iniciofecha="";
					$hora_finfecha="";

					$hora_inicio="";
					$hora_fin="";
					$sqlfecha="SELECT *FROM fechahorariosespecialista WHERE idespecialista='$objeto->idespecialista' AND fecha ='$this->fecha' AND horainicial>='$this->horaactual'";
				
					$respfecha = $this->db->consulta($sqlfecha);
					$contadorfechahorario = $this->db->num_rows($respfecha);

					$array=array();


					if ($contadorfechahorario>0) {

								while ($objetofecha=$this->db->fetch_object($respfecha)) {

									$hora_iniciofecha=$objetofecha->horainicial;
									$hora_finfecha=$objetofecha->horafinal;
								// $intervalosespecialista=$this->intervaloHora($hora_iniciofecha, $hora_finfecha, $intervalo);

								}
					}
								//else{

					$sql2="SELECT *FROM horarioespecialista WHERE idespecialista='$objeto->idespecialista' AND dia ='$this->dia'";

					$resp2 = $this->db->consulta($sql2);
					$cont2 = $this->db->num_rows($resp2);

					$array=array();
					$contador=0;
					if ($cont2>0) {

				while ($objeto2=$this->db->fetch_object($resp2)) {

					$hora_inicio=$objeto2->horainicial;
					$hora_fin=$objeto2->horafinal;
			//		$intervalosespecialista=$this->intervaloHora($hora_inicio, $hora_fin, $intervalo);



				//}
			}


			if ($hora_inicio!='' && $hora_iniciofecha!='') {
				
					$intervalosespecialista=$this->intervaloHora($hora_iniciofecha, $hora_finfecha, $intervalo);


			}

			if ($hora_inicio!='' && $hora_iniciofecha=='') {

							$intervalosespecialista=$this->intervaloHora($hora_inicio, $hora_fin, $intervalo);
			}


			if ($hora_inicio=='' && $hora_iniciofecha!='') {

							$intervalosespecialista=$this->intervaloHora($hora_iniciofecha, $hora_finfecha, $intervalo);
			}


		//}

						//var_dump($intervalosespecialista);die();

					if (count($intervalosespecialista)>0) {
						# code...
					
					for ($i=0; $i <count($intervalosespecialista) ; $i++) { 
								
					$horainiciale=substr($intervalosespecialista[$i],0,5);

					$horafinale=substr($intervalosespecialista[$i+1],0,5);

					$nuevaHora = date('H:i', strtotime($horainiciale . ' +'.$paqueteDuracion.' minutes'));
					$horafinale=$nuevaHora;
						//verificar si de todos los horarios se encuentra disponible en el horario del intervalo
					/*echo $this->horainicial.' '.$this->horafinal.'<br>';

					echo $horainiciale.' '.$horafinale;die();*/
						//echo $horafinale.'=='.$this->horafinal;die();
					/*	if ($horainiciale==$this->horainicial && $horafinale==$this->horafinal) {

							
							$evaluarcita=$this->EvaluarCitaHorario();

							if (count($evaluarcita)==0) {
								
							//	
					array_push($especialistasdisponibles,$objeto->idespecialista);
					

								}
						

							}


							}

						}


						}
					}

					return $especialistasdisponibles;

				}*/ 
			public function EvaluarEspecialistas($intervalo,$paqueteDuracion)
	{
		$especialistasdisponibles=array();
			$sql="SELECT *FROM  especialista 
			left join usuarios on especialista.idusuarios=usuarios.idusuarios
			 WHERE usuarios.estatus=1 and especialista.idsucursal='$this->idsucursal'";


			$resp = $this->db->consulta($sql);
			$cont = $this->db->num_rows($resp);


			$array=array();
			$contador=0;
			if ($cont>0) {

				while ($objeto=$this->db->fetch_object($resp)) {
					$this->idespecialista=$objeto->idespecialista;

					$sql2="SELECT *FROM horarioespecialista WHERE idespecialista='$objeto->idespecialista' AND dia ='$this->dia'";

					$resp2 = $this->db->consulta($sql2);
					$cont2 = $this->db->num_rows($resp2);

					$array=array();
					$contador=0;
					if ($cont>0) {

				while ($objeto2=$this->db->fetch_object($resp2)) {

					$hora_inicio=$objeto2->horainicial;
					$hora_fin=$objeto2->horafinal;
					$intervalosespecialista=$this->intervaloHora($hora_inicio, $hora_fin, $intervalo);

						//var_dump($intervalosespecialista);die();

					
					for ($i=0; $i <count($intervalosespecialista) ; $i++) { 
								
					$horainiciale=substr($intervalosespecialista[$i],0,5);

					$horafinale=substr($intervalosespecialista[$i+1],0,5);

					$nuevaHora = date('H:i', strtotime($horainiciale . ' +'.$paqueteDuracion.' minutes'));
					$horafinale=$nuevaHora;
						//verificar si de todos los horarios se encuentra disponible en el horario del intervalo
					/*echo $this->horainicial.' '.$this->horafinal.'<br>';

					echo $horainiciale.' '.$horafinale;die();*/
						//echo $horafinale.'=='.$this->horafinal;die();
						if ($horainiciale==$this->horainicial && $horafinale==$this->horafinal) {

							
							$evaluarcita=$this->EvaluarCitaHorario();

							if (count($evaluarcita)==0) {
								
							//	
					array_push($especialistasdisponibles,$objeto->idespecialista);
					

								}
						

							}


							}


						}
					}


				} 
			}
			return $especialistasdisponibles;
			
	}
		
public function EvaluarEspecialistas2($intervalo, $paqueteDuracion)
{
    $intervalosespecialista = [];
    $especialistasdisponibles = [];

    $sql = "SELECT * FROM especialista 
            LEFT JOIN usuarios ON especialista.idusuarios = usuarios.idusuarios
            WHERE usuarios.estatus = 1 AND especialista.idsucursal = '$this->idsucursal'";

    $resp = $this->db->consulta($sql);
    $cont = $this->db->num_rows($resp);

    if ($cont > 0) {
        while ($objeto = $this->db->fetch_object($resp)) {
            $this->idespecialista = $objeto->idespecialista;
           // $this->fecha = date('Y-m-d');
            $this->horaactual = date('H:i');
            $hora_iniciofecha = "";
            $hora_finfecha = "";
            $hora_inicio = "";
            $hora_fin = "";

            $sqlfecha = "SELECT * FROM fechahorariosespecialista WHERE idespecialista = '$objeto->idespecialista' AND fecha = '$this->fecha'  ";
            if ($objeto->idespecialista==3) {
            	//	echo $sqlfecha;
            }
           
            $respfecha = $this->db->consulta($sqlfecha);
            $contadorfechahorario = $this->db->num_rows($respfecha);
           	
            if ($contadorfechahorario > 0) {
                while ($objetofecha = $this->db->fetch_object($respfecha)) {
                    $hora_inicio = $objetofecha->horainicial;
                    $hora_fin = $objetofecha->horafinal;
                }
            } else {
                $sql2 = "SELECT * FROM horarioespecialista WHERE idespecialista = '$objeto->idespecialista' AND dia = '$this->dia'";
                $resp2 = $this->db->consulta($sql2);
                $cont2 = $this->db->num_rows($resp2);

                if ($cont2 > 0) {
                    while ($objeto2 = $this->db->fetch_object($resp2)) {
                        $hora_inicio = $objeto2->horainicial;
                        $hora_fin = $objeto2->horafinal;
                    }
                }
            }

            /*if ($hora_inicio != '' && $hora_iniciofecha != '') {
                $intervalosespecialista = $this->intervaloHora($hora_iniciofecha, $hora_finfecha, $intervalo);
            }*/

            /*if ($hora_inicio != '' && $hora_iniciofecha == '') {
                $intervalosespecialista = $this->intervaloHora($hora_inicio, $hora_fin, $intervalo);
            }*/
           
            if ($hora_inicio != '' && $hora_fin != '') {
                $intervalosespecialista = $this->intervaloHora($hora_inicio, $hora_fin, $intervalo);
            }

             if ($objeto->idespecialista==6) {
            //print_r($hora_inicio.''.$hora_fin);

            // var_dump( $intervalosespecialista);

            }
           

            if (count($intervalosespecialista) > 0) {
                for ($q = 0; $q < count($intervalosespecialista); $q++) {
                    $horainiciale = substr($intervalosespecialista[$q], 0, 5);
                    $horafinale = substr($intervalosespecialista[$q + 1], 0, 5);
                    $nuevaHora = date('H:i', strtotime($horainiciale . ' +' . $paqueteDuracion . ' minutes'));
                    $horafinale = $nuevaHora;


 
                    if ($horainiciale == $this->horainicial ) {


                        $evaluarcita = $this->EvaluarCitaHorario();
                        if (count($evaluarcita) == 0) {
                            array_push($especialistasdisponibles, $objeto->idespecialista);
                        }
                    }
                }
            }
        }
    }

    return $especialistasdisponibles;
}

	



    function intervaloHora($hora_inicio, $hora_fin, $intervalo = 30) {

		    $hora_inicio = new DateTime($hora_inicio );
		    $hora_fin    = new DateTime($hora_fin );
		    $hora_fin->modify('+1 second'); // Añadimos 1 segundo para que nos muestre $hora_fin

		    // Si la hora de inicio es superior a la hora fin
		    // añadimos un día más a la hora fin
		    if ($hora_inicio > $hora_fin) {

		        $hora_fin->modify('+1 day');
		    }

		    // Establecemos el intervalo en minutos        
		    $intervalo = new DateInterval('PT'.$intervalo.'M');

		    // Sacamos los periodos entre las horas
		    $periodo   = new DatePeriod($hora_inicio, $intervalo, $hora_fin);        

		    foreach( $periodo as $hora ) {

		        // Guardamos las horas intervalos 
		        $horas[] =  $hora->format('H:i:s');
		    }

		    return $horas;
		}



	public function EvaluarCitaHorario()
	{
		
			$sql="SELECT *FROM citas
				WHERE fechacita='$this->fecha' 
				and horainicial>='$this->horainicial' AND 
				horafinal<='$this->horafinal' AND idespecialista='$this->idespecialista'";
				/*if ($this->idespecialista==6) {
						echo $sql;die();
				}*/
			
			
			$resp = $this->db->consulta($sql);
			$cont = $this->db->num_rows($resp);


			$array=array();
			$contador=0;
			if ($cont>0) {

				while ($objeto=$this->db->fetch_object($resp)) {

					$array[$contador]=$objeto;
					$contador++;
				} 
			}
			return $array;
	}


	public function AccesoSucursalEspecialista()
	{
		$sql="SELECT
			IFNULL(GROUP_CONCAT(especialista.idespecialista),0) as idespecialista
			FROM
			especialista
			JOIN sucursal
			ON especialista.idsucursal = sucursal.idsucursal WHERE especialista.idusuarios='$this->idusuario'  ORDER BY orden asc";
			
		$resp=$this->db->consulta($sql);
		$cont = $this->db->num_rows($resp);


		$array=array();
		$contador=0;
		if ($cont>0) {

			while ($objeto=$this->db->fetch_object($resp)) {

				

				$array[$contador]=$objeto;
				$contador++;
			} 
		}
		
		return $array;
	}


	public function ValidarIntervaloDisponibleConEspecialistas($fecha,$idpaquete,$intervalo,$intervaloavalidar)
	{

		$sql="SELECT *FROM  citas 
			 WHERE citas.estatus=0 and citas.idsucursal='$this->idsucursal' AND fechacita ='$fecha'  AND '$intervaloavalidar' BETWEEN citas.horainicial AND citas.horafinal ";
			
			$resp = $this->db->consulta($sql);
			$cont = $this->db->num_rows($resp);


			$array=array();
			$contador=0;
			 $pasa=1;
			if ($cont>0) {

				while ($objeto=$this->db->fetch_object($resp)) {

					$citahorainicial=$objeto->horainicial;
					$citahorafinal=$objeto->horafinal;
					 $intervalos=$this->fechas->intervaloHora($citahorainicial,$citahorafinal,$intervalo);
					
					 $totalespecialista=$this->TotalEspecialista();

					 // var_dump($totalespecialista);die();
					 $pasa=1;
					 for ($i=0; $i <count($intervalos) ; $i++) { 
					 	$encontrado=0;

					 

					if (substr($intervalos[$i],0,5)==$intervaloavalidar) {

						$encontrado=1;
								 	

						}
								 
								 
					 	if ($encontrado==1) {
					 		

					 		$totalespecita=	$this->ValidarIntervalo($fecha,$intervaloavalidar);

					 				if ($totalespecita==$totalespecialista) {
					 					$pasa=0;
					 				
					 				}
					 				break;

					 	}

					
					 }


				}
			}


			return $pasa;

		
	}

	public function ValidarIntervalo($fecha,$intervaloavalidar)
	{
			/*$sql="
					 		SELECT COUNT(DISTINCT especialista.idespecialista) AS total_especialistas
								FROM citas
								LEFT JOIN especialista ON citas.idespecialista = especialista.idespecialista
								WHERE citas.estatus = 0
								  AND citas.idsucursal = '$this->idsucursal'
								  AND citas.fechacita = '$fecha'
								  AND '$intervaloavalidar' BETWEEN citas.horainicial AND citas.horafinal;
					 		";*/
					 

					 $sql="SELECT COUNT(DISTINCT especialista.idespecialista) AS total_especialistas
									FROM citas
									LEFT JOIN especialista ON citas.idespecialista = especialista.idespecialista
									WHERE citas.estatus IN(0,1,2,4)
  							AND citas.idsucursal = '$this->idsucursal'
  							AND citas.fechacita = '$fecha'
  							AND '$intervaloavalidar' >= citas.horainicial
  							AND '$intervaloavalidar' < citas.horafinal";
  						
					 			$resp = $this->db->consulta($sql);
								$cont = $this->db->num_rows($resp);


									$array=array();
									$contador=0;
									if ($cont>0) {

										while ($objeto=$this->db->fetch_object($resp)) {
													$array[$contador]=$objeto;
													$contador++;
										}
									}

									return $array[0]->total_especialistas;
	}



	public function TotalEspecialista()
	{
		$sql="SELECT  count(*) as total FROM  especialista 
			left join usuarios on especialista.idusuarios=usuarios.idusuarios
			 WHERE usuarios.estatus=1 and especialista.idsucursal='$this->idsucursal'";

			$resp = $this->db->consulta($sql);
			$cont = $this->db->num_rows($resp);

			$array=array();
			$contador=0;
			if ($cont>0) {

				while ($objeto=$this->db->fetch_object($resp)) {

				$array[$contador]=$objeto;
				$contador++;
			} 
		}
		
		return $array[0]->total;
	  
	}



	public function AccesoSucursalEspecialistaHorario()
	{
		$sql="SELECT
			especialista.idsucursal,especialista.idespecialista
			FROM
			especialista
			JOIN horarioespecialista ON especialista.idespecialista=horarioespecialista.idespecialista
		 WHERE especialista.idusuarios='$this->idusuarios'  limit 1";
			
		$resp=$this->db->consulta($sql);
		$cont = $this->db->num_rows($resp);


		$array=array();
		$contador=0;
		if ($cont>0) {

			while ($objeto=$this->db->fetch_object($resp)) {

				

				$array[$contador]=$objeto;
				$contador++;
			} 
		}
		
		return $array;
	}




	public function Disponibilidad4()
	{
		$sql="SELECT TABLA1.*,paquetes.nombrepaquete,paquetes.intervaloservicio from (SELECT citas.*,CONCAT(usuarios.nombre)as nombrecliente
			FROM citas
		
		left join usuarios ON usuarios.idusuarios=citas.idusuarios

		WHERE fechacita='$this->fecha' AND idespecialista='$this->idespecialista' AND citas.estatus IN(0,1,2,4)

		  )AS TABLA1
		LEFT JOIN paquetes ON TABLA1.idpaquete=paquetes.idpaquete
		where
		 '$this->horainicial' >= TABLA1.horainicial  AND '$this->horafinal'<=TABLA1.horafinal";
		
		  $resp = $this->db->consulta($sql);
		  $cont = $this->db->num_rows($resp);

		 
		$array=array();
		$contador=0;
		if ($cont>0) {

			while ($objeto=$this->db->fetch_object($resp)) {

				$array[$contador]=$objeto;
				$contador++;
			} 
		}
		return $array;
	}

}

 ?>