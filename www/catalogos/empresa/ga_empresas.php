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
require_once("../../clases/class.Empresas.php");
require_once("../../clases/class.Funciones.php");
require_once('../../clases/class.MovimientoBitacora.php');

try
{
	//declaramos los objetos de clase
	$db = new MySQL();
	$emp = new Empresas();
	$f = new Funciones();
	$md = new MovimientoBitacora();
	
	//enviamos la conexión a las clases que lo requieren
	$emp->db=$db;
	$md->db = $db;	
	
	$db->begin();
		
	//Recbimos parametros
	$emp->idempresas = trim($_POST['id']);
	$emp->empresas = trim($f->guardar_cadena_utf8($_POST['v_empresa']));
	$emp->direccion = trim($f->guardar_cadena_utf8($_POST['v_direccion']));
	$emp->telefono = trim($f->guardar_cadena_utf8($_POST['v_telefono']));
	$emp->email = trim($f->guardar_cadena_utf8($_POST['v_email']));
	$emp->contactos = trim($f->guardar_cadena_utf8($_POST['v_contactos']));
	$emp->estatus = trim($f->guardar_cadena_utf8($_POST['v_estatus']));
	$emp->f_rfc = trim($f->guardar_cadena_utf8($_POST['v_f_rfc']));
	$emp->f_razonsocial = trim($f->guardar_cadena_utf8($_POST['v_f_razonsocial']));
	$emp->f_calle = trim($f->guardar_cadena_utf8($_POST['v_f_calle']));
	$emp->f_no_ext = trim($f->guardar_cadena_utf8($_POST['v_f_no_ext']));
	$emp->f_no_int = trim($f->guardar_cadena_utf8($_POST['v_f_no_int']));
	$emp->f_colonia = trim($f->guardar_cadena_utf8($_POST['v_f_colonia']));
	$emp->f_ciudad = trim($f->guardar_cadena_utf8($_POST['v_f_ciudad']));
	$emp->f_estado = trim($f->guardar_cadena_utf8($_POST['v_f_estado']));
	$emp->f_cp = trim($f->guardar_cadena_utf8($_POST['v_f_cp']));
	$emp->f_pais=trim($f->guardar_cadena_utf8($_POST['v_pais']));
	$emp->f_municipio=trim($f->guardar_cadena_utf8($_POST['v_municipio']));


	
	//Validamos si hacermos un insert o un update
	if($emp->idempresas == 0)
	{
		//guardando
		$emp->guardarEmpresa();
		$md->guardarMovimiento($f->guardar_cadena_utf8('Empresas'),'empresas',$f->guardar_cadena_utf8('Nuevo empresas creado con el ID-'.$emp->idempresas));
		$emp->guardarEnFoliosEmpresas();
	}else{
		$emp->modificarEmpresa();	
		$md->guardarMovimiento($f->guardar_cadena_utf8('Empresas'),'empresas',$f->guardar_cadena_utf8('Modificación de la empresa -'.$emp->idempresas));
	}
				
	$db->commit();
	echo "1|".$emp->idempresas;
	
}catch(Exception $e)
{
	$db->rollback();
	echo "Error. ".$e;
}
?>