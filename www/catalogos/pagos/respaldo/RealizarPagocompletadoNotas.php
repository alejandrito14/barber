<?php
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');
require_once("../../clases/class.Sesion.php");
//creamos nuestra sesion.
$se = new Sesion();
if(!isset($_SESSION['se_SAS']))
{
  /*header("Location: ../../login.php"); */ echo "login";

  exit;
}

//Inlcuimos las clases a utilizar
require_once "../../clases/conexcion.php";

require_once "../../clases/class.Funciones.php";
/*require_once "clases/class.MovimientoBitacora.php";
*/require_once "../../clases/class.Usuarios.php";
require_once "../../clases/class.Carrito.php";
require_once "../../clases/class.Cita.php";
require_once "../../clases/class.UsoCupon.php";


require_once("../../clases/class.ClienteStripe.php");
require_once("../../clases/class.Tipodepagos.php");
require_once("../../clases/class.PagConfig.php");

require_once("../../clases/class.Notapago.php");
require_once("../../clases/class.Servicios.php");
require_once("../../clases/class.Cupones.php");
require_once("../../clases/class.Datosfiscales.php");
require_once("../../clases/class.Caja.php");
require_once("../../clases/class.Notapagometodopago.php");
require_once("../../clases/class.Tarjetalealtad.php");

include 'stripe-php-7.93.0/init.php';
$folio = "";


$constripe=$_POST['constripe'];

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
$checkConfirm=1;
$idnotapago=explode(',', $_POST['idnotapago']);
$comisionpornota=$_POST['comisionpornota'];
$comisionnota=$_POST['comisionnota'];
$tipocomisionpornota=$_POST['tipocomisionpornota'];
$idtipodepago=$_POST['idtipodepago'];
$codigocupon=$_POST['codigocupon'];
$montocupon = 0;
$idcupon=0;
$tpv=1;
$idusuarioentrega=$se->obtenerSesion('se_sas_Usuario');
$observaciones=$_POST['observaciones'];

$idbancoseleccionado=isset($_POST['idbancoseleccionado'])?$_POST['idbancoseleccionado']:0;
$idopciontarjetaseleccionado=isset($_POST['idopciontarjetaseleccionado'])?$_POST['idopciontarjetaseleccionado']:'';

$digitostarjeta=$_POST['digitostarjeta'];


$tipodepagosmultiple=json_decode($_POST['tipopagos']);

//var_dump($tipodepagosmultiple);die();
$variable="";


try {
     $db = new MySQL();
     $obj = new ClienteStripe();
     $notapago=new Notapago();
     $notapago->db=$db;
     $obj->db=$db;
     $db->begin();
     $f = new Funciones();
     $cupones=new Cupones();
     $cupones->db=$db;
     $descripcioncupon="";
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
  
   /*$paginaconfi     = new PagConfig();
     $paginaconfi->db = $db;
     $obtenerconfiguracion=$paginaconfi->ObtenerInformacionConfiguracion();*/
   $obj->idusuarios=$iduser;

    /*$contador=$notapago->ActualizarConsecutivo();
    $fecha = explode('-', date('d-m-Y'));
    $anio = substr($fecha[2], 2, 4);*/
   // $folio = $fecha[0].$fecha[1].$anio.$contador;
     $tipopago=new Tipodepagos();
     $tipopago->db=$db;
         $sinrevisionpago=0;

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
            $sinrevisionpago= $obtenertipopago[0]->habilitarsinrevision;

              if ($variable!='') {
                $variable=','.$variable;
              }
             

            
            }else{
              $variable=str_replace(',','',$variable);
            }


          $datosfiscales=new Datosfiscales();
          $datosfiscales->db=$db;

          for ($i=0; $i < count($idnotapago); $i++) { 
            # code...
          
          $notapago->idnotapago=$idnotapago[$i];
          $obtenernotapago= $notapago->ObtenerNotaPago();

         $folio=$obtenernotapago[0]->folio;
         $notapago->tpv= $obtenernotapago[0]->tpv;
         $notapago->idusuario= $obtenernotapago[0]->idusuario;
         $notapago->subtotal= $obtenernotapago[0]->subtotal;

         $sumatotalapagar=$sumatotalapagar+$notapago->subtotal;
         $notapago->iva=0;
         $notapago->total= $obtenernotapago[0]->total;
         $notapago->comisiontotal=$comisiontotal;
         $notapago->montomonedero= $obtenernotapago[0]->montomonedero;
         $notapago->estatus= $obtenernotapago[0]->estatus;
         $notapago->tipopago=$obtenertipopago[0]->tipo;
         $notapago->idtipopago=$idtipodepago;

         $notapago->tipopagoante= $obtenernotapago[0]->tipopago;
         $notapago->idtipopagoante= $obtenernotapago[0]->idtipopago;

         $notapago->confoto= $obtenernotapago[0]->confoto;
         $notapago->datostarjeta=$datostarjeta;
         $notapago->datostarjeta2=$datostarjeta2;
         $notapago->idpagostripe=0;
         $notapago->folio=$folio;
         $notapago->descuento=0;
         $notapago->descuentomembresia=0;
         $notapago->requierefactura=$requierefactura;
         $notapago->checkConfirm=$checkConfirm;

         $notapago->comisionpornota=$comisionpornota;
         $notapago->comisionnota=$comisionnota;
         $notapago->tipocomisionpornota=$tipocomisionpornota;
         $notapago->idusuariodatofiscal=0;

         $sumatotalapagar= $obtenernotapago[0]->subtotal;
        $iduser= $obtenernotapago[0]->idusuario;
       

           $notapago->codigocupon=0;
           $notapago->montocupon=0;
           $notapago->idcupon=0;
           $notapago->descripcioncupon=$descripcioncupon;
        
          // $idnotapago=$notapago->idnotapago;
           $notapago->fechacompletado=date('Y-m-d H:i:s');
           $notapago->ActualizarNotapagoCompleto();
 

         }

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
               //$db = new MySQL();
               //$db->begin();

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
               $notapagometodo=new Notapagometodopago();
                $notapagometodo->db=$db;

                 $tarjetalealtad=new Tarjetalealtad();
               $tarjetalealtad->db=$db;
              $folionota=[];
        for ($j=0; $j < count($idnotapago); $j++) { 
       
              $notapago->estatus=1;
              $notapago->idnotapago=$idnotapago[$j];

            
              $obtenerfolionota=$notapago->ObtenerNotaPago();
            array_push($folionota,$obtenerfolionota[0]->folio);
             $notapago->ActualizarEstatus();



 
         if ($campomonto==1) {
             /* $notapago->estatus=0;
              $notapago->ActualizarNotapago();*/
              $notapago->cambio=0;
              $notapago->montovisual=0;
              $notapago->ActualizarMonto();
            
          }

    $notapago->idnotapago=$idnotapago[$j];
    $detallenota=$notapago->ObtenerdescripcionNota();

    $notapago->entregado=1;
    $notapago->fechaentrega=date('Y-m-d H:i:s');
    $notapago->idusuarioentrega=$idusuarioentrega;
    $notapago->observacionesentrega=$observaciones;
    
    $notapago->idbancoseleccionado=$idbancoseleccionado;
    $notapago->idopciontarjetaseleccionado=$idopciontarjetaseleccionado;
    $notapago->digitostarjeta=$digitostarjeta;

    $notapago->ActualizarNotaEntrega();

            if (count($detallenota)>0) {
              for ($i=0; $i <count($detallenota) ; $i++) { 
                  $notapago->idnotapagodescripcion=$detallenota[$i]->idnotapago_descripcion;
                  $notapago->ActualizarNotadescripcionEntrega();

              }
            }


           
       
       
          //tarjeta de lealtad
        $tarjetalealtad->idnotapago=$idnotapago[$j];
        $tarjetalealtad->Verificarproductosnota();

       
              

          }

          

            if ($tipodepagosmultiple[0]!='') {
               


                for ($i=0; $i < count($tipodepagosmultiple); $i++) { 
                   
                $notapagometodo->idtipopago=$tipodepagosmultiple[$i]->idtipopago;
                $notapagometodo->tipopago=trim($tipodepagosmultiple[$i]->tipopago);
               $notapagometodo->montovisual= $tipodepagosmultiple[$i]->montovisual;
               $notapagometodo->confoto= $tipodepagosmultiple[$i]->confoto;
               $notapagometodo->idbanco= $tipodepagosmultiple[$i]->idbanco;
               $notapagometodo->digitostarjeta= $tipodepagosmultiple[$i]->digitostarjeta;
               $notapagometodo->tipotarjeta= $tipodepagosmultiple[$i]->tipotarjeta;
               $notapagometodo->datostarjeta= $tipodepagosmultiple[$i]->datostarjeta;
               $notapagometodo->montocampo= $tipodepagosmultiple[$i]->montocampo;
                
              
               $notapagometodo->GuardarMetodopagoNota();


                    for ($j=0; $j < count($idnotapago); $j++) { 

                             $notapagometodo->idnotapago=$idnotapago[$j];

                            $notapagometodo->GuardarRelacionNotaMetodo();

                         }

                 }

                
            }


        }

         


         

              $db->commit();

              if ($constripe==0) {
                 $output = [
                        'succeeded' => 1,
                       
                    ]; 
              }

             
          


          if($estatusdeproceso==0){

             for ($j=0; $j < count($idnotapago); $j++) { 
       
              $notapago->idnotapago=$idnotapago[$j];
            $notapago->ActualizarNotaAIncompleto();
            $db->commit();

            }
          }

            

    $respuesta['respuesta']       = 1;
    $respuesta['rutacomprobante'] = $nombreimagenes;
    $respuesta['mensaje']         = "";
    $respuesta['output']=$output;
    $respuesta['idnotapago']=$idnotapago;
    $respuesta['folionota']=$folionota;

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
    $obj->RegistrarIntentoPagoFallido();
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