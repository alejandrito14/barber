var modaldialogo="";
function Disponilidadfecha() {

	GoToPage('disponibilidadfecha');
}

function Disponibilidadespecialista() {
	GoToPage('disponibilidadespecialista');
}
function CargarCalendario() {
	 var monthNames = ['Enero', 'Febrero', 'Marzo', 'Abrirl', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
      calendarInline = app.calendar.create({
        containerEl: '#demo-calendar',
        value: [new Date()],
        weekHeader: true,
        firstDay:0,

        renderToolbar: function () {
          return `
          <div class="toolbar calendar-custom-toolbar no-shadow">
            <div class="toolbar-inner">
              <div class="left">
                <a href="#" class="link icon-only"><i class="icon icon-back ${app.theme === 'md' ? 'color-black' : ''}"></i></a>
              </div>
              <div class="center"></div>
              <div class="right">
                <a href="#" class="link icon-only"><i class="icon icon-forward ${app.theme === 'md' ? 'color-black' : ''}"></i></a>
              </div>
            </div>
          </div>
          `;
        },
        on: {
          init: function (c) {
            $('.calendar-custom-toolbar .center').text(monthNames[c.currentMonth] + ', ' + c.currentYear);
            $('.calendar-custom-toolbar .left .link').on('click', function () {
              calendarInline.prevMonth();
            });
            $('.calendar-custom-toolbar .right .link').on('click', function () {
              calendarInline.nextMonth();
            });
          },

          calendarChange:function (c) {
          console.log(c.value);
          var fechaac=new Date();
            var mes=fechaac.getMonth()+1;
          var dia=fechaac.getDate();
          fechaactualdata=fechaac.getFullYear()+'-'+ mes+'-'+dia;
         
            var fecha=c.value;


            var convertirfecha=new Date(fecha);
            var mes=(convertirfecha.getMonth() + 1)<10?'0'+(convertirfecha.getMonth() + 1):(convertirfecha.getMonth() + 1);
          var mesdata=convertirfecha.getMonth();

          var dia=convertirfecha.getDate()<10?'0'+convertirfecha.getDate():convertirfecha.getDate();
          var diadata=convertirfecha.getDate();

          fecha1=convertirfecha.getFullYear()+'-'+ mes+'-'+dia;
            ConsultarFecha(fecha1);
            $("#v_especialista").html('');
            //var fechadata=convertirfecha.getFullYear()+'-'+mesdata+'-'+diadata;

             /* $(".calendar-day").each(function( index ) {
             var datafecha=$(this).data('date');

             if (datafecha==fechadata && datafecha!= fechaactualdata) {

              $(this).children().eq(0).addClass('seleccionado');
              //return 0;
             }else{

             $(this).children().eq(0).removeClass('seleccionado');

             }

        });*/
          
      
          },
          monthYearChangeStart: function (c) {
            $('.calendar-custom-toolbar .center').text(monthNames[c.currentMonth] + ', ' + c.currentYear);
          }
        }
      });
   

    //return $render;
  
}
function ConsultarFecha(fecha) {

         // app.preloader.show();

  var paqueteid=localStorage.getItem('idpaquete');
  var sucursal=localStorage.getItem('idsucursal');

  var datos="fecha="+fecha+"&idpaquete="+paqueteid+"&idsucursal="+sucursal;
  var pagina = "ObtenerDisponibilidadPaqueteSucursal.php";
  $.ajax({
    type: 'POST',
    dataType: 'json',
    url: urlphp+pagina,
    data:datos,
    async:false,
    success: function(resp){
      var respuesta=resp.intervalos;
     // app.preloader.hide();
      localStorage.setItem('fecha',fecha);
      if (respuesta.length>0) {
       // alerta('','Se encontraron horarios disponibles');
      }
      PintarIntervalos(respuesta);
      
      
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

function PintarIntervalos(respuesta) {
  var html="";
 if (respuesta.length>0) {
    html+=`<option value="0">Seleccionar horario</option>`;

  for (var i = 0; i <respuesta.length; i++) {
    html+=`<option value="`+respuesta[i].horainicial+`_`+respuesta[i].horafinal+`">`+respuesta[i].horainicial+`-`+respuesta[i].horafinal+`</option>`;

  }
 }

 $("#v_horarios").html(html);

 //ObtenerEspecialistaHora();
}

function ObtenerEspecialistaHora() {
  var fecha=localStorage.getItem('fecha');
  var paqueteid=localStorage.getItem('idpaquete');
  var sucursal=localStorage.getItem('idsucursal');
  var horario=$("#v_horarios").val();
  var datos="fecha="+fecha+"&idpaquete="+paqueteid+"&idsucursal="+sucursal+"&horario="+horario;

    var pagina = "ObtenerDisponibilidadHoraEspecialista.php";
  $.ajax({
    type: 'POST',
    dataType: 'json',
    url: urlphp+pagina,
    data:datos,
    async:false,
    success: function(resp){
      
      var respuesta=resp.especialista;
      PintarEspecialista(respuesta);
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

function PintarEspecialista(respuesta) {
  var html="";
  if (respuesta.length>0) {
    html+=`<option value="0">Seleccionar especialista</option>`;
    for (var i =0;i<  respuesta.length; i++) {
      respuesta[i]
      html+=`<option value="`+respuesta[i].idespecialista+`">`+respuesta[i].nombre+` `+respuesta[i].paterno+`</option>`;
    }
  }else{
    html+=`<option value="0">No se encontraron especialistas</option>`;


  }

  $("#v_especialista").html(html);
}

function AgendarCita() {
   var idpaquete=localStorage.getItem('idpaquete');
   var idsucursal=localStorage.getItem('idsucursal');
   var horario=$("#v_horarios").val();
   var fecha=localStorage.getItem('fecha');
   var idusuario=localStorage.getItem('id_user');
   var idespecialista=$("#v_especialista").val();
   var costo=localStorage.getItem('precio');
   var cantidad=localStorage.getItem('cantidad');
   var datos="idpaquete="+idpaquete+"&idsucursal="+idsucursal+"&horario="+horario+"&fecha="+fecha+"&idusuario="+idusuario+"&idespecialista="+idespecialista+"&costo="+costo+"&cantidad="+cantidad;
   var pagina = "GuardarCita.php";
  $.ajax({
    type: 'POST',
    dataType: 'json',
    url: urlphp+pagina,
    data:datos,
    async:false,
    success: function(resp){

      var cita=resp.cita[0];

      var html="";
        html+=`
        <p>Gracias</p>
        <p>Tu cita quedó agendada para el dia
       `+cita.fecha+` a las `+cita.horainicial+` con `+cita.nombre+` `+cita.paterno+`</p>
      `;

      var funcion="";
      funcion+=`
        <span class="dialog-button" id="btniracarrito" onclick="VerCarrito()">Ir a carrito</span>
      `;
      CrearModalAviso(html,funcion);
      
      },error: function(XMLHttpRequest, textStatus, errorThrown){ 
        var error;
            if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
            if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
          console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
      }
    });
}

function VerCarrito(){
 
    app.dialog.close();
  GoToPage('carrito');
}

function CrearModalAviso(html,funcion) {
  

  var html=`
  
           <div class="" style="text-align: center;">
              <div class="toolbar" style="display:none;">
                  <div class="toolbar-inner" >
                      <div class="left">

                      <span style="color:black;margin-left:1em;font-size: 14px;
          font-weight: bold;"></span></div>

                        <div class="right">
                         
                        </div>
                    </div>
              </div>

                <div class="sheet-modal-inner" style="">
                <div style="padding-top:1em;"></div>

                  <div id="" class="dialog-inner" style="font-size:20px;" >
                    `+html+`
                  </div>
                  <div class="dialog-buttons">
                    `+funcion+`
                  </div>
                        
                </div>



                  </div>
               </div>

        
              `;
      


 modaldialogo=app.dialog.create({
              title: '',
              text:'',
              content:html,

              buttons: [
              
                
              ],

              onClick: function (dialog, index) {

                  if(index === 0){
                   
                  }
                 
                
              },
              verticalButtons: true,
            }).open();
    

}

function ObtenerEspecialistaCosto() {
  var idpaquete=localStorage.getItem('idpaquete');
   var idsucursal=localStorage.getItem('idsucursal');
   var horario=$("#v_horarios").val();
   var fecha=localStorage.getItem('fecha');
   var idusuario=localStorage.getItem('id_user');
   var idespecialista=$("#v_especialista").val();
   var pagina = "ObtenerCostoPaquete.php";

   var datos="idpaquete="+idpaquete+"&idsucursal="+idsucursal+"&horario="+horario+"&fecha="+fecha+"&idusuario="+idusuario+"&idespecialista="+idespecialista;
 $.ajax({
    type: 'POST',
    dataType: 'json',
    url: urlphp+pagina,
    data:datos,
    async:false,
    success: function(resp){

      var res=resp.costo[0];
      console.log(res);
    $(".precioriginal").text('$'+res.costo);
    localStorage.setItem('precio',res.costo);
    localStorage.setItem('cantidad',1);

    $(".btnagendarcita").css('display','block');

      
      },error: function(XMLHttpRequest, textStatus, errorThrown){ 
        var error;
            if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
            if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
          console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
      }
    });
}

function CargarEspecialista() {
  var paqueteid=localStorage.getItem('idpaquete');
  var sucursal=localStorage.getItem('idsucursal');
  var datos="idpaquete="+paqueteid+"&idsucursal="+sucursal;

    var pagina = "ObtenerEspecialistaPaqueteSucursal.php";
  $.ajax({
    type: 'POST',
    dataType: 'json',
    url: urlphp+pagina,
    data:datos,
    async:false,
    success: function(resp){
      
      var respuesta=resp.especialista;
      PintarEspecialista(respuesta);
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
var arraymes=['01','02','03','04','05','06','07','08','09','10','11','12'];
function AbrirCalendario() {
     let calendarDefault;
   
  calendarDefault = app.calendar.create({
        inputEl: '#demo-calendar-default',
         weekHeader: true,
        firstDay:0,

         on: {
            opened: function (e) {
              console.log(e);
              
              var mes=arraymes[e.currentMonth];
              var anio=e.currentYear;
              ObtenerFechasCalendario(mes,anio);
            },

             close: function (e) {
            calendarDefault.destroy();
              
            }
          }
      });
}

function ObtenerFechasDisponibles() {

      $("#demo-calendar-default").attr('onfocus','AbrirCalendario()');


}

function ObtenerFechasCalendario(mes,anio) {
  var paqueteid=localStorage.getItem('idpaquete');
  var sucursal=localStorage.getItem('idsucursal');
  var idespecialista=$("#v_especialista").val();
  var datos="idpaquete="+paqueteid+"&idsucursal="+sucursal+"&idespecialista="+idespecialista+"&mes="+mes+"&anio="+anio;

  var pagina = "ObtenerFechasCalendario.php";
  $.ajax({
    type: 'POST',
    dataType: 'json',
    url: urlphp+pagina,
    data:datos,
    async:false,
    success: function(resp){
      
      
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