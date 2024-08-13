<?php
class Notapagometodopago
{
	public $db;//objeto de la clase de conexcion
	
	public $idnotapagometodopago;//identificador
	public $fecha;
	public $idnotapago;
	public $idtipopago ;
	public $tipopago;
	public $montovisual;
	public $confoto;
	public $idbanco;
	public $tipotarjeta;
	public $digitostarjeta;
	public $datostarjeta;
	public $montocampo;

	public function GuardarMetodopagoNota()
	{
		$sql="INSERT INTO notapagometodopago( idtipopago, tipopago, montovisual, confoto, idbanco, tipotarjeta, digitostarjeta, datostarjeta, montocampo) VALUES (  '$this->idtipopago','$this->tipopago','$this->montovisual', '$this->confoto', '$this->idbanco','$this->tipotarjeta', '$this->digitostarjeta', '$this->datostarjeta','$this->montocampo')";
		

		$resp = $this->db->consulta($sql);
		$this->idnotapagometodopago=$this->db->id_ultimo();


	}

	public function GuardarRelacionNotaMetodo()
	{
		$sql="INSERT INTO notapago_notapagometodopago(idnotapago, idnotapagometodopago) VALUES ( '$this->idnotapago', '$this->idnotapagometodopago')";
	
		$resp = $this->db->consulta($sql);


	}


	public function ObtenerMetodospago()
	{
		$sql="SELECT
		notapago_notapagometodopago.idnotapago,
		notapagometodopago.idnotapagometodopago,
		notapagometodopago.fecha,
		notapagometodopago.idtipopago,
		notapagometodopago.tipopago,
		notapagometodopago.montovisual,
		notapagometodopago.confoto,
		notapagometodopago.idbanco,
		notapagometodopago.tipotarjeta,
		notapagometodopago.digitostarjeta,
		notapagometodopago.datostarjeta,
		notapagometodopago.montocampo
		FROM
		notapago_notapagometodopago
		JOIN notapagometodopago
		ON notapago_notapagometodopago.idnotapagometodopago = notapagometodopago.idnotapagometodopago 
		WHERE idnotapago='$this->idnotapago'";

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
	
	
}
?>