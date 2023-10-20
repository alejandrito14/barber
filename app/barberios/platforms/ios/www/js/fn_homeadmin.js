function CargarDatosAdmin() {
	  var nombre= localStorage.getItem("nombre");
     $(".nombreusuario").text(nombre);
      ObtenerTableroAnuncios();
      Obtenerpublicidad(1);
          ObtenerEdad();

      var swiper1 = new Swiper(".cardbx", {
		     slidesPerView: "auto",
		    spaceBetween: 30,
		    pagination: false,

		  });
        ObtenerFechaActual();
		//ObtenerTableroCitasAdmin(1);
	$(".licompras").css('display','none');
	$(".lifavoritos").css('display','none');
  $(".liconfiguracion").css('display','block');
      ObtenerDetalleEmpresa();
    $(".bntcalendario").attr('onclick','AbrirModalCalendario()');

    $(".disponibilidadfecha").attr('onclick','GoToPage("disponibilidadfechaadmin")');
	$(".disponibilidadespecialista").attr('onclick','GoToPage("disponibilidadespecialistaadmin")');
	$(".disponibilidaproducto").attr('onclick','GoToPage("disponibilidaproductoadmin")');
     $("#btnservicios").attr('onclick','GoToPage("servicios")');

     ObtenerTotales();

     intervalo=setInterval("ObtenerTotales()",1000);


}

function ObtenerTableroCitasAdmin(estatus) {
	var idusuarios=localStorage.getItem('id_user');
	var datos="estatus="+estatus+"&idusuarios="+idusuarios;
	var pagina = "ObtenerTableroCitasAdmin.php";
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: urlphp+pagina,
		data:datos,
		async:false,
		success: function(datos){
			

			var respuesta=datos.respuesta;
			PintarTableroCitasAdmin(respuesta);
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

function PintarTableroCitasAdmin(respuesta) {
	
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
			html+=`
			<li class="col-100 medium-50">
				<div class="card-bx job-card" onclick="AbrirModalCitaAdmin(`+respuesta[i].idcita+`)">
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
					<a  class="bookmark-btn active" style="`+color+`" >
					  <i class="fas fa-bookmark" ></i>
						
					</a>
				</div>
			</li>
			`;
		}
	}
	$(".tablerocitas").html(html);

}

function AbrirModalCalendario() {


	  calendarModal = app.calendar.create({
        inputEl: '#demo-calendar-modal',
        openIn: 'customModal',
        header: true,
        footer: true,
 		on: {
 			 init: function (c) {
 			 },
        calendarChange:function (c) {
          	console.log(c.value);
         
            var fecha=c.value;

           },

           calendarClosed:function (c) {
           	console.log('cerro calendario');
           	console.log(c.value);

           	if (c.value!=undefined) {


           	}

           },

           calendarOpen:function (c) {
            			 	$(".calendar-selected-date").text('Seleccionar fecha');

           }
       },
      });

      calendarModal.open();

}


function AbrirModalCitaAdmin(idcita) {
    myStopFunction(intervalo);

	var iduser=localStorage.getItem('id_user');
	var datos="idcita="+idcita+"&iduser="+iduser;
	var pagina = "ObtenerDetalleCitaAdmin.php";
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: urlphp+pagina,
		data:datos,
		success: function(datos){
			localStorage.setItem('idcita',idcita);
			var respuesta=datos.respuesta;
				ObtenerDetalleCitaAdmin(respuesta);	

			},error: function(XMLHttpRequest, textStatus, errorThrown){ 
				var error;
				  	if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
				  	if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
								//alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
					console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
			}
		});
	

}

function ObtenerDetalleCitaAdmin(respuesta) {
	var imagen=urlimagenes+`sucursal/imagenes/`+codigoserv+respuesta.imagen;

	var html2="";

	

var html=` <div class="sheet-modal my-sheet-swipe-to-close1" style="height: 100%;background: white;">
           
            <div class="sheet-modal-inner" style="background: black; ">
               <div class="iconocerrar link sheet-close" style="z-index:10;margin-top:1em;">
               <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M25.5188 4.48126C23.4385 2.4011 20.788 0.984547 17.9026 0.410715C15.0171 -0.163118 12.0264 0.131546 9.30839 1.25744C6.59043 2.38334 4.26736 4.28991 2.63294 6.73606C0.998525 9.18221 0.12616 12.0581 0.12616 15C0.12616 17.9419 0.998525 20.8178 2.63294 23.264C4.26736 25.7101 6.59043 27.6167 9.30839 28.7426C12.0264 29.8685 15.0171 30.1631 17.9026 29.5893C20.788 29.0155 23.4385 27.5989 25.5188 25.5188C26.9003 24.1375 27.9961 22.4976 28.7437 20.6928C29.4914 18.888 29.8762 16.9535 29.8762 15C29.8762 13.0465 29.4914 11.1121 28.7437 9.30724C27.9961 7.50242 26.9003 5.86255 25.5188 4.48126ZM20.3126 18.7613C20.4187 18.8606 20.5034 18.9808 20.5612 19.1142C20.6191 19.2476 20.6489 19.3915 20.6489 19.5369C20.6489 19.6823 20.6191 19.8262 20.5612 19.9596C20.5034 20.093 20.4187 20.2131 20.3126 20.3125C20.2133 20.411 20.0956 20.4889 19.9661 20.5418C19.8367 20.5946 19.698 20.6214 19.5582 20.6206C19.2795 20.6195 19.0124 20.5088 18.8145 20.3125L15.0001 16.4981L11.2388 20.3125C11.0409 20.5088 10.7738 20.6195 10.4951 20.6206C10.3553 20.6214 10.2166 20.5946 10.0872 20.5418C9.95773 20.4889 9.83999 20.411 9.74071 20.3125C9.54282 20.1134 9.43174 19.8441 9.43174 19.5634C9.43174 19.2827 9.54282 19.0135 9.74071 18.8144L13.502 15L9.74071 11.2388C9.56665 11.0355 9.47569 10.774 9.48602 10.5066C9.49635 10.2392 9.6072 9.98557 9.79642 9.79635C9.98565 9.60712 10.2393 9.49627 10.5067 9.48594C10.7741 9.47561 11.0356 9.56657 11.2388 9.74063L15.0001 13.5019L18.7613 9.74063C18.8597 9.63878 18.9772 9.55729 19.107 9.50083C19.2369 9.44437 19.3766 9.41404 19.5182 9.41158C19.6598 9.40911 19.8004 9.43456 19.9322 9.48646C20.0639 9.53836 20.1842 9.6157 20.286 9.71407C20.3879 9.81244 20.4694 9.9299 20.5258 10.0598C20.5823 10.1896 20.6126 10.3293 20.6151 10.4709C20.6175 10.6125 20.5921 10.7532 20.5402 10.8849C20.4883 11.0167 20.411 11.1369 20.3126 11.2388L16.4982 15L20.3126 18.7613Z" fill="#AAAAAA"></path>
            </svg>
                       </div>

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


              <div class="page-content" style="height: 100%;">
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
   							 	
	   														  <div class="">
		   															  <div class="" style="">
		   							 	 													<div class="" style="">
		   							 	 
			<div class="row">
			<div class="col-100" style="margin-left: 1em;margin-right: 1em;margin-top: 1em;">
                <div class="card margin-bottom"
                style="background:black;">
                    <div class="card-header" style="color:white;">
                        <div class="row">
                            
                            <div class="col-50">
                                <h3 class="no-margin-bottom text-color-theme">`+respuesta.titulo+`</h3>
                            	<p class="no-margin-bottom text-color-theme">`+respuesta.descripcion+`</p>

                            	<p class="no-margin-bottom text-color-theme">`+respuesta.fechaformato+`</p>
                            	<p class="no-margin-bottom text-color-theme">`+respuesta.horainicial+`-`+respuesta.horafinal+`Hrs.</p>

                            	<p class="no-margin-bottom text-color-theme">Cliente: `+respuesta.nombre+` `+respuesta.paterno+`</p>

                              <p class="no-margin-bottom text-color-theme">`+respuesta.concepto+`</p>

                              `;

                            if(respuesta.checkin==1) {
                            
                              html+=` <p class="" style="display: flex;">
                              <span>check-in:</span> <span class="material-icons-outlined" 
                                      style=" width: 30px;justify-content: center;font-size: 20px;color:#5ac35b;">
                            check_circle_outline
                            </span>
                          </p>`;  
                                    
                            }
                            else{


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
                    </div>
                    <div class="card-content card-content-padding">
                      
                        <div class="row">`;

                        if(respuesta.checkin==1 && (respuesta.finalizacita=='' || respuesta.finalizacita==null) ) {
                            
                            html+=`<div class="cronometro"></div>`;
                               html+=`<button class="button button-large button-raised"  style="background:#C7AA6A;color:white;" onclick="VisualizarTiempo2()">Tiempo transcurrido</button>`;
                          
                          }

                           if(respuesta.checkin==0  && respuesta.checkout==0 && respuesta.cancelacion==0) {
                             html+=`
                                <div class="col-100">
                                  <button style="background: rgb(199, 170, 106); display: block;" type="button" class="button button-fill color-theme button-large button-raised btncontinuarcita cambiarfuente faustina" 
                                  onclick="AbrirModalCancelacionAdmin(`+respuesta.idcita+`,`+respuesta.idusuarios+`)">Cancelar</button>

                                </div>

                              `; 

                            }else{
                                if (respuesta.cancelacion==1) {
                                  html+=`
                                    <div class="col-100">
                                      <p class="" style="display: flex;margin-left: 2px;">
                                      <span>cancelado:</span> <span class="material-icons-outlined" 
                                      style=" width: 30px;justify-content: center;font-size: 20px;color:red;">
                                      block
                                      </span>
                                    </p>
                                </div>

                                  `;

                                }

                            }
                            
                        html+`

                        </div>
                    </div>
                </div>
            </div>
							   							  	</div>
		   							 	 
		   							 			</div>


<div class="row" style="    margin-right: 2em;
    margin-left: 2em;margin-top:1em;">
					`;

				

                            


				html+=	`</div>

					<div class="row" style=" margin-right: 2em; margin-left: 2em;">
						<div class="col-80">
						<p style="    font-size: 16px;
    font-weight: bold;">Galeria de imágenes</p>
						</div>
						<div class="col-20" onclick="AbrirModalFotoimagencita()">
						<span class="material-icons-outlined" style="    font-size: 30px;
    line-height: 60px;">
								camera_alt
								</span>
						</div>

					</div>
			


			</div>

      <div class="" style="
    
    margin-bottom: 100px;
">
        <div class="">
            <div class="listadoimagenescita" style="width:100%;">
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
          
	  dynamicSheet10 = app.sheet.create({
        content: html,

    	swipeToClose: true,
        backdrop: true,
        // Events
        on: {
          open: function (sheet) {
          
           ObtenerImagenescita();

			

          },
          opened: function (sheet) {
            console.log('Sheet opened');
          },
        }
      });

       dynamicSheet10.open();
}

function VisualizarTiempo2() {

  dynamicSheet10.close();
  GoToPage('validadoqrcita2');


}

function Parar() {
  
    clearInterval(control);
    GoToPage('servicios');
  

}

function CargarPaquetes() {
	var iduser=localStorage.getItem('id_user');
	var pagina = "ObtenerPaquetes.php";
	var datos="iduser="+iduser;
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: urlphp+pagina,
		data:datos,
		success: function(res){
			var respuesta=res.respuesta;
			PintarPaquetes1(respuesta);
			},error: function(XMLHttpRequest, textStatus, errorThrown){ 
				var error;
				  	if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
				  	if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
								//alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
					console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
			}
		});
	
}
function PintarPaquetes1(datos) {
	var html="";
	html+=`<option value="0">Seleccionar servicio</option>`;

	if (datos.length>0) {
		for (var i = 0; i < datos.length; i++) {
			html+=`<option value="`+datos[i].idpaquete+`">`+datos[i].nombrepaquete+`</option>`;
		}
	}

	$("#v_paqueteservicio").html(html);
}



function CargarCalendario2() {

 var fecha=new Date();
 var mes=(fecha.getMonth() + 1)<10?'0'+(fecha.getMonth() + 1):(fecha.getMonth() + 1);
 var anio= fecha.getFullYear();
  var iduser=localStorage.getItem('id_user');
  var datos="idusuario="+iduser+"&mes="+mes+"&anio="+anio;

  var pagina = "ObtenerCitasFechasCalendario.php";
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
      $(".tablerocitas").html('');

       if (citas.length>0) {
       
        PintarCitas2(citas);
       }
      /*if (resp.disponible.length>0) {
        var disponible=resp.disponible;

        for (var i =0; i < disponible.length; i++) {
            var fecha=disponible[i];
              var dividirfecha=fecha.split('-');
              var nuevafecha=dividirfecha[0]+'-'+parseInt(dividirfecha[1])+'-'+parseInt(dividirfecha[2]);
              
             var anio=dividirfecha[0];
            var mes=(dividirfecha[1].replace(/^(0+)/g, '')-1);
            var dia=dividirfecha[2];
          
            var objeto={
              date:new Date(anio,mes,dia),
              color:'rgb(245,212,95)',
            };
              eventos.push(objeto);
        }
      }*/

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
            });
            $('.calendar-custom-toolbar .right .link').on('click', function () {
              calendarInline.nextMonth();
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

            ConsultarFechaCita(fecha1);
            $("#v_especialista").html('');
            //var fechadata=convertirfecha.getFullYear()+'-'+mesdata+'-'+diadata;

             /* $(".calendar-day").each(function( index ) {
             var datafecha=$(this).data('date');

             if (datafecha==fechadata && datafecha!= fechaactualdata) {

              $(this).children().eq(0).addClass('seleccionado');
              //return 0;
             }else{

             $(this).children().eq(0).removeClass('seleccionado');

             }

        });*/
          
      
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



function PintarCitas(respuesta) {
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
      html+=`
      <li class="col-100 medium-50">
        <div class="card-bx job-card" onclick="AbrirModalCitaAdmin(`+respuesta[i].idcita+`)">
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
          <a  class="bookmark-btn active" style="`+color+`" >
            <i class="fas fa-bookmark" ></i>
            
          </a>
        </div>
      </li>
      `;
    }
  }
  $(".tablerocitas").html(html);
}

function PintarCitas2(respuesta) {
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
      html+=`
      <li class="col-100 medium-50">
        <div class="card-bx job-card" >
          <div class="card-media">
            <a >
            <img src="`+imagen+`" alt="">
            </a>
          </div>
          <div class="card-info">
            <h6 class="item-title">
      
            <p style="margin:0;" onclick="AbrirModalCitaAdmin(`+respuesta[i].idcita+`)">`+respuesta[i].titulo+`-`+respuesta[i].descripcion+`</a></p>
            <p style="margin:0;" onclick="AbrirModalCitaAdmin(`+respuesta[i].idcita+`)">`+respuesta[i].nombreespecialista+`</a></p>


            <p style="color: #2b952a;font-size: 18px;margin:0;" onclick="AbrirModalCitaAdmin(`+respuesta[i].idcita+`)">`+respuesta[i].horacita+`-`+respuesta[i].horafinal+`hrs.</p>

            </h6>
            <div class="">
                    <p style="margin:0;" onclick="AbrirModalCitaAdmin(`+respuesta[i].idcita+`)">`+respuesta[i].nombrepaquete+`</p>

            <p style="margin:0;">`+respuesta[i].nombreusuario+`</p>
            <p style="margin:0;text-decoration: underline;" onclick="Detallepago(`+respuesta[i].idnotapago+`)">#`+respuesta[i].folio+`</p>`;
            if (respuesta[i].checkin==1) {
                html+=`
                  <p class="" style="display: flex;">`;
                html+=`<span>check-in: `+respuesta[i].fechacheckin+`</span> <span class="material-icons-outlined" style=" width: 30px;justify-content: center;font-size: 20px;color:#5ac35b;margin-left: 5px;">
                    check_circle_outline
                    </span>

                    `;
                html+=`</p>`;
                  }

                  if (respuesta[i].checkout==1) {
                html+=`
                  <p class="" style="display: flex;">`;
                html+=`<span>check-out: `+respuesta[i].fechacheckout+`</span> <span class="material-icons-outlined" style=" width: 30px;justify-content: center;font-size: 20px;color:#5ac35b;margin-left: 5px;">
                    check_circle_outline
                    </span>`;
                html+=`</p>`;
                  }
  

           html+= `</div>
            <div class="item-footer">

            </div>
          </div>
          <a  class="bookmark-btn active" style="`+color+`" >
            <i class="fas fa-bookmark" ></i>
            
          </a>
        </div>
      </li>
      `;
    }
  }
  $(".tablerocitas").html(html);
}
function ConsultarFechaCita(fecha) {
  
   var iduser=localStorage.getItem('id_user');
  var datos="idusuario="+iduser+"&fecha="+fecha;

   var pagina = "ObtenerCitasFecha.php";
  $.ajax({
    type: 'POST',
    dataType: 'json',
    url: urlphp+pagina,
    data:datos,
    async:false,
    success: function(resp){
        var citas=resp.citasdia;

      
      $(".tablerocitas").html('');
       if (citas.length>0) {
       
        PintarCitas2(citas);
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

function SeleccionarServicio() {
	var paquete=$("#v_paqueteservicio").val();
	if (paquete>0) {
		localStorage.setItem('idpaquete',paquete);
	}
}


function CargarCalendario3() {

 var fecha=new Date();
 var mes=(fecha.getMonth() + 1)<10?'0'+(fecha.getMonth() + 1):(fecha.getMonth() + 1);
 var anio= fecha.getFullYear();
  var iduser=localStorage.getItem('id_user');
  var datos="idusuario="+iduser+"&mes="+mes+"&anio="+anio;

  var pagina = "ObtenerProductosNota.php";
  $.ajax({
    type: 'POST',
    dataType: 'json',
    url: urlphp+pagina,
    data:datos,
    async:false,
    success: function(resp){
       eventos=[];
        var productofechasdia=resp.productofechasdia;

       if (resp.productofechas.length>0) {
        var productofechas=resp.productofechas;
        for (var i = 0; i <productofechas.length; i++) {
         
            var dividirfecha=productofechas[i].split('-');
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
      $(".tablerocitas").html('');

       if (productofechasdia.length>0) {
       
        PintarNotasProductos(productofechasdia);
       }
      /*if (resp.disponible.length>0) {
        var disponible=resp.disponible;

        for (var i =0; i < disponible.length; i++) {
            var fecha=disponible[i];
              var dividirfecha=fecha.split('-');
              var nuevafecha=dividirfecha[0]+'-'+parseInt(dividirfecha[1])+'-'+parseInt(dividirfecha[2]);
              
             var anio=dividirfecha[0];
            var mes=(dividirfecha[1].replace(/^(0+)/g, '')-1);
            var dia=dividirfecha[2];
          
            var objeto={
              date:new Date(anio,mes,dia),
              color:'rgb(245,212,95)',
            };
              eventos.push(objeto);
        }
      }*/

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
            });
            $('.calendar-custom-toolbar .right .link').on('click', function () {
              calendarInline.nextMonth();
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
            ConsultarFechaNota(fecha1);
            //var fechadata=convertirfecha.getFullYear()+'-'+mesdata+'-'+diadata;

             /* $(".calendar-day").each(function( index ) {
             var datafecha=$(this).data('date');

             if (datafecha==fechadata && datafecha!= fechaactualdata) {

              $(this).children().eq(0).addClass('seleccionado');
              //return 0;
             }else{

             $(this).children().eq(0).removeClass('seleccionado');

             }

        });*/
          
      
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

function PintarNotasProductos(pagos) {
  var html="";
  if (pagos.length>0) {
    for (var i = 0; i <pagos.length; i++) {
     
      var claseestatus="";

      if (pagos[i].estatus==0) {
        claseestatus="notapendiente";
      }
       if (pagos[i].estatus==1) {
        claseestatus="notaaceptado";
      }

       if (pagos[i].estatus==2) {
        claseestatus="notacancelado";
      }

          imagen=urlimagenes+`sucursal/imagenes/`+codigoserv+pagos[i].imagen;

      html+=`
      <li class="col-100 medium-50" id="pago_`+pagos[i].idnotapago+`" onclick="Detallepago(`+pagos[i].idnotapago+`)">
        <div class="card-bx job-card" >
          <div class="card-media">
            <a>
            <img src="`+imagen+`" alt="">
            </a>
          </div>
          <div class="card-info">
            <h6 class="item-title">
      
            <p style="margin:0;">`+pagos[i].nombresucursal+`</p>
            </h6>
            <div class="">
             <p class="text-muted small" style="margin:0;">`+pagos[i].nombrepaquete+`</p>
            <p class="text-muted small" style="margin:0;">`+pagos[i].nombre+` `+pagos[i].paterno+`</p>

             <p class="text-muted small" style="margin:0;text-decoration: underline;">#`+pagos[i].folio+`</p>

          
            </div>
            <div class="item-footer">

            </div>
          </div>
          <a class="bookmark-btn active" style="color:black;">
            <i class="fas fa-bookmark"></i>
            
          </a>
        </div>
      </li>

      `;

    /*  html+=`
        <li class="col-100 medium-50" id="pago_`+pagos[i].idnotapago+`" style="margin-right: 1em;
    margin-left: 1em;">
                    <div class="row">
                        <div class="col-70">
                        <p style="margin:0;">`+pagos[i].nombresucursal+`</a></p>


                          <p class="text-muted small">`+pagos[i].nombrepaquete+`</p>
                          <p class="text-muted small">`+pagos[i].nombre+` `+pagos[i].paterno+`</p>
                          <p class="text-muted small">`+pagos[i].folio+`</p>

                        <a id="btncalendario" style=" color: #007aff!important;text-align: center;justify-content: center;" onclick="Detallepago(`+pagos[i].idnotapago+`)">Ver detalle</a>


                        </div>
                        <div class="col-30">

                          <p class="text-muted small `+claseestatus+`">`+pagos[i].textoestatus+`</p>

                        </div>
                    </div>
                 </li>

      `;*/
    }
  }
      $(".tableroproductos").html(html);



}

function ConsultarFechaNota(fecha) {
    var iduser=localStorage.getItem('id_user');
  var datos="idusuario="+iduser+"&fecha="+fecha;

   var pagina = "ObtenerProductosNotaFecha.php";
  $.ajax({
    type: 'POST',
    dataType: 'json',
    url: urlphp+pagina,
    data:datos,
    async:false,
    success: function(resp){
        var notasproducto=resp.notasproducto;

      
      $(".tableroproductos").html('');
       if (notasproducto.length>0) {
       
        PintarNotasProductos(notasproducto);
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

function ObtenerTotales() {
    var iduser=localStorage.getItem('id_user');

  var datos="idusuario="+iduser;

   var pagina = "ObtenerTotalesAdmin.php";
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
        $("#totalservicios").text(totalcitasdia);
        $("#totalserviciosrealizados").text(totalrealizadas);
        $("#totalproductos").text(totalproductosdia);

         },error: function(XMLHttpRequest, textStatus, errorThrown){ 
        var error;
            if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
            if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
          console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
      }
    });
}

function PintarOpcionBloqueo(valor) {
  $("#v_servicios").html('');
  $("#v_productos").html('');
    $("#v_especialista").html('');

          $(".filtroservicios").css('display','none');
          $(".filtroproductos").css('display','none');
          $(".filtroespecialista").css('display','none');

    if (valor==1) {
      $("#v_servicios").val(0);
      ObtenerServicios();
      $("#btnbloquear").attr('onclick','BloquearServicio()');
    }
    if (valor==2) {
      $("#v_productos").val(0);
      ObtenerProductospaquetes();
      $("#btnbloquear").attr('onclick','BloquearProductos()');

    }
    if (valor==3) {
      $("#v_especialista").val(0);
      ObtenerEspecialistasAdmin();

      $("#btnbloquear").attr('onclick','BloquearEspecialista()');

    }
}

function ObtenerServicios() {
   var iduser=localStorage.getItem('id_user');

  var datos="idusuario="+iduser+"&servicio=1";

   var pagina = "ObtenerServicios.php";
  $.ajax({
    type: 'POST',
    dataType: 'json',
    url: urlphp+pagina,
    data:datos,
    async:false,
    success: function(resp){
      var servicios=resp.paquetes;
        if (servicios.length>0) {
          $(".filtroservicios").css('display','block');
          PintarServicios(servicios);
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

function PintarServicios(respuesta) {
  var html="";
       html+=`<option value="0">Seleccionar servicio</option>`;

  if (respuesta.length>0) {
    for (var i = 0; i < respuesta.length; i++) {
     
     html+=`<option value="`+respuesta[i].idpaquete+`">`+respuesta[i].nombrepaquete+`</option>`;
    }
  }

  $("#v_servicios").html(html);
}

function ObtenerProductospaquetes() {
   var iduser=localStorage.getItem('id_user');

  var datos="idusuario="+iduser+"&servicio=0";

   var pagina = "ObtenerServicios.php";
  $.ajax({
    type: 'POST',
    dataType: 'json',
    url: urlphp+pagina,
    data:datos,
    async:false,
    success: function(resp){
      var servicios=resp.paquetes;
        if (servicios.length>0) {
          $(".filtroproductos").css('display','block');
          PintarProductos1(servicios);
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

function PintarProductos1(respuesta) {
  var html="";
       html+=`<option value="0">Seleccionar producto</option>`;

  if (respuesta.length>0) {
    for (var i = 0; i < respuesta.length; i++) {
     
     html+=`<option value="`+respuesta[i].idpaquete+`">`+respuesta[i].nombrepaquete+`</option>`;
    }
  }

  $("#v_productos").html(html);
}

function ObtenerEspecialistasAdmin() {
  var iduser=localStorage.getItem('id_user');

  var datos="idusuario="+iduser;

   var pagina = "ObtenerEspecialistaAdmin.php";
  $.ajax({
    type: 'POST',
    dataType: 'json',
    url: urlphp+pagina,
    data:datos,
    async:false,
    success: function(resp){
      var especialista=resp.especialista;
                $(".filtroespecialista").css('display','block');

        if (especialista.length>0) {
          PintarEspecialistaAdmin(especialista);
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

function PintarEspecialistaAdmin(respuesta) {
  var html="";

        html+=`<option value="0">Seleccionar especialista</option>`;

  if (respuesta.length>0) {
    for (var i = 0; i <respuesta.length; i++) {
      html+=`<option value="`+respuesta[i].idespecialista+`">`+respuesta[i].nombre+` `+respuesta[i].paterno+`</option>`;
    }
  }

  $("#v_especialista").html(html);
}

function BloquearServicio() {
   var iduser=localStorage.getItem('id_user');
   var idservicio=$("#v_servicios").val();
   var datos="idusuario="+iduser+"&idpaquete="+idservicio;

   var pagina = "BloquearPaquete.php";
  $.ajax({
    type: 'POST',
    dataType: 'json',
    url: urlphp+pagina,
    data:datos,
    async:false,
    success: function(resp){
          
          alerta('','Servicio bloqueado');
         },error: function(XMLHttpRequest, textStatus, errorThrown){ 
        var error;
            if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
            if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
          console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
      }
    });
}

function BloquearProductos() {
   var iduser=localStorage.getItem('id_user');
   var idservicio=$("#v_productos").val();
   var datos="idusuario="+iduser+"&idpaquete="+idservicio;

   var pagina = "BloquearPaquete.php";
  $.ajax({
    type: 'POST',
    dataType: 'json',
    url: urlphp+pagina,
    data:datos,
    async:false,
    success: function(resp){
          
          alerta('','Servicio bloqueado');
         },error: function(XMLHttpRequest, textStatus, errorThrown){ 
        var error;
            if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
            if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
          console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
      }
    });
}

function BloquearEspecialista() {
 var iduser=localStorage.getItem('id_user');
   var idespecialista=$("#v_especialista").val();
   var datos="idusuario="+iduser+"&idespecialista="+idespecialista;

   var pagina = "BloquearEspecialista.php";
  $.ajax({
    type: 'POST',
    dataType: 'json',
    url: urlphp+pagina,
    data:datos,
    async:false,
    success: function(resp){
          
          alerta('','Barbero bloqueado');
         },error: function(XMLHttpRequest, textStatus, errorThrown){ 
        var error;
            if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
            if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
          console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
      }
    });
}

function AbrirModalCancelacionAdmin(idcita,idusuario) {
   var aviso='El monto será reembolsado al monedero';
   aviso+='¿Estás seguro cancelar el servicio?';

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
                            <button style="background: #C7AA6A;color:white;" type="button" class="button button-fill color-theme button-large button-raised  cambiarfuente" onclick="CancelarCitaAdmin(`+idcita+`,`+idusuario+`)">Si</button>
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

  function CancelarCitaAdmin(idcita,idusuario) {
    dynamicSheet5.close();
    AbirModalMotivoAdmin(idcita,idusuario);
  }

  function AbirModalMotivoAdmin(idcita,idusuario) {
   var aviso='Por favor escriba el motivo de la cancelación';

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
                          <div class="row" style="    margin-left: 2em; margin-right: 2em;    margin-top: 20px;">
                          <div class="col-100">
                          <div style="color: #c7aa6a;font-size: 30px;text-align: center;" class="cambiarfuente">
                            `+aviso+`

                            </div>
                          </div>

                          </div>`;

                          html+=`
                          <div class="row" style="    margin-left: 2em; margin-right: 2em;margin-top:1em;">
                          <div class="col-100">
                              <form>
                            <div class="list" style="margin:0;">
                              <ul class="row">
                                <li class="item-content col-100 item-input item-input-with-value">
                                  <div class="item-inner">
                                    <div class="item-input-wrap">
                                      <textarea  placeholder=""  id="motivocancelacion" class="form-control"/></textarea>
                                    </div>
                                  </div>
                                </li>

                                </ul>
                                </div>


                                </form>

                           <div id="txtadvertencia" style="color:red;"></div>

                          </div>

                          </div>`;

                       
                      
                        


                               html+=`
                            <div class="row margin-bottom " style="padding-top: 1em;    margin-left: 2em;margin-right: 2em;margin-top:20px;display:flex;justify-content:center;">
                            <div class="col-100">
                            <button style="background: #C7AA6A;color:white;" type="button" class="button button-fill color-theme button-large button-raised  cambiarfuente" onclick="AceptarCancelacionAdmin(`+idcita+`,`+idusuario+`)">Aceptar</button>
                            </div>

                            
                          </div>
                          `;
                           html+=` </div>`;
                     html+=` </div>

                  </div>

                </div>
                
              </div>
            </div>
          </div>`;
          /*<p><button class="button color-theme btncortesias" id="cortesia_`+respuesta[i].idcortesia+`" onclick="ElegirCortesia(`+idcarrito+`,`+respuesta[i].idcortesia+`)" style="background: white;color:black;padding: 10px 20px;">
                                        Elegir
                                       </button>
                                     </p>*/
    dynamicSheet3 = app.sheet.create({
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

       dynamicSheet3.open();
  }


  function AceptarCancelacionAdmin(idcita,idusuario) {
     var iduser=localStorage.getItem('id_user');
   var motivocancelac=$("#motivocancelacion").val();
 
   const myPromise = new Promise((resolve, reject) => {
                  dynamicSheet3.close();

     CrearModalEspera5(() => {
  

  var datos="idusuariocancela="+iduser+"&motivocancela="+motivocancelac+"&idcita="+idcita+"&idusuarios="+idusuario;
  var pagina = "RealizarCancelacionAdmin.php";
  $.ajax({
    type: 'POST',
    dataType: 'json',
    url: urlphp+pagina,
    data:datos,
    success: function(respuesta){
        var resp=respuesta.montoamonedero;
        var idusucursal=respuesta.detallecita.idsucursal;
        localStorage.setItem('idsucursal',idusucursal);
               dynamicSheet2.close();

               CrearModalRetornoAdmin(resp);

      },error: function(XMLHttpRequest, textStatus, errorThrown){ 
        var error;
            if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
            if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
          console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
      }
    });

   resolve("Modal cerrado después de realizar el cargo");
            });
  });

  }
function CrearModalRetornoAdmin(resp) {
   var aviso=`<p style="line-height:1;">La cancelación se realizó exitosamente</p>`;
      // aviso+=`<p style="line-height:1;">El monto <span style="color:white;">$`+resp+`</span> fue enviado al <span style="color:white;">monedero</span></p>`;
       aviso+=`<p>¿Deseas reagendar?</p>`;

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
                          <div class="row" style="    margin-left: 2em; margin-right: 2em;    margin-top: 20px;">
                          <div class="col-100">
                          <div style="color: #c7aa6a;font-size: 30px;text-align: center;" class="cambiarfuente">
                            `+aviso+`

                            </div>
                          </div>

                          </div>`;

                        
                       html+=`
                             <div class="row margin-bottom " style="padding-top: 1em;    margin-left: 2em;margin-right: 2em;margin-top:20px;">
                            <div class="col-50">
                            <button style="background: #C7AA6A;color:white;" type="button" class="button button-fill color-theme button-large button-raised  cambiarfuente" onclick="ContinuarReagendaAdmin()">Si</button>
                            </div>

                            <div class="col-50">
                            <button style="background: white;color:black;" type="button" class="button button-fill color-theme button-large button-raised  cambiarfuente" onclick="CerrarModalAviso6()">No</button>
                            </div>
                          </div>

                          </div>
                       `;
                      
                        


                   
                           html+=` </div>`;
                     html+=` </div>

                  </div>

                </div>
                
              </div>
            </div>
          </div>`;
          
    dynamicSheet6 = app.sheet.create({
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

       dynamicSheet6.open();
}
