var fechaconsulta="";
var idsucursal="";
var horainicial="";
var horafinal="";
var fechaseleccionada="";
var horainicialsele="";
var idespecialistaseleccionado=0;
var horarioseleccionado="";
var sucursalelegida=1;
var clienteseleccionado=0;
var horafinalsele="";
$(document).ready(function() {
    aparecermodulos('catalogos/dashboard/vi_dashboard.php','main');
});

 

function ObtenerClientesAndroidios() {

	
	$.ajax({
					url: 'catalogos/dashboard/obteneroclientesandroidios.php', //Url a donde la enviaremos
					type: 'POST', //Metodo que usaremos
					dataType:'json',
					error: function (XMLHttpRequest, textStatus, errorThrown) {
						var error;
						console.log(XMLHttpRequest);
						if (XMLHttpRequest.status === 404) error = "Pagina no existe" + XMLHttpRequest.status; // display some page not found error 
						if (XMLHttpRequest.status === 500) error = "Error del Servidor" + XMLHttpRequest.status; // display some server error 
						$("#divcomplementos").html(error);
					},	
					success: function (msj) {

						$("#usuariosios").text(msj.respuesta[0].ios);
						$("#usuariosandroid").text(msj.respuesta[0].android);

					
					}
				});
}

function Obtenerregistrados(argument) {
	$.ajax({
					url: 'catalogos/dashboard/obteneroclientesregistrados.php', //Url a donde la enviaremos
					type: 'POST', //Metodo que usaremos
					dataType:'json',
					error: function (XMLHttpRequest, textStatus, errorThrown) {
						var error;
						console.log(XMLHttpRequest);
						if (XMLHttpRequest.status === 404) error = "Pagina no existe" + XMLHttpRequest.status; // display some page not found error 
						if (XMLHttpRequest.status === 500) error = "Error del Servidor" + XMLHttpRequest.status; // display some server error 
						$("#divcomplementos").html(error);
					},	
					success: function (msj) {

						$("#usuariosregistrados").text(msj.respuesta[0].cantidad);

					
					}
				});
}
function clientesensession(argument) {
	
	$.ajax({
					url: 'catalogos/dashboard/obteneroclientessession.php', //Url a donde la enviaremos
					type: 'POST', //Metodo que usaremos
					dataType:'json',
					error: function (XMLHttpRequest, textStatus, errorThrown) {
						var error;
						console.log(XMLHttpRequest);
						if (XMLHttpRequest.status === 404) error = "Pagina no existe" + XMLHttpRequest.status; // display some page not found error 
						if (XMLHttpRequest.status === 500) error = "Error del Servidor" + XMLHttpRequest.status; // display some server error 
						$("#divcomplementos").html(error);
					},	
					success: function (msj) {

						$("#clientessession").text(msj.respuesta[0].clientessession);

					
					}
				});
}

function ObtenerClientesVersion() {
	
	$.ajax({
					url: 'catalogos/dashboard/obteneroclientesversion.php', //Url a donde la enviaremos
					type: 'POST', //Metodo que usaremos
					dataType:'json',
					error: function (XMLHttpRequest, textStatus, errorThrown) {
						var error;
						console.log(XMLHttpRequest);
						if (XMLHttpRequest.status === 404) error = "Pagina no existe" + XMLHttpRequest.status; // display some page not found error 
						if (XMLHttpRequest.status === 500) error = "Error del Servidor" + XMLHttpRequest.status; // display some server error 
						$("#divcomplementos").html(error);
					},	
					success: function (msj) {
						$("#versionactualdiv").css('display','none');

						if (msj.actual!=0) {

						$("#versionactualdiv").css('display','block');
						$("#totalversionactual").text(msj.actual);
						$("#totalversionesanteriores").text(msj.anterior);
						$("#versionactual").text("("+msj.versionactual+")");

						}
					}
				});
}

function ObtenerCantidadAlumnos() {
	
	$.ajax({
					url: 'catalogos/dashboard/Obteneroalumnos.php', //Url a donde la enviaremos
					type: 'POST', //Metodo que usaremos
					dataType:'json',
					error: function (XMLHttpRequest, textStatus, errorThrown) {
						var error;
						console.log(XMLHttpRequest);
						if (XMLHttpRequest.status === 404) error = "Pagina no existe" + XMLHttpRequest.status; // display some page not found error 
						if (XMLHttpRequest.status === 500) error = "Error del Servidor" + XMLHttpRequest.status; // display some server error 
						$("#divcomplementos").html(error);
					},	
					success: function (msj) {

						if (msj.respuesta!=0) {

							var respuesta=msj.respuesta[0];
							$("#alumnosregistrados").text(respuesta.total);
						

						}
					}
				});
}
function ObtenerCoaches() {
	$.ajax({
					url: 'catalogos/dashboard/ObtenerCoaches.php', //Url a donde la enviaremos
					type: 'POST', //Metodo que usaremos
					dataType:'json',
					error: function (XMLHttpRequest, textStatus, errorThrown) {
						var error;
						console.log(XMLHttpRequest);
						if (XMLHttpRequest.status === 404) error = "Pagina no existe" + XMLHttpRequest.status; // display some page not found error 
						if (XMLHttpRequest.status === 500) error = "Error del Servidor" + XMLHttpRequest.status; // display some server error 
						$("#divcomplementos").html(error);
					},	
					success: function (msj) {

						if (msj.respuesta!=0) {

						var respuesta=msj.respuesta[0];
							$("#coachregistros").text(respuesta.total);
						

						}
					}
				});
}
function ObtenerServicios() {
	$.ajax({
					url: 'catalogos/dashboard/ObtenerServicios.php', //Url a donde la enviaremos
					type: 'POST', //Metodo que usaremos
					dataType:'json',
					error: function (XMLHttpRequest, textStatus, errorThrown) {
						var error;
						console.log(XMLHttpRequest);
						if (XMLHttpRequest.status === 404) error = "Pagina no existe" + XMLHttpRequest.status; // display some page not found error 
						if (XMLHttpRequest.status === 500) error = "Error del Servidor" + XMLHttpRequest.status; // display some server error 
						$("#divcomplementos").html(error);
					},	
					success: function (msj) {

						if (msj.respuesta!=0) {

								var respuesta=msj.respuesta[0];
							$("#cantidadservicios").text(respuesta.total);
						


						}
					}
				});
}

/*function PintarCalendario(argument) {
		 $('#picker').markyourcalendar({
	          			 startDate: new Date(),
			             months: ['ene','feb','mar','abr','may','jun','jul','agos','sep','oct','nov','dic'],
			              weekdays: ['dom','lun','mar','mier','jue','vier','sab'],
			           	 isMultiple: true,


						});

}*/

function addZero(i) {
    if (i < 10) {
        i = '0' + i;
    }
    return i;
}

var hoy = new Date();
var dd = hoy.getDate();
if(dd<10) {
    dd='0'+dd;
} 
 
if(mm<10) {
    mm='0'+mm;
}

var mm = hoy.getMonth()+1;

var yyyy = hoy.getFullYear();

//dd=addZero(dd);
mm=addZero(mm);

function PintarCalendario2() {

	//alert( yyyy+'-'+mm+'-'+dd);
   // var calendarEl = document.getElementById('picker');

   // var calendar = new FullCalendar.Calendar(calendarEl, {
	$('#picker2').fullCalendar({
        header: {
        	left:'prev',
            center: 'title',
            right: 'next',

        },
            locale:'es',
        	monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio","Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
			monthNamesShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Agost","Sept", "Oct", "Nov", "Dic"],
			dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles','Jueves', 'Viernes', 'Sabado'],
			dayNamesShort: ["Dom", "Lun", "Mar", "Mier", "Jue", "Vier", "Sab", "Dom"],
        firstDay:0,
        defaultDate: yyyy+'-'+mm+'-'+dd,
       eventLimit: true, // allow "more" link when too many events 
        events: [
           
        ],
        dayClick: function (date, jsEvent, view) {
           console.log('Has hecho click en: '+  date.format());
          /*
                     var  evento=new Date(date);
 var anio=evento.getFullYear();
           var mes=evento.getMonth()+1;
           var dia=evento.getDate();
           if(dia<10) {
				    dia='0'+dia;
				} 
				if(mes<10) {
				    mes='0'+mes;
				}

				if (dia==32) {
					dia='01';
				}*/

            var fecha=date.format();

          
            fechaconsulta=fecha;
			
		$(".divintervaloshorarios").css('display','block');
		$(".fc-header-title").html('<h2>'+fechaformato(fecha)+'</h2>');
		if (NtabName=='citas') {
			 // ObtenerFechaEspe(fecha);

			  ObtenerTotalCitas();

			}else{
				ObtenerFechasProductos(fecha);

				// ObtenerProductosFechasCalendario(anio,mes);
			}
			ObtenerHorariosDia(3);
			PintarFechaSeleccionada(fecha);
			Visualizarintervalos();

        }, 
        eventClick: function (calEvent, jsEvent, view) {
            $('#event-title').text(calEvent.title);
            $('#event-description').html(calEvent.description);
            $('#modal-event').modal();

        }, 

       
	});

  //  calendar.render();
	 var fecha=new Date();
	 var f=fecha.toISOString().split('T')[0];
	
	 var anio=f.split('-')[0];
	 var mes=f.split('-')[1];
	if (NtabName=='citas') {

	 ObtenerCitasFechasCalendario(anio,mes);
	}
	 $("#txttitle").css('display','none');
	//$(".fc-header-title").html('<h2>'+fechaformato(fecha)+'</h2>');
	//PintarFechaActual();

 $('.fc-button-prev').click(function(){

          var moment = $('#picker2').fullCalendar('getDate');
      
          var cadenafecha=moment.format().split('-');
        //console.log(cadenafecha);
       	   var anio=cadenafecha[0];
           var mes=cadenafecha[1];
           var dia=cadenafecha[2];

           var mes = parseInt(cadenafecha[1], 10);

			// Restamos uno al mes (considerando que los meses van de 1 a 12)
			mes++;

			// Si el mes resultante es cero, establecemos el valor de mes a 12 (diciembre del año anterior)
			if (mes === 0) {
			  mes = 12;
			  cadenafecha[0]--; // Restamos uno al año si retrocedemos desde enero
			}

			// Convertimos nuevamente el mes a cadena y le agregamos un cero adelante si es necesario
			var mesStr = mes.toString().padStart(2, '0');

			// Actualizamos el mes en las partes de la fecha


     var fecha=anio+'-'+mesStr+'-'+dia;
     var mes=cadenafecha[1];
				if (NtabName=='citas') {

				 	 ObtenerCitasFechasCalendario(anio,mes);
				 	}else{
				 	 ObtenerProductosFechasCalendario(anio,mes);
				 	}
		//$(".fc-header-title").html('<h2>'+fechaformato(fecha)+'</h2>');

	   $("#txttitle").css('display','none');
	   $(".horarios").css('display','none');
  });

  $('.fc-button-next').click(function(){
     var moment = $('#picker2').fullCalendar('getDate');
       	   var cadenafecha=moment.format().split('-');
      	   var anio=cadenafecha[0];
           var mes=cadenafecha[1];
           var dia=cadenafecha[2];
          	//console.log(mes);
            var mes = parseInt(cadenafecha[1], 10);
            if (mes<12) {
			// Restamos uno al mes (considerando que los meses van de 1 a 12)
			mes++;

			// Si el mes resultante es cero, establecemos el valor de mes a 12 (diciembre del año anterior)
			if (mes === 0) {
			  mes = 12;
			  cadenafecha[0]--; // Restamos uno al año si retrocedemos desde enero
			}
			
				
			}

			// Convertimos nuevamente el mes a cadena y le agregamos un cero adelante si es necesario
			var mesStr = mes.toString().padStart(2, '0');


            var fecha=anio+'-'+mesStr+'-'+dia;
            //console.log(fecha);
             var mes=cadenafecha[1];
	   	 if (NtabName=='citas') {

	    	 ObtenerCitasFechasCalendario(anio,mes);
	    	}else{

	    	 ObtenerProductosFechasCalendario(anio,mes);
	    	}

	     $("#txttitle").css('display','none');
	     $(".horarios").css('display','none');

	    
  });


  $(".fc-rigid").css('height','30px');
  $(".fc-day-grid-container").css('height','144.9px');
  $(".fc-day-top .fc-day-number").css({'cssText':'margin: 5em!important;'});

  $(".fc-day-header").css('text-align','center');
  $(".fc-day-top ").css({'cssText':'text-align: center!important;'});

  $(".fc-header-right").css('visibility','visible');

  //$(".fc-header-left .fc-corner-right").css('display','none');
  $(".fc-button-today").css('display','none');

 	$(".divintervaloshorarios").css('display','block');

 ObtenerHorariosDia(3);
 PintarFechaSeleccionada(fechaconsulta);

}

function ObtenerCitasFechasCalendario(anio,mes) {

	var datos="anio="+anio+"&mes="+mes;
	$.ajax({
					url: 'catalogos/dashboard/ObtenerCitasFechasCalendario.php', //Url a donde la enviaremos
					type: 'POST', //Metodo que usaremos
					dataType:'json',
					data:datos,
					error: function (XMLHttpRequest, textStatus, errorThrown) {
						var error;
						console.log(XMLHttpRequest);
						if (XMLHttpRequest.status === 404) error = "Pagina no existe" + XMLHttpRequest.status; // display some page not found error 
						if (XMLHttpRequest.status === 500) error = "Error del Servidor" + XMLHttpRequest.status; // display some server error 
						$("#divcomplementos").html(error);
					},	
					success: function (msj) {

						var respuesta=msj.citados;
						var fecha=msj.fechaformato;
					$(".fc-header-title").html('<h2>'+fecha+'</h2>');
							$(".fc-day").each(function( index ) {
								var elemento=$(this);

								$(elemento).find('span').eq(0).remove();

								for (var i = 0; i <respuesta.length; i++) {
									

									  var fechadiv=$(this).data('date');

											//console.log(respuesta[i]);
									  	if (respuesta[i].fecha == fechadiv) {
									  		  //console.log(elemento);
									  		

									  		var html="";
									  		 html=`
											<span class="badge colornegro" style="float: right;font-size: 14px;">`+respuesta[i].cantidadcitas+`</span>
									  		`
									  		;
									  		//console.log(html);
									  		//$(elemento).children().eq(0).css({'cssText': 'background: gray;border-radius: 30px;color: white; cursor:pointer;margin: auto;width:20%;padding-right: 1em;padding-left:1em;justify-content:center;display:flex;'});
											$(elemento).children().eq(0).prepend(html);
									  		
									  		
									  	}

									
								}

						});
					}
				});
}

function PintarDisponible() {

	/*$('#picker3').fullCalendar({

		  locale: 'es',
		   header: {
		   	left:'',
            right: 'prev,next',
            center: 'title',
        },

	  monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio","Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
	  monthNamesShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Agost","Sept", "Oct", "Nov", "Dic"],
	  dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles','Jueves', 'Viernes', 'Sabado'],
	  dayNamesShort: ["Dom", "Lun", "Mar", "Mier", "Jue", "Vier", "Sab", "Dom"],
	  defaultView: 	'agendaDay',

	     editable: true,
   	    selectable: true,
    	selectHelper: true,
    	 buttonIcons: true,
        weekNumbers: false,
        editable: true,
        eventLimit: true,
    	
        slotDuration: '00:35:00',
        snapDuration: '00:35:00',
         events: [
            {
                title: 'All Day Event',
                description: 'Lorem ipsum 1...',
                start: '2019-09-23',
                color: '#3A87AD',
                textColor: '#ffffff',
            }
        ],
          views: {
        agendaTwoDay: {
          type: 'agenda',
          duration: { days: 2 },

          groupByResource: true

       
        }
      },
         resources: [
	      { id: 'a', title: 'Room A' },
	      { id: 'b', title: 'Room B'},
	      { id: 'c', title: 'Room C' },
	      { id: 'd', title: 'Room D' }
	    ],
 	
	});*/

/*	    $('#picker3').fullCalendar({
      defaultView: 'agendaDay',
      defaultDate: '2017-12-07',
      editable: true,
      selectable: true,
      eventLimit: true, // allow "more" link when too many events
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'agendaDay',
      },
      views: {
        agendaTwoDay: {
          type: 'agenda',
          duration: { days: 2 },

          // views that are more than a day will NOT do this behavior by default
          // so, we need to explicitly enable it
          groupByResource: true

          //// uncomment this line to group by day FIRST with resources underneath
          //groupByDateAndResource: true
        }
      },

      //// uncomment this line to hide the all-day slot
      //allDaySlot: false,

      resources: [
        { id: 'a', title: 'Room A' },
        { id: 'b', title: 'Room B', eventColor: 'green' },
        { id: 'c', title: 'Room C', eventColor: 'orange' },
        { id: 'd', title: 'Room D', eventColor: 'red' }
      ],
      events: [
        { id: '2', resourceId: 'a', start: '2017-12-07T09:00:00', end: '2017-12-07T14:00:00', title: 'event 2' },
        { id: '3', resourceId: 'b', start: '2017-12-07T12:00:00', end: '2017-12-08T06:00:00', title: 'event 3' },
        { id: '4', resourceId: 'c', start: '2017-12-07T07:30:00', end: '2017-12-07T09:30:00', title: 'event 4' },
        { id: '5', resourceId: 'd', start: '2017-12-07T10:00:00', end: '2017-12-07T15:00:00', title: 'event 5' }
      ],

      select: function(start, end, jsEvent, view, resource) {
        console.log(
          'select',
          start.format(),
          end.format(),
          resource ? resource.id : '(no resource)'
        );
      },
      dayClick: function(date, jsEvent, view, resource) {
        console.log(
          'dayClick',
          date.format(),
          resource ? resource.id : '(no resource)'
        );
      }
    });

	  $(".fc-header-right").css('visibility','visible');
*/
}

function PintarHorarioDisponible() {

	
	$.ajax({
					url: 'catalogos/dashboard/ObtenerHorariosFechaActual.php', //Url a donde la enviaremos
					type: 'POST', //Metodo que usaremos
					dataType:'json',
					error: function (XMLHttpRequest, textStatus, errorThrown) {
						var error;
						console.log(XMLHttpRequest);
						if (XMLHttpRequest.status === 404) error = "Pagina no existe" + XMLHttpRequest.status; // display some page not found error 
						if (XMLHttpRequest.status === 500) error = "Error del Servidor" + XMLHttpRequest.status; // display some server error 
						$("#divcomplementos").html(error);
					},	
					success: function (msj) {
						PintarDia(msj);
				}

			});
}

function PintarDia(msj) {
				$("#fechaactualdiv").html('');
				$("#intervalos").html('');
				$("#zonasdiv").html('');
				$("#espacios").html('');
	 					fechaconsulta=msj.fecha;
						var respuesta=msj.respuesta;
						var fechaformato=msj.fechaactual;
						var intervaloconf=msj.intervaloconf;
						$("#v_intervalo").val(intervaloconf);
						$("#fechaactualdiv").html(fechaformato);
					
						var intervalos=msj.intervalos;
						var pxintervalo=msj.pxintervalo;
						var zonas=msj.zonas;
						var htmlintervalo="";
						for (var i = 0; i<intervalos.length; i++) {
							 htmlintervalo=`<div class="col-md-12" style="height:`+pxintervalo+`px;margin-top: 1px;text-align:center; display: flex;justify-content: right; align-items: start;border-top:1px solid #a09f9a;">`+intervalos[i].slice(0, -3)+` hrs.</div>`;
							 $("#intervalos").append(htmlintervalo);
						}

						var htmlzonas="";
						var htmlespacio="";
						for (var i = 0; i <zonas.length; i++) {
							//onclick="AgendarSinHorario(0,'`+fechaconsulta+`',`+zonas[i].idespecialista+`)"
							colorzona=zonas[i].color!=null?zonas[i].color:'gray';
							htmlzonas=` <div style="padding-top: 1em;width: 100px;height: 50px;font-weight:bold;text-align:center;background:`+colorzona+`;color:white;cursor:pointer;"  >
							<span style="padding: 4px;background: black;border-radius: 4px;">`+zonas[i].nombre+` `+zonas[i].conteo+`</span>
							</div>`;

							$("#zonasdiv").append(htmlzonas);

							htmlespacio=`<div id="espacio_`+zonas[i].idespecialista+`" style="width: 100px;text-align:center;" ></div>`;

							$("#espacios").append(htmlespacio);


							var intervalos=zonas[i].intervalos;
							var htmlintervalos="";
								var servicioante="";
								for (var j = 0; j<intervalos.length; j++) {
									var horainicial=intervalos[j].horainicialntervalo;
									var horafinal=intervalos[j].horafinalintervalo; 

									//console.log('horainicial'+horainicial);

									var pxintervalo=msj.pxintervalo;
									var servicio=intervalos[j].servicio;
									var titulo=zonas[i].nombre;

									var color="";
									var colorfondo="background:white;color:#eaebf1;";
									var borderradiustop="border-right: 1px solid #eaebf1;";
									var borderradiusbootom=" ";
									var servicioac="";
									marginbottom="margin-bottom: 1px;border-bottom: 1px solid #dadce8;";
									margintop="margin-top: 1px;border-top: 1px solid #dadce8;";
									alineacion="";
									var funcion="";

									if (intervalos[j].disponible==0) {
										//console.log(funcion);

									 //borderradiusbootom=" border-bottom: 1px solid white;";
									    color="#eaebf1";
										colorfondo="background:"+color+";";
										
										 titulo="";
										 marginbottom="border-bottom: 1px solid "+color+";";
										 margintop="margin-top: 1px;border-top: 1px solid  "+color+";";
										 icono='';
										 if (servicio.length>0) {
										 	 nombrecliente=servicio[0].nombrecliente;
										 	servicioac=servicio[0].idcita;
										 	intervalotiempo=servicio[0].intervaloservicio;
										 	pagado=servicio[0].pagado;
										 	tpv=servicio[0].tpv;
										 	if (pagado==1) {

										 	icono=`<span class="" style="font-size:10px;margin-top:2px;background:#59c158;padding: 2px;border-radius: 5px;">Pagado</span>`;
										 		
										 	}else{
										 	icono=`<span class="" style="font-size:10px;margin-top:2px;background:#ebc418;padding: 2px;border-radius: 5px;">No pagado</span>`;


										 	}
									funcion="DetalleServicioDash("+servicio[0].idcita+")";
									var app="";
									if (tpv==1) {
										color="black";
										colorfondo="background:black;";
										letra="color:white";
										app="";
									}else{


										color="black";
										colorfondo="background:black;";
										letra="color:white";
										
										app=`<span style="color: white;display: flex;justify-content: center;margin-top: 2px;
    									background: #c7aa6a;padding: 2px;border-radius: 5px;width: 30px;float: right;margin-right: 2px;">app</span>`;
									}

									

									marginbottom="border-bottom: 1px solid "+color+";";
									margintop="border-top: 1px solid  "+color+";";

											if (servicioante!=servicioac) {

													if (servicio.length) {
													titulo+=`<div style="text-align: center;`+letra+`;">`;
													titulo+=`<span style="margin-top:10px;"></span>`+app;
													titulo+=`<br><span style="width:100%;font-size:14px;font-weight:bold;justify-content: center;display: flex;">`+nombrecliente+`</span> `;
													titulo+=`<span>`+servicio[0].nombrepaquete+`(`+intervalotiempo+`min.)</span>`;
													servicioante=servicio[0].idcita;
													titulo+=`<br><span style="width:100%;"></span> `+icono;
				
													titulo+=`</div>`;

													}
											}else{
												pxintervalo=pxintervalo+1;
											
											borderradiustop="";	
											borderradiusbootom=" border-right: 1px solid #dadce8;";
											
											}

										}else{

										titulo=`<div style="color:white;display: flex;line-height: 2.4;justify-content: end;"><span class="mdi mdi-close-circle" style="font-size:15px;"></span></div>`;
										funcion="";

										}

									}else{

									alineacion="align-items: center;";
									borderradiustop="border-right: 1px solid #dadce8;";
									//borderradiusbootom=" border-bottom: 1px solid white;";
									servicioante="";

									funcion="IrAgendarcita('"+horainicial+"','"+fechaconsulta+"',"+zonas[i].idespecialista+")";

									}
								
								
									htmlintervalos=`<div style="height:`+pxintervalo+`px;`+colorfondo+`;`+margintop+marginbottom+`font-size:10px; justify-content: center;font-weight:bold;`+alineacion+borderradiustop+borderradiusbootom+`" onclick="`+funcion+`">`+titulo+`</div>`;
								$("#espacio_"+zonas[i].idespecialista).append(htmlintervalos);

								}

						}





						
					}

					function AgendarSinHorario(horainicial,fechaconsulta,idespecialista) {
						/*$("#modalelegircliente").modal();
							$(".btnnuevocliente").attr('onclick','OcultarModal();AgregarNuevo2("'+horainicial+'","'+fechaconsulta+'",'+idespecialista+')');
							$("#btncontinuarcliente").attr('onclick','EnviarPuntoVenta("'+horainicial+'","'+fechaconsulta+'",'+idespecialista+')');
							ObtenerClientesFiltro();*/
						ObtenerCitasSinHorario(fechaconsulta,idespecialista);

						$("#modallistado").modal();

						$("#btnnuevacita").attr('onclick','NuevaAgendaSinHorario("'+horainicial+'","'+fechaconsulta+'",'+idespecialista+')');
					}

					function ObtenerCitasSinHorario(fechaconsulta,idespecialista) {
						
					var datos="fecha="+fechaconsulta+"&idespecialista="+idespecialista;
					$.ajax({
					url: 'catalogos/dashboard/ObtenerCitasFechaEspecificaSinHorario.php', //Url a donde la enviaremos
					type: 'POST', //Metodo que usaremos
					dataType:'json',
					data:datos,
					error: function (XMLHttpRequest, textStatus, errorThrown) {
						var error;
						console.log(XMLHttpRequest);
						if (XMLHttpRequest.status === 404) error = "Pagina no existe" + XMLHttpRequest.status; // display some page not found error 
						if (XMLHttpRequest.status === 500) error = "Error del Servidor" + XMLHttpRequest.status; // display some server error 
						$("#divcomplementos").html(error);
					},	
						success: function (msj) {
						 	var respuesta=msj.citasdia;
							PintarCitasSinHorario(respuesta);

							}
						});

					}
					function PintarCitasSinHorario(respuesta) {
							var html="";
						if (respuesta.length>0) {
							for (var i = 0; i < respuesta.length; i++) {
								var intervalotiempo=respuesta[i].intervaloservicio;
								var claseestatus=respuesta[i].claseestatus;
								html+=`

									<div class="row " style="padding:10px;color:white;margin-bottom: 10px;margin-right: 10px;margin-left: 10px;background:`+claseestatus+`" onclick="DetallecitaModal(`+respuesta[i].idcita+`)">

										<span class="col-md-12">
										<span style="font-size:14px;font-weight:bold;">`+respuesta[i].horains+`-`+respuesta[i].horafs+`hrs.</span>
										</span>
										<span class="col-md-12">

										<span style="font-size:14px;font-weight:bold;">`+respuesta[i].nombreusuario+`</span>
										</span>
										<span class="col-md-12">`+respuesta[i].nombrepaquete+`(`+intervalotiempo+`min.)</span>
										<span class="col-md-12">`+respuesta[i].textoestatus+`</span>

									</div>
								`;
							}
						}

						$("#divcitassinhorario").html(html);
					}

					function DetallecitaModal(idcita) {
						$("#modallistado").modal('hide');
						DetalleServicioDash(idcita);
					}

					function NuevaAgendaSinHorario(horainicial,fechaconsulta,idespecialista) {
							$("#modallistado").modal('hide');

							$("#modalelegircliente").modal();
							$(".btnnuevocliente").attr('onclick','OcultarModal();AgregarNuevo2("'+horainicial+'","'+fechaconsulta+'",'+idespecialista+')');
							$("#btncontinuarcliente").attr('onclick','EnviarPuntoVenta("'+horainicial+'","'+fechaconsulta+'",'+idespecialista+')');
							ObtenerClientesFiltro();
						//$("#btnnuevacita").attr('onclick','AbrirAgendacita('+horainicial+','+fechaconsulta+','+idespecialista+')');
					}

					function AbrirAgendacita(horainicial,fechaconsulta,idespecialista) {
						// body...
						$("#modallistado").modal('hide');

						IrAgendarcita(horainicial,fechaconsulta,idespecialista);
					}

					function IrAgendarcita(horainicial,fechaconsulta,idespecialista) {
						
				/*		var regresar='catalogos/pagos/vi_cobrar.php?horainicial='+horainicial+"&fechaconsulta="+fechaconsulta;
	    	var donde='main';

						aparecermodulos(regresar+"&idmenumodulo="+idmenumodulo+"&msj=",donde);
					*/
					//AbrirModalClienteListado()
							
							$("#modalelegircliente").modal();
							$(".btnnuevocliente").attr('onclick','OcultarModal();AgregarNuevo2("'+horainicial+'","'+fechaconsulta+'",'+idespecialista+')');
							$("#btncontinuarcliente").attr('onclick','EnviarPuntoVenta("'+horainicial+'","'+fechaconsulta+'",'+idespecialista+')');
							ObtenerClientesFiltro();
					}


function ObtenerHorariosFecha(fecha) {
 
	var datos="fecha="+fecha;
	$.ajax({
					url: 'catalogos/dashboard/ObtenerHorariosFecha.php', //Url a donde la enviaremos
					type: 'POST', //Metodo que usaremos
					dataType:'json',
					data:datos,
					error: function (XMLHttpRequest, textStatus, errorThrown) {
						var error;
						console.log(XMLHttpRequest);
						if (XMLHttpRequest.status === 404) error = "Pagina no existe" + XMLHttpRequest.status; // display some page not found error 
						if (XMLHttpRequest.status === 500) error = "Error del Servidor" + XMLHttpRequest.status; // display some server error 
						$("#divcomplementos").html(error);
					},	
					success: function (msj) {

						var respuesta=msj.respuesta;

					

								for (var i = 0; i <respuesta.length; i++) {
									
									$(".fc-day").each(function( index ) {
									 // console.log( index + ": " + $(this).data('date') );
									  var fechadiv=$(this).data('date');
									 var elemento=$(this);
									
									  	if (respuesta[i].fecha == fechadiv) {
									  		
									  		$(elemento).children().eq(0).css({'cssText': 'background: gray;border-radius: 30px;color: white; cursor:pointer;margin: auto;width:20%;padding-right: 1em;padding-left:1em;justify-content:center;display:flex;'});

									  	}

									});
								}

						
					}
				});

}

function ObtenerFechaEspe(fecha) {
	var datos="fecha="+fecha;
	$.ajax({
					url: 'catalogos/dashboard/ObtenerFechaEspecifica.php', //Url a donde la enviaremos
					type: 'POST', //Metodo que usaremos
					dataType:'json',
					data:datos,
					error: function (XMLHttpRequest, textStatus, errorThrown) {
						var error;
						console.log(XMLHttpRequest);
						if (XMLHttpRequest.status === 404) error = "Pagina no existe" + XMLHttpRequest.status; // display some page not found error 
						if (XMLHttpRequest.status === 500) error = "Error del Servidor" + XMLHttpRequest.status; // display some server error 
						$("#divcomplementos").html(error);
					},	
					success: function (msj) {
					 $("#txttitle").css('display','block');
	    			 $(".horarios").css('display','block');

	 				   
						var respuesta=msj.respuesta;
						PintarCitasCalendario(respuesta);
					}
				});
}

function ObtenerFechasProductos(fecha) {
	var datos="fecha="+fecha;
	$.ajax({
					url: 'catalogos/dashboard/ObtenerFechaProductoEspecifica.php', //Url a donde la enviaremos
					type: 'POST', //Metodo que usaremos
					dataType:'json',
					data:datos,
					error: function (XMLHttpRequest, textStatus, errorThrown) {
						var error;
						console.log(XMLHttpRequest);
						if (XMLHttpRequest.status === 404) error = "Pagina no existe" + XMLHttpRequest.status; // display some page not found error 
						if (XMLHttpRequest.status === 500) error = "Error del Servidor" + XMLHttpRequest.status; // display some server error 
						$("#divcomplementos").html(error);
					},	
					success: function (msj) {
					 $("#txttitle").css('display','block');
	    			 $(".horarios").css('display','block');

	 				   
						var respuesta=msj.respuesta;
						PintarProductosCalendario(respuesta);
					}
				});
}


function ListadoAlumnos() {
	


	$("#mostraralumnos").css('display','block');
}

function CerrarAlumnos() {
	$("#mostraralumnos").css('display','none');
}

function ListadoCitas() {
	$("#mostrarcitas").css('display','block');

	CargarCitasActuales();
}
function CerrarCitas(argument) {
	$("#mostrarcitas").css('display','none');

}

function CerrarServicios() {
	
	$("#mostrarservicios").css('display','none');

}

function ListadoServicios(argument) {

	$("#mostrarservicios").css('display','block');

}

function ObtenerHorariosDia(operacion){

	var datos="operacion="+operacion+"&fecha="+fechaconsulta;
		$.ajax({
					url: 'catalogos/dashboard/ObtenerHorariosFechaDia.php', //Url a donde la enviaremos
					type: 'POST', //Metodo que usaremos
					dataType:'json',
					data:datos,
					error: function (XMLHttpRequest, textStatus, errorThrown) {
						var error;
						console.log(XMLHttpRequest);
						if (XMLHttpRequest.status === 404) error = "Pagina no existe" + XMLHttpRequest.status; // display some page not found error 
						if (XMLHttpRequest.status === 500) error = "Error del Servidor" + XMLHttpRequest.status; // display some server error 
						$("#divcomplementos").html(error);
					},	
					success: function (msj) {
						PintarDia(msj);
				}
			});

}

function AbrirModalFecha() {
	
	$("#modalfecha").modal();
}

function BuscarFecha() {
	var fecha=$("#txtfechabuscar").val();
	var bandera=1;
	if (fecha=='') {
		bandera=0;
	}

	if (!isValidDate(fecha)) {
		bandera=0;
	}

	if (bandera==1) {
		fechaconsulta=fecha;
		ObtenerHorariosDia(3);
		$("#modalfecha").modal('hide');

	}else{

		alert('Selecciona una fecha válida')
	}
}


function DetalleServicioDash(idcita) {
	AbrirModalCitaAdmin(idcita);
	/*$("#modalServicios").modal();
	var datos="idservicio="+idservicio;
		$.ajax({
					url: 'catalogos/servicios/ObtenerAlumnosServicio.php', //Url a donde la enviaremos
					type: 'POST', //Metodo que usaremos
					dataType:'json',
					data:datos,
					error: function (XMLHttpRequest, textStatus, errorThrown) {
						var error;
						console.log(XMLHttpRequest);
						if (XMLHttpRequest.status === 404) error = "Pagina no existe" + XMLHttpRequest.status; // display some page not found error 
						if (XMLHttpRequest.status === 500) error = "Error del Servidor" + XMLHttpRequest.status; // display some server error 
						$("#divcomplementos").html(error);
					},	
					success: function (msj) {
						var respuesta=msj.asignados;
						
				     	PintarAlumnosServicios2(respuesta);
					}
				});*/
}


function PintarAlumnosServicios2(respuesta) {
	var html="";
	if (respuesta.length) {
		for (var i = 0; i < respuesta.length; i++) {
			var pagado="";
			if (respuesta[i].pagado==1) {
				pagado=`<span class="badge badge-success">Pagado</span>`;
			}else{
				pagado=`<span class="badge badge-danger">Pendiente</span>`;
			}


			html+=`<tr>
				<td>`+respuesta[i].nombre+` `+respuesta[i].paterno+` `+respuesta[i].materno+`</td>
				<td>`+pagado+`</td>
				</tr>
			`;
		}
	}

	$("#usuariosinscritos").html(html);
}

function ObtenerFechaActual() {
		

		$.ajax({
					url: 'catalogos/dashboard/ObtenerFechaActual.php', //Url a donde la enviaremos
					type: 'POST', //Metodo que usaremos
					dataType:'json',
					async:false,
					error: function (XMLHttpRequest, textStatus, errorThrown) {
						var error;
						console.log(XMLHttpRequest);
						if (XMLHttpRequest.status === 404) error = "Pagina no existe" + XMLHttpRequest.status; // display some page not found error 
						if (XMLHttpRequest.status === 500) error = "Error del Servidor" + XMLHttpRequest.status; // display some server error 
						$("#divcomplementos").html(error);
					},	
					success: function (msj) {
						var respuesta=msj.fechaactual;
						$(".fechaactual").text(respuesta);
						var formatofecha=msj.formatofecha;

						fechaconsulta=formatofecha;
					}
				});
}

function PintarFechaActual() {
	var hoy = new Date();
	var dd = hoy.getDate();
	var mm = hoy.getMonth()+1;
	var yyyy = hoy.getFullYear();

	if(dd<10) {
		    dd='0'+dd;
		} 
		 
		if(mm<10) {
		    mm='0'+mm;
		}

	var fechaactual=yyyy+'-'+mm+'-'+dd;
									
		$(".fc-day").each(function( index ) {
									 // console.log( index + ": " + $(this).data('date') );
		  var fechadiv=$(this).data('date');
		  var elemento=$(this);
		  	if (fechadiv == fechaactual) {
		  		
		  		$(elemento).children().eq(0).css({'cssText': 'background: #007aff;border-radius: 30px;color: white; cursor:pointer;margin: auto;width:20%;padding-right: 1em;padding-left:1em;justify-content:center;display:flex;'});
		  		return 0;
		  	}

		});
							

}


function PintarFechaSeleccionada(fecha) {

	var fechaactual=new Date();

	// Obtener año, mes y día
let año = fechaactual.getFullYear();
let mes = ('0' + (fechaactual.getMonth() + 1)).slice(-2); // Sumar 1 al mes ya que en JavaScript los meses van de 0 a 11
let dia = ('0' + fechaactual.getDate()).slice(-2);

// Formatear la fecha como 'Y-m-d'
let fechaFormateada = año + '-' + mes + '-' + dia;


	$(".fc-day").each(function( index ) {
									 // console.log( index + ": " + $(this).data('date') );
		  var fechadiv=$(this).data('date');
		  var elemento=$(this);
		  $(elemento).children().eq(0).removeClass('seleccionadofecha');

		});
							
		$(".fc-day").each(function( index ) {
									 // console.log( index + ": " + $(this).data('date') );
		  var fechadiv=$(this).data('date');
		  var elemento=$(this);

		  	if (fechadiv == fecha) {
		  		
		  		$(elemento).children().eq(0).addClass('seleccionadofecha');
		  		return 0;		
		  }

	

		});



	$(".fc-day").each(function( index ) {
									 // console.log( index + ": " + $(this).data('date') );
		  var fechadiv=$(this).data('date');
		  var elemento=$(this);


		  if (fechaFormateada==fechadiv) {

		  	$(elemento).children().eq(0).addClass('seleccionadofechaactual');

		  	return 0;
		  }

		});
							

}



function PintarFechaSeleccionada2(fecha) {

	
	$(".fc-day").each(function( index ) {
									 // console.log( index + ": " + $(this).data('date') );
		  var fechadiv=$(this).data('date');
		  var elemento=$(this);
		  $(elemento).children().eq(0).removeClass('seleccionadofecha2');

		});
							
		$(".fc-day").each(function( index ) {
									 // console.log( index + ": " + $(this).data('date') );
		  var fechadiv=$(this).data('date');
		  var elemento=$(this);

		  	if (fechadiv == fecha) {
		  		
		  		$(elemento).children().eq(0).addClass('seleccionadofecha2');
		  		return 0;		
		  }

		});
							

}

function ColocarIntervalo() {
		var intervalo=$("#v_intervalo").val();
		var datos="intervalo="+intervalo;
		$.ajax({
					url: 'catalogos/dashboard/GuardarIntervalo.php', //Url a donde la enviaremos
					type: 'POST', //Metodo que usaremos
					dataType:'json',
					data:datos,
					error: function (XMLHttpRequest, textStatus, errorThrown) {
						var error;
						console.log(XMLHttpRequest);
						if (XMLHttpRequest.status === 404) error = "Pagina no existe" + XMLHttpRequest.status; // display some page not found error 
						if (XMLHttpRequest.status === 500) error = "Error del Servidor" + XMLHttpRequest.status; // display some server error 
						$("#divcomplementos").html(error);
					},	
					success: function (msj) {
						
							ObtenerHorariosDia(3);
					}
				});
}

function CargarCitasActuales() {
	
		$.ajax({
					url: 'catalogos/dashboard/CargarCitasActuales.php', //Url a donde la enviaremos
					type: 'POST', //Metodo que usaremos
					dataType:'json',
					error: function (XMLHttpRequest, textStatus, errorThrown) {
						var error;
						console.log(XMLHttpRequest);
						if (XMLHttpRequest.status === 404) error = "Pagina no existe" + XMLHttpRequest.status; // display some page not found error 
						if (XMLHttpRequest.status === 500) error = "Error del Servidor" + XMLHttpRequest.status; // display some server error 
						$("#divcomplementos").html(error);
					},	
					success: function (msj) {
						var citas=msj.respuesta;
						PintarCitas(citas);	
					}
				});
}

function ObtenerTotalCitas() {

		var datos="fecha="+fechaconsulta;
		$.ajax({
					url: 'catalogos/dashboard/ObtenerTotalesAdmin.php', //Url a donde la enviaremos
					type: 'POST', //Metodo que usaremos
					dataType:'json',
					data:datos,
					error: function (XMLHttpRequest, textStatus, errorThrown) {
						var error;
						console.log(XMLHttpRequest);
						if (XMLHttpRequest.status === 404) error = "Pagina no existe" + XMLHttpRequest.status; // display some page not found error 
						if (XMLHttpRequest.status === 500) error = "Error del Servidor" + XMLHttpRequest.status; // display some server error 
						$("#divcomplementos").html(error);
					},	
					success: function (msj) {
						//console.log(msj);
						var citas=msj.respuesta;
						var totalproductosdia=msj.totalproductosdia;
						var total=msj.totalcitasdia;
						var realizadas=msj.totalcitasrealizadas;
						var pendientes=msj.totalpendientes;
						var totalcancelados=msj.totalcancelados;
						var totalproceso=msj.totalproceso;
						var totalcaducados=msj.totalnorealizados;
						$("#citasagendadas").text(total);
						$("#citasproceso").text(totalproceso);
						$("#citasrealizadas").text(realizadas);

						 var notas=msj.notas;
						$("#citaspendientes").text(pendientes);
						$("#citascanceladas").text(totalcancelados);
						$("#citascaducados").text(totalcaducados);
						$("#productosregistros").text(totalproductosdia);
						ObtenerHorariosDia(3);

						/*citasagendadas
						citasproceso
						citasrealizadas
						citaspendientes
						citascanceladas
						citascaducados*/

					}
				});
}

function PintarCitas(respuesta) {
var html="";
  if (respuesta.length>0) {
    $(".titulocitas").css('display','block');
    for (var i = 0; i < respuesta.length; i++) {

          imagen='';
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

  $(".listadocitas").html(html);
}


function PintarCitasCalendario(respuesta) {
var html="";
  if (respuesta.length>0) {
    $(".titulocitas").css('display','block');
    for (var i = 0; i < respuesta.length; i++) {

          imagen='catalogos/sucursal/imagenes/'+respuesta[i].imagen;
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
      	<div class="" style="    width: 100%;
    background: white;
    border-radius: 30%;
    height: 150px;
    padding-top: 1em;margin-bottom: 1em;">
			<div class="">
			 <div class="col-md-2" style="
			    float: left;">
			            <a>
			            <img src="`+imagen+`" alt="" style="width: 100%;border-radius: 10px;">
			            </a>
			          </div>
			  <div class="col-md-6" style="
			    float: left;">
            <h6 class="item-title">
      
            <p style="margin:0;" onclick="AbrirModalCitaAdmin(`+respuesta[i].idcita+`)">`+respuesta[i].titulo+`-`+respuesta[i].descripcion+`</a></p>
            <p style="margin:0;" onclick="AbrirModalCitaAdmin(`+respuesta[i].idcita+`)">`+respuesta[i].nombreespecialista+`</a></p>


            <p style="color: #2b952a;font-size: 18px;margin:0;" onclick="AbrirModalCitaAdmin(`+respuesta[i].idcita+`)">`+respuesta[i].horacita+`-`+respuesta[i].horafinal+`hrs.</p>

            </h6>
            <div class="">
                    <p style="margin:0;" onclick="AbrirModalCitaAdmin(`+respuesta[i].idcita+`)">`+respuesta[i].nombrepaquete+`</p>

            <p style="margin:0;">`+respuesta[i].nombreusuario+`</p>
            <p style="margin:0;text-decoration: underline;" onclick="Detallepago(`+respuesta[i].idnotapago+`)">#`+respuesta[i].folio+`</p>
              <button type="button" class="btn btn-primary" onclick="AbrirModalCitaAdmin(`+respuesta[i].idcita+`)">Ver detalle</button>

            </div>
            
          </div>
          <div class="col-md-4" style="float: left;">
          	<a class="bookmark-btn active" style="color:black;">
           	 <i class="fas fa-bookmark"></i>
            
          	</a>
          </div>
        </div>
      </div>

      `;


    }
  }

  $(".listadocitascalendario").html(html);
}

function AbrirModalCitaAdmin(idcita) {
		var iduser="";
	var datos="idcita="+idcita+"&iduser="+iduser;
	var pagina = "ObtenerDetalleCitaAdmin.php";
	
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: 'catalogos/dashboard/'+pagina, //Url a donde la enviaremos
		data:datos,
		success: function(datos){
			localStorage.setItem('idcita',idcita);
			var respuesta=datos.respuesta;
			var imagenes=datos.imagenes;
				ObtenerDetalleCitaAdmin(respuesta,imagenes);	

			},error: function(XMLHttpRequest, textStatus, errorThrown){ 
				var error;
				  	if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
				  	if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
								//alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
					console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
			}
		});
	
}

function ObtenerDetalleCitaAdmin(respuesta,imagenes) {
	var imagen=`catalogos/sucursal/imagenes/`+respuesta.imagen;

	var html2="";

				if (respuesta.horains!='' && respuesta.horains!=null) {

					respuesta.horainicial=respuesta.horains;
					respuesta.horafinal=respuesta.horafs;

				}

var html=` <div class="" style="">
            
            <div class="" style=" ">
            	
              <div class="" style="height: 100%;">
                <div style="">
   						    
   			<div class="" style="width: 100%;">
   							 	
	   	   <div class="">
		    <div class="" style="">
		   	<div class="" style="">
		   							 	 
			<div class="row">
			<div class="col-md-12" style="margin-top:1em;">
                <div class="card margin-bottom">
                    <div class="card-header" style="    border-radius: 10px;
    margin: 10px;">
                        <div class="row" style="    margin: 5px;">
                            
                            <div class="col-50">

                            	<h3 class="no-margin-bottom text-color-theme" style="font-size:26px;">Cliente: `+respuesta.nombre+` `+respuesta.paterno+`</h3>

                            	<h3 class="no-margin-bottom text-color-theme" style="font-size:24px;font-weight: normal;">`+respuesta.fechaformato+`</h3>
                            	<h3 class="no-margin-bottom text-color-theme" style="font-size:24px;">`+respuesta.horainicial+`-`+respuesta.horafinal+`Hrs.</h3>`;
                             html+=` <h3 class="no-margin-bottom text-color-theme" style="font-size:22px;font-weight: normal;">`+respuesta.concepto+`</h3>

                             <h3 class="no-margin-bottom text-color-theme" style="font-size:20px;">`+respuesta.titulo+`</h3>
                            	<p class="no-margin-bottom text-color-theme" style="font-size:20px;">`+respuesta.descripcion+`</p>`;

                            
                          if (respuesta.concortesia==1  ) {


                          if (respuesta.idcortesia>0 ) {

                          html+=`


                         <div class="icon-text-container" style="margin-top: 10px;">

                           <p style="margin:0;font-size:20px;"">Cortesía: <span class="texto">`+respuesta.nombrepaquetecortesia+`</span>
							<button class="btn btn-info" onclick="CambiarCortesia(`+respuesta.idcita+`,`+respuesta.idpaquete+`)">Cambiar</button>
                           </p>

                           </div>`;

                      }else{
                      	   html+=`


                         <div class="icon-text-container" style="margin-top: 10px;">

                           <p style="margin:0;font-size:20px;"">Cortesía: <span class="texto">Ninguno</span> 
                           							<button class="btn btn-info" onclick="CambiarCortesia(`+respuesta.idcita+`,`+respuesta.idpaquete+`)">Cambiar</button>
		
                           </p>

                           </div>`;

                      }


                      if (respuesta.idcortesia==0 && respuesta.colococortesia==1) {

                          html+=`


                         <div class="icon-text-container" style="margin-top: 10px;">

                           <p style="margin:0;">Cortesía: <span class="texto">Ninguna</span></p>

                           </div>`;
                      }
                  }

                            if(respuesta.checkin==1) {
                            
                             
                          	html+=`
									<p class="" style="margin:0;">`;
								html+=`<span>check-in: `+respuesta.fechacheckin+`</span>                               
								<span class="mdi mdi-check-circle-outline" style=" width: 30px;justify-content: center;font-size: 20px;color:#5ac35b;">


										`;
								html+=`</p>`;
                                    
                            }

                            if (respuesta.checkout==1) {
								html+=`
									<p class="" style="">`;
								html+=`<span>check-out: `+respuesta.fechacheckout+`</span> 
									   <span class="mdi mdi-check-circle-outline" style=" width: 30px;justify-content: center;font-size: 20px;color:#5ac35b;">`;
								html+=`</p>`;
									}




                               html+=`


                           </div>

                            <div class="col-50">
                                <div class="avatar">
                                    <img src="`+imagen+`" alt="" style="margin-top: 1.4em;    width: 100%;border-radius: 10px;">
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

							</div>

						</div>

		

					</div>`;

					if (imagenes.length>0) {
							html+=`<div class="row" style=" ">
												<div class="col-md-12">
													<p style="font-size: 16px;font-weight: bold;margin-left: 15px;">Galeria de imágenes</p>
												</div>
												<div class="col-md-12">
												`;


												for (var i = 0; i <imagenes.length; i++) {
														

														html+=`
														<div class="" style="width: 100%;background: white;border-radius: 30%;height: 150px;padding-top: 1em;margin-bottom: 1em;">
																	<div class="">
													      <a>
													      <div style="border-radius: 10px 10px 0px 0px;background-size: cover;">
													   		  <img src="`+imagenes[i].ruta+`" style="width: 30%;height: 100px;">
													      </div>
													      </a>
										        	</div>
										     	 </div>		`;

												}

												html+=`
												
												</div>

											</div>`;
					}

					
			

							   							  	
           		html+=`
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
          
		$("#divdetallecita").html(html);

		$("#modaldetallecita").modal();
		$(".btnreagendarcita").css('display','block');
		$(".btncancelarcita").css('display','block');
		$(".btnagregarproducto").css('display','block');

		    if(respuesta.checkin==1) {
				$(".btnreagendarcita").css('display','none');

		     }

		  if(respuesta.checkin==1) {
				$(".btncancelarcita").css('display','none');
		      }
		$(".btnreagendarcita").attr('onclick','ReagendarCita('+respuesta.idcita+')');
		$(".btncancelarcita").attr('onclick','CancelarCita('+respuesta.idcita+')');
		$(".btnagregarproducto").attr('onclick','AgregarProductoCita('+respuesta.idusuarios+')');

					if (respuesta.pagada==1) {
					$(".btnpagarcita").css('display','none');
					$(".btnmodificar").css('display','none');

					}else{
					
					$(".btnpagarcita").css('display','block');

					$(".btnpagarcita").attr('onclick','PagarNotaCita('+respuesta.idnotapago+',2)');

					$(".btnmodificar").attr('onclick','ModificarNotaCita('+respuesta.idnotapago+',4)');
					$(".btnmodificar").css('display','block');
					
					}


}

function AgregarCita() {
		var regresar='catalogos/citas/agendarcita.php';
	    var donde='main';

		aparecermodulos(regresar+"&idmenumodulo="+idmenumodulo+"&msj=",donde);

}

function AgregarProductoCita(clienteseleccionado) {
	$("#modaldetallecita").modal('hide');
	var horainicial=1;
	var datos='clienteseleccionado='+clienteseleccionado+"&horainicial="+horainicial;
	var regresar='catalogos/pagos/vi_cobrar.php?'+datos;
	var donde='main';
	aparecermodulos(regresar+"&idmenumodulo="+idmenumodulo+"&msj=",donde);
	
}

function EnviarPuntoVenta(horainicial,fecha,idespecialista) {

	
		$("#modalelegircliente").modal('hide');
		//$(".btnseleccionarcliente").attr('onclick','CrearSesionUsuario('+idcliente+')');
		var datos='clienteseleccionado='+clienteseleccionado+'&horainicial='+horainicial+"&fecha="+fecha+"&idespecialistaselect="+idespecialista;
		var regresar='catalogos/pagos/vi_cobrar.php?'+datos;
	    var donde='main';
		aparecermodulos(regresar+"&idmenumodulo="+idmenumodulo+"&msj=",donde);
	

}

function ReagendarCita(idcita) {
	$("#modaldetallecita").modal('hide');
	
	 var donde='main';
	var regresar='catalogos/citas/reagendarcita.php?idcita='+idcita;
	aparecermodulos(regresar+"&idmenumodulo="+idmenumodulo+"&msj=",donde);
}

function CancelarCita(idcita) {
	$("#modaldetallecita").modal('hide');
	
	var donde='main';
	var regresar='catalogos/citas/cancelarcita.php?idcita='+idcita;
	aparecermodulos(regresar+"&idmenumodulo="+idmenumodulo+"&msj=",donde);
}

function PagarNotaCita(idnota,accion) {
	$("#modaldetallecita").modal('hide');
	
	var donde='main';
	var regresar='catalogos/citas/pagarnotacita.php?idnotapago='+idnota+"&accion="+accion;
	aparecermodulos(regresar+"&idmenumodulo="+idmenumodulo+"&msj=",donde);
}


function ModificarNotaCita(idnota,accion) {
	$("#modaldetallecita").modal('hide');
	
	var donde='main';
	var regresar='catalogos/citas/modificarnotacita.php?idnotapago='+idnota+"&accion="+accion;
	aparecermodulos(regresar+"&idmenumodulo="+idmenumodulo+"&msj=",donde);
}

function ObtenerProductosFechasCalendario(anio,mes) {
	var datos="anio="+anio+"&mes="+mes;
	$.ajax({
					url: 'catalogos/dashboard/ObtenerProductosFechasCalendario.php', //Url a donde la enviaremos
					type: 'POST', //Metodo que usaremos
					dataType:'json',
					data:datos,
					error: function (XMLHttpRequest, textStatus, errorThrown) {
						var error;
						console.log(XMLHttpRequest);
						if (XMLHttpRequest.status === 404) error = "Pagina no existe" + XMLHttpRequest.status; // display some page not found error 
						if (XMLHttpRequest.status === 500) error = "Error del Servidor" + XMLHttpRequest.status; // display some server error 
						$("#divcomplementos").html(error);
					},	
					success: function (msj) {

						var respuesta=msj.productofechas;
						var fecha=msj.fechaformato;
					   $(".fc-header-title").html('<h2>'+fecha+'</h2>');
					   $(".fc-day").each(function( index ) {
					   				  var elemento=$(this);
									  $(elemento).find('span').eq(0).remove();

								for (var i = 0; i <respuesta.length; i++) {
									
									 // console.log( index + ": " + $(this).data('date') );
									  var fechadiv=$(this).data('date');
						
									  	if (respuesta[i].fecha == fechadiv) {
									  		var html="";
									  		$(elemento).find('span').eq(0).remove();
									  		 html=`
											<span class="badge colordorado" style="float: right;font-size: 14px;">`+respuesta[i].cantidadproducto+`</span>
									  		`
									  		;
									  		//$(elemento).children().eq(0).css({'cssText': 'background: gray;border-radius: 30px;color: white; cursor:pointer;margin: auto;width:20%;padding-right: 1em;padding-left:1em;justify-content:center;display:flex;'});
											$(elemento).children().eq(0).prepend(html);
									  		
									  	}

									
								}
								});
						
					}
				});
}

function PintarProductosCalendario(respuesta) {
	var html="";
  if (respuesta.length>0) {
    $(".titulocitas").css('display','block');
    for (var i = 0; i < respuesta.length; i++) {

          imagen='catalogos/sucursal/imagenes/'+respuesta[i].imagen;
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
      	<div class="" style="    width: 100%;
    background: white;
    border-radius: 30%;
    height: 150px;
    padding-top: 1em;">
			<div class="">
			 <div class="col-md-2" style="
			    float: left;">
			            <a>
			            <img src="`+imagen+`" alt="" style="width: 100%;border-radius: 10px;">
			            </a>
			          </div>
			  <div class="col-md-6" style="
			    float: left;">
            <h6 class="item-title">
      
            <p style="margin:0;" onclick="AbrirModalCitaAdmin(`+respuesta[i].idcita+`)">`+respuesta[i].nombresucursal+`</a></p>



            </h6>
            <div class="">
                    <p style="margin:0;" onclick="AbrirModalCitaAdmin(`+respuesta[i].idcita+`)">`+respuesta[i].nombrepaquete+`</p>

            <p style="margin:0;">`+respuesta[i].nombre+` `+respuesta[i].paterno+`</p>
            <p style="margin:0;text-decoration: underline;" onclick="Detallepago(`+respuesta[i].idnotapago+`)">#`+respuesta[i].folio+`</p>
 
            </div>
            
          </div>
          <div class="col-md-4" style="float: left;">
          	<a class="bookmark-btn active" style="color:black;">
           	 <i class="fas fa-bookmark"></i>
            
          	</a>
          </div>
        </div>
      </div>

      `;


    }
  }

  $(".listadocitascalendario").html(html);
}

function Detallepago(idnotapago) {
	PintarDetalleHtml();
	var detalleimagen=[];


	var idusuario="";
	var datos="idnotapago="+idnotapago+"&id_user="+idusuario;
	var pagina = "ObtenerDetallePago.php";
	
		$.ajax({
		type: 'POST',
		dataType: 'json',
		url: 'catalogos/dashboard/'+pagina, //Url a donde la enviaremos
		data:datos,
		async:false,
		success: function(resp){
			var resultado=resp.respuesta[0];
     		 var subtotalnota=resp.subtotalnota;
     		 var idtipopago=resultado.idtipopago;
     		 var subtotalcupon=resp.subtotalcupon;

			$(".lblsubtotal").text(formato_numero(subtotalnota,2,'.',','));
			$(".lblcupon").text(formato_numero(subtotalcupon,2,'.',','));

			$("#lblnumeronota").text(resultado.folio);
			$(".lblresumen").text(formato_numero(resultado.subtotal,2,'.',','));
			$(".lblcomision").text(formato_numero(resultado.comisiontotal,2,'.',','));
			$(".lbltotal").text(formato_numero(resultado.total,2,'.',','));
			$(".lblmonedero").text(formato_numero(resultado.montomonedero,2,'.',','));
			$("#tipopago").text(resultado.tipopago);
			if (resultado.datostarjeta!='') {
			$(".datostarjeta").html(resultado.datostarjeta);
			$(".infodatostarjeta").append(resultado.datostarjeta2);

			}

			  if (resultado.descripcioncupon!=null && resultado.descripcioncupon!='' && resultado.idcupon>0) {

		        var cupon=`
		          <p style="color: #C7AA6A;text-align:center;font-size:15px;margin:0;" class="cambiarfuente">`+resultado.codigocupon+`</p>
		              <p style="color: #C7AA6A;text-align:center;" class="cambiarfuente">Descuento aplicado `+resultado.descripcioncupon+`</p>
		        `;

		        $(".cuponaplicado").html(cupon);
		      }

			if (resultado.requierefactura==1) {


				var html="";
				html+=`<p>
					Razon social: `+resultado.razonsocial+`
					
				</p>`;
				html+=`<p>
					RFC.: `+resultado.rfc+`</p>`;
			html+=`<p>
					Correo.: `+resultado.correo+`</p>`;
			html+=`<p>
					Cod. Postal: `+resultado.codigopostal+`</p>`;
					var imagenes=resultado.imagenconstancia;
					if (imagenes!='') {

					var imagen=imagenes.split(',');
					detalleimagen=imagen;
					var htmlimagenes="";
					for (var i = 0; i < imagen.length; i++) {
						        urlimagen=urlphp+`upload/datosfactura/`+imagen[i];

						html+=`
							<div class="row">
		                        <div class="col-20" style="margin:0;padding:0;">
		                          <figure class="avatar   rounded-10">
		                          <img src="`+urlimagen+`" alt="" style="width:60px;height:60px;" onclick="DetalleImagen(`+i+`)">
		                          </figure>
		                        </div>

                       		 </div>

						`;
					}
				}

					$(".datosfiscales").html(html);
				

			}

			$("#usuariopedido").text(resultado.usuariopedido);

			if (resultado.entregado==1) {

				$("#detallesdeentrega").css('display','block');
				$("#fechaentrega").text(resultado.fechaentrega);
				$("#observaciones").text(resultado.observacionesentrega);
				$("#usuarioentrega").text(resultado.usuarioentrega);


				

			}
			var pagos=resp.pagos;


			ObtenerTipodepagosCompletar(idtipopago);


			Pintarpagosdetalle2(pagos);
			 $("#visualizardescuentos").css('display','none');

			 $("#modaldetallenota").modal();
			/*var descuentos=resp.descuentos;
			if (descuentos.length>0) {
			Pintardescuentosdetalle(descuentos);	
			}

			var descuentosmembresia=resp.descuentosmembresia;
			if (descuentosmembresia.length>0) {
				Pintardescuentomembresiadetalle(descuentosmembresia);
			}

			var imagenescomprobante=resp.imagenescomprobante;

			if (imagenescomprobante.length > 0) {
				PintarImagenesComprobante(imagenescomprobante);
			}*/

		},error: function(XMLHttpRequest, textStatus, errorThrown){ 
			var error;
				if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
				if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
								//alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
								console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
		}

	});

}

function PintarDetalleHtml() {
	/**/

	var html=`
   <div class="col-md-12 divdetalle" style="display: block;">

	<div class="row">
	<div class="col-md-12">
	 <p style="text-align: center;font-size: 18px;" id="">
      <span style="font-weight: bold;">Pago</span> #<span id="lblnumeronota"></span></p>

    <span id="fechapago" style="text-align: center;
    font-size: 18px;
    justify-content: center;
    font-weight: bold;
    display: flex;margin-top: 1em;"></span>
						</div>
						
					</div>
					<div class="listadopagoselegidos" id="listadopagos"> 
					<li class="list-group-item  align-items-center" style="">
					   
					</div>

					<div>
						<ul class="list-group subtotal" style="display: block;">
									<li class="list-group-item  align-items-center" style="color:">
								   <div class="row">
								   <div class="col-md-12">
								   		<p id="" style="text-align:center;">Subtotal</p>
					                    <p class="" style="
											   text-align:center;
											">$<span id="lblsubtotal" class="lblsubtotal">0.00</span></p>
					                   </div>
					                   <div class="col-md-2">

										    <span class="badge ">
										    </span>
								   		 </div>
								    
								    </div>

								  </li>
								</ul>
							</div>


							<div>
						<ul class="list-group comision" style="display: block;">
									<li class="list-group-item  align-items-center" style="color:">
								   <div class="row">
								   <div class="col-md-12">
								   		<p id="" style="text-align:center;">Comisión</p>
					                    <p class="" style="
											   text-align:center;
											">$<span id="lblcomision" class="lblcomision">0.00</span></p>
					                   </div>
					                   <div class="col-md-2">

										    <span class="badge ">
										    </span>
								   		 </div>
								    
								    </div>

								  </li>
								</ul>
							</div>


								<div>
							<ul class="list-group divcupon" style="display: block;">
									<li class="list-group-item  align-items-center" style="color:">
								   <div class="row">
								   <div class="col-md-12">
								   		<p id="" style="text-align:center;">Cupón</p>
								   		</div>
								   		<div class="col-md-12">
								   		   <div class="cuponaplicado"></div>
								   		</div>
								   		<div class="col-md-12">

					                    <p class="" style="
											   text-align:center;
											">$<span id="lblcupon" class="lblcupon">0.00</span></p>
					                   </div>
					                   <div class="col-md-2">

										    <span class="badge ">
										    </span>
								   		 </div>
								    
								    </div>

								  </li>
								</ul>
							</div>

						<div>
							<ul class="list-group divmonedero" style="display: block;">
									<li class="list-group-item  align-items-center" style="color:">
								   <div class="row">
								   <div class="col-md-12">
								   		<p id="" style="text-align:center;">Monedero</p>
					                    <p class="" style="
											   text-align:center;
											">$<span id="lblmonedero" class="lblmonedero">0.00</span></p>
					                   </div>
					                   <div class="col-md-2">

										    <span class="badge ">
										    </span>
								   		 </div>
								    
								    </div>

								  </li>
								</ul>
							</div>

							




							



								<div>
								<ul class="list-group divtotal" style="display: block;">
									<li class="list-group-item  align-items-center" style="background: #aeb3b7;">
								   <div class="row">
								   <div class="col-md-12">
								   		<p id="" style="text-align:center;">Total</p>
					                    <p class="" style="text-align:center;">$<span id="" class="lbltotal">980.00</span></p>
					                   </div>
					                   <div class="col-md-2">

										    <span class="badge ">
										    </span>
								   		 </div>
								    
								    </div>

								  </li>
								</ul>
							</div>
							<div class="row">
								<div class="col-md-12 imagenescomprobante">
				

									</div>
							</div>

							<div class="row" style="margin-top:10px;">
								<div class="col-md-12">
									<label for="">MÉTODO DE PAGO:</label>
									<span id="tipopago"></span>
								</div>
								<div class="col-md-12">

								  <div class="datostarjeta" style="float: left;"></div>
               					  <div class="infodatostarjeta"></div>
               					  </div>
								
								
							</div>

								
							<div class="requierefactura" style="display:none;">
								<div class="row">
									<div class="col-md-12">
										<label for="">REQUIERE FACTURA:</label>
									<span id="requierefactura"></span>
								</div>
								</div>
							</div>


								<div class="foliofacturacion" style="display: none;">
								<div class="row">
									<div class="col-md-12">
										<label for="">FOLIO DE FACTURA:</label>
									<span id="foliofactura"></span>
								</div>
								</div>
							</div>

								<div class="fechafac" style="display: none;">
								<div class="row">
									<div class="col-md-12">
										<label for="">FECHA DE FACTURA:</label>
									<span id="fechafactura"></span>
								</div>
								</div>
							</div>

							<!-- <div class="row">
								<div class="col-md-12">
									<button class="btn btn-success btncambiarestatus" onclick="">ACEPTAR PAGO</button>
								</div>
							</div> -->

									<div class="row">
          					<div class="col-md-12">
					          <label>
					       		PEDIDO DE:
					            
					          	 </span>
					         	 <span id="usuariopedido">
					        	</label>

				       		 </div>
				        </div>

							</div>

					
	

    </div>
	`;

	$("#divdetallenota").html(html);
}

function Pintarpagosdetalle2(listado) {
		// body...
		var html="";
		for (var i = 0; i <listado.length; i++) {

			var color='';
		      if (listado[i].monto<0) {
		        color='red';
		      }
		imagen='catalogos/paquetes/imagenespaquete/'+listado[i].foto;

			html+=`
				
			<div class="row" style="border: 1px solid #cacaca;padding: 10px; margin: 1px 1px 0px 1px; justify-content: space-between;display: flex;">
              <div class="col-md-4" style="width: 40%;">
             	 <img src="`+imagen+`" alt="" style="width: 150px;">
              </div>
              <div class="col-md-8" style="width: 60%;">
                <div class="row" style="margin-left: 1em;">
                  <div class="col-md-6">
                   	    <p style="margin:0;"> `+listado[i].concepto+` </p>
           
                     	<p style="margin:0;">Cantidad: `+listado[i].cantidad+`</p>`;

                     	if (listado[i].usuarioespecialista!='' && listado[i].usuarioespecialista!=null) {
                     		html+=`<p style="margin:0;">Especialista: `+listado[i].usuarioespecialista+`</p>`;
                     		html+=`<p style="margin:0;">Fecha: `+listado[i].fecha+`</p>`;
                      	}

                      	   if (listado[i].concortesia==1  ) {


                          if (listado[i].idcortesia>0 ) {

                          html+=`


                         <div class="icon-text-container" style="">

                           <p style="margin:0;">Cortesía: <span class="texto">`+listado[i].nombrepaquetecortesia+`</span></p>

                           </div>`;

                      }


                      if (listado[i].idcortesia==0 && listado[i].colococortesia==1) {

                          html+=`


                         <div class="icon-text-container" >

                           <p style="margin:0;">Cortesía: <span class="texto">Ninguna</span></p>

                           </div>`;
                      }
                  }
              		 html+= `</div>
                 
	                   	<div class="col-md-6">
	                	 <p class="text-muted " style="font-size:20px;margin:0px;">$`+formato_numero(listado[i].monto,2,'.',',')+`</p>
	                     
	                  	</div>

                    </div>	
                  </div> 
                 </div>

              
            </div>

			`;
		}


		$(".listadopagoselegidos").html(html);


		
	}


	function PintarCalendario3() {

	//alert( yyyy+'-'+mm+'-'+dd);
   // var calendarEl = document.getElementById('picker');

   // var calendar = new FullCalendar.Calendar(calendarEl, {
	$('#picker3').fullCalendar({
        header: {
        	left:'prev',
            center: 'title',
            right: 'next',

        },
            locale:'es',
        	monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio","Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
			monthNamesShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Agost","Sept", "Oct", "Nov", "Dic"],
			dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles','Jueves', 'Viernes', 'Sabado'],
			dayNamesShort: ["Dom", "Lun", "Mar", "Mier", "Jue", "Vier", "Sab", "Dom"],
        firstDay:0,
        defaultDate: yyyy+'-'+mm+'-'+dd,
       eventLimit: true, // allow "more" link when too many events 
        events: [
           
        ],
        dayClick: function (date, jsEvent, view) {
           console.log('Has hecho click en: '+  date.format());
         

            var fecha=date.format();
            idespecialistaseleccionado='';
			horarioseleccionado='';
          
            fechaconsulta=fecha;

         PintarHoraSeleccionada(fecha);
         PintarFechaSeleccionada2(fecha);
			//ObtenerHorariosDia(3);
		$(".divintervaloshorarios").css('display','block');
		$(".fc-header-title").html('<h2>'+fechaformato(fecha)+'</h2>');
		VerificarSiLlevavalor();


        }, 
        eventClick: function (calEvent, jsEvent, view) {
            $('#event-title').text(calEvent.title);
            $('#event-description').html(calEvent.description);
            $('#modal-event').modal();

        }, 

       
	});

  //  calendar.render();
	 var fecha=new Date();
	 var f=fecha.toISOString().split('T')[0];
	
	 var anio=f.split('-')[0];
	 var mes=f.split('-')[1];

	 ObtenerFechasCalendario(anio,mes);
	 $("#recargar").attr('onclick','ObtenerFechasCalendario('+anio+','+mes+')');
	 $("#txttitle").css('display','none');
	//$(".fc-header-title").html('<h2>'+fechaformato(fecha)+'</h2>');
	//PintarFechaActual();

 $('.fc-button-prev').click(function(){

          var moment = $('#picker3').fullCalendar('getDate');
      
          var cadenafecha=moment.format().split('-');
       
       	   var anio=cadenafecha[0];
           var mes=cadenafecha[1];
           var dia=cadenafecha[2];

           var mes = parseInt(cadenafecha[1], 10);

			// Restamos uno al mes (considerando que los meses van de 1 a 12)
			mes++;

			// Si el mes resultante es cero, establecemos el valor de mes a 12 (diciembre del año anterior)
			if (mes === 0) {
			  mes = 12;
			  cadenafecha[0]--; // Restamos uno al año si retrocedemos desde enero
			}

			// Convertimos nuevamente el mes a cadena y le agregamos un cero adelante si es necesario
			var mesStr = mes.toString().padStart(2, '0');



            var fecha=anio+'-'+mesStr+'-'+dia;
            var mes=cadenafecha[1];
	
	 	 ObtenerFechasCalendario(anio,mes);
	 	
		//$(".fc-header-title").html('<h2>'+fechaformato(fecha)+'</h2>');

	   $("#txttitle").css('display','none');
	   $(".horarios").css('display','none');
  });

  $('.fc-button-next').click(function(){
     var moment = $('#picker3').fullCalendar('getDate');
       	   var cadenafecha=moment.format().split('-');
      	   var anio=cadenafecha[0];
           var mes=cadenafecha[1];
           var dia=cadenafecha[2];
          	console.log(mes);
            var mes = parseInt(cadenafecha[1], 10);
            if (mes<12) {
			// Restamos uno al mes (considerando que los meses van de 1 a 12)
			mes++;

			// Si el mes resultante es cero, establecemos el valor de mes a 12 (diciembre del año anterior)
			if (mes === 0) {
			  mes = 12;
			  cadenafecha[0]--; // Restamos uno al año si retrocedemos desde enero
			}
			
				
			}

			// Convertimos nuevamente el mes a cadena y le agregamos un cero adelante si es necesario
			var mesStr = mes.toString().padStart(2, '0');
            var fecha=anio+'-'+mesStr+'-'+dia;
            console.log(fecha);
             var mes=cadenafecha[1];

	    	 ObtenerFechasCalendario(anio,mes);
	    

	     $("#txttitle").css('display','none');
	     $(".horarios").css('display','none');
  });


  $(".fc-rigid").css('height','30px');
  $(".fc-day-grid-container").css('height','144.9px');
  $(".fc-day-top .fc-day-number").css({'cssText':'margin: 5em!important;'});

  $(".fc-day-header").css('text-align','center');
  $(".fc-day-top ").css({'cssText':'text-align: center!important;'});

  $(".fc-header-right").css('visibility','visible');

  //$(".fc-header-left .fc-corner-right").css('display','none');
  $(".fc-button-today").css('display','none');



}

function ObtenerFechasCalendario(anio,mes) {
	

	var datos="idsucursal="+idsucursal+"&mes="+mes+"&anio="+anio;
	var pagina = "ObtenerFechasSucursal.php";
	
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: 'catalogos/citas/'+pagina, //Url a donde la enviaremos
		data:datos,
		success: function(msj){
			
				var respuesta=msj.disponible;
						var fecha=msj.fechaformato;
					$(".fc-header-title").html('<h2>'+fecha+'</h2>');
							$(".fc-day").each(function( index ) {
								var elemento=$(this);

								$(elemento).find('span').eq(0).remove();

								for (var i = 0; i <respuesta.length; i++) {
									

									  var fechadiv=$(this).data('date');

											console.log(respuesta[i]);
									  	if (respuesta[i] == fechadiv) {
									  		  console.log(elemento);
									  		  $(this).addClass('disponible');
									  		
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
	
}
function PintarHoraSeleccionada(fecha,horaselect) {

fechaseleccionada=fecha;

	var datos="fecha="+fecha+"&idsucursal="+idsucursal+"&idpaquete="+idpaquete+"&horaselect="+horaselect;

	var pagina="ObtenerDisponibilidadPaqueteEspecialista.php";
		$.ajax({
		type: 'POST',
		dataType: 'json',
		url: 'catalogos/citas/'+pagina, //Url a donde la enviaremos
		data:datos,
		async:false,
		success: function(msj){
			horarioseleccionado=0;
			
				var intervalos=msj.intervalos;
				PintarIntervalos(intervalos);
				VerificarSiLlevavalor();			

			},error: function(XMLHttpRequest, textStatus, errorThrown){ 
				var error;
				  	if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
				  	if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
								//alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
					console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
			}
		});

}

function PintarIntervalos(respuesta) {
		var html="";
		if (respuesta.length>0) {
			for (var i = 0; i < respuesta.length; i++) {
					
				html+=`
								<label class="btn btn_dorado btncategointervalo1 horariossele" data-hora="`+respuesta[i].horainicial+`" data-horafinal="`+respuesta[i].horafinal+`" id="catebtn_`+i+`" style="margin: 10px;">
								    <input type="checkbox" id="cate_15" class="catecheck" onchange="SeleccionarHorario('`+respuesta[i].horainicial+`','`+respuesta[i].horafinal+`','`+i+`')" value="0" >`+respuesta[i].horainicial+`
								  </label>
				`;
			}
		}

	$(".liintervalos").html(html);
}

function SeleccionarHorario(horainicial,horafinal,i) {
	 
	 $(".horariossele").removeClass('active');

  $("#catebtn_"+i).add('active');
  horainicialsele=horainicial;
  horafinalsele=horafinal;
  horarioseleccionado=horainicialsele+'_'+horafinalsele;
//horaseleccionada=arrayhorarios[posicion];

   //HabilitarBoton2();
//aqui
idespecialistaseleccionado="";
  ObtenerListadoEspecialista();
  VerificarSiLlevavalor();
}


function SeleccionarHorario3(horainicial,horafinal,i,idespecialista) {
	 
	 $(".horariossele").removeClass('active');

  $("#catebtn_"+i).add('active');
  horainicialsele=horainicial;
  horafinalsele=horafinal;
  horarioseleccionado=horainicialsele+'_'+horafinalsele;
//horaseleccionada=arrayhorarios[posicion];

   //HabilitarBoton2();
//aqui
idespecialistaseleccionado=idespecialista;
  ObtenerListadoEspecialista(idespecialista);
  VerificarSiLlevavalor();
}

function ObtenerListadoEspecialista(idespecialistasele) {
	

    var horario=horainicialsele+'_'+horafinalsele;
    var datos='idsucursal='+idsucursal+"&idpaquete="+idpaquete+"&horaseleccionada="+horario+"&fecha="+fechaseleccionada+"&idespecialistasele="+idespecialistasele;
    var pagina = "ObtenerEspecialistaPaqueteSucursal.php";
    $.ajax({
    type: 'POST',
    dataType: 'json',
				url: 'catalogos/citas/'+pagina, //Url a donde la enviaremos
    async:false,
    data:datos,
    success: function(datos){
      var especialistas=datos.especialista;
      PintarDetalleEspecialistas(especialistas);
     // PintarDetalleEspecialistas2(especialistas);

    },error: function(XMLHttpRequest, textStatus, errorThrown){ 
      var error;
        if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
        if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
                console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
          }
    });

}

function PintarDetalleEspecialistas(especialistas) {
	var html="";
	html+=`<div class="list-group">`;
						if (especialistas.length>0) {
							for (var i = 0; i <especialistas.length; i++) {
								html+=`

					  		<a  class="list-group-item list-group-item-action especialistalista" id="especialista_`+especialistas[i].idespecialista+`" onclick="SeleccionarEspecialista(`+especialistas[i].idespecialista+`)" style="background:#c7aa6a;color:white;margin-bottom: 1em;margin-top: 1em;">
					    		<div class="row">

					    			<div class="col-md-4 justify-content-between">
					      		<img src="`+especialistas[i].foto+`" style="width:100px;">
					      	</div>

					    		<div class="col-md-4 justify-content-between">
					      		`+especialistas[i].nombre+` `+especialistas[i].paterno+`
					      	
					    		</div>
					    	</div>
					  		</a>
								`;

							}
						}

	html+=`</div>`;

	$(".seleccionarbarbero").html(html);
}

function SeleccionarEspecialista(idespecialista) {
	$(".especialistalista").removeClass('active');

	$("#especialista_"+idespecialista).addClass('active');
	idespecialistaseleccionado=idespecialista;
	VerificarSiLlevavalor();
}

function VerificarSiLlevavalor() {
	var pasa=1;
	
	if (fechaseleccionada=='') {
		pasa=0;
	}

	if (horarioseleccionado=='' || horarioseleccionado==0) {
		pasa=0;
	}
	if (idespecialistaseleccionado=='') {
		pasa=0;
	}

	if (pasa==1) {

		$(".btnguardarreagenda").css('display','block');
	}else{

		$(".btnguardarreagenda").css('display','none');

	}
}


function GuardarReagenda(idcita) {
	
    var datos='horarioseleccionado='+horarioseleccionado+'&fechaseleccionada='+fechaseleccionada+'&idespecialistaseleccionado='+idespecialistaseleccionado+'&idcita='+idcita;
    	datos+='&idcortesiaseleccionado='+idcortesiaseleccionado+"&valorseleccionado="+valorseleccionado;
    var pagina = "GuardarReagenda.php";
   if(confirm("\u00BFDesea realizar esta operaci\u00f3n?"))
	{
	$('#main').html('<div align="center" class="mostrar"><img src="images/loader.gif" alt="" /><br />Procesando...</div>')
				
		setTimeout(function(){
			    $.ajax({
			    type: 'POST',
			    dataType: 'json',
				url: 'catalogos/citas/'+pagina, //Url a donde la enviaremos
			    async:false,
			    data:datos,
			    success: function(resp){
			    if (resp.respuesta==1) {

			    	var mensaje="Operación realizada con éxito";
			    	aparecermodulos('catalogos/dashboard/vi_dashboard.php?ac=1&msj='+mensaje,'main');

				}

			    },error: function(XMLHttpRequest, textStatus, errorThrown){ 
			      var error;
			        if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
			        if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
			                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
			                console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
			          }
			    });
    	},1000);

    }
}

function GuardarCancelacion(idcita) {
	  var datos='idcita='+idcita;
    var pagina = "RealizarCancelacionAdmin.php";

    AbrirModalCancelacion(idcita);
  /* if(confirm("\u00BFDesea realizar esta operaci\u00f3n?"))
	{
	$('#main').html('<div align="center" class="mostrar"><img src="images/loader.gif" alt="" /><br />Procesando...</div>')
				
		setTimeout(function(){
			    $.ajax({
			    type: 'POST',
			    dataType: 'json',
				url: 'catalogos/citas/'+pagina, //Url a donde la enviaremos
			    async:false,
			    data:datos,
			    success: function(resp){
			    if (resp.respuesta==1) {

			    	var mensaje="Operación realizada con éxito";
			    	aparecermodulos('catalogos/citas/cancelarcita.php?idcita='+idcita+"&ac=1&msj="+mensaje,'main');
				}

			    },error: function(XMLHttpRequest, textStatus, errorThrown){ 
			      var error;
			        if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
			        if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
			                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
			                console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
			          }
			    });
    	},1000);

    }*/
}


function AbrirModalCancelacion(idcita) {
	$("#modalcancelacion").modal();
}

function CancelacionAdmin(idcita,idusuario) {

    var pagina = "RealizarCancelacionAdmin.php";
    var motivocancela=$("#v_motivocancelacion").val();
    var datos="motivocancela="+motivocancela+"&idcita="+idcita+"&idusuarios="+idusuario;
		$("#modalcancelacion").modal('hide');

	    $.ajax({
			    type: 'POST',
			    dataType: 'json',
				url: 'catalogos/citas/'+pagina, //Url a donde la enviaremos
			    async:false,
			    data:datos,
			    success: function(resp){
				$(".modal-backdrop").hide();
			    if (resp.respuesta==1) {
			    	var montoamonedero=resp.montoamonedero;
			    	var mensaje="Operación realizada con éxito";
			    	if (montoamonedero>0 && montoamonedero!=null) {
			    		mensaje+="<br>El monto de $"+montoamonedero+" se agregó al monedero";
			    		}
			    	aparecermodulos('catalogos/dashboard/vi_dashboard.php?idcita='+idcita+"&ac=1&msj="+mensaje,'main');
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

function ListadoCitasRealizadas() {
	$("#mostrarcitasrealizadas").css('display','block');

	CargarCitasRealizadas();
}


function CargarCitasRealizadas() {
	$.ajax({
					url: 'catalogos/dashboard/CargarCitasActuales.php', //Url a donde la enviaremos
					type: 'POST', //Metodo que usaremos
					dataType:'json',
					error: function (XMLHttpRequest, textStatus, errorThrown) {
						var error;
						console.log(XMLHttpRequest);
						if (XMLHttpRequest.status === 404) error = "Pagina no existe" + XMLHttpRequest.status; // display some page not found error 
						if (XMLHttpRequest.status === 500) error = "Error del Servidor" + XMLHttpRequest.status; // display some server error 
						$("#divcomplementos").html(error);
					},	
					success: function (msj) {
						var citas=msj.realizadas;
						console.log(citas);
						PintarCitasRealizadas(citas);	
					}
				});
}

function PintarCitasRealizadas(respuesta) {
var html="";
  if (respuesta.length>0) {
    $(".titulocitas").css('display','block');
    for (var i = 0; i < respuesta.length; i++) {

          imagen='';
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

  $(".listadocitasrealizadas").html(html);
}

function CerrarCitasRealizadas() {
	$("#mostrarcitasrealizadas").css('display','none');

}


function ObtenerHorariosDia(operacion){

	var datos="operacion="+operacion+"&fecha="+fechaconsulta;
		$.ajax({
					url: 'catalogos/dashboard/ObtenerHorariosFechaDia.php', //Url a donde la enviaremos
					type: 'POST', //Metodo que usaremos
					dataType:'json',
					data:datos,
					async:false,
					error: function (XMLHttpRequest, textStatus, errorThrown) {
						var error;
						console.log(XMLHttpRequest);
						if (XMLHttpRequest.status === 404) error = "Pagina no existe" + XMLHttpRequest.status; // display some page not found error 
						if (XMLHttpRequest.status === 500) error = "Error del Servidor" + XMLHttpRequest.status; // display some server error 
						$("#divcomplementos").html(error);
					},	
					success: function (msj) {
						PintarDia(msj);
				}
			});

}

function ObtenerSucursalesDashBoard() {
	
	$.ajax({
		url:'catalogos/pagos/Obtenersucursales.php', //Url a donde la enviaremos
	  type:'POST', //Metodo que usaremos
	 dataType:'json',
	  error:function(XMLHttpRequest, textStatus, errorThrown){
			var error;
			console.log(XMLHttpRequest);
			if (XMLHttpRequest.status === 404)  error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error 
		 	if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error 
			$('#abc').html('<div class="alert_error">'+error+'</div>');	
			//aparecermodulos("catalogos/vi_ligas.php?ac=0&msj=Error. "+error,'main');
		},
	  success:function(msj){
	  	var respuesta=msj.respuesta;
		
	  			PintarSucursalesDasboard(respuesta);
			}
	});
}

function PintarSucursalesDasboard(resp) {
	var html="";
	if (resp.length>0) {
		//CrearSesionSucursal(resp[0].idsucursal);
		for (var i = 0; i <resp.length; i++) {
			
			//html+=`<option value="`+resp[i].idsucursal+`">`+resp[i].titulo+`</option>`;
			html+=`
			<div class="col-xl-3 col-md-4">
				<label class="btn btn_dorado catesucursal " onclick="GuardarSucursalFiltro(`+resp[i].idsucursal+`)" id="catebtn_`+resp[i].idsucursal+`" style="margin-right: 10px;width:100%;
    height: 36px;">`+resp[i].titulo+`
				<input type="checkbox" style="display: none;" id="cates_`+resp[i].idsucursal+`" class="catecheck"  value="0">
			 </label>
			</div>

			`;

		}
	}
	$(".v_sucursal").html(html);
}

function VisualizarListado() {
	$(".divintervaloshorarios").css('display','none');
	$(".divlistadoentrega").css('display','block');
	ObtenerListadoPendienteporentregar();
	ObtenerListadoentregados();
}
function Visualizarintervalos(){
	$(".divintervaloshorarios").css('display','block');
	$(".divlistadoentrega").css('display','none');
}
function ObtenerListadoPendienteporentregar() {
	var datos="fechaconsulta="+fechaconsulta;
	
	$.ajax({
		url:'catalogos/dashboard/ObtenerListadoPendienteporentregar.php', //Url a donde la enviaremos
	  type:'POST', //Metodo que usaremos
	 dataType:'json',
	 data:datos,
	  error:function(XMLHttpRequest, textStatus, errorThrown){
			var error;
			console.log(XMLHttpRequest);
			if (XMLHttpRequest.status === 404)  error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error 
		 	if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error 
			$('#abc').html('<div class="alert_error">'+error+'</div>');	
			//aparecermodulos("catalogos/vi_ligas.php?ac=0&msj=Error. "+error,'main');
		},
	  success:function(msj){
	  	var respuesta=msj.porentregar;
	  	PintarDatospendientes(respuesta);
		
	  			
			}
	});
}

function PintarDatospendientes(respuesta) {
	var html="";
	if (respuesta.length>0) {
		for (var i = 0; i < respuesta.length; i++) {
				entregado="<span style='font-size:20px;color:red;' class='mdi mdi-close-circle'></span> ";

			if (respuesta[i].entregado==1) {
				entregado="<span style='font-size:20px;color:green;' class='mdi mdi-checkbox-marked-circle'></span>";
			}
			pagado="<span style='font-size:20px;color:red;' class='mdi mdi-close-circle'></span> ";
			if (respuesta[i].estatusnota==1) {
					pagado="<span style='font-size:20px;color:green;' class='mdi mdi-checkbox-marked-circle'></span>";
			}

				html+=`

				<tr>
      <td style="width: 20%;">`+respuesta[i].cliente+`</td>
      <td style="width: 20%;">`+respuesta[i].folio+`</td>

      <td style="width: 30%;">`+respuesta[i].descripcion+`</td>
        <td style="width: 10%;text-align:center;">`+respuesta[i].cantidad+`
      	 </td>
      <td style="width: 20%;text-align:center;">`+pagado+`</td>
          <td style="width: 20%;text-align:center;">`+entregado+`</td>

      <td style="width: 20%;">`;
      if (respuesta[i].estatusnota==0) {
    html+=`  <button type="button" onclick="PagarNotaCita(`+respuesta[i].idnotapago+`,1)" class="btn btn-primary" style="" title="Detalle">
					<i class="mdi mdi-email-outline"></i>
						</button>`;

		}

		 if (respuesta[i].estatusnota==1) {
    
    	html+=`  <button type="button" onclick="PagarNotaCita(`+respuesta[i].idnotapago+`,3)" class="btn btn-primary" style="" title="Detalle">
					<i class="mdi mdi-email-outline"></i>
						</button>`;

		}


    html+=`  </td>	
    </tr>

				`;
		}
	}

	$("#tblproductospendientes").html(html);

	 
}

function ObtenerListadoentregados() {
		var datos="fechaconsulta="+fechaconsulta;

	$.ajax({
		url:'catalogos/dashboard/ObtenerListadoentregados.php', //Url a donde la enviaremos
	  type:'POST', //Metodo que usaremos
	 dataType:'json',
	 data:datos,
	 async:false,
	  error:function(XMLHttpRequest, textStatus, errorThrown){
			var error;
			console.log(XMLHttpRequest);
			if (XMLHttpRequest.status === 404)  error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error 
		 	if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error 
			$('#abc').html('<div class="alert_error">'+error+'</div>');	
			//aparecermodulos("catalogos/vi_ligas.php?ac=0&msj=Error. "+error,'main');
		},
	  success:function(msj){
	  	var respuesta=msj.entregados;
		
	  			PintarDatosEntregados(respuesta);
			}
	});
}

function PintarDatosEntregados(respuesta) {
	var html="";
	if (respuesta.length>0) {
		for (var i = 0; i < respuesta.length; i++) {
			entregado="<span style='font-size:20px;color:red;' class='mdi mdi-close-circle'></span> ";

			if (respuesta[i].entregado==1) {
				entregado="<span style='font-size:20px;color:green;' class='mdi mdi-checkbox-marked-circle'></span>";
			}
			pagado="<span style='font-size:20px;color:red;' class='mdi mdi-close-circle'></span> ";
			if (respuesta[i].estatusnota==1) {
					pagado="<span style='font-size:20px;color:green;' class='mdi mdi-checkbox-marked-circle'></span>";
			}

				html+=`

	 <tr>
      <td style="width: 20%;">`+respuesta[i].cliente+`</td>
      <td style="width: 20%;">`+respuesta[i].folio+`</td>

      <td style="width: 20%;">`+respuesta[i].descripcion+`</td>
        <td style="width: 5%;">`+respuesta[i].cantidad+`
      	 </td>
      <td style="width: 20%;text-align:center;">`+pagado+`</td>
          <td style="width: 20%;text-align:center;">`+entregado+`</td>

      <td style="width: 20%;">

      			<button type="button" onclick="PagarNotaCita(`+respuesta[i].idnotapago+`,4)" class="btn btn-primary" style="" title="Detalle">
								<i class="mdi mdi-dropbox"></i>
				</button>

		      </td>	
		    </tr>

				`;
		}
	}

	$("#tblproductosentregados").html(html);

	 
}

function OcultarModal() {
	$("#modalelegircliente").modal('hide');
}

function CambiarCortesia(idcita,idpaquete) {
	$("#modaldetallecita").modal('hide');


	 $('#modal-forms2').on('shown.bs.modal', function () { 
 
	   		$("#picker4").fullCalendar('render');
			$("#step2").css('display','none');
			//ConsultarFechasCalendarioA();
			});

	 		
  				
	var pagina = "escogercortesia.php";
  
	var datos="idpaquete="+idpaquete+"&idcita="+idcita;
	$.ajax({
		type: 'POST',
		url:'catalogos/citas/'+pagina, //Url a donde la enviaremos
		async:false,
		data:datos,
		success: function(resp){

			$("#contenedor-modal-forms2").html(resp);

			$("#step2").css('display','block');
			//var button=`<button class="btn btn-success" onclick="GuardarCliente('form_usuario','catalogos/clientes/vi_clientes.php','main','catalogos/clientes/ga_clientes.php',0)">GUARDAR</button>`;
			$("#footer-modal-forms2").css('display','none');
			$("#titulo-modal-forms2").text('Servicios');
			$("#titulo-modal-forms2").addClass('titulomodalcita');
			$("#modal-footer").css('display','none');
			$("#modal-forms2").modal();
		
	

			},error: function(XMLHttpRequest, textStatus, errorThrown){ 
				var error;
				  	if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
				  	if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
								//alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
					console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
			}
		});
}