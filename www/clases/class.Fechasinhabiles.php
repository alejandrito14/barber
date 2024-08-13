<?php

class Fechasinhabiles

{

	public $db;//objeto de la clase de conexcion

	

	public $idfechainhabil;
	public $fecha;
	public $estatus;
	public $idsucursal;



	public function ObtTodosfechainhabil()
	{
		$sql = "SELECT * FROM fechainhabil WHERE idsucursal='$this->idsucursal' ORDER by fecha asc";
		$resp = $this->db->consulta($sql);
		
		return $resp;
	}


	public function Obtenerfechainhabil()
	{
		$sql = "SELECT * FROM fechainhabil WHERE idfechainhabil=".$this->idfechainhabil."";
		
		
		$resp = $this->db->consulta($sql);
		
		return $resp;
	}
	

	
		//funcion para guardar fechainhabils
	
	public function Guarderfechainhabil()
	{
		$query="INSERT INTO 
		fechainhabil(fecha, estatus, idsucursal) VALUES ('$this->fecha', '$this->estatus', '$this->idsucursal')";
		
		
		$resp=$this->db->consulta($query);
		$this->idfechainhabil = $this->db->id_ultimo();
		
		
	}

		//funcion para modificar 
	public function ModificarFechasinhabil()
	{
		$query="UPDATE fechainhabil 
		SET fecha = '$this->fecha',
		 estatus = '$this->estatus', 
		 idsucursal = '$this->idsucursal' 
		WHERE idfechainhabil='$this->idfechainhabil'";
		
		$resp=$this->db->consulta($query);
	}


		public function obtenerFechas()
	{
		$sql="SELECT *FROM fechainhabil ";


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

	public function BorrarFechainhabil()
	{
		$query="DELETE FROM fechainhabil WHERE idfechainhabil='$this->idfechainhabil'";

		$resp=$this->db->consulta($query);
	}


	

}

?>