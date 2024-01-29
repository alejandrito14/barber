<?php 
define('API_ACCESS_KEY', 'AAAAWde0tiY:APA91bFKb9kYErB8MoXTyEiUNfYNi4VpPLBKte6PXkYjke0ygYMmGdhYj22i_0nkji4erMtBGfkHzGfde47o1IVRTvte4Fg7RISglYexXfE3H2zcYWksrwwAOCEU6gcaLCGqNmv_DgWr');

class NotificacionPush 
{


    public $db;
    public $iduseradmin;
    public $idnotificacionadmin;
    public $estatus;
    public $apikey;
    public $valor;
    public $navpage;
    public $idcliente;
    public $idusuario;
    public $idnotificacioncliente;
    public $banderatuto;

public function EnviarNotificacion($listatokens,$titulo,$mensaje)
    {

        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
    

        $tokenList=$listatokens;

     $notification = [
            'title' =>$titulo,
            'body' => $mensaje,
            'icon' =>'myIcon', 
            'sound' => 'mySound'
        ];
        $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

        $fcmNotification = [
            'registration_ids' => $tokenList, //multple token array
           //'to'        => $token, //single token
            'notification' => $notification,
            'data' => $extraNotificationData
        ];

        $headers = [
            'Authorization: key=' . $this->apikey,
            'Content-Type: application/json'
        ];


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);


       // echo $result;
    
    }

    public function AgregarNotifcacionaUsuarios($idusuario,$texto,$ruta,$valor,$estatus)
    {
        $sql="INSERT INTO notificacioncliente(idusuario,texto,ruta,valor,estatus) VALUES('$idusuario','$texto','$ruta','$valor','$estatus')";


     
        $resp=$this->db->consulta($sql);

    }

    public function Cambiarestatusnotificacion()
    {
          $query = "UPDATE notificacionadmin SET estatus = '$this->estatus' WHERE idnotificacionadmin = '$this->idnotificacionadmin'";
        $this->db->consulta($query);
    }

      public function Obtenertoken()
    {
        $fechaactual=date('Y-m-d');
        $sql = "SELECT  DISTINCT token,uuid FROM usuariotoken WHERE idusuario='$this->idusuario' and  token!='null' 
        ORDER BY idusuariotoken DESC LIMIT 3 ";
     
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


    public function ObtenerApiKey()
    {
       $query="SELECT  *, count(idpagina_configuracion) as cuantos FROM pagina_configuracion";
                
        $resp=$this->db->consulta($query);
        $rows=$this->db->fetch_assoc($resp);
        return $rows;
     


    }
	
}


 ?>