function ValidarSeleccionBeneficios() {
	
	var contador=0;
	$(".paquetebeneficio").each(function( index ) {
 		console.log('paquete '+contador);
 		if ($(this).is(':checked')) {

 			contador++;
 			console.log(contador);
 		}

	});

	if (contador>1) {

		$(".masdeuno").css('display','block');

	}else{

		$(".masdeuno").css('display','none');

	}
	// body...
}

function Guardartarjetalealtad(form,regreso,donde,idmenumodulo) {
	

	var chkpaquete=[];
	var paquetebeneficio=[];
	var nombre =$("#v_titulo").val();
	var descripcion=$("#v_descripcion").val();
	var v_fechainicial=$("#v_fechainicial").val();
	var v_fechafinal=$("#v_fechafinal").val();
	var orden=$("#v_orden").val();
	var estatus=$("#v_estatus").val();
	var clientes=[];
	var v_tproductos=$("#v_tproductos").is(':checked')?1:0;
	var v_tproductosbene=$("#v_tproductosbene").is(':checked')?1:0;
	var v_tclientes=$("#v_tclientes").is(':checked')?1:0;
	var cantidadrequerida=$("#v_cantidad").val();
	var cantidadporbeneficio=$("#v_cantidadporbeneficio").val();
	var v_regla=$("#regla").val();
	var v_repeticiones=$("#v_repeticiones").val();
	var v_porvisita=$("#v_porvisita").is(':checked')?1:0;
	//if (v_tproductos==0) {

	$(".chkpaquete").each(function( index ) {
 	
 		if ($(this).is(':checked')) {
 			var id=$(this).attr('id').split('_')[1];
 			chkpaquete.push(id);
 		}

	});

//}

	//if (v_tproductosbene==0) {

	$(".paquetebeneficio").each(function( index ) {

 		if ($(this).is(':checked')) {
 			var id=$(this).attr('id').split('_')[1];
 			paquetebeneficio.push(id);
 		}

	});

//}

	//if (v_tclientes==0) {
	$(".chkcliente_").each(function( index ) {
 		
 		if ($(this).is(':checked')) {
 			var id=$(this).attr('id').split('_')[1];
 			clientes.push(id);
 		}

	});
//}
		$("#lblnombre").removeClass('inputrequerido');
		$("#lbldescripcion").removeClass('inputrequerido');


		var id=$("#id").val();
		var data = new FormData();

		data.append('v_nombre',nombre);
		data.append('v_descripcion',descripcion);
		data.append('v_orden',orden);
		data.append('id',id);
		data.append('v_estatus',estatus);
		data.append('v_fechainicial',v_fechainicial);
		data.append('v_fechafinal',v_fechafinal);
		data.append('v_tproductos',v_tproductos);
		data.append('v_tproductosbene',v_tproductosbene);
		data.append('v_tclientes',v_tclientes);

		data.append('paquetes',chkpaquete);
		data.append('beneficios',paquetebeneficio);
		data.append('clientes',clientes);
		data.append('v_cantidadrequerida',cantidadrequerida);
		data.append('v_cantidadporbeneficio',cantidadporbeneficio);
		data.append('v_regla',v_regla);
		data.append('v_repeticiones',v_repeticiones);
		data.append('v_porvisita',v_porvisita);
		var bandera=1;
		if(nombre==''){
			bandera=0;
		}
		if (descripcion=='') {
			bandera=0;
		}

		if (v_fechainicial=='') {
			bandera=0;
		}


		if (v_fechafinal=='') {
			bandera=0;
		}

		if (cantidadrequerida=='') {
			bandera=0;
		}

		if (cantidadporbeneficio=='') {
			bandera=0;
		}
		if (bandera==1) {
		 $('#main').html('<div align="center" class="mostrar"><img src="images/loader.gif" alt="" /><br />Cargando...</div>')
				 
			setTimeout(function(){
					  $.ajax({
						  url:'catalogos/tarjetalealtad/ga_tarjetalealtad.php', //Url a donde la enviaremos
						type:'POST', //Metodo que usaremos
						contentType: false, //Debe estar en false para que pase el objeto sin procesar
						data: data, //Le pasamos el objeto que creamos con los archivos
						processData: false, //Debe estar en false para que JQuery no procese los datos a enviar
						cache: false, //Para que˘
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
									aparecermodulos(regreso+"?ac=1&idmenumodulo="+idmenumodulo+"&msj=Operacion realizada con exito&idempresas="+resp[1],donde);
							 	 }else{
									aparecermodulos(regreso+"?ac=0&idmenumodulo="+idmenumodulo+"&msj=Error. "+msj,donde);
							  	}			
						  	}
					  });				  					  
			},1000);
		}else{


			if(nombre==''){

				$("#lblnombre").addClass('inputrequerido');
		 	}
		 	if (descripcion=='') {

				$("#lbldescripcion").addClass('inputrequerido');
		 	}

		 	if(v_fechainicial==''){
				$("#lblfechainicial").addClass('inputrequerido');

		 	}
			if(v_fechafinal==''){
				$("#lblfechafinal").addClass('inputrequerido');

			}
			if(cantidadrequerida==''){
				$("#lblcantidarequerida").addClass('inputrequerido');

			}
			if(cantidadporbeneficio==''){

				$("#lblcantidadporbeneficio").addClass('inputrequerido');

			}


		}
	 }
function BorrarDatosTarjetalealtad(idtarjetalealtad,campo,tabla,n,regresar,donde,idmenumodulo) {
	 	
	 	if(confirm("\u00BFEstas seguro de querer realizar esta operaci\u00f3n?"))
	{
var datos='idtarjetalealtad='+idtarjetalealtad;
	$.ajax({
		url:'catalogos/tarjetalealtad/borrarTarjetalealtad.php', //Url a donde la enviaremos
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
		  var resp = msj.respuesta;
		  
			 console.log("El resultado de msj es: "+msj);
			   if( resp == 0 ){
				  aparecermodulos(regresar+"?ac=1&idmenumodulo="+idmenumodulo+"&msj=Operacion realizada con exito",donde);
				}else{
				  aparecermodulos(regresar+"?ac=0&idmenumodulo="+idmenumodulo+"&msj=La tarjeta se encuentra relacionada . "+msj,donde);
				}			
			}
		});
	}
}


function ObtenerProductosTarjeta(idtarjetalealtad) {
				var datos='idtarjetalealtad='+idtarjetalealtad;
	  			$.ajax({
					url:'catalogos/tarjetalealtad/ObtenerProductodosTarjeta.php', //Url a donde la enviaremos
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

						var respuesta=msj.productos;
						for (var i =0; i <respuesta.length; i++) {
							
								$("#inputpaq_"+respuesta[i].idproducto).attr('checked',true);
							}
						

					  	}
				  });
}

function ObtenerBeneficios(idtarjetalealtad) {

				var datos='idtarjetalealtad='+idtarjetalealtad;

				$.ajax({
					  url:'catalogos/tarjetalealtad/ObtenerBeneficios.php', //Url a donde la enviaremos
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
						var respuesta=msj.productos;
						for (var i =0; i <respuesta.length; i++) {
							
								$("#paquetebeneficio_"+respuesta[i].idproducto).attr('checked',true);
							}
							ValidarSeleccionBeneficios();

					  	}
				  });
}

function ObtenerClienterTarjeta(idtarjetalealtad) {
				var datos='idtarjetalealtad='+idtarjetalealtad;

				$.ajax({
					url:'catalogos/tarjetalealtad/ObtenerClienterTarjeta.php', //Url a donde la enviaremos
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
						
						var respuesta=msj.clientes;
						for (var i =0; i <respuesta.length; i++) {
							
								$("#inputcli_"+respuesta[i].idusuario).attr('checked',true);
							}
					  	}
				  });
}

function AbrirModalTarjetaUsuario(idtarjetalealtad) {
 	
 	$("#modaltarjeta").modal();

 	ObtenerUsuariosAsignados(idtarjetalealtad);
 	
 }



 function ObtenerUsuariosAsignados(idtarjetalealtad) {
 	
 	//$('#tbltarjetausuario').empty(); // empty in case the columns change
 		/*var table = new DataTable('#tbltarjetausuario');

 		if ($.fn.DataTable.isDataTable('#tbltarjetausuario')) {
 			    table.destroy();

						}*/

 	var datos='idtarjetalealtad='+idtarjetalealtad;

				$.ajax({
					url:'catalogos/tarjetalealtad/ObtenerAsignacionTarjeta.php', //Url a donde la enviaremos
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
							
							var respuesta=msj.tarjetas;
							PintarTarjetaAsignadas(respuesta);
					  	}
				  });
 }

 function cargarTabla() {
 	 $('#tbltarjetausuario').DataTable( {   
      "pageLength": 100,

      "oLanguage": {
            "sLengthMenu": "Mostrar _MENU_ ",
            "sZeroRecords": "NO EXISTEN TARJETAS ASIGNADAS.",
            "sInfo": "Mostrar _START_ a _END_ de _TOTAL_ Registros",
            "sInfoEmpty": "desde 0 a 0 de 0 records",
            "sInfoFiltered": "(filtered desde _MAX_ total Registros)",
            "sSearch": "Buscar",
            "oPaginate": {
                   "sFirst":    "Inicio",
                   "sPrevious": "Anterior",
                   "sNext":     "Siguiente",
                   "sLast":     "Ultimo"
                   }
            },
       "sPaginationType": "full_numbers", 
      	"paging":   true,
     
      	"order":[],
          "info":true,


    } );
 }

 function PintarTarjetaAsignadas(respuesta) {
 	var estatustarjeta=['Pendiente','Canjeada','Caducada','Listo para canjear'];
 	var html="";
 	if (respuesta.length>0) {
 		for (var i = 0; i <respuesta.length; i++) {
 			var citas=respuesta[i].citastarjeta.split(',');
 			html+=`
 				<tr>
	 				<td>
	 				`+respuesta[i].idusuarios+`-`+respuesta[i].nombreusuario+` `+respuesta[i].paterno+` `+respuesta[i].materno+`</td>
	 				<td>
	 				 <div class="progreso" style="display: flex;justify-content: center;">`;
				  var cantidadrequerida=respuesta[i].cantidadrequerida;
				  var cantidadproducto=respuesta[i].cantidadproducto;
				  	for (var j = 0; j < cantidadrequerida; j++) {

				  		var clase="";
				  		var numero=j+1;
				  		if (numero<=cantidadproducto) {
				  			clase="completado";

				  		}else{

				                clase="incompleto";
				              }
				  		
				  		html+=` <div class=" " > <span class="mdi mdi-checkbox-marked-circle `+clase+`" style="font-size: 20px;"></span>
                      </div>`;
				  	}

				  	if (cantidadrequerida==cantidadproducto && respuesta[i].estatus==0) {
				  		respuesta[i].estatus=3;
				  	}


				   
/*				    <div class="circulo completado"></div>
*/				   
				 
				 html+=`

				  </div>`;

				  if (citas.length>0) {
				  	for (var j = 0; j < citas.length; j++) {
				  		var dividir=citas[j].split('_');


				  		html+=`<p><span>`+dividir[0]+` </span>`;
				  		html+=`<span>`+dividir[1]+` Hrs. </span>`;
				  		html+=`<span>`+dividir[2]+` </span>`;
				  		html+=`<span>`+dividir[3]+`</span></p>`;

				  	}
				  }
				  	var clases="";
				  	if (respuesta[i].estatus==0) {
				  		clases="notapendiente";
				  	}

				  	if (respuesta[i].estatus==1) {
				  		clases="notaaceptado";
				  	}

				  	if (respuesta[i].estatus==3) {
				  		clases="tarjetaparacanjear";
				  	}


	 				html+=`	</td>

	 				<td>
	 					
	 					<p>
	 					<span class="`+clases+`">`
	 					+estatustarjeta[respuesta[i].estatus]+`</span></p>`;
	 					if (respuesta[i].estatus==1) {

	 						html+=`<p>Fecha de canje:`+respuesta[i].fechacompra+`</p>`;
	 						html+=`<p>Servicio:`+respuesta[i].descripcioncompra+`</p>`;

	 					}

	 					

	 				html+=`</td>

 				</tr>

 			`;
 		}
 	}

 	$("#datostablatarjeta").html(html);


 	// Verificar si la tabla ya tiene DataTables aplicado
	if (!$.fn.DataTable.isDataTable('#tbltarjetausuario')) {
	    // Si no tiene DataTables aplicado, inicializar DataTables
	   
	 	cargarTabla();
	}

 }


 function AbrirModalTarjeta(idtarjetalealtad) {
 		$("#modaltarjetavistas").modal();
 		$("#datostablatarjetacitas").html('');

 	ObtenerUsuariosAsignadosVisita(idtarjetalealtad);
 }


function ObtenerUsuariosAsignadosVisita(idtarjetalealtad) {
	
	var datos='idtarjetalealtad='+idtarjetalealtad;

				$.ajax({
					url:'catalogos/tarjetalealtad/ObtenerAsignacionTarjetaVisitas.php', //Url a donde la enviaremos
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
							
							var respuesta=msj.tarjetas;
							PintarTarjetaAsignadasVisita(respuesta);
					  	}
				  });
}



 function PintarTarjetaAsignadasVisita(respuesta) {
 	var estatustarjeta=['Pendiente','Canjeada','Caducada','Listo para canjear'];
 	var html="";
 	if (respuesta.length>0) {
 		for (var i = 0; i <respuesta.length; i++) {
 			var citas=respuesta[i].citastarjeta.split(',');
 			html+=`
 				<tr>
	 				<td>
	 				`+respuesta[i].idusuarios+`-`+respuesta[i].nombreusuario+` `+respuesta[i].paterno+` `+respuesta[i].materno+`</td>
	 				<td>`;
				

					html+=respuesta[i].citastarjeta;


	 				html+=`	

	 				</td>
	 				<td>
	 					`;

	 			var citas=respuesta[i].citasasignadas;
	 			console.log(respuesta[i].citasasignadas);

 				 if (citas.length>0) {
				  	for (var j = 0; j < citas.length; j++) {

				  		if (citas[j].citastarjeta2!='' && citas[j].citastarjeta2!=null) {

				  		
				  			var dividir=citas[j].citastarjeta2.split('_');

				  		html+=`<p><span>`+dividir[0]+` </span>`;
				  		html+=`<span>`+dividir[1]+` Hrs. </span>`;
				  		html+=`<span>`+dividir[2]+` </span>`;
				  		html+=`<span>`+dividir[3]+`</span></p>`;
	
				  		}
				  		
				  	}
				  }
	 					

	 				html+=`

	 				</td>


 				</tr>

 			`;
 		}
 	}

 	$("#datostablatarjetacitas").html(html);


 	// Verificar si la tabla ya tiene DataTables aplicado
	if (!$.fn.DataTable.isDataTable('#tbltarjetausuario2')) {
	    // Si no tiene DataTables aplicado, inicializar DataTables
	   
	 	cargarTabla2();
	}

 }

 function cargarTabla2() {
 	 $('#tbltarjetausuario2').DataTable( {   
      "pageLength": 100,

      "oLanguage": {
            "sLengthMenu": "Mostrar _MENU_ ",
            "sZeroRecords": "NO EXISTEN TARJETAS ASIGNADAS.",
            "sInfo": "Mostrar _START_ a _END_ de _TOTAL_ Registros",
            "sInfoEmpty": "desde 0 a 0 de 0 records",
            "sInfoFiltered": "(filtered desde _MAX_ total Registros)",
            "sSearch": "Buscar",
            "oPaginate": {
                   "sFirst":    "Inicio",
                   "sPrevious": "Anterior",
                   "sNext":     "Siguiente",
                   "sLast":     "Ultimo"
                   }
            },
       "sPaginationType": "full_numbers", 
      	"paging":   true,
     
      	"order":[],
          "info":true,


    } );
 }