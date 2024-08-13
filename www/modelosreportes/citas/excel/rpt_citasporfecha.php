<?php

/*======================= INICIA VALIDACIÓN DE SESIÓN =========================*/

require_once("../../../clases/class.Sesion.php");
//creamos nuestra sesion.
$se = new Sesion();

if(!isset($_SESSION['se_SAS']))
{
	/*header("Location: ../../login.php"); */ echo "login";

	exit;
}


$tipousaurio = $_SESSION['se_sas_Tipo'];  //variables de sesion
$lista_empresas = $_SESSION['se_liempresas']; //variables de sesion

//validaciones para todo el sistema


/*======================= TERMINA VALIDACIÓN DE SESIÓN =========================*/


require_once ("../../../clases/dompdf/autoload.inc.php");
//Importamos nuestras clases
require_once("../../../clases/conexcion.php");
require_once("../../../clases/class.Reportes.php");
require_once("../../../clases/class.Funciones.php");
require_once("../../../clases/class.Botones.php");
require_once("../../../clases/class.Usuarios.php");
require_once("../../../clases/class.Fechas.php");
require_once("../../../clases/class.Notapago.php");

require_once("../../../clases/class.Tipodepagos.php");



//Se crean los objetos de clase
$db = new MySQL();
$reporte = new Reportes();
$f = new Funciones();
$bt = new Botones_permisos();
/*$pagos=new Pagos();
$pagos->db=$db;*/
$usuarios=new Usuarios();
$usuarios->db=$db;
$fechas=new Fechas();
$nota=new Notapago();
$nota->db=$db;
$tipodepagos=new Tipodepagos();
$tipodepagos->db=$db;
$estatuspago=array('pendiente','proceso','aceptado','rechazado','reembolso','sin reembolso');
$estatusaceptado=array('NO ACEPTADO','ACEPTADO');
$estatusapagado=array('NO PAGADO','PAGADO','PENDIENTE POR VALIDAR');
//Recibo parametros del filtro
	
	$pantalla=$_GET['pantalla'];
  
    $fechainicio=$_GET['fechainicio'];
    if (!isset($_GET['fechainicio'])) {
       $fechainicio='2024-06-19';
    }

/*======================= TERMINA VALIDACIÓN DE SESIÓN =========================*/

//Importamos las clases que vamos a utilizar
require_once("../../../clases/class.Dashboard.php");
require_once("../../../clases/class.Especialista.php");
/*require_once("../../clases/class.HorariosServicios.php");
*/
require_once("../../../clases/class.Cita.php");    
require_once("../../../clases/class.HorarioEspecialista.php"); 
require_once("../../../clases/class.HorariosSucursal.php");    

    //declaramos los objetos de clase
    $dashboard = new Dashboard();
    $especialista=new Especialista();
    $especialista->db=$db;
    $cita = new Cita();
    $cita->db=$db;
    $horarioespecialista=new HorarioEspecialista();
    $horarioespecialista->db=$db;
    $notapago=new Notapago();
    $notapago->db=$db;
    $horariosucursal=new HorariosSucursal();
    $horariosucursal->db=$db;
    $cita->idsucursal=$se->obtenerSesion('idsucursalsesion');
    $horarioespecialista->idsucursal=$se->obtenerSesion('idsucursalsesion');
    $especialista->idsucursal=$se->obtenerSesion('idsucursalsesion');
    //$horarioservicio = new HorariosSucursal();

    //$horarioservicio->db=$db;
    //enviamos la conexión a las clases que lo requieren
    $dashboard->db=$db;
    $md->db = $db;  
    $zonas->db=$db;
    $fecharecibida=$fechainicio;
    $notapago->fecha=$fecharecibida;
    $idsucursal=$se->obtenerSesion('idsucursalsesion');
    $fecha=date('Y-m-d',strtotime($fecharecibida));
    $intervaloconf=$dashboard->ObtenerIntervalo();

    $operacion=$_POST['operacion'];

    if ($operacion==1) {
        $fecha=date("Y-m-d",strtotime($fecha."- 1 days")); 
    }

    if($operacion==2){
    
        $fecha=date("Y-m-d",strtotime($fecha."+ 1 days")); 
    }
    

    $fechas->fecha=$fecha;
    $cita->fecha=$fecha;
    $dashboard->fechainicial=$fecha;
    $especialista->fecha=$fecha;
    //echo $primerdiames.''.$ultimodiames;die();
    $obtener=$cita->ObtenerCitasFechaEspeci();
    
    $obtenerfecha=$fechas->fecha_texto4($fecha);


    $horariosucursal->idsucursal=$idsucursal;
    $dia=$fechas->numeroDiaSemana($fecha);
    $obtenerhorariosucursal=$horariosucursal->ObtenerHorariosSucursal($dia);
    //var_dump($obtenerhorariosucursal);die();
    
    $horainicialsucursal='10:00';
    $horafinalsucursal='21:00';

        if (count($obtenerhorariosucursal)>0) {
            $horainicialsucursal=$obtenerhorariosucursal[0]->horainicial;
            $horafinalsucursal=$obtenerhorariosucursal[0]->horafinal;
        }
    $obtenerintervalos=$fechas->intervaloHora($horainicialsucursal,$horafinalsucursal,$intervaloconf);

    $obtenerzonas=$especialista->ObtenerEspecialistasTVisibledashboard();
    

$estatus=array('Pendiente','En proceso','Completado','Cancelado','Caducado');
$claseestatus=array('#f7bb44','#38a2f7','#2b952a','red','gray');
$fechaactual=date('Y-m-d');
$horaactual=date('H:i');
    for ($i=0; $i <count($obtenerzonas) ; $i++) { 
        
            $obtenerzonas[$i]->intervalos=array();
            
                for ($k=0; $k <count($obtenerintervalos); $k++) { 
                    
                    $hora1intervalo=$obtenerintervalos[$k];
                    $hora2intervalo=$obtenerintervalos[$k+1];
                    
                

                    $disponible=1;


            $horarioespecialista->dia=$fechas->numeroDiaSemana($fecha);
            $horarioespecialista->horainicial=substr($hora1intervalo, 0, 5);
            $horarioespecialista->horafinal=substr($hora2intervalo, 0, 5);;
            $horarioespecialista->idespecialista=$obtenerzonas[$i]->idespecialista;
            $horarioespecialista->idsucursal=$idsucursal;


            $verificarhorario=$horarioespecialista->VerificarHorario2();
            $consultarsiestaocupado=[];
            $pasa=1;
            if (count($verificarhorario)>0) {
                $pasa=1;
            }




                if ($hora1intervalo!='' && $hora2intervalo!='' && $pasa==1 ) {
                            # code...
                        
                    $especialista->idespecialista=$obtenerzonas[$i]->idespecialista;
                    $especialista->horainicial=substr($hora1intervalo, 0, 5);
                    $especialista->horafinal=substr($hora2intervalo, 0, 5);
                    $especialista->fecha=$fecha;


                    $consultarsiestaocupado=$especialista->Disponibilidad5();

                    
                        /*$consultarsiestaocupado[0]->totalpagado=0;
*/                  if (count($consultarsiestaocupado)>0) {
                        $consultarsiestaocupado[0]->tpv=0;

                        $disponible=0;
                        $est=$consultarsiestaocupado[0]->estatus;
                        $consultarsiestaocupado[0]->textoestatus=$estatus[$est];

                        $consultarsiestaocupado[0]->claseestatus=$claseestatus[$est];


                        $hora_inicial = strtotime($consultarsiestaocupado[0]->horainicial);
                        $hora_final = strtotime($consultarsiestaocupado[0]->horafinal);

                        $diferencia_en_segundos = $hora_final - $hora_inicial;
                        $diferencia_en_minutos = $diferencia_en_segundos / 60;

                        $consultarsiestaocupado[0]->intervaloservicio=$diferencia_en_minutos;


                        $idcita=$consultarsiestaocupado[0]->idcita;
                        $notapago->idcita=$idcita;
                        $verificarpago=$notapago->VerificarCita();

                        $consultarsiestaocupado[0]->pagado=0;
                        $consultarsiestaocupado[0]->tpv=$verificarpago[0]->tpv;

                        if (count($verificarpago)>0) {

                            if ($verificarpago[0]->estatus==1) {

                                $consultarsiestaocupado[0]->pagado=1;


                                /*$consultarsiestaocupado[0]->totalpagado=$verificarpago[0]->total;*/
                            }
                            
                        }

                        
                    }else{

            

                        if ($fecharecibida== $fechaactual) {
                        
                        if ($horaactual>=$hora1intervalo) {
                            $disponible=1;
                                
                                }else{
                                    $disponible=1;
                                }

                            }else{


                        if ($fecharecibida<= $fechaactual) {
                                    # code...
                                
                                $disponible=1;
                                    }
                                
                            }

                    }

                }else{
                    
                    $disponible=0;

                }

                /*if($pasa==0){

                    $disponible=0;
                }*/
                        $arrayintervalo = array('horainicialntervalo' =>$hora1intervalo ,'horafinalintervalo'=>$hora2intervalo,'disponible'=>$disponible,'servicio'=>$consultarsiestaocupado);

                        array_push($obtenerzonas[$i]->intervalos, $arrayintervalo);


                     

                }


                
                
    

    }

    $ObtenerProductosnotasincita=$notapago->ObtenerNotasSinCitas();

/*  $obtenerintervaloscon=$fechas->intervaloHora('00:00:00','23:59:00',$intervaloconf);

*/

    /**/


    $respuesta['respuesta']=1;
    $respuesta['fechaactual']=$obtenerfecha;
    $respuesta['horarios']=$obtener;
    $respuesta['intervalos']=$obtenerintervalos;
    $respuesta['pxintervalo']=$intervaloconf+50;
    $respuesta['zonas']=$obtenerzonas;
    $respuesta['fecha']=$fecha;
    $respuesta['intervaloconf']=$intervaloconf;
    //echo json_encode($respuesta);

$respuesta=json_encode($respuesta);

$data = json_decode($respuesta, true);


/*-------------------------------------*/



       
 
if($pantalla==0) {
	# code...

//id alumno/alumno/tutor/celular/tipo de servicio/id servicio/servicio/aceptado/pagado/monto
$filename = "Rep_citas_".$fechainicio.".xls";
header("Content-Type: application/vnd.ms-excel charset=iso-8859-1");
header('Content-Disposition: attachment; filename="'.$filename.'"');

}

?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 
 <style>
 	.wrap2 { 
 
  height:50px;
  overflow: auto;
  width:100px;
}
 </style>



<?php

// Suponiendo que $arraymanejo es un array de objetos que ya está definido en tu script

// Agrupar datos por cuenta (nombre)
$grouped_data = [];
$cuentabancaria = "";
$totals = [];
/*foreach ($arraymanejo as $item) {
    $cuentabancaria = $item->formapago;
    if (!isset($grouped_data[$item->nombre])) {
        $grouped_data[$item->nombre] = [];
        $totals[$item->nombre] = 0;
    }
    $grouped_data[$item->nombre][] = $item;
    $totals[$item->nombre] += floatval($item->total); // Convertir a float y sumar al total
}*/
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
       table {
        table-layout: fixed;
        width: 100%;
    }
    th, td {
        width: 100px; /* ajusta el ancho de las columnas según tus necesidades */
        word-wrap: break-word; /* permite el salto de línea en celdas largas */
    }

        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .group-header {
            background-color: #d9d9d9;
            font-weight: bold;
            cursor: pointer;
        }
        .hidden-row {
            display: none;
        }

        .verticalText {
writing-mode: vertical-lr;
transform: rotate(180deg);
vertical-align: middle;
}
    </style>
   
</head>
<body>
    <?php
   
    // Obtener los intervalos
$intervalos = $data['intervalos'];
$zonas=$data['zonas'];
$resultadozonas = separarPorEspecialista($zonas);
$tipospago=$tipodepagos->Obtenertipodepagoreporte();

// Definir los encabezados de la tabla
$encabezadosVerticales = array('Cliente', 'Teléfono', 'Métodos de Pago', 'Servicio a Realizar', 'Productos', 'Zonas Encontradas', 'Comentarios');
$datosAdicionales=[];
$productosglobal=[];
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .tblheader{
         background-color:black;
         color: white;
        }
        .tblizquierda{
         background-color:gray;
         color: white;
        }
    </style>
</head>
<body>
   <table class="table  table table-striped table-bordered table-responsive  vertabla">
    <thead>
        <tr rowspan="2" style="height: 100px;">
            <th class="tblheader" style="text-align:center;">Hora de cita</th>
            <th class="tblheader" style="text-align:center;">Cliente</th>
            <th class="tblheader" style="text-align:center;">Teléfono</th>
            <?php 

            for($k=0;$k<count($tipospago);$k++){?>

              <th style="text-align:center;" class="tblheader"><?php echo $tipospago[$k]->tipo ?> </th>
               
              <?php } ?>  

            <th class="tblheader" style="text-align:center;">Servicio a Realizar</th>
            <th class="tblheader" text-align:center;>Productos</th>
            <?php 
          // print_r($resultadozonas);die();
           foreach ($resultadozonas as $idespecialista => $especialista) {
            
              foreach ($especialista as $dato) { ?>
                  <th  class="verticalText" style="text-align: center;background-color: <?php echo $dato['color'] ?>;writing-mode: tb-rl;"><?php echo $dato['nombre'] ?> </th>
            <?php  }
              
          }
                       ?>
            <th style="text-align:center;" class="tblheader">Comentarios</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $contador=count($intervalos)-1;
        foreach ($intervalos as $index => $inicio):


            $tiempoSolicitado = $inicio; 

            if ($conta<$contador) {
             // code...
            
           
            // Ejemplo de tiempo solicitado
            $servicioEncontrado = obtenerServicio($tiempoSolicitado, $zonas);
           // var_dump($servicioEncontrado);die();

            if (count($servicioEncontrado)>0) {
             // code...
           
            foreach ($servicioEncontrado as $key => $cita): 


            // echo 'idnota'.$cita[0]['idnotapago'];
             $idnotapago=$cita[0]['idnotapago'];
             $notapago->idnotapago=$idnotapago;
             $metodospago=$notapago->ObtenerMetodospago();


             $obtenerproductos=$notapago->ObtenerProductosnota();

         
             ?>
                <tr style="height: 100px;">
                    <?php if ($key === 0): // Verificar si es la primera fila de la cita para mostrar el intervalo ?>
                        <td class="tblizquierda" style="text-align:center;margin-top: 2px;            vertical-align: middle;" rowspan="<?php echo count($servicioEncontrado); ?>">
                            <?php echo $inicio . ' - ';
                            // Obtener el siguiente intervalo, si existe
                            if (isset($intervalos[$index + 1])) {
                                echo $intervalos[$index + 1];
                            } else {
                                echo '';
                            }
                            ?>
                        </td>
                    <?php endif; ?>

                    <td>
                        <div>
                             <?php

                            
                              echo $cita[0]['nombrecliente'];

                              // print_r($metodospago); 
                              ?>
                        </div>
                       
                    </td>
                    <td><?php echo $cita[0]['celular'];
                    
                   if($cita[0]['celular']=='(961) 177-5211'){

                    
                    //print_r($metodospago[0]['tipopago']);
                   } 

                
                     ?></td>
                    
                      <?php    

                      if(count($obtenerproductos)>0){ 

                       for ($i=0; $i <count($obtenerproductos) ; $i++) { 
                          

                       $encontrado= BuscarProductosEnGlobal($productosglobal,$obtenerproductos[$i]->idnotapago_descripcion);
                        $obtenerproductos[$i]->encontrado=$encontrado;
                         if ($encontrado==0) {
                          // code...
                         
                            $cita[0]['monto']=$cita[0]['monto']+$obtenerproductos[$i]->monto;

                           
                            array_push($productosglobal,$obtenerproductos[$i]);

                           }

                           }

                        } 

                   

// Suponiendo que $tipospago y $metodospago son arrays de objetos y arrays respectivamente.

for ($k = 0; $k < count($tipospago); $k++) {
    $foundMatch = false; // Variable para rastrear si se encontró una coincidencia para el tipo de pago actual

    // Abrimos una fila de la tabla
  

    for ($i = 0; $i < count($metodospago); $i++) {
        // Comparar los tipos de pago eliminando los espacios en blanco
        if (trim($metodospago[$i]['tipopago']) == trim($tipospago[$k]->tipo)) {
            echo '<td>';

            if ($metodospago[$i]['monto'] != 0) {
                // Verificar y actualizar el monto del producto
                if ($productos[$j]->monto != $metodospago[$i]['monto']) {
                    $productos[$j]->monto = $metodospago[$i]['monto'];
                }
            }

            // Acumular el monto al tipo de pago
            $tipospago[$k]->montoacumulado += $cita[0]['monto'];

            // Mostrar el monto formateado
            echo '$' . number_format($cita[0]['monto'], 2, '.', ',');

            echo '</td>';

            $foundMatch = true; // Marcar que se encontró una coincidencia
           break; // Salir del bucle interno una vez encontrada la coincidencia

        }
    }

    // Si no se encontró ninguna coincidencia, agregamos una celda vacía por cada método de pago
    if (!$foundMatch) {
        
            echo '<td></td>';
        
    }

    // Cerramos la fila de la tabla
  
}


?>


                  <td>
                    <?php
                   
                    $idespecialistacita=$cita[0]['idespecialista'];


                      echo $cita[0]['nombrepaquete']; ?></td>
                    <td>
                     
                      <?php


                       if(count($obtenerproductos)>0){ 

                       for ($i=0; $i <count($obtenerproductos) ; $i++) { 
                         $encontrado= $obtenerproductos[$i]->encontrado;

                         if ($encontrado==0) {
                          
                        echo $obtenerproductos[$i]->descripcion.'<br>';
                        }
                       }

                        } ?>
                       
                     
                    </td>
                    <?php
                      $check='';
                     foreach ($resultadozonas as $idespecialista => $especialista) {
                     $check='';
                     $estilo="";
                       foreach ($especialista as $dato) { 
                       
                         if ($idespecialistacita==$dato['idespecialista']) {
                          $check='x';
                          $estilo="style='text-align:center;background-color:".$dato['color']."'";
                         }

                        ?>
                           <td <?php echo $estilo; ?> ><?php echo $check; ?> </td>
                     <?php  }
                       
                   }
                   ?>

                    <td></td>
                </tr>
            <?php endforeach; ?>


           <?php }else{ ?>
            <tr>

            <td rowspan="1" class="tblizquierda">
                            <?php echo $inicio . ' - ';
                           
                            if (isset($intervalos[$index + 1])) {
                                echo $intervalos[$index + 1];
                            } else {
                                echo '';
                            }
                            ?>
                        </td>
                        <td></td>
                        <td></td>
                        
                         <?php 

                          for($k=0;$k<count($tipospago);$k++){
                          ?>

                            <td class=""> </td>
                             
                            <?php }

                             ?>  

                            <td></td>
                            <td></td>


                             <?php 
           
           foreach ($resultadozonas as $idespecialista => $especialista) {
            
              foreach ($especialista as $dato) { ?>
                  <td class=""> </td>
            <?php  }
              
          }?>

          <td></td>
          <tr>
                   


         <?php  } ?>


        <?php 

        $conta++;
       }
       endforeach; ?>


       <?php if (count($ObtenerProductosnotasincita)){
         for ($l=0; $l <count($ObtenerProductosnotasincita) ; $l++) { 

           $productos=$ObtenerProductosnotasincita[$l]->productos;

          $metodospago=$ObtenerProductosnotasincita[$l]->metodospago;
           

           for ($j=0; $j < count($productos); $j++) { 
            // code...
           
          ?>

           <tr>
            <td></td>
            <td><?php echo $ObtenerProductosnotasincita[$l]->nombrecliente; ?></td>
            <td><?php echo $ObtenerProductosnotasincita[$l]->celular; ?></td>

            <?php     
            

                     // Suponiendo que $tipospago y $metodospago son arrays de objetos y arrays respectivamente.

for ($k = 0; $k < count($tipospago); $k++) {
    $foundMatch = false; // Variable para rastrear si se encontró una coincidencia para el tipo de pago actual

    // Abrimos una fila de la tabla
  

    for ($i = 0; $i < count($metodospago); $i++) {
        // Comparar los tipos de pago eliminando los espacios en blanco
        if (trim($metodospago[$i]['tipopago']) == trim($tipospago[$k]->tipo)) {
            echo '<td>';

            if ($metodospago[$i]['monto'] != 0) {
                // Verificar y actualizar el monto del producto

               if ($metodospago[$i]['monto']>=$productos[$j]->monto) {
                $productos[$j]->monto=$productos[$j]->monto;
               }else{

                 if ($productos[$j]->monto != $metodospago[$i]['monto']) {
                    $productos[$j]->monto = $metodospago[$i]['monto'];
                }

               }


                
            }

            // Acumular el monto al tipo de pago
            $tipospago[$k]->montoacumulado += $productos[$j]->monto;

            // Mostrar el monto formateado
            echo '$' . number_format($productos[$j]->monto, 2, '.', ',');

            echo '</td>';

            $foundMatch = true; // Marcar que se encontró una coincidencia
           break; // Salir del bucle interno una vez encontrada la coincidencia

        }
    }

    // Si no se encontró ninguna coincidencia, agregamos una celda vacía por cada método de pago
    if (!$foundMatch) {
        
            echo '<td></td>';
        
    }

    // Cerramos la fila de la tabla
  
}

                         ?>
                         <td></td>
                     <td><?php echo $productos[$j]->descripcion; ?></td>
                     

           </tr>
          
         <?php  
          }
        
        ?>



      <?php }

      } ?>
        
      


       <tr>
        <td></td>
        <td></td>
        <td></td>
         <?php  for($k=0;$k<count($tipospago);$k++){ ?>

          <td class=""><?php 

          echo '$'.number_format($tipospago[$k]->montoacumulado,2,'.',',');
         ?> </td>
                             
         <?php } ?> 
         <td></td>
         <td></td>

                <?php 
           
           foreach ($resultadozonas as $idespecialista => $especialista) {
            
              foreach ($especialista as $dato) { ?>
                  <td class=""> </td>
            <?php  }
              
          }?>

          <td></td>

       </tr>
    </tbody>
</table>


</body>
</html>


<?php 
/*use Dompdf\Dompdf;
if ($pantalla==2){


$dompdf = new DOMPDF();
$dompdf->load_html(ob_get_clean());
$dompdf->render();
$pdf = $dompdf->output();
$filename = "Rep_manejocaja_".$idmanejocaja.".xls";
file_put_contents($filename, $pdf);
$dompdf->stream($filename);

	} */


 function obtenerServicio($tiempo, $zonas) {
    $tiempo = strtotime($tiempo);
   $arrayservicios=[];
   foreach ($zonas as $zona) {

    foreach ($zona['intervalos'] as $intervalo) {

    
    
        $horaInicial = strtotime($intervalo['horainicialntervalo']);
        $horaFinal = strtotime($intervalo['horafinalintervalo']);
        
        // Verificar si el tiempo solicitado está dentro del intervalo y el intervalo está disponible
       // echo date('H:i:s',$tiempo).'<br>';
       // echo date('H:i:s',$horaInicial).'<br>';
       // echo $intervalo['disponible'];
       // print_r($intervalo['servicio']);
        if ($horaInicial==$tiempo  && $intervalo['disponible']==0) {

         // print_r($intervalo['servicio']);
           

           //array_push($arrayservicios,$intervalo['servicio']);


         array_push($arrayservicios,$intervalo['servicio']);
           //return $intervalo['servicio']; 
           // Devolver el servicio asociado al intervalo encontrado
        }
        
    }

}

 return $arrayservicios;
   // return null; // Devolver null si no se encuentra ningún servicio disponible para el tiempo solicitado
}


function separarPorEspecialista($array) {
    $especialistas = array();
    foreach ($array as $element) {
        $idespecialista = $element['idespecialista'];
        if (!array_key_exists($idespecialista, $especialistas)) {
            $especialistas[$idespecialista] = array();
        }
        $especialistas[$idespecialista][] = $element;
    }
    return $especialistas;
}

function BuscarProductosEnGlobal($productosglobal,$idnotapago_descripcion){
$encontrado=0;
  if (count($productosglobal)>0) {
   
   for ($i=0; $i < count($productosglobal); $i++) { 
      if ($productosglobal[$i]->idnotapago_descripcion==$idnotapago_descripcion) {
        $encontrado=1;

        return $encontrado;
      }
   }

   if ($encontrado==0) {
    return $encontrado;
   }
  }else{


   return 0;
  }

}


?>
