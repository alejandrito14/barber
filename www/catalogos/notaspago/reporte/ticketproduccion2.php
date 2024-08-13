<?php
require_once("../../../clases/class.Sesion.php");
//creamos nuestra sesión.
$se = new Sesion();

if (!isset($_SESSION['se_SAS'])) {
    /*header("Location: ../../login.php"); */
    echo "login";
    exit;
}


$code = $_SESSION['codservicio'];
$nombre_fichero = 'notasproduccion' . '/' . $code;

if (!file_exists($nombre_fichero)) {
    mkdir($nombre_fichero, 0777, true);
}

error_reporting(0);

require_once("../../../clases/conexcion.php");
require_once("../../../clases/class.Funciones.php");
require_once("../../../clases/class.Notapago.php");
require_once("../../../clases/class.Fechas.php");
require_once ("../../../clases/dompdf/autoload.inc.php");
ob_start();
$db = new MySQL();

$f = new Funciones();
$as = new Notapago();
$fe = new Fechas();
$as->db = $db;

$idpedido = isset($_POST['idnota']) ? $_POST['idnota'] : '';
if (empty($idpedido)) {
    // Manejar el caso en que idnota esté vacío
    exit("ID de nota no especificado.");
}

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
$alturaContenido = 0;

// Calculamos la altura total del contenido del ticket
$alturaFilaProducto = 30; // Supongamos que cada fila tiene una altura de 30px
$cantidadProductos = count($productos);
$alturaContenido = $cantidadProductos * $alturaFilaProducto;
$alturaTicket = $alturaContenido + 120; // Añadimos un margen de 100px

// Generamos los estilos CSS del ticket dinámicamente
$estilosTicket = '';?>

<?php
$medidaTicket = 180;
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

<head>

    <style>

        @page { margin: 0px 10px; }
                .center{
                    text-align:center;
                }
                .justify{
                    text-align:justify;
                }
                .right{
                    text-align:right;
                }
                .left{
                    text-align:left;
                }
                .i{
                    font-style: italic;
                }

       

        h1 {
            font-size: 18px;
        }

        .ticket {
            margin: 2px;
        }

        .ticket-item {
            margin-bottom: 5px;
            margin-right: 4px;
        }

        .ticket-item span {
            font-weight: bold;
        }

        .ticket-header,
        .ticket-items,
        .ticket-total,
        .ticket-forma-pago {
            margin-bottom: 10px;
        }

        .ticket-total,
        .ticket-forma-pago {
            text-align: right;
        }
        .centrado{
            align-items: center;
            text-align: center;
        }
    </style>
</head>

<body>
                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ticket de compra</span>

                <div style="width:100%"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>

                 <table width="100%" style="margin-top:10px; margin-bottom:10px;">
                
                 <tbody>
                 <tr class="centrado">
                     <td class="center fs14 colorGris">
               
                     <span style="font-size: 14px"><?php echo $notaremision[0]->titulo;?></span>
                    </td>
                </tr>
             <tr class="centrado">
                         <td class="center fs14 colorGris">
                     <span style="font-size: 10px">RFC:<span class="negritas" style="font-size: 10px"> <?php echo $notaremision[0]->rfcsucursal; ?></span></span>
                 </td>
             </tr>
        
 <tr class="centrado">
      <td class="center fs14 colorGris">
         <span style="font-size: 10px"><?php echo $f->imprimir_cadena_utf8('DIRECCIÓN') ?>:<span class="negritas" style="font-size: 10px"> <?php echo $notaremision[0]->direccion; ?></span></span>
     </td>
 </tr>

 <tr class="centrado">

              <td class=" ">
                 <div style="width:100%">  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>
                <span style="font-size: 10px">CLIENTE:<span class="negritas" style="font-size: 16px"> <?php echo $notaremision[0]->nombrecliente; ?></span></span>
        </td>     
        </tr>

          <tr class="centrado">

              <td class="center fs14 colorGris">
               
                <span style="font-size: 10px">FOLIO:<span class="negritas" style="font-size: 16px"> <?php echo $notaremision[0]->folio; ?></span></span>
        </td>     
        </tr>
 <tr class="centrado">  
<td class="center fs14 colorGris">
         <span style="font-size: 10px"><span class="negritas" style="font-size: 10px">FECHA: <?php


            if ($notaremision[0]->fechaentrega!=null) {
                $fechanota=$notaremision[0]->fechaentrega;
            }else{

                $fechanota=$notaremision[0]->fecha;
 
            }

          echo date('d/m/Y',strtotime($fechanota)).' '.date('H:i',strtotime($fechanota)); ?></span>

     </span>

     <div style="width:100%"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>
     </td>
 </tr>
  <tr class="centrado">
<td class="center fs14 colorGris">

   
                  <div style="width:100%">-------------------------------</div>

            </td>

             
        </tr>
    </tbody>
</table>
       
        
            <table width="100%" style="margin-top:10px; margin-bottom:10px;" cellspacing="0">
                 <thead style="border-top:1px solid;">
                     <tr >
                        <th class="cantidad" >CANT &nbsp;</th>
                        <th class="producto" >PRODUCTO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        <th class="precio" >PRECIO</th>
                    </tr>
                   </thead>
                <tbody>
            <?php if (!empty($productos)) : ?>
                <?php
                $idcanje='';
                $total = 0;
                $monederoaplicado=0;
                foreach ($productos as $producto) :
                    $total += $producto->monto;
                    $nombreproducto = isset($producto->concepto) ? $producto->concepto : '';
                    $costo = isset($producto->monto) ? $producto->monto : 0;
                    if ($producto->idcanje!='' && $producto->idcanje!=null) {
                        $idcanje=$producto->idcanje;
                    }
                   
                    if ($producto->monederoaplicado!='' && $producto->monederoaplicado!=null) {

                        $monederoaplicado=$monederoaplicado+$producto->monederoaplicado;
                    }
                   
                ?>
                   

                     <tr>
                       
                     <td class="cantidad">
                    
                        <span></span> <?php echo isset($producto->cantidad) ? $producto->cantidad : ''; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   
                </td>

                 <td class="cantidad">
                        
                        <span></span> <?php echo substr($nombreproducto,0,16); ?>&nbsp;&nbsp;
                           
                        </td>

                <td class="cantidad">
                    
                        <span></span> $<?php echo $costo;


                         ?>
                   
                </td>
                 </tr>
                <?php endforeach; ?>
            </tbody>
            <?php endif; ?>


        </table>

        <div style="width:100%">-------------------------------</div>


         <table width="100%" style="margin-top:10px; margin-bottom:20px;" cellspacing="0">
                 

             <tbody>
                 
                 <tr>
                     <td>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total: $<?php echo number_format($total,'2','.',','); ?><br>

                          <div style="width:100%"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>
                          Form. pago:

                           <?php 
                           if ($notaremision[0]->multipletipopago != '' && $notaremision[0]->multipletipopago != null) {
                               $formapago=$notaremision[0]->multipletipopago;
                           }else{


                            $formapago=$notaremision[0]->tipopago;

                           

                               //echo 'canje'.$idcanje;

                               //echo 'mone'.$monederoaplicado;

                            if ($notaremision[0]->idtipopago==0) {
                                // code...
                            
                               $mone=(float)$monederoaplicado;
                                 if ($mone>0) {
                                    $formapago='Monedero'.$formapago;
                                }else{

                                    if ($mone==0) {
                                        $formapago='';
                                    }

                                     if ($idcanje!=0 && $idcanje!=null) {
                                    $formapago=$formapago.'Otro';
                                 }

                                }
                            }
                               
                            

                           }

                          // echo ($notaremision[0]->multipletipopago != '' && $notaremision[0]->multipletipopago != null) ? $notaremision[0]->multipletipopago : $notaremision[0]->tipopago.'<br>'; 

                           echo $formapago.'<br>';
                            ?><br>
                           <?php echo '<br>';?>

                           <div style="width:100%"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>

                            <span>
                                Si requieres factura, favor de solicitarlo al número de whatsapp <?php echo $notaremision[0]->celular; ?></span>
                           <div style="width:100%"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>
                                           <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;¡Gracias por tu compra!</span>
                                           <div style="width:100%"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>
                                           <div style="width:100%"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>

                     </td>

                 </tr>
                 <!-- <tr>
                     <td>
                Form. pag:
                 ********
                <br>
                     </td>
                 </tr> -->
                 <tr>
                     <td>
                         
                     </td>
                 </tr>
             </tbody>
         </table>

        <!--  <div style="width:100%">--------------------------------</div> -->

     <div style="width:100%"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>

         <table width="100%"  style="margin-top:5px;">
            <tbody>
                <tr>
                    <td class="center "><br></td>
                </tr>
            </tbody>
            </table>

            <div style="margin-top:10px;margin-bottom: 10px;"></div>

      
      
  <div style="page-break-after:always;"></div>
</body>

</html>
<?php

// Generamos el PDF
use Dompdf\Dompdf;
$dompdf = new DOMPDF();
$width=78;
$height=250;
$dompdf->load_html(ob_get_clean());
$paperformat=array( 0, 0, ($width/25.4) * 72, ($height/25.4) * 72 ); //TICKET


$dompdf->setPaper($paperformat, 'portrait');
$dompdf->render();

// Guardamos el PDF en un archivo
$folio = $idpedido . '_' . $notaremision[0]->folio;
$filename = "nota_" . $folio . ".pdf";
$pdf = $dompdf->output();
file_put_contents('notasproduccion/' . $code . '/' . $filename, $pdf);

// Mostramos el PDF en el navegador
//header("Content-type: application/pdf");
//header("Content-Disposition: inline; filename=" . $filename . "");
//echo $dompdf->output();

$respuesta['nota'] = 'notasproduccion/' . $code . '/' . $filename;

echo json_encode($respuesta);
// $dompdf->stream($filename);
