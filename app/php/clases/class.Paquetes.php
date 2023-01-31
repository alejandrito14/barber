<?php
class Paquetes {
    public $db;
    public $idpaquete;

    public $nombre;
    public $descripcion;
    public $precio;
    public $descuento;

    public $estatus;
    public $precionormal;
    public $precioventa;
    public $lista_empresa;
    public $tipo_usuario;
    public $idcategoria;

    public $idgrupo;
    public $idgrupopaquete;
    public $idsucursal;

    public $conpromo;
    public $confecha;
    public $directo;
    public $fechainicial;
    public $fechafinal;
    public $cantidadcobrar;
    public $cantidadaconsiderar;
    public $horainicio;
    public $horafin;

    public function obtenerFiltro() {
        $query  = "SELECT *from paquetes ";
        $result = $this->db->consulta($query);
        return $result;
    }

    public function GuardarPaquete() {
        $query = "INSERT INTO paquetes (nombrepaquete,descripcion,estatus,precionormal,precioventa,idcategorias,promocion,definirfecha,fechainicial,fechafinal,cantidadcobrar,cantidadaconsiderar,horainicialpromo,horafinalpromo) VALUES ('$this->nombre','$this->descripcion','$this->estatus','$this->precionormal','$this->precioventa','$this->idcategoria','$this->conpromo','$this->confecha','$this->fechainicial','$this->fechafinal','$this->cantidadcobrar','$this->cantidadaconsiderar','$this->horainicio','$this->horafin');";

        $this->db->consulta($query);
        $this->idpaquete = $this->db->id_ultimo();
    }

    //Funcion que sirve para modifcar un producto
    public function modificarPaquete() {
        $query = "UPDATE paquetes SET
		 	nombrepaquete = '$this->nombre',
		 	descripcion = '$this->descripcion',
			precionormal = '$this->precionormal',
			precioventa = '$this->precioventa',
			idcategorias = '$this->idcategoria',
			estatus = '$this->estatus',
			promocion='$this->conpromo',
			definirfecha='$this->confecha',
			fechainicial='$this->fechainicial',
			fechafinal='$this->fechafinal',
			cantidadcobrar='$this->cantidadaconsiderar',
			cantidadaconsiderar='$this->cantidadaconsiderar'
			 WHERE idpaquete = '$this->idpaquete' ";

        $this->db->consulta($query);
    }

    public function ObtenerPaquete() {
        $query = "
			SELECT
			paquetes.idpaquete,
			paquetes.nombrepaquete,
			paquetes.descripcion,
			paquetes.foto,
			paquetes.estatus,
			categorias.idcategorias,
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
			paquetes.activarcomentario,
			paquetes.mensaje,
			paquetes.siniva,
			paquetes.iva

			FROM
			paquetes
			JOIN categorias
			ON paquetes.idcategorias = categorias.idcategorias
			JOIN paquetesucursal
			ON paquetes.idpaquete = paquetesucursal.idpaquete
			JOIN preciopaquete
			ON paquetes.idpaquete = preciopaquete.idpaquete
			JOIN precio
			ON precio.idprecio = preciopaquete.idprecio WHERE

		 paquetes.idpaquete=" . $this->idpaquete . " GROUP BY idpaquete";

        $result = $this->db->consulta($query);

        return $result;

    }

    public function ObtPaqueteOpciones() {
        $sql = "SELECT
				grupopaquetes.idgrupopaquetes,
				grupopaquetes.idgrupo,
				grupopaquetes.idpaquete,
				grupo.nombregrupo,
				grupo.descripcion,
				grupo.sincoprecio,
				grupo.multiple,
				grupo.tope,
				grupopaquetes.topesecundario,
				grupo.obligatorio
				FROM
				grupopaquetes
				JOIN grupo
				ON grupopaquetes.idgrupo = grupo.idgrupo WHERE idpaquete = " . $this->idpaquete . "";
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

    public function EliminarPaquetesProductos($value = '') {
        $sql = "DELETE FROM paquetesproducto WHERE idpaquete = " . $this->idpaquete . "";

        $resp = $this->db->consulta($sql);

    }

    public function EliminarComplementos($value = '') {

        $sql  = "DELETE FROM grupopaquetes WHERE idpaquete = " . $this->idpaquete . "";
        $resp = $this->db->consulta($sql);

    }

  

    public function PaquetesCategoria() {
        $sql = "
			SELECT
			paquetes.idpaquete,
			paquetes.nombrepaquete,
			paquetes.descripcion,
			paquetes.foto,
			paquetes.estatus,
			paquetesucursal.idsucursal,
			paquetes.promocion,
			preciopaquete.precio as precioventa,
			precio.principal,
			paquetes.orden
			FROM
			paquetes
			JOIN paquetesucursal
			ON paquetes.idpaquete = paquetesucursal.idpaquete
			JOIN preciopaquete
			ON paquetes.idpaquete = preciopaquete.idpaquete
			JOIN precio
			ON precio.idprecio = preciopaquete.idprecio
			WHERE
			paquetesucursal.idsucursal=" . $this->idsucursal . " and paquetes.promocion=0 and precio.principal=1 and 	paquetes.estatus=1
				ORDER BY orden ASC

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

    public function ObtOpciones() {
        $sql = "SELECT
			grupoopcion.opcion,
			grupoopcion.costo,
			grupoopcion.idgrupoopcion,
			grupoopcion.idgrupo,
			grupo.multiple,
			grupo.sincoprecio,
			grupo.tope,
			grupopaquetes.idgrupopaquetes,
			grupopaquetes.topesecundario,
			grupo.obligatorio

			FROM
			grupo
			left JOIN grupoopcion
			ON grupo.idgrupo = grupoopcion.idgrupo
			INNER JOIN grupopaquetes ON grupopaquetes.idgrupo=grupoopcion.idgrupo WHERE grupoopcion.idgrupo= " . $this->idgrupo . " AND grupopaquetes.idpaquete= " . $this->idpaquete . " AND idgrupopaquetes=" . $this->idgrupopaquete . "  GROUP BY idgrupoopcion,idgrupopaquetes,idgrupo";

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

    public function obtenerPromocionPaquetes() {
        $sql = "

			SELECT
			paquetes.idpaquete,
			paquetes.nombrepaquete,
			paquetes.descripcion,
			paquetes.foto,
			paquetes.estatus,
			categorias.idcategorias,
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
			paquetes.estatus,
			paquetes.horainicialpromo,
			paquetes.horafinalpromo,
			paquetes.orden
			FROM
			paquetes
			JOIN categorias
			ON paquetes.idcategorias = categorias.idcategorias
			JOIN paquetesucursal
			ON paquetes.idpaquete = paquetesucursal.idpaquete
			JOIN preciopaquete
			ON paquetes.idpaquete = preciopaquete.idpaquete
			JOIN precio
			ON precio.idprecio = preciopaquete.idprecio
			WHERE
			paquetesucursal.idsucursal=" . $this->idsucursal . " and paquetes.promocion=1 and precio.principal=1 and paquetes.estatus=1 ORDER BY orden ASC ";

        $resp = $this->db->consulta($sql);
        $cont = $this->db->num_rows($resp);

        $array    = array();
        $contador = 0;
        if ($cont > 0) {

            while ($objeto = $this->db->fetch_object($resp)) {

                $agregar          = 0;
                $date             = date('Y-m-d H:i:s');
                $horaactual       = date('H:i');
                $horainicialpromo = "";
                $horafinalpromo   = "";

                //if ($objeto->horainicialpromo!='') {
                $horainicialpromo = date('H:i', strtotime($objeto->horainicialpromo));
                $horafinalpromo   = date('H:i', strtotime($objeto->horafinalpromo));
                //}

                /*echo $objeto->horainicialpromo.'-'.$objeto->horafinalpromo.'<br>';*/
/*                    echo $horainicialpromo.'-'.$horafinalpromo.'<br>';
 */

                if ($objeto->definirfecha == 1) {

                    $fechainicial = $objeto->fechainicial;
                    $fechafinal   = $objeto->fechafinal;

                    $fechainicial = date('Y-m-d', strtotime($fechainicial));

                    $fechafinal = date('Y-m-d', strtotime($fechafinal));

                    $fechaactual = date('Y-m-d');

                    if ($fechaactual >= $fechainicial && $fechaactual <= $fechafinal) {

                        $agregar = 1;
                    }

                }

                if ($objeto->aplicardirecto == 1) {

                    $agregar = 1;

                }

                if ($objeto->repetitivo == 1) {

                    $diaSemana = date('w');

                    $lunes     = 1;
                    $martes    = 2;
                    $miercoles = 3;
                    $jueves    = 4;
                    $viernes   = 5;
                    $sabado    = 6;
                    $domingo   = 0;

                    if ($objeto->lunes == 1 && $lunes == $diaSemana) {

                        $agregar = 1;

                    }

                    if ($objeto->martes == 1 && $martes == $diaSemana) {
                        $agregar = 1;
                    }

                    if ($objeto->miercoles == 1 && $miercoles == $diaSemana) {
                        $agregar = 1;
                    }
                    if ($objeto->jueves == 1 && $jueves == $diaSemana) {
                        $agregar = 1;
                    }
                    if ($objeto->viernes == 1 && $viernes == $diaSemana) {
                        $agregar = 1;
                    }
                    if ($objeto->sabado == 1 && $sabado == $diaSemana) {
                        $agregar = 1;
                    }
                    if ($objeto->domingo == 1 && $domingo == $diaSemana) {

                        $agregar = 1;
                    }

                }

/*                    var_dump($objeto->horainicialpromo);
 */

                if ($agregar == 1) {

                    /*echo 'validando: '.$horaactual.'|'.$horainicialpromo.'|'.$horafinalpromo.$agregar.'<br>';*/

                    if ($objeto->horainicialpromo != '' && $objeto->horainicialpromo != '00:00' && $objeto->horafinalpromo != '' && $objeto->horafinalpromo != '00:00') {

                        /*echo '-'.$horaactual.''.$horainicialpromo.'-'.$horafinalpromo.'<br>';*/

                        if ($horaactual >= $horainicialpromo && $horaactual <= $horafinalpromo) {

                            $agregar = 1;

                        } else {

                            $agregar = 0;
                        }

                    }

                }

                if ($agregar == 1) {

                    $array[$contador] = $objeto;
                    $contador++;
                }

            }
        }
        return $array;
    }

    public function obtenerPromocionTodasPaquetes() {
        $sql = "

			SELECT
			paquetes.idpaquete,
			paquetes.nombrepaquete,
			paquetes.descripcion,
			paquetes.foto,
			paquetes.estatus,
			categorias.idcategorias,
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
			paquetes.orden
			FROM
			paquetes
			JOIN categorias
			ON paquetes.idcategorias = categorias.idcategorias
			JOIN paquetesucursal
			ON paquetes.idpaquete = paquetesucursal.idpaquete
			JOIN preciopaquete
			ON paquetes.idpaquete = preciopaquete.idpaquete
			JOIN precio
			ON precio.idprecio = preciopaquete.idprecio
			WHERE
			paquetesucursal.idsucursal=" . $this->idsucursal . " and paquetes.promocion=1 and precio.principal=1 and	paquetes.estatus=1 ORDER BY orden ASC";

        $resp = $this->db->consulta($sql);
        $cont = $this->db->num_rows($resp);

        $array    = array();
        $contador = 0;
        if ($cont > 0) {

            while ($objeto = $this->db->fetch_object($resp)) {

                $agregar = 0;

                $array[$contador] = $objeto;
                $contador++;

            }
        }
        return $array;
    }

    public function Obtenerproductodepaquete() {

        $query = "SELECT
		paquetesproducto.idproducto,
		paquetesproducto.cantidad,
		paquetesproducto.idpaquete,
		productos.codigoproducto,
		productos.nombre

		FROM
		paquetesproducto
		JOIN productos
		ON paquetesproducto.idproducto = productos.idproducto WHERE paquetesproducto.idpaquete=" . $this->idpaquete . "";

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

    public function Obtenerdetalledegrupoopcion($idgrupoopcion) {
        $query = "SELECT
				grupoopcion.idgrupoopcion,
				grupoopcion.costo,
				grupoopcion.opcion,
				grupo.multiple,
				grupo.sincoprecio
				FROM
				grupoopcion
				JOIN grupo
				ON grupoopcion.idgrupo = grupo.idgrupo
				WHERE idgrupoopcion=" . $idgrupoopcion . "";

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

    public function ObtenerPaquete2() {
        $query = "
			SELECT
			paquetes.idpaquete,
			paquetes.nombrepaquete,
			paquetes.descripcion,
			paquetes.foto,
			paquetes.estatus,
			categorias.idcategorias,
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
			paquetes.horafinalpromo

			FROM
			paquetes
			JOIN categorias
			ON paquetes.idcategorias = categorias.idcategorias
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

    public function ObtImagenesPaquete() {
        $sql = "SELECT *FROM
				paquetesimagenes WHERE idpaquete = " . $this->idpaquete . "";

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

    public function ObtenerPaquetesVinculados() {
        $sql = "SELECT  GROUP_CONCAT(idpaquetepromocion) as idpaquetes,mensaje FROM
				paquetevinculado WHERE idpaquete = " . $this->idpaquete . "";

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

    public function ValidarPromocionvigente($idpaquetes) {

        $sql = "

			SELECT
			paquetes.idpaquete,
			paquetes.nombrepaquete,
			paquetes.descripcion,
			paquetes.foto,
			paquetes.estatus,
			categorias.idcategorias,
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
			paquetes.estatus,
			paquetes.horainicialpromo,
			paquetes.horafinalpromo,
			paquetes.orden
			FROM
			paquetes
			JOIN categorias
			ON paquetes.idcategorias = categorias.idcategorias
			JOIN paquetesucursal
			ON paquetes.idpaquete = paquetesucursal.idpaquete
			JOIN preciopaquete
			ON paquetes.idpaquete = preciopaquete.idpaquete
			JOIN precio
			ON precio.idprecio = preciopaquete.idprecio
			WHERE
			paquetesucursal.idsucursal=" . $this->idsucursal . " and paquetes.promocion=1 and precio.principal=1 and paquetes.estatus=1 AND paquetes.idpaquete IN(" . $idpaquetes . ") ORDER BY orden ASC ";

        $resp = $this->db->consulta($sql);
        $cont = $this->db->num_rows($resp);

        $array    = array();
        $contador = 0;
        if ($cont > 0) {

            while ($objeto = $this->db->fetch_object($resp)) {

                $agregar          = 0;
                $date             = date('Y-m-d H:i:s');
                $horaactual       = date('H:i');
                $horainicialpromo = "";
                $horafinalpromo   = "";

                //if ($objeto->horainicialpromo!='') {
                $horainicialpromo = date('H:i', strtotime($objeto->horainicialpromo));
                $horafinalpromo   = date('H:i', strtotime($objeto->horafinalpromo));
                //}

                /*echo $objeto->horainicialpromo.'-'.$objeto->horafinalpromo.'<br>';*/
/*                    echo $horainicialpromo.'-'.$horafinalpromo.'<br>';
 */

                if ($objeto->definirfecha == 1) {

                    $fechainicial = $objeto->fechainicial;
                    $fechafinal   = $objeto->fechafinal;

                    $fechainicial = date('Y-m-d', strtotime($fechainicial));

                    $fechafinal = date('Y-m-d', strtotime($fechafinal));

                    $fechaactual = date('Y-m-d');

                    if ($fechainicial >= $fechaactual && $fechaactual <= $fechafinal) {

                        $agregar = 1;
                    }

                }

                if ($objeto->aplicardirecto == 1) {

                    $agregar = 1;

                }

                if ($objeto->repetitivo == 1) {

                    $diaSemana = date('w');

                    $lunes     = 1;
                    $martes    = 2;
                    $miercoles = 3;
                    $jueves    = 4;
                    $viernes   = 5;
                    $sabado    = 6;
                    $domingo   = 0;

                    if ($objeto->lunes == 1 && $lunes == $diaSemana) {

                        $agregar = 1;

                    }

                    if ($objeto->martes == 1 && $martes == $diaSemana) {
                        $agregar = 1;
                    }

                    if ($objeto->miercoles == 1 && $miercoles == $diaSemana) {
                        $agregar = 1;
                    }
                    if ($objeto->jueves == 1 && $jueves == $diaSemana) {
                        $agregar = 1;
                    }
                    if ($objeto->viernes == 1 && $viernes == $diaSemana) {
                        $agregar = 1;
                    }
                    if ($objeto->sabado == 1 && $sabado == $diaSemana) {
                        $agregar = 1;
                    }
                    if ($objeto->domingo == 1 && $domingo == $diaSemana) {

                        $agregar = 1;
                    }

                }

/*                    var_dump($objeto->horainicialpromo);
 */

                if ($agregar == 1) {

                    /*echo 'validando: '.$horaactual.'|'.$horainicialpromo.'|'.$horafinalpromo.$agregar.'<br>';*/

                    if ($objeto->horainicialpromo != '' && $objeto->horainicialpromo != '00:00' && $objeto->horafinalpromo != '' && $objeto->horafinalpromo != '00:00') {

                        /*echo '-'.$horaactual.''.$horainicialpromo.'-'.$horafinalpromo.'<br>';*/

                        if ($horaactual >= $horainicialpromo && $horaactual <= $horafinalpromo) {

                            $agregar = 1;

                        } else {

                            $agregar = 0;
                        }

                    }

                }

                if ($agregar == 1) {

                    $array[$contador] = $objeto;
                    $contador++;
                }

            }
        }
        return $array;
    }

    public function ObtenerPaqueteInformacion() {
        $query = "
			SELECT
			paquetes.idpaquete,
			paquetes.nombrepaquete,
			paquetes.descripcion,
			paquetes.foto,
			paquetes.estatus,
			categorias.idcategorias,
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
			paquetes.activarcomentario,
			paquetes.mensaje,
			paquetes.siniva,
			paquetes.iva

			FROM
			paquetes
			JOIN categorias
			ON paquetes.idcategorias = categorias.idcategorias
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

    public function CalcularIva($precio, $ivadelpaquete) {
        $dividir   = ($ivadelpaquete / 100) + 1;
        $precioiva = $precio / $dividir;
        $precioti  = $precio - $precioiva;

        $precioi    = $precio - $precioti;
        $preciotiva = $precioi + $precioti;

        return $precioti;

    }

      public function ObtenerTotalPaquetes()
    {
    	 $sql = "
			SELECT
			paquetes.idpaquete,
			paquetes.nombrepaquete,
			paquetes.descripcion,
			paquetes.foto,
			paquetes.estatus,
			categorias.idcategorias,
			paquetesucursal.idsucursal,
			paquetes.promocion,
			preciopaquete.precio as precioventa,
			precio.principal,
			paquetes.orden,
			paquetes.visualizarcarrusel
			FROM
			paquetes
			JOIN categorias
			ON paquetes.idcategorias = categorias.idcategorias
			JOIN paquetesucursal
			ON paquetes.idpaquete = paquetesucursal.idpaquete
			JOIN preciopaquete
			ON paquetes.idpaquete = preciopaquete.idpaquete
			JOIN precio
			ON precio.idprecio = preciopaquete.idprecio
			WHERE
			categorias.idcategorias=" . $this->idcategoria . " AND paquetesucursal.idsucursal=" . $this->idsucursal . " and paquetes.promocion=0 and precio.principal=1 and 	paquetes.estatus=1 and paquetes.visualizarcarrusel=1
				ORDER BY orden ASC

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


     public function PaquetesCategoria2() {
        $sql = "
			SELECT
			paquetes.idpaquete,
			paquetes.nombrepaquete,
			paquetes.descripcion,
			paquetes.foto,
			paquetes.estatus,
			categorias.idcategorias,
			paquetesucursal.idsucursal,
			paquetes.promocion,
			preciopaquete.precio as precioventa,
			precio.principal,
			paquetes.orden
			FROM
			paquetes
			JOIN categorias
			ON paquetes.idcategorias = categorias.idcategorias
			JOIN paquetesucursal
			ON paquetes.idpaquete = paquetesucursal.idpaquete
			JOIN preciopaquete
			ON paquetes.idpaquete = preciopaquete.idpaquete
			JOIN precio
			ON precio.idprecio = preciopaquete.idprecio
			WHERE
			categorias.idcategorias=" . $this->idcategoria . " AND paquetesucursal.idsucursal=" . $this->idsucursal . " and paquetes.promocion=0 and precio.principal=1 and 	paquetes.estatus=1 
				ORDER BY orden ASC LIMIT 15

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


     public function PaquetesCategoria3() {
        $sql = "
			SELECT
			paquetes.idpaquete,
			paquetes.nombrepaquete,
			paquetes.descripcion,
			paquetes.foto,
			paquetes.estatus,
			categorias.idcategorias,
			paquetesucursal.idsucursal,
			paquetes.promocion,
			preciopaquete.precio as precioventa,
			precio.principal,
			paquetes.orden,
			paquetes.visualizarcarrusel
			FROM
			paquetes
			JOIN categorias
			ON paquetes.idcategorias = categorias.idcategorias
			JOIN paquetesucursal
			ON paquetes.idpaquete = paquetesucursal.idpaquete
			JOIN preciopaquete
			ON paquetes.idpaquete = preciopaquete.idpaquete
			JOIN precio
			ON precio.idprecio = preciopaquete.idprecio
			WHERE
			categorias.idcategorias=" . $this->idcategoria . " AND paquetesucursal.idsucursal=" . $this->idsucursal . " and paquetes.promocion=0 and precio.principal=1 and 	paquetes.estatus=1 AND paquetes.visualizarcarrusel=1
				ORDER BY orden ASC

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

}
?>