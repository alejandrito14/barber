<?php 
/**
 * 
 */
class ZonaHoraria 
{
	
	public $db;
	public $idusuario;
	public $zonahoraria;
	public $idusuariozonahoraria;

	public function GuardarZonaHoraria()
	{
		$sql = "INSERT INTO usuariozonahoraria (idusuarios,zonahoraria)
        VALUES ('$this->idusuario','$this->zonahoraria')";

        $result  = $this->db->consulta($sql);
        $this->idusuariozonahoraria = $this->db->id_ultimo();
	}


	public function EstablecerZonaHoraria()
	{
			$sql="SELECT *FROM usuariozonahoraria WHERE idusuario='$this->idusuario' ORDER BY fecharegistro DESC LIMIT 1   -- Ordena los registros por fecha en orden descendente";
			echo $sql;die();
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
		
		$this->zonahoraria=$array[0]->zonahoraria;


			$serverTimezone = new DateTimeZone('America/Mexico_City');
			// Zona horaria del usuario (Los Ángeles)
			$userTimezone = new DateTimeZone($this->zonahoraria);

			// Establecer la zona horaria del servidor
			date_default_timezone_set('America/Mexico_City');

			// Crear un objeto DateTime con la hora actual del servidor
			$serverTime = new DateTime('now', $serverTimezone);

			// Cambiar la zona horaria al usuario
			$serverTime->setTimezone($userTimezone);

			// Ahora $serverTime contiene la hora en la zona horaria del usuario
			$userTime = $serverTime->format('Y-m-d H:i:s');
			  echo $userTime;die();


	}
}
 ?>