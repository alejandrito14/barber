<?php 
/**
 * 
 */
class Especialista 
{
	
	public $db;
	public $idsucursal;
	public $idespecialista;
	public $costo;
	public $idpaquete;

	public function ObtenerEspecialistaSucursal()
	{
		$sql="SELECT *FROM especialista
		INNER JOIN usuarios ON especialista.idusuarios = usuarios.idusuarios 
		WHERE idsucursal ='$this->idsucursal'";
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


	public function GuardarEspecialistaPaquete()
	{
		$query="INSERT INTO paquetes_especialista (idpaquete,idespecialista,costo) VALUES ('$this->idpaquete','$this->idespecialista','$this->costo')";
		
		$resp=$this->db->consulta($query);
	}

	public function ObtenerEspecialistaPaquete()
	{
		$sql="SELECT *FROM paquetes_especialista
		INNER JOIN especialista ON especialista.idespecialista = paquetes_especialista.idespecialista 
		WHERE idpaquete ='$this->idpaquete'";
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

	public function EliminarEspecialistaPaquete()
	{
		$query="DELETE FROM paquetes_especialista WHERE idpaquete='$this->idpaquete'";
		
		$resp=$this->db->consulta($query);
	}

}

 ?>