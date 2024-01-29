<?php 
/**
 * 
 */
class Imagencitacomentario
{
	public $db;
	public $idimagencita;
	public $foto;
	public $descripcion;
	public $estatus;
	public $fechacreacion;
	public $idcita;
	public $idusuario;
	public $comentario;
	public $idusuarioperfil;

	public function GuardarImagen()
	{
		
		$sql="INSERT INTO imagencitacomentario(foto, estatus,idcita,comentario,idusuarioregistro) VALUES ('$this->foto',1, '$this->idcita','$this->comentario','$this->idusuario')";
				$resp=$this->db->consulta($sql);
		$this->idimagencita = $this->db->id_ultimo();

	}

	public function modificarImagen()
	{
			$sql="
			UPDATE imagencita SET
				 foto = '$this->foto',
				 comentario='$this->comentario',
				 idusuarioregistro='$this->idusuario' 
				 WHERE idimagencita = '$this->idimagencita'
		";
		$resp=$this->db->consulta($sql);
	}

	public function obtenerImagen()
	{
		$sql="SELECT *FROM imagencitacomentario  WHERE idimagencitacomentario = '$this->idimagencita' ";


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

	public function EliminarImagenCita()
	{
		$sql="DELETE FROM imagencitacomentario 
				 WHERE idimagencitacomentario = '$this->idimagencita'
		";
		$resp=$this->db->consulta($sql);
	}


	public function obtenerImagenes()
	{
		$sql="SELECT *FROM imagencitacomentario ORDER BY idimagencitacomentario ";


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

	public function ObtenerImagenesCitacomentario()
	{
		//$sql="SELECT *FROM imagencitacomentario WHERE idcita='$this->idcita' ORDER BY idimagencitacomentario ";

		$sql="SELECT imagencitacomentario.*,CONCAT(usuarios.nombre,' ',usuarios.paterno) as nombreusuario FROM imagencitacomentario 
			LEFT JOIN usuarios on usuarios.idusuarios=imagencitacomentario.idusuarioregistro 
			JOIN citas
			ON imagencitacomentario.idcita = citas.idcita 
			JOIN usuarios as u
			ON citas.idusuarios = u.idusuarios
			WHERE u.idusuarios='$this->idusuarioperfil'
			ORDER BY idimagencitacomentario";


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