<?php 

/**
 * 
 */
class Tpv {

	public $db;
	public $idtpv;
	public $fecha;

	public $idtemporalcarrito;
	public $idusuarios;
	public $idpaquete;
	public $cantidad;
	public $costounitario;
	public $costototal;
	public $idsucursal;
	public $idespecialista;
	public $idcitaapartada;
	public $nombrepaquete;
	public $estatus;
	public $preciooriginal;
	public $idcortesia;
	public $colococortesia;
	public $fechacortesia;
	public $fechacreacion;
	public $codigocupon;
	public $montocupon;
	public $idcupon;
	public $montomonedero;
	public $idnota;
	public $idnotadescripcion;
	public $horainicial;
	public $horafinal;

	public function AgregarTpv()
	{
		$query="INSERT INTO tpv (estatus) VALUES ('1')";
		
		$resp=$this->db->consulta($query);
		$this->idtpv = $this->db->id_ultimo();
	}



	public function AgregarElementoTpv()
	{
		
			$sql="INSERT INTO temporalcarritotpv( idusuarios,idpaquete,cantidad,costounitario,costototal,idsucursal,idespecialista,nombrepaquete,fecha,horainicial,horafinal,idtpv) VALUES ('$this->idusuarios', '$this->idpaquete','$this->cantidad','$this->costounitario','$this->costototal','$this->idsucursal','$this->idespecialista','$this->nombrepaquete','$this->fecha','$this->horainicial','$this->horafinal','$this->idtpv')";
			
			$resp=$this->db->consulta($sql);
			$this->idtemporalcarrito=$this->db->id_ultimo();
		
	}

	public function ActualizarElementoTpv()
	{
		$sql="UPDATE temporalcarritotpv
		SET cantidad = '$this->cantidad',
    	costounitario = '$this->costounitario',
    	costototal = '$this->costototal',
    	idsucursal = '$this->idsucursal',
    	idespecialista = '$this->idespecialista',
    	nombrepaquete = '$this->nombrepaquete',
    	fecha = '$this->fecha',
    	horainicial = '$this->horainicial',
    	horafinal = '$this->horafinal',
    	idtpv = '$this->idtpv',
    	idpaquete = '$this->idpaquete'
		WHERE  idtemporalcarritotpv='$this->idtemporalcarrito'";

		$resp=$this->db->consulta($sql);
			

	}
}


 ?>