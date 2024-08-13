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
	public $horainicial;
	public $horafinal;

	public $idcitaapartado;

	public $idsucursal;
	public $idpaquete;
	public $idespecialista;
	public $fecha;
	public $idusuario;
	public $idcita;
	public $costo;
	public $qrgenerado;
	public $idusuariocheckin;
	public $idcortesia;

	public $horainicials;
	public $horafinals;


	public function ObtenerCitasUsuario()
	{
		$fechactual=date('Y-m-d');
		$sql="

		SELECT *FROM (
		SELECT 
			citas.horacita,
			citas.fechacita,
			citas.asuntocita,
			citas.estatus,
			citas.orden,
			citas.idsucursal,
			sucursal.titulo,
			sucursal.descripcion,
			sucursal.imagen,
			citas.idusuarios,
			citas.idcita,
			citas.checkin,
			citas.fechacheckin,

			CONCAT(usuarios.nombre,' ',usuarios.paterno) AS nombreespecialista
		FROM citas INNER JOIN  especialista ON especialista.idespecialista=citas.idespecialista
		INNER JOIN usuarios ON usuarios.idusuarios=especialista.idusuarios
		INNER JOIN sucursal ON sucursal.idsucursal=citas.idsucursal WHERE fechacita BETWEEN (SELECT CURDATE()) AND (DATE_ADD(CURDATE(), INTERVAL 6 MONTH)) AND citas.idusuarios=".$this->idusuarios."

		UNION
		
		SELECT 
			citas.horacita,
			citas.fechacita,
			citas.asuntocita,
			citas.estatus,
			citas.orden,
			citas.idsucursal,
			sucursal.titulo,
			sucursal.descripcion,
			sucursal.imagen,
			citas.idusuarios,
			citas.idcita,
			citas.checkin,
			citas.fechacheckin,
			CONCAT(usuarios.nombre,' ',usuarios.paterno) AS nombreespecialista
		FROM citas INNER JOIN  especialista ON especialista.idespecialista=citas.idespecialista
		INNER JOIN usuarios ON usuarios.idusuarios=especialista.idusuarios
		INNER JOIN sucursal ON sucursal.idsucursal=citas.idsucursal WHERE citas.idusuarios=".$this->idusuarios." AND  fechacita < '$fechactual' ORDER BY fechacita desc
		) AS tabla ";
		/*$sql="SELECT 
			citas.horacita,
			citas.fechacita,
			citas.asuntocita,
			citas.estatus,
			citas.orden,
			citas.idsucursal,
			sucursal.titulo,
			sucursal.descripcion,
			sucursal.imagen,
			citas.idusuarios,
			citas.idcita,
			citas.checkin,
			citas.fechacheckin,
			CONCAT(usuarios.nombre,' ',usuarios.paterno) AS nombreespecialista
		FROM citas INNER JOIN  especialista ON especialista.idespecialista=citas.idespecialista
		INNER JOIN usuarios ON usuarios.idusuarios=especialista.idusuarios
		INNER JOIN sucursal ON sucursal.idsucursal=citas.idsucursal
		 WHERE citas.idusuarios=".$this->idusuarios."";*/
		
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


	public function ChecarHorarioEspecialista()
	{
		
		$sql="SELECT *FROM citas WHERE idespecialista='$this->idespecialista' AND horainicial='$this->horainicial' AND horafinal='$this->horafinal'";
		
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

	public function GuardarCitaApartado()
	{
		try {

			$sql="INSERT INTO citaapartado( horainicial, horafinal, idsucursal, idpaquete, idespecialista, fecha, estatus, idusuario,horains,horafs) VALUES ('$this->horainicial', '$this->horafinal',
				 '$this->idsucursal', '$this->idpaquete','$this->idespecialista','$this->fecha','$this->estatus','$this->idusuario','$this->horainicials','$this->horafinals')";
		
		$resp=$this->db->consulta($sql);
		$this->idcitaapartado=$this->db->id_ultimo();
		} catch (Exception $e) {
			echo $e;
			$this->db->roolback();
		}
		
		//$resp = $this->db->consulta($sql);

	}

	public function CitaCreada()
	{
		try {
			$sql="INSERT INTO citas(horacita, fechacita, asuntocita, estatus, orden,idsucursal, horainicial, horafinal, idpaquete, idespecialista, costo, idusuarios,horains,horafs) VALUES ( '$this->horacita','$this->fechacita','',$this->estatus, 0, '$this->idsucursal','$this->horainicial','$this->horafinal', '$this->idpaquete','$this->idespecialista','$this->costo','$this->idusuario','$this->horainicials','$this->horafinals')";
			
				$resp=$this->db->consulta($sql);
				$this->idcita=$this->db->id_ultimo();
		} catch (Exception $e) {
			echo $e;
		}
		
	}



	public function ObtenerCitaCreada()
	{
		$sql="SELECT 
			citaapartado.horainicial,
			citaapartado.fecha,
			citaapartado.estatus,
			citaapartado.idsucursal,
			sucursal.titulo,
			sucursal.descripcion,
			sucursal.imagen,
			usuarios.nombre,
			usuarios.paterno,
			citaapartado.idpaquete,
			citaapartado.horafinal,
			citaapartado.idespecialista,
			citaapartado.idusuario,
			citaapartado.costo,
			citaapartado.horains,
			citaapartado.horafs
		FROM citaapartado
		INNER JOIN sucursal ON sucursal.idsucursal=citaapartado.idsucursal
		INNER JOIN especialista ON citaapartado.idespecialista=especialista.idespecialista
		left join usuarios ON usuarios.idusuarios=especialista.idusuarios
		 WHERE 	citaapartado.idusuario='$this->idusuario' AND idcitaapartado='$this->idcitaapartado'";
		
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

	public function Obtenerdetallecita()
	{
		$sql="SELECT 
			citas.horainicial,
			citas.fechacita,
			citas.estatus,
			citas.idsucursal,
			sucursal.titulo,
			sucursal.descripcion,
			sucursal.imagen,
			sucursal.ubicacion,
			sucursal.celular,
			usuarios.nombre,
			usuarios.paterno,
			citas.idpaquete,
			citas.horafinal,
			citas.idespecialista,
			citas.idusuarios,
			citas.costo,
			citas.idcita,
			citas.checkin,
			citas.fechacheckin,
			(SELECT paquetes.nombrepaquete from paquetes WHERE paquetes.idpaquete=citas.idpaquete)as concepto


		FROM citas
		INNER JOIN sucursal ON sucursal.idsucursal=citas.idsucursal
		INNER JOIN especialista ON citas.idespecialista=especialista.idespecialista
		left join usuarios ON usuarios.idusuarios=especialista.idusuarios
		 WHERE 	citas.idusuarios='$this->idusuario' AND idcita='$this->idcita'";
		
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


	public function ObtenerCitasEspecialista($fechafiltro)
	{
		$sql="SELECT 
			citas.horacita,
			citas.horafinal,
			citas.fechacita,
			citas.asuntocita,
			citas.estatus,
			citas.orden,
			citas.idsucursal,
			sucursal.titulo,
			sucursal.descripcion,
			sucursal.imagen,
			citas.idusuarios,
			citas.idcita,
			citas.checkin,
			citas.fechacheckin,
			citas.finalizacita,
			CONCAT(usuarios.nombre,' ',usuarios.paterno) AS nombreespecialista
		FROM citas INNER JOIN  especialista ON especialista.idespecialista=citas.idespecialista
		INNER JOIN usuarios ON usuarios.idusuarios=citas.idusuarios
		INNER JOIN sucursal ON sucursal.idsucursal=citas.idsucursal
		 WHERE citas.idespecialista=".$this->idespecialista."";

		 if ($fechafiltro!='') {
		 	$sql.=" AND fechacita='".$fechafiltro."'";
		 }

		 $sql.=" ORDER BY horacita asc";
		
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



	public function ObtenerdetallecitaEspecialista()
	{
		$sql="SELECT 
			citas.horainicial,
			citas.horafinal,
			citas.fechacita,
			citas.estatus,
			citas.idsucursal,
			sucursal.titulo,
			sucursal.descripcion,
			sucursal.imagen,
			usuarios.nombre,
			usuarios.paterno,
			citas.idpaquete,
			citas.horafinal,
			citas.idespecialista,
			citas.idusuarios,
			citas.costo,
			citas.checkin,
			citas.fechacheckin,
			citas.finalizacita,
			citas.tiempotranscurrido,
			(SELECT paquetes.nombrepaquete from paquetes WHERE paquetes.idpaquete=citas.idpaquete)as concepto,

			(SELECT paquetes.servicio from paquetes WHERE paquetes.idpaquete=citas.idpaquete)as servicio,
			paquetecortesia.nombrepaquete as nombrepaquetecortesia


		FROM citas
		INNER JOIN sucursal ON sucursal.idsucursal=citas.idsucursal
		INNER JOIN especialista ON citas.idespecialista=especialista.idespecialista
		left join cortesia 
			ON citas.idcortesia=cortesia.idcortesia
		left join paquetes as paquetecortesia on paquetecortesia.idpaquete=citas.idcortesia
		left join usuarios ON usuarios.idusuarios=citas.idusuarios
		 WHERE 	citas.idespecialista='$this->idespecialista' AND idcita='$this->idcita'";
		
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

	public function ActualizarcitaQr()
	{
		 $sql = "UPDATE citas 
        SET estatus = 1,
        checkin=1,
        idqrgenerado='$this->qrgenerado',
        idusuariocheckin='$this->idusuariocheckin',
        fechacheckin='".date('Y-m-d H:i:s')."'
        WHERE idcita = '$this->idcita'
        AND idusuarios='$this->idusuarios'

        ";
        $this->db->consulta($sql);
	}

	public function ObtenerCitasAdmin()
	{
		$sql="SELECT 
			citas.horacita,
			citas.horafinal,
			citas.fechacita,
			citas.asuntocita,
			citas.estatus,
			citas.orden,
			citas.idsucursal,
			sucursal.titulo,
			sucursal.descripcion,
			sucursal.imagen,
			citas.idusuarios,
			citas.idcita,
			CONCAT(usuarios.nombre,' ',usuarios.paterno) AS nombreespecialista
		FROM citas INNER JOIN  especialista ON especialista.idespecialista=citas.idespecialista
		INNER JOIN usuarios ON usuarios.idusuarios=especialista.idusuarios
		INNER JOIN sucursal ON sucursal.idsucursal=citas.idsucursal
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

	public function ObtenerdetallecitaAdmin()
	{
		$sql="SELECT 
			citas.horainicial,
			citas.fechacita,
			citas.estatus,
			citas.idsucursal,
			sucursal.titulo,
			sucursal.descripcion,
			sucursal.imagen,
			sucursal.ubicacion,
			sucursal.celular,
			usuarios.celular as usuariocelular,
			usuarios.nombre,
			usuarios.paterno,
			citas.idpaquete,
			citas.horafinal,
			citas.idespecialista,
			citas.idusuarios,
			citas.costo,
			citas.idcita,
			citas.checkin,
			citas.checkout,
			citas.cancelacion,
			citas.fechacheckin,
			citas.idcortesia,
			citas.finalizacita,
			citas.horains,
			citas.horafs,
			(SELECT paquetes.nombrepaquete from paquetes WHERE paquetes.idpaquete=citas.idpaquete)as concepto,

			(SELECT paquetes.concortesia from paquetes WHERE paquetes.idpaquete=citas.idpaquete)as concortesia,

			(SELECT paquetes.servicio from paquetes WHERE paquetes.idpaquete=citas.idpaquete)as servicio,
			paquetecortesia.nombrepaquete as nombrepaquetecortesia



		FROM citas
		INNER JOIN sucursal ON sucursal.idsucursal=citas.idsucursal
		INNER JOIN especialista ON citas.idespecialista=especialista.idespecialista
		left join usuarios ON usuarios.idusuarios=citas.idusuarios
		left join cortesia 
			ON citas.idcortesia=cortesia.idcortesia
		left join paquetes as paquetecortesia on paquetecortesia.idpaquete=cortesia.idpaquetecortesia
		
		 WHERE 	 idcita='$this->idcita'";
		
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

	public function ObtenerCitas()
	{
		$sql="SELECT 
			citas.idcita,
			citas.horainicial,
			citas.horacita,
			citas.horains,
			citas.fechacita,
			citas.estatus,
			citas.idsucursal,
			sucursal.titulo,
			sucursal.descripcion,
			sucursal.imagen,
			usuarios.nombre,
			usuarios.paterno,
			citas.idpaquete,
			citas.horafinal,
			citas.idespecialista,
			citas.idusuarios,
			citas.costo,
			CONCAT(usuarios.nombre,' ',usuarios.paterno) AS nombreusuario,
			CONCAT(esp.nombre,' ',esp.paterno) AS nombreespecialista,
			paquetes.nombrepaquete,
			notapago.folio,
			notapago.idnotapago,
			notapago.estatus as estatusnota

		FROM citas
		INNER JOIN sucursal ON sucursal.idsucursal=citas.idsucursal
		INNER JOIN especialista ON citas.idespecialista=especialista.idespecialista
		left join usuarios ON usuarios.idusuarios=citas.idusuarios
		left join usuarios as esp on esp.idusuarios=especialista.idusuarios
		left join paquetes on citas.idpaquete=paquetes.idpaquete
		left join notapago_descripcion on citas.idcita=notapago_descripcion.idcita
		left JOIN notapago on notapago_descripcion.idnotapago=notapago.idnotapago

		 WHERE 	citas.idsucursal='$this->idsucursal'  GROUP BY idcita ORDER BY fechacita DESC";
		
		$resp=$this->db->consulta($sql);
		$cont = $this->db->num_rows($resp);


		return $resp;
	}

	public function ObtenerCitaEspecialista()
	{
		$sql="SELECT 
			citas.horacita,
			citas.fechacita,
			citas.asuntocita,
			citas.estatus,
			citas.horainicial,
			citas.orden,
			citas.idsucursal,
			sucursal.titulo,
			sucursal.descripcion,
			sucursal.imagen,
			citas.idusuarios,
			citas.idcita,
			CONCAT(usuarios.nombre,' ',usuarios.paterno) AS nombreespecialista
		FROM citas INNER JOIN  especialista ON especialista.idespecialista=citas.idespecialista
		INNER JOIN usuarios ON usuarios.idusuarios=especialista.idusuarios
		INNER JOIN sucursal ON sucursal.idsucursal=citas.idsucursal
		 WHERE citas.idespecialista=".$this->idespecialista." AND citas.idcita='$this->idcita'";
		
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



		public function ObtenerCitasNocheckin()
	{
		$sql="SELECT 
			citas.idcita,
			citas.horainicial,
			citas.horacita,
			citas.fechacita,
			citas.estatus,
			citas.idsucursal,
			sucursal.titulo,
			sucursal.descripcion,
			sucursal.imagen,
			usuarios.nombre,
			usuarios.paterno,
			citas.idpaquete,
			citas.horafinal,
			citas.idespecialista,
			citas.idusuarios,
			citas.costo,
			CONCAT(usuarios.nombre,' ',usuarios.paterno) AS nombreusuario,
			CONCAT(esp.nombre,' ',esp.paterno) AS nombreespecialista,
			paquetes.nombrepaquete,
			notapago.folio,
			notapago.idnotapago,
			citas.idsucursal

		FROM citas
		INNER JOIN sucursal ON sucursal.idsucursal=citas.idsucursal
		INNER JOIN especialista ON citas.idespecialista=especialista.idespecialista
		left join usuarios ON usuarios.idusuarios=citas.idusuarios
		left join usuarios as esp on esp.idusuarios=especialista.idusuarios
		left join paquetes on citas.idpaquete=paquetes.idpaquete
		left join notapago_descripcion on citas.idcita=notapago_descripcion.idcita
		left JOIN notapago on notapago_descripcion.idnotapago=notapago.idnotapago
		 WHERE 	 fechacita='$this->fecha' 	AND citas.estatus!=3  AND citas.idsucursal='$this->idsucursal' GROUP BY idcita ORDER BY idsucursal,fechacita,horainicial"; 
		
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

	public function EliminarCitaApartada()
	{
		
		 $sql = "DELETE FROM citaapartado
        WHERE idcitaapartado = '$this->idcitaapartado'
        ";

        $this->db->consulta($sql);
	}

	public function GuardarFinalizar()
	{
		$sql = "UPDATE citas 
        SET estatus = 2,
        finalizacita='".date('Y-m-d H:i:s')."'
        WHERE idcita = '$this->idcita'
        ";
        $this->db->consulta($sql);
        
	}


	public function ChecarHorarioFechaEspecialista()
	{
		
		/*$sql="SELECT *FROM citas WHERE idespecialista='$this->idespecialista' AND fechacita='$this->fechacita' AND horainicial='$this->horainicial' AND horafinal='$this->horafinal' ";*/

		$sql="SELECT *
			FROM citas
			WHERE idespecialista = '$this->idespecialista'
			  AND fechacita = '$this->fechacita'
			  AND ((horainicial < '$this->horafinal' AND horafinal > '$this->horainicial') OR (horainicial >= '$this->horainicial' AND horainicial < '$this->horafinal'))
			  AND estatus != 3";
	
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


	public function ObtenerCitasUsuarioFiltro($fechafiltro)
	{
		

		$sql="

		
		SELECT 
			citas.horacita,
			citas.fechacita,
			citas.asuntocita,
			citas.estatus,
			citas.orden,
			citas.idsucursal,
			sucursal.titulo,
			sucursal.descripcion,
			sucursal.imagen,
			citas.idusuarios,
			citas.idcita,
			citas.checkin,
			citas.fechacheckin,
			CONCAT(usuarios.nombre,' ',usuarios.paterno) AS nombreespecialista
		FROM citas INNER JOIN  especialista ON especialista.idespecialista=citas.idespecialista
		INNER JOIN usuarios ON usuarios.idusuarios=especialista.idusuarios
		INNER JOIN sucursal ON sucursal.idsucursal=citas.idsucursal WHERE citas.idusuarios=".$this->idusuarios." AND  fechacita = '$fechafiltro'  ORDER BY horacita desc
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

	public function ObtenerCita()
	{
		$sql=" 
			
		SELECT 
			citas.horacita,
			citas.fechacita,
			citas.asuntocita,
			citas.idpaquete,
			citas.orden,
			citas.idsucursal,
			sucursal.titulo,
			sucursal.descripcion,
			sucursal.imagen,
			citas.idusuarios,
			citas.idespecialista,
			citas.horainicial,
			citas.horafinal,
			citas.idcita,
			citas.checkin,
			citas.checkout,
			citas.fechacheckin,
			citas.cancelacion,
			citas.finalizacita,

			citas.estatus as estatuscita,
			CONCAT(usuarios.nombre,' ',usuarios.paterno) AS nombreusuario,
			usuarios.celular,
			DATE_FORMAT(citas.fechacita,'%Y-%m-%d')as fecha,
			CONCAT(esp.nombre,' ',esp.paterno) AS nombreespecialista,

			(SELECT paquetes.servicio from paquetes WHERE paquetes.idpaquete=citas.idpaquete)as servicio,
			paquetecortesia.nombrepaquete as nombrepaquetecortesia,
			citas.idcortesia,
			paquetes.nombrepaquete
		
		
		FROM citas INNER JOIN  especialista ON especialista.idespecialista=citas.idespecialista
		INNER JOIN usuarios ON usuarios.idusuarios=citas.idusuarios
		left join usuarios as esp on esp.idusuarios=especialista.idusuarios
		INNER JOIN sucursal ON sucursal.idsucursal=citas.idsucursal

		left join cortesia 
			ON citas.idcortesia=cortesia.idcortesia
		left join paquetes as paquetecortesia on paquetecortesia.idpaquete=cortesia.idpaquetecortesia
		JOIN paquetes
		ON citas.idpaquete = paquetes.idpaquete
		 WHERE citas.idcita='$this->idcita'";
		
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



	public function ObtenerCitasFechaEspecialista()
	{
		$sql="SELECT 
			citas.idcita,
			citas.horainicial,
			citas.horacita,
			citas.fechacita,
			citas.estatus,
			citas.idsucursal,
			sucursal.titulo,
			sucursal.descripcion,
			sucursal.imagen,
			usuarios.nombre,
			usuarios.paterno,
			citas.idpaquete,
			citas.horafinal,
			citas.idespecialista,
			citas.idusuarios,
			citas.costo,
			CONCAT(usuarios.nombre,' ',usuarios.paterno) AS nombreespecialista
		FROM citas
		INNER JOIN sucursal ON sucursal.idsucursal=citas.idsucursal
		INNER JOIN especialista ON citas.idespecialista=especialista.idespecialista
		left join usuarios ON usuarios.idusuarios=citas.idusuarios
		 WHERE 	 fechacita='$this->fechacita' AND sucursal.idsucursal IN($this->idsucursal) AND checkin IN (0,1) 
		 AND citas.idespecialista='$this->idespecialista'
		 ORDER BY idsucursal,fechacita,horainicial";
		
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


		public function ObtenerCitascheckin()
	{
		$sql="SELECT 
			citas.idcita,
			citas.horainicial,
			citas.horacita,
			citas.fechacita,
			citas.estatus,
			citas.idsucursal,
			sucursal.titulo,
			sucursal.descripcion,
			sucursal.imagen,
			usuarios.nombre,
			usuarios.paterno,
			citas.idpaquete,
			citas.horafinal,
			citas.idespecialista,
			citas.idusuarios,
			citas.costo,
			CONCAT(usuarios.nombre,' ',usuarios.paterno) AS nombreusuario,
			CONCAT(usuarios.nombre,' ',usuarios.paterno) AS nombreespecialista,
			paquetes.nombrepaquete,
			notapago.folio,
			notapago.idnotapago
		FROM citas
		INNER JOIN sucursal ON sucursal.idsucursal=citas.idsucursal
		INNER JOIN especialista ON citas.idespecialista=especialista.idespecialista
		left join usuarios ON usuarios.idusuarios=citas.idusuarios
		left join usuarios as esp on esp.idusuarios=especialista.idusuarios
		left join paquetes on citas.idpaquete=paquetes.idpaquete
		left join notapago_descripcion on citas.idcita=notapago_descripcion.idcita
		left JOIN notapago on notapago_descripcion.idnotapago=notapago.idnotapago
		 WHERE 	 citas.checkin=1 AND citas.checkout=1 AND citas.fechacita='$this->fecha' GROUP BY idcita ORDER BY fechacita,horainicial ";

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


		public function ObtenerCitasFechaEspecifica()
	{
		$sql="SELECT 
			citas.idcita,
			citas.horainicial,
			citas.horacita,
			citas.fechacita,
			citas.estatus,
			citas.idsucursal,
			sucursal.titulo,
			sucursal.descripcion,
			sucursal.imagen,
			usuarios.nombre,
			usuarios.paterno,
			citas.idpaquete,
			citas.horafinal,
			citas.idespecialista,
			citas.idusuarios,
			citas.costo,
			CONCAT(usuarios.nombre,' ',usuarios.paterno) AS nombreusuario,
			CONCAT(esp.nombre,' ',esp.paterno) AS nombreespecialista,
			paquetes.nombrepaquete,
			notapago.folio,
			notapago.idnotapago

		FROM citas
		INNER JOIN sucursal ON sucursal.idsucursal=citas.idsucursal
		INNER JOIN especialista ON citas.idespecialista=especialista.idespecialista
		left join usuarios ON usuarios.idusuarios=citas.idusuarios
		left join usuarios as esp on esp.idusuarios=especialista.idusuarios
		left join paquetes on citas.idpaquete=paquetes.idpaquete
		left join notapago_descripcion on citas.idcita=notapago_descripcion.idcita
		left JOIN notapago on notapago_descripcion.idnotapago=notapago.idnotapago
		 WHERE 	 fechacita='$this->fecha'  AND checkin IN (0,1) AND citas.estatus in (0,1) GROUP BY idcita ORDER BY idsucursal,fechacita,horainicial";
		
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

		public function VerificarFechaHorarioEspecialista()
	{

		
		$sql="SELECT *FROM (SELECT *FROM citas WHERE idespecialista='$this->idespecialista' AND fechacita='$this->fecha' AND estatus!=3) AS TABLA1 WHERE   TABLA1.horainicial>='$this->horainicial' AND TABLA1.horafinal<='$this->horafinal' ";

		/*$sql="SELECT *
			FROM (
			    SELECT *
			    FROM citas
			    WHERE idespecialista = '$this->idespecialista' 
			        AND fechacita = '$this->fecha'
			    	AND estatus!=3
			        
			) AS TABLA1 
			
				 WHERE 

			((TABLA1.horainicial < '$this->horafinal' AND TABLA1.horafinal > '$this->horainicial')   -- Traslape con el rango proporcionado
	        OR (TABLA1.horainicial = '$this->horainicial' AND TABLA1.horafinal >= '$this->horafinal')  -- Traslape con el rango proporcionado (inicio exacto)
	        OR (TABLA1.horainicial <= '$this->horainicial' AND TABLA1.horafinal = '$this->horafinal')  -- Traslape con el rango proporcionado (fin exacto)
	        OR (TABLA1.horainicial = '$this->horainicial')  
	   		 )


			   ";*/

		
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


	public function VerificarFechaHorarioEspecialista2()
	{

		
		//$sql="SELECT *FROM (SELECT *FROM citas WHERE idespecialista='$this->idespecialista' AND fechacita='$this->fecha' AND estatus!=3) AS TABLA1 WHERE   TABLA1.horainicial>='$this->horainicial' AND TABLA1.horafinal<='$this->horafinal' ";

		$sql="SELECT *
			FROM (
			    SELECT *
			    FROM citas
			    WHERE idespecialista = '$this->idespecialista' 
			        AND fechacita = '$this->fecha'
			    	AND estatus!=3
			        
			) AS TABLA1 
			
				 WHERE 

			((TABLA1.horainicial < '$this->horafinal' AND TABLA1.horafinal > '$this->horainicial')   -- Traslape con el rango proporcionado
	        OR (TABLA1.horainicial = '$this->horainicial' AND TABLA1.horafinal >= '$this->horafinal')  -- Traslape con el rango proporcionado (inicio exacto)
	        OR (TABLA1.horainicial <= '$this->horainicial' AND TABLA1.horafinal = '$this->horafinal')  -- Traslape con el rango proporcionado (fin exacto)
	        OR (TABLA1.horainicial = '$this->horainicial')  -- Nuevo registro comienza exactamente cuando termina el registro existente
	   		 )


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

	public function VerificarConNota($idnotapago,$idtemporalcarrito)
	{
		/*$sql="SELECT *FROM (SELECT *FROM temporalcarrito WHERE idespecialista='$this->idespecialista' AND fechacita='$this->fecha' AND estatus!=3) AS TABLA1 WHERE   TABLA1.horainicial>='$this->horainicial' AND TABLA1.horafinal<='$this->horafinal' WHERE idnota='$idnotapago' AND idtemporalcarrito NOT IN($idtemporalcarrito) ";*/

		$sql="SELECT *
			FROM (
			    SELECT *
			    FROM temporalcarrito
			    WHERE idespecialista = '$this->idespecialista' 
			        AND fecha = '$this->fecha'
			        AND idnota = '$idnotapago'
			         AND idtemporalcarrito NOT IN ($idtemporalcarrito) 
 
			        
			) AS TABLA1 
			
				 WHERE 

			((TABLA1.horainicial < '$this->horafinal' AND TABLA1.horafinal > '$this->horainicial')   -- Traslape con el rango proporcionado
	        OR (TABLA1.horainicial = '$this->horainicial' AND TABLA1.horafinal >= '$this->horafinal')  -- Traslape con el rango proporcionado (inicio exacto)
	        OR (TABLA1.horainicial <= '$this->horainicial' AND TABLA1.horafinal = '$this->horafinal')  -- Traslape con el rango proporcionado (fin exacto)
	        OR (TABLA1.horainicial = '$this->horainicial')  -- Nuevo registro comienza exactamente cuando termina el registro existente
	   		 )


			   ";


			    /*if ($this->idespecialista==1) {
			    	echo $sql;die();
			    }*/
		
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

	public function GuardarReagenda()
	{
		$sql = "UPDATE citas 
        SET estatus=0,
        horacita='$this->horainicial',
        fechacita='$this->fecha',
        horainicial='$this->horainicial',
        horafinal='$this->horafinal',
        idespecialista='$this->idespecialista',
        idcortesia='$this->idcortesia'
        WHERE idcita = '$this->idcita'
        ";
        $this->db->consulta($sql);
	}


	
	public function BuscarCitaNotapagodescripcion()
	{ 
		
		$sql="
		SELECT c.*,citas.idsucursal,notapago.estatus as estatusnota FROM notapago_descripcion as c
		LEFT JOIN citas on c.idcita=citas.idcita
		inner join notapago on c.idnotapago=notapago.idnotapago
		 WHERE c.idcita='$this->idcita'

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


	public function CancelarCita()
	{
		 $sql = "UPDATE citas 
        SET estatus = '$this->estatus',
        fechacancelacion='$this->fechacancelacion',
        cancelacion='$this->cancelacion',
        motivocancelacion='$this->motivocancelacion',
        idusuariocancelacion='$this->idusuariocancela'
        WHERE idcita = '$this->idcita'

        ";

      
        $this->db->consulta($sql);
	}
	
	
	public function ObtenerCitasFecha()
	{
		$sql="SELECT 
			citas.idcita,
			citas.horainicial,
			citas.horacita,
			citas.fechacita,
			citas.estatus,
			citas.idsucursal,
			sucursal.titulo,
			sucursal.descripcion,
			sucursal.imagen,
			usuarios.nombre,
			usuarios.paterno,
			citas.idpaquete,
			citas.horafinal,
			citas.idespecialista,
			citas.idusuarios,
			citas.costo,
			CONCAT(usuarios.nombre,' ',usuarios.paterno) AS nombreusuario,
			CONCAT(esp.nombre,' ',esp.paterno) AS nombreespecialista,
			paquetes.nombrepaquete,
			notapago.folio,
			notapago.idnotapago

		FROM citas
		INNER JOIN sucursal ON sucursal.idsucursal=citas.idsucursal
		INNER JOIN especialista ON citas.idespecialista=especialista.idespecialista
		left join usuarios ON usuarios.idusuarios=citas.idusuarios
		left join usuarios as esp on esp.idusuarios=especialista.idusuarios
		left join paquetes on citas.idpaquete=paquetes.idpaquete
		left join notapago_descripcion on citas.idcita=notapago_descripcion.idcita
		left JOIN notapago on notapago_descripcion.idnotapago=notapago.idnotapago
		 WHERE 	 fechacita='$this->fecha' AND sucursal.idsucursal IN($this->idsucursal) and citas.estatus IN (0,1) GROUP BY idcita ORDER BY idsucursal,fechacita,horainicial";
		
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



	public function ObtenerCitasFechaEspeci()
	{
		$sql="SELECT 
			citas.idcita,
			citas.horainicial,
			citas.horacita,
			citas.fechacita,
			citas.estatus,
			citas.idsucursal,
			sucursal.titulo,
			sucursal.descripcion,
			sucursal.imagen,
			usuarios.nombre,
			usuarios.paterno,
			citas.idpaquete,
			citas.horafinal,
			citas.idespecialista,
			citas.idusuarios,
			citas.costo,
			CONCAT(usuarios.nombre,' ',usuarios.paterno) AS nombreusuario,
			CONCAT(esp.nombre,' ',esp.paterno) AS nombreespecialista,
			paquetes.nombrepaquete,
			notapago.folio,
			notapago.idnotapago

		FROM citas
		INNER JOIN sucursal ON sucursal.idsucursal=citas.idsucursal
		INNER JOIN especialista ON citas.idespecialista=especialista.idespecialista
		left join usuarios ON usuarios.idusuarios=citas.idusuarios
		left join usuarios as esp on esp.idusuarios=especialista.idusuarios
		left join paquetes on citas.idpaquete=paquetes.idpaquete
		left join notapago_descripcion on citas.idcita=notapago_descripcion.idcita
		left JOIN notapago on notapago_descripcion.idnotapago=notapago.idnotapago
		 WHERE 	 fechacita='$this->fecha'   and citas.estatus IN (0,1)
		 AND citas.idsucursal='$this->idsucursal'
		  GROUP BY idcita ORDER BY idsucursal,fechacita,horainicial"

		 ;
		
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

	public function ObtenerCitasPendientes()
	{
		$sql="SELECT 
			citas.horainicial,
			citas.horacita,
			citas.fechacita,
			citas.estatus,
			citas.idsucursal,
			sucursal.titulo,
			sucursal.descripcion,
			sucursal.imagen,
			usuarios.nombre,
			usuarios.paterno,
			citas.idpaquete,
			citas.horafinal,
			citas.idespecialista,
			citas.idusuarios,
			citas.costo,
			CONCAT(usuarios.nombre,' ',usuarios.paterno) AS nombreusuario,
			CONCAT(usuarios.nombre,' ',usuarios.paterno) AS nombreespecialista,
			paquetes.nombrepaquete,
			notapago.folio,
			notapago.idnotapago
		FROM citas
		INNER JOIN sucursal ON sucursal.idsucursal=citas.idsucursal
		INNER JOIN especialista ON citas.idespecialista=especialista.idespecialista
		left join usuarios ON usuarios.idusuarios=citas.idusuarios
		left join usuarios as esp on esp.idusuarios=especialista.idusuarios
		left join paquetes on citas.idpaquete=paquetes.idpaquete
		left join notapago_descripcion on citas.idcita=notapago_descripcion.idcita
		left JOIN notapago on notapago_descripcion.idnotapago=notapago.idnotapago
		 WHERE 	 citas.estatus IN(0) AND citas.fechacita='$this->fecha'  ORDER BY fechacita,horainicial";

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


	public function ObtenerCitasNoRealizados($value='')
	{
		$sql="SELECT 
			citas.idcita,
			citas.horainicial,
			citas.horacita,
			citas.fechacita,
			citas.estatus,
			citas.idsucursal,
			sucursal.titulo,
			sucursal.descripcion,
			sucursal.imagen,
			usuarios.nombre,
			usuarios.paterno,
			citas.idpaquete,
			citas.horafinal,
			citas.idespecialista,
			citas.idusuarios,
			citas.costo,
			CONCAT(usuarios.nombre,' ',usuarios.paterno) AS nombreusuario,
			CONCAT(usuarios.nombre,' ',usuarios.paterno) AS nombreespecialista,
			paquetes.nombrepaquete,
			notapago.folio,
			notapago.idnotapago
		FROM citas
		INNER JOIN sucursal ON sucursal.idsucursal=citas.idsucursal
		INNER JOIN especialista ON citas.idespecialista=especialista.idespecialista
		left join usuarios ON usuarios.idusuarios=citas.idusuarios
		left join usuarios as esp on esp.idusuarios=especialista.idusuarios
		left join paquetes on citas.idpaquete=paquetes.idpaquete
		left join notapago_descripcion on citas.idcita=notapago_descripcion.idcita
		left JOIN notapago on notapago_descripcion.idnotapago=notapago.idnotapago
		 WHERE 	citas.estatus IN(4) AND  citas.fechacita='$this->fecha'  ORDER BY fechacita,horainicial";

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

		public function ObtenerCitasCanceladas()
	{
		$sql="SELECT 
			citas.idcita,
			citas.horainicial,
			citas.horacita,
			citas.fechacita,
			citas.estatus,
			citas.idsucursal,
			sucursal.titulo,
			sucursal.descripcion,
			sucursal.imagen,
			usuarios.nombre,
			usuarios.paterno,
			citas.idpaquete,
			citas.horafinal,
			citas.idespecialista,
			citas.idusuarios,
			citas.costo,
			CONCAT(usuarios.nombre,' ',usuarios.paterno) AS nombreusuario,
			CONCAT(usuarios.nombre,' ',usuarios.paterno) AS nombreespecialista,
			paquetes.nombrepaquete,
			notapago.folio,
			notapago.idnotapago
		FROM citas
		INNER JOIN sucursal ON sucursal.idsucursal=citas.idsucursal
		INNER JOIN especialista ON citas.idespecialista=especialista.idespecialista
		left join usuarios ON usuarios.idusuarios=citas.idusuarios
		left join usuarios as esp on esp.idusuarios=especialista.idusuarios
		left join paquetes on citas.idpaquete=paquetes.idpaquete
		left join notapago_descripcion on citas.idcita=notapago_descripcion.idcita
		left JOIN notapago on notapago_descripcion.idnotapago=notapago.idnotapago
		 WHERE 	 citas.estatus IN(3) AND citas.fechacita='$this->fecha' GROUP by citas.idcita ORDER BY fechacita,horainicial";

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


	public function ObtenerCitasProceso()
	{
		$sql="SELECT 
			citas.idcita,
			citas.horainicial,
			citas.horacita,
			citas.fechacita,
			citas.estatus,
			citas.idsucursal,
			sucursal.titulo,
			sucursal.descripcion,
			sucursal.imagen,
			usuarios.nombre,
			usuarios.paterno,
			citas.idpaquete,
			citas.horafinal,
			citas.idespecialista,
			citas.idusuarios,
			citas.costo,
			CONCAT(usuarios.nombre,' ',usuarios.paterno) AS nombreusuario,
			CONCAT(usuarios.nombre,' ',usuarios.paterno) AS nombreespecialista,
			paquetes.nombrepaquete,
			notapago.folio,
			notapago.idnotapago
		FROM citas
		INNER JOIN sucursal ON sucursal.idsucursal=citas.idsucursal
		INNER JOIN especialista ON citas.idespecialista=especialista.idespecialista
		left join usuarios ON usuarios.idusuarios=citas.idusuarios
		left join usuarios as esp on esp.idusuarios=especialista.idusuarios
		left join paquetes on citas.idpaquete=paquetes.idpaquete
		left join notapago_descripcion on citas.idcita=notapago_descripcion.idcita
		left JOIN notapago on notapago_descripcion.idnotapago=notapago.idnotapago
		 WHERE 	 citas.estatus IN(1) AND citas.fechacita='$this->fecha'  ORDER BY fechacita,horainicial";

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

	public function ObtenerCitasFechaSinHorario()
	{
		$sql="SELECT 
			citas.idcita,
			citas.horains,
			citas.horacita,
			citas.fechacita,
			citas.estatus,
			citas.idsucursal,
			sucursal.titulo,
			sucursal.descripcion,
			sucursal.imagen,
			usuarios.nombre,
			usuarios.paterno,
			citas.idpaquete,
			citas.horafs,
			citas.idespecialista,
			citas.idusuarios,
			citas.costo,
			CONCAT(usuarios.nombre,' ',usuarios.paterno) AS nombreusuario,
			CONCAT(usuarios.nombre,' ',usuarios.paterno) AS nombreespecialista,
			paquetes.nombrepaquete,
			notapago.folio,
			notapago.idnotapago
		FROM citas
		INNER JOIN sucursal ON sucursal.idsucursal=citas.idsucursal
		INNER JOIN especialista ON citas.idespecialista=especialista.idespecialista
		left join usuarios ON usuarios.idusuarios=citas.idusuarios
		left join usuarios as esp on esp.idusuarios=especialista.idusuarios
		left join paquetes on citas.idpaquete=paquetes.idpaquete
		left join notapago_descripcion on citas.idcita=notapago_descripcion.idcita
		left JOIN notapago on notapago_descripcion.idnotapago=notapago.idnotapago
		 WHERE 	 citas.estatus IN(0,1,2,3,4) AND citas.fechacita='$this->fecha'  AND horains!='' AND citas.idespecialista='$this->idespecialista' GROUP by citas.idcita ORDER BY fechacita,horains";
		
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

	public function CambiarCortesia()
	{
		 $sql = "UPDATE citas 
        SET
        idcortesia='$this->idcortesia'
        WHERE idcita = '$this->idcita'

        ";

      
        $this->db->consulta($sql);
	}

	public function ActualizarCitaTemp($value='')
	{
		
		 $sql = "UPDATE citas 
        SET estatus = 0,
        horacita='$this->horainicial',
        horainicial='$this->horainicial',
        horafinal='$this->horafinal',
        idespecialista='$this->idespecialista',
        fechacita='$this->fechacita',
        costo='$this->costo',
        idpaquete='$this->idpaquete'
        WHERE idcita = '$this->idcita'

        ";
        $this->db->consulta($sql);
	}


	public function EliminarCita()
	{
		
		 $sql = "DELETE FROM citas
        WHERE idcita = '$this->idcita'
        ";
        $this->db->consulta($sql);
	}


	public function VerificarFechaHorarioEspecialistaTpv()
	{

		
		$sql="SELECT *FROM (SELECT *FROM temporalcarritotpv WHERE idespecialista='$this->idespecialista' AND fecha='$this->fecha' AND estatus!=3 AND idtpv='$this->idtpv') AS TABLA1 WHERE '$this->horainicial' >= TABLA1.horainicial  AND '$this->horafinal'<=TABLA1.horafinal ";
		
		
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


	public function VerificarFechaHorarioEspecialistaMenosActual($idcita)
	{

		/*$sql="SELECT *FROM (SELECT *FROM citas WHERE idespecialista='$this->idespecialista' AND fechacita='$this->fecha' AND estatus!=3 AND idcita NOT IN($idcita)) AS TABLA1 WHERE   TABLA1.horainicial>='$this->horainicial' AND TABLA1.horafinal<='$this->horafinal'
		 ";*/

		 $sql="
		 SELECT *FROM (SELECT *FROM citas WHERE idespecialista='$this->idespecialista' AND fechacita='$this->fecha' AND estatus!=3 AND idcita NOT IN($idcita)) AS TABLA1

		  WHERE 

			((TABLA1.horainicial < '$this->horafinal' AND TABLA1.horafinal > '$this->horainicial')   -- Traslape con el rango proporcionado
	        OR (TABLA1.horainicial = '$this->horainicial' AND TABLA1.horafinal >= '$this->horafinal')  -- Traslape con el rango proporcionado (inicio exacto)
	        OR (TABLA1.horainicial <= '$this->horainicial' AND TABLA1.horafinal = '$this->horafinal')  -- Traslape con el rango proporcionado (fin exacto)
	        OR (TABLA1.horainicial = '$this->horainicial')  -- Nuevo registro comienza exactamente cuando termina el registro existente
	   		 )
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



		public function ObtenerCitasNocheckinApp()
	{
		$sql="SELECT *FROM (SELECT 
			citas.idcita,
			citas.horainicial,
			citas.horacita,
			citas.fechacita,
			citas.estatus,
			citas.idsucursal,
			sucursal.titulo,
			sucursal.descripcion,
			sucursal.imagen,
			usuarios.nombre,
			usuarios.paterno,
			citas.idpaquete,
			citas.horafinal,
			citas.idespecialista,
			citas.idusuarios,
			citas.costo,
			CONCAT(usuarios.nombre,' ',usuarios.paterno) AS nombreusuario,
			CONCAT(esp.nombre,' ',esp.paterno) AS nombreespecialista,
			paquetes.nombrepaquete,
			notapago.folio,
			notapago.idnotapago,
			(SELECT COUNT(*) FROM citasnotificacion WHERE citasnotificacion.idcita=citas.idcita) AS contar


		FROM citas
		INNER JOIN sucursal ON sucursal.idsucursal=citas.idsucursal
		INNER JOIN especialista ON citas.idespecialista=especialista.idespecialista
		left join usuarios ON usuarios.idusuarios=citas.idusuarios
		left join usuarios as esp on esp.idusuarios=especialista.idusuarios
		left join paquetes on citas.idpaquete=paquetes.idpaquete
		left join notapago_descripcion on citas.idcita=notapago_descripcion.idcita
		left JOIN notapago on notapago_descripcion.idnotapago=notapago.idnotapago
		 WHERE 	 fechacita='$this->fecha' 	AND citas.estatus!=3  AND citas.idsucursal='$this->idsucursal' AND notapago.tpv=0 or notapago.tpv is null   GROUP BY idcita ORDER BY idsucursal,fechacita,horainicial )
AS TABLA WHERE contar=0
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


	public function GuardarVisto()
	{
		$query="INSERT INTO citasnotificacion (idcita,idusuario) VALUES ('$this->idcita','$this->idusuario')";
		
		$resp=$this->db->consulta($query);
		$this->idbanner = $this->db->id_ultimo();
			}

}
 ?>