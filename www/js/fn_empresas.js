
function Buscar_empresa(idmenu)
{
	var empresa = $('#vf_empresa').val();
	var estatus = $('#vf_estatus').val();

	
	var datos = "empresa="+empresa+"&estatus="+estatus+"&idmenumodulo="+idmenu;
	
	console.log(datos);
	
	cerrar_filtro('modal-filtros');
	$('#modal-filtros').modal('hide');
	
	$("#contenedor_empresas").html('<div align="center" class="mostrar"><img src="images/loader.gif" alt="" /><br />Cargando...</div>');	
	
		setTimeout(function(){
				  $.ajax({
					url:'catalogos/empresa/li_empresas.php', //Url a donde la enviaremos
					type:'GET', //Metodo que usaremos
					data: datos, //Le pasamos el objeto que creamos con los archivos
					error:function(XMLHttpRequest, textStatus, errorThrown){
						  var error;
						  console.log(XMLHttpRequest);
						  if (XMLHttpRequest.status === 404)  error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error 
						  if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error 
						  $("#contenedor_empresas").html(error); 
					  },
					success:function(msj){
					      $("#contenedor_empresas").html(msj); 	  
					  	}
				  });				  					  
		},1000);	
}

/*
function Buscar_categorias(idempresa,idmenu)
{
	
	
	var datos = "idempresa="+idempresa+"&idmenumodulo="+idmenu;
		console.log(datos);
	
	cerrar_filtro('modal-filtros');
	$('#modal-filtros').modal('hide');
	
	$("#contenedor_categorias").html('<div align="center" class="mostrar"><img src="images/loader.gif" alt="" /><br />Cargando...</div>');	
	
		setTimeout(function(){
				  $.ajax({
					url:'catalogos/empresas/productos/li_categorias.php', //Url a donde la enviaremos
					type:'GET', //Metodo que usaremos
					data: datos, //Le pasamos el objeto que creamos con los archivos
					error:function(XMLHttpRequest, textStatus, errorThrown){
						  var error;
						  console.log(XMLHttpRequest);
						  if (XMLHttpRequest.status === 404)  error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error 
						  if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error 
						  $("#contenedor_categorias").html(error); 
					  },
					success:function(msj){
					      $("#contenedor_categorias").html(msj); 	  
					  	}
				  });				  					  
		},1000);	
}

*/
function GuardarEmpresa(form,regresar,donde,idmenu)
{
			//recibimos todos los datos..
		//var datos = $('#'+form)
    
      //recibimos todos los datos..
		var nombre =$("#v_empresa").val();
		var descripcion=$("#v_descripcion").val();
		var telefono=$("#v_telefono").val();
		var estatus=1;
		var email=$("#v_email").val();
		//var contactos=$("#v_contactos").val();

		var id=$("#id").val();
		var datos = new FormData();

		var archivos = document.getElementById("image"); //Damos el valor del input tipo file
		var archivo = archivos.files; //Obtenemos el valor del input (los arcchivos) en modo de arreglo

		//Como no sabemos cuantos archivos subira el usuario, iteramos la variable y al
		//objeto de FormData con el metodo "append" le pasamos calve/valor, usamos el indice "i" para
		//que no se repita, si no lo usamos solo tendra el valor de la ultima iteracion
		for (i = 0; i < archivo.length; i++) {
			datos.append('archivo', archivo[i]);
		}
		
		datos.append('v_nombre',nombre); 
		datos.append('v_descripcion',descripcion);
		datos.append('v_telefono',telefono); 
		datos.append('id',id);
		datos.append('v_email',email);
		
		setTimeout(function(){
				  $.ajax({                    
					url:'catalogos/empresa/ga_empresas.php', //Url a donde la enviaremos
		            type:'POST', //Metodo que usaremos
				  	contentType:false, //Debe estar en false para que pase el objeto sin procesar
					data: datos, //Le pasamos el objeto que creamos con los archivos
				  	processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
    				cache:false, //Para que el formulario no guarde cache,
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
						 			var URL = regresar + "?idmenumodulo=" + idmenu + "&ac=1&msj=Operacion realizada con exito";
									aparecermodulos(URL, donde);


						 	 }else{
								aparecermodulos(regresar + "?idmenumodulo=" + idmenu + "&ac=0&msj=Error. " + msj, donde);
						  	}			
					  	}
				  });				  					  
		},1);
	 }







function ModificarProducto(idproducto,idmenu,idempresa)
{

    $.ajax({
			    // En data puedes utilizar un objeto JSON, un array o un query string
			    data: {"idproducto" : idproducto, "idempresa" : idempresa},
			    //Cambiar a type: POST si necesario
			    type: "POST",
			    // Formato de datos que se espera en la respuesta
			    dataType: "json",
			    // URL a la que se enviará la solicitud Ajax
			    url: "catalogos/empresas/productos/b_json_productos.php",
			 })
			 .done(function( data, textStatus, jqXHR ) {
			     if ( console && console.log ) {
			         console.log( "La solicitud se ha completado correctamente. el resultado de data es "+ data.success + " y los datos son  " +data.mensaje);
			         
			         //obtenemos los valores de los campos para colocarlo en el formulario.

                       var foto = data.productos[0]['foto'];
                     
                       $("#d_foto_producto").attr("src","catalogos/empresas/productos/imagenes/"+foto);
                       $('#v_p_foto').val();

                     
                       $('#v_idproducto').val(data.productos[0]['idproductos']);
                       $('#v_p_producto').val(data.productos[0]['producto']);
                       $('#v_descripcion_producto').val(data.productos[0]['descripcion']);
                       $('#v_p_costo').val(data.productos[0]['costo']);
					 
                                       
                       Buscar_categoriascombo(idempresa,data.productos[0]['idcategorias']);
                        var valor = data.productos[0]['estatus'];
                         $("#v_p_estatus option[value="+ data.productos[0]['estatus'] +"]").attr("selected",true);   
					 $("#v_p_tipo option[value="+ data.productos[0]['tipo'] +"]").attr("selected",true);
						$('html, body').animate({scrollTop:0}, 'slow');                     
                     
                      $('#v_producto').val('probando producto');

			     }
			 })
			 .fail(function( jqXHR, textStatus, errorThrown ) {
			     if ( console && console.log ) {
			         console.log( "La solicitud a fallado: " +  textStatus);
			     }
			});
}

function nuevoProducto()
{
    
     $("#d_foto_producto").attr("src","catalogos/empresas/productos/imagenes/sn.png");
     $("#f_productos")[0].reset();	
    
    
    
}



function LimpiarFormularioCategorias()
{
	$('#v_categoria_nombre').val("");
	
	$('#v_idcategoria_empresa').val("0");
}

function LimpiarFormularioDatosbancarios()
{
	$('#v_banco_nombre').val("");
	$('#v_banco_titular').val("");
	$('#v_banco_no_cuenta').val("");
	$('#v_banco_clabe').val("");
	$('#v_banco_email').val("");
	$('#v_iddatobancario').val("0");
}

function GuardarDatosbancarios(form,regresar,donde,idmenu,idempresa)
{

			//recibimos todos los datos..
		var datos = ObtenerDatosFormulario(form);
		
		console.log(datos);
	
		 $('#contenedor_datosbancarios').html('<div align="center" class="mostrar"><img src="images/loader.gif" alt="" /><br />Guardando Dato Bancario...</div>')
				
		setTimeout(function(){
				  $.ajax({
					url:'catalogos/empresas/ga_datosbancarios.php', //Url a donde la enviaremos
					type:'POST', //Metodo que usaremos
					data: datos, //Le pasamos el objeto que creamos con los archivos
					error:function(XMLHttpRequest, textStatus, errorThrown){
						  var error;
						  console.log(XMLHttpRequest);
						  if (XMLHttpRequest.status === 404)  error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error 
						  if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error 
						  $('#abc').html('<div class="alert_error">'+error+'</div>');	
						  //aparecermodulos("catalogos/vi_ligas.php?ac=0&msj=Error. "+error,'main');
					  },
					success:function(msj){
						
						
						   console.log("El resultado de msj es: "+msj);
						var resp = msj.split('|');
						 	if( resp[0] == 1 ){
                                
                                LimpiarFormularioDatosbancarios();
                                Buscar_datosbancarios(idempresa,idmenu);
                                
                                
                    
                                //aparecermodulos(regresar+"?idmenumodulo="+idmenu+"&idrepartidores="+idrep+"&ac=1&msj=Operacion realizada con exito",donde);
                                
						 	 }else{
								aparecermodulos(regresar+"?idmenumodulo="+idmenu+"&idempresas="+idempresa+"&ac=0&msj=Error. "+msj,donde);
						  	}			
					  	}
				  });				  					  
		},1000);
	 }

	 function ModificarDatosBancarios(iddatobancario)
	 {
		  $.ajax({
					 // En data puedes utilizar un objeto JSON, un array o un query string
					 data: {"iddatobancario" : iddatobancario},
					 //Cambiar a type: POST si necesario
					 type: "POST",
					 // Formato de datos que se espera en la respuesta
					 dataType: "Json",
					 // URL a la que se enviará la solicitud Ajax
					 url: "catalogos/empresas/b_json_datosbancarios.php",
				  })
				  .done(function( data, textStatus, jqXHR ) {
					  if ( console && console.log ) {
						  console.log( "La solicitud se ha completado correctamente. el resultado de data es "+ data.success + " y los datos son  " +data.mensaje);
						  console.log("el nombre es : "+data.dato[0]['idgiro_comercial']);
	 
						  //obtenemos los valores de los campos para colocarlo en el formulario.
	 
	 $('#v_iddatobancario').val( data.dato[0]['idempresas_bancos']);
	 $('#v_banco_nombre').val( data.dato[0]['banco']);
	 $('#v_banco_titular').val( data.dato[0]['titular']);
	 $('#v_banco_no_cuenta').val( data.dato[0]['no_cuenta']);
	 $('#v_banco_clabe').val( data.dato[0]['clabe']);
	 $('#v_banco_email').val( data.dato[0]['emai']);


	 //$("#v_estatus option[value="+ data.sucursal[0]['estatus'] +"]").attr("selected",true);

							// $('html, body').animate({scrollTop:0}, 'slow');
	 
					  }
				  })
				  .fail(function( jqXHR, textStatus, errorThrown ) {
					  if ( console && console.log ) {
						  console.log( "La solicitud a fallado: " +  textStatus);
					  }
				 });
	 }

function GuardarCategoria(form,regresar,donde,idmenu,idempresa)
{

			//recibimos todos los datos..
		var datos = ObtenerDatosFormulario(form);
		
		console.log(datos);
	
		 $('#contenedor_categorias').html('<div align="center" class="mostrar"><img src="images/loader.gif" alt="" /><br />Guardando Categoria...</div>')
				
		setTimeout(function(){
				  $.ajax({
					url:'catalogos/empresas/productos/ga_categorias.php', //Url a donde la enviaremos
					type:'POST', //Metodo que usaremos
					data: datos, //Le pasamos el objeto que creamos con los archivos
					error:function(XMLHttpRequest, textStatus, errorThrown){
						  var error;
						  console.log(XMLHttpRequest);
						  if (XMLHttpRequest.status === 404)  error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error 
						  if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error 
						  $('#abc').html('<div class="alert_error">'+error+'</div>');	
						  //aparecermodulos("catalogos/vi_ligas.php?ac=0&msj=Error. "+error,'main');
					  },
					success:function(msj){
						
						
						   console.log("El resultado de msj es: "+msj);
							var resp = msj.split('|');
						
						 	if( resp[0] == 1 ){
                                
                                LimpiarFormularioCategorias();
                                Buscar_categorias(idempresa,idmenu);
                                 Buscar_categoriascombo(idempresa,'');
                                
                                
                                //aparecermodulos(regresar+"?idmenumodulo="+idmenu+"&idrepartidores="+idrep+"&ac=1&msj=Operacion realizada con exito",donde);
                                
						 	 }else{
								aparecermodulos(regresar+"?idmenumodulo="+idmenu+"&ac=0&msj=Error. "+msj,donde);
						  	}			
					  	}
				  });				  					  
		},1000);
	 }


	 function ModificarCategoria(idcategoria)
	 {
		  $.ajax({
					 // En data puedes utilizar un objeto JSON, un array o un query string
					 data: {"idcategoria" : idcategoria},
					 //Cambiar a type: POST si necesario
					 type: "POST",
					 // Formato de datos que se espera en la respuesta
					 dataType: "Json",
					 // URL a la que se enviará la solicitud Ajax
					 url: "catalogos/empresas/productos/b_json_categorias.php",
				  })
				  .done(function( data, textStatus, jqXHR ) {
					  if ( console && console.log ) {
						  console.log( "La solicitud se ha completado correctamente. el resultado de data es "+ data.success + " y los datos son  " +data.mensaje);
						  console.log("el nombre es : "+data.categoria[0]['idproductos_categorias']);
	 
						  //obtenemos los valores de los campos para colocarlo en el formulario.
	 
	 $('#v_idcategoria_empresa').val( data.categoria[0]['idproductos_categorias']);
	 $('#v_categoria_nombre').val( data.categoria[0]['nombre']);
	 


	 //$("#v_estatus option[value="+ data.sucursal[0]['estatus'] +"]").attr("selected",true);

							// $('html, body').animate({scrollTop:0}, 'slow');
	 
					  }
				  })
				  .fail(function( jqXHR, textStatus, errorThrown ) {
					  if ( console && console.log ) {
						  console.log( "La solicitud a fallado: " +  textStatus);
					  }
				 });
	 }

function Buscar_categoriascombo(idempresa,idcategoria)
{
	
	
	var datos = "idempresa="+idempresa+"&idcategoria="+idcategoria;
	
	
	console.log(datos);
	
	cerrar_filtro('modal-filtros');
	$('#modal-filtros').modal('hide');
	
	
		setTimeout(function(){
				  $.ajax({
					url:'catalogos/empresas/productos/li_combo_categorias.php', //Url a donde la enviaremos
					type:'GET', //Metodo que usaremos
					data: datos, //Le pasamos el objeto que creamos con los archivos
					error:function(XMLHttpRequest, textStatus, errorThrown){
						  var error;
						  console.log(XMLHttpRequest);
						  if (XMLHttpRequest.status === 404)  error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error 
						  if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error 
						  $("#categorias_combo").html(error); 
					  },
					success:function(msj){
					      $("#categorias_combo").html(msj); 	  
					  	}
				  });				  					  
		},1000);	
}

function Buscar_facturacioncombo(idempresa)
{
	
	
	var datos = "idempresa="+idempresa;
	
	
	console.log(datos);
	
	cerrar_filtro('modal-filtros');
	$('#modal-filtros').modal('hide');
	
	
		setTimeout(function(){
				  $.ajax({
					url:'catalogos/empresas/li_combo_facturacion.php', //Url a donde la enviaremos
					type:'GET', //Metodo que usaremos
					data: datos, //Le pasamos el objeto que creamos con los archivos
					error:function(XMLHttpRequest, textStatus, errorThrown){
						  var error;
						  console.log(XMLHttpRequest);
						  if (XMLHttpRequest.status === 404)  error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error 
						  if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error 
						  $("#facturacion_combo").html(error); 
					  },
					success:function(msj){
					      $("#facturacion_combo").html(msj); 	  
					  	}
				  });				  					  
		},1000);	
}


function Buscar_datosbancarios(idempresa,idmenu)
{
	
	
	var datos = "idempresa="+idempresa+"&idmenumodulo="+idmenu;
	
	
	console.log(datos);
	$('#contenedor_datosbancarios').html('<div align="center" class="mostrar"><img src="images/loader.gif" alt="" /><br />Cargando...</div>')
	
	
	
		setTimeout(function(){
				  $.ajax({
					url:'catalogos/empresas/li_cuentasbancarias.php', //Url a donde la enviaremos
					type:'GET', //Metodo que usaremos
					data: datos, //Le pasamos el objeto que creamos con los archivos
					error:function(XMLHttpRequest, textStatus, errorThrown){
						  var error;
						  console.log(XMLHttpRequest);
						  if (XMLHttpRequest.status === 404)  error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error 
						  if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error 
						  $("#contenedor_datosbancarios").html(error); 
					  },
					success:function(msj){
					      $("#contenedor_datosbancarios").html(msj); 	  
					  	}
				  });				  					  
		},1000);	
}

function BorrarDatosDescuentos(id,campo,tabla,tipo)
{
	var cadena="id="+id+"&campo="+campo+"&tabla="+tabla+"&tipo="+tipo;
	if(confirm("\u00BFEstas seguro de querer realizar esta operaci\u00f3n?"))
	{
		
		
		setTimeout(function(){
				  $.ajax({
					  type: 'POST',
					  url: 'clases/borrar.php',
					  data: cadena,
					  success:function(msj){
						  if ( msj == 1 ){
							 	$('#exampleModalLong').modal('hide');
							   alert("DATO DE DESCUENTO ELIMINADO CORECTAMENTE");
							  
						  }
						  else{
							  	$('#exampleModalLong').modal('hide');
							   alert("ERROR AL ELIMINAR DESCUENTO");
							   
						  }							  
					  },
					  error:function(){
						  $('#'+donde_mostrar).html('<div class="alert_succes"></div>');
						  $('.alert_error').hide(0).html('Ha ocurrido un error durante la ejecución');
						  $('.alert_error').slideDown(timeSlide);
						  
					  }
				  });				  					  
		},1000);
	}
}// fin de function GuardarEspecial
