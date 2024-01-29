<?php 

class Comision 
{
	public $db;
	public $idcomisionespecialista;
	public $tipo;
	public $monto;
	public $idespecialista;
	public $idpaquete;
	public $estatus;


	public function GuardarComision()
	{
		$query="INSERT INTO comisionespecialista (tipo,monto,idespecialista,estatus) VALUES ('$this->tipo','$this->monto','$this->idespecialista','$this->estatus')";
		
		$resp=$this->db->consulta($query);
		$this->idcomisionespecialista = $this->db->id_ultimo();
	}

	public function GuardarComisionPaquete()
	{
		$query="INSERT INTO comisionpaquete (idpaquete,idcomisionespecialista) VALUES ('$this->idpaquete','$this->idcomisionespecialista')";
		
		$resp=$this->db->consulta($query);
	
	}

	public function ModificarComision()
	{
		$query="UPDATE comisionespecialista 
		SET tipo='$this->tipo',
		monto='$this->monto',
		estatus='$this->estatus',
		idespecialista='$this->idespecialista' 
		WHERE idcomisionespecialista=$this->idcomisionespecialista";
	
		$resp=$this->db->consulta($query);


	}

	public function EliminarComisionPaquete()
	{
		$query="DELETE FROM comisionpaquete WHERE idcomisionespecialista='$this->idcomisionespecialista'";

		$resp=$this->db->consulta($query);

	}

	public function ObtenerComisiones()
	{
		$sql="
			SELECT
			comisionespecialista.idcomisionespecialista,
			comisionespecialista.tipo,
			comisionespecialista.monto,
			comisionespecialista.idespecialista,
			comisionespecialista.estatus,
			usuarios.nombre,
			usuarios.paterno,
			usuarios.materno,
			especialista.idusuarios,
			especialista.idsucursal
			FROM
			comisionespecialista
			INNER JOIN especialista on comisionespecialista.idespecialista=especialista.idespecialista
			inner join usuarios on usuarios.idusuarios =especialista.idusuarios
			ORDER BY idcomisionespecialista


		";
		

		$resp = $this->db->consulta($sql);

		return $resp;
       /* $cont = $this->db->num_rows($resp);

        $array    = array();
        $contador = 0;
        if ($cont > 0) {

            while ($objeto = $this->db->fetch_object($resp)) {

            	

                $array[$contador] = $objeto;
                $contador++;
            }
        }
        return $array;*/
	}


	public function buscarComision($value='')
	{
		$sql="
			SELECT
			comisionespecialista.idcomisionespecialista,
			comisionespecialista.tipo,
			comisionespecialista.monto,
			comisionespecialista.idespecialista,
			comisionespecialista.estatus,
			usuarios.nombre,
			usuarios.paterno,
			usuarios.materno,
			especialista.idusuarios,
			especialista.idsucursal
			FROM
			comisionespecialista
			INNER JOIN especialista on comisionespecialista.idespecialista=especialista.idespecialista
			inner join usuarios on usuarios.idusuarios =especialista.idusuarios
			WHERE idcomisionespecialista='$this->idcomisionespecialista'

		";

		$resp = $this->db->consulta($sql);

		return $resp;
	}


	public function GuardarSubcategoria()
	{
		$query="UPDATE comisionespecialista 
		SET
		subcategorias='$this->subcategorias' 
		WHERE idcomisionespecialista=$this->idcomisionespecialista";
	
		$resp=$this->db->consulta($query);
	}


	/*	public function GuardarSubcategoria()
	{
		$query="UPDATE comisionespecialista 
		SET
		subcategorias='$this->subcategorias' 
		WHERE idcomisionespecialista=$this->idcomisionespecialista";
	
		$resp=$this->db->consulta($query);
	}*/

	 public function GuardarCategoria($idcategoria){

	 	$query="INSERT INTO categoriacomision (idcomisionespecialista,idcategoria) VALUES ('$this->idcomisionespecialista','$idcategoria')";
		
		$resp=$this->db->consulta($query);


	 }
	public function GuardarSubcategorias($idcategoria){

		$query="INSERT INTO subcategoriacomision (idcomisionespecialista,idcategoria) VALUES ('$this->idcomisionespecialista','$idcategoria')";
		$resp=$this->db->consulta($query);

	}
 public function EliminarComisionCategoria()
 {
 	$query="DELETE FROM categoriacomision WHERE idcomisionespecialista='$this->idcomisionespecialista'";

		$resp=$this->db->consulta($query);
 }	

 public function EliminarComisionSubcategoria ()
 {

 	$query="DELETE FROM subcategoriacomision WHERE idcomisionespecialista='$this->idcomisionespecialista'";

		$resp=$this->db->consulta($query);
 	
 }


 public function ObtenerPaquetesComision()
 {
 	 $sql = "SELECT * FROM comisionpaquete WHERE idcomisionespecialista='$this->idcomisionespecialista'";

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


 public function ObtenerCategoriasComisiones()
 {
 	 $sql = "SELECT * FROM categoriacomision WHERE idcomisionespecialista='$this->idcomisionespecialista'";

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


 public function ObtenerSubcategoriasComisiones()
 {
 	 $sql = "SELECT * FROM subcategoriacomision WHERE idcomisionespecialista='$this->idcomisionespecialista'";

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


 public function BorrarComision()
 {
 	$query="DELETE FROM comisionespecialista WHERE idcomisionespecialista='$this->idcomisionespecialista'";
 	
		$resp=$this->db->consulta($query);
 	
 }

	
}

 ?>