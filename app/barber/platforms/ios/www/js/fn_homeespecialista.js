function CargarDatosEspecialista() {
	$(".licompras").css('display','none');
	$(".lifavoritos").css('display','none');

	
	 var nombre= localStorage.getItem("nombre");
     $(".nombreusuario").text(nombre);
     ObtenerTableroAnuncios();
           Obtenerpublicidad(1);
		ObtenerTableroCitasEspecialista();
		ObtenerFechaActual();
		      ObtenerDetalleEmpresa();

}


function ObtenerTableroCitasEspecialista(estatus) {

	//return new Promise((resolve, reject) => {
 	var idusuarios=localStorage.getItem('id_user');
	var datos="estatus="+estatus+"&idusuarios="+idusuarios;
	var pagina = "ObtenerTableroCitasEspecialista.php";
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: urlphp+pagina,
		data:datos,
		async:false,
		success: function(datos){
			

			var respuesta=datos.respuesta;
			PintarTableroCitasEspecialista(respuesta);
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


function PintarTableroCitasEspecialista(respuesta) {
	var html="";
	if (respuesta.length>0) {
		$(".titulocitas").css('display','block');
		for (var i = 0; i < respuesta.length; i++) {

					imagen=urlimagenes+`sucursal/imagenes/`+codigoserv+respuesta[i].imagen;

			html+=`
			<li class="col-100 medium-50">
				<div class="card-bx job-card" onclick="AbrirModalCitaEspecialista(`+respuesta[i].idcita+`)">
					<div class="card-media">
						<a >
						<img src="`+imagen+`" alt="">
						</a>
					</div>
					<div class="card-info">
						<h6 class="item-title">
			
						<p style="margin:0;">`+respuesta[i].titulo+`-`+respuesta[i].descripcion+`</a></p>

						<p style="color: #2b952a;font-size: 18px;margin:0;">`+respuesta[i].horacita+`-`+respuesta[i].horafinal+`hrs.</p>

						</h6>
					  <div class="">
				
						<p style="margin:0;">`+respuesta[i].nombreespecialista+`</p>
						</div>
						<div class="item-footer">

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

function AbrirModalCitaEspecialista(idcita) {
	var iduser=localStorage.getItem('id_user');
	var datos="idcita="+idcita+"&iduser="+iduser;
	var pagina = "ObtenerDetalleCitaEspecialista.php";
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: urlphp+pagina,
		data:datos,
		success: function(datos){
			localStorage.setItem('idcita',idcita);
			var respuesta=datos.respuesta;
				ObtenerDetalleCitaEspecialista(respuesta);	

			},error: function(XMLHttpRequest, textStatus, errorThrown){ 
				var error;
				  	if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
				  	if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
								//alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
					console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
			}
		});
	

}

function ObtenerDetalleCitaEspecialista(respuesta) {
	var imagen=urlimagenes+`sucursal/imagenes/`+codigoserv+respuesta.imagen;

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
	 								<span style="font-size: 30px;" class="material-icons-outlined">
																		cancel
																		</span>
	   						    	 </div>
              <div class="page-content" style="height: 100%;">
                <div style="background: white; height: 100%;width: 100%;border-radius: 20px;">
   						     <div class="row">
	   						     <div class="col-20">
	   						      	
	   						    </div>

   						    	 <div class="col-60">
   						    	 <span class="titulomodal" style="">Detalle de cita</span>
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
			<div class="col-100" style="margin-left: 1em;margin-right: 1em;margin-top: 1em;">
                <div class="card margin-bottom">
                    <div class="card-header">
                        <div class="row">
                            
                            <div class="col-50">
                                <h3 class="no-margin-bottom text-color-theme">`+respuesta.titulo+`</h3>
                            	<p class="no-margin-bottom text-color-theme">`+respuesta.descripcion+`</p>

                            	<p class="no-margin-bottom text-color-theme">`+respuesta.fechaformato+`</p>
                            	<p class="no-margin-bottom text-color-theme">`+respuesta.horainicial+`-`+respuesta.horafinal+`Hrs.</p>

                            	<p class="no-margin-bottom text-color-theme">Cliente: `+respuesta.nombre+` `+respuesta.paterno+`</p>

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
                    </div>
                    <div class="card-content card-content-padding">
                        <p class="text-muted margin-bottom">
                           
                        </p>
                        <div class="row">
                          
                            
                            
                        </div>
                    </div>
                </div>
            </div>
							   							  	</div>
		   							 	 
		   							 			</div>


<div class="row" style="    margin-right: 2em;
    margin-left: 2em;margin-top:1em;">
					<div class="col-100">

						
						<div style="    justify-content: center;
    display: flex;">
						<span class="material-icons-outlined" style="font-size: 30px;">
							qr_code
							</span>

							</div>

						</div>

						<div class="col-100" onclick="scanqr()" >
						<h4 style="margin:0;text-align: center;">Leer qr</h4>
						</div>
					</div>

					<div class="row" style=" margin-right: 2em; margin-left: 2em;">
						<div class="col-80">
						<p style="    font-size: 16px;
    font-weight: bold;">Galeria de imágenes</p>
						</div>
						<div class="col-20">
						<span class="material-icons-outlined" style="    font-size: 30px;
    line-height: 60px;">
								camera_alt
								</span>
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
           
			

          },
          opened: function (sheet) {
            console.log('Sheet opened');
          },
        }
      });

       dynamicSheet1.open();
}

function ObtenerFechaActual() {
	var iduser=localStorage.getItem('id_user');
	var pagina = "ObtenerFechaActual.php";
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: urlphp+pagina,
		success: function(resultado){
			var respuesta=resultado.fechaactual;
			$(".fechaactual").text(respuesta);
			

			},error: function(XMLHttpRequest, textStatus, errorThrown){ 
				var error;
				  	if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
				  	if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
								//alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
					console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
			}
		});
}
