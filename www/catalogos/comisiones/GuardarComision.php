<?php
/*======================= INICIA VALIDACIÓN DE SESIÓN =========================*/

require_once "../../clases/class.Sesion.php";
//creamos nuestra sesion.
$se = new Sesion();

if (!isset($_SESSION['se_SAS'])) {
    /*header("Location: ../../login.php"); */echo "login";

    exit;
}

/*======================= TERMINA VALIDACIÓN DE SESIÓN =========================*/

//Importamos las clases que vamos a utilizar
require_once "../../clases/conexcion.php";
require_once "../../clases/class.Comision.php";
require_once "../../clases/class.Funciones.php";
require_once '../../clases/class.MovimientoBitacora.php';
require_once '../../clases/class.Paquetes.php';

try
{
    //declaramos los objetos de clase
    $db     = new MySQL();
    $comision = new Comision();
    $f      = new Funciones();
    $paquetes=new Paquetes();
    $paquetes->db=$db;
    $md     = new MovimientoBitacora();
    $md->db     = $db;
    //enviamos la conexión a las clases que lo requieren
    $comision->db = $db;

    $db->begin();

    //Recbimos parametros
    
    $v_especialista=$_POST['v_especialista'];
    $v_tipocomision=$_POST['v_tipocomision'];
    $v_cantidadcomision=$_POST['v_cantidadcomision'];
    $v_estatus=$_POST['v_estatus'];
    $idcomision=$_POST['idcomision'];

    $comision->idcomisionespecialista=$idcomision;
    $comision->tipo=$v_tipocomision;
    $comision->monto=$v_cantidadcomision;
    $comision->idespecialista=$v_especialista;
    $comision->estatus=$v_estatus;
    $idsucursal=$se->obtenerSesion('idsucursalsesion');
    $paquetes->idsucursal=$idsucursal;



    $cat  = explode(',', $_POST['cat']);
    $sub    = explode(',', $_POST['sub']);
    $paq = explode(',', $_POST['paq']);
    //Validamos si hacermos un insert o un update
    if ($idcomision == 0) {
        //guardando
        $comision->GuardarComision();

       // var_dump($paq);die();

        $obtenerpaquetes=array();
        //if (count($paq)) {

           /* if ($paq[0]!='') {

               for ($i=0; $i < count($paq); $i++) { 

                
                $comision->idpaquete=$paq[$i];
                $comision->idcomisionespecialista=$idcomisionespecialista;
                $comision->GuardarComisionPaquete();
                }*/

            
       // }else{

           // if (count($sub)) {
                
                /*if ($sub[0]!='') {

                    $paquetes->idcategoriapaquete=$sub[0];
                   

                   if ($sub[0]!='') {
                            

                    $paquetes->idcategoriapaquete=$sub[0];
                    
                    $categoriaPrincipalID = $sub[0]; 

                    $subcategorias = $paquetes->obtenerSubcategorias($categoriaPrincipalID);
                    $comision->GuardarSubcategoria($categoriaPrincipalID);
                       
                        if (!empty($subcategorias)) {

                         for ($i=0; $i <count($subcategorias) ; $i++) { 
                      
                          $subcategorias_str=$subcategorias[$i];
                          


                            $sql_paquetes = "SELECT * FROM paquetes WHERE idcategoriapaquete IN ($subcategorias_str)";
                           
                            $result_paquetes = $db->consulta($sql_paquetes);

                            if ($result_paquetes->num_rows > 0) {
                                
                                while ($row_paquete = $result_paquetes->fetch_assoc()) {
                                   

                                   array_push($obtenerpaquetes, $row_paquete);


                                  
                                }
                            } else {
                              
                            }



                           }
                        } else {
                           
                        }
                          

                                   

                         }*/

                // }else{

                   if (count($cat)) {
                    if ($cat[0]!='') {
                            

                    $paquetes->idcategoriapaquete=$cat[0];
                    
                    $categoriaPrincipalID = $cat[0]; 

                     if ($categoriaPrincipalID>0) {
                      $comision->GuardarCategoria($categoriaPrincipalID);
                     }
                    // Aquí debes colocar el ID de la categoría principal

                        // Obtener las subcategorías recursivamente
                    if ($sub[0]!='') {

                      $categoriaPrincipalID = $sub[0];

                      if ($categoriaPrincipalID>0) {
                      $comision->GuardarSubcategorias($categoriaPrincipalID);
                     }
                    }
                    $subcategorias = $paquetes->obtenerSubcategorias($categoriaPrincipalID);

                       
                        if (!empty($subcategorias)) {

                         for ($i=0; $i <count($subcategorias) ; $i++) { 
                          # code...
                         
                          $subcategorias_str=$subcategorias[$i];

                           $comision->GuardarSubcategorias($subcategorias_str);
                            //$subcategorias_str = implode(",", $subcategorias);

                    /*$sql_paquetes = "SELECT * FROM paquetes WHERE idcategoriapaquete IN ($subcategorias_str)";
                          
                    $result_paquetes = $db->consulta($sql_paquetes);

                    if ($result_paquetes->num_rows > 0) {
                                // Mostrar los datos de cada paquete
                      while ($row_paquete = $result_paquetes->fetch_assoc()) {
                                   

                        if ($paq[0]!=''){
                                   


                            for ($i=0; $i < count($paq); $i++) { 
                                     
                              if ($paq[$i]==$row_paquete['idpaquete']) {
                                     

                              array_push($obtenerpaquetes, $row_paquete);
                                     }

                              }


                             }else{


                              array_push($obtenerpaquetes, $row_paquete);

                             }

                                 
                           }
                       } else {
                               // echo "No hay paquetes encontrados.";
                            }*/



                           }




                        } else {
                           
                        


            
       // }


                        }


                       if ($paq[0]!='') {

                        for ($i=0; $i < count($paq); $i++) { 

                         
                         $comision->idpaquete=$paq[$i];
                         
                         $comision->GuardarComisionPaquete();
                         }
                        }

                       
                          

                                  
                      }
                    }
               

                 
           // }


           


       // }
       

        $md->guardarMovimiento($f->guardar_cadena_utf8('comision'), 'comision', $f->guardar_cadena_utf8('Nuevo comision creado con el ID-' . $comision->idcomisionespecialista));
    
   /* if (count($obtenerpaquetes)>0) {
     
     for ($i=0; $i <count($obtenerpaquetes) ; $i++) { 
        
         $comision->idpaquete=$obtenerpaquetes[$i]['idpaquete'];
        
         $comision->GuardarComisionPaquete();
     }
    
    }*/

   

    } else {
        $comision->ModificarComision();

        $comision->EliminarComisionCategoria();

        $comision->EliminarComisionSubcategoria();
        $comision->EliminarComisionPaquete();

         $obtenerpaquetes=array();

        

                   if (count($cat)) {
                    if ($cat[0]!='') {
                            

                    $paquetes->idcategoriapaquete=$cat[0];
                    
                    $categoriaPrincipalID = $cat[0]; 

                     if ($categoriaPrincipalID>0) {
                      $comision->GuardarCategoria($categoriaPrincipalID);
                     }
                   
                    if ($sub[0]!='') {

                      $categoriaPrincipalID = $sub[0];

                      if ($categoriaPrincipalID>0) {
                      $comision->GuardarSubcategorias($categoriaPrincipalID);
                     }
                    }
                    $subcategorias = $paquetes->obtenerSubcategorias($categoriaPrincipalID);

                       
                        if (!empty($subcategorias)) {

                         for ($i=0; $i <count($subcategorias) ; $i++) { 
                          # code...
                         
                          $subcategorias_str=$subcategorias[$i];

                           $comision->GuardarSubcategorias($subcategorias_str);
                            //$subcategorias_str = implode(",", $subcategorias);

                    /*$sql_paquetes = "SELECT * FROM paquetes WHERE idcategoriapaquete IN ($subcategorias_str)";
                          
                    $result_paquetes = $db->consulta($sql_paquetes);

                    if ($result_paquetes->num_rows > 0) {
                                // Mostrar los datos de cada paquete
                      while ($row_paquete = $result_paquetes->fetch_assoc()) {
                                   

                        if ($paq[0]!=''){
                                   


                            for ($i=0; $i < count($paq); $i++) { 
                                     
                              if ($paq[$i]==$row_paquete['idpaquete']) {
                                     

                              array_push($obtenerpaquetes, $row_paquete);
                                     }

                              }


                             }else{


                              array_push($obtenerpaquetes, $row_paquete);

                             }

                                 
                           }
                       } else {
                               // echo "No hay paquetes encontrados.";
                            }*/



                           }




                        } else {
                           
                        


            
       // }


                        }


                       if ($paq[0]!='') {

                        for ($i=0; $i < count($paq); $i++) { 

                         
                         $comision->idpaquete=$paq[$i];
                         
                         $comision->GuardarComisionPaquete();
                         }
                        }

                       
                          

                                  
                      }
                    }

        $md->guardarMovimiento($f->guardar_cadena_utf8('comision'), 'comision', $f->guardar_cadena_utf8('Nuevo comision creado con el ID-' . $comision->idcomisionespecialista));
    }
    /*if (count($obtenerpaquetes)>0) {
     
     for ($i=0; $i <count($obtenerpaquetes) ; $i++) { 
        
         $comision->idpaquete=$obtenerpaquetes[$i]['idpaquete'];
        
         $comision->GuardarComisionPaquete();
     }
    
    }*/



       // $md->guardarMovimiento($f->guardar_cadena_utf8('comision'), 'comision', $f->guardar_cadena_utf8('Modificación de comision -' . $comision->idcomision));
    

    $db->commit();
    echo "1|" . $comision->idcomisionespecialista;

} catch (Exception $e) {
    $db->rollback();
    echo "Error. " . $e;
}