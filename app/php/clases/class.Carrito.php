<?php 
/**
 * 
 */
class Carrito 
{
	
	public $db;
	public $idcarrito;
	public $idusuarios;
	public $idpaquete;
	public $cantidad;
	public $costounitario;
	public $costototal;
	public $idsucursal;
	public $idespecialista;
	public $idcitaapartada;
	public $nombrepaquete;
	public $estatus;
	public $titulosgrupos;
	public $preciooriginal;

	public function AgregarCarrito()
	{
		$sql="INSERT INTO carrito(idusuarios, idpaquete, cantidad, costounitario, costototal, idsucursal, idespecialista, idcitaapartada, nombrepaquete, estatus,titulosgrupos) VALUES ('$this->idusuarios', '$this->idpaquete',$this->cantidad,'$this->costounitario','$this->costototal','$this->idsucursal','$this->idespecialista','$this->idcitaapartada', '$this->nombrepaquete', 1,'$this->titulosgrupos')";

		$resp=$this->db->consulta($sql);

	}


	public function ObtenerCarrito()
	{
		$sql="
			SELECT
			carrito.idcarrito,
			paquetes.nombrepaquete,
			paquetes.foto,
			paquetes.servicio,
			carrito.cantidad,
			carrito.costounitario,
			carrito.costototal,
			carrito.idsucursal,
			sucursal.titulo,
			carrito.idusuarios,
			carrito.idcitaapartada,
			carrito.idespecialista,
			carrito.titulosgrupos,
			carrito.idpaquete
			/*usuarios.nombre,
			usuarios.paterno,
			carrito.idcitaapartada,
			carrito.estatus,
			carrito.idpaquete,
			carrito.idcarrito*/
			FROM
			carrito
			JOIN paquetes
			ON carrito.idpaquete = paquetes.idpaquete 
			JOIN sucursal
			ON sucursal.idsucursal = carrito.idsucursal 
			left JOIN especialista
			ON carrito.idespecialista = especialista.idespecialista 
			left JOIN usuarios
			ON usuarios.idusuarios = especialista.idusuarios 
			left JOIN citaapartado
			ON citaapartado.idcitaapartado = carrito.idcitaapartada
			WHERE carrito.idusuarios='$this->idusuarios' AND carrito.estatus=1 ORDER BY sucursal.idsucursal

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


	public function BorrardelCarrito()
	{
		$sql="DELETE FROM carrito WHERE idcarrito='$this->idcarrito'";

		$resp=$this->db->consulta($sql);

	}


	public function ObtenerDelCarrito()
	{
		$sql="SELECT *FROM carrito WHERE idcarrito='$this->idcarrito'";
		
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

	public function ActualizarTotal()
	{
		$sql="UPDATE carrito 
		SET costototal='$this->costototal',
		cantidad='$this->cantidad'
		WHERE idcarrito='$this->idcarrito'";
		
		$resp=$this->db->consulta($sql);
	}

	public function ActualizarEstatusCarrito()
	{
		$sql="UPDATE carrito 
		SET estatus='$this->estatus'
		WHERE idcarrito='$this->idcarrito'";
		
		$resp=$this->db->consulta($sql);
	}

}
 ?>