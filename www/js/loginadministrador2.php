<?php
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');

require_once("../clases/class.Funciones.php");
require_once("../clases/class.Fechas.php");





//primero debemos de obtnre los valores de id de servicio   DB, USAURIO DB, CLAVE DB, IP SERVER DB.
//DEBEMOS DE VALIDAR LA FECHA DE VIGENCIA DEL SERVICIO.


		$codservicio = $_POST['codservicio'];
       // $con2 = mysqli_connect("189.193.4.113","pepe","121275","isadmin");
       // $con2 = mysqli_connect("is-software.net","issoftwa_prueba","prueba","issoftwa_admin");

			       //  mysql_select_db("isadmin",$con2);
           //  $con2 = mysqli_connect("192.169.197.189","issoftware","qr=]3JKxsT+3!","isadmin");



		
			/*$consulta = "SELECT * FROM servicios_clientes WHERE idservicios_clientes = '$codservicio'";
			

			$servicio =  $con2->query($consulta); 
		
			$servicio_row =  mysqli_fetch_assoc($servicio);  

			$servicio_num=mysqli_num_rows($servicio);*/


			$rutaArchivo = 'servicios_clientes.json';

			// Leer el contenido del archivo JSON
			$jsonData = file_get_contents($rutaArchivo);

			// Decodificar el JSON
			$data = json_decode($jsonData, true);

			// ID de servicio cliente que quieres buscar
			

			// Buscar el registro con el idservicios_clientes deseado
			$foundRecord = null;
			foreach ($data['RECORDS'] as $record) {
			    if ($record['idservicios_clientes'] === $codservicio) {
			        $foundRecord = $record;
			        break; // Se encontró el registro, salir del bucle
			    }
			}
		
		    if( $servicio_num  != 0)
			{
				//obtenemos la fecha de la base de datos en su vigencia.
				
				$f_vigencia = date("Y-m-d",strtotime($servicio_row['vigencia']));
				$f_actual = date("Y-m-d");


				if ($f_actual<=$f_vigencia) {

					


					$vigente=1;
					
					/*$conexcion->servidor=$servicio_row['db_ip'];
					$conexcion->usuario=$servicio_row['db_usuario'];
					$conexcion->contrase=$servicio_row['db_clave'];
					$conexcion->db=$servicio_row['db'];*/
						include('../clases/conexcion2.php');

						$conexcion= new MySQL2();
						$conexcion->servidor=$servicio_row['db_ip'];
						$conexcion->usuario=$servicio_row['db_usuario'];
						$conexcion->contrase=$servicio_row['db_clave'];
						$conexcion->db=$servicio_row['db'];
						$carpetaapp=$servicio_row['carpetaapp'];
						$conexcion->conectar();




				}else
				{

					$vigente=0;

				}
				
				
				
			}else{

				$vigente=0;

				
			}
		



//TERMINAMOS DE VALIDAR EL SERVICIO.
$rows='';

if($vigente == 1)
{


	//include('clases/class.Login.php');
	$usuario = $_POST['usuario'];
	$contrasena = $_POST['contrasena'];
	$tabla = "usuarios";
	$sistema=$_POST['sistema'];
	$tokenfirebase=$_POST['tokenfirebase'];
	$uuid=$_POST['uuid'];

	$query= "SELECT * FROM ".$tabla." WHERE usuario LIKE BINARY'".$usuario."' AND clave LIKE BINARY '".$contrasena."'";
	

			$resp=$conexcion->consulta($query);
			
			$rows=$conexcion->fetch_assoc($resp);
			$total=$conexcion->num_rows($resp);



		

			if($total>0)
			{
				if($rows['estatus']==0)
				{
					return 2;
				}
				else
				{

					

					
	
					//$se->crearSesion('se_sas_Sucursal',$rows['idsucursales']);
									
					$fn=new Funciones();
				
				
					$direccion_ip = $_SERVER['REMOTE_ADDR'];

					//$so = $fn->sistema_o();
					//$navegador = $fn->navegador();
				    $fe=new Fechas();

					$fecha_ingreso = $fe->fecha_hora_segundos();
					$idusuario=$rows['idusuarios'];
					
					$query_usuario = "INSERT INTO bitacora(direccion_ip,sistema_operativo,navegador,fecha_ingreso,idusuarios) VALUES ('$direccion_ip','$so','$navegador','$fecha_ingreso',$idusuario)";
					$conexcion->consulta($query_usuario);

					if ($tokenfirebase!='' || $tokenfirebase!=null) {

					$fechaactual=date('Y-m-d');
					$buscartokenusuario="SELECT *FROM  usuariotoken WHERE  uuid='$uuid'";

					$resultado=$conexcion->consulta($buscartokenusuario);
					$numconsulta=$conexcion->num_rows($resultado);

						if ($numconsulta==0) {
						$querytokenfirebase="INSERT INTO usuariotoken(idusuario,token,dispositivo,uuid) VALUES('$idusuario','$tokenfirebase','$sistema','$uuid')";

							$conexcion->consulta($querytokenfirebase);

						}else{

							$queryeliminar="DELETE FROM usuariotoken WHERE uuid='$uuid'";
							$conexcion->consulta($queryeliminar);

							$querytokenfirebase="INSERT INTO usuariotoken(idusuario,token,dispositivo,uuid) VALUES('$idusuario','$tokenfirebase','$sistema','$uuid')";

							$conexcion->consulta($querytokenfirebase);



						}

					}
	
					$respuesta=1;
				}
				
				
			}
			else
			{
				//return "El Usuario no existe";
				$respuesta=0;

			}

	//$quepaso = $lo->ValidandoDatos();


}else
{

	$respuesta=2;
	//echo 2;  //este valor es por que la vigencia o servicio no exiten.
}

$valores = array('respuesta' => $respuesta,'usuario'=>$rows);

$vrespuesta['respuesta']=$valores;

echo json_encode($vrespuesta);


?>