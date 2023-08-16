
function ObtenerCategoriasProductodetalle(argument) {
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

				PintarCategoriaProductodetalle(respuesta);
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

function  PintarCategoriaProductodetalle(respuesta) {
	var html="";
	if (respuesta.length>0) {
		for (var i = 0; i < respuesta.length; i++) {

			if (respuesta[i].foto!=null) {
					imagen=urlimagenes+`categoriapaquete/imagenescategoria/`+codigoserv+respuesta[i].foto;
	
				}else{

					imagen=localStorage.getItem('logo');
				}
		


		var funcion="";
		if (respuesta[i].sub>0) {
  					
  					funcion="DetalleSubCategoriadetalle("+respuesta[i].idcategoriapaquete+")";
						
			      
			      	}else{
			      		 funcion="DetalleCategiaProducto("+respuesta[i].idcategoriapaquete+")";
			      	}
			     

			html+=`

				 <div class="tarjeta cambiarfuente" style="width:100%;" id="tarjeta_`+respuesta[i].idcategoriapaquete+`" onclick="`+funcion+`">
		          <div class="card demo-card-header-pic" style="border-radius: 10px;">`;
		         
		       
		        html+=`  <div style="background-image:url(`+imagen+`);border-radius: 10px 10px 0px 0px;" 
		          class="card-header align-items-flex-end"></div>

		        <div class="" style="display: flex;
    justify-content: center;
    align-items: center;text-align: center;height: 50px;background:#C7AA6A;font-size: 16px;    
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;">
   				 <p style="margin:0px;text-align:center;color: white;

   				 ">`+respuesta[i].nombre;
			    
			       html+=` </p>`;

			     

		html+=`	</div>
		      </div>
		      </div>
			`;
		}
	}

	$(".divproductosservicios").html(html);
}

function DetalleSubCategoriadetalle(idcategoria) {
	idcategoriapadre=idcategoria;
	localStorage.setItem('idcategoria',idcategoria);
	
	GoToPage('subcategoriasdetalle');
}

function ConsultarCategoriaPadre(argument) {
	// body...
}
