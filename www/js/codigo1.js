var html=`
<div class="col-md-6 divdetalle" style="display: block;">
    <div class="row" style="margin-bottom: 1em;">
      <p style="text-align: center;font-size: 18px;" id="">
      <span style="font-weight: bold;">Pago</span> #<span id="lblnumeronota"></span></p>

    </div>
   
    <div class="row">
      

      <div class="list media-list no-margin" style="background: white;">
           <ul class="listadopagoselegidos" style="list-style: none;">
      
              </ul>
           </div>
           <div >
           
           
          </div>
      </div>

      <!-- <div class="row">
        <div class="list media-list no-margin" style="background: white;">
            <ul class="cupon" style="list-style: none;">
              <li>
                    <div class="row">
                        <div class="col-50" style="padding: 0">
                            <p class="text-muted small" style="font-size:18px;" id="">
                             Monedero
                            </p>

                             <p class="text-muted " style="font-size:30px;text-align:right;">$0.00</p>
                        </div>
                        <div class="col-50">
                        <span class="chip color-green" style="
                                height: 40px;
                                justify-content: center;
                                display: flex;
                                margin-right: 1em;
                                margin-left: 1em;"><span class="chip-label">Aplicar</span></span>

                        </div>
                    </div>
                 </li>

                  

            </ul>
           </div>
           <div >
          </div>
      </div> -->

<div class="divmonedero row">
        <div class="list media-list no-margin" style="background: white;">
            <ul class="cupon" style="list-style: none;">
             <li class="list-item">
                    <div class="row">
                        <div class="col-80" style="padding: 0;">
                            <p class="text-muted small" style="font-size:18px;" id="">
                             Monedero
                            </p>
                             <p class="text-muted " style="font-size:30px;text-align:right;">$<span class="monedero">0.00</span></p>

                        </div>
                        <div class="col-20">
                          <span class="chip color-green btnmonedero" 
                          id="" style="
                                height: 30px;display: none;
                                /*justify-content: center;
                                display: flex;
                                margin-right: 1em;
                                margin-left: 1em;*/top: 3em;"><span class="chip-label">Aplicar</span></span>
                        </div>
                    </div>
                 </li>
                  

            </ul>
           </div>
           <div >
          </div>
      </div>


     


      <!--   <div class="row" style="background: white;height: 60px;">
        <div class="list media-list no-margin" style="background: white;">
            <div class="cupon" style="list-style: none;">
              <li>
                    <div class="row" style="margin-top: .5em;">
                        <div class="col-50" style="padding: 0">
                             <input type="text" placeholder="Código cupón" name="couponcode" class="" style="width: 70%;float: left;" />
                        </div>
                        <div class="col-50"><span class="chip color-green" style="
                                height: 40px;
                                justify-content: center;
                                display: flex;
                                margin-right: 1em;
                                margin-left: 1em;"><span class="chip-label">Aplicar</span></span></div>
                    </div>
                 </li>
             </div>
           </div>
         
          </div> -->
     
      <div id="visualizardescuentos" style="display: none;">
       <div class="divdescuentos row">
        <div class="list media-list no-margin" style="background: #46b2e2;">
            <ul class="descuentos" style="list-style: none;" id="uldescuentos">
            </ul>
          </div>
        </div>
      </div>
        

    <div class="row">
        <div class="list media-list no-margin" style="background: #aeb3b7;">
            <ul class="cupon" style="list-style: none;">
             <li class="list-item">
                    <div class="row">
                        <div class="col-80" style="padding: 0;">
                            <p class="text-muted small" style="font-size:18px;" id="">
                             Resúmen
                            </p>
                             <p class="text-muted " style="font-size:30px;text-align:right;">$<span class="lblresumen">0.00</span></p>

                        </div>
                        <div class="col-20">
                        
                        </div>
                    </div>
                 </li>
                  
            </ul>
           </div>
          
      </div>

      <div class="divcomision">
      <div class="row">
        <div class="list media-list no-margin" style="background: #aeb3b7;">
            <ul class="cupon" style="list-style: none;">
             <li class="list-item">
                    <div class="row">
                        <div class="col-80" style="padding: 0;">
                            <p class="text-muted small" style="font-size:18px;" id="">
                             Comision
                            </p>
                             <p class="text-muted " style="font-size:30px;text-align:right;">$<span class="lblcomision">0.00</span></p>

                        </div>
                        <div class="col-20">
                        
                        </div>
                    </div>
                 </li>
                  
            </ul>
           </div>
          
      </div>
    </div>

      <div class="row">
        <div class="list media-list no-margin" style="background: #aeb3b7;">
            <ul class="" style="list-style: none;">
             <li class="list-item">
                    <div class="row">
                        <div class="col-80" style="padding: 0;">
                            <p class="text-muted small" style="font-size:18px;" id="">
                             Total
                            </p>
                             <p class="text-muted " style="font-size:30px;text-align:right;">$<span class="lbltotal">0.00</span></p>

                        </div>
                        <div class="col-20">
                        
                        </div>
                    </div>
                 </li>
                  
            </ul>
           </div>
          
      </div>

    
      <div class="row" style="margin-top: 1em;">
        <div class="col-100">
          <p class="text-muted" style="opacity: 0.6;">Método de pago</p>
        </div>
      </div>
      <div class="row" style="background: white;">
        
        <div class="list media-list no-margin">
          <div class="metodopago"></div>
        <div class="datostarjeta" style="float: left;"></div>
                <div class="infodatostarjeta"></div>

          <ul style="list-style: none;">
              <li>
         
           <!--  <select name="tipopago" id="tipopago">
              
            </select> -->
           
         
        </li>
       
          </ul>
        </div>
      </div>
      <div class="divtransferencia" style="display: none;">
      <div class="row "  >
        <div class="list media-list">
           <ul class="informacioncuenta"></ul>
        </div>
        

       </div>
     </div>

       <div class="block m-0"> 
                     <div class="list media-list sortable" id="" style="">
                    <div id="lista-imagenescomprobante">
                        
                    </div>
                </div> 
            </div>
       <div id="campomonto" style="display: none;">
    <div class="subdivisiones" style="margin-top: 1.5em;width: 12em!important;" >
      <span style="margin-top: .5em;margin-left: .5em;">¿Con cuanto pagas?</span>
    </div>

    <div class="list media-list sortable">
     <ul  style="list-style: none;">
      

          <li>
            
            <label class="label-radio item-content">
              
              <div class="item-inner">
             
                <div class="">

                  <input type="text" name="montovisual" id="montovisual" style="font-size: 18px;float: left;width: 60%;margin-left: 1.2em;" placeholder="$0.00" readonly />
                  <input type="number" name="montocliente" id="montocliente"  style="font-size: 18px;float: left;width: 60%;    margin-left: 1.2em;display: none;" placeholder="$0.00"   />

                 
                </div>

                </div>


                <div class="item-after" style="float: right;">
                 


                   <span class="botoneditar" style="margin-right:.10em;" >
                  
                  <i class="bi bi-pencil "></i>
                  <span class="if-not-md"></span>

                  </span>


                     <span class="botoneditar" onclick="" style="visibility: collapse;">
                  
                      <i class="bi bi-pencil"></i>

                  </span>
                 
                </div>

              
            </label>
            </li>
        </ul>

      </div>
</div> 


<!--  <div id="habilitarfoto" style="display: none;">
    <div class="subdivisiones" style="margin-top: 1.5em" ><span style="margin-top: .5em;margin-left: .5em;">Comprobante</span></div>

         <div class="list" >
                <ul>
                    <button  class="button button-fill botonesaccion botonesredondeado estiloboton" style="margin-top: 1em;"> Sube tu comprobante</button>
                         <div class="check-list" style="    display: none;margin-right: 10em;top: -.2em;position: absolute;right: -6em;"><span></span></div>
                </ul>

                    <div class="block m-0"> 
                     <div class="list media-list sortable" id="" style="">           

                    <ul id="lista-imagenescomprobante">
                        
                    </ul>
                </div> 

                </div>   
                
              </div>

            </div> 
 -->

 
    <div class=" row">
              <div style="background-color:#dfdfdf;border-radius:10px;padding-top: .5px;padding-bottom: .5px;display: none;" id="aparecerimagen">
              <div class="">
                  <div class="row no-gap" style="text-align: center;"> 
                   <img src="" id="imagencomprobante" width="60" />
                  </div>
                </div>


        </div>

      </div>
       
       

        <div class=" divtarjetas" >
          <div class="" id="divlistadotarjetas">

      <div class="divisiones2" style="display: none;"><span style="margin-top: .5em;margin-left: .5em;">Seleccionar tarjeta</span></div>
      <div class="col">
        <div class="">
          
          <div style="text-align: center;" id="categorianombre" class="categorianombre"></div>
          <div class="swiper-container  demo-swiper">
            <div class="swiper-wrapper" id="slidecategoria">

            </div>
          </div>

          <div class="list simple-list li" style="display: none;">
            <ul id="listadotarjetas">
              
            </ul>
            <div class="  ">
              <a class="button button-fill botonesredondeado botones btnnuevatarjeta"  style="height: 60px;line-height: 40px;
    /* width: 100%; */
    color: black!important;
    background: #FFC830!important;
    margin-left: 1em;
    margin-right: 1em;
    margin-top: 1em;">Nueva Tarjeta</a>
            </div>    
          </div>
              
        </div>
      </div>
    </div>
    <div class="" id="divagregartarjeta" style="display: none;">

      <div class="divisiones2" style="    margin-bottom: 1em;
    margin-top: 1em;font-weight: bold;"><span style="margin-top: .5em;margin-left: .5em;">Introduce la información de la tarjeta</span></div>

      <div class="col">

         <div class="">
         <div class="list form-list no-margin margin-bottom" id="my-form">
           <ul>
            
              <li>
                <div class="item-content item-input">
                <div class="item-inner">
                <div class="item-title item-label" >*Nombre en la tarjeta</div> 

                <div class="item-input-wrap" style="height: 56px;font-size: 15px;">
                  <input type="text" name="cardholder-name" placeholder="TITULAR DE LA TARJETA" class="mayusculas place input-with-value" id="v_cardholder-name" />
                  <span class="input-clear-button"></span>
                </div>
                  <label for="" id="lblnombre" class="lbl" style="color:red;"></label>
                </div>
                </div>
              </li>
              <li>
                <div class="item-content item-input">
                <div class="item-inner">
                <div class="item-title item-label">*Número de tarjeta</div>
                <div class="item-input-wrap" style="height: 56px;font-size: 15px;">
                  <div class="sr-input sr-element sr-card-element" id="v_card-number" style="margin-top: .5em;" >
                    <!-- A Stripe card Element will be inserted here. -->
                  </div>
                  <span class="input-clear-button"></span>
                </div>
                <label for="" id="lblntarjeta" class="lbl" style="color:red;"></label>
                </div>
                </div>
              </li> 
              <li>
                <div class="item-content item-input">
                <div class="item-inner">
                <div class="item-title item-label">*Fecha de vencimiento</div>
                <div class="item-input-wrap" style="height: 56px;font-size: 15px;">
                  <div class="sr-input sr-element sr-card-element" id="v_card-expiry" style="margin-top: .5em;">
                    <!-- A Stripe card Element will be inserted here. -->
                  </div>
                  <span class="input-clear-button"></span>
                </div>
                <label for="" id="lblntarjeta" class="lbl" style="color:red;"></label>
                </div>
                </div>

              </li> 

              <li>
                <div class="item-content item-input">
                <div class="item-inner">
                <div class="item-title item-label">*CVC</div>
                <div class="item-input-wrap" style="height: 56px;font-size: 15px;">
                  <div class="sr-input sr-element sr-card-element" id="v_card-cvc" style="margin-top: .5em;">
                    <!-- A Stripe card Element will be inserted here. -->
                  </div>
                  <span class="input-clear-button"></span>
                </div>
                <label for="" id="lblcvc" class="lbl" style="color:red;"></label>
                </div>
                </div>
              </li>
          </ul>
          <div class="sr-field-error " id="card-errors" role="alert" style="color:#E25950;"></div>
          <div class=" ">
            <a class="button button-fill botonesredondeado botones" onclick="" id="submit-card" style="height: 60px;
    line-height: 40px;
    /* width: 100%; */
    color: white!important;
    background: #FFC830!important;
    margin-left: 1em;
    margin-right: 1em;
    margin-top: 1em;">Guardar Tarjeta</a>



     <a class="button button-fill botonesredondeado botones" onclick="" id="btnatras" style="height: 60px;
    line-height: 40px;
    color: white!important;
    background: red!important;
    margin-left: 1em;
    margin-right: 1em;
    margin-top: 1em;">Cancelar</a>
          </div>  
        </div>
         </div> 
      </div>
    </div>  

       </div>

        <div class="row divefectivo" >
         

       </div>

      
       <div class="row" style="margin-top: 1em;">
             <div class="col-100">
          </div>
        </div>
      </div>
	`;