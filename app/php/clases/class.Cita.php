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
	public $valortiempo;
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

	public $cancelacion;
	public $fechacancelacion;
	public $motivocancelacion;
	public $idusuariocancela;
	public $idusuariockeckout;
	public $horaactual;
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
			citas.checkout,
			citas.cancelacion,
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

			$sql="INSERT INTO citaapartado( horainicial, horafinal, idsucursal, idpaquete, idespecialista, fecha, estatus, idusuario) VALUES ('$this->horainicial', '$this->horafinal',
				 '$this->idsucursal', '$this->idpaquete','$this->idespecialista','$this->fecha','$this->estatus','$this->idusuario')";
	
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
			$sql="INSERT INTO citas(horacita, fechacita, asuntocita, estatus, orden,idsucursal, horainicial, horafinal, idpaquete, idespecialista, costo, idusuarios,idcortesia) VALUES ( '$this->horacita','$this->fechacita','',$this->estatus, 0, '$this->idsucursal','$this->horainicial','$this->horafinal', '$this->idpaquete','$this->idespecialista','$this->costo','$this->idusuario','$this->idcortesia')";
			
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
			citaapartado.idcortesia,
			CONCAT(usuarios.nombre,' ',usuarios.paterno) as nombrebarbero
			
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
			sucursal.telefono,
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
			citas.idcortesia,
			citas.fechacheckin,
			(SELECT paquetes.nombrepaquete from paquetes WHERE paquetes.idpaquete=citas.idpaquete)as concepto,
			(SELECT paquetes.concortesia from paquetes WHERE paquetes.idpaquete=citas.idpaquete)as concortesia,

			(SELECT paquetes.servicio from paquetes WHERE paquetes.idpaquete=citas.idpaquete)as servicio,
			paquetecortesia.nombrepaquete as nombrepaquetecortesia,
			CONCAT(cliente.nombre,' ',cliente.paterno) as nombrecliente


		FROM citas
		INNER JOIN sucursal ON sucursal.idsucursal=citas.idsucursal
		INNER JOIN especialista ON citas.idespecialista=especialista.idespecialista
		left join usuarios ON usuarios.idusuarios=especialista.idusuarios
		left join cortesia 
			ON citas.idcortesia=cortesia.idcortesia
		left join paquetes as paquetecortesia on paquetecortesia.idpaquete=cortesia.idpaquetecortesia

		left join usuarios as cliente
		on citas.idusuarios=cliente.idusuarios
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
			citas.checkout, 
			CONCAT(usuarios.nombre,' ',usuarios.paterno) AS nombreusuario,

			CONCAT(esp.nombre,' ',esp.paterno) AS nombreespecialista,
			(SELECT paquetes.nombrepaquete from paquetes WHERE paquetes.idpaquete=citas.idpaquete)as concepto

		FROM citas INNER JOIN  especialista ON especialista.idespecialista=citas.idespecialista
		left join usuarios as esp ON esp.idusuarios=especialista.idusuarios
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
			citas.idcita,
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
			citas.checkout,
			citas.cancelacion,
			citas.fechacheckin,
			citas.finalizacita,
			citas.idcortesia,
			citas.tiempotranscurrido,
			(SELECT paquetes.nombrepaquete from paquetes WHERE paquetes.idpaquete=citas.idpaquete)as concepto,

				CONCAT(usuarios.nombre,' ',usuarios.paterno) AS nombreusuario,
			CONCAT(esp.nombre,' ',esp.paterno) AS nombreespecialista,
			(SELECT paquetes.concortesia from paquetes WHERE paquetes.idpaquete=citas.idpaquete)as concortesia,
			(SELECT paquetes.servicio from paquetes WHERE paquetes.idpaquete=citas.idpaquete)as servicio,
			paquetecortesia.nombrepaquete as nombrepaquetecortesia,
			
				(SELECT notapago.tpv from notapago_descripcion
				LEFT JOIN notapago ON notapago_descripcion.idnotapago=notapago.idnotapago
				WHERE notapago_descripcion.idcita=citas.idcita LIMIT 1
				) as tpv


		FROM citas
		left JOIN sucursal ON sucursal.idsucursal=citas.idsucursal
			left JOIN especialista ON citas.idespecialista=especialista.idespecialista
		left join usuarios ON usuarios.idusuarios=citas.idusuarios
		left join usuarios as esp on esp.idusuarios=especialista.idusuarios


		left join cortesia 
			ON citas.idcortesia=cortesia.idcortesia
		left join paquetes as paquetecortesia on paquetecortesia.idpaquete=cortesia.idpaquetecortesia


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
			citas.horacita,
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
			usuarios.materno,citas.idpaquete,
			citas.horafinal,
			citas.idespecialista,
			citas.idusuarios,
			citas.costo,
			citas.idcita,
			citas.checkin,
			citas.checkout,
			citas.cancelacion,
			citas.fechacheckin,
			citas.finalizacita,
			citas.idcortesia,

			(SELECT paquetes.nombrepaquete from paquetes WHERE paquetes.idpaquete=citas.idpaquete)as concepto,

			(SELECT paquetes.concortesia from paquetes WHERE paquetes.idpaquete=citas.idpaquete)as concortesia,

			(SELECT paquetes.servicio from paquetes WHERE paquetes.idpaquete=citas.idpaquete)as servicio,
			paquetecortesia.nombrepaquete as nombrepaquetecortesia,
			CONCAT(esp.nombre,' ',esp.paterno) AS nombreespecialista
			


		FROM citas
		INNER JOIN sucursal ON sucursal.idsucursal=citas.idsucursal
		INNER JOIN especialista ON citas.idespecialista=especialista.idespecialista


		left join usuarios as esp ON esp.idusuarios=especialista.idusuarios

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
			citas.checkin,
			citas.checkout,
			citas.fechacheckin,
			citas.finalizacita,
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
		 WHERE 	 fechacita='$this->fecha' AND sucursal.idsucursal IN($this->idsucursal)  GROUP BY citas.idcita ORDER BY idsucursal,fechacita,horainicial";
		
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

	public function ObtenerCitaEspecialista()
	{
		$sql="SELECT 
			citas.horacita,
			citas.horainicial,
			citas.fechacita,
			citas.estatus,
			citas.idsucursal,
			sucursal.titulo,
			sucursal.descripcion,
			sucursal.imagen,
			sucursal.ubicacion,
			sucursal.celular,
			sucursal.telefono,
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
			citas.idcortesia,
			citas.fechacheckin,
			(SELECT paquetes.nombrepaquete from paquetes WHERE paquetes.idpaquete=citas.idpaquete)as concepto,
			(SELECT paquetes.concortesia from paquetes WHERE paquetes.idpaquete=citas.idpaquete)as concortesia,

			(SELECT paquetes.servicio from paquetes WHERE paquetes.idpaquete=citas.idpaquete)as servicio,
			paquetecortesia.nombrepaquete as nombrepaquetecortesia


		FROM citas
		INNER JOIN sucursal ON sucursal.idsucursal=citas.idsucursal
		INNER JOIN especialista ON citas.idespecialista=especialista.idespecialista
		left join usuarios ON usuarios.idusuarios=especialista.idusuarios
		left join cortesia 
			ON citas.idcortesia=cortesia.idcortesia
		left join paquetes as paquetecortesia on paquetecortesia.idpaquete=cortesia.idpaquetecortesia
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
			notapago.idnotapago

		FROM citas
		INNER JOIN sucursal ON sucursal.idsucursal=citas.idsucursal
		INNER JOIN especialista ON citas.idespecialista=especialista.idespecialista
		left join usuarios ON usuarios.idusuarios=citas.idusuarios
		left join usuarios as esp on esp.idusuarios=especialista.idusuarios
		left join paquetes on citas.idpaquete=paquetes.idpaquete
		left join notapago_descripcion on citas.idcita=notapago_descripcion.idcita
		left JOIN notapago on notapago_descripcion.idnotapago=notapago.idnotapago
		 WHERE 	 fechacita='$this->fecha' GROUP BY idcita ORDER BY idsucursal,fechacita,horainicial";
		
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
        	checkout=1,
        	idusuariochekout='$this->idusuariockeckout',
        finalizacita='".date('Y-m-d H:i:s')."'
        WHERE idcita = '$this->idcita'
        ";
        
        $this->db->consulta($sql);
        
	}

	

	public function ChecarHorarioFechaEspecialista()
	{
		
		//$sql="SELECT *FROM citas WHERE idespecialista='$this->idespecialista' AND fechacita='$this->fechacita' AND '$this->horainicial'>=horainicial AND horafinal<='$this->horafinal' and estatus!=3 ";

		$sql="SELECT *
			FROM citas
			WHERE idespecialista = '$this->idespecialista'
			  AND fechacita = '$this->fechacita'
			  AND ((horainicial < '$this->horafinal' AND horafinal > '$this->horainicial') OR (horainicial >= '$this->horainicial' AND horainicial < '$this->horafinal'))
			  AND estatus != 3";
			 
		/*$sql="SELECT TABLA1.* from (SELECT *
			FROM citas

		WHERE fechacita='$this->fechacita' AND idespecialista='$this->idespecialista' AND citas.estatus!=3

		  )AS TABLA1
		
		where
		 '$this->horainicial' >= TABLA1.horainicial  AND '$this->horafinal'<=TABLA1.horafinal";*/

		
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
			citas.checkout,
			citas.fechacheckin,
			citas.cancelacion,
			citas.finalizacita,
			DATE_FORMAT(citas.fechacita,'%Y-%m-%d')as fecha,
			CONCAT(usuarios.nombre,' ',usuarios.paterno) AS nombreespecialista
		FROM citas INNER JOIN  especialista ON especialista.idespecialista=citas.idespecialista
		INNER JOIN usuarios ON usuarios.idusuarios=especialista.idusuarios
		INNER JOIN sucursal ON sucursal.idsucursal=citas.idsucursal WHERE citas.idusuarios IN($this->idusuarios) ORDER BY citas.idcita desc
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
		$sql="SELECT 
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
			citas.idpaquete,
			CONCAT(usuarios.nombre,' ',usuarios.paterno) AS nombreespecialista
		FROM citas INNER JOIN  especialista ON especialista.idespecialista=citas.idespecialista
		INNER JOIN usuarios ON usuarios.idusuarios=especialista.idusuarios
		INNER JOIN sucursal ON sucursal.idsucursal=citas.idsucursal
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


		 if ($this->estatus!=100 && $this->estatus!='') {
		 	$sqlestatus=" AND citas.estatus=".$this->estatus."";
		 }
		 $array=array();
		 if ($this->estatus!=3) {
		 	# code...
		 

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
			paquetes.nombrepaquete as concepto,
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
		 WHERE 	 fechacita='$this->fechacita' AND sucursal.idsucursal IN($this->idsucursal) 
		 AND citas.idespecialista='$this->idespecialista' $sqlestatus  AND citas.estatus NOT IN(3) GROUP BY citas.idcita
		 ORDER BY idsucursal,fechacita,horainicial";
		
		$resp=$this->db->consulta($sql);
		$cont = $this->db->num_rows($resp);


		
		$contador=0;
		if ($cont>0) {

			while ($objeto=$this->db->fetch_object($resp)) {

				$array[$contador]=$objeto;
				$contador++;
			} 
		}

	}
		
		return $array;
	}


		public function ObtenerCitascheckin()
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
		 WHERE 	 citas.checkin=1 AND citas.checkout=1 AND citas.fechacita='$this->fecha' ORDER BY fechacita,horainicial";

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
		 WHERE 	 fechacita='$this->fecha'  AND checkin IN (0,1) ORDER BY idsucursal,fechacita,horainicial";
		
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


	public function ActualizarCortesiaCita()
	{
		$sql = "UPDATE citaapartado
        SET idcortesia = '$this->idcortesia' WHERE
        idcitaapartado = '$this->idcitaapartado'
        ";
       
        $this->db->consulta($sql);
	}



	public function VerificarFechaHorarioEspecialista()
	{

		
		$sql="SELECT *FROM (SELECT *FROM citas WHERE idespecialista='$this->idespecialista' AND fechacita='$this->fecha' AND estatus!=3 ) AS TABLA1 WHERE   
			'$this->horainicial' BETWEEN horainicial AND horafinal ";
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

	public function VerificarCitaApartada()
	{
			
		$sql="SELECT *FROM (SELECT *FROM citaapartado WHERE idespecialista='$this->idespecialista' AND fecha='$this->fecha') AS TABLA1 WHERE   TABLA1.horainicial>='$this->horainicial' AND TABLA1.horafinal<='$this->horafinal' ";
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


	public function ObtenerCitasProgramadasUsuario()
	{
		$fechactual=date('Y-m-d');
		$horaactual=date('H:i');
		$sql="

		
		SELECT *
		FROM (
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
		        DATE_FORMAT(citas.fechacita, '%Y-%m-%d') AS fecha,
		        CONCAT(usuarios.nombre, ' ', usuarios.paterno) AS nombreespecialista
		    FROM citas
		    INNER JOIN especialista ON especialista.idespecialista = citas.idespecialista
		    INNER JOIN usuarios ON usuarios.idusuarios = especialista.idusuarios
		    INNER JOIN sucursal ON sucursal.idsucursal = citas.idsucursal
		    WHERE citas.idusuarios = ".$this->idusuarios." AND citas.estatus = 0
		) AS tablac
		WHERE tablac.fecha >= '$fechactual'
		AND (
		    tablac.fecha > '$fechactual'
		    OR (
		        tablac.fecha = '$fechactual'
		        AND tablac.horacita >= '$horaactual'
		    )
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


	public function BuscarCitaNotapagodescripcion()
	{
		
		$sql="
		SELECT c.*,citas.idsucursal,n.estatus as estatusnota,n.total as totalnota,n.comisiontotal,n.folio,n.idsucursal as idsucursalnota FROM notapago_descripcion as c
		LEFT JOIN citas on c.idcita=citas.idcita
		LEFT JOIN notapago as n on n.idnotapago=c.idnotapago WHERE
		  c.idcita='$this->idcita'

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


	public function ObtenerdetallecitaTiempo()
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
			citas.checkout,
			citas.cancelacion,
			citas.fechacheckin,
			citas.finalizacita,
			citas.tiempotranscurrido,
			(SELECT paquetes.nombrepaquete from paquetes WHERE paquetes.idpaquete=citas.idpaquete)as concepto
		FROM citas
		INNER JOIN sucursal ON sucursal.idsucursal=citas.idsucursal
		INNER JOIN especialista ON citas.idespecialista=especialista.idespecialista
		left join usuarios ON usuarios.idusuarios=citas.idusuarios
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
				$this->idnotapago=$objeto->idnotapago;

				


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



	public function ObtenerCitasPendientesCron()
	{
		$sql="SELECT 
			citas.idcita,
			citas.horainicial,
			citas.horacita,
			citas.fechacita,
			citas.estatus,
			citas.idsucursal,
			citas.horains,
			citas.horafs,
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
		 WHERE 	 citas.estatus IN(0) AND citas.fechacita<='$this->fecha'  ORDER BY fechacita,horainicial";

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


	public function ActualizarCitaCaducada($value='')
	{
		 $sql = "UPDATE citas 
        SET estatus = '$this->estatus'
        WHERE idcita = '$this->idcita'
        ";
        $this->db->consulta($sql);
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


	public function ObtenerCitasFechaEstatus()
	{

		 if ($this->estatus!=100 && $this->estatus!='') {
		 	$sqlestatus=" AND citas.estatus=".$this->estatus."";
		 }
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
			citas.checkin,
			citas.checkout,
			citas.fechacheckin,
			citas.finalizacita,
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
		 WHERE 	 fechacita='$this->fecha' AND sucursal.idsucursal IN($this->idsucursal)  $sqlestatus GROUP BY citas.idcita ORDER BY idsucursal,fechacita,horainicial";
		
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

	public function ObtenerCitasNocheckinEspe()
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
		 WHERE 	 fechacita='$this->fecha' AND citas.idespecialista IN($this->idespecialista) and citas.estatus NOT IN(3) GROUP BY idcita ORDER BY idsucursal,fechacita,horainicial";

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


	public function ObtenerCitascheckinEspe()
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
		 WHERE 	 citas.checkin=1 AND citas.checkout=1 AND citas.fechacita='$this->fecha' AND citas.idespecialista IN($this->idespecialista) ORDER BY fechacita,horainicial";

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


	public function ObtenerCitasPendientesEspe()
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
		 WHERE 	 citas.estatus IN(0) AND citas.fechacita='$this->fecha' AND citas.idespecialista IN($this->idespecialista) ORDER BY fechacita,horainicial";

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

	public function ObtenerCitasNoRealizadosEspe($value='')
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
		 WHERE 	citas.estatus IN(4) AND  citas.fechacita='$this->fecha' AND citas.idespecialista IN($this->idespecialista)  ORDER BY fechacita,horainicial";

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



	public function ObtenerCitasCanceladasEspe()
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
		 WHERE 	 citas.estatus IN(3) AND citas.fechacita='$this->fecha' AND citas.idespecialista IN($this->idespecialista) GROUP by citas.idcita ORDER BY fechacita,horainicial";

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

public function ObtenerCitasProcesoEspe()
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
		 WHERE 	 citas.estatus IN(1) AND citas.fechacita='$this->fecha' AND citas.idespecialista IN($this->idespecialista)  ORDER BY fechacita,horainicial";

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


	public function ActualizarcitaChe()
	{
		 $sql = "UPDATE citas 
        SET estatus = 1,
        checkin=1,
        
        idusuariocheckin='$this->idusuariocheckin',
        fechacheckin='".date('Y-m-d H:i:s')."'
        WHERE idcita = '$this->idcita'

        ";
        $this->db->consulta($sql);
	}


	public function ObtenerCitaAdmin()
	{
		$sql="SELECT 
			citas.horacita,
			citas.horainicial,
			citas.fechacita,
			citas.estatus,
			citas.idsucursal,
			sucursal.titulo,
			sucursal.descripcion,
			sucursal.imagen,
			sucursal.ubicacion,
			sucursal.celular,
			sucursal.telefono,
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
			citas.idcortesia,
			citas.fechacheckin,
			(SELECT paquetes.nombrepaquete from paquetes WHERE paquetes.idpaquete=citas.idpaquete)as concepto,
			(SELECT paquetes.concortesia from paquetes WHERE paquetes.idpaquete=citas.idpaquete)as concortesia,

			(SELECT paquetes.servicio from paquetes WHERE paquetes.idpaquete=citas.idpaquete)as servicio,
			paquetecortesia.nombrepaquete as nombrepaquetecortesia


		FROM citas
		INNER JOIN sucursal ON sucursal.idsucursal=citas.idsucursal
		INNER JOIN especialista ON citas.idespecialista=especialista.idespecialista
		left join usuarios ON usuarios.idusuarios=especialista.idusuarios
		left join cortesia 
			ON citas.idcortesia=cortesia.idcortesia
		left join paquetes as paquetecortesia on paquetecortesia.idpaquete=cortesia.idpaquetecortesia
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


	public function ObtenerCitasEnproceso()
	{
		$sql="SELECT *FROM citas WHERE idespecialista='$this->idespecialista' and estatus=1";

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

	public function GuardarCortesiaCita()
	{
		$sql = "UPDATE citas 
        SET idcortesia = '$this->idcortesia'
        
        WHERE idcita = '$this->idcita'
        ";
      
        $this->db->consulta($sql);
	}


	public function VerificacionCita2()
	{
		

		 $sql="
		 SELECT *FROM (SELECT *FROM citas WHERE idespecialista='$this->idespecialista' AND fechacita='$this->fecha' AND estatus!=3) AS TABLA1

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

	

}
 ?>