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
$idmenumodulo = $_GET['idmenumodulo'];

//validaciones para todo el sistema


$tipousaurio = $_SESSION['se_sas_Tipo'];  //variables de sesion
$lista_empresas = $_SESSION['se_liempresas']; //variables de sesion

//validaciones para todo el sistema


/*======================= TERMINA VALIDACIÓN DE SESIÓN =========================*/


//Importamos nuestras clases
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Botones.php");
require_once("../../clases/class.Usuarios.php");


//Se crean los objetos de clase
$db = new MySQL();
$usuarios = new Usuarios();
$f = new Funciones();
$bt = new Botones_permisos();
$usuarios->db=$db;


try{
	
	$celular=$_POST['celular'];

	$usuarios->celular=$celular;
	$respue=$usuarios->ObtenerUsuarioCelular();
	$existe=0;
	if (count($respue)>0) {
		$existe=1;
	}

	$respuesta['existe']=$existe;
	$respuesta['respuesta']=1;
	
    echo json_encode($respuesta);

}catch(Exception $e)
{
	$db->rollback();
	echo "Error. ".$e;
}
?>