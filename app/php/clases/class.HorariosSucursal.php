<?php
class HorariosSucursal
{
	
	public $db;
	
	public $idhorariossucursal;
	public $dia;
	public $horainicial;
	public $horafinal;
	public $idsucursal;
	public $fecha;
	public $idzona;
	public $fechainicial;
	public $fechafinal;
	

	

	public function ObtenerHorariosSucursal($numdia)
	{
		$sql="SELECT *
			FROM horariossucursal
		WHERE idsucursal='$this->idsucursal' AND dia=$numdia AND estatus=1
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
		return $array;
	}

	public function VerificarHorario()
	{
		$sql="SELECT *FROM (SELECT *
			FROM citas
		WHERE fechacita='$this->fecha' AND idsucursal='$this->idsucursal' )AS TABLA
		WHERE 
		 TABLA.horainicial>='$this->horainicial' AND TABLA.horafinal<='$this->horafinal'
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
		return $array;
	}


	public function ObtenerTodosHorariosSucursal()
	{
		$sql="SELECT *
			FROM horariossucursal
		WHERE idsucursal='$this->idsucursal' 
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
		return $array;
	}
	

}
?>