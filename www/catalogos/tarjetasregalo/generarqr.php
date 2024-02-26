<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');

error_reporting(0);

require_once("../../clases/class.Qr.php");
require_once("../../clases/class.Usuarios.php");
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Tarjetaregalo.php");
require_once("../../clases/class.Sesion.php");

try {

        $idtarjetaregalo=$_POST['idtarjetausuario'];
        
        $db = new MySQL();
        $lo = new Usuarios();
        $lo->db=$db;
        $fun=new Funciones();
       
        $tarjetaregalo=new Tarjetaregalo();
        $tarjetaregalo->db=$db;
        $tarjetaregalo->idtarjetaregalo=$idtarjetaregalo;
       $obtener= $tarjetaregalo->ObtenerTarjetaregalo();

        $sesion=new Sesion();    
      
       $codservicio=$sesion->obtenerSesion('codservicio');

       $idusuario=$obtener[0]->idusuario;
       $idsucursal=$obtener[0]->idsucursal;

        $cadena=$codservicio.'|'.$idsucursal.'|'.$idtarjetaregalo.'|'.$idusuario.'|'.date('Y-m-d H:i:s');
        $nombreqr=$idtarjetaregalo.'-'.date('Y-m-d H:i:s');

        $cadenaencrip=$fun->encrypt($cadena,'ISSINVERSA');
        $tarjetaregalo->nombre=$cadenaencrip;
        $tarjetaregalo->estatus=1;
        $tarjetaregalo->imagenqr=$nombreqr.'.png';
       



$config = array(
        'ecc' => 'H',    // L-smallest, M, Q, H-best
        'size' => 10,    // 1-50
        'dest_file' => 'qrgenerado/'.$codservicio.'/'.$nombreqr.'.png',
        'quality' => 90,
        'logo' => 'upload/logo/logo.png',
        'logo_size' => 90,
        'logo_outline_size' => 25,
        'logo_outline_color' => '#fafafa',
        'logo_radius' => 10,
        'logo_opacity' => 100,
);

 
        $ruta="https://".$_SERVER['SERVER_NAME']."/is-barber/web/tarjetaregalo.php?codigo=".$cadenaencrip;
        // Contenido del código QR
        $data = $ruta;
        if ($obtener[0]->imagenqr=='' || $obtener[0]->imagenqr==null ) {
       $tarjetaregalo->GuardarCadenaQR();
            # code...
        
        // Crea una clase de código QR
        $oPHPQRCode = new Qr();

        // establecer configuración
        $oPHPQRCode->set_config($config);

        // Crea un código QR
        $qrcode = $oPHPQRCode->generate($data);
        $imagenqr=$nombreqr.'.png';

        $obtenert= $tarjetaregalo->ObtenerTarjetaregalo();

        
    }else{

        $imagenqr=$obtener[0]->imagenqr;

         $ruta="http://".$_SERVER['SERVER_NAME'].":8888/is-barber/web/tarjetaregalo.php?codigo=".$obtener[0]->nombre;
    }

        $codservicio=$sesion->obtenerSesion('codservicio');

        // Mostrar código QR
       // echo '<img src="'.$qrcode.'?t='.time().'">';
        $rutaimagen='/is-barber/www/catalogos/tarjetasregalo/qrgenerado/'.$codservicio.'/'.$imagenqr;
        $respuesta['idusuarios']=$idusuario;
        $respuesta['imgqr']=$rutaimagen;
        $respuesta['respuesta']=1;
        $respuesta['ruta']=$ruta;
        $respuesta['idtarjetaregalodo']= $tarjetaregalo->idtarjetaregalo;
        
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