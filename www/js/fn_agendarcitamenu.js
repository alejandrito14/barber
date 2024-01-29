
function ObtenerCategoriasPrincipalesMenu() {

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
	  			//PintarCategoriasMenu(respuesta);

			}
	});
}

function PintarCategoriasMenu(respuesta) {
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


/*function AbrirModalAgendar(idcategoriapaquete) {
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
}*/
