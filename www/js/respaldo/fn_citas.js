var idusuarioagenda=0;
var idsucursalagenda=0
var idtipodepagoseleccionado=0;
function ObtenerCategoriasPaquete() {
	
		$.ajax({
					url:'catalogos/citas/ObtenerCategorias.php', //Url a donde la enviaremos
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
							var respuesta=msj.categoriaspaquete;
							PintarCategoriasPrincipal(respuesta);
					  	}
				  });
	 	
}

function PintarCategoriasPrincipal(respuesta) {
         
var html = `
              `;

            var itemsPerSlide = 3; // Número de tarjetas por slide
            var totalItems = respuesta.length;
            var activeClass = "active"; // Para la primera tarjeta


                for (var j = 0;j<respuesta.length ;j++) {
                    var foto = respuesta[j].ruta;
                    console.log(respuesta[j].sub);
                    if (respuesta[j].sub>0) {
  					html += `<div class="col-md-2 ${activeClass}"><div class="d-flex">`;

  					funcion="DetalleSubCategoria("+respuesta[j].idcategoriapaquete+")";
						
			      
			      	}else{
			      		 funcion="DetalleCategiaProducto("+respuesta[j].idcategoriapaquete+")";
			      	}

                    html += `
                        <div class="tarjeta cambiarfuente faustina mx-2" id="tarjeta_${j}" onclick="`+funcion+`">
                            <div class="card demo-card-header-pic" style="border-radius: 10px;">
                                <div class="card-header align-items-flex-end" style="background-image: url(${foto}); border-radius: 10px 10px 0px 0px; width: 300px; height: 100px; background-repeat: round;"></div>
                                <div class="card-body divcategoriaitem" id="divcategoriaitem_`+respuesta[j].idcategoriapaquete+`"  style="background: #c7aa6a; border-radius: 0px 0px 10px 10px;">
                                    <p style="margin: 0; text-align: center; color: white;">${respuesta[j].nombre}</p>
                                </div>
                            </div>
                        </div>`;

                        CrearDiv(respuesta[j].idcategoriapaquete);
                

                html += `</div></div>`;
                activeClass = ""; // No aplicar "active" a los siguientes grupos de tarjetas
            }

            html += `</div></div>`;
            $("#slidercategorias").html(html);

          /* $('#miCarrusel').carousel({
                interval: false
            });*/
}

function CrearDiv(idcategoriapaquete) {
	console.log(idcategoriapaquete);
	var html=`
		<div id="divcategoria_`+idcategoriapaquete+`" class="subcategorias"><div>
	`;
	$("#slidersubcategorias").append(html);
}

function DetalleSubCategoria(idcategoriapaquete) {
	//var datos="idcategoriapaquete="+idcategoriapaquete;
	
	var datos="idcategoria="+idcategoriapaquete;
	$.ajax({
		 type: 'POST',
		dataType: 'json',
		url:'catalogos/citas/ObtenerSubCategorias.php', //Url a donde la enviaremos
		data:datos,
		async:false,
		success: function(resp){
			var respuesta=resp.respuesta;
			//var categoriapadre=resp.idcategoriapadre;
			//var categoria=resp.categoria.nombre;
			if (respuesta.length>0) {
				//console.log('sub y productos');
				PintarSubCategoriaProducto(respuesta,idcategoriapaquete);
				var div="divsub";
				//ObtenerProductosCategorias(div);
				//localStorage.setItem('idcategoria',categoriapadre);

			/*$(".titlecatalogosub").text(categoria);
			$(".titlecatalogosub").css('display','block');
*/

			}else{
				console.log('productos');

				localStorage.setItem('idcategoria',categoriapadre);
				var div="divproductosservicios";
				ObtenerProductosCategorias(div);
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

function PintarSubCategoriaProducto(respuesta,idcategoria) {

	var contadorc=$(".carousel").length;
	var html = `
                <div id="miCarrusel`+contadorc+`" class="carousel slide">
                    <div class="carousel-inner">`;

            var itemsPerSlide = 3; // Número de tarjetas por slide
            var totalItems = respuesta.length;
            var activeClass = "active"; // Para la primera tarjeta

            for (var i = 0; i < totalItems; i += itemsPerSlide) {
                html += `<div class="carousel-item ${activeClass}"><div class="d-flex">`;

                for (var j = i; j < i + itemsPerSlide && j < totalItems; j++) {
                    var foto = respuesta[j].ruta;
                    console.log(respuesta[j].sub);
                    if (respuesta[j].sub>0) {
  					
  					funcion="DetalleSubCategoria("+respuesta[j].idcategoriapaquete+")";
						
			      
			      	}else{
			      		 funcion="DetalleCategiaProducto("+respuesta[j].idcategoriapaquete+")";
			      	}

                    html += `
                        <div class="tarjeta cambiarfuente faustina mx-2" id="tarjeta_${j}" onclick="`+funcion+`">
                            <div class="card demo-card-header-pic" style="border-radius: 10px;">
                                <div class="card-header align-items-flex-end" style="background-image: url(${foto}); border-radius: 10px 10px 0px 0px; width: 300px; height: 100px; background-repeat: round;"></div>
                                <div class="card-body" style="background: #c7aa6a; border-radius: 0px 0px 10px 10px;">
                                    <p style="margin: 0; text-align: center; color: white;">${respuesta[j].nombre}</p>
                                </div>
                            </div>
                        </div>`;
                }

                html += `</div></div>`;
                activeClass = ""; // No aplicar "active" a los siguientes grupos de tarjetas
            }

            html += `</div></div>`;
            $("#divcategoria_"+idcategoria).html(html);

           $('#miCarrusel'+contadorc).carousel({
                interval: false
            });
}

function DetalleCategiaProducto(idcategoriapaquete) {
	

	var pagina = "ObtenerProductosCategoria.php";
	//var idsucursal=localStorage.getItem('idsucursal');
	//var id_user=localStorage.getItem('id_user');
	//var idcategoria=localStorage.getItem('idcategoria');
	var datos="idcategoria="+idcategoriapaquete+"&idsucursal="+idsucursalagenda;
	$(".divcategoriaitem").removeClass('activo');

	$("#divcategoriaitem_"+idcategoriapaquete).addClass('activo');
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url:'catalogos/citas/'+pagina, //Url a donde la enviaremos
		data:datos,
		async:false,
		success: function(resp){
			var respuesta=resp.respuesta;
			var div="";
			PintarProductosConCategoria(respuesta,div);

			//var idcategoriapadre=resp.idcategoriapadre;
			idcategoriapadre=resp.idcategoriapadre;
			if (idcategoriapadre>0) {
				localStorage.setItem('idcategoria',idcategoriapadre);
			}
		/*	var nombrecate=resp.categoria.nombre;
			$(".titlecatalogo").text(nombrecate);
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

function PintarProductosConCategoria(respuesta,div) {
	var contadorc=$(".carousel").length;
	/*var html = `
                <div id="miCarrusel`+contadorc+`" class="carousel slide">
                    <div class="carousel-inner">`;*/
     var html=`
     		<div class="swiper mySwiper" id="miCarrusel`+contadorc+`"  >
   			 <div class="swiper-wrapper" style="width: 60px;">

     `;

            var activeClass = "active"; // Para la primera tarjeta


                for (var j = 0;j<respuesta.length; j++) {
                    var foto = respuesta[j].ruta;
                    console.log(respuesta[j].sub);
                    funcion="";
                              html += `<div class="swiper-slide " onclick="SeleccionarProducto(`+respuesta[j].idpaquete+`,`+respuesta[j].precioventa+`)">`;
   
                

                    html += `
                        <div class="card cambiarfuente faustina " id="tarjeta_${j}" onclick="`+funcion+`">
                            <div class="card " style="border-radius: 10px;">
                                <div class="card-header align-items-flex-end" style="background-image: url(${foto}); border-radius: 10px 10px 0px 0px; width: 100%; height: 100px; background-repeat: round;"></div>
                                <div class="card-body divpaquete" id="divpaquetes_`+respuesta[j].idpaquete+`" style="background: #c7aa6a; border-radius: 0px 0px 10px 10px;">
                                    <p style="margin: 0; text-align: center; color: white;">${respuesta[j].nombrepaquete} $${respuesta[j].precioventa}</p>
                                </div>
                            </div>
                        </div>
                        </div>
                        `;
                }

                html += `</div>`;
                activeClass = ""; // No aplicar "active" a los siguientes grupos de tarjetas
            

            html += ` 
            </div>
    		<div class="swiper-pagination" style="    display: flex;
    justify-content: center;
    width: 100%;"></div>
  			</div>`;
            $("#slidersubcategoriasproductos").html(html);

          /* $('#miCarrusel'+contadorc).carousel({
                interval: false
            });*/

             var swiper = new Swiper("#miCarrusel"+contadorc, {
		      		   slidesPerView: 3,
		      		    spaceBetween: 10,
					     pagination: {
					        el: ".swiper-pagination",
					      },
		    	});
		}		

function AbrirModalCliente() {
	var pagina = "fa_cliente.php";

	$.ajax({
		type: 'POST',
		url:'catalogos/clientes/'+pagina, //Url a donde la enviaremos
		async:false,
		success: function(resp){
			$("#clave").val('');
			$("#v_usuario").val('');
			$("#titulo-modal-forms2").html('');
			$("#contenedor-modal-forms2").html(resp);
			$(".divdatosconfiguracion").css('display','none');
			$(".divfotoperfil").css('display','none');
			//$(".divdatosacceso").css('display','none');
			$(".btnlistado").css('display','none');
			$(".divheader").css('display','none');
			var button=`<button class="btn btn-success" onclick="GuardarCliente('form_usuario','catalogos/clientes/vi_clientes.php','main','catalogos/clientes/ga_clientes.php',0)">GUARDAR</button>`;
			$("#footer-modal-forms2").html(button);
			//alert('a');
			//$(".divstatus").css('display','none');

			$("#modal-forms2").modal();
			$("#validacioncelular").text('');
			},error: function(XMLHttpRequest, textStatus, errorThrown){ 
				var error;
				  	if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
				  	if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
								//alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
					console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
			}
		});

		
	}

	function GuardarCliente(form_usuario,regreso,donde,archivoenvio,idmenumodulo,valor) {
		// body...

	if(confirm("\u00BFEstas seguro de querer realizar esta operaci\u00f3n?"))
	{
		  ValidarCelular().then(r => {

		  	if (r.existe==0) {
		var datos = ObtenerDatosFormulario(form_usuario);//obteniedo los datos del formulario
		//datos+="&asociados="+JSON.stringify(asociados);
		//datos+="&asociadoseliminados="+JSON.stringify(asociadoseliminados);
		datos+="&v_sexo="+sexoseleccionado;
	
	
				  $.ajax({
					  type: 'POST',
					  url: archivoenvio,
					  data: datos,
					  error:function(XMLHttpRequest, textStatus, errorThrown){
						  var error;
						  console.log(XMLHttpRequest);
						  if (XMLHttpRequest.status === 404)  error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error 
						  if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error 
						  $('#abc').html('<div class="alert_error">'+error+'</div>');	
							  AbrirNotificacion('Operacion no realizada');

					  },
					  success:function(msj){
						   console.log("El resultado de msj es: "+msj);
						  if ( msj == 1 ){
							 $("#modal-forms2").modal('hide');
							 //ObtenerClientesFiltro();
							 AbrirNotificacion('Operacion realizada exitosamente','mdi-checkbox-marked-circle');
							 if (valor==1) {


							 }
						  }
						  else{

							 AbrirNotificacion('Operacion no realizada','mdi-close-circle');

							$("#modal-forms2").modal('hide');

							// aparecermodulos(regreso+"?ac=0&msj=Error. "+msj,donde);
						  }	
					  }
				  });	

				}else{

					$("#validacioncelular").text('El celular ya se encuentra registrado');
					//alert('Celular ya se encuentra registrado');

				}

			 });		  					  
		
		}
	}


	function GuardarCliente2(form_usuario,regreso,donde,archivoenvio,idmenumodulo,horainicial,fechaconsulta,idespecialista) {
		// body...
		$("#validacioncelular").text('');
		$("#validacionnombre").text('');
		$("#validacionpaterno").text('');
		$("#validacionnacimiento").text('');
		$("#validacionsexo").text('');
		$("#validacioncontra").text('');
		$("#validacioncontra2").text('');

		var celular=$("#v_celular").val();
		var nombre=$("#nombre").val();
		var v_paterno=$("#v_paterno").val();
		var fechafecha=$("#v_fechanacimiento").val();
		var validacioncontra=$("#clave").val();
		var validacioncontra2=$("#clave2").val();

		var bandera=1;		

		if(confirm("\u00BFEstas seguro de querer realizar esta operaci\u00f3n?"))
		{

				if (celular=='') {
				
					bandera=0;
				}
				if (nombre=='') {
					bandera=0;
				}

				if (v_paterno=='') {
					bandera=0;
				}

				if (sexoseleccionado=='') {
					bandera=0;
				}
				if (fechafecha=='') {
					bandera=0;
				}

				if (validacioncontra=='') {
					bandera=0;
				}

				if (validacioncontra2=='') {
					bandera=0;
				}

				if (bandera==1) {
		 	 ValidarCelular().then(r => {


		  	//validacioncelular
			//validacionnombre
			//validacionpaterno
			//validacionsexo
			//validacioncontra
			//validacioncontra2

		  	if (r.existe==0) {
		var datos = ObtenerDatosFormulario(form_usuario);//obteniedo los datos del formulario
		datos+="&v_sexo="+sexoseleccionado;
		

				
				  $.ajax({
					  type: 'POST',
					  url: archivoenvio,
					  data: datos,
					  error:function(XMLHttpRequest, textStatus, errorThrown){
						  var error;
						  console.log(XMLHttpRequest);
						  if (XMLHttpRequest.status === 404)  error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error 
						  if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error 
						  $('#abc').html('<div class="alert_error">'+error+'</div>');	
							  AbrirNotificacion('Operacion no realizada');

					  },
					  success:function(msj){
						   console.log("El resultado de msj es: "+msj);
						  if ( msj == 1 ){
							 $("#modal-forms2").modal('hide');
							 //ObtenerClientesFiltro();
							 AbrirNotificacion('Operacion realizada exitosamente','mdi-checkbox-marked-circle');
							 IrAgendarcita(horainicial,fechaconsulta,idespecialista);

						  }
						  else{

							 AbrirNotificacion('Operacion no realizada','mdi-close-circle');

							$("#modal-forms2").modal('hide');

							// aparecermodulos(regreso+"?ac=0&msj=Error. "+msj,donde);
						  }	
					  }
				  });	
			

				}else{

					$("#validacioncelular").text('El celular ya se encuentra registrado');
					//alert('Celular ya se encuentra registrado');

				}

			 });		  					  
		
		}else{
					if (celular=='') {
						bandera=0;
						$("#validacioncelular").text('Celular requerido');
						}
						if (nombre=='') {
							bandera=0;
						$("#validacionnombre").text('Nombre requerido');

						}

						if (v_paterno=='') {
							bandera=0;
						$("#validacionpaterno").text('Apellido paterno requerido');
	
						}
						if (fechafecha=='') {
							bandera=0;
						$("#validacionnacimiento").text('Fecha de nacimiento requerido');
						}

						if (sexoseleccionado=='') {
							bandera=0;
						$("#validacionsexo").text('Sexo requerido');

						}

						if (validacioncontra=='') {
							bandera=0;
						$("#validacioncontra").text('Contraseña requerida');

						}

						if (validacioncontra2=='') {
							bandera=0;

						$("#validacioncontra2").text('Confirmar contraseña requerida');

						}

				}
	}
}

	function ValidarCelular() {
	return new Promise(function(resolve, reject) {

		var celular=$("#v_celular").val();
		var datos="celular="+celular;
		if (celular.length>5) {
		$.ajax({
	 url:'catalogos/clientes/ValidarCelular.php', //Url a donde la enviaremos
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
		  resolve(msj);

			 			
			}
		});
	}

		});
	}

function ObtenerClientesFiltro() {

	$.ajax({
		url:'catalogos/citas/ObtenerAlumnos.php', //Url a donde la enviaremos
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
		  var resp = msj.usuarios;
		 $("#modalclientes").modal();
		 $("#buscadoralumnos_").val('');
		  PintarUsuariosAlumnosPunto(resp);

			 			
			}
		});
	

	}



function PintarUsuariosAlumnosPunto(respuesta) {
	var html="";
	if (respuesta.length>0) {

		for (var i = 0; i <respuesta.length; i++) {
			 var nombre=respuesta[i].nombre+" "+respuesta[i].paterno+" "+respuesta[i].materno+` - `+respuesta[i].usuario;

			html+=`

				<div class="form-check alumnos_"  id="alumnos_`+respuesta[i].idusuarios+`">		 
		  		<input  type="checkbox"   value="`+respuesta[i].idusuarios+`" class="form-check-input chkalumno chkcliente_" id="inputcli_`+respuesta[i].idusuarios+`_`+`" onchange="SeleccionarCliente1(`+respuesta[i].idusuarios+`,'`+nombre+`')">
		  		<label class="form-check-label" for="flexCheckDefault" style="margin-top: 0.2em;">`+respuesta[i].idusuarios+'-'+nombre+`</label> 
				</div>						    		

			`;
		}
		$("#divusuarios").html(html);
	}
}

function SeleccionarCliente1(idcliente,nombre) {
	// body...
	
	 if($("#inputcli_"+idcliente+"_").is(':checked')){
	  	  $(".chkcliente_").prop('checked',false);

	 		$("#inputcli_"+idcliente+"_").prop('checked',true);
	 		//CrearSesionUsuario(idcliente);
	  	  	idusuarioagenda=idcliente;
	  	  }else{	

	  	  $(".chkcliente_").prop('checked',false);
	  	 	idusuarioagenda=0;

	  	  }

	$(".btnseleccionarcliente").attr('onclick','CrearSesionUsuario('+idcliente+')');

}





function ObtenerFechasCalendarioAgenda(anio,mes) {
	

	var datos="idsucursal="+idsucursalagenda+"&mes="+mes+"&anio="+anio;
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

function SeleccionarSucursalAgenda(idsucursal) {

	if ($("#inputsuc_"+idsucursal).is(':checked')) {

		idsucursalagenda=idsucursal;
	}else{
		idsucursalagenda=0;
	}

	
}


function ConsultarFechasCalendario() {
	
	//alert( yyyy+'-'+mm+'-'+dd);
   // var calendarEl = document.getElementById('picker');

   // var calendar = new FullCalendar.Calendar(calendarEl, {
	$('#picker4').fullCalendar({
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

         PintarHoraSeleccionada1(fecha);
         PintarFechaSeleccionada3(fecha);
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

	 ObtenerFechasCalendarioAgenda(anio,mes);
	 $("#recargar").attr('onclick','ObtenerFechasCalendarioAgenda('+anio+','+mes+')');
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
	
	 	 ObtenerFechasCalendarioAgenda(anio,mes);
	 	
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

	    	 ObtenerFechasCalendarioAgenda(anio,mes);
	    

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


function PintarHoraSeleccionada1(fecha) {
	
fechaseleccionada=fecha;
	var datos="fecha="+fecha+"&idsucursal="+idsucursalagenda+"&idpaquete="+idseleccionpaquete;
 
	var pagina="ObtenerDisponibilidadPaqueteEspecialista.php";
		$.ajax({
		type: 'POST',
		dataType: 'json',
		url: 'catalogos/citas/'+pagina, //Url a donde la enviaremos
		data:datos,
		success: function(msj){
			horarioseleccionado=0;
			
				var intervalos=msj.intervalos;
				PintarIntervalos2(intervalos);
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


function ObtenerFechasCalendarioAgenda(anio,mes) {
	

	var datos="idsucursal="+idsucursalagenda+"&mes="+mes+"&anio="+anio;
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
idseleccionpaquete=0;
costopaquete=0;
function SeleccionarProducto(idpaquete,costo) {
	idseleccionpaquete=idpaquete;
	costopaquete=costo;
	$(".divpaquete").removeClass('activo');
	$("#divpaquetes_"+idpaquete).addClass('activo');
	

	ConsultarFechasCalendario();
}


function PintarFechaSeleccionada3(fecha) {

	
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






function ObtenerListadoEspecialista2() {
	

    var horario=horainicialsele+'_'+horafinalsele;
    var datos='idsucursal='+idsucursalagenda+"&idpaquete="+idseleccionpaquete+"&horaseleccionada="+horario+"&fecha="+fechaseleccionada;
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

function PintarIntervalos2(respuesta) {
		var html="";
		
			$(".liintervalos").html('');

		if (respuesta.length>0) {
			for (var i = 0; i < respuesta.length; i++) {
					
				html+=`
								<label class="btn btn_dorado btncategointervalo1 horariossele" data-hora="`+respuesta[i].horainicial+`" data-horafinal="`+respuesta[i].horafinal+`" id="catebtn_`+i+`" style="margin: 10px;">
								    <input type="checkbox" id="cate_`+i+`" class="catecheck" onchange="SeleccionarHorario1('`+respuesta[i].horainicial+`','`+respuesta[i].horafinal+`','`+i+`')" value="0" >`+respuesta[i].horainicial+`
								  </label>
				`;
			}
		}

	$(".liintervalos").html(html);
}


function ObtenerTipodepagosCitas(argument) {
	$.ajax({
					url:'catalogos/citas/ObtenerTipodepagos.php', //Url a donde la enviaremos
					type:'POST', //Metodo que usaremos
					dataType:'json',
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

							if (msj.respuesta.length>0) {
								PintarTipoPagosR(msj.respuesta);
							}
								
					  	}
				  });
}


function PintarTipoPagosR(respuesta) {
	var html="";
	


	if (respuesta.length>0) {
			for (var i = 0; i <respuesta.length; i++) {
			html+=`
			<label class="btn btn_dorado btntipodepago " id="catebtntipodepago_`+respuesta[i].idtipodepago+`">
			<input type="checkbox" id="cate_`+respuesta[i].idtipodepago+`" class="catechecktipo" onchange="SeleccionarTipodePago1(`+respuesta[i].idtipodepago+`)" value="0"> 
				`+respuesta[i].tipo+`</label>
			`;

		}
	}
	$(".divtipopago").html(html);
}


function SeleccionarTipodePago1(idtipodepago) {
	
	idtipodepagoseleccionado=idtipodepago;
	$(".btntipodepago").removeClass('active');
	$("#catebtntipodepago_"+idtipodepago).addClass('active');
	Validaciondedatos();
}


function Validaciondedatos(argument) {
	
	$(".btnguardarcita").css('display','block');
	$(".btnguardarcita").attr('onclick','Guardarcita()');
}

function Guardarcita() {

	var datos="idusuario="+idusuarioagenda+"&idsucursal="+idsucursalagenda+"&idpaquete="+idseleccionpaquete+"&fecha="+fechaseleccionada;
		datos+="&horario="+horarioseleccionado+"&idespecialista="+idespecialistaseleccionado+"&metodopago="+idtipodepagoseleccionado+"&costo="+costopaquete+"&cantidad=1";

		$.ajax({
					url:'catalogos/citas/Guardarcita.php', //Url a donde la enviaremos
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

							var html=`
							<p>Cita agendada exitosamente</p>

							`;

							AbrirNotificacion(html,'mdi-checkbox-marked-circle');
							var donde="catalogos/citas/vi_citas.php?idmenumodulo="+idmenumodulo;
							aparecermodulos(donde,'main');		
					  	}
				  });
}	