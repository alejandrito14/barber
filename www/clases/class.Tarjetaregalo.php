<?php 
/**
 * 
 */
class Tarjetaregalo
{
	
	public $db;
	public $idtarjetaregalo;
	public $nombretarjeta;
	public $descripcion;
	public $tipodescuento;
	public $cantidad;
	public $montodescuento;
	public $linkgenerado;
	public $estatus;
	public $orden;
	public $fechavigencia;
	public $idsucursal;


	public function ObtenerTodosTarjetaregalo()
	{

		$query="SELECT * FROM tarjetaregalo ";
		
		$resp=$this->db->consulta($query);
		
		//echo $total;
		return $resp;
	}


	public function ObtenerUltimoOrdentarjetaregalo()
	{
		
		$query="SELECT MAX(orden) as ordenar FROM tarjetaregalo";

		$resp=$this->db->consulta($query);
		
		//echo $total;
		return $resp;
	}


	public function buscartarjetaregalo()
	{
		
		$query = "SELECT *
			FROM 
			tarjetaregalo WHERE idtarjetaregalo=".$this->idtarjetaregalo."";
			
		$result = $this->db->consulta($query);
		return $result;
	}


	public function guardarTarjetaregalo()
	{
	
		$sql="INSERT INTO tarjetaregalo(nombretarjeta, descripcion, tipodescuento, montodescuento, estatus,orden,fechavigencia) VALUES ( '$this->nombretarjeta', '$this->descripcion','$this->tipodescuento','$this->montodescuento','$this->estatus','$this->orden','$this->fechavigencia','$this->idsucursal')";
		
		$resp = $this->db->consulta($sql);
		$this->idtarjetaregalo = $this->db->id_ultimo();

	}

	public function modificarTarjetaregalo()
	{
		$sql="UPDATE tarjetaregalo 
		SET nombretarjeta = '$this->nombretarjeta', 
			descripcion = '$this->descripcion', 
			tipodescuento = '$this->tipodescuento', 
			montodescuento = '$this->montodescuento', 
			estatus = '$this->estatus', 
			orden = '$this->orden',
			fechavigencia='$this->fechavigencia',
			idsucursal='$this->idsucursal' 
			WHERE idtarjetaregalo='$this->idtarjetaregalo' ";
		$resp = $this->db->consulta($sql);
		
	}
}


 ?>