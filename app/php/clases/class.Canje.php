<?php 
/**
 * 
 */
class Canje 
{
	public $idproducto;
	public $idusuario;
	public $estatus;
	public $idtarjetalealtadasignacion;
	public $cantidad;
	public $db;
	public $idcanje;


	public function BuscarCanjeProceso()
	{
		$sql="SELECT *FROM canje
			inner JOIN carrito_canje on canje.idcanje=carrito_canje.idcanje
		 WHERE idtarjetalealtadasignacion='$this->idtarjetalealtadasignacion'  ";

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

	public function BuscarCanjePendiente()
	{
		$sql="SELECT *FROM canje WHERE idtarjetalealtadasignacion='$this->idtarjetalealtadasignacion' AND idproducto='$this->idproducto' AND estatus=0";

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

	public function GuardarCanje()
	{
		$sql="INSERT INTO canje( idusuario, idproducto, cantidad, idtarjetalealtadasignacion, estatus) VALUES ( '$this->idusuario', '$this->idproducto','$this->cantidad', '$this->idtarjetalealtadasignacion',0)";
		
			$resp=$this->db->consulta($sql);
			$this->idcanje=$this->db->id_ultimo($sql);
	}




	public function VerificarCanjeCompleto()
	{
		$sql="SELECT *FROM tarjetalealtadasignacion
			INNER JOIN tarjetalealtad ON tarjetalealtadasignacion.idtarjetalealta=tarjetalealtad.idtarjetalealta
		 WHERE idtarjetalealtadasignacion='$this->idtarjetalealtadasignacion'  ";

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

	public function GuardarCarritoCanje()
	{
		$sql="INSERT INTO carrito_canje(idcarrito, idcanje) VALUES ( '$this->idcarrito', '$this->idcanje')";
		
			$resp=$this->db->consulta($sql);
	}

	public function ActualizarCanjeTarjeta()
	{
		$sql="SELECT *FROM canje
			left join tarjetalealtadasignacion ON
			canje.idtarjetalealtadasignacion=tarjetalealtadasignacion.idtarjetalealtadasignacion
		 WHERE idcanje='$this->idcanje' ";
		 
		$resp=$this->db->consulta($sql);
		$cont = $this->db->num_rows($resp);


		$array=array();
		$contador=0;
		if ($cont>0) {

			while ($objeto=$this->db->fetch_object($resp)) {

					$this->CambiarEstatusCanje();
					$this->idtarjetalealtadasignacion=$objeto->idtarjetalealtadasignacion;
					$this->CambiarEstatusTarjeta();
			} 
		}
		
		return $array;
	}


	public function CambiarEstatusCanje()
	{
		$sql="UPDATE canje SET estatus=1 WHERE idcanje='$this->idcanje'";
		$resp=$this->db->consulta($sql);

	}

	public function CambiarEstatusTarjeta()
	{
		$sql="UPDATE tarjetalealtadasignacion SET estatus=1 WHERE idtarjetalealtadasignacion='$this->idtarjetalealtadasignacion'";
		$resp=$this->db->consulta($sql);
	}
	
}

 ?>