function ObtenerCategoriasProducto() {
	var pagina = "ObtenerCategoriasProducto.php";
	var id_user=localStorage.getItem('id_user');
	var datos="iduser="+id_user;
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: urlphp+pagina,
		data:datos,
		async:false,
		success: function(resp){
			var respuesta=resp.respuesta;
			if (respuesta.length>0) {

				PintarCategoriaProducto(respuesta);
				ObtenerProductosSinCategoria();

			}else{

				ObtenerProductos();
			}

			},error: function(XMLHttpRequest, textStatus, errorThrown){ 
				var error;
				  	if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
				  	if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
								//alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
					console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
			}
		});
}

function PintarCategoriaProducto(respuesta) {
	var html="";
	if (respuesta.length>0) {
		for (var i = 0; i < respuesta.length; i++) {
		
		imagen=urlimagenes+`categoriapaquete/imagenescategoria/`+codigoserv+respuesta[i].foto;
		var funcion="";
		if (respuesta[i].sub>0) {
  					
  					funcion="DetalleSubCategoria("+respuesta[i].idcategoriapaquete+")";
						
			      
			      	}else{
			      		 funcion="DetalleCategiaProducto("+respuesta[i].idcategoriapaquete+")";
			      	}
			     

			html+=`

				 <div class="tarjeta" style="width:50%;" id="tarjeta_`+respuesta[i].idcategoriapaquete+`">
		          <div class="card demo-card-header-pic" style="border-radius: 10px;">`;
		         
		       
		        html+=`  <div style="background-image:url(`+imagen+`);border-radius: 10px 10px 0px 0px;" onclick="`+funcion+`"
		          class="card-header align-items-flex-end"></div>

		        <div class="" style="display: flex;
    justify-content: center;
    align-items: center;text-align: center;height: 50px;background:#C7AA6A;font-size: 16px;">
   				 <p style="margin:0px;text-align:center;color: white;">`+respuesta[i].nombre;
			    
			       html+=` </p>`;

			     

		html+=`	</div>
		      </div>
		      </div>
			`;
		}
	}

	$(".divproductosservicios").html(html);
}

function ObtenerProductosSinCategoria() {
	var pagina = "ObtenerProductosSinCategoria.php";
	var idsucursal=localStorage.getItem('idsucursal');
	var id_user=localStorage.getItem('id_user');
	var datos="iduser="+id_user+"&idsucursal="+idsucursal;
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: urlphp+pagina,
		data:datos,
		async:false,
		success: function(resp){
			var respuesta=resp.respuesta;
			PintarProductosSinCategoria(respuesta);

			},error: function(XMLHttpRequest, textStatus, errorThrown){ 
				var error;
				  	if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
				  	if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
								//alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
					console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
			}
		});
}

function PintarProductosSinCategoria(respuesta) {
	var html="";
	if (respuesta.length>0) {
		for (var i = 0; i < respuesta.length; i++) {
		
		imagen=urlimagenes+`paquetes/imagenespaquete/`+codigoserv+respuesta[i].foto;
		var funcion="";
		if (respuesta[i].servicio==1) {
  					
  					funcion="DetalleServicio("+respuesta[i].idpaquete+")";
						
			      
			      	}else{
			      		 funcion="DetalleProducto("+respuesta[i].idpaquete+")";
			      	}
			     

			html+=`

				 <div class="tarjeta" style="width:50%;" id="tarjeta_`+respuesta[i].idpaquete+`">
		          <div class="card demo-card-header-pic" style="border-radius: 10px;">`;
		         
		         var classe="";

		           if (respuesta[i].favorita==1) {
		           	classe="favorito";
		           }


		           html+=` <a onclick="PaqueteFavorito(`+respuesta[i].idpaquete+`,`+respuesta[i].favorita+`)" class="link `+classe+`" style="z-index: 1000;position: absolute;right: 0;margin: 1em;" id="paquete_`+respuesta[i].idpaquete+`">`;
			        	
			        
						 favorito=`<span class="material-icons-outlined " style="color:gray;">favorite_border</span>`;
                        if (respuesta[i].favorita==1) {

                        favorito=`<span class="material-icons-outlined colorred">favorite</span>`;


                        }
  

			      html+=favorito+`  </a>`;

			      	

		        html+=`  <div style="background-image:url(`+imagen+`);border-radius: 10px 10px 0px 0px;" onclick="`+funcion+`"
		          class="card-header align-items-flex-end"></div>

		        <div class="" style="display: block;text-align: center;height: 50px;">
   				 <p style="margin:0px;text-align:center;">`+respuesta[i].nombrepaquete;
			    
			       html+=` </p>`;

			       if (respuesta[i].servicio==0) {
			      html+=` <p style="margin:0;text-align:center;color:white;    font-size: 14px;
    font-weight: bold;    margin: auto;
    width: 80px;background:black;margin:auto;width:100px;border-radius: 10px;">$`+respuesta[i].precioventa+`</p>`;
    				}else{

    					html+=`<p></p>`;
    				}

		html+=`	</div>
		      </div>
		      </div>
			`;
		}
	}

	$(".divproductosservicios").append(html);
}



function PintarProductosConCategoria(respuesta,div) {
	var html="";
	if (respuesta.length>0) {
		for (var i = 0; i < respuesta.length; i++) {
		
		imagen=urlimagenes+`paquetes/imagenespaquete/`+codigoserv+respuesta[i].foto;
		var funcion="";
		if (respuesta[i].servicio==1) {
  					
  					funcion="DetalleServicio("+respuesta[i].idpaquete+")";
						
			      
			      	}else{
			      		 funcion="DetalleProducto("+respuesta[i].idpaquete+")";
			      	}
			     

			html+=`

				 <div class="tarjeta" style="width:50%;" id="tarjeta_`+respuesta[i].idpaquete+`">
		          <div class="card demo-card-header-pic" style="border-radius: 10px;">`;
		         
		         var classe="";

		           if (respuesta[i].favorita==1) {
		           	classe="favorito";
		           }


		           html+=` <a onclick="PaqueteFavorito(`+respuesta[i].idpaquete+`,`+respuesta[i].favorita+`)" class="link `+classe+`" style="z-index: 1000;position: absolute;right: 0;margin: 1em;" id="paquete_`+respuesta[i].idpaquete+`">`;
			        	
			        
						 favorito=`<span class="material-icons-outlined " style="color:gray;">favorite_border</span>`;
                        if (respuesta[i].favorita==1) {

                        favorito=`<span class="material-icons-outlined colorred">favorite</span>`;


                        }
  

			      html+=favorito+`  </a>`;

			      	

		        html+=`  <div style="background-image:url(`+imagen+`);border-radius: 10px 10px 0px 0px;" onclick="`+funcion+`"
		          class="card-header align-items-flex-end"></div>

		        <div class="" style="text-align: center;height: 50px;">
   				 <p style="" class="nombrepaquete">`+respuesta[i].nombrepaquete;
			    
			       html+=` </p>`;

			       if (respuesta[i].servicio==0) {
			      html+=` <span style="" class="preciopaqueteestilo">$`+respuesta[i].precioventa+`</span>`;
    				}else{

    					html+=`<p></p>`;
    				}

		html+=`	</div>
		      </div>
		      </div>
			`;
		}
	}


	
	$("."+div).append(html);
		
	
}

function DetalleSubCategoria(idcategoria) {
	localStorage.setItem('idcategoria',idcategoria);
	GoToPage('subcategorias');
}

function DetalleCategiaProducto(idcategoria) {
	localStorage.setItem('idcategoria',idcategoria);
	GoToPage('productoscategoria');
}

function ObtenerProductosCategorias(div) {

	var pagina = "ObtenerProductosCategoria.php";
	var idsucursal=localStorage.getItem('idsucursal');
	var id_user=localStorage.getItem('id_user');
	var idcategoria=localStorage.getItem('idcategoria');
	var datos="iduser="+id_user+"&idcategoria="+idcategoria+"&idsucursal="+idsucursal;
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: urlphp+pagina,
		data:datos,
		async:false,
		success: function(resp){
			var respuesta=resp.respuesta;
			PintarProductosConCategoria(respuesta,div);

			},error: function(XMLHttpRequest, textStatus, errorThrown){ 
				var error;
				  	if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
				  	if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
								//alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
					console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
			}
		});
}

function ObtenerSubCategorias() {
	var pagina = "ObtenerSubCategorias.php";
	var idcategoria=localStorage.getItem('idcategoria');
	var datos="idcategoria="+idcategoria;
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: urlphp+pagina,
		data:datos,
		async:false,
		success: function(resp){
			var respuesta=resp.respuesta;
			if (respuesta.length>0) {

				PintarSubCategoriaProducto(respuesta);
				var div="divsub";
				ObtenerProductosCategorias(div);

			}else{
				var div="divproductosservicios";
				ObtenerProductosCategorias(div);
			}

			},error: function(XMLHttpRequest, textStatus, errorThrown){ 
				var error;
				  	if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
				  	if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
								//alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
					console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
			}
		});
}

function PintarSubCategoriaProducto(respuesta) {
	var html="";
	if (respuesta.length>0) {
		for (var i = 0; i < respuesta.length; i++) {
		
		imagen=urlimagenes+`categoriapaquete/imagenescategoria/`+codigoserv+respuesta[i].foto;
		var funcion="";
		if (respuesta[i].sub>0) {
  					
  					funcion="DetalleSubCategoria("+respuesta[i].idcategoriapaquete+")";
						
			      
			      	}else{
			      		 funcion="DetalleCategiaProducto("+respuesta[i].idcategoriapaquete+")";
			      	}
			     

			html+=`

				 <div class="tarjeta" style="width:50%;" id="tarjeta_`+respuesta[i].idcategoriapaquete+`">
		          <div class="card demo-card-header-pic" style="border-radius: 10px;">`;
		         
		       
		        html+=`  <div style="background-image:url(`+imagen+`);border-radius: 10px 10px 0px 0px;" onclick="`+funcion+`"
		          class="card-header align-items-flex-end"></div>

		        <div class="" style="display: flex;
    justify-content: center;
    align-items: center;text-align: center;height: 50px;background:#C7AA6A;font-size: 16px;">
   				 <p style="margin:0px;text-align:center;color: white;">`+respuesta[i].nombre;
			    
			       html+=` </p>`;

			     

		html+=`	</div>
		      </div>
		      </div>
			`;
		}
	}

	if ($(".divsub")) {
		$(".divsub").html(html);
	}else{
		$(".divproductosservicios").html(html);
	}
	

	
}