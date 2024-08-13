<?php 
/**
 * 
 */
class Tarjetalealtad
{
	
	public $db;
	public $idtarjetalealtad;
	public $nombre;
	public $descripcion;
	public $cantidadrequerida;
	public $cantidadbeneficio;
	public $orden;
	public $fechainicial;
	public $fechafinal;
	//tarjeta regalo usuario
	public $idusuario;
	public $estatus;

	public $todosproducto;
	public $idsucursal;
	public $todosbeneficio;
	public $todoscliente;

	public $idproducto;
	public $idbeneficio;
	public $idcliente;

	public $regla;
	public $porvisita;

	public $idnotapago;
	public $idtarjetalealtadasignacion;
	public $repeticiones;
	public $idcita;
	public $automatico;

	public function ObtenerTodosTarjetalealtad()
	{

		$query="SELECT
				*from tarjetalealtad WHERE idsucursal='$this->idsucursal'
				 

		";
		
		$resp=$this->db->consulta($query);
		
		//echo $total;
		return $resp;
	}


	public function ObtenerUltimoOrdentarjetalealtad()
	{
		
		$query="SELECT MAX(orden) as ordenar FROM tarjetalealtad";

		$resp=$this->db->consulta($query);
		
		//echo $total;
		return $resp;
	}


	public function buscartarjetalealtad()
	{
		
		$query = "SELECT *
			FROM 
			tarjetalealtad WHERE idtarjetalealtad=".$this->idtarjetalealtad."";
			
		$result = $this->db->consulta($query);
		return $result;
	}


	public function guardartarjetalealtad()
	{
	
		
		$sql="INSERT INTO tarjetalealtad(nombre, descripcion, estatus, cantidadrequerida, cantidadbeneficio, fechainicial, fechafinal, todosproducto, idsucursal, orden, todosbeneficio, todoscliente,regla,repeticiones,porvisita,automatico) VALUES ( '$this->nombre', '$this->descripcion','$this->estatus', '$this->cantidadrequerida','$this->cantidadbeneficio','$this->fechainicial','$this->fechafinal','$this->todosproducto','$this->idsucursal','$this->orden','$this->todosbeneficio', '$this->todoscliente','$this->regla','$this->repeticiones','$this->porvisita','$this->automatico')";
		
		$resp = $this->db->consulta($sql);
		$this->idtarjetalealtad = $this->db->id_ultimo();

	}

	public function modificartarjetalealtad()
	{
		$sql="
			UPDATE tarjetalealtad SET nombre = '$this->nombre',
			  descripcion = '$this->descripcion', 
			  estatus = '$this->estatus', 
			  cantidadrequerida = '$this->cantidadrequerida',
			  cantidadbeneficio = '$this->cantidadbeneficio',
			    fechainicial = '$this->fechainicial',
			    fechafinal = '$this->fechafinal', 
			    todosproducto = '$this->todosproducto', 
			    idsucursal = '$this->idsucursal', 
			    orden = '$this->orden', 
			    todosbeneficio = '$this->todosbeneficio',
			    todoscliente = '$this->todoscliente',
			    regla='$this->regla' ,
			    repeticiones='$this->repeticiones',
			    porvisita='$this->porvisita'
			    WHERE 
			    idtarjetalealtad = '$this->idtarjetalealtad'";
		$resp = $this->db->consulta($sql);
		
	}


	public function Guardartarjetalealtadusuario()
	{
		$sql="INSERT INTO tarjetalealtadusuario( idusuario, estatus, idpaquete, vigencia, imagenqr, idusuariorecibe, fechaaceptada, monto, nombre,idnotapago_descripcion) VALUES ('$this->idusuario', 0, '$this->idpaquete','$this->vigencia', '$this->imagenqr', 0, '','$this->monto', '$this->nombre','$this->idnotapagodescripcion')";
		
		$resp = $this->db->consulta($sql);

	}



	public function Obtenertarjetalealtad()
	{

		$query="SELECT
				paquetes.nombrepaquete,
				tarjetalealtadusuario.idtarjetalealtadusuario,
				tarjetalealtadusuario.idusuario,
				tarjetalealtadusuario.estatus,
				tarjetalealtadusuario.fecha,
				tarjetalealtadusuario.idpaquete,
				tarjetalealtadusuario.vigencia,
				tarjetalealtadusuario.imagenqr,
				tarjetalealtadusuario.idusuariorecibe,
				tarjetalealtadusuario.fechaaceptada,
				paquetes.descripcion,
				tarjetalealtadusuario.monto,
				tarjetalealtadusuario.nombre,
				tarjetalealtadusuario.idnotapago_descripcion,
				usuarios.nombre AS nombreusuario,
				usuarios.paterno,
				usuarios.materno,
				paquetesucursal.idsucursal
				FROM
				paquetes
				JOIN tarjetalealtadusuario
				ON paquetes.idpaquete = tarjetalealtadusuario.idpaquete 
				JOIN usuarios
				ON usuarios.idusuarios = tarjetalealtadusuario.idusuario
				join paquetesucursal
				on paquetes.idpaquete=paquetes.idpaquete
				WHERE idtarjetalealtadusuario='$this->idtarjetalealtad'

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


	

	public function EliminarProductostarjeta()
	 {
	 	$query = "DELETE 
			FROM 
			reglaslealtad WHERE idtarjetalealtad=".$this->idtarjetalealtad."";
			
		$result = $this->db->consulta($query);
	 } 
	 public function GuardarProducto()
	 {
	 	$query = "INSERT INTO  
			reglaslealtad(idproducto,idtarjetalealtad)  VALUES  ('$this->idproducto','$this->idtarjetalealtad')";
		$result = $this->db->consulta($query);
	 } 

	public function EliminarBeneficiosTarjeta()
	 {
	 	$query = "DELETE 
			FROM 
			beneficios WHERE idtarjetalealtad=".$this->idtarjetalealtad."";
			
		$result = $this->db->consulta($query);
	 } 
	 public function GuardarBeneficio()
	 {
	 	$query = "INSERT INTO  
			beneficios(idproducto,idtarjetalealtad)  VALUES  ('$this->idbeneficio','$this->idtarjetalealtad')";
			
		$result = $this->db->consulta($query);
	 } 


	public function EliminarClientesTarjeta()
	 {
	 	$query = "DELETE 
			FROM 
			tarjetalealtadcliente WHERE idtarjetalealtad=".$this->idtarjetalealtad."";
			
		$result = $this->db->consulta($query);
	 } 
	 public function GuardarClienteTarjeta()
	 {
	 	try {
	 		$query = "INSERT INTO  
			tarjetalealtadcliente(idtarjetalealtad,idusuario)  VALUES  ('$this->idtarjetalealtad','$this->idusuario')";
			
		$result = $this->db->consulta($query);
	 		
	 	} catch (Exception $e) {
	 		echo $e;
	 		
	 	}
	 	
	 } 


	 public function VerificarSiestaRelacion()
	 {
	 	$query = "SELECT *
			FROM 
			tarjetalealtadasignacion WHERE idtarjetalealtad=".$this->idtarjetalealtad."";
			
		$result = $this->db->consulta($query);
		return $result;
	 }

	 public function EliminarTarjetaLealtad()
	 {
	 	$query = "DELETE 
			FROM 
			tarjetalealtad WHERE idtarjetalealtad=".$this->idtarjetalealtad."";
			
		$result = $this->db->consulta($query);
	 } 



	 public function ObtenerProductosTarjeta()
	 {
		$query="SELECT *FROM reglaslealtad
	 	inner join paquetes ON reglaslealtad.idproducto=paquetes.idpaquete
	 	 WHERE idtarjetalealtad='$this->idtarjetalealtad'";
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


	 public function ObtenerBeneficiosTarjeta()
	 {
	 	$query="SELECT *FROM beneficios WHERE idtarjetalealtad='$this->idtarjetalealtad'";

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


	 public function ObtenerClienteTarjeta()
	 {
	 	$query="SELECT *FROM tarjetalealtadcliente WHERE idtarjetalealtad='$this->idtarjetalealtad'";

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


	/* public function ObtenerTarjetalealtad()
	{	
		$fechaactual=date('Y-m-d');

		$query="SELECT
				*from tarjetalealtad WHERE idsucursal='$this->idsucursal' AND estatus=1 AND fechainicial>='$fechaactual' AND '$fechaactual'<=fechafinal
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
		
	}*/


	public function ObtenerUsuariosConTarjeta()
	{
		
		$sql="SELECT *FROM (SELECT
		tarjetalealtad.nombre,
		tarjetalealtad.descripcion,

		tarjetalealtad.idsucursal,
		tarjetalealtad.orden,
		tarjetalealtad.regla,
		tarjetalealtad.fechainicial,
		tarjetalealtad.fechafinal,
		tarjetalealtad.cantidadrequerida,
		tarjetalealtad.cantidadbeneficio,
		tarjetalealtadasignacion.estatus ,
		tarjetalealtadasignacion.idtarjetalealtadasignacion,
		tarjetalealtad.idtarjetalealtad,
		tarjetalealtadasignacion.valida,
		tblcantidadproducto.cantidadproducto,
		usuarios.idusuarios,
		usuarios.nombre as nombreusuario,
		usuarios.paterno,
		usuarios.materno,
		canje.fecha,
		notapago_descripcion.fecha as fechacompra,
		notapago_descripcion.descripcion as descripcioncompra,
		notacita.citastarjeta
		FROM
		tarjetalealtadasignacion
		JOIN tarjetalealtad
		ON tarjetalealtadasignacion.idtarjetalealtad = tarjetalealtad.idtarjetalealtad
		 LEFT JOIN (
        SELECT  idtarjetalealtadasignacion,SUM(cantidad) AS cantidadproducto
	        FROM tarjetaasignaproducto
	        GROUP BY idtarjetalealtadasignacion
	    ) AS tblcantidadproducto ON tblcantidadproducto.idtarjetalealtadasignacion = tarjetalealtadasignacion.idtarjetalealtadasignacion
		LEFT JOIN usuarios
		ON usuarios.idusuarios=tarjetalealtadasignacion.idusuario
		LEFT JOIN canje ON
		tarjetalealtadasignacion.idtarjetalealtadasignacion=canje.idtarjetalealtadasignacion and canje.estatus=1
		LEFT JOIN carrito_canje ON 
		canje.idcanje=carrito_canje.idcanje
		LEFT JOIN notapago_descripcion
		ON notapago_descripcion.idcarrito=carrito_canje.idcarrito
				LEFT JOIN (
			SELECT GROUP_CONCAT(CONCAT(fecha_texto5(fechacita),'_',horacita,'_',nombrepaquete,'_',folio))  AS citastarjeta ,tarjetalealtadasignacion_notapago.idtarjetalealtadasignacion FROM tarjetalealtadasignacion_notapago
			LEFT JOIN citas on citas.idcita=tarjetalealtadasignacion_notapago.idcita
			LEFT JOIN paquetes on paquetes.idpaquete=citas.idpaquete
			LEFT JOIN notapago ON notapago.idnotapago=tarjetalealtadasignacion_notapago.idnotapago
		GROUP BY tarjetalealtadasignacion_notapago.idtarjetalealtadasignacion
		
		
		)as notacita ON notacita.idtarjetalealtadasignacion=tarjetalealtadasignacion.idtarjetalealtadasignacion


		WHERE  tarjetalealtad.idtarjetalealtad='$this->idtarjetalealtad' ) as tblasig ORDER by  cantidadproducto DESC,nombreusuario ASC ";
		
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



	public function Verificarproductosnota()
	{
		try {
			
		
		$sql="SELECT *FROM (SELECT
		notapago_descripcion.idnotapago,
		notapago_descripcion.descripcion,
		notapago_descripcion.cantidad,
		notapago_descripcion.monto,
		notapago_descripcion.idpaquete,
		notapago_descripcion.fecha,
		notapago_descripcion.idcita,
		notapago_descripcion.tipo,
		notapago_descripcion.costounitario,
		notapago_descripcion.entregado,
		notapago_descripcion.estatus,
		notapago_descripcion.cancelado,
		notapago_descripcion.motivocancelacion,
		notapago_descripcion.idcarrito,
		notapago_descripcion.idcupon,
		notapago.idusuario,
		carrito_canje.idcanje,
		(SELECT COUNT(*) FROM tarjetalealtadasignacion_notapago WHERE tarjetalealtadasignacion_notapago.idnotapago=notapago.idnotapago) AS encontrado

		FROM
		notapago
		LEFT JOIN notapago_descripcion
		ON notapago.idnotapago = notapago_descripcion.idnotapago
		LEFT JOIN  carrito_canje  
		ON carrito_canje.idcarrito=notapago_descripcion.idcarrito
		
 		WHERE notapago.idnotapago='$this->idnotapago' AND cancelado=0 AND idcanje is null  GROUP BY notapago_descripcion.idpaquete)
		AS tbl WHERE encontrado=0
			
			";
 		
 	

		$resp=$this->db->consulta($sql);
		$cont = $this->db->num_rows($resp);


		$array=array();
		$contador=0;
		if ($cont>0) {

			while ($objeto=$this->db->fetch_object($resp)) {

				$idpaquetenota=$objeto->idpaquete;
				$idusuario=$objeto->idusuario;
				$idcita=$objeto->idcita;
				$this->idcita=$idcita;

				$obtenertarjetas=$this->BuscarPaqueteTarjeta($idpaquetenota);



				if (count($obtenertarjetas)>0) {
					# code...
				
				$this->idusuario=$idusuario;


				for ($i=0; $i < count($obtenertarjetas) ; $i++) { 

					$this->idtarjetalealtad=$obtenertarjetas[$i]->idtarjetalealtad;

					$porvisita=$obtenertarjetas[$i]->porvisita;
					$validavisita=0;
					$fechaactual=date('Y-m-d');
					$obtenernotasdia=[];
					if ($porvisita==1) {
						$validavisita=1;
						$obtenernotasdia=$this->ObtenerNotasComprasDia($fechaactual);
					}

					$numerorepeticiones=$obtenertarjetas[$i]->repeticiones;
					


					$contarcuantaslleva=$this->BuscarTarjetasAsignadasUsuario($idusuario);

					if ($numerorepeticiones=='') {
						$numerorepeticiones=0;
						$contarcuantaslleva=[];
					}

					if (count($contarcuantaslleva)<=$numerorepeticiones && count($obtenernotasdia)==0) {
						
					



					$this->idproducto=$objeto->idpaquete;

					$buscarestaasignada=$this->BuscarTarjetaAsignada($idusuario);

						if (count($buscarestaasignada)>0) {

							$this->idtarjetalealtadasignacion=$buscarestaasignada[0]->idtarjetalealtadasignacion;
							$this->SumarTarjetaProducto();
							$this->GuardarNotaAsignacion();
						
						}else{


							$this->CrearTarjetaAsignacion();
							$this->SumarTarjetaProducto();

							$this->GuardarNotaAsignacion();
							}

							}
							
							
						}

					}


				} 
			}
			
		

		} catch (Exception $e) {
			echo $e;
		}
	}

	public function BuscarPaqueteTarjeta($idpaquete)
	{
		$fechaactual=date('Y-m-d');
		
		$sqlpa="SELECT
			reglaslealtad.idproducto,
			tarjetalealtad.nombre,
			tarjetalealtad.descripcion,
			tarjetalealtad.cantidadrequerida,
			tarjetalealtad.cantidadbeneficio,
			tarjetalealtad.regla,
			tarjetalealtad.idsucursal,
			tarjetalealtad.idtarjetalealtad,
			tarjetalealtad.repeticiones,
			tarjetalealtad.porvisita
			FROM
			reglaslealtad
			JOIN tarjetalealtad
			ON reglaslealtad.idtarjetalealtad = tarjetalealtad.idtarjetalealtad WHERE idproducto='$idpaquete' AND tarjetalealtad.estatus=1 AND'$fechaactual'>= tarjetalealtad.fechainicial AND '$fechaactual'<=tarjetalealtad.fechafinal";
			
		$resp1=$this->db->consulta($sqlpa);
		$cont = $this->db->num_rows($resp1);


		$array=array();
		$contador=0;
		if ($cont>0) {

			while ($objeto2=$this->db->fetch_object($resp1)) {

				$array[$contador]=$objeto2;
				$contador++;
			} 
		}
		
		return $array;

	}


	public function BuscarTarjetaAsignada($idusuario)
	{
		/*$sqlasignada="SELECT *FROM tarjetalealtadasignacion
		WHERE idtarjetalealtad='$this->idtarjetalealtad' AND estatus=0 AND idusuario='$this->idusuario'";*/

		$sqlasignada="
		SELECT *
		FROM 
		tarjetalealtadasignacion
		 LEFT JOIN (
        SELECT  idtarjetalealtadasignacion,SUM(cantidad) AS cantidadproducto
	        FROM tarjetaasignaproducto
	        GROUP BY idtarjetalealtadasignacion
	    ) AS tblcantidadproducto ON tblcantidadproducto.idtarjetalealtadasignacion = tarjetalealtadasignacion.idtarjetalealtadasignacion
	
		LEFT JOIN(
			select tbll.cantidadrequerida,tbll.idtarjetalealtad from tarjetalealtad as tbll
		)as tblealtad on tblealtad.idtarjetalealtad=tarjetalealtadasignacion.idtarjetalealtad
		WHERE
		tarjetalealtadasignacion.idtarjetalealtad='$this->idtarjetalealtad' AND estatus=0 
		  AND idusuario='$this->idusuario' and cantidadproducto<cantidadrequerida";

		$respasig=$this->db->consulta($sqlasignada);
		$cont = $this->db->num_rows($respasig);


		$array=array();
		$contador=0;
		if ($cont>0) {

			while ($objeto=$this->db->fetch_object($respasig)) {

				$array[$contador]=$objeto;
				$contador++;
			} 
		}
		
		return $array;

	}


	public function SumarTarjetaProducto()
	{
		try {

			$sqlsuma="SELECT
			tarjetalealtadasignacion.idtarjetalealtadasignacion,
			tarjetalealtadasignacion.idusuario,
			tarjetalealtadasignacion.fecha,
			tarjetalealtadasignacion.valida,
			tarjetalealtadasignacion.estatus,
			tarjetalealtadasignacion.idtarjetalealtad,
			tarjetaasignaproducto.idproducto,
			tarjetaasignaproducto.cantidad
			FROM
			tarjetalealtadasignacion
			LEFT JOIN tarjetaasignaproducto
			ON tarjetalealtadasignacion.idtarjetalealtadasignacion = tarjetaasignaproducto.idtarjetalealtadasignacion

			WHERE idtarjetalealtad='$this->idtarjetalealtad' AND idproducto='$this->idproducto'  AND tarjetalealtadasignacion.idtarjetalealtadasignacion='$this->idtarjetalealtadasignacion'";

				$respsuma=$this->db->consulta($sqlsuma);
				$cont = $this->db->num_rows($respsuma);


				$array=array();
				$contador=0;
				if ($cont>0) {

					while ($objeto=$this->db->fetch_object($respsuma)) {

					$cantidad=$objeto->cantidad+1;
					$this->idtarjetalealtadasignacion=$objeto->idtarjetalealtadasignacion;

					$sql2="UPDATE tarjetaasignaproducto SET cantidad='$cantidad'  WHERE idtarjetalealtadasignacion='$objeto->idtarjetalealtadasignacion' AND idproducto='$this->idproducto'";
					
					$resp2=$this->db->consulta($sql2);


					} 
			}else{

				$sql3="INSERT INTO tarjetaasignaproducto( idproducto, cantidad, idtarjetalealtadasignacion) VALUES ( '$this->idproducto','1', '$this->idtarjetalealtadasignacion')";

				
					$resp3=$this->db->consulta($sql3);


			}
			
		
			
		} catch (Exception $e) {
			echo $e;
		}
		
	}

	public function CrearTarjetaAsignacion()
	{
			$querytarjeta = "INSERT INTO  
			tarjetalealtadasignacion(idtarjetalealtad,idusuario,estatus,valida)  VALUES  ('$this->idtarjetalealtad','$this->idusuario',0,0)";
			
			$result = $this->db->consulta($querytarjeta);
			$this->idtarjetalealtadasignacion=$this->db->id_ultimo();
	}


	public function ObtenerTarjetasAsignadas($value='')
	{
		$fechaactual=date('Y-m-d');
		$sqlpa="SELECT
		tarjetalealtad.nombre,
		tarjetalealtad.descripcion,
	  tarjetalealtad.estatus,
		tarjetalealtad.idsucursal,
		tarjetalealtad.orden,
		tarjetalealtad.regla,
		tarjetalealtad.fechainicial,
		tarjetalealtad.fechafinal,
		tarjetalealtad.cantidadrequerida,
		tarjetalealtad.cantidadbeneficio,
		tarjetalealtadasignacion.estatus ,
		tarjetalealtadasignacion.idtarjetalealtadasignacion,
		tarjetalealtad.idtarjetalealtad,
		tarjetalealtadasignacion.valida,
		tblcantidadproducto.cantidadproducto
		FROM
		tarjetalealtadasignacion
		JOIN tarjetalealtad
		ON tarjetalealtadasignacion.idtarjetalealtad = tarjetalealtad.idtarjetalealtad
		 LEFT JOIN (
        SELECT  idtarjetalealtadasignacion,SUM(cantidad) AS cantidadproducto
	        FROM tarjetaasignaproducto
	        GROUP BY idtarjetalealtadasignacion
	    ) AS tblcantidadproducto ON tblcantidadproducto.idtarjetalealtadasignacion = tarjetalealtadasignacion.idtarjetalealtadasignacion


		WHERE tarjetalealtadasignacion.estatus=0 and tarjetalealtad.estatus=1 and tarjetalealtadasignacion.idusuario='$this->idusuario' ";

			if ($this->idsucursal!=0) {

			$sqlpa.=" AND tarjetalealtad.idsucursal='$this->idsucursal'";
			}


			if ($fechaactual!='') {
				// code...
			
			$sqlpa.=" AND'$fechaactual'>= tarjetalealtad.fechainicial AND '$fechaactual'<=tarjetalealtad.fechafinal";

		}
		
		$resp1=$this->db->consulta($sqlpa);
		$cont = $this->db->num_rows($resp1);


		$array=array();
		$contador=0;
		if ($cont>0) {

			while ($objeto2=$this->db->fetch_object($resp1)) {

				$array[$contador]=$objeto2;
				$contador++;
			} 
		}
		
		return $array;
	}



	public function ObtenerAsignaciontarjeta()
	{
		try {

			$sqlsuma="SELECT
			tarjetalealtadasignacion.idtarjetalealtadasignacion,
			tarjetalealtadasignacion.idusuario,
			tarjetalealtadasignacion.fecha,
			tarjetalealtadasignacion.valida,
			tarjetalealtadasignacion.estatus,
			tarjetalealtadasignacion.idtarjetalealtad,
			tarjetaasignaproducto.idproducto,
			tarjetaasignaproducto.cantidad,
			tarjetalealtad.cantidadbeneficio
			FROM
			tarjetalealtadasignacion
			LEFT JOIN tarjetaasignaproducto
			ON tarjetalealtadasignacion.idtarjetalealtadasignacion = tarjetaasignaproducto.idtarjetalealtadasignacion

			 LEFT JOIN (
        SELECT  idtarjetalealtadasignacion,SUM(cantidad) AS cantidadproducto
	        FROM tarjetaasignaproducto
	        GROUP BY idtarjetalealtadasignacion
	    ) AS tblcantidadproducto ON tblcantidadproducto.idtarjetalealtadasignacion = tarjetalealtadasignacion.idtarjetalealtadasignacion
			LEFT JOIN tarjetalealtad ON tarjetalealtad.idtarjetalealtad=tarjetalealtadasignacion.idtarjetalealtad

			WHERE  idproducto='$this->idproducto'  AND tarjetalealtadasignacion.idtarjetalealtadasignacion='$this->idtarjetalealtadasignacion'";


		$resp1=$this->db->consulta($sqlsuma);
		$cont = $this->db->num_rows($resp1);


		$array=array();
		$contador=0;
		if ($cont>0) {

			while ($objeto2=$this->db->fetch_object($resp1)) {

				$array[$contador]=$objeto2;
				$contador++;
			} 
		}
		
		return $array;
		
			
		} catch (Exception $e) {
			echo $e;
		}
		
	}


	public function BuscarTarjetasAsignadasUsuario($idusuario)
	{
		$sqlasignada="SELECT *FROM tarjetalealtadasignacion
		WHERE idtarjetalealtad='$this->idtarjetalealtad' AND idusuario='$this->idusuario'";


		$respasig=$this->db->consulta($sqlasignada);
		$cont = $this->db->num_rows($respasig);


		$array=array();
		$contador=0;
		if ($cont>0) {

			while ($objeto=$this->db->fetch_object($respasig)) {

				$array[$contador]=$objeto;
				$contador++;
			} 
		}
		
		return $array;

	}


	public function ObtenerNotasComprasDia($fechaactual)
	{

		/*$slqcompras="SELECT *FROM notapago
		LEFT JOIN notapago_descripcion
		on notapago_descripcion.idnotapago=notapago.idnotapago

		LEFT JOIN(SELECT
			reglaslealtad.idproducto,
			tarjetalealtad.nombre,
			tarjetalealtad.descripcion,
			tarjetalealtad.cantidadrequerida,
			tarjetalealtad.cantidadbeneficio,
			tarjetalealtad.regla,
			tarjetalealtad.idsucursal,
			tarjetalealtad.idtarjetalealtad,
			tarjetalealtad.repeticiones,
			tarjetalealtad.porvisita
			FROM
			reglaslealtad
			JOIN tarjetalealtad
			ON reglaslealtad.idtarjetalealtad = tarjetalealtad.idtarjetalealtad 
			WHERE tarjetalealtad.estatus=1 AND '$fechaactual'<=tarjetalealtad.fechafinal
			)as reglas on reglas.idproducto=notapago_descripcion.idpaquete
		inner join citas ON citas.idcita=notapago_descripcion.idcita
		WHERE  DATE(citas.fechacita)='$fechaactual'  AND notapago.idusuario='$this->idusuario' AND notapago.idnotapago  NOT IN($this->idnotapago) AND notapago.estatus=1

		";*/
		$slqcompras="
			SELECT
    notapago_descripcion.idnotapago_descripcion,
    notapago_descripcion.idnotapago,
    notapago_descripcion.descripcion,
    notapago_descripcion.cantidad,
    notapago_descripcion.monto,
    notapago_descripcion.idcita,
    notapago.idusuario,
    notapago.fecha,
    citas.idcita AS idcita_0,
    citas.estatus,
    citas.fechacita,
    notapago_descripcion.estatus AS estatus_0
FROM
    notapago_descripcion
LEFT JOIN notapago ON notapago_descripcion.idnotapago = notapago.idnotapago
LEFT JOIN citas ON notapago_descripcion.idcita = citas.idcita

LEFT JOIN(SELECT
			reglaslealtad.idproducto,
			tarjetalealtad.nombre,
			tarjetalealtad.descripcion,
			tarjetalealtad.cantidadrequerida,
			tarjetalealtad.cantidadbeneficio,
			tarjetalealtad.regla,
			tarjetalealtad.idsucursal,
			tarjetalealtad.idtarjetalealtad,
			tarjetalealtad.repeticiones,
			tarjetalealtad.porvisita
			FROM
			reglaslealtad
			JOIN tarjetalealtad
			ON reglaslealtad.idtarjetalealtad = tarjetalealtad.idtarjetalealtad 
			WHERE tarjetalealtad.estatus=1 AND '$fechaactual'<=tarjetalealtad.fechafinal AND tarjetalealtad.idtarjetalealtad='1'
			)as reglas on reglas.idproducto=citas.idpaquete
			
	inner JOIN tarjetalealtadasignacion_notapago ON tarjetalealtadasignacion_notapago.idcita=notapago_descripcion.idcita
		
	WHERE
       notapago.idusuario='$this->idusuario' AND 
     citas.idusuarios= '$this->idusuario'
    AND notapago.idusuario = '$this->idusuario'
    AND citas.estatus != 3 AND citas.fechacita='$this->fechacita' AND citas.idcita NOT IN('$this->idcita') ";

		
		$respasig=$this->db->consulta($slqcompras);
		$cont = $this->db->num_rows($respasig);


		$array=array();
		$contador=0;
		if ($cont>0) {

			while ($objeto=$this->db->fetch_object($respasig)) {

				

				$array[$contador]=$objeto;
				$contador++;
			} 
		}
	

		return $array;

	}




	public function GuardarNotaAsignacion()
	{
		$sql="INSERT INTO tarjetalealtadasignacion_notapago( idtarjetalealtadasignacion, idnotapago,idcita) VALUES ('$this->idtarjetalealtadasignacion', '$this->idnotapago','$this->idcita')";
		
		$resp = $this->db->consulta($sql);
	}



	public function Obtenertarjetas()
	{

		$sqltarjeta="SELECT *FROM tarjetalealtad WHERE idsucursal='$this->idsucursal' AND estatus=1";
		$respasig=$this->db->consulta($sqltarjeta);
		$cont = $this->db->num_rows($respasig);


		$array=array();
		$contador=0;
		if ($cont>0) {

			while ($objeto=$this->db->fetch_object($respasig)) {

				

				$array[$contador]=$objeto;
				$contador++;
			} 
		}
	

		return $array;
	}



	public function ObtenerUsuariosConTarjetaVisitas()
	{
		
		$sql="SELECT *
FROM (
    SELECT
        tarjetalealtad.nombre,
        tarjetalealtad.descripcion,
        tarjetalealtad.idsucursal,
        tarjetalealtad.orden,
        tarjetalealtad.regla,
        tarjetalealtad.fechainicial,
        tarjetalealtad.fechafinal,
        tarjetalealtad.cantidadrequerida,
        tarjetalealtad.cantidadbeneficio,
        tarjetalealtadasignacion.estatus,
        tarjetalealtadasignacion.idtarjetalealtadasignacion,
        tarjetalealtad.idtarjetalealtad,
        tarjetalealtadasignacion.valida,
        tblcantidadproducto.cantidadproducto,
        usuarios.idusuarios,
        usuarios.nombre AS nombreusuario,
        usuarios.paterno,
        usuarios.materno,
        canje.fecha,
        notapago_descripcion.fecha AS fechacompra,
        notapago_descripcion.descripcion AS descripcioncompra,
        COALESCE(notacita.citastarjeta, 0) AS citastarjeta
    FROM
        tarjetalealtadasignacion
    JOIN tarjetalealtad
        ON tarjetalealtadasignacion.idtarjetalealtad = tarjetalealtad.idtarjetalealtad
    LEFT JOIN (
        SELECT
            idtarjetalealtadasignacion,
            SUM(cantidad) AS cantidadproducto
        FROM
            tarjetaasignaproducto
        GROUP BY
            idtarjetalealtadasignacion
    ) AS tblcantidadproducto
        ON tblcantidadproducto.idtarjetalealtadasignacion = tarjetalealtadasignacion.idtarjetalealtadasignacion
    LEFT JOIN usuarios
        ON usuarios.idusuarios = tarjetalealtadasignacion.idusuario
    LEFT JOIN canje
        ON tarjetalealtadasignacion.idtarjetalealtadasignacion = canje.idtarjetalealtadasignacion AND canje.estatus = 1
    LEFT JOIN carrito_canje
        ON canje.idcanje = carrito_canje.idcanje
    LEFT JOIN notapago_descripcion
        ON notapago_descripcion.idcarrito = carrito_canje.idcarrito
    LEFT JOIN (
        SELECT 
            tarjetalealtadasignacion.idtarjetalealtad,
            tarjetalealtadasignacion.idusuario,
            COUNT(*) AS citastarjeta
        FROM
            tarjetalealtadasignacion_notapago
        LEFT JOIN tarjetalealtadasignacion
            ON tarjetalealtadasignacion.idtarjetalealtadasignacion = tarjetalealtadasignacion_notapago.idtarjetalealtadasignacion
        GROUP BY
            tarjetalealtadasignacion.idtarjetalealtad,
            tarjetalealtadasignacion.idusuario
    ) AS notacita
        ON notacita.idtarjetalealtad = tarjetalealtadasignacion.idtarjetalealtad 
        AND notacita.idusuario = usuarios.idusuarios
    WHERE
        tarjetalealtad.idtarjetalealtad = '$this->idtarjetalealtad'
) AS tblasig

GROUP BY idusuarios,idtarjetalealtad

ORDER BY
    cantidadproducto DESC,
    nombreusuario ASC; ";
		
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



	public function CitasAsignacion($value='')
	{
		$sql="	SELECT CONCAT(fecha_texto5(fechacita),'_',horacita,'_',nombrepaquete,'_',folio)  AS citastarjeta2 ,tarjetalealtadasignacion_notapago.idtarjetalealtadasignacion,tarjetalealtadasignacion.idusuario,tarjetalealtadasignacion.idtarjetalealtad
 FROM  tarjetalealtadasignacion
			 LEFT JOIN tarjetalealtadasignacion_notapago
            ON tarjetalealtadasignacion.idtarjetalealtadasignacion = tarjetalealtadasignacion_notapago.idtarjetalealtadasignacion
			LEFT JOIN citas on citas.idcita=tarjetalealtadasignacion_notapago.idcita
			LEFT JOIN paquetes on paquetes.idpaquete=citas.idpaquete
			LEFT JOIN notapago ON notapago.idnotapago=tarjetalealtadasignacion_notapago.idnotapago

			WHERE tarjetalealtadasignacion.idtarjetalealtad='$this->idtarjetalealtad' AND tarjetalealtadasignacion.idusuario='$this->idusuario'
				ORDER BY citas.idcita asc
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