<?php
class Paquetes
{
	public $db;
	public $idpaquete;

	public $nombre;
	public $descripcion;
	public $precio;
	public $descuento ;

	public $estatus ;
	public $precionormal;
	public $precioventa;
	public $lista_empresa;
	public $tipo_usuario;
	public $idcategoria;
	public $fechainicial;
	public $fechafinal;
	public $conpromo;
	public $confecha;
	public $directo;
	public $cantidadcobrar;
	public $cantidadaconsiderar;
	public $servicio;

	public $repetitivo;
	public $lunes;
	public $martes;
	public $miercoles;
	public $jueves;
	public $viernes;
	public $sabado;
	public $domingo;
	public $preciofijo;
	public $horainicio;
	public $horafin;
	public $orden;
	public $activarcomentario;
	public $siniva;
	public $iva;
	public $mensajev;
	public $idcategoriapaquete;
	public $idsucursal;
	public $tiempoestimado;

	public $tarjetaregalo;
	public $montomonedero;
	public $convigencia;

	public $txtvigencia;

	public $idcortesia;
	
	public $arraysub;
	public function obtenerFiltro()
	{
		$query = "SELECT
			paquetes.idpaquete,
			paquetes.nombrepaquete,
			paquetes.descripcion,
			paquetes.foto,
			paquetes.estatus,
			categoriapaquete.idcategoriapaquete,
			categoriapaquete.nombre as titulo,
			paquetes.promocion,
			preciopaquete.precio AS precioventa,
			precio.principal,
			paquetes.orden,
			paquetes.fechainicial,
			paquetes.fechafinal,
			paquetes.aplicardirecto,
			paquetes.cantidad,
			paquetes.considerar,
			paquetes.definirfecha,
			paquetes.lunes,
			paquetes.martes,
			paquetes.miercoles,
			paquetes.jueves,
			paquetes.viernes,
			paquetes.sabado,
			paquetes.domingo,
			paquetes.repetitivo,
			paquetes.preciofijo,
			paquetes.horainicialpromo,
			paquetes.horafinalpromo
			FROM
			paquetes
			LEFT JOIN categoriapaquete
			ON paquetes.idcategoriapaquete = categoriapaquete.idcategoriapaquete 
			
			LEFT JOIN preciopaquete
			ON paquetes.idpaquete = preciopaquete.idpaquete 
			LEFT JOIN precio
			ON precio.idprecio = preciopaquete.idprecio AND   precio.principal=1
			


			";
			
		$result = $this->db->consulta($query);
		return $result;
	}


	public function GuardarPaquete()
	{


//$this->db->real_escape_string(
		$query = "INSERT INTO paquetes (nombrepaquete,descripcion,estatus,idcategorias,promocion,definirfecha,fechainicial,fechafinal,cantidad,considerar,aplicardirecto,servicio,repetitivo,lunes,martes,miercoles,jueves,viernes,sabado,domingo,preciofijo,horainicialpromo,horafinalpromo,orden,activarcomentario,mensaje,siniva,iva,idcategoriapaquete,intervaloservicio,tarjetaregalo,montomonedero,confechavigencia,fechavigencia) VALUES ('".$this->db->real_escape_string($this->nombre)."','".$this->db->real_escape_string($this->descripcion)."','$this->estatus','0','$this->conpromo','$this->confecha','$this->fechainicial','$this->fechafinal','$this->cantidadcobrar','$this->cantidadaconsiderar','$this->directo','$this->servicio',$this->repetitivo,$this->lunes,$this->martes,$this->miercoles,$this->jueves,$this->viernes,$this->sabado,$this->domingo,$this->preciofijo,'$this->horainicio','$this->horafin','$this->orden','$this->activarcomentario','$this->mensajev','$this->siniva','$this->iva','$this->idcategoriapaquete','$this->tiempoestimado','$this->tarjetaregalo','$this->montomonedero','$this->convigencia','$this->txtvigencia')";

		$this->db->consulta($query);
		$this->idpaquete = $this->db->id_ultimo();
	}

		//Funcion que sirve para modifcar un producto
	public function modificarPaquete()
	{
		$query = "UPDATE paquetes SET  
		 	nombrepaquete = '$this->nombre', 
		 	descripcion = '$this->descripcion', 
			idcategorias = 0,
			estatus = '$this->estatus',
			promocion='$this->conpromo',
			definirfecha='$this->confecha',
			fechainicial='$this->fechainicial',
			fechafinal='$this->fechafinal',
			cantidad='$this->cantidadcobrar',
			considerar='$this->cantidadaconsiderar',
			aplicardirecto='$this->directo',
			servicio='$this->servicio',
			repetitivo='$this->repetitivo',
			lunes='$this->lunes',
			martes='$this->martes',
			miercoles='$this->miercoles',
			jueves='$this->jueves',
			viernes='$this->viernes',
			sabado='$this->sabado',
			domingo='$this->domingo',
			preciofijo='$this->preciofijo',
			horainicialpromo='$this->horainicio',
			horafinalpromo='$this->horafin',
			orden='$this->orden',
			activarcomentario='$this->activarcomentario',
			mensaje='$this->mensajev',
			siniva='$this->siniva',
			iva='$this->iva',
			idcategoriapaquete='$this->idcategoriapaquete',
			intervaloservicio='$this->tiempoestimado',
			tarjetaregalo='$this->tarjetaregalo',
			montomonedero='$this->montomonedero',
			confechavigencia='$this->convigencia',
			fechavigencia='$this->txtvigencia'
			WHERE idpaquete = '$this->idpaquete' ";

			
		$this->db->consulta($query);
	}
	

	public function ObtenerPaquete()
	{
		$query="SELECT *FROM paquetes WHERE idpaquete=".$this->idpaquete."";

		$result=$this->db->consulta($query);

		return $result;

	}





	public function ObtPaqueteOpciones()
	{
		$sql = "SELECT * FROM grupopaquetes WHERE idpaquete = ".$this->idpaquete."";
		
		$resp = $this->db->consulta($sql);
		$cont = $this->db->num_rows($resp);


		$array=array();
		$contador=0;
		if ($cont>0) {

			while ($objeto=$this->db->fetch_object($resp)) {

				$array[$contador]=$objeto;
				$contador++;
			} 
		}
		return $array;
	}

	public function EliminarPaquetesProductos($value='')
	{
		$sql = "DELETE FROM paquetesproducto WHERE idpaquete = ".$this->idpaquete."";
		
		$resp = $this->db->consulta($sql);
		
	}

	public function EliminarComplementos($value='')
	{
		
		$sql = "DELETE FROM grupopaquetes WHERE idpaquete = ".$this->idpaquete."";
		$resp = $this->db->consulta($sql);
		
	}

	public function EliminarPaquete()
	{
		$sql = "DELETE FROM paquetes WHERE idpaquete = ".$this->idpaquete."";

		$resp = $this->db->consulta($sql);
		
	}


	public function EliminarPaquetevinculo()
	{
		$sql = "DELETE FROM paquetevinculado WHERE idpaquete = ".$this->idpaquete."";

		$resp = $this->db->consulta($sql);
		
	}


	public function EliminarPaquetevinculo2()
	{
		$sql = "DELETE FROM paquetevinculado WHERE idpaquetepromocion = ".$this->idpaquete."";

		$resp = $this->db->consulta($sql);
		
	}


	public function ObtenerPaqueteSucursal($idsucursal,$idpaquete)
	{
		$sql = "SELECT * FROM paquetesucursal WHERE idsucursal = ".$idsucursal." AND idpaquete=".$idpaquete."";
		$resp = $this->db->consulta($sql);
		$cont = $this->db->num_rows($resp);


		$array=array();
		$contador=0;
		if ($cont>0) {

			while ($objeto=$this->db->fetch_object($resp)) {

				$array[$contador]=$objeto;
				$contador++;
			} 
		}
		return $contador;
	}

	public function FiltrarPaquetes()
	{
		$query = "SELECT *from paquetes WHERE 1=1";
		$query.= ($this->nombre != '') ? " AND  nombrepaquete  LIKE '%".$this->nombre."%'":" ";

			
		$result = $this->db->consulta($query);
		return $result;
	}

	public function Obtenerprecios()
	{
		$sql = "SELECT * FROM precio WHERE estatus=1 ORDER BY principal DESC";
		$resp = $this->db->consulta($sql);
		$cont = $this->db->num_rows($resp);


		$array=array();
		$contador=0;
		if ($cont>0) {

			while ($objeto=$this->db->fetch_object($resp)) {

				$array[$contador]=$objeto;
				$contador++;
			} 
		}
		return $array;
	}


	public function Obtenerpreciospaquete()
	{
		$sql = "SELECT * FROM preciopaquete WHERE idpaquete=".$this->idpaquete."";
		$resp = $this->db->consulta($sql);
		$cont = $this->db->num_rows($resp);


		$array=array();
		$contador=0;
		if ($cont>0) {

			while ($objeto=$this->db->fetch_object($resp)) {

				$array[$contador]=$objeto;
				$contador++;
			} 
		}
		return $array;
	}

	public function GuardaPreciopaquete($idprecio,$precio)
	{
		$sql="INSERT INTO preciopaquete(idprecio,precio,idpaquete) VALUES (".$idprecio.",".$precio.",".$this->idpaquete.")";

	
		 $this->db->consulta($sql);
	
	}

	public function eliminarpreciopaquete()
	{
		$sql="DELETE FROM preciopaquete WHERE idpaquete=".$this->idpaquete."";
		
		$this->db->consulta($sql);

	}

	public function precioprincipal()
	{
		$sql = "SELECT
				preciopaquete.idpaquete,
				preciopaquete.idprecio,
				preciopaquete.precio,
				precio.principal
				FROM
				preciopaquete
				JOIN precio
				ON preciopaquete.idprecio = precio.idprecio WHERE preciopaquete.idpaquete=".$this->idpaquete." AND precio.principal=1";


		$result=$this->db->consulta($sql);
		return $result;


	}


	public function Obtenerproductodepaquete()
	{
		
		$query="SELECT
		paquetesproducto.idproducto,
		paquetesproducto.cantidad,
		paquetesproducto.idpaquete,
		productos.codigoproducto,
		productos.nombre

		FROM
		paquetesproducto
		JOIN productos
		ON paquetesproducto.idproducto = productos.idproducto WHERE paquetesproducto.idpaquete=".$this->idpaquete."";



		$resp = $this->db->consulta($query);
		$cont = $this->db->num_rows($resp);


		$array=array();
		$contador=0;
		if ($cont>0) {

			while ($objeto=$this->db->fetch_object($resp)) {

				$array[$contador]=$objeto;
				$contador++;
			} 
		}
		return $array;


	}

	

	public function Obtenerdetalledegrupoopcion($idgrupoopcion)
	{
		$query="SELECT
				grupoopcion.idgrupoopcion,
				grupoopcion.opcion,
				grupo.multiple,
				grupo.sincoprecio
				FROM
				grupoopcion
				JOIN grupo
				ON grupoopcion.idgrupo = grupo.idgrupo 
				WHERE idgrupoopcion=".$idgrupoopcion."";

		$resp = $this->db->consulta($query);
		$cont = $this->db->num_rows($resp);


		$array=array();
		$contador=0;
		if ($cont>0) {

			while ($objeto=$this->db->fetch_object($resp)) {

				$array[$contador]=$objeto;
				$contador++;
			} 
		}
		return $array;

	}

	public function ObtenerUltimoOrdenpaquete()
	{
		$query="SELECT MAX(orden) as ordenar FROM paquetes ";		

		$resp=$this->db->consulta($query);
		$cont = $this->db->num_rows($resp);


		$array=array();
		$contador=0;
		$numero=0;
		if ($cont>0) {

			while ($objeto=$this->db->fetch_object($resp)) {

				$array[$contador]=$objeto;
				$contador++;
			} 

			$numero=$array[0]->ordenar;
		}

		return $numero;
	}


	public function ObtenerImagenespaquete()
	{
		$sql="SELECT *FROM paquetesimagenes WHERE idpaquete=".$this->idpaquete."";

		$resp=$this->db->consulta($sql);
		$cont = $this->db->num_rows($resp);


		$array=array();
		$contador=0;
		if ($cont>0) {

			while ($objeto=$this->db->fetch_object($resp)) {

				$array[$contador]=$objeto;
				$contador++;
			} 
		}
		
		return $array;
	}


	public function ObtenerPaquetesSinPromocion()
	{
		
		$query="SELECT
		paquetes.idpaquete,
		paquetes.nombrepaquete

		FROM paquetes
	WHERE paquetes.promocion=0";


		$resp = $this->db->consulta($query);
		$cont = $this->db->num_rows($resp);


		$array=array();
		$contador=0;
		if ($cont>0) {

			while ($objeto=$this->db->fetch_object($resp)) {

				$array[$contador]=$objeto;
				$contador++;
			} 
		}
		return $array;
	}


	public function GuardaPaquetevinculado($idpaquetevinculado)
	{
		$sql="INSERT INTO paquetevinculado(idpaquetepromocion,idpaquete,mensaje) VALUES (".$this->idpaquete.",".$idpaquetevinculado.",'".$this->mensajev."')";

		 $this->db->consulta($sql);
	}

	public function Eliminarpaquetevinculado()
	{
		
		$sql = "DELETE FROM paquetevinculado WHERE idpaquetepromocion = ".$this->idpaquete."";
		$resp = $this->db->consulta($sql);
	}

	public function ObtenerVinculados()
	{
		$query="SELECT
		paquetevinculado.idpaquete,
		paquetevinculado.idpaquetepromocion
		FROM paquetevinculado
	WHERE paquetevinculado.idpaquetepromocion='$this->idpaquete'";



		$resp = $this->db->consulta($query);
		$cont = $this->db->num_rows($resp);


		$array=array();
		$contador=0;
		if ($cont>0) {

			while ($objeto=$this->db->fetch_object($resp)) {

				$array[$contador]=$objeto;
				$contador++;
			} 
		}
		return $array;
	}

	
	public function ActualizarOrdenPaquete()
	{
		$query = "UPDATE paquetes SET  
			orden='$this->orden'
			WHERE idpaquete = '$this->idpaquete' ";

			
		$this->db->consulta($query);
	}


	public function Obtenergrupospaquete($value='')
	{
		$query="SELECT
		grupo.idgrupo,
		grupo.nombregrupo,
		grupopaquetes.idpaquete
		FROM
		grupo
		JOIN grupopaquetes
		ON grupopaquetes.idgrupo = grupo.idgrupo WHERE grupopaquetes.idpaquete=".$this->idpaquete."";



		$resp = $this->db->consulta($query);
		$cont = $this->db->num_rows($resp);


		$array=array();
		$contador=0;
		if ($cont>0) {

			while ($objeto=$this->db->fetch_object($resp)) {

				$array[$contador]=$objeto;
				$contador++;
			} 
		}
		return $array;

	}

	public function VisualizarPaquetesCarrusel()
	{
		$query = "UPDATE paquetes SET  
			visualizarcarrusel=1
			WHERE idpaquete = '$this->idpaquete' ";

		$this->db->consulta($query);

		
	}

	public function ActualizarVisualizarCarrusel($estado)
	{
		
		$query = "UPDATE paquetes SET  
			visualizarcarrusel=$estado
			WHERE idcategorias = '$this->idcategoria' ";

		$this->db->consulta($query);

	}

	public function ObtenerSucursalPaquete()
	{
		$query="SELECT * FROM paquetesucursal 
		WHERE 
		paquetesucursal.idpaquete='$this->idpaquete'";

		$resp = $this->db->consulta($query);
		$cont = $this->db->num_rows($resp);


		$array=array();
		$contador=0;
		if ($cont>0) {

			while ($objeto=$this->db->fetch_object($resp)) {

				$array[$contador]=$objeto;
				$contador++;
			} 
		}
		return $array;
	}

	public function GuardarPaqueteSucursal()
	{
		$sql="INSERT INTO paquetesucursal(idpaquete,idsucursal) VALUES ('$this->idpaquete', '$this->idsucursal')";

		$this->db->consulta($sql);

	}

	public function EliminarDeSucursal()
	{
		$sql="DELETE FROM paquetesucursal WHERE idpaquete='$this->idpaquete'";

		$this->db->consulta($sql);

	}


	public function obtenerDependenciaHaciaArriba($subcategoriaId) {

    $consulta = "SELECT idcategoriapaquete, nombre, iddepende FROM categoriapaquete WHERE idcategoriapaquete = '$subcategoriaId'";
		$resultado1=$this->db->consulta($consulta);
    	
    	$subcategoria=$this->db->fetch_assoc($resultado1);

    	//var_dump($subcategoria);die();
   
    $resultado = array(
        'id' => $subcategoria['idcategoriapaquete'],
        'nombre' => $subcategoria['nombre']
    );
    
    $idDependencia = $subcategoria['iddepende'];
   
    if ($idDependencia != null && $idDependencia!='' && $idDependencia!=0) {
        $dependenciaPadre = $this->obtenerDependenciaHaciaArriba($idDependencia, $conexion);
        $resultado['dependencia_padre'] = $dependenciaPadre;
    }
    
    return $resultado;
}


 public function mostrarEstructuraDependencia($dependencia) {
 	
 	    $estructura = $dependencia['nombre'];
    $dependenciaPadre = $dependencia['dependencia_padre'];

    while ($dependenciaPadre) {
        $estructura = $dependenciaPadre['nombre'] . '/' . $estructura;
        $dependenciaPadre = $dependenciaPadre['dependencia_padre'];


    }

    

    return $estructura;

}


  public function ObtenerPaquete2() {
        $query = "
			SELECT
			paquetes.idpaquete,
			paquetes.nombrepaquete,
			paquetes.descripcion,
			paquetes.foto,
			paquetes.estatus,
			categoriapaquete.idcategoriapaquete,
			paquetesucursal.idsucursal,
			paquetes.promocion,
			paquetes.aplicardirecto,
			paquetes.definirfecha,
			paquetes.repetitivo,
			paquetes.fechainicial,
			paquetes.fechafinal,
			paquetes.lunes,
			paquetes.martes,
			paquetes.miercoles,
			paquetes.jueves,
			paquetes.viernes,
			paquetes.sabado,
			paquetes.domingo,
			paquetes.preciofijo,
			paquetes.cantidad,
			paquetes.considerar,
			preciopaquete.precio as precioventa,
			paquetes.horainicialpromo,
			paquetes.horafinalpromo,
			paquetes.intervaloservicio,
			paquetes.servicio

			FROM
			paquetes
			JOIN categoriapaquete
			ON paquetes.idcategoriapaquete = categoriapaquete.idcategoriapaquete
			JOIN paquetesucursal
			ON paquetes.idpaquete = paquetesucursal.idpaquete
			JOIN preciopaquete
			ON paquetes.idpaquete = preciopaquete.idpaquete
			JOIN precio
			ON precio.idprecio = preciopaquete.idprecio WHERE

		 paquetes.idpaquete=" . $this->idpaquete . " GROUP BY idpaquete";
		
        $resp = $this->db->consulta($query);
        $cont = $this->db->num_rows($resp);

        $array    = array();
        $contador = 0;
        if ($cont > 0) {

            while ($objeto = $this->db->fetch_object($resp)) {

                $array[$contador] = $objeto;
                $contador++;
            }
        }
        return $array;

    }


    public function ObtenerPaquetesIntervalos() {
       $sql = "
			SELECT *FROM (SELECT
			paquetes.idpaquete,
			paquetes.nombrepaquete,
			paquetes.descripcion,
			paquetes.foto,
			paquetes.estatus,
			paquetesucursal.idsucursal,
			paquetes.promocion,
			preciopaquete.precio as precioventa,
			precio.principal,
			paquetes.orden,
			paquetes.servicio,
			paquetes.intervaloservicio
			FROM
			paquetes
			JOIN paquetesucursal
			ON paquetes.idpaquete = paquetesucursal.idpaquete
			JOIN preciopaquete
			ON paquetes.idpaquete = preciopaquete.idpaquete
			JOIN precio
			ON precio.idprecio = preciopaquete.idprecio
			WHERE
			paquetesucursal.idsucursal IN('$this->idsucursal') and precio.principal=1 and 	paquetes.estatus=1 AND paquetes.servicio=1
				GROUP BY paquetes.intervaloservicio) AS TABLA ";

		
        $resp = $this->db->consulta($sql);
        $cont = $this->db->num_rows($resp);

        $array    = array();
        $contador = 0;
        if ($cont > 0) {

            while ($objeto = $this->db->fetch_object($resp)) {

                $array[$contador] = $objeto;
                $contador++;
            }
        }
        return $array;
    }



     public function PaquetesCategoriaSuLimite($inicio,$cantidad)
    {
    	  $sql = "
			SELECT *FROM (SELECT
			paquetes.idpaquete,
			paquetes.nombrepaquete,
			paquetes.descripcion,
			paquetes.idcategoriapaquete as iddepende,
			paquetes.foto,
			paquetes.estatus,
			paquetesucursal.idsucursal,
			paquetes.promocion,
			preciopaquete.precio as precioventa,
			precio.principal,
			paquetes.orden,
			paquetes.servicio,
			IFNULL(paquetes.preciofijo,0) AS preciofijo,
			(SELECT COUNT(*)  FROM paquetefavorito WHERE idpaquete=paquetes.idpaquete AND idusuarios='$this->idusuario')as favorito

			FROM
			paquetes
			JOIN paquetesucursal
			ON paquetes.idpaquete = paquetesucursal.idpaquete
			JOIN preciopaquete
			ON paquetes.idpaquete = preciopaquete.idpaquete
			JOIN precio
			ON precio.idprecio = preciopaquete.idprecio
			WHERE
			paquetesucursal.idsucursal=" . $this->idsucursal . "  and precio.principal=1 and 	paquetes.estatus=1 AND paquetes.idcategoriapaquete='$this->idcategoriapaquete' and paquetes.escortesia=0 ORDER BY paquetes.orden DESC
				) AS TABLA ORDER BY TABLA.orden,TABLA.favorito LIMIT $inicio,$cantidad

		";
		
        $resp = $this->db->consulta($sql);
        $cont = $this->db->num_rows($resp);

        $array    = array();
        $contador = 0;
        if ($cont > 0) {

            while ($objeto = $this->db->fetch_object($resp)) {

            	

                $array[$contador] = $objeto;
                $contador++;
            }
        }
        return $array;
    }


    public function ObtenerPaquetesF($valor)
	{
	$query = "SELECT
	paquetes.idpaquete,
	paquetes.nombrepaquete,
	paquetes.descripcion,
	paquetes.foto,
	paquetes.estatus,
	categoriapaquete.idcategoriapaquete,
	categoriapaquete.nombre AS titulo,
	paquetes.promocion,
	preciopaquete.precio as precioventa,
	paquetes.orden,
	paquetes.fechainicial,
	paquetes.fechafinal,
	paquetes.aplicardirecto,
	paquetes.cantidad,
	paquetes.considerar,
	paquetes.definirfecha,
	paquetes.lunes,
	paquetes.martes,
	paquetes.miercoles,
	paquetes.jueves,
	paquetes.viernes,
	paquetes.sabado,
	paquetes.domingo,
	paquetes.repetitivo,
	paquetes.preciofijo,
	paquetes.horainicialpromo,
	paquetes.horafinalpromo,
	paquetes.servicio
FROM
	paquetes
	LEFT JOIN categoriapaquete ON paquetes.idcategoriapaquete = categoriapaquete.idcategoriapaquete 
	
	JOIN paquetesucursal
			ON paquetes.idpaquete = paquetesucursal.idpaquete
			JOIN preciopaquete
			ON paquetes.idpaquete = preciopaquete.idpaquete
			JOIN precio
			ON precio.idprecio = preciopaquete.idprecio
			
			WHERE  1=1 and nombrepaquete like '%".$valor."%'
				and servicio=0

			";
			
		$resp = $this->db->consulta($query);
		$cont = $this->db->num_rows($resp);


		$array=array();
		$contador=0;
		if ($cont>0) {

			while ($objeto=$this->db->fetch_object($resp)) {

				$array[$contador]=$objeto;
				$contador++;
			} 
		}
		return $array;
	}

public function ObtenerDatosPaquete()
	{
	$query = "SELECT
			paquetes.idpaquete,
			paquetes.nombrepaquete,
			paquetes.descripcion,
			paquetes.foto,
			paquetes.estatus,
			paquetes.promocion,
				preciopaquete.precio as precioventa,

			paquetes.orden,
			paquetes.fechainicial,
			paquetes.fechafinal,
			paquetes.aplicardirecto,
			paquetes.cantidad,
			paquetes.considerar,
			paquetes.definirfecha,
			paquetes.lunes,
			paquetes.martes,
			paquetes.miercoles,
			paquetes.jueves,
			paquetes.viernes,
			paquetes.sabado,
			paquetes.domingo,
			paquetes.repetitivo,
			paquetes.preciofijo,
			paquetes.horainicialpromo,
			paquetes.horafinalpromo
			FROM
			paquetes
			JOIN paquetesucursal
			ON paquetes.idpaquete = paquetesucursal.idpaquete
			JOIN preciopaquete
			ON paquetes.idpaquete = preciopaquete.idpaquete
			JOIN precio
			ON precio.idprecio = preciopaquete.idprecio
			
			
			WHERE paquetes.idpaquete='$this->idpaquete'


			";
		
		$resp = $this->db->consulta($query);
		$cont = $this->db->num_rows($resp);


		$array=array();
		$contador=0;
		if ($cont>0) {

			while ($objeto=$this->db->fetch_object($resp)) {

				$array[$contador]=$objeto;
				$contador++;
			} 
		}
		return $array;
	}



  public function ObtenerPaqueteServicio() {
        $query = "
			SELECT
			paquetes.idpaquete,
			paquetes.nombrepaquete,
			paquetes.descripcion,
			paquetes.foto,
			paquetes.estatus,
			categoriapaquete.idcategoriapaquete,
			categoriapaquete.nombre as nombrecat,
			paquetesucursal.idsucursal,
			paquetes.promocion,
			paquetes.aplicardirecto,
			paquetes.definirfecha,
			paquetes.repetitivo,
			paquetes.fechainicial,
			paquetes.fechafinal,
			paquetes.lunes,
			paquetes.martes,
			paquetes.miercoles,
			paquetes.jueves,
			paquetes.viernes,
			paquetes.sabado,
			paquetes.domingo,
			paquetes.preciofijo,
			paquetes.cantidad,
			paquetes.considerar,
			preciopaquete.precio as precioventa,
			paquetes.horainicialpromo,
			paquetes.horafinalpromo,
			paquetes.intervaloservicio,
			paquetes.servicio

			FROM
			paquetes
			JOIN categoriapaquete
			ON paquetes.idcategoriapaquete = categoriapaquete.idcategoriapaquete
			JOIN paquetesucursal
			ON paquetes.idpaquete = paquetesucursal.idpaquete
			JOIN preciopaquete
			ON paquetes.idpaquete = preciopaquete.idpaquete
			JOIN precio
			ON precio.idprecio = preciopaquete.idprecio WHERE paquetes.estatus=1 GROUP BY idpaquete";
		
        $resp = $this->db->consulta($query);
        $cont = $this->db->num_rows($resp);

        $array    = array();
        $contador = 0;
        if ($cont > 0) {

            while ($objeto = $this->db->fetch_object($resp)) {

                $array[$contador] = $objeto;
                $contador++;
            }
        }
        return $array;

    }




  public function ObtenerPaquetes() {
        $query = "
			SELECT
			paquetes.idpaquete,
			paquetes.nombrepaquete,
			paquetes.descripcion,
			paquetes.foto,
			paquetes.estatus,
			categoriapaquete.idcategoriapaquete,
			paquetesucursal.idsucursal,
			paquetes.promocion,
			paquetes.aplicardirecto,
			paquetes.definirfecha,
			paquetes.repetitivo,
			paquetes.fechainicial,
			paquetes.fechafinal,
			paquetes.lunes,
			paquetes.martes,
			paquetes.miercoles,
			paquetes.jueves,
			paquetes.viernes,
			paquetes.sabado,
			paquetes.domingo,
			paquetes.preciofijo,
			paquetes.cantidad,
			paquetes.considerar,
			preciopaquete.precio as precioventa,
			paquetes.horainicialpromo,
			paquetes.horafinalpromo,
			paquetes.intervaloservicio,
			paquetes.servicio

			FROM
			paquetes
			JOIN categoriapaquete
			ON paquetes.idcategoriapaquete = categoriapaquete.idcategoriapaquete
			JOIN paquetesucursal
			ON paquetes.idpaquete = paquetesucursal.idpaquete
			JOIN preciopaquete
			ON paquetes.idpaquete = preciopaquete.idpaquete
			JOIN precio
			ON precio.idprecio = preciopaquete.idprecio WHERE paquetes.estatus=1 GROUP BY idpaquete";
		
        $resp = $this->db->consulta($query);
        $cont = $this->db->num_rows($resp);

        $array    = array();
        $contador = 0;
        if ($cont > 0) {

            while ($objeto = $this->db->fetch_object($resp)) {

                $array[$contador] = $objeto;
                $contador++;
            }
        }
        return $array;

    }

    public function ObtenerPaquetesCortesia($value='')
    {
    	$query = "
			
			SELECT
			paquetes.idpaquete,
			paquetes.nombrepaquete,
			paquetes.descripcion,
			paquetes.foto,
			paquetes.estatus,
			categoriapaquete.idcategoriapaquete,
			paquetesucursal.idsucursal,
			paquetes.promocion,
			paquetes.aplicardirecto,
			paquetes.definirfecha,
			paquetes.repetitivo,
			paquetes.fechainicial,
			paquetes.fechafinal,
			paquetes.lunes,
			paquetes.martes,
			paquetes.miercoles,
			paquetes.jueves,
			paquetes.viernes,
			paquetes.sabado,
			paquetes.domingo,
			paquetes.preciofijo,
			paquetes.cantidad,
			paquetes.considerar,
			paquetes.horainicialpromo,
			paquetes.horafinalpromo,
			paquetes.intervaloservicio,
			paquetes.servicio

			FROM
			paquetes
			LEFT JOIN categoriapaquete
			ON paquetes.idcategoriapaquete = categoriapaquete.idcategoriapaquete 
			LEFT JOIN paquetesucursal
			ON paquetes.idpaquete=paquetesucursal.idpaquete

			WHERE paquetes.estatus=1 AND escortesia=1 AND paquetesucursal.idsucursal='$this->idsucursal'";

		
        $resp = $this->db->consulta($query);
        $cont = $this->db->num_rows($resp);

        $array    = array();
        $contador = 0;
        if ($cont > 0) {

            while ($objeto = $this->db->fetch_object($resp)) {

                $array[$contador] = $objeto;
                $contador++;
            }
        }
        return $array;
    }

     public function ObtenerCortesias()
    {
    	$sql="SELECT *FROM cortesia
    	left JOIN paquetes ON paquetes.idpaquete=cortesia.idpaquetecortesia
    	 WHERE cortesia.idpaquete='$this->idpaquete' ";
    	
        $resp = $this->db->consulta($sql);
        $cont = $this->db->num_rows($resp);

        $array    = array();
        $contador = 0;
        if ($cont > 0) {

            while ($objeto = $this->db->fetch_object($resp)) {

                $array[$contador] = $objeto;
                $contador++;
            }
        }
        return $array;
    }


    public function ObtenerPaqueteCortesia()
	{
		$query="SELECT *FROM paquetes WHERE idpaquete=".$this->idpaquete."";

		 $resp = $this->db->consulta($query);
        $cont = $this->db->num_rows($resp);

        $array    = array();
        $contador = 0;
        if ($cont > 0) {

            while ($objeto = $this->db->fetch_object($resp)) {

                $array[$contador] = $objeto;
                $contador++;
            }
        }
        return $array;

	}

	public function PaquetesCategodiaid()
	{
		$sql = "
			SELECT *FROM (SELECT
			paquetes.idpaquete,
			paquetes.nombrepaquete,
			paquetes.descripcion,
			paquetes.idcategoriapaquete as iddepende,
			paquetes.foto,
			paquetes.estatus,
			paquetesucursal.idsucursal,
			paquetes.promocion,
			preciopaquete.precio as precioventa,
			precio.principal,
			paquetes.orden,
			paquetes.servicio,
			IFNULL(paquetes.preciofijo,0) AS preciofijo
			

			FROM
			paquetes
			JOIN paquetesucursal
			ON paquetes.idpaquete = paquetesucursal.idpaquete
			JOIN preciopaquete
			ON paquetes.idpaquete = preciopaquete.idpaquete
			JOIN precio
			ON precio.idprecio = preciopaquete.idprecio
			WHERE
			paquetesucursal.idsucursal=".$this->idsucursal."  and precio.principal=1 and 	paquetes.estatus=1 AND 
			paquetes.idcategoriapaquete='".$this->idcategoriapaquete."' and paquetes.escortesia=0 ORDER BY paquetes.orden DESC
				) AS TABLA ORDER BY TABLA.orden
		";
		
        $resp = $this->db->consulta($sql);
        $cont = $this->db->num_rows($resp);

        $array    = array();
        $contador = 0;
        if ($cont > 0) {

            while ($objeto = $this->db->fetch_object($resp)) {

            	

                $array[$contador] = $objeto;
                $contador++;
            }
        }
        return $array;
	}



	function obtenerSubcategorias($categoriaID) {
    $sql = "SELECT idcategoriapaquete FROM categoriapaquete WHERE iddepende = $categoriaID AND estatus=1";
 	
    $result = $this->db->consulta($sql);
    $subcategorias = [];

    if ($this->db->num_rows($result) > 0) {
        while ($row = $this->db->fetch_assoc($result )) {
        	
            $this->arraysub[] = $row['idcategoriapaquete'];
            // Llamada recursiva para obtener las subcategorías de las subcategorías actuales

            $subcategorias = array_merge($this->arraysub,$this->obtenerSubcategorias($row['idcategoriapaquete']));



        }


    }

   
    return $subcategorias;
	}


	public function GuardarCortesia()
	{
		$sql="INSERT INTO cortesia( idpaquete, idpaquetecortesia) VALUES ('$this->idpaquete', '$this->idcortesia')";

		$resp = $this->db->consulta($sql);


	}


	public function ObtenerCortesiaPaquete()
	{
		$sql="SELECT *FROM cortesia 
		WHERE idpaquete=$this->idpaquete";

		 $resp = $this->db->consulta($sql);
        $cont = $this->db->num_rows($resp);

        $array    = array();
        $contador = 0;
        if ($cont > 0) {

            while ($objeto = $this->db->fetch_object($resp)) {

            	

                $array[$contador] = $objeto;
                $contador++;
            }
        }
        return $array;

	}

	public function EliminarCortesias()
	{
		$sql="DELETE FROM cortesia 
		WHERE idpaquete=$this->idpaquete";

		 $resp = $this->db->consulta($sql);
	}

	
}
?>