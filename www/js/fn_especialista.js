/*function AgregarSucursal() {
	
	var promesa=ObtenerSucursales();

	promesa.then(r => {



	});


}
*/

function ObtenerSucursales(){
 //return new Promise(function(resolve, reject) {

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
						
							resolve(msj.respuesta);
					  	}
				  });
	 	//	});
}