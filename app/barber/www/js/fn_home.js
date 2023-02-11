
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
							<a  class="">
							<img src="`+imagen+`" alt="">
							</a>
						</div>
						<div class="card-info">
							<h5 class="title">
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
							<div class="icon-bx">
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
				html+=`<div class="swiper-wrapper">`;

		for (var i = 0; i < respuesta.length; i++) {
			
		imagen=urlimagenes+`sucursal/imagenes/`+codigoserv+respuesta[i].imagen;

			html+=`
				<div class="swiper-slide swiper-slide-active" role="group"  style="margin-right: 20px;width:200px;" onclick="DetalleSucursal(`+respuesta[i].idsucursal+`)">
				<div class="">
						<div class="card-media" style="width:100%;height:72px;">
						<span class="material-icons-outlined" style="    z-index: 9999;
    position: absolute;
    right: 0;margin-right: 0.5em;margin-top: 0.3em;">favorite_border</span>
							<span  class="">
							<img src="`+imagen+`" alt="" style="height: 100px;width: 100%;">
							</span>
						</div>
						<div class="card-info">
							<div class="row" style="    margin-top: 2em;">
								<div class="col-70">
									<span class="title" style="font-weight:bold;color:black;">
										<a >`+respuesta[i].titulo+`
										</a>
									</span>
									<p class="location">
									`+respuesta[i].descripcion+`</p>
									<h6 class="text-primary vacancy">
									</h6>
								</div>

								<div class="col-30" style=" 
							    text-align: right;
							    position: absolute;
							    right: 0;
							    margin-right: 0.5em;
							    margin-top: 0.3em;">
									<span class="material-icons-outlined" style="font-size:28px;line-height: 1;">
									location_on
									</span>

								</div>
							</div>
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

					imagen=urlimagenes+`sucursal/imagenes/`+codigoserv+respuesta[i].imagen;

			html+=`
			<li class="col-100 medium-50">
				<div class="card-bx job-card">
					<div class="card-media">
						<a >
						<img src="`+imagen+`" alt="">
						</a>
					</div>
					<div class="card-info">
						<h6 class="item-title">
						<a >
						`+respuesta[i].titulo+`-`+respuesta[i].descripcion+`</a>
						</h6>
					  <div class="list-info">
						<p>`+respuesta[i].fechacita+` `+respuesta[i].horacita+`hrs.</p>
						</div>
						<div class="item-footer">
							<a  class="item-tag">
							</a>
							<h5 class="item-price text-primary">
							</h5>
						</div>
					</div>
					<a  class="bookmark-btn active">
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
			Pintarpublicidad(respuesta);

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
						<div class="card card-bx card-featured" style="width: 50%;height:100px;">
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
	 									<span class="bi bi-x-circle-fill"></span>
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
				<div class="col-30" style="
   						 margin-top: 1em;border-radius: 10px;color:white;
    background: #59c158;" onclick="GuardarInteres(`+respuesta[i].idintereses+`)" id="interes_`+respuesta[i].idintereses+`">
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
	 ObtenerTableroAnuncios(1);
      ObtenerTableroCategorias(1);
      ObtenerTableroSucursal(1);
      ObtenerTableroCitas(1);
      Obtenerpublicidad(1);


     var nombre= localStorage.getItem("nombre");
     $(".nombreusuario").text(nombre);

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