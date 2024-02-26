<?php 
/**
 * 
 */
class Temporalcarrito 
{
	
	public $db;
	public $idtemporalcarrito;
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
	public $montomonedero;
	public $idnota;
	public $idnotadescripcion;
	public $fecha;
	public $horainicial;
	public $horafinal;


	public function AgregarTemporalCarrito()
	{
		$sql="INSERT INTO temporalcarrito( idpaquete, cantidad, costounitario, costototal, idsucursal, idespecialista, idcitaapartada, nombrepaquete, estatus,titulosgrupos,idnota,idnotadescripcion,fecha,horainicial,horafinal) VALUES ( '$this->idpaquete',$this->cantidad,'$this->costounitario','$this->costototal','$this->idsucursal','$this->idespecialista','$this->idcita', '$this->nombrepaquete', 1,'$this->titulosgrupos','$this->idnota','$this->idnotadescripcion','$this->fecha','$this->horainicial','$this->horafinal')";
		//echo $sql;die();
		$resp=$this->db->consulta($sql);
		$this->idtemporalcarrito=$this->db->id_ultimo();
	}

	public function AgregarTemporalCarrito2($value='')
	{
		$sql="INSERT INTO temporalcarrito( idpaquete, cantidad, costounitario, costototal, idsucursal, idespecialista, idcitaapartada, nombrepaquete, estatus,titulosgrupos,idnota,idnotadescripcion) VALUES ( '$this->idpaquete',$this->cantidad,'$this->costounitario','$this->costototal','$this->idsucursal','$this->idespecialista','$this->idcita', '$this->nombrepaquete', 1,'$this->titulosgrupos','$this->idnota','$this->idnotadescripcion')";
		
		$resp=$this->db->consulta($sql);
		$this->idtemporalcarrito=$this->db->id_ultimo();
	}


	public function Ediciontemporal($value='')
	{
		$sql="UPDATE temporalcarrito 
		SET idpaquete='$this->idpaquete',
		nombrepaquete='$this->nombrepaquete',
		costounitario='$this->costounitario',
		costototal='$this->costototal'
		WHERE idtemporalcarrito='$this->idtemporalcarrito'";
		
		$resp=$this->db->consulta($sql);

	}

	public function ObtenerTemporalCarrito()
	{
		$sql="
			SELECT
	temporalcarrito.idtemporalcarrito,
	temporalcarrito.idcarrito,
	paquetes.nombrepaquete,
	paquetes.foto,
	paquetes.concortesia,
	paquetes.servicio,
	paquetes.foto,
	paquetes.tarjetaregalo,
	paquetes.fechavigencia,
	paquetes.montomonedero AS montoregalo,
	temporalcarrito.cantidad,
	temporalcarrito.costounitario,
	temporalcarrito.costototal,
	temporalcarrito.idsucursal,
	sucursal.titulo,
	temporalcarrito.idusuarios,
	temporalcarrito.idespecialista,
	temporalcarrito.titulosgrupos,
	temporalcarrito.idpaquete,
	temporalcarrito.montomonedero,
	temporalcarrito.montocupon,
	temporalcarrito.idcupon,
	temporalcarrito.codigocupon,
	temporalcarrito.colococortesia,
	(
	SELECT
		CONCAT( usuarios.nombre, ' ', usuarios.paterno ) 
	FROM
		especialista
		INNER JOIN usuarios ON usuarios.idusuarios = especialista.idusuarios 
	WHERE
		especialista.idespecialista = temporalcarrito.idespecialista 
	) AS usuarioespecialista,
	DATE_FORMAT( temporalcarrito.fecha, '%d-%m-%Y' ) AS fecha,
	temporalcarrito.horainicial,
	temporalcarrito.horafinal,
	temporalcarrito.fecha as fechacita,
	temporalcarrito.idcitaapartada,
	temporalcarrito.idcortesia,
	paquetecortesia.nombrepaquete AS nombrepaquetecortesia,
	categoriapaquete.idcategoriapaquete,

	categoriapaquete.nombre AS titulo,
	paquetes.intervaloservicio,
		temporalcarrito.idnotadescripcion

 
FROM
	temporalcarrito
	JOIN paquetes ON temporalcarrito.idpaquete = paquetes.idpaquete

	LEFT JOIN categoriapaquete ON paquetes.idcategoriapaquete = categoriapaquete.idcategoriapaquete 
	JOIN sucursal ON sucursal.idsucursal = temporalcarrito.idsucursal
	LEFT JOIN especialista ON temporalcarrito.idespecialista = especialista.idespecialista
	LEFT JOIN usuarios ON usuarios.idusuarios = especialista.idusuarios
	LEFT JOIN citas ON citas.idcita = temporalcarrito.idcitaapartada
	LEFT JOIN cortesia ON temporalcarrito.idcortesia = cortesia.idcortesia
	LEFT JOIN paquetes AS paquetecortesia ON paquetecortesia.idpaquete = cortesia.idpaquetecortesia 
		WHERE
			
		temporalcarrito.idnota='$this->idnota'

	
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
		idcupon='$this->idcupon'
		WHERE idcarrito='$this->idcarrito'";
		$resp=$this->db->consulta($sql);
	 }

	  public function GuardarMonederoCarrito()
	 {
	 	$sql="UPDATE carrito 
		SET montomonedero='$this->montomonedero'
		WHERE idcarrito='$this->idcarrito'";
		
		$resp=$this->db->consulta($sql);
	 }




	public function BuscarPaqueteCarrito()
	{
		$sql="
			SELECT
			carrito.idcarrito,
			paquetes.nombrepaquete,
			paquetes.foto,
			paquetes.servicio,
			preciopaquete.precio as precioventa,
			carrito.cantidad,
			carrito.costounitario,
			carrito.costototal,
			carrito.idusuarios,
			carrito.idpaquete,
			carrito.montomonedero	


			FROM
			carrito
			JOIN paquetes
			ON carrito.idpaquete = paquetes.idpaquete 
			JOIN paquetesucursal
			ON paquetes.idpaquete = paquetesucursal.idpaquete
			JOIN preciopaquete
			ON paquetes.idpaquete = preciopaquete.idpaquete
			JOIN precio
			ON precio.idprecio = preciopaquete.idprecio
			
		
			WHERE carrito.idusuarios='$this->idusuarios' AND carrito.idpaquete='$this->idpaquete' AND carrito.estatus=1 
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

	public function EliminarCarrito()
	{

		$sql="DELETE FROM carrito WHERE idusuarios='$this->idusuarios'";
		
		$resp=$this->db->consulta($sql);
	}



	public function ActualizarMonederoUsadoCarrito()
	{
			$sql="UPDATE carrito 
		SET montomonedero='$this->monederousado'
		WHERE idcarrito='$this->idcarrito'";
		
		$resp=$this->db->consulta($sql);
	}


	public function GuardarNuevoMonto()
	{
		$sql="UPDATE carrito 
		SET costounitario='$this->costounitario',
		costototal='$this->costototal',
		cantidad='$this->cantidad'
		WHERE idcarrito='$this->idcarrito'";
		
		$resp=$this->db->consulta($sql);
	}

	public function EliminarCarritoTemporal()
	{
		$sql="DELETE FROM temporalcarrito WHERE idnota='$this->idnota'";
		
		$resp=$this->db->consulta($sql);
	}

	public function EdicionTemporalCarrito()
	{
		$sql="
			UPDATE temporalcarrito SET idcarrito = 0, 
			    idusuarios = 0, 
			    idpaquete = '$this->idpaquete', 
			    cantidad = 1, costounitario = '$this->costounitario', costototal = '$this->costototal', idespecialista = '$this->idespecialista', nombrepaquete= '$this->concepto',  
			    fecha = '$this->fecha', 
			    horainicial = '$this->horainicial', 
			    horafinal = '$this->horafinal' WHERE 
			    idtemporalcarrito = '$this->idtemporalcarrito';
		";
		
		$resp=$this->db->consulta($sql);
	}

	public function EliminarElemento()
	{
		

		$sql="DELETE FROM temporalcarrito WHERE idtemporalcarrito='$this->idtemporalcarrito'";
		
		$resp=$this->db->consulta($sql);

	}

}
 ?>