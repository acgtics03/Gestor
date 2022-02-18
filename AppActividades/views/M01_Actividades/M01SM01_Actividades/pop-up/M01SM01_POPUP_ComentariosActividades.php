<div class="modal-dialog modal-sm modal-dialog-centered" role="document" style="width: 1000px;">
    <div class="modal-content" style="width: 1000px;">
		<div class="modal-cabecera-list" style="text-align:left;">
			<button class="close btn-cerrar" data-dismiss="modal" aria-label="Close"><i class="fa fa-window-close"
					aria-hidden="true"></i>
			</button>
			<span><i class="fa fa-list" aria-hidden="true"></i> Comentarios de la Actividad</span>
		</div>
		<div class="modal-body" style="width: 900px;">		
			<input type="hidden" id="txtIDActividadComentarios">  
			
			<label for="" class="label-texto">DATOS DE LA ACTIVIDAD</label>
			<br>
			
            <div class="form-row separador">				
                <div class="col-4">	
				
					<div class="form-row">
						<div class="col">
							<label for="" class="label-texto">Nombre</label>
							<select class="cbx-texto" name="bxNombreActividadComent" id="bxNombreActividadComent" disabled>
								<option selected="true" disabled="disabled">Seleccionar..</option>
							</select>
						</div>
					</div>
					<div class="form-row">
						<div class="col">
							<label for="" class="label-texto">Descripción</label>
							<textarea id="txtDescripcionComent" class="caja-texto cbx-tam descripcion" maxlength="200" onkeypress="cancelar()" readonly></textarea>
						</div>
					</div>
					
					<div class="form-row">
						<div class="col">
							<label for="" class="label-texto">Responsable</label>
							<select class="cbx-texto" name="bxResponsableComent" id="bxResponsableComent" disabled>
								<option selected="true" disabled="disabled">Seleccionar..</option>
							</select>
						</div>
					</div>
					<div class="form-row">
						<div class="col-md-6">
							<label for="" class="label-texto">Fec. Inicio 
								<small id="txtFechaBajaRegistroHtml" class="form-text text-muted-validacion text-danger ocultar-info"></small>
							</label>
							<input type="date" id="txtFechaInicioComent" class="caja-texto">
						</div>
						<div class="col-md-6">
							<label class="label-texto">Fec. Termino 
								<small id="boxmotivo_eliminarHtml" class="form-text text-muted-validacion text-danger ocultar-info"></small>
							</label>
							<input type="date" id="txtFechaTerminoComent" class="caja-texto">
						</div>
						<div class="col-md-6">
							<label for="" class="label-texto">Hr Inicio <small id="txtFechaBajaRegistroHtml"
								class="form-text text-muted-validacion text-danger ocultar-info">
							</small></label>

							<div class="row">
								<div class="col">
									<input type="number" class="caja-texto" name="txtHoraInicioComent" id="txtHoraInicioComent" list="horas" placeholder="Horas" onKeyDown="limitText(this,2);" onKeyUp="limitText(this,2);">
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
									<input type="number" class="caja-texto" name="txtMinutosInicioComent" id="txtMinutosInicioComent" list="Minutos" placeholder="Minutos" onKeyDown="limitText(this,2);" onKeyUp="limitText(this,2);">
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
									<input type="number" class="caja-texto" name="txtHoraTerminoComent" id="txtHoraTerminoComent" list="horas" placeholder="Horas" onKeyDown="limitText(this,2);" onKeyUp="limitText(this,2);">
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
									<input type="number" class="caja-texto" name="txtMinutosTerminoComent" id="txtMinutosTerminoComent" list="Minutos" placeholder="Minutos" onKeyDown="limitText(this,2);" onKeyUp="limitText(this,2);">
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
							<select class="cbx-texto" name="bxEstadoComent" id="bxEstadoComent" disabled>
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
					
					
					<div style="padding-top: 20px;">
						<div style="text-align: center;">
							<label for="" class="label-texto">INGRESO DE COMENTARIOS</label>
							<br>
						</div>
						<form method="POST" id="commentForm">
							<div class="form-row">
								<div class="col">
									<label for="" class="label-texto">Nombre</label>
									<input type="text" name="nombre" id="nombre" class="form-control" required />
								</div>
							</div>
							<div class="form-row">
								<div class="col">
									<label for="" class="label-texto">Comentario</label>
									<textarea name="comentario" id="comentario" class="form-control" rows="2" required></textarea>
								</div>
							</div>						
							<span id="message"></span>
							<br>
							<div class="form-group" style="text-align: right !important;margin-bottom: 0px;">
								<input type="hidden" name="commentId" id="commentId" value="0" />
								<input type="submit" name="submit" id="submit" class="btn btn-primary" value="COMENTAR" />
							</div>
						</form>		
					</div>		
                </div>			
				<div class="col" style="height: 540px; overflow: auto;">
					<div class="wrapper" >
						<div class="chat-area">
							<div class="chat-area-header">
								<div class="chat-area-title">Grupo Soporte</div>
								
								<div class="chat-area-group">
									<img class="chat-area-profile" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%283%29+%281%29.png" alt="" />
									<img class="chat-area-profile" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%282%29.png" alt="">
									<img class="chat-area-profile" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%2812%29.png" alt="" />
									<span>+4</span>
								</div>
							</div>
							<div class="chat-area-main">
								<?php //$contC = 0 ?>
								<?php							
								//while($row= mysqli_fetch_assoc($query)) {  
								//print_r($key);
								?>
								<?php //$contC++ ?>
								<!--<div class="chat-msg">
									<div class="chat-msg-profile">
										<img class="chat-msg-img" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%283%29+%281%29.png" alt="" />
										<div class="chat-msg-date"><span class="color-autor">Luis Chavez</span> &nbsp; &nbsp; <?php //echo $row['fecha']; ?> - <?php //echo $row['hora']; ?></div>
									</div>
									<div class="chat-msg-content">
										<div class="chat-msg-text"><?php //echo $row['comentario']; ?></div>
									</div>
								</div>-->
								<?php //}  ?>
								<!--<div class="chat-msg owner">
									<div class="chat-msg-profile">
										<img class="chat-msg-img" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%281%29.png" alt="" />
										<div class="chat-msg-date"><span class="color-autor">Jimenna Lopez</span> &nbsp; &nbsp; 26/01/2022 - 2:50pm</div>
									</div>
									<div class="chat-msg-content">
										<div class="chat-msg-text">Cras mollis nec arcu malesuada tincidunt.</div>
									</div>
								</div>-->	
								
								
								<div id="showComments"></div>
									
							</div>
						</div>			
					</div>
				</div>                                
			</div>
		</div>
	</div>
</div>