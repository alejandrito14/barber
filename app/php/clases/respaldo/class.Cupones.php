<?php
class Cupones
{
	public $db;
	public $idcupon;
	public $codigocupon;
	public $fechainicial;
	public $fechafinal;
    public $horainicial;
	public $horafinal;
	public $tipodescuento;
	public $descuento;
	public $limiteusos;
	public $estatus;
	public $tsucursales;
	public $tpaquetes;
	public $tclientes;
	public $montocompra;
	public $cantidadcompra;
	public $secuenciaventa;
	public $lusocliente;
	public $lusosucursal;
	public $lusodia;
	public $lusototal;
	public $aplicarsobrepromo;


	public $lista_empresa;
	public $tipo_usuario;
	public $idsucursales;

	public function ObtenerTodos()
	{
		$query = "SELECT cupones.idcupon,cupones.codigocupon,cupones.tipodescuento,cupones.descuento,
			cupones.lusocliente,cupones.lusosucursal,cupones.lusodia,cupones.lusototal,cupones.fechainicial,
			cupones.fechafinal,cupones.horainicial,cupones.montocompra,cupones.secuenciaventa,cupones.cantidadcompra,cupones.aplicarsobrepromo,
			cupones.horafinal,cupones.tsucursales,cupones.tpaquetes,cupones.tclientes,cupones.estatus
			FROM 
			cupones WHERE cupones.estatus=1";
			
		
			$resp = $this->db->consulta($query);
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

	public function ObtenerCuponSucursales()
	{
		$query = "SELECT cuponsucursales.idsucursal, sucursal.titulo FROM cuponsucursales JOIN sucursal ON cuponsucursales.idsucursal = sucursal.idsucursal WHERE cuponsucursales.idcupon = '".$this->idcupon."'";
		
		$resp = $this->db->consulta($query);
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

	public function ObtenerCuponPaquetes()
	{
		$query = "SELECT cuponpaquetes.idpaquete, paquetes.nombrepaquete FROM cuponpaquetes JOIN paquetes ON cuponpaquetes.idpaquete = paquetes.idpaquete WHERE cuponpaquetes.idcupon ='".$this->idcupon."'";
		
			$resp = $this->db->consulta($query);
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

	public function ObtenerCuponClientes($idcupon)
	{
		$sql = "SELECT cuponclientes.idcliente, clientes.nombre, clientes.paterno, clientes.materno FROM cuponclientes JOIN clientes ON cuponclientes.idcliente = clientes.idcliente WHERE cuponclientes.idcupon = ".$idcupon;
		$resp = $this->db->consulta($sql);
		return $resp;
	}

	public function GuardarCupon()
	{
		$query = "INSERT INTO cupones (codigocupon,tipodescuento,descuento,fechainicial,fechafinal,horainicial,horafinal,tsucursales,
		tpaquetes,tclientes,montocompra,cantidadcompra,secuenciaventa,lusocliente,lusodia,lusosucursal,lusototal,aplicarsobrepromo,estatus) 
		VALUES ('".$this->db->real_escape_string($this->codigocupon)."','".$this->db->real_escape_string($this->tipodescuento)."',
		'$this->descuento','".$this->db->real_escape_string($this->fechainicial)."',
		'".$this->db->real_escape_string($this->fechafinal)."','".$this->db->real_escape_string($this->horainicial)."',
		'".$this->db->real_escape_string($this->horafinal)."','".$this->db->real_escape_string($this->tsucursales)."',
	    '".$this->db->real_escape_string($this->tpaquetes)."','".$this->db->real_escape_string($this->tclientes)."',
		'".$this->db->real_escape_string($this->montocompra)."','".$this->db->real_escape_string($this->cantidadcompra)."',
		'".$this->db->real_escape_string($this->secuenciaventa)."',
		'".$this->db->real_escape_string($this->lusocliente)."','".$this->db->real_escape_string($this->lusodia)."',
		'".$this->db->real_escape_string($this->lusosucursal)."','".$this->db->real_escape_string($this->lusototal)."',
		'".$this->db->real_escape_string($this->aplicarsobrepromo)."','".$this->db->real_escape_string($this->estatus)."' );";
		$this->db->consulta($query);
		$this->idcupon = $this->db->id_ultimo();
	}

	public function guardarCuponSucursales($idsuc)
	{
		$query = "INSERT INTO cuponsucursales(idcupon,idsucursal) VALUES ('".$this->db->real_escape_string($this->idcupon)."','".$this->db->real_escape_string($idsuc)."');";
		$this->db->consulta($query);	
	}

	public function guardarCuponPaquetes($idpaq)
	{
		$query = "INSERT INTO cuponpaquetes(idcupon,idpaquete) VALUES ('".$this->db->real_escape_string($this->idcupon)."','".$this->db->real_escape_string($idpaq)."');";
		$this->db->consulta($query);
	}

	public function guardarCuponClientes($idcli)
	{
		$query = "INSERT INTO cuponclientes(idcupon,idcliente) VALUES ('".$this->db->real_escape_string($this->idcupon)."','".$this->db->real_escape_string($idcli)."');";
		$this->db->consulta($query);
	}

	public function validarCodigoCupon($codigocupon)
	{
		$query = "SELECT idcupon FROM cupones where codigocupon = '".$this->db->real_escape_string($codigocupon)."'";
		$resp = $this->db->consulta($query);
		$ncups = $this->db->num_rows($resp);
		if ($ncups > 0 ){
			return 1;
		}
		else{
			return 0;
		}
	}

	public function ActualizarEstado($idcupon,$state)
	{
		$query = "UPDATE cupones SET  
		 	estatus = $state 
		 	WHERE idcupon = $idcupon ";

		$this->db->consulta($query);

	}

	public function ObtenerUsoCupon()
	{
		$query = "SELECT idcupon,numerodeveces FROM usocupon where idcupon = '".$this->idcupon."'";
	
		$resp = $this->db->consulta($query);
		$row=$this->db->fetch_assoc($resp);
		$ncups = $this->db->num_rows($resp);
		$cantidadusada=0;

		if ($ncups>0) {
			$cantidadusada=$row['numerodeveces'];
		}

		return $cantidadusada;
	}


	public function ObtenerUsoCuponSucursal($lusosucursal)
	{
			$query = "SELECT idcupon,numerodeveces FROM usocuponsucursal where idcupon = '".$this->idcupon."'";
			
			$resp = $this->db->consulta($query);
			$cont = $this->db->num_rows($resp);


			$array=array();
			$contador=0;
			$validado=0;
			if ($cont>0) {

				while ($objeto=$this->db->fetch_object($resp)) {

					if ($objeto->numerodeveces>$lusosucursal) {
						$validado=0;
					}else{


						$validado=1;
					}
				} 
			}else{

				$validado=1;
			}
			return $validado;
	}


	public function ObtenerUsoCuponDia($fecha)
	{
		$query = "SELECT idcupon,numerodeveces FROM usocupondia where idcupon = '".$this->idcupon."' AND fecha='$fecha'";

		
		$resp = $this->db->consulta($query);
		$row=$this->db->fetch_assoc($resp);
		$ncups = $this->db->num_rows($resp);
		$cantidadusada=0;

		if ($ncups>0) {
			$cantidadusada=$row['numerodeveces'];
		}

		return $cantidadusada;
		
	}


	public function ObtenerUsoCliente($idcliente)
	{
		$query = "SELECT idcupon,numerodeveces FROM usocuponcliente where idcupon = '".$this->idcupon."' AND idcliente='$idcliente'";
		$resp = $this->db->consulta($query);
		$row=$this->db->fetch_assoc($resp);
		$ncups = $this->db->num_rows($resp);
		$cantidadusada=0;

		if ($ncups>0) {
			$cantidadusada=$row['numerodeveces'];
		}

		return $cantidadusada;
	}


	public function VerificarDisponibilidadCuponCliente($idcliente)
	{

		$query = "SELECT idcupon,idusuarios FROM cuponclientes where idcupon = '".$this->idcupon."' AND idusuarios='$idcliente'";
	
		$resp = $this->db->consulta($query);
		$row=$this->db->fetch_assoc($resp);
		$ncups = $this->db->num_rows($resp);


		$validado=0;

		if ($ncups>0) {
			$validado=1;
		}

		//echo 'validado'.$validado;

		return $validado;
		
	}


	public function ObtenerCupon()
	{
		$query = "SELECT cupones.idcupon,cupones.codigocupon,cupones.tipodescuento,cupones.descuento,
			cupones.lusocliente,cupones.lusosucursal,cupones.lusodia,cupones.lusototal,cupones.fechainicial,
			cupones.fechafinal,cupones.horainicial,cupones.montocompra,cupones.secuenciaventa,cupones.cantidadcompra,cupones.aplicarsobrepromo,
			cupones.horafinal,cupones.tsucursales,cupones.tpaquetes,cupones.tclientes,cupones.estatus
			FROM 
			cupones WHERE cupones.idcupon='".$this->idcupon."'";
			
		
			$resp = $this->db->consulta($query);
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

	public function ObtenerCuponCodigo($value='')
	{
		$query = "SELECT cupones.idcupon,cupones.codigocupon,cupones.tipodescuento,cupones.descuento,
			cupones.lusocliente,cupones.lusosucursal,cupones.lusodia,cupones.lusototal,cupones.fechainicial,
			cupones.fechafinal,cupones.horainicial,cupones.montocompra,cupones.secuenciaventa,cupones.cantidadcompra,cupones.aplicarsobrepromo,
			cupones.horafinal,cupones.tsucursales,cupones.tpaquetes,cupones.tclientes,cupones.estatus
			FROM 
			cupones WHERE cupones.codigocupon='".$this->codigocupon."'";
			
			
			$resp = $this->db->consulta($query);
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


	public function ObtenerUsoCuponSucursalCliente($lusosucursal,$idsucursal)
	{
			$query = "SELECT idcupon,numerodeveces FROM usocuponsucursal where idcupon = '".$this->idcupon."' AND idsucursal='$idsucursal'";
			
			$resp = $this->db->consulta($query);
			$cont = $this->db->num_rows($resp);


			$array=array();
			$contador=0;
			$validado=0;
			if ($cont>0) {

				while ($objeto=$this->db->fetch_object($resp)) {

					if ($objeto->numerodeveces>$lusosucursal) {
						$validado=0;
					}else{


						$validado=1;
					}
				} 
			}else{

				$validado=1;
			}
			return $validado;
	}


		public function ObtenerCuponSucursalesCliente($idsucursal)
	{
		$query = "SELECT cuponsucursales.idsucursal, sucursal.titulo FROM cuponsucursales JOIN sucursal ON cuponsucursales.idsucursal = sucursal.idsucursal WHERE cuponsucursales.idcupon = '".$this->idcupon."' AND cuponsucursales.idsucursal='".$idsucursal."'";
		
		$resp = $this->db->consulta($query);
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



	public function BuscarEnArray($arreglo,$idbuscar)
	{	
		$validado=0;
		for ($i=0; $i <count($arreglo); $i++) { 

			if ($arreglo[$i]->idpaquete==$idbuscar) {
				$validado=1;
				break;
			}
		}


		return $validado;
	}


	public function BuscarPosicion($arreglo,$idbuscar)
	{
		$posicion='';
		for ($i=0; $i <count($arreglo); $i++) { 

			if ($arreglo[$i]->idpaquete==$idbuscar) {
				$posicion=$i;
				break;
			}
		}

		return $posicion;
	}


	public function ventasrealizadasporcliente($idcliente)
	{
		$sql="SELECT
			COUNT(*) AS totalventas

				FROM
				nota_remision 
				INNER JOIN sucursales ON nota_remision.idsucursales=sucursales.idsucursales
				WHERE nota_remision.idcliente='".$idcliente."' 
				AND nota_remision.estatus=2
			 ORDER BY nota_remision.idnota_remision DESC";

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

	public function ventasrealizadasporclienteperiodo($idcliente,$fechainicial,$fechafinal){
		$sql="SELECT
			COUNT(*) AS totalventas
				FROM
				nota_remision 
				INNER JOIN sucursales ON nota_remision.idsucursales=sucursales.idsucursales
				WHERE nota_remision.idcliente='".$idcliente."' AND nota_remision.estatus=2 AND fechapedido>='".$fechainicial."' AND fechafinal<='".$fechafinal."'" ;

				if ($this->idsucursales!='') {
					$sql.=" AND idsucursales=".$this->idsucursales."";
				}
			$sql.=" ORDER BY nota_remision.idnota_remision DESC";
			
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

	public function ObtenerCuponesAutomaticos()
	{
		$query = "SELECT cupones.idcupon,cupones.codigocupon,cupones.tipodescuento,cupones.descuento,
			cupones.lusocliente,cupones.lusosucursal,cupones.lusodia,cupones.lusototal,cupones.fechainicial,
			cupones.fechafinal,cupones.horainicial,cupones.montocompra,cupones.secuenciaventa,cupones.cantidadcompra,cupones.aplicarsobrepromo,
			cupones.horafinal,cupones.tsucursales,cupones.tpaquetes,cupones.tclientes,cupones.estatus
			FROM 
			cupones WHERE cupones.estatus=1 AND cupones.automatico=1";
			
		
			$resp = $this->db->consulta($query);
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


	public function informacioncodigo($codigocupon)
	{
		$query = "SELECT * FROM cupones where codigocupon = '".$codigocupon."'";
		


			$resp = $this->db->consulta($query);
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