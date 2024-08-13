<?php 
/**
 * 
 */
class HistorialModificacion 
{
	
	public $idhistorialmodificacion;
	public $idusuario;
	public $preciomodificado;
	public $nuevoprecio;
	public $idcarrito;
	public $fecha;

	public function GuardarModificacion()
	{
		$sql="INSERT INTO historialmodificacionprecio( idusuario, preciomodificado, nuevoprecio, idcarrito) VALUES ( '$this->idusuario', '$this->preciomodificado','$this->nuevoprecio', '$this->idcarrito')";
		
		$resp=$this->db->consulta($sql);
		$this->idhistorialmodificacion=$this->db->id_ultimo();
	}

}
 ?>