function ObtenerProductos() {
	var idsucursal=localStorage.getItem('idsucursal');
	var pagina = "ObtenerListadoPaquetes.php";
	var datos="idsucursal="+idsucursal;
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: urlphp+pagina,
		data:datos,
		async:false,
		success: function(datos){
			
			var respuesta=datos.respuesta;
			PintarProductos(respuesta);
			//resolve(respuesta);
			},error: function(XMLHttpRequest, textStatus, errorThrown){ 
				var error;
				  	if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
				  	if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
								//alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
					console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
			}
		});
}

function PintarProductos(respuesta) {
	var html="";
	if (respuesta.length>0) {
		for (var i = 0; i < respuesta.length; i++) {
			html+=`

				 <div class="col-50">
		          <div class="card demo-card-header-pic">
		          <div style="background-image:url(https://cdn.framework7.io/placeholder/nature-1000x600-3.jpg)"
		          class="card-header align-items-flex-end" style="    height: 20vw!important;">Journey To Mountains</div>
		          <div class="card-content card-content-padding">
		          <p class="date">Posted on January 21, 2015</p>
		         
		        </div>
		        <div class="card-footer"><a href="#" class="link">Like</a><a href="#" class="link">Read more</a></div>
		      </div>
		      </div>
			`;
		}
	}

	$(".divproductosservicios").html(html);
}