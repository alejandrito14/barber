<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');

error_reporting(0);

require_once("clases/class.Qr.php");
require_once("clases/class.Usuarios.php");
require_once("clases/conexcion.php");
require_once("clases/class.Funciones.php");
require_once("clases/class.Funciones.php");
require_once("clases/class.Qrgenerados.php");


try {

        $idusuario=$_POST['id_user'];
        $idcita=$_POST['idcita'];
        $db = new MySQL();
        $lo = new Usuarios();
        $lo->db=$db;
        $fun=new Funciones();
        $qrgenera=new Qrgenerados();
        $qrgenera->db=$db;

        $lo->idusuarios=$idusuario;
        $qrgenera->idusuarios=$idusuario;
        $qrgenera->idcita=$idcita;
        $usuario=$lo->ObtenerUsuario();
        $obtenerusuario=$usuario[0];
        $nombreqr=$idusuario.'-'.date('Y-m-d H:i:s');
       // var_dump($obtenerusuario->usuario);die();
        $cadena=$idcita.'|'.$idusuario.'|'.$usuario[0]->usuario.'|'.$usuario[0]->nombre.'|'.$usuario[0]->paterno.'|'.$usuario[0]->materno.'|'.date('Y-m-d H:i:s');

        $cadenaencrip=$fun->encrypt($cadena,'ISSINVERSA');
        $qrgenera->qrgenerado=$cadenaencrip;
        $qrgenera->estatus=1;
        $qrgenera->imagen=$nombreqr.'.png';
        $nousados=$qrgenera->ObtenerNoUsados();
        if (count($nousados)>0) {
            # code...
        
        for ($i=0; $i < count($nousados); $i++) { 
              $idgenerado=$nousados[$i]->idqrgenerado;
              $qrgenera->CambiarEstatusqr($idgenerado);
        }
    }

        $qrgenera->GuardarCadenaQR();


$config = array(
        'ecc' => 'H',    // L-smallest, M, Q, H-best
        'size' => 12,    // 1-50
        'dest_file' => 'upload/qrgenerado/'.$nombreqr.'.png',
        'quality' => 90,
        'logo' => 'upload/logo/logo.png',
        'logo_size' => 90,
        'logo_outline_size' => 25,
        'logo_outline_color' => '#fafafa',
        'logo_radius' => 10,
        'logo_opacity' => 100,
);

        // Contenido del código QR
        $data = $cadenaencrip;

        // Crea una clase de código QR
        $oPHPQRCode = new Qr();

        // establecer configuración
        $oPHPQRCode->set_config($config);

        // Crea un código QR
        $qrcode = $oPHPQRCode->generate($data);

        // Mostrar código QR
       // echo '<img src="'.$qrcode.'?t='.time().'">';

        $respuesta['idusuarios']=$idusuario;
        $respuesta['imgqr']=$nombreqr.'.png';
        $respuesta['respuesta']=1;
        $respuesta['idqrgenerado']= $qrgenera->idqrgenerado;
        
        $myJSON = json_encode($respuesta);
        echo $myJSON;
        
} catch (Exception $e) {

        //$db->rollback();
        //echo "Error. ".$e;
        
        $array->resultado = "Error: ".$e;
        $array->msg = "Error al ejecutar el php";
        $array->id = '0';
                //Retornamos en formato JSON 
        $myJSON = json_encode($array);
        echo $myJSON;
        
}


?>