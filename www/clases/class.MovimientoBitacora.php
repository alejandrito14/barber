<?php
require_once('class.Sesion.php');
require_once('class.Fechas.php');

 class MovimientoBitacora
 {
	 public $db;
	 private $sesion;
	 private $f;
	 public function __construct()
	 {
         
		 $this->sesion = new Sesion();
		 $this->f = new Fechas();
		 
		 		 
	 }// fin de MovimientoBitacora
	 
	 public function guardarMovimiento($modulo,$tabla,$descripcion)
	 {
		
		   try {
		   	 $idbitacora = $this->sesion->obtenerSesion('idbitacoraSAS');
		   
		   $query_movimiento = "INSERT INTO bitacora_movimientos (idbitacora,modulo,descripcion) VALUES ($idbitacora,'$modulo','$descripcion');";
		   
		 
		   
		 
		   $this->db->consulta($query_movimiento);
		   	
		   } catch (Exception $e) {
		   	echo $e;
		   }
		   //$fechaactual = $this->f->fechaaYYYY_mm_dd_guion();
		  
		 
	 }// fin de guardarMovimiento
	 
 }// fin de clase MovimientoBitacora
?>