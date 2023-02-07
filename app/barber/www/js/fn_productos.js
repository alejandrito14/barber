function ObtenerProductos() {
	var idsucursal=localStorage.getItem('idsucursal');
	var iduser=localStorage.getItem('id_user');
	var pagina = "ObtenerListadoPaquetes.php";
	var datos="idsucursal="+idsucursal+"&iduser="+iduser;
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
		
		imagen=urlimagenes+`paquetes/imagenespaquete/`+codigoserv+respuesta[i].foto;

			html+=`

				 <div class="col-50">
		          <div class="card demo-card-header-pic">
		          <div style="background-image:url(`+imagen+`)"
		          class="card-header align-items-flex-end" style="height: 20vw!important;">`+respuesta[i].nombrepaquete+`</div>
		          <div class="card-content card-content-padding">
		          <p class="date"></p>
		         
		        </div>
		        <div class="card-footer">
			        <a onclick="PaqueteFavorito(`+respuesta[i].idpaquete+`,`+respuesta[i].favorita+`)" class="link">`;
			        	
			        
						 favorito=`<span class="material-icons-outlined ">favorite_border</span>`;
                        if (respuesta[i].favorita==1) {

                        favorito=`<span class="material-icons-outlined">favorite</span>`;


                        }
  

			      html+=favorito+`  </a>`;

			      	if (respuesta[i].servicio==1) {
  					
  					html+=` <a onclick="DetalleServicio(`+respuesta[i].idpaquete+`)"  class="link"><span class="material-icons-outlined">
						add_circle</span>`;
			      
			      	}else{
			      		  html+=` <a onclick="DetalleProducto(`+respuesta[i].idpaquete+`)"  class="link"><span class="material-icons-outlined">
						add_circle</span>`;
			      	}
			     


			       html+=` </a>
		        </div>
		      </div>
		      </div>
			`;
		}
	}

	$(".divproductosservicios").html(html);
}

function PaqueteFavorito(idpaquete,valor) {

	if (valor==1) {

			valor=0;
		}else{

			valor=1;
		}

	var pagina = "ColocarFavorito.php";
	var id_user=localStorage.getItem('id_user');
	var datos="idpaquete="+idpaquete+"&iduser="+id_user+"&valor="+valor;
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: urlphp+pagina,
		data:datos,
		async:false,
		success: function(datos){
			
			ObtenerProductos();
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

function DetalleProducto(idpaquete) {
	
	localStorage.setItem('idpaquete',idpaquete);
	GoToPage('detallepaquete');

}

function DetalleServicio(idpaquete) {
		localStorage.setItem('idpaquete',idpaquete);
		GoToPage('detalleservicio');
		
}