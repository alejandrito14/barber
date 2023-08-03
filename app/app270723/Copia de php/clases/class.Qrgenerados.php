<?php 
/**
 * 
 */
class Qrgenerados 
{
	public $db;
	public $idusuarios;
	public $idcita;
	public $qrgenerado;
    public $idqrgenerado;
	
	 public function ObtenerNoUsados()
    {
        $sql="SELECT *from qrgenerados WHERE idusuarios='$this->idusuarios' AND idcita='$this->idcita' AND estatus=1";
       
        $resp = $this->db->consulta($sql);
        $cont = $this->db->num_rows($resp);

        $array    = array();
        $contador = 0;
        if ($cont > 0) {

            while ($objeto = $this->db->fetch_object($resp)) {

                $array[$contador] = $objeto;
                $contador++;
            }
        }
        return $array;

    }

    public function CambiarEstatusqr($idqrgenerado)
    {
        $sql = "UPDATE qrgenerados 
        SET estatus = '2' 
        WHERE idqrgenerado = '$idqrgenerado'";

        $this->db->consulta($sql);
    }

    public function ConsultarQrUsuario()
    {
       $sql="SELECT *from qrgenerados WHERE idusuarios='$this->idusuarios' AND estatus=1 AND idcita='$this->idcita' AND qrgenerado='$this->qrgenerado'";
     

        $resp = $this->db->consulta($sql);
        $cont = $this->db->num_rows($resp);

        $array    = array();
        $contador = 0;
        if ($cont > 0) {

            while ($objeto = $this->db->fetch_object($resp)) {

                $array[$contador] = $objeto;
                $contador++;
            }
        }
        return $array;
    }

    public function ActualizarEstatusqr($idqrgenerado)
    {
        $sql = "UPDATE qrgenerados 
        SET estatus = '3' 
        WHERE idqrgenerado = '$idqrgenerado'";
        $this->db->consulta($sql);
    }

     public function GuardarCadenaQR()
    {
       $sql = "INSERT INTO qrgenerados (qrgenerado,estatus,idusuarios,imagen,idcita)
        VALUES ('$this->qrgenerado',1,'$this->idusuarios','$this->imagen','$this->idcita')  ";
        
        $result = $this->db->consulta($sql);

        $this->idqrgenerado=$this->db->id_ultimo();

    }

}

 ?>