<?php 
/**
 * 
 */
class HorarioEspecialista 
{
	public $db;
	public $idespecialista;
	public $idsucursal;
	public $dia;
	public $horainicial;
	public $horafinal;
	public $estatus;
	public $fechaactual;
	public $horaactual;
	public $fecha;


	public function VerificarHorario()
	{
		$sql="SELECT *FROM horarioespecialista WHERE idespecialista='$this->idespecialista' and idsucursal='$this->idsucursal'  AND dia='$this->dia' and  '$this->horainicial' >= horainicial  AND '$this->horafinal' <= horafinal ";
	
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

	public function VerficarfechaHorario()
	{

		$sql="SELECT *FROM fechahorariosespecialista WHERE idespecialista='$this->idespecialista' and idsucursal='$this->idsucursal'  AND fecha='$this->fecha' and  '$this->horainicial' >= horainicial  AND '$this->horafinal' <= horafinal ";

		
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




	public function ObtenerfechaHorario()
	{
		
		$sql="SELECT *FROM fechahorariosespecialista WHERE idespecialista='$this->idespecialista' and idsucursal='$this->idsucursal'  AND fecha='$this->fecha'  ";
		
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


	public function ObtenerHorario()
	{
		$sql="SELECT *FROM horarioespecialista WHERE idespecialista='$this->idespecialista' and idsucursal='$this->idsucursal'  AND dia='$this->dia' and horainicial<='$this->horainicial' and '$this->horainicial'<=horafinal ";


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