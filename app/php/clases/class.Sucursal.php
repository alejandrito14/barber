<?php
class Sucursal
{
	public $db;
	public $idsucursales;
	public $idempresas;
	public $sucursal;
	public $direccion;
	public $telefono;
	public $idmunicipio;
	public $idestado;
	public $idpais;
	public $email;
	public $estatus;
	public $iva;
	
    public $tipo_usuario;
    public $lista_empresas;
    public $idusuario;
	

	public function ObtenerTodos()
	{
		$query="SELECT * FROM sucursales  ORDER BY orden asc";
		
		$resp=$this->db->consulta($query);
		
		//echo $total;
		return $resp;
	}
	
	
	public function ObtenerSucursales()
	{
		$sql="SELECT * FROM sucursal WHERE estatus=1  ORDER BY orden asc";
		$resp=$this->db->consulta($sql);
		$cont = $this->db->num_rows($resp);


		$array=array();
		$contador=0;
		if ($cont>0) {

			while ($objeto=$this->db->fetch_object($resp)) {

				$horaentrada='';
				$horasalida='';
				$horaactual=date('H:i:s');
				$dia=date('w');
				$objeto->abierto=1;



				$sqlhorarios="SELECT *FROM horariossucursal WHERE idsucursal=".$objeto->idsucursal."";

				$res=$this->db->consulta($sqlhorarios);
				$numhora=$this->db->num_rows($res);

					if ($numhora>0) {
						# code...
						$arrayhorarios=array();

						$contadorhorarios=0;
					while ($objetohorarios=$this->db->fetch_object($res)) {

						$horaentrada=date('H:i:s',strtotime($objetohorarios->horainicial));
						$horasalida=date('H:i:s',strtotime($objetohorarios->final));
						if ($objetohorarios->dia==$dia && $horaactual>=$horaentrada && $horaactual<=$horasalida) {
							
							$objeto->abierto=1;

							break;

						}else{

							$objeto->abierto=0;


						}


					}

					

				}else{

				$objeto->abierto=0;


				}



				/*if ($objeto->horaentrada!='') {
					$horaentrada=date('H:i:s',strtotime($objeto->horaentrada));
					$horasalida=date('H:i:s',strtotime($objeto->horasalida));


					if ($horaactual>=$horaentrada && $horaactual<=$horasalida) {
						
						$objeto->abierto=1;
					}else{

						$objeto->abierto=0;

					}
					
				}*/

				$array[$contador]=$objeto;
				$contador++;
			} 
		}
		
		return $array;
	}
	//funcion  sucursales por usuario

	public function AccesoSucursal()
	{
		$sql="SELECT
			IFNULL(GROUP_CONCAT(sucursal.idsucursal),0) as idsucursales
			FROM
			acceso_sucursal_empleado
			JOIN sucursal
			ON acceso_sucursal_empleado.idsucursales = sucursal.idsucursal WHERE acceso_sucursal_empleado.idusuarios='$this->idusuario' AND sucursal.estatus=1  ORDER BY orden asc";

	
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
	
	


	//funcion que sirve para guardar una sucursal 
	public function guardar_sucursal()
	{
		$query = "INSERT INTO sucursales (sucursal,direccion,telefono,email,estatus,iva) VALUES ('$this->sucursal','$this->direccion','$this->telefono','$this->email','$this->estatus','$this->iva');";


	
		$this->db->consulta($query);
		$this->idsucursales = $this->db->id_ultimo();
	}
//funcion que sirve para modificar una sucursal
	public function modificar_sucursal()
	{
		$query = "UPDATE sucursales SET sucursal = '$this->sucursal', direccion = '$this->direccion', telefono = '$this->telefono', email = '$this->email', estatus = '$this->estatus',iva='$this->iva' WHERE idsucursales = '$this->idsucursales'";
		$this->db->consulta($query);
	}
	
	///funcion para objeter datos de un usuario
	public function buscar_sucursal()
	{
		$query="SELECT * FROM sucursal WHERE idsucursal=".$this->idsucursales;
		$resp=$this->db->consulta($query);
		
		//echo $total;
		return $resp;
	}

	public function buscar_sucursalpaquete()
	{
		$query="SELECT * FROM paquetesucursal WHERE idsucursal=".$this->idsucursales;


		$resp=$this->db->consulta($query);
		
		//echo $total;
		return $resp;
	}

	public function EliminarDeFolio()
	{
		$query="DELETE FROM sucursales_folios WHERE idsucursales=".$this->idsucursales;


		$resp=$this->db->consulta($query);
		
	}


		public function EliminarSucursales()
	{
		$query="DELETE FROM sucursales WHERE idsucursales=".$this->idsucursales;


		$resp=$this->db->consulta($query);
		
	}

	public function ObtenerImagenesSucursal()
	{
		$sql="SELECT *FROM sucursalesimagenes WHERE idsucursal=".$this->idsucursales."";

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

	public function ObtenerHorariosSucursal()
	{
		$sql="SELECT *FROM horariossucursal WHERE idsucursal=".$this->idsucursales."";

		
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



	public function ObtenerHorariosSucursalProximo()
	{
		$sql="SELECT *FROM horariosucursal  WHERE idsucursal=".$this->idsucursales." ORDER BY dia,horainicial asc ";



		$resp=$this->db->consulta($sql);
		$cont = $this->db->num_rows($resp);


		$array=array();
		$contador=0;
		if ($cont>0) {

			while ($objeto=$this->db->fetch_object($resp)) {
					$horaactual=date('H:i:s');
					$dia=date('w');
					$horaentrada=date('H:i:s',strtotime($objeto->horainicial));

					$salir=0;

					if ($dia==$objeto->dia && $horaentrada>=$horaactual) {
						
						
						$array[$contador]=$objeto;

						$salir=1;
						break;

					}


					if ($salir==0) {
						

						$sqlbuscar="SELECT *FROM horariosucursal  WHERE idsucursal=".$this->idsucursales." AND dia>=".$dia." ORDER BY dia,horainicial asc limit 1";


						$respuesta=$this->db->consulta($sqlbuscar);
						$conta = $this->db->num_rows($respuesta);


						if ($conta>0) {
							
							while ($objetosiguiente=$this->db->fetch_object($respuesta)) {

								$array[$contador]=$objetosiguiente;

								$salir=1;
								break;

							}

						}else{

							$sqlbuscar="SELECT *FROM horariosucursal  WHERE idsucursal=".$this->idsucursales." AND dia<=".$dia." ORDER BY dia,horainicial asc limit 1";


								$respuesta=$this->db->consulta($sqlbuscar);
								$conta = $this->db->num_rows($respuesta);
								
								while ($objetosiguiente=$this->db->fetch_object($respuesta)) {

								$array[$contador]=$objetosiguiente;

								$salir=1;
								break;

							}

						}


					}

					if ($salir==1) {
						break;
					}



				$contador++;
			} 
		}
		
		return $array;
	}

	public function Obtenerdatossucursal()
	{
		$sql="SELECT sucursal,direccion,telefono,imagenticket,email,foto,codigopostal,estados.nombre as nombreestado,municipios.nombre as nombremunicipio FROM sucursales INNER JOIN estados ON estados.id=sucursales.estado
			INNER JOIN municipios  ON municipios.id=sucursales.municipio WHERE idsucursales='$this->idsucursales'";
		$resp=$this->db->consulta($sql);

		return $resp;
	}
	
	public function buscar_sucursal2()
	{
		$query="SELECT * FROM sucursales WHERE idsucursales=".$this->idsucursales;
	
		$resp=$this->db->consulta($query);
		
		//echo $total;
		return $resp;
	}

	public function Buscardia($arrayintervalo,$dia)
	{
		if (count($arrayintervalo)>0) {
			for ($i=0; $i <count($arrayintervalo) ; $i++) { 
				
				if ($arrayintervalo[$i]['dia']==$dia) {
					return $arrayintervalo[$i];
				}

			}
		}

		
	}



	
}
?>