<?php
require_once("../../clases/class.Sesion.php");
//creamos nuestra sesion.
$se = new Sesion();

 
if(!isset($_SESSION['se_SAS']))
{
	//header("Location: ../login.php");
	echo "login";
	exit;
}

require_once("../../clases/conexcion.php");

require_once("../../clases/class.Cita.php");

require_once("../../clases/class.Categoriaspaquete.php");

$codigo=$_SESSION['codservicio'];

$idcategoriapaquete=$_POST['idcategoriapaquete'];
	try {

		$db = new MySQL();

		$categorias = new Categoriaspaquete();
		$categorias->db=$db;
		
		$categorias->idcategoriapaquete=$idcategoriapaquete;
		$obtenercategorias=$categorias->ObtenerCategoriaPaquete();

		if (count($obtenercategorias)>0) {
			for ($i=0; $i < count($obtenercategorias); $i++) { 
				$idcatepadre=$obtenercategorias[$i]->idcategoriapaquete;
				$foto=$obtenercategorias[$i]->foto;
				$ruta="";
				if ($foto!='') {
					$ruta="./catalogos/categoriapaquete/imagenescategoria/".$codigo."/".$foto;
				}
				

				$obtenercategorias[$i]->ruta=$ruta;

				if($obtenercategorias[$i]->sub==0){

					$obtenercategorias[$i]->subcategorias=[];
				}else{


					$obtenercategorias[$i]->subcategorias=[];


					$subcategorias=$categorias->sub_categories($idcatepadre);

					$obtenercategorias[$i]->subcategorias=$subcategorias;


				}


			}
		}

		$respuesta['categoriaspaquete']=$obtenercategorias;

		$myJSON = json_encode($respuesta);
		echo $myJSON;
	

		
	} catch (Exception $e) {
		

	echo "Error. ".$e;
	}






?>