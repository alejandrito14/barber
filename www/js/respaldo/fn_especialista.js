/*function AgregarSucursal() {
	
	var promesa=ObtenerSucursales();

	promesa.then(r => {



	});


}
*/

function ObtenerSucursales2(){
 return new Promise(function(resolve, reject) {

	 			$.ajax({
					url:'catalogos/especialistas/ObtenerSucursales.php', //Url a donde la enviaremos
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
						
							resolve(msj);
					  	}
				  });
	 		});
}

function AbrirModalHorario() {
	var promise=ObtenerSucursales2();
	    promise.then(function(resp) {
	    	
	    	PintarSucursales(resp.sucursales);

	    	$("#modalhorario").modal();
	    		$(".diasemanasele").val('');
							$(".horainiciodiaselec").val('');
							$(".horafindiaselec").val('');
	    });

}

function PintarSucursales(resp) {
	var html="";
	if (resp.length>0) {
		for (var i = 0; i <resp.length; i++) {
			
			html+=`<option value="`+resp[i].idsucursal+`">`+resp[i].titulo+`</option>`;
		}
	}
	$("#v_sucursal").html(html);
}
var sucursaleslistado=[];
var listadohorarios=[];
function ObtenerHorariosSucursal(idusuarios) {
			var datos="idusuarios="+idusuarios;

			$.ajax({
					url:'catalogos/especialistas/ObtenerHorariosSucursal.php', //Url a donde la enviaremos
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
							var respuesta=msj.sucursales;
							sucursaleslistado=msj.todassucursales;
							listadohorarios=respuesta;
							var html="";
							if (respuesta.length>0) {
								
								for (var i = 0; i < respuesta.length; i++) {
									html+=`
										<div class="sucursal_`+respuesta[i].idsucursal+`">
										<div class="col-md-6" style="font-size: 18px;margin-top: 10px;margin-bottom: 10px;">
										`+respuesta[i].titulo+`
										</div>
									`;

									var horarios=respuesta[i].horarios;
									html+=`<div id="horariossucursal_`+respuesta[i].idsucursal+`">`;
									for (var j = 0; j < horarios.length; j++) {
										var dia=horarios[j].dia;
										var horainicio=horarios[j].horainicial;
										var horafin=horarios[j].horafinal;
										var tipocomision=horarios[j].tipocomision;
										var v_cantidadcomision=horarios[j].montocomision;
										html+=`
												<div class="col-md-12 horariosatencionsucursal" data-sucursal="`+respuesta[i].idsucursal+`" id="contador_`+j+`">
												<div class="row">
												 <div class="col-md-2">
													<label>DIA</label>	

													<select class="form-control diasemana" id="diasemana_`+j+`" >
														<option value="t"  ${dia === "" ? "selected" : ""}>SELECCIONAR DIA</option>
														<option value="0"  ${dia === "0" ? "selected" : ""}>DOMINGO</option>
														<option value="1"  ${dia === "1" ? "selected" : ""}>LUNES</option>
														<option value="2"  ${dia === "2" ? "selected" : ""}>MARTES</option>
														<option value="3"  ${dia === "3" ? "selected" : ""}>MIÉRCOLES</option>
														<option value="4"  ${dia === "4" ? "selected" : ""}>JUEVES</option>
														<option value="5"  ${dia === "5" ? "selected" : ""}>VIERNES</option>
														<option value="6"  ${dia === "6" ? "selected" : ""}>SÁBADO</option>

													</select>
													</div>
													<div class="col-md-2">
													<label>HORA INICIO:</label>
														<div class="form-group mb-2" style="">
															<input type="time" id="horai_`+j+`" class="form-control horainiciodia" value="`+horainicio+`">
														</div>

													</div>

												
													<div class="col-md-2">

														<label>HORA FIN:</label>
														<div class="form-group mb-2" style="">
															<input type="time" id="horaf_`+j+`" class="form-control horafindia" value="`+horafin+`"> 
														</div>
													</div>

													<div class="col-md-2">

														<label>TIPO COMISIÓN:</label>
														<div class="form-group mb-2" style="">
															<select class="form-control tipocomision" id="tipocomision_`+j+`">
														<option value="t"  ${tipocomision === "" ? "selected" : ""}>SELECCIONAR DIA</option>
														<option value="0"  ${tipocomision === "0" ? "selected" : ""}>PORCENTAJE</option>
														<option value="0"  ${tipocomision === "1" ? "selected" : ""}>MONTO</option>

															</select>
														</div>
													</div>


														<div class="col-md-3">

														<label>CANT. DE LA COMISIÓN:</label>
														<div class="form-group mb-2" style="">
														<input type="text" id="cantidadcomi_`+j+`" class="form-control cantidadcomi" value="`+v_cantidadcomision+`"> 
	
														</div>
													</div>
													<div class="col-md-1">
														<button type="button" style="margin-top: 2em;" onclick="EliminarOpcionHorarioEspecialista(`+j+`)" class="btn btn_rojo"><i class="mdi mdi-delete-empty"></i></button>
													</div>
												</div>
												</div>
										`;
									}
									html+=`</div>`;

									html+=`</div>`;
								}
							}

						$(".horariosespecialistas").html(html);

							
					  	}

				  });

	}

	function EliminarOpcionHorarioEspecialista(idhorarioespecialista) {
		
		if(confirm("\u00BFDesea realizar esta operaci\u00f3n?"))
	{

		$("#contador_"+idhorarioespecialista).remove();
	}
}

function AgregarNuevoHorario() {
	var sucursal=$("#v_sucursal").val();
	var diasemana=$(".diasemanasele").val();
	var horainiciodia=$(".horainiciodiaselec").val();
	var horafindia=$(".horafindiaselec").val();
	var tipocomision=$("#v_tipocomision").val();
	var v_cantidadcomision=$("#v_cantidadcomision").val();

		PintarNuevoHorario(sucursal,diasemana,horainiciodia,horafindia,tipocomision,v_cantidadcomision);
		$("#modalhorario").modal('hide');


}

function PintarNuevoHorario(sucursal,dia,horainiciodia,horafindia,tipocomision,v_cantidadcomision) {
	var j=$(".horariosatencionsucursal").length+1;

	const objetoEncontrado = listadohorarios.find(objeto => objeto.idsucursal === sucursal);

		var html="";
if (objetoEncontrado) {


	html+=`				<div class="col-md-12 horariosatencionsucursal" data-sucursal="`+sucursal+`" id="contador_`+j+`">
												<div class="row">
												 <div class="col-md-2">
													<label>DIA</label>	

													<select class="form-control diasemana" id="diasemana_`+j+`" >
														<option value="t"  ${dia === "" ? "selected" : ""}>SELECCIONAR DIA</option>
														<option value="0"  ${dia === "0" ? "selected" : ""}>DOMINGO</option>
														<option value="1"  ${dia === "1" ? "selected" : ""}>LUNES</option>
														<option value="2"  ${dia === "2" ? "selected" : ""}>MARTES</option>
														<option value="3"  ${dia === "3" ? "selected" : ""}>MIÉRCOLES</option>
														<option value="4"  ${dia === "4" ? "selected" : ""}>JUEVES</option>
														<option value="5"  ${dia === "5" ? "selected" : ""}>VIERNES</option>
														<option value="6"  ${dia === "6" ? "selected" : ""}>SÁBADO</option>

													</select>
													</div>
													<div class="col-md-2">
													<label>HORA INICIO:</label>
														<div class="form-group mb-2" style="">
															<input type="time" id="horai_`+j+`" class="form-control horainiciodia" value="`+horainiciodia+`">
														</div>

													</div>

												
													<div class="col-md-2">

														<label>HORA FIN:</label>
														<div class="form-group mb-2" style="">
															<input type="time" id="horaf_`+j+`" class="form-control horafindia" value="`+horafindia+`"> 
														</div>
													</div>

													<div class="col-md-2">

														<label>TIPO COMISIÓN:</label>
														<div class="form-group mb-2" style="">
															<select class="form-control tipocomision" id="tipocomision_`+j+`">
														<option value="t"  ${tipocomision === "" ? "selected" : ""}>SELECCIONAR DIA</option>
														<option value="0"  ${tipocomision === "0" ? "selected" : ""}>PORCENTAJE</option>
														<option value="0"  ${tipocomision === "1" ? "selected" : ""}>MONTO</option>

															</select>
														</div>
													</div>


														<div class="col-md-3">

														<label>CANT. DE LA COMISIÓN:</label>
														<div class="form-group mb-2" style="">
														<input type="text" id="cantidadcomi_`+j+`" class="form-control cantidadcomi" value="`+v_cantidadcomision+`"> 
	
														</div>
													</div>

													<div class="col-md-1">
														<button type="button" style="margin-top: 2em;" onclick="EliminarOpcionHorarioEspecialista(`+j+`)" class="btn btn_rojo"><i class="mdi mdi-delete-empty"></i></button>
													</div>
												</div>
												</div>
										`;

									$("#horariossucursal_"+sucursal).append(html);
								}else{

										const objetoEncontrado = sucursaleslistado.find(objeto => objeto.idsucursal === sucursal);

										if($(".sucursal_"+objetoEncontrado.idsucursal).length == 0 ) {

									
											html=`
										<div class="sucursal_`+objetoEncontrado.idsucursal+`">
										<div class="col-md-6" style="font-size: 18px;margin-top: 10px;margin-bottom: 10px;">
										`+objetoEncontrado.titulo+`
										</div>
									`;

									html+=`<div id="horariossucursal_`+objetoEncontrado.idsucursal+`"></div>`;
								
									$(".horariosespecialistas").append(html);

								}
									html=`<div class="col-md-12 horariosatencionsucursal" data-sucursal="`+objetoEncontrado.idsucursal+`"  id="contador_`+j+`">
												<div class="row">
												 <div class="col-md-2">
													<label>DIA</label>	

													<select class="form-control diasemana" id="diasemana_`+j+`" >
														<option value="t"  ${dia === "" ? "selected" : ""}>SELECCIONAR DIA</option>
														<option value="0"  ${dia === "0" ? "selected" : ""}>DOMINGO</option>
														<option value="1"  ${dia === "1" ? "selected" : ""}>LUNES</option>
														<option value="2"  ${dia === "2" ? "selected" : ""}>MARTES</option>
														<option value="3"  ${dia === "3" ? "selected" : ""}>MIÉRCOLES</option>
														<option value="4"  ${dia === "4" ? "selected" : ""}>JUEVES</option>
														<option value="5"  ${dia === "5" ? "selected" : ""}>VIERNES</option>
														<option value="6"  ${dia === "6" ? "selected" : ""}>SÁBADO</option>

													</select>
													</div>
													<div class="col-md-2">
													<label>HORA INICIO:</label>
														<div class="form-group mb-2" style="">
															<input type="time" id="horai_`+j+`" class="form-control horainiciodia" value="`+horainiciodia+`">
														</div>

													</div>

												
													<div class="col-md-2">

														<label>HORA FIN:</label>
														<div class="form-group mb-2" style="">
															<input type="time" id="horaf_`+j+`" class="form-control horafindia" value="`+horafindia+`"> 
														</div>
													</div>

														<div class="col-md-2">

														<label>TIPO COMISIÓN:</label>
														<div class="form-group mb-2" style="">
															<select class="form-control tipocomision" id="tipocomision_`+j+`">
														<option value="t"  ${tipocomision === "" ? "selected" : ""}>SELECCIONAR DIA</option>
														<option value="0"  ${tipocomision === "0" ? "selected" : ""}>PORCENTAJE</option>
														<option value="0"  ${tipocomision === "1" ? "selected" : ""}>MONTO</option>

															</select>
														</div>
													</div>


														<div class="col-md-3">

														<label>CANTIAD DE LA COMISIÓN:</label>
														<div class="form-group mb-2" style="">
														<input type="text" id="cantidadcomi_`+j+`" class="form-control cantidadcomi" value="`+v_cantidadcomision+`"> 
	
														</div>
													</div>

													<div class="col-md-1">
														<button type="button" style="margin-top: 2em;" onclick="EliminarOpcionHorarioEspecialista(`+j+`)" class="btn btn_rojo"><i class="mdi mdi-delete-empty"></i></button>
													</div>
												</div>
												</div>
										`;

									$("#horariossucursal_"+sucursal).append(html);



								}
}

function GuardarusuarioEspecialista(form_usuario,regreso,donde,archivoenvio,idmenumodulo) {
		$("#validacioncelular").text('');
		$("#validacionnombre").text('');
		$("#validacionpaterno").text('');
		$("#validacionnacimiento").text('');
		$("#validacionsexo").text('');
		$("#validacioncontra").text('');
		$("#validacioncontra2").text('');
		$("#validacioncolor").text('');
		var celular=$("#v_celular").val();
		var nombre=$("#nombre").val();
		var v_paterno=$("#v_paterno").val();
		var fechafecha=$("#v_fechanacimiento").val();
		var validacioncontra=$("#clave").val();
		var validacioncontra2=$("#clave2").val();
		var color=$("#v_color").val();
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

				if (color=='') {
					bandera=0;
				}
				if (bandera==1) {
	
		var horariosespecialista=[];
		$(".horariosatencionsucursal").each(function(index) {
			
			var elemento=$(this).attr('data-sucursal');
			var elementoposicion=$(this).attr('id');
			var id=elementoposicion.split('_')[1];

			var diasemana=$("#diasemana_"+id).val();
			var horainicio=$("#horai_"+id).val();
			var horafinal=$("#horaf_"+id).val();
			var tipocomision=$("#tipocomision_"+id).val();
			var cantidadcomi=$("#cantidadcomi_"+id).val();

				var objeto={
					idsucursal:elemento,
					diasemana:diasemana,
					horainicio:horainicio,
					horafinal:horafinal,
					tipocomision:tipocomision,
					cantidadcomi:cantidadcomi

				};
			
			horariosespecialista.push(objeto);

		});
	 //var datos = ObtenerDatosFormulario(form_usuario);//obteniedo los datos del formulario
		//datos+="&horariosespecialista="+JSON.stringify(horariosespecialista);
		//datos+="&sexo="+sexoseleccionado;
		var v_celular=$("#v_celular").val();
		var v_alias=$("#v_alias").val();
		var nombre=$("#nombre").val();
		var v_paterno=$("#v_paterno").val();
		var v_materno=$("#v_materno").val();
		var v_id=$("#v_id").val();
		var v_fechanacimiento=$("#v_fechanacimiento").val();
		var clave=$("#clave").val();
		var v_estatus=$("#v_estatus").val();
		var v_tipo=$("#v_tipo").val();
		var v_color=$("#v_color").val();
	//	var v_celular=$("#v_celular").val();
		var datos = new FormData();


		datos.append('horariosespecialista',JSON.stringify(horariosespecialista));
	 datos.append('sexo',sexoseleccionado);
		datos.append('v_celular',v_celular);
		datos.append('v_alias',v_alias);
		datos.append('nombre',nombre);
		datos.append('paterno',v_paterno);
		datos.append('materno',v_materno);
		datos.append('v_fechanacimiento',v_fechanacimiento);
		datos.append('clave',clave);
		datos.append('estatus',v_estatus);
		datos.append('v_id',v_id);
		datos.append('tipo',v_tipo);
		datos.append('v_color',v_color);
		var archivos = document.getElementById("image"); //Damos el valor del input tipo file
		var archivo = archivos.files; //Obtenemos el valor del input (los arcchivos) en modo de arreglo
		console.log(datos);

		//Como no sabemos cuantos archivos subira el usuario, iteramos la variable y al
		//objeto de FormData con el metodo "append" le pasamos calve/valor, usamos el indice "i" para
		//que no se repita, si no lo usamos solo tendra el valor de la ultima iteracion
		for (i = 0; i < archivo.length; i++) {
		
			datos.append('archivo' + i, archivo[i]);
		}

		$('#abc').html('<div align="center" class="mostrar"><img src="images/loader.gif" alt="" /><br />Cargando...</div>');
	
		setTimeout(function(){
				  $.ajax({
								url: 'catalogos/especialistas/ga_especialistas.php', //Url a donde la enviaremos
					 type: 'POST', //Metodo que usaremos
						contentType: false, //Debe estar en false para que pase el objeto sin procesar
						data: datos, //Le pasamos el objeto que creamos con los archivos
						processData: false, //Debe estar en false para que JQuery no procese los datos a enviar
						cache: false, //Para que el formulario no guarde cache,
									  error:function(XMLHttpRequest, textStatus, errorThrown){
						  var error;
						  console.log(XMLHttpRequest);
						  if (XMLHttpRequest.status === 404)  error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error 
						  if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error 
						  $('#abc').html('<div class="alert_error">'+error+'</div>');	
						 aparecermodulos(regreso+"?ac=0&msj=Error. "+msj,donde);

					  },
					  success:function(msj){
						   console.log("El resultado de msj es: "+msj);
						  if ( msj == 1 ){
							 
							  aparecermodulos(regreso+"?ac=1&msj=Operacion realizada con exito&idmenumodulo="+idmenumodulo,donde);
						  }
						  else{
							
							 aparecermodulos(regreso+"?ac=0&msj=Error. "+msj,donde);
						  }	
					  }
				  });				  					  
			},1000);
		
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

						if (color=='') {
							bandera=0;
						$("#validacioncolor").text('Color requerido');

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
