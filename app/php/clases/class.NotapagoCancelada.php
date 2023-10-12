<?php 
/**
 * 
 */
class NotapagoCancelada 
{

	public $db;

	public $foliocancelacion;
	public $idnotapagodescripcion;
	public $montocancelacion;
	public $motivocancelacion;
	public $estatus;
	public $idnotapagocancelada;
	public $idnotapago_descripcion;
	public $idnotapago;

	public function GuardarNotaCancelada()
	{
		try {

			$sql="
			INSERT INTO notapagocancelacion(foliocancelacion,  montocancelacion, motivocancelacion, estatus, idnotapagocancelada, idnotapago_descripcion, idnotapago) VALUES ('$this->foliocancelacion', '$this->montocancelacion', '$this->motivocancelacion','$this->estatus','$this->idnotapagocancelada','$this->idnotapago_descripcion', $this->idnotapago);

		";
		
		$resp=$this->db->consulta($sql);
		
			
		} catch (Exception $e) {
			echo $e;
		}
		

	}


}
 ?>