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
  $(".btniracarrito").css('display','none');
    if (res.length>0) {
      
        $(".btniracarrito").css('display','block');
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
          <li class="item-content cambiarfuente" style="margin-top: 10px;
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
                        <div class="icon-text-container" style="margin-top: 10px;">
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

                        if (respuesta[i].concortesia==1 && respuesta[i].idcortesia==0 ) {

                       /* html+=`
                        <div class="col-100" style="padding-bottom: 1em;
    padding-top: 1em;">
                      <button class="button  color-theme  " style="background:#C7AA6A;padding:10px 20px;" onclick="ObtenerCortesia(`+respuesta[i].idcarrito+`,`+respuesta[i].idpaquete+`)">
                        Cortesia
                       </button>
                     
                     </div>
                      `;*/

                    }else{

                      if (respuesta[i].idcortesia>0 ) {

                          html+=`


                         <div class="icon-text-container">
                           <span class="material-icons-outlined">card_giftcard</span>

                           <p style="margin:0;">`+respuesta[i].nombrepaquetecortesia+`</p>

                           </div>`;

                      }
          

                    }
                  }

                  

              html+=` </div>
                <div class="col-30">`;

                  if (respuesta[i].precioante!=0) {
                     html+=`
                     <div class="col-100">
                     <p style="margin:0;text-decoration:line-through;font-size: 12px;text-align: right;">$`+respuesta[i].precioante+`</p>
                     </div>
                     `;

                  }


                   html+=`
                   <div class="col-100">
                      <button class="button color-red" onclick="EliminarProductoCarrito(`+respuesta[i].idcarrito+`,'`+respuesta[i].nombrepaquete+`')">
                        <span class="material-icons-outlined" style="font-size: 30px;margin-left:1em;margin-right:1em;">
                        delete
                        </span>
                       </button>
                     
                     </div>
                     `;

                 



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

 /* if (invitado==1) {


    GoToPage('signup2');


    }else{*/



      var promesa=VerificarProductosCarritoConCortesia();
         promesa.then(r => {
          var carrito=r.respuesta;
          var concortesia=r.concortesia;
          var cortesiasporagregar=r.cortesiasporagregar;
            if (carrito.length==1 && concortesia==1 && cortesiasporagregar==1) {


              ObtenerCortesia(carrito[0].idcarrito,carrito[0].idpaquete);
 
            }else{

              AbrirModalNecesitas();
            }

        });


      //GoToPage('resumenpago');
    //}

       
   
}


function AbrirModalNecesitas(argument) {
 
  var html2="";

var html=` <div class="sheet-modal my-sheet-swipe-to-close1" style="height: 100%;background: black;">
            <div class="toolbar" style="background: black;margin-top: 1em;">
              <div class="toolbar-inner">
                <div class="left"></div>
                <div class="right">
                  <a class="link sheet-close"></a>
                </div>
              </div>
            </div>
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
                          <div class="row">
                          <div class="col-100">
                          <p style="color: #c7aa6a;font-size: 30px;
    text-align: center;" class="cambiarfuente">¿Necesitas algo más?</p>
                          </div>

                          </div>

                          <div class="row margin-bottom " style="padding-top: 1em;    margin-left: 2em;margin-right: 2em;margin-top:20px;">
                            <div class="col-50">
                            <button style="background: #C7AA6A;color:white;" type="button" class="button button-fill color-theme button-large button-raised btnagregarcortesia cambiarfuente" onclick="IrSucursal()">Si</button>
                            </div>

                            <div class="col-50">
                            <button style="background: white;color:black;" type="button" class="button button-fill color-theme button-large button-raised btnagregarcortesia cambiarfuente" onclick="IrApago()">No</button>
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
           idcortesiaelegida=0;

            

          },
          opened: function (sheet) {
            console.log('Sheet opened');

            if (tipoletra!='') {
              $(".cambiarfuente").addClass(tipoletra);
            }
          },
        }
      });

       dynamicSheet1.open();
}

function IrSucursal() {
  dynamicSheet1.close();
  GoToPage('detallesucursal');
}

function IrApago(argument) {
  dynamicSheet1.close();
  GoToPage('resumenpago');

}

function Agregarmasproducto() {
  if (localStorage.getItem('idsucursal')!=undefined && localStorage.getItem('idsucursal')!=null) {
      GoToPage('detalleproductoservicios');
      
    }else{

      GoToPage('home');
  
    }
}

function ObtenerCortesia(idcarrito,idpaquete) {
  var idusuario=localStorage.getItem('id_user');

var datos="idcarrito="+idcarrito+"&idpaquete="+idpaquete;
var pagina="ObtenerCortesiaPaquete.php";

 $.ajax({
    type: 'POST',
    dataType: 'json',
    url: urlphp+pagina,
    data:datos,
    async:false,
    success: function(resp){
     
      var respuesta=resp.respuesta;

      AbrirModalCortesia(respuesta,idcarrito);

     
      },error: function(XMLHttpRequest, textStatus, errorThrown){ 
        var error;
            if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
            if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
          console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
      }
    });
}
var idcortesiaelegida="";

function AbrirModalCortesia(respuesta,idcarrito) {
  

  var html2="";

var html=` <div class="sheet-modal my-sheet-swipe-to-close1" style="height: 100%;background: black;">
            <div class="toolbar" style="background: black;margin-top: 1em;">
              <div class="toolbar-inner">
                <div class="left"></div>
                <div class="right">
                  <a class="link sheet-close"></a>
                </div>
              </div>
            </div>
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
    color: #c7aa6a;">Escoge tu cortesía</span>
                     </div>
                     <div class="col-20">
                     <span class="limpiarfiltros"></span>
                     </div>
                 </div>
                 <div class="" style="position: absolute;top:1em;width: 100%;">
                
                       
                        `;

                       

        
                          html+=`

                          <div class="row margin-bottom " style="padding-top: 1em;    margin-left: 2em;margin-right: 2em;margin-top:20px;">
                         `;

                       
                                html+=` 
                    
                               <div class="col-100 " style="    padding-top: 1em;padding-bottom: 1em;">
                                 <div class="row">
                                   <div class="col-50">
                                     <p style="margin:0;" class="cambiarfuente">Ninguna</p>
                                    </div>  

                                  <div class="col-50"> 
                                    <div class="toggle">
                                              <label>
                                                <input type="checkbox" id="cortesia_0" class="btncortesias" onchange="ElegirCortesia(`+idcarrito+`,0)" />
                                                <span class="toggle-icon"></span>
                                              </label>
                                            </div>
                                     
                                  </div>
                                 </div> 
                              
                                </div>
                                
                              

                         `;
                          
                            if (respuesta.length>0) {
                              for (var i = 0; i < respuesta.length; i++) {
                                         imagen=urlimagenes+'paquetes/imagenespaquete/'+codigoserv+respuesta[i].foto;

                           html+=` 
                              
                               <div class="col-100 opcionescortesia" style="    padding-top: 1em;padding-bottom: 1em;">
                                 <div class="row">
                                   <div class="col-50">
                                     <p style="margin:0;" class="cambiarfuente">`+respuesta[i].nombrepaquete+`</p>
                                    </div>  

                                  <div class="col-50"> 

                                    
                                        <div class="toggle">
                                              <label class="">
                                                <input type="checkbox" class="btncortesias" id="cortesia_`+respuesta[i].idcortesia+`" onchange="ElegirCortesia(`+idcarrito+`,`+respuesta[i].idcortesia+`)">
                                                <span class="toggle-icon"></span>
                                              </label>
                                            </div>
                                    
                                     
                                  </div>
                                 </div> 
                              
                              

                                `;
                              }
                            }

                          html+=`
                          </div> 
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
           idcortesiaelegida=0;

            

          },
          opened: function (sheet) {
            console.log('Sheet opened');

            if (tipoletra!='') {
              $(".cambiarfuente").addClass(tipoletra);
            }
          },
        }
      });

       dynamicSheet1.open();
}
function ElegirCortesia(idcarrito,idcortesia) {

 // $(".btncortesias").prop('checked',false);
     
  if($("#cortesia_"+idcortesia).is(':checked')) {
   $(".btncortesias").prop('checked',false);
     $("#cortesia_"+idcortesia).prop('checked',true);
       idcortesiaelegida=idcortesia;
       $(".btnagregarcortesia").css('display','block');
       $(".btnagregarcortesia").attr('onclick','GuardarCortesiaCarrito('+idcarrito+','+idcortesia+')');
       if (idcortesia==0) {

        $(".opcionescortesia").css('display','none');
       }
  }else{
      idcortesiaelegida="";
      $("#cortesia_"+idcortesia).prop('checked',false);
       $(".btnagregarcortesia").css('display','none');
           if (idcortesia==0) {

        $(".opcionescortesia").css('display','block');
       }
  }



}

function GuardarCortesiaCarrito(idcarrito,idcortesia) {
  var datos="idcarrito="+idcarrito+"&idcortesia="+idcortesiaelegida;
  var pagina="GuardarCortesiaCarrito.php";

 $.ajax({
    type: 'POST',
    dataType: 'json',
    url: urlphp+pagina,
    data:datos,
    async:false,
    success: function(resp){
     
      dynamicSheet1.close();

      CargarCarrito();


      IrAPago();
      },error: function(XMLHttpRequest, textStatus, errorThrown){ 
        var error;
            if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
            if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
          console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
      }
    });
}

function VerificarProductosCarritoConCortesia() {
   return new Promise(function(resolve, reject) {


  var idusuario=localStorage.getItem('id_user');
  var datos="idusuario="+idusuario;
  var pagina="VerificarProductosCarritoConCortesia.php";

 $.ajax({
    type: 'POST',
    dataType: 'json',
    url: urlphp+pagina,
    data:datos,
    async:false,
    success: function(resp){

      resolve(resp);
    
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