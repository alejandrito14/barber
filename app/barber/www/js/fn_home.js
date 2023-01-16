
function ObtenerTableroAnuncios(estatus) {

	//return new Promise((resolve, reject) => {
 
	var datos="estatus="+estatus;
	var pagina = "ObtenerTableroAnuncios.php";
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: urlphp+pagina,
		data:datos,
		async:false,
		success: function(datos){
			$$(".cardswiper").html('');

			var respuesta=datos.respuesta;
			PintarTableroAnuncios(respuesta);
			//resolve(respuesta);
			},error: function(XMLHttpRequest, textStatus, errorThrown){ 
				var error;
				  	if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
				  	if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
								//alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
					console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
			}
		});

	//});
}

function PintarTableroAnuncios(respuesta) {
	var html="";

			var	classe="swiper-slide-active";

		if (respuesta.length>0) {

			html+=` <div class="swiper-wrapper">`;
		for (var i = 0; i < respuesta.length; i++) {
		imagen=urlimagenes+`tableroanuncios/imagenes/`+codigoserv+respuesta[i].imagen;
			var checked="";
			if (respuesta[i].estatus==1) {
				checked="checked";
			}
				html+=`
<div class="swiper-slide swiper-slide-active" role="group"  style="margin-right: 20px;width:200px;">
				<div class="card-bx featured-card">
						<div class="card-media" style="width:100%;height:72px;">
							<a href="/company-detail/" class="">
							<img src="`+imagen+`" alt="">
							</a>
						</div>
						<div class="card-info">
							<h5 class="title">
								<a href="/company-detail/">`+respuesta[i].titulo+`
								</a>
							</h5>
							<p class="location">
							</p>
							<h6 class="text-primary vacancy">
							</h6>
						</div>
					</div>
				</div>

				`;
				classe="";
		}

		html+=`</div>`;
		console.log(html);
		$$(".cardswiper").html(html);

		 var swiper1 = new Swiper(".cardswiper", {
		     slidesPerView: "auto",
		    spaceBetween: 30,
		    pagination: false,

		  });
			$(".divtableroauncios").css('display','block');

			if (localStorage.getItem('idtipousuario')==0) {
				$(".seleccionadoranuncio").each(function(index) {
				$(this).css('display','block');
				});	
			}



	}else{

		$(".divtableroauncios").css('display','none');

	}
}



function ObtenerTableroCategorias(estatus) {

	//return new Promise((resolve, reject) => {
 
	var datos="estatus="+estatus;
	var pagina = "ObtenerTableroCategorias.php";
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: urlphp+pagina,
		data:datos,
		async:false,
		success: function(datos){
			$$(".cardswipercategorias").html('');

			var respuesta=datos.respuesta;
			PintarTableroCategorias(respuesta);
			//resolve(respuesta);
			},error: function(XMLHttpRequest, textStatus, errorThrown){ 
				var error;
				  	if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
				  	if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
								//alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
					console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
			}
		});

	//});
}

function PintarTableroCategorias(respuesta) {
	var html="";
	if (respuesta.length>0) {
		html+=`<div class="swiper-wrapper">`;
		for (var i = 0; i < respuesta.length; i++) {
			

			html+=`
				<div class="swiper-slide" style="width: 50%!important;">
						<a href="/search/" class="categories-bx">
							<div class="icon-bx">
								
							</div>
							<h6 class="title">`+respuesta[i].titulo+`</h6>
						</a>
					</div>

			`;	
		}

		html+=`</div>`;

		$(".cardswipercategorias").html(html);

		 var swiper2 = new Swiper(".cardswipercategorias", {
		     slidesPerView: "auto",
		    spaceBetween: 30,
		    pagination: false,

		  });
	}

}


function ObtenerTableroSucursal(estatus) {

	//return new Promise((resolve, reject) => {
 
	var datos="estatus="+estatus;
	var pagina = "ObtenerTableroSucursal.php";
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: urlphp+pagina,
		data:datos,
		async:false,
		success: function(datos){
			$$(".cardswipersucursal").html('');

			var respuesta=datos.respuesta;
			PintarTableroSucursal(respuesta);
			//resolve(respuesta);
			},error: function(XMLHttpRequest, textStatus, errorThrown){ 
				var error;
				  	if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
				  	if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
								//alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
					console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
			}
		});

	//});
}

function PintarTableroSucursal(respuesta) {
	var html="";
	if (respuesta.length>0) {
				html+=`<div class="swiper-wrapper">`;

		for (var i = 0; i < respuesta.length; i++) {
			html+=`
				<div class="swiper-slide swiper-slide-active" role="group"  style="margin-right: 20px;width:200px;">
				<div class="">
						<div class="card-media" style="width:100%;height:72px;">
						<span class="material-icons-outlined" style="    z-index: 9999;
    position: absolute;
    right: 0;margin-right: 0.5em;margin-top: 0.3em;">favorite_border</span>
							<span  class="">
							<img src="img/logo/middle/logo1.png" alt="" style="height: 100px;width: 100%;">
							</span>
						</div>
						<div class="card-info">
							<h5 class="title">
								<a href="/company-detail/">`+respuesta[i].titulo+`
								</a>
							</h5>
							<p class="location">
							`+respuesta[i].descripcion+`</p>
							<h6 class="text-primary vacancy">
							</h6>
						</div>
					</div>
				</div>
			`;

		}
		html+=`</div>`;


		$$(".cardswipersucursal").html(html);



		 var swiper3 = new Swiper(".cardswipersucursal", {
		     slidesPerView: "auto",
		    spaceBetween: 30,
		    pagination: false,

		  });

	}
}



function ObtenerTableroCitas(estatus) {

	//return new Promise((resolve, reject) => {
 	var idusuarios=1;
	var datos="estatus="+estatus+"&idusuarios="+idusuarios;
	var pagina = "ObtenerTableroCitas.php";
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: urlphp+pagina,
		data:datos,
		async:false,
		success: function(datos){
			

			var respuesta=datos.respuesta;
			PintarTableroCitas(respuesta);
			//resolve(respuesta);
			},error: function(XMLHttpRequest, textStatus, errorThrown){ 
				var error;
				  	if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
				  	if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
								//alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
					console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
			}
		});

	//});
}

function PintarTableroCitas(respuesta) {
	var html="";
	if (respuesta.length>0) {
		$(".titulocitas").css('display','block');
		for (var i = 0; i < respuesta.length; i++) {
			html+=`
			<li class="col-100 medium-50">
				<div class="card-bx job-card">
					<div class="card-media">
						<a href="/job-detail/">
						<img src="img/logo/logo1.png" alt="">
						</a>
					</div>
					<div class="card-info">
						<h6 class="item-title">
						<a href="/job-detail/">
						`+respuesta[i].titulo+`-`+respuesta[i].descripcion+`</a>
						</h6>
					  <div class="list-info">
						<p>`+respuesta[i].fechacita+` `+respuesta[i].horacita+`hrs.</p>
						</div>
						<div class="item-footer">
							<a href="#" class="item-tag">
							</a>
							<h5 class="item-price text-primary">
							</h5>
						</div>
					</div>
					<a href="#" class="bookmark-btn active">
					<i class="fas fa-bookmark"></i>
						<i class="far fa-bookmark">
						</i>
					</a>
				</div>
			</li>
			`;
		}
	}
	$(".tablerocitas").html(html);
}

