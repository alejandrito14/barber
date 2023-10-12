function CargarDatosAdmin() {
	  var nombre= localStorage.getItem("nombre");
     $(".nombreusuario").text(nombre);
      ObtenerTableroAnuncios();
      Obtenerpublicidad(1);

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
            <div class="toolbar" style="background: black;">
              <div class="toolbar-inner">
                <div class="left"></div>
                <div class="right">
                  <a class="link sheet-close"></a>
                </div>
              </div>
            </div>
            <div class="sheet-modal-inner" style="background: black; ">
            	 <div class="iconocerrar link sheet-close" style="z-index:10;">
	 								<span style="font-size: 30px;" class="material-icons-outlined">
																		cancel
																		</span>
	   						    	 </div>
              <div class="page-content" style="height: 100%;">
                <div style="background: black; height: 100%;width: 100%;border-radius: 20px;">
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
                    <div class="card-header">
                        <div class="row">
                            
                            <div class="col-50">
                                <h3 class="no-margin-bottom text-color-theme">`+respuesta.titulo+`</h3>
                            	<p class="no-margin-bottom text-color-theme">`+respuesta.descripcion+`</p>

                            	<p class="no-margin-bottom text-color-theme">`+respuesta.fechaformato+`</p>
                            	<p class="no-margin-bottom text-color-theme">`+respuesta.horainicial+`-`+respuesta.horafinal+`Hrs.</p>

                            	<p class="no-margin-bottom text-color-theme">Cliente: `+respuesta.nombre+` `+respuesta.paterno+`</p>`;

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

						
						<div style="justify-content: center;display: flex;">
						<span class="material-icons-outlined" style="font-size:30px;">cancel</span>

							</div>

						</div>

						<div class="col-100" onclick="scanqr()" >
						<h4 style="margin:0;text-align: center;">Cancelar servicio</h4>
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
            <p style="margin:0;text-decoration: underline;" onclick="Detallepago(`+respuesta[i].idnotapago+`)">#`+respuesta[i].folio+`</p>
 
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
