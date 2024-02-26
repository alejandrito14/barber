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
require_once("../../clases/class.Paquetes.php");
require_once('../../clases/class.Paquetesproductos.php');
require_once('../../clases/class.Opcion.php');

require_once("../../clases/class.Funciones.php");
require_once('../../clases/class.MovimientoBitacora.php');
require_once('../../clases/class.Especialista.php');

try
{
	//declaramos los objetos de clase
	$db = new MySQL();
	$emp = new Paquetes();
	$f = new Funciones();
	$md = new MovimientoBitacora();
	$especialista=new Especialista();
	$especialista->db=$db;
	$emp->db=$db;
	$md->db = $db;	
	$ruta="imagenespaquete/".$_SESSION['codservicio'].'/';
	$db->begin();

	//Recbimos parametros
	
	$VALIDACION = trim($_POST['VALIDACION']);
	$emp->idpaquete = trim($_POST['id']);
	$emp->nombre = trim($f->guardar_cadena_utf8($_POST['v_nombre']));
	$emp->descripcion = trim($f->guardar_cadena_utf8($_POST['v_descripcion']));
	$emp->precionormal = trim($f->guardar_cadena_utf8($_POST['preciounitario']));

	$emp->estatus = trim($f->guardar_cadena_utf8($_POST['v_estatus']));
	$emp->precioventa=trim($_POST['precioventa']);
	$emp->idcategoria=$_POST['idcategoria'];
	$emp->tiempoestimado=$_POST['v_tiempoestimado'];

	$emp->conpromo=$_POST['conpromo'];
	$emp->confecha=$_POST['confecha'];
	$emp->directo=$_POST['directo'];
	$emp->fechainicial=$_POST['fechainicial'];
	$emp->fechafinal=$_POST['fechafinal'];
	$emp->cantidadcobrar=$_POST['cantidadcobrar'];
	$emp->cantidadaconsiderar=$_POST['cantidadaconsiderar'];
	$emp->servicio=$_POST['servicio'];

	$emp->repetitivo=$_POST['repetitivo'];
	$emp->lunes=$_POST['lunes']!=''?$_POST['lunes']:0;
	$emp->martes=$_POST['martes']!=''?$_POST['martes']:0;
	$emp->miercoles=$_POST['miercoles']!=''?$_POST['miercoles']:0;
	$emp->jueves=$_POST['jueves']!=''?$_POST['jueves']:0;
	$emp->viernes=$_POST['viernes']!=''?$_POST['viernes']:0;
	$emp->sabado=$_POST['sabado']!=''?$_POST['sabado']:0;
	$emp->domingo=$_POST['domingo']!=''?$_POST['domingo']:0;
	$emp->preciofijo=$_POST['preciofijo'];

	$emp->horainicio=$_POST['horainicio'];

	$emp->horafin=$_POST['horafin'];
	$emp->orden=$_POST['orden'];
	$emp->activarcomentario=$_POST['activarcomentario'];
	$emp->siniva=$_POST['siniva'];
	$emp->iva=$_POST['iva'];
	$emp->mensajev=$_POST['mensajev'];
	$emp->idcategoriapaquete=$_POST['idcategoriapaquete'];
	$emp->txtcosto=$_POST['txtcosto'];

	if ($emp->txtcosto=='') {
		$emp->txtcosto=0;
	}
	
	$v_sucursal=$_POST['v_sucursal'];




	$emp->tarjetaregalo=$_POST['tarjetaregalo'];
	$emp->montomonedero=$_POST['txtmonederoregalo'];
	$emp->convigencia=$_POST['convigencia'];
	$emp->txtvigencia=$_POST['txtvigencia'];
	

	$especialistaspaquete='';

	if (isset($_POST['especialistaspaquete'])) {
		$especialistaspaquete=json_decode($_POST['especialistaspaquete']);
	}

	/*if ($emp->iva=='') {
		$emp->iva
	}*/

	if ($emp->preciofijo=='') {
		$emp->preciofijo=0;
	}

	if ($emp->cantidadcobrar=='') {
		$emp->cantidadcobrar=0;
	}

	if ($emp->cantidadaconsiderar=='') {
		$emp->cantidadaconsiderar=0;
	}
	if($emp->directo==''){
		$emp->directo=0;
	}
	if ($emp->conpromo=='') {
		$emp->conpromo=0;
	}
	if ($emp->repetitivo=='') {
		$emp->repetitivo=0;
	}

	if ($emp->servicio=='') {
		$emp->servicio=0;
	}
	if ($emp->confecha=='') {
		$emp->confecha=0;
	}
	$idinsumos=explode(',',$_POST['idproductos']);
	$cantidades=explode(',', $_POST['cantidades']);
	$insumomedidas=explode(',', $_POST['insumomedidas']);
	$insumototalmedidas=explode(',', $_POST['insumototalmedidas']);

	$preciospaquete=explode(',',$_POST['preciospaquete']);


	$complementos=explode(',', $_POST['complementos']);
	$paquetesvinculados=explode(',',$_POST['paquetesvinculados']);


	$suma=0;
	//Validamos si hacermos un insert o un update
	if($VALIDACION==1)
	{


		//guardando
		$emp->GuardarPaquete();
		$emp->EliminarDeSucursal();
		$emp->idsucursal=$v_sucursal;
		$emp->GuardarPaqueteSucursal();



		foreach($_SESSION['CarritoProducto'] as $k => $v)
		{  
			$cantidaddeprodutos ++;
			$producto_array = $k;	
			$producto_valores = explode("|",$v);

			$idproducto = $producto_valores[0];
			$cantidad = $producto_valores[1];
			$nombre=$producto_valores[2];


			$productos_descripcion=new Paquetesproductos();
			$productos_descripcion->db=$db;

			$productos_descripcion->idproducto=$idproducto;
			$productos_descripcion->cantidad=$cantidad;
				
				$productos_descripcion->idpaquete=$emp->idpaquete;

				$productos_descripcion->guardarPaqueteDescripcion();


			}


			if ($complementos[0]!='') {
				# code...
			$topessecundarios=explode(',',$_POST['topessecundarios']);

			if (count($complementos)>0) {
				# code...

				for ($i=0; $i <count($complementos) ; $i++) { 

					$op = new Opcion();
					$op->db=$db;
					$op->idgrupo=$complementos[$i];
					$op->idpaquete=$emp->idpaquete;
					$op->topesecundario=$topessecundarios[$i];
					$op->GuardaGrupoPaquete();



				}
			}
		}


			for ($i=0; $i < count($preciospaquete); $i++) { 
					
				$dividircadena=explode('_',$preciospaquete[$i]);	
				$idprecio=$dividircadena[0];
				$precio=$dividircadena[1];

				$emp->GuardaPreciopaquete($idprecio,$precio);

			}


			if ($emp->conpromo==1) {
	

			if ($paquetesvinculados[0]!='') {


				for ($i=0; $i < count($paquetesvinculados); $i++) { 
						
					$idpaquetevinculado=$paquetesvinculados[$i];
						
					
					if ($idpaquetevinculado!=0) {
						$emp->GuardaPaquetevinculado($idpaquetevinculado);

					}

				}

			}

		}

			$md->guardarMovimiento($f->guardar_cadena_utf8('Paquetes'),'Paquetes',$f->guardar_cadena_utf8('Nuevo paquete creado con el ID-'.$emp->idpaquete));


			$se->crearSesion('CarritoComplemento',null);
		}else{

			

		$emp->modificarPaquete();	
	
		$emp->EliminarPaquetesProductos();
		$emp->EliminarComplementos();

		$emp->EliminarDeSucursal();
		$emp->idsucursal=$v_sucursal;
		$emp->GuardarPaqueteSucursal();


		foreach($_SESSION['CarritoProducto'] as $k => $v)
		{  
			$cantidaddeprodutos ++;
			$producto_array = $k;	
			$producto_valores = explode("|",$v);

			$idproducto = $producto_valores[0];
			$cantidad = $producto_valores[1];
			$nombre=$producto_valores[2];


			$productos_descripcion=new Paquetesproductos();
			$productos_descripcion->db=$db;

			$productos_descripcion->idproducto=$idproducto;
			$productos_descripcion->cantidad=$cantidad;
				/*$productos_descripcion->medida=$insumomedidas[$i];
				$productos_descripcion->subtotalmedida=$insumototalmedidas[$i];*/
				$productos_descripcion->idpaquete=$emp->idpaquete;

				$productos_descripcion->guardarPaqueteDescripcion();

				//$suma=$suma+$subtotalinsumos[$i];

			}
if ($complementos[0]!='') {
			if (count($complementos)>0) {
				# code...
				$topessecundarios=explode(',',$_POST['topessecundarios']);

				for ($i=0; $i <count($complementos) ; $i++) { 

					$op = new Opcion();
					$op->db=$db;
					$op->idgrupo=$complementos[$i];
					$op->idpaquete=$emp->idpaquete;
					$op->topesecundario=$topessecundarios[$i];

					$op->GuardaGrupoPaquete();



				}
			}
		}


				$emp->eliminarpreciopaquete();

			for ($i=0; $i < count($preciospaquete); $i++) { 
					
				$dividircadena=explode('_',$preciospaquete[$i]);	
				$idprecio=$dividircadena[0];
				$precio=$dividircadena[1];

				$emp->GuardaPreciopaquete($idprecio,$precio);

			}
			
			//$emp->Eliminarpaquetevinculado();

			if ($emp->conpromo==1) {
	

			if ($paquetesvinculados[0]!='') {

				for ($i=0; $i < count($paquetesvinculados); $i++) { 
						
					$idpaquetevinculado=$paquetesvinculados[$i];	
					
					if ($idpaquetevinculado!=0) {
						$emp->GuardaPaquetevinculado($idpaquetevinculado);

					}

				}

			}

		}

				$md->guardarMovimiento($f->guardar_cadena_utf8('Paquetes'),'Paquetes',$f->guardar_cadena_utf8('Modificacion de paquete con el ID-'.$emp->idpaquete));
		}

		if ($emp->servicio==1) {
			

			$especialista->idpaquete=$emp->idpaquete;

			$especialista->EliminarEspecialistaPaquete();
			//var_dump($especialistaspaquete);die();
			if (count($especialistaspaquete)>0) {
				for ($i=0; $i < count($especialistaspaquete); $i++) { 
					$especialista->idespecialista=$especialistaspaquete[$i]->idespecialista;
					$especialista->costo=$especialistaspaquete[$i]->costo;
					$especialista->GuardarEspecialistaPaquete();
				}
			}
		}

	//$emp->ActualizarPrecioProducto();

		

		if (isset($_FILES["archivo"])) {

		//if($_FILES['error'] == UPLOAD_ERR_OK ){//Verificamos si se subio correctamente

			$nombre = str_replace(' ','_',date('Y-m-d H:i:s').'-'.$emp->idpaquete.".jpg");//Obtenemos el nombre del archivo
			$temporal = $_FILES["archivo"]['tmp_name']; //Obtenemos el nombre del archivo temporal
			$tamano= ($key['size'] / 1000)."Kb"; //Obtenemos el tamaño en KB

			//obtenemos el nombre del archivo anterior para ser eliminado si existe

			$sql = "SELECT foto FROM paquetes WHERE idpaquete='".$emp->idpaquete."'";
			$result_borrar = $db->consulta($sql);
			$result_borrar_row = $db->fetch_assoc($result_borrar);
			$nombreborrar = $result_borrar_row['foto'];		  

			if($nombreborrar != "")
			{
				unlink($ruta.$nombreborrar); 
			}


			move_uploaded_file($temporal, $ruta.$nombre); //Movemos el archivo temporal a la ruta especificada

			$sql = "UPDATE paquetes SET foto = '$nombre' WHERE idpaquete ='".$emp->idpaquete."'";   
			$db->consulta($sql);	 
		//}
	}



		/*foreach ($_FILES as $key) 
		{*/

		if (isset($_FILES["archivo2"])) {

		//if($_FILES['error'] == UPLOAD_ERR_OK ){//Verificamos si se subio correctamente

			$nombre = str_replace(' ','_',date('Y-m-d H:i:s').'-'.$emp->idpaquete."-2.jpg");//Obtenemos el nombre del archivo
			$temporal = $_FILES["archivo2"]['tmp_name']; //Obtenemos el nombre del archivo temporal
			//$tamano= ($key['size'] / 1000)."Kb"; //Obtenemos el tamaño en KB

			//obtenemos el nombre del archivo anterior para ser eliminado si existe

			$sql = "SELECT foto2 FROM paquetes WHERE idpaquete='".$emp->idpaquete."'";
			$result_borrar = $db->consulta($sql);
			$result_borrar_row = $db->fetch_assoc($result_borrar);
			$nombreborrar = $result_borrar_row['foto2'];		  

			if($nombreborrar != "")
			{
				unlink($ruta.$nombreborrar); 
			}


			move_uploaded_file($temporal, $ruta.$nombre); //Movemos el archivo temporal a la ruta especificada

			$sql = "UPDATE paquetes SET foto2 = '$nombre' WHERE idpaquete ='".$emp->idpaquete."'";   
			$db->consulta($sql);	 
		//}
	 }
	//}


	$cortesias=explode(',', $_POST['cortesias']);
		$tienecortesia=$emp->ObtenerCortesiaPaquete();

		if (count($tienecortesia)>0) {
			$emp->EliminarCortesias();
		}

	if ($cortesias[0]!='') {
		
		for ($i=0; $i < count($cortesias); $i++) { 
			$emp->idcortesia=$cortesias[$i];
			$emp->GuardarCortesia();
		}
	}

	

	$db->commit();
	echo 1;
	
}catch(Exception $e)
{
	$db->rollback();
	echo "Error. ".$e;
}
?>


