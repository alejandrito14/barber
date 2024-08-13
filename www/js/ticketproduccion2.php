<?php 

require_once("../../../clases/class.Sesion.php");
//creamos nuestra sesion.
$se = new Sesion();

if(!isset($_SESSION['se_SAS']))
{
    /*header("Location: ../../login.php"); */ echo "login";

    exit;
} 
 
$code=$_SESSION['codservicio'];
$nombre_fichero='notasproduccion'.'/'.$code;

if (!file_exists($nombre_fichero)) {
                                
     mkdir($nombre_fichero,0777, true);
                           
    } 

error_reporting(0);

require_once("../../../clases/conexcion.php");
require_once ("../../../clases/dompdf/autoload.inc.php");
require_once("../../../clases/class.Funciones.php");
require_once("../../../clases/class.Notapago.php");
require_once("../../../clases/class.Fechas.php");

ob_start(); 
$db = new MySQL();

$f = new Funciones();
$as = new Notapago();
$fe = new Fechas();
$as->db = $db;

$idpedido = $_POST['idnota'];
$fechaactual = date("Y-m-d");
$matrixPointSize = 3;

$query = "SELECT *, count(idpagina_configuracion) as cuantos FROM pagina_configuracion";
$resp = $db->consulta($query);
$rowsconfiguracion = $db->fetch_assoc($resp);
    
$as->idnotapago = $idpedido;
$notaremision = $as->Obtenernota2();
$productos = $as->ObtenerdescripcionNota();

// Inicializamos la variable para almacenar el HTML del ticket
$htmlticket = "";

$medidaTicket = 180;
$medidaTicket2 = 200;

$alturaContenido = 0;

// Calculamos la altura total del contenido del ticket
$alturaFilaProducto = 30; // Supongamos que cada fila tiene una altura de 30px
$cantidadProductos = count($productos);
$alturaContenido = $cantidadProductos * $alturaFilaProducto;
$alturaTicket = $alturaContenido + 120; // Añadimos un margen de 100px

// Generamos los estilos CSS del ticket dinámicamente
$estilosTicket = '';?>

<meta http-equiv="Content-Security-Policy" content="default-src *;
img-src * 'self' data: https:; script-src 'self' 'unsafe-inline' 'unsafe-eval' *;
style-src  'self' 'unsafe-inline' *">

<?php
$medidaTicket = 180;


$medidaTicket2 = 200;

?>
<?php
$medidaTicket = 180;


$alturaContenido = 0;

// Calcular la altura de cada fila de producto (supongamos que cada fila tiene una altura de 30px)
$alturaFilaProducto = 30;

// Calcular la cantidad de productos
$cantidadProductos = count($productos);

// Calcular la altura total del contenido sumando la altura de cada fila de producto
$alturaContenido = $cantidadProductos * $alturaFilaProducto;

// Ajustar el alto del contenedor del ticket
$alturaTicket = $alturaContenido + 100; // Agrega un margen adicional de 100px
$estilosTicket = '.ticket { height: ' . $alturaTicket . 'px; }';


?>
<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<head>

    <style>
        * {
            font-size: 12px;
            font-family: 'DejaVu Sans', serif;
        }

        h1 {
            font-size: 18px;
        }

        .ticket {
            margin: 2px;
        }

        td,
        th,
        tr,
        table {
            border-top: 1px solid black;
            border-collapse: collapse;
            margin: 0 auto;
        }

        td.precio {
            text-align: right;
            font-size: 10px;
        }

        td.cantidad {
            font-size: 10px;
            text-align: center;

        }

        td.producto {
            text-align: center;
            font-size: 10px;

        }

         td.precio {
            text-align: center;
            font-size: 10px;

        }

        th {
            text-align: center;
        }


        .centrado {
            text-align: center;
            align-content: center;
        }

        .ticket {
            width: <?php echo $medidaTicket ?>px;
            max-width: <?php echo $medidaTicket ?>px;
        }

        img {
            max-width: inherit;
            width: inherit;
        }

        * {
            margin: 0;
            padding: 0;
        }

        .ticket {
            margin: 0;
            padding: 0;
        }

        body {
            text-align: center;
        }

        .negritas{
            font-weight: bold;
        }

           /* Estilos específicos del ticket */
       <?php echo $estilosTicket; ?>;
    </style>
</head>

<body>
    <div class="ticket centrado">
        <h3 style="font-size: 14px"><?php echo $notaremision[0]->titulo;?></h3>
         <h3 style="font-size: 10px">RFC:<span class="negritas" style="font-size: 10px"> <?php echo $notaremision[0]->rfcsucursal; ?></span></h3>
         <h3 style="font-size: 10px">DIRECCIÓN:<span class="negritas" style="font-size: 10px"> <?php echo $notaremision[0]->direccion; ?></span></h3>

        <h3 style="font-size: 10px">FOLIO:<span class="negritas" style="font-size: 16px"> <?php echo $notaremision[0]->folio; ?></span></h3>

         <h3 style="font-size: 10px"><span class="negritas" style="font-size: 10px"> <?php echo date('d/m/Y',strtotime($notaremision[0]->fecha)).' '.date('H:i',strtotime($notaremision[0]->fecha)); ?></span></h3>

        <h3></h3>
                <h3>**Ticket de compra**</h3>

        <?php
      
        ?> 


        <table>
            <thead>
                <tr class="">
                    <th class="cantidad">CANT</th>
                    <th class="producto">PRODUCTO</th>
                    <th class="precio">PRECIO</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                
                foreach ($productos as $producto) {
                    $total += $producto->monto;
                    $nombreproducto=$producto->concepto;
                    $costo=$producto->monto;
                    ?>


                      <tr style="text-align: center;">
                                <td style="border-bottom: 0;"><?php echo $producto->cantidad; ?></td>
                                <td><?php echo $nombreproducto; ?></td>
                                <td>$<?php echo  $costo; ?></td>
                            </tr>


                  <?php  }

                ?>

                <?php 

                   

                 ?>






               
                
            </tbody>

              <tr>
                <td class=""></td>
                <td class="">
                
               </td>
                <td class="">
                 
              </td>
            </tr>


            <tr>
                <td class="" style="border:0;">Subtotal</td>
                <td class="" style="border:0;">
                 
               </td>
                <td class="" style="border:0;text-align:right;">$<?php echo $notaremision[0]->subtotal; ?>
              </td>
            </tr>
          

              <tr>
                <td class="" style="border:0;">Mone.</td>
                <td class="" style="border:0;">
                 
               </td>
                <td class="" style="border:0;text-align: right;">$<?php echo $notaremision[0]->montomonedero;?>
              </td>
            </tr>

              


              <tr>
                <td class="" style="border:0;">Total</td>
                <td class="" style="border:0;">
               </td>
                <td class="" style="border:0;text-align: right;">$<?php echo $notaremision[0]->total;?>
              </td>
            </tr>



             

            
        </table>
        <br>

        <div>
        Forma de pago: 


        <?php  if($notaremision[0]->multipletipopago!='' && $notaremision[0]->multipletipopago!=null){

         echo $notaremision[0]->multipletipopago;
       
         }else{

          echo $notaremision[0]->tipopago;


        }



        ?>
        </div>
       

         
           
               <?php 


                   
                 ?> 

              
                    
                

          




                



           





<!--         <p class="centrado">¡GRACIAS POR SU COMPRA!
 -->     
                       
     
    </div>
</body>

</html>
<?php

// Generamos el PDF
use Dompdf\Dompdf;
$dompdf = new DOMPDF();


$dompdf->load_html(ob_get_clean());

$dompdf->setPaper('b7', 'portrait');
$dompdf->render();

// Guardamos el PDF en un archivo
$folio = $idpedido . '_' . $notaremision[0]->folio;
$filename = "nota_" . $folio . ".pdf";
$pdf = $dompdf->output();
file_put_contents('notasproduccion/'.$code.'/'. $filename, $pdf);

// Mostramos el PDF en el navegador
//header("Content-type: application/pdf");
//header("Content-Disposition: inline; filename=" . $filename . "");
//echo $dompdf->output();

$respuesta['nota'] = 'notasproduccion/'.$code.'/'.$filename;

 echo json_encode($respuesta);
// $dompdf->stream($filename);