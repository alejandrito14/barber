function VerificarCajaAbierta() {
	 var pagina="verificarCajaAbierta.php";
	$.ajax({
    type: 'POST',
    dataType: 'json',
    url: 'catalogos/caja/'+pagina,
    success: function(resp){
        var resultado=resp.caja;

        if (resultado.length>0) {
            ObtenerTipodepagos();
            ObtenerCategoriasPrincipales()

            $("#fechahoraapertura").text(resultado[0].fechainicio);
            $("#divseleccionar").css('display','');
            $(".eleccion").css('display','');

        }else{
            
            $("#divfechahoraapertura").css('display','none');

           var html=`<div class="card">

           <div class="card-body">
            <h2 class="page-header" style="
    margin-left: 10px;">Apertura de Caja</h2>
        <form id="aperturaCajaForm" class="form-horizontal" role="form">
           

            <div class="form-group">
                <label for="saldoInicial" class="col-md-4 control-label">Saldo Inicial:</label>
                <div class="col-sm-10">
                    <input type="number" style="width:200px;" class="form-control" id="saldoInicial" name="saldoInicial" step="0.01"  required>
                
               
                                                                    </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="button" class="btn btn-primary" onclick="AbrirCaja()" style="width: 200px;">Abrir Caja</button>
                
               
                                                                </div>
            
            </div>

        </form>

        </div>
        </div>

        `;

         $("#divapertura").html(html);
         $(".eleccion").css('display','none');

      //  $("#saldoInicial").attr('onkeyup','CambiarFormato(this)');

        /*  $("#saldoInicial").on({
              "focus": function(event) {
                $(event.target).select();
              },
              "keyup": function(event) {
                $(event.target).val(function(index, value) {
                  return value.replace(/\D/g, "")
                    .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                    .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                });
              }
            });*/


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

function CambiarFormato(objeto) {
    var valor=$("#saldoInicial").val();

    var convertir=NumberConvertToDecimal(valor);
    $("#saldoInicial").val(convertir);
}
function AbrirCaja() {

    var pagina="AbrirCaja.php";
    var saldoinicial=$("#saldoInicial").val();
    var datos="saldoinicial="+saldoinicial;
	$.ajax({
    type: 'POST',
    dataType: 'json',
    url: 'catalogos/caja/'+pagina,
    data:datos,
    success: function(resp){
        var resultado=resp;
        $("#divfechahoraapertura").css('display','block');
        VerificarCajaAbierta();
        $("#divapertura").css('display','none');
        console.log(datos);
        $("#divseleccionar").css('display','');
        $(".eleccion").css('display','');

    },error: function(XMLHttpRequest, textStatus, errorThrown){ 
      var error;
        if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
        if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
                console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
          }
    });
}

function AbrirModalCerrarCaja() {
    
   $("#modalcierrecaja").modal();
}
function CerrarCaja() {
     var pagina="CerrarCaja.php";
    var saldofinal=0;
    var datos="saldofinal="+saldofinal;
    $.ajax({
    type: 'POST',
    dataType: 'json',
    url: 'catalogos/caja/'+pagina,
    data:datos,
    success: function(resp){
        var resultado=resp.respuesta;
        var caja=resp.caja;
        VerificarCajaAbierta();
        $("#divapertura").css('display','block');
        $("#divseleccionar").css('display','none');
        $("#metodopagodiv").css('display','none');
        $("#datoscliente").css('display','none');
        $(".divtabs").css('display','none');
        $("#punto-venta").css('display','none');
        $("#divfechahoraapertura").css('display','none');
        $(".eleccion").css('display','none');
        $("#modalcierrecaja").modal('hide');
        AbrirReporteManejocaja(caja);
    },error: function(XMLHttpRequest, textStatus, errorThrown){ 
      var error;
        if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
        if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
                console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
          }
    });
}


function AbrirReporteManejocaja(caja) {
     var pagina="modelosreportes/caja/excel/rpt_manejocaja.php?idmanejocaja="+caja+"&pantalla=1";


    $.ajax({
    type: 'GET',
    url: pagina,
    success: function(resp){
             var paginaulr="modelosreportes/caja/excel/rpt_manejocaja.php?idmanejocaja="+caja+"&pantalla=2";

            $('#divreportecaja').html(resp);
            $(".btnimprimirreporte").attr('href',paginaulr);
            $("#modalreportecaja").modal();

    },error: function(XMLHttpRequest, textStatus, errorThrown){ 
      var error;
        if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
        if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
                console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
          }
    });

}

function ImprimirReporteCaja(caja) {


    $.ajax({
    type: 'GET',
    url: pagina,
    success: function(resp){
           
    },error: function(XMLHttpRequest, textStatus, errorThrown){ 
      var error;
        if (XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
        if (XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
                //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
                console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
          }
    });
}