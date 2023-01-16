<?php 
/**
 * 
 */
class Cita 
{
	
	public $db;
	public $horacita;
	public $fechacita;
	public $estatus;
	public $orden;
	public $idusuarios;


	public function ObtenerCitasUsuario()
	{
		$sql="SELECT 
			citas.horacita,
			citas.fechacita,
			citas.asuntocita,
			citas.estatus,
			citas.orden,
			usuarios_citas.idusuarios,
			citas.idsucursal,
			sucursal.titulo,
			sucursal.descripcion,
			sucursal.imagen
		FROM usuarios_citas
		INNER JOIN citas ON usuarios_citas.idcita=citas.idcita
		INNER JOIN sucursal ON sucursal.idsucursal=citas.idsucursal
		 WHERE idusuarios=".$this->idusuarios."";


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