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
require_once("../../clases/class.Tarjetalealtad.php");
require_once("../../clases/class.Funciones.php");
require_once('../../clases/class.MovimientoBitacora.php');

try
{
	//declaramos los objetos de clase
	$db = new MySQL();
	$emp = new Tarjetalealtad();
	$f = new Funciones();
	$md = new MovimientoBitacora();
	
	//enviamos la conexión a las clases que lo requieren
	$emp->db=$db;
	$md->db = $db;	
	
	$db->begin();



		
	//Recbimos parametros
	$emp->idtarjetalealtad = trim($_POST['id']);
	$emp->nombre =$_POST['v_nombre'];
	$emp->descripcion = $_POST['v_descripcion'];
	$emp->cantidadrequerida=isset($_POST['v_cantidadrequerida'])?$_POST['v_cantidadrequerida']:0;

	$emp->cantidadbeneficio=isset($_POST['v_cantidadporbeneficio'])?$_POST['v_cantidadporbeneficio']:0;
	$emp->repeticiones=$_POST['v_repeticiones'];

	if (isset($_POST['v_regla'])) {
		if ($_POST['v_regla']=='undefined') {
			$emp->regla=0;
		}else{

			$emp->regla=isset($_POST['v_regla'])?$_POST['v_regla']:0;
		}
	}


	

	$emp->orden = $_POST['v_orden'];
	$emp->fechainicial=$_POST['v_fechainicial'];
	$emp->fechafinal=$_POST['v_fechafinal'];
	$emp->porvisita=$_POST['v_porvisita'];
	$emp->automatico=$_POST['v_automatico'];

	$emp->estatus = $_POST['v_estatus'];

	$emp->idsucursal=$se->obtenerSesion('idsucursalsesion');
	

	$emp->todosproducto=$_POST['v_tproductos'];
	$emp->todosbeneficio=$_POST['v_tproductosbene'];
	$emp->todoscliente=$_POST['v_tclientes'];

	$paquetes=explode(',', $_POST['paquetes']);
	$beneficios=explode(',',$_POST['beneficios']);
	$clientes=explode(',',$_POST['clientes']);
	//Validamos si hacermos un insert o un update
	if($emp->idtarjetalealtad == 0)
	{
		//guardando
		$emp->guardartarjetalealtad();
		$md->guardarMovimiento($f->guardar_cadena_utf8('tarjeta'),'tarjeta lealtad',$f->guardar_cadena_utf8('Nuevo tarjeta lealtad creado con el ID-'.$emp->idtarjetaregalo));
	}else{
		$emp->modificartarjetalealtad();	
		$emp->EliminarProductostarjeta();

		$emp->EliminarBeneficiosTarjeta();

		$emp->EliminarClientesTarjeta();

		$md->guardarMovimiento($f->guardar_cadena_utf8('tarjeta lealtad'),'tarjeta lealtad',$f->guardar_cadena_utf8('Modificación del tarjeta lealtad -'.$emp->idtarjetaregalo));
	}



	if ($paquetes[0]!='') {
		# code...
	
	for ($i=0; $i < count($paquetes); $i++) { 
		
		$emp->idproducto=$paquetes[$i];
		$emp->GuardarProducto();
	}
}

	if ($beneficios[0]!='') {
		# code...
	

	for ($i=0; $i <count($beneficios) ; $i++) { 

		$emp->idbeneficio=$beneficios[$i];
		$emp->GuardarBeneficio();

	}

}
if ($clientes[0]!='') {
	for ($i=0; $i <count($clientes) ; $i++) { 

		$emp->idusuario=$clientes[$i];
		$emp->GuardarClienteTarjeta();
	}

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
	echo "1|".$emp->idtarjetalealtad;
	
}catch(Exception $e)
{
	$db->rollback();
	echo "Error. ".$e;
}
?>