<?php 
/**
 * 
 */
class Opciones 
{
	
	public $db;
	public $idopcion;

	public function ObtenerOpcionesActivas()
	{
		
		$sql="SELECT *FROM opciones WHERE estatus=1";

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