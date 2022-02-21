<div class="modal-dialog modal-sm modal-dialog-centered" role="document" style="width: 1000px;">
    <div class="modal-content" style="width: 1000px;">
		<div class="modal-cabecera-list" style="text-align:left;">
			<button class="close btn-cerrar" data-dismiss="modal" aria-label="Close"><i class="fa fa-window-close"
					aria-hidden="true"></i>
			</button>
			<span><i class="fa fa-list" aria-hidden="true"></i> Comentarios de la Tarea</span>
		</div>
		<div class="modal-body" style="width: 900px;">						
				
				<label for="" class="label-texto">DATOS DE LA TAREA</label>
				<br>
				
			
		<div class="form-row separador">				
			<div class="col-4">	
			
				<div class="form-row">
					<div class="col">
						<label for="" class="label-texto">Nombre</label>
						<input type="text" id="txtNombreTareaComent" class="caja-texto" placeholder="Apellido Paterno" readonly>
					</div>
				</div>

				<div class="form-row">
					<div class="col">
						<label for="" class="label-texto">Descripción</label>
					   <textarea rows="4" maxlength="150" id="txtDescripcionTareaComent" class="caja-texto"
							placeholder="Describa la tarea" style="height: auto;resize: none;" required readonly></textarea>
					</div>
				</div>

				<div class="form-row">
					<div class="col">
						<label for="" class="label-texto">Responsable</label>
						<select class="cbx-texto" name="bxResponsableTareaComent" id="bxResponsableTareaComent" disabled>
							<option selected="true" disabled="disabled">Seleccionar..</option>
						</select>
					</div>
				</div>

				<div class="form-row">
					<div class="col-md-6">
						<label for="" class="label-texto">Fec. Inicio <small id="txtFechaBajaRegistroHtml"
								class="form-text text-muted-validacion text-danger ocultar-info">
							</small></label>
						<input type="date" id="txtFechaInicioTareaComent" class="caja-texto">

					</div>
					<div class="col-md-6">
						<label class="label-texto">Fec. Termino <small id="boxmotivo_eliminarHtml"
								class="form-text text-muted-validacion text-danger ocultar-info">
							</small></label>
						<input type="date" id="txtFechaTerminoTareaComent" class="caja-texto">
					</div>

					<div class="col-md-6">
						<label for="" class="label-texto">Hr Inicio <small id="txtFechaBajaRegistroHtml"
							class="form-text text-muted-validacion text-danger ocultar-info">
						</small></label>

						<div class="row">
							<div class="col">
								<input type="number" class="caja-texto" name="txtHoraInicioTareaComent" id="txtHoraInicioTareaComent" list="horas" placeholder="Horas" onKeyDown="limitText(this,2);" onKeyUp="limitText(this,2);">
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
								<input type="number" class="caja-texto" name="txtMinutosInicioTareaComent" id="txtMinutosInicioTareaComent" list="Minutos" placeholder="Minutos" onKeyDown="limitText(this,2);" onKeyUp="limitText(this,2);">
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
								<input type="number" class="caja-texto" name="txtHoraTerminoTareaComent" id="txtHoraTerminoTareaComent" list="horas" placeholder="Horas" onKeyDown="limitText(this,2);" onKeyUp="limitText(this,2);">
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
								<input type="number" class="caja-texto" name="txtMinutosTerminoTareaComent" id="txtMinutosTerminoTareaComent" list="Minutos" placeholder="Minutos" onKeyDown="limitText(this,2);" onKeyUp="limitText(this,2);">
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
						<select class="cbx-texto" name="bxEstadoTareaComent" id="bxEstadoTareaComent" disabled>
							<option selected="true" disabled="disabled">Seleccionar..</option>
							<?php
							$Estados = new ControllerCategorias();
							$verEstados = $Estados->VerEstadosTareas();
							foreach ($verEstados as $TEstados) {
								?>
								<option value="<?php echo $TEstados['ID']; ?>"><?php echo $TEstados['Nombre']; ?></option>
							<?php }  ?>
						</select>   
					</div>
				</div>
					
					
				<div style="padding-top: 35px;">
					<div style="text-align: center;">
						<label for="" class="label-texto">INGRESO DE COMENTARIOS</label>
						<br>
					</div>									
					  
					<form method="POST" id="commentFormTareas">
						<input type="hidden" id="txtIDTareasComentarios" name="txtIDTareasComentarios">
						<?php $usuario = $_SESSION['usu'];  								
						$consultar_nombre =  mysqli_query($conection, "SELECT idusuario AS ID FROM usuario WHERE usuario ='$usuario'");
						$consultar_nombrer = mysqli_fetch_assoc($consultar_nombre);
						$id_usuario = $consultar_nombrer['ID'];
						?>
						<input type="hidden" id="IdUsuario" name="IdUsuario" value="<?php echo $id_usuario; ?>">
		
						<div class="form-row">
							<div class="col">
								<label for="" class="label-texto">Nombre</label>
								<input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $nombre_usuario; ?>" />
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
				
			<div class="col" style="height: 550px; overflow: auto;">
				<div class="wrapper" >
					<div class="chat-area">
						<div class="chat-area-header">

							<div class="chat-area-title">Grupo Soporte</div>
							
							<div class="chat-area-group">
								<!--<img class="chat-area-profile" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%283%29+%281%29.png" alt="" />
								<img class="chat-area-profile" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%282%29.png" alt="">
								<img class="chat-area-profile" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%2812%29.png" alt="" />
								<span>+4</span>-->
							</div>
						</div>
						<div class="chat-area-main">
							<div id="ViewsCommentsTareas"></div>
						</div>						
					</div>			
				</div>
			</div>                                
		
		</div>
		</div>
	</div>
</div>