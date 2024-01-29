<?php
require_once("../../clases/class.Sesion.php");
//creamos nuestra sesion.
$se = new Sesion();


if(!isset($_SESSION['se_SAS']))
{
	/* header("Location: ../login.php"); */ echo "login";
	exit;
}

require_once("../../clases/conexcion.php");
require_once("../../clases/class.Usuarios.php");
require_once('../../clases/class.MovimientoBitacora.php');
require_once("../../clases/class.Funciones.php");

require_once("../../clases/class.Especialista.php");
try
{
	$db= new MySQL();
	$us= new Usuarios();
	$md = new MovimientoBitacora();
	$f = new Funciones();
	$especialista=new Especialista();
	$especialista->db=$db;
	
	$us->db=$db;
	$md->db = $db;	
	
	$db->begin();
		
	$id = $_POST['v_id'];
	$idusuario=$id;
	$us->id_usuario=$id;
	$us->idperfiles = 0;
	$us->idpuesto = $_POST['idpuesto'];
	$us->nombre= trim($f->guardar_cadena_utf8($_POST['nombre']));
	$us->paterno=trim($f->guardar_cadena_utf8($_POST['paterno']));
	$us->materno=trim($f->guardar_cadena_utf8($_POST['materno']));
	$us->celular=trim($_POST['v_celular']);
	$us->telefono=trim($_POST['telefono']);
	$us->email=trim($f->guardar_cadena_utf8($_POST['email']));
	$us->usuario=trim($f->guardar_cadena_utf8($_POST['v_celular']));
	$us->clave=trim($f->guardar_cadena_utf8($_POST['clave']));
	$us->idempresas_sucursal = $_POST['sucursal'];
	$us->tipo = $_POST['tipo_usuario'];
	$us->alias=$_POST['v_alias'];
	$us->sexo=$_POST['sexo'];
	$us->fechanacimiento=$_POST['v_fechanacimiento'];
	$us->estatus=$_POST['estatus'];
	$tipo = $_POST['tipo'];
	$us->tipo=$tipo;
	$color=$_POST['v_color'];
	$us->color=$color;
	
	$horarios=json_decode($_POST['horariosespecialista']);

	if($id == 0)
	{
	
	
	//recibiendo datos
	
	//$us->tipo_usuario = $_POST['tipo_usuario'];
	//guardando
	$us->GuardarUsuario();
	$md->guardarMovimiento($f->guardar_cadena_utf8('Alumnos'),'usuarios',$f->guardar_cadena_utf8('Nuevo Usuario creado -'.$_POST['usuario']));
	
		
	}else
	{
	
		//recibiendo datos
	/*$us->id_usuario=$_POST['v_id'];
	$us->idperfiles=0;
	$us->nombre=trim($f->guardar_cadena_utf8($_POST['nombre']));
	$us->paterno=trim($f->guardar_cadena_utf8($_POST['paterno']));
	$us->materno=trim($f->guardar_cadena_utf8($_POST['materno']));
	$us->celular=trim($_POST['celular']);
	$us->telefono=trim($_POST['telefono']);
	$us->email=trim($f->guardar_cadena_utf8($_POST['email']));
	$us->usuario=trim($f->guardar_cadena_utf8($_POST['usuario']));
	$us->clave=trim($f->guardar_cadena_utf8($_POST['clave']));
	$us->estatus=$_POST['estatus'];
	$us->tipo_usuario = $_POST['tipo_usuario'];
	$us->alias=$_POST['alias'];
	$us->sexo=$_POST['v_sexo'];
	$us->fechanacimiento=$_POST['v_fechanacimiento'];

	$tipo = $_POST['tipo'];
	$us->tipo=$tipo;
*/
	
	//guardando
	$us->ModificarUsuario();	
	$md->guardarMovimiento($f->guardar_cadena_utf8('Alumnos'),'usuarios',$f->guardar_cadena_utf8('Modificación de Usuario -'.$_POST['usuario']));
		
	}

	$us->EliminarHorarios();


if ($horarios[0]!='' && $horarios[0]!=null)
	{


	for ($i=0; $i <count($horarios) ; $i++) { 
		$us->idsucursal=$horarios[$i]->idsucursal;

		$verificar=$us->verificarusuariosucursal();

		if (count($verificar)>0) {

			$especialista->idespecialista=$verificar[0]->idespecialista;
			$especialista->bloqueo=0;
			$especialista->idsucursal=$verificar[0]->idsucursal;
			$especialista->estatus=1;
			$especialista->dia=$horarios[$i]->diasemana;
			$especialista->horainicial=$horarios[$i]->horainicio;
			$especialista->horafinal=$horarios[$i]->horafinal;
			$especialista->tipocomision=$horarios[$i]->tipocomision;
			$especialista->cantidadcomi=$horarios[$i]->cantidadcomi;
			$especialista->GuardarHorario();
			# code...
		}else{

			$especialista->idusuario=$us->id_usuario;
			$especialista->idsucursal=$horarios[$i]->idsucursal;
			$especialista->bloqueo=0;
			$guardar=$especialista->GuardarEspecialista();

			$especialista->estatus=1;

			$especialista->dia=$horarios[$i]->diasemana;
			$especialista->horainicial=$horarios[$i]->horainicio;
			$especialista->horafinal=$horarios[$i]->horafinal;

			$especialista->tipocomision=$horarios[$i]->tipocomision;
			$especialista->cantidadcomi=$horarios[$i]->cantidadcomi;
			
			$especialista->GuardarHorario();

			
			}

		}
}
	
	$db->commit();
	echo 1;
	
	
}
catch(Exception $e)
{
	$db->rollback();
	echo "Error. ".$e;
}
?>