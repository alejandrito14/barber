<?php 

/**
 * 
 */
class CategoriaPaquete
{

	public $idcategoriapaquete;
	public $nombre;
	public $foto;
	public $iddepende;
	public $db;

	public function ObtenerCategoriaPaquete()
	{
		$sql="
			SELECT *,
			(SELECT COUNT(*) FROM categoriapaquete as sub WHERE sub.iddepende=categoriapaquete.idcategoriapaquete ) as sub

			FROM categoriapaquete WHERE estatus=1 AND iddepende=0
		";

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

	public function ObtSubcategorias()
	{
		$sql="
			SELECT *,
			(SELECT COUNT(*) FROM categoriapaquete as sub WHERE sub.iddepende=categoriapaquete.idcategoriapaquete) as sub

			FROM categoriapaquete WHERE estatus=1 AND iddepende='$this->iddepende' ORDER BY orden ASC
		";

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
	

	public function ObtenerCategoriapadre()
	{
		$sql="
			SELECT *
			FROM categoriapaquete WHERE idcategoriapaquete='$this->iddepende'
		";

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



	public function ObtenerCategoria()
	{
		$sql="
			SELECT *
			FROM categoriapaquete WHERE idcategoriapaquete='$this->idcategoriapaquete'
		";

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
	

		public function ObtenerCantidadCategoriaPaquete()
	{
		$sql="
			SELECT COUNT(*)as cantidad
			
			FROM categoriapaquete WHERE estatus=1 AND iddepende=0
		";

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


	public function ObtenerCategoriaPaqueteLimit($inicio,$cantidad)
	{
		$limite="";
		
		if($inicio!=-1) {
			
			$limite=" LIMIT $inicio,$cantidad";
		}
		$sql="
			SELECT *,
			(SELECT COUNT(*) FROM categoriapaquete as sub WHERE sub.iddepende=categoriapaquete.idcategoriapaquete ) as sub

			FROM categoriapaquete WHERE estatus=1 AND iddepende=0

			$limite
		";


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

public function ObtenerCategoriaPaqueteTotal()
	{
		
		$sql="
			SELECT *,
			(SELECT COUNT(*) FROM categoriapaquete as sub WHERE sub.iddepende=categoriapaquete.idcategoriapaquete ) as sub

			FROM categoriapaquete WHERE estatus=1 AND iddepende=0
		";


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

	public function ObtenerCategoriaLimit($inicio,$cantidad)
	{
		$sql="
			SELECT *
			FROM categoriapaquete WHERE iddepende='$this->iddepende' AND estatus=1 LIMIT $inicio,  $cantidad
		";
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



public function ObtenerTodas($inicio,$cantidad)
	{
		$sql="
			SELECT *
			FROM categoriapaquete WHERE iddepende='$this->iddepende' AND estatus=1
		";
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