var html=`
			<div class="col-md-6 divdetalle" style="display: block;">
<!-- 					<label for="">DETALLE DE NOTA</label>
 -->					<div class="row">
						<div class="col-md-12">
							<span id="folionota" style="text-align: center;
    font-size: 18px;
    justify-content: center;
    font-weight: bold;
    display: flex;"></span>

    <span id="fechapago" style="text-align: center;
    font-size: 18px;
    justify-content: center;
    font-weight: bold;
    display: flex;margin-top: 1em;">2023-05-31 20:41:02</span>
						</div>
						
					</div>
					<div class="listadopagos" id="listadopagos"> <li class="list-group-item  align-items-center" style="">
					   <div class="row">
					   <div class="col-md-10">
					   		<p id=""> 						ACADEMIA JUNIO ADULTOS MATUTINO M Y J  7:00 A 8:00 AM																																		 </p>
		                    <p class="" style="float: right;">$<span class="">980.00</span></p>

		                   </div>
		                   <div class="col-md-2">

							    <span class="badge ">
		                        
							    </span>
					   		 </div>
					    
					    </div>

					  </li></div>
					<div>
						<ul class="list-group divmonedero" style="display: block;">
									<li class="list-group-item  align-items-center" style="color:">
								   <div class="row">
								   <div class="col-md-10">
								   		<p id="">Monedero</p>
					                    <p class="" style="
											    float: right;
											">$<span id="monedero">0.00</span></p>
					                   </div>
					                   <div class="col-md-2">

										    <span class="badge ">
										    </span>
								   		 </div>
								    
								    </div>

								  </li>
								</ul>
							</div>

							<div>
								<ul class="list-group" id="uldescuentos" style="background: #46b2e2;"></ul>
							</div>




								<div>
								<ul class="list-group divresumen" style="display: block;">
									<li class="list-group-item  align-items-center" style="background: #aeb3b7;">
								   <div class="row">
								   <div class="col-md-10">
								   		<p id="">Resumen</p>
					                    <p class="" style="
											    float: right;
											">$<span id="" class="lblresumen">980.00</span></p>
					                   </div>
					                   <div class="col-md-2">

										    <span class="badge ">
										    </span>
								   		 </div>
								    
								    </div>

								  </li>
								</ul>
							</div>

								<div>
								<ul class="list-group divcomision" style="display: block;">
									<li class="list-group-item  align-items-center" style="background: #aeb3b7;">
								   <div class="row">
								   <div class="col-md-10">
								   		<p id="">Comisión</p>
					                    <p class="" style="
											    float: right;
											">$<span id="" class="lblcomision">0.00</span></p>
					                   </div>
					                   <div class="col-md-2">

										    <span class="badge ">
										    </span>
								   		 </div>
								    
								    </div>

								  </li>
								</ul>
							</div>


								<div>
								<ul class="list-group divtotal" style="display: block;">
									<li class="list-group-item  align-items-center" style="background: #aeb3b7;">
								   <div class="row">
								   <div class="col-md-10">
								   		<p id="">Total</p>
					                    <p class="" style="
											    float: right;
											">$<span id="" class="lbltotal">980.00</span></p>
					                   </div>
					                   <div class="col-md-2">

										    <span class="badge ">
										    </span>
								   		 </div>
								    
								    </div>

								  </li>
								</ul>
							</div>
							<div class="row">
								<div class="col-md-12 imagenescomprobante">
				<div class="card" style="width: 18rem;">
				  <img class="card-img-top" src="app/appwoolis/php/upload/comprobante/2023-05-31 20:40:53.png" style="cursor:pointer;" onclick="mostrarModal(this)">
				  <div class="card-body">
				    <h5 class="card-title"></h5>
				    <p class="card-text"></p>
				  </div>
				</div>

			</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<label for="">MÉTODO DE PAGO:</label>
									<span id="tipopago">Transferencia,</span>
								</div>
								
								
							</div>

								<div class="row">
									<div class="col-md-12">
									<label for="">ESTATUS:</label>
								<span id="estatus" class="notaaceptado">ACEPTADO</span>
							</div>
							</div>
							<div class="requierefactura">
								<div class="row">
									<div class="col-md-12">
										<label for="">REQUIERE FACTURA:</label>
									<span id="requierefactura">NO</span>
								</div>
								</div>
							</div>


								<div class="foliofacturacion" style="display: none;">
								<div class="row">
									<div class="col-md-12">
										<label for="">FOLIO DE FACTURA:</label>
									<span id="foliofactura"></span>
								</div>
								</div>
							</div>

								<div class="fechafac" style="display: none;">
								<div class="row">
									<div class="col-md-12">
										<label for="">FECHA DE FACTURA:</label>
									<span id="fechafactura"></span>
								</div>
								</div>
							</div>

							<!-- <div class="row">
								<div class="col-md-12">
									<button class="btn btn-success btncambiarestatus" onclick="">ACEPTAR PAGO</button>
								</div>
							</div> -->

							</div>
	`;