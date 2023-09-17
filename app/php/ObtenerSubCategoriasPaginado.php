<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.CategoriaPaquete.php");
require_once("clases/class.Funciones.php");
	require_once "clases/class.PagConfig.php";
try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$lo = new CategoriaPaquete();
	$f=new Funciones();
 	$pagina=new PagConfig();
    $pagina->db=$db;
 	$obtenerconfi=$pagina->ObtenerInformacionConfiguracion();
    $limitepaginado=$obtenerconfi['cantidadelementospaginado'];


	//Enviamos la conexion a la clase
	$lo->db = $db;

	$lo->iddepende=$_POST['idcategoria'];	
	$obtener=$lo->ObtSubcategorias();

	$categoria=$lo->ObtenerCategoriapadre();
	$categoriapadre=0;
	if (count($categoria)>0) {
		$categoriapadre=$categoria[0]->iddepende;
	}

	$lo->idcategoriapaquete=$lo->iddepende;
	$obtenercategoria=$lo->ObtenerCategoria();

	$cantidadelementos=count($obtenercategoria);

	

	 $cantidad=$limitepaginado;
    if (isset($_POST['inicio'])) {
       $inicio=$_POST['inicio'];


    }
    

  
    $totalelementos=$lo->ObtenerTodas();
  

    $resultado=$lo->ObtenerCategoriaLimit($inicio,$cantidad);


       $inicio=$_POST['inicio']+$cantidad;

    
    $respuesta['categoria']=$obtenercategoria[0];
	$respuesta['respuesta']=$resultado;
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