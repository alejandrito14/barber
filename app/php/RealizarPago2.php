<?php
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');

//Inlcuimos las clases a utilizar
require_once "clases/conexcion.php";

require_once "clases/class.Funciones.php";
require_once "clases/class.Fechas.php";
/*require_once "clases/class.MovimientoBitacora.php";

*/require_once "clases/class.Usuarios.php";
require_once "clases/class.Carrito.php";
require_once "clases/class.Cita.php";
require_once "clases/class.UsoCupon.php";

//require_once("clases/class.PagosCoach.php");

//require_once("clases/class.Pagos.php");
//require_once("clases/class.Descuentos.php");
//require_once("clases/class.ServiciosAsignados.php");

require_once("clases/class.ClienteStripe.php");
require_once("clases/class.Tipodepagos.php");
require_once("clases/class.PagConfig.php");
//require_once("clases/class.Membresia.php");
require_once("clases/class.Notapago.php");
require_once("clases/class.Servicios.php");
require_once("clases/class.Cupones.php");
require_once("clases/class.Datosfiscales.php");
require_once("clases/class.WhatsapMensaje.php");
require_once("clases/class.Sucursal.php");

include 'stripe-php-7.93.0/init.php';
$folio = "";

 
//$pagosconsiderados=json_decode($_POST['pagos']);
$constripe=$_POST['constripe'];
$sumatotalapagar=$_POST['sumatotalapagar'];
$iduser=$_POST['id_user'];
if (isset($_POST['idsucursal'])) {
 $idsucursal=$_POST['idsucursal'];

}else{
  $idsucursal=1;

}
//$descuentosaplicados=json_decode($_POST['descuentosaplicados']);
//$descuentosmembresia=json_decode($_POST['descuentosmembresia']);
$rutacomprobante=$_POST['rutacomprobante'];
$comentariosimagenes=$_POST['comentariosimagenes'];
$comision=$_POST['comision'];
$comisionmonto=$_POST['comisionmonto'];
$comisiontotal=$_POST['comisiontotal'];
$impuestototal=$_POST['impuestototal'];
$impuesto=$_POST['impuesto'];
$montomonedero=$_POST['monedero']==''?0:$_POST['monedero'];
$datostarjeta=$_POST['datostarjeta'];
$datostarjeta2=$_POST['datostarjeta2'];

$subtotalsincomision=$_POST['subtotalsincomision'];
$confoto=$_POST['confoto'];
$constripe=$_POST['constripe'];
$campomonto=$_POST['campomonto'];
$montovisual=$_POST['montovisual'];
$cambiomonto=$_POST['cambiomonto'];
$requierefactura=$_POST['requierefactura'];
$idusuariosdatosfiscales=$_POST['idusuariosdatosfiscales'];
$checkConfirm=$_POST['checkConfirm'];

$comisionpornota=$_POST['comisionpornota'];
$comisionnota=$_POST['comisionnota'];
$tipocomisionpornota=$_POST['tipocomisionpornota'];
$idtipodepago=$_POST['idtipodepago'];
$codigocupon=$_POST['codigocupon'];
$montocupon = trim($_POST['montocupon']) !== '' ? $_POST['montocupon'] : 0;
$idcupon=$_POST['idcupon']!=''?$_POST['idcupon']:0;


$variable="";


try {
   $db = new MySQL();
   $obj = new ClienteStripe();
   $notapago=new Notapago();
   $notapago->db=$db;
   $whatsap=new WhatsapMensaje();
   $whatsap->db=$db;
   $fechas=new Fechas();
   $sucursal=new Sucursal();
   $sucursal->db=$db;
   $sucursal->idsucursales=$idsucursal;

   $datossucursal=$sucursal->ObtenerSucursal();
   $celularsucursal=$datossucursal[0]->celular;


     $obj->db=$db;
     $db->begin();
     $f = new Funciones();
     $cupones=new Cupones();
     $cupones->db=$db;
     $descripcioncupon="";
     $obj->idusuarios=$iduser;
        $dbresult = $obj->ObtenerDatosCliente();
        $a_result=$obj->db->fetch_assoc($dbresult);
        $nombrecliente = $a_result['nombre'] . " " . $a_result['paterno'];
        $celularcliente=$a_result['celular'];


     if ($idcupon>0) {
      
      $cupones->idcupon=$idcupon;
      $datoscupon=$cupones->ObtenerCupon();

      if ($datoscupon[0]->tipodescuento==0) {
        $descripcioncupon=$datoscupon[0]->descuento.'%';

      }
       if ($datoscupon[0]->tipodescuento==1) {
        $descripcioncupon='$'.$datoscupon[0]->descuento;
      }


     }
  /* $lo=new ServiciosAsignados();
   $lo->db=$db;*/
   $idnotapago=0;
   $paginaconfi     = new PagConfig();
     $paginaconfi->db = $db;
     $obtenerconfiguracion=$paginaconfi->ObtenerInformacionConfiguracion();
   $obj->idusuarios=$iduser;

    $contador=$notapago->ActualizarConsecutivo();
    $fecha = explode('-', date('d-m-Y'));
    $anio = substr($fecha[2], 2, 4);
    $folio = $fecha[0].$fecha[1].$anio.$contador;
     $tipopago=new Tipodepagos();
     $tipopago->db=$db;

      if ($montomonedero>0) {
  
            if ($montomonedero==$sumatotalapagar) {
               $idtipodepago=0;
               $tipopago->idtipodepago=0;
            }else{
                $tipopago->idtipodepago=0;
                $obtenertipopago=$tipopago->ObtenerTipodepago2();
             $variable=$obtenertipopago[0]->tipo;

          
            }

           
          }


            //$idtipodepago=$_POST['idtipodepago'];
            if ($tipopago->idtipodepago!=$idtipodepago) {
                $tipopago->idtipodepago=$idtipodepago;
           
              $obtenertipopago=$tipopago->ObtenerTipodepago2();
               
              //$variable=' '.$variable;

            
            }else{
              $variable=str_replace(',',' ',$variable);
            }


             $datosfiscales=new Datosfiscales();
               $datosfiscales->db=$db;


         $notapago->idusuario=$iduser;
         $notapago->subtotal=$subtotalsincomision;
         $notapago->iva=0;
         $notapago->total=$sumatotalapagar;
         $notapago->comisiontotal=$comisiontotal;
         $notapago->montomonedero=$montomonedero;
         $notapago->estatus=0;
         $notapago->tipopago=$variable.' '.$obtenertipopago[0]->tipo;
         $notapago->idtipopago=$idtipodepago;
         $notapago->confoto=$confoto;
         $notapago->datostarjeta=$datostarjeta;
         $notapago->datostarjeta2=$datostarjeta2;
         $notapago->idpagostripe=0;
         $notapago->folio=$folio;
         $notapago->descuento=0;
         $notapago->descuentomembresia=0;
         $notapago->requierefactura=$requierefactura;
         $notapago->checkConfirm=$checkConfirm;
         $notapago->idsucursal=$idsucursal;
         $notapago->comisionpornota=$comisionpornota;
         $notapago->comisionnota=$comisionnota;
         $notapago->tipocomisionpornota=$tipocomisionpornota;
         $notapago->idusuariodatofiscal=0;
         if ($requierefactura==1) {
            $datosfiscales->idusuariosdatosfiscales=$idusuariosdatosfiscales;
             $datosf=$datosfiscales->Obtenerdatofiscal();

              $notapago->razonsocial=$datosf[0]->razonsocial;
              $notapago->rfc=$datosf[0]->rfc;
              $notapago->direccion=$datosf[0]->direccion;
              $notapago->nointerior=$datosf[0]->nointerior;
              $notapago->noexterior=$datosf[0]->noexterior;
              $notapago->colonia=$datosf[0]->colonia;
              $notapago->municipio=$datosf[0]->municipio;
              $notapago->estado=$datosf[0]->estado;
              $notapago->codigopostal=$datosf[0]->codigopostal;
              $notapago->correo=$datosf[0]->correo;
              $notapago->pais=$datosf[0]->pais;
              $notapago->asentamiento=$datosf[0]->asentamiento;
              $notapago->calle=$datosf[0]->calle;
              $notapago->formapago=$datosf[0]->formapago;
              $notapago->metodopago=$datosf[0]->metodopago;
              $notapago->usocfdi=$datosf[0]->usocfdi;
              $buscarimagenes=$datosfiscales->ObtenerImagenesfiscalAgrupado();
              $imagenesfac="";
              if (count($buscarimagenes)>0){
                $imagenesfac=$buscarimagenes[0]->imagenesconstancia;
              }

              $notapago->imagenconstancia=$imagenesfac;
              $notapago->idusuariodatofiscal=$idusuariosdatosfiscales;
         }

           $notapago->codigocupon=$codigocupon;
           $notapago->montocupon=$montocupon;
           $notapago->idcupon=$idcupon;
           $notapago->descripcioncupon=$descripcioncupon;
          $notapago->CrearNotapago();
          $idnotapago=$notapago->idnotapago;

            $constripe=$obtenertipopago[0]->constripe;

            if ($obtenertipopago[0]->constripe==1) {
              # code...
            
            $skey=$obtenertipopago[0]->claveprivada;
            $pub_key=$obtenertipopago[0]->clavepublica;
            $obj->skey=$skey;

             $cantidadintentos=$obtenerconfiguracion['intentostarjeta'];
            $monto =  $sumatotalapagar*100;  
            $descripcion = "Pago servicio ".$obtenerconfiguracion['nombrenegocio1'].' '.$folio;

                $obj->idTransaccion = '';
                $obj->monto = $monto;
                $obj->digitosTarjeta ='';
                $obj->estatus = '';
                $obj->fechaTransaccion = ''; 
                $obj->comision=$comision;
        $obj->comisiontotal=$comisiontotal;
        $obj->comisionmonto=$comisionmonto;
        $obj->impuestototal=$impuestototal;
        $obj->subtotalsincomision = $subtotalsincomision;
        $obj->impuesto=$impuesto;
        $obj->total=$sumatotalapagar;
                $obj->RegistrarIntentoPago();
               

            //////SOLO TEST
            //$idpedido = rand(1,1000);  //SOLOTEST
            //$descripcion = "Pedido ". $idpedido; //SOLOTEST
            //$monto =  rand(2000,20000); // SOLOTEST
            $idclientestripe = ObtenerIdClienteStripe($obj);
             $db->commit();
            $output=array();
           

           if ($idclientestripe!='' && $skey!=''){
                 
                 \Stripe\Stripe::setApiKey($skey);

                $payment_methods = \Stripe\PaymentMethod::all([
                    'customer' => $idclientestripe,
                    'type' => 'card'
                  ]);
                     
                $db = new MySQL();
                $obj->db = $db; 
            
                $dbresult=$obj->ObtenerLastCard();
                $a_result=$db->fetch_assoc($dbresult);
                $payment_method_id = $a_result['lastcard_stripe'];
                 $obj->fechaactual=date('Y-m-d');
                 $obj->lastcard=$payment_method_id;
                 $intentos=$obj->ObtenerIntentos();
               
                 if (count($intentos)<$cantidadintentos) {
                     # code...
                 

                $paymentIntent = \Stripe\PaymentIntent::create([
                    'amount' => $monto,
                    'currency' => 'mxn',
                    'payment_method' => $payment_method_id,
                    'description' => $descripcion,
                    'customer' => $idclientestripe,
                    'confirm' => true,
                    'off_session' => true
                  ]); 

                $stripe = new \Stripe\StripeClient($skey);
                $intent =$stripe->paymentIntents->retrieve(
                  $paymentIntent->id,
                  []
                );
               // echo $intent->status;

                $obj->idTransaccion = $paymentIntent->id;
                $obj->monto = $monto;
                $obj->digitosTarjeta = $paymentIntent->payment_method;
                $obj->estatus = $intent->status;
                $obj->fechaTransaccion = $paymentIntent->created;   
                
                    
                $db = new MySQL();
                $obj->db = $db; 
                $obj->ActualizarIntento();
                $db->commit();


                if ($obj->estatus=='succeeded') {
                   
                        $output = [
                        'succeeded' => true,
                        'publicKey' => $pub_key,
                        'clientSecret' => $paymentIntent->client_secret,
                        'paymentIntent' => $paymentIntent->id,
                        'entro' => 1
                    ];
                $estatusdeproceso=1;

              
                }else{

                       $output = [
                        'error' => 1,
                        'publicKey' => $pub_key,
                        'clientSecret' => $paymentIntent->client_secret,
                        'paymentIntent' => $paymentIntent->id
                    ]; 

                    $estatusdeproceso=0;
                }
                

                 }else{

                      $output = [
                        'error' => 1,
                        'publicKey' => $pub_key,
                        'clientSecret' => $paymentIntent->client_secret,
                        'paymentIntent' => 0,
                        'intentos'=>$cantidadintentos,
                    ]; 

                    $estatusdeproceso=0;
              }
          }else{


            $output = [
                        'error' => 1,
                        'publicKey' => $pub_key,
                        'clientSecret' => $paymentIntent->client_secret,
                        'paymentIntent' => 0,
                        'intentos'=>0,
                    ]; 

                    $estatusdeproceso=0;

          }

        }else{
          $estatusdeproceso=1;
        }
         $db->commit();
   
          if ($estatusdeproceso==1) {
               $db = new MySQL();
               $db->begin();

               //$pagos=new Pagos();
               //$pagos->db=$db;
               //$descuentos=new Descuentos();
               //$descuentos->db=$db;
               //$lo=new ServiciosAsignados();
               //$lo->db=$db;
               //$membresia= new Membresia();
               //$membresia->db=$db;
               $cita=new Cita();
               $cita->db=$db;
               $notapago=new Notapago();
               $notapago->db=$db;
               $carrito=new Carrito();
               $carrito->db=$db;
               $usocupon= new UsoCupon();
               $usocupon->db = $db;

             
         $carrito->idusuarios=$iduser;
         $obtenercarrito=$carrito->ObtenerCarrito();

         $sumacarrito=0;
         $idsucursal="";
             for ($i=0; $i <count($obtenercarrito) ; $i++) { 
              $tipo=0;
              $cita->idcita=0;
              if ($obtenercarrito[$i]->idcitaapartada>0) {
                # code...
                $cita->idusuario=$obtenercarrito[$i]->idusuarios;
                $cita->idcitaapartado=$obtenercarrito[$i]->idcitaapartada;
                $obtenerapartada=$cita->ObtenerCitaCreada();

                $cita->horacita=$obtenerapartada[0]->horainicial;
                $cita->fechacita=$obtenerapartada[0]->fecha;
                $cita->estatus=0;
                
                $cita->idusuarios=$obtenerapartada[0]->idusuario;
                $cita->idespecialista=$obtenerapartada[0]->idespecialista;
                $cita->horainicial=$obtenerapartada[0]->horainicial;
                $cita->horafinal=$obtenerapartada[0]->horafinal;


                $cita->idsucursal=$obtenerapartada[0]->idsucursal;

                $idsucursal=$obtenerapartada[0]->idsucursal;
                $cita->idpaquete=$obtenerapartada[0]->idpaquete;
                $cita->costo=$obtenercarrito[$i]->costototal;
                $cita->idcortesia=$obtenerapartada[0]->idcortesia;


                $cita->CitaCreada();
                $tipo=1;

            }
                

              $notapago->descripcion=$obtenercarrito[$i]->nombrepaquete;
              $notapago->cantidad=$obtenercarrito[$i]->cantidad;
              $notapago->monto=$obtenercarrito[$i]->costototal;
              $notapago->idpaquete=$obtenercarrito[$i]->idpaquete;
              $notapago->idcita=$cita->idcita;
              $notapago->costounitario=$obtenercarrito[$i]->costounitario;
               $notapago->tipo=$tipo;
               $notapago->idnotapago=$idnotapago;
               $notapago->monederoaplicado=$obtenercarrito[$i]->montomonedero;
               $notapago->idcupon=$idcupon;
               $notapago->codigocupon=$codigocupon;
               $notapago->montocupon=$montocupon;
              $notapago->Creardescripcionpago();
               
                $carrito->idcarrito=$obtenercarrito[$i]->idcarrito;

                $obtenercarrito[$i]->idnotapagodescripcion=$notapago->idnotapagodescripcion;

                $carrito->estatus=2;
                $carrito->ActualizarEstatusCarrito();

                $sumacarrito=$sumacarrito+$obtenercarrito[$i]->costototal;
               }
        


              $notapago->fechareporte=date('Y-m-d H:i:s');
              $notapago->idpagostripe=0;
              if ($constripe==1) {
               $notapago->idpagostripe=$obj->idintento;
               
             }
               $notapago->descuento=0;
               $notapago->descuentomembresia=0;

             /* if (count($descuentosaplicados)>0) {
              
              for ($i=0; $i <count($descuentosaplicados) ; $i++) { 
                  
              $descuentos->iddescuento=$descuentosaplicados[$i]->iddescuento;
              $descuentos->montopago=$descuentosaplicados[$i]->montopago;
              $descuentos->montoadescontar=$descuentosaplicados[$i]->montoadescontar;
              $descuentos->idpago=$descuentosaplicados[$i]->idpago;
              $descuentos->tipo=$descuentosaplicados[$i]->tipo;
              $descuentos->monto=$descuentosaplicados[$i]->monto;
              $descuentos->idnotapago= $notapago->idnotapago;
               
              $descuentos->GuardarDescuentoPago();
              $notapago->descuento= $notapago->descuento+$descuentosaplicados[$i]->montoadescontar;
                }

              }*/

              /*if (count($descuentosmembresia)>0) {
                
                for ($i=0; $i <count($descuentosmembresia) ; $i++) { 
                  $membresia->idpago=$descuentosmembresia[$i]->idpago;
                  $membresia->idmembresia=$descuentosmembresia[$i]->idmembresia;

                  $membresia->idservicio=$descuentosmembresia[$i]->idservicio;
                  $membresia->descuento=$descuentosmembresia[$i]->descuento;
                  $membresia->monto=$descuentosmembresia[$i]->monto;
                  $membresia->montoadescontar=$descuentosmembresia[$i]->montoadescontar;

                   $membresia->idnotapago=$notapago->idnotapago;
                  $membresia->GuardarPagoDescuentoMembresia();
                  $notapago->descuentomembresia=$notapago->descuentomembresia+$descuentosmembresia[$i]->montoadescontar;
                }
              }*/
              $notapago->estatus=1;
             $notapago->ActualizarNotapago();




  if ($montomonedero!='' && $montomonedero!=0) {

    $usuarios=new Usuarios();
    $usuarios->db=$db;

      for ($i=0; $i <count($obtenercarrito) ; $i++) {

      $monederousado=$obtenercarrito[$i]->montomonedero;
      $idnotapagodescripcion=$obtenercarrito[$i]->idnotapagodescripcion;

              
    $usuarios->idusuarios = $iduser;
    $row_cliente = $usuarios->ObtenerUsuario();
    $saldo_anterior = $row_cliente[0]->monedero;
    
    //Calculamos nuevo saldo
    $nuevo_saldo = $saldo_anterior - $monederousado;
    $sql = "UPDATE usuarios SET monedero = '$nuevo_saldo' WHERE idusuarios = '$iduser'";
    
    $db->consulta($sql);
    //Guardamos el movimiento en tabla cliente_monedero
    $tipo=1;
    $concepto="Cargo de ".$obtenercarrito[$i]->nombrepaquete;
    $sql_movimiento = "INSERT INTO monedero (idusuarios,monto,modalidad,tipo,saldo_ant,saldo_act,concepto,idnota,idnotadescripcion) VALUES ('$iduser','$montomonedero','2','$tipo','$saldo_anterior','$nuevo_saldo','$concepto','$notapago->idnotapago','$idnotapagodescripcion');";

     $db->consulta($sql_movimiento);

     if ($montomonedero>=$sumacarrito) {
              $notapago->estatus=1;
              $notapago->ActualizarNotapago();
          }

        }

   }

    if ($idcupon != 0 && $codigocupon != '' && $estatusdeproceso==1) {

            
            $usocupon->idcupon     = $idcupon;
            $usocupon->codigocupon = $codigocupon;
            $usocupon->idsucursal  = $idsucursal;
            $usocupon->fecha       = date('Y-m-d');
            $usocupon->idcliente   = $iduser;
            $cupon                 = $usocupon->ObtenerUsocupon();

            if (count($cupon) > 0) {
                $usocupon->numerodeveces = $cupon[0]->numerodeveces + 1;
                $usocupon->ActualizaUsoCupon();
            } else {

                $usocupon->numerodeveces = 1;
                $usocupon->GuardarUsoCupon();
            }

            $cuponsucursal = $usocupon->ObtenerUsocuponSucursal();

            if (count($cuponsucursal) > 0) {
                $usocupon->numerodeveces = $cuponsucursal[0]->numerodeveces + 1;
                $usocupon->ActualizaUsoCuponSucursal();
            } else {

                $usocupon->numerodeveces = 1;
                $usocupon->GuardarUsoCuponSucursal();
            }

            $cupondia = $usocupon->ObtenerUsocuponDia();

            if (count($cupondia) > 0) {
                $usocupon->numerodeveces = $cupondia[0]->numerodeveces + 1;
                $usocupon->ActualizaUsoCuponDia();
            } else {

                $usocupon->numerodeveces = 1;
                $usocupon->GuardarUsoCuponDia();
            }

            $cuponcliente = $usocupon->ObtenerUsocuponCliente();

            if (count($cuponcliente) > 0) {
                $usocupon->numerodeveces = $cuponcliente[0]->numerodeveces + 1;
                $usocupon->ActualizaUsoCuponCliente();
            } else {

                $usocupon->numerodeveces = 1;
                $usocupon->GuardarUsoCuponCliente();
            }

        }

    /*if ($confoto == 1) {

        $nombreimagenes = explode(',', $rutacomprobante);
        $comentariosimagenes = explode(',', $comentariosimagenes);

        for ($i = 0; $i < count($nombreimagenes); $i++) {

            $imagen      = $nombreimagenes[$i];
            $comentario  = $comentariosimagenes[$i];
            $sqlimagenes = "INSERT INTO notapago_comprobante(rutacomprobante,idnotapago,comentario,estatus) VALUES('$imagen',$notapago->idnotapago,'$comentario','0') ";
          
            $db->consulta($sqlimagenes);


        }
               

         $notapago->estatus=0;
         $notapago->ActualizarNotapago();

      
        }*/
   
         if ($campomonto==1) {
              $notapago->estatus=0;
              $notapago->ActualizarNotapago();
              $notapago->cambio=abs($cambiomonto);
              $notapago->montovisual=$montovisual;
              $notapago->ActualizarMonto();
            
          }

          /*if($estatusdeproceso==1) {
       
       
          //tarjeta de lealtad
        $tarjetalealtad->idnotapago=$idnotapago;
        $tarjetalealtad->Verificarproductosnota();

       }*/

       if ($estatusdeproceso==1) {
        $whatsapp=new WhatsapMensaje();
        $whatsapp->phoneid=$obtenerconfiguracion['phoneid'];

        $celularsucursal=str_replace(array('(', ')', '-'), '', $celularsucursal);

       
        $whatsapp->tophone=$celularsucursal;

        $whatsapp->Version=$obtenerconfiguracion['faceversion'];
        $whatsapp->accestoken=$obtenerconfiguracion['tokenface'];

       
        $nombrepaquete="";

         for ($i=0; $i <count($obtenercarrito) ; $i++) { 
              $tipo=0;
              $cita->idcita=0;
             
              $texto="Producto:";
              if ($obtenercarrito[$i]->servicio==1) {
                $texto="Servicio:";
              }

               $nombrepaquete.=$texto.$obtenercarrito[$i]->nombrepaquete;

              if ($obtenercarrito[$i]->idcitaapartada>0) {
                # code...
                $cita->idusuario=$obtenercarrito[$i]->idusuarios;
                $cita->idcitaapartado=$obtenercarrito[$i]->idcitaapartada;
                $obtenerapartada=$cita->ObtenerCitaCreada();

                $cita->horacita=$obtenerapartada[0]->horainicial;
                $cita->fechacita=$obtenerapartada[0]->fecha;
                $cita->estatus=0;
                
                $cita->idusuarios=$obtenerapartada[0]->idusuario;
                $cita->idespecialista=$obtenerapartada[0]->idespecialista;
                $cita->horainicial=$obtenerapartada[0]->horainicial;
                $cita->horafinal=$obtenerapartada[0]->horafinal;


                $cita->idsucursal=$obtenerapartada[0]->idsucursal;

                $idsucursal=$obtenerapartada[0]->idsucursal;
                $cita->idpaquete=$obtenerapartada[0]->idpaquete;
                $cita->costo=$obtenercarrito[$i]->costototal;
                $cita->idcortesia=$obtenerapartada[0]->idcortesia;


                $nombrepaquete.='\nFecha:'.$fechas->fecha_texto5($obtenerapartada[0]->fecha).'\n';
                $nombrepaquete.='Hora:'.$obtenerapartada[0]->horainicial.'-'.$obtenerapartada[0]->horafinal.'Hrs.\n';
                $nombrepaquete.='Barbero:'.$obtenerapartada[0]->nombrebarbero.'\n';





              }
            }
           // var_dump($nombrepaquete);die();
        $detalle="".$nombrepaquete;
        $nombrecliente='Cliente:'.$nombrecliente;
    
        $whatsapp->MensajeNotapago($folio,$detalle,$nombrecliente);
       }
 


         

              $db->commit();

              if ($constripe==0) {
                 $output = [
                        'succeeded' => 1,
                       
                    ]; 
              }

             
          }

            

    $respuesta['respuesta']       = 1;
    $respuesta['rutacomprobante'] = $nombreimagenes;
    $respuesta['mensaje']         = "";
    $respuesta['output']=$output;
    $respuesta['idnotapago']=$notapago->idnotapago;

    //Retornamos en formato JSON
    $myJSON = json_encode($respuesta);
    echo $myJSON;
  

  }
catch (\Stripe\Exception\CardException $err) {
    $error_code = $err->getError()->code;
     $estatusdeproceso=0;
    $obj->idTransaccion =  $err->getError()->payment_intent->id;
    $obj->monto =$err->getError()->payment_intent->amount;
    $obj->digitosTarjeta = $err->getError()->payment_method->id;
    $obj->estatus = $error_code;
    $obj->fechaTransaccion = $err->getError()->payment_intent->created;   
    
    $db = new MySQL();
    $obj->db = $db; 
    $obj->idNotaRemision=$notapago->idnotapago;

     $obj->RegistrarIntentoPagoFallido2();
    $notapago->db=$db;
    $notapago->ActualizarNotaAIncompleto();

    
    $obj->idTransaccion = $paymentIntent->id;
    $obj->monto = $monto;
    $obj->digitosTarjeta = $paymentIntent->payment_method;
    $obj->estatus = $intent->status;
    $obj->fechaTransaccion = $paymentIntent->created;   
                
    $obj->ActualizarIntento();
     $db->commit();
    if($error_code == 'authentication_required') {
   

       $output = [
                       'error' => 'authentication_required', 
        'card'=> $err->getError()->payment_method->card, 
        'paymentMethod' => $err->getError()->payment_method->id, 
        'publicKey' => $pub_key, 
        'clientSecret' => $err->getError()->payment_intent->client_secret,
        'paymentIntent' => $err->getError()->payment_intent->id
                    ]; 

    $respuesta['respuesta']       = 1;
    $respuesta['mensaje']         = "";
    $respuesta['output']=$output;

    //Retornamos en formato JSON
    $myJSON = json_encode($respuesta);
    echo $myJSON;

    } else if ($error_code && $err->getError()->payment_intent != null) {
        $output = [
                       'error' => $error_code, 
        'card'=> $err->getError()->payment_method->card, 
        'paymentMethod' => $err->getError()->payment_method->id, 
        'publicKey' => $pub_key, 
        'clientSecret' => $err->getError()->payment_intent->client_secret,
        'paymentIntent' => $err->getError()->payment_intent->id
                    ]; 

    $respuesta['respuesta']       = 1;
    $respuesta['mensaje']         = "";
    $respuesta['output']=$output;

    //Retornamos en formato JSON
    $myJSON = json_encode($respuesta);
    echo $myJSON;
    } else {

              $output = [
                       'error' => 1, 
      
                    ]; 
          $array->resultado = "Error: Unknown error occurred";
          $array->output=$output;
          $array->msg = "Error al ejecutar el php";
          $array->id = '0';
          $array->respuesta=1;
              //Retornamos en formato JSON 
          $myJSON = json_encode($array);
          echo $myJSON; 
    }

     

} catch (Exception $e) {
  $db->rollback();
    //echo "Error. ".$e;
     $output = [
                'error' => 1,
                ]; 
     $array->resultado = "Error: Unknown error occurred";
     $array->msg = "Error al ejecutar el php";
     $array->id = '0';
     $array->respuesta=$e;
     $array->output=$output;
              //Retornamos en formato JSON 
     $myJSON = json_encode($array);
          echo $myJSON; 
}


function ObtenerIdClienteStripe($obj)
{
    $dbresult = $obj->ObtenerIDCustomer();
    $a_result=$obj->db->fetch_assoc($dbresult);


    $row_resultado=$obj->db->num_rows($dbresult);
    $idclientestripe='';
    if ($row_resultado>0) {
          $idclientestripe = $a_result['customerid_stripe']; 

    }
    
    if($idclientestripe == '')
    {
        $dbresult = $obj->ObtenerDatosCliente();
        $a_result=$obj->db->fetch_assoc($dbresult);
        $nombrecliente = $a_result['nombre'] . " " . $a_result['paterno'];
        $customer = \Stripe\Customer::create([
            //'payment_method' => 'pm_card_chargeCustomerFail', //SOLOTEST
            //'payment_method' => 'pm_card_authenticationRequired', //SOLOTEST
            //'payment_method' => 'pm_card_authenticationRequiredSetupForOffSession', //Sucess SOLOTEST
            'email' => $a_result['email'], //asignar email
            'name' =>  $nombrecliente //asignar nombre
        ]);

        $obj->customerid=$customer->id;
        $obj->GuardarIdCustomer();
        $idclientestripe = $customer->id;
    } 
    return $idclientestripe;
}



?>