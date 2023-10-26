var fechaconsulta="";
var idsucursal="";
var horainicial="";
var horafinal="";
var fechaseleccionada="";
var horainicialsele="";
var idespecialistaseleccionado=0;
var horarioseleccionado="";

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
			//ObtenerHorariosDia(3);
		$(".divintervaloshorarios").css('display','block');
		$(".fc-header-title").html('<h2>'+fechaformato(fecha)+'</h2>');
		if (NtabName=='citas') {
			  ObtenerFechaEspe(fecha);

			}else{
				ObtenerFechasProductos(fecha);

				// ObtenerProductosFechasCalendario(anio,mes);
			}

			PintarFechaSeleccionada(fecha);

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
	$(".fc-header-title").html('<h2>'+fechaformato(fecha)+'</h2>');
	//PintarFechaActual();

 $('.fc-button-prev').click(function(){

          var moment = $('#picker2').fullCalendar('getDate');
      
          var cadenafecha=moment.format().split('-');
        console.log(cadenafecha);
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

											console.log(respuesta[i]);
									  	if (respuesta[i].fecha == fechadiv) {
									  		  console.log(elemento);

									  		var html="";
									  		 html=`
											<span class="badge colornegro" style="float: right;font-size: 14px;">`+respuesta[i].cantidadcitas+`</span>
									  		`
									  		;
									  		console.log(html);
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
							 htmlintervalo=`<div class="col-md-12" style="height:`+pxintervalo+`px;margin-top: 1px;text-align:center; display: flex;justify-content: center; align-items: center;">`+intervalos[i]+`</div>`;
							 $("#intervalos").append(htmlintervalo);
						}

						var htmlzonas="";
						var htmlespacio="";
						for (var i = 0; i <zonas.length; i++) {
							htmlzonas=` <div style="padding-top: 1em;width: 100px;height: 50px;font-weight:bold;text-align:center;">`+zonas[i].nombre+`</div>`;

							$("#zonasdiv").append(htmlzonas);

							htmlespacio=`<div id="espacio_`+zonas[i].idzona+`" style="width: 100px;text-align:center;"></div>`;

							$("#espacios").append(htmlespacio);


							var intervalos=zonas[i].intervalos;
							var htmlintervalos="";
								var servicioante="";
								for (var j = 0; j<intervalos.length; j++) {
									var pxintervalo=msj.pxintervalo;
									var servicio=intervalos[j].servicio;
									var titulo="Disponible";
									var colorfondo="background:#59c158;";
									var borderradiustop="border-right: 1px solid white;";
									var borderradiusbootom=" ";
									var servicioac="";
									marginbottom="margin-bottom: 1px;";
									margintop="margin-top: 1px;";
									alineacion="";
									var funcion="";
									if (intervalos[j].disponible==0) {
										funcion="DetalleServicioDash("+servicio[0].idservicio+")";
										console.log(funcion);
									 //borderradiusbootom=" border-bottom: 1px solid white;";

										colorfondo="background:"+zonas[i].color;
										servicioac=servicio[0].idservicio;
										titulo="";
										 marginbottom="border-bottom: 1px solid "+zonas[i].color+";";
										 margintop="border-top: 1px solid "+zonas[i].color+";";
											if (servicioante!=servicioac) {

													if (servicio.length) {
													
													titulo=servicio[0].horainicial+` - `+servicio[0].horafinal;
													titulo+=`<br>`+servicio[0].titulo;
													servicioante=servicio[0].idservicio;

													}
											}else{
												pxintervalo=pxintervalo+2;
											
											borderradiustop="";	
											borderradiusbootom=" border-right: 1px solid white;";
											
											}

									}else{
									alineacion="align-items: center;";
									borderradiustop="border-right: 1px solid white;";
									//borderradiusbootom=" border-bottom: 1px solid white;";
									servicioante="";
									}
								
								
									htmlintervalos=`<div style="height:`+pxintervalo+`px;`+colorfondo+`;`+margintop+marginbottom+`font-size:10px; display: flex;justify-content: center;color:white;font-weight:bold;`+alineacion+borderradiustop+borderradiusbootom+`" onclick="`+funcion+`">`+titulo+`</div>`;
								$("#espacio_"+zonas[i].idzona).append(htmlintervalos);

								}

						}





						
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


function DetalleServicioDash(idservicio) {
	
	$("#modalServicios").modal();
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
				});
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
						var total=citas.length;
						var realizadas=msj.realizadas;
						$("#citasregistros").text(total);
						 var notas=msj.notas;
						$("#productosregistros").text(notas.length);

						$("#citasregistrosrealizadas").text(realizadas.length);
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
	var imagen=`catalogos/sucursal/imagenes/`+respuesta.imagen;

	var html2="";

	

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
                    <div class="card-header">
                        <div class="row">
                            
                            <div class="col-50">
                                <h3 class="no-margin-bottom text-color-theme">`+respuesta.titulo+`</h3>
                            	<p class="no-margin-bottom text-color-theme">`+respuesta.descripcion+`</p>

                            	<p class="no-margin-bottom text-color-theme">`+respuesta.fechaformato+`</p>
                            	<p class="no-margin-bottom text-color-theme">`+respuesta.horainicial+`-`+respuesta.horafinal+`Hrs.</p>

                            	<p class="no-margin-bottom text-color-theme">Cliente: `+respuesta.nombre+` `+respuesta.paterno+`</p>`;
                            	html+=` <p class="no-margin-bottom text-color-theme">`+respuesta.concepto+`</p>`;
                          if (respuesta.concortesia==1  ) {


                          if (respuesta.idcortesia>0 ) {

                          html+=`


                         <div class="icon-text-container" style="margin-top: 10px;">

                           <p style="margin:0;">Cortesía: <span class="texto">`+respuesta.nombrepaquetecortesia+`</span></p>

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

							</div>

						</div>

						<div class="col-100" onclick="scanqr()" >
						

						</div>

					</div>

					<div class="row" style=" ">
						<div class="col-md-12">
						<p style="font-size: 16px;font-weight: bold;">Galeria de imágenes</p>
						</div>
						<div class="col-md-12">
						
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
          
		$("#divdetallecita").html(html);

		$("#modaldetallecita").modal();
		$(".btnreagendarcita").css('display','block');
		$(".btncancelarcita").css('display','block');

		                if(respuesta.checkin==1) {
						$(".btnreagendarcita").css('display','none');
		                }

		                if(respuesta.checkin==1) {
						$(".btncancelarcita").css('display','none');
		                }
		$(".btnreagendarcita").attr('onclick','ReagendarCita('+respuesta.idcita+')');
		$(".btncancelarcita").attr('onclick','CancelarCita('+respuesta.idcita+')');

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
			var pagos=resp.pagos;

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

								
							<div class="requierefactura">
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
	$(".fc-header-title").html('<h2>'+fechaformato(fecha)+'</h2>');
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
function PintarHoraSeleccionada(fecha) {

fechaseleccionada=fecha;

	var datos="fecha="+fecha+"&idsucursal="+idsucursal+"&idpaquete="+idpaquete;

	var pagina="ObtenerDisponibilidadPaqueteEspecialista.php";
		$.ajax({
		type: 'POST',
		dataType: 'json',
		url: 'catalogos/citas/'+pagina, //Url a donde la enviaremos
		data:datos,
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
								<label class="btn btn_dorado btncategointervalo1 horariossele" id="catebtn_`+i+`" style="margin: 10px;">
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

function ObtenerListadoEspecialista() {
	

    var horario=horainicialsele+'_'+horafinalsele;
    var datos='idsucursal='+idsucursal+"&idpaquete="+idpaquete+"&horaseleccionada="+horario+"&fecha="+fechaseleccionada;
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
			    	aparecermodulos('catalogos/citas/reagendarcita.php?idcita='+idcita+"&ac=1&msj="+mensaje,'main');
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

    }
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