<?php 

/**
 * 
 */
class HorariosEspecialista 
{
	
	public $db;
	public $idhorariosespecialista;
	public $dia;
	public $horainicial;
	public $horafinal;
	public $idespecialista;
	public $estatus;
	public $idsucursal;


	public function ObtenerHorariosEspecialista()
	{
		$sql="SELECT *FROM horarioespecialista WHERE idsucursal=".$this->idsucursal." AND idespecialista='$this->idespecialista'";
		
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