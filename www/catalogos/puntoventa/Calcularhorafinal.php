<?php 


$horainicial=$_POST['horainicial'];
$intervaloservicio=$_POST['tiempo'];


$horafinal = date('H:i', strtotime($horainicial . ' +'.$intervaloservicio.' minutes'));

$respuesta['horafinal']=$horafinal;

 echo json_encode($respuesta);


 ?>