<?php
/*======================= INICIA VALIDACIÓN DE SESIÓN =========================*/

require_once("../../clases/class.Sesion.php");
//creamos nuestra sesion.
$se = new Sesion();

if(!isset($_SESSION['se_SAS']))
{
	/*header("Location: ../../login.php"); */ echo "login";

	exit;
}

/*======================= TERMINA VALIDACIÓN DE SESIÓN =========================*/

//Importamos las clases que vamos a utilizar
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Tarjetaregalo.php");
require_once("../../clases/class.Funciones.php");
require_once('../../clases/class.MovimientoBitacora.php');

try
{
	//declaramos los objetos de clase
	$db = new MySQL();
	$emp = new Tarjetaregalo();
	$f = new Funciones();
	$md = new MovimientoBitacora();
	
	//enviamos la conexión a las clases que lo requieren
	$emp->db=$db;
	$md->db = $db;	
	
	$db->begin();
		
	//Recbimos parametros
	$emp->idtarjetaregalo = trim($_POST['id']);
	$emp->nombretarjeta = trim($f->guardar_cadena_utf8($_POST['v_nombre']));
	$emp->descripcion = trim($f->guardar_cadena_utf8($_POST['v_descripcion']));
	$emp->tipodescuento=$_POST['v_tipodescuento'];
	$emp->montodescuento=$_POST['v_cantidad'];

	$emp->orden = trim($f->guardar_cadena_utf8($_POST['v_orden']));
	$emp->fechavigencia=$_POST['fechavigencia'];
	$emp->estatus = trim($f->guardar_cadena_utf8($_POST['v_estatus']));

	$emp->idsucursal=$se->obtenerSesion('idsucursalsesion');
	

	
	//Validamos si hacermos un insert o un update
	if($emp->idtarjetaregalo == 0)
	{
		//guardando
		$emp->guardarTarjetaregalo();
		$md->guardarMovimiento($f->guardar_cadena_utf8('tarjeta'),'tarjeta regalo',$f->guardar_cadena_utf8('Nuevo tarjeta regalo creado con el ID-'.$emp->idtarjetaregalo));
	}else{
		$emp->modificarTarjetaregalo();	
		$md->guardarMovimiento($f->guardar_cadena_utf8('tarjeta regalo'),'tarjeta regalo',$f->guardar_cadena_utf8('Modificación del tarjeta regalo -'.$emp->idtarjetaregalo));
	}




	/*	foreach ($_FILES as $key) 
		{
		if($key['error'] == UPLOAD_ERR_OK ){//Verificamos si se subio correctamente


			$nombre = str_replace(' ','_',date('Y-m-d H:i:s').'-'.$emp->idpublicidad.".jpg");//Obtenemos el nombre del archivo
			
			$temporal = $key['tmp_name']; //Obtenemos el nombre del archivo temporal
			$tamano= ($key['size'] / 1000)."Kb"; //Obtenemos el tamaño en KB

			//obtenemos el nombre del archivo anterior para ser eliminado si existe

			$sql = "SELECT imagen FROM publicidad WHERE idpublicidad='".$emp->idpublicidad."'";

			$result_borrar = $db->consulta($sql);
			$result_borrar_row = $db->fetch_assoc($result_borrar);
			$nombreborrar = $result_borrar_row['imagen'];		  
			if($nombreborrar != "")
			{
				unlink($ruta.$nombreborrar); 
			}


			move_uploaded_file($temporal, $ruta.$nombre); //Movemos el archivo temporal a la ruta especificada

			$sql = "UPDATE publicidad SET imagen = '$nombre' WHERE idpublicidad='".$emp->idpublicidad."'";   
			$db->consulta($sql);	 
		}
	}*/
				
	$db->commit();
	echo "1|".$emp->idpublicidad;
	
}catch(Exception $e)
{
	$db->rollback();
	echo "Error. ".$e;
}
?>