function ObtenerListadoHijos() {
	var iduser=localStorage.getItem('id_user');
	var datos="id_user="+iduser;

		var pagina="ObtenerListadoHijos.php";

		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: urlphp+pagina,
			data: datos,
			async:false,
			success: function(r){
				var respuesta=r.respuesta;
					
				PintarListadoHijos(respuesta);

			},error: function(XMLHttpRequest, textStatus, errorThrown){ 
					var error;
				  	if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
				  	if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
					//alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
					console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
				}
		});
}

function PintarListadoHijos(respuesta) {
	var html="";

	if (respuesta.length>0) {
		for (var i = 0; i < respuesta.length; i++) {
			html+=`
			<div class="card card-outline" style="    background: no-repeat;
    color: white;
    margin: 0;
    border: 1px solid #c7aa6a;
    margin-bottom: 1em;">
    
      <div class="card-content card-content-padding">
        <div class="row">
          <div class="col-80">
            <span class="spnombre">`+respuesta[i].nombre+` `+respuesta[i].paterno+` `+respuesta[i].materno+`</span>
          </div>
          <div class="col-20">
            	<button class="button color-red" type="button" onclick="AbrirModalUsuarioHijo(`+respuesta[i].idusuarios+`)">
                        <span class="material-icons-outlined" style="font-size: 30px;margin-left:1em;margin-right:1em;">
                        delete
                        </span>
                </button>
          </div>

        </div>
      </div>
      </div>

			`;
		}
	}

	$("#listadohijos").html(html);
}


function GuardarNuevoHijo() {

	$(".linombre").removeClass('is-invalid');
	$(".lipaterno").removeClass('is-invalid');
	$(".limaterno").removeClass('is-invalid');
	$(".lifechanacimiento").removeClass('is-invalid');
	$(".lisexo").removeClass('is-invalid');

	$(".linombre").addClass('is-valid');
	$(".lipaterno").addClass('is-valid');
	$(".limaterno").addClass('is-valid');
	$(".lifechanacimiento").addClass('is-valid');

	
	var v_nombre=$("#v_nombre").val();
	var v_paterno=$("#v_paterno").val();
	var v_materno=$("#v_materno").val();
	var v_fecha=$("#v_fecha").val();

 	var sistema=localStorage.getItem("SO");

	var rutaine=localStorage.getItem('rutaine');

	var tokenfirebase=localStorage.getItem('tokenfirebase');
	var id_user=localStorage.getItem('id_user');
	var datos="v_nombre="+v_nombre+"&v_paterno="+v_paterno+"&v_materno="+v_materno+"&v_fecha="+v_fecha+"&sistema="+sistema+"&tokenfirebase="+tokenfirebase+"&id_user="+id_user+"&sexoseleccionado="+sexoseleccionado;
	var pagina = "registrohijo.php";

	var msj="";
	var bandera=1;
	if (v_nombre=='') {
		usuario1='Campo requerido';
		bandera=0;
	}


	if (v_paterno=='') {
		apellidop1='Campo requerido';
		bandera=0;
	}

	if (v_materno=='') {
		apellidom1='Campo requerido';
		bandera=0;
	}


	if (isValidDate(v_fecha)==false) {

		bandera=0;
	}

	

	if (bandera==1) {

		
			var r=0;
		if (r==0) {
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: urlphp+pagina,
			data: datos,
			crossDomain: true,
			cache: false,
			beforeSend: function() {
        // setting a timeout
        app.preloader.show();

    },
    success: function(datos){
    	app.preloader.hide();
    	var respuesta=datos.respuesta;

		if (respuesta==1) {

			GoToPage("registrohijos");

		}
				
					},error: function(XMLHttpRequest, textStatus, errorThrown){ 
						app.preloader.hide();

						alert('Error de conexión');
						var error;
				  		if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
				  		if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
						//alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
						console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
					}
				});
		}else{

			alerta('','El correo ya se encuentra registrado');
	}
	//});

	}else{



		

		if (v_nombre=='') {
			nombre1='Campo requerido';
			$("#lblnombre").html(nombre1);
			$(".linombre").addClass('is-invalid');

			bandera=0;
		}

		if (v_paterno=='') {
			apellidop1='Campo requerido';
			$("#lblapellidop").html(apellidop1);
			$(".lipaterno").addClass('is-invalid');

			bandera=0;
		}

		if (v_materno=='') {
			apellidom1='Campo requerido';
			$("#lblapellidom").html(apellidom1);
	    	$(".limaterno").addClass('is-invalid');

			bandera=0;
		}


			if (isValidDate(v_fecha)==false) {

				bandera=0;
				$(".lifechanacimiento").addClass('is-invalid');

			}
			if (bandera==0) {

				alerta('','Te falta por capturar una opción obligatoria');
			}


	}

}

function AbrirModalUsuarioHijo(idusuario) {
	 var aviso='¿Seguro que desea eliminar el registro?';

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
                          <div class="row" style="margin-left: 2em;margin-right: 2em;margin-top:20px;">
                          <div class="col-100">
                          <p class="cambiarfuente cambiarfuente2" style="color: #c7aa6a;font-size: 30px;text-align: center;line-height: 1;" class="cambiarfuente `+estiloparrafo+`">`+aviso+`</p>
                          </div>

                          </div>

                          <div class="row margin-bottom " style="padding-top: 1em;    margin-left: 2em;margin-right: 2em;margin-top:20px;">
                            <div class="col-50">
                            <button style="background: #C7AA6A;color:white;" type="button" class="button button-fill color-theme button-large button-raised  cambiarfuente" onclick="EliminacionHijo(`+idusuario+`)">Si</button>
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
            

          },
          opened: function (sheet) {
            console.log('Sheet opened');

          },
        }
      });
    dynamicSheet1.open();
}

function EliminacionHijo(idusuario) {
	
	    var datos="idusuariohijo="+idusuario;
		var pagina="EliminacionHijo.php";

		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: urlphp+pagina,
			data: datos,
			async:false,
			success: function(datos){
				var respuesta=datos.respuesta;
					
				dynamicSheet1.close();
					if (respuesta==1) {

						ObtenerListadoHijos();
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

function VerificacionPantalla() {
	
	var promesa=VerificarTieneHijos(1);

	promesa.then(r => {
		if (r.length==0) {
			VerificarSitieneporcanjear();
		}

	});

}

//VerificarSitieneporcanjear();

function VerificarTieneHijos(variable) {
	 return new Promise(function(resolve, reject) {

	var iduser=localStorage.getItem('id_user');
	var datos="id_user="+iduser;

		var pagina="ObtenerListadoHijos.php";

		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: urlphp+pagina,
			data: datos,
			async:false,
			success: function(r){
				var respuesta=r.respuesta;
					
				if (respuesta.length>0) {

					AbriModalEleccion(respuesta,variable);
				}
				resolve(respuesta);

			},error: function(XMLHttpRequest, textStatus, errorThrown){ 
					var error;
				  	if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
				  	if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
					//alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
					console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
				}
		});
	});
}

/*function AbriModalEleccion(respuesta) {
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
}*/

function AbriModalEleccion(resp,variable) {
  
var parrafo="¿Para quién es la cita?";
 
var iduser=localStorage.getItem('id_user');
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
    								text-align: center;font-weight: 600;color: #c7aa6a;"></span>
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

          
                          html+=`

                          <div class="row margin-bottom " style="padding-top: 1em; margin-top: 10px;display: flex;justify-content: center;">
                         `;

                       
                html+=` 
                        
                <div class="" style="width:100%;">
                                 
               `;
                          
                 

      html+=` <div class="row" style="margin-left: 1em;">`;
      html+=`
     <div class="tarjeta contadortarjeta cambiarfuente  " style="width:100%;"  onclick="ElegirUsuarioCita(`+iduser+`,`+variable+`)">
     <div class="card demo-card-header-pic" style="border-radius: 10px;">  
      

    <div class="cardcortesia" id="cardcortesia_0"  style="display: flex;
    justify-content: center;
    align-items: center;text-align: center;height: 50px;background:#9c9c9c ;font-size: 18px;   
    border-radius: 10px;">
           <p style="margin:0px;text-align:center;color: white;">Para mí</p> </div>
          </div>
          </div>

      `;

    if (resp.length>0) {

    for (var i = 0; i < resp.length; i++) {
      
             
     html+=`
      <div class="tarjeta contadortarjeta cambiarfuente  " style="width:100%;"   onclick="ElegirUsuarioCita(`+resp[i].idusuarios+`,`+variable+`)">
      <div class="card demo-card-header-pic" style="border-radius: 10px;">  

     <div class="cardcortesia" id="cardcortesia_`+resp[i].usuarios+`" style="display: flex;
    justify-content: center;
    align-items: center;text-align: center;height: 50px;background:#9c9c9c ;font-size: 18px;   
    border-radius: 10px;">
           <p style="margin:0px;text-align:center;color: white;">`+resp[i].nombre+` </p> </div>
          </div>
          </div>

      `;
   
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

               

          },
          opened: function (sheet) {
            console.log('Sheet opened');

           
          },
        }
      });

       dynamicSheet1.open();



	
}

function ElegirUsuarioCita(idusuario,variable) {
	dynamicSheet1.close();
	localStorage.setItem('idusuariocita',idusuario);
	if (variable==1) {
			GoToPage('disponibilidadfechasucursal');

		}else{


			GoToPage('detalleproductoservicios');

		}
}