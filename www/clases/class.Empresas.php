<?php
class Empresas
{
	
	public $db;
	
	public $idempresas;
	public $empresas;
	public $direccion;
	public $telefono;
	public $email;
	public $contactos;
	public $f_rfc;
	public $f_razonsocial;
	public $f_calle;
	public $f_no_ext;
	public $f_no_int;
	public $f_colonia;
	public $f_ciudad;
	public $f_estado;
	public $f_cp;
	public $estatus;
	public $f_pais;
	public $f_municipio;
	public $descripcion;
	
	//validacione de tipo de usuario
	
	public $tipo_usuario;
	public $lista_empresas;
	
	
	
	//Funcion que nos regresa todos los registros de la tabla empresas
	public function obtenerTodas()
	{

		//echo $this->tipo_usuario.'-'.$this->lista_empresas;
		if($this->tipo_usuario != 0)
		{
		  
			if($this->lista_empresas != 0)
			{
				$SQLidempresas = " AND idempresas IN ($this->lista_empresas)";
			}else
			{
				$SQLidempresas = "";
			}
				
		}else
		{
		   $SQLidempresas = "";
		}
		
		
		
		 $sql = "SELECT * FROM empresa WHERE 1=1 $SQLidempresas";
		
		//echo $sql;
		$resp = $this->db->consulta($sql);
		return $resp;
	}
	
	
		//Funcion que nos regresa los registros de la tabla empresas según el filtro
	public function obtenerFiltro()
	{
		
		/*
		if($this->tipo_usuario != 0)
		{
		  
				if($this->idempresas != 0)
				{

					$SQLidempresas = "AND idempresas = $this->idempresas";
				}else
				{
				   $SQLidempresas = "AND idempresas IN ($this->lista_empresas)";
				}
		
		}else
		{
			$SQLidempresas = "";
		}*/
		
		
		 $sql = "SELECT * FROM empresa  ";
		
		
		$resp = $this->db->consulta($sql);
		return $resp;
	}
	
	//Funcion que regresa empresas que estan habilitadas en su estatus como activado
	public function obtenerActivadas()
	{
		$sql = "SELECT * FROM empresas WHERE estatus = '1'";
		$resp = $this->db->consulta($sql);
		return $resp;
	}


	
	//Funcion que sirve para obtener un registro especifico de la tabla empresas
	public function buscarEmpresa()
	{
		$sql = "SELECT empresa.idempresa,empresa.nombre,empresa.descripcion,empresa.telefono,empresa.email,empresa.imagen, municipios.nombre as nombremunicipio,estados.nombre as nombreestado,pais.pais FROM empresa

		LEFT JOIN municipios ON municipios.id=empresa.f_municipio
		LEFT JOIN estados ON estados.id =empresa.f_estado
		LEFT JOIN pais ON pais.idpais=empresa.f_pais
		 WHERE idempresa = '$this->idempresas'";

		
		$resp = $this->db->consulta($sql);
		return $resp;
	}

	//Funcion que guarda un registro en la tabla empresas
	public function guardarEmpresa()
	{
	
		$sql="INSERT INTO empresa(nombre, descripcion, f_municipio, f_estado, f_pais,telefono,email) VALUES ( '$this->empresas', '$this->descripcion','','', '','$this->telefono','$this->email')";

		$resp = $this->db->consulta($sql);
		$this->idempresas = $this->db->id_ultimo();
	}
	
	//Funcion que sirve para modificar un registro en la tabla empresas
	public function modificarEmpresa(){
		
		$sql="UPDATE empresa SET nombre = '$this->empresas', descripcion = '$this->descripcion',
			telefono='$this->telefono',
			email='$this->email'
		 WHERE idempresa='$this->idempresas'";
		
		$this->db->consulta($sql);
	}

	public function AsignarUsuariosEmpresas()
	{
		$sql="INSERT INTO acceso_empresa_empleado(idempresas,idusuarios) VALUES ($idempresas,$idusuarios)";

		$this->db->consulta($sql);
	}

	public function guardarEnFoliosEmpresas()
	{
		$sql="INSERT INTO empresas_folios (idempresas) VALUES ($this->idempresas)";

		$this->db->consulta($sql);
	}
	

	
	
	
}
?>