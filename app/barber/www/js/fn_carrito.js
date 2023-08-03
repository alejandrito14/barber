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
  $(".bcantidadcarrito").css('display','none');
    if (res.length>0) {
      
        $(".bcantidadcarrito").css('display','block');
        $(".bcantidadcarrito").text(res.length);      
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
      $("#cantidadagregados").text(respuesta.length);

	if (respuesta.length>0) {

		for (var i = 0; i < respuesta.length; i++) {
      var estilo="";
      if (respuesta[i].foto!='' && respuesta[i].foto!=null ) {
          imagen=urlimagenes+'paquetes/imagenespaquete/'+codigoserv+respuesta[i].foto;
  
        }else{
            estilo="opacity:0.2";
          imagen=localStorage.getItem('logo');
        }

        html+=`
          <li class="item-content" style="margin-top: 10px;
    margin-right: 1em;
    margin-left: 1em;
    border-bottom: 1px solid;">
            <div class="row">
              <div class="col-70">
                <div class="icon-text-container">
              
               <span class="material-icons-outlined">inventory_2
                </span> <p style="margin:0;">`+respuesta[i].nombrepaquete+`
                </p>

                </div>
                <div class="icon-text-container">
                <p style="margin:0;margin-left:30px;">$`+respuesta[i].costototal+`</p></div>
                <div class="icon-text-container">
                 <span class="material-icons-outlined">
                    add_business
                    </span>
                    <p style="margin:0;">
                   
                    `+respuesta[i].titulo+`</p>
                     </div>
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
                  }else{


                    html+=` 
                        <div class="icon-text-container">
                        <span class="material-icons-outlined">supervised_user_circle</span>
                    <p style="margin:0;">`+respuesta[i].usuarioespecialista+`</p>
                    </div>
                    `;
                    html+=`
                   <div class="icon-text-container">
                     <span class="material-icons-outlined">calendar_month</span>

                     <p style="margin:0;">`+respuesta[i].fechaformato+`</p>

                     </div>
                     `;


                  }

              html+=` </div>
                <div class="col-30">`;

                  if (respuesta[i].precioante!=0) {
                     html+=`<p style="margin:0;text-decoration:line-through;font-size: 12px;text-align: right;">$`+respuesta[i].precioante+`</p>`;

                  }


                   html+=`
                     <p><button class="button color-red" onclick="EliminarProductoCarrito(`+respuesta[i].idcarrito+`,'`+respuesta[i].nombrepaquete+`')">
                        <span class="material-icons-outlined" style="font-size: 30px;">
                        delete
                        </span>
                       </button>
                     </p>`;


             html+=` </div>

            </div>
          </li>

        `;

			/*html+=`
			<li class="item-content">
              <div class="item-media">
              <img src="`+imagen+`" alt="" style="    width: 100px;
    border-radius: 10px;`+estilo+`"></div>
              <div class="item-inner">
                <div class="row">
                  <div class="col-60">
                    <p style="margin:0;">`+respuesta[i].nombrepaquete+`</p>
               	    <p style="margin:0;">`+respuesta[i].titulo+`</p>
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
                  }else{


                    html+=` <p style="margin:0;">`+respuesta[i].usuarioespecialista+`</p>`;
                    html+=` <p style="margin:0;">`+respuesta[i].fechaformato+`</p>`;


                  }

                  html+=`</div>	

                  <div class="col-40">`;

                  if (respuesta[i].precioante!=0) {
                     html+=`<p style="margin:0;text-decoration:line-through;font-size: 12px;text-align: right;">$`+respuesta[i].precioante+`</p>`;

                  }

                    html+=` <p style="margin:0;">$`+respuesta[i].costototal+`</p>
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

			`;*/

    
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

  var idusuario=localStorage.getItem('id_user');

  var invitado=localStorage.getItem('invitado');

  if (invitado==1) {


    GoToPage('signup2');


    }else{

      GoToPage('resumenpago');
    }

       
   
}

function Agregarmasproducto() {
  if (localStorage.getItem('idsucursal')!=undefined && localStorage.getItem('idsucursal')!=null) {
      GoToPage('detalleproductoservicios');
      
    }else{

      GoToPage('home');
  
    }
}