<?php 

class Interes 
	{
		public $db; //objeto de conecxion con la base de datos

		public $idusuarios;
		public $idinteres;

		public function ObtenerInteres()
		{
			$sql = "SELECT *FROM interesespersonales WHERE estatus=1
			ORDER BY interes asc
			
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


		public function GuardarInteresUsuario()
		{
			$sql="INSERT INTO usuarios_interesespersonales( idusuarios, idintereses ) VALUES ('$this->idusuarios','$this->idinteres')";
			
			$resp = $this->db->consulta($sql);

		}
		
	}

 ?>