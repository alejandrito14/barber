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
	public $idcortesia;
	public $colococortesia;
	public $fechacortesia;
	public $fechacreacion;
	public $codigocupon;
	public $montocupon;
	public $idcupon;

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
			paquetes.concortesia,
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
			carrito.idpaquete,
			carrito.colococortesia,
			(SELECT  CONCAT(usuarios.nombre,' ',usuarios.paterno) FROM especialista INNER JOIN usuarios on usuarios.idusuarios=especialista.idusuarios where especialista.idespecialista=citaapartado.idespecialista ) as usuarioespecialista,
			DATE_FORMAT(citaapartado.fecha,'%d-%m-%Y')as fecha,
			citaapartado.horainicial,
			carrito.idcortesia,
			paquetecortesia.nombrepaquete as nombrepaquetecortesia
			
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
			left join cortesia 
			ON carrito.idcortesia=cortesia.idcortesia
			left join paquetes as paquetecortesia on paquetecortesia.idpaquete=cortesia.idpaquetecortesia
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

	public function ActualizarCarritoCosto()
	{
		$sql="UPDATE carrito 
		SET costototal='$this->costototal',
		costounitario='$this->costounitario',
		cantidad='$this->cantidad'
		WHERE idcarrito='$this->idcarrito'";
		
		$resp=$this->db->consulta($sql);
	}

	public function ActualizarIdUsuarioCarrito(){
			$sql="UPDATE carrito 
		SET idusuarios='$this->idusuarios'
		WHERE idcarrito='$this->idcarrito'";
		
		$resp=$this->db->consulta($sql);


	}
	 public function ActualizarIdusuarioCita(){

	 	$sql="UPDATE citaapartado 
		SET idusuario='$this->idusuarios'
		WHERE idcitaapartado='$this->idcitaapartada'";
		
		$resp=$this->db->consulta($sql);

	 }

	 public function GuardarCortesiaCarrito()
	 {
	 	$sql="UPDATE carrito 
		SET idcortesia='$this->idcortesia',
		colococortesia='$this->colococortesia',
		fechacortesia='$this->fechacortesia'
		WHERE idcarrito='$this->idcarrito'";
		
		$resp=$this->db->consulta($sql);
	 }

	 public function ObtenerCarritoAnterior()
	 {
	 	$sql="
			SELECT
			carrito.idcarrito,
			paquetes.nombrepaquete,
			paquetes.foto,
			paquetes.concortesia,
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
			carrito.idpaquete,
			carrito.fechacreacion,
			carrito.colococortesia,
			(SELECT  CONCAT(usuarios.nombre,' ',usuarios.paterno) FROM especialista INNER JOIN usuarios on usuarios.idusuarios=especialista.idusuarios where especialista.idespecialista=citaapartado.idespecialista ) as usuarioespecialista,
			DATE_FORMAT(citaapartado.fecha,'%d-%m-%Y')as fecha,
			citaapartado.horainicial,
			carrito.idcortesia,
			paquetecortesia.nombrepaquete as nombrepaquetecortesia
			
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
			left join cortesia 
			ON carrito.idcortesia=cortesia.idcortesia
			left join paquetes as paquetecortesia on paquetecortesia.idpaquete=cortesia.idpaquetecortesia
			WHERE carrito.idusuarios='$this->idusuarios' AND carrito.estatus=1  fechacreacion<='$this->fechacreacion' ORDER BY sucursal.idsucursal 

				

		";
		echo $sql;die();
		
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

	 public function ActualizarValoresCarrito()
	 {
	 	$sql="UPDATE carrito 
		SET codigocupon='',
		montocupon=0,
		idcupon=0,
		montomonedero=0
		WHERE idcarrito='$this->idcarrito'";
		
		$resp=$this->db->consulta($sql);
	 }


	  public function ActualizarValoresCarritoCupon()
	 {
	 	$sql="UPDATE carrito 
		SET codigocupon='$this->codigocupon',
		montocupon='$this->montocupon',
		idcupon='$this->idcupon',

		WHERE idcarrito='$this->idcarrito'";
		
		$resp=$this->db->consulta($sql);
	 }

}
 ?>