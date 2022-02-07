<div class="modal-dialog modal-sm modal-dialog-centered" role="document" style="width: 1000px;">
    <div class="modal-content" style="width: 1000px;">
        <div class="modal-cabecera-list" style="text-align:left;">
            <button class="close btn-cerrar" data-dismiss="modal" aria-label="Close"><i class="fa fa-window-close"
                    aria-hidden="true"></i></button>
            <span><i class="fa fa-list" aria-hidden="true"></i> Comentarios de la Actividad</span>
        </div>
        <div class="modal-body" style="width: 900px;">
		
            <input type="hidden" id="txtIDActividadComentarios">   
			
				<label for="" class="label-texto">DATOS DE LA ACTIVIDAD</label>
			
			<br>
            <div class="form-row separador">				
                <div class="col-4">			
					<!--<input type="hidden" id="txtIDActividadTareas">-->

					<div class="form-row">
						<div class="col">
							<label for="" class="label-texto">Nombre</label>
							<select class="cbx-texto" name="bxNombreActividadPopup" id="bxNombreActividadPopup">
								<option selected="true" disabled="disabled">Seleccionar..</option>
							</select>
						</div>
					</div>
					<div class="form-row">
						<div class="col">
							<label for="" class="label-texto">Descripción</label>
							<textarea id="txtDescripcionPopup" class="caja-texto cbx-tam descripcion" maxlength="200" onkeypress="cancelar()"></textarea>
						</div>
					</div>
					<div class="form-row">
						<div class="col">
							<label for="" class="label-texto">Responsable</label>
							<select class="cbx-texto" name="bxResponsablePopup" id="bxResponsablePopup">
								<option selected="true" disabled="disabled">Seleccionar..</option>
							</select>
						</div>
					</div>
					<div class="form-row">
						<div class="col-md-6">
							<label for="" class="label-texto">Fec. Inicio 
								<small id="txtFechaBajaRegistroHtml" class="form-text text-muted-validacion text-danger ocultar-info"></small>
							</label>
							<input type="date" id="txtFechaInicioPopup" class="caja-texto">
						</div>
						<div class="col-md-6">
							<label class="label-texto">Fec. Termino 
								<small id="boxmotivo_eliminarHtml" class="form-text text-muted-validacion text-danger ocultar-info"></small>
							</label>
							<input type="date" id="txtFechaTerminoPopup" class="caja-texto">
						</div>
						<div class="col-md-6">
							<label for="" class="label-texto">Hr Inicio <small id="txtFechaBajaRegistroHtml"
								class="form-text text-muted-validacion text-danger ocultar-info">
							</small></label>

							<div class="row">
								<div class="col">
									<input type="number" class="caja-texto" name="txtHoraInicioPopup" id="txtHoraInicioPopup" list="horas" placeholder="Horas" onKeyDown="limitText(this,2);" onKeyUp="limitText(this,2);">
									<datalist id="horas">
										<?php
										$Horas = new ControllerCategorias();
										$verHoras = $Horas->VerHoras();
										foreach ($verHoras as $THoras) {
											?>
											<option value="<?php echo $THoras['ID']; ?>"><?php echo $THoras['Nombre']; ?></option>
										<?php }  ?>
									</datalist>  
								</div>
								<label for="">:</label>
								<div class="col">
									<input type="number" class="caja-texto" name="txtMinutosInicioPopup" id="txtMinutosInicioPopup" list="Minutos" placeholder="Minutos" onKeyDown="limitText(this,2);" onKeyUp="limitText(this,2);">
									<datalist id="Minutos">
										<?php
										$Minutos = new ControllerCategorias();
										$verMinutos = $Minutos->VerMinutos();
										foreach ($verMinutos as $TMinutos) {
											?>
											<option value="<?php echo $TMinutos['ID']; ?>"><?php echo $TMinutos['Nombre']; ?></option>
										<?php }  ?>
									</datalist>  
								</div>
							</div>
						</div>
						
						
						<div class="col-md-6">
							<label class="label-texto">Hr Termino <small id="boxmotivo_eliminarHtml"
								class="form-text text-muted-validacion text-danger ocultar-info">
							</small></label>

							<div class="row">
								<div class="col">
									<input type="number" class="caja-texto" name="txtHoraTerminoPopup" id="txtHoraTerminoPopup" list="horas" placeholder="Horas" onKeyDown="limitText(this,2);" onKeyUp="limitText(this,2);">
									<datalist id="horas">
										<?php
										$Horas = new ControllerCategorias();
										$verHoras = $Horas->VerHoras();
										foreach ($verHoras as $THoras) {
											?>
											<option value="<?php echo $THoras['ID']; ?>"><?php echo $THoras['Nombre']; ?></option>
										<?php }  ?>
									</datalist>  
								</div>
								<label for="">:</label>
								<div class="col">
									<input type="number" class="caja-texto" name="txtMinutosTerminoPopup" id="txtMinutosTerminoPopup" list="Minutos" placeholder="Minutos" onKeyDown="limitText(this,2);" onKeyUp="limitText(this,2);">
									<datalist id="Minutos">
										<?php
										$Minutos = new ControllerCategorias();
										$verMinutos = $Minutos->VerMinutos();
										foreach ($verMinutos as $TMinutos) {
											?>
											<option value="<?php echo $TMinutos['ID']; ?>"><?php echo $TMinutos['Nombre']; ?></option>
										<?php }  ?>
									</datalist>  
								</div>
							</div>                                             
						</div>
					</div>
					<div class="form-row">
						<div class="col">
							<label for="" class="label-texto">Estado</label>
							<select class="cbx-texto" name="bxEstadoPopup" id="bxEstadoPopup">
								<option selected="true" disabled="disabled">Seleccionar..</option>
								<?php
								$Estados = new ControllerCategorias();
								$verEstados = $Estados->VerEstados();
								foreach ($verEstados as $TEstados) {
									?>
									<option value="<?php echo $TEstados['ID']; ?>"><?php echo $TEstados['Nombre']; ?></option>
								<?php }  ?>
							</select>   
						</div>
					</div>
					<div style="padding-top: 50px;">
						<div style="text-align: center;">
							<label for="" class="label-texto">INGRESO DE COMENTARIOS</label>
						</div>
						<br>
						<div class="form-row">
							<div class="col">
								<label for="" class="label-texto">Nombre</label>
								<input type="text" id="txtNombreTarea" class="caja-texto" placeholder="Escriba aquí">
							</div>
						</div>
						<div class="form-row">
							<div class="col">
								<label for="" class="label-texto">Ingresa tu comentario</label>
								<textarea id="txtDescripcionPopup" class="caja-texto cbx-tam descripcion" maxlength="200" onkeypress="cancelar()"></textarea>
							</div>
						</div>
						
						<div class="chat-area-footer" style="border-top: none !important; padding:0px !important; position: inherit !important;">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
							  class="feather feather-image">
							<rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
							<circle cx="8.5" cy="8.5" r="1.5" />
							<path d="M21 15l-5-5L5 21" /></svg>								
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
							  class="feather feather-smile">
							<circle cx="12" cy="12" r="10" />
							<path d="M8 14s1.5 2 4 2 4-2 4-2M9 9h.01M15 9h.01" /></svg>	
							<div style="margin-left: 30px;">
								<button id="guardar" type="button" class="btn btn-registro" style="width: 100%; padding: 0px 20px;"> PUBLICAR COMENTARIO</button>
							</div>								
						</div>
						
					</div>
                </div>
				
				<div class="col" style="height: 575px; overflow: auto;">
					<div class="wrapper" >
						<div class="chat-area">
							<div class="chat-area-header">
								<!--<img class="user-profile" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%281%29.png" alt="" class="account-profile" alt="">-->
								<div class="chat-area-title">Grupo Soporte</div>
								
								<div class="chat-area-group">
									<img class="chat-area-profile" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%283%29+%281%29.png" alt="" />
									<img class="chat-area-profile" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%282%29.png" alt="">
									<img class="chat-area-profile" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%2812%29.png" alt="" />
									<span>+4</span>
								</div>
							</div>
							<div class="chat-area-main">
								<div class="chat-msg">
									<div class="chat-msg-profile">
										<img class="chat-msg-img" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%283%29+%281%29.png" alt="" />
										<div class="chat-msg-date"><span class="color-autor">Luis Chavez</span> &nbsp; &nbsp; 26/01/2022 - 2:40pm</div>
									</div>
									<div class="chat-msg-content">
										<div class="chat-msg-text">Neque gravida in fermentum et sollicitudin ac orci phasellus egestas. Pretium lectus quam id leo.</div>
									</div>
								</div>
								<div class="chat-msg owner">
									<div class="chat-msg-profile">
										<img class="chat-msg-img" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%281%29.png" alt="" />
										<div class="chat-msg-date"><span class="color-autor">Jimenna Lopez</span> &nbsp; &nbsp; 26/01/2022 - 2:50pm</div>
									</div>
									<div class="chat-msg-content">
										<div class="chat-msg-text">Cras mollis nec arcu malesuada tincidunt.</div>
									</div>
								</div>
								<div class="chat-msg">
									<div class="chat-msg-profile">
										<img class="chat-msg-img" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%282%29.png" alt="">
										<div class="chat-msg-date"><span class="color-autor">Miriam Gutierrez</span> &nbsp; &nbsp; 26/01/2022 - 2:53pm</div>
									</div>
									<div class="chat-msg-content">
										<div class="chat-msg-text">Ut faucibus pulvinar elementum integer enim neque volutpat.</div>
									</div>
								</div>
								<div class="chat-msg owner">
									<div class="chat-msg-profile">
										<img class="chat-msg-img" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%281%29.png" alt="" />
										<div class="chat-msg-date"><span class="color-autor">Jimenna Lopez</span> &nbsp; &nbsp; 26/01/2022 - 2:56pm</div>
									</div>
									<div class="chat-msg-content">
										<div class="chat-msg-text">Cras mollis nec arcu malesuada tincidunt.</div>
									</div>
								</div>
								<div class="chat-msg">
									<div class="chat-msg-profile">
										<img class="chat-msg-img" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%2812%29.png" alt="" />
										<div class="chat-msg-date"><span class="color-autor">Alfredo Mendiola</span> &nbsp; &nbsp; 26/01/2022 - 2:58pm</div>
									</div>
									<div class="chat-msg-content">
										<div class="chat-msg-text">Egestas tellus rutrum tellus pellentesque</div>
									</div>
								</div>
								<div class="chat-msg">
									<div class="chat-msg-profile">
										<img class="chat-msg-img" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%283%29+%281%29.png" alt="" class="account-profile" alt="">
										<div class="chat-msg-date"><span class="color-autor">Luis Chavez</span> &nbsp; &nbsp; 26/01/2022 - 3:00pm</div>
									</div>
									<div class="chat-msg-content">
										<div class="chat-msg-text">Consectetur adipiscing elit pellentesque habitant morbi tristique senectus et.</div>
									</div>
								</div>
								<div class="chat-msg owner">
									<div class="chat-msg-profile">
										<img class="chat-msg-img" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%281%29.png" alt="" />
										<div class="chat-msg-date"><span class="color-autor">Jimenna Lopez</span> &nbsp; &nbsp; 26/01/2022 - 3:02pm</div>
									</div>
									<div class="chat-msg-content">
										<div class="chat-msg-text">Tincidunt arcu non sodales😂</div>
									</div>
								</div>
								<div class="chat-msg">
									<div class="chat-msg-profile">
										<img class="chat-msg-img" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%282%29.png" alt="">
										<div class="chat-msg-date"><span class="color-autor">Miriam Gutierrez</span> &nbsp; &nbsp; 26/01/2022 - 3:05pm</div>
									</div>
									<div class="chat-msg-content">
										<div class="chat-msg-text">Consectetur adipiscing elit pellentesque habitant morbi tristique senectus et🥰</div>
									</div>
								</div>
							</div>
							
						</div>			
					</div>
				</div>                                
			</div>
        </div>
    </div>
</div>