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
          alert(fechaactualdata);
            var fecha=c.value;


            var convertirfecha=new Date(fecha);
            var mes=(convertirfecha.getMonth() + 1)<10?'0'+(convertirfecha.getMonth() + 1):(convertirfecha.getMonth() + 1);
          var mesdata=convertirfecha.getMonth();

          var dia=convertirfecha.getDate()<10?'0'+convertirfecha.getDate():convertirfecha.getDate();
          var diadata=convertirfecha.getDate();

          fecha1=convertirfecha.getFullYear()+'-'+ mes+'-'+dia;
            ConsultarFecha(fecha1);
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
    success: function(datos){
      
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