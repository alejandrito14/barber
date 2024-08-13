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
	public $montovisual;
	public $cambio;

	public $descripcion;
	public $cantidad;
	public $monto;
	public $idpago;
	public $descripcionaceptacion;
	public $tpv;
	public $idcita;
	public $tipopagoante;
	public $idtipopagoante;
	public $fechacompletado;

	public $entregado;
	public $fechaentrega;
	public $idusuarioentrega;
	public $observacionesentrega;
	public $idnotapagodescripcion;
	public $idcarrito;
	public $costounitario;
	public $idsucursal;

	public $idbancoseleccionado;
	public $idopciontarjetaseleccionado;
	public $digitostarjeta;

	public function CrearNotapago()
	{
		
		$sql="INSERT INTO notapago( idusuario, subtotal, iva, total, comisiontotal, montomonedero, estatus, idtipopago, tipopago, confoto, datostarjeta,datostarjeta2,idpagostripe,folio,comisionpornota,comisionnota,tipocomisionpornota,requierefactura,razonsocial,rfc,direccion,nointerior,noexterior,colonia,municipio,estado,codigopostal,correo,pais,asentamiento,calle,formapago,metodopago,usocfdi,imagenconstancia,idusuariodatofiscal,confirmaciontermino,montocupon,codigocupon,idcupon,descripcioncupon,tpv,idsucursal,idbanco,tipotarjeta,digitostarjeta) VALUES ('$this->idusuario', '$this->subtotal','$this->iva', '$this->total', '$this->comisiontotal','$this->montomonedero','$this->estatus','$this->idtipopago','$this->tipopago','$this->confoto','$this->datostarjeta','$this->datostarjeta2','$this->idpagostripe','$this->folio','$this->comisionpornota','$this->comisionnota','$this->tipocomisionpornota',
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
			'$this->descripcioncupon',
			'$this->tpv',
			'$this->idsucursal',
			'$this->idbancoseleccionado',
			'$this->idopciontarjetaseleccionado',
			'$this->digitostarjeta'

			)";
			
		 $resp=$this->db->consulta($sql);
		 $this->idnotapago=$this->db->id_ultimo();

	}

	public function ActualizarNotapago()
	{
		$sql="UPDATE notapago SET 
			  subtotal = '$this->subtotal',
			  iva = '$this->iva', 
			  total = '$this->total', 
			  comisiontotal = '$this->comisiontotal',
			  montomonedero = '$this->montomonedero', 
			  estatus = '$this->estatus',  
			  idpagostripe = '$this->idpagostripe', 
			  descuento='$this->descuento',
			  descuentomembresia='$this->descuentomembresia'
			  WHERE idnotapago='$this->idnotapago'";

		$resp=$this->db->consulta($sql);

  
	}


	public function ActualizarNotaAIncompleto()
	{
		try {
			$sql="UPDATE notapago SET 
				  estatus =3 
		WHERE idnotapago='$this->idnotapago'";
				  
			$resp=$this->db->consulta($sql);
			
		} catch (Exception $e) {
			echo $e;
		}
		
	}
/*	public function Creardescripcionpago()
	{
		$sql="INSERT INTO notapago_descripcion( idnotapago, descripcion, cantidad, monto, idpago) VALUES ( '$this->idnotapago', '$this->descripcion', '$this->cantidad','$this->monto', '$this->idpago')";

		$resp=$this->db->consulta($sql);

	}*/

	public function Creardescripcionpago()
	{
		try {
			$sql="INSERT INTO notapago_descripcion(idnotapago, descripcion, cantidad, monto, idpaquete,idcita,tipo,costounitario,monederoaplicado,idcupon,codigocupon,montocupon,idcarrito) VALUES ( '$this->idnotapago', '$this->descripcion', '$this->cantidad','$this->monto', '$this->idpaquete','$this->idcita','$this->tipo','$this->costounitario','$this->monederoaplicado','$this->idcupon','$this->codigocupon','$this->montocupon','$this->idcarrito')";
		
		$resp=$this->db->consulta($sql);
		//$this->idnotapagodescripcion=$this->db->id_ultimo();
			
		} catch (Exception $e) {
			echo $e;
		}
		
	}
	

	public function Obtenernota()
	{
		$sql="
			SELECT notapago.*,CONCAT(usuarios.nombre,' ',usuarios.paterno) as usuarioentrega ,CONCAT(u.nombre,' ',u.paterno) as usuariopedido FROM notapago
			LEFT JOIN usuarios ON notapago.idusuarioentrega=usuarios.idusuarios
			LEFT JOIN usuarios as u ON notapago.idusuario=u.idusuarios
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
	

	public function Obtenernota2($value='')
	{
		$sql="
			SELECT notapago.*,sucursal.titulo,sucursal.rfcsucursal,sucursal.direccion,sucursal.celular,multiple.multipletipopago,CONCAT(usuarios.nombre,' ',usuarios.paterno,' ',usuarios.materno) as nombrecliente,sucursal.imagen
			 FROM notapago
			LEFT JOIN sucursal ON notapago.idsucursal=sucursal.idsucursal


			LEFT JOIN (
			    SELECT
			        notapago_notapagometodopago.idnotapago,
			        GROUP_CONCAT(notapagometodopago.tipopago) as multipletipopago
			    FROM
			        notapago_notapagometodopago
			    JOIN
			        notapagometodopago ON notapago_notapagometodopago.idnotapagometodopago = notapagometodopago.idnotapagometodopago
			    GROUP BY
			        notapago_notapagometodopago.idnotapago
			) AS multiple ON notapago.idnotapago = multiple.idnotapago

			LEFT JOIN usuarios ON usuarios.idusuarios=notapago.idusuario
			 WHERE notapago.idnotapago='$this->idnotapago' ";

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
			SELECT notapago_descripcion.idnotapago,
			notapago_descripcion.descripcion as concepto,monto,DATE_FORMAT(fechacita,'%d-%m-%Y')as fecha,
			citas.idespecialista,
			citas.fechacita,
				citas.horainicial,
				citas.horafinal,
				citas.horains,
				paquetesucursal.idsucursal,
				citas.horafs,
				notapago_descripcion.cantidad,
				notapago_descripcion.costounitario,
				paquetes.foto,
				citas.idespecialista,
				(SELECT  CONCAT(usuarios.nombre,' ',usuarios.paterno) FROM especialista INNER JOIN usuarios on usuarios.idusuarios=especialista.idusuarios where especialista.idespecialista=citas.idespecialista ) as usuarioespecialista,
					paquetes.concortesia,
					paquetes.servicio,
					paquetes.intervaloservicio as intervaloservicio,
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
			notapago_descripcion.idnotapago_descripcion,
			categoriapaquete.idcategoriapaquete,
			citas.idcita,
			categoriapaquete.nombre AS titulo,
			notapago.folio,
			carrito_canje.idcanje
			FROM notapago_descripcion
			left join notapago on notapago.idnotapago=notapago_descripcion.idnotapago
			left join paquetes on paquetes.idpaquete=notapago_descripcion.idpaquete


			LEFT JOIN categoriapaquete ON paquetes.idcategoriapaquete = categoriapaquete.idcategoriapaquete 

			left join paquetesucursal on paquetes.idpaquete=paquetesucursal.idpaquete
			left join sucursal on paquetesucursal.idsucursal=sucursal.idsucursal

			LEFT JOIN citas on citas.idcita=notapago_descripcion.idcita
			left join cortesia 
			ON citas.idcortesia=cortesia.idcortesia
			left join paquetes as paquetecortesia on paquetecortesia.idpaquete=cortesia.idpaquetecortesia
			left join cupones on notapago_descripcion.idcupon=cupones.idcupon
			left join carrito ON  carrito.idcarrito=notapago_descripcion.idcarrito
			left join carrito_canje ON carrito_canje.idcarrito=carrito.idcarrito
			
			 WHERE   notapago_descripcion.idnotapago='$this->idnotapago'";

			 /*if ($this->idnotapago==926) {
					print_r($sql);
						} */

		

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
		$sql="UPDATE notapago SET 
			  cambio = '$this->cambio',
			  montovisual = '$this->montovisual', 
			  estatus = '$this->estatus'
			  WHERE idnotapago='$this->idnotapago'";

		$resp=$this->db->consulta($sql);

  
	}

	public function ObtTodosNotaPagos()
	{
		$sql="SELECT 
    notapago.idnotapago,
    notapago.idusuario,
    notapago.fecha,
    notapago.subtotal,
    notapago.iva,
    notapago.total,
    notapago.comisiontotal,
    notapago.montomonedero,
    notapago.estatus,
    notapago.idtipopago,
    notapago.tipopago,
    notapago.confoto,
    notapago.datostarjeta,
    notapago.idpagostripe,
    notapago.folio,
    notapago.descuento,
    notapago.descuentomembresia,
    notapago.datostarjeta2,
    notapago.montovisual,
    notapago.cambio,
    usuarios.nombre,
    usuarios.paterno,
    usuarios.materno,
    notapago.tpv,
    multiple.multipletipopago
FROM 
    notapago
INNER JOIN 
    usuarios ON notapago.idusuario = usuarios.idusuarios
LEFT JOIN (
    SELECT
        notapago_notapagometodopago.idnotapago,
        GROUP_CONCAT(notapagometodopago.tipopago) as multipletipopago
    FROM
        notapago_notapagometodopago
    JOIN
        notapagometodopago ON notapago_notapagometodopago.idnotapagometodopago = notapagometodopago.idnotapagometodopago
    GROUP BY
        notapago_notapagometodopago.idnotapago
) AS multiple ON notapago.idnotapago = multiple.idnotapago
ORDER BY 
    notapago.idnotapago DESC";
		
		$resp=$this->db->consulta($sql);
		return $resp;
	}

	public function CambiarEstatus()
	{
			$sql="UPDATE notapago SET 
			  estatus = '$this->estatus',
			  descripcionaceptacion='$this->descripcionaceptacion'
			  WHERE idnotapago='$this->idnotapago'";

		    $resp=$this->db->consulta($sql);

	}

	public function ListadoNotasPagosPorvalidar()
	{
		
			$sql = "SELECT *FROM
					notapago INNER JOIN usuarios ON notapago.idusuario=usuarios.idusuarios		
			    	WHERE  
			    	 notapago.estatus IN(0) ORDER BY idnotapago DESC";

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
			$sql="SELECT * from notapago_descripcion WHERE  notapago_descripcion.tipo=0 and 
			    	 estatus IN(0,1) and entregado=0 ORDER BY idnotapago DESC";
			/*$sql = "SELECT *from (SELECT *,
					(SELECT COUNT(*) from notapago_descripcion WHERE  notapago_descripcion.tipo=0  and notapago_descripcion.idnotapago=notapago.idnotapago)as productos
				FROM
					notapago

			    	WHERE   
			    	 estatus IN(0,1) ) as tabla1 WHERE productos>0 AND entregado=0 ORDER BY idnotapago DESC";
*/		
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


	/*public function ActualizarConsecutivo()
	{

		 $sql="SELECT *FROM pagina_configuracion";
		 $resp = $this->db->consulta($sql);
		 $datos=$this->db->fetch_assoc($resp);


		 $val=$datos['contadorfolio'];
		 $valor=$val+1;

		$sql="UPDATE pagina_configuracion SET contadorfolio='$valor'";


		 $resp = $this->db->consulta($sql);
		return $val;
		
	}*/
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

	public function ObtenerNotaPago()
	{
		$sql = "SELECT *FROM
					notapago 	
			   WHERE  
			   notapago.idnotapago ='$this->idnotapago' ";

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



	public function ActualizarNotapagoCompleto()
	{
		$sql="UPDATE notapago SET 
			  subtotal = '$this->subtotal',
			  iva = '$this->iva', 
			  total = '$this->total', 
			  comisiontotal = '$this->comisiontotal',
			  montomonedero = '$this->montomonedero', 
			  estatus = '$this->estatus',  
			  idpagostripe = '$this->idpagostripe', 
			  idtipopagoante='$this->idtipopagoante',
			  tipopagoante='$this->tipopagoante',
			  completado=1,
			  idtipopago='$this->idtipopago',
			  tipopago='$this->tipopago',
			  fechacompletado='$this->fechacompletado'

			  WHERE idnotapago='$this->idnotapago'";
			  
		$resp=$this->db->consulta($sql);

  
	}

	public function ActualizarEstatus()
	{
		$sql="UPDATE notapago SET 
			
			  estatus = '$this->estatus'  
			  WHERE idnotapago='$this->idnotapago'";
			  
		$resp=$this->db->consulta($sql);

  
	}

	public function Pendientesporentregar()
	{
		$sql="SELECT *FROM (SELECT
			notapago_descripcion.idnotapago_descripcion,
			notapago_descripcion.descripcion,
			notapago_descripcion.cantidad,
			notapago_descripcion.monto,
			notapago_descripcion.costounitario,
			notapago_descripcion.entregado,
			notapago_descripcion.fechaentregado,
			notapago_descripcion.monederoaplicado,
			notapago_descripcion.idnotapago,
			notapago.estatus AS estatusnota,
			notapago.idtipopago,
			notapago_descripcion.idpaquete,
			paquetes.servicio,
			CONCAT(usuarios.nombre,' ',usuarios.paterno) as cliente,
			notapago.folio
			FROM
			notapago
			JOIN notapago_descripcion
			ON notapago.idnotapago = notapago_descripcion.idnotapago 
			JOIN paquetes
			ON notapago_descripcion.idpaquete = paquetes.idpaquete 
			left join usuarios on notapago.idusuario=usuarios.idusuarios
			WHERE servicio=0 and notapago_descripcion.entregado=0) as tabla1 WHERE  estatusnota IN(0,1)";

			

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
	


	public function ProductosEntregados()
	{
		$sql="SELECT *FROM (SELECT
			notapago_descripcion.idnotapago_descripcion,
			notapago_descripcion.descripcion,
			notapago_descripcion.cantidad,
			notapago_descripcion.monto,
			notapago_descripcion.costounitario,
			notapago_descripcion.entregado,
			notapago_descripcion.fechaentregado,
			notapago_descripcion.monederoaplicado,
			notapago_descripcion.idnotapago,
			notapago.estatus AS estatusnota,
			notapago.idtipopago,
			notapago_descripcion.idpaquete,
			paquetes.servicio,
			CONCAT(usuarios.nombre,' ',usuarios.paterno) as cliente,
			notapago.folio
			FROM
			notapago
			JOIN notapago_descripcion
			ON notapago.idnotapago = notapago_descripcion.idnotapago 
			JOIN paquetes
			ON notapago_descripcion.idpaquete = paquetes.idpaquete
			left join usuarios on notapago.idusuario=usuarios.idusuarios
			 WHERE servicio=0 and notapago_descripcion.entregado=1) as tabla1 WHERE  estatusnota IN(1)";


			
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

	public function ActualizarNotaEntrega()
	{
		
		$sql="UPDATE notapago SET 
			  fechaentrega = '$this->fechaentrega',
			  entregado = '$this->entregado', 
			  idusuarioentrega = '$this->idusuarioentrega',
			    observacionesentrega='$this->observacionesentrega',
			    idbanco='$this->idbancoseleccionado',
			    tipotarjeta='$this->idopciontarjetaseleccionado',
			    digitostarjeta='$this->digitostarjeta'
			  WHERE idnotapago='$this->idnotapago'";
			
		$resp=$this->db->consulta($sql);

		
	}


	public function ActualizarNotadescripcionEntrega()
	{
		$sql="UPDATE notapago_descripcion SET 
			  fechaentregado = '$this->fechaentrega',
			  entregado = '$this->entregado'
			  WHERE idnotapago_descripcion='$this->idnotapagodescripcion'";
			  
		$resp=$this->db->consulta($sql);

		
	}

	public function ObtenerNotasPagoPendientes()
	{
		$sql="SELECT 
			notapago.idnotapago,
			notapago.idusuario,
			notapago.fecha,
			notapago.subtotal,
			notapago.iva,
			notapago.total,
			notapago.comisiontotal,
			notapago.montomonedero,
			notapago.estatus,
			notapago.idtipopago,
			notapago.tipopago,
			notapago.confoto,
			notapago.datostarjeta,
			notapago.idpagostripe,
			notapago.folio,
			notapago.descuento,
			notapago.descuentomembresia,
			notapago.datostarjeta2,
			notapago.montovisual,
			notapago.cambio,
			usuarios.nombre,
			usuarios.paterno,
			usuarios.materno


		 FROM notapago INNER JOIN usuarios ON notapago.idusuario=usuarios.idusuarios  

		 WHERE notapago.estatus=0 AND notapago.idusuario='$this->idusuario' ORDER BY idnotapago DESC
		 ";
		
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


	public function VerificarCita()
	{
		$sql="SELECT
		notapago_descripcion.idnotapago_descripcion,
		notapago_descripcion.idnotapago,
		notapago_descripcion.idcita,
		notapago.idusuario,
		notapago.estatus,
		notapago.tpv,
		notapago.tipopago,
		notapago.total
		FROM
		notapago
		JOIN notapago_descripcion
		ON notapago.idnotapago = notapago_descripcion.idnotapago
		 LEFT JOIN (
        SELECT idnotapago, SUM(montocampo) AS sumapago
        FROM notapagometodopago
				LEFT JOIN notapago_notapagometodopago on notapagometodopago.idnotapagometodopago=notapago_notapagometodopago.idnotapagometodopago
        GROUP BY idnotapago
    ) AS tbl ON tbl.idnotapago = notapago.idnotapago
		WHERE notapago.estatus IN(0,1,2) and notapago_descripcion.idcita= '$this->idcita' GROUP BY idnotapago";
		
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

	public function ActualizarNotacancelada()
	{
		$sql="UPDATE notapago SET 
			  estatus = 2
			  WHERE idnotapago='$this->idnotapago'";
			 
		$resp=$this->db->consulta($sql);
	}

	public function ActualizarNotadescripcion()
	{
		$sql="UPDATE notapago_descripcion SET descripcion = '$this->descripcion', 
			cantidad = '$this->cantidad', 
			monto = '$this->monto', 
			idpaquete = '$this->idpaquete',
			costounitario = '$this->costounitario', 
			idcupon = '0', 
			montocupon = '0.00',
			codigocupon = '', 
			monederoaplicado = '0.00'
			WHERE idnotapago_descripcion = '$this->idnotapagodescripcion'";

			//echo $sql.'<br>';
		$resp=$this->db->consulta($sql);


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
		monto='$this->monto',
		cantidad='$this->cantidad'
		WHERE idnotapago_descripcion='$this->idnotapagodescripcion'";
		
		$resp=$this->db->consulta($sql);
	}

	public function ActualizarToTalnota()
	{
		$sql="UPDATE notapago 
		SET subtotal='$this->subtotal',
		total='$this->total'
		
		WHERE idnotapago='$this->idnotapago'";
		
		$resp=$this->db->consulta($sql);
	}


	public function Eliminarnotapagodescripcion()
	{
		try {

		$sql = "DELETE FROM notapago_descripcion
        WHERE idnotapago_descripcion = '$this->idnotapagodescripcion' ";
      
        $this->db->consulta($sql);
			
		} catch (Exception $e) {
			print_r($e);
		}
	}

	public function ObtenerdescripcionNotaCita()
	{
		$sql="
			SELECT idnotapago,
			
			notapago_descripcion.descripcion as concepto,monto,DATE_FORMAT(fechacita,'%d-%m-%Y')as fecha,
			citas.idespecialista,
			citas.fechacita,
				citas.horainicial,
				citas.horafinal,
				citas.horains,
				paquetesucursal.idsucursal,
				citas.horafs,
				notapago_descripcion.cantidad,
				notapago_descripcion.costounitario,
				paquetes.foto,
				citas.idespecialista,
				(SELECT  CONCAT(usuarios.nombre,' ',usuarios.paterno) FROM especialista INNER JOIN usuarios on usuarios.idusuarios=especialista.idusuarios where especialista.idespecialista=citas.idespecialista ) as usuarioespecialista,
					paquetes.concortesia,
					paquetes.servicio,
					paquetes.intervaloservicio as intervaloservicio,
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
			notapago_descripcion.idnotapago_descripcion,
			categoriapaquete.idcategoriapaquete,
			citas.idcita,
			categoriapaquete.nombre AS titulo
			FROM notapago_descripcion
			left join paquetes on paquetes.idpaquete=notapago_descripcion.idpaquete

			LEFT JOIN categoriapaquete ON paquetes.idcategoriapaquete = categoriapaquete.idcategoriapaquete 

			left join paquetesucursal on paquetes.idpaquete=paquetesucursal.idpaquete
			left join sucursal on paquetesucursal.idsucursal=sucursal.idsucursal

			LEFT JOIN citas on citas.idcita=notapago_descripcion.idcita
			left join cortesia 
			ON citas.idcortesia=cortesia.idcortesia
			left join paquetes as paquetecortesia on paquetecortesia.idpaquete=cortesia.idpaquetecortesia
			left join cupones on notapago_descripcion.idcupon=cupones.idcupon
			
			 WHERE citas.idcita='$this->idcita'";


		$resp=$this->db->consulta($sql);
		$cont = $this->db->num_rows($resp);

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


	public function ObtenerdescripcionNotaNoCanceladas()
	{
		$sql="
			SELECT idnotapago,
			
			notapago_descripcion.descripcion as concepto,monto,DATE_FORMAT(fechacita,'%d-%m-%Y')as fecha,
			citas.idespecialista,
			citas.fechacita,
				citas.horainicial,
				citas.horafinal,
				citas.horains,
				paquetesucursal.idsucursal,
				citas.horafs,
				notapago_descripcion.cantidad,
				notapago_descripcion.costounitario,
				paquetes.foto,
				citas.idespecialista,
				(SELECT  CONCAT(usuarios.nombre,' ',usuarios.paterno) FROM especialista INNER JOIN usuarios on usuarios.idusuarios=especialista.idusuarios where especialista.idespecialista=citas.idespecialista ) as usuarioespecialista,
					paquetes.concortesia,
					paquetes.servicio,
					paquetes.intervaloservicio as intervaloservicio,
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
			notapago_descripcion.idnotapago_descripcion,
			categoriapaquete.idcategoriapaquete,
			citas.idcita,
			categoriapaquete.nombre AS titulo
			FROM notapago_descripcion
			left join paquetes on paquetes.idpaquete=notapago_descripcion.idpaquete

			LEFT JOIN categoriapaquete ON paquetes.idcategoriapaquete = categoriapaquete.idcategoriapaquete 

			left join paquetesucursal on paquetes.idpaquete=paquetesucursal.idpaquete
			left join sucursal on paquetesucursal.idsucursal=sucursal.idsucursal

			LEFT JOIN citas on citas.idcita=notapago_descripcion.idcita
			left join cortesia 
			ON citas.idcortesia=cortesia.idcortesia
			left join paquetes as paquetecortesia on paquetecortesia.idpaquete=cortesia.idpaquetecortesia
			left join cupones on notapago_descripcion.idcupon=cupones.idcupon
			
			 WHERE notapago_descripcion.cancelado=0 AND idnotapago='$this->idnotapago'";


		$resp=$this->db->consulta($sql);
		$cont = $this->db->num_rows($resp);

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