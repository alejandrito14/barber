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
	public $orden;
	public $fechavigencia;
	public $idsucursal;
	//tarjeta regalo usuario
	public $idusuario;
	public $estatus;
	public $idpaquete;
	public $vigencia;
	public $imagenqr;
	public $idusuariorecibe;
	public $fechaaceptada;
	public $monto;
	public $nombre;
	public $idnotapagodescripcion;


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


	public function GuardarTarjetaregalousuario()
	{
		$sql="INSERT INTO tarjetaregalousuario( idusuario, estatus, idpaquete, vigencia, imagenqr, idusuariorecibe, fechaaceptada, monto, nombre,idnotapago_descripcion) VALUES ('$this->idusuario', 0, '$this->idpaquete','$this->vigencia', '$this->imagenqr', 0, '','$this->monto', '$this->nombre','$this->idnotapagodescripcion')";
		
		$resp = $this->db->consulta($sql);

	}
}


 ?>