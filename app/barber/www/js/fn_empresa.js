function ObtenerDetalleEmpresa() {
	
	var pagina = "ObtenerDetalleEmpresa.php";
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: urlphp+pagina,
		async:false,
		success: function(datos){
			
			var respuesta=datos.respuesta;
			PintarDetalleEmpresa(respuesta);
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

function PintarDetalleEmpresa(respuesta) {
		
		imagen=urlimagenes+`empresa/imagenempresa/`+codigoserv+respuesta[0].imagen;
		$(".imagenempresa").attr('src',imagen);

		var descripcion=respuesta[0].descripcion;
		var des=descripcion.split('|');
		var html="";
		for (var i = 0; i < des.length; i++) {
					html+=`<p>`+des[i]+`</p>`;	
		}

		$(".descripcionempresa").html(html);
		var nombre=respuesta[0].nombre;
		$(".nombreempresa").html(nombre);
}

function AbrirModalDescripcion() {
	

      var html="";  
html+=` <div class="sheet-modal my-sheet-swipe-to-close1" style="height: 100%;background: none;">
            
            <div class="sheet-modal-inner" style="background: white;border-top-left-radius: 20px;border-top-right-radius:20px; ">
              <div class="iconocerrar link sheet-close" style="z-index:100;">
                                        <span class="material-icons-outlined" style="    font-size: 30px;">cancel</span>
                                     </div>

              <div class="" style="height: 100%;">
                   <div class="row">
                                 <div class="col-20">
                                    
                                </div>

                                 <div class="col-60">
                                 <span class="titulomodal"></span>
                                 </div>
                                 <div class="col-20">
                                 <span class="limpiarfiltros"></span>
                                 </div>
                             </div>
                <div class="page-content" style="background: white; height: 100%;width: 100%;border-radius: 20px;">
                        
                             <div class="" style="position: absolute;top:2em;width: 100%;">
                                
                                  <div class="">
                                      <div class="block" style="margin-right:1em;margin-left:1em;">

                                       `;
                
                                    html+=`
                                           
                                           <div class="row" style="margin-bottom:1em;margin-top:3em;">
                                                 <div class="col-100 fotoimagen">
                                                    <div class="  margin-bottom" style="margin-right: 1em;
                                              margin-left: 1em;">
                                                        <div class="card-content ">
                                                         <img src="" alt="" style="    width: 100%;height: 70%;border-radius: 10px;" class="imagenempresa" />
                                                        </div>
                                                    </div>
                                                </div> 
                                           
                                            </div>
                                            <div class="row">
                                               <div class="descripcionempresa">

                                               </div>
                                                 

                                            </div>


                                        </div>
                                    </div>
                             </div>
                        </div>
                        
                      </div>
                    </div>
                  </div>`;
      dynamicSheet2 = app.sheet.create({
        content: html,
        swipeToClose: true,
        backdrop: true,
        // Events
        on: {
          open: function (sheet) {
            ObtenerDetalleEmpresa();
          },
          opened: function (sheet) {
            console.log('Sheet opened');
          },
        }
      });

       dynamicSheet2.open();

}