function CargarSucursales()
{
	
	$.ajax({
		type:'GET',
		url: 'catalogos/reportes/li_sucursales.php',
		cache:false,
		async:false,
		error:function(XMLHttpRequest, textStatus, errorThrown){
		 console.log(arguments);
		 var error;
		 if (XMLHttpRequest.status === 404) error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error 
		 if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error 
		alert(error);						  
		 },
		success : function (msj){
		
			$('#v_idsucursales').html(msj);   
			}
		}); 
}


function CargarFiltrosreportes(idreporte) {

	if (idreporte>0) {
	var datos="idreporte="+idreporte;

	$.ajax({
		type:'POST',
		url: 'catalogos/reportes/Obtenerfiltrosreporte.php',
		data:datos,
		dataType:'json',
		cache:false,
		async:false,
		error:function(XMLHttpRequest, textStatus, errorThrown){
		 console.log(arguments);
		 var error;
		 if (XMLHttpRequest.status === 404) error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error 
		 if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error 
		alert(error);						  
		 },
		success : function (msj){
			
			var respuesta=msj.respuesta;
			var habilitarsucursal=respuesta.habilitarsucursal;
			var habilitarfechainicio=respuesta.habilitarfechainicio;
			var habilitarfechafin=respuesta.habilitarfechafinal;
			var funcion=respuesta.funcion;
			var funcionpantalla=respuesta.funcionpantalla;
			Filtrosreportes(habilitarsucursal,habilitarfechainicio,habilitarfechafin,funcion,funcionpantalla);
			
			}
		}); 
	}else{

		$("#alumnos").css('display','none');
		$("#servicios").css('display','none');
		$("#fechainicio").css('display','none');
		$("#fechafinal").css('display','none');
		$("#btngenerar").css('display','none');
		$("#btnpantalla").css('display','none');

	}
}

function Filtrosreportes(habilitarservicio,habilitarfechainicio,habilitarfechafinal,funcion,funcionpantalla) {

	//$("#servicios").css('display','none');
	$("#fechainicio").css('display','none');
	$("#fechafinal").css('display','none');
	$("#btngenerar").css('display','block');
	//$("#btngenerar").attr('onclick',funcion);
	//$("#horainicio").attr('display','none');
	//$("#horafin").attr('display','none');
	$("#btnpantalla").css('display','block');
	$("#btngenerar").attr('onclick','ejecutar('+funcionpantalla+')');

	$("#btnpantalla").attr('onclick',funcion);

	/*if (habilitarservicio==1) {

		$("#servicios").css('display','block');
		CargarServiciosReporte();
		$("#v_servicios").attr('onchange','CargarAlumnos()');
	}

	if (habilitaralumnos==1) {
		$("#alumnos").css('display','block');
		CargarAlumnosReporte();
	}*/
	

	if (habilitarfechainicio==1) {

		$("#fechainicio").css('display','block');
	
	}

	if (habilitarfechafinal==1) {

		$("#fechafinal").css('display','block');
	
	}

	/*if (habilitarhorainicio==1) {

		$("#horainicio").css('display','block');
	
	}
	if (habilitarhorafin==1) {
		$("#horafin").css('display','block');
	}*/
	
}

// Función para mostrar el modal de "Cargando"
function mostrarModalCargando() {
  // Código para mostrar el modal (puedes personalizarlo según tus necesidades)
 

  $('#mainc').html('<div align="center" class="mostrar"><img src="images/loader.gif" alt="" /><br />Cargando...</div>')
  $('#modalCargando').modal({backdrop: 'static', keyboard: false})

  //$("#modalCargando").modal();


}

// Función para ocultar el modal de "Cargando"
function ocultarModalCargando() {
  // Código para ocultar el modal (puedes personalizarlo según tus necesidades)
  $("#modalCargando").modal('hide');
}

function ejecutar(funcionpantalla) {
mostrarModalCargando();

  setTimeout(function() {
    // Ejecuta la función dinámica asignada al botón y espera a que termine
    ejecutarFuncionDinamica(funcionpantalla).then(function() {
      // Oculta el modal cuando la función haya terminado
      ocultarModalCargando();
    });

     }, 2000); 
}

function CargarCategorias() {

	$.ajax({
		type:'GET',
		url: 'catalogos/reportes/li_categorias.php',
		cache:false,
		async:false,
		error:function(XMLHttpRequest, textStatus, errorThrown){
		 console.log(arguments);
		 var error;
		 if (XMLHttpRequest.status === 404) error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error 
		 if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error 
		alert(error);						  
		 },
		success : function (msj){
		
			$('#v_categoria').html(msj);   
			}
		}); 
}

function GenerarReporteVentas(){

	var idservicio=$("#v_servicios").val();
	var fechainicio=$("#fechainicio1").val();
	var fechafin=$("#fechafin").val();

	var horainicio=$("#v_horainicio").val();
	var horafin=$("#v_horafin").val();

	var fechainicio1=fechainicio.split(' ')[0];
	var fechafin1=fechafin.split(' ')[0];

	var datos="idservicio="+idservicio+"&alumno="+v_alumnos+"&fechainicio="+fechainicio1+"&fechafin="+fechafin1+"&horainicio="+horainicio+"&horafin="+horafin;

	var url='modelosreportes/ventas/excel/rpt_Ventas_general.php?'+datos; 

	//alert(url);
	window.open(url, '_blank');	

}

function GenerarPantallaReporteVentas(){

	var idservicio=$("#v_servicios").val();
	var fechainicio=$("#fechainicio1").val();
	var fechafin=$("#fechafin").val();

	var horainicio=$("#v_horainicio").val();
	var horafin=$("#v_horafin").val();

	var fechainicio1=fechainicio.split(' ')[0];
	var fechafin1=fechafin.split(' ')[0];
	var v_alumnos=$("#v_alumnos").val();

	var datos="idservicio="+idservicio+"&alumno="+v_alumnos+"&fechainicio="+fechainicio1+"&fechafin="+fechafin1+"&horainicio="+horainicio+"&horafin="+horafin;

	aparecermodulos('catalogos/reportes/GenerarPantallaReporteVentas.php?'+datos,'contenedor_reportes'); 

}

function GenerarReporteDetalladoVentas(){


	var idservicios=$("#v_servicios").val();
	var fechainicio=$("#fechainicio1").val();
	var fechafin=$("#fechafin").val();

	var horainicio=$("#v_horainicio").val();
	var horafin=$("#v_horafin").val();

	var fechainicio1=fechainicio.split(' ')[0];
	var fechafin1=fechafin.split(' ')[0];

	var datos="idservicios="+idservicios+"&fechainicio="+fechainicio1+"&fechafin="+fechafin1+"&horainicio="+horainicio+"&horafin="+horafin;

	var url='modelosreportes/ventas/excel/rpt_Ventas_detalle.php?'+datos; 
	window.open(url, '_blank');

}

function CargarServiciosReporte() {

	$.ajax({
		type:'GET',
		url: 'catalogos/reportes/li_servicios.php',
		cache:false,
		async:false,
		error:function(XMLHttpRequest, textStatus, errorThrown){
		 console.log(arguments);
		 var error;
		 if (XMLHttpRequest.status === 404) error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error 
		 if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error 
		alert(error);						  
		 },
		success : function (msj){
		
			$('#v_servicios').html(msj);   
			}
		}); 
}

function CargarAlumnosReporte() {

	$.ajax({
		type:'GET',
		url: 'catalogos/reportes/li_alumnos.php',
		cache:false,
		async:false,
		error:function(XMLHttpRequest, textStatus, errorThrown){
		 console.log(arguments);
		 var error;
		 if (XMLHttpRequest.status === 404) error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error 
		 if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error 
		alert(error);						  
		 },
		success : function (msj){
		
			$('#v_alumnos').html(msj);   
			}
		}); 
}



function CargarAlumnos() {
	var idservicio=$("#v_servicios").val();
	var datos="idservicio="+idservicio;
	$.ajax({
		type:'GET',
		url: 'catalogos/reportes/li_alumnos.php',
		cache:false,
		data:datos,
		async:false,
		error:function(XMLHttpRequest, textStatus, errorThrown){
		 console.log(arguments);
		 var error;
		 if (XMLHttpRequest.status === 404) error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error 
		 if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error 
		alert(error);						  
		 },
		success : function (msj){
		
			$('#v_alumnos').html(msj);   
			}
		}); 
}

function GenerarReporteCitas() {
	var fechainicio=$("#fechainicio1").val();
	
	var datos="fechainicio="+fechainicio+"&pantalla=0";

	var url='modelosreportes/citas/excel/rpt_citasporfecha.php?'+datos; 

	//alert(url);
	window.open(url, '_blank');	
}

function GenerarReporteCitasPantalla() {
	var fecha=$("#fechainicio1").val();
	
	var datos="fechainicio="+fecha+"&pantalla=1";

	var url='modelosreportes/citas/excel/rpt_citasporfecha.php'; 

	$.ajax({
		type:'GET',
		url: url,
		cache:false,
		data:datos,
		async:false,
		error:function(XMLHttpRequest, textStatus, errorThrown){
		 console.log(arguments);
		 var error;
		 if (XMLHttpRequest.status === 404) error="Pagina no existe"+XMLHttpRequest.status;// display some page not found error 
		 if (XMLHttpRequest.status === 500) error="Error del Servidor"+XMLHttpRequest.status; // display some server error 
		alert(error);						  
		 },
		success : function (msj){
		
			$("#contenedor_reportes").html(msj);

			//CargarEstilostable('.vertabla');
			$("#btnpantalla").css('display','block');

			}
		});
}

function ejecutarFuncionDinamica(funcionpantalla) {
  return new Promise(function(resolve, reject) {
    // Lógica adicional que deseas ejecutar antes de la función dinámica

    // Ejecuta la función dinámica asignada al botón
    if (typeof funcionpantalla === "function") {
     
      // Simula un tiempo de espera (reemplaza esto con tu lógica real)
      resolve(funcionpantalla());
    } else {
      // En caso de que la función no sea válida, rechaza la promesa
      reject("Función no válida");
    }
  });
}

