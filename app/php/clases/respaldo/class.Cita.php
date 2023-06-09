<?php 
/**
 * 
 */
class Cita 
{
	
	public $db;
	public $horacita;
	public $fechacita;
	public $estatus;
	public $orden;
	public $idusuarios;
	public $horainicial;
	public $horafinal;

	public $idcitaapartado;

	public $idsucursal;
	public $idpaquete;
	public $idespecialista;
	public $fecha;
	public $idusuario;
	public $idcita;
	public $costo;
	public $qrgenerado;

	public function ObtenerCitasUsuario()
	{
		$sql="SELECT 
			citas.horacita,
			citas.fechacita,
			citas.asuntocita,
			citas.estatus,
			citas.orden,
			citas.idsucursal,
			sucursal.titulo,
			sucursal.descripcion,
			sucursal.imagen,
			citas.idusuarios,
			citas.idcita,
			citas.checkin,
			citas.fechacheckin,
			CONCAT(usuarios.nombre,' ',usuarios.paterno) AS nombreespecialista
		FROM citas INNER JOIN  especialista ON especialista.idespecialista=citas.idespecialista
		INNER JOIN usuarios ON usuarios.idusuarios=especialista.idusuarios
		INNER JOIN sucursal ON sucursal.idsucursal=citas.idsucursal
		 WHERE citas.idusuarios=".$this->idusuarios."";
		
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


	public function ChecarHorarioEspecialista()
	{
		
		$sql="SELECT *FROM citas WHERE idespecialista='$this->idespecialista' AND horainicial='$this->horainicial' AND horafinal='$this->horafinal'";
		
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

	public function GuardarCitaApartado()
	{
		try {

			$sql="INSERT INTO citaapartado( horainicial, horafinal, idsucursal, idpaquete, idespecialista, fecha, estatus, idusuario) VALUES ('$this->horainicial', '$this->horafinal',
				 '$this->idsucursal', '$this->idpaquete','$this->idespecialista','$this->fecha','$this->estatus','$this->idusuario')";
	
		$resp=$this->db->consulta($sql);
		$this->idcitaapartado=$this->db->id_ultimo();
		} catch (Exception $e) {
			echo $e;
			$this->db->roolback();
		}
		
		//$resp = $this->db->consulta($sql);

	}

	public function CitaCreada()
	{
		try {
			$sql="INSERT INTO citas(horacita, fechacita, asuntocita, estatus, orden,idsucursal, horainicial, horafinal, idpaquete, idespecialista, costo, idusuarios) VALUES ( '$this->horacita','$this->fechacita','',$this->estatus, 0, '$this->idsucursal','$this->horainicial','$this->horafinal', '$this->idpaquete','$this->idespecialista','$this->costo','$this->idusuario')";
			
				$resp=$this->db->consulta($sql);
				$this->idcita=$this->db->id_ultimo();
		} catch (Exception $e) {
			echo $e;
		}
		
	}



	public function ObtenerCitaCreada()
	{
		$sql="SELECT 
			citaapartado.horainicial,
			citaapartado.fecha,
			citaapartado.estatus,
			citaapartado.idsucursal,
			sucursal.titulo,
			sucursal.descripcion,
			sucursal.imagen,
			usuarios.nombre,
			usuarios.paterno,
			citaapartado.idpaquete,
			citaapartado.horafinal,
			citaapartado.idespecialista,
			citaapartado.idusuario,
			citaapartado.costo
		FROM citaapartado
		INNER JOIN sucursal ON sucursal.idsucursal=citaapartado.idsucursal
		INNER JOIN especialista ON citaapartado.idespecialista=especialista.idespecialista
		left join usuarios ON usuarios.idusuarios=especialista.idusuarios
		 WHERE 	citaapartado.idusuario='$this->idusuario' AND idcitaapartado='$this->idcitaapartado'";
		
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

	public function Obtenerdetallecita()
	{
		$sql="SELECT 
			citas.horainicial,
			citas.fechacita,
			citas.estatus,
			citas.idsucursal,
			sucursal.titulo,
			sucursal.descripcion,
			sucursal.imagen,
			sucursal.ubicacion,
			sucursal.celular,
			usuarios.nombre,
			usuarios.paterno,
			citas.idpaquete,
			citas.horafinal,
			citas.idespecialista,
			citas.idusuarios,
			citas.costo,
			citas.idcita,
			citas.checkin,
			citas.fechacheckin,
			(SELECT paquetes.nombrepaquete from paquetes WHERE paquetes.idpaquete=citas.idpaquete)as concepto


		FROM citas
		INNER JOIN sucursal ON sucursal.idsucursal=citas.idsucursal
		INNER JOIN especialista ON citas.idespecialista=especialista.idespecialista
		left join usuarios ON usuarios.idusuarios=especialista.idusuarios
		 WHERE 	citas.idusuarios='$this->idusuario' AND idcita='$this->idcita'";
		
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


	public function ObtenerCitasEspecialista($fechafiltro)
	{
		$sql="SELECT 
			citas.horacita,
			citas.horafinal,
			citas.fechacita,
			citas.asuntocita,
			citas.estatus,
			citas.orden,
			citas.idsucursal,
			sucursal.titulo,
			sucursal.descripcion,
			sucursal.imagen,
			citas.idusuarios,
			citas.idcita,
			CONCAT(usuarios.nombre,' ',usuarios.paterno) AS nombreespecialista
		FROM citas INNER JOIN  especialista ON especialista.idespecialista=citas.idespecialista
		INNER JOIN usuarios ON usuarios.idusuarios=citas.idusuarios
		INNER JOIN sucursal ON sucursal.idsucursal=citas.idsucursal
		 WHERE citas.idespecialista=".$this->idespecialista."";

		 if ($fechafiltro!='') {
		 	$sql.=" AND fechacita='".$fechafiltro."'";
		 }
		
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



	public function ObtenerdetallecitaEspecialista()
	{
		$sql="SELECT 
			citas.horainicial,
			citas.horafinal,
			citas.fechacita,
			citas.estatus,
			citas.idsucursal,
			sucursal.titulo,
			sucursal.descripcion,
			sucursal.imagen,
			usuarios.nombre,
			usuarios.paterno,
			citas.idpaquete,
			citas.horafinal,
			citas.idespecialista,
			citas.idusuarios,
			citas.costo,
			citas.checkin,
			citas.fechacheckin,
			(SELECT paquetes.nombrepaquete from paquetes WHERE paquetes.idpaquete=citas.idpaquete)as concepto
		FROM citas
		INNER JOIN sucursal ON sucursal.idsucursal=citas.idsucursal
		INNER JOIN especialista ON citas.idespecialista=especialista.idespecialista
		left join usuarios ON usuarios.idusuarios=citas.idusuarios
		 WHERE 	citas.idespecialista='$this->idespecialista' AND idcita='$this->idcita'";
		
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

	public function ActualizarcitaQr()
	{
		 $sql = "UPDATE citas 
        SET estatus = 1,
        checkin=1,
        idqrgenerado='$this->qrgenerado',
        fechacheckin='".date('Y-m-d H:i:s')."'
        WHERE idcita = '$this->idcita'
        AND idusuarios='$this->idusuarios'

        ";
        $this->db->consulta($sql);
	}

	public function ObtenerCitasAdmin()
	{
		$sql="SELECT 
			citas.horacita,
			citas.horafinal,
			citas.fechacita,
			citas.asuntocita,
			citas.estatus,
			citas.orden,
			citas.idsucursal,
			sucursal.titulo,
			sucursal.descripcion,
			sucursal.imagen,
			citas.idusuarios,
			citas.idcita,
			CONCAT(usuarios.nombre,' ',usuarios.paterno) AS nombreespecialista
		FROM citas INNER JOIN  especialista ON especialista.idespecialista=citas.idespecialista
		INNER JOIN usuarios ON usuarios.idusuarios=especialista.idusuarios
		INNER JOIN sucursal ON sucursal.idsucursal=citas.idsucursal
		";
		
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

	public function ObtenerdetallecitaAdmin()
	{
		$sql="SELECT 
			citas.horainicial,
			citas.fechacita,
			citas.estatus,
			citas.idsucursal,
			sucursal.titulo,
			sucursal.descripcion,
			sucursal.imagen,
			sucursal.ubicacion,
			sucursal.celular,
			usuarios.nombre,
			usuarios.paterno,
			citas.idpaquete,
			citas.horafinal,
			citas.idespecialista,
			citas.idusuarios,
			citas.costo,
			citas.idcita,
			citas.checkin,
			citas.fechacheckin,
			(SELECT paquetes.nombrepaquete from paquetes WHERE paquetes.idpaquete=citas.idpaquete)as concepto

		FROM citas
		INNER JOIN sucursal ON sucursal.idsucursal=citas.idsucursal
		INNER JOIN especialista ON citas.idespecialista=especialista.idespecialista
		left join usuarios ON usuarios.idusuarios=citas.idusuarios
		 WHERE 	 idcita='$this->idcita'";
		
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

	public function ObtenerCitasFecha()
	{
		$sql="SELECT 
			citas.idcita,
			citas.horainicial,
			citas.horacita,
			citas.fechacita,
			citas.estatus,
			citas.idsucursal,
			sucursal.titulo,
			sucursal.descripcion,
			sucursal.imagen,
			usuarios.nombre,
			usuarios.paterno,
			citas.idpaquete,
			citas.horafinal,
			citas.idespecialista,
			citas.idusuarios,
			citas.costo,
			CONCAT(usuarios.nombre,' ',usuarios.paterno) AS nombreespecialista
		FROM citas
		INNER JOIN sucursal ON sucursal.idsucursal=citas.idsucursal
		INNER JOIN especialista ON citas.idespecialista=especialista.idespecialista
		left join usuarios ON usuarios.idusuarios=citas.idusuarios
		 WHERE 	 fechacita='$this->fechacita' AND sucursal.idsucursal IN($this->idsucursal) AND checkin=0 ORDER BY idsucursal,fechacita,horainicial";
		
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

	public function ObtenerCitaEspecialista()
	{
		$sql="SELECT 
			citas.horacita,
			citas.fechacita,
			citas.asuntocita,
			citas.estatus,
			citas.orden,
			citas.idsucursal,
			sucursal.titulo,
			sucursal.descripcion,
			sucursal.imagen,
			citas.idusuarios,
			citas.idcita,
			CONCAT(usuarios.nombre,' ',usuarios.paterno) AS nombreespecialista
		FROM citas INNER JOIN  especialista ON especialista.idespecialista=citas.idespecialista
		INNER JOIN usuarios ON usuarios.idusuarios=especialista.idusuarios
		INNER JOIN sucursal ON sucursal.idsucursal=citas.idsucursal
		 WHERE citas.idespecialista=".$this->idespecialista." AND citas.idcita='$this->idcita'";
		
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



		public function ObtenerCitasNocheckin()
	{
		$sql="SELECT 
			citas.horainicial,
			citas.horacita,
			citas.fechacita,
			citas.estatus,
			citas.idsucursal,
			sucursal.titulo,
			sucursal.descripcion,
			sucursal.imagen,
			usuarios.nombre,
			usuarios.paterno,
			citas.idpaquete,
			citas.horafinal,
			citas.idespecialista,
			citas.idusuarios,
			citas.costo,
			CONCAT(usuarios.nombre,' ',usuarios.paterno) AS nombreespecialista
		FROM citas
		INNER JOIN sucursal ON sucursal.idsucursal=citas.idsucursal
		INNER JOIN especialista ON citas.idespecialista=especialista.idespecialista
		left join usuarios ON usuarios.idusuarios=citas.idusuarios
		 WHERE 	 citas.checkin=0 ORDER BY fechacita,horainicial";

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

	public function EliminarCitaApartada()
	{
		
		 $sql = "DELETE FROM citaapartado
        WHERE idcitaapartado = '$this->idcitaapartado'
        ";

        $this->db->consulta($sql);
	}
}
 ?>