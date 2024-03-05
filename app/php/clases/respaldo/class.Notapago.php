<?php 

class Notapago 
{
	public $db;
	public $idnotapago;
	public $idusuario;
	public $fecha;
	public $subtotal;
	public $iva;
	public $total;
	public $comisiontotal;
	public $montomonedero;
	public $estatus;
	public $tipopago;
	public $idtipopago;
	public $confoto;
	public $datostarjeta;
	public $datostarjeta2;
	public $idpagostripe;
	public $folio;
	public $descuento;
	public $descuentomembresia;
	public $cambio;
	public $montovisual;

	public $descripcion;
	public $cantidad;
	public $monto;
	public $idpaquete;
	public $comisionpornota;
	public $comisionnota;
	public $tipocomisionpornota;

	public $requierefactura;
	public $razonsocial;
	public $rfc;
	public $direccion;
	public $nointerior;
	public $noexterior;
	public $colonia;
	public $municipio;
	public $estado;
	public $codigopostal;
	public $correo;
	public $pais;
	public $asentamiento;
	public $calle;
	public $calle1;
	public $referencia;
	public $formapago;
	public $metodopago;
	public $usocfdi;
	public $imagenconstancia;
	public $idusuariodatofiscal;
	public $idcita;
	public $idusuarios;
	public $fechareporte;
	public $idsucursal;
	public $checkConfirm;
	public $idnotapagodescripcion;
	public $cancelado;
	public $fechacancelado;
	public $motivocancelacion;
	public $idusuariocancela;
	public $codigocupon;
	public $montocupon;
	public $idcupon;
	public $monederoaplicado;
	public $descripcioncupon;
	public $costounitario;

	public function CrearNotapago()
	{
		$sql="INSERT INTO notapago( idusuario, subtotal, iva, total, comisiontotal, montomonedero, estatus, idtipopago, tipopago, confoto, datostarjeta,datostarjeta2,idpagostripe,folio,comisionpornota,comisionnota,tipocomisionpornota,requierefactura,razonsocial,rfc,direccion,nointerior,noexterior,colonia,municipio,estado,codigopostal,correo,pais,asentamiento,calle,formapago,metodopago,usocfdi,imagenconstancia,idusuariodatofiscal,confirmaciontermino,montocupon,codigocupon,idcupon,descripcioncupon) VALUES ('$this->idusuario', '$this->subtotal','$this->iva', '$this->total', '$this->comisiontotal','$this->montomonedero','$this->estatus','$this->idtipopago','$this->tipopago','$this->confoto','$this->datostarjeta','$this->datostarjeta2','$this->idpagostripe','$this->folio','$this->comisionpornota','$this->comisionnota','$this->tipocomisionpornota',
			'$this->requierefactura',
			'$this->razonsocial',
			'$this->rfc',
			'$this->direccion',
			'$this->nointerior',
			'$this->noexterior',
			'$this->colonia',
			'$this->municipio',
			'$this->estado',
			'$this->codigopostal',
			'$this->correo',
			'$this->pais',
			'$this->asentamiento',
			'$this->calle',
			'$this->formapago',
			'$this->metodopago',
			'$this->usocfdi',
			'$this->imagenconstancia',
			'$this->idusuariodatofiscal',
			'$this->checkConfirm',
			'$this->montocupon',
			'$this->codigocupon',
			'$this->idcupon',
			'$this->descripcioncupon'

			)";

			
		 $resp=$this->db->consulta($sql);
		 $this->idnotapago=$this->db->id_ultimo();

	}

	public function ActualizarNotapago()
	{
		 /* subtotal = '$this->subtotal',
			  iva = '$this->iva', 
			  total = '$this->total', 
			  comisiontotal = '$this->comisiontotal',
			  montomonedero = '$this->montomonedero', */
			  try {
			  	$sql="UPDATE notapago SET 
			
			  estatus = '$this->estatus',  
			  idpagostripe = '$this->idpagostripe', 
			  descuento='$this->descuento',
			  descuentomembresia='$this->descuentomembresia',
			  fechareporte='$this->fechareporte'
			  WHERE idnotapago='$this->idnotapago'";
			
				$resp=$this->db->consulta($sql);

			  	
			  } catch (Exception $e) {
			  	echo $e;
			  }
		
  
	}

	public function Creardescripcionpago()
	{
		try {
			$sql="INSERT INTO notapago_descripcion(idnotapago, descripcion, cantidad, monto, idpaquete,idcita,tipo,costounitario,monederoaplicado,idcupon,codigocupon,montocupon) VALUES ( '$this->idnotapago', '$this->descripcion', '$this->cantidad','$this->monto', '$this->idpaquete','$this->idcita','$this->tipo','$this->costounitario','$this->monederoaplicado','$this->idcupon','$this->codigocupon','$this->montocupon')";
		
		$resp=$this->db->consulta($sql);
		$this->idnotapagodescripcion=$this->db->id_ultimo();
			
		} catch (Exception $e) {
			echo $e;
		}
		
	}
	

	public function Obtenernota()
	{
		$sql="
			SELECT *FROM notapago
			 WHERE idnotapago='$this->idnotapago' ";
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
	

	public function ObtenerPagosStripe()
	{
		$sql="
			SELECT 
			pagos.idpago,
			pagos.idusuarios,
			pagos.idservicio,
			pagos.idmembresia,
			pagos.tipo,
			pagos.monto,
			pagos.estatus,
			pagos.fechapago,
			pagos.tarjeta,
			pagos.fechacreacion,
			pagos.pagado,
			pagos.digitostarjeta,
			pagos.tipopago,
			pagos.fechaevento,
			pagos.dividido,
			pagos.fechainicial,
			pagos.folio,
			pagos.idtipopago,
			pagos.fechafinal,
			pagos.concepto,
			pagos.tipodepago,
			pagos.descuento,
			pagos_pagostripe.idpagostripe,
			pagos_pagostripe.idpagopagostripe

			FROM pagos_pagostripe
			INNER JOIN pagos ON pagos_pagostripe.idpago=pagos.idpago
			 WHERE idpagostripe='$this->idpagostripe'


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


	public function ObtenerdescripcionNota()
	{ 
		$sql="
			SELECT idnotapago,notapago_descripcion.descripcion as concepto,monto,DATE_FORMAT(fechacita,'%d-%m-%Y')as fecha,notapago_descripcion.cantidad,paquetes.foto,
				citas.idespecialista,
				(SELECT  CONCAT(usuarios.nombre,' ',usuarios.paterno) FROM especialista INNER JOIN usuarios on usuarios.idusuarios=especialista.idusuarios where especialista.idespecialista=citas.idespecialista ) as usuarioespecialista,
					paquetes.concortesia,
					paquetes.servicio,
					sucursal.titulo,
					paquetecortesia.nombrepaquete as nombrepaquetecortesia,
					citas.horainicial,
			notapago_descripcion.idpaquete,
			notapago_descripcion.monto,
			notapago_descripcion.montocupon,
			notapago_descripcion.codigocupon,
			notapago_descripcion.idcupon,
			notapago_descripcion.monederoaplicado,	
			citas.idcortesia,
			cupones.tipodescuento,
			cupones.descuento,
			notapago_descripcion.idnotapago_descripcion

			FROM notapago_descripcion 
			left join paquetes on paquetes.idpaquete=notapago_descripcion.idpaquete
			left join paquetesucursal on paquetes.idpaquete=paquetesucursal.idpaquete
			left join sucursal on paquetesucursal.idsucursal=sucursal.idsucursal

			LEFT JOIN citas on citas.idcita=notapago_descripcion.idcita
			left join cortesia 
			ON citas.idcortesia=cortesia.idcortesia
			left join paquetes as paquetecortesia on paquetecortesia.idpaquete=cortesia.idpaquetecortesia
			left join cupones on notapago_descripcion.idcupon=cupones.idcupon
			
		 WHERE idnotapago='$this->idnotapago'";
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

	public function ObtenerImagenesComprobante()
	{
		$sql="SELECT * FROM notapago_comprobante WHERE idnotapago='$this->idnotapago'";
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

	public function ActualizarMonto()
	{
		try {

			$sql="UPDATE notapago SET 
			  cambio = '$this->cambio',
			  montovisual = '$this->montovisual', 
			  estatus = '$this->estatus'
			  WHERE idnotapago='$this->idnotapago'";
	
		$resp=$this->db->consulta($sql);

			
		} catch (Exception $e) {
			echo $e;
		}
		
  
	}

	public function ActualizarConsecutivo()
	{

		 $sql="SELECT *FROM pagina_configuracion";
		 $resp = $this->db->consulta($sql);
		 $datos=$this->db->fetch_assoc($resp);


		 $val=$datos['contadorfolio'];
		 $valor=$val+1;

		$sql="UPDATE pagina_configuracion SET contadorfolio='$valor'";


		 $resp = $this->db->consulta($sql);
		return $val;
		
	}



	public function ListadoNotaspagospagados()
		{
			$sql = "SELECT *FROM
					notapago		
			    	WHERE notapago.idusuario  
			    	IN($this->idusuarios) AND estatus IN(0,1) ORDER BY idnotapago DESC";
			    	
			$resp = $this->db->consulta($sql);
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




		public function ListadoNotasProductos()
		{
			$sql = "SELECT *from (SELECT *,
					(SELECT COUNT(*) from notapago_descripcion WHERE  notapago_descripcion.tipo=0  and notapago_descripcion.idnotapago=notapago.idnotapago)as productos
				FROM
					notapago

			    	WHERE   
			    	 estatus IN(1) ) as tabla1 WHERE productos>0 AND 
			    	  DATE(fechareporte)='$this->fecha' ORDER BY idnotapago DESC";
		
			$resp = $this->db->consulta($sql);
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

		public function ListadoNotasDescripcionProductos()
		{
			$sql = "
				SELECT
				notapago_descripcion.idnotapago,
				notapago_descripcion.descripcion,
				notapago_descripcion.cantidad,
				notapago_descripcion.monto,
				notapago_descripcion.idpaquete,
				notapago_descripcion.fecha,
				notapago.folio,
				notapago.fecha,
				notapago.estatus,
				paquetes.nombrepaquete,
				usuarios.nombre,
				usuarios.paterno,
				usuarios.materno,
				notapago_descripcion.entregado,
				notapago_descripcion.fechaentregado,
				paquetes.servicio,
				sucursal.imagen,
				CONCAT(sucursal.titulo,'-',sucursal.descripcion) as nombresucursal
				FROM
				notapago_descripcion
				LEFT JOIN paquetes
				ON notapago_descripcion.idpaquete = paquetes.idpaquete 
				LEFT JOIN notapago
				ON notapago.idnotapago = notapago_descripcion.idnotapago 
				LEFT JOIN paquetesucursal
				ON paquetesucursal.idpaquete = paquetes.idpaquete 
				left JOIN usuarios
				ON usuarios.idusuarios = notapago.idusuario 
				left JOIN sucursal
				ON paquetesucursal.idsucursal = sucursal.idsucursal WHERE servicio=0 AND 
			    	  DATE(fechareporte)='$this->fecha' ORDER BY idnotapago DESC";
		
			$resp = $this->db->consulta($sql);
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


		public function ActualizarConsecutivoCancelado()
	{

		 $sql="SELECT *FROM pagina_configuracion";
		 $resp = $this->db->consulta($sql);
		 $datos=$this->db->fetch_assoc($resp);


		 $val=$datos['contadorfoliocancelado'];
		 $valor=$val+1;

		$sql="UPDATE pagina_configuracion SET contadorfoliocancelado='$valor'";


		 $resp = $this->db->consulta($sql);
		return $val;
		
	}

	public function ActualizarEstatusdescripcion()
	{
			$sql="UPDATE notapago_descripcion SET 
			  cancelado = '$this->cancelado',  
			  fechacancelado='$this->fechacancelado',
			  motivocancelacion='$this->motivocancelacion',
			  idusuariocancelacion='$this->idusuariocancela'
			  WHERE idnotapago_descripcion='$this->idnotapagodescripcion'";
			
				$resp=$this->db->consulta($sql);
	}


	public function VerificarCitaPagada()
	{
		$sql="SELECT
		notapago_descripcion.idnotapago_descripcion,
		notapago_descripcion.idnotapago,
		notapago_descripcion.idcita,
		notapago.idusuario,
		notapago.estatus,
		notapago.tpv,
		notapago.tipopago
		FROM
		notapago
		JOIN notapago_descripcion
		ON notapago.idnotapago = notapago_descripcion.idnotapago
		WHERE notapago.estatus=0 and notapago_descripcion.idcita= '$this->idcita' GROUP BY idnotapago";


		$resp = $this->db->consulta($sql);
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


	public function Obtenerdescripcion()
	{
		$sql="
			SELECT *FROM notapago_descripcion
			 WHERE idnotapago_descripcion='$this->idnotapagodescripcion' ";
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



	public function GuardarNuevoMonto()
	{
		$sql="UPDATE notapago_descripcion 
		SET costounitario='$this->costounitario',
		monto='$this->costototal',
		cantidad='$this->cantidad'
		WHERE idnotapago_descripcion='$this->idnotapagodescripcion'";
		
		$resp=$this->db->consulta($sql);
	}


}
 ?>