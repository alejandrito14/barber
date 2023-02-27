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
		var funcion="";
		if (respuesta[i].servicio==1) {
  					
  					funcion="DetalleServicio("+respuesta[i].idpaquete+")";
						
			      
			      	}else{
			      		 funcion="DetalleProducto("+respuesta[i].idpaquete+")";
			      	}
			     

			html+=`

				 <div class="tarjeta" style="width:50%;" id="tarjeta_`+respuesta[i].idpaquete+`">
		          <div class="card demo-card-header-pic">`;
		           html+=` <a onclick="PaqueteFavorito(`+respuesta[i].idpaquete+`,`+respuesta[i].favorita+`)" class="link" style="z-index: 1000;position: absolute;right: 0;margin: 1em;">`;
			        	
			        
						 favorito=`<span class="material-icons-outlined ">favorite_border</span>`;
                        if (respuesta[i].favorita==1) {

                        favorito=`<span class="material-icons-outlined colorred">favorite</span>`;


                        }
  

			      html+=favorito+`  </a>`;

			      	

		        html+=`  <div style="background-image:url(`+imagen+`)" onclick="`+funcion+`"
		          class="card-header align-items-flex-end" style="height: 20vw!important;"></div>

		        <div class="card-footer" style="justify-content: center;
    display: flex;"><p style="margin:0px;text-align:center;">`+respuesta[i].nombrepaquete;
			     

			       html+=` </p>
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
