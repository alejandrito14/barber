var calendarModal="";
var dynamicSheet10="";
function CargarDatosEspecialista() {
	$(".licompras").css('display','none');
	$(".lifavoritos").css('display','none');
	$(".divcalendario").attr('onclick','AbrirCalendarioEspecialista()');
	$(".divhoy").attr('onclick','CargarFechafiltro();IntervaloCitas();');
	 var nombre= localStorage.getItem("nombre");
    $(".nombreusuario").text(nombre);
    $(".liconfiguracion").css('display','none');
     ObtenerEdad();
     CargarFechafiltro();
     ObtenerTableroAnuncios();
     Obtenerpublicidad(1);
	// ObtenerTableroCitasEspecialista();
	 ObtenerTotalesCitasEspecialista();
	 ObtenerFechaActual();
	 
	 ObtenerDetalleEmpresa();

	 $(".btnserviciosagendados").attr('onclick','GoToPage("calendarioespecialista")');


    $(".btnserviciosagendados").attr('onclick','MostrarServiciosEspe(100)');
    $(".btnserviciosproceso").attr('onclick','MostrarServiciosEspe(1)');
    $(".btnserviciospendientes").attr('onclick','MostrarServiciosEspe(0)');
    $(".btnserviciosrealizados").attr('onclick','MostrarServiciosEspe(2)');
    $(".btnserviciosnorealizados").attr('onclick','MostrarServiciosEspe(4)');
    $(".btnservicioscancelados").attr('onclick','MostrarServiciosEspe(3)');
    myStopFunction(identificadorDeTemporizador);
  myStopFunction(intervalocitas);


	intervalocitas=setInterval("ObtenerTotalesCitasEspecialista()",2000);	      
	//intervalocitas=setInterval("FiltrarTableroCitas()",2000);
}

function MostrarServiciosEspe(estatus) {

  localStorage.setItem('estatusmostrar',estatus);
  GoToPage("calendarioespecialista")
}

function IntervaloCitas() {
		intervalocitas=setInterval("FiltrarTableroCitas()",1000);

}


function ObtenerTableroCitasEspecialista(estatus) {

	//return new Promise((resolve, reject) => {
 	var idusuarios=localStorage.getItem('id_user');
	var datos="estatus="+estatus+"&idusuarios="+idusuarios+"&hoy=1";
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


function PintarTableroCitasEspecialista(respuesta) {
	var html="";
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

			var colorborde='#9c9c9c';
	         if (i % 2 === 0) {
	         
	         colorborde='#c7aa6a';
	         }


			html+=`
						<li class="col-100" style=" border: 1px solid `+colorborde+`;
    border-radius: 10px; margin-right: 1em; margin-left: 1em;margin-bottom: 1em;" >`;
				


					/*html+=`<a  class="bookmark-btn active"  >
						<span class="material-icons-outlined" style="font-size: 28px;`+color+`">
							qr_code
						</span>
					</a>`;*/

				
				html+=`
				</div>

				<div class="row">
					<div class="col-60">`;
			 html+=`<div class="card-bx job-card" style="padding-right: 0;">
         
          <div class="card-info">
            <p class="item-title" style="">
            <p style="margin:0;color:white;" >`+respuesta[i].fechaformato+`</a></p>
              <p style="color: white;font-size: 18px;margin:0;">`+respuesta[i].horacita+`-`+respuesta[i].horafinal+`hrs.</p>

            <p style="margin:0;color: white;" >Cliente: `+respuesta[i].nombreusuario+`</a></p>

            <p style="margin:0;color: white;" >Barbería: `+respuesta[i].titulo+`</a></p>
             <p style="margin:0;color: white;" >`+respuesta[i].concepto+`</p>



            </h6>
            <div class=""> `;

            if (respuesta[i].checkin==1) {
                html+=`
                  <p class="" style="display: flex;" >`;
                html+=`<span>check-in: `+respuesta[i].fechacheckin+`</span> <span class="material-icons-outlined" style=" width: 30px;justify-content: center;font-size: 20px;color:#5ac35b;margin-left: 5px;">
                    check_circle_outline
                    </span>

                    `;
                html+=`</p>`;
                  }

                  if (respuesta[i].checkout==1) {
                html+=`
                  <p class="" style="display: flex;" >`;
                html+=`<span>check-out: `+respuesta[i].fechacheckout+`</span> <span class="material-icons-outlined" style=" width: 30px;justify-content: center;font-size: 20px;color:#5ac35b;margin-left: 5px;">
                    check_circle_outline
                    </span>`;
                html+=`</p>`;
                  }

  
                html+=`<a id="btncalendario" style=" color: #007aff!important;text-align: center;justify-content: center;" onclick="AbrirModalCitaEspecialista(`+respuesta[i].idcita+`)">Ver detalle</a>`;

           html+= `</div>
            <div class="item-footer" onclick="AbrirModalCitaEspecialista(`+respuesta[i].idcita+`)">

            </div>
          </div>
          
        </div>`;

				html+=`	</div> 

					<div class="col-40">`;

					var claseestatus="";

                if (respuesta[i].estatuscita==0) {
                  claseestatus='estatuscitapendiente';
                  }
                  if (respuesta[i].estatuscita==1) {
                  claseestatus='estatuscitaproceso';
                  }
                  if(respuesta[i].estatuscita==2) {
                  claseestatus='estatuscitafinalizada';
                  }

                  if(respuesta[i].estatuscita==3) {
                  claseestatus='estatuscitacancelada';
                  }

                   if(respuesta[i].estatuscita==4) {
                  claseestatus='estatuscitavencida';
                  }

                 
                html+=`
                  <p  style="display: flex;text-align: right;
    justify-content: right;
    margin-right: 10px;" >`;
                html+=`<span class="`+claseestatus+`">`+respuesta[i].textoestatus+`</span>  `;
                html+=`</p>`;
                  

					html+=`
					</div>
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
			myStopFunction(intervalocitas);
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

var html=`  <div class="sheet-modal my-sheet-swipe-to-close1" style="height: 100%;background: black;">
            <div class="toolbar" style="background: black;margin-top: 20px;">
              <div class="toolbar-inner">
                <div class="left"></div>
                <div class="right">
                  <a class="link sheet-close"></a>
                </div>
              </div>
            </div>
            <div class="sheet-modal-inner" style="background: black;border-top-left-radius: 20px;border-top-right-radius:20px; ">
               <div class="iconocerrar link sheet-close" style="z-index:10;">
      <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M25.5188 4.48126C23.4385 2.4011 20.788 0.984547 17.9026 0.410715C15.0171 -0.163118 12.0264 0.131546 9.30839 1.25744C6.59043 2.38334 4.26736 4.28991 2.63294 6.73606C0.998525 9.18221 0.12616 12.0581 0.12616 15C0.12616 17.9419 0.998525 20.8178 2.63294 23.264C4.26736 25.7101 6.59043 27.6167 9.30839 28.7426C12.0264 29.8685 15.0171 30.1631 17.9026 29.5893C20.788 29.0155 23.4385 27.5989 25.5188 25.5188C26.9003 24.1375 27.9961 22.4976 28.7437 20.6928C29.4914 18.888 29.8762 16.9535 29.8762 15C29.8762 13.0465 29.4914 11.1121 28.7437 9.30724C27.9961 7.50242 26.9003 5.86255 25.5188 4.48126ZM20.3126 18.7613C20.4187 18.8606 20.5034 18.9808 20.5612 19.1142C20.6191 19.2476 20.6489 19.3915 20.6489 19.5369C20.6489 19.6823 20.6191 19.8262 20.5612 19.9596C20.5034 20.093 20.4187 20.2131 20.3126 20.3125C20.2133 20.411 20.0956 20.4889 19.9661 20.5418C19.8367 20.5946 19.698 20.6214 19.5582 20.6206C19.2795 20.6195 19.0124 20.5088 18.8145 20.3125L15.0001 16.4981L11.2388 20.3125C11.0409 20.5088 10.7738 20.6195 10.4951 20.6206C10.3553 20.6214 10.2166 20.5946 10.0872 20.5418C9.95773 20.4889 9.83999 20.411 9.74071 20.3125C9.54282 20.1134 9.43174 19.8441 9.43174 19.5634C9.43174 19.2827 9.54282 19.0135 9.74071 18.8144L13.502 15L9.74071 11.2388C9.56665 11.0355 9.47569 10.774 9.48602 10.5066C9.49635 10.2392 9.6072 9.98557 9.79642 9.79635C9.98565 9.60712 10.2393 9.49627 10.5067 9.48594C10.7741 9.47561 11.0356 9.56657 11.2388 9.74063L15.0001 13.5019L18.7613 9.74063C18.8597 9.63878 18.9772 9.55729 19.107 9.50083C19.2369 9.44437 19.3766 9.41404 19.5182 9.41158C19.6598 9.40911 19.8004 9.43456 19.9322 9.48646C20.0639 9.53836 20.1842 9.6157 20.286 9.71407C20.3879 9.81244 20.4694 9.9299 20.5258 10.0598C20.5823 10.1896 20.6126 10.3293 20.6151 10.4709C20.6175 10.6125 20.5921 10.7532 20.5402 10.8849C20.4883 11.0167 20.411 11.1369 20.3126 11.2388L16.4982 15L20.3126 18.7613Z" fill="#AAAAAA"></path>
            </svg>
                       </div>
              <div class="page-content cambiarfuente" style="height: 100%;">
                

                <div style="background: black; height: 100%;width: 100%;border-radius: 20px;position: absolute;top:3em;width: 100%;">
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
   							 	
	   						 <div class="row">
		   															 
		   			 <div class="col-100" style="    margin-left: 1em; margin-right: 1em;">
		   		<div class="card margin-bottom" style="background:black!important;">
		   							 	 
			<div class="row">
			<div class="col-100" style="margin-left: 1em;margin-right: 1em;margin-top: 1em;">
              
     <div class=" cambiarfuente " style="list-style: none;background: black;">

                 <li class="item-content cambiarfuente itemcarrito2" style="margin-top: 1em;border-bottom: 1px solid;margin-bottom: 1em;padding: 20px;
    padding-top: 1em;border-top: 1px solid white;">
            <div class="row" style="margin-bottom: 10px;">
              <div class="col-90">
                <div class="icon-text-container">`;
                var etiqueta='';
                if (respuesta.servicio==1) {
                  etiqueta="Servicio";
                }

                if (respuesta.servicio==0) {
                  etiqueta="Producto";
                }

               html+=`
               <span class="material-icons-outlined">inventory_2
                </span> <p style="margin:0;">`+etiqueta+`: <span class="texto">`+respuesta.concepto+`</span>
                </p>

                </div>
                <div class="icon-text-container" style="margin-top: 10px;">
                <span class="material-icons-outlined">local_atm</span>
                  <p style="margin:0;">Costo: <span class="texto">$`+respuesta.costo+`</span>
                  </p>
                </div>
                <div class="icon-text-container" style="margin-top: 10px;">
                 <span class="material-icons-outlined">
                    add_business
                    </span>
                    <p style="margin:0;">
                   
                    Negocio: <span class="texto">`+respuesta.titulo+`</span></p>
                     </div>
                    `;

                       if (respuesta.servicio==0) {
                      html+=`<p style="margin:0;">Cantidad: `+respuesta.cantidad+`</p>`;
                 
                  }else{


                    html+=` 
                        <div class="icon-text-container" style="margin-top: 10px;">
                        <span class="material-icons-outlined">supervised_user_circle</span>
                    <p style="margin:0;">Barbero: <span class="texto">`+respuesta.nombreespecialista+` </span></p>
                    </div>
                    `;

                    html+=` 
                        <div class="icon-text-container" style="margin-top: 10px;">
                        <span class="material-icons-outlined">supervised_user_circle</span>
                    <p style="margin:0;">Cliente: <span class="texto">`+respuesta.nombreusuario+`</span></p>
                    </div>
                    `;


                    html+=` 
                       <div class="icon-text-container" style="margin-top: 10px;width: 100%;justify-content: center;display: flex;">
                    <span class="texto" style="
                          background: gray;
                          padding: 3px;
                          border-radius: 10px;
                      " onclick="AbrirModalPerfilCliente(`+respuesta.idusuarios+`)">Perfil del cliente</span>
                    </div>
                    `;

                    html+=`
                   <div class="icon-text-container" style="margin-top:10px;">
                     <span class="material-icons-outlined">calendar_month</span>

                     <p style="margin:0;">Fecha/Hora: <span class="texto">`+respuesta.fechaformato+` `+respuesta.horainicial+'-'+respuesta.horafinal+`</span></p>

                     </div>
                     `;

                        if (respuesta.concortesia==1  ) {


                          if (respuesta.idcortesia>0 ) {

                          html+=`


                         <div class="icon-text-container" style="margin-top: 10px;">
                           <span class="material-icons-outlined">card_giftcard</span>

                           <p style="margin:0;">Cortesía: <span class="texto">`+respuesta.nombrepaquetecortesia+`</span></p>

                           </div>`;

                            html+=`
                            <div class="icon-text-container" style="margin-top: 10px;width: 100%;justify-content: center;display: flex;">
                    <span class="texto" style="
                          background: gray;
                          padding: 3px;
                          border-radius: 10px;
                      " onclick="CambiarCortesia(`+respuesta.idcita+`)">Cambiar cortesía</span>
                    </div>

                           `;

                      }


                      if (respuesta.idcortesia==0 ) {

                          html+=`


                         <div class="icon-text-container" style="margin-top: 10px;">
                           <span class="material-icons-outlined">card_giftcard</span>

                           <p style="margin:0;">Cortesía: <span class="texto">Ninguna</span></p>

                           </div>`;


                           html+=`
                            <div class="icon-text-container" style="margin-top: 10px;width: 100%;justify-content: center;display: flex;">
                    <span class="texto" style="
                          background: gray;
                          padding: 3px;
                          border-radius: 10px;
                      " onclick="CambiarCortesia(`+respuesta.idcita+`)">Cambiar cortesía</span>
                    </div>

                           `;
                      }

                       /* html+=`
                        <div class="col-100" style="padding-bottom: 1em;
    padding-top: 1em;">
                      <button class="button  color-theme  " style="background:#C7AA6A;padding:10px 20px;" onclick="ObtenerCortesia(`+respuesta[i].idcarrito+`,`+respuesta[i].idpaquete+`)">
                        Cortesia
                       </button>
                     
                     </div>
                      `;*/

                    }else{

                 
          

                    }
                  }

                  

              html+=` </div>
                <div class="col-10">`;

                  if (respuesta.precioante!=0) {
                     html+=`
                     <div class="col-100">
                     <p style="margin:0;text-decoration:line-through;font-size: 12px;text-align: right;">$`+respuesta.precioante+`</p>
                     </div>
                     `;

                  }


                   html+=`
                   <div class="col-100">
                   
                     </div>
                     `;

                 



             html+=` </div>

              </div> 
          </li>
         <div class="icon-text-container" style="margin-top: 10px; margin-left: 30px;">
                 	`;
                            	
                            	if(respuesta.checkin==1) {
                            
                            	html+=` <p class="" style="display: flex;"><span>check-in:</span> <span class="material-icons-outlined" 
                            	style=" width: 30px;justify-content: center;font-size: 20px;color:#5ac35b;">
										check_circle_outline
										</span>
									</p>`;	
                            
                            }

                            if (respuesta.checkout==1) {

								html+=`
								<p class="" style="display: flex;">
										<span>check-out:</span> <span class="material-icons-outlined" 
										style=" width: 30px;justify-content: center;font-size: 20px;color:#5ac35b;">
										check_circle_outline
										</span>
								</p>
										`;
									}

                              if (respuesta.cancelacion==1) {
                                  html+=`
                                    <div class="col-100">
                                      <p class="" style="display: flex;"><span>cancelado:</span> <span class="material-icons-outlined" 
                                      style=" width: 30px;justify-content: center;font-size: 20px;color:red;">
                                      block
                                      </span>
                                    </p>
                                </div>

                                  `;

                                }

                           html+=` 

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
                    
                  
                        <div class="row" style="margin-top:1em;">
                        `;

                        	if(respuesta.checkin==1 && (respuesta.finalizacita=='' || respuesta.finalizacita==null) ) {
                   					
                        		html+=`<div class="cronometro"></div>`;
                   						 html+=`<button class="button button-large button-raised"  style="background:#C7AA6A;color:white;" onclick="VisualizarTiempo()">Tiempo transcurrido</button>`;
                          
                          }

                          if (respuesta.estatus==0 && respuesta.checkin==0 && respuesta.cancelacion==0 && respuesta.tpv==1) {

                            html+=`<div class="checkinmanual"></div>`;
                               html+=`<button class="button button-large button-raised"  style="background:#C7AA6A;color:white;" onclick="RealizarCheckin(`+respuesta.idcita+`)">Check-in</button>`;
                           

                          }
                           
                           html+=`
                            
                        </div>

                        </div>
                    </div>
                </div>
            </div>





  


<div class="row" style="    margin-right: 2em;
    margin-left: 2em;margin-top:1em;">
          <div class="row" style=" margin-right: 2em; margin-left: 2em;">
            <div class="col-80">
              <p style="font-size: 16px;font-weight: bold;">Galeria de imágenes</p>
            </div>
            <div class="col-20" onclick="AbrirModalFotoimagencita()">
                <span class="material-icons-outlined" style="    font-size: 30px;line-height: 60px;margin-left: 1em;">
                camera_alt
                </span>
            </div>
          </div>
      </div>

      <div class="" style="
    margin-right: 2em;
    margin-left: 2em;
    margin-bottom: 100px;
    width: 100%;
">
        <div class="">
            <div class="listadoimagenescita" style="width:100%;">
            </div>
        </div>
</div>

      <div style="height:200px;"></div>
							   							  	
           												 </div>
							   							  	</div>
		   							 	 


                        


		   							 			`;

		   							
		   							 	html+=`</div>



              
		   							 		<div class="row">

		   							 		`;

		   							 	


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
          
	  dynamicSheet10 = app.sheet.create({
        content: html,

    	swipeToClose: true,
        backdrop: true,
        // Events
        on: {
          open: function (sheet) {
           
					ObtenerImagenescita();
         // ObtenerImagenescitaComentario();
          },
          opened: function (sheet) {
            console.log('Sheet opened');
          },

          close: function (sheet) {
           
          		//intervalocitas=setInterval("FiltrarTableroCitas()",2000);

          },
      }
        
      });

       dynamicSheet10.open();
}

function VisualizarTiempo() {

	dynamicSheet10.close();
	GoToPage('validadoqrcita');
}

function RealizarCheckin(idcita) {
  var aviso='';
   aviso+='¿Estás seguro de realizar la operación?';

  var html=` <div class="sheet-modal my-sheet-swipe-to-close1" style="height: 70%;background: black;">
           
            <div class="sheet-modal-inner" style="background: white;border-top-left-radius: 20px;border-top-right-radius:20px; ">
               <div class="iconocerrar link sheet-close" style="z-index:10;">
               <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M25.5188 4.48126C23.4385 2.4011 20.788 0.984547 17.9026 0.410715C15.0171 -0.163118 12.0264 0.131546 9.30839 1.25744C6.59043 2.38334 4.26736 4.28991 2.63294 6.73606C0.998525 9.18221 0.12616 12.0581 0.12616 15C0.12616 17.9419 0.998525 20.8178 2.63294 23.264C4.26736 25.7101 6.59043 27.6167 9.30839 28.7426C12.0264 29.8685 15.0171 30.1631 17.9026 29.5893C20.788 29.0155 23.4385 27.5989 25.5188 25.5188C26.9003 24.1375 27.9961 22.4976 28.7437 20.6928C29.4914 18.888 29.8762 16.9535 29.8762 15C29.8762 13.0465 29.4914 11.1121 28.7437 9.30724C27.9961 7.50242 26.9003 5.86255 25.5188 4.48126ZM20.3126 18.7613C20.4187 18.8606 20.5034 18.9808 20.5612 19.1142C20.6191 19.2476 20.6489 19.3915 20.6489 19.5369C20.6489 19.6823 20.6191 19.8262 20.5612 19.9596C20.5034 20.093 20.4187 20.2131 20.3126 20.3125C20.2133 20.411 20.0956 20.4889 19.9661 20.5418C19.8367 20.5946 19.698 20.6214 19.5582 20.6206C19.2795 20.6195 19.0124 20.5088 18.8145 20.3125L15.0001 16.4981L11.2388 20.3125C11.0409 20.5088 10.7738 20.6195 10.4951 20.6206C10.3553 20.6214 10.2166 20.5946 10.0872 20.5418C9.95773 20.4889 9.83999 20.411 9.74071 20.3125C9.54282 20.1134 9.43174 19.8441 9.43174 19.5634C9.43174 19.2827 9.54282 19.0135 9.74071 18.8144L13.502 15L9.74071 11.2388C9.56665 11.0355 9.47569 10.774 9.48602 10.5066C9.49635 10.2392 9.6072 9.98557 9.79642 9.79635C9.98565 9.60712 10.2393 9.49627 10.5067 9.48594C10.7741 9.47561 11.0356 9.56657 11.2388 9.74063L15.0001 13.5019L18.7613 9.74063C18.8597 9.63878 18.9772 9.55729 19.107 9.50083C19.2369 9.44437 19.3766 9.41404 19.5182 9.41158C19.6598 9.40911 19.8004 9.43456 19.9322 9.48646C20.0639 9.53836 20.1842 9.6157 20.286 9.71407C20.3879 9.81244 20.4694 9.9299 20.5258 10.0598C20.5823 10.1896 20.6126 10.3293 20.6151 10.4709C20.6175 10.6125 20.5921 10.7532 20.5402 10.8849C20.4883 11.0167 20.411 11.1369 20.3126 11.2388L16.4982 15L20.3126 18.7613Z" fill="#AAAAAA"></path>
            </svg>
                       </div>
              <div class="page-content" style="height: 100%;">
                <div style="background: black; height: 100%;width: 100%;border-radius: 20px;">
                   <div class="row">
                     <div class="col-20">
                        
                    </div>

                     <div class="col-60">
                     <span class="titulomodal cambiarfuente" style="font-size: 20px;
    text-align: center;
    font-weight: 600;
    color: #c7aa6a;"></span>
                     </div>
                     <div class="col-20">
                     <span class="limpiarfiltros"></span>
                     </div>
                 </div>
                 <div class="" style="position: absolute;top:1em;width: 100%;">
                
                       
                        `;

                       

                          html+=`
                          <div class="divcitacancela">
                          <div class="row" style="margin-left: 2em;margin-right: 2em;margin-top:20px;">
                          <div class="col-100">
                          <p class="cambiarfuente cambiarfuente2" style="color: #c7aa6a;font-size: 30px;text-align: center;line-height: 1;" class="cambiarfuente">`+aviso+`</p>
                          </div>

                          </div>

                          <div class="row margin-bottom " style="padding-top: 1em;    margin-left: 2em;margin-right: 2em;margin-top:20px;">
                            <div class="col-50">
                            <button style="background: #C7AA6A;color:white;" type="button" class="button button-fill color-theme button-large button-raised  cambiarfuente" onclick="AceptarCheckin(`+idcita+`)">Si</button>
                            </div>

                            <div class="col-50">
                            <button style="background: white;color:black;" type="button" class="button button-fill color-theme button-large button-raised  cambiarfuente" onclick="CerrarModalAviso5()">No</button>
                            </div>
                          </div>

                          </div>

             

                  </div>

                </div>
                
              </div>
            </div>
          </div>`;
          /*<p><button class="button color-theme btncortesias" id="cortesia_`+respuesta[i].idcortesia+`" onclick="ElegirCortesia(`+idcarrito+`,`+respuesta[i].idcortesia+`)" style="background: white;color:black;padding: 10px 20px;">
                                        Elegir
                                       </button>
                                     </p>*/
    dynamicSheet5 = app.sheet.create({
        content: html,

      swipeToClose: true,
        backdrop: true,
        // Events
        on: {
          open: function (sheet) {
           $(".cambiarfuente2").css('display','none');
            

          },
          opened: function (sheet) {
            console.log('Sheet opened');

            if (tipoletra!='') {
              $(".cambiarfuente").addClass(tipoletra);
            }
          $(".cambiarfuente2").css('display','block');

          },
        }
      });

       dynamicSheet5.open();


}

function AceptarCheckin(idcita) {
  dynamicSheet5.close();
  dynamicSheet10.close();

  var iduser=localStorage.getItem('id_user');
  var datos="idcita="+idcita+"&iduser="+iduser;
  var pagina = "AceptarCheckin.php";
  $.ajax({
    type: 'POST',
    dataType: 'json',
    url: urlphp+pagina,
    data:datos,
    success: function(res){
                var respuesta=res;


          if (respuesta.validado==1) {

                  localStorage.setItem('idcita',respuesta.cita);
                 // alerta('','Se ha validado el qr');

                  GoToPage('validadoqrcita');
                  var detallecita=res.detallecita[0];
                  AbrirValidacionQr2(detallecita);
                }
 
                 if (respuesta.validado==2) {
                  localStorage.setItem('cita',respuesta.cita);

                  var aviso="La cita se encuentra fuera de horario";
                  AbrirModalAviso(aviso);
                  
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
			var fecha=resultado.fechafiltro;
   
      localStorage.setItem('fechaconsulta',fecha);

			},error: function(XMLHttpRequest, textStatus, errorThrown){ 
				var error;
				  	if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
				  	if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
								//alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
					console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
			}
		});
}

function CargarFechafiltro() {
	 const fechaActual = new Date();

    // Obtiene el día, el mes y el año de la fecha actual
    const dia = fechaActual.getDate().toString().padStart(2, '0');
	const mes = (fechaActual.getMonth() + 1).toString().padStart(2, '0');
    const anio = fechaActual.getFullYear();

    // Formatea la fecha actual como "DD/MM/AAAA"
    const fechaFormateada = anio + "-" + mes + "-" + dia;
	localStorage.setItem('fechafiltro',fechaFormateada);

}
function AbrirCalendarioEspecialista() {
MarcarCitasCalendario();
	  

/*$(".calendar-footer").html('');
	var html=`
		<a class="button calendar-close sheet-close popover-close">Filtrar</a>
		<a class="button calendar-close sheet-close popover-close">Cerrar</a>
	`;*/
}

function MarcarCitasCalendario() {
	

 var fecha=new Date();
 var mes=(fecha.getMonth() + 1)<10?'0'+(fecha.getMonth() + 1):(fecha.getMonth() + 1);
 var anio= fecha.getFullYear();
  var iduser=localStorage.getItem('id_user');
  var datos="idusuario="+iduser+"&mes="+mes+"&anio="+anio;

  var pagina = "ObtenerCitasFechasCalendarioEspecialista.php";
  $.ajax({
    type: 'POST',
    dataType: 'json',
    url: urlphp+pagina,
    data:datos,
    async:false,
    success: function(resp){
       eventos=[];
        var citas=resp.citasdia;

       if (resp.citados.length>0) {
        var fechascitas=resp.citados;
        for (var i = 0; i <fechascitas.length; i++) {
         
            var dividirfecha=fechascitas[i].split('-');
            var anio=dividirfecha[0];
            var mes=(dividirfecha[1].replace(/^(0+)/g, '')-1);
            var dia=dividirfecha[2];


          var objeto={
              date:new Date(anio,mes,dia),
              color:'rgb(245,212,95)',
            };
              eventos.push(objeto);
        }


       }

	 var monthNames = ['Enero', 'Febrero', 'Marzo', 'Abrirl', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

       calendarModal = app.calendar.create({
        inputEl: '#demo-calendar-modal',
        openIn: 'customModal',
        events:eventos,
        firstDay:0,
        weekHeader: true,
        header: true,
        footer: true,
        toolbarCloseText:'Cerrar',
        headerPlaceholder:'Seleccionar fecha',
         dateFormat: 'dd/mm/yyyy',

         closeOnSelect:true,
          renderToolbar: function () {
          return '<div class="toolbar calendar-custom-toolbar no-shadow">' +
            '<div class="toolbar-inner">' +
            '<div class="left">' +
            '<a  class="link icon-only"><i class="icon icon-back"></i></a>' +
            '</div>' +
            '<div class="center"></div>' +
            '<div class="right">' +
            '<a  class="link icon-only"><i class="icon icon-forward"></i></a>' +
            '</div>' +
            '</div>' +
            '</div>';
        },
         on:{

         	init: function (c) {
           

          },

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
         	 			FiltrarTableroCitas();
         	 		}
          },

          open:function (c) {
          	
          	 $('.calendar-custom-toolbar .left .link').on('click', function () {
              calendarModal.prevMonth();
              //alert(c.currentMonth,c.currentYear);
                           AnteriorSiguiente(c.currentMonth,c.currentYear);

            });
            $('.calendar-custom-toolbar .right .link').on('click', function () {
            	calendarModal.nextMonth();
            	//AnteriorSiguiente(c.currentMonth,c.currentYear);
             AnteriorSiguiente(c.currentMonth,c.currentYear);

            });

            $('.calendar-custom-toolbar .center').text(monthNames[c.currentMonth] + ', ' + c.currentYear);

          $(".calendar-day-today .calendar-day-number").addClass('diaactual');
            $(".calendar-day-has-events .calendar-day-number").addClass('calendarevento');
                 $(".calendar-day-event").css('display','none');

          },
           monthYearChangeStart: function (c) {
            $('.calendar-custom-toolbar .center').text(monthNames[c.currentMonth] + ', ' + c.currentYear);

          }
         }
      });

	calendarModal.open();
   },error: function(XMLHttpRequest, textStatus, errorThrown){ 
				var error;
				  	if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
				  	if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
								//alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
					console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
			}
		});
}

function AnteriorSiguiente(mes,anio) {
	

 var mes=(mes + 1)<10?'0'+(mes + 1):(mes + 1);

  var iduser=localStorage.getItem('id_user');
  var datos="idusuario="+iduser+"&mes="+mes+"&anio="+anio;

  var pagina = "ObtenerCitasFechasCalendarioEspecialista.php";
  $.ajax({
    type: 'POST',
    dataType: 'json',
    url: urlphp+pagina,
    data:datos,
    async:false,
    success: function(resp){
       eventos=[];
        var citas=resp.citasdia;

       if (resp.citados.length>0) {
        var fechascitas=resp.citados;
        for (var i = 0; i <fechascitas.length; i++) {
         
            var dividirfecha=fechascitas[i].split('-');
            var anio=dividirfecha[0];
            var mes=(dividirfecha[1].replace(/^(0+)/g, '')-1);
            var dia=dividirfecha[2];


          var objeto={
              date:new Date(anio,mes,dia),
              color:'rgb(245,212,95)',
            };
              eventos.push(objeto);
        }


       }

       // Actualiza el calendario con los nuevos eventos
		/*calendarModal.update({
		  events: eventos
		});*/
    //aqui
 calendarInline.params.events = eventos;
            calendarInline.update();

          $(".calendar-day-has-events .calendar-day-number").addClass('calendarevento');
          $(".calendar-day-event").css('display','none');


    },error: function(XMLHttpRequest, textStatus, errorThrown){ 
				var error;
				  	if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
				  	if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
								//alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
					console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
			}
		});

}

function FiltrarTableroCitas() {
	var iduser=localStorage.getItem('id_user');
	var fecha=localStorage.getItem('fechafiltro');
	var estatus=1;
	var datos="idusuarios="+iduser+"&fechafiltro="+fecha+"&estatus="+estatus+"&hoy=0";
	var pagina = "ObtenerTableroCitasEspecialista.php";
	

	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: urlphp+pagina,
		data:datos,
		success: function(datos){
			myStopFunction(intervalo);
			var respuesta=datos.respuesta;
			var fecha=datos.fechafiltro;
			PintarTableroCitasEspecialista(respuesta);
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

function ObtenerTiempoCita() {
	var iduser=localStorage.getItem('id_user');
	var idcita=localStorage.getItem('idcita');

	var datos="idcita="+idcita+"&iduser="+iduser;
	var pagina = "ObtenerTiempoCita.php";
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: urlphp+pagina,
		data:datos,
		success: function(datos){
			localStorage.setItem('idcita',idcita);
			var respuesta=datos.respuesta;
			var hora=datos.horas;
			var minuto=datos.minutos;
			var segundo=datos.segundos;
			var centes=datos.centesimas;

			  colocarvalor(centes,segundo,minuto,hora);
			  $("#txtbarberia").text(respuesta.titulo);
						  $("#txthora").html(respuesta.horainicial+'-'+respuesta.horafinal+'Hrs.');


			},error: function(XMLHttpRequest, textStatus, errorThrown){ 
				var error;
				  	if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
				  	if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
								//alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
					console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
			}
		});
	
}


function RegresarHomeEspecialista() {
		clearInterval(control);
	GoToPage('homeespecialista');
}

function FinalizarCita() {

  var aviso='¿Estás seguro de finalizar la cita?';

  var html=` <div class="sheet-modal my-sheet-swipe-to-close1" style="height: 70%;background: black;">
           
            <div class="sheet-modal-inner" style="background: white;border-top-left-radius: 20px;border-top-right-radius:20px; ">
               <div class="iconocerrar link sheet-close" style="z-index:10;">
               <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M25.5188 4.48126C23.4385 2.4011 20.788 0.984547 17.9026 0.410715C15.0171 -0.163118 12.0264 0.131546 9.30839 1.25744C6.59043 2.38334 4.26736 4.28991 2.63294 6.73606C0.998525 9.18221 0.12616 12.0581 0.12616 15C0.12616 17.9419 0.998525 20.8178 2.63294 23.264C4.26736 25.7101 6.59043 27.6167 9.30839 28.7426C12.0264 29.8685 15.0171 30.1631 17.9026 29.5893C20.788 29.0155 23.4385 27.5989 25.5188 25.5188C26.9003 24.1375 27.9961 22.4976 28.7437 20.6928C29.4914 18.888 29.8762 16.9535 29.8762 15C29.8762 13.0465 29.4914 11.1121 28.7437 9.30724C27.9961 7.50242 26.9003 5.86255 25.5188 4.48126ZM20.3126 18.7613C20.4187 18.8606 20.5034 18.9808 20.5612 19.1142C20.6191 19.2476 20.6489 19.3915 20.6489 19.5369C20.6489 19.6823 20.6191 19.8262 20.5612 19.9596C20.5034 20.093 20.4187 20.2131 20.3126 20.3125C20.2133 20.411 20.0956 20.4889 19.9661 20.5418C19.8367 20.5946 19.698 20.6214 19.5582 20.6206C19.2795 20.6195 19.0124 20.5088 18.8145 20.3125L15.0001 16.4981L11.2388 20.3125C11.0409 20.5088 10.7738 20.6195 10.4951 20.6206C10.3553 20.6214 10.2166 20.5946 10.0872 20.5418C9.95773 20.4889 9.83999 20.411 9.74071 20.3125C9.54282 20.1134 9.43174 19.8441 9.43174 19.5634C9.43174 19.2827 9.54282 19.0135 9.74071 18.8144L13.502 15L9.74071 11.2388C9.56665 11.0355 9.47569 10.774 9.48602 10.5066C9.49635 10.2392 9.6072 9.98557 9.79642 9.79635C9.98565 9.60712 10.2393 9.49627 10.5067 9.48594C10.7741 9.47561 11.0356 9.56657 11.2388 9.74063L15.0001 13.5019L18.7613 9.74063C18.8597 9.63878 18.9772 9.55729 19.107 9.50083C19.2369 9.44437 19.3766 9.41404 19.5182 9.41158C19.6598 9.40911 19.8004 9.43456 19.9322 9.48646C20.0639 9.53836 20.1842 9.6157 20.286 9.71407C20.3879 9.81244 20.4694 9.9299 20.5258 10.0598C20.5823 10.1896 20.6126 10.3293 20.6151 10.4709C20.6175 10.6125 20.5921 10.7532 20.5402 10.8849C20.4883 11.0167 20.411 11.1369 20.3126 11.2388L16.4982 15L20.3126 18.7613Z" fill="#AAAAAA"></path>
            </svg>
                       </div>
              <div class="page-content" style="height: 100%;">
                <div style="background: black; height: 100%;width: 100%;border-radius: 20px;">
                   <div class="row">
                     <div class="col-20">
                        
                    </div>

                     <div class="col-60">
                     <span class="titulomodal cambiarfuente" style="font-size: 20px;
    text-align: center;
    font-weight: 600;
    color: #c7aa6a;"></span>
                     </div>
                     <div class="col-20">
                     <span class="limpiarfiltros"></span>
                     </div>
                 </div>
                 <div class="" style="position: absolute;top:1em;width: 100%;">
                
                       
                        `;

                       

                          html+=`
                          <div class="divcitacancela">
                          <div class="row" style="margin-left: 2em;margin-right: 2em;margin-top:20px;">
                          <div class="col-100">
                          <p class="cambiarfuente cambiarfuente2" style="color: #c7aa6a;font-size: 30px;text-align: center;line-height: 1;" class="cambiarfuente">`+aviso+`</p>
                          </div>

                          </div>

                          <div class="row margin-bottom " style="padding-top: 1em;    margin-left: 2em;margin-right: 2em;margin-top:20px;">
                            <div class="col-50">
                            <button style="background: #C7AA6A;color:white;" type="button" class="button button-fill color-theme button-large button-raised  cambiarfuente" onclick="AceptarFinalizar()">Si</button>
                            </div>

                            <div class="col-50">
                            <button style="background: white;color:black;" type="button" class="button button-fill color-theme button-large button-raised  cambiarfuente" onclick="CerrarModalAviso5()">No</button>
                            </div>
                          </div>

                          </div>

                          <div class="divmotivocancela" style="display:none;">
                          	<div class="">
                          		<div class="col-100">
                              <form>
                            	<div class="list" style="margin:0;">
	                              <ul class="row">
	                                <li class="item-content col-100 item-input item-input-with-value">
	                                  <div class="item-inner">
	                                    <div class="item-input-wrap">
	                                      <input type="text" placeholder="Motivo de cancelación"  id="motivocancelacion" class="form-control"/>
	                                    </div>
	                                  </div>
	                                </li>

	                                </ul>
                                </div>
                                </form>
                          	</div>
                          </div>


                      </div>

                  </div>

                </div>
                
              </div>
            </div>
          </div>`;
          /*<p><button class="button color-theme btncortesias" id="cortesia_`+respuesta[i].idcortesia+`" onclick="ElegirCortesia(`+idcarrito+`,`+respuesta[i].idcortesia+`)" style="background: white;color:black;padding: 10px 20px;">
                                        Elegir
                                       </button>
                                     </p>*/
    dynamicSheet5 = app.sheet.create({
        content: html,

      swipeToClose: true,
        backdrop: true,
        // Events
        on: {
          open: function (sheet) {
           $(".cambiarfuente2").css('display','none');
            

          },
          opened: function (sheet) {
            console.log('Sheet opened');

            if (tipoletra!='') {
              $(".cambiarfuente").addClass(tipoletra);
            }
          $(".cambiarfuente2").css('display','block');

          },
        }
      });

       dynamicSheet5.open();

}


function AceptarFinalizar() {
	// body...
	dynamicSheet5.close();
	var iduser=localStorage.getItem('id_user');
	var idcita=localStorage.getItem('idcita');

	var datos="idcita="+idcita+"&iduser="+iduser;
	var pagina = "FinalizarCita.php";
	$.ajax({ 
		type: 'POST',
		dataType: 'json',
		url: urlphp+pagina,
		data:datos,
		success: function(datos){
		
			var respuesta=datos.respuesta;
      var conpago=datos.conpago;
			//alerta('','Se finalizó la cita');

      if (conpago==1 && respuesta==1) {
            var aviso="Se finalizó la cita";
            AbrirModalAviso(aviso);
            $("#txttitulocita").html('Cita finalizada');
            $("#contenedor").html('');
            $("#txttiempo").html('');
            $(".btnfinalizar").css('display','none');
            myStopFunction(control);

      }else{
          var aviso="Es necesario que se complete el pago";
          AbrirModalAviso(aviso);

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

function CargarCalendarioespecialista() {
  var fecha=new Date();
  var mes=(fecha.getMonth() + 1)<10?'0'+(fecha.getMonth() + 1):(fecha.getMonth() + 1);
  var anio= fecha.getFullYear();
//  var iduser=localStorage.getItem('id_user');
  var estatuscarga=localStorage.getItem('estatusmostrar');
  var fecha=new Date();
  var mes=(fecha.getMonth() + 1)<10?'0'+(fecha.getMonth() + 1):(fecha.getMonth() + 1);
  var anio= fecha.getFullYear();
  var iduser=localStorage.getItem('id_user');
  var datos="idusuario="+iduser+"&mes="+mes+"&anio="+anio+"&estatuscarga="+estatuscarga;

  var pagina = "ObtenerCitasFechasCalendarioEspecialista.php";
 
 
  //var pagina = "ObtenerCitasFechasCalendario.php";
  $.ajax({
    type: 'POST',
    dataType: 'json',
    url: urlphp+pagina,
    data:datos,
    async:false,
    success: function(resp){
        eventos=[];
        var citas=resp.citasdia;
        var fechactual1=resp.fechaactual;
        $(".divfechaactual").html(fechactual1);
 
       if (resp.citados.length>0) {
        var fechascitas=resp.citados;
        for (var i = 0; i <fechascitas.length; i++) {
         
            var dividirfecha=fechascitas[i].split('-');
            var anio=dividirfecha[0];
            var mes=(dividirfecha[1].replace(/^(0+)/g, '')-1);
            var dia=dividirfecha[2];


          var objeto={
              date:new Date(anio,mes,dia),
              color:'rgb(245,212,95)',
            };
              eventos.push(objeto);
        }


       }

        if (citas.length>0) {
       
       	 PintarTableroCitasEspecialista(citas);
       }

     // $(".tablerocitas").html('');

     /* 

       var citasagendadas=resp.totalcitasdia;
       var totalcitasrealizadas=resp.totalcitasrealizadas;
       var totalnorealizados=resp.totalnorealizados;
       var totalpendientes=resp.totalpendientes;
       $("#totalservicios2").text(citasagendadas);
       $("#totalserviciosrealizados2").text(totalcitasrealizadas);
       $("#totalserviciospendientes2").text(totalpendientes);
       $("#totalserviciosnorealizados2").text(totalnorealizados);
      
        var totalproceso=resp.totalproceso;
        var totalcancelados=resp.totalcancelados;
        
       $("#totalserviciosproceso2").text(totalproceso);
       $("#totalservicioscancelados2").text(totalcancelados);

  */


  	  var citasagendadas=resp.totalcitasdia;
       var totalcitasrealizadas=resp.totalcitasrealizadas;
       var totalnorealizados=resp.totalnorealizados;
       var totalpendientes=resp.totalpendientes;
       $("#totalservicios2").text(citasagendadas);
       $("#totalserviciosrealizados2").text(totalcitasrealizadas);
       $("#totalserviciospendientes2").text(totalpendientes);
       $("#totalserviciosnorealizados2").text(totalnorealizados);
      
        var totalproceso=resp.totalproceso;
        var totalcancelados=resp.totalcancelados;
        
       $("#totalserviciosproceso2").text(totalproceso);
       $("#totalservicioscancelados2").text(totalcancelados);


	 var monthNames = ['Enero', 'Febrero', 'Marzo', 'Abrirl', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
      calendarInline = app.calendar.create({
        containerEl: '#demo-calendar',
        weekHeader: true,
        firstDay:0,
        events:eventos,
        renderToolbar: function () {
          return `
          <div class="toolbar calendar-custom-toolbar no-shadow">
            <div class="toolbar-inner">
              <div class="left">
                <a href="#" class="link icon-only"><i class="icon icon-back ${app.theme === 'md' ? 'color-black' : ''}"></i></a>
              </div>
              <div class="center"></div>
              <div class="right">
                <a href="#" class="link icon-only"><i class="icon icon-forward ${app.theme === 'md' ? 'color-black' : ''}"></i></a>
              </div>
            </div>
          </div>
          `;
        },
        on: {
          init: function (c) {
            $('.calendar-custom-toolbar .center').text(monthNames[c.currentMonth] + ', ' + c.currentYear);
            $('.calendar-custom-toolbar .left .link').on('click', function () {
              calendarInline.prevMonth();
              //aqui
                           AnteriorSiguiente(c.currentMonth,c.currentYear);
            });
            $('.calendar-custom-toolbar .right .link').on('click', function () {
              calendarInline.nextMonth();
                           AnteriorSiguiente(c.currentMonth,c.currentYear);
            });

          $(".calendar-day-today .calendar-day-number").addClass('diaactual');
            $(".calendar-day-has-events .calendar-day-number").addClass('calendarevento');
                 $(".calendar-day-event").css('display','none');
 
          },

          calendarChange:function (c) {
          console.log(c.value);
          var fechaac=new Date();
          var mes=fechaac.getMonth()+1;
          var dia=fechaac.getDate();
          fechaactualdata=fechaac.getFullYear()+'-'+ mes+'-'+dia;
         
          var fecha=c.value;
          var convertirfecha=new Date(fecha);
          var mes=(convertirfecha.getMonth() + 1)<10?'0'+(convertirfecha.getMonth() + 1):(convertirfecha.getMonth() + 1);
          var mesdata=convertirfecha.getMonth();

          var dia=convertirfecha.getDate()<10?'0'+convertirfecha.getDate():convertirfecha.getDate();
          var diadata=convertirfecha.getDate();

          fecha1=convertirfecha.getFullYear()+'-'+ mes+'-'+dia;
          localStorage.setItem('fechaconsulta',fecha1);
          ConsultarFechaCitaEspe(fecha1);
          // ConsultarFechaCita(fecha1);
          // $("#v_especialista").html('');
           
          
      
          },
          monthYearChangeStart: function (c) {
            $('.calendar-custom-toolbar .center').text(monthNames[c.currentMonth] + ', ' + c.currentYear);
          }
        }
      });
   


      },error: function(XMLHttpRequest, textStatus, errorThrown){ 
        var error;
            if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
            if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
          console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
      }
    });

   // return $render;
  
}

function ConsultarFechaCitaEspe(fecha) {
	 var estatuscarga=localStorage.getItem('estatusmostrar');

   var iduser=localStorage.getItem('id_user');
  var datos="idusuario="+iduser+"&fecha="+fecha+"&estatuscarga="+estatuscarga;
   var pagina = "ObtenerCitasFechasCalendarioEspecialista.php";
  $.ajax({
    type: 'POST',
    dataType: 'json',
    url: urlphp+pagina,
    data:datos,
    async:false,
    success: function(resp){
        var citas=resp.citasdia;
        var fechafiltro=resp.fechafiltro;
        $(".divfechaactual").html(fechafiltro);

       $(".tablerocitas").html(' ');
       if (citas.length>0) {
       
        PintarTableroCitasEspecialista(citas);
       }


       var citasagendadas=resp.totalcitasdia;
       var totalcitasrealizadas=resp.totalcitasrealizadas;
       var totalnorealizados=resp.totalnorealizados;
       var totalpendientes=resp.totalpendientes;
       var totalproceso=resp.totalproceso;
       var totalcancelados=resp.totalcancelados;
      
       $("#totalservicios2").text(citasagendadas);
       $("#totalserviciosrealizados2").text(totalcitasrealizadas);
       $("#totalserviciospendientes2").text(totalpendientes);
       $("#totalserviciosnorealizados2").text(totalnorealizados);
       $("#totalserviciosproceso2").text(totalproceso);

       $("#totalservicioscancelados2").text(totalcancelados);
         },error: function(XMLHttpRequest, textStatus, errorThrown){ 
        var error;
            if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
            if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
          console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
      }
    });

}

function ObtenerTotalesCitasEspecialista() {
	 var iduser=localStorage.getItem('id_user');

  var datos="idusuario="+iduser;

   var pagina = "ObtenerTotalesEspecialista.php";
  $.ajax({
    type: 'POST',
    dataType: 'json',
    url: urlphp+pagina,
    data:datos,
    async:false,
    success: function(resp){
        var totalproductosdia=resp.totalproductosdia;
        var totalcitasdia=resp.totalcitasdia;
        var totalrealizadas=resp.totalcitasrealizadas;
        var totalserviciospendientes=resp.totalpendientes;
        var totalserviciosnorealizados=resp.totalnorealizados;
        $("#totalservicios").text(totalcitasdia);
        $("#totalserviciosrealizados").text(totalrealizadas);
        $("#totalproductos").text(totalproductosdia);
        $("#totalserviciospendientes").text(totalserviciospendientes);
        $("#totalserviciosnorealizados").text(totalserviciosnorealizados);

        var totalproceso=resp.totalproceso;
        var totalcancelados=resp.totalcancelados;

       $("#totalserviciosproceso").text(totalproceso);
       $("#totalservicioscancelados").text(totalcancelados);

         },error: function(XMLHttpRequest, textStatus, errorThrown){ 
        var error;
            if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
            if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
          console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
      }
    });
}

function FiltrarEstatusEspe(estatus) {
	localStorage.setItem('estatusmostrar',estatus);
    var fecha=localStorage.getItem('fechaconsulta');
    ConsultarFechaCitaEspe(fecha);
}

function AbrirModalPerfilCliente(idcliente) {

  var html2="";

var html=`  <div class="sheet-modal my-sheet-swipe-to-close1" style="height: 100%;background: black;">
            <div class="toolbar" style="background: black;margin-top: 20px;">
              <div class="toolbar-inner">
                <div class="left"></div>
                <div class="right">
                  <a class="link sheet-close"></a>
                </div>
              </div>
            </div>
            <div class="sheet-modal-inner" style="background: black;border-top-left-radius: 20px;border-top-right-radius:20px; ">
               <div class="iconocerrar link sheet-close" style="z-index:10;">
      <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M25.5188 4.48126C23.4385 2.4011 20.788 0.984547 17.9026 0.410715C15.0171 -0.163118 12.0264 0.131546 9.30839 1.25744C6.59043 2.38334 4.26736 4.28991 2.63294 6.73606C0.998525 9.18221 0.12616 12.0581 0.12616 15C0.12616 17.9419 0.998525 20.8178 2.63294 23.264C4.26736 25.7101 6.59043 27.6167 9.30839 28.7426C12.0264 29.8685 15.0171 30.1631 17.9026 29.5893C20.788 29.0155 23.4385 27.5989 25.5188 25.5188C26.9003 24.1375 27.9961 22.4976 28.7437 20.6928C29.4914 18.888 29.8762 16.9535 29.8762 15C29.8762 13.0465 29.4914 11.1121 28.7437 9.30724C27.9961 7.50242 26.9003 5.86255 25.5188 4.48126ZM20.3126 18.7613C20.4187 18.8606 20.5034 18.9808 20.5612 19.1142C20.6191 19.2476 20.6489 19.3915 20.6489 19.5369C20.6489 19.6823 20.6191 19.8262 20.5612 19.9596C20.5034 20.093 20.4187 20.2131 20.3126 20.3125C20.2133 20.411 20.0956 20.4889 19.9661 20.5418C19.8367 20.5946 19.698 20.6214 19.5582 20.6206C19.2795 20.6195 19.0124 20.5088 18.8145 20.3125L15.0001 16.4981L11.2388 20.3125C11.0409 20.5088 10.7738 20.6195 10.4951 20.6206C10.3553 20.6214 10.2166 20.5946 10.0872 20.5418C9.95773 20.4889 9.83999 20.411 9.74071 20.3125C9.54282 20.1134 9.43174 19.8441 9.43174 19.5634C9.43174 19.2827 9.54282 19.0135 9.74071 18.8144L13.502 15L9.74071 11.2388C9.56665 11.0355 9.47569 10.774 9.48602 10.5066C9.49635 10.2392 9.6072 9.98557 9.79642 9.79635C9.98565 9.60712 10.2393 9.49627 10.5067 9.48594C10.7741 9.47561 11.0356 9.56657 11.2388 9.74063L15.0001 13.5019L18.7613 9.74063C18.8597 9.63878 18.9772 9.55729 19.107 9.50083C19.2369 9.44437 19.3766 9.41404 19.5182 9.41158C19.6598 9.40911 19.8004 9.43456 19.9322 9.48646C20.0639 9.53836 20.1842 9.6157 20.286 9.71407C20.3879 9.81244 20.4694 9.9299 20.5258 10.0598C20.5823 10.1896 20.6126 10.3293 20.6151 10.4709C20.6175 10.6125 20.5921 10.7532 20.5402 10.8849C20.4883 11.0167 20.411 11.1369 20.3126 11.2388L16.4982 15L20.3126 18.7613Z" fill="#AAAAAA"></path>
            </svg>
                       </div>
              <div class="page-content cambiarfuente" style="height: 100%;">
                

                <div style="background: black; height: 100%;width: 100%;border-radius: 20px;position: absolute;top:3em;width: 100%;">
                   <div class="row">
                     <div class="col-20">
                        
                    </div>

                     <div class="col-60">
                     <span class="titulomodal" style="">Perfil del cliente</span>
                     </div>
                     <div class="col-20">
                     <span class="limpiarfiltros"></span>
                     </div>
                 </div>
                 <div class="" style="position: absolute;top:1em;width: 100%;">
                  
                 <div class="row">
                                     
             <div class="col-100" style="    margin-left: 1em; margin-right: 1em;">
          <div class="card margin-bottom" style="background:black!important;">
                       
      <div class="row">
      <div class="col-100" style="">
              
     <div class=" cambiarfuente " style="list-style: none;background: black;">




       <div class="row" style="
   margin-top:1em;margin-bottom:2em;">
          <div class="row" style=" margin-right: 2em; margin-left: 2em;">
            <div class="col-60">
              <p style="font-size: 16px;font-weight: bold;">Nueva imagen o comentario</p>
            </div>
            <div class="col-20" onclick="AbrirModalFotoimagencitacomentario()">
                <span class="material-icons-outlined" style="    font-size: 30px;line-height: 60px;margin-left: 1em;">
                camera_alt
                </span>
            </div>

            <div class="col-20" onclick="AbrirModalcomentario()">
                <span class="material-icons-outlined" style="    font-size: 30px;line-height: 60px;margin-left: 1em;">
                edit
                </span>
            </div>
          </div>
      </div>

      <div class="" style="
    margin-bottom: 100px;
">
        <div class="">
            <div class="listadoimagenescitacomentario" style="width:100%;">
            </div>
        </div>
</div>





      <div style="height:200px;"></div>
                                  
                                   </div>
                                  </div>
                       


                        


                          `;

                    
                      html+=`</div>



              
                        <div class="row">

                        `;

                      


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
          
    dynamicSheet11 = app.sheet.create({
        content: html,

      swipeToClose: true,
        backdrop: true,
        // Events
        on: {
          open: function (sheet) {
           
          //ObtenerImagenescita();
          ObtenerImagenescitaComentario();
          },
          opened: function (sheet) {
            console.log('Sheet opened');
          },

          close: function (sheet) {
           
              //intervalocitas=setInterval("FiltrarTableroCitas()",2000);

          },
      }
        
      });

       dynamicSheet11.open();
}

function AbrirModalcomentario() {
  var parrafo2="<p class='cambiarfuente "+estiloparrafo+"' style=''>Ingresa tu comentario</p>";


      var html="";  
html+=` <div class="sheet-modal my-sheet-swipe-to-close1" style="height: 100%;background: black;">
           <div class="toolbar" style="background: black;margin-top: 1em;">
              <div class="toolbar-inner">
                <div class="left"></div>
                <div class="right">
                  <a class="link sheet-close"></a>
                </div>
              </div>
            </div>
            <div class="sheet-modal-inner" style="background: black;border-top-left-radius: 20px;border-top-right-radius:20px; ">
               <div class="iconocerrar link sheet-close" style="z-index:10;">
      <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M25.5188 4.48126C23.4385 2.4011 20.788 0.984547 17.9026 0.410715C15.0171 -0.163118 12.0264 0.131546 9.30839 1.25744C6.59043 2.38334 4.26736 4.28991 2.63294 6.73606C0.998525 9.18221 0.12616 12.0581 0.12616 15C0.12616 17.9419 0.998525 20.8178 2.63294 23.264C4.26736 25.7101 6.59043 27.6167 9.30839 28.7426C12.0264 29.8685 15.0171 30.1631 17.9026 29.5893C20.788 29.0155 23.4385 27.5989 25.5188 25.5188C26.9003 24.1375 27.9961 22.4976 28.7437 20.6928C29.4914 18.888 29.8762 16.9535 29.8762 15C29.8762 13.0465 29.4914 11.1121 28.7437 9.30724C27.9961 7.50242 26.9003 5.86255 25.5188 4.48126ZM20.3126 18.7613C20.4187 18.8606 20.5034 18.9808 20.5612 19.1142C20.6191 19.2476 20.6489 19.3915 20.6489 19.5369C20.6489 19.6823 20.6191 19.8262 20.5612 19.9596C20.5034 20.093 20.4187 20.2131 20.3126 20.3125C20.2133 20.411 20.0956 20.4889 19.9661 20.5418C19.8367 20.5946 19.698 20.6214 19.5582 20.6206C19.2795 20.6195 19.0124 20.5088 18.8145 20.3125L15.0001 16.4981L11.2388 20.3125C11.0409 20.5088 10.7738 20.6195 10.4951 20.6206C10.3553 20.6214 10.2166 20.5946 10.0872 20.5418C9.95773 20.4889 9.83999 20.411 9.74071 20.3125C9.54282 20.1134 9.43174 19.8441 9.43174 19.5634C9.43174 19.2827 9.54282 19.0135 9.74071 18.8144L13.502 15L9.74071 11.2388C9.56665 11.0355 9.47569 10.774 9.48602 10.5066C9.49635 10.2392 9.6072 9.98557 9.79642 9.79635C9.98565 9.60712 10.2393 9.49627 10.5067 9.48594C10.7741 9.47561 11.0356 9.56657 11.2388 9.74063L15.0001 13.5019L18.7613 9.74063C18.8597 9.63878 18.9772 9.55729 19.107 9.50083C19.2369 9.44437 19.3766 9.41404 19.5182 9.41158C19.6598 9.40911 19.8004 9.43456 19.9322 9.48646C20.0639 9.53836 20.1842 9.6157 20.286 9.71407C20.3879 9.81244 20.4694 9.9299 20.5258 10.0598C20.5823 10.1896 20.6126 10.3293 20.6151 10.4709C20.6175 10.6125 20.5921 10.7532 20.5402 10.8849C20.4883 11.0167 20.411 11.1369 20.3126 11.2388L16.4982 15L20.3126 18.7613Z" fill="#AAAAAA"></path>
            </svg>
            </div>

          
                <div class="page-content" style="background: black; height: 100%;width: 100%;border-radius: 20px;">
                        
                             <div class="" style="position: absolute;top:2em;width: 100%;">
                                
                                  <div class="">
                                      <div class="block" style="margin-right:1em;margin-left:1em;">

                                       `;
                
                                    html+=`
                                           
                                           <div class="row" style="margin-bottom:1em;margin-top:3em;">
                                                 
                                                <div class="col-100">
                                                <div style="color: #c7aa6a;text-align: center;width: 100%;" class="cambiarfuente">`+parrafo2+`</div>
                                                    <form>
                                                    <div class="list" style="margin:0;">
                                                      <ul class="row">

                                                        <li class="item-content col-100 item-input item-input-with-value">

                                                          <div class="item-inner">
                                                            <div class="item-input-wrap">
                                                              <textarea placeholder="" id="txtcomentario" class="form-control" maxlength="200"></textarea>
                                                            </div>
                                                          </div>
                                                        </li>

                                                        </ul>
                                                        </div>


                                                        </form>
                                                </div>
                                           
                                            </div>
                                            <div class="row">
                                               <div class="col">
                                                      <button style="background: white;color:black;" class=" button button-fill button-large  button-raised " id="btncancel" type="button" > Cancelar</button>
                                                </div>
                                                 <div class="col">
                                                 <button style="background: #C7AA6A;color:white;" class=" button button-fill button-large button-raised" id="btnguardarimagen" type="button"> Guardar</button>
                                                </div>

                                            </div>


                                        </div>
                                    </div>
                             </div>
                        </div>
                        
                      </div>
                    </div>
                  </div>`;
      dynamicSheet2 = app.sheet.create({
        content: html,
        swipeToClose: true,
        backdrop: true, 
        // Events
        on: {
          open: function (sheet) {
            

             $$("#btnguardarimagen").attr('onclick','Guardarcomentario()');
             $$("#btncancel").attr('onclick','CancelarFotocita()');
          },
          opened: function (sheet) {
            console.log('Sheet opened');
          },
        }
      });

       dynamicSheet2.open();
       
}
function Guardarcomentario(argument) {
  var comentario=$("#txtcomentario").val();
  var foto="";
  var idcita=localStorage.getItem('idcita');
  var idusuario=localStorage.getItem('id_user');

  var datos="idimagencitacomentario=0"+"&foto="+foto+"&iduser="+idusuario+"&idcita="+idcita+"&comentario="+comentario;
  var bandera=1;



      if (bandera==1) {


        var pagina = "Guardarimagencitacomentario.php";
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: urlphp+pagina,
            data:datos,
            crossDomain: true,
            cache: false,
            async:false,
            success: function(datos){
                dynamicSheet2.close();
                localStorage.setItem('fotoimagencitacomentario','');

                //alerta('','');
               var aviso="Registro guardado correctamente";
                AbrirModalAviso(aviso)
                ObtenerImagenescitaComentario();
                
               
                },error: function(XMLHttpRequest, textStatus, errorThrown){ 
                    var error;
                        if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
                        if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                                    //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
                        console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
                }
            });

    }else{


        if (foto=='') {

            bandera=0;
          }



        if (bandera==0) {
            alerta('','Falta por subir una imagen');
        }
    }
}

function ObtenerDetallecitaInfo() {
  var idcita=localStorage.getItem('idcita');
  var datos="idcita="+idcita;
  var pagina="ObtenerDetalleCitaAdmin.php";

  $.ajax({ 
    type: 'POST',
    dataType: 'json',
    url: urlphp+pagina,
    data:datos,
    success: function(res){
     var respuesta=res.respuesta;
     var concepto=respuesta.concepto;
     var costo= respuesta.costo;
     var titulo= respuesta.titulo;
     var cantidad= respuesta.cantidad;
     var nombreespecialista= respuesta.nombreespecialista;
     var cliente= respuesta.nombre+' '+respuesta.paterno;
     var fechaformato = respuesta.fechaformato+' '+respuesta.horainicial+'-'+respuesta.horafinal;
     $(".textservicio").text(concepto);
     $(".textcosto").text(costo);
     $(".textnegocio").text(titulo);
     $(".textbarbero").text(nombreespecialista);
     $(".textcliente").text(cliente);
     $(".textfecha").text(fechaformato);


      },error: function(XMLHttpRequest, textStatus, errorThrown){ 
        var error;
            if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
            if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
          console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
      }
    });


}

function CambiarCortesia(idcita) {
  
var idusuario=localStorage.getItem('id_user');

var datos="idcita="+idcita;
var pagina="ObtenerCortesiaPaqueteCita.php";

 $.ajax({
    type: 'POST',
    dataType: 'json',
    url: urlphp+pagina,
    data:datos,
    async:false,
    success: function(resp){
     
      var respuesta=resp;

      AbrirModalCortesiaCita(respuesta,idcita);

     
      },error: function(XMLHttpRequest, textStatus, errorThrown){ 
        var error;
            if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
            if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
          console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
      }
    });
}

function AbrirModalCortesiaCita(resp,idcita) {
  

  var sucursalimageninguna=resp.sucursal.imagenninguna;
  var producto=resp.paquete;
  var servicio="producto";
  if (producto.servicio==1) {
    servicio="servicio";
  }
  var imagenninguna=urlimagenes+`sucursal/imagenes/`+codigoserv+sucursalimageninguna;

  var parrafo=`<p class="cambiarfuente `+estiloparrafo+`">El `+servicio+` <span style='color:white;'> `+producto.nombrepaquete+`</span> te da una cortesía</p>`;
      parrafo+=`<p class="cambiarfuente `+estiloparrafo+`">¿Cuál eliges?</p>`;

  var html2="";

var html=` <div class="sheet-modal my-sheet-swipe-to-close1" style="height:70%;background: black;">
            
            <div class="sheet-modal-inner" style="background: white;border-top-left-radius: 20px;border-top-right-radius:20px; ">
               <div class="iconocerrar link sheet-close" style="z-index:10;">
               <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M25.5188 4.48126C23.4385 2.4011 20.788 0.984547 17.9026 0.410715C15.0171 -0.163118 12.0264 0.131546 9.30839 1.25744C6.59043 2.38334 4.26736 4.28991 2.63294 6.73606C0.998525 9.18221 0.12616 12.0581 0.12616 15C0.12616 17.9419 0.998525 20.8178 2.63294 23.264C4.26736 25.7101 6.59043 27.6167 9.30839 28.7426C12.0264 29.8685 15.0171 30.1631 17.9026 29.5893C20.788 29.0155 23.4385 27.5989 25.5188 25.5188C26.9003 24.1375 27.9961 22.4976 28.7437 20.6928C29.4914 18.888 29.8762 16.9535 29.8762 15C29.8762 13.0465 29.4914 11.1121 28.7437 9.30724C27.9961 7.50242 26.9003 5.86255 25.5188 4.48126ZM20.3126 18.7613C20.4187 18.8606 20.5034 18.9808 20.5612 19.1142C20.6191 19.2476 20.6489 19.3915 20.6489 19.5369C20.6489 19.6823 20.6191 19.8262 20.5612 19.9596C20.5034 20.093 20.4187 20.2131 20.3126 20.3125C20.2133 20.411 20.0956 20.4889 19.9661 20.5418C19.8367 20.5946 19.698 20.6214 19.5582 20.6206C19.2795 20.6195 19.0124 20.5088 18.8145 20.3125L15.0001 16.4981L11.2388 20.3125C11.0409 20.5088 10.7738 20.6195 10.4951 20.6206C10.3553 20.6214 10.2166 20.5946 10.0872 20.5418C9.95773 20.4889 9.83999 20.411 9.74071 20.3125C9.54282 20.1134 9.43174 19.8441 9.43174 19.5634C9.43174 19.2827 9.54282 19.0135 9.74071 18.8144L13.502 15L9.74071 11.2388C9.56665 11.0355 9.47569 10.774 9.48602 10.5066C9.49635 10.2392 9.6072 9.98557 9.79642 9.79635C9.98565 9.60712 10.2393 9.49627 10.5067 9.48594C10.7741 9.47561 11.0356 9.56657 11.2388 9.74063L15.0001 13.5019L18.7613 9.74063C18.8597 9.63878 18.9772 9.55729 19.107 9.50083C19.2369 9.44437 19.3766 9.41404 19.5182 9.41158C19.6598 9.40911 19.8004 9.43456 19.9322 9.48646C20.0639 9.53836 20.1842 9.6157 20.286 9.71407C20.3879 9.81244 20.4694 9.9299 20.5258 10.0598C20.5823 10.1896 20.6126 10.3293 20.6151 10.4709C20.6175 10.6125 20.5921 10.7532 20.5402 10.8849C20.4883 11.0167 20.411 11.1369 20.3126 11.2388L16.4982 15L20.3126 18.7613Z" fill="#AAAAAA"></path>
            </svg>
                       </div>
              <div class="page-content" style="height: 100%;">
                <div style="background: black; height: 100%;width: 100%;border-radius: 20px;">
                   <div class="row">
                     <div class="col-20">
                        
                    </div>

                     <div class="col-60">
                     <span class="titulomodal cambiarfuente" style="font-size: 20px;
    text-align: center;
    font-weight: 600;
    color: #c7aa6a;"></span>
                     </div>
                     <div class="col-20">
                     <span class="limpiarfiltros"></span>
                     </div>
                 </div>
                 <div class="" style="position: absolute;top:1em;width: 100%;">
                
                       
                        `;
                      

                          html+=`
                          <div class="row" style="    margin-left: 2em; margin-right: 2em;    margin-top: 20px;">
                          <div class="col-100">
                          <div style="color: #c7aa6a;font-size: 30px;text-align: center;" class="cambiarfuente">
                            `+parrafo+`

                            </div>
                          </div>

                          </div>`;

                        var respuesta=resp.respuesta;
          
                          html+=`

                          <div class="row margin-bottom " style="padding-top: 1em; margin-top: 10px;display: flex;justify-content: center;">
                         `;

                       
                                html+=` 
                        
                                 <div data-space-between="12" data-slides-per-view="auto" data-centered-slides="false" class="swiper-container swiper-init divtablerocortesia">
                                  

                         `;
                          
                 

      html+=` <div class="row" style="margin-left: 1em;">`;
      html+=`
         <div class="tarjeta contadortarjeta cambiarfuente  " style="width:100%;"  onclick="ElegirCortesiaCita(`+idcita+`,0,'Ninguna')">
              <div class="card demo-card-header-pic" style="border-radius: 10px;">  
              <div style="background-image:url(`+imagenninguna+`);border-radius: 10px 10px 0px 0px;" class="card-header align-items-flex-end"></div>                
      

            <div class="cardcortesia" id="cardcortesia_0"  style="display: flex;
    justify-content: center;
    align-items: center;text-align: center;height: 50px;background:#9c9c9c ;font-size: 18px;   
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;">
           <p style="margin:0px;text-align:center;color: white;">Ninguna</p> </div>
          </div>
          </div>

      `;
/*
      html+=`
          <div class="swiper-slide swiper-slide-active" role="group"  style="margin-right: 20px;width: 40%;">
        <div class="card cardcortesia" id="cardcortesia_0" style="height: 55px!important;padding: 10px;"  onclick="ElegirCortesia(`+idcarrito+`,0)">
        <div class="card-content   featured-card" style="padding-top: 9px;">
           
            <div class="card-info">

            <span class="material-icons-outlined" style="color: red;
    font-size: 35px;">
              block
              </span>
             `;
         

              html+=` 
         
              <p class="location">
              </p>
              <h6 class="text-primary vacancy">
              </h6>
            </div>
          </div>
        </div>


         <h5 class="title" style="color: white!important;text-align: center;margin: 0;">
               <a style="
    color: white;
    text-align: center;">Ninguna
                </a>
              </h5>
        </div>

      `;*/

    if (respuesta.length>0) {

    for (var i = 0; i < respuesta.length; i++) {
      
          var imagen="";
        if (respuesta[i].foto!='' && respuesta[i].foto!=null) {
             imagen=urlimagenes+`paquetes/imagenespaquete/`+codigoserv+respuesta[i].foto;
     
        }else{


          imagen=localStorage.getItem('logo');
        }

      var checked="";
     
      html+=`
        <div class="tarjeta contadortarjeta cambiarfuente  " style="width:100%;"   onclick="ElegirCortesiaCita(`+idcita+`,`+respuesta[i].idcortesia+`,'`+respuesta[i].nombrepaquete+`')">
              <div class="card demo-card-header-pic" style="border-radius: 10px;">  
              <div style="background-image:url(`+imagen+`);border-radius: 10px 10px 0px 0px;" class="card-header align-items-flex-end"></div>

            <div class="cardcortesia" id="cardcortesia_`+respuesta[i].idcortesia+`" style="display: flex;
    justify-content: center;
    align-items: center;text-align: center;height: 50px;background:#9c9c9c ;font-size: 18px;   
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;">
           <p style="margin:0px;text-align:center;color: white;">`+respuesta[i].nombrepaquete+` </p> </div>
          </div>
          </div>

      `;
       /* html+=`
<div class="swiper-slide swiper-slide-active" role="group"  style="margin-right: 20px;width: 40%;">
        <div class="card cardcortesia" id="cardcortesia_`+respuesta[i].idcortesia+`" style="height: 55px!important;padding: 10px;"  onclick="ElegirCortesia(`+idcarrito+`,`+respuesta[i].idcortesia+`)">
        <div class="card-content   featured-card" style="padding-top: 9px;">
           
            <div class="card-info">
             `;
              if (imagen!='') {

                 html+=`<img src="`+imagen+`" alt="" style="width:60px;">`;
                }

              html+=` 
         
              <p class="location">
              </p>
              <h6 class="text-primary vacancy">
              </h6>
            </div>
          </div>
        </div>


              <h5 class="title" style="color: white!important;text-align: center;margin: 0;">
               <a style="
    color: white;
    text-align: center;">`+respuesta[i].nombrepaquete+`
                </a>
              </h5>
        </div>

        `;*/
    }
  }

    html+=`
         </div>
    </div>`;
   


                          html+=`
                         
                          </div>

                          <div class="row margin-bottom " style="padding-top: 1em;    margin-left: 2em;margin-right: 2em;margin-top:20px;">
                            <div class="col-100"><button style="background: #C7AA6A;display:none;" type="button" class="button button-fill color-theme button-large button-raised btnagregarcortesia cambiarfuente" onclick="">Aceptar</button></div>
                          </div>


                      </div>

                  </div>

                </div>
                
              </div>
            </div>
          </div>`;
          /*<p><button class="button color-theme btncortesias" id="cortesia_`+respuesta[i].idcortesia+`" onclick="ElegirCortesia(`+idcarrito+`,`+respuesta[i].idcortesia+`)" style="background: white;color:black;padding: 10px 20px;">
                                        Elegir
                                       </button>
                                     </p>*/
    dynamicSheet1 = app.sheet.create({
        content: html,

      swipeToClose: true,
        backdrop: true,
        // Events
        on: {
          open: function (sheet) {
           idcortesiaelegida=0;

             if (tipoletra!='') {
              $(".cambiarfuente").addClass(tipoletra);
            }

           
/*
    if (swiper1 && swiper1.destroy) {
      swiper1.destroy(true, true); 
    }

      swiper1 = new Swiper(".divtablerocortesia", {
         slidesPerView: "auto",
        spaceBetween: 1,
        pagination: false,

      });*/



     // swiper1.update();
  
                


               

          },
          opened: function (sheet) {
            console.log('Sheet opened');

           
          },
        }
      });

       dynamicSheet1.open();

}


function ElegirCortesiaCita(idcita,idcortesia,nombrecortesia) {
    idcortesiaelegida=0;
    $("#cardcortesia_"+idcortesia).addClass('seleccionadocortesia');
    idcortesiaelegida=idcortesia;
    dynamicSheet1.close();

   

var html2="";
var html=` <div class="sheet-modal my-sheet-swipe-to-close1" style="height: 70%;background: black;">
            
            <div class="sheet-modal-inner" style="background: white;border-top-left-radius: 20px;border-top-right-radius:20px; ">
               <div class="iconocerrar link sheet-close" style="z-index:10;">
               <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M25.5188 4.48126C23.4385 2.4011 20.788 0.984547 17.9026 0.410715C15.0171 -0.163118 12.0264 0.131546 9.30839 1.25744C6.59043 2.38334 4.26736 4.28991 2.63294 6.73606C0.998525 9.18221 0.12616 12.0581 0.12616 15C0.12616 17.9419 0.998525 20.8178 2.63294 23.264C4.26736 25.7101 6.59043 27.6167 9.30839 28.7426C12.0264 29.8685 15.0171 30.1631 17.9026 29.5893C20.788 29.0155 23.4385 27.5989 25.5188 25.5188C26.9003 24.1375 27.9961 22.4976 28.7437 20.6928C29.4914 18.888 29.8762 16.9535 29.8762 15C29.8762 13.0465 29.4914 11.1121 28.7437 9.30724C27.9961 7.50242 26.9003 5.86255 25.5188 4.48126ZM20.3126 18.7613C20.4187 18.8606 20.5034 18.9808 20.5612 19.1142C20.6191 19.2476 20.6489 19.3915 20.6489 19.5369C20.6489 19.6823 20.6191 19.8262 20.5612 19.9596C20.5034 20.093 20.4187 20.2131 20.3126 20.3125C20.2133 20.411 20.0956 20.4889 19.9661 20.5418C19.8367 20.5946 19.698 20.6214 19.5582 20.6206C19.2795 20.6195 19.0124 20.5088 18.8145 20.3125L15.0001 16.4981L11.2388 20.3125C11.0409 20.5088 10.7738 20.6195 10.4951 20.6206C10.3553 20.6214 10.2166 20.5946 10.0872 20.5418C9.95773 20.4889 9.83999 20.411 9.74071 20.3125C9.54282 20.1134 9.43174 19.8441 9.43174 19.5634C9.43174 19.2827 9.54282 19.0135 9.74071 18.8144L13.502 15L9.74071 11.2388C9.56665 11.0355 9.47569 10.774 9.48602 10.5066C9.49635 10.2392 9.6072 9.98557 9.79642 9.79635C9.98565 9.60712 10.2393 9.49627 10.5067 9.48594C10.7741 9.47561 11.0356 9.56657 11.2388 9.74063L15.0001 13.5019L18.7613 9.74063C18.8597 9.63878 18.9772 9.55729 19.107 9.50083C19.2369 9.44437 19.3766 9.41404 19.5182 9.41158C19.6598 9.40911 19.8004 9.43456 19.9322 9.48646C20.0639 9.53836 20.1842 9.6157 20.286 9.71407C20.3879 9.81244 20.4694 9.9299 20.5258 10.0598C20.5823 10.1896 20.6126 10.3293 20.6151 10.4709C20.6175 10.6125 20.5921 10.7532 20.5402 10.8849C20.4883 11.0167 20.411 11.1369 20.3126 11.2388L16.4982 15L20.3126 18.7613Z" fill="#AAAAAA"></path>
            </svg>
                       </div>
              <div class="page-content" style="height: 100%;">
                <div style="background: black; height: 100%;width: 100%;border-radius: 20px;">
                   <div class="row">
                     <div class="col-20">
                        
                    </div>

                     <div class="col-60">
                     <span class="titulomodal cambiarfuente" style="font-size: 20px;
    text-align: center;
    font-weight: 600;
    color: #c7aa6a;"></span>
                     </div>
                     <div class="col-20">
                     <span class="limpiarfiltros"></span>
                     </div>
                 </div>
                 <div class="" style="position: absolute;top:1em;width: 100%;">
                
                       
                        `;

                       
                          
                          
                      

                          html+=`
                          <div class="row" style="margin-left: 1em; margin-right: 1em; margin-top: 60px;">
                          <div class="col-100">
                          <p style="color: #c7aa6a;text-align: center;" class="cambiarfuente cambiarfuente2 `+estiloparrafo+`">Has elegido <span style="color:white;">`+nombrecortesia+`</span> como cortesía. ¿Estás seguro de tu elección?</p>
                          </div>

                          </div>

                          <div class="row margin-bottom " style="padding-top: 1em;    margin-left: 2em;margin-right: 2em;margin-top:20px;">
                            <div class="col-50">
                            <button style="background: #C7AA6A;color:white;" type="button" class="button button-fill color-theme button-large button-raised  cambiarfuente" onclick="GuardarCortesiaCita(`+idcita+`,`+idcortesiaelegida+`)">Si</button>
                            </div>

                            <div class="col-50">
                            <button style="background: white;color:black;" type="button" class="button button-fill color-theme button-large button-raised  cambiarfuente" onclick="CerrarModalAviso()">No</button>
                            </div>
                          </div>


                      </div>

                  </div>

                </div>
                
              </div>
            </div>
          </div>`;
          /*<p><button class="button color-theme btncortesias" id="cortesia_`+respuesta[i].idcortesia+`" onclick="ElegirCortesia(`+idcarrito+`,`+respuesta[i].idcortesia+`)" style="background: white;color:black;padding: 10px 20px;">
                                        Elegir
                                       </button>
                                     </p>*/
    dynamicSheet1 = app.sheet.create({
        content: html,

      swipeToClose: true,
        backdrop: true,
        // Events
        on: {
          open: function (sheet) {
         
           $(".cambiarfuente2").css('display','none');
            if (tipoletra!='') {
              $(".cambiarfuente").addClass(tipoletra);
           
            }
          $(".cambiarfuente2").css('display','block');
 

          },
          opened: function (sheet) {
                 console.log('Sheet opened');

          },
        }
      });

       dynamicSheet1.open();
}

function GuardarCortesiaCita(idcita,idcortesia) {
  

  var datos="idcita="+idcita+"&idcortesia="+idcortesiaelegida;
  var pagina="GuardarCortesiaCita.php";

 $.ajax({
    type: 'POST',
    dataType: 'json',
    url: urlphp+pagina,
    data:datos,
    async:false,
    success: function(resp){
      dynamicSheet10.close();
      dynamicSheet1.close();

      AbrirModalCitaEspecialista(idcita);
        //aqui
      },error: function(XMLHttpRequest, textStatus, errorThrown){ 
        var error;
            if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
            if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
          console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
      }
    });
}

