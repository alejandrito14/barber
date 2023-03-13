<?php 
/**
 * 
 */
class Especialista 
{
	
	public $db;
	public $idsucursal;
	public $idusuarios;

	public $idpaquete;

	public function ObtenerEspecialistas()
	{
		$sql = "SELECT 
				usuarios.nombre,
				usuarios.idusuarios,
				usuarios.paterno,
				usuarios.materno,
				paquetes_especialista.idespecialista,
				paquetes_especialista.idpaquete,
				especialista.idsucursal
			FROM especialista
			left JOIN sucursal ON especialista.idsucursal=sucursal.idsucursal
			left join usuarios on especialista.idusuarios=usuarios.idusuarios
			left JOIN paquetes_especialista ON especialista.idespecialista=paquetes_especialista.idespecialista

		 WHERE usuarios.estatus=1 AND paquetes_especialista.idpaquete='$this->idpaquete' AND sucursal.idsucursal='$this->idsucursal'";

		
			$resp = $this->db->consulta($sql);
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


	public function ObtenerCosto()
	{
			$sql="SELECT *FROM paquetes_especialista
			WHERE idespecialista='$this->idespecialista' AND idpaquete='$this->idpaquete'";
			$resp = $this->db->consulta($sql);
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