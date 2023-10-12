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

	public function ObtenerEspecialistas()
	{
		$sql = "SELECT 
				usuarios.nombre,
				usuarios.idusuarios,
				usuarios.paterno,
				usuarios.materno,
				especialista.idespecialista,
				especialista.idsucursal,
				usuarios.orden,
				usuarios.foto
			FROM especialista
			left JOIN sucursal ON especialista.idsucursal=sucursal.idsucursal
			left join usuarios on especialista.idusuarios=usuarios.idusuarios
			
		 WHERE usuarios.estatus=1 AND especialista.bloqueo=0 and sucursal.idsucursal='$this->idsucursal'  ORDER BY usuarios.orden asc ";

	
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


	public function EvaluarEspecialistas($intervalo)
	{
		$especialistasdisponibles=array();
			$sql="SELECT *FROM paquetes_especialista
			left join especialista on especialista.idespecialista=paquetes_especialista.idespecialista
			left join usuarios on especialista.idusuarios=usuarios.idusuarios
			 WHERE usuarios.estatus=1 and paquetes_especialista.idpaquete='$this->idpaquete'";
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


						//verificar si de todos los horarios se encuentra disponible en el horario del intervalo
					/*echo $this->horainicial.' '.$this->horafinal.'<br>';

					echo $horainiciale.' '.$horafinale;die();*/

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