<?php
require_once("../../clases/class.Sesion.php");
require_once("../../clases/class.Especialista.php");
require_once("../../clases/conexcion.php"); 
require_once("../../clases/class.Fechas.php");
require_once("../../clases/class.Cita.php"); 

$se = new Sesion();
$especialista=new Especialista();
$db=new MySQL();
$especialista->db=$db;
$cita=new Cita();
$cita->db=$db;

$fechas=new Fechas();


$idsucursal=$_POST['idsucursal'];
$horaselecte=$_POST['horaselecte'];
$fechaselecte2=$_POST['fechaselecte2'];
$idespecialista=$_POST['idespecialista'];


    // code...

$arraypaqueteseleccionado=json_decode($_POST['arraypaqueteseleccionado']);

if ($idespecialista!='') {
    // code...

$especialista->idespecialista=$idespecialista;
$obtenerespe=$especialista->ObtenerEspecialista();
$nombreespecialista=$obtenerespe[0]->nombre.' '.$obtenerespe[0]->paterno;
}

//var_dump($arraypaqueteseleccionado);

        $horaanterior="";
        for ($i=0; $i < count($arraypaqueteseleccionado); $i++) {

            $arraypaqueteseleccionado[$i]->{'informacion'}=0;
             $arraypaqueteseleccionado[$i]->{'fecha'}='';
             $arraypaqueteseleccionado[$i]->{'hora'}='';
             $arraypaqueteseleccionado[$i]->{'horafinal'}='';
             $arraypaqueteseleccionado[$i]->{'nombreespecialista'}='';
             $arraypaqueteseleccionado[$i]->{'idespecialista'}='';
             $arraypaqueteseleccionado[$i]->{'disponible'}='';
             $arraypaqueteseleccionado[$i]->{'desbloqueado'}=1;
             $arraypaqueteseleccionado[$i]->{'fechaformato'}='';

            if ($fechaselecte2!='') {
                // code...
            
            $arraypaqueteseleccionado[$i]->{'fecha'}=$fechaselecte2;

           $arraypaqueteseleccionado[$i]->{'fechaformato'}=$fechas->fecha_texto5($fechaselecte2);

            }

            $intervaloservicio=$arraypaqueteseleccionado[$i]->{'intervaloservicio'};

            if ($horaselecte!='' && $horaselecte!=1) {
                // code...
            

            if ($i==0) {
               $arraypaqueteseleccionado[$i]->{'hora'}=$horaselecte;

                $horafinal = date('H:i', strtotime($arraypaqueteseleccionado[$i]->{'hora'} . ' +'.$intervaloservicio.' minutes'));
               
             }

           


             if ($i>0) {
                $horaanterior=$horafinal;

                $arraypaqueteseleccionado[$i]->{'hora'}=$horaanterior;

                $horafinal = date('H:i', strtotime($horaanterior . ' +'.$intervaloservicio.' minutes'));

                $horaanterior=$horafinal;

             }


             $arraypaqueteseleccionado[$i]->{'horafinal'}=$horafinal;

              $arraypaqueteseleccionado[$i]->{'nombreespecialista'}=$nombreespecialista;
              $arraypaqueteseleccionado[$i]->{'barbero'}=$nombreespecialista;
           $arraypaqueteseleccionado[$i]->{'idespecialista'}=$idespecialista;

         }


            
         if ( $arraypaqueteseleccionado[$i]->{'horafinal'}!='') {
            $arraypaqueteseleccionado[$i]->{'informacion'}=1;
         }

          

           $cita->idespecialista=$idespecialista;
           $cita->fechacita=$fechaselecte2;
           $cita->horafinal=$horafinal;
           $cita->horainicial=$arraypaqueteseleccionado[$i]->{'hora'};
          
           if ( $cita->idespecialista!='' && $cita->fechacita!='') {
               // code...
           

           $verificarHoradisponible=$cita->ChecarHorarioFechaEspecialista();
           $disponible=1;
           if (count($verificarHoradisponible)>0) {
              $disponible=0;
           }

           $arraypaqueteseleccionado[$i]->{'disponible'}=$disponible;

           $arraypaqueteseleccionado[$i]->{'desbloqueado'}=1;
           if (count($arraypaqueteseleccionado)>1) {
               // code...
           
            if ($i === count($arraypaqueteseleccionado) - 1) {

                 $arraypaqueteseleccionado[$i]->{'desbloqueado'}=1;
               }else{
                $arraypaqueteseleccionado[$i]->{'desbloqueado'}=0;
               }
           }

       }
    }



        $respuesta['array']=$arraypaqueteseleccionado;
        echo json_encode($respuesta);



 ?>