var resultimagendatosfactura=[];
var idsucursalseleccionada=0;
function Guardarpagos(form,regresar,donde,idmenumodulo)
{ 
	if(confirm("\u00BFDesea realizar esta operaci\u00f3n?"))
	{			
		//recibimos todos los datos..
		var datos = ObtenerDatosFormulario(form);
		
		//console.log(datos);
	
		 $('#main').html('<div align="center" class="mostrar"><img src="images/loader.gif" alt="" /><br />Procesando...</div>')
				
		setTimeout(function(){
				  $.ajax({
					url:'catalogos/pagos/ga_pagos.php', //Url a donde la enviaremos
					type:'POST', //Metodo que usaremos
					data: datos, //Le pasamos el objeto que creamos con los archivos
					error:function(XMLHttpRequest, textStatus, errorThrown){
						  var error;
						  console.log(XMLHttpRequest);
						  if (XMLHttpRequest.status === 404)  error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error 
						  if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error 
						  $('#abc').html('<div class="alert_error">'+error+'</div>');	
						  //aparecermodulos("catalogos/vi_ligas.php?ac=0&msj=Error. "+error,'main');
					  },
					success:function(msj){
						var resp = msj.split('|');
						
						   console.log("El resultado de msj es: "+msj);
						 	if( resp[0] == 1 ){
								aparecermodulos(regresar+"?ac=1&idmenumodulo="+idmenumodulo+"&msj=Operacion realizada con exito&idempresas="+resp[1],donde);
						 	 }else{
								aparecermodulos(regresar+"?ac=0&idmenumodulo="+idmenumodulo+"&msj=Error. "+msj,donde);
						  	}			
					  	}
				  });				  					  
		},1000);
	 }
}


function SeleccionarClientePagos(idcliente) {
	//LimpiarVariables();
	clienteid=idcliente;
	
	var datos="idcliente="+idcliente;
	$("#datoscliente").removeClass('borde');
	$("#datoscliente").html('');

	 
	 /* $(".cli_").removeClass('seleccionado');
	  $("#cli_"+idcliente+"_").addClass('seleccionado');*/
	 // if($("#inputcli_"+idcliente+"_").is(':checked')){
	  	idparticipante=idcliente;
	  	$("#divsucursal").css('display','none');
	  	//openTab('punto-venta');
	  //$(".divtabs").css('display','block');
	  	$("#modalclientes").modal('hide');
	  	$("#inputcli_"+idcliente+"_").prop('checked',true);
	  /*$.ajax({
					url:'catalogos/pagos/ObtenerTodosPagos.php', //Url a donde la enviaremos
					type:'POST', //Metodo que usaremos
					data: datos, //Le pasamos el objeto que creamos con los archivos
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
						
						
						arraypagos=respuesta;*/
						//EliminarCarritoCliente(idcliente);

						ObtenerDatosCliente(idcliente);
						//ObtenerPaquetesCarrito();
						//$(".requierefacturadiv").css('display','block');
						//$("#btnmonederodisponible").css('display','block');
				
						/*						//PintarpagosTabla(respuesta);
						PintarPagosPorpagar(respuesta);
						//$("#tblpaquetesventa").html(" ");
						$(".btnnuevopago").css('display','block');
					
								
					  	}
				  });*/

	//}else{

	/*$("#contenedor_descuentos").css('display','none');
	$("#listadodescuentos").html("");
	$("#listadodescuentosmembresia").html("");
	$("#contenedor_descuentos_membresia").css('display','none');
	$("#listadopagos").html("");
	
	$("#btnpagarresumen").attr('disabled',true);
	LimpiarVariables();
	CalcularTotales();
	}*/
}

function ObtenerClientePagos(idcliente) {
	
	clienteid=idcliente;
	var datos="idcliente="+idcliente;
	  $.ajax({
					url:'catalogos/pagos/ObtenerTodosPagos.php', //Url a donde la enviaremos
					type:'POST', //Metodo que usaremos
					data: datos, //Le pasamos el objeto que creamos con los archivos
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
						//CalcularTotales();

						var respuesta=msj.respuesta;
						arraypagos=respuesta;
						PintarPagosPorpagar(respuesta);
						
								
					  	}
				  });

	
}

function ObtenerDatosCliente(idcliente) {
	var datos="idusuario="+idcliente;
	console.log('datos'+idcliente);
	 $.ajax({
					url:'catalogos/pagos/ObtenerUsuario.php', //Url a donde la enviaremos
					type:'POST', //Metodo que usaremos
					data: datos, //Le pasamos el objeto que creamos con los archivos
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
						var usuario=msj.respuesta;

					
					
						monederousuario=usuario.monedero;
					if (monederousuario!=null || monederousuario==0) {
							$("#btnmonederodisponible").css('display','block');

							$("#btnmonederodisponible").attr('disabled',false);
							$("#monederodisponible").text(monederousuario);
							$("#btnmonederodisponible").attr('onclick','AbrirModalMonedero()');
						  }

						$("#monederodispo").text(usuario.monedero);
						$(".nombreusuario").val(usuario.idusuarios+`-`+usuario.nombre+` `+usuario.paterno+` `+usuario.materno);
						var html=`
						<table style="background: #7488d2;width: 100%;    color: white;
    					border-bottom-left-radius: 10px;
 						border-bottom-right-radius: 10px;
    					border-top-left-radius: 10px;
    					border-top-right-radius: 10px;">
						  <tr>
						    <th style="padding: 4px;    width: 20%;">NOMBRE</th>
						    <td style="font-size: 19px;">`+usuario.idusuarios+`-`+usuario.nombre+` `+usuario.paterno+` `+usuario.materno+`
							</td>
						  </tr>
						  `;
						  if (usuario.celular!='') {
							 html+=`<tr>
						    	<th style="padding: 4px;width: 20%;">CELULAR</th>
						    	<td style="font-size: 19px;">`+usuario.celular+`</td>
						 	 	</tr>`;
							}

						 html+=`
						  <tr>
						    <th style="padding: 4px;    width: 20%;">MONEDERO</th>
						    <td style="font-size: 19px;">$`+usuario.monedero+`</td>
						  </tr>
						</table>

						`;

						$("#datoscliente").html(html);
						$("#datoscliente").addClass('borde');
								
					  	}
				  });
}



function ObtenerMonedero(idcliente) {
	var datos="idusuario="+idcliente;

	 $.ajax({
					url:'catalogos/pagos/ObtenerUsuario.php', //Url a donde la enviaremos
					type:'POST', //Metodo que usaremos
					data: datos, //Le pasamos el objeto que creamos con los archivos
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
						var usuario=msj.respuesta;
						monedero=0;

						$("#monederodispo").text(msj.monedero);
						}
				  });
}

function EliminarCarritoCliente(idcliente) {
	var datos="idcliente="+idcliente;
	 $.ajax({
					url:'catalogos/pagos/EliminarCarritoCliente.php', //Url a donde la enviaremos
					type:'POST', //Metodo que usaremos
					data: datos, //Le pasamos el objeto que creamos con los archivos
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
						//CalcularTotales();

						
								
					  	}
				  });

}


//punto venta
function PintarPagosPorpagar(pagos) {
	var html="";
	if (pagos.length>0) {
		html+=`<ul class="list-group">
		 		<li class="list-group-item  " style="">

		       <div class="row">
				   <div class="col-md-10">

				   <span>Seleccionar todos</span> 
				   </div>
				  <div class="col-md-2">

					<span style="">
					
					<input type="checkbox" class="checkcambia" id="checktodos" onchange="SeleccionarTodos()" style="width:30px;height: 20px;">
					</span>
			 	  </div>
		 	  </div>
		</li>

		`;
		for (var i = 0; i <pagos.length; i++) {
			html+=`

			  <li class="list-group-item  align-items-center">
			   <div class="row">
			   <div class="col-md-10">
			   		<p id="concepto_`+pagos[i].idpago+`">Pago de `+pagos[i].concepto+`</p>`;
			    	 if(pagos[i].fechaformato!=''){

                             html+=`<p class="">Vencimiento `+pagos[i].fechaformato+`</p>`;
                          }
                        html+=`<p class=""> `+pagos[i].nombre+` `+pagos[i].paterno+` `+pagos[i].materno+`</p>
   
                          <p class="">$`+pagos[i].monto+`</p>
                          <input type="hidden" value="`+pagos[i].monto+`" class="montopago" id="val_`+pagos[i].idpago+`">
                          <input type="hidden" value="`+pagos[i].tipopago+`" class="tipopago" id="tipopago_`+pagos[i].idpago+`">

                   </div>
                   <div class="col-md-2">`;


                        if (pagos[i].dividido==2) {


                          if (pagos[i].alumnos==pagos[i].aceptados) {

                             html+=` <input type="checkbox" id="check_`+pagos[i].idpago+`" class="seleccionar checkcambia" onchange="Seleccionarcheck(`+pagos[i].idpago+`)" style="width: 30px;height: 20px;" />`;
                               html+=` <input type="hidden" id="sepuede_`+pagos[i].idpago+`" class="" value="1" style="" />`;

                          }else{

                            html+=` <input type="checkbox" id="check_`+pagos[i].idpago+`" class="seleccionar checkcambia" onchange="Advertencia(`+pagos[i].idpago+`)" style="width: 30px;height: 20px;" />`;
                            html+=` <input type="hidden" id="sepuede_`+pagos[i].idpago+`" class="" value="0" style="" />`;

                          }
     
                        }else{

                         html+=` <input type="checkbox" id="check_`+pagos[i].idpago+`" class="seleccionar checkcambia" onchange="Seleccionarcheck(`+pagos[i].idpago+`)" style="width: 30px;height: 20px;" />`;
                         html+=` <input type="hidden" id="sepuede_`+pagos[i].idpago+`" class="" value="1" style="" />`;

                        }

					  html+=`  <span class="badge ">

                        <input type="hidden" id="tipo_`+pagos[i].idpago+`" value="`+pagos[i].tipo+`"  />
                        <input type="hidden" id="habilitarmonedero_`+pagos[i].idpago+`" value="`+pagos[i].habilitarmonedero+`"  />

                        <input type="hidden" id="servicio_`+pagos[i].idpago+`" value="`+pagos[i].idservicio+`"  />
                        <input type="hidden" id="fechainicial_`+pagos[i].idpago+`" value="`+pagos[i].fechainicial+`"  />
                        <input type="hidden" id="fechafinal_`+pagos[i].idpago+`" value="`+pagos[i].fechafinal+`"  />
                        <input type="hidden" id="usuario_`+pagos[i].idpago+`" value="`+pagos[i].idusuarios+`"  />


					    </span>`;

/*
					    if (pagos[i].habilitarmonedero==1) {
                           if (pagos[i].monederousado==0) {
                        html+=`  <span class="chip  btnmonedero" 
                          id="" style=" height: 30px;width:150px;background:#007aff;color:white;margin-right: 10px;text-align:center;justify-content: center;" 
                          onclick="AbrirModalmonedero('`+pagos[i].idpago+`')">
                                
                                Aplicar monedero
                                </span>`;

                              }else{

                         html+=`  <span class="chip  btnmonedero" 
                          id="" style=" height: 30px;width:150px;background:#007aff;color:white;margin-right: 10px;text-align:center;justify-content: center;" 
                          onclick="RevertirMonedero('`+pagos[i].idpago+`')">
                                
                                Revertir
                                </span>`;


                              }
                            }*/


			   		html+=` </div>
			    
			    </div>

			  </li>
  

			`;
		}

		html+=`</ul>`;


	}

	$(".todospagos").html(html);

	CambiarChek();
}
function Advertencia(idpago) {
  $("#check_"+idpago).prop('checked',false);

  alert('','Para pagar, todos los participantes deben aceptar');

}

function CambiarChek(argument) {
	  	var checkboxes = document.querySelectorAll('.checkcambia');

// Recorre cada elemento y reemplázalo con la estructura de div personalizada
checkboxes.forEach(function(checkbox) {
  var div = document.createElement('div');
  div.className = 'material-switch pull-right';

  var newCheckbox = document.createElement('input');
  newCheckbox.id = checkbox.id;
  newCheckbox.type = 'checkbox';
  newCheckbox.value = checkbox.value;
  newCheckbox.onchange = checkbox.onchange; // Copia la función onchange del checkbox original
  newCheckbox.className=checkbox.className;

  var label = document.createElement('label');
  label.setAttribute('for', checkbox.id);
  label.className = 'label-success';

  div.appendChild(newCheckbox);
  div.appendChild(label);

  // Agregar nuevo div al DOM reemplazando el checkbox original
  checkbox.parentNode.replaceChild(div, checkbox);

  // Agregar evento onchange al nuevo div
  
});
}
function PintarpagosTabla(respuesta) {
	var html="";
	if (respuesta.length>0) {
		for (var i = 0; i <respuesta.length; i++) {
			html+=`<tr style="text-align: center;">
					<td width="20"><input type="checkbox" class="form-control pagosusuario" id="pago_`+respuesta[i].idpago+`" onchange="VerificarDescuento(`+respuesta[i].idpago+`)"></td>

				      <td  width="40">`+respuesta[i].concepto+`<br>`;
				      if (respuesta[i].fechafinal!='' && respuesta[i].fechafinal!=null ) {
				      html+=`
				      <span>VIGENCIA:`+respuesta[i].fechafinal+`</span>`;
				  		}
				      html+=`
				      <input type="hidden" value="`+respuesta[i].tipo+`" id="tipo_`+respuesta[i].idpago+`"> 
				      </td>
				
				      <td  width="40">$<span id="monto_`+respuesta[i].idpago+`">`+respuesta[i].monto+`</span></td>
			    </tr>`;
		}


	}

	$("#listadopagos").html(html);
}

function SeleccionarTodosPagos() {
	if ($("#inputtodos").is(':checked')) {
		$(".pagosusuario").each(function( index ) {
			   $(this).prop('checked',true);
			});


	}else{

		$(".pagosusuario").each(function( index ) {
			   $(this).prop('checked',false);
			});

	}

	VerificarDescuento();
}

function VerificarDescuento() {
	 pagos=[];
	 //console.log(pagos);
	 var suma=0;
	$(".pagosusuario").each(function( index ) {

			if ($(this).is(':checked')) {
			   var id=$(this).attr('id');
			   var dividir=id.split('_');
			   var monto=$("#monto_"+dividir[1]).text()
			   var tipo=$("#tipo_"+dividir[1]).val();
			   var objeto={
			   	id:dividir[1],
			   	monto:monto,
			   	tipo:tipo
			   }
			  // console.log(objeto);
			   suma=parseFloat(suma)+parseFloat(monto);
			   pagos.push(objeto);


			}


	});
		if (pagos.length>0) {
			$("#btnpagar").attr('disabled',false);
			$("#btnpagar").attr('onclick','ElegirMetodoPago()')
		}else{

			$("#btnpagar").attr('disabled',true);

		}

	$("#subtotal").html(formato_numero(suma,2,'.',','));

	  var datos="pagos="+JSON.stringify(pagos);
		descuentosaplicados=[];
	  $.ajax({
					url:'catalogos/pagos/ObtenerDescuentosRelacionados.php', //Url a donde la enviaremos
					type:'POST', //Metodo que usaremos
					data: datos, //Le pasamos el objeto que creamos con los archivos
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
						$("#contenedor_descuentos").css('display','none');
						$("#listadodescuentos").html("");

						if (msj.descuentos.length>0) {
							
						$("#contenedor_descuentos").css('display','block');
							descuentosaplicados=msj.descuentos;
							PintarDescuentos(msj.descuentos);
						}

						ObtenerMembresiaUsuario();
						CalcularTotales();

							
					  	}
				  });

}

function PintarDescuentos(respuesta) {
	var html="";
	if (respuesta.length>0) {
		
		for (var i = 0; i < respuesta.length; i++) {
			html+=`<tr style="text-align: center;">
					
					<td width="10">
					<div style="width:15px;"></div>
					</td>
				      <td width="40">Descuento `+respuesta[i].titulo+`</td>
				      <td width="40">$<span id="monto_`+respuesta[i].iddescuento+`">`+formato_numero(respuesta[i].montoadescontar,2,'.',',')+`</span></td>
			    </tr>`;
		}
	}
	$("#listadodescuentos").html(html);
}

function ObtenerMembresiaUsuario() {
	var idusuario=0;
	$(".chkcliente_").each(function( index ) {
			  if ($(this).is(':checked')) {

			  	var idelemento=$(this).attr('id').split('_');
			  	 idusuario=idelemento[1];
			  }
			});
	
	  var datos="pagos="+JSON.stringify(pagos)+"&id_user="+idusuario+"&descuentosaplicados="+JSON.stringify(descuentosaplicados);
	descuentosmembresia=[];
	  $.ajax({
					url:'catalogos/pagos/ObtenerMembresiaUsuario.php', //Url a donde la enviaremos
					type:'POST', //Metodo que usaremos
					data: datos, //Le pasamos el objeto que creamos con los archivos
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
						$("#listadodescuentosmembresia").html("");

						$("#contenedor_descuentos_membresia").css('display','none');
						if (msj.descuentomembresia.length>0) {
							$("#contenedor_descuentos_membresia").css('display','block');
							descuentosmembresia = msj.descuentomembresia;
							PintarMembresiasDescuento(msj.descuentomembresia);
						}
								
					  	}
				  });
}
function PintarMembresiasDescuento(respuesta) {
	var html="";
	if (respuesta.length>0) {
		for (var i = 0; i <respuesta.length; i++) {
			
			html+=`<tr style="text-align: center;">
					
					<td width="10">
					<div style="width:15px;"></div>
					</td>
				      <td width="40">Descuento `+respuesta[i].titulomembresia+`</td>
				      <td width="40">$<span id="monto_`+respuesta[i].idmembresia+`">`+formato_numero(respuesta[i].montoadescontar,2,'.',',')+`</span></td>
			    </tr>`;
		}
	}

	$("#listadodescuentosmembresia").html(html);
}
/*
function CalcularTotales() {
	var suma=0;
	pagos=[];
	
	if ($(".pagosusuario").length>0) {
	$(".pagosusuario").each(function( index ) {

			if ($(this).is(':checked')) {
			   var id=$(this).attr('id');
			   var dividir=id.split('_');
			   var monto=$("#monto_"+dividir[1]).text()
			   var tipo=$("#tipo_"+dividir[1]).val();
 
			   var objeto={
			   	id:dividir[1],
			   	monto:monto,
			   	tipo:tipo

			   }

			   suma=parseFloat(suma)+parseFloat(monto);
			   pagos.push(objeto);
			}


	});
}

	var montodescuento=0;
	for (var i = 0; i < descuentosaplicados.length; i++) {
		montodescuento=parseFloat(montodescuento)+parseFloat(descuentosaplicados[i].montoadescontar);
	}
	

	var montodescuentomembresia=0;
	for (var i = 0; i < descuentosmembresia.length; i++) {
		montodescuentomembresia=parseFloat(montodescuentomembresia)+parseFloat(descuentosmembresia[i].montoadescontar);
	}

	$("#descuento").html(formato_numero(montodescuento,2,'.',','));
	$("#descuentomembresia").html(formato_numero(montodescuentomembresia,2,'.',','));

	// total=parseFloat(suma)-parseFloat(monedero)-parseFloat(montodescuento)+parseFloat(montodescuentomembresia);

	var resta=parseFloat(suma)-parseFloat(monedero)-parseFloat(montodescuento)-parseFloat(montodescuentomembresia);
    var sumaconcomision=resta;
	subtotalsincomision=resta;


	$("#total").html(formato_numero(resta,2,'.',','));


     // if (localStorage.getItem('comisionporcentaje')!=0 ){
       // comisionporcentaje=localStorage.getItem('comisionporcentaje');
        comimonto=parseFloat(comisionporcentaje)/100;
        
        comimonto=parseFloat(comimonto)*parseFloat(sumaconcomision);

        comision=parseFloat(comimonto)+parseFloat(comisionmonto);
      
       // localStorage.setItem('comision',comision);

     // }


     // if (localStorage.getItem('impuesto')!=0 ){
       // impuesto=localStorage.getItem('impuesto');
        impumonto=impuesto/100;

        comision1=parseFloat(comision)*parseFloat(impumonto);
        impuestotal=comision1;
       // localStorage.setItem('impuestotal',comision1);
        comision=parseFloat(comision1)+parseFloat(comision);


     // }
        $(".divcomision").css('display','none');


     // if (comision!=0 || comisionmonto!=0 ) {

        $(".divcomision").css('display','block');
        $("#comision").text(formato_numero(comision,2,'.',','));
       // localStorage.setItem('comisiontotal',comision);
        comisiontotal=comision;
        sumaconcomision=parseFloat(sumaconcomision)+parseFloat(comision);
    //  }
   // subtotalsincomision=total.toFixed(2);
    //localStorage.setItem('subtotalsincomision',resta.toFixed(2));
	  //localStorage.setItem('sumatotalapagar',sumaconcomision.toFixed(2));
	$(".lblresumen").text(formato_numero(resta,2,'.',','));
    $("#total").text(formato_numero(sumaconcomision,2,'.',','));
    $("#monedero").text(formato_numero(monedero,2,'.',','));	
    var suma=sumaconcomision;

    total=sumaconcomision;
   /* if (suma==0) {

      $("#btnpagarresumen").attr('disabled',false);
    }
}*/


function ElegirMetodoPago() {

	//$("#modalmetodopago").modal();
	ObtenerTipodepagos();
}

function ObtenerTipodepagos() {
			$.ajax({
					url:'catalogos/pagos/ObtenerTipodepagos.php', //Url a donde la enviaremos
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
								PintarTipoPagos(msj.respuesta);
							}
								
					  	}
				  });
}

function ObtenerTipodepagosCompletar(idtipodepago) {
	$.ajax({
					url:'catalogos/pagos/ObtenerTipodepagosCompletar.php', //Url a donde la enviaremos
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
								PintarTipoPagos2(msj.respuesta,idtipodepago);
							}
								
					  	}
				  });
}

function PintarTipoPagos2(respuesta,idtipodepago) {
	var html="";
	/*if (respuesta.length>0) {
		html+=`<option value="0">SELECCIONAR TIPO DE PAGO</option>`;
		for (var i = 0; i <respuesta.length; i++) {
			html+=`<option value="`+respuesta[i].idtipodepago+`">`+respuesta[i].tipo+`</option>`;
		}
	}*/


	if (respuesta.length>0) {
			for (var i = 0; i <respuesta.length; i++) {

				if (respuesta[i].idtipodepago!=idtipodepago) {
			html+=`
			<label class="btn btn_colorgray2 btntipodepago " id="catebtntipodepago_`+respuesta[i].idtipodepago+`">
			<input type="checkbox" id="cate_13" class="catechecktipo" onchange="SeleccionarTipodePago2(`+respuesta[i].idtipodepago+`)" value="0"> 
				`+respuesta[i].tipo+`</label>
			`;
			}

		}
	}
	$(".divtipopago").html(html);
}


function PintarTipoPagos3(respuesta,idtipodepago) {
	var html="";
	/*if (respuesta.length>0) {
		html+=`<option value="0">SELECCIONAR TIPO DE PAGO</option>`;
		for (var i = 0; i <respuesta.length; i++) {
			html+=`<option value="`+respuesta[i].idtipodepago+`">`+respuesta[i].tipo+`</option>`;
		}
	}*/


	if (respuesta.length>0) {
			for (var i = 0; i <respuesta.length; i++) {

				if (respuesta[i].idtipodepago!=idtipodepago) {
			html+=`
			<div class="row">
			<div class=" btn-group-toggle col-md-6">
				<label class="btn btn_colorgray2 btntipodepago " id="catebtntipodepago_`+respuesta[i].idtipodepago+`">
				<input type="checkbox" id="tipopago_`+respuesta[i].idtipodepago+`" class="catechecktipo" onchange="SeleccionarTipodePago3(`+respuesta[i].idtipodepago+`)" value="0"> 
				`+respuesta[i].tipo+`</label>
				</div>
			<div class="col-md-4">

				<input type="text" placeholder="Monto" class="form-control" id="inputtipodepago_`+respuesta[i].idtipodepago+`">

			</div>


			</div>
			`;
			}

		}
	}
	$(".divtipopago").html(html);
}

function CargartipopagoFactura(tipodepagoseleccionado) {
   var pagina = "obtenertipodepagos2.php";
    var datos="tipo=1";
    $.ajax({
    type: 'POST',
    dataType: 'json',
    url: urlphp+pagina,
    data:datos,
    async:false,
    success: function(datos){

      var opciones=datos.respuesta;
        
            Pintartipodepagos(opciones,tipodepagoseleccionado);

    },error: function(XMLHttpRequest, textStatus, errorThrown){ 
      var error;
        if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
        if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
                console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
    }

  });
}

function PintarTipoPagos(respuesta) {
	var html="";
	/*if (respuesta.length>0) {
		html+=`<option value="0">SELECCIONAR TIPO DE PAGO</option>`;
		for (var i = 0; i <respuesta.length; i++) {
			html+=`<option value="`+respuesta[i].idtipodepago+`">`+respuesta[i].tipo+`</option>`;
		}
	}*/


	if (respuesta.length>0) {
			for (var i = 0; i <respuesta.length; i++) {

			html+=`
			<label class="btn btn_colorgray2 btntipodepago " id="catebtntipodepago_`+respuesta[i].idtipodepago+`">
			<input type="checkbox" id="cate_13" class="catechecktipo" onchange="SeleccionarTipodePago(`+respuesta[i].idtipodepago+`)" value="0"> 
				`+respuesta[i].tipo+`</label>
			`;

		}
	}
	$(".divtipopago").html(html);
}
function SeleccionarTipodePago(idtipodepago) {
	CargarOpcionesTipopago(idtipodepago);
}

function SeleccionarTipodePago2(idtipodepago) {
	CargarOpcionesTipopago2(idtipodepago);
}

function SeleccionarTipodePago3(idtipodepago) {
	CargarOpcionesTipopago3(idtipodepago);
}


function ValidacionMonto() {
	$("#btnpagarresumen").prop('disabled',true);
	var valor= $("#montovisual").val();
	cambiomonto=0;


	if (valor>=total) {
				console.log('aq3 - '+total);

	$("#btnpagarresumen").prop('disabled',false);
	var cambio=parseFloat(total)-parseFloat(valor);
	$("#cambio").text(formato_numero(Math.abs(cambio),2,'.',','));
	cambiomonto=cambio;
	}else{
		console.log('aq');
	$("#btnpagarresumen").prop('disabled',true);
	
	}
}
function HabilitarBotonPagar() {
   var seleccion=0;
      $(".opccard").each(function( index ) {
        if ($(this).is(':checked')) {
        seleccion=1; 
        }
      });
      $("#btnpagarresumen").prop('disabled',true);
      if (seleccion==1) {
          $("#btnpagarresumen").prop('disabled',false);
      }
}

function Atras() {
  $("#divagregartarjeta").css('display','none');
  $("#divlistadotarjetas").css('visibility','visible');
  $("#divlistadotarjetas").css('display','block');

}




function AbrirModalDetalle(idnotapago,idusuario) {
	$("#modaldetallenota").modal();
	ObtenerDetalleNota(idnotapago,idusuario);
}

function ObtenerDetalleNota(idnotapago,idusuario) {
	/*var datos="idnotapago="+idnotapago+"&id_user="+idusuario;
	 var pagina = "ObtenerDetalleNota.php";
      $.ajax({
      type: 'POST',
      dataType: 'json',
      url: urlphp+pagina,
      data:datos,
      async:false,
      success: function(resp){

      	var pagos=resp.pagos;
      	var descuentos=resp.descuentos;
      	var descuentosmembresia=resp.descuentosmembresia;
      	var respuesta=resp.respuesta;
      	var usuario=resp.usuario;
      	PintardetalleNota(respuesta[0],usuario);
      	PintarPagos(pagos);

      	if (descuentos.length>0) {

      	PintarDescuentosDetalle(descuentos);

      }

      	if (descuentosmembresia.length>0) {
      	PintarDescuentosDetalleMembresia(descuentosmembresia[0]);

      }
      	
           
      },error: function(XMLHttpRequest, textStatus, errorThrown){ 
        var error;
          if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
          if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                  //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
                  console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
            }
      });*/
}

/*function PintarPagos(respuesta) {
	var html="";
	var sumapagos=0;
	if (respuesta.length>0) {
		for (var i = 0; i <respuesta.length; i++) {
			html+=`<tr style="text-align: center;">

				      <td  width="40">`+respuesta[i].concepto+` </td>
				
				      <td  width="40">$<span id="monto_`+respuesta[i].idpago+`">`+respuesta[i].monto+`</span></td>
			    </tr>`;
		
			    sumapagos=parseFloat(sumapagos)+parseFloat(respuesta[i].monto);
		}


	}
	$("#subtotal").text(formato_numero(sumapagos,'2','.',','));
	$(".listadopagos").html(html);
}*/
function PintarDescuentosDetalle(respuesta) {
	var html="";
	console.log(respuesta);
	if (respuesta.length>0) {
		
		for (var i = 0; i < respuesta.length; i++) {
			html+=`<tr style="text-align: center;">
					
					<td width="10">
					<div style="width:15px;"></div>
					</td>
				      <td width="40">Descuento `+respuesta[i].titulo+`</td>
				      <td width="40">$<span id="monto_`+respuesta[i].iddescuento+`">`+formato_numero(respuesta[i].montoadescontar,2,'.',',')+`</span></td>
			    </tr>`;
		}
	}
	//$(".listadodescuentos").html(html);
}

function PintarDescuentosDetalleMembresia(respuesta) {
	var html="";
	if (respuesta.length>0) {
		for (var i = 0; i <respuesta.length; i++) {
			
			html+=`<tr style="text-align: center;">
					
					<td width="10">
					<div style="width:15px;"></div>
					</td>
				      <td width="40">Descuento `+respuesta[i].titulo+`</td>
				      <td width="40">$<span id="monto_`+respuesta[i].idmembresia+`">`+formato_numero(respuesta[i].montoadescontar,2,'.',',')+`</span></td>
			    </tr>`;
		}
	}

	//$(".listadodescuentosmembresia").html(html);
}

function PintardetalleNota(respuesta,usuario) {
estatus=['PENDIENTE','ACEPTADO','CANCELADO'];

	$("#folio").text(respuesta.folio);
	$("#fechapago").text(respuesta.fecha);
	var nombreusuario=usuario.nombre+" "+usuario.paterno+" "+usuario.materno;
	$("#alumno").text(nombreusuario);
	$("#tipopago").text(respuesta.tipopago);

	$("#estatus").text(estatus[respuesta.estatus]);



	//$("#btnState_1").attr('onchange','CambiarEstatusNota('+respuesta.idnotapago+')');
	var html="";

	html+=`
	<div class="row">
	<div class="col-md-6" style=""></div>
	<div class="col-md-3" style="
    margin: 0;
    padding: 0;">
		<div class="">
			<div class="col-md-12">
				<div class="card">
				<div class="card-body">
			<div class="row" style="
			    /* margin-left: 1em; */
			    ">
			    	<div class="col-md-12" style="font-size: 16px;">SUBTOTAL: </div>
			    	<div class="col-md-12" style="font-size: 16px;">MONEDERO: </div>
				
					<div class="col-md-12 divcomision" style="font-size: 16px;">COMISIÓN: </div>

				<div class="col-md-12" style="font-size: 20px;">TOTAL:</div>

			</div>
		</div>
	</div>
	</div>
	</div>
</div>
	<div class="col-md-2" style="font-size: 16px;">

		<div class="row">
			<div class="col-md-12">
				<div class="card">
				<div class="card-body" style="    padding-left: 0;
    padding-right: 1px;">
			<div class="row">
				<div class="col-md-12" style="text-align: right;">$<span id="subtotal" style="
    font-size: 16px;"></span></div>
						<div class="col-md-12" style="text-align: right;">$<span id="monedero" style="
    font-size: 16px;">`+formato_numero(respuesta.montomonedero,2,'.',',')+`</span></div>
				
				<div class="col-md-12" style="text-align: right;">$<span id="descuento" style="
    font-size: 16px;">`+formato_numero(respuesta.descuento,2,'.',',')+`</span>
				</div>
				<div class="col-md-12" style="text-align: right;padding-top: 24px;">$<span id="descuentomembresia" style="font-size: 16px;">`+formato_numero(respuesta.descuentomembresia,2,'.',',')+`</span><br>
				</div><br>

					<div class="col-md-12 divcomision" style="text-align: right;">$<span id="comision" style=" font-size: 16px;">`+formato_numero(respuesta.comisiontotal,2,'.',',')+`</span>
				</div>
				<div class="col-md-12" style="text-align: right;font-size: 20px;/* padding-top: 6px; */">$<span id="total">`+formato_numero(respuesta.total,2,'.',',')+`</span></div></div>

			</div>
		</div>
	</div>
	</div>

		</div>


	</div>
				<div class="col-md-2" style="font-size: 16px;">


	`;

	$(".modaldetalle").html(html);


	if (respuesta.estatus==1) {
		 $('.btnState_1').prop('checked', true).trigger('change');

	}
	if (respuesta.estatus==0) {

		 $('.btnState_1').prop('checked', false).trigger('change');
	
	}
	$("#btnState_1").attr('onchange','CambiarEstatusNota('+respuesta.idnotapago+','+usuario.idusuarios+')');
	
}

function HabilitarOpcion(opcion) {
	$(".opciones").prop('checked',false);
	$("#opcion_"+opcion).prop('checked',true);
	$("#listado").html();
	$("#servicioslistado").css('display','none');
	$("#membresiaslistado").css('display','none');
	$("#divservicios").css('display','none');
	$("#divmembresia").css('display','none');
	$("#servicioslistado").val(0);
	$("#membresiaslistado").val(0);
	if (opcion==1) {
		$("#listado").css('display','block');
		$("#divservicios").css('display','block');
		ObtenerServiciosListado();
		$("#servicioslistado").css('display','block');


	}
	if (opcion==2) {
		$("#listado").css('display','block');
		$("#divmembresia").css('display','block');
		ObtenerMembresiaListado();
		$("#membresiaslistado").css('display','block');
	}
	if (opcion==3) {

	}


}

function ObtenerServiciosListado() {
      $.ajax({
      type: 'POST',
      dataType: 'json',
	  url:'catalogos/pagos/ObtenerServiciosListado.php', //Url a donde la enviaremos
      async:false,
      success: function(resp){

	var respuesta=resp.respuesta;

      	if (respuesta.length>0) {
      		PintarListadoServicio(respuesta);
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

function PintarListadoServicio(respuesta) {
	if (respuesta.length>0) {
		var html="";
		for (var i = 0; i <respuesta.length; i++) {
			html+=`<option value="`+respuesta[i].idservicio+`">`+respuesta[i].titulo+`</option>`;
			
		}

		$("#servicioslistado").html(html);
	}
}
function ObtenerMembresiaListado() {
      $.ajax({
      type: 'POST',
      dataType: 'json',
	  url:'catalogos/pagos/ObtenerMembresiaListado.php', //Url a donde la enviaremos
      async:false,
      success: function(resp){


      	var respuesta=resp.respuesta;

      	if (respuesta.length>0) {
      		PintarListadoMembresia(respuesta);
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

function PintarListadoMembresia(respuesta) {
	if (respuesta.length>0) {
		var html="";
		for (var i = 0; i <respuesta.length; i++) {
			html+=`<option value="`+respuesta[i].idmembresia+`">`+respuesta[i].titulo+`</option>`;
			
		}

		$("#membresiaslistado").html(html);
	}
}

var idmenumodu=0;
function VerdatelleNota(idnotapago,idusuario,idmenumodulo) {
	var datos="idnotapago="+idnotapago+"&idusuario="+idusuario+"&idmenumodulo="+idmenumodulo;

	idmenumodu=idmenumodulo;
	  $.ajax({
      type: 'POST',
      data:datos,
	  url:'catalogos/pagos/detallenota.php', //Url a donde la enviaremos
      async:false,
      success: function(resp){
      
	  $("#main").html(resp);
          
      },error: function(XMLHttpRequest, textStatus, errorThrown){ 
        var error;
          if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
          if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                  //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
                  console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
            }
      });
}

function CambiarEstatusNota(idnotapago,idusuario) {
estatus=['PENDIENTE','ACEPTADO','CANCELADO'];

	var estado=0;
	if ($("#btnState_1").is(':checked')) {
		estado=1;
	}



	$("#modalconfirmacion").modal();

	var html="";
		html+=`
		<div class="row">
			<div class="col-md-12">
				¿Seguro que desea cambiar el estado de la nota a `+estatus[estado]+` ?
			</div>
		</div>

		`;
		$("#divconfirmacion").html(html);
		$("#btnaceptar").attr('onclick','AceptarCambiarEstatus('+idnotapago+','+idusuario+')');
		$("#btncerrar").attr('onclick','CerrarModalConfirm('+idnotapago+','+estado+')');

}

function AceptarCambiarEstatus(idnotapago,idusuario) {

	var datos="idnotapago="+idnotapago;
	var estado=0;
	if ($("#btnState_1").is(':checked')) {
		estado=1;
	}


	  var datos="idnotapago="+idnotapago+"&estado="+estado;
      $.ajax({
      type: 'POST',
      data:datos,
	  url:'catalogos/pagos/Cambiarestatus.php', //Url a donde la enviaremos
      async:false,
      success: function(resp){
      	 $("#modalconfirmacion").modal('hide');

      	VerdatelleNota(idnotapago,idusuario,idmenumodu);
        
      },error: function(XMLHttpRequest, textStatus, errorThrown){ 
        var error;
          if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
          if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                  //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
                  console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
            }
      });

  





}

function CerrarModalConfirm(idnotapago,estatus) {
		$("#modalconfirmacion").modal('hide');
		if (estatus==1) {
			estatus=0;
		}else{
			estatus=1;
		}

		if (estatus==1) {

			$("#btnState_1").prop('checked',true);
		}else{
			$("#btnState_1").prop('checked',false);
		
		}

}



function ObtenerListadoDatosFiscales() {
	if (idparticipante>0) {
  if ($("#requierefactura").is(':checked')) {
  	  $(".divfiscal").css('display','block');

      var pagina = "ObtenerListadoDatosFiscales.php";
      $.ajax({
      type: 'POST',
      dataType: 'json',
      url: urlphp+pagina,
      async:false,
      success: function(resp){
       var respuesta=resp.respuesta;
       PintarListadoDatosFiscales(respuesta);

      },error: function(XMLHttpRequest, textStatus, errorThrown){ 
        var error;
          if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
          if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                  //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
                  console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
            }
      });
  	}else{
  		idusuariosdatosfiscales=0;
  		$(".divfiscal").css('display','none');
  		}
	}
}
function PintarListadoDatosFiscales(respuesta) {
  	var html=`
  	  <div class="list-group">
  	`;

  	html+=`<div class="">
        <div class="" style="margin-bottom: 1em;">
          <button type="button" onclick="AbrirModalDatoFiscal()"   class="btn btn-primary" style="width:94%;">
            Agregar datos fiscales
          </button>
        </div>`;

  if (respuesta.length>0) {

  	for (var i = 0; i < respuesta.length; i++) {
  		html+=`

  			 <div class="list-group-item" style="margin-right: 2.5em;    margin-left: 0.1em;">
		        <div class="form-check">
		          <input class="form-check-input checkfiscal" type="checkbox"  id="check_`+respuesta[i].idusuariosdatosfiscales+`" onchange="SeleccionarChekboxDatos(`+respuesta[i].idusuariosdatosfiscales+`)">
		          <label class="form-check-label" for="checkbox2">
		            <p style="margin:0;padding:0">R.F.C: `+respuesta[i].rfc+`</p>
		            <p style="margin:0;padding:0">RAZÓN SOCIAL: `+respuesta[i].razonsocial+`</p>
		        	<p style="margin:0;padding:0">`+respuesta[i].direccion+` No.ext. `+respuesta[i].noexterior+` No.int. `+respuesta[i].nointerior+` </p>
		        	<p style="margin:0;padding:0">`+respuesta[i].colonia+` Cod.postal `+respuesta[i].codigopostal+`</p>
		        	<p style="margin:0;padding:0">`+respuesta[i].nombremunicipio+` `+respuesta[i].nombreestado+`,`+respuesta[i].nombrepais+`</p>

		          </label>
		        </div>
		      </div>
  		`;

  	}
  }
  html+=`</div>`;

  $(".divfiscal").html(html);
}

function SeleccionarChekboxDatos(idusudatosfiscal) {

	if ($("#check_"+idusudatosfiscal).is(':checked')) {
	 	$(".checkfiscal").prop('checked',false);
		$("#check_"+idusudatosfiscal).prop('checked',true);
		idusuariosdatosfiscales=idusudatosfiscal;
	}else{
		idusuariosdatosfiscales=0;
		$("#check_"+idusudatosfiscal).prop('checked',false);
	 	$(".checkfiscal").prop('checked',false);

	}


}

function AbrirModalDatoFiscal() {
	
	$("#modaldatofiscal").modal();
	ObtenermetodoPago();
	ObtenerformaPago();
	ObtenerUsoCfdi();
	$(".btnguardardatofiscal").attr('onclick','GuardarDatoFiscal()');
}

function ObtenermetodoPago() {

	  var pagina = "ObtenermetodoPago.php";
      $.ajax({
      type: 'POST',
      dataType: 'json',
      url: urlphp+pagina,
      async:false,
      success: function(resp){
       var respuesta=resp.respuesta;
       var html="";
       if (respuesta.length>0) {
       	for (var i = 0; i < respuesta.length; i++) {
       		html+=`<option value="`+respuesta[i].c_metodopago+`">`+respuesta[i].c_metodopago+' '+respuesta[i].descripcion+`</option>`;
       	}
       }

       $("#metodopago").html(html);

      },error: function(XMLHttpRequest, textStatus, errorThrown){ 
        var error;
          if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
          if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                  //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
                  console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
            }
      });
  
}


function ObtenerformaPago() {

	  var pagina = "ObtenerformaPago.php";
      $.ajax({
      type: 'POST',
      dataType: 'json',
      url: urlphp+pagina,
      async:false,
      success: function(resp){
       var respuesta=resp.respuesta;
       var html="";
       if (respuesta.length>0) {
       	for (var i = 0; i < respuesta.length; i++) {
       		html+=`<option value="`+respuesta[i].cformapago+`">`+respuesta[i].cformapago+' '+respuesta[i].descripcion+`</option>`;
       	}
       }
       
       $("#formapago").html(html);

      },error: function(XMLHttpRequest, textStatus, errorThrown){ 
        var error;
          if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
          if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                  //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
                  console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
            }
      });
  
}


function ObtenerUsoCfdi() {

	  var pagina = "ObtenerUsoCfdi.php";
      $.ajax({
      type: 'POST',
      dataType: 'json',
      url: urlphp+pagina,
      async:false,
      success: function(resp){
       var respuesta=resp.respuesta;
       var html="";
       if (respuesta.length>0) {
       	for (var i = 0; i < respuesta.length; i++) {
       		html+=`<option value="`+respuesta[i].c_uso+`">`+respuesta[i].c_uso+' '+respuesta[i].descripcion+`</option>`;
       	}
       }
       
       $("#usocfdi").html(html);

      },error: function(XMLHttpRequest, textStatus, errorThrown){ 
        var error;
          if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
          if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                  //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
                  console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
            }
      });
  
}

function GuardarDatoFiscal() {
  
  var razonsocial=$("#v_fis_razonsocial").val();
  var rfc=$("#v_fis_rfc").val();
  var email=$("#correofiscal").val();
  var codigopostal=$("#v_fis_cp").val();
  var formapago=$("#formapago").val();
  var metodopago=$("#metodopago").val();
  var v_pais=$("#v_fis_pais").val();
  var v_estado=$("#v_fis_estado").val();
  var v_municipio=$("#v_fis_municipio").val();
  var v_colonia=$("#v_fis_colonia").val();
  var v_calle=$("#v_fis_direccion").val();
  var v_noexterior=$("#v_fis_no_ext").val();
  var v_nointerior=$("#v_fis_no_int").val();
  var textovpais= $('#v_fis_pais option:selected').text();
  var textovestado= $('#v_fis_estado option:selected').text();
  var textovmunicipio=$("#v_fis_municipio option:selected").text();
  var id=$("#v_idfactura").val();
  var v_usocfdi=$("#usocfdi").val();

  var bandera=1;
  var pagina="Guardardatosfiscales.php";
   
  
    	var datos = new FormData();

		var archivos = document.getElementById("image"); //Damos el valor del input tipo file
		var archivo = archivos.files; //Obtenemos el valor del input (los arcchivos) en modo de arreglo

		//Como no sabemos cuantos archivos subira el usuario, iteramos la variable y al
		//objeto de FormData con el metodo "append" le pasamos calve/valor, usamos el indice "i" para
		//que no se repita, si no lo usamos solo tendra el valor de la ultima iteracion
		for (i = 0; i < archivo.length; i++) {
			datos.append('archivo', archivo[i]);
		}

		datos.append('id', id);
		datos.append('razonsocial', razonsocial);
		datos.append('v_rfc', rfc);
		datos.append('v_correo', email);
		datos.append('v_codigopostal', codigopostal);
		datos.append('formapago', formapago);
		datos.append('metodopago', metodopago);
		datos.append('v_pais', v_pais);
		datos.append('v_estado', v_estado);
		datos.append('v_municipio', v_municipio);
		datos.append('v_colonia', v_colonia);
		datos.append('v_calle', v_calle);
		datos.append('v_noexterior', v_noexterior);
		datos.append('v_nointerior', v_nointerior);
		datos.append('v_usocfdi', v_usocfdi);
		datos.append('textovpais', textovpais);
		datos.append('textovestado', textovestado);
		datos.append('textovmunicipio', textovmunicipio);




    if (razonsocial=='') {

      bandera=0;
    }

    if (rfc=='') {
      bandera=0;
    }

    if (email=='') {
      bandera=0;
    }
    if (codigopostal=='') {
      bandera=0;
    }

     if (v_pais==null) {
      bandera=0;
    }

    if(v_estado==null) {
      bandera=0;
    }
    if (v_municipio==null) {
      bandera=0;
    }
    if (v_colonia=='') {
      bandera=0;
    }
    if (v_calle=='') {
      bandera=0;
    }
    if (formapago==null) {
       bandera=0;
    }

     if (metodopago==null) {
       bandera=0;
    }

    if(v_usocfdi==null) {
       bandera=0;
    }

    if (bandera==1) {
  $.ajax({
    type: 'POST',
    dataType: 'json',
    url: urlphp+pagina,
    contentType: false, //Debe estar en false para que pase el objeto sin procesar
	data: datos, //Le pasamos el objeto que creamos con los archivos
	processData: false, //Debe estar en false para que JQuery no procese los datos a enviar
	cache: false, //Para que
    success: function(datos){
    resultimagendatosfactura=[];
    $("#modaldatofiscal").modal('hide');
      ObtenerListadoDatosFiscales();
     
    
    },error: function(XMLHttpRequest, textStatus, errorThrown){ 
      var error;
        if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
        if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
                console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
          }
    });

}else{

  var msj="";

      

    if (razonsocial=='') {

       $(".lirazonsocial").removeClass('is-valid');
      $(".lirazonsocial").addClass('is-invalid');


    }

    if (rfc=='') {
    $(".lirfc").removeClass('is-valid');
      $(".lirfc").addClass('is-invalid');

    }

    if (email=='') {
     $(".liemail").removeClass('is-valid');
      $(".liemail").addClass('is-invalid');

    }
    if (codigopostal=='') {

       $(".licodigopostal").removeClass('is-valid');
      $(".licodigopostal").addClass('is-invalid');

    }

     if (v_pais==null) {

       $(".lipais").removeClass('is-valid');
      $(".lipais").addClass('is-invalid');

    }


    if(v_estado==null) {
     
       $(".liestado").removeClass('is-valid');
      $(".liestado").addClass('is-invalid');

    }
    if (v_municipio==null) {
      
       $(".limunicipio").removeClass('is-valid');
      $(".limunicipio").addClass('is-invalid');

    }
    if (v_colonia=='') {
     $(".licolonia").removeClass('is-valid');
      $(".licolonia").addClass('is-invalid');
    }
    if (v_calle=='') {
     $(".licalle").removeClass('is-valid');
     $(".licalle").addClass('is-invalid');
    }


     if (formapago==null) {
        $(".liformapago").removeClass('is-valid');
      $(".liformapago").addClass('is-invalid');

    }

     if (metodopago==null) {

         $(".limetodopago").removeClass('is-valid');
      $(".limetodopago").addClass('is-invalid');


    }

    if(v_usocfdi==null) {
      
       $(".liusocfdi").removeClass('is-valid');
      $(".liusocfdi").addClass('is-invalid');


    }
    if (bandera==0) {

      msj+="Te falta por agregar una opción obligatoria<br>";
    }

  /*  if (resultimagendatosfactura.length==0) {
      msj+="Falta por agregar al menos una imagen<br>";
    }*/
    alert(msj);


  }
}


function ObtenerClientesFiltro() {

	$.ajax({
		url:'catalogos/pagos/ObtenerAlumnos.php', //Url a donde la enviaremos
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
		  		<input  type="checkbox"   value="`+respuesta[i].idusuarios+`" class="form-check-input chkalumno chkcliente_" id="inputcli_`+respuesta[i].idusuarios+`_`+`" onchange="SeleccionarCliente(`+respuesta[i].idusuarios+`,'`+nombre+`')">
		  		<label class="form-check-label" for="flexCheckDefault" style="margin-top: 0.2em;">`+respuesta[i].idusuarios+'-'+nombre+`</label> 
				</div>						    		

			`;
		}
		$("#divusuarios").html(html);
	}
}

function SeleccionarCliente(idcliente,nombre) {
	// body...
	 if($("#inputcli_"+idcliente+"_").is(':checked')){
	  	  $(".chkcliente_").prop('checked',false);

	 		$("#inputcli_"+idcliente+"_").prop('checked',true);
	 		//CrearSesionUsuario(idcliente);
	  	 	clienteseleccionado=idcliente;
	  	 	//$("#btncontinuarcliente").css('display','');
	  	 	$("#btncontinuarcliente2").css('display','');

	  	  }else{

	  	  $(".chkcliente_").prop('checked',false);
	  	 	$("#btncontinuarcliente").css('display','none');
	  	 	$("#btncontinuarcliente2").css('display','none');

	  	  }

	$(".btnseleccionarcliente").attr('onclick','CrearSesionUsuario('+idcliente+')');

}

function CrearSesionUsuario(idcliente) {
	
	var datos="idcliente="+idcliente;
	$.ajax({
		url:'catalogos/pagos/CrearSesionUsuario.php', //Url a donde la enviaremos
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
			
	  	SeleccionarClientePagos(idcliente);
		$(".eleccion").css('display','block');	
			}
	});
}

function AbrirModalDetalleOperacion() {
	// body...
	//var detalle=$(".detallepago").html();
	var lblsubtotal=$("#subtotal").text();
	var lblmonedero=$("#monedero").text();
	var lbldescuento=$("#descuento").text();
	var lbldescuentomem=$("#descuentomembresia").text();
	var lblcomision=$(".lblcomision").text();
	var lbltotal=$("#total").text();

	$("#modaldetalleope").modal();

	//if (NtabName=='punto-venta') {
		$("#tbllistardetalle").html('');
		CargarProductosSeleccionados2('tbllistardetalle');
	//}

	//if (NtabName=='pagos') {

		CargarPagosElegidosSeleccionados2('tbllistardetalle');

	//}

	
	var detalletotal=`
		<div class="row detallepago" style="">
	<div class="col-md-6" style="
    margin: 0;
    padding: 0;">
		<div class="">
			<div class="col-md-12">
				<div class="card">
				<div class="card-body" style="    padding: 1.25rem 0rem 1rem 1rem;">
			<div class="row" style="
			       
			    ">
			    	<div class="col-md-12" style="font-size: 16px;">SUBTOTAL: </div>
			    	<div class="col-md-12" style="font-size: 16px;">MONEDERO: </div>
			
					<div class="col-md-12 divcomision" style="font-size: 16px;display: none;">COMISIÓN: </div>

				<div class="col-md-12" style="font-size: 20px;">TOTAL:</div>

			</div>
		</div>
	</div>
	</div>
	</div>
</div>
	<div class="col-md-6" style="font-size: 16px;">

		<div class="row" >
			<div class="col-md-12">
				<div class="card">
				<div class="card-body" style="padding: 1.25rem 1rem 1rem 1rem;">
			<div class="row">
				<div class="col-md-12" style="text-align: right;">$<span id="subtotal" class="" style="font-size: 16px;">`+lblsubtotal+`</span></div>
						<div class="col-md-12" style="text-align: right;">$<span id="" style="font-size: 16px;">`+lblmonedero+`</span></div>
				
				
				`;
		if (parseFloat(lblcomision)>0) {
			detalletotal+=`<div class="col-md-12 divcomision" style="text-align: right;display: none;">
			$<span id="comision" class="" style="font-size: 16px;">0.00</span>
			</div>`;
		}


			detalletotal+=`
			<div class="col-md-12" style="text-align: right;font-size: 20px;/* padding-top: 6px; */">$<span id="">`+lbltotal+`</span>
			</div>
			</div>

			</div>
		</div>
	</div>
	</div>
		</div>
	</div>

	`;

	$("#totales").html(detalletotal);

}

function CargarProductosSeleccionados2(tbllistarseleccionado) {
	
	var pagina="ObtenerCarrito.php";
	$.ajax({
    type: 'POST',
    dataType: 'json',
    url: urlphp+pagina,
    success: function(datos){

    	var carrito=datos.carrito;
    	monederousuario=datos.monedero;
    	elementoscarrito=carrito;
    
	if (elementoscarrito.length>0) {
	var html="";
	if (elementoscarrito.length>0) {
		for (var i = 0; i <elementoscarrito.length; i++) {

		html+=`
		<tr>
	      <td style="text-align:center;">`+elementoscarrito[i].cantidad+`</td>
	      <td style="width: 20%;text-align:center;">`+elementoscarrito[i].nombrepaquete+`</td>
	       
	      <td style="width: 20%;text-align:center;">$`+formato_numero(elementoscarrito[i].costounitario,2,'.',',')+`</td>`;
	      var total=elementoscarrito[i].costototal;
	      html+=`<td style="text-align:center;">$`+formato_numero(total,2,'.',',')+`</td>
		      <td style="width: 20%;text-align:center;">

		      $`+elementoscarrito[i].montomonedero+`
										

		      </td>	`;
		      var resta=parseFloat(elementoscarrito[i].costototal)-parseFloat(elementoscarrito[i].montomonedero);
		    
		     html+= `
		  
		   <td style="text-align:center;">$`+formato_numero(resta,2,'.',',')+`</td>
		    </tr>

			 	`;

			 
		 }


	}

	$("#"+tbllistarseleccionado).append(html);

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

function CargarPagosElegidosSeleccionados2(tbllistarseleccionado) {
	var html=``;

	if (arraypagoscheck.length>0) {
		
		for (var i = 0; i < arraypagoscheck.length; i++) {
				var totaldescuentos=0;
				var totaldescuentosm=0;

			var objetoEncontrado = arraypagos.find(function(objeto) {
					  return objeto.idpago == arraypagoscheck[i];
					});

			var monederoobjeto=0;

			if (pagosguardados.length>0) {
				var objetoEncontrado2 = pagosguardados.find(function(objeto) {
					  return objeto.idpago == arraypagoscheck[i];
					});
				if (objetoEncontrado2!=null) {

					monederoobjeto=objetoEncontrado2.valormonedero;

				}

			}
		
				if (objetoEncontrado!=null) {


					var objetoEncontrado3 = descuentosaplicados.filter(function(objeto) {
					  return objeto.idpago == arraypagoscheck[i];
					});

					var objetoEncontrado4 = descuentosmembresia.filter(function(objeto) {
					  return objeto.idpago == arraypagoscheck[i];
					});




					if (objetoEncontrado3.length>0) {
						for (var k = 0; k < objetoEncontrado3.length; k++) {
							totaldescuentos=totaldescuentos+objetoEncontrado3[k].montoadescontar;
						}
					}

					if (objetoEncontrado4.length>0) {
						for (var l = 0; l < objetoEncontrado4.length; l++) {
							totaldescuentosm=totaldescuentosm+objetoEncontrado4[k].montoadescontar;
						}
					}

						

					html+=`
		 			<tr>
     			    <td style="width: 20%;text-align:center;">1</td>

			      	<td style="width: 20%;text-align:center;">`+objetoEncontrado.concepto+`</td>
			       
			      	<td style="width: 20%;text-align:center;">$`+formato_numero(objetoEncontrado.monto,2,'.',',')+`</td>`;
			      	var total=objetoEncontrado.monto;
			      	html+=`<td style="width: 20%;text-align:center;">$`+formato_numero(total,2,'.',',')+`</td>


				      <td style="width: 20%;text-align:center;">
				      $`+formato_numero(monederoobjeto,2,'.',',')+`
												
				      </td>	`;
				      var resta=parseFloat(total)-parseFloat(totaldescuentos)-parseFloat(totaldescuentosm)-parseFloat(monederoobjeto);

				        html+=`<td style="width: 20%;text-align:center;">$`+totaldescuentos+`</td>`;

				     	html+=`<td style="width: 20%;text-align:center;">$`+totaldescuentosm+`</td>`;

				     	html+=`<td style="width: 20%;text-align:center;">$`+formato_numero(resta,2,'.',',')+`</td>
				    </tr>

		 				`;

				}
		}

		$("#"+tbllistarseleccionado).append(html);

	}
}

function ObtenerSucursales(idsucursalseleccionada) {
	
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
		
	  			PintarSucursalesP(respuesta,idsucursalseleccionada);
	  			CrearSesionSucursal(idsucursalseleccionada)

			}
	});
}

function PintarSucursalesP(resp,idsucursalseleccionada) {
	var html="";
	if (resp.length>0) {
		//CrearSesionSucursal(resp[0].idsucursal);
		for (var i = 0; i <resp.length; i++) {
			
			//html+=`<option value="`+resp[i].idsucursal+`">`+resp[i].titulo+`</option>`;
			html+=`
			<label class="btn btn_dorado catesucursal " id="catebtn_`+resp[i].idsucursal+`" style="margin-right: 10px;    width: 250px;
    height: 36px;">`+resp[i].titulo+`
			<input type="checkbox" id="cates_`+resp[i].idsucursal+`" class="catecheck" onchange="CrearSesionSucursal(`+resp[i].idsucursal+`)" value="0">
			 </label>

			`;

		}


	}
	$("#v_sucursal").html(html);
}

function CrearSesionSucursal(idsucursal) {
	var datos="idsucursal="+idsucursal;
	idsucursalseleccionada=idsucursal;
  $(".catesucursal").removeClass('active');
  $("#cates_"+idsucursal).add('active');

	$.ajax({
		url:'catalogos/pagos/CrearSesionSucursal.php', //Url a donde la enviaremos
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
			openTab('punto-venta');
			$(".btncita").css('display','block');	
			
			ObtenerPaquetesCarrito();
			 			
			}
	});
}

function AgregarNuevo(valor) {
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
			$(".divdatosacceso").css('display','none');
			$(".btnlistado").css('display','none');
			$(".divheader").css('display','none');
			var button=`<button class="btn btn-success" onclick="GuardarCliente('form_usuario','catalogos/clientes/vi_clientes.php','main','catalogos/clientes/ga_clientes.php',0,'`+valor+`')">GUARDAR</button>`;
			$("#footer-modal-forms2").css('display','block');

			$("#modal-footer").css('display','block');
	
			$("#footer-modal-forms2").html(button);
			$("#modal-forms2").modal();
			$(".datosconfi").css('display','block');
			$("#v_celular").attr('onkeyup','ValidarCelularInput()')

			$("#validacioncelular").text('');
			$("#spanrespuesta").text('');
			$("#clave").val('');
			$("#clave2").val('');

			$(".datosconfi").css('padding-top','0px');
			$(".headercard").css('margin-top:0px;');
			},error: function(XMLHttpRequest, textStatus, errorThrown){ 
				var error;
				  	if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
				  	if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
								//alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
					console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
			}
		});
}


function AgregarNuevo2(horainicial,fechaconsulta,
idespecialista) {

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
			$(".divdatosacceso").css('display','none');
			$(".btnlistado").css('display','none');
			$(".divheader").css('display','none');
			var button=`<button class="btn btn-success" onclick="GuardarCliente2('form_usuario','catalogos/clientes/vi_clientes.php','main','catalogos/clientes/ga_clientes.php',0,'`+horainicial+`','`+fechaconsulta+`','`+idespecialista+`')">GUARDAR</button>`;
			$("#footer-modal-forms2").html(button);
			$("#footer-modal-forms2").css('display','block');
			$("#modal-forms2").modal();
			$(".datosconfi").css('display','block');
			$("#v_celular").attr('onkeyup','ValidarCelularInput();');
			$("#validacioncelular").text('');
			$("#spanrespuesta").text('');
			$("#clave").val('');
			$("#clave2").val('');
			$("#modal-footer").css('display','block');

			$(".datosconfi").css('padding-top','0px');
			$(".headercard").css('margin-top','0px');
			$(".divstatus").css('display','none');
			$(".bodycard").css('padding-top','0px');
			//mostrarPassword('clave','icon1');
			//mostrarPassword('clave2','icon2');
			$(".divcontra1").css('display','none');
			$(".divcontra2").css('display','none');
			$(".divfecha").css('display','none');
			$("#spanrespuesta").css('display','none');
			//$("#v_celular").attr('onkeyup','ValidarCelularInput();CoincidirContra2("clave","clave2")');
			},error: function(XMLHttpRequest, textStatus, errorThrown){ 
				var error;
				  	if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
				  	if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
								//alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
					console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
			}
		});
}

function ValidarCelularInput() {
	 ValidarCelular().then(r => {
		  		$("#validacioncelular").text('');

		  	if (r.existe==0) {
		  		$("#validacioncelular").text('');

		  
		  	    var celu=$("#v_celular").val().replace(/[()-\s]/g,'');		  	  
		

		  		$("#clave").val(celu);
		  		$("#clave2").val(celu);
		  	}else{
		  		$("#clave").val("");
		  		$("#clave2").val("");
		  		$("#validacioncelular").text('El celular ya se encuentra registrado');

		  	}

		  });
}


function ValidarCelularInput2() {
	 ValidarCelular().then(r => {
		  		$("#validacioncelular").text('');

		  	if (r.existe==0) {
		  		$("#validacioncelular").text('');

		  
		  	   
		  	}else{
		  		
		  		$("#validacioncelular").text('El celular ya se encuentra registrado');

		  	}

		  });
}
function AbrirModalAgendar(idcategoriapaquete) {
		$("#buscador").css('display','none');

	 $('#modal-forms2').on('shown.bs.modal', function () { 
 
	   		$("#picker4").fullCalendar('render');
			$("#step2").css('display','none');
			ConsultarFechasCalendarioA();
			});

		$('#modal-forms2').on('hidden.bs.modal', function (e) {
		  // Acciones a realizar una vez que se cierra el modal
		  ObtenerPaquetesCarrito();
		});

	 		
  				
	var pagina = "agendarcitamenu.php";
  
	var datos="idsucursal="+idsucursalseleccionada+"&idcategoriapaquete="+idcategoriapaquete+"&fechaselecte="+fechaselecte+"&horainicialselect="+horainicialselect+"&idespecialistaselect="+idespecialistaselect;
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

function Vender(argument) {
	$("#buscador").css('display','block');
}

function ConsultarFechasCalendarioA() {

	   
 
 //alert( yyyy+'-'+mm+'-'+dd);
   // var calendarEl = document.getElementById('picker');

   // var calendar = new FullCalendar.Calendar(calendarEl, {
 
 /* var fecha=new Date();
  var f=fecha.toISOString().split('T')[0];
 
  var anio=f.split('-')[0];
  var mes=f.split('-')[1];
 
  ObtenerFechasCalendarioAgendaA(anio,mes);
  $("#recargar").attr('onclick','ObtenerFechasCalendarioAgenda('+anio+','+mes+')');
  $("#txttitle").css('display','none');*/
 //$(".fc-header-title").html('<h2>'+fechaformato(fecha)+'</h2>');
 //PintarFechaActual();

		 var fecha=new Date();
		        var f=fecha.toISOString().split('T')[0];
		       
		        var anio=f.split('-')[0];
		        var mes=f.split('-')[1];
		       
		        ObtenerFechasCalendarioAgendaA(anio,mes);
		        $("#txttitle").css('display','none');
		                     

 $('.fc-button-prev').click(function(){

          var moment = $('.picker4').fullCalendar('getDate');
      
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
 
    ObtenerFechasCalendarioAgendaA(anio,mes);
   
  //$(".fc-header-title").html('<h2>'+fechaformato(fecha)+'</h2>');

    $("#txttitle").css('display','none');
    $(".horarios").css('display','none');
  });

  $('.fc-button-next').click(function(){
     var moment = $('.picker4').fullCalendar('getDate');
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

       ObtenerFechasCalendarioAgendaA(anio,mes);
     

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



function ObtenerFechasCalendarioAgendaA(anio,mes) {
 

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




function PintarFechaSeleccionadaA(fecha) {

 
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



function ObtenerCategoriasPrincipales() {

	$.ajax({
		url:'catalogos/pagos/CategoriasPrincipales.php', //Url a donde la enviaremos
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
	  			PintarCategorias(respuesta);

			}
	});
}

function PintarCategorias(respuesta) {
	var html="";
	if (respuesta.length>0) {
		for (var i = 0; i < respuesta.length; i++) {
				//funcion="SeleccionarServicio("+respuesta[i].idcategoriapaquete+")";
				funcion="AbrirModalAgendar("+respuesta[i].idcategoriapaquete+")";
			/*if (respuesta[i].detiposervicio==1) {

				funcion="SeleccionarServicio("+elementosFiltrados[i].idpaquete+","+elementosFiltrados[i].precioventa+")";

			}*/

         var foto = respuesta[i].ruta;

            html=`
               <div class="tarjeta cambiarfuente col-md-3" id="tarjeta_${i}" onclick="`+funcion+`" style="margin: 1em;">
                       <div class="card demo-card-header-pic" style="border-radius: 10px;">
                        <div class="card-header align-items-flex-end" style="background-image: url(${foto}); border-radius: 10px 10px 0px 0px; width: auto; height: 100px; background-repeat: round;"></div>
                                <div class="card-body divcpaqueitem" id="divcpaqueitem_`+respuesta[i].idpaquete+`"  style="background: #c7aa6a; border-radius: 0px 0px 10px 10px;">
                                    <p style="margin: 0; text-align: center; color: white;">${respuesta[i].nombre}
                                   
                                    </p>

                                </div>
                            </div>
                        </div>

            `;

            $(".categoriasprincipales").append(html);
		}
	}
}

function ModificarPrecio(idcarrito,servicio) {
	
	$("#modalprecio").modal();
	$("#txtprecio").val('');
	if (servicio==1) {
			$("#btnmodificar").attr('onclick','ModificarPrecioCarrito('+idcarrito+','+servicio+')')

		}else{
			var valor=$("#txtprecio").val();
			$("#btnmodificar").attr('onclick','GuardarModificar2('+idcarrito+','+servicio+')')

		}
}

function ModificarPrecioCarrito(idcarrito,servicio) {
	var valor=$("#txtprecio").val();
	var datos="idcarrito="+idcarrito+"&precio="+valor;

	if (servicio==1) {
			AbrirModalValidacion(idcarrito,valor);

		}else{


		}
	phoneFormatter2('txtusuario');

}

function AbrirModalValidacion(idcarrito,valor) {
	$("#modalprecio").modal('hide');
	$("#modalverificacion").modal();
	$("#respuesta").text('');
	$("#btnguardarprecio").attr('onclick','GuardarModificar('+idcarrito+','+valor+')');
}

function GuardarModificar(idcarrito,valor) {
	var txtcontra=$("#txtcontra").val();
	var txtusuario=$("#txtusuario").val();
	var datos="idcarrito="+idcarrito+"&precio="+valor+"&usuario="+txtusuario+"&contra="+txtcontra;

	$.ajax({
	 url:'catalogos/pagos/GuardarModificarPrecioCarrito.php', //Url a donde la enviaremos
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
	  			$("#txtcontra").val('');
				$("#txtusuario").val('');
	  			if (msj.respuesta==1) {
	  				$("#modalverificacion").modal('hide');
	  				AbrirNotificacion('Se guardó los cambios correctamente','mdi mdi-checkbox-marked-circle');
	  				ObtenerPaquetesCarrito();
	  			}else{


	  				$("#respuesta").text('Usuario o contraseña incorrecta');
	  			}
	  			
			}
	});

}


function GuardarModificar2(idcarrito,valor) {

	var valor=$("#txtprecio").val();


	var datos="idcarrito="+idcarrito+"&precio="+valor;

	$.ajax({
	 url:'catalogos/pagos/GuardarModificarPrecioCarrito2.php', //Url a donde la enviaremos
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
	  			
	  			if (msj.respuesta==1) {
	  				$("#modalprecio").modal('hide');
	  				AbrirNotificacion('Se guardó los cambios correctamente','mdi mdi-checkbox-marked-circle');
	  				ObtenerPaquetesCarrito();
	  			}else{


	  				AbrirNotificacion('No se guardaron los cambios','mdi mdi-checkbox-marked-circle');

	  			}
	  			
			}
	});

}

