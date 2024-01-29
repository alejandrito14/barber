<?php
class Categoriaspaquete
{
	
	public $db;
	
	public $idcategoria;
	public $nombre;
	public $depende;
	public $empresa;
	public $orden;
	public $estatus;
	
	//validacione de tipo de usuario
	
	public $tipo_usuario;
	public $lista_empresas;
	
	public $idcategoriapaquete;
		public function obtenerTodas()
	{
		
		
		
		$sql = "SELECT C.* FROM categoriapaquete C";

	
		$resp = $this->db->consulta($sql);
		return $resp;
	}
	
		public function obtenerEmpresas()
	{
		if($this->tipo_usuario != 0)
		{
		   $SQLidempresas = "and idempresas IN ($this->lista_empresas)";
		}else
		{
		   $SQLidempresas = "";
		}
		
		
		
		$sql = "SELECT * FROM empresas where estatus=1 $SQLidempresas";
		$resp = $this->db->consulta($sql);
		return $resp;
	}
	
		//Funcion que nos regresa los registros de la tabla empresas según el filtro
	public function obtenerFiltro()
	{
		
		
		$sql = "SELECT C.* FROM categoriapaquete C ";
		/*$sql .= ($this->nombre != '')? " AND C.categoria LIKE '%$this->nombre%'":"";
		$sql .= ($this->idcategoria != '')? " AND C.idcategorias = '$this->idcategoria'":"";*/


		$resp = $this->db->consulta($sql);
		return $resp;
	}
	public function obtenerCategorias()
	{
		
		/* if($this->tipo_usuario != 0)
		{
		   $SQLidempresas = "and E.idempresas IN ($this->lista_empresas)";
		}else
		{
		   $SQLidempresas = "";
		}	*/
		$sql = "SELECT C.* FROM categorias C ";
		
		
		$resp = $this->db->consulta($sql);
		return $resp;
	}
	
	public function NombreCategoria($id){
		$nombre="";
		if($id==0){
			$nombre= "No Asignado";
		}
		else {
			$sql ="select * from categorias where idcategorias='$id'";
			
			$result=$this->db->consulta($sql);
			$result_row=$this->db->fetch_assoc($result);
			$nombre=$result_row['categoria'];
		}
		
		return $nombre;
	}


	
	//Funcion que sirve para obtener un registro especifico de la tabla empresas
	public function buscarCategoria()
	{
		$sql = "SELECT * FROM categoriapaquete WHERE idcategoriapaquete = '$this->idcategoria'";
		$resp = $this->db->consulta($sql);
		return $resp;
	}

	//Funcion que sirve para obtener un registro especifico de la tabla empresas
	public function buscarCategoriaporempresa()
	{
		$sql = "SELECT * FROM categoriapaquete";
		$resp = $this->db->consulta($sql);
		return $resp;
	}

	//Funcion que guarda un registro en la tabla empresas
	public function guardarCategoria()
	{
		$sql = "INSERT INTO categoriapaquete (nombre,orden,estatus,iddepende) VALUES ('$this->nombre','$this->orden','$this->estatus','$this->depende')";
		
		$resp = $this->db->consulta($sql);
		$this->idcategoria = $this->db->id_ultimo();
	}
	
	//Funcion que sirve para modificar un registro en la tabla empresas
	public function modificarCategoria(){
		$sql = "UPDATE categoriapaquete SET 
		nombre = '$this->nombre', 
		orden='$this->orden',
		estatus='$this->estatus',
		iddepende='$this->depende'
		 WHERE idcategoriapaquete = '$this->idcategoria'";
		$this->db->consulta($sql);
	}

	public function VerificarRelacionCategoria()
	{
		$sql="SELECT *FROM paquetes WHERE idcategoriapaquete='$this->idcategoria'";


		$resp = $this->db->consulta($sql);
		return $resp;
	}


	public function ObtenerImagenesCategorias()
	{
		$sql="SELECT *FROM categoriasimagenes WHERE idcategorias=".$this->idcategoria."";

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

	public function ObtenerUltimoOrdencategoria()
	{
		$query="SELECT MAX(orden) as ordenar FROM categoriapaquete";		
		$resp=$this->db->consulta($query);
		
		//echo $total;
		return $resp;
	}

	public function BorrarCategoria()
	{
		
		$query="DELETE FROM categoriapaquete WHERE idcategoriapaquete=".$this->idcategoria."";	
		$resp=$this->db->consulta($query);
		return $resp;
	}

	public function ObtenerPaquetesCategorias($value='')
	{
		
		$sql="SELECT *FROM paquetes WHERE idcategorias=".$this->idcategoria." AND estatus=1 AND promocion=0";

	

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


	public function ObtenerCategoriaPaquete()
	{
		$sql="
			SELECT *,
			(SELECT COUNT(*) FROM categoriapaquete as sub WHERE sub.iddepende=categoriapaquete.idcategoriapaquete) as sub
			FROM categoriapaquete WHERE estatus=1 AND iddepende='$this->idcategoriapaquete'
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


	
	public function ObtSubcategorias()
	{
		$sql="
			SELECT *,
			(SELECT COUNT(*) FROM categoriapaquete as sub WHERE sub.iddepende=categoriapaquete.idcategoriapaquete) as sub

			FROM categoriapaquete WHERE estatus=1 AND iddepende='$this->iddepende' ORDER BY orden ASC
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


public function categories()
{


	$sql = "SELECT * FROM categoriapaquete WHERE parent_id=0";
	$result = $this->consulta($sql);

	$categories = array();

	while($row = $this->fetch_assoc())
	{
	$categories[] = array(
	'idcat' => $row['idcategoriapaquete'],
	'parent_id' => $row['iddepende'],
	'categoria_nombre' => $row['nombre'],
	'subcategory' => $this->sub_categories($row['idcategoriapaquete']),
	);
	}

	return $categories;
}

public function sub_categories($idcat)
{


	$sql = "SELECT * FROM categoriapaquete WHERE iddepende=$idcat";

	$result = $this->db->consulta($sql);

	$categories = array();

	while($row = $this->db->fetch_assoc($result))
	{
		$categories[] = array(
		'idcategoriapaquete' => $row['idcategoriapaquete'],
		'parent_id' => $row['iddepende'],
		'nombre' => $row['nombre'],
		'subcategorias' => $this->sub_categories($row['idcategoriapaquete']),
		);
	}
	
	return $categories;
}

function viewsubcat($categories)
{
$html = '<ul class="sub-category">';
foreach($categories as $category){

$html .= '<li>'.$category['categoria_nombre'].'</li>';

if( ! empty($category['subcategory'])){
$html .= viewsubcat($category['subcategory']);
}
}
$html .= '</ul>';

return $html;
}



	public function ObtenerTodasCategorias()
	{
		$sql="
			SELECT *
			FROM categoriapaquete WHERE estatus=1 
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