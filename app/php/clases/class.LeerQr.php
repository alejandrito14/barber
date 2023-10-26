<?php
class LeerQr
{
	public $db;
	public $idqrgenerado;
	public $estatus;
	public $idusuarios;
	public $idcita;


	public function VerificarSihasidoleido()
	{
		$sql="SELECT *FROM qrgenerados WHERE idqrgenerado='$this->idqrgenerado' AND idcita='$this->idcita' AND estatus=3";
		
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


	public function VerificarSihasidofinalizada()
	{
		$sql="SELECT *FROM citas WHERE  idcita='$this->idcita' AND estatus=2 AND checkout=1 ";
		
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