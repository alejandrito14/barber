var porfecha=0;
var porbarbero=0;
var imagenfecha="";
var imagenbarbero="";
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
		//ObtenerListaEspecialistasSucursal3(idsucursal);
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

function ObtenerDatosSucursalPorfechabarbero(idsucursal) {

 return new Promise(function(resolve, reject) {

		var datos='idsucursal='+idsucursal;
		var pagina = "ObtenerSucursal.php";
		$.ajax({
		type: 'POST',
		dataType: 'json',
		url: urlphp+pagina,
		async:false,
		data:datos,
		success: function(datos){
		
		var respuesta=datos.sucursal;

			resolve(respuesta);
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

var imagenesgaleria=[];
function PintarDatosSucursal(respuesta,imagenes) {


	imagen=urlimagenes+`sucursal/imagenes/`+codigoserv+respuesta.imagensecundaria;
	$(".imagensucursal").attr('src',imagen);
	$(".titulosucursal").text(respuesta.titulo);
	$(".telefono").text(respuesta.celular);
	$(".btnwhapsap").attr('onclick',"AbrirWhapsap(\'"+respuesta.celular+"\')");
	var direccion=respuesta.direccion+', '+respuesta.colonia;
	$(".descripcion").text(direccion);
	var coordenadas=respuesta.ubicacion;
	var lat="";
	var long="";
	if (coordenadas!='') {
	 coordenadas=respuesta.ubicacion.split(',');

		lat=coordenadas[0];
		long=coordenadas[1];

		ObtenerMapa(long,lat);
	}

		 imagenesgaleria.push(imagen);


	$(".divvisualizarimagen").attr("onclick","AbrirImagen(0)");

	$(".textelefono").text(respuesta.telefono);
	$(".btntelefono").attr("onclick","hacerLlamada('"+respuesta.telefono+"')");
	$(".btnagenda").attr("onclick","GoToPage('servicioslista')");
	$(".btnlocalizar").attr("onclick","abrirGoogleMaps('"+lat+"','"+long+"')");
	$(".btnvercalificaciones").attr("onclick","ObtenerCalificacionesSucursal("+respuesta.idsucursal+")");
	$(".btnconoceespecialistas").attr("onclick","ObtenerListaEspecialistasSucursal2("+respuesta.idsucursal+")");
	var html="";
	if (imagenes.length>0) {
		html+=`<div class="swiper-wrapper">`;
		for (var i = 0; i < imagenes.length; i++) {

				imagen=urlimagenes+`sucursal/imagenes/`+codigoserv+imagenes[i].imagen;
				imagenesgaleria.push(imagen);
			html+=`
					<div class="swiper-slide"  style="margin-right:0px!important;" onclick="AbrirImagen(`+i+`)">
						<div class="dz-media">
							<img src="`+imagen+`" alt="">
						</div>
			
					</div>
				`;
		}

		html+=`</div>`;
	}


	//$(".gallery-swiper").html(html);


		 /*var swiper4 = new Swiper(".gallery-swiper", {
		     slidesPerView: "auto",
		    spaceBetween: 30,
		    pagination: false,

		  });*/
}

function AbrirWhapsap(numeroTelefono) {
	var mensaje="Hola";
	//window.open("whatsapp://send?phone=" + numeroTelefono, "_system", "location=yes");
	window.open('whatsapp://send?phone='+numeroTelefono+'&text='+mensaje+'','_system');

}
function hacerLlamada(numeroTelefono) {
    window.plugins.CallNumber.callNumber(function(){}, function(){}, numeroTelefono, true);
}

function abrirGoogleMaps(latitud, longitud) {
    var url = 'https://www.google.com/maps?q=' + latitud + ',' + longitud;
    var opciones = 'location=yes';
    var navegador = window.open(url, '_blank', opciones);

}

function ObtenerCalificacionesSucursal(idsucursal) {
	

		var datos='idsucursal='+idsucursal;
		var pagina = "ObtenerCalificacionesSucursal.php";
		$.ajax({
		type: 'POST',
		dataType: 'json',
		url: urlphp+pagina,
		async:false,
		data:datos,
		success: function(datos){
			var calificaciones=datos.calificaciones;
			PintarDetallecalificaciones(calificaciones);

		},error: function(XMLHttpRequest, textStatus, errorThrown){ 
			var error;
				if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
				if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
								//alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
								console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
					}
		});


}

function PintarDetallecalificaciones(respuesta) {

	var html2="";

	

var html=` <div class="sheet-modal my-sheet-swipe-to-close1" style="height: 100%;background: white;">
            <div class="toolbar" style="background: white;">
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
   						    	 <span class="titulomodal" style="">Calificaciones</span>
   						    	 </div>
   						    	 <div class="col-20">
   						    	 <span class="limpiarfiltros"></span>
   						    	 </div>
   							 </div>
   							 <div class="" style="position: absolute;top:1em;width: 100%;">
   							 	
	   											<div class="">
		   											<div class="" style="">
		   							 	 				<div class="" style="">
		   							 	 
												   		<div class="list">
												   			<ul>
												   		`;

												   		if (respuesta.length>0) {
												   			for (var i = 0; i <respuesta.length; i++) {
												   					
												   					var calificacion=respuesta[i].calificacion;

												   				html+=`

												   				<li style="margin-top: 1em;">
																	<div class="item-content">

																	<div class="">
																		<div class="">
																			<div class="">
																				<p style="margin:0;margin-left: 5px;font-weight: bold;">`+respuesta[i].nombre+` `+respuesta[i].paterno+`</p>
																				<div class="row" style="">

																				`;


																				for (var j = 0; j <5; j++) {

																						var color="";

																						if (j<calificacion) {
																							color="colorestrella";
																						}
																				
																					html+=`
																						<div class="col" >
									                	<div>
									                	 <span  id="estre_1"  style="font-size:20px;" class="`+color+`">
									                	 <span class="material-icons-outlined">
																													star
																													</span>
																												</span>
										                	 <div class="oculto">
										                	
										                	 <input type="checkbox"  id="che_1" >
										                	</div>
									                	</div>
									               
									               </div>

																					`;
																				}

																			html+=	`
                  
                

                </div>

                		<p style="margin:0;margin-left: 5px;">`+respuesta[i].comentario+`</p>


                </div>

																	
												
																		</div>
																		<div class="item-subtitle"></div>
																		<div class="item-text"></div>
																	</div>
																	</div>
																
																</li>
												   				`;
												   			}
												   		}
															
												   	  html+=`
												   	  	</ul>
												   	  </div>
		   							 	 
		   							 			</div>
	   							  	
           									 </div>
							   			</div>
		   							 	 
		   							 			`;

		   							
		   							 	html+=`</div>

		   							 		<div class="row">`;

		   							 	


		   							  		html+=`</div>

		   							  		<div class="row margin-bottom " style="padding-top: 1em;">
		   							  		`;
		   							  		


		   							  		html+=`
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
           
			

          },
          opened: function (sheet) {
            console.log('Sheet opened');
          },
          close:function (sheet) {
          	// BorrarIntervalo();
          
          },
        }
      });

       dynamicSheet1.open();
}

function ObtenerListaEspecialistasSucursal(idsucursal) {
	
		var datos='idsucursal='+idsucursal;
		var pagina = "ObtenerListaEspecialistasSucursal.php";
		$.ajax({
		type: 'POST',
		dataType: 'json',
		url: urlphp+pagina,
		async:false,
		data:datos,
		success: function(datos){
			var especialistas=datos.especialistas;
			PintarDetalleEspecialistas(especialistas);

		},error: function(XMLHttpRequest, textStatus, errorThrown){ 
			var error;
				if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
				if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
								//alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
								console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
					}
		});

}


function ObtenerListaEspecialistasSucursal2(idsucursal) {
	
		var datos='idsucursal='+idsucursal;
		var pagina = "ObtenerListaEspecialistasSucursal.php";
		$.ajax({
		type: 'POST',
		dataType: 'json',
		url: urlphp+pagina,
		async:false,
		data:datos,
		success: function(datos){
			var especialistas=datos.especialistas;
			PintarDetalleEspecialistasSucursal(especialistas);

		},error: function(XMLHttpRequest, textStatus, errorThrown){ 
			var error;
				if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
				if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
								//alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
								console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
					}
		});

}



function PintarDetalleEspecialistas(respuesta) {
	

	var html2="";

	

var html=` <div class="sheet-modal my-sheet-swipe-to-close1" style="height: 100%;background: white;">
            <div class="toolbar" style="background: white;">
              <div class="toolbar-inner">
                <div class="left"></div>
                <div class="right">
                  <a class="link sheet-close"></a>
                </div>
              </div>
            </div>
            <div class="sheet-modal-inner" style="background: white;border-top-left-radius: 20px;border-top-right-radius:20px;    margin-top: 1em; ">
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
   						    	 <span class="titulomodal" style="">Barberos</span>
   						    	 </div>
   						    	 <div class="col-20">
   						    	 <span class="limpiarfiltros"></span>
   						    	 </div>
   							 </div>
   							 <div class="" style="position: absolute;top:1em;width: 100%;">
   							 	
	   											<div class="">
		   											<div class="" style="">
		   							 	 				<div class="" style="">
		   							 	 
												   		<div class="list">
												   			<div>
												   		`;

												   		if (respuesta.length>0) {
												   			for (var i = 0; i <respuesta.length; i++) {
												   					
												   					if (respuesta[i].foto!='' && respuesta[i].foto!=null && respuesta[i].foto!='null') {

																								urlimagen=urlphp+`upload/perfil/`+respuesta[i].foto;
																								imagen='<img src="'+urlimagen+'" alt="" />';
																								}else{


																								if (respuesta[i].sexo=='M') {

																									urlimagen=urlphp+`imagenesapp/`+localStorage.getItem('avatarmujer');
																					
																										}else{
																											urlimagen=urlphp+`imagenesapp/`+localStorage.getItem('avatarhombre');
																								
																										}

																									imagen='<img src="'+urlimagen+'" alt="" style="width:100px;"  />';
																								}

												   				html+=`

												   				<div style="margin-top: 1em;" onclick="DetalleEspecialista(`+respuesta[i].idespecialista+`)" class="estilobarbero">
																	<div class="item-content">
																	<div class="item-media">
																		<div class="card-media">
                                    <a>
                                    <img src="`+urlimagen+`" alt="" style="width: 85px;border-radius: 50%;height: 80px;">
                                    </a>
                                  </div>
																	</div>

																	<div class="item-inner">
																		<div class="">
																			<div class="">
																				<p style="margin:0;margin-left: 5px;font-weight: bold;">`+respuesta[i].nombre+` `+respuesta[i].paterno+`</p>
																				<div class="row" style="">

																				`;



																			html+=	`
                  
                

                </div>

                		<p style="margin:0;margin-left: 5px;"></p>


                </div>

																	
												
																		</div>
																		<div class="item-subtitle"></div>
																		<div class="item-text"></div>
																	</div>
																	</div>
																
																</div>
												   				`;
												   			}
												   		}
															
												   	  html+=`
												   	  	</div>
												   	  </div>
		   							 	 
		   							 			</div>
	   							  	
           									 </div>
							   			</div>
		   							 	 
		   							 			`;

		   							
		   							 	html+=`</div>

		   							 		<div class="row">`;

		   							 	


		   							  		html+=`</div>

		   							  		<div class="row margin-bottom " style="padding-top: 1em;">
		   							  		`;
		   							  		


		   							  		html+=`
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
           
			

          },
          opened: function (sheet) {
            console.log('Sheet opened');
          },
          close:function (sheet) {
          	// BorrarIntervalo();
          
          },
        }
      });

       dynamicSheet1.open();
}

function PintarDetalleEspecialistasSucursal(respuesta) {
	

	var html2="";

	

var html=` <div class="sheet-modal my-sheet-swipe-to-close1" style="height: 100%;background: white;">
            <div class="toolbar" style="background: white;">
              <div class="toolbar-inner">
                <div class="left"></div>
                <div class="right">
                  <a class="link sheet-close"></a>
                </div>
              </div>
            </div>
            <div class="sheet-modal-inner" style="background: white;border-top-left-radius: 20px;border-top-right-radius:20px;    margin-top: 1em; ">
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
   						    	 <span class="titulomodal" style="">Barberos</span>
   						    	 </div>
   						    	 <div class="col-20">
   						    	 <span class="limpiarfiltros"></span>
   						    	 </div>
   							 </div>
   							 <div class="" style="position: absolute;top:1em;width: 100%;">
   							 	
	   											<div class="">
		   											<div class="" style="">
		   							 	 				<div class="" style="">
		   							 	 
												   		<div class="list">
												   			<div>
												   		`;

												   		if (respuesta.length>0) {
												   			for (var i = 0; i <respuesta.length; i++) {
												   					
												   					if (respuesta[i].foto!='' && respuesta[i].foto!=null && respuesta[i].foto!='null') {

																								urlimagen=urlphp+`upload/perfil/`+respuesta[i].foto;
																								imagen='<img src="'+urlimagen+'" alt="" />';
																								}else{


																								if (respuesta[i].sexo=='M') {

																									urlimagen=urlphp+`imagenesapp/`+localStorage.getItem('avatarmujer');
																					
																										}else{
																											urlimagen=urlphp+`imagenesapp/`+localStorage.getItem('avatarhombre');
																								
																										}

																									imagen='<img src="'+urlimagen+'" alt="" style="width:100px;"  />';
																								}

												   				html+=`

												   				<div style="margin-top: 1em;" onclick="DetalleEspecialistaSucursal(`+respuesta[i].idespecialista+`)" class="estilobarbero">
																	<div class="item-content">
																	<div class="item-media">
																		`+imagen+`
																	</div>

																	<div class="item-inner">
																		<div class="">
																			<div class="">
																				<p style="margin:0;margin-left: 5px;font-weight: bold;">`+respuesta[i].nombre+` `+respuesta[i].paterno+`</p>
																				<div class="row" style="">

																				`;



																			html+=	`
                  
                

                </div>

                		<p style="margin:0;margin-left: 5px;"></p>


                </div>

																	
												
																		</div>
																		<div class="item-subtitle"></div>
																		<div class="item-text"></div>
																	</div>
																	</div>
																
																</div>
												   				`;
												   			}
												   		}
															
												   	  html+=`
												   	  	</div>
												   	  </div>
		   							 	 
		   							 			</div>
	   							  	
           									 </div>
							   			</div>
		   							 	 
		   							 			`;

		   							
		   							 	html+=`</div>

		   							 		<div class="row">`;

		   							 	


		   							  		html+=`</div>

		   							  		<div class="row margin-bottom " style="padding-top: 1em;">
		   							  		`;
		   							  		


		   							  		html+=`
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
           
			

          },
          opened: function (sheet) {
            console.log('Sheet opened');
          },
          close:function (sheet) {
          	// BorrarIntervalo();
          
          },
        }
      });

       dynamicSheet1.open();
}

function AbrirImagen(posicion) {

	  var nombre=imagenesgaleria[posicion];
	//  imagen=urlimagenes+`sucursal/imagenes/`+codigoserv+nombre;

	   var myPhotoBrowser = app.photoBrowser.create({
       
        photos: [
         nombre
            ]
            ,
            theme: 'dark',
      });
      //Open photo browser on click
      myPhotoBrowser.open();
      var html=`
      	<div class="iconocerrar link sheet-close" style="z-index:10;">
	 		<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M25.5188 4.48126C23.4385 2.4011 20.788 0.984547 17.9026 0.410715C15.0171 -0.163118 12.0264 0.131546 9.30839 1.25744C6.59043 2.38334 4.26736 4.28991 2.63294 6.73606C0.998525 9.18221 0.12616 12.0581 0.12616 15C0.12616 17.9419 0.998525 20.8178 2.63294 23.264C4.26736 25.7101 6.59043 27.6167 9.30839 28.7426C12.0264 29.8685 15.0171 30.1631 17.9026 29.5893C20.788 29.0155 23.4385 27.5989 25.5188 25.5188C26.9003 24.1375 27.9961 22.4976 28.7437 20.6928C29.4914 18.888 29.8762 16.9535 29.8762 15C29.8762 13.0465 29.4914 11.1121 28.7437 9.30724C27.9961 7.50242 26.9003 5.86255 25.5188 4.48126ZM20.3126 18.7613C20.4187 18.8606 20.5034 18.9808 20.5612 19.1142C20.6191 19.2476 20.6489 19.3915 20.6489 19.5369C20.6489 19.6823 20.6191 19.8262 20.5612 19.9596C20.5034 20.093 20.4187 20.2131 20.3126 20.3125C20.2133 20.411 20.0956 20.4889 19.9661 20.5418C19.8367 20.5946 19.698 20.6214 19.5582 20.6206C19.2795 20.6195 19.0124 20.5088 18.8145 20.3125L15.0001 16.4981L11.2388 20.3125C11.0409 20.5088 10.7738 20.6195 10.4951 20.6206C10.3553 20.6214 10.2166 20.5946 10.0872 20.5418C9.95773 20.4889 9.83999 20.411 9.74071 20.3125C9.54282 20.1134 9.43174 19.8441 9.43174 19.5634C9.43174 19.2827 9.54282 19.0135 9.74071 18.8144L13.502 15L9.74071 11.2388C9.56665 11.0355 9.47569 10.774 9.48602 10.5066C9.49635 10.2392 9.6072 9.98557 9.79642 9.79635C9.98565 9.60712 10.2393 9.49627 10.5067 9.48594C10.7741 9.47561 11.0356 9.56657 11.2388 9.74063L15.0001 13.5019L18.7613 9.74063C18.8597 9.63878 18.9772 9.55729 19.107 9.50083C19.2369 9.44437 19.3766 9.41404 19.5182 9.41158C19.6598 9.40911 19.8004 9.43456 19.9322 9.48646C20.0639 9.53836 20.1842 9.6157 20.286 9.71407C20.3879 9.81244 20.4694 9.9299 20.5258 10.0598C20.5823 10.1896 20.6126 10.3293 20.6151 10.4709C20.6175 10.6125 20.5921 10.7532 20.5402 10.8849C20.4883 11.0167 20.411 11.1369 20.3126 11.2388L16.4982 15L20.3126 18.7613Z" fill="#AAAAAA"></path>
            </svg>
	   	 </div>

      `;
    
     $(".popup-close").removeClass('link');
     $(".popup-close").html(html);
     $(".popup-close").css('margin-top','100px');
     $(".iconocerrar").css('top','80px');
}

function VistaCategoria(idsucursal) {
	var promesa=ObtenerDatosSucursalPorfechabarbero(idsucursal);

	promesa.then(r => {


			var porfecha=r.porfecha;
			var porbarbero=r.porbarbero;
			var imagenbarbero=r.imagenporbarbero;
			var imagenfecha=r.imagenporfecha;


		var html=` <div class="sheet-modal my-sheet-swipe-to-close1" style="height: 100%;background: white;">
            <div class="toolbar" style="background: white;">
              <div class="toolbar-inner">
                <div class="left"></div>
                <div class="right">
                  <a class="link sheet-close"></a>
                </div>
              </div>
            </div>
            <div class="sheet-modal-inner" style="background: white;border-top-left-radius: 20px;border-top-right-radius:20px;    margin-top: 1em; ">
            	 <div class="iconocerrar link sheet-close" style="z-index:10;">
	 		<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M25.5188 4.48126C23.4385 2.4011 20.788 0.984547 17.9026 0.410715C15.0171 -0.163118 12.0264 0.131546 9.30839 1.25744C6.59043 2.38334 4.26736 4.28991 2.63294 6.73606C0.998525 9.18221 0.12616 12.0581 0.12616 15C0.12616 17.9419 0.998525 20.8178 2.63294 23.264C4.26736 25.7101 6.59043 27.6167 9.30839 28.7426C12.0264 29.8685 15.0171 30.1631 17.9026 29.5893C20.788 29.0155 23.4385 27.5989 25.5188 25.5188C26.9003 24.1375 27.9961 22.4976 28.7437 20.6928C29.4914 18.888 29.8762 16.9535 29.8762 15C29.8762 13.0465 29.4914 11.1121 28.7437 9.30724C27.9961 7.50242 26.9003 5.86255 25.5188 4.48126ZM20.3126 18.7613C20.4187 18.8606 20.5034 18.9808 20.5612 19.1142C20.6191 19.2476 20.6489 19.3915 20.6489 19.5369C20.6489 19.6823 20.6191 19.8262 20.5612 19.9596C20.5034 20.093 20.4187 20.2131 20.3126 20.3125C20.2133 20.411 20.0956 20.4889 19.9661 20.5418C19.8367 20.5946 19.698 20.6214 19.5582 20.6206C19.2795 20.6195 19.0124 20.5088 18.8145 20.3125L15.0001 16.4981L11.2388 20.3125C11.0409 20.5088 10.7738 20.6195 10.4951 20.6206C10.3553 20.6214 10.2166 20.5946 10.0872 20.5418C9.95773 20.4889 9.83999 20.411 9.74071 20.3125C9.54282 20.1134 9.43174 19.8441 9.43174 19.5634C9.43174 19.2827 9.54282 19.0135 9.74071 18.8144L13.502 15L9.74071 11.2388C9.56665 11.0355 9.47569 10.774 9.48602 10.5066C9.49635 10.2392 9.6072 9.98557 9.79642 9.79635C9.98565 9.60712 10.2393 9.49627 10.5067 9.48594C10.7741 9.47561 11.0356 9.56657 11.2388 9.74063L15.0001 13.5019L18.7613 9.74063C18.8597 9.63878 18.9772 9.55729 19.107 9.50083C19.2369 9.44437 19.3766 9.41404 19.5182 9.41158C19.6598 9.40911 19.8004 9.43456 19.9322 9.48646C20.0639 9.53836 20.1842 9.6157 20.286 9.71407C20.3879 9.81244 20.4694 9.9299 20.5258 10.0598C20.5823 10.1896 20.6126 10.3293 20.6151 10.4709C20.6175 10.6125 20.5921 10.7532 20.5402 10.8849C20.4883 11.0167 20.411 11.1369 20.3126 11.2388L16.4982 15L20.3126 18.7613Z" fill="#AAAAAA"></path>
            </svg>
	   						    	 </div>
              <div class="page-content" style="height: 100%;">
                <div style="background: white; height: 100%;width: 100%;border-radius: 20px;">
   						     <div class="row" style="margin-top:2em;">
	   						     <div class="col-20">
	   						      	
	   						    </div>

   						    	 <div class="col-60">
   						    	 <span class="titulomodal" style="">Agenda tu cita</span>
   						    	 </div>
   						    	 <div class="col-20">
   						    	 <span class="limpiarfiltros"></span>
   						    	 </div>
   							 </div>
   							 <div class="" style="position: absolute;top:4em;width: 100%;">
   							 	
	   											<div class="">
		   											<div class="" style="">
		   							 	 				<div class="" style="">
		   							 	 										 <div class="block">
          
          	<div class="row" style="    margin-right: 1em; margin-left: 1em;">`;

          	if (porfecha==1) {

          				imagen=urlimagenes+`sucursal/imagenes/`+codigoserv+imagenfecha;

   			html+=`<div class="tarjeta" style="width:50%;" id="tarjeta_1"  onclick="DisponibilidadFecha(`+idsucursal+`)">
		          <div class="card demo-card-header-pic" style="border-radius: 10px;">  <div style="background-image:url(`+imagen+`);border-radius: 10px 10px 0px 0px;" class="card-header align-items-flex-end"></div>

		        <div class="" style="display: flex;
    justify-content: center;
    align-items: center;text-align: center;height: 50px;background:#C7AA6A;font-size: 16px;    
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;">
   				 <p style="margin:0px;text-align:center;color: white;

   				 ">Por fecha </p>	</div>
		      </div>
		      </div>`;

		     }

		     if (porbarbero==1) {

		     	 	imagen=urlimagenes+`sucursal/imagenes/`+codigoserv+imagenbarbero;

		    html+=` <div class="tarjeta" style="width:50%;" id="tarjeta_1" onclick="DisponibilidadEspe(`+idsucursal+`)">
		          <div class="card demo-card-header-pic" style="border-radius: 10px;">  <div style="background-image:url(`+imagen+`);border-radius: 10px 10px 0px 0px;" class="card-header align-items-flex-end"></div>
							        <div class="" style="display: flex;
					    justify-content: center;
					    align-items: center;text-align: center;height: 50px;background:#C7AA6A;font-size: 16px;    
					    border-bottom-left-radius: 10px;
					    border-bottom-right-radius: 10px;">
					   					 <p style="margin:0px;text-align:center;color: white;

					   				 ">Por barbero </p>	

					   				 </div>
		      </div>
		      </div>`;
           
             
            }
          
         
        html+=`  </div>

        </div>
												   
		   							 	 
		   							 											</div>
	   							  	
           									 </div>
							   			</div>
		   							 	 
		   							 			`;

		   							
		   							 	html+=`</div>

		   							 		<div class="row">`;

		   							 	


		   							  		html+=`</div>

		   							  		<div class="row margin-bottom " style="padding-top: 1em;">
		   							  		`;
		   							  		


		   							  		html+=`
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
           
			

          },
          opened: function (sheet) {
            console.log('Sheet opened');
          },
          close:function (sheet) {
          	// BorrarIntervalo();
          
          },
        }
      });

       dynamicSheet1.open();

      });


}

function DisponibilidadEspe(idsucursal) {
		dynamicSheet1.close();
		ObtenerListaEspecialistasSucursal(idsucursal);

	}

	function DisponibilidadFecha(idsucursal) {
				dynamicSheet1.close();
				GoToPage('disponibilidadfechasucursal');
	}

	function DetalleEspecialistaSucursal(idespecialista) {
	//dynamicSheet1.close();
	localStorage.setItem('idespecialista',idespecialista);

		GoToPage('detalleespecialista');
		//VerDisponibilidad();
}

function DetalleEspecialista(idespecialista) {
	dynamicSheet1.close();
	localStorage.setItem('idespecialista',idespecialista);

		//GoToPage('detalleespecialista');
		VerDisponibilidad();
}

function ObtenerListaEspecialistasSucursal3(idsucursal) {
	
		var datos='idsucursal='+idsucursal;
		var pagina = "ObtenerListaEspecialistasSucursal.php";
		$.ajax({
		type: 'POST',
		dataType: 'json',
		url: urlphp+pagina,
		async:false,
		data:datos,
		success: function(datos){
			var especialistas=datos.especialistas;
			PintarDetalleEspecialistasSucursal3(especialistas);

		},error: function(XMLHttpRequest, textStatus, errorThrown){ 
			var error;
				if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
				if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
								//alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
								console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
					}
		});

}

function PintarDetalleEspecialistasSucursal3(respuesta) {
	var html="";
	if (respuesta.length>0) {
		html+=`<div class="swiper-wrapper">`;
		for (var i = 0; i < respuesta.length; i++) {

				urlimagen=urlphp+`upload/perfil/`+respuesta[i].foto;

												   					if (respuesta[i].foto!='' && respuesta[i].foto!=null && respuesta[i].foto!='null') {

																								urlimagen=urlphp+`upload/perfil/`+respuesta[i].foto;
																								}else{


																								if (respuesta[i].sexo=='M') {

																									urlimagen=urlphp+`imagenesapp/`+localStorage.getItem('avatarmujer');
																					
																										}else{
																											urlimagen=urlphp+`imagenesapp/`+localStorage.getItem('avatarhombre');
																								
																										}

																								}
			html+=`
					
<div class="swiper-slide"  style="margin-right:5px!important;width: 30%;" onclick="DetalleEspecialistaSucursal(`+respuesta[i].idespecialista+`)">
						<div class="card-bx featured-card" style="box-shadow:none!important;">
								<div class="card-media">
										<a >
										<img src="`+urlimagen+`" alt="" style="border-radius: 50%;">
										</a>
								</div>
								<div class="card-info">
									<h5 class="title">`+respuesta[i].nombre+` `+respuesta[i].paterno+ `
								</h5>
							
							</div>
					</div>
				
					</div>
				`;
		}

		html+=`</div>`;

		html+=`  <div class="swiper-pagination" style="bottom: -6px!important;"></div>`;
	}


	$(".barberos-swiper1").html(html);


	var swiper9 = new Swiper(".barberos-swiper1", {
		     slidesPerView: "auto",
		    spaceBetween: 0,
					 pagination: {
					    el: '.swiper-pagination',
					    type: 'bullets',
					  },
					  height:210,

		  });
}