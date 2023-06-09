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
				paquetes_especialista.idespecialista,
				paquetes_especialista.idpaquete,
				especialista.idsucursal,
				paquetes_especialista.costo,
				usuarios.foto
			FROM especialista
			left JOIN sucursal ON especialista.idsucursal=sucursal.idsucursal
			left join usuarios on especialista.idusuarios=usuarios.idusuarios
			left JOIN paquetes_especialista ON especialista.idespecialista=paquetes_especialista.idespecialista

		 WHERE usuarios.estatus=1 AND especialista.bloqueo=0 AND  paquetes_especialista.idpaquete='$this->idpaquete' AND sucursal.idsucursal='$this->idsucursal'";

		
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
			WHERE fechacita='$this->fecha' and horainicial>='$this->horainicial' AND horafinal<='$this->horafinal' AND idespecialista='$this->idespecialista'";
		
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