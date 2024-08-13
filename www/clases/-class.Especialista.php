<?php 
/**
 * 
 */
class Especialista 
{
	
	public $db;
	public $idsucursal;
	public $idespecialista;
	public $costo;
	public $idpaquete;
	public $bloqueo;


	public $dia;
	public $horainicial;
	public $horafinal;
	public $estatus;
	public $fecha;
	public $fechas;
	public $tipocomision;
	public $cantidadcomi;
	public $idtpv;

	public function ObtenerEspecialistaSucursal()
	{
		$sql="SELECT *FROM especialista
		INNER JOIN usuarios ON especialista.idusuarios = usuarios.idusuarios 
		WHERE idsucursal ='$this->idsucursal'";
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


	public function GuardarEspecialistaPaquete()
	{
		$query="INSERT INTO paquetes_especialista (idpaquete,idespecialista,costo) VALUES ('$this->idpaquete','$this->idespecialista','$this->costo')";
		
		$resp=$this->db->consulta($query);
	}

	public function ObtenerEspecialistaPaquete()
	{
		$sql="SELECT *FROM paquetes_especialista
		INNER JOIN especialista ON especialista.idespecialista = paquetes_especialista.idespecialista 
		WHERE idpaquete ='$this->idpaquete'";
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

	public function EliminarEspecialistaPaquete()
	{
		$query="DELETE FROM paquetes_especialista WHERE idpaquete='$this->idpaquete'";
		
		$resp=$this->db->consulta($query);
	}

	public function GuardarEspecialista()
	{
		$query="INSERT INTO especialista (idusuarios,idsucursal,bloqueo) VALUES ('$this->idusuario','$this->idsucursal','$this->bloqueo')";
		
		$resp=$this->db->consulta($query);
		$this->idespecialista=$this->db->id_ultimo();

	}

	public function GuardarHorario()
	{
		$query="INSERT INTO horarioespecialista(dia, horainicial, horafinal, idespecialista, estatus, idsucursal) VALUES ( '$this->dia', '$this->horainicial', '$this->horafinal','$this->idespecialista','$this->estatus','$this->idsucursal')";
		
		$resp=$this->db->consulta($query);

	}



	public function EvaluarHorarioDisponible()
	{
		/*$sql="SELECT *FROM citas
			WHERE fechacita='$this->fecha' and '$this->horainicial'<=horafinal AND '$this->horafinal'>=horainicial AND idespecialista='$this->idespecialista'";*/

		/*	$sql="SELECT *FROM citas
			WHERE fechacita='$this->fecha' and horainicial>='$this->horainicial' AND horafinal<='$this->horafinal' AND idespecialista='$this->idespecialista' AND estatus IN(0,1,2)";*/

			$sql="SELECT *FROM citas
			WHERE fechacita='$this->fecha'
			AND idespecialista='$this->idespecialista' AND estatus IN(0,1,2)
			AND ((horainicial < '$this->horafinal' AND horafinal > '$this->horainicial') OR (horainicial >= '$this->horainicial' AND horainicial < '$this->horafinal'))";
			//echo $sql;die();
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
					/*if ($this->idespecialista==4) {
						var_dump($intervalosespecialista);die();
					}*/
					
					for ($i=0; $i <count($intervalosespecialista) ; $i++) { 
								
					$horainiciale=substr($intervalosespecialista[$i],0,5);

					$horafinale=substr($intervalosespecialista[$i+1],0,5);

					$nuevaHora = date('H:i', strtotime($horainiciale . ' +'.$intervalo.' minutes'));
					$horafinale=$nuevaHora;



					/*if ($this->idespecialista==4) {
						echo $horainiciale.' '.$horafinale.'</br>';
					}*/
						//verificar si de todos los horarios se encuentra disponible en el horario del intervalo
					
						//echo $horafinale.'=='.$this->horafinal;die();
					//	if ($horainiciale==$this->horainicial ) {

							//aqui se evalua
							$evaluarcita=$this->EvaluarCitaHorario();

							$evaluarocupadotpv=$this->EvaluarTpvTemporal();

							if (count($evaluarcita)==0 && count($evaluarocupadotpv)==0) {
								
							//	
					array_push($especialistasdisponibles,$objeto->idespecialista);
					

								}
						

					//		}


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
				
			  AND ((horainicial < '$this->horafinal' AND horafinal > '$this->horainicial') OR (horainicial >= '$this->horainicial' AND horainicial < '$this->horafinal'))

			   AND idespecialista='$this->idespecialista' AND estatus != 3 ";

			 

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


	
	public function ObtenerEspecialistas($idespecialistasele)
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

					 
					 $pasa=1;
					 for ($i=0; $i <count($intervalos) ; $i++) { 
					 	$encontrado=0;

					 

								 	if (substr($intervalos[$i],0,5)==$intervaloavalidar) {

								 		$encontrado=1;
								 	

								 	}
								 
								 
					 	if ($encontrado==1) {
					 		

					 					$totalespecita=	$this->ValidarIntervalo($fecha,$intervaloavalidar);
					 			//echo $totalespecita;die();	
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
					$sql="
					 		SELECT COUNT(DISTINCT especialista.idespecialista) AS total_especialistas
								FROM citas
								LEFT JOIN especialista ON citas.idespecialista = especialista.idespecialista
								WHERE citas.estatus = 0
								  AND citas.idsucursal = '$this->idsucursal'
								  AND citas.fechacita = '$fecha'
								  AND '$intervaloavalidar' BETWEEN citas.horainicial AND citas.horafinal;
					 		";
					
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

	
	public function ObtenerEspecialista()
	{
		$sql = "SELECT 
				usuarios.nombre,
				usuarios.idusuarios,
				usuarios.paterno,
				usuarios.materno,
				usuarios.sexo,
				especialista.idsucursal,
				especialista.idespecialista,
				usuarios.foto,
				usuarios.orden,
				sucursal.idsucursal,
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



	public function ObtenerEspecialistasT()
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
				usuarios.color,
				usuarios.foto,
					(SELECT COUNT(idcita) AS conteo 
					FROM citas 
					WHERE citas.fechacita = '$this->fecha' 
					AND horainicial = '' 
					AND horains != '' and idespecialista=especialista.idespecialista) as conteo
			FROM especialista
			left JOIN sucursal ON especialista.idsucursal=sucursal.idsucursal
			left join usuarios on especialista.idusuarios=usuarios.idusuarios


			
		 WHERE usuarios.estatus=1 AND especialista.bloqueo=0 AND sucursal.idsucursal='$this->idsucursal' ORDER BY usuarios.orden asc ";

		
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

	public function GuardarFechaHorario($value='')
	{
		$query="INSERT INTO fechahorariosespecialista (fecha, horainicial, horafinal, idespecialista, estatus, idsucursal) VALUES ( '$this->fecha', '$this->horainicial', '$this->horafinal','$this->idespecialista','$this->estatus','$this->idsucursal')";
		
		$resp=$this->db->consulta($query);
	}



	public function EvaluarTpvTemporal()
	{
		
			$sql="SELECT *FROM temporalcarritotpv
				WHERE fecha='$this->fecha' 
				and horainicial>='$this->horainicial' AND 
				horafinal<='$this->horafinal' AND idespecialista='$this->idespecialista' and idtpv='$this->idtpv'";

	
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