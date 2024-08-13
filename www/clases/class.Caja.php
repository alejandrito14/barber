<?php 

class Caja 
	{
		public $db; //objeto de conecxion con la base de datos

		public $idusuario;
		public $fechainicio;
		public $fechafin;
		public $montoinicial;
		public $montofinal;
		public $totalventas;
		public $estatus;
		public $idmanejocaja;

		public $idnotapago;


		public function VerificarCajaAbierta()
		{
			$sql = "SELECT *FROM manejocaja WHERE estatus=1 AND idusuario='$this->idusuario'";


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


		public function AbrirCaja()
		{
			$sql="INSERT INTO manejocaja( idusuario, montoinicial, estatus) VALUES ('$this->idusuario', '$this->montoinicial','$this->estatus')";

			$resp=$this->db->consulta($sql);
			$this->idmanejocaja=$this->db->id_ultimo();

		}

		public function GuardarNotaCaja()
		{
			$sql="INSERT INTO manejocajanota( idmanejocaja, idnotapago) VALUES ('$this->idmanejocaja', '$this->idnotapago')";
			
			$resp=$this->db->consulta($sql);
		}

		public function ActualizarCaja()
		{
			$sql="UPDATE manejocaja SET  fechafin = '$this->fechafin',montofinal = '$this->montofinal', estatus = '$this->estatus' WHERE idmanejocaja = '$this->idmanejocaja'";
			$resp=$this->db->consulta($sql);
		}


		public function ObtenerCaja()
		{
			$sql = "SELECT *FROM manejocaja WHERE idmanejocaja='$this->idmanejocaja'";


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

		public function ObtenerNotasPagadas()
		{
			$sql="SELECT notapago.idnotapago,folio,notapago.estatus,fecha, fechaentrega,fechacompletado,idmanejocaja,IF(estatus=1,IF(fechaentrega!='',fechaentrega,fecha),'')as fechapago
			FROM notapago 
			LEFT JOIN manejocajanota on   notapago.idnotapago=manejocajanota.idnotapago WHERE idmanejocaja='$this->idmanejocaja'
			  ";

			$resp = $this->db->consulta($sql);
			$cont = $this->db->num_rows($resp);


			$array=array();
			$contador=0;
			if ($cont>0) {

				while ($objeto=$this->db->fetch_object($resp)) {

					if ($objeto->fechapago=='') {
						$this->idnotapago=$objeto->idnotapago;
						$this->QuitarIdManejo();
					}
					if ($objeto->fechapago!='') {
					$array[$contador]=$objeto;
					$contador++;
					}
				} 
			}
			return $array;
		}


		public function QuitarIdManejo()
		{
			$sql="UPDATE manejocajanota SET idmanejocaja=0 WHERE idnotapago='$this->idnotapago' AND idmanejocaja='$this->idmanejocaja'";
			
			$resp = $this->db->consulta($sql);
			$cont = $this->db->num_rows($resp);
		}


		public function ObtenerNotasPagadasSinManejo()
		{
			$sql="SELECT *from (SELECT
				notapago.idnotapago,
				folio,tpv,
				notapago.estatus,
				fecha,
				fechaentrega,
				fechacompletado,
				idmanejocaja,
				IF
					( estatus = 1, IF ( fechaentrega != '', fechaentrega, fecha ), '' ) AS fechapago 
				FROM
				notapago
				LEFT JOIN manejocajanota ON notapago.idnotapago = manejocajanota.idnotapago ) as tabla
				WHERE idmanejocaja='0' AND fechapago>='$this->fechainicio' AND fechapago<='$this->fechafin'
			  ";
			  
			$resp = $this->db->consulta($sql);
			$cont = $this->db->num_rows($resp);


			$array=array();
			$contador=0;
			if ($cont>0) {

				while ($objeto=$this->db->fetch_object($resp)) {

					
					if ($objeto->fechapago!='') {

					$this->idnotapago=$objeto->idnotapago;
					$this->ActualizarIdManejo();

					$array[$contador]=$objeto;
					$contador++;

						
					}
				} 
			}
			return $array;
		}


		public function ActualizarIdManejo()
		{
			$sql="UPDATE manejocajanota SET idmanejocaja='$this->idmanejocaja' WHERE idnotapago='$this->idnotapago' AND idmanejocaja='0'";

			$resp = $this->db->consulta($sql);
			$cont = $this->db->num_rows($resp);
		}


		public function ObtenerNotasPagadasApp()
		{
			$sql="SELECT *from (SELECT
				notapago.idnotapago,
				folio,tpv,
				notapago.estatus,
				fecha,
				fechaentrega,
				fechacompletado,
				idmanejocaja,
				IF
					( estatus = 1, IF ( fechaentrega != '', fechaentrega, fecha ), '' ) AS fechapago 
				FROM
				notapago
				LEFT JOIN manejocajanota ON notapago.idnotapago = manejocajanota.idnotapago ) as tabla
				WHERE tpv='0' AND fechapago>='$this->fechainicio' AND fechapago<='$this->fechafin'
			  ";
			 
			$resp = $this->db->consulta($sql);
			$cont = $this->db->num_rows($resp);


			$array=array();
			$contador=0;
			if ($cont>0) {

				while ($objeto=$this->db->fetch_object($resp)) {

					
					if ($objeto->fechapago!='') {

					$this->idnotapago=$objeto->idnotapago;
					$this->AgregarIdManejo();

					$array[$contador]=$objeto;
					$contador++;

						
					}
				} 
			}
			return $array;
		}


		public function AgregarIdManejo()
		{
			$sql="INSERT INTO manejocajanota( idmanejocaja, idnotapago) VALUES ('$this->idmanejocaja', '$this->idnotapago')";

			$resp = $this->db->consulta($sql);

		}
}