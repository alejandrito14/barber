<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.Paquetes.php");
require_once("clases/class.Funciones.php");
require_once("clases/class.CategoriaPaquete.php");

/*require_once("clases/class.Sms.php");
require_once("clases/class.phpmailer.php");
require_once("clases/emails/class.Emails.php");*/
require_once "clases/class.PagConfig.php";
try
{
    
    //Declaramos objetos de clases
    $db = new MySQL();
    $lo = new Paquetes();
    $f=new Funciones();
    $categoriapaq=new CategoriaPaquete();
    $categoriapaq->db=$db;
    //Enviamos la conexion a la clase
    $lo->db = $db;

    $pagina=new PagConfig();
    $pagina->db=$db;
    $obtenerconfi=$pagina->ObtenerInformacionConfiguracion();
    $limitepaginado=$obtenerconfi['cantidadelementospaginado'];



    //$idcategoria=$_POST['idcategoria'];
    $idsucursal=$_POST['idsucursal'];
    $idcategoria=$_POST['idcategoria'];
    $iduser=$_POST['iduser'];
    $lo->idsucursal=$idsucursal;
    $lo->idusuario=$iduser;
    $lo->idcategoriapaquete=$idcategoria;

    $totalelementos=$lo->PaquetesCategoriaSu();


    

     $cantidad=$limitepaginado;
    if (isset($_POST['inicio'])) {
       $inicio=$_POST['inicio'];

    }

    $categoriapaq->iddepende=$idcategoria;
    $categoria= $categoriapaq->ObtenerCategoriapadre();
    $categoriapaq->idcategoriapaquete=$idcategoria;
    $obtenercategoria=$categoriapaq->ObtenerCategoria();

    $categoriapadre=0;
    if (count($categoriapaq)>0) {
        $categoriapadre=$idcategoria;
    }


    $obtenerpaquetes=$lo->PaquetesCategoriaSuLimite($inicio,$cantidad);


    if (count($obtenerpaquetes)>0) {
        # code...
    
    for ($i=0; $i <count($obtenerpaquetes) ; $i++) { 
        $lo->idpaquete=$obtenerpaquetes[$i]->idpaquete;
        $obtenerfavorita=$lo->ObtenerPaqueteFavorito();
        $favorita=0;
        if (count($obtenerfavorita)>0) {
            $favorita=1;
        }

        $obtenerpaquetes[$i]->favorita=$favorita;
    }
    
}
    
    $inicio=$_POST['inicio']+$cantidad;


    $respuesta['categoria']=$obtenercategoria[0];
    $respuesta['respuesta']=$obtenerpaquetes;
    $respuesta['idcategoriapadre']=$categoriapadre;

    $respuesta['inicio']=$inicio;
    $respuesta['totalelementos']=count($totalelementos);

    //Retornamos en formato JSON 
    $myJSON = json_encode($respuesta);
    echo $myJSON;

}catch(Exception $e){
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