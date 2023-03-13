function PintarCantidadcarrito() {
var idusuario=localStorage.getItem('id_user');

var datos="idusuario="+idusuario;
var pagina="ObtenerCarrito.php";

 $.ajax({
    type: 'POST',
    dataType: 'json',
    url: urlphp+pagina,
    data:datos,
    async:false,
    success: function(resp){

      var res=resp.respuesta;
 
      $(".bcantidadcarrito").text(res.length);      
      },error: function(XMLHttpRequest, textStatus, errorThrown){ 
        var error;
            if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
            if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
          console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
      }
    });
}

function CargarCarrito() {
var idusuario=localStorage.getItem('id_user');

var datos="idusuario="+idusuario;
var pagina="ObtenerCarrito.php";

 $.ajax({
    type: 'POST',
    dataType: 'json',
    url: urlphp+pagina,
    data:datos,
    async:false,
    success: function(resp){
    	var res=resp.respuesta;
    	PintarCarrito(res);
    	var total=formato_numero(resp.totalcarrito,2,'.',',');
    	$(".totalcarrito").html(total);
      localStorage.setItem('sumatotalapagar',total);
      },error: function(XMLHttpRequest, textStatus, errorThrown){ 
        var error;
            if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
            if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
          console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
      }
    });
}

function PintarCarrito(respuesta) {

	var html="";
	if (respuesta.length>0) {

    $("#cantidadagregados").text(respuesta.length);
		for (var i = 0; i < respuesta.length; i++) {

		imagen=urlimagenes+'paquetes/imagenespaquete/'+codigoserv+respuesta[i].foto;

			html+=`
			<li class="item-content">
              <div class="item-media">
              <img src="`+imagen+`" alt="" style="    width: 100px;
    border-radius: 10px;"></div>
              <div class="item-inner">
                <div class="row">
                  <div class="col-60">
                    <p>`+respuesta[i].nombrepaquete+`</p>
               	    <p>`+respuesta[i].titulo+`</p>
                    `;
                    if (respuesta[i].servicio==0) {
                   html+=` <p>
                       
                        <div class="stepper stepper-small stepper-init cantidads_`+respuesta[i].idcarrito+`" id="c_`+respuesta[i].idcarrito+`">
                          <div class="stepper-button-minus" style="border:0;" ></div>
                          <div class="stepper-input-wrap" style="border:0;">
                            <input type="text" id="cantidad_`+respuesta[i].idcarrito+`" value="`+respuesta[i].cantidad+`"  min="1" max="100" step="1" readonly />
                          </div>
                          <div class="stepper-button-plus" style="border:0;" ></div>
                        </div>
                     

                    </p>`; 
                  }

                  html+=`</div>	

                  <div class="col-40">
                     <p>$`+respuesta[i].costototal+`</p>
                     <p><button class="button color-red" onclick="EliminarProductoCarrito(`+respuesta[i].idcarrito+`,'`+respuesta[i].nombrepaquete+`')">
                        <span class="material-icons-outlined" style="font-size: 30px;">
                        delete
                        </span>
                       </button>
                     </p>
                  </div>
                 </div>`;

               

                html+=` </div>

              </div>
            </li>

			`;

    
		}
	}


	$(".listadocarrito").html(html);
 // Destruir();
  Inicializar();
}
function Destruir() {
  $('.stepper').each(function(index, stepperEl) {
      var stepper =app.stepper.get(stepperEl);


  });
}

function Inicializar() {
 $('.stepper').each(function(index, stepperEl) {
  var stepper = app.stepper.create({
    el: stepperEl,
    on: {
        stepperChange: function (e) {
      
          var id=e.el.id;
          var dividir=id.split('_')[1];
          var valor=e.value;
          e.setValue(valor);
          SumarCarrito(dividir,valor);
           
        }
    }
});
})
}
function SumarCarrito(idcarrito,valor) {


          var pagina="SumarCarrito.php";
         // var cantidad=$("#cantidad_"+idcarrito).val();
         var datos="idcarrito="+idcarrito+"&operacion=1"+"&cantidad="+valor;

         console.log(valor);
    
           $.ajax({
            type: 'POST',
            dataType: 'json',
            url: urlphp+pagina,
            data:datos,
            success: function(resp){

              CargarCarrito();
            
            },error: function(XMLHttpRequest, textStatus, errorThrown){ 
                var error;
                    if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
                    if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                        //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
                  console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
              }

            });
          

 
}

/*function RestarCarrito(idcarrito) {
  var datos="idcarrito="+idcarrito+"&operacion=0";
  var pagina="SumarCarrito.php";


         
   if (cantidad>0) {

   $.ajax({
    type: 'POST',
    dataType: 'json',
    url: urlphp+pagina,
    crossDomain: true,
    cache: false,
    data:datos,
    success: function(resp){
        CargarCarrito();

 
    
    },error: function(XMLHttpRequest, textStatus, errorThrown){ 
        var error;
            if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
            if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
          console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
      }

    });

       }else{

            $("#cantidad_"+idcarrito).val(1);
          }



}*/

function EliminarProductoCarrito(idcarrito,nombre) {
 
  app.dialog.confirm('','¿Seguro que desea eliminar '+nombre+' del carrito?' , function () {
    var id_user=localStorage.getItem('id_user');
  var pagina = "EliminarProductoCarrito.php";
  var datos="id_user="+id_user+"&idcarrito="+idcarrito;
  $.ajax({
    type: 'POST',
    dataType: 'json',
    url: urlphp+pagina,
    crossDomain: true,
    cache: false,
    data:datos,
    success: function(resp){

      
        CargarCarrito();

      
    
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

function IrAPago() {
  GoToPage('resumenpago');
}

function Agregarmasproducto() {
  GoToPage('detalleproductoservicios');
}