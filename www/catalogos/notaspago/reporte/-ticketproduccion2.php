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

$medidaTicket = 200;
$medidaTicket2 = 200;

$alturaContenido = 0;

// Calculamos la altura total del contenido del ticket
$alturaFilaProducto = 30; // Supongamos que cada fila tiene una altura de 30px
$cantidadProductos = count($productos);
$alturaContenido = $cantidadProductos * $alturaFilaProducto;
$alturaTicket = $alturaContenido + 100; // Añadimos un margen de 100px

// Generamos los estilos CSS del ticket dinámicamente
$estilosTicket = '.ticket { height: ' . $alturaTicket . 'px; }';

// Construimos el HTML del ticket
$htmlticket .= '<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        * {
            font-size: 12px;
            font-family: "DejaVu Sans", serif;
        }
        h1 {
            font-size: 18px;
        }
        .ticket {
            margin: 2px;
        }
        td, th, tr, table {
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
        th {
            text-align: center;
        }
        .centrado {
            text-align: center;
            align-content: center;
        }
        .ticket {
            width: ' . $medidaTicket . 'px;
            max-width: ' . $medidaTicket . 'px;
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
            margin: auto;
            padding: 0;
        }
        body {
            text-align: center;
        }
        .negritas {
            font-weight: bold;
        }
        /* Estilos específicos del ticket */
        ' . $estilosTicket . '
    </style>
</head>
<body>
    <div class="ticket centrado">
        <h3 style="font-size: 14px">' . utf8_encode($notaremision[0]->titulo). '</h3>
        <h3 style="font-size: 10px">RFC:<span class="negritas" style="font-size: 10px"> ' . $notaremision[0]->rfcsucursal . '</span></h3>
        <h3 style="font-size: 10px">'.utf8_encode('DIRECCIÓN').':<span class="negritas" style="font-size: 10px"> ' . utf8_encode($notaremision[0]->direccion ). '</span></h3>
        <h3 style="font-size: 10px">FOLIO:<span class="negritas" style="font-size: 16px"> ' . $notaremision[0]->folio . '</span></h3>
        <h3 style="font-size: 10px"><span class="negritas" style="font-size: 10px"> ' . date('d/m/Y', strtotime($notaremision[0]->fecha)) . ' ' . date('H:i', strtotime($notaremision[0]->fecha)) . '</span></h3>
        <h3></h3>
        <h3>**Ticket de compra**</h3>
        <table>
            <thead>
                <tr class="">
                    <th class="cantidad">CANT</th>
                    <th class="producto">PRODUCTO</th>
                    <th class="precio">PRECIO</th>
                </tr>
            </thead>
            <tbody>';
            
// Iteramos sobre los productos para agregarlos al HTML del ticket
foreach ($productos as $producto) {
    $total += $producto->monto;
    $nombreproducto = $producto->concepto;
    $costo = $producto->monto;

    $htmlticket .= '<tr style="text-align: center;">
                        <td style="border-bottom: 0;">' . $producto->cantidad . '</td>
                        <td>' . $f->imprimir_cadena_utf8($nombreproducto). '</td>
                        <td>$' . $costo . '</td>
                    </tr>';
}

$htmlticket .= '</tbody>
                <tr>
                    <td class=""></td>
                    <td class=""></td>
                    <td class=""></td>
                </tr>
                <tr>
                    <td class="" style="border:0;">Subtotal</td>
                    <td class="" style="border:0;"></td>
                    <td class="" style="border:0;text-align:right;">$' . $notaremision[0]->subtotal . '</td>
                </tr>
                <tr>
                    <td class="" style="border:0;">Mone.</td>
                    <td class="" style="border:0;"></td>
                    <td class="" style="border:0;text-align: right;">$' . $notaremision[0]->montomonedero . '</td>
                </tr>
                <tr>
                    <td class="" style="border:0;">Total</td>
                    <td class="" style="border:0;"></td>
                    <td class="" style="border:0;text-align: right;">$' . $notaremision[0]->total . '</td>
                </tr>
            </table>
            
            <div>
                Forma de pago: ';

if ($notaremision[0]->multipletipopago != '' && $notaremision[0]->multipletipopago != null) {
    $htmlticket .= $notaremision[0]->multipletipopago;
} else {
    $htmlticket .= $f->imprimir_cadena_utf8($notaremision[0]->tipopago);
}

$htmlticket .= '</div>
        </div>
    </body>
</html>';

// Generamos el PDF
use Dompdf\Dompdf;
$dompdf = new DOMPDF();
 ob_get_clean();

$dompdf->load_html(utf8_decode($htmlticket));

$dompdf->setPaper('b8', 'portrait');
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
