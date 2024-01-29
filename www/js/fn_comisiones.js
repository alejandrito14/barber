
function ObtenerCategoriasPrincipalescomi() {

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
	  			PintarCategoriascomi(respuesta);

			}
	});
}

function PintarCategoriascomi(respuesta) {
	
	var html="";
	if (respuesta.length>0) {
		for (var i = 0; i < respuesta.length; i++) {
				//funcion="SeleccionarServicio("+respuesta[i].idcategoriapaquete+")";
		funcion="AbrirMasCategorias("+respuesta[i].idcategoriapaquete+")";
			
         var foto = respuesta[i].ruta;

            html=`
               <div class="tarjeta cambiarfuente col-md-3" id="tarjeta_${i}"  style="margin: 1em;">
                       <div class="card demo-card-header-pic" style="border-radius: 10px;">
                        <div class="card-header align-items-flex-end" style="background-image: url(${foto}); border-radius: 10px 10px 0px 0px; width: auto; height: 100px; background-repeat: round;">
                        </div>

                                <div class="card-body divcpaqueitem" id="divcpaqueitem_`+respuesta[i].idcategoriapaquete+`"  style="background: #c7aa6a; border-radius: 0px 0px 10px 10px;">
                                   
                                      <input type="checkbox" id="checkboxca_${respuesta[i].idcategoriapaquete}" onchange="SeleccionarCategoriaC(${respuesta[i].idcategoriapaquete});`+funcion+`" class="checkboxca_" name="checkbox">
           							 <label for="checkbox_${respuesta[i].idcategoriapaquete}"  style="margin-left: 5px;">${respuesta[i].nombre}</label>

                                </div>
                            </div>
                        </div>

            `;

            $(".categoriasprincipales").append(html);
		}
	}
}

function SeleccionarCategoriaC(idcategoriapaquete) {
	
	   // Desmarca todos los checkboxes del grupo
    $(".checkboxca_").prop("checked", false);

    // Marca solo el checkbox específico
    $("#checkboxca_" + idcategoriapaquete).prop("checked", true);
}

function SeleccionarCategoriaC2(idcategoriapaquete2) {
	   // Desmarca todos los checkboxes del grupo
    $(".checkboxca").prop("checked", false);

    // Marca solo el checkbox específico
    $("#checkboxca_" +idcategoriapaquete2).prop("checked", true);
}

	function GuardarComisiones(form,regresar,donde,idmenumodulo) {

		var v_especialista=$("#v_especialista").val();
		var v_tipocomision=$("#v_tipocomision").val();
		var v_cantidadcomision=$("#v_cantidadcomision").val();
		var v_estatus=$("#v_estatus").val();

		var cat=[];
		var sub=[];
		var paq=[];
		
		$(".checkboxca_").each(function(index) {
			 if($(this).is(':checked')){
			 	var id=$(this).attr('id');
			 	var dividido=id.split('_')[1];

			 	cat.push(dividido);
			 }

			});

		$(".checkboxca").each(function( index ) {
			 if($(this).is(':checked')){
			 	var id=$(this).attr('id');
			 	var dividido=id.split('_')[1];

			 	sub.push(dividido);
			 }

			});


		$(".checkboxpaquete").each(function( index ) {
			  if($(this).is(':checked')){
			 	var id=$(this).attr('id');
			 	var dividido=id.split('_')[1];

			 	paq.push(dividido);
			 }

			});

		var idcomision=$("#id").val();

		var datos="v_especialista="+v_especialista+"&v_tipocomision="+v_tipocomision+"&v_cantidadcomision="+v_cantidadcomision+"&v_estatus="+v_estatus;
			datos+="&cat="+cat+"&sub="+sub+"&paq="+paq;
			datos+="&idcomision="+idcomision;
 	    $('#main').html('<div align="center" class="mostrar"><img src="images/loader.gif" alt="" /><br />Cargando...</div>')
				
		setTimeout(function(){
		$.ajax({
		url:'catalogos/comisiones/GuardarComision.php', //Url a donde la enviaremos
		type:'POST', //Metodo que usaremos
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
		  			
		  			var resp = msj.split('|');
						
						   console.log("El resultado de msj es: "+msj);
						 	if( resp[0] == 1 ){

								aparecermodulos(regresar+"?ac=1&idmenumodulo="+idmenumodulo+"&msj=Operacion realizada con exito",donde);
						 	 	
						 	 }else{
								aparecermodulos(regresar+"?ac=0&idmenumodulo="+idmenumodulo+"&msj=Error. "+msj,donde);
						  	}			


					}
				});

			});
					
				
	}
				
function BorrarDatosComision(idcomision,regresar,donde,idmenumodulo) {
	

if(confirm("\u00BFEstas seguro de querer realizar esta operaci\u00f3n?"))
	{
	var datos='idcomisionespecialista='+idcomision;
	$.ajax({
		url:'catalogos/comisiones/borrarComision.php', //Url a donde la enviaremos
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
				  aparecermodulos(regresar+"?ac=0&idmenumodulo="+idmenumodulo+"&msj=La entrada se encuentra relacionada . "+msj,donde);
				}			
			}
	});
}
}
	

