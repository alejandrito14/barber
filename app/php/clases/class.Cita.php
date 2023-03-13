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
			usuarios.nombre,
			usuarios.paterno,
			citas.idpaquete,
			citas.horafinal,
			citas.idespecialista,
			citas.idusuarios,
			citas.costo
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
}
 ?>