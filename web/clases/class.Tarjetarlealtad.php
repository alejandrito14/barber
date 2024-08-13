<?php 
/**
 * 
 */
class Tarjetaregalo
{
	
	public $db;
	public $idtarjetalealtad;
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

		$query="SELECT
				paquetes.nombrepaquete,
				tarjetaregalousuario.idtarjetaregalousuario,
				tarjetaregalousuario.idusuario,
				tarjetaregalousuario.estatus,
				tarjetaregalousuario.fecha,
				tarjetaregalousuario.idpaquete,
				tarjetaregalousuario.vigencia,
				tarjetaregalousuario.imagenqr,
				tarjetaregalousuario.idusuariorecibe,
				tarjetaregalousuario.fechaaceptada,
				tarjetaregalousuario.monto,
				tarjetaregalousuario.nombre,
				tarjetaregalousuario.idnotapago_descripcion,
				usuarios.nombre AS nombreusuario,
				usuarios.paterno,
				usuarios.materno
				FROM
				paquetes
				JOIN tarjetaregalousuario
				ON paquetes.idpaquete = tarjetaregalousuario.idpaquete 
				JOIN usuarios
				ON usuarios.idusuarios = tarjetaregalousuario.idusuario
				join paquetesucursal
				on paquetes.idpaquete=paquetes.idpaquete
				WHERE paquetesucursal.idsucursal='$this->idsucursal' GROUP BY idsucursal,idtarjetaregalousuario='$this->idsucursal'  

		";
		
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



	public function ObtenerTarjetaregalo()
	{

		$query="SELECT
				paquetes.nombrepaquete,
				tarjetaregalousuario.idtarjetaregalousuario,
				tarjetaregalousuario.idusuario,
				tarjetaregalousuario.estatus,
				tarjetaregalousuario.fecha,
				tarjetaregalousuario.idpaquete,
				tarjetaregalousuario.vigencia,
				tarjetaregalousuario.imagenqr,
				tarjetaregalousuario.idusuariorecibe,
				tarjetaregalousuario.fechaaceptada,
				tarjetaregalousuario.monto,
				tarjetaregalousuario.nombre,
				tarjetaregalousuario.idnotapago_descripcion,
				usuarios.nombre AS nombreusuario,
				usuarios.paterno,
				usuarios.materno,
				paquetes.descripcion
				FROM
				paquetes
				JOIN tarjetaregalousuario
				ON paquetes.idpaquete = tarjetaregalousuario.idpaquete 
				JOIN usuarios
				ON usuarios.idusuarios = tarjetaregalousuario.idusuario  
				WHERE idtarjetaregalousuario='$this->idtarjetaregalo'

		";
		
		$resp=$this->db->consulta($query);
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


	public function GuardarCadenaQR()
	{
		$sql="UPDATE tarjetaregalousuario 
		SET imagenqr = '$this->imagenqr', 
			nombre = '$this->nombre'
			WHERE idtarjetaregalousuario='$this->idtarjetaregalo' ";
		$resp = $this->db->consulta($sql);
	}

}


 ?>