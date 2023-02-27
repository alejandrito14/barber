function ObtenerDatosSucursal() {

	var idsucursal=localStorage.getItem('idsucursal');

		var datos='idsucursal='+idsucursal;
		var pagina = "ObtenerSucursal.php";
		$.ajax({
		type: 'POST',
		dataType: 'json',
		url: urlphp+pagina,
		async:false,
		data:datos,
		success: function(datos){
		
		var sucursal=datos.sucursal;
		var imagenes=datos.imagenes;
		PintarDatosSucursal(sucursal,imagenes);

	/*	localStorage.setItem('minutosconsiderados',sucursal.minutosconsiderados);
		localStorage.setItem('nombresucursal',sucursal.sucursal);
		localStorage.setItem('campomontofactura',sucursal.campomontofactura);
		localStorage.setItem('habilitarfactura',sucursal.solicitarfactura);
*/
			

		},error: function(XMLHttpRequest, textStatus, errorThrown){ 
			var error;
				if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
				if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
								//alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
								console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
					}
		});

}

function PintarDatosSucursal(respuesta,imagenes) {

	imagen=urlimagenes+`sucursal/imagenes/`+codigoserv+respuesta.imagen;
	$(".imagensucursal").attr('src',imagen);
	$(".titulosucursal").text(respuesta.titulo);
	$(".telefono").text(respuesta.celular);
	$(".descripcion").text(respuesta.descripcion);

	var html="";
	if (imagenes.length>0) {
		html+=`<div class="swiper-wrapper">`;
		for (var i = 0; i < imagenes.length; i++) {

				imagen=urlimagenes+`sucursal/imagenes/`+codigoserv+imagenes[i].imagen;

			html+=`
					<div class="swiper-slide"  style="margin-right:0px!important;">
						<div class="dz-media">
							<img src="`+imagen+`" alt="">
						</div>
			
					</div>
				`;
		}

		html+=`</div>`;
	}


	$(".gallery-swiper").html(html);
}