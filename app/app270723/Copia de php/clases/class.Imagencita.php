<?php 
/**
 * 
 */
class Imagencita 
{
	public $db;
	public $idimagencita;
	public $foto;
	public $descripcion;
	public $estatus;
	public $fechacreacion;
	public $idcita;
	public $idusuario;

	public function GuardarImagen()
	{
		
		$sql="INSERT INTO imagencita(foto, estatus,idcita) VALUES ('$this->foto',1, '$this->idcita')";
				$resp=$this->db->consulta($sql);
		$this->idimagencita = $this->db->id_ultimo();

	}

	public function modificarImagen()
	{
			$sql="
			UPDATE imagencita SET
				 foto = '$this->foto' 
				 WHERE idimagencita = '$this->idimagencita'
		";
		$resp=$this->db->consulta($sql);
	}

	public function obtenerImagen()
	{
		$sql="SELECT *FROM imagencita  WHERE idimagencita = '$this->idimagencita' ";


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

	public function EliminarImagenGrupal()
	{
		$sql="DELETE FROM imagencita 
				 WHERE idimagencita = '$this->idimagencita'
		";
		$resp=$this->db->consulta($sql);
	}


	public function obtenerImagenes()
	{
		$sql="SELECT *FROM imagencita ORDER BY idimagencita ";


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

	public function ObtenerImagenesCita()
	{
		$sql="SELECT *FROM imagencita WHERE idcita='$this->idcita' ORDER BY idimagencita ";


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