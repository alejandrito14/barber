var dynamicSheet1="";
var intervalove=0;
var dynamicSheet4="";
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
			PintarTableroAnuncios2(respuesta);
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
							<a  class="">
							<img src="`+imagen+`" alt="">
							</a>
						</div>
						<div class="card-info">
							<h5 class="title" >
								<a >`+respuesta[i].titulo+`
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

function PintarTableroAnuncios2(respuesta) {
	
	if (respuesta.length>0) {
		var html="";
		html+=`<div class="swiper-wrapper">`;
		for (var i = 0; i <respuesta.length; i++) {
		imagen=urlimagenes+`tableroanuncios/imagenes/`+codigoserv+respuesta[i].imagen;

			   var checked="";
			if (respuesta[i].estatus==1) {

				checked="checked";
			}
			html+=`
				<div class="swiper-slide coverimg" >
				<div class="seleccionador" style="position: absolute;right: 0;z-index:3;display:none;" > <label><input type="checkbox" class="" style="    margin-right: 1.4em;
				    transform: scale(1.5);    height: 15px;width: 20px;" id="cambiopubli_`+respuesta[i].idtableroanuncios+`" onchange="CambioEstatusPublicidad(`+respuesta[i].idtableroanuncios+`)" `+checked+`>
				     </label>
				    </div>
                 <a  class="card margin-bottom coverimg" style="display: contents;">
                 <div class="card-content " style="padding-top:0;padding-bottom:0;">
                 <div class="row">

                	<div class="" style="padding: 0;margin: 0px auto;" >
                        <img src="`+imagen+`" alt="" onclick="" style="width: 100%;border-radius: 10px;margin: 0;padding: 0px;">
                      </div>
                      <div class="" style="width:100%;">
							<h5 class="" style="margin:0;text-align:center;">
								<span style="color:#bdbdbc;">`+respuesta[i].titulo+`
								</span>
							</h5>
							
						</div>

               
                   </div>
                 </div>
                </a>
              </div>

			`;


			
		}

		html+=`</div>`;

		$$(".cardswiper").html(html);


	if(localStorage.getItem('idtipousuario')==0){

		var swiper3 = new Swiper(".cardswiper", {
		    slidesPerView: "auto",
		    spaceBetween: 0,
		    pagination: false,
		    
		  });
	}else{

		var swiper3 = new Swiper(".cardswiper", {
		    slidesPerView: "auto",
		    spaceBetween: 0,
		    pagination: false,
		     autoplay: {
		        delay: 2500,
		        disableOnInteraction: false,
		        },
		  });
	}

			$(".divpublicidad").css('display','block');
	
	}else{

		$(".divpublicidad").css('display','none');
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
			
			imagen=urlimagenes+`categorias/imagenes/`+codigoserv+respuesta[i].foto;

			html+=`
				<div class="swiper-slide" style="width: 50%!important;">
						<a  class="categories-bx">
							<div class="">
								<img src="`+imagen+`" alt="" style="width:80%;">
							</div>


							<h6 class="title">
							
							<span>`+respuesta[i].titulo+`</span></h6>
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

		for (var i = 0; i < respuesta.length; i++) {
			
		imagen=urlimagenes+`sucursal/imagenes/`+codigoserv+respuesta[i].imagen;

		var coordenadas=respuesta[i].ubicacion;
	var lat="";
	var long="";
	var onclick="";
	if (coordenadas!='' && coordenadas!=null) {
	 coordenadas=respuesta[i].ubicacion.split(',');

		lat=coordenadas[0];
		long=coordenadas[1];

		onclick="abrirGoogleMaps('"+lat+"','"+long+"')";
	}
	var estilo="";
	var cantidadsucursal=respuesta.length;
	if (cantidadsucursal>1) {
		estilo="border-bottom:1px solid; ";
	}



		      html+=`
		      <div class=""> 
		      	<div class="row" style="`+estilo+`padding-bottom: 1em;">
			        <div class="col-40" onclick="DetalleSucursal(`+respuesta[i].idsucursal+`)" style="margin-left: 10px;"> 
							<img src="`+imagen+`" alt="" style="width: 100%;">

			        </div>
			        <div class="col-60">
			        	<div class="row" style="    margin-left: 10px;">
								<div class="col-100">
								<p class="title" style="color:black;margin:0;font-size: 18px;margin-bottom: 10px;">
										<a >`+respuesta[i].titulo+`
									</p>
									<p style="font-size: 14px;color:#c7aa6a;line-height: 16px;">
									`+respuesta[i].direccion+`, `+respuesta[i].colonia+`</p>
									
									
								</div>
							
							</div>
							<div class="row" style="
							    margin-top: 1em;    margin-left: 20px;">
							
							</div>

			        </div>
		      

		      </div>

		      </div>


		      `;



		}
	


		$$(".cardswipersucursal").html(html);



		/* var swiper3 = new Swiper(".cardswipersucursal", {
		     slidesPerView: "auto",
		    spaceBetween: 30,
		    pagination: false,

		  });
	    <div class="col-10" style="">
																
								<span style="" class="material-icons-outlined" onclick="AgendarDesdeSucursal(`+respuesta[i].idsucursal+`)">
									calendar_month
									</span>
								</div>

								<div class="col-80" style="">
									<span class="material-icons-outlined" style="font-size:28px;" onclick="`+onclick+`">
									location_on
									</span>

								</div>

		  */

	}
}


function AgendarDesdeSucursal(idsucursal) {
	localStorage.setItem('idsucursal',idsucursal);
	VistaCategoria(idsucursal);
}

function ObtenerTableroCitas(estatus) {
    var fecha="";
	var estatus=1;
	var iduser=localStorage.getItem('id_user');
	var datos="idusuarios="+iduser+"&fechafiltro="+fecha+"&estatus="+estatus+"&hoy=1";
	var pagina = "ObtenerTableroCitasFiltro.php";
	//return new Promise((resolve, reject) => {
 	//var idusuarios=localStorage.getItem('id_user');
	//var datos="estatus="+estatus+"&idusuarios="+idusuarios;
	var pagina = "ObtenerTableroCitasFiltro.php";
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: urlphp+pagina,
		data:datos,
		async:false,
		success: function(datos){
			

			var respuesta=datos.respuesta;
			PintarTableroCitas(respuesta);
			var fecha=datos.fechafiltro;

			$(".fechaactual").text(fecha);

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
	$(".titulocitas").css('display','none');

	if (respuesta.length>0) {
		$(".titulocitas").css('display','block');
		for (var i = 0; i < respuesta.length; i++) {

				imagen=urlimagenes+`sucursal/imagenes/`+codigoserv+respuesta[i].imagen;
				var color="color:black;";
				if (respuesta[i].estatus==0) {
					 color="color:black;";
				}

				if (respuesta[i].estatus==1) {
					color="color:#C7AA6A;";

				}

				if (respuesta[i].estatus==2) {
					color="color:#5ac35b;";
				}

			html+=`
			<li class="col-100 medium-50">
				<div class="card-bx job-card" >
					<div class="card-media">
						<a >
						<img src="`+imagen+`" alt="" onclick="AbrirModalCita(`+respuesta[i].idcita+`)">
						</a>
					</div>
					<div class="card-info">
						<h6 class="item-title">
						<p style="margin:0;color:#d2cfc7;" onclick="AbrirModalCita(`+respuesta[i].idcita+`)" >`+respuesta[i].anio+` </p>
						<a style="color:#1870bc;" onclick="AbrirModalCita(`+respuesta[i].idcita+`)">
							<p style="margin:0;word-break: break-word;">`+respuesta[i].fechaformato+` </p>
						</a>

						<p style="color: #2b952a;font-size: 18px;margin:0;" onclick="AbrirModalCita(`+respuesta[i].idcita+`)">`+respuesta[i].horacita+`hrs.</p>

						</h6>
					  <div class="">
				
						<p style="margin:0;" onclick="AbrirModalCita(`+respuesta[i].idcita+`)">`+respuesta[i].nombreespecialista+`</p>
						<p style="margin:0;" onclick="AbrirModalCita(`+respuesta[i].idcita+`)">`+respuesta[i].titulo+`-`+respuesta[i].descripcion+`</a></p>
						</div>
						<div class="item-footer">

						</div>
					</div>`;
					var onclick="";
					
					if (respuesta[i].checkin==0) {

						onclick="GenerarQrCita2("+respuesta[i].idcita+")";
	
					}else{

						
					}



					html+=`<a  class="bookmark-btn active" onclick="`+onclick+`" >
						<span class="material-icons-outlined" style="font-size: 28px;`+color+`">
							qr_code
						</span>
					</a>`;


				html+=`

				</div>
			</li>
			`;
		}
	}
	$(".tablerocitas").html(html);
}


function GenerarQrCita2(idcita) {
	var iduser=localStorage.getItem('id_user');
	var datos="idcita="+idcita+"&iduser="+iduser;
	var pagina = "ObtenerDetalleCita.php";
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: urlphp+pagina,
		data:datos,
		success: function(datos){

				var respuesta=datos.respuesta;
				const myPromise = new Promise((resolve, reject) => {
				ObtenerDetalleCita(respuesta);	

				});
				
				localStorage.setItem('idcita',idcita);

				myPromise.then((successMessage) => {

				GenerarQrCita(idcita);

				});
			},error: function(XMLHttpRequest, textStatus, errorThrown){ 
				var error;
				  	if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
				  	if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
								//alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
					console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
			}
		});
}

function Obtenerpublicidad(estatus){

	var datos="estatus="+estatus;
	var pagina = "ObtenerPublicidad.php";
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: urlphp+pagina,
		data:datos,
		crossDomain: true,
		cache: false,
		async:false,
		success: function(datos){

			var respuesta=datos.respuesta;
			Pintarpublicidad2(respuesta);

			},error: function(XMLHttpRequest, textStatus, errorThrown){ 
				var error;
				  	if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
				  	if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
								//alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
					console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
			}
		});

}

function Pintarpublicidad(respuesta) {
		$("·divpublicidad").css('display','none');

	if (respuesta.length>0) {
		$("·divpublicidad").css('display','block');
		var html="";
		html+=`<div class="swiper-wrapper">`;
		for (var i = 0; i <respuesta.length; i++) {
			   		imagen=urlimagenes+`publicidad/imagenes/`+codigoserv+respuesta[i].imagen;

			   var checked="";
			if (respuesta[i].estatus==1) {

				checked="checked";
			}
			html+=`
				<div class="swiper-slide coverimg" >
				<div class="seleccionador" style="position: absolute;right: 0;z-index:3;display:none;" > <label><input type="checkbox" class="" style="    margin-right: 1.4em;
				    transform: scale(1.5);    height: 15px;width: 20px;" id="cambiopubli_`+respuesta[i].idpublicidad+`" onchange="CambioEstatusPublicidad(`+respuesta[i].idpublicidad+`)" `+checked+`>
				     </label>
				    </div>
                 <a  class="card margin-bottom coverimg" style="display: contents;">
                 <div class="card-content card-content-padding " style="padding-top:0;padding-bottom:0;    padding-right: 1.5em;">
                 <div class="row">

                	<div class="" style="padding: 0;margin: 0px auto;" onclick="DetallePromocion(`+respuesta[i].idpublicidad+`)">
                        <img src="`+imagen+`" alt="" onclick="" style="width: 100%;border-radius: 10px;margin: 0;padding: 0px;"">
                      </div>


               
                   </div>
                 </div>
                </a>
              </div>

			`;
		}

		html+=`</div>`;

		$$(".cardpublicidad").html(html);


	if(localStorage.getItem('idtipousuario')==0){

		var swiper2 = new Swiper(".cardpublicidad", {
		    slidesPerView: "auto",
		    spaceBetween: 0,
		    pagination: false,
		    
		  });
	}else{

		var swiper2 = new Swiper(".cardpublicidad", {
		    slidesPerView: "auto",
		    spaceBetween: 0,
		    pagination: false,
		     autoplay: {
		        delay: 2500,
		        disableOnInteraction: false,
		        },
		  });
	}

			$(".divpublicidad").css('display','block');
	
	}else{

		$(".divpublicidad").css('display','none');
	}
	

}

function Pintarpublicidad2(respuesta) {
	if (respuesta.length>0) {
		var html="";
		html+=`<div class="swiper-wrapper">`;
		for (var i = 0; i <respuesta.length; i++) {
		imagen=urlimagenes+`publicidad/imagenes/`+codigoserv+respuesta[i].imagen;

			   var checked="";
			if (respuesta[i].estatus==1) {

				checked="checked";
			}
			html+=`
				<div class="swiper-slide coverimg" >
				<div class="seleccionador" style="position: absolute;right: 0;z-index:3;display:none;" > <label><input type="checkbox" class="" style="    margin-right: 1.4em;
				    transform: scale(1.5);    height: 15px;width: 20px;" id="cambiopubli_`+respuesta[i].idpublicidad+`" onchange="CambioEstatusPublicidad(`+respuesta[i].idpublicidad+`)" `+checked+`>
				     </label>
				    </div>
                 <a  class="card margin-bottom coverimg" style="display: contents;">
                 <div class="card-content  " style="padding-top:0;padding-bottom:0; ">
                 <div class="row">

                	<div class="" style="padding: 0;margin: 0px auto;" >
                        <img src="`+imagen+`" alt="" onclick="" style="width: 100%;border-radius: 10px;margin: 0;padding: 0px;"">
                      </div>
                      <div class="card-info">
							
							
						</div>

               
                   </div>
                 </div>
                </a>
              </div>

			`;
		}

		html+=`</div>`;

		$$(".cardpublicidad").html(html);


	if(localStorage.getItem('idtipousuario')==0){

		var swiper4 = new Swiper(".cardpublicidad", {
		    slidesPerView: "auto",
		    spaceBetween: 0,
		    pagination: false,
		    
		  });
	}else{

		var swiper4 = new Swiper(".cardpublicidad", {
		    slidesPerView: "auto",
		    spaceBetween: 0,
		    pagination: false,
		     autoplay: {
		        delay: 2500,
		        disableOnInteraction: false,
		        },
		  });
	}

			$(".divpublicidad").css('display','block');
	
	}else{

		$(".divpublicidad").css('display','none');
	}

}


function ObtenerCategorias(estatus) {

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
			$$(".welcome-swiper").html('');

			var respuesta=datos.respuesta;
			PintarCategorias(respuesta);
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

function PintarCategorias(respuesta) {
	var html="";
	if (respuesta.length>0) {
		html+=`<div class="swiper-wrapper">`;
		for (var i = 0; i < respuesta.length; i++) {
			
			imagen=urlimagenes+`categorias/imagenes/`+codigoserv+respuesta[i].foto;

			html+=`
				<div class="swiper-slide">
						<div class="card card-bx card-featured listacategorias" style="width: 50%;height:100px;" id="cat_`+respuesta[i].idcategorias+`" onclick="ElegirCategoria(`+respuesta[i].idcategorias+`)">
							<div class="icon-bx">
								<img src="`+imagen+`" alt="" style="width:100%;">
							</div>
							<div class="dz-info">
								<h5 class="title">`+respuesta[i].titulo+`</h5>
								
							</div>
						</div>
					</div>


			`;
		}
		html+=`</div>`;
	}

			$$(".welcome-swiper").html(html);


	var swiper3 = new Swiper(".welcome-swiper", {
		    slidesPerView: "auto",
		    spaceBetween: 0,
		    pagination: false,
		    
		  });
}

function ElegirCategoria(idcategoria) {

	$(".listacategorias").removeClass('bordecategoria');
	$("#cat_"+idcategoria).addClass('bordecategoria');
	localStorage.setItem('idcategoriaelegida',idcategoria);
}

function DetallePromocion(idpublicidad) {
	var datos="idpublicidad="+idpublicidad;
	var pagina = "ObtenerDetallePromocion.php";
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: urlphp+pagina,
		data:datos,
		async:false,
		success: function(datos){
			
			var respuesta=datos.respuesta;
			PintarDetallePromocion(respuesta);
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

function PintarDetallePromocion(respuesta) {
	
var html=` <div class="sheet-modal my-sheet-swipe-to-close1" style="height: 100%;background: none;">
            <div class="toolbar">
              <div class="toolbar-inner">
                <div class="left"></div>
                <div class="right">
                  <a class="link sheet-close"></a>
                </div>
              </div>
            </div>
            <div class="sheet-modal-inner" style="background: white;border-top-left-radius: 20px;border-top-right-radius:20px; ">
            	 <div class="iconocerrar link sheet-close" style="z-index:10;">
	 														<span class="material-icons-outlined">
																		cancel
																		</span>
	   						    	 </div>
              <div class="page-content" style="height: 100%;">
                <div style="background: white; height: 100%;width: 100%;border-radius: 20px;">
   						     <div class="row">
	   						     <div class="col-20">
	   						      	
	   						    </div>

   						    	 <div class="col-60">
   						    	 <span class="titulomodal"></span>
   						    	 </div>
   						    	 <div class="col-20">
   						    	 <span class="limpiarfiltros"></span>
   						    	 </div>
   							 </div>
   							 <div class="" style="position: absolute;top:2em;width: 100%;">
   							 	
	   							  <div class="">
		   							  <div class="block" style="margin-right:1em;margin-left:1em;">
		   							 	 
		   							  	<div class="row">
		   							  		<h1 class=" margin-bottom" style="font-size:24px;text-align:center;">
								             `+respuesta.titulo+`
								             </h1>
		   							  	</div>
		   							 	 <div class="row margin-bottom">
									        <div class="col-100 no-padding-horizontal">
										        
										          </div>
									        </div>
								      </div>
		   							 			`;

		   							 			//var descripcion= respuesta.descripcion;

/*		   							 			var dividircadena=descripcion.replace('|','<br>');
*/
		   							 	html+=`</div>

		   							 		<div class="row">
			   							  		<p class=" margin-bottom" style="font-size:18px;text-align: justify;">
									             
									             </p>
		   							  		</div>

		   							  		<div class="row margin-bottom " style="padding-top: 1em;">
		   							  		<div class="col-100">`;
		   							  		if (respuesta.url!='' && respuesta.url!=null) {
		   							  		html+=`<button class="button button-fill button-large color-theme button-raised margin-bottom-half btnmisservicios" onclick="showArchivo('`+respuesta.url+`')">
		   							  			<i class="bi bi-globe2 margin-horizontal-half">
		   							  			</i>
		   							  			Visitar
		   							  			
		   							  			</button>`;
		   							  		}

		   							  		html+=`</div>
		   							  		</div>

	   							 	</div>

   							 </div>

   				</div>
                
              </div>
            </div>
          </div>`;
          
	 var dynamicSheet1 = app.sheet.create({
        content: html,

    	swipeToClose: true,
        backdrop: true,
        // Events
        on: {
          open: function (sheet) {
           


			 var swiper = new Swiper('.swiper-imagenes', {

				      pagination: {
				        el: '.swiper-pagination',
				       dynamicBullets:true,
				      },
				     /* slideToClickedSlide: true,
				      lazyLoading:true,*/
				   		

				    });

			

          },
          opened: function (sheet) {
            console.log('Sheet opened');
          },
        }
      });

       dynamicSheet1.open();
}

function ObtenerIntereses() {

	var pagina = "ObtenerIntereses.php";
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: urlphp+pagina,
		async:false,
		success: function(datos){

			var respuesta=datos.respuesta;
			PintarIntereses(respuesta);
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

function PintarIntereses(respuesta) {
	var html="";
	if (respuesta.length>0) {
		for (var i = 0; i < respuesta.length; i++) {
			html+=`
				<div class="col-100" style="
   						 margin-top: .5em;margin-bottom:.5em; border-radius: 10px;color:white;
    background: #C7AA6A;" onclick="GuardarInteres(`+respuesta[i].idintereses+`)" id="interes_`+respuesta[i].idintereses+`">
					<p style="    text-align: center;
    margin: 3px;word-break: break-all;line-height:2;">
					`+respuesta[i].interes+`</p>
					</div>

			`;
		}
	}
	$(".listadointeres").html(html);
}

var arrayinteres=[];
function GuardarInteres(idintereses) {
	if ($("#interes_"+idintereses).hasClass('interesseleccionado')) {

		$("#interes_"+idintereses).removeClass('interesseleccionado');
		BorraInteres(idintereses);
	}else{
		$("#interes_"+idintereses).addClass('interesseleccionado');
		arrayinteres.push(idintereses);
	}

}

function BorraInteres(idinteres) {
	if (arrayinteres.length>0) {
		for (var i = 0; i < arrayinteres.length; i++) {
			
			if (arrayinteres[i]==idinteres) {
				arrayinteres.splice(idinteres,1);
			}
		}
	}
}

function GuardarIntereses() {
	var iduser=localStorage.getItem('id_user');
	var datos="iduser="+iduser+"&arrayinteres="+arrayinteres;
	var pagina = "GuardarIntereses.php";
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: urlphp+pagina,
		data:datos,
		async:false,
		success: function(datos){

			var respuesta=datos.respuesta;
			localStorage.removeItem('idusuarioinvitado');
			   GoToPage("home");

			
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
function CargarDatos() {
	  //ObtenerTableroAnuncios(1);
     // ObtenerTableroCategorias(1);
      ObtenerTableroSucursal(1);
      ObtenerTableroCitas(1);
      Obtenerpublicidad(1);
      ObtenerDetalleEmpresa();
    PintarCantidadcarrito();
    ObtenerFechaActual();
	$(".divhoy").attr('onclick','ObtenerTableroCitas(1);');
    $(".liconfiguracion").css('display','none');

	$(".divcalendario").attr('onclick','AbrirCalendarioUsuario()');

     var nombre= localStorage.getItem("nombre");
     $(".nombreusuario").text(nombre);


     var os=  localStorage.getItem("SO");
       $(".bcantidadcarrito").css('right','3em');

     if (os=='ios') {
     	$(".bcantidadcarrito").css('right','3em');
     }
}


function Cargarperfilfoto() {
	
	var pagina = "Obtenerdatospersonales.php";
	var id_user=localStorage.getItem('id_user');
	var datos="id_user="+id_user;
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: urlphp+pagina,
		crossDomain: true,
		cache: false,
		data:datos,
		success: function(datos){

			var respuesta=datos.respuesta;
			var confi=datos.confi;
		
			if (respuesta.foto!='' && respuesta.foto!='null' && respuesta.foto!=null ) {

				localStorage.setItem('foto',respuesta.foto)

			}else{
				if (respuesta.sexo=='M') {
					foto=confi.avatarmujer;
				}
				else{
					foto=confi.avatarhombre;
				}

				localStorage.setItem('avatar',foto);

				localStorage.setItem('foto','');

			}

			if (respuesta.nombre==null) {
				respuesta.nombre='';
			}
			if (respuesta.paterno==null) {
				respuesta.paterno='';
			}
			if (respuesta.materno==null) {
				respuesta.materno='';
			}
			var nombre=respuesta.nombre+' '+respuesta.paterno+' '+respuesta.materno;
			$("#txtnombre").text(nombre);

			CargarFoto();

			},error: function(XMLHttpRequest, textStatus, errorThrown){ 
				var error;
				  	if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
				  	if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
								//alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
					console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
			}
		});
}

function DetalleSucursal(idsucursal) {
	localStorage.setItem('idsucursal',idsucursal);
	GoToPage('detallesucursal');
}

function IraCarrito() {
	GoToPage('carrito');
}

function AbrirModalCita(idcita) {
var iduser=localStorage.getItem('id_user');
	var datos="idcita="+idcita+"&iduser="+iduser;
	var pagina = "ObtenerDetalleCita.php";
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: urlphp+pagina,
		data:datos,
		success: function(datos){

			var respuesta=datos.respuesta;
				ObtenerDetalleCita(respuesta);	
				localStorage.setItem('idcita',idcita);
			},error: function(XMLHttpRequest, textStatus, errorThrown){ 
				var error;
				  	if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
				  	if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
								//alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
					console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
			}
		});
	

}

function ObtenerDetalleCita(respuesta) {
		var imagen=urlimagenes+`sucursal/imagenes/`+codigoserv+respuesta.imagen;

	var html2="";

	var coordenadas=respuesta.ubicacion;
	var lat="";
	var long="";
	if (coordenadas!='') {
	 coordenadas=respuesta.ubicacion.split(',');

		lat=coordenadas[0];
		long=coordenadas[1];
	}
		var llamada="";
	if (respuesta.celular!='') {
		llamada="hacerLlamada('"+respuesta.celular+"')";
	}

var html=` <div class="sheet-modal my-sheet-swipe-to-close1" style="height: 100%;background: white;">
            <div class="toolbar" style="background: white;margin-top: 1em;">
              <div class="toolbar-inner">
                <div class="left"></div>
                <div class="right">
                  <a class="link sheet-close"></a>
                </div>
              </div>
            </div>
            <div class="sheet-modal-inner" style="background: white;border-top-left-radius: 20px;border-top-right-radius:20px; ">
            	 <div class="iconocerrar link sheet-close" style="z-index:10;">
	 		<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M25.5188 4.48126C23.4385 2.4011 20.788 0.984547 17.9026 0.410715C15.0171 -0.163118 12.0264 0.131546 9.30839 1.25744C6.59043 2.38334 4.26736 4.28991 2.63294 6.73606C0.998525 9.18221 0.12616 12.0581 0.12616 15C0.12616 17.9419 0.998525 20.8178 2.63294 23.264C4.26736 25.7101 6.59043 27.6167 9.30839 28.7426C12.0264 29.8685 15.0171 30.1631 17.9026 29.5893C20.788 29.0155 23.4385 27.5989 25.5188 25.5188C26.9003 24.1375 27.9961 22.4976 28.7437 20.6928C29.4914 18.888 29.8762 16.9535 29.8762 15C29.8762 13.0465 29.4914 11.1121 28.7437 9.30724C27.9961 7.50242 26.9003 5.86255 25.5188 4.48126ZM20.3126 18.7613C20.4187 18.8606 20.5034 18.9808 20.5612 19.1142C20.6191 19.2476 20.6489 19.3915 20.6489 19.5369C20.6489 19.6823 20.6191 19.8262 20.5612 19.9596C20.5034 20.093 20.4187 20.2131 20.3126 20.3125C20.2133 20.411 20.0956 20.4889 19.9661 20.5418C19.8367 20.5946 19.698 20.6214 19.5582 20.6206C19.2795 20.6195 19.0124 20.5088 18.8145 20.3125L15.0001 16.4981L11.2388 20.3125C11.0409 20.5088 10.7738 20.6195 10.4951 20.6206C10.3553 20.6214 10.2166 20.5946 10.0872 20.5418C9.95773 20.4889 9.83999 20.411 9.74071 20.3125C9.54282 20.1134 9.43174 19.8441 9.43174 19.5634C9.43174 19.2827 9.54282 19.0135 9.74071 18.8144L13.502 15L9.74071 11.2388C9.56665 11.0355 9.47569 10.774 9.48602 10.5066C9.49635 10.2392 9.6072 9.98557 9.79642 9.79635C9.98565 9.60712 10.2393 9.49627 10.5067 9.48594C10.7741 9.47561 11.0356 9.56657 11.2388 9.74063L15.0001 13.5019L18.7613 9.74063C18.8597 9.63878 18.9772 9.55729 19.107 9.50083C19.2369 9.44437 19.3766 9.41404 19.5182 9.41158C19.6598 9.40911 19.8004 9.43456 19.9322 9.48646C20.0639 9.53836 20.1842 9.6157 20.286 9.71407C20.3879 9.81244 20.4694 9.9299 20.5258 10.0598C20.5823 10.1896 20.6126 10.3293 20.6151 10.4709C20.6175 10.6125 20.5921 10.7532 20.5402 10.8849C20.4883 11.0167 20.411 11.1369 20.3126 11.2388L16.4982 15L20.3126 18.7613Z" fill="#AAAAAA"></path>
            </svg>
	   						    	 </div>
              <div class="page-content" style="height: 100%;">
                <div style="background: white; height: 100%;width: 100%;border-radius: 20px;">
   						     <div class="row">
	   						     <div class="col-20">
	   						      	
	   						    </div>

   						    	 <div class="col-60">
   						    	 <span class="titulomodal" style="">Tu cita</span>
   						    	 </div>
   						    	 <div class="col-20">
   						    	 <span class="limpiarfiltros"></span>
   						    	 </div>
   							 </div>
   							 <div class="" style="position: absolute;top:1em;width: 100%;">
   							 	
	   						<div class="">
		   				   <div class="" style="">
		   					<div class="" style="">
		   							 	 
							<div class="row">
					<div class="col-100" style="margin-left: 1em;margin-right: 1em;">
                <div class="card margin-bottom">
                    <div class="card-header">
                    <div class="datoscita">
                        <div class="row " >
                            
                            <div class="col-50">
                                <h3 class="no-margin-bottom text-color-theme">`+respuesta.titulo+`</h3>
                            	<p class="no-margin-bottom text-color-theme">`+respuesta.descripcion+`</p>

                            	<p class="no-margin-bottom text-color-theme">`+respuesta.fechaformato+`</p>
                            	<p class="no-margin-bottom text-color-theme">`+respuesta.horainicial+` Hrs.</p>

                            	<p class="no-margin-bottom text-color-theme">Barbero: `+respuesta.nombre+` `+respuesta.paterno+`</p>`;

                            if(respuesta.checkin==1) {
                            
                            	html+=` <p class="" style="display: flex;"><span>check-in:</span> <span class="material-icons-outlined" 
                            	style=" width: 30px;justify-content: center;font-size: 20px;color:#5ac35b;">
																														check_circle_outline
																														</span>
																													</p>`;	
                            
                            }
                            html+=`
                        	<p class="no-margin-bottom text-color-theme">`+respuesta.concepto+`</p>

                            </div>

                            <div class="col-50">
                                <div class="avatar">
                                    <img src="`+imagen+`" alt="" style="
																																			margin-top: 1.4em;    width: 100%;
																																			    border-radius: 10px;
																																			">
                                </div>
                            </div>
                            </div>

                            <div class="row">
                        	<div class="imagenqr" style="    justify-content: center;display: flex;"></div>
                        </div>
                        </div>

                        

                        
                        	<div class="" style="">
                        		<div class="row ">
                        			<div class="calificacion"></div>
                        		 </div>
                        	</div>
                       
                    </div>
                    <div class="card-content card-content-padding">
                        <p class="text-muted margin-bottom">
                           
                        </p>
                        
                    </div>
                </div>
            </div>
							   							  	</div>
		   							 	 
		   							 			</div>

		   	<div class="opcionescita">						 			
		   	<div class="row" style="margin-right: 2em; margin-left: 2em;    margin-top: 1em;">
				<div class="col" onclick="`+llamada+`">
					<span style="justify-content: center;
    display: flex;" class="material-icons-outlined">call</span>
					<h5 class="mt-5 mb-0 telefono" style="font-size: 12px;text-align: center;">¿Necesitas un cambio?</h5>
				</div>
				<div class="col" onclick="abrirGoogleMaps('`+lat+`','`+long+`')">
					<span style="justify-content: center;
    display: flex;" class="material-icons-outlined">location_on</span>
					<h5 class="mt-5 mb-0" style="font-size: 12px;text-align: center;">Encuentra la sucursal</h5>
				</div>

				<div class="col" onclick="CalificarCita(`+respuesta.idcita+`)">
					<span style="justify-content: center;
    display: flex;" class="material-icons-outlined">grade</span>

					<h5 class="mt-5 mb-0" style="font-size: 12px;text-align: center;">Califica</h5>
				</div>`;

				if (respuesta.checkin==0) {
			/*	html+=`<div class="col" onclick="GenerarQrCita(`+respuesta.idcita+`)">
					<span style="justify-content: center;
    display: flex;" class="material-icons-outlined">qr_code</span>

					<h5 class="mt-5 mb-0" style="font-size: 12px;text-align: center;">Mostrar Qr</h5>
				</div>`;*/

			}

			html+=`
			</div>
			
					<div class="row" style=" margin-right: 2em; margin-left: 2em;">
						<div class="col-80">
							<p style="font-size: 16px;font-weight: bold;margin-left: 1em;">Galeria de imágenes</p>
						</div>
						<div class="col-20" >
							
						</div>
					</div>
		

			<div class="" style="
    margin-right: 2em;
    margin-left: 2em;
    margin-bottom: 100px;
">
				<div class="">
						<div class="listadoimagenescita" style="width:100%;">
						</div>
				</div>
</div>
		
				<div class="row" style="height:200px;">
                          
                            
                            
                        </div>
					
		</div>		   							  	
           												 </div>
							   							  	</div>
		   							 	 
		   							 			`;

		   							
		   							 	html+=`</div>
	  	
		   							 		<div class="row">`;

		   							 	


		   							  		html+=`</div>

		   							  		<div class="row margin-bottom " style="padding-top: 1em;">
		   							  		<div class="col-100">`;
		   							  		


		   							  		html+=`</div>
		   							  		</div>



	   							 	</div>

   							 </div>

   				</div>
                
              </div>
            </div>
          </div>`;
          
	  dynamicSheet1 = app.sheet.create({
        content: html,

    	swipeToClose: true,
        backdrop: true,
        // Events
        on: {
          open: function (sheet) {

          	if (respuesta.checkin==0) {
          		GenerarQrCita(respuesta.idcita);
          	}
           	ObtenerImagenescitaCliente();

			

          },
          opened: function (sheet) {
            console.log('Sheet opened');
          },
          close:function (sheet) {
          	// BorrarIntervalo();
          	 clearInterval(intervalove);

									localStorage.setItem('idqrgenerado','');
             ObtenerTableroCitas(1);
          },
        }
      });

       dynamicSheet1.open();
}

function RegresarLanding() {
	GoToPage('welcome');
}

function GenerarQrCita(idcita) {
	var id_user=localStorage.getItem('id_user');
	var datos="id_user="+id_user+"&idcita="+idcita;
	var pagina = "generarqr.php";
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: urlphp+pagina,
		data:datos,
		success: function(datos){	
			var respuesta=datos;
			var ruta=urlphp+'/upload/qrgenerado/'+datos.imgqr;
			localStorage.setItem('idqrgenerado',datos.idqrgenerado);
		

			//$(".datoscita").css('display','none');
			$(".imagenqr").html('<img src="" id="colocarqr" alt="" style="width:80%"/>');

			$("#colocarqr").attr('src',ruta.trim());

				//countdown(agregaMinutos(new Date(), .50).toString(), 'clock', '');
		 intervalove=setInterval('VerificarSihasidoleido()',1000);

			
			},error: function(XMLHttpRequest, textStatus, errorThrown){ 
				var error;
				  	if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
				  	if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
								//alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
					console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
			}
		});
}

function VerificarSihasidoleido() {
		var id_user=localStorage.getItem('id_user');
		var idcita=localStorage.getItem('idcita');
		var idqrgenerado=localStorage.getItem('idqrgenerado');
		var datos="id_user="+id_user+"&idcita="+idcita+"&idqrgenerado="+idqrgenerado;
		var pagina = "VerificarSihasidoleido.php";
		$.ajax({ 
			type: 'POST',
			dataType: 'json',
			url: urlphp+pagina,
			data:datos,
			success: function(resultado){	
				var respuesta=resultado.respuesta;

				if (respuesta==1) {
					
					 clearInterval(intervalove);
					 dynamicSheet1.close();
					 dynamicSheet1.destroy();
					 var datosqr=resultado.datosqr[0];
					AbrirValidacionQr(datosqr);
					
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


function AbrirValidacionQr(datos) {
			
var html=` <div class="sheet-modal my-sheet-swipe-to-close1" style="height: 100%;">
            <!--<div class="toolbar">
              <div class="toolbar-inner">
                <div class="left"></div>
                <div class="right">
                  <a class="link sheet-close"></a>
                </div>
              </div>
            </div>--!>
            <div class="sheet-modal-inner" style="background: white;border-top-left-radius: 20px;border-top-right-radius:20px; ">
            	 
              <div class="page-content" style="height: 100%;">
                <div style="background: white; height: 100%;width: 100%;border-radius: 20px;">
   						     <div class="row">
	   						     <div class="col-20">
	   						      	
	   						    </div>

   						    	 <div class="col-60">
   						    	 <span class="titulomodal"></span>
   						    	 </div>
   						    	 <div class="col-20">
   						    	 <span class="limpiarfiltros"></span>
   						    	 </div>
   							 </div>
   							 <div class="" style="position: absolute;top:2em;width: 100%;">
   							 	
	   							  <div class="">
		   							  <div class="block" style="margin-right:1em;margin-left:1em;">
		   									

		   							  		<div class="card-content" style="margin-top:6em;">
		   										<div class="row">
			   										<div class="col-100">
			   											<h3 style="margin-left: 1em;
    margin-right: 1em;
    text-align: center;">Tu código qr se ha leído exitosamente</h3>
			   										</div>
		   										</div>
		   									</div>
		   				
		   							 		<div class="card-content ">
		   							 		<div class="row">
		   							 		<div class="col-100">
			   							 		<div class="" style="margin-top:1em;">
			   							 		

																<span class="material-icons-outlined" style=" width: 30px;
																    justify-content: center;
																    font-size: 100px;
																    display: flex;
																    margin: auto;color:#5ac35b;">
																			check_circle_outline
																			</span>
			   							 		</div>
		   							 		</div>
		   							 		<div class="col-100" style="margin-top:1em;">
		   		
		   							 		
			   							 		
			   							 	
																		<a onclick="CerrarModal()" class="button-large button button-fill color-theme button-raised">
													                  Cerrar
													    </a>		   		
											
		   						

			   							 		</div>
			   							 		<div class="col-100">
			   							 		</div>
		   							 		</div>
		   							 		<div class="row">
		   							 			<div class="col">
		   							 					</div>
		   							 				</div>
		   							 			</div>
		   							 		</div>

		   							 		</div>
		   							 		<div class="row">
		   							 			<div class="col">
		   							 			<h4 style="
												    text-align: center;
												    font-size: 28px;
												    color: red;
												    padding-top: 1em;
												"></h4>
		   							 			</div>
		   							 		</div>
		   							 		<div class="row" style="margin-top:6em;">
		   									
											 
											</div>
										</div>
		   				

										</div>

	   							 	</div>

   							 </div>

   				</div>
                
              </div>
            </div>
          </div>`;
          
	  dynamicSheet4 = app.sheet.create({

        content: html,

    	swipeToClose: true,
        backdrop: true,
        // Events
        on: {
          open: function (sheet) {
		
					
          },
          opened: function (sheet) {
          
          },

          close:function () {
          	 AbrirModalCita(datos.idcita);
          }
        }
      });

       dynamicSheet4.open();
	}

	function CerrarModal() {

		dynamicSheet4.close();
	}

	
function ObtenerPolitica() {
	var pagina = "ObtenerConfiguracion.php";
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: urlphp+pagina,
		async:false,
		success: function(datos){

			
			var cadena =datos.respuesta.politicaprivacidad;

			$(".textopoliticas").html('<p style="text-align:justify;">'+cadena+'</p>');

			},error: function(XMLHttpRequest, textStatus, errorThrown){ 
				var error;
				  	if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
				  	if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
								//alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
					console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
			}
		});
}


function entrarinvitado() {
	  return new Promise((resolve, reject) => {

	
	resolve(CrearUsuarioInvitado());

	});
	

}

function CrearUsuarioInvitado() {

	if (localStorage.getItem("idusuarioinvitado")!=undefined && localStorage.getItem("idusuarioinvitado")!=null && localStorage.getItem("idusuarioinvitado")!=0) {
				var idusuario=localStorage.getItem("idusuarioinvitado");
				localStorage.setItem("id_user",idusuario);
				localStorage.setItem("idusuarioinvitado",idusuario);
				localStorage.setItem('pregunta',1);
    			localStorage.setItem('session',1);
				localStorage.setItem("nombre","Invitado");
				localStorage.removeItem('carrito');
				localStorage.setItem('invitado',1);
				localStorage.setItem('idtipousuario',6);
				//GoToPage("home");
	}else{

		var pagina = "CrearUsuarioInvitado.php";
		$.ajax({
		type: 'POST',
		dataType: 'json',
		url: urlphp+pagina,
		async:false,
		success: function(resp){
				var idusuario=resp.id_user;
				localStorage.setItem("id_user",idusuario);
				localStorage.setItem("idusuarioinvitado",idusuario);
				localStorage.setItem('pregunta',1);
    			localStorage.setItem('session',1);
				localStorage.setItem("nombre","Invitado");
				localStorage.removeItem('carrito');
				localStorage.setItem('invitado',1);
				localStorage.setItem('idtipousuario',6);
				//GoToPage("home");
			
			},error: function(XMLHttpRequest, textStatus, errorThrown){ 
				var error;
				  	if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
				  	if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
								//alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
					console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
			}
		});

	}

	
}

function CerrarCalificacion() {
			$(".opcionescita").css('display','block');
			$(".datoscita").css('display','block');
			$(".calificacion").css('display','none');
}
function CalificarCita(idcita){

       var html=`
         
              <div class="block">
               <div class="row">
                  
                <div class="col" >
                	<div>
                	 <i class=" iconosestrella " id="estre_1"  onclick="Cambio(1)">
                	 	<span class="material-icons-outlined">
						star
						</span>
                	   </i>
	                	 <div class="oculto">
	                	 <input type="checkbox"  id="che_1" >
	                	</div>
                	</div>
               
               </div>
                 <div class="col"  >
                 	<div >
	                  <i class="bi bi-star iconosestrella " id="estre_2" onclick="Cambio(2)">
	                  <span class="material-icons-outlined">
						star
						</span>
	                  </i>
	               		<input type="checkbox" class="oculto" id="che_2"  >
               		</div>
                </div>
                <div class="col" >
	                  <div  >
		                   <i class="bi bi-star iconosestrella " id="estre_3" onclick="Cambio(3)" >
		                   <span class="material-icons-outlined">
						star
						</span>
		                   </i>
		                	<input type="checkbox" class="oculto" id="che_3"  >
	                  </div>
                 </div>
                   <div class="col" >
                   <div  >
                   	    <i class="bi bi-star iconosestrella " id="estre_4" onclick="Cambio(4)">
                   	    <span class="material-icons-outlined">
						star
						</span>
                   	    </i>
                 		<input type="checkbox" class="oculto" id="che_4" >
                 	</div>
                  </div>
                    <div class="col" >   
	                    <div  >              
	                     	 <i class="bi bi-star iconosestrella " id="estre_5" onclick="Cambio(5)" >
	                     	 <span class="material-icons-outlined">
						star
						</span>
	                     	 </i>
	                 		 <input type="checkbox" class="oculto" id="che_5"  >
	                   	</div>
                    </div>
               

                </div>

                <div class="row" style="padding-top:1em;">
                	<label style="font-size:16px;padding:1px;">Comentarios:</label>
                	<textarea name="" id="txtcomentario" cols="30" rows="3"></textarea>
                </div>
              </div>
           
         
        `;
       app.dialog.create({
          title: 'Califica cita',
          //text: 'Dialog with vertical buttons',
          content:html,
          buttons: [
            {
              text: 'Cancelar',
            },
            {
              text: 'Calificar',
            },
            
          ],
           onClick: function (dialog, index) {
                    if(index === 0){
               
          }
          else if(index === 1){
             	GuardarCalificacion(idcita);

            }
           
        },
          verticalButtons: false,
        }).open();
	/*var calificacion=respuesta.calificacion;
	if (calificacion.length>0) {
		var cantidad=calificacion[0].calificacion;
		Cambio(cantidad);
		disableClicks();
		$("#txtcomentario").val(calificacion[0].comentario);
		$("#txtcomentario").attr('disabled',true);

	}*/
}
function CalificarCita2(idcita) {
		$(".datoscita").css('display','none');
		$(".opcionescita").css('display','none');

	var html="";
		html+=`
			<div class="row" style="margin-top: 2em;">
                  
                <div class="col-20" >
                	<div>
                	 <span  id="estre_1"  onclick="Cambio(1)" style="font-size:20px;"><span class="material-icons-outlined">
						star
						</span>
						</span>
	                	 <div class="oculto">
	  
	                	 <input type="checkbox"  id="che_1" >
	                	</div>
                	</div>
               
               </div>
                 <div class="col-20"  >
                 	<div >
                	 <span  id="estre_2"  onclick="Cambio(2)" style="font-size:20px;">
<span class="material-icons-outlined">
star
</span>
                	 </span>
	               		<input type="checkbox" class="oculto" id="che_2"  >
               		</div>
                </div>
                <div class="col-20" >
	                  <div  >
                	 <span  id="estre_3"  onclick="Cambio(3)" style="font-size:20px;">
						<span class="material-icons-outlined">
						star
						</span>
                	 </span>
		                	<input type="checkbox" class="oculto" id="che_3"  >
	                  </div>
                 </div>
                   <div class="col-20" >
                   <div  >
                	 <span  id="estre_4"  onclick="Cambio(4)" style="font-size:20px;">
                	 <span class="material-icons-outlined">
					star
					</span>
                	 </span>
                 		<input type="checkbox" class="oculto" id="che_4" >
                 	</div>
                  </div>
                    <div class="col-20" >   
	                    <div  >              
                	 <span  id="estre_5"  onclick="Cambio(5)" style="font-size:20px;">
<span class="material-icons-outlined">
star
</span>
                	 </span>
	                 		 <input type="checkbox" class="oculto" id="che_5"  >
	                   	</div>
                    </div>

                    </div>
                    <div class="row" style="padding-top:1em;">
                    <div class="col-20" >   
	                    <div  >              
                	 <span  id="estre_6"  onclick="Cambio(6)" style="font-size:20px;">
<span class="material-icons-outlined">
star
</span>
                	 </span>
	                 		 <input type="checkbox" class="oculto" id="che_6"  >
	                   	</div>
                    </div>

                    <div class="col-20" >   
	                    <div  >              
                	 <span  id="estre_7"  onclick="Cambio(7)" style="font-size:20px;">
<span class="material-icons-outlined">
star
</span>
                	 </span>
	                 		 <input type="checkbox" class="oculto" id="che_7"  >
	                   	</div>
                    </div>
               	

               		<div class="col-20" >   
	                    <div  >              
                	 <span  id="estre_8"  onclick="Cambio(8)" style="font-size:20px;">
<span class="material-icons-outlined">
star
</span>
                	 </span>
	                 		 <input type="checkbox" class="oculto" id="che_8"  >
	                   	</div>
                    </div>

                    <div class="col-20" >   
	                    <div  >              
                	 <span  id="estre_9"  onclick="Cambio(9)" style="font-size:20px;">
<span class="material-icons-outlined">
star
</span>
                	 </span>
	                 		 <input type="checkbox" class="oculto" id="che_9"  >
	                   	</div>
                    </div>

                    <div class="col-20" >   
	                    <div  >              
                	 <span  id="estre_10"  onclick="Cambio(10)" style="font-size:20px;">
					<span class="material-icons-outlined">
					star
					</span>
                	 </span>
	                 		 <input type="checkbox" class="oculto" id="che_10"  >
	                   	</div>
                    </div>

                </div>


                <div class="row" style="padding-top:1em;">
                	<label style="font-size:16px;padding:1px;">Comentarios:</label>
                	<textarea name="" id="txtcomentario" cols="30" rows="3" style="color:black;"></textarea>
                </div>
              </div>

              <div class="row">
   <div class="col">
    
     <a id="btneliminarcuenta" class="button button-fill button-large button-raised margin-bottom color-theme" style="margin: 1em;" onclick="GuardarCalificacion(`+idcita+`)">
               Guardar calificacion
         </a>


          <a id="btneliminar" class="button button-fill button-large button-raised margin-bottom " style="margin: 1em;" onclick="CerrarCalificacion()">
              Cerrar
         </a>
   </div>
  </div>

		`;
		$(".calificacion").html(html);
	$(".calificacion").css('display','block');

}


function Cambio(valor) {

	  select = $('#che_'+valor);
	  select.on('change', SeleccionarEstrella(valor));
	  select.trigger('change');
}


function SeleccionarEstrella(cantidad) {
	var colocar=0;
	if ($("#che_"+cantidad).is(':checked')) {

		
		colocar=0;

	}else{
		
		colocar=1;

	}

	if (colocar==1) {
		/*$("#estre_"+cantidad).removeClass('bi-star');
		$("#estre_"+cantidad).addClass('bi-star-fill');*/
		if (cantidad>=1) {
			for (var i = 1; i <=cantidad; i++) {
				/*$("#estre_"+i).removeClass('bi-star');
				$("#estre_"+i).addClass('bi-star-fill');*/
				$("#estre_"+i+" span").addClass('colorestrella');

				$("#che_"+i).attr('checked',true);
			}
		}
		
	}else{
			
			for (var i = 1; i <= 10; i++) {
				/*$("#estre_"+i).removeClass('bi-star-fill');
				$("#estre_"+i).addClass('bi-star');*/
				$("#estre_"+i+" span").removeClass('colorestrella');

				$("#che_"+i).attr('checked',false);
			}

			if (cantidad>=1) {
			for (var i = 1; i <=cantidad; i++) {
				/*$("#estre_"+i).removeClass('bi-star');
				$("#estre_"+i).addClass('bi-star-fill');*/
				$("#estre_"+i+" span").addClass('colorestrella');


				$("#che_"+i).attr('checked',true);

			}
		}
	
	}
	

}

function GuardarCalificacion(idcita) {
	var idusuario=localStorage.getItem('id_user');
	var cantidad=$(".colorestrella").length;
	var comentario=$("#txtcomentario").val();
	 app.dialog.confirm('','¿Seguro de guardar la calificación?', function () {

	var datos="idcita="+idcita+"&idusuario="+idusuario+"&cantidad="+cantidad+"&comentario="+comentario;
	var pagina = "GuardarCalificacionCita.php";
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: urlphp+pagina,
		data:datos,
		async:false,
		success: function(resp){

			
				$("#txtcomentario").val('');
				$(".opcionescita").css('display','block');
				$(".datoscita").css('display','block');
				//$(".calificacion").css('display','none');
				CerrarModal2();
			},error: function(XMLHttpRequest, textStatus, errorThrown){ 
				var error;
				  	if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
				  	if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
								//alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
					console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
			}
		});

	});
}

function CerrarModal2() {
	app.dialog.close();
}

function AbrirCalendarioUsuario() {
	localStorage.setItem('fechafiltro','');

	  calendarModal = app.calendar.create({
        inputEl: '#demo-calendar-modal',
        openIn: 'customModal',
        header: true,
        footer: true,
        toolbarCloseText:'Cerrar',
        headerPlaceholder:'Seleccionar fecha',
         dateFormat: 'dd/mm/yyyy',
         closeOnSelect:true,
         on:{
         	 calendarChange:function (c) {
          
            var fecha=c.value;
            var convertirfecha=new Date(fecha);
            var mes=(convertirfecha.getMonth() + 1)<10?'0'+(convertirfecha.getMonth() + 1):(convertirfecha.getMonth() + 1);
            var mesdata=convertirfecha.getMonth();
            var dia=convertirfecha.getDate()<10?'0'+convertirfecha.getDate():convertirfecha.getDate();
            var diadata=convertirfecha.getDate();
            fecha1=convertirfecha.getFullYear()+'-'+ mes+'-'+dia;
            localStorage.setItem('fechafiltro',fecha1);
         

          },
         	 close: function (c) {

         	 		if (localStorage.getItem('fechafiltro')!='') {
         	 			myStopFunction(intervalo);
         	 			FiltrarTableroCitasUsuario();
         	 		}
          }
         }
      });

	calendarModal.open();

}

function FiltrarTableroCitasUsuario() {
	var iduser=localStorage.getItem('id_user');
	var fecha=localStorage.getItem('fechafiltro');
	var estatus=1;
	var datos="idusuarios="+iduser+"&fechafiltro="+fecha+"&estatus="+estatus+"&hoy=0";
	var pagina = "ObtenerTableroCitasFiltro.php";
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: urlphp+pagina,
		data:datos,
		success: function(datos){
			myStopFunction(intervalo);
			var respuesta=datos.respuesta;
			var fecha=datos.fechafiltro;
			PintarTableroCitas(respuesta);
			$(".fechaactual").text(fecha);

			},error: function(XMLHttpRequest, textStatus, errorThrown){ 
				var error;
				  	if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
				  	if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
								//alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
					console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
			}
		});
}
