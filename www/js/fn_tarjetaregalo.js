
function GuardarTarjetaregalo(form,regresar,donde,idmenumodulo)
{
	if(confirm("\u00BFDesea realizar esta operaci\u00f3n?"))
	{			
		//recibimos todos los datos..
		var nombre =$("#v_titulo").val();
		var descripcion=$("#v_descripcion").val();
		var tipodescuento=$("#v_tipodescuento").val();
		var cantidad=$("#v_cantidadcomision").val();
		var orden=$("#v_orden").val();
		var estatus=$("#v_estatus").val();
		var v_fechavigencia=$("#v_fechavigencia").val();
		var todosclientes=$("#v_tclientes").is(':checked')?1:0;

		var clientesseleccionados=[];

		$(".chkcliente_").each(function(index) {
			if ($(this).is(':checked')) {

				var id=$(this).attr('id');
				var dividir=id.split('_')[1];

				clientesseleccionados.push(dividir);
			}
		  
		
		});

		var id=$("#id").val();
		var data = new FormData();

		/*var archivos = document.getElementById("image"); //Damos el valor del input tipo file
		var archivo = archivos.files; //Obtenemos el valor del input (los arcchivos) en modo de arreglo
		console.log(archivo);

		//Como no sabemos cuantos archivos subira el usuario, iteramos la variable y al
		//objeto de FormData con el metodo "append" le pasamos calve/valor, usamos el indice "i" para
		//que no se repita, si no lo usamos solo tendra el valor de la ultima iteracion
		for (i = 0; i < archivo.length; i++) {
			data.append('archivo' + i, archivo[i]);
		}
*/
		

		data.append('v_nombre',nombre);
		data.append('v_descripcion',descripcion);
		data.append('v_tipodescuento',tipodescuento);
		data.append('v_cantidad',cantidad);
		data.append('v_orden',orden);
		data.append('id',id);
		data.append('v_estatus',estatus);
		data.append('todosclientes',todosclientes);
		data.append('clientesseleccionados',clientesseleccionados);
		data.append('fechavigencia',v_fechavigencia);
	
		 $('#main').html('<div align="center" class="mostrar"><img src="images/loader.gif" alt="" /><br />Subiendo Archivos...</div>')
				
		setTimeout(function(){
				  $.ajax({
					  url:'catalogos/tarjetasregalo/ga_tarjetasregalo.php', //Url a donde la enviaremos
					type:'POST', //Metodo que usaremos
					contentType: false, //Debe estar en false para que pase el objeto sin procesar
					data: data, //Le pasamos el objeto que creamos con los archivos
					processData: false, //Debe estar en false para que JQuery no procese los datos a enviar
					cache: false, //Para que˘
					error:function(XMLHttpRequest, textStatus, errorThrown){
						  var error;
						  console.log(XMLHttpRequest);
						  if (XMLHttpRequest.status === 404)  error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error 
						  if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error 
						  $('#abc').html('<div class="alert_error">'+error+'</div>');	
						  //aparecermodulos("catalogos/vi_ligas.php?ac=0&msj=Error. "+error,'main');
					  },
					success:function(msj){
						var resp = msj.split('|');
						
						   console.log("El resultado de msj es: "+msj);
						 	if( resp[0] == 1 ){
								aparecermodulos(regresar+"?ac=1&idmenumodulo="+idmenumodulo+"&msj=Operacion realizada con exito&idempresas="+resp[1],donde);
						 	 }else{
								aparecermodulos(regresar+"?ac=0&idmenumodulo="+idmenumodulo+"&msj=Error. "+msj,donde);
						  	}			
					  	}
				  });				  					  
		},1000);
	 }
}

function AbrirModalQr(idtarjetausuario) {
		
		var datos="idtarjetausuario="+idtarjetausuario;
	 	$.ajax({
				url:'catalogos/tarjetasregalo/generarqr.php', //Url a donde la enviaremos
				type:'POST', //Metodo que usaremos
				dataType:'json',
				data:datos,
				error:function(XMLHttpRequest, textStatus, errorThrown){
					  var error;
					  console.log(XMLHttpRequest);
					  if (XMLHttpRequest.status === 404)  error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error 
					  if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error 
					  $("#empresasasignadas").html(error); 
				  },
				success:function(msj){
					var respuesta=msj.ruta;
					var rutaimagenqr=msj.imgqr;
					$("#modaltarjeta").modal();
	
					$("#txtimagenruta").attr('src',rutaimagenqr);
						//VisualizarCodigoqr(respuesta,rutaimagenqr);
					 $("#linkInput").val(respuesta);
						
				  	}
		});
}
function VisualizarCodigoqr(respuesta,rutaimagen) {

}

  function copiarAlPortapapeles() {
    /* Selecciona el contenido del input */
    var inputElement = document.getElementById('linkInput');
    inputElement.select();
    
    /* Copia el contenido al portapapeles */
    document.execCommand('copy');
    
    /* Deselecciona el input para evitar confusiones visuales */
    window.getSelection().removeAllRanges();
  }