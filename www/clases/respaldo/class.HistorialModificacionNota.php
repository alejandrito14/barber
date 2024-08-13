<?php 
/**
 * 
 */
class HistorialModificacionNota
{
	
	public $idhistorialmodificacion;
	public $idusuario;
	public $preciomodificado;
	public $nuevoprecio;
	public $idnopagodescripcion;
	public $fecha;

	public function GuardarModificacion()
	{
		$sql="INSERT INTO historialmodificacionprecionota( idusuario, preciomodificado, nuevoprecio, idnopagodescripcion) VALUES ( '$this->idusuario', '$this->preciomodificado','$this->nuevoprecio', '$this->idnopagodescripcion')";
		
		$resp=$this->db->consulta($sql);
		$this->idhistorialmodificacion=$this->db->id_ultimo();
	}

}
 ?>