<?php 
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');


//Inlcuimos las clases a utilizar
require_once("clases/conexcion.php");
require_once("clases/class.PagConfig.php");
require_once("clases/class.Funciones.php");
/*require_once("clases/class.Sms.php");
require_once("clases/class.phpmailer.php");
require_once("clases/emails/class.Emails.php");*/

try
{
	
	//Declaramos objetos de clases
	$db = new MySQL();
	$confi = new PagConfig();
	$f=new Funciones();
	$lo = new CategoriaPaquete();
	$lo->db=$db;
	//Enviamos la conexion a la clase
	$confi->db = $db;

	$pagina=$confi->ObtenerInformacionConfiguracion();
	$limitepaginado=$obtenerconfi['cantidadelementospaginado'];



	$totalelementos=$lo->ObtSubcategoriasMostrarCalendario();

	/*$categoria=$lo->ObtenerCategoriapadre();
	$categoriapadre=0;
	if (count($categoria)>0) {
		$categoriapadre=$categoria[0]->iddepende;
	}*/

	

	

	 $cantidad=$limitepaginado;
    if (isset($_POST['inicio'])) {
       $inicio=$_POST['inicio'];


    }
    

  
  

    $resultado=$lo->ObtSubcategoriasMostrarCalendarioLimit($inicio,$cantidad);


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