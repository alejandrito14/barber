<?php
//require_once dirname(__FILE__)."/qr/qrlib.php";
require_once("qr/qrlib.php");

/**
   * PHP crea clase de código QR
 * Date:    2018-03-18
 * Author:  fdipzone
 * Version: 1.0
 *
 * Description:
   * PHP realiza la creación de clases de códigos QR, admite la configuración del tamaño, agrega LOGO, esquinas redondeadas, transparencia y otros procesos.
 *
 * Func:
   * configuración pública set_config set
   * generar público para crear un código QR
   * create_qrcode privado crea una imagen de código QR puro
   * add_logo privado combina imágenes de códigos QR puros e imágenes de logotipos
   * Objeto de imagen privado image_outline para trazo
   * Objeto de imagen privado image_fillet para procesamiento de esquinas redondeadas
   * imagen privadacopymerge_alpha fusiona imágenes y conserva su transparencia
   * create_dirs privados crean directorios
   * color hexadecimal hex2rgb privado a color rgb
   * get_file_ext privado para obtener el tipo de imagen
 */
class Qr{ // class start

    /** Configuración predeterminada */
    private $_config = array(
        'ecc' => 'H',                       // Calidad del código QR L-menor, M, Q, H-mejor
        'size' => 15,                       // Tamaño del código QR 1-50
        'dest_file' => 'qrcode.png',        // Ruta de código QR creada
        'quality' => 100,                    // Calidad de imagen
        'logo' => '',                       // Ruta del logotipo, vacío significa que no hay logotipo
        'logo_size' => null,                // tamaño del logotipo, nulo significa que se calcula automáticamente de acuerdo con el tamaño del código QR
        'logo_outline_size' => null,        // Tamaño del trazo del logotipo, nulo significa que se calculará automáticamente de acuerdo con el tamaño del logotipo
        'logo_outline_color' => '#FFFFFF',  // color del trazo del logo
        'logo_opacity' => 100,              // opacidad del logo 0-100
        'logo_radius' => 0,                 // ángulo de empalme del logo 0-30
    );

    /**
           * Configuración de ajuste
     * @param    Contenido de configuración de Array $ config
     */
    public function set_config($config){

        // Permitir configurar la configuración
        $config_keys = array_keys($this->_config);

        // Obtenga la configuración entrante y escriba la configuración
        foreach($config_keys as $k=>$v){
            if(isset($config[$v])){
                $this->_config[$v] = $config[$v];
            }
        }

    }

    /**
           * Crea un código QR
     * @param    Contenido del código QR String $ data
     * @return String
     */
    public function generate($data){
        try {

             // Crea una imagen de código QR temporal
        $tmp_qrcode_file = $this->create_qrcode($data);
       // var_dump($tmp_qrcode_file);die();
        // Combinar la imagen del código QR temporal y la imagen del logotipo
        $this->add_logo($tmp_qrcode_file);

    
        // Eliminar la imagen del código QR temporal
        if($tmp_qrcode_file!='' && file_exists($tmp_qrcode_file)){
            unlink($tmp_qrcode_file);
        }

        return file_exists($this->_config['dest_file'])? $this->_config['dest_file'] : '';

            
        } catch (Exception $e) {
             print_r($e);   
        }
       
    }

    /**
           * Crea una imagen de código QR temporal
     * @param    Contenido del código QR String $ data
     * @return String
     */
    private function create_qrcode($data){

        // Imagen de código QR temporal
        $tmp_qrcode_file = dirname(__FILE__).'/tmp_qrcode_'.time().mt_rand(100,999).'.png';

        // Crea un código QR temporal
        QRcode::png($data, $tmp_qrcode_file, $this->_config['ecc'], $this->_config['size'], 2);

        // Regresar a la ruta temporal del código QR
        return file_exists($tmp_qrcode_file)? $tmp_qrcode_file : '';

    }

    /**
           * Combinar imágenes de códigos QR temporales e imágenes de logotipos
     * @param  String $ tmp_qrcode_file Imagen de código QR temporal
     */
    private function add_logo($tmp_qrcode_file){

        // Crear carpeta de destino
        $this->create_dirs(dirname($this->_config['dest_file']));

        // Obtener el tipo de imagen de destino
        $dest_ext = $this->get_file_ext($this->_config['dest_file']);
      
        // Necesito agregar logo
        if(file_exists($this->_config['logo'])){

            // Crear objeto de imagen de código QR temporal
            $tmp_qrcode_img = imagecreatefrompng($tmp_qrcode_file);

           
            // Obtener el tamaño de la imagen del código QR temporal
            list($qrcode_w, $qrcode_h, $qrcode_type) = getimagesize($tmp_qrcode_file);

            // Obtener el tamaño y el tipo de la imagen del logotipo
            list($logo_w, $logo_h, $logo_type) = getimagesize($this->_config['logo']);

            // Crea un objeto de imagen de logo
            switch($logo_type){  
                case 1: $logo_img = imagecreatefromgif($this->_config['logo']); break;  
                case 2: $logo_img = imagecreatefromjpeg($this->_config['logo']); break;  
                case 3: $logo_img = imagecreatefrompng($this->_config['logo']); break;  
                default: return '';  
            }

            // Establezca el tamaño combinado de la imagen del logotipo, si no se establece, se calculará automáticamente de acuerdo con la proporción
            $new_logo_w = isset($this->_config['logo_size'])? $this->_config['logo_size'] : (int)($qrcode_w/5);
            $new_logo_h = isset($this->_config['logo_size'])? $this->_config['logo_size'] : (int)($qrcode_h/5);

            // Ajusta la imagen del logo según el tamaño establecido
            $new_logo_img = imagecreatetruecolor($new_logo_w, $new_logo_h);
            imagecopyresampled($new_logo_img, $logo_img, 0, 0, 0, 0, $new_logo_w, $new_logo_h, $logo_w, $logo_h);

            // Determinar si se necesita un golpe
            if(!isset($this->_config['logo_outline_size']) || $this->_config['logo_outline_size']>0){
                list($new_logo_img, $new_logo_w, $new_logo_h) = $this->image_outline($new_logo_img);
            }

            // Determine si se necesitan esquinas redondeadas
            if($this->_config['logo_radius']>0){
                $new_logo_img = $this->image_fillet($new_logo_img);
            }

            // Combinar logotipo y código QR temporal
            $pos_x = ($qrcode_w-$new_logo_w)/2;
            $pos_y = ($qrcode_h-$new_logo_h)/2;

            imagealphablending($tmp_qrcode_img, true);

            // Combinar las imágenes y mantener su transparencia
            $dest_img = $this->imagecopymerge_alpha($tmp_qrcode_img, $new_logo_img, $pos_x, $pos_y, 0, 0, $new_logo_w, $new_logo_h, $this->_config['logo_opacity']);

            // Generar imagen
            switch($dest_ext){
                case 1: imagegif($dest_img, $this->_config['dest_file'], $this->_config['quality']); break;
                case 2: imagejpeg($dest_img, $this->_config['dest_file'], $this->_config['quality']); break;
                case 3: imagepng($dest_img, $this->_config['dest_file'], (int)(($this->_config['quality']-1)/10)); break;
            } 

        // No es necesario agregar logo
        }else{

            $dest_img = imagecreatefrompng($tmp_qrcode_file);
            // Generar imagen
            switch($dest_ext){
                case 1: imagegif($dest_img, $this->_config['dest_file'], $this->_config['quality']); break;
                case 2: imagejpeg($dest_img, $this->_config['dest_file'], $this->_config['quality']); break;
                case 3: 
               $res= imagepng($dest_img, $this->_config['dest_file'], (int)(($this->_config['quality']-1)/10));
             

                 break;
            }
        }

    }

    /**
    * Acaricia el objeto de la imagen
     * @param    Objeto de imagen Obj $ img
     * @return Array
     */
    private function image_outline($img){

        // Obtener ancho y alto de la imagen
        $img_w = imagesx($img);
        $img_h = imagesy($img);

        // Calcula el tamaño del trazo, si no está configurado, se calculará automáticamente de acuerdo con la proporción
        $bg_w = isset($this->_config['logo_outline_size'])? intval($img_w + $this->_config['logo_outline_size']) : $img_w + (int)($img_w/5);
        $bg_h = isset($this->_config['logo_outline_size'])? intval($img_h + $this->_config['logo_outline_size']) : $img_h + (int)($img_h/5);

        // Crea un objeto de mapa base
        $bg_img = imagecreatetruecolor($bg_w, $bg_h);

        // Establecer el color del mapa base
        $rgb = $this->hex2rgb($this->_config['logo_outline_color']);
        $bgcolor = imagecolorallocate($bg_img, $rgb['r'], $rgb['g'], $rgb['b']);

        // Rellena el color del mapa base
        imagefill($bg_img, 0, 0, $bgcolor);

        // Combina la imagen y el mapa base para lograr el efecto de trazo
        imagecopy($bg_img, $img, (int)(($bg_w-$img_w)/2), (int)(($bg_h-$img_h)/2), 0, 0, $img_w, $img_h);

        $img = $bg_img;

        return array($img, $bg_w, $bg_h);

    }

    /**
     * Esquinas redondeadas de objetos de imagen
     * @param    Objeto de imagen Obj $ img
     * @return Obj
     */
    private function image_fillet($img){

        // Obtener ancho y alto de la imagen
        $img_w = imagesx($img);
        $img_h = imagesy($img);

        // Crea un objeto de imagen con esquinas redondeadas
        $new_img = imagecreatetruecolor($img_w, $img_h);

        // guarda el canal transparente
        imagesavealpha($new_img, true);

        // Rellena la imagen con esquinas redondeadas
        $bg = imagecolorallocatealpha($new_img, 255, 255, 255, 127);
        imagefill($new_img, 0, 0, $bg);

        // Radio de redondeo
        $r = $this->_config['logo_radius'];

        // Realizar procesamiento de esquinas redondeadas
        for($x=0; $x<$img_w; $x++){
            for($y=0; $y<$img_h; $y++){
                $rgb = imagecolorat($img, $x, $y);

                // No en las cuatro esquinas de la imagen, dibuja directamente
                if(($x>=$r && $x<=($img_w-$r)) || ($y>=$r && $y<=($img_h-$r))){
                    imagesetpixel($new_img, $x, $y, $rgb);

                // En las cuatro esquinas de la imagen, elige dibujar
                }else{
                    // arriba a la izquierda
                    $ox = $r; // centro x coordenada
                    $oy = $r; // centro coordenada y
                    if( ( ($x-$ox)*($x-$ox) + ($y-$oy)*($y-$oy) ) <= ($r*$r) ){
                        imagesetpixel($new_img, $x, $y, $rgb);
                    }

                    // parte superior derecha
                    $ox = $img_w-$r; // centro x coordenada
                    $oy = $r;        // centro coordenada y
                    if( ( ($x-$ox)*($x-$ox) + ($y-$oy)*($y-$oy) ) <= ($r*$r) ){
                        imagesetpixel($new_img, $x, $y, $rgb);
                    }

                    // abajo a la izquierda
                    $ox = $r;        // centro x coordenada
                    $oy = $img_h-$r; // centro coordenada y
                    if( ( ($x-$ox)*($x-$ox) + ($y-$oy)*($y-$oy) ) <= ($r*$r) ){
                        imagesetpixel($new_img, $x, $y, $rgb);
                    }

                    // abajo a la derecha
                    $ox = $img_w-$r; // centro x coordenada
                    $oy = $img_h-$r; // centro coordenada y
                    if( ( ($x-$ox)*($x-$ox) + ($y-$oy)*($y-$oy) ) <= ($r*$r) ){
                        imagesetpixel($new_img, $x, $y, $rgb);
                    }

                }

            }
        }

        return $new_img;

    }

    // Combinar las imágenes y mantener su transparencia
    private function imagecopymerge_alpha($dest_img, $src_img, $pos_x, $pos_y, $src_x, $src_y, $src_w, $src_h, $opacity){

        $w = imagesx($src_img);
        $h = imagesy($src_img);

        $tmp_img = imagecreatetruecolor($src_w, $src_h);

        imagecopy($tmp_img, $dest_img, 0, 0, $pos_x, $pos_y, $src_w, $src_h);
        imagecopy($tmp_img, $src_img, 0, 0, $src_x, $src_y, $src_w, $src_h);
        imagecopymerge($dest_img, $tmp_img, $pos_x, $pos_y, $src_x, $src_y, $src_w, $src_h, $opacity);

        return $dest_img;

    }

    /**
     * Crea un directorio
     * @param  String  $path
     * @return Boolean
     */
    private function create_dirs($path){

        if(!is_dir($path)){
            return mkdir($path, 0777, true);
        }

        return true;

    }

    /** color hexadecimal a color rgb
     *  @param    Cadena $ color color hexadecimal
     *  @return Array
     */
    private function hex2rgb($hexcolor){
        $color = str_replace('#', '', $hexcolor);
        if (strlen($color) > 3) {
            $rgb = array(
                'r' => hexdec(substr($color, 0, 2)),
                'g' => hexdec(substr($color, 2, 2)),
                'b' => hexdec(substr($color, 4, 2))
            );
        } else {
            $r = substr($color, 0, 1) . substr($color, 0, 1);
            $g = substr($color, 1, 1) . substr($color, 1, 1);
            $b = substr($color, 2, 1) . substr($color, 2, 1);
            $rgb = array(
                'r' => hexdec($r),
                'g' => hexdec($g),
                'b' => hexdec($b)
            );
        }
        return $rgb;
    }

    /** Obtener el tipo de imagen 
     * @param    Cadena $ ruta de la imagen del archivo 
     * @return int 
     */  
    private function get_file_ext($file){
        $filename = basename($file);
        list($name, $ext)= explode('.', $filename);

        $ext_type = 0;

        switch(strtolower($ext)){
            case 'jpg':
            case 'jpeg':
                $ext_type = 2;
                break;
            case 'gif':
                $ext_type = 1;
                break;
            case 'png':
                $ext_type = 3;
                break;
        }

        return $ext_type;
    }

} // class end
?>